<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
$top_menu=array(
	'index' => '变量列表',
	'add'   => '添加变量',
	'edit'  => array('name' => '编辑变量', 'hide' => true)
);
if($edit=(int)$edit)$method='edit';
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$tbName = 'vars';
switch($method){
	case 'index':
		if(admin::getList($tbName, '*', '', '', true)==2){
			admin::updateVars();
			admin::show_message('删除成功', $base_url);
		}
	break;
	case 'add':
		if ($rs = admin::insert($tbName, array('key'=>'f_key','val'=>'f_val','remark'=>'f_remark'))) {
			admin::updateVars();
			admin::show_message('添加成功', $base_url);
		} elseif ($rs<0) {
			if($rs==-1)admin::show_message('参数错误！');
			if($rs==-2)admin::show_message('参数错误！');
		}
	break;
	case 'edit':
		if ($rs = admin::update($tbName, array('key'=>'f_key','val'=>'f_val','remark'=>'f_remark'), $edit)) {
			admin::updateVars();
			admin::show_message('编辑成功', $base_url);
		} elseif ($rs<0) {
			if($rs==-1)admin::show_message('参数错误！');
			if($rs==-2)admin::show_message('参数错误！');
			if($rs==-3)admin::show_message('非法操作！');
		}
	break;
}
?>