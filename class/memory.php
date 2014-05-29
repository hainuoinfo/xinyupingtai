<?php
class memory{
	private static $datas = array();
	public static function write($name, $data){
		return self::$datas[$name] = $data;
	}
	public static function get($name){
		$data = self::$datas[$name];
		!isset($data) && $data = NULL;
		return $data;
	}
	public static function writeClass($name, $data){
		$name = '_class_'.$name.'_data_';
		return self::write($name, $data);
	}
	public static function getClass($name){
		$name = '_class_'.$name.'_data_';
		return self::get($name);
	}
}
?>