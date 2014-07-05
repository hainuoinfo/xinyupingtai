<?php
class user{
	public static function add($username,$password,$groupid){
		global $ipint,$timestamp;
		$salt=common::salt();
		$password=md5(md5($password).$salt);
		$groupid=(int)$groupid;
		if($username && $password) {
			if(!db::exists('members',array('username'=>$username))){
				db::insert('members',array('username'=>$username,'password'=>$password,'salt'=>$salt,'reg_ip'=>$ipint,'reg_time_stamp'=>$timestamp));
				return true;
			} else return '该用户已经存在';
		} return '参数错误';
	}
	public static function edit($uid,$username,$password,$groupid){
		global $ipint,$timestamp;
		$salt=common::salt();
		$password=md5(md5($password).$salt);
		$groupid=(int)$groupid;
		if($username && $password) {
			if(!db::exists('members',"username='$username' and id<>'$uid'")){
				db::update('members',array('username'=>$username,'password'=>$password,'salt'=>$salt),"id='$uid'");
				return true;
			} else return '该用户已经存在';
		} else return '参数错误';
	}
	public static function set_avatar($s,$uid){
		global $user_avatar_path,$user_avatar_width,$user_avatar_height;
		$uid_=sprintf('%08X',$uid);
		$a=substr($uid_,0,2);
		$b=substr($uid_,2,2);
		$c=substr($uid_,4,2);
		$d=substr($uid_,6,2);
		$save=d($user_avatar_path);
		$save.=$a.D;
		!file_exists($save) && mkdir($save);
		$save.=$b.D;
		!file_exists($save) && mkdir($save);
		$save.=$c.D;
		!file_exists($save) && mkdir($save);
		//$save.=$d;
		$pathinfo=pathinfo($s);
		image::thumb($s,$save.$d.'.'.$pathinfo['extension'],array('width'=>$user_avatar_width,'height'=>$user_avatar_height));
		@unlink($s);
		return $a.'/'.$b.'/'.$c.'/'.$d.'.'.$pathinfo['extension'];
	}
}
?>