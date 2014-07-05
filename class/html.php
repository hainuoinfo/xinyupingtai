<?php
class html{
	private static $cache_name='';
	public static $header='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">';
	public static $footer='</html>';
	public static $html='';
	public static function initialize(){
		
	}
	public static function cache_start($name,$out=true){
		if($out){
			$cache_file=WEB_ROOT.'./html/'.$name.'.htm';
			if(file_exists($cache_file)){
				ob_clean();
				echo file::read($cache_file);
				return;
			}
		}
		self::$cache_name=$name;
	}
	public static function cache_exists($name){
		return file_exists(WEB_ROOT.'./html/'.$name.'.htm');
	}
	public static function cache_del($name){
		$cache_file=WEB_ROOT.'./html/'.$name.'.htm';
		if(file_exists($cache_file)){
			@unlink($cache_file);
		}
	}
	public static function cache_end($clear=false){
		$html=ob_get_contents();
		common::create_folder(WEB_ROOT.'./html/');
		$write=@file::write(WEB_ROOT.'./html/'.self::$cache_name.'.htm',$html);
		$clear&&ob_clean();
		return $write;
	}
	public static function u_title($prefix){
		global $web_name,$city,$title;
		$title=$prefix.' | '.$web_name.$city['name'].'站';
	}
}
?>