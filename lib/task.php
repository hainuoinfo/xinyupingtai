<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
//loadLib('member.base');

language::load(array('folder' => 'member', 'name' => 'reg'));
template::initialize('./templates/default/'.$action.'/', './cache/default/'.$action.'/');//设置BBS模板缓存目录
$ops = array('tao', 'you', 'pai', 'new', 'flow', 'collect', 'reflow');
($operation && in_array($operation, $ops)) || $operation = $ops[0];
if (!$memberLogined ) {
	common::goto_url('/member/login/?referer='.$baseUrl2);
}
$bbsNav = array(
	array('name' => $web_name, 'url' => $weburl2),
	array('name' => '我的联盟中心', 'url' => common::getUrl('/member/'))
);
$lanP0 = 't_';
$tplName = $operation;
include($libRoot.$action.D.$operation.'.php');
/*switch ($operation) {
	case 'tao':
		
	break;
	case 'pai':
	break;
	case 'new':
	break;
	case 'flow':
	break;
	case 'collect':
	break;
}*/
$title .= ' - '.$web_name;
include(template::load($tplName));
?>