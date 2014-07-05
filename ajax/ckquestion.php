<?php
include('../class/index.php');
common::nocache();
	if ($rs = form::is_form_hash2()) {
			$_POST = common::filterHtml($_POST);
			$datas = form::get('username', 'password', 'cookietime');
			if ($rs === true) {
				$_POST && extract($_POST);
				if ($rs === true) {
				    $rs = member_base::login($username, $password, $questionid, $answer, $cookietime);
			    } else {
				    $rs = 'login_expire';
			    }	
				if ($rs === true) {
			    	common::goto_url($referer, true);
			    } else {
				     if ($rs == 'accountException') common::goto_url('/member/checkAccount/?username='.urlencode($username), false, '帐号异常，请验证！');
				     $indexMessage = language::get($rs, 'login', 'member');
		     	}
				
				
			} else {
				$indexMessage = '表单超时，请重新提交';
			}
		}
echo $rs;
?>