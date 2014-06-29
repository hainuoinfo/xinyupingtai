<?php
class task_club{
	public static function create($uid, $name, $ico, $remark, $password){
		global $timestamp;
		$next = true;
		if ($next) {
			if (db::exists('club', array('uid' => $uid))) {
				$next = false;
				$rs = '对不起，您已经创建过门派了';
			}
		}
		if ($next) {
			if ($name && $remark && $password) {
				$name     = common::cutstr($name, 16);
				$password = common::cutstr($password, 32);
			} else {
				$rs = 'data_error';
				$next = false;
			}
		}
		if ($next) {
			if ($next) {
				$savePath = d('./img/club/');
				$savePath2 = date('Y/m/', $timestamp);
				$img = image::getImage($ico, $savePath.$savePath2, 195, 146);
				if ($img !== false) {
					$img = $savePath2.$img;
				} else {
					$rs = '上传门派图片失败';
					$next = false;
				}
			}
		}
		if ($next) {
			if ($clubId = db::insert('club', array(
				'uid'       => $uid,
				'name'      => $name,
				'ico'       => $img,
				'remark'    => $remark,
				'password'  => $password,
				'users'     => 0,
				'timestamp' => $timestamp,
				'status'    => 0
			), true)) {
				self::sys_quit($uid);
				self::joinClub($clubId, $uid);
				$rs = true;
			} else {
				$rs = 'insert_error';
			}
		}
		return $rs;
	}
	public static function joinClub($id, $uid) {
		if (db::one_one('memberfields', 'club', "uid='$uid'") == 0) {
			db::update('club', 'users=users+1', "id='$id'");
			db::update('memberfields', "club='$id'", "uid='$uid'");
			return true;
		}
		return false;
	}
	public static function isJoin($uid) {
		return db::exists('memberfields', "uid='$uid' and club>0");
	}
	public static function goJoin($cid, $uid, $password){
		if (self::isJoin($uid)) return '已经加入过了，请先退出已加入的门派';
		if ($club = self::get2($cid)) {
			if ($password == $club['password']){
				db::update('memberfields', "club='$cid'", "uid='$uid'");
				db::update('club', 'users=users+1', "id='$cid'");
				return true;
			}
			return '门派通行证不正确';
		}
		return '不存在该门派';
	}
	public static function quit($uid, $cid){
		if (db::exists('memberfields', "uid='$uid' and club='$cid'")) {
			db::update('memberfields', "club='0'", "uid='$uid'");
			db::update('club', "users=users-1", "id='$cid'");
			return true;
		}
		return false;
	}
	public static function sys_quit($uid) {
		$club = db::one_one('memberfields', 'club', "uid='$uid'");
		if ($club > 0) {
			db::update('club', 'users=users-1', "id='$club'");
			db::update('memberfields', "club='0'", "uid='$uid'");
			return true;
		}
		return false;
	}
	public static function isCreate($uid) {
		return db::exists('club', "uid='$uid'");
	}
	public static function get($uid){
		global $db, $pre;
		if ($club = $db->fetch_first("select t1.username,t2.credits,t3.* from {$pre}members t1 left join {$pre}memberfields t2 on t2.uid=t1.id left join {$pre}club t3 on t3.id=t2.club where t1.id='$uid' and club>0")) {
			$club['fLevel'] = member_credit::getLevel($club['credits']);
			return $club;
		}
		return false;
	}
	public static function get2($id){
		return db::one('club', '*', "id='$id' and status='1'");
	}
	public static function verify($id){
		db::update('club', 'status=\'1\'', "id='$id'");
	}
	public static function getClubCount(){
		return db::data_count('club', "status='1'");
	}
	public static function getList($spage = 0, $spagesize = 0){
		global $page, $pagesize, $db, $pre;
		$spage     || $spage     = $page;
		$spagesize || $spagesize = $pagesize;
		//return db::get_list('club', '*', "status='1'", 'timestamp desc', $spage, $spagesize);
		$list = array();
		$query = $db->query("select t1.*,t2.username,t2.qq,t3.credits,t3.vip,t3.vip2,t3.isEnsure from {$pre}club t1 left join {$pre}members t2 on t2.id=t1.uid left join {$pre}memberfields t3 on t3.uid=t2.id where t1.status='1' order by t1.timestamp desc limit ".($spage - 1) * $spagesize.','.$spagesize);
		while ($line = $db->fetch_array($query)) {
			$line['fLevel'] = member_credit::getLevel($line['credits']);
			$list[] = $line;
		}
		return $list;
	}
}
?>