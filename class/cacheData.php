<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
class cacheData{
	private static $indexList = array(), $statusList = array(), $cacheData = array(), $lastTime = array(), $lastSuffix = array(), $lastIgnoreKey = array();
	public static $cacheDir, $timestamp;
	private static function getFileKey($file){
		$file = substr($file, strlen(WROOT));
		$file = strtr($file, '\\/.', '___');
		return $file;
	}
	private static function getKey($key, $suffix, $ignoreKey){
		if ($suffix) {
			if ($ignoreKey) $key = $suffix;
			else $key = $key.'_'.$suffix;
		}
		return $key;
	}
	private static function setIndex($key, $count){
		!isset(self::$indexList[$key]) && self::$indexList[$key] = 0;
		self::$indexList[$key] += $count;
	}
	private static function getCache($key, $time){
		$cacheFile = self::$cacheDir.$key.'_'.self::$indexList[$key].'.php';
		//$cacheFile = self::$cacheDir.self::getKey($key, self::$lastSuffix[$key], self::$lastIgnoreKey[$key]).'_'.self::$indexList[$key].'.php';
		if (file_exists($cacheFile)) {
			//echo $cacheFile, '<br />';
			//echo self::$timestamp, '|', filemtime($cacheFile), '|', self::$timestamp - filemtime($cacheFile), '<br /><br />';
			if (self::$timestamp - filemtime($cacheFile) <= $time) {
				$html = file::read($cacheFile);
				$html = substr($html, 13);
				return $html;
			}
		}
		return false;
	}
	private static function saveCache($key, $data){$data = '<?php exit;?>'.$data;
		$cacheFile = self::$cacheDir.$key.'_'.self::$indexList[$key].'.php';
		//$cacheFile = self::$cacheDir.self::getKey($key, self::$lastSuffix[$key], self::$lastIgnoreKey[$key]).'_'.self::$indexList[$key].'.php';
		file::write($cacheFile, $data);
	}
	private static function setStatus($key, $bool){
		self::$statusList[$key.'_'.self::$indexList[$key]] = $bool;
	}
	private static function getStatus($key){
		return self::$statusList[$key.'_'.self::$indexList[$key]];
	}
	public static function cacheStart($file, $time = 3600, $suffix = '', $ignoreKey = false){
		$key = self::getFileKey($file);
		self::$lastTime[$key]      = $time;
		self::$lastSuffix[$key]    = $suffix;
		self::$lastIgnoreKey[$key] = $ignoreKey;
		$key = self::getKey($key, self::$lastSuffix[$key], self::$lastIgnoreKey[$key]);
		self::setIndex($key, 1);
		$html = self::getCache($key, $time);
		//echo $html !== false ? 1: 2, '|', $time, '|', '[', $html, ']', '<br />';
		if ($html !== false) {
			self::setStatus($key, true);
			echo $html;
			return false;
		} else {
			self::setStatus($key, false);
			self::$cacheData[$key] = common::ob_get_contents();
			common::ob_clean();
			return true;
		}
	}
	public static function cacheEnd($file, $end = true){
		$key = self::getFileKey($file);
		$key = self::getKey($key, self::$lastSuffix[$key], self::$lastIgnoreKey[$key]);
		if (!self::getStatus($key)) {
			$data = common::ob_get_contents();
			common::ob_clean();
			echo self::$cacheData[$key];
			unset(self::$cacheData[$key]);
			echo $data;
			self::saveCache($key, $data);
		}
		//if ($end) unset(self::$indexList[$key]);
	}
	public static function cacheClear(){
		self::$statusList    = array();
		self::$cacheData     = array();
		self::$indexList     = array();
		self::$lastTime      = array();
		self::$lastSuffix    = array();
		self::$lastIgnoreKey = array();
	}
	public static function nocacheStart($file){
		self::cacheEnd($file, false);
	}
	public static function nocacheEnd($file){
		$key = self::getFileKey($file);
		return self::cacheStart($file, self::$lastTime[$key], self::$lastSuffix[$key], self::$lastIgnoreKey[$key]);
	}
}
cacheData::$cacheDir  = d('./cache/html/tpl/');
file_exists(cacheData::$cacheDir) || common::create_folder(cacheData::$cacheDir);
cacheData::$timestamp = time();
?>