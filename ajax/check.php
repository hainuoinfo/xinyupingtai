<?php
include('../class/index.php');
common::nocache();
switch($action){
	case 'username':
		if(form::is_form_hash2()){
			if($username = $_POST['username']){
				if(preg_match("/^[0-9a-zA-Z]{3,16}$/",$username)){
				$rs = db::exists('members', array('username' => $username))?'1':'2';	
				}else
				{
				$rs='3';
				}
			} else 
				 {
				$rs = '-1';
			}
		} else {
			$rs = '0';
		}
	break;
	case 'parent':
		if(form::is_form_hash2()){
			if($parent = $_POST['parent']){
				$rs = db::exists('members', array('username' => $parent))?'1':'2';	
			} else 
				 {
				$rs = '-1';
			}
		} else {
			$rs = '0';
		}
	break;
	case 'vcode':
		if(form::is_form_hash2()){
			if (vcode2::checkPost(false)) {
				$rs = '1';
			} else {
				$rs = '2';
			}
		} else {
			$rs = '-1';
		}
	break;
}
echo $rs;
?>