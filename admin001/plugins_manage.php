<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
$top_menu=array(
	'all'         => '全部插件',
	'installed'   => '已安装插件',
	'uninstalled' => '未安装插件'/*,
	'upload'      => '上传插件'*/
);
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
if ($install) {
	//安装
	checkWrite();
	if (plugins::install($install)) {
		admin::show_message('安装成功', $referer);
	} else {
		admin::show_message('安装失败', $referer);
	}
} elseif ($uninstall) {
	//卸载
	checkWrite();
	if (plugins::uninstall($uninstall)) {
		admin::show_message('卸载成功', $referer);
	} else {
		admin::show_message('卸载失败', $referer);
	}
}
switch ($method) {
	case 'all':
		if (form::is_form_hash()) {
			if ($del = $_POST['del']) {
				plugins::delPlugins($del);
				admin::show_message('删除完毕', $referer);
			}
		}
		$list = plugins::getPlugins();
	break;
	case 'installed':
		$list = plugins::getPlugins('installed');
	break;
	case 'uninstalled':
		$list = plugins::getPlugins('uninstalled');
	break;
}
?>