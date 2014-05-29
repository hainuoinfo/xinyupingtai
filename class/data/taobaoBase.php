<?php
!defined('IN_JB') && exit('error');
class data_taobaoBase{
	private static $appKey,$appSecret,$nick;
	protected static $useApi = false;
	private static $server_url='http://gw.api.taobao.com/router/rest?';//'http://gw.api.tbsandbox.com/router/rest?
	public static function ini($appKey,$appSecret,$nick){
		self::$appKey    = $appKey;
		self::$appSecret = $appSecret;
		self::$nick      = $nick;
		self::$useApi     = true;
	}
	public static function createSign ($paramArr) { 
		$sign = self::$appSecret;
		ksort($paramArr);
		foreach ($paramArr as $key => $val) {
		   if ($key !='' && (string)$val !='') {
			   $sign .= $key.$val; 
		   } 
		}
		$sign = strtoupper(md5($sign));  //Hmac方式
	//    $sign = strtoupper(md5($sign.$appSecret)); //Md5方式	
		return $sign; 
	}
	public static function createStrParam ($paramArr) { 
		$strParam = ''; 
		foreach ($paramArr as $key => $val) {
		   if ($key != '' && (string)$val !='') {
			   $strParam .= $key.'='.urlencode($val).'&'; 
		   } 
		}
		return $strParam; 
	}
	public static function getXmlData ($strXml) {
		$pos = strpos($strXml, 'xml');
		if ($pos) {
			$xmlCode=simplexml_load_string($strXml,'SimpleXMLElement', LIBXML_NOCDATA);
			$arrayCode=self::get_object_vars_final($xmlCode);
			return $arrayCode ;
		} else {
			return '';
		}
	}
	public static function get_object_vars_final($obj){
		if(is_object($obj)){
			$obj=get_object_vars($obj);
		}
		if(is_array($obj)){
			foreach ($obj as $key=>$value){
				$obj[$key]=self::get_object_vars_final($value);
			}
		}
		return $obj;
	}
	public static function get($parr){
		global $timestamp;
		$paramArr = array(
			'timestamp' => date('Y-m-d H:i:s',$timestamp),
			'format' => 'xml',
			'app_key' => self::$appKey,
			'v' => '2.0',
			'sign_method'=>'MD5'
		);
		$paramArr +=$parr;
		$sign      = self::createSign($paramArr);
		$strParam  = self::createStrParam($paramArr);
		$strParam .= 'sign='.$sign;
		return self::getXmlData(winsock::get_html(self::$server_url.$strParam));
	}
	public static function getShopUrl($num_iid){
		return 'http://item.taobao.com/item.htm?id='.$num_iid;
	}
}
//以下为淘宝开放平台的API http://open.taobao.com/
data_taobaoBase::ini('12210736', 'a9139cb3136455f2ffe7c2f07574d1ca', '');
?>