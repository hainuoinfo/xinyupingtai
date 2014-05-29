<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php')
if (!$memberLogined) exit('');
$rs = array();
     $maidian=$_POST['andmine'];
    if($maidian){
	        $sale=rand(4,8);
			$num=50;
			$money=$num*$sale/10;
			member_base::addFabudian($uid, $num);
			member_base::addMoney($uid, $money);
			$surplus=$memberFields[money]-$money;
				$rs = array(
				'sale'   => $sale,
				'money'   => $money,
				'surplus'  => $surplus,
			);	
	}else{
	            $rs = array(
				'error'   => '参数错误！'
			);
	}
echo json_encode($rs);
?>