<?php
class css{
	private static $css_list=array();
	private static $lib_path='';
	//private static $lib_list=array('jquery_ui'=>'jquery/ui/jquery-ui.css');
	/*config start*/private static $lib_list=array('jquery_ui'=>'jquery/ui/jquery-ui.css','editor'=>'index/editor/index.css','i_seller1'=>'index/daylight/mgr_index.css','i_seller2'=>'index/daylight/datePicker.css');/*config end*/
	public static function initialize(){
		global $weburl;
		self::$lib_path=$weburl.'/css/';
	}
	public static function select($css){
		if(array_search($css,self::$css_list)===false)self::$css_list[]=$css;
	}
	public static function select_lib(){
		foreach(func_get_args() as $lib_name){
			self::$lib_list[$lib_name]&&self::select(self::$lib_path.self::$lib_list[$lib_name]);
		}
	}
	public static function get_css($name, $folder='', $suffix='.css'){
		$folder && ($folder.='/');
		return '<link href="'.self::$lib_path.$folder.$name.$suffix.'" rel="stylesheet" type="text/css" />';
	}
	public static function getUrl($name, $folder='', $suffix='.css'){
		$folder && ($folder.='/');
		return self::$lib_path.$folder.$name.$suffix;
	}
	public static function output($return=false){
		$css_code='';
		foreach(self::$css_list as $css){
			$css_code.='<link href="'.$css.'" rel="stylesheet" type="text/css" />';
		}
		self::$css_list=array();
		if($return)return $css_code;
		echo $css_code;
	}
}
css::initialize();
?>