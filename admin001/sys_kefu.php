<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
if ($view) {
	$tab = 'sub';
	$cateName = kefu::getCateName($view);
}
$tab || $tab = 'index';
switch ($tab){
	case 'index':
		$top_menu=array(
			'index' => '客服分类',
			'add'   => '添加分类',
			'edit'  => array('name' => '编辑分类', 'isHide' => true)
		);
		if($edit=(int)$edit)$method='edit';
		$top_menu_key = array_keys($top_menu);
		($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
		switch($method){
			case 'index':
				if (form::is_form_hash()) {
					extract($_POST);
					if ($del) {
						kefu::delCate($del);
						admin::show_message('删除完毕', $base_url);
					}
					kefu::setSort($ids, $sort);
					admin::show_message('设置排序完成', $base_url);
				}
				if ($total = kefu::getCateTotal()) {
					$list = kefu::getCates();
					$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&page={page}', $pagestyle);
				}
			break;
			case 'add':
				if (form::is_form_hash()) {
					extract($_POST);
					if ($name) {
						if (kefu::addCate($name)) {
							admin::show_message('添加成功', $base_url);
						} else {
							admin::show_message('添加失败，请重试，可能添加的分类名已经存在了');
						}
					} else {
						$info = '参数错误';
					}
				}
			break;
			case 'edit':
				if (form::is_form_hash()) {
					extract($_POST);
					kefu::editCate($edit, $name);
					admin::show_message('修改完毕', $base_url);
				}
				$name = kefu::getCateName($edit);
			break;
		}
	break;
	case 'sub':
		$base_url.='&view='.$view;
		$top_menu=array(
			'index' => $cateName.'客服列表',
			'add'   => '添加'.$cateName.'客服',
			'edit'  => array('name' => '编辑'.$cateName.'客服', 'isHide' => true)
		);
		if($edit=(int)$edit)$method='edit';
		$top_menu_key = array_keys($top_menu);
		($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
		switch($method){
			case 'index':
				if (form::is_form_hash()) {
					extract($_POST);
					if ($del) {
						kefu::delKefu($del);
						admin::show_message('删除完毕', $base_url);
					}
					kefu::setKefuSort($ids, $sort);
					admin::show_message('设置排序完成', $base_url);
				}
				if ($total = kefu::getKefuTotal($view)) {
					$list = kefu::getKefuList($view);
					$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&page={page}', $pagestyle);
				}
			break;
			case 'add':
				if (form::is_form_hash()) {
					extract($_POST);
					$savePath = d('./img/kefu/avatar/');
					$savePath2 = date('Y/m/', $timestamp);
					$avatar = image::getImage('pic', $savePath.$savePath2, 120, 100);
					if ($avatar !== false) {
						$avatar = $savePath2.$avatar;
						kefu::addKefu($view, $nickname, $avatar, $qq);
						admin::show_message('添加成功', $base_url);
					} else {
						$info = '上传头像失败';
					}
				}
			break;
			case 'edit':
				if (form::is_form_hash()) {
					extract($_POST);
					$savePath = d('./img/kefu/avatar/');
					$savePath2 = date('Y/m/', $timestamp);
					$avatar = image::getImage('pic', $savePath.$savePath2, 120, 100);
					if ($avatar !== false) {
						$avatar = $savePath2.$avatar;
					}
					kefu::editKefu($edit, $nickname, $avatar, $qq);
					admin::show_message('修改完毕', $base_url);
				}
				$update = false;
				if ($kefu = kefu::getKefu($edit)) {
					$update = true;
				}
			break;
		}
	break;
}
?>