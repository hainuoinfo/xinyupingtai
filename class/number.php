<?php
!defined('IN_JB')&&exit('没有权限');
/*class cls_number{
	private static $number_general1=array('零','一','二','三','四','五','六','七','八','九');
	private static $number_general2=array('十','百','千');
	private static $number_general3=array('万','亿','兆','京','垓','杼','穰','沟','涧','正','载','极','恒河沙','阿僧□','那由它','不可思议','无量','大数','古戈','古戈布莱克斯');
	public static function chinese($number){
		$number=(int)$number;
		$rn='';
		$unit_list=array(100000000,10000,1000,100,10);
		foreach($unit_list as $v){
			$count=floor($number/$v);
			$unit_list2[]=$count;
			$number-=$count*$v;
		}
		print_r($unit_list2);
		return $rn;
	}
}*/
class number{
	private static $basical=array(0=>"零","一","二","三","四","五","六","七","八","九");
	//var $basical=array(0=>"零","壹","贰","叁","肆","伍","陆","柒","捌","玖");
	private static $advanced=array(1=>"十","百","千");
	//var $advanced=array(1=>"拾","佰","仟");
	private static $top=array(1=>"万","亿");
	
	private static $level;        // 以4位为一级
	
	// 先实现万一下的数的转换
	public static function chinese($number){
	   if ($number>999999999999)    // 只能处理到千亿。
		   return "数字太大，无法处理。抱歉！";
	   if ($number==0)
		   return "零";
	
	   for(self::$level=0;$number>0.0001;self::$level++,$number=floor($number / 10000)){
		   // 对于中文来说，应该是4位为一组。
		   // 四个变量分别对应 个、十、百、千 位。
		   $n1=substr($number,-1,1);
		   if($number>9)
			  $n2=substr($number,-2,1);
		   else
			  $n2=0;
		   if($number>99)
			  $n3=substr($number,-3,1);
		   else
			  $n3=0;
		   if($number>999)
			  $n4=substr($number,-4,1);
		   else
			  $n4=0;
	
		   if($n4)
			  $parsed[self::$level].=self::$basical[$n4].self::$advanced[3];
		   else
			  if(($number/10000)>=1)    // 千位为0，数值大于9999的情况
				 $parsed[self::$level].="零";
		   if($n3)
			  $parsed[self::$level].=self::$basical[$n3].self::$advanced[2];
		   else
			  if(!preg_match("/零$/",$parsed[self::$level]) && ($number / 1000)>=1) // 不出现连续两个“零”的情况
				 $parsed[self::$level].="零";
		   if($n2)
			  $parsed[self::$level].=self::$basical[$n2].self::$advanced[1];
		   else
			  if(!preg_match("/零$/",$parsed[self::$level]) && ($number / 100)>=1) // 不出现连续两个“零”的情况
				 $parsed[self::$level].="零";
		   if($n1)
			  $parsed[self::$level].=self::$basical[$n1];
	   }
	   for(self::$level-=1;self::$level>=0;self::$level--){
		   $result.=$parsed[self::$level].self::$top[self::$level];
	   }
	
	   if(preg_match("/零$/",$result))
		   $result=substr($result,0,strlen($result)-2);
	
	   return $result;
	   
	}
}
?>