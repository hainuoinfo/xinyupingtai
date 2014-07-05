<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
$top_menu=array(
	'index'     => '基本设置',
);
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$tbName = 'message_log';
switch ($method) {
	case 'index':
		$vars = array(
			'mail_server'   => 'SMTP服务器',
			'mail_port'   => 'SMTP端口',
			'mail_username'   => 'SMTP帐号',
			'mail_from'       => '邮箱地址',
			'mail_password'   => 'SMTP密码',
		);
		if (form::is_form_hash()) {
			$vals = array();
			foreach ($vars as $k => $v) {
				$val = $_POST[$k];
				if (is_array($v)) {
					$remark = $v['title'];
					$v['type'] && settype($val, $v['type']);
				} else {
					$remark = $v;
				}
				$vals[] = array(
					'key'    => $k,
					'val'    => $val,
					'remark' => $remark
				);
			}
			foreach ($vals as $var) {
				$key = $var['key'];
				if ($id = db::one_one('vars', 'id', "`key`='$key'")) {
					db::update('vars', $var, "id='$id'");
				} else {
					db::insert('vars', $var);
				}
			}
			admin::updateVars();
			admin::show_message('添加成功');
		}
	break;
}
?>