<?
include(dirname(__FILE__).DIRECTORY_SEPARATOR.'../../class/index.php');
if (($id = payfor_topup::checkReturnA('chinabank')) !== false) {
	if ($sys_debug) payfor_topup::complateOrder($id, '通过网银在线充值');
	payfor_topup::back($id);
} else {
	echo '充值失败';
}
?>