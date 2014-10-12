<?php
class task_reflow{
	private static $taskId = 1, $tb = 'task_reflow';
	public static function upCache(){
		global $today_start, $db, $pre, $timestamp;
		//自动退出一定时间没有完成任务的
		$t = $timestamp - cfg::getInt('reflow', 'time_expire');
		$query = db::query('SELECT id,uid,time FROM `'.db::table('task_reflow_log').'` WHERE status=\'0\' and time<=\''.$t.'\'');
		while ($line = db::fetch($query)) {
			self::quit($line['id'], $line['uid']);
		}
		//更新定时发布的任务
		$query = $db->query("select id from {$pre}task_reflow where status='0' and isPlan='1' and planDate<$timestamp");
		while ($tid = $db->fetch_array_first($query)) {
			$db->query("update {$pre}task_reflow set status='1',isPlan='0',planDate='0' where id='$tid'");
		}
	}
	public static function checkUrl($url){
		//if (preg_match('/^http:\/\/(?:[\w-]+\.)+(?:(?:taobao)|(?:tmall))\.com\/item\.htm\?(?:item_)?(?:num_)?id=(\d+).*$/i', $url, $matches)) return $matches[1];
		if (preg_match('/^(?:http:\/\/[\w-]+\.+(?:taobao|tmall)\.com\/item\.htm\?.*?id=(\d+))|(?:http:\/\/item\.(?:tmall|taobao)\.com\/mealDetail\.htm\?.*?id=(\d+))/i', $url, $matches)) return $matches[1] ? $matches[1] : $matches[2];
		return false;
	}
	private static function ignoreEmpty($arr){
		$rn = array();
		foreach($arr as $v){
			if ($v = trim($v)) {
				$rn[] = $v;
			}
		}
		return $rn;
	}
	private static function parseIpCount($str){
		$rs = array();
		foreach (explode(';', $str) as $v) {
			list($count, $price, $check) = explode(',', $v);
			$rs[$count] = $price;
		}
		return $rs;
	}
	private static function formatData(&$datas){
		//处理搜索条件
		$checkTypeId = $checkValueId = '';
		switch ($datas['wayId']) {
			case 0:
				$datas['visitKey'] = $datas['visitKey_0'];
				$datas['visitTip'] = $datas['visitTip_0'];
				$checkTypeId = 'checkType_0';
				$checkValueId = 'checkValue'.$datas[$checkTypeId].'_0';
			break;
			case 1:
				$datas['visitKey'] = $datas['visitKey_1'];
				$datas['visitTip'] = $datas['visitTip_1'];
				$checkTypeId = 'checkType_1';
				$checkValueId = 'checkValue'.$datas[$checkTypeId].'_1';
			break;
			case 2:
				$datas['visitKey'] = '';
				$datas['visitTip'] = $datas['visitTip_2'];
				$checkTypeId = 'checkType_2';
				$checkValueId = 'checkValue'.$datas[$checkTypeId].'_2';
			break;
			default:
				return '数据错误！';
			break;
		}
		$datas['checkType'] = $datas[$checkTypeId];
		switch ($datas[$checkTypeId]) {
			case 0:
			break;
			case 1:
				$datas['checkValue'] = $datas[$checkValueId];
			break;
			case 2:
				$datas['checkValue'] = $datas[$checkValueId];
			break;
			default:
				return '数据错误！';
			break;
		}
		//TRIM
		$datas['itemurl']  = trim($datas['itemurl']);
		$datas['visitKey'] = trim($datas['visitKey']);
		$datas['visitTip'] = trim($datas['visitTip']);
		$datas['checkValue'] = trim($datas['checkValue']);
		//处理真假
		$datas['isIP'] = $datas['isIP'] ? 1 : 0;
		$datas['isLimit'] = $datas['isLimit'] ? 1 : 0;
		$datas['isPlan']  = $datas['isPlan'] ? 1 : 0;
		$datas['isRate'] = $datas['isRate'] ? 1 : 0;
		if ($datas['isPlan']) {
			$datas['planDate'] = time::get_general_timestamp($datas['planDate']);
			if ($datas['planDate'] == 0) $datas['isPlan'] = 0;
		} else $datas['planDate'] = 0;
		//其它
		$datas['minute'] = trim($datas['minute']);
		//处理系统配置
		cfg::getInt('reflow', 'isIP') == 1 && $datas['isIP'] = 1;
		cfg::getInt('reflow', 'isLimit') == 1 && $datas['isLimit'] = 1;
		cfg::getInt('reflow', 'isRate') == 1 && $datas['isRate'] = 1;
		if (cfg::getInt('reflow', 'count_min') > $datas['total'] || $datas['total'] > cfg::getInt('reflow', 'count_max')) return '访问次数错误！';
		if (is_numeric($datas['minute'])) {
			if (cfg::getInt('reflow', 'minute_min') > $datas['minute'] || $datas['minute'] > cfg::getInt('reflow', 'minute_max')) return '访问频率错误！';
		} else {
			$datas['minute'] = rand(cfg::getInt('reflow', 'minute_min'), cfg::getInt('reflow', 'minute_max'));
		}
		!$datas['isRate'] && $datas['minute'] = 0;
		$datas['minute'] && $datas['rateTime'] = intval($datas['minute']) * 60;
		$__arr = array_keys(self::parseIpCount(cfg::get('reflow', 'ip_count1')));
		if ($datas['isIP']) {
			in_array($datas['numIP'], $__arr) || $datas['numIP'] = $__arr[0];
		} else {
			$datas['numIP'] = 0;
		}
		$__arr = array_keys(self::parseIpCount(cfg::get('reflow', 'ip_count2')));
		if ($datas['isLimit']) {
			in_array($datas['numUser'], $__arr) || $datas['numUser'] = $__arr[0];
		} else {
			$datas['numUser'] = 0;
		}
		//处理竞价
		if ($datas['__bidUp'] == 'c') $datas['bidUp'] = common::formatMoney($datas['bidUpCus']);
		else $datas['bidUp'] = common::formatMoney($datas['bidUp']);
		//最后处理
		$datas['flowAll']      = $datas['total'];
		$datas['flowComplate'] = 0;
		$datas['flowLock']     = 0;
		$datas['flowTotal']    = $datas['total'];
		$datas['snickname']    = $datas['nickname'];
		$datas['bidUp'] > 0 && $datas['bidUp'] *= $datas['flowAll'];
		unset(
			$datas['nickname'],
			$datas['visitKey_0'], $datas['visitKey_1'],
			$datas['visitTip_0'], $datas['visitTip_1'], $datas['visitTip_2'],
			$datas['checkType_0'], $datas['checkType_1'], $datas['checkType_2'],
			$datas['checkValue1_0'], $datas['checkValue1_1'], $datas['checkValue1_2'],
			$datas['checkValue2_0'], $datas['checkValue2_1'], $datas['checkValue2_2'],
			$datas['__bidUp'],
			$datas['bidUpCus'],
			$datas['total']
		);
		return true;
	}
	public static function add($datas, $uid){
		global $timestamp;
		$next = true;
		$rs   = true;
		$member = $seller = array();
		$point = $point1 = $point2 = 0;
		if ($next) {
			if ( !($member = member_base::getMemberAll($uid)) ) {
				$next = false;
				$rs   = '用户不存在！';
			}
		}
		if ($next) {
			$rs = self::formatData($datas);
			if ($rs !== true) {
				$next = false;
			}
		}
		if ($next) {
			if ( !($seller = task_seller::getSeller2(self::$taskId, $datas['snickname'], $uid)) ) {
				$next = false;
				$rs   = '掌柜不存在！';
			}
		}
		if ($next) {
			if ($itemid = self::checkUrl($datas['itemurl'])) {
				if (data_taobaoShop::exists($itemid)) {
					if (data_taobaoShop::getNick($itemid) != $datas['snickname']) {
						$next = false;
						$rs   = '所选掌柜号与商品对应的掌柜不相符！';
					}
				} else {
					$next = false;
					$rs   = '商品不存在！';
				}
			} else {
				$next = false;
				$rs   = '商品地址格式错误！';
			}
		}
		if ($next) {
			$__p = $member['attach']['flowVip'] ? cfg::getMoney('reflow', 'price_once_vip') : cfg::getMoney('reflow', 'price_once');
			$point1 = $datas['flowAll'] * $__p;
			if ($datas['isIP']) {
				$__arr = self::parseIpCount(cfg::get('reflow', 'ip_count1'));
				$point2 += $__arr[$datas['numIP']] * $datas['flowAll'];
			}
			if ($datas['isLimit']) {
				$__arr = self::parseIpCount(cfg::get('reflow', 'ip_count2'));
				$point2 += $__arr[$datas['numUser']] * $datas['flowAll'];
			}
			$datas['isPlan'] && $point2 += cfg::getMoney('reflow', 'price_planDate');
			$point2 += $datas['bidUp'];
			$point = $point1 + $point2;
		}
		if ($next) {
			if ($point <= $member['attach']['fabudian'.self::$taskId]) {
				$datas = array(
					'type'      => self::$taskId,
					'suid'      => $member['base']['id'],
					'susername' => $member['base']['username'],
					'sid'       => $seller['id'],
					'snickname' => $seller['nickname'],
					'itemid'    => $itemid,
					'itemtitle' => addslashes(data_taobaoShop::getTitle($itemid)),
					'itemprice' => data_taobaoShop::getPrice($itemid)
				) + $datas + array(
					'point'  => $point,
					'point1' => $point1,
					'point2' => $point2,
					'time'   => $timestamp,
					'ctime'  => 0,
					'status' => $datas['isPlan'] ? 0 : 1
				);
				if (db::insert2(self::$tb, $datas)) {
					member_base::addFabudian($uid, -$datas['point'], self::$taskId, '发布来路任务');
					return true;
				} else {
					$next = false;
					$rs   = '发布失败，系统错误！';
				}
			} else {
				$next = false;
				$rs   = '兔粮不足';
			}
		}
		return $rs;
	}
	public static function get($tid, $uid = 0){
		$cacheName = 'cache_reflow_task_'.$tid;
		$rs = memory::get($cacheName);
		if (!isset($rs)) {
			$rs = db::one(self::$tb, '*', "type='".self::$taskId."'".($uid?" and suid='$uid'":"")." and id='$tid'");
		}
		return $rs;
	}
	public static function resume($tid, $uid){
		if ($task = self::get($tid, $uid)) {
			if ($task['status'] == 0) {
				if (db::update(self::$tb, array('isPlan' => 0, 'planDate' => 0, 'status' => 1), "id='$tid'")) {
					return true;
				}
				return 'update_error';
			}
			return 'error';
		}
		return '不存在该任务';
	}
	public static function pause($tid, $uid){
		if ($task = self::get($tid, $uid)) {
			if ($task['status'] == 1) {
				if (db::update(self::$tb, array('status' => 0), "id='$tid'")) {
					return true;
				}
				return 'update_error';
			}
			return 'error';
		}
		return '不存在该任务';
	}
	private static function getLastTime($tid){
		$rs = db::one_one('task_reflow_log', 'time', "tid='$tid'", 'time DESC');
		$rs && $rs = intval($rs);
		return $rs;
	}
	private static function getIpCount($tid, $ip = 0, $time = 86400){
		global $timestamp, $ipint;
		$ip || $ip = $ipint;
		$t1 = $timestamp - $time;
		$t2 = $timestamp;
		$rs = db::data_count('task_reflow_log', "tid='$tid' and ip='$ip' and status<>'1' and time>='$t1' and time<='$t2'");
		return intval($rs);
	}
	private static function getUserCount($tid, $uid){
		return intval(db::data_count('task_reflow_log', "tid='$tid' and uid='$uid' and status<>'1'"));
	}
	private static function getUserNCount($uid){
		return intval(db::data_count('task_reflow_log', "uid='$uid' and status='0'"));
	}
	public static function in($tid, $uid){
		global $timestamp, $ipint;
		$next = true;
		$rs   = true;
		$task = array();
		if ($next) {
			if ( !($task = self::get($tid)) ) {
				$next = false;
				$rs   = '很抱歉，该任务不存在';
			}
		}
		if ($next) {
			if ($task['suid'] == $uid) {
				$next = false;
				$rs   = '很抱歉，不能接自己的任务！';
			}
		}
		if ($next) {
			if ($task['status'] == 1) {
				if ($task['flowTotal'] > 0) {
					//
				} else {
					$next = false;
					$rs   = '很抱歉，该任务已经全被接手了！';
				}
			} else {
				$next = false;
				$rs   = '很抱歉，不能接手该任务！';
			}
		}
		if ($next) {//检测同时接手数
			if (self::getUserNCount($uid) >= cfg::getInt('reflow', 'buyer_max')) {
				$next = false;
				$rs   = '很抱歉，同时接手任务数为：'.cfg::getInt('reflow', 'buyer_max');
			}
		}
		if ($next) {//来路频率检测
			if ($task['isRate']) {
				$t = self::getLastTime($tid);
				if ($t) {
					if ($timestamp - $t < $task['minute'] * 60) {
						$next = false;
						$rs   = '对不起，您慢了一步，请您接手其他的任务';
					}
				}
			}
		}
		if ($next) {//IP限制检测
			if ($task['isIP']) {
				if (self::getIpCount($tid) >= $task['numIP']) {
					$next = false;
					$rs   = '很抱歉，该任务限制了IP访问次数，请换个IP再接';
				}
			}
		}
		if ($next) {//接手人限制
			if ($task['isLimit']) {
				if (self::getUserCount($tid, $uid) >= $task['numUser']) {
					$next = false;
					$rs   = '很抱歉，该任务限制了用户访问次数，您不能再接手该任务！';
				}
			}
		}
		if ($next) {//可以接了
			$total = 1;
			if (db::update('task_reflow', "flowLock=flowLock+'1',flowTotal=flowTotal-'$total',lastTime='$timestamp'", "id='$tid' and flowTotal>='$total'") && db::changeRows() > 0) {
				if (db::insert('task_reflow_log', array(
					'type'     => self::$taskId,
					'tid'      => $tid,
					'uid'      => $uid,
					'username' => member_base::getUsername($uid),
					'total'    => $total,
					'ip'       => $ipint,
					'time'     => $timestamp,
					'status'   => 0
				))) {
					//接手成功
				} else {
					$next = false;
					$rs   = '很抱歉，接手失败！';
				}
			} else {
				$next = false;
				$rs   = '对不起，您慢了一步，请您接手其他的任务';
			}
		}
		return $rs;
	}
	public static function quit($id, $uid){
		if ($item = db::one('task_reflow_log', '*', "id='$id'")) {
			if ($item['uid'] == $uid) {
				if ($item['status'] == 0) {
					if ( db::update(self::$tb, "flowLock=flowLock-'1',flowTotal=flowTotal+'1'", "id='$item[tid]'") && db::changeRows() > 0 ) {
						db::update('task_reflow_log', array('status' => 1), "id='$id'");
						return true;
					}
					return '很抱歉退出失败，请重试！';
				}
				return '很抱歉，该任务状态已经改变，不能退出！';
			}
			return '很抱歉，该记录不是您接的！';
		}
		return '很抱歉，该记录不存在！';
	}
	public static function check($tid, $lid, $uid, $keys){
		global $timestamp;
		$keys = trim($keys);
		if ($task = self::get($tid)) {
			if ($task['status'] == 2) return '该任务已经被锁定了！';
			if ($item = db::one('task_reflow_log', '*', "id='$lid' and uid='$uid'")) {
				if ($task['id'] == $item['tid']) {
					if ($item['status'] == 0) {
						$checkStatus = false;
						switch ($task['checkType']) {
							case '0':
								$checkRs0 = self::checkUrl($keys);
								$checkRs1 = self::checkUrl($task['itemurl']);
								if (!$checkRs0 || !$checkRs1 || $checkRs0 != $checkRs1) $checkStatus = false;
								else $checkStatus = true;
								//$checkStatus = $keys == $task['itemurl'];
							break;
							case '1':
								$checkStatus = common::formatMoney($keys) == common::formatMoney($task['checkValue']);
							break;
							case '2':
								$checkStatus = $keys == $task['checkValue'];
							break;
						}
						db::update('task_reflow_log', "checkCount=checkCount+'1'", "id='$lid'");
						if ($checkStatus) {
							//验证OK
							db::update('task_reflow_log', array('status' => 2, 'ctime' => $timestamp), "id='$item[id]'");
							db::update('task_reflow', "flowLock=flowLock-'1',flowComplate=flowComplate+'1'", "id='$tid'");
							$task = self::get($tid);
							if ($task['flowLock'] == 0 && $task['flowTotal'] == 0) db::update(sefl::$tb, array('status' => 3, 'ctime' => $timestamp), "id='$tid'");
							return true;
						} else {
							$check_error = cfg::getInt('reflow', 'check_error');
							if ($check_error > 0) {
								/*$t = $timestamp - 20;
								db::update(self::$tb, "errTime='$timestamp',errCount=errCount+'1'", "id='$tid' and (errTime='0' or errTime<'$t')");
								if (db::changeRows() > 0) {
									$task = self::get($tid);
									if ($task['status'] == 1 && $task['errCount'] >= $check_error && $task['flowTotal'] + $item['total'] == $task['flowAll']) {
										//db::update(self::$tb, "status='2'", "id='$tid'");
										self::lock($tid);
									}
								}*/
								db::update(self::$tb, "errTime='$timestamp',errCount=errCount+'1'", "id='$tid'");
							}
							return '验证失败，请检查是否按照提示操作！';
						}
					}
					return '很抱歉，该任务已经完成，请不要重复验证！';
				}
				return '错误！';
			}
			return '很抱歉，该记录不存在！';
		}
		return '很抱歉，该任务不存在！';
	}
	public static function complateCount($uid){
		return intval(db::data_count('task_reflow_log', "uid='$uid' and status='2' and pay='0'"));
	}
	public static function pay($uid){
		$complateCount = self::complateCount($uid);
		$payfor_count  = cfg::getInt('reflow', 'payfor_count');
		if ($complateCount >= $payfor_count) {
			$point = cfg::getMoney('reflow', 'price_pay_one') * $complateCount;
			db::update('task_reflow_log', "pay='1'", "uid='$uid' and status='2' and pay='0'");
			member_base::addFabudian($uid, $point, self::$taskId, '结算了'.$complateCount.'个来路任务');
			return $complateCount;
		}
		return '结算失败，最少完成'.$payfor_count.'个任务才能结算';
	}
	public static function lock($tid){
		global $timestamp;
		db::update(self::$tb, array('status' => 2, 'lockTime' => $timestamp), "id='$tid' and status='1'");
		if (db::changeRows() > 0) return true;
		return false;
	}
	public static function unlock($tid){
		db::update(self::$tb, array('status' => 1, 'errCount' => 0, 'errTime' => 0), "id='$tid' and status='2'");
		if (db::changeRows() > 0) return true;
		return false;
	}
	public static function del($ids){
		is_array($ids) || $ids = array($ids);
		$idsStr = '\''.implode('\',\'', $ids).'\'';
		db::del_ids(self::$tb, $ids);
		db::update('task_reflow_log', "status='2'", "tid in($idsStr) and status='0'");
	}
	public static function isIn($tid, $uid){
		global $timestamp;
		if ($task = self::get($tid)) {
			if ($task['status'] == 1 && $task['flowTotal'] > 0) {
				if ($task['isIP']) {
					if (self::getIpCount($tid) >= $task['numIP']) return false;
					
				}
				if ($task['isLimit']) {
					if (self::getUserCount($tid, $uid) >= $task['numUser']) return false;
				}
				
				if ($task['isRate']) {
					$t = self::getLastTime($tid);
					if ($t) {
						if ($timestamp - $t < $task['rateTime']) {
							return false;
						}
					}
				}
				if ($task['suid'] == $uid) return false;
				return true;
			}
		}
		return false;
	}
}
?>