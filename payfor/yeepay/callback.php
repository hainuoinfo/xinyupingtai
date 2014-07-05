<?php
include(dirname(__FILE__).DIRECTORY_SEPARATOR.'../../class/index.php');
common::char_set();
if ($_REQUEST['r9_BType'] == '1') {
	//前台
	if (($id = payfor_topup::checkReturnA('yeepay')) !== false) {
		payfor_topup::back($id);
	} else {
		echo '充值失败';
	}
} elseif($_REQUEST['r9_BType'] == '2') {
	//后台
	if (($id = payfor_topup::checkReturnB('yeepay')) !== false) {
		payfor_topup::complateOrder($id, '通过网银在线充值');
		//payfor_topup::back($id);
		echo 'success';
	} else {
		echo '充值失败';
	}
}
?>