<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
loadLib('bbs.forums');
$groups = array('所有用户'=>'0');
foreach($userGroups as $k=>$v){
	$groups[$v['name']]=$v['id'];
}
$top_menu=array(
	'index' => '版块列表',
	'add'   => '添加版块',
	'edit'  => array('name' => '编辑版块', 'hide' => true),
	'addModerator' => array('name' => '添加版主', 'hide' => true),
	'delModerator' => array('name' => '删除版主', 'hide' => true)
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
	case 'add':
		if(form::is_form_hash()){
			$_POST = common::filterHtml($_POST);
			$datas = form::get('name', 'ename', 'des',array('view_group_id','int'),array('view_credits','int'),array('post_group_id','int'),array('post_credits','int'));
			if(bbs_forums::add($datas['name'], $datas['ename'], $datas['des'], $datas['view_group_id'], $datas['view_credits'], $datas['post_group_id'], $datas['post_credits'])){
				admin::show_message('添加成功', $base_url);
			} else {
				admin::show_message('添加失败');
			}
		}
	break;
	case 'edit':
		if(form::is_form_hash()){
			if($_POST['isEdit']){
				$_POST = common::filterHtml($_POST);
				$datas = form::get('name', 'ename', 'des',array('view_group_id','int'),array('view_credits','int'),array('post_group_id','int'),array('post_credits','int'));
				if(bbs_forums::update($datas['name'], $datas['ename'], $datas['des'], $datas['view_group_id'], $datas['view_credits'], $datas['post_group_id'], $datas['post_credits'], $edit)){
					admin::show_message('修改成功', $base_url);
				} else {
					admin::show_message('修改失败');
				}
			} else {
				admin::show_message('非法操作！');
			}
		}
		if($forum = bbs_forums::getForum($edit)){
			if($datas = common::filterArray($forum, array('name', 'ename', 'des', 'view_group_id', 'view_credits', 'post_group_id', 'post_credits'))){
				extract($datas);
				unset($datas);
			}
			$update = true;
		} else {
			$update = false;
		}
	break;
	case 'addModerator':
		if (form::is_form_hash()) {
			$rs = bbs_forums::addModerator($fid, $_POST['username']);
			if ($rs === true) {
				admin::show_message('添加成功', $base_url);
			} else {
				$info = language::get($rs);
			}
		}
	break;
	case 'delModerator':
		if (admin::confirm('你确定要删除该版主吗？')) {
			bbs_forums::delModerator2($fid, $mid);
			admin::show_message('删除完毕', $base_url);
		}
	break;
}
?>