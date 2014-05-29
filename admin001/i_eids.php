<?php
$top_menu=array(
	'index' => '快递单号列表',
	'add'   => '添加快递单号'
);
if($edit=(int)$edit)$method='edit';
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];

switch($method){
	case 'index':
		admin::getList('eids', '*', '', 'status,addTime desc');
	break;
	case 'add':
		if (form::is_form_hash()) {
			$_POST['timestamp'] = $timestamp;
			if (admin::insert('eids', array('eid' => 'eid', 'addTime' => 'timestamp')) === true) {
				admin::show_message('添加成功', $base_url);
			} else {
				admin::show_message('添加失败');
			}
		}
	break;
}
?>