<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
if ($view) {
	$tab = 'sub';
	$cateName = db::one_one('soft_cate', 'name', "id='$view'");
}
$tab || $tab = 'index';
switch ($tab){
	case 'index':
		$top_menu=array(
			'index' => '软件分类',
			'add'   => '添加分类',
			'edit'  => array('name' => '编辑分类', 'isHide' => true)
		);
		if($edit=(int)$edit)$method='edit';
		$top_menu_key = array_keys($top_menu);
		($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
		$tbName = 'soft_cate';
		switch($method){
			case 'index':
				if (form::is_form_hash()) {
					extract($_POST);
					if ($del) {
						db::del_ids($tbName, $del);
						db::del_keys('softs', $del, 'cid');
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
		$tbName = 'softs';
		$cid = $view;
		switch($method){
			case 'index':
				if (form::is_form_hash()) {
					extract($_POST);
					if ($del) {
						$dir1 = d('./img/soft/');
						$dir2 = d('./down/soft/');
						foreach ($del as $id) {
							if ($soft = db::one($tbName, 'cid,img,soft', "id='$id'")) {
								db::del_id($tbName, $id);
								db::update('soft_cate', 'total=total-1', "id='$soft[cid]'");
								@unlink($dir1.$soft['img']);
								@unlink($dir2.$soft['soft']);
							}
						}
						admin::show_message('删除完毕', $base_url);
					}
				}
				if ($total = db::data_count($tbName, "cid='$cid'")) {
					$list = db::get_list2($tbName, '*', "cid='$cid'",'timestamp desc',$page,$pagesize);
					$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&page={page}', $pagestyle);
				}
			break;
			case 'add':
				if (form::is_form_hash()) {
					$next = true;
					if ($next) {
						$savePath = d('./img/soft/');
						$savePath2 = date('Y/m/', $timestamp);
						$img = image::getImage('img', $savePath.$savePath2, 140, 100);
						if ($img !== false) {
							$img = $savePath2.$img;
						} else {
							$info = '上传软件封面失败';
							$next = false;
						}
					}
					if ($next) {
						$savePath = d('./down/soft/');
						$savePath2 = date('Y/m/', $timestamp);
						$soft = upload::getSoft('soft', $savePath.$savePath2);
						if ($soft !== false) {
							$soft = $savePath2.$soft;
							$size = filesize($savePath.$soft);
						} else {
							$info = '上传软件失败';
							$next = false;
						}
					}
					if ($next) {
						$_POST['cid']  = $cid;
						$_POST['img']  = $img;
						$_POST['soft'] = $soft;
						$_POST['size'] = $size;
						$_POST['timestamp'] = $timestamp;
						if (admin::insert($tbName, array('cid' => 'cid', 'title' => 'title', 'content'=>'content', 'img' => 'img', 'soft' => 'soft', 'size' => 'size', 'price' => 'price', 'credit' => 'credit', 'timestamp'=>'timestamp')) === true) {
							db::update('soft_cate', 'total=total+1',"id='$cid'");
							admin::show_message('添加成功',$base_url);
						}
						admin::show_message('添加失败');
					}
				}
				$price  || $price  = 0;
 				$credit || $credit = 0;
			break;
			case 'edit':
				$update = false;
				if ($item = db::one($tbName, '*', "id='$edit'")) {
					if (form::is_form_hash()) {
						$next = true;
						$size = 0;
						if ($next) {
							$savePath = d('./img/soft/');
							$savePath2 = date('Y/m/', $timestamp);
							$img = image::getImage('img', $savePath.$savePath2, 140, 100);
							if ($img !== false) {
								$img = $savePath2.$img;
							}
						}
						if ($next) {
							$savePath = d('./down/soft/');
							$savePath2 = date('Y/m/', $timestamp);
							$soft = upload::getSoft('soft', $savePath.$savePath2);
							if ($soft !== false) {
								$soft = $savePath2.$soft;
								$size = filesize($savePath.$soft);
							}
						}
						if ($next) {
							!$img  && $img  = $item['img'];
							!$soft && $soft = $item['soft'];
							!$size && $size = $item['size'];
							$_POST['cid']  = $cid;
							$_POST['img']  = $img;
							$_POST['soft'] = $soft;
							$_POST['size'] = $size;
							$_POST['timestamp'] = $timestamp;
							if (admin::update($tbName, array('cid' => 'cid', 'title' => 'title', 'content'=>'content', 'img' => 'img', 'soft' => 'soft', 'size' => 'size', 'price' => 'price', 'credit' => 'credit', 'timestamp'=>'timestamp'), $edit) === true) {
								if ($img != $item['img']) {
									@unlink(d('./img/soft/').$item['img']);
								}
								if ($soft != $item['soft']) {
									@unlink(d('./down/soft/').$item['soft']);
								}
								admin::show_message('修改成功',$base_url);
							}
						}
						if (admin::update($tbName, array('cid'=>'cid','name'=>'name','des'=>'des', 'content' => 'content', 'price' => 'price', 'count' => 'count', 'timestamp1'=>'timestamp1', 'timestamp2' => 'timestamp2'), $edit) === true) {
							admin::show_message('修改成功',$base_url);
						}
						admin::show_message('修改失败');
					}
					extract($item);
					$update = true;
				}
			break;
		}
	break;
}
?>