<?php
class javascript{
	private static $js_list=array();
	private static $js_code_list=array();
	private static $lib_path='',$lib_url;
	//private static $lib_list=array('jquery'=>'jquery.min.js','jquery_ui'=>'jquery-ui.min.js');
	/*config start*/private static $lib_list=array('jquery'=>'jquery.min.js','jquery_ui'=>'jquery-ui.min.js','form_hack'=>'form_hack.js','xheditor'=>'/js_lib/xheditor/xheditor-zh-cn.min.js','get_css'=>'get_css.js','xheditor_ubb'=>'/js_lib/xheditor/xheditor_plugins/ubb.min.js','i1'=>'index/index.js','ckeditor'=>'/js_lib/ckeditor/ckeditor.js','i2'=>'index/index_ex.js','formValidator'=>'form_validator.js','common'=>'common.func.js','datePicker'=>'datepicker.js','messager'=>'jquery.messager.js');/*config end*/
	public static function initialize(){
		global $weburl;
		self::$lib_path=$weburl.'/javascript/';
		self::$lib_url=$weburl;
	}
	public static function select($js){
		if(array_search($js,self::$js_list)===false)self::$js_list[]=$js;
	}
	public static function select_lib(){
		foreach(func_get_args() as $lib_name){
			if(self::$lib_list[$lib_name]){
				if(substr(self::$lib_list[$lib_name],0,1)=='/')self::select(self::$lib_url.self::$lib_list[$lib_name]);
				else self::select(self::$lib_path.self::$lib_list[$lib_name]);
			}
			//self::$lib_list[$lib_name]&&self::select(self::$lib_path.self::$lib_list[$lib_name]);
		}
	}
	public static function add_code($code){
		self::$js_code_list[]=$code;
	}
	public static function output($return=false){
		$js_code='';
		foreach(self::$js_list as $js){
			$js_code.='<script type="text/javascript" src="'.$js.'"></script>';
		}
		foreach(self::$js_code_list as $code){
			$js_code.=$code;
		}
		self::$js_code_list=array();
		self::$js_list=array();
		if($return)return $js_code;
		echo $js_code;
	}
	public static function get_js($name,$folder=''){
		$folder&&($folder.='/');
		return '<script type="text/javascript" src="'.self::$lib_path.$folder.$name.'.js'.'"></script>';
	}
	public static function getUrl($name, $folder=''){
		$folder && ($folder.='/');
		return self::$lib_path.$folder.$name.'.js';
	}
}
javascript::initialize();
?>