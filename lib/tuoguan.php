<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
template::initialize('./templates/default/'.$action.'/', './cache/default/'.$action.'/');//
$ops = array('tuoguan');
($operation && in_array($operation, $ops)) || $operation = $ops[0];
switch ($operation) {
	case 'tuoguan':
		$nav_bar = array(
			array('title' => $web_name, 'url' => $weburl.'/')
		);
		if ($rs = form::is_form_hash2()){
		    if ($memberLogined){
                $datas = form::get('store_price', 'store_deal', 'store_day','store_att');
				$store_style =$_POST['store_style'];
				$datas['uid']=$uid;
				$datas['username']=$member['username'];
				$datas['usertname']=$member['truename'];
				$datas['user_tel']=$member['mobilephone'];
				$datas['user_qq']=$member['qq'];
				$datas['store_atime']=$timestamp;
				$datas['store_ip']=$ipint;
			    if($member['status']){
				    if($store_style==1){
				        if($datas['store_price'] <= $memberFields['money']){
					    $money = $datas['store_price'];
					    member_base::addMoney($uid, -$money,'购买网店托管服务');
				        db::insert('store',$datas);
					    echo "<script>alert('购买网店托管服务成功！');window.location.href='';</script>";
					}else{
					    echo "<script>alert('余额不足，请先充值！');window.location.href='/member/topup/';</script>";
					}   
				    }
				    if($store_style==2){
				    if($datas['store_price'] <= $memberFields['money']){
					$money = $datas['store_price'];
					member_base::addMoney($uid, -$money,'购买网店托管服务');
				    db::insert('store',$datas);
					echo "<script>alert('购买网店托管服务成功！');window.location.href='';</script>";
					}else{
					echo "<script>alert('余额不足，请先充值！');window.location.href='/member/topup/';</script>";
					}   
				   }
				   if($store_style==3){
				    if($datas['store_price'] <= $memberFields['money']){
					$money = $datas['store_price'];
					member_base::addMoney($uid, -$money,'购买网店托管服务');
				    db::insert('store',$datas);
					echo "<script>alert('购买网店托管服务成功！');window.location.href='';</script>";
					}else{
					echo "<script>alert('余额不足，请先充值！');window.location.href='/member/topup/';</script>";
					}   
				   }
				   if($store_style==4){
				    if($datas['store_price'] <= $memberFields['money']){
					$money = $datas['store_price'];
					member_base::addMoney($uid, -$money,'购买网店托管服务');
				    db::insert('store',$datas);
					echo "<script>alert('购买网店托管服务成功！');window.location.href='';</script>";
					}else{
					echo "<script>alert('余额不足，请先充值！');window.location.href='/member/topup/';</script>";
					}   
				   }
				   if($store_style==5){
				    if($datas['store_price'] <= $memberFields['money']){
					$money = $datas['store_price'];
					member_base::addMoney($uid, -$money,'购买网店托管服务');
				    db::insert('store',$datas);
					echo "<script>alert('购买网店托管服务成功！');window.location.href='';</script>";
					}else{
					echo "<script>alert('余额不足，请先充值！');window.location.href='/member/topup/';</script>";
					}   
				    }
				   if($store_style==6){
				    if($datas['store_price'] <= $memberFields['money']){
					$money = $datas['store_price'];
					member_base::addMoney($uid, -$money,'购买网店托管服务');
				    db::insert('store',$datas);
					echo "<script>alert('购买网店托管服务成功！');window.location.href='';</script>";
					}else{
					echo "<script>alert('余额不足，请先充值！');window.location.href='/member/topup/';</script>";
					}   
				    }
				    if($store_style==7){
				    if($datas['store_price'] <= $memberFields['money']){
					$money = $datas['store_price'];
					member_base::addMoney($uid, -$money,'购买网店托管服务');
				    db::insert('store',$datas);
					echo "<script>alert('购买网店托管服务成功！');window.location.href='';</script>";
					}else{
					echo "<script>alert('余额不足，请先充值！');window.location.href='/member/topup/';</script>";
					}   
				    }
				    if($store_style==8){
				    if($datas['store_price'] <= $memberFields['money']){
					$money = $datas['store_price'];
					member_base::addMoney($uid, -$money,'购买网店托管服务');
				    db::insert('store',$datas);
					echo "<script>alert('购买网店托管服务成功！');window.location.href='';</script>";
					}else{
					echo "<script>alert('余额不足，请先充值！');window.location.href='/member/topup/';</script>";
					}   
				    }
			    }else{
			     echo "<script>alert('您的手机号还未激活，请先激活手机号再购买！');window.location.href='/member/topup/';</script>";
			  }
            } else{
	        common::goto_url('/member/login/');
            }
		}
		include(template::load($operation));
	break;
}
?>