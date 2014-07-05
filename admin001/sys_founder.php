<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
if(common::is_form_hash()) {
	extract(form::get('sys_user','sys_pwd','sys_new_pwd'));
	!$sys_user && admin::show_message('创始人帐号不能为空');
	!$sys_pwd && admin::show_message('请输入创始人密码');
	if($sys_user != $config['sys_user'] || $sys_new_pwd != '') {
		if(md5(md5($sys_pwd).$config['sys_salt'])==$config['sys_pwd']) {
			$sys_new_pwd && $salt = common::salt();
			$sys_new_pwd && $sys_pwd=md5(md5($sys_new_pwd).$salt);
			$config['sys_user']=$sys_user;
			$sys_new_pwd && $config['sys_pwd']=$sys_pwd;
			$sys_new_pwd && $config['sys_salt']=$salt;
			file::write($sys_config_file,'<?php !defined(\'IN_JB\')&&exit(\'ERROR\');$config='.string::format_array($config).';?>');
			common::setcookie("founder_login",'');
			admin::show_message('修改成功！请重新登陆',$admin_url,true);
		} else admin::show_message('创始人密码错误！');
	} else {
		admin::show_message('未做修改');
	}
}
?>