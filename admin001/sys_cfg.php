<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
if (isset($view) && ($view = intval($view))) {
	if ($cate = cfg::getCate($view)) {
		$tab = 'cfg';
		$cateListUrl = $base_url.'&method=cateList';
		$base_url.='&view='.$view;
	}
}
isset($tab) || $tab = 'cate';
switch ($tab) {
	case 'cate':
		$top_menu=array(
			'cateList' => '配置分类列表',
			'addCate'   => '添加配置分类',
			'editCate'  => array('name' => '编辑配置分类', 'isHide' => true)
		);
		if($edit=(int)$edit)$method='edit';
		$top_menu_key = array_keys($top_menu);
		($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
		switch($method){
			case 'cateList':
				if (form::is_form_hash()) {
					extract(form::get3('del'));
					if ($del) {
						cfg::delCate($del);
						admin::show_message('删除完毕', $base_url.'&method=cateList');
					}
				}
				if ($total = cfg::getCateTotal()) {
					$list = cfg::getCates($page, $pagesize);
					$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&page={page}', $pagestyle);
				}
			break;
			case 'addCate':
				if (form::is_form_hash()) {
					extract(form::get3('name', 'remark'));
					$rs = cfg::addCate($name, $remark);
					if (is_numeric($rs) && $rs > 0) {
						admin::show_message('添加成功', $base_url.'&method=index');
					} else admin::show_message($rs);
				}
			break;
			case 'editCate':
				if (form::is_form_hash()) {
					extract(form::get3('name', 'remark'));
					$rs = cfg::editCate($name, $remark, $id);
					if ($rs === true) {
						admin::show_message('修改成功', $base_url.'&method=index');
					} else admin::show_message($rs);
				}
				if ($item = cfg::getCate($id)) {
					$update = true;
					extract(common::filterArray($item, array('name', 'remark')));
				} else admin::show_message('很抱歉，不存在该分类');
			break;
		}
	break;
	case 'cfg':
		$top_menu=array(
			'back' => array(
				'name' => '返回配置列表',
				'url'  => $cateListUrl,
				'hide' => false
			),
			'cfgList'     => '配置列表',
			'cfgListInfo' => '配置信息',
			'addCfg'      => '添加配置',
			'editCfg'     => array('name' => '编辑配置', 'isHide' => true)
		);
		if($edit=(int)$edit)$method='edit';
		$top_menu_key = array_keys($top_menu);
		($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[1];
		switch($method){
			case 'cfgList':
				if (form::is_form_hash()) {
					extract(form::get3('del'));
					if ($del) {
						$delCount = cfg::delCfg($del);
						admin::show_message('成功删除'.$delCount.'条配置信息', $base_url.'&method=cfgList');
					}
				}
				if ($total = cfg::getCfgTotal($cate['id'])) {
					$list = cfg::getCfgs($cate['id'], $page, $pagesize);
					$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method=cfgList&page={page}', $pagestyle);
				}
			break;
			case 'cfgListInfo':
				if (form::is_form_hash()) {
					if (cfg::setCfg($cate['id'], $_POST)) {
						admin::show_message('设置成功', $base_url.'&method=cfgListInfo');
					} else admin::show_message('设置失败！');
				}
				$list = cfg::getCfgs($cate['id'], 0, 0);
			break;
			case 'addCfg':
				if (form::is_form_hash()) {
					extract(form::get3('name', 'type', 'attach', 'remark'));
					$rs = cfg::addCfg($cate['id'], $name, $type, $attach, $remark);
					if (is_numeric($rs) && $rs > 0) {
						admin::show_message('添加成功', $base_url.'&method=index');
					} else admin::show_message($rs);
				}
			break;
			case 'editCfg':
				if (form::is_form_hash()) {
					extract(form::get3('name', 'type', 'attach', 'remark'));
					$rs = cfg::editCfg($id, $name, $type, $attach, $remark);
					if ($rs === true) {
						admin::show_message('修改成功', $base_url.'&method=index');
					} else admin::show_message($rs);
				}
				if ($item = cfg::getCfg($id)) {
					$update = true;
					extract(common::filterArray($item, array('name', 'type', 'attach', 'remark')));
				} else admin::show_message('很抱歉，不存在该分类');
			break;
		}
	break;
}
?>