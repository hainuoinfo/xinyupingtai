<?php
class virtual{
	//自动任务	
//随机任务编号
    public static function create_rand($num){
        $arr = array();
      do{
             $rand ='TB'.date('mdHis').rand(100000,999999);
             if(!in_array($rand,$arr))
             $arr[] = $rand; 
        }
        while (count($arr)<$num);
        return $arr;
    }
//随机用户名函数
     public static function randomkeys($length) {
            $returnStr='';
            $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
        for($i = 0; $i < $length; $i ++) {
             $returnStr .= $pattern {mt_rand ( 0, 61 )}; //生成php随机数
        }
        return $returnStr;
    }
//创建随机用户名
     public static function create_name($num){
        do{
             $rand =self::randomkeys(8);
        if(!in_array($rand,$arr))
             $arr[] = $rand; 
        }
         while (count($arr)<$num);
        return $arr;
     }
//随机价格
     public static function create_type($k,$m,$n,$num){
            $arr = array();
        do{
		    $rand =rand($k,$m).'.'.rand(0,$n).'0';
            // $rand =rand(1,199).'.00';
             if(!in_array($rand,$arr))
             $arr[] = $rand; 
         }
        while (count($arr)<$num);
         return $arr;
    }
     public static function create_fabudian($k,$m,$n,$num){
            $arr = array();
        do{
		    $rand =rand($k,$m).'.'.rand(0,$n).'0';
            // $rand =rand(1,199).'.00';
            // if(!in_array($rand,$arr))
             $arr[] = $rand; 
         }
        while (count($arr)<$num);
         return $arr;
    }
	//
	public static function create_stype($m,$n,$num){
            $arr = array();
        do{
             $rand =mt_rand($m,$n);
             $arr[] = $rand; 
         }
        while (count($arr)<$num);
         return $arr;
    }
	public static function create_time($num){
        $arr = array();
      do{
             $rand =date('H')-1;
            // if(!in_array($rand,$arr))
             $arr[] = $rand; 
        }
        while (count($arr)<$num);
        return $arr;
    }
	
}
?>