<?php
!defined('IN_JB')&&exit('没有权限');
ini_set('memory_limit', '128M');
class common{
	public static $cls_time;
	public static $start_time;
	private static $ob_start=false,$ob_gzip;
	public static function initialize(){
		//时间类
		self::$start_time=time::$time_stamp;
		if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST){
			if(!MAGIC_QUOTES_GPC){
				$_POST = self::bf_addslashes($_POST);
			}
			$GLOBALS['post_data'] = true;
		} else $GLOBALS['post_data'] = false;
		if($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET){
			if(!MAGIC_QUOTES_GPC){
				$_GET = self::bf_addslashes($_GET);
			}
		}
		$GLOBALS['cookie'] = self::parse_cookie($_COOKIE);
		self::ob_start();
	}
	public static function is_form_hash(){
		$rs = $_POST && $_POST['hash'] && self::is_hash($_POST['hash']);
		if ($rs) {
			if (IN_ADMIN === true) checkWrite();
		}
		return $rs;
	}
	public static function is_hash($hash){
		return $hash==$GLOBALS['sys_hash'];
	}
	private static function parse_cookie($arr){
		$rn=array();
		foreach($arr as $k=>$v){
			if(is_array($v))$rn[$k]=self::parse_cookie($v);
			else $rn[$k]=self::authcode($v,0);
		}
		return $rn;
	}
	public static function ob_start($zip=true){
		if(!self::$ob_start){
			if($zip && ZLIB===true && ACCEPT_ENCODING_GZIP===true && (!defined('CONTENT_TYPE') || in_array(CONTENT_TYPE,array('text','txt','html','css','js')))) {
				self::$ob_gzip=true;
				ob_start('ob_gzhandler');
				header("Content-Encoding: gzip");
				self::$ob_start=true;
			} else {
				self::$ob_gzip = false;
				ob_start();
				header("Content-Encoding: ",true);
				header('Vary: ', true);
				self::$ob_start=true;
			}
		}
	}
	public static function ob_clean(){
		if(self::$ob_start){
			if(self::$ob_gzip===true){
				ob_end_clean();
				ob_start('ob_gzhandler');
			} else {
				ob_clean();
			}
		}
	}
	public static function ob_end_clean(){
		if(self::$ob_start){
			ob_end_clean();
			if(self::$ob_gzip===true){
				header("Content-Encoding: ",true);
				header('Vary: ', true);
			}
			self::$ob_start=false;
		}
	}
	public static function ob_get_contents(){
		return ob_get_contents();
	}
	public static function ob_reset($zip=false){
		if(self::$ob_start){
			ob_end_clean();
			self::$ob_start=false;
		}
		self::ob_start($zip);
	}
	public static function getArticleIds($id){
		$id=sprintf('%08X',$id);
		$a=substr($id,0,2);
		$b=substr($id,2,2);
		$c=substr($id,4,2);
		$d=substr($id,6,2);
		return array($a,$b,$c,$d);
	}
	public static function getArticlePath($id, $f = D){
		$sp=self::getArticleIds($id);
		return implode($f, $sp);
	}
	public static function get_eval($data){
		$tmp=ob_get_contents();
		common::ob_clean();
		@eval($data);
		$eval=ob_get_contents();
		common::ob_clean();
		echo $tmp;
		return $eval;
	}
	public static function char_set($encoding=''){
		$encoding||($encoding=ENCODING);
		header('Content-Type:text/html;charset='.$encoding);
	}
	public static function run_time(){
		return time()-self::$start_time;
	}
	public static function arrid($arr,$id){
		if(!is_array($arr))return $arr;
		$rn = array();
		foreach($arr as $v){
			$rn[]=$v[$id];
		}
		return $rn;
	}
	public static function bf_addslashes($arr){
		if(is_array($arr)){
			foreach($arr as $k=>$v){
				$arr[$k]=self::bf_addslashes($v);
			}
			return $arr;
		} else {
			return addslashes($arr);
		}
	}
	public static function bf_stripslashes($arr){
		if(is_array($arr)){
			foreach($arr as $k=>$v){
				$arr[$k]=self::bf_stripslashes($v);
			}
		} else return stripslashes($arr);
		return $arr;
	}
	public static function bf_addcslashes($arr){
		if (is_array($arr)) {
			foreach ($arr as $k => $v) {
				$arr[$k] = self::bf_addcslashes($arr);
			}
		} else $arr = addcslashes($arr, '\'\\');
		return $arr;
	}
	public static function cutstr($data,$len){
		$data    = preg_replace("/<.*?>/", "", $data);
		$dataLen = mb_strlen($data);
		if ($dataLen > $len) {
			$data = mb_substr($data, 0, $len - 1).'…';
		}
		return $data;
	}
	public static function cutstr2($data,$len){
		$data    = preg_replace("/\[.*?\]/", "", $data);
		$dataLen = mb_strlen($data);
		if ($dataLen > $len) {
			$data = mb_substr($data, 0, $len - 1).'…';
		}
		return $data;
	}
	public static function format_trim_text($str){
		$str=preg_replace('/<.+?>/s','',$str);
		return trim($str);
	}
	public static function format_post_text($array){
		if(is_array($array)){
			foreach($array as $k=>$v){
				if(is_array($v)){
					$array[$k]=self::format_post_text($v);
				} else $array[$k]=self::format_trim_text($v);
			}
			return $array;
		} else return self::format_trim_text($v);
	}
	public static function set_int($arr,$keys){
		foreach($keys as $v){
			$arr[$v]=(int)$arr[$v];
		}
		return $arr;
	}
	public static function getInt($arr){
		if (is_array($arr)) {
			$rn = array();
			foreach ($arr as $v){
				$v = (int)$v;
				if ($v) $rn[] = $v;
			}
			return $rn;
		}
		return (int)$arr;
	}
	public static function domain_parse($domain=''){
		if(!$domain)$domain=$_SERVER['HTTP_HOST'];
		if($domain){
			$domain_list=explode('.',strtolower($domain));
			if($domain_list[0]=='www'){
				unset($domain_list[0]);
				$domain_list=array_values($domain_list);
			}
			$count=count($domain_list);
			$domain_list[$count-2].='.'.$domain_list[$count-1];
			unset($domain_list[$count-1]);
			$domain_list=array_reverse($domain_list);
			$count-=2;
			$domain_list['count']=$count;
			$domain_list['host']=$domain;
			$domain_list['host_url']='http://'.$domain_list['host'];
			$domain_list['parent_url']='http://www.'.$domain_list[0];
			$domain_list['user_url']='http://my.'.$domain_list[0];
			$domain_list['domain0']=$domain_list[0];
			if($count>0){
				$base_domain=$domain_list[0];
				for($i=1;$i<=$count;$i++){
					$base_domain=$domain_list[$i].'.'.$base_domain;
					$domain_list['domain'.$i]=$base_domain;
				}
			}
			return $domain_list;
		}
	}
	public static function ipint($ip=''){
		if(!$ip)
		$ip=$_SERVER['REMOTE_ADDR'];
		$sp=explode(".",$ip);
		return $sp[0]*0x1000000+$sp[1]*0x10000+$sp[2]*0x100+$sp[3];
	}
	public static function intip($ip=0,$xinghao=0){
		if($ip==0){
			return $_SERVER['REMOTE_ADDR'];
		} else {
			$ip=(float)$ip;
			$ip1=$ip>>24&0xFF;
			$ip2=$ip>>16&0xFF;
			$ip3=$ip>>8&0xFF;
			$ip4=$ip&0xFF;
			if(!$xinghao)return "$ip1.$ip2.$ip3.$ip4";
			else {
				if($xinghao==1)return "$ip1.$ip2.$ip3.*";
				if($xinghao==2)return "$ip1.$ip2.*.*";
				if($xinghao==3)return "$ip1.*.*.*";
				if($xinghao==4)return "*.*.*.*";
			}
		}
	}
	public static function create_date_folder($parent_folder,$fill='/'){
		$t=$GLOBALS['timestamp'];
		$folders[]=date('Y',$t);
		$folders[]=date('m',$t);
		$folders[]=date('d',$t);
		if(!file_exists($parent_folder))self::create_folder($parent_folder);
		!in_array(substr($parent_folder,-1),array('\\','/')) && $parent_folder.=D;
		$path=$parent_folder;
		foreach($folders as $folder){
			$path.=$folder.D;
			!file_exists($path) && mkdir($path);
		}
		return implode($fill,$folders);
	}
	public static function create_folders(){
		$list_count=func_num_args();
		$complate_count=0;
		if($list_count>0){
			$path_list=func_get_args();
			foreach($path_list as $path){
				if(self::create_folder($path))$complate_count++;
			}
		}
		return $complate_count;
	}
	public static function create_folder($path){
		if(!file_exists($path)){
			$folder_list=preg_split('/\\/|\\\\/',$path);
			$path='';
			foreach($folder_list as $k => $folder){
				if($folder!=''){
					$path && substr($path, -1) != D && $path .= D;
					$path.=$folder;
					if(!file_exists($path) && !self::inWebRoot($path)){
						if(!mkdir($path))return false;
					}
				} else {
					if ($k == 0) {
						$path .= D;
					}
				}
			}
		}
		return true;
	}
	private static function inWebRoot($path){
		if (substr(WROOT, 0, strlen($path)) == $path) return true;
		return false;
	}
	public static function show_message($message,$tpl='',$close=true){
		global $web_name, $weburl, $webutl2, $domains;
		//ob_end_clean();
		if($tpl){
			include(template::load($tpl));
		} else {
			header("Content-Type:text/html;charset=".ENCODING,true);
			echo $message;
		}
		if($close)exit;
	}
	public static function showmessage($message){
		extract($GLOBALS, EXTR_SKIP);
		template::initialize('./templates/default/', './cache/default/');
		include(template::load('showmessage'));
		exit;
	}
	public static function salt(){
		return substr(uniqid(rand()), -6);
	}
	public static function salt_pwd($salt,$pwd){
		return md5(md5($pwd).$salt);
	}
	public static function salt_pwd_check($old_pwd,$new_pwd,$salt){
		return self::salt_pwd($salt,$new_pwd)==$old_pwd;
	}
	public static function goto_url($url,$full_url = false, $alert = ''){
		//header('Location:'.(!$full_url?$GLOBALS['weburl']:'').$url);
		global $web_rewrite, $referer;
		common::ob_clean();
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>页面跳转</title>
</head>

<body>
<script language="javascript">
	'.($alert?'alert(\''.string::formatAlert($alert).'\');':'').'
	location.href="'.(!$full_url?$GLOBALS['weburl'].(!$web_rewrite?'/rewrite.php?rewrite='.str_replace('?', '&', $url):$url):$url).'"
</script>
</body>
</html>
';
		exit;
	}
	public static function getUrl($url){
		global $web_rewrite, $weburl;
		return $weburl.(!$web_rewrite?'/rewrite.php?rewrite=':'').$url;
	}
	public static function back($url,$full_url=false){
		//header('Location:'.(!$full_url?$GLOBALS['weburl']:'').$url);
		common::ob_clean();
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>页面跳转</title>
</head>

<body>
<script language="javascript">
	history.back(-1);
</script>
</body>
</html>
';
		exit;
	}
	public static function refresh(){
		self::goto_url($GLOBALS['nowurl'],true);
	}
	public static function header($string, $replace = true, $http_response_code = 0) {
		if(empty($http_response_code) || PHP_VERSION < '4.3' ) {
			@header($string, $replace);
		} else {
			@header($string, $replace, $http_response_code);
		}
	}
	public static function nocache(){
		@self::header("Expires: -1");
		@self::header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", false);
		@self::header("Pragma: no-cache");
	}
	public static function authcode($string, $encode = true, $expiry = 0, $KEY=AUTHKEY) {
		$ckey_length = 4;	// 随机密钥长度 取值 0-32;
				// 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
				// 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
				// 当此值为 0 时，则不产生随机密钥
		$key  = md5($KEY);
		$keya = md5(substr($key, 0, 16));
		$keyb = md5(substr($key, 16, 16));
		$operation=$encode===true?'ENCODE':'DECODE';
		$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
		
		$cryptkey   = $keya.md5($keya.$keyc);
		$key_length = strlen($cryptkey);
	
		$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
		$string_length = strlen($string);
	
		$result = '';
		$box = range(0, 255);
	
		$rndkey = array();
		for($i = 0; $i <= 255; $i++) {
			$rndkey[$i] = ord($cryptkey[$i % $key_length]);
		}
	
		for($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}
	
		for($a = $j = $i = 0; $i < $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}
		if($operation == 'DECODE') {
			if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
				return substr($result, 26);
			} else {
				return '';
			}
		} else {
			return $keyc.str_replace('=', '', base64_encode($result));
		}
	}
	public static function setcookie($var, $value = '', $life = 0, $prefix = 1, $httponly = false) {
		global $cookiepre, $cookiedomain, $cookiepath,$domains;
		$var = ($prefix ? $cookiepre : '').$var;
		if($value == '' || $life < 0) {
			$value = '';
			$life = -1;
		}
		$value&&($value=self::authcode($value));
		$life = $life > 0 ? time::$time_stamp + $life : ($life < 0 ? time::$time_stamp - 31536000 : 0);
		$cookiepath||($cookiepath='/');
		$path = $httponly && PHP_VERSION < '5.2.0' ? "$cookiepath; HttpOnly" : $cookiepath;
		$secure = $_SERVER['SERVER_PORT'] == 443 ? 1 : 0;
		$cookiedomain||($cookiedomain='.'.$domains[0]);
		if(PHP_VERSION < '5.2.0') {
			setcookie($var, $value, $life, $path, $cookiedomain, $secure);
		} else {
			setcookie($var, $value, $life, $path, $cookiedomain, $secure, $httponly);
		}
	}
	public static function unsetcookie(){
		if (func_num_args() > 0) {
			foreach (func_get_args() as $v) {
				self::setcookie($v, '');
			}
		}
	}
	public static function clearcookies() {
		
	}
	public static function parse_url(){
		$query_string=$_SERVER['QUERY_STRING'];
		if($query_string){
			if(substr($query_string,0,1)!='/')$query_string='/'.$query_string;
			if(substr($query_string,strlen($query_string)-1,1)=='/')$query_string.='index.php';
			$include_file=$query_string;
			if(file_exists(WEB_ROOT.'.'.$include_file)){
				include WEB_ROOT.'.'.$include_file;
			} else {
				self::show_message("404 file not found");
			}
		}
	}
	public static function rewrite_parse_url($url,$format,$marker='{}'){
		$marker_left=substr($marker,0,1);
		$marker_right=substr($marker,1,1);
		$format_tmp=preg_replace("/(\?|\\/|\*|\[|\])/","\\\\$1",$format);
		$format_tmp='/^'.preg_replace("/\\".$marker_left."(.+?)\\".$marker_right."/","(?P<$1>.+?)",$format_tmp).'$/';
		$parameters=array();
		if(preg_match($format_tmp,$url,$matches)){
			foreach($matches as $k=>$v){
				if(!is_numeric($k))$parameters[$k]=$v;
			}
			return $parameters;
		}
		return false;
	}
	public static function rewrite_build_url($parameters,$format,$marker='{}'){
		$marker_left=substr($marker,0,1);
		$marker_right=substr($marker,1,1);
		return preg_replace("/\\".$marker_left."(.+?)\\".$marker_right."/e","\$parameters['$1']",$format);
		/*$cache_name=md5($format);
		if(($cache_file=cache::get_rewrite($cache_name))===false){
			$format=str_replace('\'','\\\'',$format);
			$format=preg_replace("/\\".$marker_left."(.+?)\\".$marker_right."/","'.\$parameters['$1'].'",$format);
			$format='<?php $format_url=\''.$format.'\';?>';
			$cache_file=cache::write_rewrite($cache_name,$format);
		}
		include($cache_file);
		return $format_url;
		以下效率比直接替换还低
		*/
	}
	public static function trimExplode($flag, $str){
		$rn = array();
		$sp = explode($flag, $str);
		foreach($sp as $v){
			$rn[] = trim($v);
		}
		return $rn;
	}
	public static function filterHtml($arr){
		if(is_array($arr)){
			foreach($arr as $k=>$v){
				$arr[$k] = self::filterHtml($v);
			}
		} else $arr = preg_replace('/<.*?>/s', '', $arr);
		return $arr;
	}
	public static function filterArray($arr, $keys){
		$rn = array();
		foreach($keys as $key){
			if(isset($arr[$key]))$rn[$key] = $arr[$key];
		}
		return $rn;
	}
	public static function replaceVars($str, $arr = array()){
		$arr || $arr = $GLOBALS['webArgs'];
		return preg_replace('/\{(\w+?)\}/e','self::replaceVars_(\'$1\', $arr)', $str);
	}
	private static function replaceVars_($key, $arr){
		if (empty($arr[$key])) return '{'.$key.'}';
		return $arr[$key];
	}
	public static function setMsg($message, $key = '_showmessage'){
		self::setcookie($key, $message);
	}
	public static function formatMoney($money){
		$money = (float)$money;
		$money = floor($money * 100 + 0.5) / 100;
		return $money;
	}
	public static function setCache($name, $data){
		global $_cache;
		if (!isset($_cache)) $_cache = array();
		$_cache[$name] = $data;
		return false;
	}
	public static function getCache($name){
		global $_cache;
		if (isset($_cache)) {
			$data = $_cache[$name];
			if (isset($data)) return $data;
		}
		return false;
	}
	public static function setType(&$var, $type){
		if (is_array($var)) {
			foreach($var as &$v) {
				self::setType($v, $type);
			}
		} else {
			switch ($type) {
				case '01':
					$var = $var ? 1 : 0;
				break;
				case 'money':
					$var = self::getMoney($var);
				break;
				default:
					settype($var, $type);
				break;
			}
		}
	}
}
//common::initialize();
?>