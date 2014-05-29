<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
if ($view) {
	$tab = 'sub';
	$cateName = b_nav::getMenuName($view);
}
$tab || $tab = 'index';
switch ($tab){
	case 'index':
		$top_menu=array(
			'index' => '菜单列表',
			'add'   => '添加菜单',
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
						b_nav::del($del);
						admin::show_message('删除完毕', $base_url);
					}
					b_nav::setSort($ids, $sort);
					admin::show_message('设置排序完成', $base_url);
				}
				$list = b_nav::getMenus();
			break;
			case 'add':
				if (form::is_form_hash()) {
					extract($_POST);
					if ($f_name && $f_ename) {
						if (b_nav::add($f_name, $f_ename, 0)) {
							admin::show_message('添加成功', $base_url);
						} else {
							admin::show_message('添加失败，请重试！');
						}
					} else {
						$info = '参数错误';
					}
				}
			break;
			case 'edit':
				if (form::is_form_hash()) {
					extract($_POST);
					if (b_nav::edit($f_name, $f_ename, $edit)) {
						admin::show_message('修改成功', $base_url);
					} else {
						admin::show_message('修改失败');
					}
				}
				if ($menu = b_nav::getMenu($edit)) {
					$f_name  = $menu['name'];
					$f_ename = $menu['ename'];
				}
			break;
		}
	break;
	case 'sub':
		$base_url.='&view='.$view;
		$top_menu=array(
			'index' => $cateName.'菜单列表',
			'add'   => '添加'.$cateName.'菜单',
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
						b_nav::del($del);
						admin::show_message('删除完毕', $base_url);
					}
					b_nav::setSort($ids, $sort);
					admin::show_message('设置排序完成', $base_url);
				}
				$list = b_nav::getSubMenus($view);
			break;
			case 'add':
				if (form::is_form_hash()) {
					extract($_POST);
					if ($f_name && $f_ename) {
						if (b_nav::add($f_name, $f_ename, $view)) {
							admin::show_message('添加成功', $base_url);
						} else {
							admin::show_message('添加失败，请重试！');
						}
					} else {
						$info = '参数错误';
					}
				}
			break;
			case 'edit':
				if (form::is_form_hash()) {
					extract($_POST);
					if (b_nav::edit($f_name, $f_ename, $edit)) {
						admin::show_message('修改成功', $base_url);
					} else {
						admin::show_message('修改失败');
					}
				}
				if ($menu = b_nav::getMenu($edit)) {
					$f_name  = $menu['name'];
					$f_ename = $menu['ename'];
				}
			break;
		}
	break;
}
?>