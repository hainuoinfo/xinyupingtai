<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
$_GET && extract($_GET);
$rs=array();
common::nocache();
$rs['error']=1;
switch($n){
	case 'signupemail':
		//检查EMAIL是否存在
		if($v){
			if(!db::exists('members',array('email'=>$v))){
				$rs['error']=0;
				$rs['data']=0;
			}
		}
	break;
	case 'signupname':
		if($v){
			if(!db::exists('members',array('username'=>$v))){
				$rs['error']=0;
				$rs['data']=0;
			}
		}
	break;
}
echo string::json_encode($rs);
?>