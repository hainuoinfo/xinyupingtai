<?php
class payfor{
	public static function initialize(){
		cache::get_array('payfor');
	}
	public static function pay($payfor_type,$oid,$title,$description,$money){
		global $payfor;
		$lib_path=d('./payfor/'.$payfor_type.'/');
		$lib=$lib_path.'index.php';
		$lib_url=u('./payfor/'.$payfor_type.'/',true);
		include($lib);
		return $payfor_url;
	 }
}
payfor::initialize();
?>