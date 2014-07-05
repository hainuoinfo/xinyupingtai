<?php
!defined('IN_JB') && exit('error');
loadLib('member.base');
class msg{
	private static $tbName = 'msg';
	public static function send($from_uid, $to_uid, $title, $message, $type = 0, $save = false){
		global $timestamp;
		if ($type == 0) {
			//type = 0 用户消息 type = 1系统消息 type = 2 保存消息
			if (!($from_username = member_base::getUsername($from_uid))) return 'from_user_not_exists';
			if (!($to_username = member_base::getUsername($to_uid))) return 'to_user_not_exists';
			if ($from_uid == $to_uid) return 'msg_not_self';
			//member_base::sendPm($ensure['fuid'], '维权任务'.$ensure['tid'].'失败', '维权结果', 'getpm');
			member_base::sendSms($to_uid, '收到用户：'.$from_username.'的新消息：'.$message, 'getpm');
		} else {
			$to_username = member_base::getUsername($to_uid);
		}
		$title = common::cutstr($title, 64);
		$datas = array(
			'type'          => $type,
			'from_uid'      => $from_uid,
			'from_username' => $from_username,
			'to_uid'        => $to_uid,
			'to_username'   => $to_username,
			'read'          => 0,
			'title'         => $title,
			'message'       => $message,
			'timestamp'     => $timestamp
		);
		if ($rs = db::insert(self::$tbName, $datas)) {
			if ($save) {
				$datas['type'] = 2;
				db::insert(self::$tbName, $datas);
			}
			member_base::setMsgCount($to_uid);
		}
		return $rs;
	}
	public static function send0($to_uid, $title, $message, $save = false){
		global $uid;
		return self::send($uid, $to_uid, $title, $message, 0, $save);
	}
	public static function sendForm(){
		@extract(form::get('username', 'title', 'message', 'isSave'));
		$to_uid = member_base::getUid($username);
		return self::send0($to_uid, $title, $message, $isSave);
	}
	public static function sendSys($uid, $message, $title = ''){
		global $web_name;
		$title || $title = $web_name.'提醒您';
		return self::send(0, $uid, $title, $message, 1, false);
	}
	public static function getCount0($type = 0, $msgType = 'to', $uid_ = 0){
		global $uid;
		$uid_ || $uid_ = $uid;
		return db::data_count(self::$tbName, "type='$type' and {$msgType}_uid='$uid_'");
	}
	public static function getCount($type = 0, $msgType = 'to', $uid_ = 0){
		global $uid;
		$uid_ || $uid_ = $uid;
		return db::data_count(self::$tbName, "type='$type' and {$msgType}_uid='$uid_' and `read`='0'");
	}
	public static function getList($type = 0, $msgType = 'to', $uid_ = 0, $spage = 0, $spagesize = 0){
		global $uid, $page, $pagesize;
		$uid_ || $uid_ = $uid;
		$spage     || $spage = $page;
		$spagesize || $spagesize = $pagesize;
		return db::get_list2(self::$tbName, 'id,from_uid,from_username,to_uid,to_username,`read`,title,timestamp', "type='$type' and {$msgType}_uid='$uid_'", '`read`,timestamp desc', $spage, $spagesize);
	}
	//*1
	private static function setRead_($type, $uid, $id, $read, $msgType = 'to'){
		if (db::exists(self::$tbName, array('type' => $type, $msgType.'_uid' => $uid, 'read' => $read?0:1, 'id' => $id))) {
			db::update(self::$tbName, array('read' => $read?1:0), "id='$id'");
			member_base::setMsgCount($uid, $read?-1:1);
			return true;
		}
		return false;
	}
	public static function setRead($ids, $type = 0, $read = true, $msgType = 'to', $uid_ = 0){
		//设置短信已读
		global $uid;
		$uid_ || $uid_ = $uid;
		$i = 0;
		if (!is_array($ids)) {
			$sp = explode(',', $ids);
			$ids = array();
			foreach ($sp as $id) {
				if (is_numeric($id)) {
					$ids[] = $id;
				}
			}
			foreach ($ids as $id) {
				if (self::setRead_($type, $uid_, $id, $read, $msgType)) $i++;
			}
		}
		return $i;
	}
	public static function setReadAll($type = 0, $read = true, $msgType = 'to', $uid_ = 0){
		global $db, $pre, $uid;
		$uid_ || $uid_ = $uid;
		$query = $db->query("select id from {$pre}msg where type='$type' and {$msgType}_uid='$uid' and `read`='".($read?0:1)."'");
		while ($id = $db->fetch_array_first($query)) {
			self::setRead_($type, $uid_, $id, $read, $msgType);
		}
	}
	//删除开始
	public static function del($id, $msgType = 'to'){
		if ($msgType == 'to') {
			if ($item = db::one(self::$tbName, 'to_uid,`read`', "id='$id'")) {
				if (!$item['read']) member_base::setMsgCount($item['to_uid'], -1);
				db::del_id(self::$tbName, $id);
				return true;
			}
		} else {
			return db::del_id(self::$tbName, $id);
		}
		return false;
	}
	public static function delIds($ids, $msgType = 'to', $uid = 0){
		$uid || $uid = $GLOBALS['uid'];
		$i = 0;
		if ($uid) {
			if (!is_array($ids)) {
				$sp = explode(',', $ids);
				$ids = array();
				foreach ($sp as $id) {
					if (is_numeric($id)) {
						$ids[] = $id;
					}
				}
			}
			foreach ($ids as $id) {
				if (db::exists(self::$tbName, array('id' => $id, $msgType.'_uid' => $uid))){
					if (self::del($id)) $i++;
				}
			}
		}
		return $i;
	}
	public static function delAll($type = 0, $msgType = 'to', $uid_ = 0){
		global $db, $pre, $uid;
		$uid_ || $uid_ = $uid;
		$query = $db->query("select id from {$pre}msg where type='$type' and {$msgType}_uid='$uid_'");
		while ($id = $db->fetch_array_first($query)) {
			self::del($id);
		}
	}
	public static function get($id, $msgType = 'to', $uid_ = 0){
		global $uid;
		$uid_ || $uid_ = $uid;
		if ($item = db::one(self::$tbName, '*', "id='$id'")) {
			//if ($item[$msgType.'_uid'] == $uid_) {
			if ($item['to_uid'] == $uid_ || $item['from_uid'] == $uid_) {
				if ($msgType == 'to' && !$item['read']) {
					self::setRead_($item['type'], $item[$msgType.'_uid'], $item['id'], true, $msgType);
				}
				return $item;
			}
			return 'user_error';
		}
		return 'message_not_exists';
	}
}
?>