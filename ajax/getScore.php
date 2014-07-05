<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
common::char_set();
common::nocache();
if (!$memberLogined) {
	echo '对不起，请先登陆后再操作！';
	exit;
}
if ($id = (int)$id) {
	$rs = task_buyer::updateScore($id, $uid);
	echo $rs;
} else {
	echo '参数错误';
}
?>