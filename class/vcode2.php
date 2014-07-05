<?php
!defined('IN_JB')&&exit('ERROR');
class vcode2{
	public static $font='vcode2.ttf';
	public static function show(){
		global $config;
		$fontSize      = 12;//print font size
		$fontWidth     = imagefontwidth($fontSize);//font width
		$fontHeight    = imagefontheight($fontSize);//font height
		$charLength    = 4;
		$text          = self::GetRandChar($charLength, 1);
		$imgWidth      = 50;//image width
		$imgHeight     = 22;//image height
		$padding       = 2;//padding pixel
		$border        = 1;//set border width
		$borderColor   = array(0xCC, 0xCC, 0xCC);
		$imgTrueWidth  = $imgWidth - ($padding + $border) * 2;
		$imgTrueHeight = $imgHeight - ($padding + $border) * 2;
		$charSpace     = false;
		$charWidth     = $charSpace?ceil($imgTrueWidth / $charLength):$fontWidth;
		$printX        = $padding + $border;//print start x
		$printY        = $padding + $border;//pring start y
		$printX > 0 && $printX -= 1;
		!$charSpace && $printX += floor($imgTrueWidth / 2 - $charWidth * $charLength / 2);
		$printY > 0 && $printY -= 1;
		$charColors1    = array(
			array(0x00, 0x00, 0xCC),
			array(0x33, 0x00, 0x99),
			array(0x33, 0x00, 0x66),
			array(0x66, 0x00, 0x33)
		);
		$charColors2    = array();
		if(function_exists('imagepng')){
			header('Content-Type:image/png');
			$img_func='imagepng';
		} elseif(function_exists('imagejpeg')){
			header('Content-Type:image/jpeg');
			$img_func='imagejpeg';
		}
		$im     = imagecreatetruecolor($imgWidth, $imgHeight);
		$borderColorInt = imagecolorallocate($im, $borderColor[0], $borderColor[1], $borderColor[2]);
		$charColorCount = count($charColors1);
		$charColorIndex = 0;
		foreach($charColors1 as $k=>$v){
			//$text_c = imagecolorallocate($im, mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
			$charColors2[$k] = imagecolorallocate($im, $v[0], $v[1], $v[2]);
		}
		$buttum_c = imagecolorallocate($im, 0xff, 0xff, 0xff);
		imagefill($im, 16, 13, $buttum_c);
		for($i = 0; $i < $border; $i++){
			$x = $y = $i;
			$x2 = $imgWidth - $i - 1;
			$y2 = $imgHeight - $i - 1;
			imagerectangle($im, $x, $y, $x2, $y2, $borderColorInt);
		}
		self::$font=WROOT.'./images/fonts/'.self::$font;;
		
		for ($i=0;$i<strlen($text);$i++){
			$tmp =substr($text, $i, 1);
			$array = array(-1,1);
			$p = array_rand($array);
			$an = 0;//-10;//$array[$p] * mt_rand(1,10);//角度
			imagettftext($im, $fontSize, $an, $printX + ($i * $charWidth), $printY + $fontHeight, $charColors2[$charColorIndex], self::$font, $tmp);
			$charColorIndex++;
			if($charColorIndex == $charColorCount)$charColorIndex = 0;
			//imagechar($im, $fontSize, $printX + ($i * $charWidth), $printY, $tmp, $text_c);
		}
		//self::sin_image($im,2);//用正弦函数扭曲图片
		//加入干扰象素;
		$count = 260;//干扰像素的数量
		for($i=0; $i<$count; $i++){
			$randcolor = imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
			imagesetpixel($im, mt_rand()%$imgWidth , mt_rand()%$imgHeight, $randcolor);
		}
	
		
		$img_func($im);
		imagedestroy($im);
		common::setcookie('vcode', common::authcode($text));
		return $text;
	}
	public static function check($code, $clear = true){
		global $cookie;
		if ($cookie['vcode'] && common::authcode($cookie['vcode'], false) == $code) {
			if ($clear) common::unsetcookie('vcode');
			return true;
		} else {
			return false;
		}
	}
	public static function checkPost($clear = true){
		return $GLOBALS['post_data'] && self::check($_POST['vcode'], $clear);
	}
	public static function GetRandChar($len=4,$type=7){
		$return='';
		$set_C_list=array();
		($type&1)&&($set_C_list[]=1);
		($type&2)&&($set_C_list[]=2);
		($type&4)&&($set_C_list[]=3);
		$set_C=count($set_C_list);
		$set_C>0&&($set_C--);
		for($i=0;$i<$len;$i++){
			switch($set_C_list[mt_rand(0,$set_C)]){
				case 1:
				//数字
				$return.=chr(mt_rand(0x30,0x39));
				break;
				case 2:
				//大写字母
				$return.=chr(mt_rand(0x41,0x5A));
				break;
				case 3:
				//小写字母
				$return.=chr(mt_rand(0x61,0x7A));
				break;
			}
		}
		return $return;
	}
}
?>
