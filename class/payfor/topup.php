<?php
class payfor_topup{
	public static $status;
	public static function payfor($uid, $money1, $type, $useMp = true, $datas = array()){
		global $db, $pre, $timestamp;
		self::$status = false;
		if (member_base::memberIdExists($uid)) {
			$class = 'payfor_'.$type;
			if (class_exists($class)) {
				$c = new $class();
				if ($c->status) {
					$vip      = member_base::isVip($uid);
					$username = member_base::getUsername($uid);
					$money1   = self::format_money($money1);
					if ($useMp) {
						if ($vip) $mp = 0.005;//如果是会员收0.5%的手续费
						else $mp = 0.007;//如果不是会员收0.7%的手续费
						$money2 = self::format_money($money1 + $money1 * $mp);
					} else {
						$money2 = $money1;
						$mp     = 0;
					}
					if ($money2 > 0) {
						$type = substr($type, 0, 10);
						$db->query("lock table `{$pre}topup` write");
						do {
							$id = self::createId();
						} while(db::exists('topup', array('id' => $id)));
						if (db::insert('topup', array(
							'id'         => $id,
							'type'       => $type,
							'uid'        => $uid,
							'username'   => $username,
							'money1'     => $money1,
							'money2'     => $money2,
							'mp'         => $mp,//手续费百分比
							'status'     => 0,
							'ptimestamp' => $timestamp,
							'ctimestamp' => 0
						))) {
							$db->query("unlock tables");
							if ($datas) {
								$args = $c->payfor($id, $money2, $datas);
							} else {
								$args = $c->payfor($id, $money2);
							}
							if ($args !== false) {
								$html = self::formatData($args);
								if ($html !== false) {
									self::$status = true;
									return $html;
								} else {
									//错误 删除数据
									db::del_id('topup', $id);
									return 'payfor_error';
								}
							}
						}
						$db->query("unlock tables");
						return 'payfor_error';
					}
					return 'data_error';
				}
				return 'payfor_disabled';
			}
			return 'class_not_exists';
		}
		return 'user_not_exists';
	}
	public static function payfor2($uid, $type, $id, $pwd, $back = true){
		global $db, $pre, $timestamp;
		self::$status = false;
		if (member_base::memberIdExists($uid)) {
			$class = 'payfor_'.$type;
			if (class_exists($class)) {
				$c = new $class();
				if ($c->status) {
					$money1 = $c->useCard($id, $pwd);
					$cardId = $id;
					if ($money1 > 0) {
						$username = member_base::getUsername($uid);
						$money2 = $money1;
						if ($money2 > 0) {
							$type = substr($type, 0, 10);
							$mp   = 0;
							$db->query("lock table `{$pre}topup` write");
							do {
								$id = self::createId();
							} while(db::exists('topup', array('id' => $id)));
							if (db::insert('topup', array(
								'id'         => $id,
								'type'       => $type,
								'uid'        => $uid,
								'username'   => $username,
								'money1'     => $money1,
								'money2'     => $money2,
								'mp'         => $mp,//手续费百分比
								'status'     => 0,
								'ptimestamp' => $timestamp,
								'ctimestamp' => 0
							))) {
								$db->query("unlock tables");
								db::update('rcard', array(
									'uid'      => $uid,
									'username' => $username
								), "id='$cardId'");
								self::complateOrder($id, $c->name.'支付');
								$back && self::back($id);
								return true;
							}
							$db->query("unlock tables");
							return 'payfor_error';
						}
					}
					return $money1;
				}
				return 'payfor_disabled';
			}
			return 'class_not_exists';
		}
		return 'user_not_exists';
	}
	public static function back($id){
		if ($order = db::one('topup', '*', "id='$id'")) {
			common::setMsg('充值成功，如果5分钟之内未到账，请联系客服');
			echo "<script>alert('充值成功，如5分钟内未到账，请联系客服！');window.location.href='/member/PayDetails/?type=5';</script>";
			
		}
		exit('error');
	}
	public static function getStatus($type){
		$class = 'payfor_'.$type;
		if (class_exists($class)) {
			$c = new $class();
			return $c->status;
		}
		return false;
	}
	public static function checkReturnA($type){
		$class = 'payfor_'.$type;
		if (class_exists($class)) {
			$c = new $class();
			if ($c->status) {
				return $c->checkReturnA();
			}
		}
		return false;
	}
	public static function checkReturnB($type){
		$class = 'payfor_'.$type;
		if (class_exists($class)) {
			$c = new $class();
			if ($c->status) {
				return $c->checkReturnB();
			}
		}
		return false;
	}
	public static function complateOrder($id, $remark = ''){
		global $timestamp, $web_name;
		if ($order = db::one('topup', '*', "id='$id'")) {
			if (!$order['status']) {
				//还没有充值成功的
				if ($money = member_base::addMoney($order['uid'], $order['money1'], $remark)) {
					$credit = 0;
					$vip = member_base::isVip($order['uid']);
					if ($order['money1'] >= 5000) {
						if ($vip) $credit = 600;
						else $credit = 500;
					} elseif ($order['money1'] >= 1000) {
						if ($vip) $credit = 100;
						else $credit = 90;
					} elseif ($order['money1'] >= 500) {
						if ($vip) $credit = 50;
						else $credit = 40;
					}
					if ($credit > 0) {
						$credit = member_base::addCredit($order['uid'], $credit, '充值奖励');
					}
					db::update('topup', array(
						'money'      => $money,
						'credit'     => $credit,
						'ctimestamp' => $timestamp,
						'status'     => 1
					), "id='$id'");
					member_base::sendPm($order['uid'], '恭喜您，您成功充值了'.$order['money1'].'元存款', '网站提醒：充值成功', 'remit');
					member_base::sendSms($order['uid'], '恭喜您，您成功充值了'.$order['money1'].'元存款', 'remit');
				}
				return true;
			}
		}
		return false;
	}
	private static function format_money($money){
		$money = (float)$money;
		$money = floor($money * 100 + 0.5) / 100;
		return $money;
	}
	private static function createId(){
		list($millisecond, $second)=explode(' ', microtime());
		$millisecond  = (float)$millisecond;
		$second       = (int)$second;
		$millisecond *= 1000000;
		$millisecond  = sprintf('%06d', floor($millisecond));
		//$salt = substr(uniqid(rand()), -5);
		$id = date('YmdHis', $second).$millisecond;
		return $id;
	}
	private static function formatData($args){
		if (!is_array($args) || !$args['url'] || !$args['type']) return false;
		$args['encoding'] || $args['encoding'] = ENCODING;
		$html = '';
		if ($args['type'] == 'post') {
			if (!$args['datas'] || !is_array($args['datas'])) return false;
			foreach ($args['datas'] as $k => $v) {
				if ($args['encoding'] != ENCODING) $v = iconv(ENCODING, $args['encoding'], $v);
				$v = htmlspecialchars($v);
				$html .= '<input type="hidden" name="'.$k.'" value="'.$v.'" />';
			}
			$html = '<form method="post" action="'.$args['url'].'" enctype="application/x-www-form-urlencoded" name="myForm">'.$html.'</form>
			<script language="javascript">document.myForm.submit();</script>
			';
		} elseif ($args['type'] =='get') {
			$url = '';
			if ($args['datas']) {
				$url .= http_build_query($args['datas']);
			}
			$url && $url = '?'.$url;
			$url = $args['url'].$url;
			$html = '<script language="javascript">location.href="'.$url.'";</script>';
		}
		if ($html) {$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset='.$args['encoding'].'" />
<title>'.iconv(ENCODING, $args['encoding'], '正在跳转...').'</title>
</head>

<body>'.$html.'</body>
</html>';
			return $html;
		}
		return false;
	}
}
?>