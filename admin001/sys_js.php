<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
($cache_file_sys_js_lib=cache::get_data('sys_js_lib'))&&(include($cache_file_sys_js_lib));
$cache_sys_js_lib||$cache_sys_js_lib=array();
if(form::is_form_hash()){
	$_POST=common::bf_stripslashes($_POST);
	$name_=$_POST['name'];
	$url_=$_POST['url'];
	$b_=$_POST['b'];
	$count=count($name_);
	$configs=$arr=$js_lib=array();
	for($i=0;$i<$count;$i++){
		$name=$name_[$i];
		$url=$url_[$i];
		$b=$b_[$i];
		if($name!=='' && $url!=='') {
			$arr['name']=$name;
			$arr['url']=$url;
			$arr['b']=$b;
			$configs[]=$arr;
			$js_lib[$name]=$url;
		}
	}
	//print_r($js_lib);
	//print_r($configs);exit;
	if($js_lib){
		$file=d('./class/javascript.php');
		$phpcode=file::read($file);
		$phpcode=preg_replace('/(\/\*config start\*\/).*?(\/\*config end\*\/)/s','$1private static $lib_list='.string::format_array($js_lib).';$2',$phpcode);
		file::write($file,$phpcode);
	}
	cache::write_data('sys_js_lib','<?php $cache_sys_js_lib='.string::format_array($configs).';');
	common::refresh();
}
?>