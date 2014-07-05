<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
common::char_set();
common::nocache();
if (!$memberLogined) {
	echo '对不起，请先登陆后再操作！';
	exit;
}
if ($rs = form::is_form_hash2()) {
	if ($rs === true) {
		$mobilephone = $member['mobilephone'];
		if (form::check_mobilephone($mobilephone)) {
			$t1 = $timestamp;
			$t2 = $t1 - 5 * 60;//5分钟之内只能发一次
			if (db::exists('pwd2_log', "uid='$uid' and timestamp>=$t2 and timestamp<=$t1")) {
				echo '对不起，5分钟之内只能重置一次';
			} else {
				if (db::data_count('pwd2_log', "uid='$uid' and timestamp>=$today_start and timestamp<=$today_end") >= 3) {
					echo '很抱歉，同一用户一天最多只能重置3次操作码';
				} else {
					$pwd = string::getRandStr(20, 1);
					if (member_base::setPwd2($uid, $pwd)) {
						db::insert('pwd2_log', array(
							'uid' => $uid,
							'username'    => $member['username'],
							'password'    => $pwd,
							'mobilephone' => $mobilephone,
							'timestamp'   => $timestamp
						));
						message::send($mobilephone, '新的的操作码为：'.$pwd.'，'.$web_name);
						echo '新操作码已经发送到您的手机，请注意查收！';
					} else {
						echo '重置失败，请重试！';
					}
				}
			}
		} else {
			echo '很抱歉，您的手机号码格式错误，请联系管理员！';
		}
	} else {
		echo '数据超时，请刷新网页再提交！';
	}
}
?>