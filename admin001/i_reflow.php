<?php
$top_menu=array(
	'tao' => '淘宝区任务管理',
	'view' => array('name' => '商品详情', 'isHide' => true),
	'getList' => array('name' => '接手人列表', 'isHide' => true)
);
if($edit=(int)$edit)$method='edit';
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$top_menu2 = array(
	'all'         => '全部',
	'pause'       => '暂停中的任务',
	'ing'         => '进行中的任务',
	'lock'        => '锁定中的任务',
	'complate'    => '已完成的任务'
);
$top_menu_key2 = array_keys($top_menu2);
($method2 && in_array($method2,$top_menu_key2)) || $method2 = $top_menu_key2[0];
$status = array('暂停中', '进行中', '锁定中', '已完成');
if ($lock) {
	$task = task_reflow::get($lock);
	if ($task['status'] == 2) {
		//解锁
		if (task_reflow::unlock($lock)) {
			admin::show_message('解锁成功！', $referer);
		} else {
			admin::show_message('解锁失败！', $referer);
		}
	} else {
		//锁定
		if (task_reflow::lock($lock)) {
			admin::show_message('锁定成功！', $referer);
		} else admin::show_message('锁定失败，已完成的任务和暂停中的任务不能锁定！', $referer);
	}
}
switch($method){
	case 'tao':
		if (form::is_form_hash()) {
			extract(form::get3('del'));
			$del && task_reflow::del($del);
			admin::show_message('删除成功', $base_url.'&method='.$method.'&method2='.$method2);
		}
		$where = "type='1'";
		switch ($method2) {
			case 'all':
				
			break;
			case 'pause':
				(($where && $where .= ' and ') || !$where) && $where .= "status='0'";
			break;
			case 'ing':
				(($where && $where .= ' and ') || !$where) && $where .= "status='1'";
			break;
			case 'lock':
				(($where && $where .= ' and ') || !$where) && $where .= "status='2'";
			break;
			case 'complate':
				(($where && $where .= ' and ') || !$where) && $where .= "status='3'";
			break;
		}
		if ($total = db::data_count('task_reflow', $where)) {
			//$taskInfo = db::one('task', 'sum(price) priceAll,sum(point) pointAll', $where);
			$list = array();
			foreach (db::get_list2('task_reflow', '*', $where, 'time desc', $page, $pagesize) as $v) {
				$v['lock'] = $v['status'] == 2 ? 1: 0;
				$list[] = $v;
			}
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
			if ($task = db::one('task_reflow', '*', "id='$sid'")) {
				$update = true;
			}
		}
	break;
	case 'getList':
		if (form::is_form_hash()) {
			extract(form::get3('del'));
			if ($del) {
				foreach ($del as $id) {
					if ($item = db::one('task_reflow_log', '*', "id='$id'")) {
						if ($item['status'] == 0) {
							//进行中的任务
							db::update('task_reflow', 'flowLock=flowLock-\'1\',flowTotal=flowTotal+\'1\'', "id='$item[tid]'");//返回流量点
						}
					}
				}
				db::del_ids('task_reflow_log', $del);
				admin::show_message('删除成功！', $base_url.'&method=getList&sid='.$sid);
			}
		}
		if ($total = db::data_count('task_reflow_log', "tid='$sid'")) {
			$list = db::select('task_reflow_log', '*', "tid='$sid'", 'time DESC', $pagesize, $page);
		}
	break;
}
?>