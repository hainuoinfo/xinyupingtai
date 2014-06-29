<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
$top_menu=array(
	'send'     => '发送站内信'
);
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$tbName = 'message_log';
switch ($method) {
	case 'send':
		if (form::is_form_hash()) {
			extract(form::get2('username', 'title', 'content'));
			if ($username && $title && $content) {
				$i = 0;
				$sp = preg_split('/,|，/', $username);
				$sp = array_filter($sp);
				$us = '\''.implode('\',\'', $sp).'\'';
				$query = db::query("SELECT id FROM `{$pre}members` WHERE username IN($us)");
				while ($__uid = db::fetchArrayFirst($query)) {
					msg::sendSys($__uid, $content, $title);
					$i++;
				}
				admin::show_message('发送了'.$i.'条站内信', $base_url.'&method=send');
			} else admin::show_message('参数错误！');
		}
	break;
}
?>