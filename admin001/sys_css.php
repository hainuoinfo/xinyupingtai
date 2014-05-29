<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
($cache_file_sys_css_lib=cache::get_data('sys_css_lib'))&&(include($cache_file_sys_css_lib));
$cache_sys_css_lib||$cache_sys_css_lib=array();
if(form::is_form_hash()){
	$_POST=common::bf_stripslashes($_POST);
	$name_=$_POST['name'];
	$url_=$_POST['url'];
	$b_=$_POST['b'];
	$count=count($name_);
	$configs=$arr=$css_lib=array();
	for($i=0;$i<$count;$i++){
		$name=$name_[$i];
		$url=$url_[$i];
		$b=$b_[$i];
		if($name!=='' && $url!=='') {
			$arr['name']=$name;
			$arr['url']=$url;
			$arr['b']=$b;
			$configs[]=$arr;
			$css_lib[$name]=$url;
		}
	}
	//print_r($css_lib);
	//print_r($configs);exit;
	if($css_lib){
		$file=d('./class/css.php');
		$phpcode=file::read($file);
		$phpcode=preg_replace('/(\/\*config start\*\/).*?(\/\*config end\*\/)/s','$1private static $lib_list='.string::format_array($css_lib).';$2',$phpcode);
		file::write($file,$phpcode);
	}
	cache::write_data('sys_css_lib','<?php $cache_sys_css_lib='.string::format_array($configs).';');
	common::refresh();
}
?>