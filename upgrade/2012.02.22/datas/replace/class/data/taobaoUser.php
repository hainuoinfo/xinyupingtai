<?php
!defined('IN_JB') && exit('error');
loadLib($libP.'taobaoBase');
class data_taobaoUser extends data_taobaoBase{
	public static function getApiUser($nick){
		$args = array(
			'method' => 'taobao.user.get',
			'fields' => 'uid,nick,sex,buyer_credit,seller_credit,type,promoted_type,consumer_protection,has_shop',
			'nick'   => $nick
		);
		//消保
		//promoted_type 实名认证标志 有无实名认证。可选值:authentication(实名认证),not authentication(没有认证)
		//http://rate.taobao.com/user-rate-13ed87d3175ac9f8979fd27a33c47eee.htm 信用页面
		if(($rs = parent::get($args)) && $rs['user']){
			$rs = $rs['user'];
			if (!$rs['promoted_type']) {
				$html = winsock::get_html('http://rate.taobao.com/user-rate-'.$rs['uid'].'.htm');
				if (strpos($html, '支付宝实名认证') !== false) $rs['promoted_type'] = 'authentication';
				else $rs['promoted_type'] = 'not authentication';
				if (preg_match('/<li class="join-status">(.+?)<\/li>/is', $html, $matches)) {
					if (strpos($matches[1], '未加入') !== false) $rs['consumer_protection'] = false;
					else $rs['consumer_protection'] = true;
				} else $rs['consumer_protection'] = false;
			}
			return $rs;
		} else {
			return false;
		}
	}
	public static function userExists($nick){
		$args = array(
			'method' => 'taobao.user.get',
			'fields' => 'uid',
			'nick'   => $nick
		);
		if(($rs = parent::get($args)) && $rs['user']){
			return true;
		} else {
			return false;
		}
	}
	public static function getUser($nick){
		return self::getApiUser($nick);
	}
}
?>