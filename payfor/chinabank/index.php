<?php
include(dirname(__FILE__).DIRECTORY_SEPARATOR.'../../class/index.php');
echo payfor_topup::payfor($uid, '500', 'chinabank')
?>