<?php
class filterCss{
	private $cssList,$html;
	public function __construct(){
		$this->re();
	}
	public function re(){
		//重置
		$this->cssList=array();
		$this->html='';
	}
	public function addCss($file){
		$this->cssList[]=$file;
	}
}
?>