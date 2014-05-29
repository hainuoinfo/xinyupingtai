<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
common::char_set();
common::nocache();
if (!$memberLogined) {
	echo '对不起，请先登陆后再操作！';
	exit;
}
$data = array();
     $maidian=$_POST['andmine'];
    if($maidian){
	        $sale=rand(4,8);
			$num=50;
			$money=$num*$sale/10;
			member_base::addFabudian($uid, $num);
			member_base::addMoney($uid, -$money);
			$surplus=$memberFields['money']-$money;
				$data = array(
				'sale'   => $sale,
				'money'   => $money,
				'surplus'  => $surplus,
			);	
	}else{
	            $data = array(
				'error'   => '参数错误！'
			);
	}
echo json_encode($data);
?>