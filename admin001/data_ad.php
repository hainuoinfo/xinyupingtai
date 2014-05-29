<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
$top_menu=array(
	'index' => '广告分类',
	'add'   => '添加分类',
	'edit'  => array('name' => '编辑分类', 'hide' => true)
);
if($edit=(int)$edit)$method='edit';
if($view=(int)$view){
	if($editInfo=(int)$editInfo)$method='add_info';
	if(!$method)$method = 'view';
	if($cateInfo = db::one('ad_cate', '*', "id='$view'")){
		$top_menu['view']     = array('name' => $cateInfo['name'], 'hide' => false, 'attach' => '&view='.$view);
		$top_menu['add_info'] = array('name' => '添加'.$cateInfo['name'].'广告', 'hide' => false, 'attach' => '&view='.$view);
	}
}
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];

switch($method){
	case 'index':
		if(admin::getList('ad_cate', '*', '', '', true)==2){
			admin::show_message('删除成功', $base_url);
		}
	break;
	case 'add':
		if ($rs = admin::insert('ad_cate', array('name'=>'f_name'))) {
			admin::show_message('添加成功', $base_url);
		} elseif ($rs<0) {
			if($rs==-1)admin::show_message('参数错误！');
			if($rs==-2)admin::show_message('参数错误！');
		}
	break;
	case 'edit':
		if ($rs = admin::update('ad_cate', array('name'=>'f_name'), $edit)) {
			admin::show_message('编辑成功', $base_url);
		} elseif ($rs<0) {
			if($rs==-1)admin::show_message('参数错误！');
			if($rs==-2)admin::show_message('参数错误！');
			if($rs==-3)admin::show_message('非法操作！');
		}
	break;
	case 'view':
		if(admin::getList('ad', 'id,remark,marker', "cid='$view'", '', true)==2){
			admin::show_message('删除成功', $base_url.'&view='.$view);
		}
	break;
	case 'add_info':
		if($editInfo){
			if ($rs = admin::update('ad', array('remark'=>'f_remark', 'marker'=>'f_marker', 'content'=>'f_content'), $editInfo)) {
				admin::show_message('编辑成功', $base_url.'&view='.$view);
			} elseif ($rs<0) {
				if($rs==-1)admin::show_message('参数错误！');
				if($rs==-2)admin::show_message('参数错误！');
				if($rs==-3)admin::show_message('非法操作！');
			}
		} else {
			$_POST['f_cid'] = $view;
			if ($rs = admin::insert('ad', array('cid' => 'f_cid', 'remark'=>'f_remark', 'marker'=>'f_marker', 'content'=>'f_content'))) {
				admin::show_message('添加成功', $base_url.'&view='.$view);
			} elseif ($rs<0) {
				if($rs==-1)admin::show_message('参数错误！');
				if($rs==-2)admin::show_message('参数错误！');
			}
		}
	break;
}
?>