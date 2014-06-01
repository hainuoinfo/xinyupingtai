<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
header("Content-Type:text/html;charset=utf-8");
loadLib('bbs.forums');
loadLib('bbs.thread');
bbs_forums::updateCache();//更新缓存，如每天发帖数等
template::initialize('./templates/default/'.$action.'/', './cache/default/'.$action.'/');//设置BBS模板缓存目录
$ops = array('index', 'threadlist', 'post', 'reply', 'thread', 'edit', 'del', 'moderate', 'search', 'list', 'collection');
($operation && in_array($operation, $ops)) || $operation = $ops[0];
switch($operation){
	case 'index':
		$forums = bbs_forums::getForums();
		$bbsNav = array(
			array('name' => $web_name, 'url' => $weburl.'/'),
			array('name' => '论坛')
		);
	break;
	case 'threadlist':
		$type || $type = 'all';
		$oModerator = false;
		if(bbs_forums::forumExists($fid) || ($fid = bbs_forums::getForumId($ename))){
			$forum = bbs_forums::getForum($fid);
			$isModerator = bbs_thread::isModerator($fid, $uid);
			if ($forum['view_group_id'] > 0) {//如果发帖需要显示用户组
				$forumGroup  = $userGroups2[$forum['view_group_id']];
				$memberGroup = $userGroups2[$member['groupid']];
				if ($memberGroup['sort'] > $forumGroup['sort']) {
					error::bbsMsg('对不起，'.$forum['name'].'只有'.$forumGroup['name'].'及以上权限的用户组才可以浏览');
				}
			}
			if ($forum['view_credits'] > 0) {//如果限制了积分
				if ($memberFields['credits'] < $forum['view_credits']) {
					error::bbsMsg('对不起，'.$forum['name'].'只有积分达到了'.$forum['view_credits'].'才可以浏览');
				}
			}
			$title       = $forum['name']. ' - {webName}';
			$keywords    = '刷信誉,刷信用,互刷信誉平台,刷收藏,刷流量,{webName2}';
			$description = $forum['des'];
			$title       = common::replaceVars($title);
			$keywords    = common::replaceVars($keywords);
			$description = common::replaceVars($description);
			$bbsNav = array(
				array('name' => $web_name, 'url' => $weburl.'/'),
				array('name' => '论坛', 'url' => common::getUrl('/bbs/')),
				array('name' => $forum['name'])
			);
			$threadListTop = bbs_thread::getTops($fid);
			$threadList = bbs_thread::getThreadList($fid, $type);
			$total = bbs_thread::getTotal($fid, $type);
			if ($total > 0) {
				$multipage = multi_page::parse($total, $pagesize, $page, common::getUrl($type == 'all' ? '/bbs/'.$forum['ename'].'/{page}/' : '/bbs/threadlist.php?fid='.$forum['id'].'&type='.$type.'&page={page}'), $pageStyle, 10, 'bbs_threadlist');
			}
		} else {
			error::forumNotFound();
		}
	break;
	case 'post':
		if (!bbs_forums::forumExists($fid)) error::forumNotFound();//版块不存在
		if (!$memberLogined) common::goto_url('/member/login/?referer='.urlencode($nowurl));
		$forum = bbs_forums::getForum($fid);
		if ($forum['post_group_id'] > 0) {//如果发帖需要显示用户组
			$forumGroup  = $userGroups2[$forum['post_group_id']];
			$memberGroup = $userGroups2[$member['groupid']];
			if ($memberGroup['sort'] > $forumGroup['sort'] || ($memberGroup['key'] == 'moderator' && !bbs_thread::isModerator($fid, $uid))) {
				error::bbsMsg('对不起，'.$forum['name'].'只有'.$forumGroup['name'].'及以上权限的用户组才可以发新主题');
			}
		}
		if ($forum['post_credits'] > 0) {//如果限制了积分
			if ($memberFields['credits'] < $forum['post_credits']) {
				error::bbsMsg('对不起，'.$forum['name'].'只有积分达到了'.$forum['post_credits'].'才可以发新主题');
			}
		}
		$complate = false;
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				$datas = form::get(array('iconid', 'int'), 'f_title', 'message');
				$datas = common::filterHtml($datas);
				$datas && extract($datas);
				$rs = bbs_thread::addThread($fid, $iconid, $f_title, $message);
			}
			if ($rs > 0) {
				$complate = true;
				$tid = $rs;
				$threadUrl = common::getUrl('/bbs/t'.$tid.'/');
			} else {
				$indexMessage = language::get($rs);
			}
		}
		$title       = $forum['name']. ' - {webName}';
		$keywords    = '';
		$description = '';
		$title       = common::replaceVars($title);
		$keywords    = common::replaceVars($keywords);
		$description = common::replaceVars($description);
		$bbsNav = array(
			array('name' => $web_name, 'url' => $weburl.'/'),
			array('name' => '论坛', 'url' => common::getUrl('/bbs/')),
			array('name' => $forum['name'], 'url' => common::getUrl('/bbs/'.($forum['ename']?$forum['ename'].'/':$forum['id'].'.html'))),
			array('name' => '发帖')
		);
	break;
	case 'reply':
		if (!$memberLogined) common::goto_url('/member/login/?referer='.urlencode($nowurl));
		if (!bbs_thread::threadExists($tid)) error::bbsMsg('不存在该主题');
		$thread = bbs_thread::getThread($tid);
		$forum = bbs_forums::getForum($thread['fid']);
		$bbsNav = array(
			array('name' => $web_name, 'url' => $weburl.'/'),
			array('name' => '论坛', 'url' => common::getUrl('/bbs/')),
			array('name' => $forum['name'], 'url' => common::getUrl('/bbs/'.($forum['ename']?$forum['ename'].'/':$forum['id'].'.html'))),
			array('name' => $thread['title'], 'url' => common::getUrl('/bbs/t'.$thread['tid'].'/')),
			array('name' => '回复主题')
		);
		if ($rs = form::is_form_hash2()) {
				$datas = form::get('f_title', 'message');
				$datas = common::filterHtml($datas);
				$datas && extract($datas);
			if ($rs === true) {
				$rs = bbs_thread::addPost($tid, $f_title, $message);
			}
			if ($rs > 0) {
				$complate = true;
				$pid = $rs;
				$threadUrl = common::getUrl('/bbs/t'.$tid.'/'.bbs_thread::postAtPage($pid).'/#t'.$pid);
			} else {
				$indexMessage = language::get($rs);
			}
		} else {
			if ($pid) $f_title = 'RE:'.$thread['title'];
			if ($quote = (int)$quote) {
				if (db::exists('posts', array('tid' => $thread['id'], 'id' => $quote))) {
					$message = '[quote1]'.$quote.'[/quote1]';
				}
			}
		}
	break;
	case 'thread':
		if (!bbs_thread::threadExists($tid)) {
			error::bbsMsg('该主题不存在');
		}
		$thread = bbs_thread::getThread($tid);
		$fid = $thread['fid'];
		/*if (in_array($memberGroup['key'], array('moderator', 'admin')) || $uid == $thread['uid']) {
			if ($memberGroup['key'] == 'moderator') {
				if (db::exists('moderator', array(
					'fid' => $fid,
					'uid' => $uid
				))) {
					$isThreadAuthor = true;
				} else {
					$isThreadAuthor = false;
				}
			} else {
				$isThreadAuthor = true;
			}
		} else {
			$isThreadAuthor = false;
		}*/
		$isModerator = bbs_thread::isModerator($fid, $uid);
		$forum = bbs_forums::getForum($fid);
		$bbsNav = array(
			array('name' => $web_name, 'url' => $weburl.'/'),
			array('name' => '论坛', 'url' => common::getUrl('/bbs/')),
			array('name' => $forum['name'], 'url' => common::getUrl('/bbs/'.($forum['ename']?$forum['ename'].'/':$forum['id'].'.html'))),
			array('name' => $thread['title'])
		);
		if ($go == 'last') {
			$total = $thread['posts'];
			$total--;
			$total < 0 && $total = 0;
			$page = floor($total / $pagesize) + 1;
		}
		$postList = bbs_thread::getPosts($tid, $page, $pagesize, $ignore);
		$title    = $thread['title'].' - '.$forum['name'].' - '.$web_name;
		$keywords = '刷信誉,刷信用,互刷信誉平台,刷收藏,刷流量,'.$web_name2;
		$message  = preg_replace('/<.*?>/', '', $postList[0]['message']);
		$message  = str_replace('&nbsp;', '', $message);
		$message  = preg_replace('/\s+/', ' ', $message);
		$description = common::cutstr($message, 30);
		if ($ignore = (int)$ignore) {
			$multipage = multi_page::parse(bbs_thread::getPostTotal($tid, $ignore), $pagesize, $page, common::getUrl('/bbs/t'.$tid.'/?ignore='.$ignore.'&page={page}'), $pageStyle);
		} else {
			$multipage = multi_page::parse($thread['posts'], $pagesize, $page, common::getUrl('/bbs/t'.$tid.'/{page}/'), $pageStyle);
		}
		//设置是否可以回复
		$autoPost = false;
		if ($memberLogined) {
			$autoPost = true;
			/*if ($forum['post_group_id'] > 0) {//如果发帖需要显示用户组
				$forumGroup  = $userGroups2[$forum['post_group_id']];
				if ($memberGroup['sort'] > $forumGroup['sort']) {
					$autoPost = false;
				}
			}
			if ($forum['post_credits'] > 0) {//如果限制了积分
				if ($memberFields['credits'] < $forum['post_credits']) {
					$autoPost = false;
				}
			}*/
		}
	break;
	case 'edit':
		if (!$memberLogined) common::goto_url('/member/login/?referer='.urlencode($nowurl));
		if ($post = bbs_thread::getPost($pid, false)) {
			if ($post['first']) {
				//主题
				$thread = bbs_thread::getThread($post['tid']);
				if (!bbs_thread::isThreadAuthor($thread['id'], $uid)) error::bbsMsg('很抱歉，您没有权限编辑该帖');
				$editType = 'thread';
				$iconid = $thread['iconid'];
			} else {
				//帖子
				if (!bbs_thread::isPostAuthor($thread['id'], $uid)) error::bbsMsg('很抱歉，您没有权限编辑该帖');
				$editType = 'post';
			}
			$attachs = array();
			if ($list = bbs_thread::getAttachs($post['id'])) {
				foreach ($list as $v) {
					$attachs[$v['id']] = array('type' => $v['filetype'], 'src' => $weburl2.'img/attach/'.$v['src'], 'thumb' => $weburl2.'img/attach/'.$v['thumb']);
				}
			}
			if ($attachs) $attachs = string::json_encode($attachs);
			if ($rs = form::is_form_hash2()) {
				if ($rs === true) {
					if ($editType == 'thread') {
						$datas = form::get(array('iconid', 'int'), 'f_title', 'message');
						$datas = common::filterHtml($datas);
						$datas && extract($datas);
						$rs = bbs_thread::editThread($post['tid'], $iconid, $f_title, $message);
					} elseif ($editType == 'post') {
						$datas = form::get('f_title', 'message');
						$datas = common::filterHtml($datas);
						$datas && extract($datas);
						$rs = bbs_thread::editPost($pid, $f_title, $message);
					}
				}
				if ($rs > 0) {
					$complate = true;
					$tid = $post['tid'];
					if ($editType =='thread') {
						$threadUrl = common::getUrl('/bbs/t'.$tid.'/');
					} else {
						$threadUrl = common::getUrl('/bbs/t'.$tid.'/'.bbs_thread::postAtPage($pid).'/#t'.$pid);
					}
				} else {
					$indexMessage = language::get($rs);
				}
			}
			$f_title = $post['title'];
			$message = $post['message'];
		} else {
			error::bbsMsg('不存在该帖子');
		}
	break;
	case 'del':
		if (!$memberLogined) common::goto_url('/member/login/?referer='.urlencode($nowurl));
		$rs = bbs_thread::delPost($pid, $uid);
		if ($rs > 0) {
			bbs_thread::showmessage('帖子删除成功，返回主题<br /><br /><br />', common::getUrl('/bbs/t'.$rs.'/'));
		} else {
			error::bbsMsg(language::get($rs));
		}
	break;
	case 'moderate':
		if (!$memberLogined) common::goto_url('/member/login/?referer='.urlencode($referer));
		$_POST && extract($_POST);
		if (!is_array($moderate)) $moderate = explode(',', $moderate);
		$moderate = common::getInt($moderate);
		if (!$moderate) error::bbsMsg('参数错误');
		$threads = count($moderate);
		if (!$isAdmin) {
			//如果不是管理员 检查权限
			if ($mFids = db::get_keys('moderator', 'fid', "uid='$uid'")) {
				$mIds = '\''.implode('\',\'', $moderate).'\'';
				$query = $db->query("select fid,uid from {$pre}threads where id in($mIds)");
				while ($line = $db->fetch_array($query)) {
					if (!in_array($line['fid'], $mFids)) {
						error::bbsMsg('没有权限');
					}
				}
			} else {
				error::bbsMsg('没有权限');
			}
		}
		if ($op == 'delete') {
			$c = 0;
			foreach ($moderate as $tid) {
				if (bbs_thread::delThread($tid)) $c++;
			}
			bbs_thread::showmessage('成功删了了'.$c.'个主题', $referer);
		}
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				$datas = array();
				if ($op_top) {
					$datas['top'] = (int)$top;
				}
				if ($op_digest) {
					$datas['digest'] = (int)$digest;
				}
				if ($op_highlight) {
					//高亮
					$title_flag = 0;
					$title_b && $title_flag |= 1;
					$title_i && $title_flag |= 1 << 1;
					$title_u && $title_flag |= 1 << 2;
					if (preg_match('/rgb\((.+?)\)/i', $title_color, $matches)) {
						$sp = explode(',', $matches[1]);
						$title_color = '#'.sprintf('%02X', trim($sp[0])).sprintf('%02X', trim($sp[1])).sprintf('%02X', trim($sp[2]));
					}
					$datas['title_color'] = $title_color;
					$datas['title_flag'] = $title_flag;
				}
				if (!$datas) {
					error::bbsMsg('没有操作');
				}
				$fid = 0;
				foreach ($moderate as $tid) {
					$fid || $fid = db::one_one('threads', 'fid', "id='$tid'");
					if ($datas) {
						db::update('threads', $datas, "id='$tid'");
					}
				}
				$forum = bbs_forums::getForum($fid);
				bbs_thread::showmessage('操作成功', $forum['url']);
			} else {
				$showMessage = language::get($rs);
			}
		}
		$bbsNav = array(
			array('name' => $web_name, 'url' => $weburl.'/'),
			array('name' => '帖子操作')
		);
	break;
	case 'search':
		if ($keyword) {
			if ($fid > 0 && !bbs_forums::forumExists($fid)) error::bbsMsg('不存在该版块');
			$fid < 0 && $fid = 0;
			$keyword = urldecode($keyword);
			$keys = preg_split('/\s+/', $keyword);
			$keys = array_unique($keys);
			$keyInfo = db::one('bbs_keys', 'id,threads,timestamp', "fid='$fid' and `key`='$keyword'");
			$lastTimestamp = $keyInfo['timestamp'];
			$kid           = $keyInfo['id'];
			$threads       = $keyInfo['threads'];
			$update = false;
			if (!$lastTimestamp || $timestamp - $lastTimestamp > 86400) $update = true;
			if ($update) {
				
				$sKey = 'title like \'%'.implode('%\' or title like \'%', $keys).'%\'';
				if ($kid) db::del_keys('bbs_key_threads', 'kid', $kid);
				else $kid = db::insert('bbs_keys', array(
					'fid'       => $fid,
					'key'       => $keyword,
					'threads'   => 0,
					'searchs'   => 0,
					'timestamp' => $timestamp
				), true);
				if ($kid) {
					if ($fid > 0) $where = "fid='$fid'";
					else $where = '';
					$where && $where .= ' and ';
					$where .= '('.$sKey.')';
					$db->query("insert into {$pre}bbs_key_threads select '$kid' kid,id tid from {$pre}threads where $where");
					$threads = $db->affected_rows();
					$db->query("update {$pre}bbs_keys set threads='$threads',searchs=searchs+1 where id='$kid'");
				} else {
					error::bbsMsg('关键词太长');
				}
			} else {
				$db->query("update {$pre}bbs_keys set searchs=searchs+1 where id='$kid'");
			}
			$bbsNav = array(
				array('name' => $web_name, 'url' => $weburl.'/'),
				array('name' => '论坛', 'url' => common::getUrl('/bbs/')),
				array('name' => '论坛搜索')
			);
			$threadList = array();
			$query = $db->query("select t2.* from {$pre}bbs_key_threads t1,{$pre}threads t2 where t1.kid='$kid' and t1.tid=t2.id order by t2.timestamp limit ".($page - 1) * $pagesize.','.$pagesize);
			while ($thread = $db->fetch_array($query)) {
				$thread['title'] = string::setColors($thread['title'], $keys, '#FF0000');
				$threadList[] = $thread;
			}
			$multipage = multi_page::parse($threads, $pagesize, $page, common::getUrl('/bbs/?operation='.$operation.'&fid='.$fid.'&keyword='.urlencode($keyword).'&page={page}'), $pageStyle, 10 ,'bbs_threadlist');
			//if ($tids = db::get_keys('bbs_key_threads', 'tid', "kid='$kid'", $page, $pagesize)) {
			//	
			//}
			
		} else {
			error::bbsMsg('参数错误');
		}
	break;
	case 'list':
		if ($type == 'new') {
			$threads = db::data_count('threads');
			$threadList = bbs_thread::getThreadList2('','timestamp desc', $page, $pagesize);
		} elseif ($type == 'digest') {
			$threads = db::data_count('threads', 'digest<>0');
			$threadList = bbs_thread::getThreadList2('digest<>0','timestamp desc', $page, $pagesize);
		}
		$multipage = multi_page::parse($threads, $pagesize, $page, common::getUrl('/bbs/?operation='.$operation.'&type='.$type.'&page={page}'), $pageStyle, 10 ,'bbs_threadlist');
	break;
	case 'collection':
		if (!$memberLogined) common::goto_url('/member/login/?referer='.urlencode($nowurl));
		if ($thread = bbs_thread::getThread($tid)) {
			$url = '/bbs/t'.$tid.'/';
			if (!($cid = db::one_one('collection', 'id', "uid='$uid' and url='$url'"))) {
				db::insert('collection', array(
					'uid'       => $uid,
					'title'     => $thread['title'],
					'url'       => $url,
					'timestamp' => $timestamp
				));
			} else {
				db::update('collection', array('timestamp' => $timestamp), "id='$cid'");
			}
			common::goto_url($referer, true);
		} else {
			error::bbsMsg('很抱歉，不存在该帖子，不能收藏');
		}
	break;
}
include(template::load($operation, true));
?>