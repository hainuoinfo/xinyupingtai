<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
template::initialize('./templates/default/'.$action.'/', './cache/default/'.$action.'/');//
$ops = array('index', 'cate', 'jiaocheng', 'fuwu', 'taskout', 'taskin', 'text', 'flow','guide');
($operation && in_array($operation, $ops)) || $operation = $ops[0];
switch ($operation) {
	case 'index':
		$nav_bar = array(
			array('title' => $web_name, 'url' => '/'),
			array('title' => '帮助中心'),
		);
		if ($cates = db::get_list2('help_cate', 'id,ico,name', 'sort')) {
			foreach ($cates as $k => $v) {
				$cates[$k]['list'] = db::get_list2('help', 'title,url', "cid='$v[id]'", 'sort,timestamp desc', 1, 6);
			}
			$cates = array_chunk($cates, 2);
		}
	break;
	
	
	case 'taskout':
		$nav_bar = array(
			array('title' => $web_name, 'url' => '/'),
			array('title' => '刷钻流程')
		);
	break;
	case 'taskin':
		$nav_bar = array(
			array('title' => $web_name, 'url' => '/'),
			array('title' => '刷钻流程')
		);
	break;
	case 'text':
		$nav_bar = array(
			array('title' => $web_name, 'url' => '/'),
			array('title' => '刷钻流程')
		);
	break;
}
include(template::load($operation));
?>