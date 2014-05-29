<?php
class html_editor{
	public $width,$height;
	public function __construct(){
		$this->width=800;
		$this->height=600;
	}
	public static function create(){
		template::config();
		template::initialize('./templates/default/interface/','./cache/default/interface/','.htm','.php');
		include(template::load('editor'));
		//eval(parse_php::parse(file::read(d('./mysql.php'))));
	}
}
?>