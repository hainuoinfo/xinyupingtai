<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
//$ms = array('resumePwd2');
//(isset($method) && in_array($method, $ms)) || $method = $ms[0];
switch ($method) {
	case 'resumePwd2':
		if ($id) {
			db::del_key('memberlog', 'uid', $id);
			$rs['status'] = true;
			$rs['msg']    = '';
		} else $rs['msg'] = '参数错误！';
	break;
}
?>