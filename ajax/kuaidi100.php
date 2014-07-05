<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
template::initialize('./templates/default/ajax/', './cache/default/ajax/');
$rs = array(
	'status' => false,
	'msg'    => '非法操作！'
);
common::nocache();
if ($memberLogined) {
	$isGet = true;
	if (!$isVip) {
		$getCount = cfg::getInt('epCfg', 'memberCount');
		$getTask  = cfg::getInt('epCfg', 'memberGetTask');
		$sendTask  = cfg::getInt('epCfg', 'memberSendTask');
	} else {
		$getCount = cfg::getInt('epCfg', 'vipCount');
		$getTask  = cfg::getInt('epCfg', 'vipGetTask');
		$sendTask  = cfg::getInt('epCfg', 'vipSendTask');
	}
	if ($getCount > 0 && $isGet) {
		if ($getCount <= db::data_count('log_express', "time>='$today_start' AND time<='$today_end'")) {
			$rs['msg'] = ($isVip ? 'VIP用户' : '普通用户').'每天只能获取'.$getCount.'条数据';
			$isGet = false;
		} else {
			$isGet = true;
		}
	}
	if ($getTask > 0 && $isGet) {
		if ($getTask > db::data_count('task', "buid='$uid' AND status='10'")) {
			$isGet = false;
			$rs['msg'] = ($isVip ? 'VIP用户' : '普通用户').'必须要接手完成'.$getTask.'个任务才能使用';
		} else {
			$isGet = true;
		}
	}
	if ($sendTask > 0 && $isGet) {
		if ($sendTask > db::data_count('task', "suid='$uid' AND status='10'")) {
			$isGet = false;
			$rs['msg'] = ($isVip ? 'VIP用户' : '普通用户').'必须要发布完成'.$sendTask.'个任务才能使用';
		} else {
			$isGet = true;
		}
	}
	if ($isGet) {
		switch($getType){
			case 'rand':
				if ($epEname) {
					$e = new express($epEname);
					$list = array();
					$list[] = $e->getRandOneFull($e->getRandMarker());
					$list[] = $e->getRandOneFull($e->getRandMarker());
					$list[] = $e->getRandOneFull($e->getRandMarker());
					$list[] = $e->getRandOneFull($e->getRandMarker());
					$rs['status'] = true;
					$rs['msg']    = '';
					$rs['list'] = $list;
				} else $rs['msg'] = '参数错误！';
			break;
			case 'cus':
				if ($epEname && $eid) {
					$e = new express($epEname);
					$list = array();
					$list = $e->getCusListFull($eid, 4);
					$rs['status'] = true;
					$rs['msg']    = '';
					$rs['list'] = $list;
				} else $rs['msg'] = '参数错误！';
			break;
			case 'get':
				if ($epEname && $eid) {
					$e = new express($epEname);
					$list = array();
					$list[] = $e->getIdInfo($eid);
					$rs['status'] = true;
					$rs['msg']    = '';
					$rs['list'] = $list;
				} else $rs['msg'] = '参数错误！';
			break;
		}
		if ($rs['status']) {
			foreach ($rs['list'] as $v) {
				if ($v['info']['status']) {
					db::insert('log_express', array(
						'uid'      => $uid,
						'username' => $member['username'],
						'eid'      => $v['id'],
						'time'     => time()
					));
				}
			}
		}
	}
} else {
	$rs['msg'] = '请先登录再操作！';
}
echo string::json_encode($rs);
?>