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
	extract($_POST);
		if (form::check_mobilephone($mobilephone)){
			$next = true;
			$mobile = db::one_one('members', '*', "mobilephone='$mobilephone' and status='1'");
			if($mobile ){
			    $rs='对不起，该手机号码已被绑定！';
			}else{
		    	if($sendLog = db::one('vcode_log', '*', "uid='$member[id]'", 'timestamp desc')) {
				    if ($timestamp - $sendLog['timestamp'] <= $msg_vcode_time) {
					     $next = false;
					     $rs='对不起，激活码'.$msg_vcode_time.'秒内只能发送一次';
				    }
			    }
			    if($sendLog = db::one('vcode_log', '*', "uid='$member[id]'", 'timestamp desc')) {
				    if ($timestamp - $sendLog['timestamp'] <= $msg_vcode_time) {
					     $next = false;
					     $rs='对不起，激活码'.$msg_vcode_time.'秒内只能发送一次';
				    }
			    }
			    if ($next){
			        extract($_POST);
			        $salt = common::salt();
			         if (message::send($mobilephone, '您的激活码为：'.$salt.'['.$web_name.']')==1){
				        db::insert('vcode_log', array('uid' => $uid, 'mobilephone' => $mobilephone, 'vcode' => $salt, 'timestamp' => $timestamp));
				        $rs= '验证码已经发到您的手机上，请注意查收手机短信';
			        }
			    }
		    }
		} else {
			$rs= '很抱歉，您的手机号码格式错误，请联系管理员！';
		}
}
echo $rs;
?>