<?php
$top_menu=array(
	'tao' => '淘宝区申诉处理',
	'pai' => '拍拍区申诉处理',
	'you' => '有啊区申诉处理',
	'new' => '新手区申诉处理',
	'view' => array('name' => '申述详情', 'isHide' => true)
);
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$cStatus = array('等待被申诉方解决问题或辩解', '申诉成功', '申诉失败', '撤销申诉', '等待申诉人撤诉', '申诉人坚持申诉');
switch($method){
	case 'tao':
		if (form::is_form_hash()) {
			if (($del = $_POST['del']) && ($ids = '\''.implode('\',\'', $del).'\'')) {
				if ($tids = db::get_keys('complain', 'tid', "id in($ids) and status='0'")) {
					$tids = '\''.implode('\',\'', $tids).'\'';
					db::update('task', "complain='0'", "id in($tids)");
				}
				db::del_ids('complain', $del);
				db::del_keys('complain', 'cid', $del);
				
			}
			admin::show_message('删除成功', $base_url);
		}
		$where = "type='1'";
		if ($total = db::data_count('complain', $where)) {
			$list = db::get_list2('complain', 'id,fusername,tusername,tid,title,timestamp1,timestamp2,status', $where, 'status,timestamp1 desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&method2='.$method2.'&page={page}', $pagestyle, 10);
		}
	break;
	case 'pai':
		if (form::is_form_hash()) {
			if (($del = $_POST['del']) && ($ids = '\''.implode('\',\'', $del).'\'')) {
				if ($tids = db::get_keys('complain', 'tid', "id in($ids) and status='0'")) {
					$tids = '\''.implode('\',\'', $tids).'\'';
					db::update('task', "complain='0'", "id in($tids)");
				}
				db::del_ids('complain', $del);
				db::del_keys('complain', 'cid', $del);
				
			}
			admin::show_message('删除成功', $base_url);
		}
		$where = "type='2'";
		if ($total = db::data_count('complain', $where)) {
			$list = db::get_list2('complain', 'id,fusername,tusername,tid,title,timestamp1,timestamp2,status', $where, 'status,timestamp1 desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&method2='.$method2.'&page={page}', $pagestyle, 10);
		}
	break;
	case 'you':
		if (form::is_form_hash()) {
			if (($del = $_POST['del']) && ($ids = '\''.implode('\',\'', $del).'\'')) {
				if ($tids = db::get_keys('complain', 'tid', "id in($ids) and status='0'")) {
					$tids = '\''.implode('\',\'', $tids).'\'';
					db::update('task', "complain='0'", "id in($tids)");
				}
				db::del_ids('complain', $del);
				db::del_keys('complain', 'cid', $del);
				
			}
			admin::show_message('删除成功', $base_url);
		}
		$where = "type='3'";
		if ($total = db::data_count('complain', $where)) {
			$list = db::get_list2('complain', 'id,fusername,tusername,tid,title,timestamp1,timestamp2,status', $where, 'status,timestamp1 desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&method2='.$method2.'&page={page}', $pagestyle, 10);
		}
	break;
	case 'new':
		if (form::is_form_hash()) {
			if (($del = $_POST['del']) && ($ids = '\''.implode('\',\'', $del).'\'')) {
				if ($tids = db::get_keys('complain', 'tid', "id in($ids) and status='0'")) {
					$tids = '\''.implode('\',\'', $tids).'\'';
					db::update('task', "complain='0'", "id in($tids)");
				}
				db::del_ids('complain', $del);
				db::del_keys('complain', 'cid', $del);
				
			}
			admin::show_message('删除成功', $base_url);
		}
		$where = "type='4'";
		if ($total = db::data_count('complain', $where)) {
			$list = db::get_list2('complain', 'id,fusername,tusername,tid,title,timestamp1,timestamp2,status', $where, 'status,timestamp1 desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&method2='.$method2.'&page={page}', $pagestyle, 10);
		}
	break;
	case 'view':
		if ($id) {
			if ($complain = db::one('complain', '*', "id='$id'")) {
				$task = task_base::_get($complain['tid']);//获取任务
				if ($task['buid'] == $complain['fuid']) $isBuyer = true;//是买家
				else $isBuyer = false;//是卖家
				$complainMessage = array();
				$query = $db->query("select * from {$pre}complain_message where cid='$complain[id]' order by timestamp");
				while ($line = $db->fetch_array($query)) {
					$line['message'] = string::ubbDecode($line['message']);
					$complainMessage[$line['type']][] = $line;
				}
				if (form::is_form_hash()) {
					if (!in_array($complain['status'], array(1, 2, 3))) {
						//$task = task_base::_get($complain['tid']);
						if ($task['status'] >= 5) {//最少要支付了才有申诉权
							//if ($task['buid'] == $complain['fuid']) $isBuyer = true;
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
									member_base::addMoney($task['buid'], $backPrice, '任务'.$task['id'].'接手方申诉成功，返还担保金');
									//member_base::addFabudian($task['money'], $task['money'], '任务'.$task['id'].'申诉成功，返还担保金');
									member_base::addPoint($task['id'], $backPoint);
									member_base::addCredit($task['buid'], member_base::isVip($task['buid'])?6:5, '任务'.$task['id'].'申诉成功');
								} else {
									member_base::addMoney($task['suid'], $backPrice, '任务'.$task['id'].'发布方申诉失败，返还担保金');
									member_base::backPoint($task['id'], $backPoint);
								}
								
									
								member_base::sendPm($complain['fuid'], '申诉任务'.$complain['tid'].'成功', '申诉结果', 'complain_end');
								member_base::sendSms($complain['fuid'], '申诉任务'.$complain['tid'].'成功', 'complain_end');
								member_base::sendPm($complain['tuid'], '被申诉任务'.$complain['tid'].'失败', '申诉结果', 'complain_end');
								member_base::sendSms($complain['tuid'], '被申诉任务'.$complain['tid'].'失败', 'complain_end');
								member_base::addCredit($complain['tuid'], -12, '客服裁定申诉任务'.$complain['tid']);
							} else {
								if (!$isBuyer) {
									member_base::addMoney($task['buid'], $backPrice, '任务'.$task['id'].'发布方申诉失败，返还担保金');
									//member_base::addFabudian($task['money'], $task['money'], '任务'.$task['id'].'申诉成功，返还担保金');
									member_base::addPoint($task['id'], $backPoint);
									member_base::addCredit($task['buid'], member_base::isVip($task['buid'])?6:5, '任务'.$task['id'].'申诉成功');
								} else {
									member_base::addMoney($task['suid'], $backPrice, '任务'.$task['id'].'接手方申诉成功，返还担保金');
									member_base::backPoint($task['id'], $backPoint);
								}
								member_base::sendPm($complain['fuid'], '申诉任务'.$complain['tid'].'失败', '申诉结果', 'complain_end');
								member_base::sendSms($complain['fuid'], '申诉任务'.$complain['tid'].'失败', 'complain_end');
								member_base::sendPm($complain['tuid'], '被申诉任务'.$complain['tid'].'成功', '申诉结果', 'complain_end');
								member_base::sendSms($complain['tuid'], '被申诉任务'.$complain['tid'].'成功', 'complain_end');
							}
							//扣除附加的金钱和兔粮
							if ($sprice != 0) {
								member_base::addMoney($task['suid'], $sprice, '申诉任务'.$task['id'].'处理');
							}
							if ($spoint != 0) {
								member_base::addFabudian($task['suid'], $spoint, $task['type'], '申诉任务'.$task['id'].'处理');
							}
							if ($bprice != 0) {
								member_base::addMoney($task['buid'], $bprice, '申诉任务'.$task['id'].'处理');
							}
							if ($bpoint != 0) {
								member_base::addFabudian($task['buid'], $bpoint, $task['type'], '申诉任务'.$task['id'].'处理');
							}
							//
							if ($task['status'] >=2 && $task['status'] <= 7) $f = 'ing';
							else $f = 'Expire';
							db::update('membertask', 'out'.$f.$task['type'].'='.'out'.$f.$task['type'].'-1,outComplate'.$task['type'].'=outComplate'.$task['type'].'+1,outComplate=outComplate+1', "uid='$task[suid]'");
							db::update('membertask', 'in'.$f.$task['type'].'='.'in'.$f.$task['type'].'-1,inComplate'.$task['type'].'=inComplate'.$task['type'].'+1,inComplate=inComplate+1', "uid='$task[buid]'");
							//db::update('task', "status='10',complain='10'", "id='$task[id]'");
							db::update('task', "status='10',complain='0'", "id='$task[id]'");
							db::update('complain', "status='$status',timestamp2='$timestamp'", "id='$id'");
							admin::show_message('处理成功', $base_url);
						}
					}
				}
			}
		}
	break;
}
?>