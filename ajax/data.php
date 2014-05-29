<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
if (!$memberLogined) exit('');
switch($action){
	case 'taobao':
		switch($operation){
			case 'nickName':
				echo data_taobaoShop::getNick($shopId);
			break;
		}
	break;
}
?>