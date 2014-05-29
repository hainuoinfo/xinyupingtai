<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
common::char_set();
common::nocache();
if (!$memberLogined) {
	echo '对不起，请先登陆后再操作！';
	exit;
}
template::initialize('./templates/default/ajax/', './cache/default/ajax/');
$taskid = $_POST['taskid'];
$b_memo = $_POST['remark'];
$s_memo = $_POST['ramark'];
if($taskid){
    if ($task = task_base::_get($taskid)) {
	    if($s_memo){
		    db::update('task', array('s_memo' =>$s_memo), "id='$taskid'");
			$result='备注提交成功';
		}
		if($b_memo){
	        db::update('task', array('b_memo' =>$b_memo), "id='$taskid'");
			$result='备注提交成功';
		}
	}
}

echo $result;
?>