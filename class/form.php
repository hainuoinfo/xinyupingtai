<?php
class form{
	public static function get(){
		$list=array();
		if(func_num_args()>0) {
			foreach(func_get_args() as $v) {
				if(is_array($v)){
					if(!isset($v[2]) || $v[2]===false)$ignore=false;
					else $ignore=true;
					if((!$ignore && isset($_POST[$v[0]])) || $ignore){
						$list[$v[0]]=$_POST[$v[0]];
						common::setType($list[$v[0]],$v[1]);
					}
				} else {
					if(isset($_POST[$v]))$list[$v]=$_POST[$v];
				}
			}
		}
		return $list;
	}
	public static function get2(){
		$list=array();
		if(func_num_args()>0) {
			foreach(func_get_args() as $v) {
				if(is_array($v)){
						$list[$v[0]]=$_POST[$v[0]];
						common::setType($list[$v[0]],$v[1]);
				} else {
					if(isset($_POST[$v]))$list[$v]=$_POST[$v];
				}
			}
		}
		return $list;
	}
	public static function get3(){
		$list=array();
		if(func_num_args()>0) {
			foreach(func_get_args() as $v) {
				if(is_array($v)){
						$list[$v[0]]=$_POST[$v[0]];
						common::setType($list[$v[0]],$v[1]);
				} else {
					if(isset($_POST[$v]))$list[$v]=$_POST[$v];
				}
			}
		}
		$list && $list = common::filterHtml($list);
		return $list;
	}
	public static function reg(){
		if(func_num_args()>0) {
			foreach(func_get_args() as $v) {
				if(is_array($v)){
					if(!isset($v[2]) || $v[2]===false)$ignore=false;
					else $ignore=true;
					if((!$ignore && isset($_POST[$v[0]])) || $ignore){
						$GLOBALS[$v[0]]=$_POST[$v[0]];
						settype($GLOBALS[$v[0]],$v[1]);
					}
				} else {
					if(isset($_POST[$v]))$GLOBALS[$v]=$_POST[$v];
				}
			}
		}
	}
	public static function filter_html_($data){
		return preg_replace('/<.*?>/s','',$data);
	}
	public static function filter_html(){
		if(func_num_args()>0){
			foreach(func_get_args() as $v){
				$GLOBALS[$v]=preg_replace('/<.*?>/s','',$GLOBALS[$v]);
			}
		}
	}
	public static function array_equal($arr1,$arr2){
		if(is_array($arr1) && is_array($arr2) && ($count=count($arr1))==count($arr2))return $count;
		return false;
	}
	public static function is_form_hash(){
		$rs = $_POST && $_POST['hash'] && self::is_hash($_POST['hash']);
		if ($rs) {
			if (IN_ADMIN === true) checkWrite();
		}
		return $rs;
	}
	public static function is_form_hash2(){
		if ($GLOBALS['post_data'] && $_POST['hash2']) {
			$hash = base64_decode($_POST['hash2']);
			if ($hash) {
				$rs = self::is_hash(common::authcode($hash, false));
				if ($rs) {
					return true;
				} else {
					return 'form_expire';
				}
			} else {
				return false;
			}
		}
	}
	public static function is_hash($hash){
		return $hash==$GLOBALS['sys_hash'];
	}
	public static function check_vcode(){
		if($vcode=$_POST['vcode']){
			$img = new securimage();
			return $img->check($vcode);
		}
		return false;
	}
	public static function check_qq($v){
		if(preg_match('/^[1-9]\d{4,10}$/i',$v))return true;
		return false;
	}
	public static function check_email($v){
		if(preg_match('/^[a-z0-9][a-z0-9_.]*@[a-z0-9]+(?:\.[a-z]+){1,3}$/i',$v))return true;
		return false;
	}
	public static function check_phone($v){
		if(preg_match('/(?:^1(?:(?:[0-9][0-9]))\d{8}$)|(?:^\d{2,4}-\\d{7,8}$)|(?:^\d{7,8}$)/',$v))return true;
		return false;
	}
	public static function check_telephone($v){
		if(preg_match('/(?:^\d{2,4}-\d{7,8}$)|(?:^\d{7,8}$)/',$v))return true;
		return false;
	}
	public static function check_mobilephone($v){
		if(preg_match('/^1(?:(?:[0-9][0-9]))\\d{8}$/',$v))return true;
		return false;
	}
}
?>