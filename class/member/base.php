<?php
!defined('IN_JB') && exit('error');
class member_base{
	private static $tbName = 'members';
	private static $cachePrefix = 'member_base_cache_update_';
	public static function upCache(){
		global $tswkStart;
		$t = $tswkStart;
		$cacheName = self::$cachePrefix.'spread';
		$arr = cache::get_array($cacheName, true);
		if (!$arr || $arr['lasttime'] != $t) $update = true;
		else $update = false;
		if ($update) {
			$loak = new lock(1, 30, false, 0, __FILE__);
			if (!$lock->islock) {
				db::update('members', 'childMonth=0,monthCount=monthCount+1');
				cache::write_array($cacheName, array('lasttime' => $t));
			}
		}
	}
	public static function memberExists($username){
		return db::exists(self::$tbName, array('username' => $username));
	}
	public static function memberIdExists($uid){
		return db::exists(self::$tbName, array('id' => $uid));
	}
	public static function getUid($username){
		($uid = db::one_one(self::$tbName, 'id', "username='$username'")) || $uid = 0;
		return $uid;
	}
	public static function getMoney($uid){
		return db::one_one('memberfields', 'money', "uid='$uid'");
	}
	public static function getPoint($uid, $type = 1){
		$point = db::one_one('memberfields', 'fabudian'.$type, "uid='$uid'");
		if ($point) return common::formatMoney($point);
		return 0;
	}
	public static function isSys($uid){
		return db::exists(self::$tbName, array('id' => $uid, 'sys' => 1));
	}
	public static function checkMemberData(&$datas){
		global $questions, $userGroups;
		if (is_array($datas)) {
			if ($datas['username'] && $datas['password'] && $datas['password2'] && $datas['truename'] && $datas['qq'] && $datas['email'] && $datas['mobilephone'] && $datas['sex']) {
				!$datas['groupid'] && $datas['groupid'] = 11;
				if (!preg_match('/^[A-Za-z\x{4E00}-\x{9FA5}]{1}[A-Za-z0-9\x{4E00}-\x{9FA5}._-]{2,16}$/u', $datas['username'])) {
					return 'username_error';
				} else {
					if (self::memberExists($datas['username'])) return 'username_exists';
				}
				if (!preg_match('/^.{6,20}$/', $datas['password'])) return 'password_error';
				if (!preg_match('/^.{6,20}$/', $datas['password2'])) return 'password2_error';
				if (!preg_match('/^[\x{4E00}-\x{9FA5}]{2,4}$/u', $datas['truename'])) return 'truename_error';
				if (!form::check_qq($datas['qq'])) return 'qq_error';
				if (!form::check_email($datas['email'])) return 'email_error';
				if (!form::check_mobilephone($datas['mobilephone'])) return 'mobilephone_error';
				
				if (db::exists(self::$tbName, array('qq'          => $datas['qq'])))                   return 'qq_exists';
				if (db::exists(self::$tbName, array('email'       => $datas['email'])))       return 'email_exists';
				if (db::exists(self::$tbName, array('mobilephone' => $datas['mobilephone']))) return 'mobilephone_exists';
				$datas['sex'] = intval($datas['sex']);
				$datas['sex'] > 2 && $datas['sex'] = 1;
				$datas['parent'] && $datas['parent'] = self::getUid($datas['parent']);
				if ($datas['questionid'] && $datas['answer']) {
					if (!$questions[$datas['questionid']]) {
						$datas['questionid'] = 0;
						$datas['answer']     = 0;
					}
				} else {
					$datas['questionid'] = 0;
					$datas['answer']     = '';
				}
				return true;
			} else return 'data_error';
		} else return 'data_error';
	}
	//public static function add($username, $password, $password2, $truename, $qq, $email, $mobilephone, $sex, $address, $parent){
	public static function add($datas){
		global $timestamp, $ipint;
		$rs = self::checkMemberData($datas);
		if ($rs === true) {
			$datas = array_merge($datas, array(
				'salt'                 => common::salt(),
				'reg_timestamp'        => $timestamp,
				'reg_ip'               => $ipint,
				'last_login_timestamp' => $timestamp,
				'last_login_ip'        => $ipint
			));
			$datas['password'] = common::salt_pwd($datas['salt'], $datas['password']);
			$datas['password2'] = common::salt_pwd($datas['salt'], $datas['password2']);
			if ($rs = db::insert(self::$tbName, $datas, true)) {
				if ($datas['parent'] > 0) {
					db::update(self::$tbName, 'child1=child1+1', "id='$datas[parent]'");
					member_base::sendPm($datas['parent'], '用户：'.$datas['username'].'通过您的推广注册成功', '推广注册', 'rmd_reg');
					member_base::sendSms($datas['parent'], '用户：'.$datas['username'].'通过您的推广注册成功', 'rmd_reg');
				}
				db::update('user_groups', 'users=users+1', "id='$datas[groupid]'");
				db::insert('memberfields', array(
					'uid'     => $rs,
					'credits' => 0,
					'money'   => 0,
					'tyroTaskAll' => db::data_count('cms_tyrotask')
				));
				db::insert('memberconfigs', array(
					'uid' => $rs
				));
				db::insert('membertask', array(
					'uid' => $rs
				));
				db::insert('top_credit', array(
					'uid' => $rs
				));
				db::insert('top_buyer', array(
					'uid' => $rs
				));
				db::insert('top_seller', array(
					'uid' => $rs
				));
				db::insert('top_spread', array(
					'uid' => $rs
				));
				self::setDefConfig($rs);
				return $rs;
			} else {
				return 'insert_error';
			}
		} else {
			return $rs;
		}
	}
	public static function setConfig($uid, $configs){
		if (db::update('memberconfigs', $configs, "uid='$uid'")) {
			return true;
		}
		return 'update_error';
	}
	public static function setDefConfig($uid_ = 0) {
		global $uid;
		$uid_ || $uid_ = $uid;
		$arr = array('out_take' => 1, 'out_pay' => 0, 'out_receive' => 0, 'out_comment' => 1, 'out_to_grade' => 1, 'out_complain' => 1, 'out_grade' => 1, 'in_verify' => 1, 'in_send' => 1, 'in_confirm' => 1, 'in_to_grade' => 1, 'acc_high' => 1, 'acc_ban' => 1, 'in_book' => 1, 'in_grade' => 1, 'complain' => 1, 'complain_end' => 1, 'ensure' => 1, 'ensure_end' => 1, 'black' => 1, 'credit' => 1, 'score' => 1, 'remit' => 1, 'remit_fail' => 1, 'payment_app' => 1, 'payment' => 1, 'buy_points' => 0, 'score_points' => 0, 'points_gold' => 1, 'luck' => 1, 'rmd_bonus' => 0, 'rmd_reg' => 1, 'post_reply' => 0, 'post_move' => 1, 'post_del' => 1, 'getpm' => 0, 'lock' => 1, 'ban' => 1, 'vip_end' => 1, 'mod_per' => 1);
		return self::setConfig($uid_, $arr);
	}
	public static function setFormConfig($uid_ = 0){
		global $uid;
		$uid_ || $uid_ = $uid;
		$args = array('out_take', 'out_pay', 'out_receive', 'out_comment', 'out_to_grade', 'out_complain', 'out_grade', 'in_verify', 'in_send', 'in_confirm', 'in_to_grade', 'acc_high', 'acc_ban', 'in_book', 'in_grade', 'complain', 'complain_end', 'ensure', 'ensure_end', 'black', 'credit', 'score', 'remit', 'remit_fail', 'payment_app', 'payment', 'buy_points', 'score_points', 'points_gold', 'luck', 'rmd_bonus', 'rmd_reg', 'post_reply', 'post_move', 'post_del', 'getpm', 'lock', 'ban', 'vip_end', 'mod_per');//所有变量
		$defArgs = array('in_send' => 1, 'complain' => 1, 'ensure' => 1, 'credit' => 1, 'score' => 1, 'remit_fail' => 1, 'payment_app' => 1, 'payment' => 1, 'points_gold' => 1, 'luck' => 1, 'getpm' => -1, 'lock' => 1, 'ban' => 1, 'vip_end' => 1, 'mod_per' => 1);//默认不可更改的
		$arr = array();
		foreach ($args as $v) {
			$val = 0;
			if ($_POST[$v.'_pm'])  $val |= 1;
			if ($_POST[$v.'_sms']) $val |= 1 << 1;
			$arr[$v] = $val;
		}
		foreach ($defArgs as $k => $v) {
			if ($v > 0) {
				$arr[$k] |= $v;
			} elseif ($v < 0) {
				$v = abs($v);
				$arr[$k] &= 0xff ^ $v;
			}
		}
		return self::setConfig($uid_, $arr);
	}
	public static function getMemberConfig($uid_ = 0) {
		global $uid;
		$uid_ || $uid_ = $uid;
		$c = array();
		if ($arr = db::one('memberconfigs', '*', "uid='$uid_'")) {
			unset($arr['uid']);
			foreach ($arr as $k => $v) {
				$c[$k.'_pm']  = $v & 1?true:false;
				$c[$k.'_sms'] = $v & 2?true:false;
			}
		}
		return $c;
	}
	public static function isSend($uid, $name, $type = 'pm'){
		global $_cache;
		if (!isset($_cache) && !isset($_cache['memberConfigs']) && !isset($_cache['memberConfigs'][$uid])) {
			if (!isset($_cache)) $_cache = array();
			elseif (!isset($_cache['memberConfigs'])) $_cache['memberConfigs'] = array();
			$_cache['memberConfigs'][$uid] = self::getMemberConfig($uid);
		}
		if ($_cache['memberConfigs'][$uid]) {
			return $_cache['memberConfigs'][$uid][$name.'_'.$type];
		}
		return false;
	}
	public static function setPwd2($uid, $pwd){
		if ($salt = db::one_one(self::$tbName, 'salt', "id='$uid'")) {
			$pwd = common::salt_pwd($salt, $pwd);
			db::update(self::$tbName, array('password2' => $pwd), "id='$uid'");
			return true;
		}
		return false;
	}
	public static function editBase($datas, $avatar = '', $uid_ = 0){
		global $uid, $img_avatar, $ipint, $timestamp;
		$uid_ || $uid_ = $uid;
		$datas = common::filterArray($datas, array('email', 'sex', 'address','qq','truename'));
		$datas = common::filterHtml($datas);
		if (!form::check_email($datas['email'])) return 'email_error';
		$datas['sex'] = (int)$datas['sex'];
		$datas['sex'] > 2 && $datas['sex'] = 2;
		$datas['address'] = common::cutstr($datas['address'], 100);
		db::update(self::$tbName, $datas, "id='$uid_'");
		$username = self::getUsername($uid_);
		db::insert('log_member', array(
			'uid'       => $uid_,
			'username'  => $username,
			'title'     => '修改个人资料',
			'content'   => $username.'修改了自己的个人资料',
			'ip'        => $ipint,
			'timestamp' => $timestamp
		));
		member_base::sendPm($uid_, '修改资料成功', '用户资料修改', 'mod_per');
		member_base::sendSms($uid_, '修改资料成功', 'mod_per');
		if ($avatar) {
			$p0 = common::getArticlePath($uid_, '/');
			$f0 = strrpos($p0, '/');
			$p1 = substr($p0, 0, $f0);
			$p2 = substr($p0, $f0 + 1);
			$filename = image::getImage($avatar, d('./'.$img_avatar.$p1.'/'), 120, 120, '_'.$p2);
			if ($filename !== false) {
				$avatar0 = $p1.'/'.$filename;
				$avatar1 = $p1.'/'.substr($filename, 1);
				if ($avatar2 = db::one_one('memberfields', 'avatar', "uid='$uid_'")) {
					@unlink(d('./'.$img_avatar.$avatar2));
				}
				if (@rename(d('./'.$img_avatar.$avatar0), d('./'.$img_avatar.$avatar1))) {
					$avatar = $avatar1;
				} else {
					$avatar = $avatar0;
				}
				db::update('memberfields', "avatar='$avatar'", "uid='$uid_'");
			}
		}
		return true;
	}
	public static function editPwd($datas = array(), $uid_ = 0){
		global $uid, $sys_pwd2_err_count, $ipint, $timestamp;
		$uid_ || $uid_ = $uid;
		$datas || $datas = $_POST;
		$datas = common::filterArray($datas, array('pwd2', 'password', 'password_', 'password2', 'password2_', 'questionid', 'answer'));
		$datas = common::filterHtml($datas);
		$rs = self::checkPwd2($uid_, $datas['pwd2']);
		if ($rs === true) {
			unset($datas['pwd2']);
			if ($datas['password'] || $datas['questionid'] || $datas['password2']) {
				if ($datas['password']) {
					if ($datas['password'] != $datas['password_']) return 'password__error';
				}
				if ($datas['password2']) {
					if ($datas['password2'] != $datas['password2_']) return 'password2__error';
				}
				if ($datas['questionid']) {
					if ($datas['answer']) $datas['answer'] = common::cutstr($datas['answer'], 20);
					else $datas['questionid'] = '';
				}
				$insert = array();
				//$salt = '';
				if ($datas['password'] || $datas['password2']) {
					//$salt = common::salt();
					$salt = db::one_one(self::$tbName, 'salt', "id='$uid_'");
					if ($datas['password']) $insert['password'] = common::salt_pwd($salt, $datas['password']);
					if ($datas['password2']) $insert['password2'] = common::salt_pwd($salt, $datas['password2']);
				}
				//if ($salt) $insert['salt'] = $salt;
				if ($datas['questionid']) {
					$insert['questionid'] = $datas['questionid'];
					$insert['answer'] = $datas['answer'];
				} else {
					$insert['questionid'] = 0;
					$insert['answer'] = '';
				}
				if (db::update(self::$tbName, $insert, "id='$uid_'")) {
					$username = self::getUsername($uid_);
					db::insert('log_member', array(
						'uid'       => $uid_,
						'username'  => $username,
						'title'     => '修改个人资料',
						'content'   => $username.'修改了自己的个人密码',
						'ip'        => $ipint,
						'timestamp' => $timestamp
					));
					member_base::sendPm($uid_, '修改密码成功', '用户密码修改', 'mod_per');
					member_base::sendSms($uid_, '修改密码成功', 'mod_per');
					return true;
				} else return 'update_error';
			}
			return 'data_error';
		} else {
			return 'password2_error';
			/*$errCount = self::getPwd2ErrCount();
			if ($errCount > 0) {
				return array('name' => 'password2_error_count', 'args' => array('x' => $errCount));
			} else {
				return array('name' => 'password2_expire', 'args' => array('x' => $sys_pwd2_err_count));
			}*/
		}
	}
	public static function sendVcode($uid, $mobilephone){
		global $web_name, $timestamp;
		if ($member = db::one(self::$tbName, 'salt', "id='$uid'")) {
		
				if (message::send($mobilephone, '您的激活码为：'.$salt.'['.$web_name.']')==1){
					db::insert('vcode_log', array('uid' => $uid, 'mobilephone' => $mobilephone, 'vcode' => $salt, 'timestamp' => $timestamp));
					return true;
				}
				return '激活码发送失败！';
			
		}
		return 'user_not_exists';
	}
	public static function checkVcode($uid, $vid, $vcode){
		global $sys_reg_add_credit, $web_name, $ipint, $timestamp;
		if ($uid && $vid && $vcode){
			if ($log = db::one('vcode_log', '*', "id='$vid'")) {
				if ($log['uid'] == $uid) {
					if ($log['vcode'] == $vcode){
						db::update('vcode_log', array('status' => 1), "id='$vid'");
						db::update(self::$tbName , array('mobilephone' => $log['mobilephone'], 'status' => 1), "id='$uid'");
						$username = self::getUsername($uid);
						db::insert('log_member', array(
							'uid'       => $uid,
							'username'  => $username,
							'title'     => '认证手机',
							'content'   => '平台帐户手机认证成功',
							'ip'        => $ipint,
							'timestamp' => $timestamp
						));
						if ($parent = db::one_one(self::$tbName, 'parent', "id='$uid'")) {
							//db::update(self::$tbName, 'child2=child2+1'.($sys_reg_add_credit > 0?',':''));
							$pUser = db::one('members', '*', "id='$parent'");
							db::update(self::$tbName, 'child2=child2+1,childMonth=childMonth+1', "id='$parent'");
							if (self::isSend($parent, 'rmd_reg', 'pm')) {//发送站内信
								msg::sendSys($parent, '恭喜您，您的推广用户'.$username.'已经成功注册，请您关注他/她的任务以便领取奖励', '网站提醒：推广用户注册');
							}
							if (self::isSend($parent, 'rmd_reg', 'sms')) {//发送手机短信
								sms::sendPhone($pUser['mobilephone'], '恭喜您，您的推广用户'.$username.'已经成功注册，请您关注他/她的任务以便领取奖励-['.$web_name.']', $parent);
							}
							if (isset($sys_reg_add_credit) && $sys_reg_add_credit > 0) {
								//db::update('memberfields', 'credits=credits+'.$sys_reg_add_credit, "uid='$parent'");
								self::addCredit($parent, $sys_reg_add_credit, '注册激活奖励积分');
								if (self::isSend($parent, 'rmd_bonus', 'pm')) {//发送站内信
									msg::sendSys($parent, '恭喜您，您的推广用户'.$username.'已经成功注册，获得'.$sys_reg_add_credit.'积分', '网站提醒：推广用户获得积分奖励');
								}
								if (self::isSend($parent, 'rmd_bonus', 'sms')) {//发送短消息
									sms::sendPhone($pUser['mobilephone'], '恭喜您，您的推广用户'.$username.'已经成功注册，获得'.$sys_reg_add_credit.'积分-['.$web_name.']', $parent);
								}
							}
						}
						return true;
					}
					return 'vcode_error';
				}
				return 'error';
			}
			return 'vcode_log_not_exists';
		}
		return 'data_error';
	}
	public static function addCredit($uid, $credit, $remark = ''){
		if (self::memberIdExists($uid)) {
			if ($credit >= 0) {
				if ($doubleCredit = db::one_one('memberfields', 'double_credit', "uid='$uid'")) {
					db::update('card', 'total3=total3+'.$credit, "id='$doubleCredit'");
					$credit *= 2;
				}
				db::update('memberfields', 'credits=credits+'.$credit, "uid='$uid'");
			} else {
				$info = self::getMemberFields($uid);
				$oc   = intval($info['credits']);
				$c    = 0;
				if ($oc >= abs($credit)) {
					$c = $credit;
				} else {
					$c = -$oc;
				}
				db::update('memberfields', 'credits=credits'.$c, "uid='$uid'");
			}
			self::addLog('credits', $uid, $c, $remark);
			return $credit;
		}
		return 0;
	}
	public static function addLog($type, $uid, $val, $remark,$fabudian='',$tassktype='',$totalmoney=''){
		global $timestamp;
		$username = self::getUsername($uid);
		if (self::isSys($uid))
			return true;
		$insert=array();
		if($type)
			$insert['type'] = $type;
		if($uid)
			$insert['uid']=$uid;
		if($username)
			$insert['username']=$username;
		if($val)
			$insert['val']=$val;
		if($remark)
			$insert['remark']=$remark;
		if($fabudian)
			$insert['fabudian']=$fabudian;
		if($tassktype)
			$insert['tasktype']=$tassktype;
		if($timestamp)
			$insert['timestamp']=$timestamp;
		if($totalmoney)
			$insert['totalmoney']=$totalmoney;
		return db::insert('log', $insert);
	}
	public static function addMoney($uid, $money, $remark = ''){
		if (self::memberIdExists($uid)) {
			db::update('memberfields', 'money=money'.($money >= 0?'+':'').$money, "uid='$uid'");
			$totalmoney=db::one_one('memberfields', 'money', "uid='$uid'");
			self::addLog('money', $uid, $money, $remark,'','',$totalmoney);
			return $totalmoney;
		}
		return false;
	}
	public static function redMoney($uid, $money, $remark = ''){
		if (self::memberIdExists($uid)) {
			db::update('memberfields', 'money=money'.($money >= 0?'+':'').-$money, "uid='$uid'");
			self::addLog('money', $uid, $money, $remark);
			return db::one_one('memberfields', 'money', "uid='$uid'");
		}
		return false;
	}
	public static function addFabudian($uid, $nums, $tasktype, $remark = ''){
		if (self::memberIdExists($uid)) {
			$type = (int)$type;
			if ($type < 1 || $type > 3) $type = 1;
			db::update('memberfields', 'fabudian=fabudian'.($nums >= 0?'+':'').$nums, "uid='$uid'");
			$fabudian= db::one_one('memberfields', 'fabudian', "uid='$uid'");
			self::addLog('fabudian', $uid, $nums, $remark,$fabudian,$tasktype);
			return $fabudian;
		}
		return false;
	}
	public static function addPoint($tid, $point = 0){
		if ($task = db::one('task', '*', "id='$tid'")) {
			$uid = $task['buid'];
			$point || $point = $task['point'];
			if ($member = db::one('memberfields', '*', "uid='$uid'")) {
				if ($member['credits'] >= 300) {
					if ($member['vip']) $point *= cfg::getFloat('sys', 'point_get_vip');
					else $point *= cfg::getFloat('sys', 'point_get');
				}
				$point = floor($point * 100 + 0.5) / 100;
				if ($task['type'] == 4) $task['type'] = 1;
				if ($task['freeTask']) $point *= 2;
				self::addFabudian($uid, $point, $task['type'], '完成任务'.$task['id'].'奖励发布点');
			}
		}
		return false;
	}
	public static function backPoint($tid, $point = 0){
		if ($task = db::one('task', '*', "id='$tid'")) {
			$uid   = $task['suid'];
			$point || $point = $task['point'];
			if ($member = db::one('memberfields', '*', "uid='$uid'")) {
				if ($task['type'] == 4) $task['type'] = 1;
				self::addFabudian($uid, $point, $task['type'], '返还任务'.$task['id'].'的发布点');
			}
		}
		return false;
	}
	public static function addLiuliang($uid, $nums, $remark = ''){
		if (self::memberIdExists($uid)) {
			db::update('memberfields', 'liuliang=liuliang'.($nums >= 0?'+':'').$nums, "uid='$uid'");
			//self::addLog('fabudian', $uid, $nums, $remark);
			return db::one_one('memberfields', 'liuliang', "uid='$uid'");
		}
		return false;
	}
	public static function getUsername($uid){
		return db::one_one(self::$tbName, 'username', "id='$uid'");
	}
	public static function getMember($uid){
		return db::one(self::$tbName, '*', "id='$uid'");
	}
	public static function getMemberAll($uid, $username = false){
		$key = $username?'username':'id';
		$info = array();
		if ($baseInfo = db::one(self::$tbName, '*', "$key='$uid'")) {
			$info['base']   = $baseInfo;
			$info['attach'] = self::getMemberFields($baseInfo['id']);//db::one('memberfields', '*' ,"uid='$baseInfo[id]'");
		}
		return $info;
	}
	public static function getMemberFields($uid){
		global $weburl2, $img_avatar;
		if ($fields = db::one('memberfields', '*', "uid='$uid'")) {
			$fields['avatar'] || $fields['avatar'] = db::one_one(self::$tbName, 'sex', "id='$uid'") == 1?'boy.gif':'girl.gif';
			$fields['avatar'] = $weburl2.$img_avatar.$fields['avatar'];
			$fields['sgrade'] = $fields['sgrade1'] + $fields['sgrade2'] + $fields['sgrade3'];
			$fields['bgrade'] = $fields['bgrade1'] + $fields['bgrade2'] + $fields['bgrade3'];
			$fields['credit'] = ($fields['sgrade1'] - $fields['sgrade3']) + ($fields['bgrade1'] - $fields['bgrade3']);
			$fields['isTyro'] = !($fields['tyroTaskCount'] == $fields['tyroTaskAll']);
		}
		return $fields;
	}
	public static function getMemberTask($uid){
		return db::one('membertask', '*', "uid='$uid'");
	}
	public static function total(){
		return db::data_count(self::$tbName);
	}
	public static function getList($f = '*', $spage = -1, $spagesize = -1){
		global $page, $pagesize;
		$spage     == -1 && $spage     = $page;
		$spagesize == -1 && $spagesize = $pagesize;
		return db::get_list2(self::$tbName, $f, '', 'reg_timestamp desc', $spage, $spagesize);
	}
	public static function deleteMember($uid){
		//
		if (self::memberIdExists($uid)) {
			$memberInfo = self::getMember($uid);
			if ($memberInfo['parent'] > 0) {
				//delete parent child
				$where = 'child1=child1-1';
				$memberInfo['status'] > 0 && $where .= ',child2=child2-1';
				db::update(self::$tbName, $where, "id='$memberInfo[parent]'");
			}
			db::del_id(self::$tbName, $uid);//delete member base info
			db::del_key('memberfields', 'uid', $uid);//delete member credits
			db::update('user_groups', 'users=users-1', "id='$memberInfo[groupid]'");
			//预留位置删除刷钻信息用户头像等一切关于该用户ID的信息
			return true;
		}
		return false;
	}
	public static function delete($ids) {
		if (!is_array($ids)) $ids = array($ids);
		$deleteCount = 0;
		foreach($ids as $id) {
			if ($id = (int)$id) {
				if (self::deleteMember($id)) $deleteCount++;
			}
		}
		return $deleteCount;
	}
	public static function login($username, $password, $questionid = 0, $answer = '',$log_count='log_count', $cookietime = 0, $ignoreQuestion = false){
		global $timestamp, $ipint;
		if ($member = db::one(self::$tbName, 'id,username,password,salt,questionid,answer,last_login_ip,log_count', "username='$username'")) {
			if (!$ignoreQuestion && $member['questionid']) {
				if ($questionid != $member['questionid'])return 'question_error';
				if ($answer     != $member['answer']) return 'answer_error';
			}
			if (common::salt_pwd_check($member['password'], $password, $member['salt'])) {
				//login ok
				$uid      = $member['id'];
				$username = $member['username'];
				if (cfg::getBoolean('sys', 'checkIP')) {
					if ($member['last_login_ip']) {
						$info0 = ip::info($member['last_login_ip'], true);
						$info1 = ip::info($ipint, true);
						if ($info0['coutry'] != $info1['coutry']) return 'accountException';
					}
				}
				db::update(self::$tbName, array('last_login_timestamp' => $timestamp, 'last_login_ip' => $ipint, 'log_count'=>$member['log_count'] + 1 ), "id='$uid'");
				//common::setcookie('loginUid', $uid);
				$auth = array(
					'uid'      => $uid,
					'password' => $member['password']
				);
				$auth = serialize($auth);
				common::setcookie('memberAuth', $auth, cfg::getInt('sys', 'sys_logout'));
				common::setcookie('memberAuth2', $auth);
				db::insert('log_member', array(
					'uid'       => $uid,
					'username'  => $username,
					'title'     => '登陆网站',
					'content'   => $username.'登陆网站',
					'ip'        => $ipint,
					'timestamp' => $timestamp
				));
				if ($cookietime = (int)$cookietime) {//记住用户名
					/*$auth = array(
						'uid' => $uid,
						'password' => $member['password']
					);
					$auth = serialize($auth);
					common::setcookie('memberAuth', $auth, $cookietime);*/
					common::setcookie('loginUsername', $username, $cookietime);
				}
				return true;
			}
			return 'password_error';
		}
		return 'user_not_exists';
	}
	public static function loginUid($uid, $password){
		if (db::exists(self::$tbName, array('id' => $uid, 'password' => $password))) {
			//common::setcookie('loginUid', $uid);
			$auth = array(
				'uid'      => $uid,
				'password' => $password
			);
			$auth = serialize($auth);
			common::setcookie('memberAuth', $auth, cfg::getInt('sys', 'sys_logout'));
			common::setcookie('memberAuth2', $auth);
			return true;
		}
		return false;
	}
	public static function logout(){
		global $memberLogined;
		if ($memberLogined) {
			common::unsetcookie('loginUid', 'memberAuth', 'memberAuth2', 'checkPwd2', 'firstOpen');
		}
		return false;
	}
	public static function getClientId($uid){
		if ($member = self::getMember($uid)) {
			$cId = string::getRandStr(32);
			$cId = md5(md5($cId).$member['salt']);
			if (db::update(self::$tbName, array('clientId' => $cId), "id='$uid'")) {
				return $cId;
			}
			return 'error';
		}
		return 'user_not_exists';
	}
	public static function checkPwd2($uid, $pwd2){
		global $sys_pwd2_err_count, $timestamp, $today_start;
		if ($member = db::one(self::$tbName, 'id,password2,salt', "id='$uid'")) {
			if (db::exists('memberlog', "uid='$uid'")) {
				if (!db::exists('memberlog', array('uid' => $uid, 'pwd2_err_timestamp' => $today_start))) {
					db::update('memberlog', 'pwd2_err_count=0', "uid='$uid'");
				}
			} else {
				db::insert('memberlog', array('uid'=>$uid));
			}
			$errCount = (int)db::one_one('memberlog', 'pwd2_err_count', "uid='$uid' and pwd2_err_timestamp='$today_start'");
			if (!isset($sys_pwd2_err_count)  || $errCount < $sys_pwd2_err_count) {
				if (common::salt_pwd_check($member['password2'], $pwd2, $member['salt'])) {
					db::update('memberlog', array('pwd2_err_count' => 0), "uid='$uid'");
					common::setcookie('checkPwd2', true);
					return true;
				}
				db::update('memberlog', "pwd2_err_timestamp='$today_start',pwd2_err_count=pwd2_err_count+1", "uid='$uid'");
				return 'password2_error';
			}
			return array('name' => 'password2_expire', 'args' => array('x' => $sys_pwd2_err_count));
		}
		return 'user_not_exists';
	}
	public static function getPwd2ErrCount($uid_ = 0){
		global $uid, $sys_pwd2_err_count, $today_start;
		$uid_ || $uid_ = $uid;
		$count = (int)db::one_one('memberlog', 'pwd2_err_count', "uid='$uid_' and pwd2_err_timestamp='$today_start'");
		$c     = $sys_pwd2_err_count - $count;
		return $c;
	}
	public static function getPwd2ErrMsg($uid_ = 0){
		global $uid, $sys_pwd2_err_count, $today_start;
		$uid_ || $uid_ = $uid;
		$c = self::getPwd2ErrCount($uid_);
		/*if ($c > 0) {
			$errMsg = str_replace('{x}', $c, language::get('password2_error_count'));
		} else {
			$errMsg = str_replace('{x}', $sys_pwd2_err_count, language::get('password2_expire'));
		}*/
		if ($c > 0) {
			$errMsg = language::get(array('name' => 'password2_error_count', 'args' => array('x' => $errCount)));
		} else {
			$errMsg = language::get(array('name' => 'password2_expire', 'args' => array('x' => $sys_pwd2_err_count)));
		}
		return $errMsg;
	}
	public static function setMsgCount($uid, $count = 1){
		$count >= 0 && $count = '+'.$count;
		db::update('memberfields', 'msg=msg'.$count, "uid='$uid'");
	}
	//groups
	public static function setGroupUsers($gid, $count = 1){
		$count >=0 && $count='+'.$count;
		return db::update('user_groups', "users=users$count", "id='$gid'");
	}
	public static function changeGroup($uid, $groupName){
		if ($groupId = db::one_one(self::$tbName, 'groupid', "id='$uid'")) {
			if ($group = db::one('user_groups', '*', "`key`='$groupName'")) {
				if ($groupId == $group['id']) return true;
				if (self::setGroupUsers($groupId, -1)) {
					if (self::setGroupUsers($group['id'], 1)) {
						return db::update(self::$tbName, array('groupid' => $group['id']), "id='$uid'")?true:'error';
					} else {
						self::setGroupUsers($groupId, 1);
					}
				}
				return 'error';
			}
			return 'group_not_exists';
		}
		return 'user_not_exists';
	}
	public static function isVip($uid){
		$vip = db::one_one('memberfields', 'vip', "uid='$uid'");
		if ($vip) return true;
		return false;
	}
	public static function addVip($uid, $month, $auto){
		global $timestamp;
		if ($uid && $month > 0) {
			if ($m = db::one('memberfields', 'money,vip,vip_expire', "uid='$uid'")) {
				if ($m['vip_expire']) return '您已是VIP了！！';
				$vip_money = common::formatMoney(cfg::get('sys', 'vip_money'));
				( ($money = cfg::getListValue('sys', 'vip_money_list', $month)) && ($monty = common::formatMoney($money)) ) || $money = $vip_money * $month;
				if ($money <= $m['money']) {
					self::addMoney($uid, -$money, '申请'.$month.'个月一级会员');
					db::insert('log_vip', array(
						'uid'       => $uid,
						'username'  => self::getUsername($uid),
						'vip_style'     => 1,
						'month'     => $month,
						'money'     => $money,
						'timestamp' => $timestamp,
						'auto'      => $auto?$month:0
					));
					db::update('memberfields', array(
						'vip'        => 1,
						'vip_expire' => $timestamp + 86400 * 30 * $month,
						'vip_auto'   => $auto?$month:0
					), "uid='$uid'");
					db::update('members', array('groupid' =>6), "id='$uid'");
					return '一级VIP购买成功！';
				}
				return '你的余额不足,请先充值！';
			}
			return '会员不存在！';
		}
		return '月份选择有误！';
	}
	
