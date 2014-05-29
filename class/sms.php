<?php
!defined('IN_JB') && exit('error');
loadLib('member.base');
class sms{
	private static $tbName = 'sms';
	public static function onePrice($uid) {
		global $msg_price, $msg_vip_price;
		$vip = false;
		if ($vip) return $msg_price;
		return $msg_vip_price;
	}
	public static function sendPhone($phone, $message, $uid_ = 0){
		global $uid, $msg_user_price, $msg_vip_price, $timestamp;
		$uid_ || $uid_ = $uid;
		if (form::check_mobilephone($phone)) {
			$vip = false;
			$memberFields = member_base::getMemberFields($uid_);
			if ($vip) {
				$onePrice = $msg_vip_price;
			} else {
				$onePrice = $msg_user_price;
			}
			$money = message::howMuch($message, $onePrice);
			if ($memberFields['money'] >= $money) {
				$rs = message::send($phone, $message, true);
				if (is_array($rs)) {
					if ($count = $rs['complate']) {
						$money = $onePrice * $count;
						member_base::addMoney($uid_, - $money, '发送了'.$count.'条短信');
						foreach ($rs['list'][$phone] as $msg) {
							db::insert(self::$tbName, array(
								'uid'       => $uid_,
								'phone'     => $phone,
								'message'   => $msg,
								'timestamp' => $timestamp
							));
						}
						return $count;
					}
				}
				return 'send_error';
			}
			return 'money_error';
		}
		return 'mobilephone_error';
	}
	public static function sendUser($id, $message, $uid_ = 0){
		global $uid;
		$uid_ || $uid_ = $uid;
		if (preg_match('/^[A-Za-z\x{4E00}-\x{9FA5}]{1}[A-Za-z0-9\x{4E00}-\x{9FA5}._-]{2,16}$/u', $id)) {
			if ($uid0 = member_base::getUid($id)) {
				$member = member_base::getMember($uid0);
				$phone = $member['mobilephone'];
			} else {
				return 'user_not_exists';
			}
		} else {
			$phone = $id;
		}
		return self::sendPhone($phone, $message, $uid_);
	}
	public static function getTotal($uid_ = 0){
		global $uid;
		$uid_ || $uid_ = $uid;
		return db::data_count(self::$tbName, "uid='$uid_'");
	}
	public static function getList($uid_ = 0, $spage = 0, $spagesize = 0){
		global $uid, $page, $pagesize;
		$uid_ || $uid_ = $uid;
		$spage || $spage = $page;
		$spagesize || $spagesize = $pagesize;
		return db::get_list2(self::$tbName, '*', "uid='$uid_'", 'timestamp desc', $spage, $spagesize);
	}
	public static function del_($id, $uid){
		if (db::exists(self::$tbName, array('id' => $id, 'uid' => $uid))) {
			db::del_id(self::$tbName, $id);
			return true;
		}
		return false;
	}
	public static function del($ids, $uid_ = 0){
		global $uid;
		$uid_ || $uid_ = $uid;
		$id = 0;
		if (!is_array($ids)) {
			$sp = explode(',', $ids);
			$ids = array();
			foreach ($sp as $v) {
				if (is_numeric($v)) $ids[] = $v;
			}
		}
		foreach ($ids as $id) {
			if (self::del_($id, $uid_)) $i++;
		}
		return $i;
	}
}
?>