<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
//$ms = array('resumePwd2');
//(isset($method) && in_array($method, $ms)) || $method = $ms[0];
switch ($method) {
	case 'send':
		if ($cardid && $username) {
			if ($uid = member_base::getUid($username)) {
				if ($card = db::one('rcard', 'id,money,pwd,status', "id='$cardid'")) {
					if (!$card['status']) {
						$title   = cfg::get('msgContent', 'sendCardTitle');
						$content = cfg::get('msgContent', 'sendCardContent');
						$args = array(
							'webName' => $web_name,
							'cardMoney'   => $card['money'],
							'cardId'      => $card['id'],
							'cardPwd'     => $card['pwd']
						);
						$title   = common::replaceVars($title, $args);
						$content = common::replaceVars($content, $args);
						if (msg::sendSys($uid, $content, $title)) {
							$rs['status'] = true;
						} else $rs['msg'] = '发送失败，请重试！';
					} else $rs['msg'] = '充值卡：'.$cardid.'已经使用过了';
				} else $rs['msg'] = '充值卡：'.$cardid.'记录不存在';
			} else $rs['msg'] = '该用户不存在！';
		} else $rs['msg'] = '参数错误！';
	break;
}
?>