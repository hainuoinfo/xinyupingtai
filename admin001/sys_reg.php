<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
$top_menu=array(
	'index' => '密码提问',
	'add'   => '添加提问',
	'edit'  => array('name' => '编辑提问', 'hide' => true)
);
if($edit=(int)$edit)$method='edit';
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$tbName = 'member_questions';
switch($method){
	case 'index':
		if($rs = admin::getList($tbName, '*', '', 'sort', true)){
			if ($rs > 1) {
				admin::updateQuestions();
				if ($rs == 2){
					if ($del = $_POST['del']) {
						$ids = '\''.implode('\',\'', $del).'\'';
						db::update('members', array('questionid' => 0), "id in($ids)");
					}
					admin::show_message('删除成功', $base_url);
				}
				if ($rs == 3)admin::show_message('更新成功', $base_url.'&page='.$page);
			}
		}
	break;
	case 'add':
		if ($rs = admin::insert($tbName, array('question'=>'f_question'))) {
			admin::updateQuestions();
			admin::show_message('添加成功', $base_url);
		} elseif ($rs<0) {
			if($rs==-1)admin::show_message('参数错误！');
			if($rs==-2)admin::show_message('参数错误！');
		}
	break;
	case 'edit':
		if ($rs = admin::update($tbName, array('question'=>'f_question'), $edit)) {
			admin::updateQuestions();
			admin::show_message('编辑成功', $base_url);
		} elseif ($rs<0) {
			if($rs==-1)admin::show_message('参数错误！');
			if($rs==-2)admin::show_message('参数错误！');
			if($rs==-3)admin::show_message('非法操作！');
		}
	break;
}
?>