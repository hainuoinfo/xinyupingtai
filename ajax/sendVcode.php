<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
common::char_set();
common::nocache();
if (!$memberLogined) {
	echo '对不起，请先登陆后再操作！';
	exit;
}
$_POST && extract($_POST);
if ($rs = form::is_form_hash2()) {
	if ($rs === true) {
		switch ($type) {
			case 'seller':
				if ($id = (int)$id) {
					if (db::exists('sellers', array('id' => $id, 'status' =>0))) {
						$mobilephone = $member['mobilephone'];
						if (form::check_mobilephone($mobilephone)) {
							$next = true;
							if ($sendLog = db::one('vcode_log', '*', "uid='$member[id]'", 'timestamp desc')) {
								if ($timestamp - $sendLog['timestamp'] <= $msg_vcode_time) {
									$next = false;
									echo '对不起，激活码'.$msg_vcode_time.'秒内只能发送一次';
								}
							}
							if ($next) {
								extract($_POST);
								$salt = common::salt();
								if (message::send($mobilephone, '您的激活码为：'.$salt.'['.$web_name.']')==1){
									db::insert('vcode_log', array('uid' => $uid, 'mobilephone' => $mobilephone, 'vcode' => $salt, 'timestamp' => $timestamp));
									echo '验证码已经发到您的手机上，请注意查收手机短信';
								}
							}
						} else {
							echo '很抱歉，您的手机号码格式错误，请联系管理员！';
						}
					} else {
						echo '不存在该掌柜，或该掌柜已经激活';
					}
				} else {
					echo '参数错误';
				}
			break;
		}
	} else {
		echo '数据超时，请刷新网页再提交！';
	}
}
?>