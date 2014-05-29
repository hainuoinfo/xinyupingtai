<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
template::initialize('./templates/default/'.$action.'/', './cache/default/'.$action.'/');//
$ops = array('tbseo');
($operation && in_array($operation, $ops)) || $operation = $ops[0];
switch ($operation) {
	case 'tbseo':
		$nav_bar = array(
			array('title' => $web_name, 'url' => $weburl.'/')
		);
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
		$datas = form::get(array('seomoney', 'seo'));
		$datas && extract($datas);
		print_r($datas);
		}
		}
		include(template::load($operation));
	break;
}
?>