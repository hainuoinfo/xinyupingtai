<?php
!defined('IN_JB') && exit('error');
loadLib('bbs.forums');
class bbs_thread extends bbs_forums{
	private static $cacheName = 'bbs_cache_icons', $load = false, $icons = array();
	public static function ini(){
		if (!self::$load) {
			self::loadIcons();
		}
	}
	private static function loadIcons(){
		self::$icons = cache::get_array(self::$cacheName, true);
		self::$load  = true;
	}
	public static function saveIcons($icons){
		cache::write_array(self::$cacheName, $icons);
		self::loadIcons();
		return true;
	}
	public static function getIcons(){
		return self::$icons;
	}
	public static function getIcon($iconId) {
		if ($iconId == 0) return false;
		return self::$icons[$iconId - 1];
	}
	public static function threadExists($tid){
		return db::exists('threads', array('id' => $tid));
	}
	public static function postExists($pid){
		return db::exists('posts', array('id' => $pid));
	}
	public static function addThread($fid, $iconid, $title, $message, $uid_ = 0) {
		global $uid, $timestamp;
		$uid_ || $uid_ = $uid;
		$title = common::cutstr($title, 80);;
		loadLib('member.base');
		$username = member_base::getUsername($uid_);
		if (!$username) return 'user_not_exists';
		
		if ($tid = db::insert('threads', array(
			'fid'                 => $fid,
			'top'                 => 0,
			'digest'              => 0,
			'iconid'              => $iconid,
			'title_flag'          => 0,
			'title_color'         => '',
			'title'               => $title,
			'uid'                 => $uid_,
			'username'            => $username,
			'clicks'              => 0,
			'timestamp'           => $timestamp,
			'posts'               => 0,
			'last_post_timestamp' => 0
		), true)) {
			if (($rs = self::addPost($tid, $title, $message, true, $uid_)) > 0) {
				db::update('forums', "threads=threads+1,today_threads=today_threads+1,last_tid='$tid',last_thread_title='$title',last_thread_timestamp='$timestamp',last_thread_uid='$uid',last_thread_username='$username'", "id='$fid'");
				return $tid;
			} else {
				db::del_id('threads', $tid);
				return $rs;
			}
		}
		return 'insert_error';
	}
	public static function addPost($tid, $title, $message, $first = false, $uid_ = 0){
		global $uid, $timestamp, $sys_credit_post;//发帖奖励积分
		$uid_ || $uid_ = $uid;
		loadLib('member.base');
		if (self::threadExists($tid)) {
			if ($username = member_base::getUsername($uid_)) {
				$aids = array();
				if (preg_match_all('/\[attach\](\d+)\[\/attach\]/', $message, $matches)) {
					$aids = $matches[1];
				}
				$pid = db::insert('posts', array(
					'tid'       => $tid,
					'uid'       => $uid_,
					'username'  => $username,
					'first'     => $first?1:0,
					'attachs'   => 0,
					'title'     => $title,
					'message'   => $message,
					'timestamp' => $timestamp
				), true);
				if ($pid) {
					$attachs = 0;
					if ($aids) {
						foreach ($aids as $aid) {
							if (db::exists('attach', array('id' => $aid, 'uid' => $uid_, 'status' => 0))) {
								db::update('attach', array('pid' => $pid, 'status' => 1), "id='$aid'");
								$attachs++;
							}
						}
					}
					if ($attachs > 0) {
						db::update('posts', array('attachs' => $attachs), "id='$pid'");
					}
					$fid = db::one_one('threads', 'fid', "id='$tid'");
					db::update('threads', "posts=posts+1,last_pid='$pid',last_post_uid='$uid_',last_post_username='$username',last_post_timestamp='$timestamp'", "id='$tid'");//更新帖子最新信息
					db::update('forums', "posts=posts+1,today_posts=today_posts+1,last_pid='$pid',last_post_timestamp='$timestamp',last_post_uid='$uid_',last_post_username='$username'", "id='$fid'");//更新版块帖子数
					db::update('memberfields', 'posts=posts+1', "uid='$uid_'");
					if (isset($sys_credit_post)) {
						member_base::addCredit($uid_, $sys_credit_post, '发帖产生的积分');//奖励用户积分或者扣除积分
					}
					$thread = self::getThread($tid, false);
					member_base::sendPm($thread['uid'], '用户：'.$username.'回复了您的帖子《'.$thread['title'].'》', '帖子新回复', 'post_reply');
					member_base::sendSms($thread['uid'], '用户：'.$username.'回复了您的帖子《'.$thread['title'].'》', 'post_reply');
					return $pid;
				}
				return 'insert_error';
			}
			return 'user_not_exists';
		}
		return 'thread_not_exists';
	}
	public static function editThread($tid, $iconid, $title, $message){
		global $timestamp;
		if (db::update('threads', array(
			'iconid'    => $iconid,
			'title'     => $title,
			'timestamp' => $timestamp
		), "id='$tid'")) {
			$thread = db::one('threads', '*', "id='$tid'");
			$forum  = db::one('forums', '*', "id='$thread[fid]'");
			if ($forum['last_tid'] == $tid) {
				db::update('forums', array(
					'last_thread_title'     => $thread['title'],
					'last_thread_timestamp' => $thread['timestamp'],
					'last_thread_uid'       => $thread['uid'],
					'last_thread_username'  => db::one_one('members', 'username', "id='$thread[uid]'")
				), "id='$thread[fid]'");
			}
			$pid = db::one_one('posts', 'id', "tid='$tid' and first='1'");
			if (($rs = self::editPost($pid, $title, $message)) === true) return true;
			return $rs;
		}
		return 'update_error';
	}
	public static function editPost($pid, $title, $message){
		
		global $timestamp, $uid;
		loadLib('member.base');
		if (self::postExists($pid)) {
			$aids = array();
			if (preg_match_all('/\[attach\](\d+)\[\/attach\]/', $message, $matches)) {
				$aids = $matches[1];
			}
			if (db::update('posts', array(
				'title'     => $title,
				'message'   => $message,
				'timestamp' => $timestamp
			), "id='$pid'")) {
				$post = db::one('posts', 'tid,uid,username', "id='$pid'");
				$authorId      = $post['uid'];
				$username = $post['username'];
				$tid      = $post['tid'];
				if ($pid == self::getLastPost($tid)) {
					db::update('threads', "last_pid='$pid',last_post_uid='$authorId',last_post_username='$username',last_post_username='',last_post_timestamp='$timestamp'", "id='$tid'");
					$fid = db::one_one('threads', 'fid', "id='$tid'");
					if (db::one_one('forums', 'last_tid', "id='$fid'") == $tid) {
						db::update('forums', array(
							'last_pid'            => $pid,
							'last_post_timestamp' => $timestamp,
							'last_post_uid'       => $authorId,
							'last_post_username'  => db::one_one('members', 'username', "id='$authorId'")
						), "id='$fid'");
					}
				}
				$attachs = 0;
				if ($aids) {
					foreach ($aids as $aid) {
						if (db::exists('attach', array('id' => $aid, 'uid' => $uid, 'status' => 0))) {
							db::update('attach', array('pid' => $pid, 'uid' => $authorId, 'status' => 1), "id='$aid'");
							$attachs++;
						}
					}
				}
				if ($attachs > 0) {
					db::update('posts', array('attachs' => $attachs), "id='$pid'");
				}
				return true;
			}
				return 'update_error';
		}
		return 'post_not_exists';
	
	}
	public static function getThread($tid, $addClick = true){
		if ($thread = db::one('threads', '*', "id='$tid'")) {
			if ($addClick) {
				db::update('threads', 'clicks=clicks+1', "id='$tid'");
				$thread['clicks']++;
			}
			return $thread;
		}
		return false;
	}
	public static function getPostTotal($tid, $ignore = 0){
		$ignore = (int)$ignore;
		return db::data_count('posts', "tid='$tid'".($ignore?" and uid='$ignore'":''));
	}
	public static function getPosts($tid, $spage = 0, $spagesize = 0, $ignore = 0){
		global $page, $pagesize, $db, $pre, $weburl2, $img_avatar;
		$ignore = (int)$ignore;//只看该作者
		$spage || $spage = $page;
		$spagesize || $spagesize = $pagesize;
		loadLib('member.credit');
		$limit = ' limit '.($spage - 1) * $spagesize.','.$spagesize;
		//$query = $db->query("select t1.*,t2.sex,t3.* from {$pre}posts t1,{$pre}members t2,{$pre}memberfields t3 where t1.tid='$tid'".($ignore?" and t1.uid='$ignore'":'')." and t1.uid=t2.id and t2.id=t3.uid order by t1.id$limit");
		$query = $db->query("select t1.*,t2.sex,t3.*,t4.* from {$pre}posts t1 left join {$pre}members t2 on t2.id=t1.uid left join {$pre}memberfields t3 on t3.uid=t2.id left join {$pre}membertask t4 on t4.uid=t3.uid where t1.tid='$tid'".($ignore?" and t1.uid='$ignore'":'')." order by t1.id$limit");
		$postList = array();
		while ($post = $db->fetch_array($query)) {
			$post['avatar'] || $post['avatar'] = $post['sex'] == 1?'boy.gif':'girl.gif';
			$post['avatar'] = $weburl2.$img_avatar.$post['avatar'];
			$post['level']  = member_credit::getLevel($post['credits']);
			/*$post['message'] = string::ubbDecode($post['message']);
			if ($post['attachs'] > 0) {
				$post['message'] = self::parseUbb($post['id'], $post['message']);
			}*/
			$post['message'] = self::parseUbb($tid, $post['id'], $post['message'], $post['attachs']);
			$postList[] = $post;
		}
		if ($postList) return $postList;
		return false;
	}
	public static function getSimplePosts($tid, $spage = 0, $spagesize = 0, $ignore = 0){
		global $page, $pagesize, $db, $pre, $weburl2, $img_avatar;
		$ignore = (int)$ignore;//只看该作者
		$spage || $spage = $page;
		$spagesize || $spagesize = $pagesize;
		$limit = ' limit '.($spage - 1) * $spagesize.','.$spagesize;
		$query = $db->query("select t1.*,t2.sex,t3.*,t4.* from {$pre}posts t1 left join {$pre}members t2 on t2.id=t1.uid left join {$pre}memberfields t3 on t3.uid=t2.id left join {$pre}membertask t4 on t4.uid=t3.uid where t1.tid='$tid'".($ignore?" and t1.uid='$ignore'":'')." order by t1.id$limit");
		$postList = array();
		while ($post = $db->fetch_array($query)) {
			$post['message'] = preg_replace('/\[attach\]\d+\[\/attach\]|\[img.*?\].*?\[\/img\]|\[.*?\]/', '', $post['message']);
			$post['message'] = nl2br($post['message']);
			$postList[] = $post;
		}
		if ($postList) return $postList;
		return false;
	}
	private static function parseUbb($tid, $pid, $message, $atts = 0){
		global $db, $pre;
		$message = string::ubbDecode($message);
		if ($atts > 0) {
			$attachs = array();
			$query2 = $db->query("select * from {$pre}attach where pid='$pid'");
			while ($att = $db->fetch_array($query2)) {
				$attachs[$att['id']] = $att;
			}
			if ($attachs) {
				$message = preg_replace('/\[attach\](\d+)\[\/attach\]/e', 'self::getAttach($1,$attachs)', $message);
			}
		}
		$message = preg_replace('/\[quote1\](\d+)\[\/quote1\]/e', 'self::getQuote($1,$tid)', $message);
		return $message;
	}
	private static function getAttach($id, $attachs){
		global $weburl2;
		if ($att = $attachs[$id]) {
			switch ($att['filetype']) {
				case 'img':
					return '<img src="'.$weburl2.'img/attach/'.$att['src'].'" />';
				break;
				default:
					return '<a href="'.$att['src'].'">下载附件</a>';
				break;
			}
		}
		return '[attach]'.$id.'[/attach]';
	}
	private static function getQuote($pid, $tid){
		if ($post = db::one('posts', '*', "tid='$tid' and id='$pid'")) {
			$message = $post['message'];
			return '<div class="quote"><blockquote>'.self::parseUbb($post['tid'], $pid, $message, $post['attachs']).'
							<label>'.$post['username'].' 发表于 '.date('Y-m-d H:i:s', $post['timestamp']).'</label>
						</blockquote></div>';
		}
		return '[quote1]'.$pid.'[/quote]';
	}
	public static function getAttachs($pid){
		return db::get_list2('attach', '*', "pid='$pid'");
	}
	public static function getPost($pid, $format = true){
		global $db, $pre, $weburl2, $img_avatar;
		loadLib('member.credit');
		if ($post = $db->fetch_first("select t1.*,t2.sex,t3.* from {$pre}posts t1,{$pre}members t2,{$pre}memberfields t3 where t1.id='$pid' and t1.uid=t2.id and t2.id=t3.uid")) {
			$post['avatar'] || $post['avatar'] = $post['sex'] == 1?'boy.gif':'girl.gif';
			$post['avatar'] = $weburl2.$img_avatar.$post['avatar'];
			$post['level']  = member_credit::getLevel($post['credits']);
			$format && $post['message'] = string::ubbDecode($post['message']);;
		}
		if ($post) return $post;
		return false;
	}
	public static function postAtPage($pid, $spagesize = 0){
		global $pagesize;
		$spagesize || $spagesize = $pagesize;
		$tid = db::one_one('posts', 'tid', "id='$pid'");
		$index = db::data_count('posts', "tid='$tid' and id<=$pid");
		if ($index == 0) return 0;
		$index--;
		return floor($index / $spagesize) + 1;
	}
	public static function isThreadAuthor($tid, $uid){
		if ($thread = db::one('threads', '*', "id='$tid'")) {
			if ($thread['uid'] == $uid) return true;
			if ($groupId = db::one_one('members', 'groupid', "id='$uid'")) {
				if ($group   = db::one('user_groups', '*', "id='$groupId'")) {
					if (in_array($group['key'], array('admin'))) return true;
					if ($group['key'] == 'moderator') {
						$fid = $thread['fid'];
						if (db::exists('moderator', array(
							'fid' => $fid,
							'uid' => $uid
						))) return true;
					}
				}
			}
		}
		return false;
	}
	public static function isPostAuthor($pid, $uid){
		if ($post = db::one('posts', '*', "id='$pid'")) {
			if ($post['uid'] == $uid) return true;
			if ($groupId = db::one_one('members', 'groupid', "id='$uid'")) {
				if ($group   = db::one('user_groups', '*', "id='$groupId'")) {
					if (in_array($group['key'], array('admin'))) return true;
					if ($group['key'] == 'moderator') {
						$fid = db::one_one('threads', 'fid', "id='$post[tid]'");
						if (db::exists('moderator', array(
							'fid' => $fid,
							'uid' => $uid
						))) return true;
					}
				}
			}
		}
		return false;
	}
	public static function isLastPost($pid){
		if ($tid = db::one_one('posts', 'uid', "id='$pid'")) {
			if (db::data_count('posts', "tid='$tid' and id>'$pid'") == 0) {
				return true;
			}
			return false;
		}
		return false;
	}
	public static function getLastPost($tid, $key = 'id'){
		return db::one_one('posts', 'id', "tid='$tid'", 'id desc');
	}
	public static function delThread($tid){
		global $db, $pre;
		if ($thread = db::one('threads', '*', "id='$tid'")) {
			$fid = $thread['fid'];
			$query = $db->query("select id,uid from {$pre}posts where tid='$tid'");
			while ($line = $db->fetch_array($query)) {
				//$db->query("update {$pre}memberfields set posts=posts-1 where uid='$uid'");
				self::delPost($line['id'], $line['uid']);
			}
			$db->query("delete from {$pre}threads where id='$tid'");
			$db->query("update {$pre}forums set threads=threads-1 where id='$fid'");
			if (db::one_one('forums', 'last_tid', "id='$fid'") == $tid) {
				//如果是最后一个帖子的话 更新版块最新信息
				if ($lastThread = db::one('threads', '*', "fid='$fid'", 'timestamp desc')) {
					$lastPost = db::one('posts', '*', "tid='$lastThread[id]'", 'timestamp desc');
					db::update('forums', array(
						'last_tid'              => $lastThread['id'],
						'last_thread_title'     => $lastThread['title'],
						'last_thread_timestamp' => $lastThread['timestamp'],
						'last_thread_uid'       => $lastThread['uid'],
						'last_thread_username'  => $lastThread['username'],
						'last_pid'              => $lastPost['id'],
						'last_post_timestamp'   => $lastPost['timestamp'],
						'last_post_uid'         => $lastPost['uid'],
						'last_post_timestamp'   => $lastPost['timestamp']
					), "id='$fid'");
				} else {
					db::update('forums', array(
						'last_tid'              => 0,
						'last_thread_title'     => '',
						'last_thread_timestamp' => 0,
						'last_pid'              => 0,
						'last_post_timestamp'   => 0,
						'last_post_uid'         => 0,
						'last_post_timestamp'   => 0
					), "id='$fid'");
				}
			}
			if ($GLOBALS['uid'] != $thread['uid']) {
				member_base::sendPm($thread['uid'], '帖子《'.$thread['title'].'》被删除', '帖子被删除', 'post_del');
				member_base::sendSms($thread['uid'], '帖子《'.$thread['title'].'》被删除', 'post_del');
			}
			return true;
		}
		return 'error';
	}
	public static function delPost($pid, $uid, $ignoreFirst = false){
		global $timestamp;
		if (!self::isPostAuthor($pid, $uid)) return 'authority_error';
		if ($pid) {
			if ($post = db::one('posts', '*', "id='$pid'")) {
				if ($post['uid'] == $uid) {
					$tid = $post['tid'];
					$fid = db::one_one('threads', 'fid', "id='$tid'");
					if ($post['first'] && $ignoreFirst) {
						//主题
						return 'authority_error';
					} else {
						$lastPostId = self::getLastPost($tid);
						db::del_id('posts', $pid);
						db::update('threads', 'posts=posts-1', "id='$fid'");
						db::update('forums', 'posts=posts-1', "id='$fid'");
						db::update('memberfields', 'posts=posts-1',"uid='$uid'");
						if ($lastPostId == $pid) {
							//更新最后发帖的帖子时间
							//$lastPostTime = self::getLastPost($tid, 'timestamp');
							$lastPost = db::one('posts', '*', "tid='$tid'", 'id desc');
							db::update('threads', "last_post_timestamp='$lastPost[timestamp]'", "id='$tid'");
							if (db::one_one('forums', 'last_tid', "id='$fid'") == $tid) {
								db::update('forums', "last_post_timestamp='$lastPost[timestamp]',last_post_uid='$lastPost[uid]',last_post_username='$lastPost[username]'", "id='$fid'");//更新最后发帖的作者
							}
						}
						return $tid;
					}
				}
				return 'post_author_error';
			}
			return 'post_not_exists';
		}
		return 'pid_error';
	}
	public static function getTotal($fid, $type = 'all'){
		$where = "fid='$fid' and top='0'";
		$type == 'digest' && (($where && $where .= ' and ') || !$where) && $where .= "digest in('1', '2', '3')";
		return db::data_count('threads', $where);
	}
	public static function getSimpleTotal($fid){
		return db::data_count('threads', "fid='$fid'");
	}
	public static function getTopTids($fid){
		return db::get_ids('threads', "top=1 or (top=2 and fid='$fid')");
	}
	public static function getTops($fid){
		if ($list = db::get_list2('threads', '*', "top=1 or (top=2 and fid='$fid')", 'last_post_timestamp desc')) {
			foreach ($list as $k => $v) {
				if ($v['title_color']) {
					$v['title_style'] .= 'color:'.$v['title_color'].';';
				}
				if ($v['title_flag'] > 0) {
					if ($v['title_flag'] & 1) $v['title_style'] .= 'font-weight:bold;';//加粗
					if ($v['title_flag'] & 2) $v['title_style'] .= 'font-style: italic;';//倾斜
					if ($v['title_flag'] & 4) $v['title_style'] .= 'text-decoration: underline;';//下划线
				}
				$list[$k] = $v;
			}
			return $list;
		}
		return array();
	}
	public static function getThreadList($fid, $type = 'all', $spage = 0, $spagesize = 0, $ignore = array()){
		global $page, $pagesize;
		$spage     || $spage = $page;
		$spagesize || $spagesize = $pagesize;
		if ($ignore) $ignore = '\''.implode('\',\'', $ignore).'\'';
		else $ignore = '';
		$where = "fid='$fid' and top='0'";
		$type == 'digest' && (($where && $where .= ' and ') || !$where) && $where .= "digest in('1', '2', '3')";
		if ($ignore) $where .= ' and id not in($ignore)';
		if ($list = db::get_list2('threads', '*', $where, 'last_post_timestamp desc', $spage, $spagesize)) {
			foreach ($list as $k => $v) {
				if ($v['title_color']) {
					$v['title_style'] .= 'color:'.$v['title_color'].';';
				}
				if ($v['title_flag'] > 0) {
					if ($v['title_flag'] & 1) $v['title_style'] .= 'font-weight:bold;';//加粗
					if ($v['title_flag'] & 2) $v['title_style'] .= 'font-style: italic;';//倾斜
					if ($v['title_flag'] & 4) $v['title_style'] .= 'text-decoration: underline;';//下划线
				}
				$list[$k] = $v;
			}
			return $list;
		}
		return array();
	}
	public static function getSimpleThreadList($fid, $spage = 0, $spagesize = 0, $ignore = array()){
		global $page, $pagesize;
		$spage     || $spage = $page;
		$spagesize || $spagesize = $pagesize;
		if ($ignore) $ignore = '\''.implode('\',\'', $ignore).'\'';
		else $ignore = '';
		$where = "fid='$fid'";
		if ($ignore) $where .= ' and id not in($ignore)';
		if ($list = db::get_list2('threads', '*', $where, 'last_post_timestamp desc', $spage, $spagesize)) {
			
			return $list;
		}
		return array();
	}
	public static function getThreadList2($where, $order, $spage = 0, $spagesize = 0){
		global $page, $pagesize;
		$spage     || $spage = $page;
		$spagesize || $spagesize = $pagesize;
		if ($list = db::get_list2('threads', '*', $where, $order, $spage, $spagesize)) {
			foreach ($list as $k => $v) {
				if ($v['title_color']) {
					$v['title_style'] .= 'color:'.$v['title_color'].';';
				}
				if ($v['title_flag'] > 0) {
					if ($v['title_flag'] & 1) $v['title_style'] .= 'font-weight:bold;';//加粗
					if ($v['title_flag'] & 2) $v['title_style'] .= 'font-style: italic;';//倾斜
					if ($v['title_flag'] & 4) $v['title_style'] .= 'text-decoration: underline;';//下划线
				}
				$list[$k] = $v;
			}
			return $list;
		}
		return array();
	}
}
bbs_thread::ini();
?>