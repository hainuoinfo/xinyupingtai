<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
loadLib('bbs.forums');
$top_menu=array(
	'index' => '论坛基本设置'
);
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
if($edit=(int)$edit)$method='edit';
elseif($look=(int)$look)$method='look';
$tbName = 'forums';
switch($method){
	case 'index':
		if(form::is_form_hash()){
			extract($_POST);
			if($del || ($sort && $ids)){
				if($del){
					if(bbs_forums::delete($del)){
						admin::show_message('删除成功', $base_url);
					} else {
						admin::show_message('删除失败', $base_url);
					}
				} else {
					if(bbs_forums::updateSort($ids, $sort)){
						admin::show_message('更新成功', $base_url);
					} else {
						admin::show_message('更新失败', $base_url);
					}
				}
			}
		}
		$list = bbs_forums::getForums();
	break;
}
?>