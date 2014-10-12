<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
class card{
	public static $onePrice = array(), $names = array(
		'', '单次兔粮卡', '流量点卡', '单钻信托卡', '双钻信托卡', '三钻信托卡', '四钻信托卡', '五钻信托卡', '至尊皇冠卡', '24小时双倍积分卡', '双倍积分周卡', '预定任务次卡', '至尊VIP体验卡'
	),$names2 = array('', '单钻信托卡', '双钻信托卡', '三钻信托卡', '四钻信托卡', '五钻信托卡', '至尊皇冠卡');
	public static function buy($uid, $cardType, $nums = 0){
		global $timestamp;
		if ($member = member_base::getMemberAll($uid)) {
			$onePrice = self::$onePrice[$cardType];
			switch ($cardType) {
				case 0:
					//系统奖励 单次兔粮卡
					if ($nums <= 0) return 'buy_count_error';
					db::insert('card', array(
						'type'      => 0,
						'cid'        => $cardType,
						'uid'        => $uid,
						'username'   => $member['base']['username'],
						'money'      => $money,
						'name'       => '来路调查奖励',
						'total1'     => $nums,
						'total2'     => $nums,
						'timestamp1' => $timestamp,
						'timestamp3' => $timestamp + 86400 * 3
					));
					member_base::sendPm($uid, '恭喜您获得系统奖励的'.$nums.'张单次兔粮卡', '网站提醒：系统奖励了'.$nums.'张单次兔粮卡', 'luck');
					member_base::sendSms($uid, '恭喜您获得系统奖励的'.$nums.'张单次兔粮卡', 'luck');
					return true;
				break;
				case 1:
					//单次兔粮卡
					if ($nums <= 0) return 'buy_count_error';
					$money = $onePrice * $nums;
					if ($money > $member['attach']['money']) return 'money_error';
					member_base::addMoney($uid, - $money, '购买'.$nums.'张单次兔粮卡');
					db::insert('card', array(
						'type'      => 1,
						'cid'        => $cardType,
						'uid'        => $uid,
						'username'   => $member['base']['username'],
						'money'      => $money,
						'name'       => '单次兔粮卡',
						'total1'     => $nums,
						'total2'     => $nums,
						'timestamp1' => $timestamp
					));
					member_base::sendPm($uid, '购买了'.$nums.'张兔粮卡', '网站提醒：购买了'.$nums.'张兔粮卡', 'buy_points');
					member_base::sendSms($uid, '购买了'.$nums.'张兔粮卡', 'buy_points');
					return true;
				break;
				case 2:
					//流量点卡
					if ($nums <= 0) return 'buy_count_error';
					$money = $onePrice * $nums;
					if ($money > $member['attach']['money']) return 'money_error';
					member_base::addMoney($uid, - $money, '购买'.$nums.'张流量点卡');
					db::insert('card', array(
						'type'      => 1,
						'cid'        => $cardType,
						'uid'        => $uid,
						'username'   => $member['base']['username'],
						'money'      => $money,
						'name'       => '流量点卡',
						'total1'     => $nums,
						'total2'     => $nums,
						'timestamp1' => $timestamp
					));
					return true;
				break;
				case 3:
					//单钻信托卡
					$nums = 1;
					if ($nums <= 0) return 'buy_count_error';
					$money = $onePrice * $nums;
					if ($money > $member['attach']['money']) return 'money_error';
					member_base::addMoney($uid, - $money, '购买'.$nums.'张单钻信托卡');
					db::insert('card', array(
						'type'      => 1,
						'cid'        => $cardType,
						'uid'        => $uid,
						'username'   => $member['base']['username'],
						'money'      => $money,
						'name'       => '单钻信托卡',
						'total1'     => 251,
						'total2'     => 251,
						'timestamp1' => $timestamp
					));
					return true;
				break;
				case 4:
					//双钻信托卡
					$nums = 1;
					if ($nums <= 0) return 'buy_count_error';
					$money = $onePrice * $nums;
					if ($money > $member['attach']['money']) return 'money_error';
					member_base::addMoney($uid, - $money, '购买'.$nums.'张双钻信托卡');
					db::insert('card', array(
						'type'      => 1,
						'cid'        => $cardType,
						'uid'        => $uid,
						'username'   => $member['base']['username'],
						'money'      => $money,
						'name'       => '双钻信托卡',
						'total1'     => 501,
						'total2'     => 501,
						'timestamp1' => $timestamp
					));
					return true;
				break;
				case 5:
					//三钻信托卡
					$nums = 1;
					if ($nums <= 0) return 'buy_count_error';
					$money = $onePrice * $nums;
					if ($money > $member['attach']['money']) return 'money_error';
					member_base::addMoney($uid, - $money, '购买'.$nums.'张三钻信托卡');
					db::insert('card', array(
						'type'      => 1,
						'cid'        => $cardType,
						'uid'        => $uid,
						'username'   => $member['base']['username'],
						'money'      => $money,
						'name'       => '三钻信托卡',
						'total1'     => 1001,
						'total2'     => 1001,
						'timestamp1' => $timestamp
					));
					return true;
				break;
				case 6:
					//四钻信托卡
					$nums = 1;
					if ($nums <= 0) return 'buy_count_error';
					$money = $onePrice * $nums;
					if ($money > $member['attach']['money']) return 'money_error';
					member_base::addMoney($uid, - $money, '购买'.$nums.'张四钻信托卡');
					db::insert('card', array(
						'type'      => 1,
						'cid'        => $cardType,
						'uid'        => $uid,
						'username'   => $member['base']['username'],
						'money'      => $money,
						'name'       => '四钻信托卡',
						'total1'     => 2001,
						'total2'     => 2001,
						'timestamp1' => $timestamp
					));
					return true;
				break;
				case 7:
					//五钻信托卡
					$nums = 1;
					if ($nums <= 0) return 'buy_count_error';
					$money = $onePrice * $nums;
					if ($money > $member['attach']['money']) return 'money_error';
					member_base::addMoney($uid, - $money, '购买'.$nums.'张五钻信托卡');
					db::insert('card', array(
						'type'      => 1,
						'cid'        => $cardType,
						'uid'        => $uid,
						'username'   => $member['base']['username'],
						'money'      => $money,
						'name'       => '五钻信托卡',
						'total1'     => 5001,
						'total2'     => 5001,
						'timestamp1' => $timestamp
					));
					return true;
				break;
				case 8:
					//至尊皇冠卡
					$nums = 1;
					if ($nums <= 0) return 'buy_count_error';
					$money = $onePrice * $nums;
					if ($money > $member['attach']['money']) return 'money_error';
					member_base::addMoney($uid, - $money, '购买'.$nums.'张至尊皇冠卡');
					db::insert('card', array(
						'type'      => 1,
						'cid'        => $cardType,
						'uid'        => $uid,
						'username'   => $member['base']['username'],
						'money'      => $money,
						'name'       => '至尊皇冠卡',
						'total1'     => 10001,
						'total2'     => 10001,
						'timestamp1' => $timestamp
					));
					return true;
				break;
				case 9:
					//24小时双倍积分卡
					$nums = 1;
					if ($nums <= 0) return 'buy_count_error';
					$money = $onePrice * $nums;
					if ($money > $member['attach']['money']) return 'money_error';
					member_base::addMoney($uid, - $money, '购买'.$nums.'张24小时双倍积分卡');
					db::insert('card', array(
						'type'       => 2,
						'cid'        => $cardType,
						'uid'        => $uid,
						'username'   => $member['base']['username'],
						'money'      => $money,
						'name'       => '24小时双倍积分卡',
						'total1'     => $nums,
						'total2'     => $nums,
						'timestamp1' => $timestamp
					));
					return true;
				break;
				case 10:
					//一周双倍积分卡
					$nums = 1;
					if ($nums <= 0) return 'buy_count_error';
					$money = $onePrice * $nums;
					if ($money > $member['attach']['money']) return 'money_error';
					member_base::addMoney($uid, - $money, '购买'.$nums.'张一周双倍积分卡');
					db::insert('card', array(
						'type'       => 2,
						'cid'        => $cardType,
						'uid'        => $uid,
						'username'   => $member['base']['username'],
						'money'      => $money,
						'name'       => '一周双倍积分卡',
						'total1'     => $nums,
						'total2'     => $nums,
						'timestamp1' => $timestamp
					));
					return true;
				break;
				case 11:
					//预定任务次卡
					if ($nums <= 0) return 'buy_count_error';
					$money = $onePrice * $nums;
					if ($money > $member['attach']['money']) return 'money_error';
					member_base::addMoney($uid, - $money, '购买'.$nums.'张预定任务次卡');
					db::insert('card', array(
						'type'      => 3,
						'cid'        => $cardType,
						'uid'        => $uid,
						'username'   => $member['base']['username'],
						'money'      => $money,
						'name'       => '预定任务次卡',
						'total1'     => $nums,
						'total2'     => $nums,
						'timestamp1' => $timestamp
					));
					return true;
				break;
				case 12:
					//VIP至尊体验卡
					$nums = 1;
					if ($nums <= 0) return 'buy_count_error';
					$money = $onePrice * $nums;
					if ($money > $member['attach']['money']) return 'money_error';
					member_base::addMoney($uid, - $money, '购买'.$nums.'张VIP至尊体验卡');
					db::insert('card', array(
						'type'       => 5,
						'cid'        => $cardType,
						'uid'        => $uid,
						'username'   => $member['base']['username'],
						'money'      => $money,
						'name'       => 'VIP至尊体验卡',
						'total1'     => $nums,
						'total2'     => $nums,
						'timestamp1' => $timestamp
					));
					return true;
				break;
			}
		}
		return 'user_not_exists';
	}
	public static function total($uid, $type, $status = -1, $cid = 0){
		return db::data_count('card', "type='$type'".($cid?" and cid='$cid'":'')." and uid='$uid'".($status!=-1?" and status='$status'":''));
	}
	public static function getList($uid, $type, $order, $page, $pagesize, $status = -1, $cid = 0){
		return db::get_list2('card', '*', "type='$type'".($cid?" and cid='$cid'":'')." and uid='$uid'".($status!=-1?" and status='$status'":''), $order, $page, $pagesize);
	}
	public static function getCard($id){
		$id = (int)$id;
		if ($card = db::one('card', '*', "id='$id'")) {
			return $card;
		}
		return false;
	}
	public static function active($id, $flag = ''){
		global $timestamp;
		$card = self::getCard($id);
		if ($card === false) return 'card_not_exists';
		if ($card['status'] == 1) return 'card_active';
		if ($card['status'] == 2) return 'card_expire';
		switch ($card['cid']) {
			case 0:
				member_base::addFabudian($card['uid'], $card['total1'], $flag, '激活系统奖励兔粮卡');
				db::update('card', array('total2' => 0, 'timestamp2' => $timestamp, 'status' => 1), "id='$id'");
				return true;
			break;
			case 1:
				//单次兔粮卡
				member_base::addFabudian($card['uid'], $card['total1'], $flag, '激活单次兔粮卡');
				db::update('card', array('total2' => 0, 'timestamp2' => $timestamp, 'status' => 1), "id='$id'");
				return true;
			break;
			case 2:
				//流量点卡
				member_base::addLiuliang($card['uid'], $card['total1'], '激活流量卡');
				db::update('card', array('total2' => 0, 'timestamp2' => $timestamp, 'status' => 1), "id='$id'");
				return true;
			break;
			case 3:
				//单钻信托卡
				member_base::addFabudian($card['uid'], $card['total1'], $flag, '激活单钻信托卡');
				db::update('card', array('total2' => 0, 'timestamp2' => $timestamp, 'status' => 1), "id='$id'");
				db::update('memberfields', array('vip2' => 1), "uid='$card[uid]'");
				/*if (!db::one_one('memberfields', 'vip2', "uid='$card[uid]'")) {
					db::update('memberfields', array('vip2' => 1), "uid='$card[uid]'");
				}*/
				return true;
			case 4:
				//双钻信托卡
				member_base::addFabudian($card['uid'], $card['total1'], $flag, '激活双钻信托卡');
				db::update('card', array('total2' => 0, 'timestamp2' => $timestamp, 'status' => 1), "id='$id'");
				db::update('memberfields', array('vip2' => 2), "uid='$card[uid]'");
				/*if (!db::one_one('memberfields', 'vip2', "uid='$card[uid]'")) {
					db::update('memberfields', array('vip2' => 1), "uid='$card[uid]'");
				}*/
				return true;
			break;
			case 5:
				//三钻信托卡
				member_base::addFabudian($card['uid'], $card['total1'], $flag, '激活三钻信托卡');
				db::update('card', array('total2' => 0, 'timestamp2' => $timestamp, 'status' => 1), "id='$id'");
				db::update('memberfields', array('vip2' => 3), "uid='$card[uid]'");
				/*if (!db::one_one('memberfields', 'vip2', "uid='$card[uid]'")) {
					db::update('memberfields', array('vip2' => 1), "uid='$card[uid]'");
				}*/
				return true;
			break;
			case 6:
				//四钻信托卡
				member_base::addFabudian($card['uid'], $card['total1'], $flag, '激活四钻信托卡');
				db::update('card', array('total2' => 0, 'timestamp2' => $timestamp, 'status' => 1), "id='$id'");
				db::update('memberfields', array('vip2' => 4), "uid='$card[uid]'");
				/*if (!db::one_one('memberfields', 'vip2', "uid='$card[uid]'")) {
					db::update('memberfields', array('vip2' => 1), "uid='$card[uid]'");
				}*/
				return true;
			break;
			case 7:
				//五钻信托卡
				member_base::addFabudian($card['uid'], $card['total1'], $flag, '激活五钻信托卡');
				db::update('card', array('total2' => 0, 'timestamp2' => $timestamp, 'status' => 1), "id='$id'");
				db::update('memberfields', array('vip2' => 5), "uid='$card[uid]'");
				/*if (!db::one_one('memberfields', 'vip2', "uid='$card[uid]'")) {
					db::update('memberfields', array('vip2' => 1), "uid='$card[uid]'");
				}*/
				return true;
			break;
			case 8:
				//至尊皇冠卡
				member_base::addFabudian($card['uid'], $card['total1'], $flag, '激活至尊皇冠卡');
				db::update('card', array('total2' => 0, 'timestamp2' => $timestamp, 'status' => 1), "id='$id'");
				db::update('memberfields', array('vip2' => 6), "uid='$card[uid]'");
				/*if (!db::one_one('memberfields', 'vip2', "uid='$card[uid]'")) {
					db::update('memberfields', array('vip2' => 1), "uid='$card[uid]'");
				}*/
				return true;
			break;
			case 9:
				//24小时双倍积分卡
				if (!db::exists('card', "(cid='9' or cid='10') and status='1'")) {
					db::update('card', array('total2' => 0, 'timestamp2' => $timestamp, 'timestamp3' => $timestamp + 86400, 'status' => 1), "id='$id'");
					db::update('memberfields', array('double_credit' => $id), "uid='$card[uid]'");
					return true;
				}
				return 'card_double_credit_no_expire';
			break;
			case 10:
				//一周双倍积分卡
				if (!db::exists('card', "(cid='9' or cid='10') and uid='$card[uid]' and status='1'")) {
					db::update('card', array('total2' => 0, 'timestamp2' => $timestamp, 'timestamp3' => $timestamp + 86400 * 7, 'status' => 1), "id='$id'");
					db::update('memberfields', array('double_credit' => $id), "uid='$card[uid]'");
					return true;
				}
				return 'card_double_credit_no_expire';
			break;
			case 11:
				//预定任务次卡
				if (!db::exists('card', "cid='11' and uid='$card[uid]' and status='1' and total2>0")) {
					db::update('card', array('timestamp2' => $timestamp, 'status' => 1), "id='$id'");
					return true;
				}
				return 'card_yuding_no_expire';
			break;
			case 12:
				//VIP至尊体验卡
				if (!member_base::isVip($card['uid'])) {
					db::update('card', array('timestamp2' => $timestamp, 'timestamp3' => $timestamp + 86400 * 3, 'status' => 1), "id='$id'");
					db::update('memberfields', array('vip' => 1), "uid='$card[uid]'");
					return true;
				}
				return 'card_is_vip';
			break;
		}
	}
}
card::$onePrice = array(
		0, 
		cfg::getMoney('card', 'card1'), 
		cfg::getMoney('card', 'card2'), 
		cfg::getMoney('card', 'card3'), 
		cfg::getMoney('card', 'card4'), 
		cfg::getMoney('card', 'card5'), 
		cfg::getMoney('card', 'card6'), 
		cfg::getMoney('card', 'card7'), 
		cfg::getMoney('card', 'card8'), 
		cfg::getMoney('card', 'card9'), 
		cfg::getMoney('card', 'card10'), 
		cfg::getMoney('card', 'card11'), 
		cfg::getMoney('card', 'card12')
	);
?>