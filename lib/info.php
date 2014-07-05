<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
template::initialize('./templates/default/'.$action.'/', './cache/default/'.$action.'/');//
$ops = array('article');
($operation && in_array($operation, $ops)) || $operation = $ops[0];
switch ($operation) {
	case 'article':
		$nav_bar = array(
			array('title' => $web_name, 'url' => $weburl.'/')
		);
		$aid = preg_replace('/[^a-z0-9]/', '', $aid);
		$id = 0;
		if (is_numeric($aid)) {
			if (!($id = db::one_one('sys_article', 'id', "id='$aid'"))) {
				$id = db::one_one('sys_article', 'id', "ename='$aid'");
			}
		} else {
			$id = db::one_one('sys_article', 'id', "ename='$aid'");
		}
		if ($id) {
			$item = db::one('sys_article', 'title,content', "id='$id'");
			$a_title  = $item['title'];
			$content  = string::ubbdecode($item['content']);
			$nav_bar[] = array('title'=>$a_title);
			unset($item);
		}
		$list = db::get_list2('sys_article', 'id,ename,title', "cid='1'", 'sort,timestamp desc');
		include(template::load($operation));
	break;
}
?>