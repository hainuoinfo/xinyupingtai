<?php
class template{
	private static $tpl_folder;
	private static $cache_folder;
	private static $tpl_suffix;
	private static $this_tpl_folder;
	private static $cache_suffix;
	private static $configs=array(),$js_lib=array(),$css_lib=array(),$subTplList=array();
	public static function initialize($tpl='./templates/default/',$cache='./cache/default/',$suffix='.htm',$cache_suffix='.php'){
		self::$tpl_folder=d($tpl);
		self::$cache_folder=d($cache);
		self::$tpl_suffix=$suffix;
		self::$cache_suffix=$cache_suffix;
	}
	public static function getTpl($name = ''){
		$file = self::$tpl_folder;
		$name && $file.=$name.self::$tpl_suffix;
		return $file;
	}
	public static function getCache($name = ''){
		$file = self::$cache_folder;
		$name && $file.=$name.self::$cache_suffix;
		return $file;
	}
	public static function config($save=true,$name='def'){
		if(!$save){
			if(self::$configs[$name]){
				self::set_config(self::$configs[$name]);
			} else common::show_message('template config load error!');
		} else {
			self::$configs[$name]=self::get_config();
		}
	}
	public static function get_config(){
		return array('tpl_folder'=>self::$tpl_folder,'cache_folder'=>self::$cache_folder,'tpl_suffix'=>self::$tpl_suffix,'this_tpl_folder'=>self::$this_tpl_folder,'cache_suffix'=>self::$cache_suffix);
	}
	public static function set_config($config){
		self::$tpl_folder=$config['tpl_folder'];
		self::$cache_folder=$config['cache_folder'];
		self::$tpl_suffix=$config['tpl_suffix'];
		self::$this_tpl_folder=$config['this_tpl_folder'];
		self::$cache_suffix=$config['cache_suffix'];
	}
	public static function install(){
		common::create_folders(self::$tpl_folder,self::$cache_folder);
	}
	public static function exists($name,$tpl=true){
		$name=strtr($name,'\\/',D.D);
		return file_exists($tpl?self::$tpl_folder.$name.self::$tpl_suffix:self::$cache_folder.$name.self::$cache_suffix);
	}
	public static function load($tpl_name,$ispath=false,$custom_cache_name=''){
		$cache_name=$ispath?strtr($tpl_name, '/', D):$tpl_name;
		$tpl=self::$tpl_folder.$tpl_name.self::$tpl_suffix;
		$cache=self::$cache_folder.$cache_name.self::$cache_suffix;
		return self::load_base($tpl,$cache);
	}
	public static function load_folder($tpl_name,$folder=''){
		$folder&&($folder.='/');
		self::$this_tpl_folder=self::$tpl_folder.$folder;
		return self::load_base(self::$this_tpl_folder.$tpl_name.self::$tpl_suffix,self::$cache_folder.$folder.$tpl_name.self::$cache_suffix);
	}
	public static function load_base($tpl_file,$cache_file,$ignoreTime = false){
		//$parse = false;
		$parse = $ignoreTime;
		if(!$ignoreTime){
			if(!file_exists($cache_file)){
				if(file_exists($tpl_file)){
					$parse=true;
				} else {
					common::show_message("Current template file '".basename($tpl_file)."' not found or have no access!");
				}
			} else {
				if(file_exists($tpl_file)&&(filemtime($tpl_file)>filemtime($cache_file)))$parse=true;
			}
		}
		if($parse){
			$cacheLockFile = $cache_file.'.lock';
			if(!file_exists($cacheLockFile)){
				self::$subTplList=array();
				$tpl_file=d($tpl_file);
				$cache_file=d($cache_file);
				$cache_file_info=pathinfo($cache_file);
				common::create_folder($cache_file_info['dirname']);
				touch($cacheLockFile);//锁定模板解析
				$code=file_get_contents($tpl_file);
				$code=self::parse_code($code);
				$pathinfo = pathinfo($tpl_file);
				$code = '<?php !defined("IN_JB")&&exit("error");$__tplUrl = \''.u($pathinfo['dirname'] . D).'\';'.substr($code,6);
				$refreshCode='';
				foreach(self::$subTplList as $subTpl){
					$refreshCode && $refreshCode.='||';
					$refreshCode.='filemtime(\''.$subTpl.'\')>$_tplModify';
				}
				$refreshCode && ($refreshCode = '$_tplModify=filemtime(\''.$cache_file.'\');if('.$refreshCode.'){include(template::load_base(\''.$tpl_file.'\',\''.$cache_file.'\',true));exit;}') && $code = '<?php '.$refreshCode.'?>'.$code;
				$code = parse_php::formatArray($code);
				file_put_contents($cache_file,$code);
				self::$js_lib=array();
				self::$css_lib=array();
				@unlink($cacheLockFile);
			} else {
				exit('php template:'.$tpl_file.' is parseing,please wait...');
			}
		}
		return $cache_file;
		
	}
	public static function parse_code($code){
		language::load('index');
		$nest = 6;
		//$code = self::stripblock($code);
		//$code = preg_replace("/\{lang\s+(.+?)\}/ies", "self::languagevar('\\1')", $code);
		//$code = preg_replace("/[\n\r\t]*\{template\s+([^\/:*?\"<>|}]+)\}[\n\r\t]*/ies", "self::stripvtemplate('\\1', 0)", $code);
		//$code = preg_replace("/[\n\r\t]*\{subtemplate\s+([^\/:*?\"<>|}]+)\}[\n\r\t]*/ies", "self::stripvtemplate('\\1', 1)", $code);
		//$code = preg_replace("/\{lang2\s+(.+?)\}/ies", "'<?=language::get('.self::stripphpvtags('\\1').')? >'", $code);
		$code = parse_php::parse($code);
		return '<?php '.$code.'?>';
	}
	private static function stripvtemplate($tpl, $sub) {
		$vars = explode(':', $tpl);
		$codeid = 0;
		$tpldir = '';
		if(count($vars) == 2) {
			list($codeid, $tpl) = $vars;
			$tpldir = './plugins/'.$codeid.'/templates';
		}
		if($sub) {
			return self::loadsubtemplate($tpl, $codeid, $tpldir);
		} else {
			return self::stripvtags("<? include template::load('$tpl', '$codeid', '$tpldir'); ?>", '');
		}
	}
	public static function loadsubtemplate($tpl_name, $codeid = 0, $tpldir = '') {
		($folder=self::$this_tpl_folder)||($folder=self::$tpl_folder);
		$tpl=$folder.$tpl_name.self::$tpl_suffix;
		$tpl = realpath($tpl);//获取规范化路径
		//if(file_exists($tpl)){
		if ($tpl !== false) {
			$pathinfo = pathinfo($tpl);//模板路径信息
			$cacheName = md5($tpl);//缓存配置名字
			template::config(true, $cacheName);//缓存当前配置
			$tplFolder   = $pathinfo['dirname'].D;//当前模板文件夹
			$cacheFolder = str_replace('templates', 'cache', $tplFolder);//缓存模板文件夹
			self::$tpl_folder   = $tplFolder;//进入当前模板路径
			self::$cache_folder = $cacheFolder;//进入当前缓存路径
			self::$subTplList[]=$tpl;
			$code = file_get_contents($tpl);
			$code = self::parse_code($code);
			template::config(false, $cacheName);//还原之前的模板路径
			return $code;
			//$code=parse_php::parse($code);
			//return '<?php '.$code.'? >';
		} else return 'sub_template '.$tpl_name.' not found';
		return $content;
	}
	public static function css_select($css_list){
		$css_list=explode(',',$css_list);
		foreach($css_list as $css){
			if(!self::$css_lib[$css]){
				css::select_lib($css);
				self::$css_lib[$css]=true;
			}
		}
		return css::output(true);
	}
	public static function js_select($js_list){
		$js_list=explode(',',$js_list);
		foreach($js_list as $js){
			if(!self::$js_lib[$js]){
				javascript::select_lib($js);
				self::$js_lib[$js]=true;
			}
		}
		return javascript::output(true);
	}
	private static function addquote($var) {
		return str_replace("\\\"", "\"", preg_replace("/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s", "['\\1']", $var));
	}
	private static function languagevar($var) {
		return language::get($var,'index','default');
	}
	private static function stripphpvtags($expr) {
		$expr = str_replace("\\\"", "\"", preg_replace("/\<\?\=(\\\$.+?)\?\>/s", "\\1", $expr));
		return $expr;
	}
	private static function stripvtags($expr, $statement) {
		$expr = str_replace("\\\"", "\"", preg_replace("/\<\?\=(\\\$.+?)\?\>/s", "\\1", $expr));
		$statement = str_replace("\\\"", "\"", $statement);
		return $expr.$statement;
	}
	public static function stripblock($marker) {
		global $db,$pre;
		$data=$db->result_first("select data from {$pre}block where marker='$marker'");
		if($data){
			return self::parse_code($data);
		}
	}
}
template::initialize();
?>