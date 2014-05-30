<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
loadLib('member.credit');
language::load(array('folder' => 'member', 'name' => 'reg'));
template::initialize('./templates/default/'.$action.'/', './cache/default/'.$action.'/');//设置BBS模板缓存目录
$ops = array('index', 'reg', 'forgotpwd', 'login', 'logout', 'pwd2', 'info', 'active', 'credit', 'kefu', 'sms', 'message', 'userdata', 'setpwd','vipinfo',
'thread',
'exam',
'topup',
'topupLog',
'payment',
'paymentLog',
'buyTaobaoVcode',
'buyAlipay',
'setting',
'card',
'cardLog',
'vip',
'ShuaKe',
'flowVip',
'exchange','Authentication','buytao','buypai',
'PayDetails','userjob','mineaction',
'logGold', 'logAccount','SecKill','BuyPoint',
'soft', 'black', 
'ensure',//商保
'eids',//获取快递号
'getEids','express',
'complain', 'taskLog', 'club', 'from', 'spread', 'checkAccount','safesz'
);
($operation && in_array($operation, $ops)) || $operation = $ops[0];
if (!$memberLogined && !in_array($operation, array('login', 'reg', 'forgotpwd', 'logout', 'info', 'checkAccount')) ) {
	common::goto_url('/member/login/?referer='.$baseUrl2);
} elseif ($memberLogined && in_array($operation, array('login', 'reg'))) {
	common::goto_url('/member/');
}
$pageStyle = '
				{page>minpage}
				<a href="{url minpage}" class="page">首 页</a>
				<a href="{url page-1}" class="page"><</a>
				{/page}
				{pages}
				{select}<strong>{page}</strong>{else}<a href="{url}">{page}</a>{/select}
				{/pages}
				{page<maxpage}
				<a href="{url page+1}" class="next">></a>
				<a href="{url maxpage}" class="next">尾 页</a>
				{/page}
				';
if ($operation == 'index') {
	$bbsNav = array(
		array('name' => $web_name, 'url' => $weburl2),
		array('name' => '我的联盟中心')
	);
} else {
	$bbsNav = array(
		array('name' => $web_name, 'url' => $weburl2),
		array('name' => '我的联盟中心', 'url' => common::getUrl('/member/'))
	);
}

