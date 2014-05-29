<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
$m || $m = 'index';
$ms = array('index', 'add', 'in', 'out', 'tpl');
($m && in_array($m, $ms)) || $m = $ms[0];
$tplName.= '_'.$m;
$pName = '来路流量发布区';
$title = $pName;

$taskId = 1;

$thisUrl = $baseUrl0.'?m='.$m;
$lang = array(
	'status'     => array('暂停中', '等待接手', '进行中', '完成'),
);
$allCount = db::data_count('task_reflow', "type='$taskId'");
$complateCount = db::data_count('task_reflow', "type='$taskId' and status='2'");
$flowAll = (int)db::one_one('task_reflow', 'sum(flowComplate)', "type='$taskId'");
if ($m == 'index') {
	$bbsNav[] = $pName;
} else {
	$bbsNav[] = array('name' => $pName, 'url' => $baseUrl0);
}
task_reflow::upCache();
function __parseLimitCount($str){
	$rs = array();
	foreach (explode(';', $str) as $v) {
		list($count, $point, $check) = explode(',', $v);
		$count = intval($count);
		$point = common::formatMoney($point);
		$check = isset($check) ? ($check == '1' ? true : false) : false;
		$rs[] = array(
			'count' => $count,
			'point' => $point,
			'check' => $check
		);
	}
	return $rs;
}
switch ($m) {
	case 'index':
		
	break;
	case 'add':
		checkPwd2();
		$bbsNav[] = '发布来路流量任务';
		if ($isVip) $maxCount = 20;
		elseif ($isVip2) $maxCount = 10;
		else $maxCount = 5;
		$count1 = 5;
		$count2 = $maxCount - $count1;
		if ($rs = form::is_form_hash2()) {
			$datas = form::get3(
				'nickname',
				'itemurl',
				array('wayId', 'int'),
				'visitKey_0', 'visitKey_1',
				'visitTip_0', 'visitTip_1', 'visitTip_2',
				array('checkType_0', 'int'), array('checkType_1', 'int'), array('checkType_2', 'int'),
				
				'checkValue1_0', 'checkValue2_0',
				'checkValue1_1', 'checkValue2_1',
				'checkValue1_2', 'checkValue2_2',
				
				array('total', 'int'),
				array('isIP', 'int'),
				array('numIP', 'int'),
				array('isLimit', 'int'),
				array('numUser', 'int'),
				array('isPlan', 'int'),
				'planDate',
				
				array('isRate', 'int'), 'minute',
				array('bidUp', 'float'), '__bidUp', array('bidUpCus', 'float'));
			//$indexMessage = task_reflow::add($datas, $uid);
			if ($rs === true) {
				$rs = task_reflow::add($datas, $uid);
			}
			if ($rs === true) {
				//保存模板
				$datas2 = form::get(array('isTpl', 'int'), 'tplTo');
				$datas2 && extract($datas2);
				if ($isTpl && $tplTo) {
					$tplTo = common::cutstr($tplTo, 64);
					$maxTplCount = cfg::getInt('reflow', 'tplSaveCount');
					if (db::data_count('task_reflow_tpl', "uid='$uid'") < $maxTplCount) {
						db::insert('task_reflow_tpl', array(
							'type'      => $taskId,
							'uid'       => $uid,
							'name'      => $tplTo,
							'datas'     => addslashes(serialize($datas)),
							'timestamp' => $timestamp
						));
					}
				}
				// THE END
				common::setMsg('发布成功');
				common::goto_url($baseUrl0.'?m=out');
			} else {
				$indexMessage = language::get($rs);
			}
		}
		$tplList = db::select('task_reflow_tpl', 'id,name', "type='$taskId' and uid='$uid'", 'timestamp desc');
		if (($tplId = intval($tplId)) && !$datas) {
			$datas = db::one_one('task_reflow_tpl', 'datas', "type='$taskId' and uid='$uid' and id='$tplId'");
			$datas && $datas = unserialize($datas);
		}
		$sellers = task_seller::getSellers($uid, 1);
	break;
	case 'in':
		checkPwd2();
		if ($new) {
			$rs = task_reflow::in($new, $uid);
			if ($rs === true) {
				common::setMsg('任务接手成功，请尽快完成任务。');
				common::goto_url($thisUrl.'&t=ing');
			} else {
				common::goto_url($referer, true, $rs);
			}
		} elseif ($quit) {
			$rs = task_reflow::quit($quit, $uid);
			if ($rs === true) {
				common::setMsg('退出成功！');
				common::goto_url($thisUrl);
			} else {
				common::goto_url($referer, true, $rs);
			}
		} elseif (isset($t)) {
			if ($t == 'pay') {
				$rs = task_reflow::pay($uid);
				if (is_numeric($rs)) {
					common::setMsg('结算了'.$rs.'个来路任务！');
				} else common::setMsg(language::get($rs), 'indexMessage');
				common::goto_url($thisUrl);
			}
		}
		$complateCount = task_reflow::complateCount($uid);
		$payfor_count  = cfg::getInt('reflow', 'payfor_count');
		$where = "type='$taskId' and uid='$uid'";
		$list = array();
		if ($total = db::data_count('task_reflow_log', $where)) {
			/*$limit = ($page - 1) * $pagesize.','.$pagesize;
			$limit = ' limit '. $limit;
			$query = $db->query("select t1.*,t2.username,t3.vip,t3.vip2,t3.credits,t3.isEnsure from (select * from {$pre}task_reflow where $where order by status,time desc$limit) t1 left join {$pre}members t2 on t2.id=t1.suid left join {$pre}memberfields t3 on t3.uid=t2.id");
			while ($line = $db->fetch_array($query)) {
				$line['level'] = member_credit::getLevel($line['credits']);
				$list[] = $line;
			}*/
			$list = db::select('task_reflow_log', '*', $where, '`time` DESC', $pagesize, $page);
			$multipage = multi_page::parse($total, $pagesize, $page, $baseUrl.'?page={page}', $pageStyle, 10, 'member1');
		}
	break;
	case 'out':
		$bbsNav[] = '已发任务';
		$t || $t = 'all';
		switch ($t) {
			case 'all':
				$ts = array('all', 'ing', 'pause', 'complate');
				($t && in_array($t, $ts)) || $t = $ts[0];
				if ($resume) {
					$rs = task_reflow::resume($resume, $uid);
					common::setMsg('恢复成功');
					common::goto_url($referer, true);
				} elseif ($pause) {
					$rs = task_reflow::pause($pause, $uid);
					common::setMsg('暂停成功');
					common::goto_url($referer, true);
				}
				$where = "type='$taskId' and suid='$uid'";
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
					(($where && $where .= ' and ') || !$where) && $where .= "time>=$dt1 and time<=$dt2";
				}
				if ($sid) {
					(($where && $where .= ' and ') || !$where) && $where .= "id='$sid'";
				}
				if ($total = db::data_count('task_reflow', $where)) {
					$fList = db::get_list2('task_reflow', '*', $where, 'status,time desc', $page, $pagesize);
					$multipage = multi_page::parse($total, $pagesize, $page, $thisUrl.'&t='.$t.'&page={page}', $pageStyle, 10, 'member1');
				}
			break;
			case 'inList':
				if ($sid) {
					if ($total = db::data_count('task_reflow_log', "tid='$sid'")) {
						$list = db::select('task_reflow_log', '*', "tid='$sid'", "time DESC", $pagesize, $page);
					}
				}
			break;
		}
	break;
	case 'tpl':
		$bbsNav[] = '任务模板';
		if ($del = (int)$del) {
			db::delete('task_reflow_tpl', "id='$del' and uid='$uid'");
			common::setMsg('删除成功');
			common::goto_url($thisUrl);
		}
		if ($tplList = db::get_list2('task_reflow_tpl', '*', "type='1' and uid='$uid'", 'timestamp desc')) {
			foreach ($tplList as $k => $v) {
				$v['datas'] = unserialize($v['datas']);
				$tplList[$k] = $v;
			}
		}
	break;
}
?>