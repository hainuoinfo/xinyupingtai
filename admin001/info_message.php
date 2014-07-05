<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
$top_menu=array(
	'index'     => '基本设置',
	'send'      => '发送短信',
	'log'       => '信息记录',
	'vcode_log' => '激活码发送记录',
	'pwd2_log'  => '操作码发送记录',
);
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$tbName = 'message_log';
switch ($method) {
	case 'index':
		$vars = array(
			'msg_username'   => '短信帐号',
			'msg_password'   => '短信密码',
			'msg_price'      => array('title' => '每条短信价格' ,'type' => 'float'),
			'msg_user_price' => array('title' => '每条短信普通用户价格', 'type' => 'float'),
			'msg_vip_price'  => array('title' => '每条短信会员价格', 'type' => 'float'),
			'msg_vcode_time' => array('title' => '激活码发送间隔时间(秒)', 'type' => 'int')
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
	case 'send':
		$money = message::getMoney();
		if (!is_numeric($money)) {
			admin::show_message('不能发送短信，错误信息：'.language::get($money, 'message'));
		}
		$money = sprintf('%0.1f', $money);
		if (form::is_form_hash()) {
			extract($_POST);
			if ($phones && $message) {
				$rs = message::send($phones, $message);
				if (is_numeric($rs) && $rs >= 0) {
					admin::show_message('成功发送了'.$rs.'条', $base_url.'&method='.$method);
				} else {echo 123;
					admin::show_message('发送失败，错误信息：'.language::get($rs, 'message'));
				}
			} else {
				$info = '参数错误';
			}
		}
	break;
	case 'log':
		admin::getList($tbName, '*', '', 'timestamp desc');
	break;
	case 'vcode_log':
		admin::getList('vcode_log', '*', '', 'timestamp desc');
	break;
	case 'pwd2_log':
		admin::getList('pwd2_log', '*', '', 'timestamp desc');
	break;
}
?>