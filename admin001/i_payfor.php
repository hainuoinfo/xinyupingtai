<?php
$top_menu=array(
	'index' => '充值接口列表',
	'add'   => '添加充值接口',
	'edit'  => array('name' => '编辑充值接口', 'isHide' => true)
);
if($edit=(int)$edit)$method='edit';
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];

switch($method){
	case 'index':
		admin::getList('payfor_interface', '*', '', 'sort,type,time desc');
	break;
	case 'add':
		if (form::is_form_hash()) {
			$_POST['time'] = $timestamp;
			if (admin::insert('payfor_interface', array(
				'name'     => 'name',
				'ename'    => 'ename',
				'type'     => 'type',
				'username' => array('name' => 'username', 'must' => false),
				'userid'   => array('name' => 'userid'  , 'must' => false),
				'userpwd'  => array('name' => 'userpwd' , 'must' => false),
				'status'   => 'status',
				'time'     => 'time'
			)) === true) {
				admin::show_message('添加成功！', $base_url.'&method=index');
			} else admin::show_message('添加失败');
		}
	break;
	case 'edit':
		$update = false;
		if ($datas = db::one('payfor_interface', 'name,ename,type,username,userid,userpwd,status,time', "id='$edit'")) {
			if (form::is_form_hash()) {
				$_POST['time'] = $timestamp;
				if (admin::update('payfor_interface', array(
					'name'     => 'name',
					'ename'    => 'ename',
					'type'     => 'type',
					'username' => array('name' => 'username', 'must' => false),
					'userid'   => array('name' => 'userid'  , 'must' => false),
					'userpwd'  => array('name' => 'userpwd' , 'must' => false),
					'status'   => 'status',
					'time'     => 'time'
				), $edit) === true) {
					admin::show_message('编辑成功！', $base_url.'&method=index');
				} else admin::show_message('编辑失败！！');
			}
			$update = true;
			extract($datas);
		} else {
			admin::show_message('对不起，该接口数据不存在！');
		}
	break;
}
?>