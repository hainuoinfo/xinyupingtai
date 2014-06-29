<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
if ($view) {
	$tab = 'sub';
	$cateName = db::one_one('shop_cate', 'name', "id='$view'");
}
$tab || $tab = 'index';
switch ($tab){
	case 'index':
		$top_menu=array(
			'index' => '商品分类',
			'add'   => '添加分类',
			'edit'  => array('name' => '编辑分类', 'isHide' => true)
		);
		if($edit=(int)$edit)$method='edit';
		$top_menu_key = array_keys($top_menu);
		($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
		$tbName = 'shop_cate';
		switch($method){
			case 'index':
				if (form::is_form_hash()) {
					extract($_POST);
					if ($del) {
						db::del_ids($tbName, $del);
						db::del_keys('shops', $del, 'cid');
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
					$list = db::get_list2($tbName, '*', '', 'sort', $page, $pagesize);
					$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&page={page}', $pagestyle);
				}
			break;
			case 'add':
				if (form::is_form_hash()) {
					//$datas = form::get('name');
					//$datas['timestamp'] = $timestamp;
					$datas = array('name' => 'name');
					admin::insert($tbName, $datas);
					admin::show_message('添加完毕', $base_url);
				}
			break;
			case 'edit':
				if (form::is_form_hash()) {
					admin::update($tbName, array('name' => 'name'), $edit);
					admin::show_message('修改完毕', $base_url);
				}
				$update = false;
				if ($item = db::one($tbName, 'name', "id='$edit'")) {
					$name = $item['name'];
					$update = true;
				}
			break;
		}
	break;
	case 'sub':
		$base_url.='&view='.$view;
		$top_menu=array(
			'index' => $cateName.'列表',
			'add'   => '添加'.$cateName,
			'edit'  => array('name' => '编辑'.$cateName, 'isHide' => true)
		);
		if($edit=(int)$edit)$method='edit';
		$top_menu_key = array_keys($top_menu);
		($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
		$tbName = 'shops';
		$cid = $view;
		switch($method){
			case 'index':
				if (form::is_form_hash()) {
					extract($_POST);
					if ($del) {
						foreach ($del as $id) {
							if ($shop = db::one($tbName, 'cid,status', "id='$id'")) {
								db::del_id($tbName, $id);
								db::update('shop_cate', 'total1=total1-1'.($shop['status']==0?',total3=total3-1':($shop['status']==2?',total2=total2-1':'')), "id='$shop[cid]'");
							}
						}
						admin::show_message('删除完毕', $base_url);
					}
				}
				if ($total = db::data_count($tbName, "cid='$cid'")) {
					$list = db::get_list2($tbName, '*', "cid='$cid'",'timestamp1 desc',$page,$pagesize);
					$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&page={page}', $pagestyle);
				}
			break;
			case 'add':
				if (form::is_form_hash()) {
					if ($expire_datetime = $_POST['expire_datetime']) {
						$timestamp2 = time::get_general_timestamp($expire_datetime) + time::$define_list['DAY'] - 1;
					} else {
						$timestamp2 = 0;
					}
					if ($timestamp2 < $timestamp) $timestamp2 = 0;
					$_POST['cid'] = $cid;
					$_POST['timestamp1'] = $timestamp;
					$_POST['timestamp2'] = $timestamp2;
					if (admin::insert($tbName, array('cid'=>'cid','name'=>'name','des'=>'des', 'content' => 'content', 'price' => 'price', 'count' => 'count', 'timestamp1'=>'timestamp1', 'timestamp2' => 'timestamp2')) === true) {
						db::update('shop_cate', 'total1=total1+1,total3=total3+1',"id='$cid'");
						admin::show_message('添加成功',$base_url);
					}
					admin::show_message('添加失败');
				}
			break;
			case 'edit':
				if (form::is_form_hash()) {
					if ($expire_datetime = $_POST['expire_datetime']) {
						$timestamp2 = time::get_general_timestamp($expire_datetime) + time::$define_list['DAY'] - 1;
					} else {
						$timestamp2 = 0;
					}
					if ($timestamp2 < $timestamp) $timestamp2 = 0;
					$_POST['cid'] = $cid;
					$_POST['timestamp1'] = $timestamp;
					$_POST['timestamp2'] = $timestamp2;
					if (admin::update($tbName, array('cid'=>'cid','name'=>'name','des'=>'des', 'content' => 'content', 'price' => 'price', 'count' => 'count', 'timestamp1'=>'timestamp1', 'timestamp2' => 'timestamp2'), $edit) === true) {
						admin::show_message('修改成功',$base_url);
					}
					admin::show_message('修改失败');
				}
				$update = false;
				if ($item = db::one($tbName, '*', "id='$edit'")) {
					extract($item);
					if ($timestamp2) $expire_datetime = date('Y-m-d', $timestamp2);
					else $expire_datetime = '';
					$update = true;
				}
			break;
		}
	break;
}
?>