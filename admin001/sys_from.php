<?php
$top_menu=array(
	'list' => '来路列表',
	'add'  => '添加来路选项'
);
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
switch ($method) {
	case 'list':
		admin::getList('from_cate', '*', '', 'sort');
	break;
	case 'add':
		if (form::is_form_hash()) {
			$_POST && extract($_POST);
			if ($name) {
				db::insert('from_cate', array(
					'name'      => $name,
					'input'     => $input,
					'inputName' => $inputName
				));
				admin::show_message('添加成功', $base_url);
			}
		}
	break;
}
?>