	public static function addVip1($uid, $month, $auto){
		global $timestamp;
		if ($uid && $month > 0) {
			if ($m = db::one('memberfields', 'money,vip,vip_expire', "uid='$uid'")) {
				if ($m['vip_expire']) return '您已是VIP了！';
				$vip_money = common::formatMoney(cfg::get('sys', 'vip_money'));
				( ($money = cfg::getListValue('sys', 'vip_money_list', $month)) && ($monty = common::formatMoney($money)) ) || $money = $vip_money * $month;
				if ($money <= $m['money']) {
					self::addMoney($uid, -$money, '申请'.$month.'个月一级会员');
					db::insert('log_vip', array(
						'uid'       => $uid,
						'username'  => self::getUsername($uid),
						'vip_style'     => 1,
						'month'     => $month,
						'money'     => $money,
						'timestamp' => $timestamp,
						'auto'      => $auto?$month:0
					));
					db::update('memberfields', array(
						'vip'        => 1,
						'vip_expire' => $timestamp + 86400 * 30 * $month,
						'vip_auto'   => $auto?$month:0
					), "uid='$uid'");
					db::update('members', array('groupid' =>6), "id='$uid'");
					return '一级VIP购买成功！';
				}
				return '你的余额不足,请先充值！';
			}
			return '会员不存在！';
		}
		return '月份选择有误！';
	}
	public static function addVip2($uid, $month){
		global $timestamp;
		if ($uid && $month > 0) {
			if ($m = db::one('memberfields', 'money,vip,vip_expire', "uid='$uid'")) {
				if ($m['vip_expire']) return '您已是VIP了！！';
				$vip_money = common::formatMoney(cfg::get('sys', 'jewel_vip_money'));
				( ($money = cfg::getListValue('sys', 'jewel_vip_money_list', $month)) && ($monty = common::formatMoney($money)) ) || $money = $vip_money * $month;
				if ($money <= $m['money']) {
					self::addMoney($uid, -$money, '申请'.$month.'个月钻石会员');
					db::insert('log_vip', array(
						'uid'       => $uid,
						'username'  => self::getUsername($uid),
						'vip_style'     => 2,
						'month'     => $month,
						'money'     => $money,
						'timestamp' => $timestamp,
					));
					db::update('memberfields', array(
						'vip'        => 2,
						'vip_expire' => $timestamp + 86400 * 30 * $month,
					), "uid='$uid'");
					db::update('members', array('groupid' =>5), "id='$uid'");
					return '钻石VIP购买成功！';
				}
				return '你的余额不足,请先充值！';
			}
			return '会员不存在！';
		}
		return '月份选择有误！';
	}
	public static function addVip3($uid, $month){
	    global $timestamp; 
		if ($uid && $month > 0) {
			if ($m = db::one('memberfields', 'money,vip,vip_expire', "uid='$uid'")) {
				if ($m['vip_expire']) return '您已是VIP了！！';
				$vip_money = common::formatMoney(cfg::get('sys', 'crown_vip_money'));
				( ($money = cfg::getListValue('sys', 'crown_vip_money_list', $month)) && ($money = common::formatMoney($money)) ) || $money = $vip_money * $month;
				if ($money <= $m['money']) {
					self::addMoney($uid, -$money, '申请'.$month.'个月皇冠会员');
					db::insert('log_vip', array(
						'uid'       => $uid,
						'username'  => self::getUsername($uid),
						'vip_style'     => 3,
						'month'     => $month,
						'money'     => $money,
						'timestamp' => $timestamp,
					));
					db::update('memberfields', array(
						'vip'        => 3,
						'vip_expire' => $timestamp + 86400 * 30 * $month,
					), "uid='$uid'");
					db::update('members', array('groupid' =>4), "id='$uid'");
					return '皇冠VIP购买成功！';
				}
				return '你的余额不足,请先充值！';
			}
			return '会员不存在！';
		}
		return'月份选择有误！';
	}
	public static function addVipAdm($uid, $month, $auto){
		if ($month > 0) {
			if ($m = db::one('memberfields', 'money,vip,vip_expire', "uid='$uid'")) {
				/*if ($month = 1) $money = 30;
				elseif ($month == 3) $money = 78;
				elseif ($month == 6) $money = 138;
				elseif ($month == 12) $money = 248;
				else $money = 20 * $month;*/
				$vip_money = common::formatMoney(cfg::get('sys', 'vip_money'));
				( ($money = cfg::getListValue('sys', 'vip_money_list', $month)) && ($monty = common::formatMoney($money)) ) || $money = $vip_money * $month;
				if ($money > $m['money']) {
					if ($m['money'] >= $vip_money) {
						$month = 1;
					} else $month = 0;
				}
				if ($month > 0) {
					return self::addVip1($uid, $month, $auto);
				}
				return 'money_error';
			}
			return 'user_not_exists';
		}
		return 'data_error';
	}
	public static function addFlowVip($uid, $month){
		global $timestamp;
		if ($uid && $month > 0) {
			if ($m = db::one('memberfields', 'money,flowVip,flowVipExpire', "uid='$uid'")) {
				//if ($m['flowVipExpire']) return 'already_is_flowVip';
				//$vip_min = intval(cfg::get('sys', 'reflow_vip_min'));
				//$vip_max = intval(cfg::get('sys', 'reflow_vip_max'));
				$vip_money = common::formatMoney(cfg::get('sys', 'reflow_vip_money'));
				//if ($month < $vip_min) return '对不起，申请的月数不能小于'.$vip_min.'个月';
				//if ($month > $vip_max) return '对不起，申请的月数不能大于'.$vip_max.'个月';
				( ($money = cfg::getListValue('sys', 'reflow_vip_money_list', $month)) && ($monty = common::formatMoney($money)) ) || $money = $vip_money * $month;
				if ($money <= $m['money']) {
					self::addMoney($uid, -$money, '申请'.$month.'个月流量会员');
					db::insert('log_flow_vip', array(
						'uid'       => $uid,
						'username'  => self::getUsername($uid),
						'month'     => $month,
						'timestamp' => $timestamp
					));
					if (!$m['flowVipExpire']) {
						db::update('memberfields', array(
							'flowVip'        => 1,
							'flowVipExpire' => $timestamp + 86400 * 30 * $month
						), "uid='$uid'");
					} else {
						db::update('memberfields', "flowVip='1',flowVipExpire=flowVipExpire+".(86400 * 30 * $month), "uid='$uid'");
					}
					return true;
				}
				return 'money_error';
			}
			return 'user_not_exists';
		}
		return 'data_error';
	}
	public static function sendPm($uid, $message, $title, $type){
		if (self::isSend($uid, $type, 'pm')) {//发送站内信
			msg::sendSys($uid, $message, $title);
		}
	}
	public static function sendSms($uid, $message, $type, $addSuffix = true){
		global $web_name;
		if (self::isSend($uid, $type, 'sms')) {//发送站内信
			if ($user = self::getMember($uid)) {
				if ($addSuffix) $message .= '-['.$web_name.']';
				sms::sendPhone($user['mobilephone'], $message, $uid);
			}
		}
	}
	public static function addBlack($fuid, $tusername, $days, $isFriend){
		global $timestamp;
		if (($fusername = self::getUsername($fuid)) && ($tuid = self::getUid($tusername))) {
			if ($fuid == $tuid) return '对不起，您不能加你自己到黑名单中';
			if (!db::exists('task', "suid='$tuid' or buid='$tuid'")) return '对不起，该用户和你没有任务关系，您不能拉他到黑名单';
			$daysTimestamp = $timestamp + $days * 86400;
			if ($black = db::one('blacks', '*', "fuid='$fuid' and tuid='$tuid'")) {
				if ($black['status'] == '0') return '该用户已经在您的黑名单列表中了';
				if (db::update('blacks', "fuid='$fuid',fusername='$fusername',tuid='$tuid',tusername='$tusername',days='$days',daysTimestamp='$daysTimestamp',isFriend=".($isFriend?1:0).",count=count+1,timestamp='$timestamp',status='0'", "id='$black[id]'")) {
					db::update('memberfields', 'black1=black1+1', "uid='$fuid'");
					if (!$isFriend) {
						db::update('memberfields', 'black2=black2+1', "uid='$tuid'");
						self::addCredit($tuid, -5, '被'.$fusername.'拉入黑名单');
						member_base::sendPm($tuid, '被'.$fusername.'拉入黑名单', '被拉黑名单', 'black');
						member_base::sendSms($tuid, '被'.$fusername.'拉入黑名单', 'black');
					}
					return true;
				}
			} else {
				if (db::insert('blacks', array(
					'fuid'          => $fuid,
					'fusername'     => $fusername,
					'tuid'          => $tuid,
					'tusername'     => $tusername,
					'days'          => $days,
					'daysTimestamp' => $daysTimestamp,
					'isFriend'      => $isFriend?1:0,
					'timestamp'     => $timestamp
				))) {
					db::update('memberfields', 'black1=black1+1', "uid='$fuid'");
					if (!$isFriend) {
						db::update('memberfields', 'black2=black2+1', "uid='$tuid'");
						self::addCredit($tuid, -5, '被'.$fusername.'拉入黑名单');
						member_base::sendPm($tuid, '被'.$fusername.'拉入黑名单', '', 'black');
						member_base::sendSms($tuid, '被'.$fusername.'拉入黑名单', 'black');
					}
					return true;
				}
			}
			return 'error';
		}
		return 'user_not_exists';
	}
	public static function removeBlack($fuid, $tusername) {
		if (($tuid = self::getUid($tusername))) {
			if ($black = db::one('blacks', '*', "fuid='$fuid' and tuid='$tuid'")) {
				db::update('blacks', "status='1'", "id='$black[id]'");
				db::update('memberfields', 'black1=black1-1', "uid='$fuid'");
				if (!$black['isFriend']) {
					db::update('memberfields', 'black2=black2-1', "uid='$tuid'");
				}
				return true;
			}
			return 'error';
		}
		return 'user_not_exists';
	}
	public static function setEnsureMoney($uid, $money = 0){
		global $timestamp, $sys_ensure_min_money, $sys_ensure_max_money;
		if ($memberInfo = self::getMemberAll($uid)) {
			$payforMoney = $sys_ensure_max_money - $memberInfo['attach']['ensureMoney'];
			if ($money >=0 && $payforMoney < 0) return '对不起，押金超过了最大金额：'.$sys_ensure_max_money;
			$payforMoney > $sys_ensure_min_money && $payforMoney = $sys_ensure_min_money;
			$money > 0 && $money > $sys_ensure_min_money && $money = $sys_ensure_min_money;
			$money || $money = $payforMoney;
			$remark = ($money > 0 ? '增加' : '扣除').'商保押金';
			if ($memberInfo['attach']['money'] >= $money) {
				if ($money > 0) {
					//增加押金
					if ($memberInfo['attach']['isEnsure']) {
						//已经增加了的，续加
						self::addMoney($uid, -$money, '增加商保押金');
						db::update('memberfields', "ensureMoney=ensureMoney+'$money',ensureLastTime='$timestamp'", "uid='$uid'");
						db::insert('ensure_log', array(
							'uid'       => $uid,
							'username'  => $memberInfo['base']['username'],
							'money'     => $money,
							'remark'    => $remark,
							'timestamp' => $timestamp
						));
						return true;
					} else {
						self::addMoney($uid, -$money, '开通商保');
						db::update('memberfields', "isEnsure='1',ensureMoney=ensureMoney+'$money',ensureFirstTime='$timestamp',ensureLastTime='$timestamp'", "uid='$uid'");
						db::insert('ensure_log', array(
							'uid'       => $uid,
							'username'  => $memberInfo['base']['username'],
							'money'     => $money,
							'remark'    => $remark,
							'timestamp' => $timestamp
						));
						return true;
					}
				} else {
					//扣除押金
					if ($memberInfo['attach']['money'] >= -$money) {
						db::update('memberfields', "ensureMoney=ensureMoney$money,ensureLastTime='$timestamp'", "uid='$uid'");
						db::insert('ensure_log', array(
							'uid'       => $uid,
							'username'  => $memberInfo['base']['username'],
							'money'     => $money,
							'remark'    => $remark,
							'timestamp' => $timestamp
						));
						if ($memberInfo['attach']['money'] - $money <= 0) {
							db::update('memberfields', array(
								'isEnsure' => 0,
							), "uid='$uid'");
						}
						return true;
					}
					return '商保押金不足';
				}
			}
			return '余额不足'.$money.'元';
		}
		return 'user_not_exists';
	}
	public static function exitEnsure($uid){
		global $timestamp, $sys_ensure_min_money;
		if ($memberInfo = self::getMemberAll($uid)) {
			if ($memberInfo['attach']['isEnsure']) {
				if ($memberInfo['attach']['ensureMoney'] >= $sys_ensure_min_money) {
					if ($rs = self::setEnsureMoney($uid,-$memberInfo['attach']['ensureMoney'])) {
						self::addMoney($uid, $memberInfo['attach']['ensureMoney'], '退回商保押金');
						return true;
					}
					return $rs;
				}
				return '对不起，您的商保金额小于'.$sys_ensure_min_money.'元，不能退出！';
			}
			return '对不起，该用户没有加入商保服务';
		}
		return 'user_not_exists';
	}
}
?>