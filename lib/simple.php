<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
bbs_forums::updateCache();//更新缓存，如每天发帖数等
template::initialize('./templates/default/'.$action.'/', './cache/default/'.$action.'/');//设置BBS模板缓存目录
$ops = array('index', 'threadlist', 'post', 'reply', 'thread', 'edit', 'del', 'moderate', 'search', 'list', 'collection');
($operation && in_array($operation, $ops)) || $operation = $ops[0];
$pageStyle = '{pages}{select}<strong>[{page}]</strong>{else}<a href="{url}">{page}</a>{/select}&nbsp;{/pages}';
switch($operation){
	case 'index':
		$forums = bbs_forums::getForums();
		$bbsNav = array(
			array('name' => $web_name, 'url' => $weburl.'/'),
			array('name' => '论坛')
		);
	break;
	case 'threadlist':
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
			$pagesize = 80;
			$threadList = bbs_thread::getSimpleThreadList($fid);
			$total = bbs_thread::getSimpleTotal($fid);
			if ($total > 0) {
				$multipage = multi_page::parse($total, $pagesize, $page, common::getUrl('/simple/'.$forum['ename'].'/{page}/'), $pageStyle, 10, 'bbs_SimpleThreadlist');
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
	case 'thread':
		if (!bbs_thread::threadExists($tid)) {
			error::bbsMsg('该主题不存在');
		}
		$thread = bbs_thread::getThread($tid);
		$fid = $thread['fid'];
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
		$postList = bbs_thread::getSimplePosts($tid, $page, $pagesize, $ignore);
		$title    = $thread['title'].' - '.$forum['name'].' - '.$web_name;
		$keywords = '刷信誉,刷信用,互刷信誉平台,刷收藏,刷流量,'.$web_name2;
		$message  = preg_replace('/<.*?>/', '', $postList[0]['message']);
		$message  = str_replace('&nbsp;', '', $message);
		$message  = preg_replace('/\s+/', ' ', $message);
		$description = common::cutstr($message, 30);
		if ($ignore = (int)$ignore) {
			$multipage = multi_page::parse(bbs_thread::getPostTotal($tid, $ignore), $pagesize, $page, common::getUrl('/bbs/t'.$tid.'/?ignore='.$ignore.'&page={page}'), $pageStyle);
		} else {
			$multipage = multi_page::parse($thread['posts'], $pagesize, $page, common::getUrl('/simple/t'.$tid.'/{page}/'), $pageStyle);
		}
		//设置是否可以回复
		$autoPost = false;
		if ($memberLogined) {
			$autoPost = true;
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