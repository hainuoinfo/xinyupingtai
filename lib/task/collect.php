<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
$m || $m = 'index';
$ms = array('index', 'add', 'in', 'out', 'buyer');
($m && in_array($m, $ms)) || $m = $ms[0];
$tplName.= '_'.$m;
$pName = '收藏发布区';
$title = $pName;

$taskId = 1;

$thisUrl = $baseUrl0.'?m='.$m;
$lang = array(
	'status'     => array('暂停中', '等待接手', '进行中', '完成'),
);
$allCount = db::data_count('task_collect', "type='$taskId'");
$complateCount = db::data_count('task_collect', "type='$taskId' and status='0'");
$collectAll = (int)db::one_one('task_collect', 'sum(totalComplate)', "type='$taskId'");
if ($m == 'index') {
	$bbsNav[] = $pName;
} else {
	$bbsNav[] = array('name' => $pName, 'url' => $baseUrl0);
}
task_collect::upCache();
switch ($m) {
	case 'index':
		
	break;
	case 'add':
		checkPwd2();
		$bbsNav[] = '发布收藏任务';
		if ($rs = form::is_form_hash2()) {
			$datas = form::get2('nickname',  array('ctype', 'int'), 'shopurl', 'itemurl', array('total', 'int'));
			if ($rs === true) {
				$rs = task_collect::add($datas, $uid);
			}
			if ($rs === true) {
				common::setMsg('发布成功');
				common::goto_url($baseUrl0.'?m=out&t=ing');
			} else {
				$indexMessage = language::get($rs);
			}
		}
		$sellers = task_seller::getSellers($uid, $taskId);
	break;
	case 'in':
		checkPwd2();
		$bbsNav[] = '已接任务';
		$minChange = cfg::getInt('collect', 'cg_min');
		$noChange = db::data_count('task_collects', "type='$taskId' and uid='$uid' and status='1' and isChange='0'");
		if ($change == 'all' && $noChange > $minChange) {
			member_base::addFabudian($uid, $noChange * cfg::getMoney('collect', 'cg_one_point'), $taskId, '结算了'.$noChange.'个收藏任务');
			db::update('task_collects', "isChange='1'", "uid='$uid' and status='1' and isChange='0'", $noChange);
			common::setMsg('结算成功');
			common::goto_url($baseUrl0.'?m=in');
		}
		if ($total = db::data_count('task_collects', "type='$taskId' and uid='$uid'")) {
			$list = db::get_list2('task_collects', '*', "type='$taskId' and uid='$uid'", 'status,timestamp1 desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $thisUrl.'&page={page}', $pageStyle, 10, 'member1');
		}
	break;
	case 'out':
		$bbsNav[] = '已发任务';
		$ts = array('all', 'ing', 'pause', 'complate');
		($t && in_array($t, $ts)) || $t = $ts[0];
		if ($resume) {
			$rs = task_collect::resume($resume, $uid);
			common::setMsg('恢复成功');
			common::goto_url($referer, true);
		} elseif ($pause) {
			$rs = task_collect::pause($pause, $uid);
			common::setMsg('暂停成功');
			common::goto_url($referer, true);
		}
		$where = "type='$taskId' and uid='$uid'";
		switch ($t) {
			case 'all':
			break;
			case 'ing':
				(($where && $where .= ' and ') || !$where) && $where .= "status='1'";
			break;
			case 'pause':
				(($where && $where .= ' and ') || !$where) && $where .= "status='0'";
			break;
			case 'complate':
				(($where && $where .= ' and ') || !$where) && $where .= "status='2'";
			break;
		}
		if ($sid) {
			(($where && $where .= ' and ') || !$where) && $where .= "id='$sid'";
		}
		if ($total = db::data_count('task_collect', $where)) {
			$cList = db::get_list2('task_collect', '*', $where, 'status,timestamp desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $thisUrl.'&t='.$t.'&page={page}', $pageStyle, 10, 'member1');
		}
	break;
	case 'buyer':
		checkPwd2();
		if ($cancel) {
			task_buyer::cancelCollect($cancel, $uid);
			common::setMsg('取消成功');
			common::goto_url($thisUrl);
		} elseif ($active) {
			task_buyer::activeCollect($active, $uid);
			common::setMsg('启用成功');
			common::goto_url($thisUrl);
		} elseif ($suspend) {
			task_buyer::frostCollect($suspend, $uid);
			common::setMsg('暂停成功');
			common::goto_url($thisUrl);
		}
		if ($total = task_buyer::total($taskId, 6)) {
			$bList = task_buyer::getList(1, $uid, 6);
			$multipage = multi_page::parse($total, $pagesize, $page, $thisUrl.'&page={page}', $pageStyle, 10, 'member1');
		}
	break;
}
?>