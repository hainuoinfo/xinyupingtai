<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
loadLib('member.base');
loadLib('member.credit');
common::char_set();
common::nocache();
if (!$memberLogined) {
	echo '对不起，请先登陆后再操作！';
	exit;
}
template::initialize('./templates/default/ajax/', './cache/default/ajax/');
    $out = $_POST['taskid'];
	if ($out) {
	    $result = task_tao::taskout($out, $uid);
	}
echo json_encode($result);
?>