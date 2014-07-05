<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
if (admin::confirm('是否确定清理多余的模板？')) {
	$ignoreAdminList = array('index.php' ,'admin.rar', 'sys_menu.php');
	$ignoreTplList   = array('index.htm', 'header.htm', 'footer.htm', 'confirm.htm', 'login.htm', 'show_message.htm', 'css.htm');
	$tplList = $adminList = $delTplList = $delAdminList = array();
	foreach ($menus as $k => $v) {
		if ($v['sub']) {
			foreach ($v['sub'] as $k2 => $v2) {
				$name = $k.'_'.$k2;
				$tplList[]   = $name.'.htm';
				$adminList[] = $name.'.php';
			}
		}
	}
	$adminList = array_merge($adminList, $ignoreAdminList);
	$tplList   = array_merge($tplList, $ignoreTplList);
	foreach(file::getFiles(ADMIN_ROOT) as $file){
		if (array_search($file, $adminList)===false) {
			$delAdminList[] = $file;
		}
	}
	$tplRoot = template::getTpl();
	foreach	(file::getFiles($tplRoot) as $file) {
		if (array_search($file, $tplList)===false) {
			$delTplList[] = $file;
		}
	}
	$delAdmin = $delTpl = 0;
	foreach ($delAdminList as $file) {
		if (@unlink(ADMIN_ROOT.$file)) {
			$delAdmin++;
		}
	}
	foreach ($delTplList as $file) {
		if (@unlink($tplRoot.$file)) {
			$delTpl++;
		}
	}
	admin::show_message('成功删除了'.$delAdmin.'个后台程序文件，'.$delTpl.'个模板文件');
}
exit;
?>