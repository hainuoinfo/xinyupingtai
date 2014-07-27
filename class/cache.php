<?php
class cache{
	public static function write_rewrite($name,$data){
		$file=d('./cache/rewrite/'.$name.'.php');
		file::write($file,$data);
		return $file;
	}
	public static function get_rewrite($name){
		$file=d('./cache/rewrite/'.$name.'.php');
		if(file_exists($file))return $file;
		return false;
	}
	public static function write_data($name,$data){
		$file=d('./cache/data/'.$name.'.php');
		file::write($file,$data);
		return $file;
	}
	public static function get_data($name){
		$file=d('./cache/data/'.$name.'.php');
		if(file_exists($file))return $file;
		return false;
	}
	public static function write_area($name,$array){
		$dir  = d('./cache/area/');
		$file = $dir.$name.'.php';
		file_exists($dir) || common::create_folder($dir);
		/*file::write($file,'<?php $area='.string::format_array($array).';?>');*/
		file::write($file,'<?php exit;?>'.serialize($array));
		return $file;
	}
	public static function get_area($name){
		$file=d('./cache/area/'.$name.'.php');
		$rn=array();
		if(file_exists($file)){
			$rn=@unserialize(substr(file::read($file),13));
			!is_array($rn) && $rn=array();
		}
		return $rn;
	}
	public static function write_cate($name,$array){
		$file=d('./cache/cate/'.$name.'.php');
		file::write($file,'<?php $cate='.string::format_array($array).';?>');
		return $file;
	}
	public static function get_cate($name){
		$file=d('./cache/cate/'.$name.'.php');
		if(file_exists($file)){
			include($file);
			return $cate;
		}
		return false;
	}
	public static function write_text($name,$data){
		$file=d('./cache/text/'.$name.'.txt');
		file::write($file,$data);
		return $file;
	}
	public static function get_text($name){
		$file=d('./cache/text/'.$name.'.txt');
		if(file_exists($file)){
			return file::read($file);
		}
		return false;
	}
	public static function write_code($name,$data){
		$file=d('./cache/code/'.$name.'.php');
		file::write($file,'<?php '.$data.';?>');
		return $file;
	}
	public static function get_code($name){
		$file=d('./cache/code/'.$name.'.php');
		if(file_exists($file)){
			return $file;
		}
		return false;
	}
	public static function write_php($name,$data){
		$file=d('./cache/php/'.$name.'.php');
		file::write($file,'<?php '.$data.';?>');
		return $file;
	}
	public static function get_php($name){
		$file=d('./cache/php/'.$name.'.php');
		if(file_exists($file)){
			return $file;
		}
		return false;
	}
	public static function write_array($name,$arr){
echo '<pre>';
		$file=d('./cache/array/'.$name.'.php');
		$result=file::write($file,'<?php exit;?>'.serialize($arr));
	}
	public static function delete_array($name){
		$file=d('./cache/array/'.$name.'.php');
		return @unlink($file);
	}
	public static function get_array($name,$return=false) {
		$rn=array();
		$file=d('./cache/array/'.$name.'.php');
		if(file_exists($file)){
			$rn=@unserialize(substr(file::read($file),13));
			!is_array($rn) && $rn=array();
		}
		if($return)return $rn;
		else $GLOBALS[$name]=$rn;
	}
	public static function write_js($name,$data){
		$file=d('./cache/js/'.$name.'.js');
		file::write($file,$data);
		return $file;
	}
	public static function get_js($name){
		$file=d('./cache/js/'.$name.'.js');
		if(file_exists($file))return u($file);
		return false;
	}
}
?>
