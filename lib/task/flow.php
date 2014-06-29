<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
$m || $m = 'index';
$ms = array('index', 'add', 'out');
($m && in_array($m, $ms)) || $m = $ms[0];
$tplName.= '_'.$m;
$pName = '流量发布区';
$title = $pName;


$taskId = 1;

$thisUrl = $baseUrl0.'?m='.$m;
$lang = array(
	'status'     => array('暂停中', '等待接手', '进行中', '完成'),
);
$allCount = db::data_count('task_flow', "type='$taskId'");
$complateCount = db::data_count('task_flow', "type='$taskId' and status='2'");
$flowAll = (int)db::one_one('task_flow', 'sum(flowComplate)', "type='$taskId'");
if ($m == 'index') {
	$bbsNav[] = $pName;
} else {
	$bbsNav[] = array('name' => $pName, 'url' => $baseUrl0);
}
task_flow::upCache();
switch ($m) {
	case 'index':
		$where = "type='$taskId' and status in ('1','2')";
		$list = array();
		if ($total = db::data_count('task_flow', $where)) {
			$limit = ($page - 1) * $pagesize.','.$pagesize;
			$limit = ' limit '. $limit;
			$query = $db->query("select t1.*,t2.username,t3.vip,t3.vip2,t3.credits,t3.isEnsure from (select * from {$pre}task_flow where $where order by status,timestamp desc$limit) t1 left join {$pre}members t2 on t2.id=t1.uid left join {$pre}memberfields t3 on t3.uid=t2.id");
			while ($line = $db->fetch_array($query)) {
				$line['level'] = member_credit::getLevel($line['credits']);
				$list[] = $line;
			}
			$multipage = multi_page::parse($total, $pagesize, $page, $baseUrl.'?page={page}', $pageStyle, 10, 'member1');
		}
	break;
	case 'add':
		checkPwd2();
		$bbsNav[] = '发布流量任务';
		if ($isVip) $maxCount = 20;
		elseif ($isVip2) $maxCount = 10;
		else $maxCount = 5;
		$count1 = 5;
		$count2 = $maxCount - $count1;
		if ($rs = form::is_form_hash2()) {
			$datas = form::get2('itemurl', 'flow',array('isIp', 'int'), array('times', 'int'), array('isPlan', 'int'), 'planDate', array('minute', 'int'));
			if ($rs === true) {
				$rs = task_flow::add($datas, $uid);
			}
			if ($rs === true) {
				common::setMsg('发布成功');
				common::goto_url($baseUrl0.'?m=out');
			} else {
				$indexMessage = language::get($rs);
			}
		}
	break;
	case 'out':
		$bbsNav[] = '已发任务';
		$ts = array('all', 'ing', 'pause', 'complate');
		($t && in_array($t, $ts)) || $t = $ts[0];
		if ($resume) {
			$rs = task_flow::resume($resume, $uid);
			common::setMsg('恢复成功');
			common::goto_url($referer, true);
		} elseif ($pause) {
			$rs = task_flow::pause($pause, $uid);
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
		if ($d1 && $d2) {
			$dt1 = time::get_general_timestamp($d1);
			$dt2 = time::get_general_timestamp($d2) + 86400 - 1;
			(($where && $where .= ' and ') || !$where) && $where .= "timestamp>=$dt1 and timestamp<=$dt2";
		}
		if ($sid) {
			(($where && $where .= ' and ') || !$where) && $where .= "id='$sid'";
		}
		if ($total = db::data_count('task_flow', $where)) {
			$fList = db::get_list2('task_flow', '*', $where, 'status,timestamp desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $thisUrl.'&t='.$t.'&page={page}', $pageStyle, 10, 'member1');
		}
	break;
}
?>