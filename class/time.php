<?php
!defined('IN_JB')&&exit('没有权限');
class time{
	public static $define_list = array();
	public static $time_stamp,$today_start,$today_end;
	private static $time_start=array(),$time_offset;
	public static function initialize(){
		self::$time_offset=8;
		self::$define_list['TIME_ZONE'] = 'Etc/GMT-'.self::$time_offset;//时区
		self::$define_list['SECOND']=1;
		self::$define_list['MINUTE'] = self::$define_list['SECOND']*60;
		self::$define_list['HOUR']   = self::$define_list['MINUTE']*60;
		self::$define_list['DAY']    = self::$define_list['HOUR']*24;
		if(function_exists('date_default_timezone_get')&&function_exists('date_default_timezone_set')){
			if(date_default_timezone_get()!=self::$define_list['TIME_ZONE']){
				date_default_timezone_set(self::$define_list['TIME_ZONE']);
			}
		}
		self::$time_stamp=time();
		self::$today_start=self::$time_stamp - (self::$time_stamp + self::$time_offset*self::$define_list['HOUR'])%self::$define_list['DAY'];
		self::$today_end=self::$today_start + self::$define_list['DAY']-1;
	}
	public static function is_evening(){
		$t=self::$time_stamp;
		$t=($t + self::$time_offset * self::$define_list['HOUR']) % self::$define_list['DAY'];
		if($t>=19*self::$define_list['HOUR'] || $t<5*self::$define_list['HOUR'])return true;//19点到凌成5点算是夜晚
		return false;
	}
	private static function format_time($time){
		($time=(int)$time)||($time=time());
		return $time;
	}
	public static function format_general($time=0){
		return date('Y-m-d H:i:s',self::format_time($time));
	}
	public static function format_general_chinese($time=0){
		return date('Y年m月d日 H时i分s秒',self::format_time($time));
	}
	public static function format_general_date(){
		return date('Y-m-d',self::format_time($time));
	}
	public static function format_general_date_chinese(){
		return date('Y年m月d日',self::format_time($time));
	}
	public static function time_difference($time_stamp1,$time_stamp2=0){
		$time_stamp2||$time_stamp2=self::$time_stamp;
		$ts=$time_stamp2-$time_stamp1;
		if($ts>5*7*86400){
			return self::format_general($time_stamp1);
		} else {
			$day=floor($ts/self::$define_list['DAY']);
			$ts-=$day*self::$define_list['DAY'];
			$hour=floor($ts/self::$define_list['HOUR']);
			$ts-=$hour*self::$define_list['HOUR'];
			$minute=floor($ts/self::$define_list['MINUTE']);
			$ts-=$minute*self::$define_list['MINUTE'];
			$weekday=floor($day/7);
			if($weekday>0)return $weekday.'周前';
			if($day>0)return $day.'天前';
			if($hour>0)return $hour.'小时前';
			if($minute>0)return $minute.'分钟前';
			if($ts>0)return $ts.'秒前';
		}
	}
	public static function daytime($ts){
		$day=floor($ts/self::$define_list['DAY']);
		$ts-=$day*self::$define_list['DAY'];
		$hour=floor($ts/self::$define_list['HOUR']);
		$ts-=$hour*self::$define_list['HOUR'];
		$minute=floor($ts/self::$define_list['MINUTE']);
		$ts-=$minute*self::$define_list['MINUTE'];
		$weekday=floor($day/7);
		return array('day'=>$day,'hour'=>$hour,'minute'=>$minute,'second'=>$ts,'weekday'=>$weekday);
	}
	public static function millisecond(){
		list($millisecond,$second)=explode(' ',microtime());
		return array('millisecond'=>(float)$millisecond,'second'=>(float)$second);
	}
	public static function get_general_timestamp($date){
		$sp0 = explode(' ', $date);
		$date = $sp0[0];
		$time = $sp0[1];
		if ($time) $sp0 = explode(':', $time);
		else $sp0 = array(0, 0, 0);
		$sp=explode('-',$date);
		return mktime((int)$sp0[0], (int)$sp0[1], (int)$sp0[2], (int)$sp[1],(int)$sp[2],(int)$sp[0]);
	}
	public static function timer_start(){
		self::$time_start=self::millisecond();
	}
	public static function timer_end($export=false){
		$millisecond=self::millisecond();
		$second=$millisecond['second']-self::$time_start['second'];
		$millisecond=$millisecond['millisecond']-self::$time_start['millisecond'];
		if($export)echo $second+$millisecond;
		else return $second+$millisecond;
	}
	public static function isRunNian($year){
		if ($year % 400 == 0 || ($year % 4 == 0 && $year % 100 != 0))return true;
		return false;
	}
	public static function tswk(){
		//获取本周时间戳
		$w = (int)date('w', self::$today_start);
		$w == 0 && $w = 7;
		$d1 = $w - 1;
		$d2 = 7 - $w;
		$t1 = self::$today_start - (self::$define_list['DAY'] * $d1);
		$t2 = self::$today_end   + (self::$define_list['DAY'] * $d2);
		return array('start' => $t1, 'end' => $t2);
	}
	public static function tsm(){
		//获取本月时间戳
		list($y, $m, $d) = explode(',', date('Y,n,j', self::$today_start));
		$y = (int)$y;
		$m = (int)$m;
		$d = (int)$d;
		if ($m == 2){
			if (self::isRunNian($y)) $maxDay = 29;
			else $maxDay = 28;
		} elseif (in_array($m, array(1, 3, 5, 7, 8, 10, 12))) {
			$maxDay = 31;
		} else {
			//
			$maxDay = 30;
		}
		$d1 = $d - 1;
		$d2 = $maxDay - $d;
		$t1 = self::$today_start - (self::$define_list['DAY'] * $d1);
		$t2 = self::$today_end   + (self::$define_list['DAY'] * $d2);
		return array('start' => $t1, 'end' => $t2);
	}
	public static function days($t){
		if ($t < 0) return 0;
		$t /= 86400;
		$t *= 10;
		$t = floor($t + 0.5) / 10;
		return sprintf('%0.1f', $t);
	}
	public static function hours($t){
		if ($t < 0) return 0;
		$t /= 3600;
		$t *= 10;
		$t = floor($t + 0.5) / 10;
		return sprintf('%0.1f', $t);
	}
	public static function minutes($t){
		if ($t < 0) return 0;
		$t /= 60;
		$t *= 10;
		$t = floor($t + 0.5) / 10;
		return sprintf('%0.1f', $t);
	}
}
time::initialize();
?>