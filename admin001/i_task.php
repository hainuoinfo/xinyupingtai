<?php
$top_menu=array(
	'new' => '新手区任务管理',
	'tao' => '淘宝区任务管理',
	'pai' => '拍拍区任务管理',
	'you' => '有啊区任务管理',
	'view' => array('name' => '商品详情', 'isHide' => true)
);
if($edit=(int)$edit)$method='edit';
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$top_menu2 = array(
	'all'         => '全部',
	'pause'      => '暂停中的任务',
	'waiting'     => '等待接手任务',
	'ing'         => '进行中的任务',
	'waitExpress' => '等待快递单号',
	'complate'    => '已完成的任务'
);
$top_menu_key2 = array_keys($top_menu2);
($method2 && in_array($method2,$top_menu_key2)) || $method2 = $top_menu_key2[0];
$status     = array(
		'暂停中', 
		'已发布，等待接手人接手', 
		'已接手，等待接手人绑定买号', '等待发布方审核', '已绑定买号，等待接手方支付', '已支付，待核对快递地址', '准备发货，等待快递单号', '已支付，等待发布人发货', 
		'已发货，等待收货与好评', '已确认，等待卖家核实货款', 
		'交易完成');
$types = array('', '淘宝区', '拍拍区', '有啊区');
$times = array('', '马上好评', '24小时好评', '48小时好评', '72小时好评');
$lang = array(
	/*'status'     => array('暂停中', '已发布，等待接手人接手', '已接手，等待接手人绑定买号', '等待发布方审核', '已绑定买号，等待接手方支付', '已支付，等待发布人发货', '已发货，等待收货与好评', '已确认，等待卖家确认', '交易完成'),*/
	'status'     => array(
		'暂停中', 
		'已发布，等待接手人接手', 
		'已接手，等待接手人绑定买号', '等待发布方审核', '已绑定买号，等待接手方支付', '已支付，待核对快递地址', '准备发货，等待快递单号', '已支付，等待发布人发货', 
		'已发货，等待收货与好评', '已确认，等待卖家核实货款', 
		'交易完成'),
	'isPriceFit' => array('不需要', '需要'),
	'times'      => array('', '马上好评', '24小时好评', '48小时好评', '72小时好评'),
	'times_ico'  => array('&nbsp;', '&nbsp;', '<span class=\'task_24\' title=\'24小时好评\'></span>', '<span class=\'task_48\' title=\'48小时好评\'></span>', '<span class=\'task_72\' title=\'72小时好评\'></span>'),
	'scores'     => array('全部不打分', 5 => '全部打5分'),
	'share'      => array('', '非匿名分享', '匿名分享'),
	'bStatus'    => array('正常', '危险', '挂起', '失效', '锁定', '暂停', '收藏'),
	'cStatus'    => array('双方未评分', '接手方已评分', '发布方已评分', '双方已评分')
);
error_reporting(E_ALL & ~E_NOTICE);
switch($method){
	case 'new':
		if (form::is_form_hash()) {
			if ($del = $_POST['del']) {
				$ids = array();
				foreach ($del as $id) {
					$task = db::one('task', '*', "id='$id'");
					$s = $task['status'];
					$t = $task['type'];
					if ($s < 5) {
						if ($s == 0) {
							$f = 'Pause';
						} elseif ($s == 1) {
							$f = 'Waiting';
						} else {
							$f = 'ing';
						}
						db::update('membertask', 'out'.$f.$t.'='.'out'.$f.$t.'-1', "uid='$task[suid]'");
						db::update('sellers', 'tasking=tasking-1', "id='$task[sid]'");
						if ($s > 1) {
							db::update('membertask', 'in'.$f.$t.'='.'in'.$f.$t.'-1', "uid='$task[buid]'");
							db::update('buyers', 'tasking=tasking-1', "id='$task[bid]'");
						}
						member_base::addMoney($task['suid'], $task['price'], '后台删除任务，返还担保金');
						member_base::addFabudian($task['suid'], $task['point'], $task['type'] == 4?1:$task['type'], '后台删除任务，返还兔粮');
						member_base::addCredit($task['suid'], -($task['svip']?6:5), '后台删除任务，扣除发布奖励积分');
						$ids[] = $id;
					} elseif($task['status'] == 10) {
						$ids[] = $id;
					}
				}
				if ($ids) db::del_ids('task', $ids);
			}
			admin::show_message('删除成功', $base_url.'&method='.$method.'&method2='.$method2);
		}
		$where = "type='4'";
		switch ($method2) {
			case 'all':
				
			break;
			case 'pause':
				(($where && $where .= ' and ') || !$where) && $where .= "status='0'";
			break;
			case 'waiting':
				(($where && $where .= ' and ') || !$where) && $where .= "status='1'";
			break;
			case 'ing':
				(($where && $where .= ' and ') || !$where) && $where .= "status in('2','3','4','5','6','7','8','9')";
			break;
			case 'waitExpress':
				(($where && $where .= ' and ') || !$where) && $where .= "status='6'";
			break;
			case 'complate':
				(($where && $where .= ' and ') || !$where) && $where .= "status='10'";
			break;
		}
		if ($total = db::data_count('task', $where)) {
			$taskInfo = db::one('task', 'sum(price) priceAll,sum(point) pointAll', $where);
			$list = db::get_list2('task', '*', $where, 'status,stimestamp desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&method2='.$method2.'&page={page}', $pagestyle, 10);
		}
		if (!$taskInfo) $taskInfo = array('priceAll' => 0, 'pointAll' => 0);
	break;
	case 'tao':
		if (form::is_form_hash()) {
			if ($del = $_POST['del']) {
				$ids = array();
				foreach ($del as $id) {
					$task = db::one('task', '*', "id='$id'");
					$s = $task['status'];
					$t = $task['type'];
					if ($s < 5) {
						if ($s == 0) {
							$f = 'Pause';
						} elseif ($s == 1) {
							$f = 'Waiting';
						} else {
							$f = 'ing';
						}
						db::update('membertask', 'out'.$f.$t.'='.'out'.$f.$t.'-1', "uid='$task[suid]'");
						db::update('sellers', 'tasking=tasking-1', "id='$task[sid]'");
						if ($s > 1) {
							db::update('membertask', 'in'.$f.$t.'='.'in'.$f.$t.'-1', "uid='$task[buid]'");
							db::update('buyers', 'tasking=tasking-1', "id='$task[bid]'");
						}
						member_base::addMoney($task['suid'], $task['price'], '后台删除任务，返还担保金');
						member_base::addFabudian($task['suid'], $task['point'], $task['type'] == 4?1:$task['type'], '后台删除任务，返还兔粮');
						member_base::addCredit($task['suid'], -($task['svip']?6:5), '后台删除任务，扣除发布奖励积分');
						$ids[] = $id;
					} elseif($task['status'] == 10) {
						$ids[] = $id;
					}
				}
				if ($ids) db::del_ids('task', $ids);
			}
			admin::show_message('删除成功', $base_url.'&method='.$method.'&method2='.$method2);
		}
		$where = "type='1'";
		switch ($method2) {
			case 'all':
				
			break;
			case 'pause':
				(($where && $where .= ' and ') || !$where) && $where .= "status='0'";
			break;
			case 'waiting':
				(($where && $where .= ' and ') || !$where) && $where .= "status='1'";
			break;
			case 'ing':
				(($where && $where .= ' and ') || !$where) && $where .= "status in('2','3','4','5','6','7','8','9')";
			break;
			case 'waitExpress':
				(($where && $where .= ' and ') || !$where) && $where .= "status='6'";
			break;
			case 'complate':
				(($where && $where .= ' and ') || !$where) && $where .= "status='10'";
			break;
		}
		if ($total = db::data_count('task', $where)) {
			$taskInfo = db::one('task', 'sum(price) priceAll,sum(point) pointAll', $where);
			$list = db::get_list2('task', '*', $where, 'status,stimestamp desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&method2='.$method2.'&page={page}', $pagestyle, 10);
		}
		if (!$taskInfo) $taskInfo = array('priceAll' => 0, 'pointAll' => 0);
	break;
	case 'pai':
		if (form::is_form_hash()) {
			if ($del = $_POST['del']) {
				$ids = array();
				foreach ($del as $id) {
					$task = db::one('task', '*', "id='$id'");
					$s = $task['status'];
					$t = $task['type'];
					if ($s < 5) {
						if ($s == 0) {
							$f = 'Pause';
						} elseif ($s == 1) {
							$f = 'Waiting';
						} else {
							$f = 'ing';
						}
						db::update('membertask', 'out'.$f.$t.'='.'out'.$f.$t.'-1', "uid='$task[suid]'");
						db::update('sellers', 'tasking=tasking-1', "id='$task[sid]'");
						if ($s > 1) {
							db::update('membertask', 'in'.$f.$t.'='.'in'.$f.$t.'-1', "uid='$task[buid]'");
							db::update('buyers', 'tasking=tasking-1', "id='$task[bid]'");
						}
						member_base::addMoney($task['suid'], $task['price'], '后台删除任务，返还担保金');
						member_base::addFabudian($task['suid'], $task['point'], $task['type'] == 4?1:$task['type'], '后台删除任务，返还兔粮');
						member_base::addCredit($task['suid'], -($task['svip']?6:5), '后台删除任务，扣除发布奖励积分');
						$ids[] = $id;
					} elseif($task['status'] == 10) {
						$ids[] = $id;
					}
				}
				if ($ids) db::del_ids('task', $ids);
			}
			admin::show_message('删除成功', $base_url.'&method='.$method.'&method2='.$method2);
		}
		$where = "type='2'";
		switch ($method2) {
			case 'all':
				
			break;
			case 'pause':
				(($where && $where .= ' and ') || !$where) && $where .= "status='0'";
			break;
			case 'waiting':
				(($where && $where .= ' and ') || !$where) && $where .= "status='1'";
			break;
			case 'ing':
				(($where && $where .= ' and ') || !$where) && $where .= "status in('2','3','4','5','6','7','8','9')";
			break;
			case 'waitExpress':
				(($where && $where .= ' and ') || !$where) && $where .= "status='6'";
			break;
			case 'complate':
				(($where && $where .= ' and ') || !$where) && $where .= "status='10'";
			break;
		}
		if ($total = db::data_count('task', $where)) {
			$taskInfo = db::one('task', 'sum(price) priceAll,sum(point) pointAll', $where);
			$list = db::get_list2('task', '*', $where, 'status,stimestamp desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&method2='.$method2.'&page={page}', $pagestyle, 10);
		}
		if (!$taskInfo) $taskInfo = array('priceAll' => 0, 'pointAll' => 0);
	break;
	case 'you':
		if (form::is_form_hash()) {
			if ($del = $_POST['del']) {
				$ids = array();
				foreach ($del as $id) {
					$task = db::one('task', '*', "id='$id'");
					$s = $task['status'];
					$t = $task['type'];
					if ($s < 5) {
						if ($s == 0) {
							$f = 'Pause';
						} elseif ($s == 1) {
							$f = 'Waiting';
						} else {
							$f = 'ing';
						}
						db::update('membertask', 'out'.$f.$t.'='.'out'.$f.$t.'-1', "uid='$task[suid]'");
						db::update('sellers', 'tasking=tasking-1', "id='$task[sid]'");
						if ($s > 1) {
							db::update('membertask', 'in'.$f.$t.'='.'in'.$f.$t.'-1', "uid='$task[buid]'");
							db::update('buyers', 'tasking=tasking-1', "id='$task[bid]'");
						}
						member_base::addMoney($task['suid'], $task['price'], '后台删除任务，返还担保金');
						member_base::addFabudian($task['suid'], $task['point'], $task['type'] == 4?1:$task['type'], '后台删除任务，返还兔粮');
						member_base::addCredit($task['suid'], -($task['svip']?6:5), '后台删除任务，扣除发布奖励积分');
						$ids[] = $id;
					} elseif($task['status'] == 10) {
						$ids[] = $id;
					}
				}
				if ($ids) db::del_ids('task', $ids);
			}
			admin::show_message('删除成功', $base_url.'&method='.$method.'&method2='.$method2);
		}
		$where = "type='3'";
		switch ($method2) {
			case 'all':
				
			break;
			case 'pause':
				(($where && $where .= ' and ') || !$where) && $where .= "status='0'";
			break;
			case 'waiting':
				(($where && $where .= ' and ') || !$where) && $where .= "status='1'";
			break;
			case 'ing':
				(($where && $where .= ' and ') || !$where) && $where .= "status in('2','3','4','5','6','7','8','9')";
			break;
			case 'waitExpress':
				(($where && $where .= ' and ') || !$where) && $where .= "status='6'";
			break;
			case 'complate':
				(($where && $where .= ' and ') || !$where) && $where .= "status='10'";
			break;
		}
		if ($total = db::data_count('task', $where)) {
			$taskInfo = db::one('task', 'sum(price) priceAll,sum(point) pointAll', $where);
			$list = db::get_list2('task', '*', $where, 'status,stimestamp desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&method2='.$method2.'&page={page}', $pagestyle, 10);
		}
		if (!$taskInfo) $taskInfo = array('priceAll' => 0, 'pointAll' => 0);
	break;
	case 'view':
		if ($sid) {
			if (form::is_form_hash()) {
				$expressNum = $_POST['expressNum'];
				db::update('task', array('expressNum' => $expressNum, 'status' => 7), "id='$sid' and status='6'");
				admin::show_message('更新成功');
			}
			if ($task = db::one('task', '*', "id='$sid'")) {
				if ($task['isCart'] || $task['isExpress']) {
					$shops = db::get_list('taskshops', '*', "tid='$task[id]'");
					if ($task['isExpress']) {
						if ($sellerExpress = task_seller::getExpress($task['sid'], $task['expressTM'])) {
							$sellerExpress['area'] = str_replace(' ', '', $sellerExpress['area']);
						}
						if ($buyerExpress = task_buyer::getExpress($task['bid'], $task['expressTM'])) {
							$buyerExpress['area'] = str_replace(' ', '', $buyerExpress['area']);
						}
					}
				}
			}
		}
	break;
}
?>