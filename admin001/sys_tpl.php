<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
($cache_file_sys_tpl_marker=cache::get_data('sys_tpl_marker'))&&(include($cache_file_sys_tpl_marker));
$cache_sys_tpl_marker||$cache_sys_tpl_marker=array();
if(form::is_form_hash()){
	$_POST=common::bf_stripslashes($_POST);
	$m_=$_POST['m'];
	$d_=$_POST['d'];
	$o_=array_values($_POST['o']);
	$a_=$_POST['a'];
	$b_=$_POST['b'];
	$count=count($m_);
	$configs=$arr=array();
	$replace='';
	for($i=0;$i<$count;$i++){
		$m=$m_[$i];
		$d=$d_[$i];
		$o=$o_[$i];
		$a=$a_[$i];
		$b=$b_[$i];
		if($m!=='' && $d!=='') {
			$arr['m']=$m;
			$arr['d']=$d;
			$arr['o']=$o==1?true:false;
			$arr['a']=$a;
			$arr['b']=$b;
			$replace.='$replace[]=array(\''.addcslashes($arr['m'],'\'\\').'\',\''.addcslashes($arr['d'],'\'\\').'\','.($arr['o']?'true':'false').','.($arr['a']?$arr['a']:'array()').');';
			$configs[]=$arr;
		}
	}
	if($replace){
		$file=d('./class/parse_php.php');
		$phpcode=file::read($file);
		$phpcode=preg_replace('/(\/\*marker start\*\/).*?(\/\*marker end\*\/)/s','$1'.$replace.'$2',$phpcode);
		file::write($file,$phpcode);
	}
	cache::write_data('sys_tpl_marker','<?php $cache_sys_tpl_marker='.string::format_array($configs).';');
	common::refresh();
}
?>