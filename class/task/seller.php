<?php
class task_seller{
	public static function getSeller($id, $uid_ = 0){
		global $uid;
		$uid_ || $uid_ = $uid;
		return db::one('sellers', '*', "id='$id' and uid='$uid_'");
	}
	public static function getSellers($uid, $status = '', $type = 1){
		return db::get_list2('sellers', '*', "type='$type' and uid='$uid'".($status?" and status='$status'":''));
	}
	public static function exists($type, $uid, $nickname){
		return db::exists('sellers',array('type' => $type, 'uid' => $uid, 'nickname' => $nickname));
	}
	public static function getSeller2($type, $nickname, $uid) {
		$seller = db::one('sellers', '*', "type='$type' and nickname='$nickname'");
		if ($seller && $seller['uid'] == $uid) return $seller;
		return false;
	}
	public static function setTruth($id, $truth, $uid_ = 0){
		global $uid;
		$uid_ || $uid_ = $uid;
		$rs = db::update('sellers', array('truth' => $truth), "id='$id' and uid='$uid_'");
		if ($rs) return true;
		return 'set_error';
	}
	public static function updateExpress($id, $uid){
		global $db, $pre;
		if (db::exists('sellers', array('id' => $id, 'uid' => $uid))) {
			$names = '';
			$query = $db->query("select eid from {$pre}express_sellers where sid='$id' and uid='$uid'");
			while ($eid = $db->fetch_array_first($query)) {
				$names && $names.=',';
				$names .= db::one_one('express', 'name', "id='$eid'");
			}
			db::update('sellers', array('express' => $names), "id='$id'");
		}
	}
	public static function setAddress($sid, $eid, $area, $address, $nickName, $mobilephone, $uid){
		global $timestamp;
		$addr = self::getAddress($sid, $eid, $uid);
		if ($addr) {
			if (db::update('express_sellers', array(
				'area'        => $area,
				'address'     => $address,
				'nickname'    => $nickName,
				'mobilephone' => $mobilephone,
				'timestamp'   => $timestamp
			), "id='$addr[id]'")) {
				self::updateExpress($sid, $uid);
				return true;
			}
			return 'update_error';

		} else {
			if ($id = db::insert('express_sellers', array(
				'sid'         => $sid,
				'eid'         => $eid,
				'uid'         => $uid,
				'username'    => member_base::getUsername($uid_),
				'area'        => $area,
				'address'     => $address,
				'nickname'    => $nickName,
				'mobilephone' => $mobilephone,
				'timestamp'   => $timestamp
			), true)) {
				self::updateExpress($sid, $uid);
				return true;
			}
			return 'insert_error';
		}
	}
	public static function getAddress($sid, $eid, $uid) {
		return db::one('express_sellers', '*', "sid='$sid' and eid='$eid' and uid='$uid'");
	}
	public static function addComplate($id){
		db::update('sellers', 'task=task+1,tasking=tasking-1', "id='$id'");
	}
	public static function getExpress($sid, $eid){
		return db::one('express_sellers', '*', "sid='$sid' and eid='$eid'");
	}
	public static function del($id, $uid){
		global $timestamp;
		if ($Seller = self::getSeller($id, $uid)) {
			if ($buyer['tasking'] == 0) {
				db::delete('Sellers', "id='$id' and uid='$uid'");
				return true;
			}
			return '该掌柜目前还有任务没有完成，请完成后再删除';
		}
		return '不存在该掌柜号';
	}
}
?>