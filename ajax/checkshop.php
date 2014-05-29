<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
loadLib('task.base');
if (!$memberLogined) {
	echo '对不起，请先登陆后再操作！';
	exit;
}
  $goodsUrl=$_POST['goodsUrl'];
  $seller=$_POST['seller'];
  if($seller){
    $rs=0;
  }
echo $rs;
?>