<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
if ($view) {
	$tab = 'sub';
	$cateName = db::one_one('help_cate', 'name', "id='$view'");
}
$tab || $tab = 'index';
switch ($tab){
	case 'index':
		$top_menu=array(
			'index' => '帮助分类',
			'add'   => '添加分类',
			'edit'  => array('name' => '编辑分类', 'isHide' => true)
		);
		if($edit=(int)$edit)$method='edit';
		$top_menu_key = array_keys($top_menu);
		($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
		$tbName = 'help_cate';
		switch($method){
			case 'index':
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
					$list = db::get_list2($tbName, '*', '', 'sort', $page, $pagesize);
					$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&page={page}', $pagestyle);
				}
			break;
			case 'add':
				if (form::is_form_hash()) {
					//$datas = form::get('name');
					//$datas['timestamp'] = $timestamp;
					$datas = array('ico' => 'ico', 'name' => 'name');
					admin::insert($tbName, $datas);
					admin::show_message('添加完毕', $base_url);
				}
			break;
			case 'edit':
				if (form::is_form_hash()) {
					admin::update($tbName, array('ico' => 'ico', 'name' => 'name'), $edit);
					admin::show_message('修改完毕', $base_url);
				}
				$update = false;
				if ($item = db::one($tbName, 'ico,name', "id='$edit'")) {
					$ico  = $item['ico'];
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
		$tbName = 'help';
		$cid = $view;
		switch($method){
			case 'index':
				if (form::is_form_hash()) {
					extract($_POST);
					if ($del) {
						foreach ($del as $id) {
							if ($cid = db::one_one($tbName, 'cid', "id='$id'")) {
								db::del_id($tbName, $id);
								db::update('help_cate', 'total=total-1', "id='$cid'");
							}
						}
						admin::show_message('删除完毕', $base_url);
					}
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
				if ($total = db::data_count($tbName, "cid='$cid'")) {
					$list = db::get_list2($tbName, '*', "cid='$cid'",'sort,timestamp desc',$page,$pagesize);
					$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&page={page}', $pagestyle);
				}
			break;
			case 'add':
				if (form::is_form_hash()) {
					$_POST['cid'] = $cid;
					$_POST['timestamp'] = $timestamp;
					admin::insert($tbName, array('cid'=>'cid','title'=>'title','url'=>'url','timestamp'=>'timestamp'));
					db::update('help_cate', 'total=total+1',"id='$cid'");
					admin::show_message('添加成功',$base_url);
				}
			break;
			case 'edit':
				if (form::is_form_hash()) {
					$_POST['timestamp'] = $timestamp;
					admin::update($tbName, array('title'=>'title','url'=>'url','timestamp'=>'timestamp'), $edit);
					admin::show_message('修改完毕', $base_url);
				}
				$update = false;
				if ($item = db::one($tbName, '*', "id='$edit'")) {
					$title = $item['title'];
					$url   = $item['url'];
					$update = true;
				}
			break;
		}
	break;
}
?>