<?php
$top_menu=array(
	'tao' => '淘宝区维权处理',
	'pai' => '拍拍区维权处理',
	'you' => '有啊区维权处理',
	'new' => '新手区维权处理',
	'view' => array('name' => '申述详情', 'isHide' => true)
);
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$cStatus = array('等待被维权方解决问题或辩解', '维权成功', '维权失败', '撤销维权', '等待维权人撤诉', '维权人坚持维权');
switch($method){
	case 'tao':
		if (form::is_form_hash()) {
			if (($del = $_POST['del']) && ($ids = '\''.implode('\',\'', $del).'\'')) {
				if ($tids = db::get_keys('ensure', 'tid', "id in($ids) and status='0'")) {
					$tids = '\''.implode('\',\'', $tids).'\'';
					db::update('task', "ensure='0'", "id in($tids)");
				}
				db::del_ids('ensure', $del);
				db::del_keys('ensure', 'cid', $del);
				
			}
			admin::show_message('删除成功', $base_url);
		}
		$where = "type='1'";
		if ($total = db::data_count('ensure', $where)) {
			$list = db::get_list2('ensure', 'id,fusername,tusername,tid,title,timestamp1,timestamp2,status', $where, 'status,timestamp1 desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&method2='.$method2.'&page={page}', $pagestyle, 10);
		}
	break;
	case 'pai':
		if (form::is_form_hash()) {
			if (($del = $_POST['del']) && ($ids = '\''.implode('\',\'', $del).'\'')) {
				if ($tids = db::get_keys('ensure', 'tid', "id in($ids) and status='0'")) {
					$tids = '\''.implode('\',\'', $tids).'\'';
					db::update('task', "ensure='0'", "id in($tids)");
				}
				db::del_ids('ensure', $del);
				db::del_keys('ensure', 'cid', $del);
				
			}
			admin::show_message('删除成功', $base_url);
		}
		$where = "type='2'";
		if ($total = db::data_count('ensure', $where)) {
			$list = db::get_list2('ensure', 'id,fusername,tusername,tid,title,timestamp1,timestamp2,status', $where, 'status,timestamp1 desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&method2='.$method2.'&page={page}', $pagestyle, 10);
		}
	break;
	case 'you':
		if (form::is_form_hash()) {
			if (($del = $_POST['del']) && ($ids = '\''.implode('\',\'', $del).'\'')) {
				if ($tids = db::get_keys('ensure', 'tid', "id in($ids) and status='0'")) {
					$tids = '\''.implode('\',\'', $tids).'\'';
					db::update('task', "ensure='0'", "id in($tids)");
				}
				db::del_ids('ensure', $del);
				db::del_keys('ensure', 'cid', $del);
				
			}
			admin::show_message('删除成功', $base_url);
		}
		$where = "type='3'";
		if ($total = db::data_count('ensure', $where)) {
			$list = db::get_list2('ensure', 'id,fusername,tusername,tid,title,timestamp1,timestamp2,status', $where, 'status,timestamp1 desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&method2='.$method2.'&page={page}', $pagestyle, 10);
		}
	break;
	case 'new':
		if (form::is_form_hash()) {
			if (($del = $_POST['del']) && ($ids = '\''.implode('\',\'', $del).'\'')) {
				if ($tids = db::get_keys('ensure', 'tid', "id in($ids) and status='0'")) {
					$tids = '\''.implode('\',\'', $tids).'\'';
					db::update('task', "ensure='0'", "id in($tids)");
				}
				db::del_ids('ensure', $del);
				db::del_keys('ensure', 'cid', $del);
				
			}
			admin::show_message('删除成功', $base_url);
		}
		$where = "type='4'";
		if ($total = db::data_count('ensure', $where)) {
			$list = db::get_list2('ensure', 'id,fusername,tusername,tid,title,timestamp1,timestamp2,status', $where, 'status,timestamp1 desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&method2='.$method2.'&page={page}', $pagestyle, 10);
		}
	break;
	case 'view':
		if ($id) {
			if ($ensure = db::one('ensure', '*', "id='$id'")) {
				$task = task_base::_get($ensure['tid']);//获取任务
				if ($task['buid'] == $ensure['fuid']) $isBuyer = true;//是买家
				else $isBuyer = false;//是卖家
				if ($isBuyer) admin::show_message('很抱歉，暂时不支持买家维权的投诉');
				$buyerInfo = member_base::getMemberAll($task['buid']);
				$ensureMessage = array();
				$query = $db->query("select * from {$pre}ensure_message where cid='$ensure[id]' order by timestamp");
				while ($line = $db->fetch_array($query)) {
					$line['message'] = string::ubbDecode($line['message']);
					$ensureMessage[$line['type']][] = $line;
				}
				if (form::is_form_hash()) {
					if (!in_array($ensure['status'], array(1, 2, 3))) {
						//$task = task_base::_get($ensure['tid']);
						if ($task['status'] >= 5) {//最少要支付了才有维权权
							//if ($task['buid'] == $ensure['fuid']) $isBuyer = true;
							//else $isBuyer = false;
							$status = (int)$_POST['status'];
							$backPrice = common::formatMoney($_POST['backPrice']);
							$backPoint = common::formatMoney($_POST['point']);
							$sprice = common::formatMoney($_POST['sprice']);
							$spoint = common::formatMoney($_POST['spoint']);
							$bprice = common::formatMoney($_POST['bprice']);
							$bpoint = common::formatMoney($_POST['bpoint']);
							if ($status==1) {
								//成功
								if ($isBuyer) {
									member_base::addMoney($task['buid'], $backPrice, '任务'.$task['id'].'接手方维权成功，返还担保金');
									//member_base::addFabudian($task['money'], $task['money'], '任务'.$task['id'].'维权成功，返还担保金');
									member_base::addPoint($task['id'], $backPoint);
									member_base::addCredit($task['buid'], member_base::isVip($task['buid'])?6:5, '任务'.$task['id'].'维权成功');
								} else {
									member_base::addMoney($task['suid'], $backPrice, '任务'.$task['id'].'发布方维权失败，返还担保金');
									//member_base::backPoint($task['id'], $backPoint);
									member_base::setEnsureMoney($task['buid'], -$backPrice);
									db::update('task', array('ensureStatus' => 1 | 1 << 1 | 1 << 3), "id='$task[id]'");
								}
								member_base::sendPm($ensure['fuid'], '维权任务'.$ensure['tid'].'成功', '维权结果', 'ensure_end');
								member_base::sendSms($ensure['fuid'], '维权任务'.$ensure['tid'].'成功', 'ensure_end');
								member_base::sendPm($ensure['tuid'], '被维权任务'.$ensure['tid'].'失败', '维权结果', 'ensure_end');
								member_base::sendSms($ensure['tuid'], '被维权任务'.$ensure['tid'].'失败', 'ensure_end');
							} else {
								if (!$isBuyer) {
									member_base::addMoney($task['buid'], $backPrice, '任务'.$task['id'].'发布方维权失败，返还担保金');
									//member_base::addFabudian($task['money'], $task['money'], '任务'.$task['id'].'维权成功，返还担保金');
									//member_base::addPoint($task['id'], $backPoint);
									//member_base::addCredit($task['buid'], member_base::isVip($task['buid'])?6:5, '任务'.$task['id'].'维权成功');
									db::update('task', array('ensureStatus' => 1 | 1 << 1), "id='$task[id]'");
								} else {
									member_base::addMoney($task['suid'], $backPrice, '任务'.$task['id'].'接手方维权成功，返还担保金');
									member_base::backPoint($task['id'], $backPoint);
								}
								member_base::sendPm($ensure['fuid'], '维权任务'.$ensure['tid'].'失败', '维权结果', 'ensure_end');
								member_base::sendSms($ensure['fuid'], '维权任务'.$ensure['tid'].'失败', 'ensure_end');
								member_base::sendPm($ensure['tuid'], '被维权任务'.$ensure['tid'].'成功', '维权结果', 'ensure_end');
								member_base::sendSms($ensure['tuid'], '被维权任务'.$ensure['tid'].'成功', 'ensure_end');
							}
							//扣除附加的金钱和兔粮
							if ($sprice != 0) {
								member_base::addMoney($task['suid'], $sprice, '维权任务'.$task['id'].'处理');
							}
							if ($spoint != 0) {
								member_base::addFabudian($task['suid'], $spoint, $task['type'], '维权任务'.$task['id'].'处理');
							}
							if ($bprice != 0) {
								member_base::addMoney($task['buid'], $bprice, '维权任务'.$task['id'].'处理');
							}
							if ($bpoint != 0) {
								member_base::addFabudian($task['buid'], $bpoint, $task['type'], '维权任务'.$task['id'].'处理');
							}
							//
							/*if ($task['status'] >=2 && $task['status'] <= 7) $f = 'ing';
							else $f = 'Expire';
							db::update('membertask', 'out'.$f.$task['type'].'='.'out'.$f.$task['type'].'-1,outComplate'.$task['type'].'=outComplate'.$task['type'].'+1,outComplate=outComplate+1', "uid='$task[suid]'");
							db::update('membertask', 'in'.$f.$task['type'].'='.'in'.$f.$task['type'].'-1,inComplate'.$task['type'].'=inComplate'.$task['type'].'+1,inComplate=inComplate+1', "uid='$task[buid]'");
							db::update('task', "status='10',ensure='10'", "id='$task[id]'");*/
							db::update('ensure', "status='$status',timestamp2='$timestamp'", "id='$id'");
							admin::show_message('处理成功', $base_url);
						}
					}
				}
			}
		}
	break;
}
?>