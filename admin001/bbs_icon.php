<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
$top_menu=array(
	'index' => '积分等级'
);
if($edit=(int)$edit)$method='edit';
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
loadLib('bbs.thread');
switch($method){
	case 'index':
		if (form::is_form_hash()) {
			extract($_POST);
			$c = count($sort);
			$icons = $sorts = array();
			for ($i = 0; $i < $c; $i++) {
				$sid = intval($sort[$i]);
				$ico = $icon[$i];
				$tit = $title[$i];
				$sorts[] = $sid;
				$icons[] = array('sort' => $sid, 'icon' => $ico, 'title' => $tit);
			}
			array_multisort($sorts, SORT_ASC, SORT_NUMERIC, $icons);
			if (bbs_thread::saveIcons($icons)) {
				admin::show_message('添加成功', $base_url);
			} else {
				admin::show_message('添加失败');
			}
		}
		$icons = bbs_thread::getIcons();
	break;
}
?>