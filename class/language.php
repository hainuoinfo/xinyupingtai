<?php
class language{
	private static $lang=array();
	public static $lang_name='index',$lang_folder='default';
	public static function load(){
		foreach(func_get_args() as $arg){
			!is_array($arg) && ($arg = array('folder' => 'default', 'name' => $arg));
			$path = d('./language/'.$arg['folder'].'/'.$arg['name'].'.php');
			if(!isset(self::$lang[$arg['folder']][$arg['name']])){
				$lang=array();
				@include($path);
				if(!$lang)$lang = false;
				self::$lang[$arg['folder']][$arg['name']] = $lang;
			}
		}
	}
	public static function get($name, $lang_name='', $lang_folder=''){
		if (!is_array($name)) {
			$var_name_list = explode(',', $name);
		} else {
			$var_name_list = array($name);
		}
		$lang_name   || ($lang_name   = self::$lang_name);
		$lang_folder || ($lang_folder = self::$lang_folder);
		if($var_name_list){
			if (!isset(self::$lang[$lang_folder][$lang_name]))self::load(array('folder' => $lang_folder, 'name' => $lang_name));
			$return = self::$lang[$lang_folder][$lang_name];
			if ($return !== false) {
				foreach($var_name_list as $v){
					if (!is_array($v)) {
						$return = $return[$v];
					} else {
						$return = $return[$v['name']];
						if (!is_array($return) && $v['args']) {
							$return = preg_replace('/\{(\w+)\}/e', '$v[\'args\'][\'$1\']', $return);
						}
					}
				}
				$return || ($return = $name);
				return $return;
			}
			return $name;
		}
	}
}
?>