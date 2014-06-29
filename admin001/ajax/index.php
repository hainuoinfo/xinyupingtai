<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'../class/index.php');
define('ADMIN_ROOT', dirname(__FILE__).D);
template::initialize('./templates/default/founder/ajax/','./cache/default/founder/ajax/');
$admin_url=$weburl.'/'.$config['sys_admin_folder'].'/index.php';
$adminId = 0;
$admin = array();
if ($cookie['admin_login']) {
	$adminId = $cookie['admin_login'];
	$admin   = admin::get($adminId);
} else {
	$admin = array(
		'username' => $config['sys_user']
	);
}
define('IN_ADMIN', $cookie['founder_login'] || $adminId?true:false);
define('IN_FOUNDER', $cookie['founder_login']?true:false);
$rs = array(
	'status' => false,
	'msg'    => '非法操作！'
);
if(IN_ADMIN === true){
	admin::updateLogin();
	//$_GET&&extract($_GET);
	
	$admin_url='index.php';
	$base_url=$admin_url.($action||$operation?'?'.($action?'action='.$action:'').($operation?'&operation='.$operation:''):'');
	if($action){
		if($operation){
			if(file_exists(SCRIPT_ROOT.'./'.$action.'_'.$operation.'.php')) {
				include(SCRIPT_ROOT.'./'.$action.'_'.$operation.'.php');
			} elseif(file_exists(SCRIPT_ROOT.'./'.$action.'.php'))include(SCRIPT_ROOT.'./'.$action.'.php');
			else {
				if(file_exists(SCRIPT_ROOT.'./'.$action.'.php'))include(SCRIPT_ROOT.'./'.$action.'.php');
				else {
					$rs['msg'] = 'action:'.$action.' not exists';
				}
			}
		}
		
	}
}
echo string::json_encode($rs);
?>