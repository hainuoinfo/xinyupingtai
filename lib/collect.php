<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
template::initialize('./templates/default/'.$action.'/', './cache/default/'.$action.'/');//
$ops = array('collect');
($operation && in_array($operation, $ops)) || $operation = $ops[0];
switch ($operation) {
	case 'collect':
		$nav_bar = array(
			array('title' => $web_name, 'url' => $weburl.'/')
		);
		if ($rs = form::is_form_hash2()){
		if ($memberLogined){
		    if($member['status']!=''){
                $style=$_POST['style'];
				if($style==1){
				    $datas = form::get('nums', 'cs_url', 'cs_mark');
                    $datas['uid'] = $uid;
					$datas['user_name'] = $member['username'];
					$datas['user_tname']=$member['truename'];
				    $datas['user_tel']=$member['mobilephone'];
				    $datas['user_qq']=$member['qq'];
				    $datas['cs_atime']=$timestamp;
				    $datas['cs_ip']=$ipint;
					$money = $datas['nums'] * 0.1 ;
					if($money <= $memberFields['money']){
					    member_base::addMoney($uid, -$money,'购买收藏服务');
				        db::insert('collect',$datas);
					    echo "<script>alert('恭喜您购买收藏服务成功！');window.location.href='';</script>";
					}else{
					    echo "<script>alert('余额不足，请先充值！');window.location.href='/member/topup/';</script>";
					}
				}
				if($style==2){
				    $datas = form::get('days', 'url', 'ips');
					if($datas['ips']==200){
					    $price = 6 ;
					}
					if($datas['ips']==500){
					    $price = 8 ;
					}
					if($datas['ips']==1000){
					    $price = 13.6 ;
					}
					if($datas['ips']==2000){
					    $price = 26 ;
					}
					if($datas['ips']==3000){
					    $price = 39 ;
					}
					if($datas['ips']==4000){
					    $price = 54 ;
					}
					if($datas['ips']==5000){
					    $price = 66.8 ;
					}
					if($datas['ips']==6000){
					    $price = 80.8 ;
					}
					if($datas['ips']==7000){
					    $price = 94.4 ;
					}
					if($datas['ips']==8000){
					    $price = 107.8 ;
					}
					if($datas['ips']==9000){
					    $price = 121.2 ;
					}
					if($datas['ips']==10000){
					    $price = 148 ;
					}
					$money = $datas['days'] * $price ;
					$datas['uid'] = $uid;
					$datas['user_name'] = $member['username'];
					$datas['user_tname']=$member['truename'];
				    $datas['user_tel']=$member['mobilephone'];
					$datas['user_qq']=$member['qq'];
				    $datas['price']=$money;
				    $datas['atime']=$timestamp;
				    $datas['ip']=$ipint;
				    if($datas['price'] <= $memberFields['money']){
					     member_base::addMoney($uid, -$money,'购买流量服务');
				         db::insert('rate',$datas);
					     echo "<script>alert('恭喜您购买流量服务成功！');window.location.href='';</script>";
					}else{
					    echo "<script>alert('余额不足，请先充值！');window.location.href='/member/topup/';</script>";
					}
				
				}
				
			}else{
             echo"<script>alert('您的手机号还未激活，请先激活手机号再购买！');window.location.href='/member/topup/';</script>";
			}
		}else{
		echo"<script>alert('您还未登陆，请先登录再进行操作！');window.location.href='/member/';</script>";
		}
		}
		include(template::load($operation));
	break;
}
?>