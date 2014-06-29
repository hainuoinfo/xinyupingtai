<?php
class task_base{
	public static function _get($id){
		/*$cacheName = __CLASS__.'_task_'.$id;
		$rs = memory::getClass($cacheName);
		if (!isset($rs)) {
			$rs = db::one('task', '*', "id='$id'");
		}
		return $rs;*/
		return db::one('task', '*', "id='$id'");
	}
	public static function tieBuyer($tid, $bid, $uid) {
		global $timestamp, $today_start, $today_end, $tswkStart, $tswkEnd, $tskStart, $tsmEnd, $isVip;
		if ($tid && $bid && $uid) {
			if ($buyer = task_buyer::getBuyer($bid, $uid)) {
				if ($task = self::_get($tid)) {
					if ($task['status'] != 2) return '该任务已经绑定过了买号';
					if ($task['buid'] == $uid) {
						if ($task['type'] == $buyer['type'] || (in_array($task['type'], array(4, 5, 6)) && $buyer['type'] == 1)) {
							if (in_array($buyer['status'], array(0, 1))) {
								//if ($task['svip'] && !in_array($task['type'], array(6))) {//会员功能
								if (!in_array($task['type'], array(6))) {//非会员功能
									/*$t1 = $today_start - 13 * 86400;
									$t2 = $today_end;
									$inCount = db::data_count('task', "sid='$task[sid]' and bid='$bid' and (btimestamp>=$t1 and btimestamp<=$t2)");
									if ($inCount >0) return '对不起，同一买号，14天之内只能接手同一卖家一次任务';*/
									$t1 = $today_start - 14 * 86400;
									$t2 = $today_end;
									$inCount = db::data_count('task', "sid='$task[sid]' and itemid='$task[itemid]' and bid='$bid' and (btimestamp>=$t1 and btimestamp<=$t2)");
									if ($inCount >0) return '对不起，同一个小号一个任务宝贝在15天只能接手一次';
									
									$t1 = $today_start - 29 * 86400;
									$t2 = $today_end;
									$inCount = db::data_count('task', "sid='$task[sid]' and bid='$bid' and (btimestamp>=$t1 and btimestamp<=$t2)");
									if ($inCount > 6) return '对不起，同一个小号30天内只能接手同一个卖家店铺不大于6个宝贝';
								}
								if ($task['isStar']) {
									//$levelFunc = 'getLevel'.$buyer['type'];
									//if ($task['lvlStar'] != task_buyer::$levelFunc($buyer['score'])) return '对不起，该任务需要'.$task['lvlStar'].'星小号才能接手';
									if ($task['lvlStar'] != $buyer['level']) return '对不起，该任务需要'.$task['lvlStar'].'星小号才能接手';
									$__list = array();
									foreach (explode(';', cfg::get('sys', 'buyer_level_count')) as $__v) {
										$__sp = explode(':', $__v);
										$__list[$__sp[0]] = $__sp[1];
									}
									$__sp = explode(',', $__list[$buyer['level']]);
									$__buyer = task_buyer::getFull($buyer['id']);
									if ($__buyer['tsmTask'] >= $__sp[2]) return '对不起，'.$buyer['level'].'星买号一月只能接手'.$__sp[2].'个任务！';
									if ($__buyer['tswkTask'] >= $__sp[1]) return '对不起，'.$buyer['level'].'星买号一周只能接手'.$__sp[1].'个任务！';
									if ($__buyer['todayTask'] >= $__sp[0]) return '对不起，'.$buyer['level'].'星买号一天只能接手'.$__sp[0].'个任务！';
								}
								if ($task['type'] == 4) {
									$minScore = -1;
								} else {
									$minScore = -1;//原来为12
								}
								if ($buyer['score'] > $minScore) {
									if ($task['isReal'] && $buyer['isreal'] != 1) return '很抱歉，该任务需要实名认证的小号才能接手';
									if ($task['isReal']) {
										if ($task['realname'] == 1) {
											//普通实名
											if (!$buyer['isreal']) return '很抱歉，该任务需要实名认证的小号才能接手';
										} else {
											//掌柜
											if (!$buyer['isreal'] || !$buyer['hasShop']) return '很抱歉，该任务需要淘宝掌柜号才能接手';
										}
									}
									if ($task['isFame'] && $buyer['score'] >= $task['fameLvl']) return '很抱歉，该任务需要积分小于'.$task['fameLvl'].'的买号才能接手';
									if ($task['isBuyerHyper'] && $buyer['score'] < $task['buyerHyper']) return '很抱歉，该任务需要积分大于'.$task['BuyerHyper'].'的买号才能接手';
									if ($task['isExpress']) {
										if (!db::exists('express_buyers', array('bid' => $buyer['id'], 'eid' => $task['expressTM']))) return '很抱歉，该任务为真实快递任务，您选择的接手小号没有绑定'.$task['expressName'].'收货地址';
									}
									db::update('task', array(
										'bid'        => $bid,
										'bnickname'  => $buyer['nickname'],
										'ttimestamp' => $task['isVerify']?0:$timestamp + 900,//时间为15分钟
										'status'     => $task['isVerify']?3:4
									), "id='$tid'");
									db::update('buyers', 'tasking=tasking+1', "id='$buyer[id]'");
									return true;
								}
								return '很抱歉，买号信誉必须大于'.$minScore.'才能接任务';
							}
							return '很抱歉，您不能用该小号接任务';
						}
						return '很抱歉，该买号和任务对应的区域不一致';
					}
					return '很抱歉，该任务不是您接手的，请检查是否已经超时';
				}
				return '很抱歉，不存在该任务';
			}
			return '很抱歉，不存在该买号';
		}
		return 'data_error';
	}
	public static function confirmExpress($tid, $uid){
		if ($task = self::_get($tid)) {
			if ($task['suid'] == $uid) {
				if ($task['status'] == 5) {
					db::update('task', array('status' => 6), "id='$tid'");
					return true;
				}
				return '该任务已经确认过了';
			}
			return '很抱歉，该任务不是您发布的';
		}
		return '很抱歉，不存在该任务';
	}
	public static function addLog($tid, $title, $message){
		global $timestamp;
		if ($task = self::_get($tid)) {
			$message = preg_replace('/\{(\w+)\}/e', '$task[\'$1\']', $message);
			db::insert('task_log', array(
				'tid'       => $tid,
				'uid'       => $task['suid'],
				'isBuyer'   => 0,
				'title'     => $title,
				'message'   => $message,
				'timestamp' => $timestamp
			));
			if ($task['buid']) {
				db::insert('task_log', array(
					'tid'       => $tid,
					'uid'       => $task['buid'],
					'isBuyer'   => 1,
					'title'     => $title,
					'message'   => $message,
					'timestamp' => $timestamp
				));
			}
		}
	}
}
?>