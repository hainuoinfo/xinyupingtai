<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
$top_menu=array(
	'index' => '用户组列表',
	'add'   => '添加用户组',
	'edit'  => array('name' => '编辑用户组', 'hide' => true),
	'check' => '校验用户组数据'
);
if($edit=(int)$edit)$method='edit';
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$tbName = 'user_groups';
switch($method) {
	case 'index':
		if($rs = admin::getList($tbName, '*', '', 'sort', true)){
			admin::updateUserGroups();
			if ($rs == 2) {
				admin::show_message('删除成功', $base_url);
			} elseif ($rs == 3) {
				admin::show_message('更新成功', $base_url);
			}
		}
	break;
	case 'add':
		if ($rs = admin::insert($tbName, array('name'=>'f_name','key'=>'f_key'))) {
			admin::updateUserGroups();
			admin::show_message('添加成功', $base_url);
		} elseif ($rs<0) {
			if($rs==-1)admin::show_message('参数错误！');
			if($rs==-2)admin::show_message('参数错误！');
		}
	break;
	case 'edit':
		if ($rs = admin::update($tbName, array('name'=>'f_name','key'=>'f_key'), $edit)) {
			admin::updateUserGroups();
			admin::show_message('编辑成功', $base_url);
		} elseif ($rs<0) {
			if($rs==-1)admin::show_message('参数错误！');
			if($rs==-2)admin::show_message('参数错误！');
			if($rs==-3)admin::show_message('非法操作！');
		}
	break;
	case 'check':
		if (admin::confirm('您确定要校验用户组数据吗？这将花费一些时间')) {
			$noviceGroupId = $userGroups['novice']['id'];//普通用户ID
			db::update('members', array('groupid' => $noviceGroupId), "groupid='0'");
			db::update('user_groups', array('users' => 0));
			$query = $db->query("select groupid g,count(*) c from {$pre}members group by groupid");
			while ($line = $db->fetch_array($query)) {
				db::update('user_groups', array('users' => $line['c']), "id='$line[g]'");
			}
			admin::show_message('修改成功', $referer);
		}
	break;
}
?>