<?php
$top_menu=array(
);
foreach (db::get_list('payfor_interface', 'ename,name') as $v) $top_menu[$v['ename']] = $v['name'];
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$tbName = 'log';
empty($username) && $username = '';
if (form::is_form_hash()) {
	extract(form::get3('username'));
}
$uid = 0;
$username && $uid = member_base::getUid($username);
$multipageUrlAdd = '';
if ($uid) {
	$multipageUrlAdd = '&username='.urlencode($username);
}
switch ($method) {
	case 'chinabank':
		admin::getList('topup', '*', "type='$method'".($uid ? ' AND uid=\''.$uid.'\'' : '') ,'ptimestamp desc');
	break;
	case 'card':
		admin::getList('topup', '*', "type='$method'".($uid ? ' AND uid=\''.$uid.'\'' : '')  ,'ptimestamp desc');
	break;
	case 'alipay':
		if ($confirm) {
			checkWrite();
			if (payfor_topup::complateOrder($confirm, '支付宝转账')) $msg = '确认成功';
			else $msg = '该订单已经确认了';
			admin::show_message($msg, $base_url.'&method='.$method.'&page='.$page);
		}
		if ($bad) {
			checkWrite();
			db::update('topup', array('status' => 2), "id='$bad'");
			admin::show_message('设置成功', $base_url.'&method='.$method.'&page='.$page);
		}
		admin::getList('topup', '*', "type='$method'".($uid ? ' AND uid=\''.$uid.'\'' : '')  ,'status,ptimestamp desc');
	break;
	case 'tenpay':
		if ($confirm) {
			checkWrite();
			if (payfor_topup::complateOrder($confirm, '财付通转账')) $msg = '确认成功';
			else $msg = '该订单已经确认了';
			admin::show_message($msg, $base_url.'&method='.$method.'&page='.$page);
		}
		admin::getList('topup', '*', "type='$method'".($uid ? ' AND uid=\''.$uid.'\'' : '')  ,'ptimestamp desc');
	break;
	case 'setting':
		cache::get_array('payfor_config');
		$payfor_config && extract($payfor_config);
		if (form::is_form_hash()) {
			$datas = form::get('chinabank_status', 'chinabank_id', 'chinabank_key');
			cache::write_array('payfor_config', $datas);
			admin::show_message('设置成功', $base_url);
		}
	break;
	default:
		admin::getList('topup', '*', "type='$method'".($uid ? ' AND uid=\''.$uid.'\'' : '')  ,'ptimestamp desc');
	break;
}
?>