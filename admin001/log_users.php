<?php
$top_menu=array(
	'credits'   => '积分日志',
	'money'     => 'RMB日志',
	'fabudian'  => '发布点日志',
	'vipLog'    => 'VIP消费记录',
	'ensureLog' => '商保担保金记录'
);
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$tbName = 'log';
switch ($method) {
	case 'credits':
		$tmp = $base_url;
		$base_url .= '&method='.$method;
		admin::getList($tbName, '*', "type='$method'", 'timestamp desc');
		$base_url = $tmp;
	break;
	case 'money':
		$tmp = $base_url;
		$base_url .= '&method='.$method;
		admin::getList($tbName, '*', "type='$method'", 'timestamp desc');
		$base_url = $tmp;
	break;
	case 'fabudian':
		$tmp = $base_url;
		$base_url .= '&method='.$method;
		admin::getList($tbName, '*', "type='$method'", 'timestamp desc');
		$base_url = $tmp;
	break;
	case 'vipLog':
		$tmp = $base_url;
		$base_url .= '&method='.$method;
		admin::getList('log_vip', '*', '', 'timestamp desc');
		$base_url = $tmp;
	break;
	case 'ensureLog':
		$tmp = $base_url;
		$base_url .= '&method='.$method;
		admin::getList('ensure_log', '*', '', 'timestamp desc');
		$base_url = $tmp;
	break;
}
?>