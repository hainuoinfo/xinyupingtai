<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
if (!$memberLogined) exit('');
$rs = array();
     $viptype=$_POST['viptype'];
    if($viptype==1){
	        
				$rs = array(
				'detailed'   => "一个月:30元",
				'mounth'   => 30,
			);	
	}elseif($viptype==2){
	        
				$rs = array(
				'detailed'   => "一个月:48元",
				'mounth'   => 48,
			);	
	}elseif($viptype==3){
	        
				$rs = array(
				'detailed'   => "一个月:99元",
				'mounth'   => 99,
			);	
	}else{
	            $rs = false;
	}
echo json_encode($rs);
?>