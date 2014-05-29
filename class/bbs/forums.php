<?php
class bbs_forums{
	public static function getForums($f='*'){
		//return db::get_list2('forums', $f, '', 'sort,timestamp desc');
		global $db, $pre;
		$forums = array();
		/*$query = $db->query("select $f from {$pre}forums order by sort,timestamp desc");
		while ($forum = $db->fetch_array($query)) {
			$forum['moderator'] = self::getModerator($forum['id']);
			$forums[] = $forum;
		}
		return $forums;*/
		$query = $db->query("select id from {$pre}forums order by sort,timestamp desc");
		while ($fid = $db->fetch_array_first($query)) {
			$forums[] = self::getForum($fid);
		}
		return $forums;
	}
	public static function getForum($fid, $f = '*'){
		if ($forum = db::one('forums', $f, "id='$fid'")) {
			$forum['moderator'] = self::getModerator($forum['id']);
			$forum['url']       = common::getUrl('/bbs/'.($forum['ename']?$forum['ename'].'/':$forum['id'].'.html'));
			/*if ($forum['last_post_tid']) {
				$tid = $forum['last_post_tid'];
				$thread = db::one('threads', '*', "id='$tid'");
				$last_uid = $forum['last_post_uid'];
				$forum['last_post'] = array(
					'tid'           => $tid,
					'title'         => $thread['title'],
					'url'           => common::getUrl('/bbs/t'.$tid.'/'),
					'uid'           => $thread['uid'],
					'username'      => $thread['username'],
					'timestamp'     => $thread['timestamp'],
					'last_uid'      => $last_uid,
					'last_username' => db::one_one('members', 'username', "id='$last_uid'"),
					'last_timestamp' 
				);
			} else {
				$forum['last_post'] = array();
			}*/
			return $forum;
		}
		return false;
	}
	public static function getForumSimple($val, $key = 'id'){
		if ($forum = db::one('forums', 'id,name,ename', $key."='$val'")) {
			return $forum;
		}
		return false;
	}
	public static function forumExists($val, $id = true){
		if($val){
			$key = $id?'id':'ename';
			return db::exists('forums', array($key=>$val));
		}
		return false;
	}
	public static function getForumId($ename){
		return db::one_one('forums', 'id', "ename='$ename'");
	}
	public static function add($name, $ename, $des, $view_group_id, $view_credits, $post_group_id, $post_credits){
		global $timestamp;
		$datas = array(
			'name'          => $name,
			'ename'         => $ename,
			'des'           => $des,
			'view_group_id' => $view_group_id,
			'view_credits'  => $view_credits,
			'post_group_id' => $post_group_id,
			'post_credits'  => $post_credits,
			'timestamp'     => $timestamp
		);
		return db::insert('forums', $datas);
	}
	public static function update($name, $ename, $des, $view_group_id, $view_credits, $post_group_id, $post_credits, $id){
		global $timestamp;
		$datas = array(
			'name'          => $name,
			'ename'         => $ename,
			'des'           => $des,
			'view_group_id' => $view_group_id,
			'view_credits'  => $view_credits,
			'post_group_id' => $post_group_id,
			'post_credits'  => $post_credits,
			'timestamp'     => $timestamp
		);
		return db::update('forums', $datas, "id='$id'");
	}
	public static function updateSort($ids, $sorts){
		if($count = form::array_equal($ids, $sorts)){
			for($i=0; $i<$count; $i++){
				$id   = $ids[$i];
				$sort = $sorts[$i];
				db::update('forums', array('sort'=>$sort), "id='$id'");
			}
			return true;
		}
		return false;
	}
	public static function delete($ids){
		if(!is_array($ids))$ids = array($ids);
		foreach($ids as $id){
			//这里以后还要增加处理其它数据的代码
			db::del_id('forums', $id);
		}
		return true;
	}
	public static function addModerator($fid, $username){
		loadLib('member.base');
		if ($uid = member_base::getUid($username)) {
			if (self::forumExists($fid)) {
				if (!db::exists('moderator', array('fid' => $fid, 'uid' => $uid))) {
					$mid = db::insert('moderator', array('fid' => $fid, 'uid' => $uid), true);
					if ($mid) {
						$rs = member_base::changeGroup($uid, 'moderator');
						if ($rs === true) {
							return true;
						} else {
							db::del_id('moderator', $mid);
							return $rs;
						}
					}
					return 'insert_error';
				}
				return 'moderator_already_exists';
			}
			return 'forum_not_exists';
		}
		return 'user_not_exists';
	}
	public static function delModerator($fid, $mid){
		loadLib('member.base');
		if ($uid = self::getModeratorUid($mid)) {
			if (self::forumExists($fid)) {
				if (db::exists('moderator', array('fid' => $fid, 'uid' => $uid))) {
					$rs = member_base::changeGroup($uid, 'novice');//更改版主为普通用户组
					if ($rs === true) {
						return db::del_id('moderator', $mid)?true:'delete_error';
					}
					return $rs;
				}
				return 'moderator_not_exists';
			}
			return 'forum_not_exists';
		}
		return 'moderator_not_exists';
	}
	public static function delModerator2($fid, $uid){
		if (self::forumExists($fid)) {
			//if (db::exists('moderator', array('fid' => $fid, 'uid' => $uid))) {
			if ($mid = db::one_one('moderator', 'id', "fid='$fid' and uid='$uid'")) {
				$rs = member_base::changeGroup($uid, 'novice');//更改版主为普通用户组
				if ($rs === true) {
					return db::del_id('moderator', $mid)?true:'delete_error';
				}
				return $rs;
			}
			return 'moderator_not_exists';
		}
		return 'forum_not_exists';
	}
	public static function getModeratorUid($mid){
		return db::one_one('moderator', 'uid', "id='$mid'");
	}
	public static function getModerator($fid) {
		global $db, $pre;
		loadLib('member.base');
		loadLib('member.credit');
		$users = array();
		$query = $db->query("select uid from {$pre}moderator where fid='$fid'");
		while ($uid = $db->fetch_array_first($query)) {
			$memberInfo = member_base::getMemberAll($uid);
			$user = array(
				'uid' => $uid,
				'username' => $memberInfo['base']['username'],
				'credits'  => $memberInfo['attach']['credits'],
				'vip'      => $memberInfo['attach']['vip'],
				'vip2'     => $memberInfo['attach']['vip2'],
				'isEnsure' => $memberInfo['attach']['isEnsure'],
				'level'    => member_credit::getLevel($memberInfo['attach']['credits'])
			);
			$users[] = $user;
		}
		return $users;
	}
	public static function isModerator($fid, $uid){
		static $cacheData = array();
		$k = $fid.'_'.$uid;
		if (isset($cacheData[$k])) return $cacheData[$k];
		$cacheData[$k] = db::exists('moderator', array(
			'fid' => $fid,
			'uid' => $uid
		));
		return $cacheData[$k];
	}
	public static function updateCache(){
		global $today_start;
		$cacheName = 'bbs_cache_update_posts';
		$arr = cache::get_array($cacheName, true);
		if (!$arr || $arr['lasttime'] != $today_start) $update = true;
		else $update = false;
		if ($update) {
			$loak = new lock(1, 30);
			if (!$lock->islock) {
				db::update('forums', 'today_posts=0,today_threads=0');
				cache::write_array($cacheName, array('lasttime' => $today_start));
			}
		}
	}
	public static function showmessage($message, $gotoUrl = ''){
		extract($GLOBALS, EXTR_SKIP);
		$bbsNav || $bbsNav = array(
			array('name' => $web_name, 'url' => $weburl.'/')
		);
		common::ob_clean();
		include(template::load('showmessage'));
		exit;
	}
}
?>