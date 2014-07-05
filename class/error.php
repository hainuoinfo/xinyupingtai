<?php
class error{
	public static function _404(){
		global $weburl;
		common::ob_clean();
		header("HTTP/1.1 404 Not Found");
		include(template::load('error/404', true));
		exit;
	}
	public static function bbsMsg($message){
		template::initialize('./templates/default/bbs/', './cache/default/bbs/');//设置BBS模板缓存目录
		extract($GLOBALS);
		$cssList = array(
			css::getUrl('login', 'bbs')
		);
		include(template::load('show_message'));
		exit;
	}
	public static function forumNotFound(){
		self::bbsMsg('对不起，您访问的版块不存在');
	}
}
?>