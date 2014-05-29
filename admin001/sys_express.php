<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
$top_menu=array(
	'index' => '快递列表',
	'add'   => '添加快递',
	'edit'  => array('name' => '编辑分类', 'isHide' => true)
);
if($edit=(int)$edit)$method='edit';
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$tbName = 'express';
switch($method){
	case 'index':
		if ($status = (int)$status) {
			db::update($tbName, 'status=1-status', "id='$status'");
			admin::show_message('修改成功', $base_url.'&method='.$method);
		}
		if (form::is_form_hash()) {
			extract($_POST);
			if ($del) {
				db::del_ids($tbName, $del);
				db::del_keys('help', $del, 'cid');
			}
			$count = count($ids);
			for ($i = 0; $i < $count; $i++) {
				$id  = $ids[$i];
				$sid = $sort[$i];
				db::update($tbName, array('sort' => $sid), "id='$id'");
			}
			admin::show_message('设置排序完成', $base_url);
		}
		if ($total = db::data_count($tbName)) {
			$list = db::get_list2($tbName, 'id,sort,name,marker,timestamp,status', '', 'sort,timestamp desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&page={page}', $pagestyle);
		}
	break;
	case 'add':
		if (form::is_form_hash()) {
			$_POST['timestamp'] = $timestamp;
			$datas = array('name' => 'name', 'marker' => 'marker', 'city1' => 'city1', 'city2' => 'city2', 'city3' => 'city3', 'timestamp' => 'timestamp');
			$eid = admin::insert($tbName, $datas, true);
			if ($eid > 0) {
				admin::updateExpress($eid);
			}
			admin::show_message('添加完毕', $base_url);
		}
	break;
	case 'edit':
		if (form::is_form_hash()) {
			$_POST['timestamp'] = $timestamp;
			$datas = array('name' => 'name', 'marker' => 'marker', 'city1' => 'city1', 'city2' => 'city2', 'city3' => 'city3', 'timestamp' => 'timestamp');
			if (admin::update($tbName, $datas, $edit) === true) {
				admin::updateExpress($edit);
			}
			admin::show_message('修改完毕', $base_url);
		}
		$update = false;
		if ($item = db::one($tbName, '*', "id='$edit'")) {
			$name = $item['name'];
			$marker = $item['marker'];
			$city1 = $item['city1'];
			$city2 = $item['city2'];
			$city3 = $item['city3'];
			$update = true;
		}
	break;
}
?>