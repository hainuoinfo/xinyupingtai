<?php
$top_menu=array(
	'replace' => '正则表达式字符替换',
);
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];

?>