<?php
class images{
	private static $lib_path='';
	public static function initialize(){
		global $weburl;
		self::$lib_path=$weburl.'/images/';
	}
	public static function get_img(){
		$rn='';
		if(func_num_args()>0){
			foreach(func_get_args() as $arr)$rn.=self::get_img_base($arr);
		}
		return $rn;
	}
	public static function get_img_base($arr){
		$folder&&($folder.='/');
		$args='';
		foreach($arr as $k=>$v){
			if($v!=''){
				$args&&($args.=' ');
				$args.=$k.'="'.$v.'"';
			}
		}
		return "<img $args />";
	}
}
images::initialize();
?>