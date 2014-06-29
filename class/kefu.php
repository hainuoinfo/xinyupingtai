<?php
class kefu{
	private static $tbName1 = 'kefu_cate', $tbName2 = 'kefu', $tbName3 = 'kefu_review';
	public static function addCate($name){
		$datas = array('name' => $name);
		if (!db::exists(self::$tbName1, $datas)) {
			return db::insert(self::$tbName1, $datas);
		} else {
			return false;
		}
	}
	public static function getCateTotal(){
		return db::data_count(self::$tbName1);
	}
	public static function getCates(){
		return db::get_list2(self::$tbName1, '*', '', 'sort');
	}
	public static function delCate($ids){
		!is_array($ids) && $ids = array($ids);
		foreach ($ids as $id) {
			if ($kIds = db::get_ids(self::$tbName2, "cid='$id'")) {
				self::delKefu($kIds);
			}
			db::del_id(self::$tbName1, $id);
		}
	}
	public static function setSort($ids, $sorts){
		$count = count($ids);
		for ($i = 0; $i < $count; $i++) {
			$id   = $ids[$i];
			$sort = $sorts[$i];
			db::update(self::$tbName1, array('sort' => $sort), "id='$id'");
		}
	}
	public static function setKefuSort($ids, $sorts){
		$count = count($ids);
		for ($i = 0; $i < $count; $i++) {
			$id   = $ids[$i];
			$sort = $sorts[$i];
			db::update(self::$tbName2, array('sort' => $sort), "id='$id'");
		}
	}
	public static function getCateName($id){
		return db::one_one(self::$tbName1, 'name', "id='$id'");
	}
	public static function editCate($id, $name){
		db::update(self::$tbName1, array('name' => $name), "id='$id'");
	}
	public static function addKefu($cid, $nickname, $avatar, $qq){
		global $timestamp;
		if (db::insert(self::$tbName2, array('cid' => $cid, 'nickname' => $nickname, 'qq' => $qq, 'avatar' => $avatar, 'timestamp' => $timestamp))) {
			db::update(self::$tbName1, 'members=members+1', "id='$cid'");
		}
	}
	public static function editKefu($id, $nickname, $avatar, $qq){
		global $timestamp;
		if ($kefu = self::getKefu($id)) {
			if ($avatar) {
				@unlink(d('./img/kefu/avatar/'.$kefu['avatar']));
				$datas = array(
					'nickname' => $nickname,
					'avatar'   => $avatar,
					'qq'       => $qq
				);
			} else {
				$datas = array(
					'nickname' => $nickname,
					'qq'       => $qq
				);
			}
			db::update(self::$tbName2, $datas, "id='$id'");
		}
	}
	public static function delKefu($ids){
		!is_array($ids) && $ids = array($ids);
		foreach ($ids as $id) {
			if ($kefu = self::getKefu($id)) {
				if ($kefu['avatar']) {
					@unlink(d('./img/kefu/avatar/'.$kefu['avatar']));
				}
				db::update(self::$tbName1, 'members=members-1', "id='$kefu[cid]'");
			}
			db::del_id(self::$tbName2, $id);
		}
	}
	public static function getKefu($id){
		if ($kefu = db::one(self::$tbName2, '*', "id='$id'")) {
			$mt = time::tsm();//this month time
			$c  = db::one_one(self::$tbName3, 'sum(credit)', "kid='$id' and timestamp>=$mt[start] and timestamp<=$mt[end]");
			$kefu['mcredit']  = (int)$c;
			$kefu['gradeAll'] = $kefu['grade1'] + $kefu['grade2'] + $kefu['grade3'];
			$kefu['fn']       = $kefu['gradeAll'] > 0?$kefu['grade1'] / $kefu['gradeAll']:0;
			return $kefu;
		}
		return false;
	}
	public static function getKefuTotal($cid = 0){
		if ($cid) {
			return db::one_one(self::$tbName1, 'members', "id='$cid'");
		} else {
			return db::one_one(self::$tbName1, 'sum(members)');
		}
	}
	public static function getKefuList($cid, $spage = 0, $spagesize = 0){
		global $page, $pagesize;
		$spage     || $spage     = $page;
		$spagesize || $spagesize = $pagesize;
		return db::get_list2(self::$tbName2, '*', "cid='$cid'", 'sort', $spage, $spagesize);
	}
	public static function alreadyReview($kid, $uid){
		global $timestamp;
		$wt = time::tswk();
		return db::exists(self::$tbName3, "kid='$kid' and (timestamp>=$wt[start] and timestamp<=$wt[end]) and uid='$uid'");
	}
	public static function review($kid, $uid, $grade, $remark, $hide_user = false){
		global $timestamp, $ipint;
		loadLib('member.base');
		if ($kefu = self::getKefu($kid)) {
			if ($memberInfo = member_base::getMemberAll($uid)) {
				if ($memberInfo['attach']['credits'] >= 50) {
					if (!self::alreadyReview($uid)) {
						$cs = array(
							1 => 2,
							2 => 1,
							3 => -3
						);
						$c0 = $c = $cs[$grade];
						$c > 0 && $c = '+'.$c;
						db::update(self::$tbName2, "grade$grade=grade$grade+1,credits=credits$c", "id='$kid'");
						db::insert(self::$tbName3, array(
							'kid'           => $kid,
							'kefu_nickname' => $kefu['nickname'],
							'uid'           => $uid,
							'username'      => $memberInfo['base']['username'],
							'hide_user'     => $hide_user?1:0,
							'type'          => $grade,
							'credit'        => $c0,
							'content'       => $remark,
							'timestamp'     => $timestamp,
							'ip'            => $ipint
						));
						return true;
					}
					return 'already_review';
				}
				return 'credits_error';
			}
			return 'user_not_exists';
		}
		return 'kefu_not_exists';
	}
	public static function getReviewTotal($kid){
		return db::data_count(self::$tbName3, "kid='$kid'");
	}
	public static function getReview($kid, $page = 0, $pagesize = 0){
		$page     || $page     =$GLOBALS['page'];
		$pagesize || $pagesize = $GLOBALS['pagesize'];
		return db::get_list2(self::$tbName3, '*', "kid='$kid'", 'timestamp desc', $page, $pagesize);
	}
}
?>