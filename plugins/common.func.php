<?php
!defined('IN_QS_PLUGIN') && IN_QS_PLUGIN !== true && exit('error');
function pluginReplaceArgs($files, $args){
	if (is_array($files) && is_array($args)) {
		foreach ($files as $v) {
			$s = $v['s'];
			$d = $v['d'];
			if (file_exists($s)) {
				$code = file::read($s);
				$code = common::replaceVars($code, $args);//preg_replace('/\{(\w+)\}/e', '$args[\'$1\']', $code);
				file::write($d, $code);
			}
		}
		return true;
	}
	return false;
}
function pluginClearFiles($files){
	if (is_array($files)) {
		foreach ($files as $v) {
			@unlink($v['d']);
		}
	}
}
function pluginMessage($msg, $url = ''){
	admin::show_message($msg, $url);
}
?>