$errorMessag='对不起，您的存款不足！ 请<a href="/member/topup/"> 立即充值</a>';
switch($operation){
	case 'reg':
	    $pusername = $_GET['pusername'];
		if ($rs = form::is_form_hash2()) {
			$_POST = common::filterHtml($_POST);
			$datas = form::get('username', 'password', 'password_','password2', 'truename','qq', 'mobilephone', 'email', 'sex', 'parent');
			if($datas['parent']<=0){
			$datas['parent']=$pusername;
			}else{
			$datas['parent']=$datas['parent'];
			}
			if ($rs === true) {
					if ($datas['password'] == $datas['password_']) {
							unset($datas['password_']);
							$rs = member_base::add($datas);
							
							if ($rs >0) {
								//add ok
								common::setcookie('loginUid', $rs);
								common::goto_url('/member/');
							} else {
								//error
								$indexMessage = language::get($rs, 'reg', 'member');
							}

					} else {
						$indexMessage = '两次密码输入不一致';
					}
				
			} else {
				$indexMessage = '表单超时，请重新提交';
			}
		}
		$cssList = array(css::getUrl('reg', 'member'));
	break;
	case 'index':
		loadLib('bbs.thread');
		$isFrom = db::exists('from', "uid='$uid'");
		if (!$cookie['firstOpen']){
			$firstOpen = true;
			common::setcookie('firstOpen', true);
		} else $firstOpen = false;
		$cssList = array(
			css::getUrl('center', 'member')
		);
		if($memberFields[credits]==0){
		$credits='新手会员';
		}elseif($memberFields[credits] < 100){
		$credits='金牌会员';
		}elseif($memberFields[credits] < 1000){
		$credits='白金会员';
		}elseif($memberFields[credits] < 5000){
		$credits='黄金会员';
		}elseif($memberFields[credits] < 10000){
		$credits='钻石会员';
		}elseif($memberFields[credits] < 100000){
		$credits='皇冠会员';
		}
		if($memberFields[vip]==1){
		 $vip='一级VIP';
		}elseif($memberFields[vip]==2){
		 $vip='钻石VIP';
		}elseif($memberFields[vip]==3){
		 $vip='皇冠VIP';
		}
	    $list = array();
		$query = $db->query("select title,id from {$pre}threads  where fid=1 ORDER BY timestamp desc limit 0,3");
		while ($line = $db->fetch_array($query)) {
			$list[] = $line;
		}
		 $task_list = array();
		$query = $db->query("select id,point,stimestamp from {$pre}task  where suid='$uid' ORDER BY stimestamp desc limit 0,8");
		while ($line = $db->fetch_array($query)) {
			$task_list[] = $line;
		}
		$stype=$_GET['cation'];
		if($stype=='open'){
		db::update('memberFields', array('state' =>1), "uid='$uid'");
		$stype='close';
		}else{
		db::update('memberFields', array('state' =>0), "uid='$uid'");
		$stype='open';
		}
		
	break;
	case 'login':
		//$ipint = common::ipint('218.6.161.10');
		if ($rs = form::is_form_hash2()) {
			extract($_POST);
			if ($rs === true) {
				
				$rs = member_base::login($username, $password, $questionid, $answer, $login_cookietime);
				
			} else {
				$rs = 'login_expire';
			}
			if ($rs === true) {
				common::goto_url($referer, true);
			} else {
				if ($rs == 'accountException') common::goto_url('/member/checkAccount/?username='.urlencode($username), false, '帐号异常，请验证！');
				$indexMessage = language::get($rs, 'login', 'member');
			}
		}
		cache::get_array('questions');
		$cssList = array(
			css::getUrl('login', 'member')
		);
	break;
	case 'logout':
		member_base::logout();
		common::goto_url($referer, true);
	break;
	case 'vipinfo':
		
	break;
	case 'buytao':
		checkPwd2();
		if ($isVip) $maxTieCount = -1;
		elseif ($isVip2) $maxTieCount = 20;
		else $maxTieCount = 7;
		$status = (int)$status;
		if ($pause = (int)$pause) {
			task_buyer::pause($pause, $uid);
			common::setMsg('暂停成功');
			common::goto_url($thisUrl.'&status=6');
		} elseif ($resume = (int)$resume) {
			task_buyer::resume($resume, $uid);
			common::setMsg('恢复成功');
			common::goto_url($thisUrl.'&status=1');
		} elseif ($resumeMore) {
			task_buyer::resumeMore($resumeMore, $uid);
			common::setMsg('恢复成功');
			common::goto_url($thisUrl.'&status=1');
		} elseif ($del = (int)$del) {
			task_buyer::del($del, $uid);
			common::setMsg('删除成功');
			common::goto_url($thisUrl.'&status=1');
		} elseif ($setCollect) {
			task_buyer::setCollect($setCollect, $uid);
			common::setMsg('设置收藏买号成功');
			common::goto_url('/task/collect/?m=buyer');
		}
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				if ($maxTieCount > 0 && $memberFields['buyers1'] + 1 > $maxTieCount) $rs = '对不起，您不可以绑定更多的买号了';
				else {
					$nickname = $_POST['nickname'];
					$rs = task_buyer::tie($uid, 1, $nickname);
				}
			}
			if ($rs === true) {
				common::setMsg('添加成功');
				common::refresh();
			} else {
				$indexMessage = language::get($rs);
			}
		}
		$status2 = $status - 1;
		//if ($status2 < 0 || $status2 > 6) $status2 = 0;
		if ($status2 > 6) $status2 = -1;
		//if ($total = $memberFields['buyers1']) {
		if ($total = task_buyer::total($taskId, $status2)) {
			$bList = task_buyer::getList(1, $uid, $status2);
			$multipage = multi_page::parse($total, $pagesize, $page, $thisUrl.'&status='.$status.'&page={page}', $pageStyle, 10, 'member1');
		}
	break;
	case 'buypai':
		checkPwd2();
		if ($isVip) $maxTieCount = -1;
		elseif ($isVip2) $maxTieCount = 20;
		else $maxTieCount = 7;
		$status = (int)$status;
		if ($pause = (int)$pause) {
			task_buyer::pause($pause, $uid);
			common::setMsg('暂停成功');
			common::goto_url($thisUrl.'&status=6');
		} elseif ($resume = (int)$resume) {
			task_buyer::resume($resume, $uid);
			common::setMsg('恢复成功');
			common::goto_url($thisUrl.'&status=1');
		} elseif ($resumeMore) {
			task_buyer::resumeMore($resumeMore, $uid);
			common::setMsg('恢复成功');
			common::goto_url($thisUrl.'&status=1');
		} elseif ($del = (int)$del) {
			task_buyer::del($del, $uid);
			common::setMsg('删除成功');
			common::goto_url($thisUrl.'&status=1');
		}
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				if ($maxTieCount > 0 && $memberFields['buyers'.$taskId] + 1 > $maxTieCount) $rs = '对不起，您不可以绑定更多的买号了';
				else {
					$nickname = $_POST['nickname'];
					if (is_numeric($nickname)) {
						$rs = task_buyer::tie($uid, $taskId, $nickname);
					} else $rs = '拍拍帐号只能为数字';
				}
			}
			if ($rs === true) {
				common::setMsg('添加成功');
				common::refresh();
			} else {
				$indexMessage = language::get($rs);
			}
		}
		if ($total = $memberFields['buyers'.$taskId]) {
			$status2 = $status - 1;
			//if ($status2 < 0 || $status2 > 6) $status2 = 0;
			if ($status2 > 6) $status2 = -1;
			$bList = task_buyer::getList($taskId, $uid, $status2);
			$multipage = multi_page::parse($total, $pagesize, $page, $thisUrl, $pageStyle.'&status='.$status.'&page={page}', 10, 'member1');
		}
	break;
	case 'express':
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				//处理缴费
				if ($isVip) {
					$time = $timestamp - $sys_time_space_getEid;
					if (db::exists('eids', "uid='$uid' and useTime>'$time'")) {
						$timeInfo = time::daytime($sys_time_space_getEid);
						$rs = '对不起'.($timeInfo['day'] ? $timeInfo['day'].'天' : '').($timeInfo['hour'] ? $timeInfo['hour'].'时' : '').($timeInfo['minute'] ? $timeInfo['minute'].'分' : '').($timeInfo['second'] ? $timeInfo['second'].'秒' : '').'之内只能获取一个免费快递号';
					} else {
						if ($id = db::one_one('eids', 'id', "status='0'", 'addTime')) {
							db::update('eids', array('uid' => $uid, 'username' => $member['username'], 'useTime' => $timestamp, 'status' => 1), "id='$id'");
							$rs = true;
						} else $rs = '很抱歉，系统缺货，暂时没有单号提供！';
					}
				} else $rs = '对不起，您不是会员，只有会员才能免费获取！';
			}
			if ($rs === true) {
				common::setMsg('恭喜您，免费获取成功');
				common::goto_url($baseUrl0);
			} else {
				$indexMessage = language::get($rs);
			}
		}
		if ($total = db::data_count('eids', "uid='$uid'")) {
			$list = db::get_list('eids', '*', "uid='$uid'", 'useTime desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $baseUrl.'?page={page}', $pageStyle);
		}					
	break;
	case 'BuyPoint':
	    $memberInfo = member_base::getMember($uid);
		if ($rs = form::is_form_hash2()){
			if ($rs === true) {
						$datas = form::get('nums','jiage','Type','cardType','viptype');
						$datas && extract($datas);
				if($Type == 1){	
					$money=$nums * $jiage;
				    if($money <= $memberFields['money']){
                        member_base::addFabudian($uid, $nums,'购买麦点');
						member_base::addMoney($uid, -$money,'购买麦点');
				    }else{
					    error::bbsMsg($errorMessag);
					}
			         if ($rs === true) {
						common::setMsg('购买成功！');
						common::refresh();
					} else {
						$indexMessage = language::get($rs);
					}	
				}   
				 if($Type == 2)	{
				    $money=$jiage;
				    if($money <= $memberFields['money']){
			        	if($viptype==1){
				            $rs = member_base::addVip1($uid, 1); 
				        }else{
				            $indexMessage = language::get($rs);
				        }
				        if($viptype==2){
				            $rs = member_base::addVip2($uid, 1); 
				        }else{
				            $indexMessage = language::get($rs);
				        }
				        if($viptype==3){
				            $rs = member_base::addVip3($uid, 1); 
				        }else{
				            $indexMessage = language::get($rs);
				        }			
						
				    }else{
					    error::bbsMsg($errorMessag);
					}
			         if ($rs === true) {
						common::setMsg('购买成功！');
						common::refresh();
					} else {
						$indexMessage = language::get($rs);
					}
				
				} 
                 if($Type == 3)	{
				    $money=$jiage;
				    if($money <= $memberFields['money']){
                        member_base::addFabudian($uid, $nums,'购买麦点');
						member_base::addMoney($uid, -$money,'购买麦点');
				    }else{
					    error::bbsMsg($errorMessag);
					}
			         if ($rs === true) {
						common::setMsg('购买成功！');
						common::refresh();
					} else {
						$indexMessage = language::get($rs);
					}
				} 
                 if($Type == 4)	{
				    $money=$jiage;
				    if($money <= $memberFields['money']){
                        member_base::addFabudian($uid, $nums,'购买麦点');
						member_base::addMoney($uid, -$money,'购买麦点');
				    }else{
					    error::bbsMsg($errorMessag);
					}
			         if ($rs === true) {
						common::setMsg('购买成功！');
						common::refresh();
					} else {
						$indexMessage = language::get($rs);
					}
				} 
                if($Type == 5)	{
				    $money=$jiage;
				    if($money <= $memberFields['money']){
                        member_base::addFabudian($uid, $nums,'购买麦点');
						member_base::addMoney($uid, -$money,'购买麦点');
				    }else{
					    error::bbsMsg($errorMessag);
					}
			         if ($rs === true) {
						common::setMsg('购买成功！');
						common::refresh();
					} else {
						$indexMessage = language::get($rs);
					}
				} 
                if($Type == 6)	{
				    $money=$jiage;
				    if($money <= $memberFields['money']){
                        member_base::addFabudian($uid, $nums,'购买麦点');
						member_base::addMoney($uid, -$money,'购买麦点');
				    }else{
					    error::bbsMsg($errorMessag);
					}
			         if ($rs === true) {
						common::setMsg('购买成功！');
						common::refresh();
					} else {
						$indexMessage = language::get($rs);
					}
				} 	
                if($Type == 7){
				    $money=$jiage;
				    if($money <= $memberFields['money']){
                        member_base::addFabudian($uid, $nums,'购买麦点');
						member_base::addMoney($uid, -$money,'购买麦点');
				    }else{
					    error::bbsMsg($errorMessag);
					}
			         if ($rs === true) {
						common::setMsg('购买成功！');
						common::refresh();
					} else {
						$indexMessage = language::get($rs);
					}
				} 
				 if($Type == 8){
				    $money=$jiage;
				    if($money <= $memberFields['money']){
                        member_base::addFabudian($uid, $nums,'购买麦点');
						member_base::addMoney($uid, -$money,'购买麦点');
				    }else{
					    error::bbsMsg($errorMessag);
					}
			         if ($rs === true) {
						common::setMsg('购买成功！');
						common::refresh();
					} else {
						$indexMessage = language::get($rs);
					}
				} 
                if($Type == 9)	{
				    $money=$jiage;
				    if($money <= $memberFields['money']){
                        //24小时双倍积分卡
						if(member_base::addMoney($uid, -$money,'购买24小时双倍积分卡')){
				            	db::insert('card', array(
								    'type'       => 2,
									'uid'         => $uid,
									'username'    => $memberInfo['username'],
									'money'    => $money,
									'name'  =>'24小时双倍积分卡',
									'cid'    => $cardType,
									'status'    => 1,
									'timestamp1'   => $timestamp,
									'timestamp2'   => $timestamp,
									'timestamp3' => $timestamp + 86400,
									'total1'     => 1,
						            'total2'     => 1
									));
						    if ($id = db::one_one('card', 'id', "uid='$uid' and cid='9'", 'timestamp1')){
					            db::update('memberfields', array('double_credit' => $id), "uid='$uid'");
					            echo "<script>alert('成功购买24小时双倍积分卡，即时生效！');window.location.href='';</script>";
						    } 
					    }
				    }else{
					    error::bbsMsg($errorMessag);
					}
				} 
                  if($Type == 10){
				    $money=$jiage;
				    if($money <= $memberFields['money']){
				     //一周双倍积分卡
						if(member_base::addMoney($uid, -$money,'购买一张一周双倍积分卡')){
				            	db::insert('card', array(
								    'type'       => 2,
									'uid'         => $uid,
									'username'    => $memberInfo['username'],
									'money'    => $money,
									'name'  =>'一周双倍积分卡',
									'cid'    => $cardType,
									'status'    => 1,
									'timestamp1'   => $timestamp,
									'timestamp2'   => $timestamp,
									'timestamp3' => $timestamp + 86400 * 7,
									'total1' => 1,
									'total2' => 0
									));
						    if ($id = db::one_one('card', 'id', "uid='$uid' and cid='10'", 'timestamp1')){
					            db::update('memberfields', array('double_credit' => $id), "uid='$uid'");
					            echo "<script>alert('成功购买一周双倍积分卡，即时生效！');window.location.href='';</script>";
						    } 
					    }
					}else{
					    error::bbsMsg($errorMessag);
					}
				} 
                  if($Type == 11){
				    $money=$jiage;
				    if($money <= $memberFields['money']){
				     //任务预订卡
						if(member_base::addMoney($uid, -$money,'一天任务预订卡')){
				            	db::insert('card', array(
								    'type'       => 3,
									'uid'         => $uid,
									'username'    => $memberInfo['username'],
									'money'    => $money,
									'name'  =>'一张任务预订卡',
									'cid'    => $cardType,
									'status'    => 1,
									'timestamp1'   => $timestamp,
									'timestamp2'   => $timestamp,
									'timestamp3' => $timestamp + 86400,
									'total1' => 10,
									'total2' => 10
									));
						    if ($id = db::one_one('card', 'id', "uid='$uid' and cid='11'", 'timestamp1')){
					           // db::update('memberfields', array('double_credit' => $id), "uid='$uid'");
					            echo "<script>alert('成功购买一天任务预订卡！');window.location.href='';</script>";
						    } 
					    }
					}else{
					    error::bbsMsg($errorMessag);
					}
				} 
                 if($Type == 12){
				    $money=$jiage;
				    if($money <= $memberFields['money']){
				     //任务预订卡
						if(member_base::addMoney($uid, -$money,'一天任务预订卡')){
				            	db::insert('card', array(
								    'type'       => 3,
									'uid'         => $uid,
									'username'    => $memberInfo['username'],
									'money'    => $money,
									'name'  =>'一张任务预订卡',
									'cid'    => $cardType,
									'status'    => 1,
									'timestamp1'   => $timestamp,
									'timestamp2'   => $timestamp,
									'timestamp3' => $timestamp + 86400,
									'total1' => 10,
									'total2' => 10
									));
						    if ($id = db::one_one('card', 'id', "uid='$uid' and cid='11'", 'timestamp1')){
					           // db::update('memberfields', array('double_credit' => $id), "uid='$uid'");
					            echo "<script>alert('成功购买一天任务预订卡！');window.location.href='';</script>";
						    } 
					    }
					}else{
					    error::bbsMsg($errorMessag);
					}
				}
                if($Type == 13){
				    $money=$jiage;
				    if($money <= $memberFields['money']){
				     //任务预订卡
						if(member_base::addMoney($uid, -$money,'投诉清理卡')){
				            	db::insert('card', array(
								    'type'       => 3,
									'uid'         => $uid,
									'username'    => $memberInfo['username'],
									'money'    => $money,
									'name'  =>'投诉清理卡',
									'cid'    => $cardType,
									'status'    => 1,
									'timestamp1'   => $timestamp,
									'timestamp2'   => $timestamp,
									'timestamp3' => $timestamp + 86400,
									'total1' => 1,
									'total2' => 1
									));
						    if ($id = db::one_one('card', 'id', "uid='$uid' and cid='12'", 'timestamp1')){
					           // db::update('memberfields', array('double_credit' => $id), "uid='$uid'");
					            echo "<script>alert('成功购买一天任务预订卡！');window.location.href='';</script>";
						    } 
					    }
					}else{
					    error::bbsMsg($errorMessag);
					}
				}  				
			}else {
				     error::bbsMsg('参数错误！');
		    } 					
		}
	break;
	case 'SecKill':
	    $seckill = db::one_one('kill', 'name', "id='1'");
		if ($rs = form::is_form_hash2()){ 
		    if ($rs === true) {
			    $datas = form::get('nums','jiage');
		        $datas && extract($datas);
		        $nums=$datas['nums'];
		        $price=$datas['jiage'];
				if($nums<=$seckill && $seckill > 0){
				    $money=$nums * $price;
					if($money<=$memberFields['money']){
					    if(db::update('kill', 'name=name'.-$nums, "id=1")){
						member_base::addFabudian($uid, $nums,'麦点秒杀');
						member_base::addMoney($uid, -$money,'麦点秒杀');
				        member_base::sendSms($uid, '您于'.date('Y-m-d H:i:s', $timestamp).'使用'.$money.'秒杀了'.$nums.'个麦点', 'score_points');
				        common::setMsg('恭喜您，秒杀陈功！');
						}else{
						error::bbsMsg('秒杀失败！！');
						}  
					}else{
					error::bbsMsg('余额不足！');
					}
				}else{
				error::bbsMsg('对不起，麦点不足！');
					}
			}else {
			error::bbsMsg('参数错误！');
			}	
		}
	break;
	case 'pwd2':
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				$rs = member_base::checkPwd2($member['id'], $_POST['password2']);
			}
			if ($rs === true) {
				common::goto_url($referer, true);
			} else {
				$indexMessage = language::get($rs);
				if ($rs == 'password2_expire') {
					$indexMessage = str_replace('{x}', $sys_pwd2_err_count, $indexMessage);
				}
				if ($rs == 'password2_error') {
					if (isset($sys_pwd2_err_count)) {
						$count = db::one_one('memberlog', 'pwd2_err_count', "uid='$uid' and pwd2_err_timestamp='$today_start'");
						$c     = $sys_pwd2_err_count - $count;
						if ($c > 0) {
							$errMsg = '您今天还可以输错 ['.($c).'] 次操作码';
						} else {
							$errMsg = '您今天输错操作码的次数超过了'.$sys_pwd2_err_count.'次';
						}
					}
				}
			}
		}
	break;
	case 'info':
		$cssList = array(
			css::getUrl('info', 'member'),
			css::getUrl('member', 'member')
		);
		$memberInfo = member_base::getMemberAll($username, true);
		$type || $type ='post';
		$bbsNav = array(
			array('name' => $web_name, 'url' => $weburl.'/'),
			array('name' => '个人资料 - <strong class="f_orange">'.$memberInfo['base']['username'].'</strong>')
		);
		$memberInfo['level'] = member_credit::getLevel($memberInfo['attach']['credits']);
		switch ($type) {
			case 'post':
				if ($total = db::data_count('credits', "tuid='{$memberInfo[base][id]}' and isBuyer='0'")) {
					$cList = db::get_list2('credits', '*', "tuid='{$memberInfo[base][id]}' and isBuyer='0'", 'timestamp desc', $page, $pagesize);
					$multipage = multi_page::parse($total, $pagesize, $page, common::getUrl('/'.$action.'/'.$operation.'/?page={page}'), $pageStyle);
				}
			break;
			case 'get':
				if ($total = db::data_count('credits', "tuid='{$memberInfo[base][id]}' and isBuyer='1'")) {
					$cList = db::get_list2('credits', '*', "tuid='{$memberInfo[base][id]}' and isBuyer='1'", 'timestamp desc', $page, $pagesize);
					$multipage = multi_page::parse($total, $pagesize, $page, common::getUrl('/'.$action.'/'.$operation.'/?page={page}'), $pageStyle);
				}
			break;
			case 'appeal':
			break;
		}
	break;
	case 'active':
		$cssList = array(
			css::getUrl('member', 'member')
		);
		if ($member['status']) {
			$type = 'complate';
			$msg = '您的帐户已经激活';
		}else{
		    $mobile=$_POST['mobilephone'];
			$vcode=$_POST['vcode']; 
			if($mobile!='' && $vcode!=''){
			    $m = db::one_one('vcode_log', '*', "mobilephone='$mobile' and vcode='$vcode' and status='0' and uid='$uid'",'timestamp');
				if($m){
				    $mid=$m['id'];
				    if(db::update('members', array('mobilephone' => $mobile,'status' => 1), "id='$uid'")){
					    $row=db::update('vcode_log',array('status' => 1), "id='$mid'");
				        echo "<script>alert('手机激活成功！');window.location.href='';</script>";
					}
				}else{
				    echo "<script>alert('激活错误,请重新激活！');window.location.href='';</script>";
				}
			
			}
		}
		
	break;	
	case 'Authentication':
		$Authentication = $_POST['Authentication'];
		switch ($Authentication) {
		case 'open':
             checkPwd2();
		break;
        case 'close':
             checkPwd2();
		break;			
		}		
	break;
	case 'kefu':
		$kefu = false;
		if ($id) {
			$kefu = kefu::getKefu($id);
		}
		if ($kefu) {
			$kid = $kefu['id'];
			$alreadyReview = kefu::alreadyReview($kid, $uid);
			if ($rs = form::is_form_hash2()) {
				if ($rs === true) {
					extract($_POST);
					$rs = kefu::review($kid, $uid, $grade, $remark, $isHide);
				} else {
					$rs = 'form_expire';
				}
				if ($rs === true) {
					common::setMsg('谢谢您的评价');
					common::goto_url('/'.$action.'/kefu.php?id='.$kid);
				} else {
					$indexMessage = language::get($rs, $operation, $action);
				}
			}
			if ($total = kefu::getReviewTotal($id)) {
				$list = kefu::getReview($id);
				$multipage = multi_page::parse($total, $pagesize, $page, '/'.$action.'/'.$operation.'.php?id='.$id.'&page={page}', $pageStyle, 10, 'member1');
			}
		} else {
			common::showmessage('不存在该客服');
		}
	break;
	case 'sms':
		checkPwd2();
		if ($rs = form::is_form_hash2()) {
			$_POST = common::filterHtml($_POST);
			extract($_POST);
			if ($rs === true) {
				$rs = sms::sendUser($username, $message);
			}
			if (is_numeric($rs) && $rs >= 0) {
				common::setMsg('发送完成，您一共发送了 '.$rs.' 条短信');
				common::refresh();
			} else {
				$indexMessage = language::get($rs);
			}
		}
		if ($act) {
			switch ($act) {
				case 'del':
					sms::del($ids);
				break;
			}
			common::goto_url('/'.$action.'/'.$operation.'/');
		}
		if ($total = sms::getTotal()) {
			$list = sms::getList();
			$multipage = multi_page::parse($total, $pagesize, $page, $baseUrl.'?page={page}', $pageStyle);
		}
		$bbsNav[] = array('name' => '手机短信');
	break;
	case 'message':
		//站内信
		$type || $type = 'inUser';
		$userMsgCount0 = msg::getCount0(0);
		$sysMsgCount0  = msg::getCount0(1);
		$outMsgCount0  = msg::getCount0(2, 'from');
		
		$userMsgCount = msg::getCount(0);
		$sysMsgCount  = msg::getCount(1);
		$outMsgCount  = msg::getCount(2, 'from');
		switch ($type) {
			case 'inUser':
				if ($act) {
					switch ($act) {
						case 'isRead':
							msg::setRead($ids, 0, true);
						break;
						case 'notRead':
							msg::setRead($ids, 0, false);
						break;
						case 'readAll':
							msg::setReadAll(0, true);
						break;
						case 'allNotRead':
							msg::setReadAll(0, false);
						break;
						case 'del':
							msg::delIds($ids);
						break;
						case 'delAll':
							msg::delAll();
						break;
					}
					common::goto_url('/'.$action.'/'.$operation.'/?type='.$type.'&page='.$page);
				}
				if ($userMsgCount0 > 0) {
					$list = msg::getList(0);
					$multipage = multi_page::parse($userMsgCount0, $pagesize, $page, $baseUrl.'?type='.$type.'&page={page}', $pageStyle);
				}
			break;
			case 'inSys':
				if ($act) {
					switch ($act) {
						case 'isRead':
							msg::setRead($ids, 1, true);
						break;
						case 'notRead':
							msg::setRead($ids, 1, false);
						break;
						case 'readAll':
							msg::setReadAll(1, true);
						break;
						case 'allNotRead':
							msg::setReadAll(1, false);
						break;
						case 'del':
							msg::delIds($ids);
						break;
						case 'delAll':
							msg::delAll(1);
						break;
					}
					common::goto_url('/'.$action.'/'.$operation.'/?type='.$type.'&page='.$page);
				}
				if ($sysMsgCount0 > 0) {
					$list = msg::getList(1);
					$multipage = multi_page::parse($userMsgCount0, $pagesize, $page, $baseUrl.'?type='.$type.'&page={page}', $pageStyle);
				}
			break;
			case 'out':
				if ($act) {
					switch ($act) {
						case 'del':
							msg::delIds($ids, 'from');
						break;
						case 'delAll':
							msg::delAll(2, 'from');
						break;
					}
					common::goto_url('/'.$action.'/'.$operation.'/?type='.$type.'&page='.$page);
				}
				if ($outMsgCount0 > 0) {
					$list = msg::getList(2, 'from');
					$multipage = multi_page::parse($outMsgCount0, $pagesize, $page, $baseUrl.'?type='.$type.'&page={page}', $pageStyle);
				}
			break;
		}
		$bbsNav[] = array('name' => '站内短信');
	break;
	case 'userdata':
		$bbsNav = array(
			array('name' => $web_name, 'url' => $weburl.'/'),
			array('name' => '我的联盟中心' , 'url' => common::getUrl('/member/')),
			array('name' => '维护个人资料')
		);
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				switch ($type) {
					case 'pass':
					    $datas = form::get('pwd2', 'password', 'password_');
			            $datas && extract($datas);
							if ($memberInfo = member_base::getMember($uid)) {
								$password2 = $memberInfo['password2'];
							    $salt = db::one_one(members, 'salt', "id='$uid'");
								if($password2==common::salt_pwd($salt,$datas['pwd2'])){
								   if($datas['password']==$datas['password_']){
								        if (db::update('members', array('password' => common::salt_pwd($salt,$datas['password']) ) , "id='$uid'")){
												db::insert('pwd_log', array(
													'uid'         => $uid,
													'username'    => $memberInfo['username'],
													'password'    => $pwd,
													'timestamp'   => $timestamp
												));
											common::setMsg('修改成功！');
							                common::refresh();
										}else{
                                        common::setMsg('操作失败！');
							            common::refresh();
										}
								   
								   }else{
								   common::setMsg('两次新密码不一致！');
							       common::refresh();
								   }
								}else{
								common::setMsg('安全码错误！');
							    common::refresh();
								}	
							} else {
								common::setMsg('该用户不存在');
							    common::refresh();
							}
					break;
					case 'safepass':
					    $datas = form::get('pwd2', 'password2', 'password2_');
			            $datas && extract($datas);
							if ($memberInfo = member_base::getMember($uid)) {
								$password2 = $memberInfo['password2'];
							    $salt = db::one_one(members, 'salt', "id='$uid'");
								if($password2==common::salt_pwd($salt,$datas['pwd2'])){
								   if($datas['password2']==$datas['password2_']){
								        if (db::update('members', array('password2' => common::salt_pwd($salt,$datas['password2']) ) , "id='$uid'")){
												db::insert('pwd_log', array(
													'uid'         => $uid,
													'username'    => $memberInfo['username'],
													'timestamp'   => $timestamp
												));
  											 common::setMsg('安全码修改成功！');
								             common::refresh();
										}else{
										common::setMsg('操作失败！');
								        common::refresh();
										}
								   
								   }else{
								   common::setMsg('两次新安全码不一致！');
								   common::refresh();
								   }
								}else{
								common::setMsg('安全码错误！');
								common::refresh();
								}	
							} else {
								common::setMsg('该用户不存在！');
								common::refresh();
							}
					break;
					case 'GetPass':
					    $datas = form::get('email');
							if ($memberInfo = member_base::getMember($uid)) {
								$email = $memberInfo['email'];
							    $salt = db::one_one(members, 'salt', "id='$uid'");
								if($email==$datas['email']){
								  $pwd = string::getRandStr(8, 1);
									if (db::update('members', array('password2' => common::salt_pwd($salt, $pwd) ) , "id='$uid'")) {
									db::insert('pwd_log', array(
									'uid'         => $uid,
									'username'    => $memberInfo['username'],
									'password'    => $pwd,
									'timestamp'   => $timestamp
									));
									$smtp = new email($mail_server, $mail_port, true, $mail_username, $mail_password);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
									//$smtp->debug = TRUE;//是否显示发送的调试信息
									$smtp->sendmail($memberInfo['email'], $mail_from, $web_name.'安全码找回', '您好，您的帐号：'.$memberInfo['username'].'的新安全码为：'.$pwd.'，请登陆'.$web_name.'更改', 'HTML');
									common::setMsg('设置新安全码设置成功,请登录邮箱查看！');
								    common::refresh();
									} else {
									common::setMsg('设置新安全码失败，请重试！');
								    common::refresh();
									}
							
								}else{
								common::setMsg('邮箱错误！');
								common::refresh();
								}	
							} else {
							    common::setMsg('该用户不存在');
								common::refresh();
								//$rs = '该用户不存在';
							}
					break;
					case 'ProtectPass':
					    cache::get_array('questions');
					    $datas = form::get('questionId','answer','pwd2');
			            $datas && extract($datas);
							if ($memberInfo = member_base::getMember($uid)) {
								$password2 = $memberInfo['password2'];
							    $salt = db::one_one(members, 'salt', "id='$uid'");
								if($password2==common::salt_pwd($salt,$datas['pwd2'])){
									if (db::update('members', array('questionId' => $datas['questionId']),array('answer' => $datas['answer']), "id='$uid'")) {
									common::setMsg('安全问题设置成功！');
				                    common::refresh();
									} else {
									common::setMsg('设置新安全码失败，请重试！');
				                    common::refresh();
									}
							
								}else{
                                common::setMsg('安全码错误！');
				                common::refresh();
								}	
							} else {
								common::setMsg('该用户不存在');
				                common::refresh();
							}
					    break;
					case 'index':
				    if ($rs = form::is_form_hash2()) {
			          if ($rs === true) {
				        extract(common::filterHtml($_POST));
						if ($memberInfo = member_base::getMember($uid)){ 
								$password2 = $memberInfo['password2'];
							    $salt = db::one_one(members, 'salt', "id='$uid'");
								if($password2==common::salt_pwd($salt,$_POST['password2'])){
								if ($rs === true) {
					            $rs = member_base::editBase($_POST, 'userPic');
				                 }
								}else{
								$rs = '安全码错误！';
								}
						}
			          }
			            if ($rs === true) {
				        common::setMsg('修改成功');
				        common::refresh();
			            } else {
				        $indexMessage = language::get($rs);
			            }
		            }
		                $count = db::one_one('memberlog', 'pwd2_err_count', "uid='$uid' and pwd2_err_timestamp='$today_start'");
		               $c = $sys_pwd2_err_count - $count;
		              if ($c > 0) {
			          $errMsg = '您今天还可以输错 ['.$c.'] 次操作码';
		              } else {
			          $errMsg = '您今天输错操作码的次数超过了'.$sys_pwd2_err_count.'次';
		              }
					break;
				}
			}
		}
	break;
	case 'setpwd':
		$bbsNav = array(
			array('name' => $web_name, 'url' => $weburl.'/'),
			array('name' => '我的联盟中心' , 'url' => common::getUrl('/member/')),
			array('name' => '维护个人资料')
		);
		cache::get_array('questions');
		if ($rs = form::is_form_hash2()) {
			$indexMessage = '';
			if ($rs === true) {
				//extract(common::filterHtml($_POST));
				//$rs = member_base::checkPwd2($member['id'], $_POST['pwd2']);
				if ($rs === true) {
					//$rs = member_base::editBase($_POST, 'userPic');
					$rs = member_base::editPwd();
				}/* else {
					//密码错误次数
					$errMsg = member_base::getPwd2ErrMsg();
					$indexMessage = '操作码错误';
					//
				}*/
			}
			if ($rs === true) {
				common::setMsg('修改成功');
				common::refresh();
			} else {
				$errMsg = member_base::getPwd2ErrMsg();
				$indexMessage || $indexMessage = language::get($rs);
			}
		}
	break;
	case 'forgotpwd':
		if ($rs = form::is_form_hash2()) {
			$datas = form::get('type', 'username', 'email', 'mobile');
			$datas && extract($datas);
			if ($rs === true) {
				switch ($type) {
					case 'mobilephone':
						if (form::check_mobilephone($mobile)) {
							if ($memberInfo = member_base::getMemberAll($username, true)) {
								$_uid = $memberInfo['base']['id'];
								if ($memberInfo['base']['mobilephone'] == $mobile) {
									$t1 = $timestamp;
									$t2 = $t1 - 5 * 60;//5分钟之内只能发一次
									if (db::exists('pwd_log', "uid='$_uid' and timestamp>=$t2 and timestamp<=$t1")) {
										$rs = '对不起，5分钟之内只能找回一次';
									} else {
										if (db::data_count('pwd_log', "uid='$_uid' and timestamp>=$today_start and timestamp<=$today_end") >= 3) {
											$rs = '很抱歉，同一用户一天最多只能找回3次密码';
										} else {
											$pwd = string::getRandStr(8, 1);
											if (db::update('members', array('password' => common::salt_pwd($memberInfo['base']['salt'], $pwd) ) , "id='$_uid'")) {
												db::insert('pwd_log', array(
													'uid'         => $_uid,
													'username'    => $memberInfo['base']['username'],
													'password'    => $pwd,
													'email'       => $email,
													'timestamp'   => $timestamp
												));
												message::send($mobile, '新的的密码为：'.$pwd.'，请登陆'.$web_name.'更改');
												$rs = true;
											} else {
												$rs = '设置新密码失败，请重试！';
											}
										}
									}
								} else {
									$rs = '系统检测到您的手机号码与帐号所绑定的手机号码不一致';
								} 
							} else {
								$rs = '该用户不存在';
							}
						} else {
							$rs = '手机格式错误';
						}
					break;
					case 'email':
						if (form::check_email($email)) {
							if ($memberInfo = member_base::getMemberAll($username, true)) {
								$_uid = $memberInfo['base']['id'];
								if ($memberInfo['base']['email'] == $email) {
									$t1 = $timestamp;
									$t2 = $t1 - 5 * 60;//5分钟之内只能发一次
									if (db::exists('pwd_log', "uid='$_uid' and timestamp>=$t2 and timestamp<=$t1")) {
										$rs = '对不起，5分钟之内只能找回一次';
									} else {
										if (db::data_count('pwd_log', "uid='$_uid' and timestamp>=$today_start and timestamp<=$today_end") >= 3) {
											$rs = '很抱歉，同一用户一天最多只能找回3次密码';
										} else {
											$pwd = string::getRandStr(8, 1);
											if (db::update('members', array('password' => common::salt_pwd($memberInfo['base']['salt'], $pwd) ) , "id='$_uid'")) {
												db::insert('pwd_log', array(
													'uid'         => $_uid,
													'username'    => $memberInfo['base']['username'],
													'password'    => $pwd,
													'mobilephone' => $mobilephone,
													'timestamp'   => $timestamp
												));
												$smtp = new email($mail_server, $mail_port, true, $mail_username, $mail_password);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
												//$smtp->debug = TRUE;//是否显示发送的调试信息
												$smtp->sendmail($memberInfo['base']['email'], $mail_from, $web_name.'密码找回', '您好，您的帐号：'.$memberInfo['base']['username'].'的新的的密码为：'.$pwd.'，请登陆'.$web_name.'更改', 'HTML');
												$rs = true;
											} else {
												$rs = '设置新密码失败，请重试！';
											}
										}
									}
								} else {
									$rs = '系统检测到您的Email与帐号所绑定的Email不一致';
								} 
							} else {
								$rs = '该用户不存在';
							}
						} else {
							$rs = 'Email格式错误';
						}
					break;
				}
			}
			if ($rs === true) {
				switch ($type) {
					case 'mobilephone':
						common::setMsg('您的新密码已经发送到手机上，请注意查收');
						common::refresh();
					break;
					case 'email':
						common::setMsg('您的新密码已经发送到您的邮箱中，请注意查收');
						common::refresh();
					break;
				}
			} else {
				$indexMessage = language::get($rs);
			}
		}
	break;
	//帖子
	case 'thread':
		$bbsNav[] = array('name' => '我的帖子');
		$types = array('thread', 'post', 'collection');
		($type && in_array($type, $types)) || $type = $types[0];
		switch ($type) {
			case 'thread':
				if ($total = db::data_count('threads', "uid='$uid'")) {
					$threadList = db::get_list2('threads', 'id,title,timestamp', "uid='$uid'", 'timestamp desc', $page, $pagesize);
					$multipage = multi_page::parse($total, $pagesize, $page, $baseUrl.'?type='.$type.'&page={page}', $pageStyle, 10, 'bbs_threadlist');
				}
			break;
			case 'post':
				$postList = array();
				if ($total = db::data_count('posts', "uid='$uid'")) {
					$query = $db->query("select t1.tid,t2.title,t1.message,t1.timestamp from {$pre}posts t1,{$pre}threads t2 where t1.uid='$uid' and t1.tid=t2.id limit ".($page - 1) * $pagesize.','.$pagesize);
					while ($post = $db->fetch_array($query)) {
						$post['message'] = preg_replace('/\[.*?\]/s', '', $post['message']);
						$postList[] = $post;
					}
					$multipage = multi_page::parse($total, $pagesize, $page, $baseUrl.'?type='.$type.'&page={page}', $pageStyle, 10, 'bbs_threadlist');
				}
			break;
			case 'collection':
				if ($del = (int)$del) {
					$db->query("delete from {$pre}collection where id='$del' and uid='$uid'");
					common::goto_url('/'.$action.'/'.$operation.'/?type='.$type);
				}
				if ($total = db::data_count('collection', "uid='$uid'")) {
					$collectionList = db::get_list('collection', '*', "uid='$uid'", 'timestamp desc', $page, $pagesize);
					$multipage = multi_page::parse($total, $pagesize, $page, $baseUrl.'?type='.$type.'&page={page}', $pageStyle, 10, 'bbs_threadlist');
				}
			break;
		}
	break;
	//考试
	case 'exam':
		if (!$memberFields['exam']) {
		    if($memberFields[credits]==0){
		$credits='新手会员';
		}elseif($memberFields[credits] < 100){
		$credits='金牌会员';
		}elseif($memberFields[credits] < 1000){
		$credits='白金会员';
		}elseif($memberFields[credits] < 5000){
		$credits='黄金会员';
		}elseif($memberFields[credits] < 10000){
		$credits='钻石会员';
		}elseif($memberFields[credits] < 100000){
		$credits='皇冠会员';
		}
		if($memberFields[vip]==1){
		 $vip='一级VIP';
		}elseif($memberFields[vip]==2){
		 $vip='钻石VIP';
		}elseif($memberFields[vip]==3){
		 $vip='皇冠VIP';
		}
			$allCount   = db::data_count('e_question');
			$rightCount = db::data_count('e_answer', "uid='$uid' and status='1'");
			if ($rightCount > 0) {
				$rightIds = db::get_keys('e_answer', 'eid', "uid='$uid' and status='1'");
				$rIds = '\''.implode('\',\'', $rightIds).'\'';
			}
			$errCount = $allCount - $rightCount;
			if ($errCount == 0) {
				if ($errCount == 0) common::goto_url('/'.$action.'/'.$operation.'/');
				$questions = array();
				$query = $db->query("select * from {$pre}e_question".($rIds?" where id not in($rIds)":'')." order by sort,timestamp desc");
				while ($line = $db->fetch_array($query)) {
					$questions[$line['id']] = $line;
				}
				if ($questions) {
					$query = $db->query("select * from {$pre}e_select".($rIds?" where eid not in($rIds)":'')." order by sort");
					while ($line = $db->fetch_array($query)) {
						$questions[$line['eid']]['list'][$line['sort']]=$line['title'];
					}
				}
			} else {
				$questions = array();
				$query = $db->query("select * from {$pre}e_question".($rIds?" where id not in($rIds)":'')." order by sort,timestamp desc");
				while ($line = $db->fetch_array($query)) {
					$questions[$line['id']] = $line;
				}
				if (form::is_form_hash()) {
					$rs = array();
					foreach ($questions as $v) {
						$datas = $_POST['ques_'.$v['id']];
						$data = $_POST['type'];
						if ($v['multi']) {
							$d = 0;
							foreach ($datas as $v2) {
								$d |= 1<<$v2;
							}
							$datas = $d;
						} else $datas = 1<<$datas;
						if ($datas == $v['answer'] && $data == $v['sort']){ 
						$rs[$v['id']] = true;
						}else{ 
						$rs[$v['id']] = false;
						
						}
					}
					foreach ($rs as $k => $v) {
						if ($v) {
							if (!db::exists('e_answer', array('uid' => $uid, 'eid' => $k))) {
								db::insert('e_answer', array(
									'uid'       => $uid,
									'eid'       => $k,
									'status'    => 1,
									'timestamp' => $timestamp
								));
							}
						}
					}
					$rightCount = db::data_count('e_answer', "uid='$uid' and status='1'");
					if ($allCount - $rightCount > 0) {
						common::goto_url('/'.$action.'/'.$operation.'/');
					} else {
						common::setMsg('恭喜您通过了考试');
						db::update('memberfields', array('exam' => 1), "uid='$uid'");
						member_base::addFabudian($uid, 1,'调查考试通过奖励');
						common::refresh();
					}
				}
				if ($questions) {
					$query = $db->query("select * from {$pre}e_select".($rIds?" where eid not in($rIds)":'')." order by sort");
					while ($line = $db->fetch_array($query)) {
						$questions[$line['eid']]['list'][$line['sort']]=$line['title'];
					}
				}
			}
		}
	break;
	case 'topup':
		$bbsNav[] = array('name' => '存款充值');
		$newTops = array();
		$query = $db->query("select t1.username,t1.money1 money,t2.credits,t1.ctimestamp timestamp from {$pre}topup t1,{$pre}memberfields t2 where t1.status='1' and t1.uid=t2.uid order by t1.ctimestamp desc limit 10;");
		while ($line = $db->fetch_array($query)) {
			$line['level'] = member_credit::getLevel($line['credits']);
			$newTops[] = $line;
		}
		$tab || $tab = 'card';
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				$type = $_POST['type'];
				switch ($type) {
					case 'chinabank':	
						$datas = form::get(array('money', 'int'));
						$datas && extract($datas);
						if ($money) {
							$html = payfor_topup::payfor($uid, $money, $type);
							if (payfor_topup::$status) {
								echo $html;
								exit;
							} else {
								$rs = $html;
							}
						} else {
							$rs = 'data_error';
						}
					break;
					case 'card':
						$datas = form::get('cardId', 'cardPwd');
						$datas && extract($datas);
						if ($cardId && $cardPwd) {
							$rs = payfor_topup::payfor2($uid, $type, $cardId, $cardPwd);
						}
					break;
					case 'alipay':
							$datas = form::get(array('alipayMoney', 'float'), 'alipayId');
							if (!db::exists('topup', array('type' => $type, 'remark2' => $datas['alipayId']))) {
								$html = payfor_topup::payfor($uid, $datas['alipayMoney'], $type, false, $datas);
								if (payfor_topup::$status) {
									echo $html;
									exit;
								} else {
									$rs = $html;
								}
							} else {
								$rs = '该交易号已经被提交过了，请不好重复提交！';
							}
						
					break;
					case 'tenpay':
						$datas = form::get(array('money', 'int'), 'tenpay');
						$datas && extract($datas);
						$html = payfor_topup::payfor($uid, $money, $type, false, array('tenpay' => $tenpay));
						if (payfor_topup::$status) {
							echo $html;
							exit;
						} else {
							$rs = $html;
						}
					break;
					default:
						//$rs = 'data_error';
						$datas = form::get(array('money', 'int'));
						$datas && extract($datas);
						if ($money) {
							$html = payfor_topup::payfor($uid, $money, $type);
							if (payfor_topup::$status) {
								echo $html;
								exit;
							} else {
								$rs = $html;
							}
						} else {
							$rs = 'data_error';
						}
					break;
				}
			}
			if ($rs === true) {
				
			} else {
				$indexMessage = language::get($rs);
			}
		}
	break;
	case 'topupLog':
		$bbsNav[] = array('name' => '充值记录');
		$type || $type = '';
		$where = "uid='$uid'";
		$type && (($where && $where .= ' and ') || !$where) && $where.="type='$type'";
		$oid && (($where && $where .= ' and ') || !$where) && $where.="id='$oid'";
		if ($total = db::data_count('topup', $where)) {
			$tList = db::get_list('topup', '*', $where, 'ptimestamp desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, common::getUrl('/'.$action.'/'.$operation.'/?'.($type?"type='$type'&":'').'page={page}'), $pageStyle, 10, 'member1');
		}
	break;
	case 'payment':
		$bbsNav[] = array('name' => '申请提现');
		$minCredit = 50;
		if ($memberFields['credits'] < $minCredit) error::bbsMsg('对不起，您的积分小于'.$minCredit.'不能提现');
		$newPayments = array();
		$query = $db->query("select t1.username,t1.money,t2.credits,t1.timestamp2 timestamp,t2.vip,t2.vip2,t2.isEnsure from {$pre}payment t1,{$pre}memberfields t2 where t1.status='5' and t1.uid=t2.uid order by t1.timestamp2 desc limit 10;");
		while ($line = $db->fetch_array($query)) {
			$line['level'] = member_credit::getLevel($line['credits']);
			$newPayments[] = $line;
		}
		$taobaoMinMoney = cfg::getMoney('payment', 'taobaoMinMoney');
		$alipayMinMoney = cfg::getMoney('payment', 'alipayMinMoney');
		$bankMinMoney   = cfg::getMoney('payment', 'bankMinMoney');
		
		if ($memberFields['vip']==1) {
			$paymentCountMax = cfg::getInt('payment', 'vipCount');//一级会员每日提现次数
			$paymentMoneyMax = cfg::getMoney('payment', 'vipMaxMoney');//一级会员每日提现金额
		} elseif ($memberFields['vip']==2) {
			$paymentCountMax = cfg::getInt('payment', 'vip2Count');//钻石会员每日提现次数
			$paymentMoneyMax = cfg::getMoney('payment', 'vip2MaxMoney');//钻石会员每日提现金额
		}elseif ($memberFields['vip']==3) {
			$paymentCountMax = cfg::getInt('payment', 'vip3Count');//皇冠会员每日提现次数
			$paymentMoneyMax = cfg::getMoney('payment', 'vip3MaxMoney');//皇冠会员每日提现金额
		} else {
			$paymentCountMax = cfg::getInt('payment', 'memberCount');//普通会员每日提现次数
			$paymentMoneyMax = cfg::getMoney('payment', 'memberMaxMoney');//普通会员每日提现金额
		}
		if ($rs = form::is_form_hash2()) {
            if ($rs === true) {
				$rs = member_base::checkPwd2($uid, $_POST['pwd2']);
			}
			if ($rs === true) {
				//
				$paymentCount = db::data_count('payment', "uid='$uid' and timestamp1>=$today_start and timestamp1<=$today_end");
				$paymentMoney = (int)db::one_one('payment', 'sum(money)', "uid='$uid' and timestamp1>=$today_start and timestamp1<=$today_end");
				if ($paymentCount >= $paymentCountMax) error::bbsMsg('对不起，您每日提现的数次为'.$paymentCountMax.'次，今日提现已经达到了'.$paymentCountMax);
				if ($paymentMoney >= $paymentMoneyMax) error::bbsMsg('对不起，您每日提现的最大金额为￥'.$paymentMoneyMax.'次，今日提现已经达到了￥'.$paymentMoneyMax);
				$type = $_POST['type'];
				switch ($type) {
					case 'taobao':
						if (cfg::getBoolean('payment', 'taobaoStatus')) {
						$datas = form::get('money', 'shopurl');
						$datas && extract($datas);
						$money = common::formatMoney($money);
						$money2 = 0;
						$mp = cfg::getFloat('payment', 'taobaoSXF');
						
						$payfor = $money;
						if ($mp > 0) {
							$money2 = $money + $money * $mp;
							$money2 = common::formatMoney($money2);
							$payfor = $money2;
						}
						
						if ($payfor > $memberFields['money']) error::bbsMsg('对不起，您的余额小于'.$payfor.'￥');
						if ($money < $taobaoMinMoney) error::bbsMsg('对不起，淘宝商品提现最小提现额度为：￥'.$taobaoMinMoney);
						if (!$shopurl) error::bbsMsg('淘宝商品链接不能为空');
						if (preg_match('/^http:\/\/(?:[\w-]+\.)+(?:(?:taobao)|(?:tmall))\.com\/item\.htm\?(?:item_)?(?:num_)?id=(\d+).*$/', $shopurl, $matches)) {
							$shopId = $matches[1];
							$nickName = data_taobaoShop::getNick($shopId);
							if (!$nickName) error::bbsMsg('获取掌柜名失败');
						} else error::bbsMsg('淘宝商品地址格式错误');
						//插入数据
						if (db::insert2('payment', array(
							'uid' => $uid,
							'type' => $type,
							'username'   => $member['username'],
							'truename'   => $member['truename'],
							'money'      => $money,
							'mp'         => $mp,
							'money2'     => $money2,
							'remark1'    => $nickName,
							'remark2'    => $shopurl,
							'timestamp1' => $timestamp,
							'status'     => 0
						))) {
							member_base::addMoney($uid, - $payfor, '通过淘宝商品提现');
							member_base::sendPm($uid, '您于'.date('Y-m-d H:i:s', $timestamp).'通过淘宝商品申请提现￥'.$money, '网站提醒：申请提现￥'.$money, 'payment_app');
							member_base::sendSms($uid, '您于'.date('Y-m-d H:i:s', $timestamp).'通过淘宝商品申请提现￥'.$money, 'payment_app');
							common::setMsg('申请成功，请等待处理');
							common::refresh();
						} else {
							error::bbsMsg('系统错误，请重试');
						}
						} else error::bbsMsg('淘宝提现已禁用！');
					break;
					case 'alipay':
						if (cfg::getBoolean('payment', 'alipayStatus')) {
						$datas = form::get('money', 'alipay', 'nickname');
						$datas && extract($datas);
						$money = common::formatMoney($money);
						$money2 = 0;
						$mp = cfg::getFloat('payment', 'alipaySXF');
						$payfor = $money;
						if ($mp > 0) {
							$money2 = $money + $money * $mp;
							$money2 = common::formatMoney($money2);
							$payfor = $money2;
						}
						if ($payfor > $memberFields['money']) error::bbsMsg('对不起，您的余额小于'.$payfor.'￥');
						if ($money < $alipayMinMoney) error::bbsMsg('对不起，支付宝提现最小提现额度为：￥'.$alipayMinMoney);
						if (!$alipay) error::bbsMsg('支付宝帐号不能为空');
						if (!form::check_email($alipay) && !form::check_mobilephone($alipay)) error::bbsMsg('支付宝帐号格式错误');
						if (!$nickname) error::bbsMsg('支付宝真实姓名不能为空');
						//插入数据
						if (db::insert2('payment', array(
							'uid' => $uid,
							'type' => $type,
							'username'   => $member['username'],
							'truename'   => $member['truename'],
							'money'      => $money,
							'mp'         => $mp,
							'money2'     => $money2,
							'remark1'    => $nickname,
							'remark2'    => $alipay,
							'timestamp1' => $timestamp,
							'status'     => 0
						))) {
							member_base::addMoney($uid, - $payfor, '通过支付宝提现');
							member_base::sendPm($uid, '您于'.date('Y-m-d H:i:s', $timestamp).'通过支付宝转账申请提现￥'.$money, '网站提醒：申请提现￥'.$money, 'payment_app');
							member_base::sendSms($uid, '您于'.date('Y-m-d H:i:s', $timestamp).'通过支付宝转账申请提现￥'.$money, 'payment_app');
							common::setMsg('申请成功，请等待处理');
							common::refresh();
						} else {
							error::bbsMsg('系统错误，请重试');
						}
						} else error::bbsMsg('支付宝提现已禁用！');
					break;
					case 'bank':
						if (cfg::getBoolean('payment', 'bankStatus')) {
							$datas = form::get('money', 'bankType', 'truename', 'bankId', 'bankAddress');
							$datas && extract($datas);
							$money = common::formatMoney($money);
							$money2 = 0;
							$mp = cfg::getFloat('payment', 'bankSXF');
							$payfor = $money;
							if ($mp > 0) {
								$money2 = $money + $money * $mp;
								$money2 = common::formatMoney($money2);
								$payfor = $money2;
							}
							if ($payfor > $memberFields['money']) error::bbsMsg('对不起，您的余额小于'.$payfor.'￥');
							if ($money < $alipayMinMoney) error::bbsMsg('对不起，银行卡最小提现额度为：￥'.$bankMinMoney);
							if (!$bankId) error::bbsMsg('银行卡号不能为空');
							if (!$truename) error::bbsMsg('银行卡户名不能为空');
							!$bankAddress && error::bbsMsg('银行卡开户地址不能为空');
							//插入数据
							if (db::insert2('payment', array(
								'uid' => $uid,
								'type' => $type,
								'username'   => $member['username'],
								'truename'   => $member['truename'],
								'money'      => $money,
								'mp'         => $mp,
								'money2'     => $money2,
								'remark1'    => $bankType,
								'remark2'    => $bankId,
								'remark3'    => $truename,
								'remark4'    => $bankAddress,
								'timestamp1' => $timestamp,
								'status'     => 0
							))) {
								member_base::addMoney($uid, - $payfor, '通过银行卡提现');
								member_base::sendPm($uid, '您于'.date('Y-m-d H:i:s', $timestamp).'通过银行卡申请提现￥'.$money, '网站提醒：申请提现￥'.$money, 'payment_app');
								member_base::sendSms($uid, '您于'.date('Y-m-d H:i:s', $timestamp).'通过银行卡申请提现￥'.$money, 'payment_app');
								common::setMsg('申请成功，请等待处理');
								common::refresh();
							} else {
								error::bbsMsg('系统错误，请重试');
							}
						} else error::bbsMsg('银行卡提现已禁用！');
						
					break;
					case 'paylog':
		               
						  print_r($uid);
					break;
					default:
					break;
				}
			}
			if ($rs === true) {
			} else {
				$indexMessage = language::get($rs);
			}
		}
		//
		                $status = array('待审核', '已撤销', '未验证', '已拒绝', '处理中', '已发放');
		                if (isset($state)) $state = (int)$state;
		                else $state = '';
		                if ($total = db::data_count('payment', "uid='$uid'")) {
			              $payList = db::get_list('payment', '*', "uid='$uid'", 'timestamp1 desc', $page, $pagesize);
			              $multipage = multi_page::parse($total, $pagesize, $page, $baseUrl.'?page={page}', $pageStyle);
		                  }
					$all = db::one('payment', 'sum(money)', "uid='$uid' and status=5");
             		$allMoney = $all['sum(money)'];			
	break;
	case 'paymentLog':
		//$type || $type = '';
		//status 1:撤销 2
		$status = array('待审核', '已撤销', '未验证', '已拒绝', '处理中', '已发放');
		if ($cancel) {
			$item = db::one('payment', '*', "id='$cancel' and uid='$uid'");
			if (!$item['status']) {
				db::update('payment', array('timestamp2' => $timestamp, 'status' => 1), "id='$cancel'");
				if ($item['type'] == 'taobao')member_base::addMoney($uid, $item['money'], '撤销提现');
				else member_base::addMoney($uid, $item['money2'], '撤销提现');
			}
			common::goto_url($referer, true);
		}
		$bbsNav[] = array('name' => '提现记录');
		if (isset($state)) $state = (int)$state;
		else $state = '';
		$where = "uid='$uid'";
		$state !== '' && (($where && $where .= ' and ') || !$where) && $where.="status='$state'";
		$oid && (($where && $where .= ' and ') || !$where) && $where.="id='$oid'";
		if ($total = db::data_count('payment', $where)) {
			$tList = db::get_list('payment', '*', $where, 'timestamp1 desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, common::getUrl('/'.$action.'/'.$operation.'/?'.($type?"type='$type'&":'').'page={page}'), $pageStyle, 10, 'member1');
		}
	break;
	case 'buyTaobaoVcode':
		checkPwd2();
		$bbsNav[] = array('name' => '购买手机验证码');
	break;
	case 'buyAlipay':
		$bbsNav[] = array('name' => '购买实名支付宝');
		checkPwd2();
		$type || $type = 'buy';
		switch ($type) {
			case 'buy':
				if ($buy = (int)$buy) {
					$shop = db::one('shops', '*', "id='$buy'");
					if (!$shop['status']) {
						if ($memberFields['money'] < $shop['price']) error::bbsMsg('对不起，您的余额不足￥'.$shop['money']);
						member_base::addMoney($uid, - $shop['price'], '购买'.$shop['name']);
						db::update('shops', array(
							'uid'        => $uid,
							'username'   => $member['username'],
							'timestamp3' => $timestamp,
							'status'     => 1
						), "id='$buy'");
						db::update('shop_cate', 'total3=total3-1', "id='$shop[cid]'");
						common::setMsg('购买成功！');
						common::goto_url('/'.$action.'/'.$operation.'/?type=log');
					} else {
						if ($shop['status'] == 1) error::bbsMsg('该商品已经售出');
						if ($shop['status'] == 2) error::bbsMsg('该商品已经过期');
					}
				}
				if ($total = db::data_count('shops', "cid='1' and status='0'")) {
					$bList = db::get_list('shops', '*', "cid='1' and status='0'", 'timestamp1 desc', $page, $pagesize);
					$multipage = multi_page::parse($total, $pagesize, $page, common::getUrl('/'.$action.'/'.$operation.'/?type='.$type.($state!==''?"state='$state'&":'').'page={page}'), $pageStyle, 10, 'member1');
				}
			break;
			case 'log':
				if ($total = db::data_count('shops', "cid='1' and uid='$uid'")) {
					$bList = db::get_list('shops', '*', "cid='1' and uid='$uid'", 'timestamp3 desc', $page, $pagesize);
					$multipage = multi_page::parse($total, $pagesize, $page, common::getUrl('/'.$action.'/'.$operation.'/?type='.$type.($state!==''?"state='$state'&":'').'page={page}'), $pageStyle, 10, 'member1');
				}
			break;
		}
	break;
	case 'setting':
		checkPwd2();
		$memberConfig = member_base::getMemberConfig();
		if ($setDefault) {
			member_base::setDefConfig();
			common::setMsg('设置网站提醒设置默认设置成功');
			common::goto_url($baseUrl, true);
		}
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				$rs = member_base::setFormConfig();
			}
			if ($rs === true) {
				common::setMsg('设置成功');
				common::refresh();
			} else {
				$indexMessage = language::get($rs);
			}
		}
		$configArgs = array(
			array(
				'name' => '任务发布提醒',
				'sub'  => array(
					'out_take'     => '发布的任务被人接手',
					'out_pay'      => '接手人平台确认付款',
					'out_receive'  => '接手人平台确认收货',
					'out_comment'  => '接手人平台确认好评',
					'out_to_grade' => '已发任务到期好评',
					'out_complain' => '收到接手方投诉',
					'out_grade'    => '接手方给任务评分（修改时也发送）'
				)
			),
			array(
				'name' => '接手任务提醒',
				'sub'  => array(
					'in_verify'   => '成功接手任务（通过任务保护审核后）',
					'in_send'     => array('title' => '发布方确认发货', 'disabled' => true),
					'in_confirm'  => '发布方确认付款',
					'in_to_grade' => '接手的任务到期好评时',
					'acc_high'    => '买号购买信誉过高提醒',
					'acc_ban'     => '买号购买信誉过高，禁用',
					'in_book'     => '使用预定特权卡，预定到任务',
					'in_grade'    => '发布方给任务评分（修改时也发送）'
				)
			),
			array(
				'name' => '信用记录提醒',
				'sub'  => array(
					'complain'     => array('title' => '收到投诉', 'disabled' => true),
					'complain_end' => '收到申诉审核结果（或被撤销申述）',
					'ensure'       => array('title' => '收到维权投诉', 'disabled' => true),
					'ensure_end'   => '收到维权审核结果（或被撤销维权）',
					'black'        => '进入他人黑名单提醒',
					'credit'       => array('title' => '信用额度过低提醒', 'disabled' => true),
					'score'        => array('title' => '官方扣除积分提醒', 'disabled' => true)
				)
			),
			array(
				'name' => '资金变动通知',
				'sub'  => array(
					'remit'        => '充值成功通知',
					'remit_fail'   => array('title' => '充值失败通知', 'disabled' => true),
					'payment_app'  => array('title' => '申请提现通知', 'disabled' => true),
					'payment'      => array('title' => '发放提现通知', 'disabled' => true),
					'buy_points'   => '购买发布点通知',
					'score_points' => '积分兑换发布点通知',
					'points_gold'  => array('title' => '发布点换存款通知', 'disabled' => true),
					'luck'         => array('title' => '抽奖中心中奖通知', 'disabled' => true),
					'rmd_bonus'    => '推广奖励发放',
					'rmd_reg'      => '推广用户注册通知',
				)
			),
			array(
				'name' => '论坛提醒',
				'sub'  => array(
					'post_reply' => '当我的帖子收到回复时',
					'post_move'  => '当我的帖子被移动时',
					'post_del'   => '当我的帖子被删除时',
					'getpm'      => array('title' => '当我收到私人站内信时', 'disabled' => true),
				)
			),
			array(
				'name' => '信用记录提醒',
				'sub'  => array(
					'lock'    => array('title' => '账号挂起提醒', 'disabled' => true),
					'ban'     => array('title' => '账号封号通知', 'disabled' => true),
					'vip_end' => array('title' => 'VIP 会员到期提醒', 'disabled' => true),
					'mod_per' => array('title' => '修改个人资料提醒', 'disabled' => true),
				)
			)
		);
		$bbsNav[] = array('name' => '网站提醒设置');
	break;
	case 'card':
		               $datas = form::get('cardId', 'cardPwd');
						$datas && extract($datas);
						if ($cardId && $cardPwd) {
							$rs = payfor_topup::payfor2($uid, $type, $cardId, $cardPwd);
						}
		$newCards = array();
		$query = $db->query("select t1.name,t1.username,t1.money,t2.credits,t1.timestamp1 timestamp,t2.vip,t2.vip2,t2.isEnsure from {$pre}card t1,{$pre}memberfields t2 where t1.uid=t2.uid order by t1.timestamp1 desc limit 13;");
		while ($line = $db->fetch_array($query)) {
			$line['level'] = member_credit::getLevel($line['credits']);
			$newCards[] = $line;
		}
		$type || $type = 'card1';
		$bbsNav[] = array('name' => '点卡中心');
		if ($rs = form::is_form_hash2()) {
			checkPwd2();
			if ($rs === true) {
				$nums     = (int)$_POST['nums'];
				$cardType = (int)$_POST['cardType'];
				$rs = card::buy($uid, $cardType, $nums);
			}
			if ($rs === true) {
				common::setMsg('购买成功！，请到“我的宝贝”中激活');
				common::refresh();
			} else {
				$indexMessage = language::get($rs);
			}
		}
	break;
	case 'cardLog':
		checkPwd2();
		$bbsNav[] = '我的宝物';
		$type || $type = 0;
		$type = (int)$type;
		if ($active) {
			$rs = card::active($active);
			if ($rs === true) {
				common::setMsg('激活成功');
				common::goto_url($referer, true);
			} else {
				$indexMessage = language::get($rs);
				common::setMsg($indexMessage, 'indexMessage');
				common::goto_url($referer, true);
			}
		}
		if ($total = card::total($uid, $type)) {
			$list = card::getList($uid, $type, 'timestamp1 desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $baseUrl.'?type='.$type.'&page={page}', $pageStyle, 10, 'member1');
		}
	break;
	case 'vip':
		$bbsNav[] = array('name' => 'VIP申请');
		checkPwd2();
		if ($rs = form::is_form_hash2()) {
		    if ($rs === true) {
			    $datas = form::get3('viptype','months');
				$viptype=$datas['viptype'];
				$m = db::one('memberfields', 'vip,vip2,vip3', "uid='$uid'");
				if($m['vip']==1 || $m['vip2']==1 || $m['vip3']==1 ){
				    $indexMessage = '你已是VIP,请勿重复申请！';
				}else{
				    if($viptype==1){
				        $rs = member_base::addVip1($uid, $_POST['months']); 
						$indexMessage = $rs;
				    }elseif($viptype==2){
				        $rs = member_base::addVip2($uid, $_POST['months']);
						$indexMessage = $rs;
				    }elseif($viptype==3){
				        $rs = member_base::addVip3($uid, $_POST['months']); 
						$indexMessage = $rs;
				    }else{
				        $indexMessage = language::get($rs);
				    }
				}
		    }else{
            $indexMessage = language::get($rs);
            }		 
		}else{
		$indexMessage = language::get($rs);
		}
		 $vip_list=db::get_list3('log_vip', '*','id>0','timestamp desc');
	break;
	case 'flowVip':
		$bbsNav[] = array('name' => '尊享VIP申请');
		checkPwd2();
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				extract(form::get3('nums'));
				$rs = member_base::addFlowVip($uid, $nums);
			}
			if ($rs === true) {
				common::setMsg('申请流量VIP成功');
				common::refresh();
			} else {
				$indexMessage = language::get($rs);
			}
		}
	break;
	case 'mineaction':
		$bbsNav[] = array('name' => '砸地雷');
		$andmine = $_POST['andmine'];
			if (!$andmine){
			$rs='1';
			}else{
			$rs='0';
			    }
		
	
	break;
	case 'userjob':
		$bbsNav[] = array('name' => '砸地雷');
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				extract(form::get3('nums'));
				$rs = member_base::addFlowVip($uid, $nums);
			}
			if ($rs === true) {
				common::setMsg('申请流量VIP成功');
				common::refresh();
			} else {
				$indexMessage = language::get($rs);
			}
		}
	break;
	case 'exchange':
	   $bbsNav[] = array('name' => '兑换中心');
		checkPwd2();
		        $yu_jifen = cfg::getInt('exchange', 'yu_jifen');
				$ke_jifen = $memberFields[credits] - $yu_jifen ;
				$oneMoney = cfg::getMoney('exchange', 'money_point');
				if ($rs = form::is_form_hash2()) {
					if ($rs === true) {
						$datas = form::get('num','type','jifen','sid');
						$datas && extract($datas);
						$num=$datas[num];
						$type=$datas[type];
						$jifen=$datas[jifen];
						$sid=$datas[sid];
						if ($type==2) {
							if ($num < $memberFields[fabudian]) {
							    $money = $num * $oneMoney;
								if($money){
								member_base::addFabudian($uid, -$num,'麦点兑换现金');
								member_base::addMoney($uid, $money,'麦点兑换现金');
								}
								db::insert('log_exchange', array(
									'type'      => $type,
									'uid'       => $uid,
									'username'  => $member['username'],
									'total1'    => $num,
									'total2'    => $money,
									'total3'    => 0,
									'p'         => 1,
									'timestamp' => $timestamp
								));
								member_base::sendPm($uid, '您于'.date('Y-m-d H:i:s', $timestamp).'使用'.$num.'个发布点兑换了'.$money.'元存款', '网站提醒：发布点兑换存款', 'points_gold');
								member_base::sendSms($uid, '您于'.date('Y-m-d H:i:s', $timestamp).'使用'.$num.'个发布点兑换了'.$money.'元存款', 'points_gold');
						       echo "<script>alert('兑换成功！');window.location.href='';</script>";
							}
							else {
							echo "<script>alert('麦点不足！!');window.location.href='';</script>";
						    }
						} else {
							$rs = 'data_error';
						}
						if ($type==3) {
						    if($num!='' && $jifen!=''){
							    if($jifen < $ke_jifen ){
								    if($num > 0){
									member_base::addCredit($uid, -$jifen,'积分兑换麦点');
								    member_base::addFabudian($uid, $num,'积分兑换麦点');
								db::insert('log_exchange', array(
									'type'      => $type,
									'uid'       => $uid,
									'username'  => $member['username'],
									'total1'    => $jifen,
									'total2'    => $num,
									'total3'    => 0,
									'p'         => 1,
									'timestamp' => $timestamp
								));
								member_base::sendPm($uid, '您于'.date('Y-m-d H:i:s', $timestamp).'使用'.$jifen.'积分兑换了'.$nums.'个发布点', '网站提醒：积分兑换发布点', 'score_points');
								member_base::sendSms($uid, '您于'.date('Y-m-d H:i:s', $timestamp).'使用'.$jifen.'积分兑换了'.$nums.'个发布点', 'score_points');
									echo "<script>alert('积分成功兑换麦点！');window.location.href='';</script>";
									}else{
									echo "<script>alert('参数错误！');window.location.href='';</script>";
									}
								}else{
								echo "<script>alert('积分不足！');window.location.href='';</script>";
								}
							}else{
							$rs = 'data_error';
							}
						} else {
							$rs = 'data_error';
						}
						if ($type==1) {
						    if($sid!=''){
							    if($sid==1){
								echo "<script>alert('对不起，货源不足！');window.location.href='';</script>";
								}
								if($sid==2){
								echo "<script>alert('对不起，货源不足！');window.location.href='';</script>";
								}
								if($sid==3){
								echo "<script>alert('对不起，货源不足！');window.location.href='';</script>";
								}
								if($sid==4){
								echo "<script>alert('对不起，货源不足！');window.location.href='';</script>";
								}
							}else{
							$rs = 'data_error';
							}
						} else {
							$rs = 'data_error';
						}
					}
				}
	break;
	case 'logGold':
		$type = (int)$type;
		$type || $type = 0;
		$where = '';
		if ($dateStart) {
			$t1 = time::get_general_timestamp($dateStart);
			$t1 > 0 && ($where && ($where .= ' and ') || !$where) && $where .= "timestamp>=$t1";
		} else $dateStart = '';
		if ($dateEnd) {
			$t2 = time::get_general_timestamp($dateEnd);
			$t2 > 0  && ($t2 += 86400-1) && ($where && ($where .= ' and ') || !$where) && $where .= "timestamp<=$t2";
		} else $dateEnd = '';
		switch ($type) {
			case 0:
				
			break;
			case 1:
				($where && ($where .= ' and ') || !$where) && $where .= 'type=\'money\'';
			break;
			case 2:
				($where && ($where .= ' and ') || !$where) && $where .= 'type=\'fabudian\'';
			break;
			case 3:
				($where && ($where .= ' and ') || !$where) && $where .= 'type=\'credits\'';
			break;
		}
		($where && ($where .= ' and ') || !$where) && $where .= "uid='$uid'";
		if ($total = db::data_count('log', $where)) {
			$logList = db::get_list2('log', '*', $where, 'timestamp desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, common::getUrl('/'.$action.'/'.$operation.'/?type='.$type.($dateStart?'&dateStart='.$dateStart:'').($dateEnd?'&dateEnd='.$dateEnd:'').'&page={page}'), $pageStyle, 10, 'member1');
		}
	break;
	case 'PayDetails':
		switch ($type) {
			case 0:
				
			break;
			case 1:
			  $type = (int)$type;
		      $type || $type = 0;
			    $where = '';
		      if ($dateStart) {
			$t1 = time::get_general_timestamp($dateStart);
			$t1 > 0 && ($where && ($where .= ' and ') || !$where) && $where .= "timestamp>=$t1";
		     } else $dateStart = '';
		     if ($dateEnd) {
			$t2 = time::get_general_timestamp($dateEnd);
			$t2 > 0  && ($t2 += 86400-1) && ($where && ($where .= ' and ') || !$where) && $where .= "timestamp<=$t2";
		     } else $dateEnd = '';
				($where && ($where .= ' and ') || !$where) && $where .= 'type=\'money\'';
			     ($where && ($where .= ' and ') || !$where) && $where .= "uid='$uid'";
		     if ($total = db::data_count('log', $where)) {
			$logList = db::get_list2('log', '*', $where, 'timestamp desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, common::getUrl('/'.$action.'/'.$operation.'/?type='.$type.($dateStart?'&dateStart='.$dateStart:'').($dateEnd?'&dateEnd='.$dateEnd:'').'&page={page}'), $pageStyle, 10, 'member1');
		    }	  
			break;
			case 2:
			$type = (int)$type;
		     $type || $type = 0;
				    $where = '';
		     if ($dateStart) {
			$t1 = time::get_general_timestamp($dateStart);
			$t1 > 0 && ($where && ($where .= ' and ') || !$where) && $where .= "timestamp>=$t1";
		    } else $dateStart = '';
		    if ($dateEnd) {
			$t2 = time::get_general_timestamp($dateEnd);
			$t2 > 0  && ($t2 += 86400-1) && ($where && ($where .= ' and ') || !$where) && $where .= "timestamp<=$t2";
		     } else $dateEnd = '';
				($where && ($where .= ' and ') || !$where) && $where .= 'type=\'fabudian\'';
			     ($where && ($where .= ' and ') || !$where) && $where .= "uid='$uid'";
		     if ($total = db::data_count('log', $where)) {
			$logList = db::get_list2('log', '*', $where, 'timestamp desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, common::getUrl('/'.$action.'/'.$operation.'/?type='.$type.($dateStart?'&dateStart='.$dateStart:'').($dateEnd?'&dateEnd='.$dateEnd:'').'&page={page}'), $pageStyle, 10, 'member1');
		     }
			break;
			case 3:
			$type = (int)$type;
		     $type || $type = 0;
			    $where = '';
		     if ($dateStart) {
			  $t1 = time::get_general_timestamp($dateStart);
			  $t1 > 0 && ($where && ($where .= ' and ') || !$where) && $where .= "timestamp>=$t1";
	        	} else $dateStart = '';
		    if ($dateEnd) {
			$t2 = time::get_general_timestamp($dateEnd);
			$t2 > 0  && ($t2 += 86400-1) && ($where && ($where .= ' and ') || !$where) && $where .= "timestamp<=$t2";
		    } else $dateEnd = '';
				($where && ($where .= ' and ') || !$where) && $where .= 'type=\'credits\'';
			     ($where && ($where .= ' and ') || !$where) && $where .= "uid='$uid'";
		     if ($total = db::data_count('log', $where)) {
			$logList = db::get_list2('log', '*', $where, 'timestamp desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, common::getUrl('/'.$action.'/'.$operation.'/?type='.$type.($dateStart?'&dateStart='.$dateStart:'').($dateEnd?'&dateEnd='.$dateEnd:'').'&page={page}'), $pageStyle, 10, 'member1');
		     }
			break;	
			case 4:
			       $where = '';
		     if ($dateStart) {
			  $t1 = time::get_general_timestamp($dateStart);
			  $t1 > 0 && ($where && ($where .= ' and ') || !$where) && $where .= "timestamp>=$t1";
	        	} else $dateStart = '';
		    if ($dateEnd) {
			$t2 = time::get_general_timestamp($dateEnd);
			$t2 > 0  && ($t2 += 86400-1) && ($where && ($where .= ' and ') || !$where) && $where .= "timestamp<=$t2";
		    } else $dateEnd = '';
                ($where && ($where .= ' and ') || !$where) && $where .= "uid='$uid'";
	         	if ($total = db::data_count('task_log', $where)) {
			    $lList = db::get_list('task_log', '*', $where, 'timestamp desc', $page, $pagesize);
			   $multipage = multi_page::parse($total, $pagesize, $page, common::getUrl('/'.$action.'/'.$operation.'/?type='.$type.($dateStart?'&dateStart='.$dateStart:'').($dateEnd?'&dateEnd='.$dateEnd:'').'&page={page}'), $pageStyle, 10, 'member1');
		     }
				
			break;
            case 5:
				$where = '';
		     if ($dateStart) {
			  $t1 = time::get_general_timestamp($dateStart);
			  $t1 > 0 && ($where && ($where .= ' and ') || !$where) && $where .= "ptimestamp>=$t1";
	        	} else $dateStart = '';
		    if ($dateEnd) {
			$t2 = time::get_general_timestamp($dateEnd);
			$t2 > 0  && ($t2 += 86400-1) && ($where && ($where .= ' and ') || !$where) && $where .= "ptimestamp<=$t2";
		    } else $dateEnd = '';
			     ($where && ($where .= ' and ') || !$where) && $where .= "uid='$uid'";
		       if ($total = db::data_count('topup', $where)) {
			      $tList = db::get_list('topup', '*', $where, 'ptimestamp desc', $page, $pagesize);
			      $multipage = multi_page::parse($total, $pagesize, $page, common::getUrl('/'.$action.'/'.$operation.'/?type='.$type.($dateStart?'&dateStart='.$dateStart:'').($dateEnd?'&dateEnd='.$dateEnd:'').'&page={page}'), $pageStyle, 10, 'member1');
		     }
			break;	
            case 6:
		          $status = array('待审核', '已撤销', '未验证', '已拒绝', '处理中', '已发放');
		          if ($cancel) {
			      $item = db::one('payment', '*', "id='$cancel' and uid='$uid'");
			      if (!$item['status']) {
				  db::update('payment', array('timestamp2' => $timestamp, 'status' => 1), "id='$cancel'");
				  if ($item['type'] == 'taobao')member_base::addMoney($uid, $item['money'], '撤销提现');
				  else member_base::addMoney($uid, $item['money2'], '撤销提现');
			      }
			      common::goto_url($referer, true);
		          }
		        if (isset($state)) $state = (int)$state;
		        else $state = '';
		        $where = "uid='$uid'";
		        $state !== '' && (($where && $where .= ' and ') || !$where) && $where.="status='$state'";
		        $oid && (($where && $where .= ' and ') || !$where) && $where.="id='$oid'";
				$where = '';
		     if ($dateStart) {
			  $t1 = time::get_general_timestamp($dateStart);
			  $t1 > 0 && ($where && ($where .= ' and ') || !$where) && $where .= "timestamp1>=$t1";
	        	} else $dateStart = '';
		    if ($dateEnd) {
			$t2 = time::get_general_timestamp($dateEnd);
			$t2 > 0  && ($t2 += 86400-1) && ($where && ($where .= ' and ') || !$where) && $where .= "timestamp1<=$t2";
		    } else $dateEnd = '';
			     ($where && ($where .= ' and ') || !$where) && $where .= "uid='$uid'";
	        	if ($total = db::data_count('payment', $where)) {
			    $txList = db::get_list('payment', '*', $where, 'timestamp1 desc', $page, $pagesize);
			    $multipage = multi_page::parse($total, $pagesize, $page, common::getUrl('/'.$action.'/'.$operation.'/?type='.$type.($dateStart?'&dateStart='.$dateStart:'').($dateEnd?'&dateEnd='.$dateEnd:'').'&page={page}'), $pageStyle, 10, 'member1');
		     }
			break;
             case 7:
			    $where = '';
		       if ($dateStart) {
			   $t1 = time::get_general_timestamp($dateStart);
			   $t1 > 0 && ($where && ($where .= ' and ') || !$where) && $where .= "timestamp>=$t1";
		        } else $dateStart = '';
		        if ($dateEnd) {
			    $t2 = time::get_general_timestamp($dateEnd);
			    $t2 > 0  && ($t2 += 86400-1) && ($where && ($where .= ' and ') || !$where) && $where .= "timestamp<=$t2";
		        } else $dateEnd = '';
		        ($where && ($where .= ' and ') || !$where) && $where .= "uid='$uid'";
		        if ($total = db::data_count('log_member', $where)) {
			    $accList = db::get_list2('log_member', '*', $where, 'timestamp desc', $page, $pagesize);
			    $multipage = multi_page::parse($total, $pagesize, $page, common::getUrl('/'.$action.'/'.$operation.'/?'.($dateStart?'&dateStart='.$dateStart:'').($dateEnd?'&dateEnd='.$dateEnd:'').'&page={page}'), $pageStyle, 10, 'member1');
		        }
		}   
	break;
	
	case 'logAccount':
		$bbsNav[] = array('name' => '账户维护日志');
		$where = '';
		if ($dateStart) {
			$t1 = time::get_general_timestamp($dateStart);
			$t1 > 0 && ($where && ($where .= ' and ') || !$where) && $where .= "timestamp>=$t1";
		} else $dateStart = '';
		if ($dateEnd) {
			$t2 = time::get_general_timestamp($dateEnd);
			$t2 > 0  && ($t2 += 86400-1) && ($where && ($where .= ' and ') || !$where) && $where .= "timestamp<=$t2";
		} else $dateEnd = '';
		($where && ($where .= ' and ') || !$where) && $where .= "uid='$uid'";
		if ($total = db::data_count('log_member', $where)) {
			$logList = db::get_list2('log_member', '*', $where, 'timestamp desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, common::getUrl('/'.$action.'/'.$operation.'/?'.($dateStart?'&dateStart='.$dateStart:'').($dateEnd?'&dateEnd='.$dateEnd:'').'&page={page}'), $pageStyle, 10, 'member1');
		}
	break;
	case 'soft':
		$imgUrl = $weburl2.'img/soft/';
		$softUrl = $weburl2.'down/soft';
		$soft = false;
		if ($download = (int)$download) {
			if ($soft = db::one('softs', '*', "id='$download'")) {
				if ($soft['credit'] > 0 && $memberFields['credits'] < $soft['credit']) error::bbsMsg('对不起，您的积分小于'.$soft['credit'].'不能下载');
				if ($soft['price'] > 0) {
					if ($memberFields['money'] < $soft['price']) error::bbsMsg('对不起，您的余额小于'.$soft['money']);
					member_base::addMoney($uid, -$soft['price'], '下载软件['.$soft['title'].']');
				}
				$file = d('./down/soft/'.$soft['soft']);
				if (file::download($file, false)) {
					db::update('softs', 'downloads=downloads+1', "id='$download'");
					db::insert('log_soft', array(
						'sid'       => $soft['id'],
						'title'     => $soft['title'],
						'uid'       => $uid,
						'username'  => $member['username'],
						'timestamp' => $timestamp,
						'ip'        => $ipint
					));
				}
				exit;
			} else {
				error::bbsMsg('不存在该软件');
			}
		} elseif ($id) {
			if ($soft = db::one('softs', '*', "id='$id'")) {
				$cid = $soft['cid'];
				$soft['size']    = floor($soft['size'] / 1024 + 0.5).'KB';
				$soft['content'] = string::ubbDecode($soft['content']);
			}
		} else {
			if (!$cid) $cid = db::one_one('soft_cate', 'id', '', 'sort');
			if ($cid) {
				$cate = db::one('soft_cate', '*', "id='$cid'");
				$title = $cate['name'].' - '.$web_name;
				$hotSofts = db::get_list2('softs', '*', '', 'downloads,timestamp desc', 1, 5);
				if ($total = $cate['total']) {
					$softList = db::get_list2('softs', '*', "cid='$cid'", 'timestamp desc', $page, $pagesize);
					$multipage = multi_page::parse($taotal, $pagesize, $page, common::getUrl('/'.$action.'/'.$operation.'/?cid='.$cid.'&page={page}'), $pageStyle, 10, 'member1');
				}
			}
		}
		$newDowns = array();
		$query = $db->query("select t1.username,t1.title,t2.credits,t1.timestamp,t2.vip,t2.vip2,t2.isEnsure from {$pre}log_soft t1,{$pre}memberfields t2 where t1.uid=t2.uid order by t1.timestamp desc limit 20;");
		while ($line = $db->fetch_array($query)) {
			$line['level'] = member_credit::getLevel($line['credits']);
			$newDowns[] = $line;
		}
	break;
	case 'credit':
		$bbsNav[] = '个人信用中心';
		if ($total = db::data_count('credits', "tuid='$uid'")) {
			$cList = db::get_list2('credits', '*', "tuid='$uid'", 'timestamp desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, common::getUrl('/'.$action.'/'.$operation.'/?page={page}'), $pageStyle);
		}
	break;
	case 'ShuaKe':
		$bbsNav[] = '职业刷客';
		$shuake=cfg::get('sys', 'shuake_jifen');
		if ($rs = form::is_form_hash2()) {
		   $applyfor = (int)$_POST['applyfor'];
		   $sid = (int)$_POST['sid'];
		   if($rs=true){
		       if ($applyfor==1) {
			      if($memberFields[shuake]!=1){
		            if($shuake <= $memberFields[credits]){
				    db::update('memberfields', array('shuake' => 1,'shuake_expire' => $timestamp + 86400 * 30 * 1), "uid='$uid'");
					echo "<script>alert('申请职业刷客成功！');window.location.href='';</script>";
				    }else{
				    echo "<script>alert('积分不足！');window.location.href='';</script>";
				    }
				  }else{
				  echo "<script>alert('您已是职业刷客，请勿重复申请！');window.location.href='';</script>";
				  }
			    }
			    if ($applyfor==2) {
		            if($sid==1){
					echo "<script>alert('货源不足，请稍后再试！');window.location.href='';</script>";
					}
					if($sid==2){
					echo "<script>alert('货源不足，请稍后再试！');window.location.href='';</script>";
					}
					if($sid==3){
					echo "<script>alert('货源不足，请稍后再试！');window.location.href='';</script>";
					}
			    }
			}
		}
	break;
	
	case 'black':
		if ($isVip) $maxCountBase = 80;
		elseif ($isVip2) $maxCountBase =50;
		else $maxCountBase = 10;
		if ($memberFeilds['credits'] < 401) $multiple = 3;//倍数
		elseif ($memberFields['credits'] < 5001) $multiple = 5;
		elseif ($memberFields['credits'] < 50001) $multiple = 8;
		else $multiple = 15;
		$maxCount = $maxCountBase * $multiple;
		if ($remove) {
			member_base::removeBlack($uid, $remove);
			common::goto_url($baseUrl0);
		}
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				if ($memberFields['black1'] + 1 > $maxCount) $indexMessage = '对不起，您不可以添加更多黑名单了';
				else {
					$datas = form::get('username', array('blackDays', 'int'), array('isFriend', 'int'));
					$datas && extract($datas);
					$rs = member_base::addBlack($uid, $username, $blackDays, $isFriend);
				}
			}
			if ($rs === true) {
				common::setMsg('添加成功');
				common::goto_url($baseUrl0);
			} else {
				$indexMessage = language::get($rs);
			}
		}
		$bList = array();
		if ($total = $memberFields['black1']) {
			//$bList = db::get_list2('blacks', '*', "fuid='$uid'", 'timestamp desc');
			$query = $db->query("select t1.*,t2.credits,t2.black2 from {$pre}blacks t1 left join {$pre}memberfields t2 on t2.uid=t1.tuid where t1.fuid='$uid' and t1.status='0' order by t1.timestamp desc");
			while ($line = $db->fetch_array($query)) {
				$line['tLevel'] = member_credit::getLevel($line['credits']);
				$bList[] = $line;
			}
		}
		$newList = array();
		$query = $db->query("select t1.black2,t2.username from (select uid,black2 from {$pre}memberfields where black2>0 order by black2 limit 20) t1 left join {$pre}members t2 on t2.id=t1.uid");
		while ($line = $db->fetch_array($query)) {
			$newList[] = $line;
		}
	break;
	case 'complain':
		checkPwd2();
		$bbsNav[] = '申诉中心';
		$cStatus = array('等待被申诉方解决问题或辩解', '申诉成功', '申诉失败', '撤销申诉', '等待申诉人撤诉', '申诉人坚持申诉');
		$t || $t = 'post';
		if ($renew = (int)$renew) {
			$t = 'renew';
		} elseif ($cancel = (int)$cancel) {
			db::update('complain', array('status' => 4), "id='$cancel' and tuid='$uid' and status='0'");
			common::setMsg('申请撤销申述成功，请等待对方处理');
			common::goto_url($baseUrl0.'?t=get');
		} elseif ($goon = (int)$goon) {
			db::update('complain', array('status' => 5), "id='$goon' and fuid='$uid' and status='4'");
			common::setMsg('坚持申述成功');
			common::goto_url($baseUrl0.'?t=post');
		} elseif ($del = (int)$del) {
			if ($c = db::one('complain', '*', "id='$del' and fuid='$uid'")) {
				if (!in_array($c['status'], array(1, 2, 3))) {
					db::update('complain', array('status' => 3), "id='$del'");
					db::update('task', array('complain' => 0), "id='$c[tid]'");
					$msg = '任务“'.$c['tid'].'”，的申诉被撤销';
					member_base::sendPm($c['tuid'], $msg, '任务“'.$c['tid'].'”的申诉被撤销', 'complain_end');
					member_base::sendSms($c['tuid'], $msg, 'complain_end');
				}
			}
			common::setMsg('撤销申述成功');
			common::goto_url($baseUrl0.'?t=post');
		}
		$where = '';
		switch ($t) {
			case 'post':
				$where = "fuid='$uid'";
			break;
			case 'get':
				$where = "tuid='$uid'";
			break;
			case 'renew':
				$status = array(
		'暂停中', 
		'已发布，等待接手人接手', 
		'已接手，等待接手人绑定买号', '等待发布方审核', '已绑定买号，等待接手方支付', '已支付，待核对快递地址', '准备发货，等待快递单号', '已支付，等待发布人发货', 
		'已发货，等待收货与好评', '已确认，等待卖家核实货款', 
		'交易完成');
				if ($complain = $db->fetch_first("select t1.*,t2.status taskStatus from {$pre}complain t1 left join {$pre}task t2 on t2.id=t1.tid where t1.id='$renew'")) {
					if ($complain['fuid'] == $uid) $isMy = true;
					elseif ($complain['tuid'] == $uid) $isMy = false;
					else error::bbsMsg('错误');
					if (!in_array($complain['status'], array(1, 2))) {
						if ($rs = form::is_form_hash2()) {
							$datas = form::get('message');
							$datas = common::filterHtml($datas);
							$datas && extract($datas);
							if ($rs === true) {
								if (db::insert('complain_message', array(
									'cid'       => $complain['id'],
									'type'      => $isMy?0:1,
									'message'   => $message,
									'timestamp' => $timestamp
								))) {
									
								} else {
									$rs ='insert_error';
								}
							}
							if ($rs === true) {
								common::setMsg('内容补充成功');
								common::refresh();
							}
						}
					}
					$complainMessage = array();
					$query = $db->query("select * from {$pre}complain_message where cid='$complain[id]' order by timestamp");
					while ($line = $db->fetch_array($query)) {
						$line['message'] = string::ubbDecode($line['message']);
						$complainMessage[$line['type']][] = $line;
					}
				}
			break;
		}
		if ($where) {
			if ($total = db::data_count('complain', $where)) {
				$cList = db::get_list2('complain', '*', $where, 'timestamp1 desc', $page, $pagesize);
				$multipage = multi_page::parse($total, $pagesize, $page, $thisUrl.'?t='.$t.'&page={page}', $pageStyle, 10, 'member1');
			}
		}
	break;
	case 'taskLog':
		checkPwd2();
		$ts = array('all', 'seller', 'buyer');
		($t && in_array($t, $ts)) || $t = $ts[0];
		$where = "uid='$uid'";
		$sid && (($where && $where .= ' and ') || !$where) && $where .= "tid='$sid'";
		switch ($t) {
			case 'all':
			break;
			case 'seller':
				(($where && $where .= ' and ') || !$where) && $where .= "isBuyer='0'";
			break;
			case 'buyer':
				(($where && $where .= ' and ') || !$where) && $where .= "isBuyer='1'";
			break;
		}
		if ($total = db::data_count('task_log', $where)) {
			$lList = db::get_list('task_log', '*', $where, 'timestamp desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $thisUrl.'?t='.$t.($sid?'&sid='.$sid:'').'&page={page}', $pageStyle, 10, 'member1');
		}
	break;
	case 'club':
		$member['child2'] = 30;
		$ts = array('my', 'list', 'create');
		($t && in_array($t, $ts)) || $t = $ts[0];
		if ($quit = (int)$quit) {
			task_club::quit($uid, $quit);
			common::setMsg('成功退出门派');
			common::goto_url($baseUrl0.'?t=list');
		}
		switch ($t) {
			case 'list':
				$title = '江湖 - '. $web_name;
				if ($total = task_club::getClubCount()) {
					$cList = task_club::getList();
					$multipage = multi_page::parse($total, $pagesize, $page, $thisUrl.'?t='.$t.'&page={page}', $pageStyle, 10, 'member1');
				}
			break;
			case 'my':
				$title = '我的门派 - '. $web_name;
				$myClub = task_club::get($uid);
			break;
			case 'create':
				$isCreate = task_club::isCreate($uid);
				if (!$isCreate) {
					$title = '创建门派 - '. $web_name;
					if ($rs = form::is_form_hash2()) {
						$datas = form::get('name', 'remark', 'password');
						$datas = common::filterHtml($datas);
						$datas && extract($datas);
						if ($rs === true) {
							if ($memberFields['credits'] >= 30 && $isVip && $member['child2'] >= 30) {
								$rs = task_club::create($uid, $name, 'ico', $remark, $password);
							} else {
								$rs = '对不起，您不具备创建门派的条件';
							}
						}
						if ($rs === true) {
							common::setMsg('创建成功，等待审核');
							common::goto_url($baseUrl0.'?t=my');
						} else {
							$indexMessage = language::get($rs);
						}
					}
				}
			break;
		}
		$bbsNav[] = '我的门派';
	break;
	case 'from':
		$type || $type = 'from';
		
		switch ($type) {
			case 'from':
				$isFrom = db::exists('from', "uid='$uid'");
				if (!$isFrom){
					if ($rs = form::is_form_hash2()){
						if ($rs === true) {
							$datas = form::get(array('fromId', 'int'), 'remark');
							$datas && extract($datas);
							if ($fromId) {
								if (db::exists('from_cate', "id='$fromId'")) {
									if (db::insert('from', array(
										'fid'       => $fromId,
										'uid'       => $uid,
										'username'  => $member['username'],
										'remark'    => $remark,
										'timestamp' => $timestamp
									))) {
										db::update('from_cate', 'count=count+1', "id='$fromId'");
										member_base::addfabudian($uid, 1, '来路调查奖励');
										common::getUrl('/'.$action.'/member/');
									}
								} else {
									$rs = '不存在该选项';
								}
							}
						}
						if ($rs === true) {
							
						} else {
							$indexMessage  = language::get($rs);
						}
					}
				} else error::bbsMsg('对不起，您已经调查过了');
			break;
			case 'get':
				if ($t == 'get') {
					$total = rand(3, 5);
					card::buy($uid, 0, $total);
					db::update('memberfields', array('from' => 1), "uid='$uid'");
					common::setMsg('恭喜您，抽奖中了'.$total.'个发布点，请到我的宝物中进行激活即可使用');
					common::goto_url($baseUrl0.'?type='.$type);
				}
			break;
		}
	break;
	case 'spread':
		$limit = ' limit '.($page - 1) * $pagesize.','.$pagesize;
		$sList = array();
		$sList_month = array();
		$sList_top = array();
		$count1 = array();
		$where = "parent='$uid' and status>='0'";
				$total = db::data_count('members', $where);
				$month_start = date('Y-m-01 00:00:00',time());
				$now_start = date('Y-m-d 00:00:00',time());
				$now_end = date('Y-m-d H:i:s',time());
				$monthwhere = "parent='$uid' and reg_timestamp>=unix_timestamp('$month_start') and reg_timestamp<=unix_timestamp('$now_end')";
				$daywhere = "parent='$uid' and reg_timestamp>=unix_timestamp('$now_start') and reg_timestamp<=unix_timestamp('$now_end')";
				$month = db::data_count('members', $monthwhere);
				$day = db::data_count('members', $monthwhere);
				if ($total > 0){
					$query = $db->query("select t1.id,t1.username,t1.rewordPoint2,t1.reg_timestamp,t2.credits,t2.vip,t2.vip2,t2.vip3,t3.inComplate,t3.outComplate from (select * from {$pre}members where $where order by reg_timestamp desc$limit) t1 left join {$pre}memberfields t2 on t2.uid=t1.id left join {$pre}membertask t3 on t3.uid=t2.uid");
					while ($line = $db->fetch_array($query)) {
						$line['level'] = member_credit::getLevel($line['credits']);
						$sList[] = $line;
					}
				}
				member_base::upCache();
				$total_month = db::data_count('members', 'childMonth>0');
				$query_month = $db->query("select t1.username,t1.monthCount,t1.childMonth,t1.rewordPointMonth,t2.credits,t2.vip,t2.vip2,t2.isEnsure from {$pre}members t1 left join {$pre}memberfields t2 on t2.uid=t1.id where t1.childMonth>0 order by t1.childMonth desc limit 0,10");
				while ($line_month = $db->fetch_array($query_month)) {
					$line_month['level'] = member_credit::getLevel($line_month['credits']);
					$sList_month[] = $line_month;
				}
				$total_top = db::data_count('members');
				$query_top = $db->query("select t1.username,t1.child2,t1.rewordPoint1,t2.credits,t2.vip,t2.vip2,t2.isEnsure from {$pre}members t1 left join {$pre}memberfields t2 on t2.uid=t1.id order by t1.child2 desc limit 0,10");
				while ($line_top = $db->fetch_array($query_top)) {
					$line_top['level'] = member_credit::getLevel($line_top['credits']);
					$sList_top[] = $line_top;
				}
				$i=0;$i++;
		if ($total) {
			$multipage = multi_page::parse($total, $pagesize, $page, $baseUrl.'?t='.$t.'&page={page}', $pageStyle, 10, 'member1');
		}
		$tops = array();
		$query = $db->query("
		select
			t2.username username1,t3.credits credits1,t3.vip vip1,t3.vip2 vip21,t3.isEnsure isEnsure1,t1.username username2,t1.credits credits2,t1.vip vip2,t1.vip2 vip22,t1.isEnsure isEnsure2,t1.reg_timestamp
		from
			(select t1.*,t2.credits,t2.vip,t2.vip2,t2.isEnsure from
				(select
					id,username,parent,reg_timestamp
				from
					{$pre}members 
				where
					parent>0 and status='1' order by reg_timestamp desc limit 10) t1 
			left join
				{$pre}memberfields t2 
			on
				t2.uid=t1.id) t1
		left join
			{$pre}members t2
		on
			t2.id=t1.parent
		left join
			{$pre}memberfields t3
		on
			t3.uid=t2.id
		");
		while ($line = $db->fetch_array($query)) {
			$line['level1'] = member_credit::getLevel($line['credits1']);
			$line['level2'] = member_credit::getLevel($line['credits2']);
			$tops[] = $line;
		}
	break;
	case 'ensure':
		$ts = array('index', 'join', 'joinPay', 'in', 'out', 'exit');
		($type && in_array($type, $ts)) || $type = $ts[0];
		switch ($type) {
			case 'index':
			break;
			case 'join':
				if ($isEnsure) {
					//common::goto_url($baseUrl0.'?type=joinPay');
				}
			break;
			case 'joinPay':
				if ($memberFields['ensureMoney'] < $sys_ensure_max_money) {
					//可以缴费
					$status = true;
					$payforMoney = $sys_ensure_max_money - $memberFields['ensureMoney'];
					$payforMoney > $sys_ensure_min_money && $payforMoney = $sys_ensure_min_money;
					if ($rs = form::is_form_hash2()) {
						if ($rs === true) {
							//处理缴费
							$rs = member_base::setEnsureMoney($uid, $payforMoney);
						}
						if ($rs === true) {
							common::setMsg('恭喜您，缴纳保证金成功并加入商家保障');
							common::goto_url($baseUrl0);
						} else {
							$indexMessage = language::get($rs);
						}
					}
				} else {
					//超额了
					$status = false;
				}
			break;
			/*case 'in':
				checkPwd2();
			break;
			case 'out':
				checkPwd2();
			break;*/
			case 'exit':
				if (!$isEnsure) error::bbsMsg('您尚未加入商保！');
				if ($memberFields['ensureMoney'] > $sys_ensure_min_money) {
					if ($timestamp - $memberFields['ensureLastTime'] > 90 * 86400) {
						if (db::exists('task', "buid='$uid' and isEnsure='1' and status<'10'")) error::bbsMsg('对不起，您还有商保任务未完成，不能退出！');
						$ensureTaskLastTime = db::one_one('task', 'ctimestamp', "guid='$uid' and status='10'", 'ctimestamp desc');
						if ($timestamp - $ensureTaskLastTime < 16 * 86400) error::bbsMsg('对不起，您离最后一个商保任务间隔没有16天，不能退出！');
						$rs = member_base::exitEnsure($uid);
						if ($rs === true) {
							common::setMsg('恭喜您，成功退出商家保障');
							common::goto_url($baseUrl0);
						} else {
							$indexMessage = language::get($rs);
						}
					} else error::bbsMsg('对不起，您离最后加押时间没有90天不能退出！');
				} else error::bbsMsg('对不起，您的保证金不足！');
			break;
			default:
				checkPwd2();
				$bbsNav[] = '申诉中心';
				$cStatus = array('等待被投诉方解决问题或辩解', '维权成功', '维权失败', '撤销维权', '等待维权人撤诉', '维权人坚持维权');
				if ($renew = (int)$renew) {
					$type = 'renew';
				} elseif ($cancel = (int)$cancel) {
					db::update('ensure', array('status' => 4), "id='$cancel' and tuid='$uid' and status='0'");
					common::setMsg('申请撤销维权完毕，请等待对方处理');
					common::goto_url($baseUrl0.'?type=in');
				} elseif ($goon = (int)$goon) {
					db::update('ensure', array('status' => 5), "id='$goon' and fuid='$uid' and status='4'");
					common::setMsg('坚持维权成功');
					common::goto_url($baseUrl0.'?type=out');
				} elseif ($del = (int)$del) {
					if ($c = db::one('ensure', '*', "id='$del' and fuid='$uid'")) {
						if (!in_array($c['status'], array(1, 2, 3))) {
							db::update('ensure', array('status' => 3), "id='$del'");
							db::update('task', array('ensureStatus' => 1 | 1 << 1 | 1 << 2), "id='$c[tid]'");
							member_base::sendPm($c['tuid'], $c['fusername'].'对您撤销了商保索赔，任务ID：'.$c['tid'], $c['fusername'].'对您撤销了商保索赔，任务ID：'.$c['tid'], 'ensure_end');
						}
					}
					common::setMsg('撤销申述成功');
					common::goto_url($baseUrl0.'?type=out');
				}
				$where = '';
				switch ($type) {
					case 'out':
						$where = "fuid='$uid'";
					break;
					case 'in':
						$where = "tuid='$uid'";
					break;
					case 'renew':
						if ($complain = $db->fetch_first("select t1.*,t2.status taskStatus from {$pre}ensure t1 left join {$pre}task t2 on t2.id=t1.tid where t1.id='$renew'")) {
							if ($complain['fuid'] == $uid) $isMy = true;
							elseif ($complain['tuid'] == $uid) $isMy = false;
							else error::bbsMsg('错误');
							if (!in_array($complain['status'], array(1, 2))) {
								if ($rs = form::is_form_hash2()) {
									$datas = form::get('message');
									$datas = common::filterHtml($datas);
									$datas && extract($datas);
									if ($rs === true) {
										if (db::insert('ensure_message', array(
											'cid'       => $complain['id'],
											'type'      => $isMy?0:1,
											'message'   => $message,
											'timestamp' => $timestamp
										))) {
											
										} else {
											$rs ='insert_error';
										}
									}
									if ($rs === true) {
										common::setMsg('内容补充成功');
										common::refresh();
									}
								}
							}
							$complainMessage = array();
							$query = $db->query("select * from {$pre}ensure_message where cid='$complain[id]' order by timestamp");
							while ($line = $db->fetch_array($query)) {
								$line['message'] = string::ubbDecode($line['message']);
								$complainMessage[$line['type']][] = $line;
							}
						}
					break;
				}
				if ($where) {
					if ($total = db::data_count('ensure', $where)) {
						$cList = db::get_list2('ensure', '*', $where, 'timestamp1 desc', $page, $pagesize);
						$multipage = multi_page::parse($total, $pagesize, $page, $thisUrl.'?type='.$type.'&page={page}', $pageStyle, 10, 'member1');
					}
				}
			break;
		}
	break;
	case 'eids':
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				//处理缴费
				if ($isVip) {
					$time = $timestamp - $sys_time_space_getEid;
					if (db::exists('eids', "uid='$uid' and useTime>'$time'")) {
						$timeInfo = time::daytime($sys_time_space_getEid);
						$rs = '对不起'.($timeInfo['day'] ? $timeInfo['day'].'天' : '').($timeInfo['hour'] ? $timeInfo['hour'].'时' : '').($timeInfo['minute'] ? $timeInfo['minute'].'分' : '').($timeInfo['second'] ? $timeInfo['second'].'秒' : '').'之内只能获取一个免费快递号';
					} else {
						if ($id = db::one_one('eids', 'id', "status='0'", 'addTime')) {
							db::update('eids', array('uid' => $uid, 'username' => $member['username'], 'useTime' => $timestamp, 'status' => 1), "id='$id'");
							$rs = true;
						} else $rs = '很抱歉，系统缺货，暂时没有单号提供！';
					}
				} else $rs = '对不起，您不是会员，只有会员才能免费获取！';
			}
			if ($rs === true) {
				common::setMsg('恭喜您，免费获取成功');
				common::goto_url($baseUrl0);
			} else {
				$indexMessage = language::get($rs);
			}
		}
		if ($total = db::data_count('eids', "uid='$uid'")) {
			$list = db::get_list('eids', '*', "uid='$uid'", 'useTime desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $baseUrl.'?page={page}', $pageStyle);
		}
	break;
	case 'checkAccount':
		if (!cfg::getBoolean('sys', 'checkIP')) return common::goto_url('/');//不允许检测
		if (!$username || !member_base::memberExists($username)) common::goto_url('/');//没有用户名或者不存在
		$__uid = member_base::getUid($username);
		$memberInfo = member_base::getMemberAll($__uid);
		$tps = array('index', 'check');
		(!empty($type) && in_array($type, $tps)) || $type = $tps[0];
		switch ($type) {
			case 'index':
				if ($rs = form::is_form_hash2()) {
					if ($rs === true) {
						$t0 = cfg::getInt('sys', 'checkIPTime');
						$t1 = $timestamp;
						$t2 = $t1 - $t0;//5分钟之内只能发一次
						if (db::exists('log_exception', "uid='$__uid' and time>=$t2 and time<=$t1")) {
							$rs = '对不起，'.$t0.'秒之内只能找回一次';
						} else {
							$code = string::getRandStr(8, 1);
							$args = array(
								'webName'  => $web_name,
								'username' => $memberInfo['base']['username'],
								'code'     => $code,
								'activeUrl' => common::getUrl('/member/checkAccount/?username='.urlencode($memberInfo['base']['username']).'&type=check&code='.$code)
							);
							$datas = form::get3('type', 'email', 'mobile');
							switch ($datas['type']) {
								case 'email':
									if ($datas['email'] == $memberInfo['base']['email']) {
											if (db::insert('log_exception', array(
												'uid'         => $__uid,
												'username'    => $username,
												'code'        => $code,
												'time'        => $timestamp
											))) {
												$title   = cfg::get('email', 'ecpTitle');
												$content = cfg::get('email', 'ecpContent');
												$title   = common::replaceVars($title, $args);
												$content = common::replaceVars($content, $args);
												$smtp = new email($mail_server, $mail_port, true, $mail_username, $mail_password);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
												//$smtp->debug = TRUE;//是否显示发送的调试信息
												$smtp->sendmail($memberInfo['base']['email'], $mail_from, $title, $content, 'HTML');
												$rs = true;
											} else {
												$rs = '异常错误！';
											}
									} else {
										$rs = '系统检测到您输入的E-Mail与帐号绑定的E-Mail不一致';
									}
								break;
								case 'mobilephone':
									if ($memberInfo['base']['mobilephone'] == $datas['mobile']) {
										if (db::insert('log_exception', array(
												'uid'         => $__uid,
												'username'    => $username,
												'code'        => $code,
												'time'        => $timestamp
											))) {
												$content = cfg::get('message', 'ecpContent');
												$content = common::replaceVars($content, $args);
												message::send($datas['mobile'], $content);
												$rs = true;
											} else {
												$rs = '异常错误！';
											}
									} else {
										$rs = '系统检测到您输入的手机号码与帐号绑定的不一致';
									}
								break;
							}
						}
					}
					if ($rs === true) {
						common::goto_url($baseUrl0.'?username='.urlencode($username).'&type=check', false, '提交成功，请注意查收！');
					} else {
						$indexMessage = language::get($rs);
					}
				}
			break;
			case 'check':
				if ($rs = form::is_form_hash2()) {
					if ($rs === true) {
						$datas = form::get3('code');
						if ($datas['code']) {
							$code = db::one_one('log_exception', 'code', "uid='$__uid'", 'id DESC');
							if (!empty($code) && $code == $datas['code']) {
								db::update('members', array('last_login_ip' => $ipint), "id='$__uid'");
								common::goto_url('/member/login/', false, '验证成功，请登录！');
							} else {
								$rs = '验证失败！';
							}
						} else {
							$rs = '参数错误！';
						}
					}
					if ($rs === true) {
						common::goto_url($baseUrl0.'?username='.urlencode($username).'&type=check', false, '提交成功，请注意查收邮件！');
					} else {
						$indexMessage = language::get($rs);
					}
				}
			break;
		}
	break;
}
include(template::load($operation));
?>