<?php
class message{
	private static $ini = false, $logined = false, $money = 0, $oneMsgLen = 70, $username, $password, $price ,$encoding = 'gbk';
	public static function ini($username = '', $password = '', $price = 0){
		global $msg_username, $msg_password, $msg_price, $sys_msg_debug;
		$username || $username = $msg_username;
		$password || $password = $msg_password;
		$price    || $price    = $msg_price;
		if ($username && $password && $price) {
			$username = urlencode(iconv(ENCODING, 'GBK', $username));
			$password = urlencode(iconv(ENCODING, 'GBK', $password));
			if ($sys_msg_debug) {
				$html = '9999.9';
			} else {
				$url = 'http://service8.winic.org/webservice/public/remoney.asp?uid='.$username.'&pwd='.$password;//get money
				$html = winsock::get_html($url);
			}
			if (is_numeric($html)) {
				self::$username = $username;
				self::$password = $password;
				self::$price    = $price;
				self::$money    = (float)$html;
				self::$logined  = true;
			}
		}
		self::$ini = true;
	}
	public static function getMoney(){
		if (!self::$ini) self::ini();
		if (self::$logined) {
			return self::$money;
		}
		return 'not_login';
	}
	public static function getLen(){
		return self::$oneMsgLen;
	}
	public static function howMuch($message, $money){
		$message   = iconv(ENCODING, self::$encoding, $message);
		$message   = preg_replace('/\r\n|\n/', '', $message);
		$msgLength = mb_strlen($message, self::$encoding);
		if ($msgLength > 0) {
			$msgCount    = floor(($msgLength -1) / self::$oneMsgLen) + 1;
			return $msgCount * $money;
		}
		return 0;
	}
	public static function send($phones, $message, $returnMsg = false){
		if (!self::$ini) self::ini();
		if (self::$logined) {
			$phones = preg_replace('/\D/', ',', $phones);
			$sp     = explode(',', $phones);
			$phones = array();
			foreach ($sp as $v) {
				if (preg_match('/^1(?:(?:3[0-9])|(?:5[0-35-9])|(?:8[26-9]))\\d{8}$/', $v)) {
					$phones[] = $v;
				}
			}
			$phoneCount = count($phones);
			if ($phoneCount > 0) {
				$message   = preg_replace('/\r\n|\n/', '', $message);
				$message   = iconv(ENCODING, self::$encoding, $message);
				$msgLength = mb_strlen($message, self::$encoding);
				if ($msgLength > 0) {
					$msgList     = $rnMsg = array();
					$msgCount    = floor(($msgLength -1) / self::$oneMsgLen) + 1;
					$sendCount   = 0;
					$onePriceAll = self::$price * $msgCount;
					$priceAll    = $onePriceAll * $phoneCount;
					if ($priceAll < self::$money) {
						for ($i = 0; $i < $msgCount; $i++) {
							$msgList[] = mb_substr($message, $i * self::$oneMsgLen, self::$oneMsgLen, self::$encoding);
						}
						foreach ($phones as $phone) {
							foreach ($msgList as $msg) {
								if (self::sendOne($phone, $msg)) {
									$sendCount++;
									if ($returnMsg) {
										$rnMsg[$phone][] = $msg;
									}
								}
							}
						}
						if ($returnMsg) {
							return array('complate' => $sendCount, 'list' => $rnMsg);
						}
						return $sendCount;
					}
					return 'money_error';
				}
				return 'msg_none';
			}
			return 'none';
		}
		return 'not_login';
	}
	public static function sendOne($phone, $msg){
		global $timestamp, $sys_msg_debug;
		if (!self::$ini) self::ini();
		if (self::$logined) {
			$msgId = db::insert('message_log', array(
				'mobilephone' => $phone,
				'content'     => iconv(self::$encoding, ENCODING, $msg),
				'timestamp'   => $timestamp,
				'money'       => self::$price,
				'status'      => 0
			), true);
			if ($msgId) {
				$msg = urlencode($msg);
				if ($sys_msg_debug) {
					$html = '000/Send:1/Consumption:0.1/Tmoney:9999.9/sid:123';
				} else {
					$html = winsock::get_html('http://service.winic.org/sys_port/gateway/?id='.self::$username.'&pwd='.self::$password.'&to='.$phone.'&content='.$msg);
				}
				if(preg_match("/^\s*(\d{3}|-\d{2})\\/Send:(\d{1,100})\\/Consumption:([\d\.]+)\\/Tmoney:([\d\.]+)\\/sid:(\d+)?$/is", $html, $rs)){
					$status=array(
						'000'=>array('state' => true,  'info' => '成功'),
						'-01'=>array('state' => false, 'info' => '当前余额不足'),
						'-02'=>array('state' => false, 'info' => '当前用户ID错误'),
						'-03'=>array('state' => false, 'info' => '当前密码错误'),
						'-04'=>array('state' => false, 'info' => '参数不够或参数内容的类型错误'),
						'-05'=>array('state' => false, 'info' => '手机号码格式不对'),
						'-06'=>array('state' => false, 'info' => '短信内容编码不对'),
						'-07'=>array('state' => false, 'info' => '短信内容含有敏感字符'),
						'-08'=>array('state' => false, 'info' => '账号已冻结或锁定'),
						'-09'=>array('state' => false, 'info' => '系统维护中'),
						'-10'=>array('state' => false, 'info' => '手机号码数量超长'),
						'-11'=>array('state' => false, 'info' => '短信内容超长'),
						'-12'=>array('state' => false, 'info' => '其它错误')
					);
					if($status[$rs[1]]['state']){
						self::$money = (float)$rs[4];
						db::update('message_log', array('status' => 1), "id='$msgId'");
						return true;
					} else {
						db::update('message_log', array('remark' => $status[$rs[1]]['info']), "id='$msgId'");
						return false;	
					}
				} else {
					db::update('message_log', array('remark' => '其它错误'), "id='$msgId'");
					return false;
				}
			}
		}
		return false;
	}
}
?>