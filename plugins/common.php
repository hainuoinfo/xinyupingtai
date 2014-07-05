<?php
!defined('IN_JB') && exit('error');
define('IN_JB_PLUGIN', true);//兼容老版本，一定版本之后可以去掉
define('IN_QS_PLUGIN', true);//
//error_reporting(E_ALL & ~E_NOTICE);
class plugins{
	private static $xmlPre = 'qs_plugin_', $cacheName = 'cache_plugins', $plugins = array(),$cachePName = '';//xml prefix
	public static function initialize(){
		self::$cachePName = __CLASS__.'_plugins';
	}
	private static function getRunPlugins(){
		$datas = memory::getClass(self::$cachePName);
		if (isset($datas)) return $datas;
		$datas = cache::get_array(self::$cacheName, true);
		memory::writeClass(self::$cachePName, $datas);
		return $datas;
	}
	public static function loadPlugins(){
		$plugins = self::getRunPlugins();
		foreach ($plugins as $plugin => $type) {
			$pluginFile = PLUGIN_ROOT.$plugin.D.'plugin.inc.php';
			include_once($pluginFile);
			$class = 'plugin_'.$plugin;
			self::$plugins[$type][$plugin] = new $class();
		}
	}
	public static function call($type, $pluginName = '', $m = 'run'){//echo func_num_args();exit;
		$args = array();
		if (func_num_args() > 3) {
			$args = func_get_args();
			unset($args[0], $args[1], $args[2]);
			$args = array_values($args);
		}
		if (isset(self::$plugins[$type])) {
			template::config();
			if ($pluginName != '') {
				if ($plugin = self::$plugins[$type][$pluginName]) {
					if (method_exists($plugin, $m)) {
						template::initialize('./plugins/'.$pluginName.'/templates/', './cache/default/plugins/'.$pluginName.'/');
						$datas = $plugin->$m($args);
						if (!empty($datas)) {
							template::config(false);
							return $datas;
						}
					}
				}
			} else {
				foreach (self::$plugins[$type] as $pluginName => $plugin) {
					if (method_exists($plugin, $m)) {
						template::initialize('./plugins/'.$pluginName.'/templates/', './cache/default/plugins/'.$pluginName.'/');
						$datas = $plugin->$m($args);
						if (!empty($datas)) {
							template::config(false);
							return $datas;
						}
					}
				}
			}
			template::config(false);
		}
	}
	public static function getCount($type){
		return count(self::$plugins[$type]);
	}
	public static function callHeader(){
		self::call('header');
	}
	public static function callFooter(){
		self::call('footer');
	}
	public static function callMarker($name){
		self::call('marker', $name);
	}
	public static function callName($name){
		self::call($name);
	}
	private static function isPlugin($pluginName){
		$dir        = PLUGIN_ROOT.$pluginName;
		$xmlFile    = $dir.D.self::$xmlPre.'config.xml';
		$pluginFile = $dir.D.'plugin.php';
		return file_exists($xmlFile) && file_exists($pluginFile);
	}
	public static function getPlugins($type = ''){
		$list = array();
		if ($o = opendir(PLUGIN_ROOT)) {
			while ($filename = readdir($o)) {
				$file = PLUGIN_ROOT.$filename;
				if (!in_array($filename, array('.', '..')) && filetype($file) == 'dir') {
					$xmlFile    = $file.D.self::$xmlPre.'config.xml';
					$pluginFile = $file.D.'plugin.php';
					if (file_exists($xmlFile) && file_exists($pluginFile)) {
						$lockFile  = $file.D.'install.lock';
						$lockFile2 = $file.D.'suspend.lock';
						$installed = file_exists($lockFile);
						$suspend   = file_exists($lockFile2);
						if ($type == '' || ($type == 'installed' && $installed) || ($type == 'uninstalled' && !$installed)) {
							$xmlData = file::read($xmlFile);
							$xmlArr  = string::getXmlData($xmlData);
							$xmlArr['marker'] = trim($xmlArr['marker']);
							$xmlArr['marker'] || $xmlArr['marker'] = 'marker';
							$list[] = array(
								'folder'      => $filename,
								'title'       => trim($xmlArr['title']),
								'description' => trim($xmlArr['description']),
								'author'      => trim($xmlArr['author']),
								'support'     => trim($xmlArr['support']),
								'marker'      => trim($xmlArr['marker']),
								'version'     => trim($xmlArr['version']),
								'installed'   => $installed,
								'suspend'     => $suspend
							);
						}
					}
				}
			}
			closedir($o);
		}
		return $list;
	}
	private static function addRunPlugin($folder, $marker){
		$plugins = self::getRunPlugins();
		if ($plugins[$folder]) unset($plugins[$folder]);
		$plugins[$folder] = $marker;
		cache::write_array(self::$cacheName, $plugins);
		memory::writeClass(self::$cachePName, $plugins);
		return true;
	}
	private static function removeRunPlugin($folder){
		$plugins = self::getRunPlugins();
		if ($plugins[$folder]) unset($plugins[$folder]);
		cache::write_array(self::$cacheName, $plugins);
		memory::writeClass(self::$cachePName, $plugins);
		return true;
	}
	public static function install($folder){
		global $db, $pre;
		$dir = PLUGIN_ROOT.$folder;//plugin dir
		if (file_exists($dir) && filetype($dir) == 'dir') {
			$xmlFile    = $dir.D.self::$xmlPre.'config.xml';
			$pluginFile  = $dir.D.'plugin.php';
			$pluginFile2 = $dir.D.'plugin.inc.php';
			if (file_exists($xmlFile) && file_exists($pluginFile)) {
				$lockFile = $dir.D.'install.lock';
				if (file_exists($lockFile)) {
					return false;//已经安装过了
				}
				$xmlData = file::read($xmlFile);
				$xmlArr  = string::getXmlData($xmlData);
				$installFile = '';
				$xmlArr['install'] = trim($xmlArr['install']);
				$xmlArr['marker']    = trim($xmlArr['marker']);
				$xmlArr['marker'] || $xmlArr['marker'] = 'marker';
				$xmlArr['install'] && $installFile = d(PLUGIN_ROOT.$folder.D.$xmlArr['install'], false);
				if ($installFile) {
					$pluginName = $folder;
					$pluginType = $xmlArr['marker'];
					if (!file_exists($installFile)) return false;
					if(!@include($installFile)) return false;
					else {
						file_exists($pluginFile2) || @copy($pluginFile, $pluginFile2);
					}
				}
				//$plugins = cache::get_array(self::$cacheName, true);
				//if ( ($key = array_search($folder, $plugins)) !==false ) unset($plugins[$key]);
				//if ($plugins[$folder]) unset($plugins[$folder]);
				//$plugins[$folder] = trim($xmlArr['marker']);
				//cache::write_array(self::$cacheName, $plugins);
				self::addRunPlugin($folder, trim($xmlArr['marker']));
				touch($lockFile);
				return true;
			}
		}
		return false;
	}
	public static function suspend($folder) {
		$dir = PLUGIN_ROOT.$folder;//plugin dir
		if (file_exists($dir) && filetype($dir) == 'dir') {
			$xmlFile    = $dir.D.self::$xmlPre.'config.xml';
			$pluginFile = $dir.D.'plugin.php';
			if (file_exists($xmlFile) && file_exists($pluginFile)) {
				$lockFile = $dir.D.'install.lock';
				$lockFile2 = $dir.D.'suspend.lock';
				if (file_exists($lockFile)) {
					if (self::removeRunPlugin($folder)) {
						touch($lockFile2);
						return true;
					}
					return false;
					//return true;
				}
			}
		}
		return false;
	}
	public static function resume($folder) {
		$dir = PLUGIN_ROOT.$folder;//plugin dir
		if (file_exists($dir) && filetype($dir) == 'dir') {
			$xmlFile    = $dir.D.self::$xmlPre.'config.xml';
			$pluginFile = $dir.D.'plugin.php';
			if (file_exists($xmlFile) && file_exists($pluginFile)) {
				$lockFile = $dir.D.'install.lock';
				$lockFile2 = $dir.D.'suspend.lock';
				if (file_exists($lockFile) && file_exists($lockFile2)) {
					$xmlData = file::read($xmlFile);
					$xmlArr  = string::getXmlData($xmlData);
					$xmlArr['marker']    = trim($xmlArr['marker']);
					$xmlArr['marker'] || $xmlArr['marker'] = 'marker';
					if (self::addRunPlugin($folder, $xmlArr['marker'])) {
						@unlink($lockFile2);
						return true;
					}
					return false;
					//return true;
				}
			}
		}
		return false;
	}
	public static function uninstall($folder){
		global $db, $pre;
		$dir = PLUGIN_ROOT.$folder;//plugin dir
		if (file_exists($dir) && filetype($dir) == 'dir') {
			$xmlFile    = $dir.D.self::$xmlPre.'config.xml';
			$pluginFile  = $dir.D.'plugin.php';
			$pluginFile2 = $dir.D.'plugin.inc.php';
			if (file_exists($xmlFile) && file_exists($pluginFile)) {
				$lockFile  = $dir.D.'install.lock';
				$lockFile2 = $dir.D.'suspend.lock';
				if (file_exists($lockFile)) {
					$xmlData = file::read($xmlFile);
					$xmlArr  = string::getXmlData($xmlData);
					$installFile = '';
					$xmlArr['uninstall'] = trim($xmlArr['uninstall']);
					$xmlArr['uninstall'] && $uninstallFile = d(PLUGIN_ROOT.$folder.D.$xmlArr['uninstall'], false);
					$plugins = self::getRunPlugins();
					if ($uninstallFile) {
						$pluginName = $folder;
						$pluginType = $plugins[$folder];
						if (!file_exists($uninstallFile)) return false;
						if(!include($uninstallFile)) return false;
						else {
							file_exists($pluginFile2) && @unlink($pluginFile2);
						}
					}
					/*$plugins = cache::get_array(self::$cacheName, true);
					if ($plugins[$folder]) unset($plugins[$folder]);
					cache::write_array(self::$cacheName, $plugins);*/
					self::removeRunPlugin($folder);
					@unlink($lockFile);
					@unlink($lockFile2);
					return true;
				}
			}
		}
		return false;
	}
	public static function delPlugins($plugins){
		foreach ($plugins as $plugin) {
			if (self::isPlugin($plugin)) {
				$dir      = PLUGIN_ROOT.$plugin;
				$xmlFile  = $dir.D.self::$xmlPre.'config.xml';
				$lockFile = $dir.D.'install.lock';
				if (file_exists($lockFile)) {
					if (!self::uninstall($plugin)) continue;
				}
				file::rmDir($dir);
			}
		}
		return true;
	}
}
plugins::initialize();
?>