<?php $_tplModify=filemtime('D:\xinyupingtai\cache\default\task\tao_index.php');if(filemtime('D:\xinyupingtai\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\task\tao_info.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\quick.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\task\tab.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\xinyupingtai\templates\default\task\tao_index.htm','D:\xinyupingtai\cache\default\task\tao_index.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/task/';$cssList=array(0=>'http://d.hainuo.info/css/task/task.css');echo '
';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>';echo $title;echo '</title>
<meta name="description" content="';echo $description;echo '" />
<meta name="keywords" content="';echo $keywords;echo '" />
';if($cssList){echo '
';if($cssList){foreach($cssList as $v){echo '
<link rel="stylesheet" type="text/css" href="';echo $v;echo '" />
';}}echo '
';}else{echo '
<link href="http://d.hainuo.info/css/bbs/bbs.css" rel="stylesheet" type="text/css" />
';}echo '
<script type="text/javascript" src="http://d.hainuo.info/javascript/jquery.min.js"></script><script type="text/javascript" src="http://d.hainuo.info/javascript/common.func.js"></script>
';if($jsList){echo '
';if($jsList){foreach($jsList as $v){echo '
<script type="text/javascript" src="';echo $v;echo '"></script>
';}}echo '
';}echo '
<script type="text/javascript">
';if($showMessage){echo '
alert(\'';echo common::bf_addcslashes($showMessage);echo '\');
';}echo '
$.ajaxSetup({';echo 'cache:false';echo '});
var memberLogined=';echo $memberLogined?'true':'false';echo ';
var loginUsername=\'';echo $memberLogined?$member['username']:'';echo '\';
var weburl=\'';echo $weburl;echo '\';
var weburl2=\'';echo $weburl2;echo '\';
var sys_hash2=\'';echo $sys_hash2;echo '\';
var webqq = 195230378 ;
</script>
<link href="/css/httshouye.css" rel="stylesheet" type="text/css" />
';if($memberLogined){echo '
<link href="/css/denglu.css" rel="stylesheet" type="text/css" />
';}echo '
<script src="/Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>

<body>
<div id="top">
';if($memberLogined){echo '
<div class="top-mid">
    	<form action="" method="get">你好，<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info/?username=';echo $member['username'];echo '"><em>';echo $member['username'];echo '</em></a><img title="积分：';echo $memberFields['credits'];echo '" alt="积分" src="';echo $memberLevel['icon'];echo '"><input type="button" onclick="window.location.href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/logout/\'" class="tc" value="退出" /></form>
        <ul style="width:560px;">
            <li class="ck"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/">存款：<span>';echo $memberFields['money'];echo '</span></a>　/
           		 <ul>
                	<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/">账号充值</a></li>
                    <li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/PayDetails/?type=1">存款明细</a></li>
                </ul>                        
            </li>
            
            
            <li class="tl"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/BuyPoint/">兔粮：';echo $memberFields['fabudian'];echo '</a>　/
           		 <ul>
                	<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/BuyPoint/">购买兔粮</a></li>
                    <li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/PayDetails/?type=2">兔粮明细</a></li>
                </ul>            
            </li>
            
            
            <li class="xx"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/">信息：<span>(';echo $memberFields['msg'];echo ')</span></a>　/
           		 <ul>
                	<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=inUser">私人收件箱</a></li>
                    <li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=inSys">官方收件箱</a></li>
                    <li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=setting">站内信提醒</a></li>
                </ul>                       
            </li>
            
            
             <li class="wsfbf"><a href="#">我是发布方</a>　/
           		 <ul>
                	<li><a href="#">图文教程</a></li>
                    <li><a href="#">视频教程</a></li>
                    <li><a href="#">排行榜</a></li>
                </ul>                       
            </li>
            
            
            
            <li class="wsjsf"><a href="#">我是接手方</a>　/
           		 <ul>
                	<li><a href="#">图文教程</a></li>
                    <li><a href="#">视频教程</a></li>
                    <li><a href="#">领取奖励</a></li>
                    <li><a href="#">排行榜</a></li>
                </ul>                       
            </li>
            
            
            
        	<li class="zhsz"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/userdata/?type=index">账号设置</a>　/
                <ul>
                	<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/forgotpwd/">找回密码</a></li>
                    <li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/userdata/?type=GetPass">找回操作码</a></li>
                    <li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/forgotpwd/">更多操作</a></li>
                </ul>            
            </li>
        	<!--<li class="wdtw"><a href="#">我的兔窝</a>　/
            	<ul>-->
                	<!--<li><a href="#"><img onmouseover="this.src=\'/img/att223_03.png\'" onmouseout="this.src=\'/img/att222_03.png\'" src="/img/att222_03.png"/></a></li>
                    <li><a href="#"><img onmouseover="this.src=\'/img/att223_05.png\'" onmouseout="this.src=\'/img/att222_05.png\'" src="/img/att222_05.png"/></a></li>
                    <li><a href="#"><img onmouseover="this.src=\'/img/att223_09.png\'" onmouseout="this.src=\'/img/att222_09.png\'" src="/img/att222_09.png"/></a></li>
                    <li><a href="#"><img onmouseover="this.src=\'/img/att223_10.png\'" onmouseout="this.src=\'/img/att222_10.png\'" src="/img/att222_10.png"/></a></li>-->
                    <!--<li><a href="#">我要充值</a></li>
                    <li><a href="#">我要提现</a></li>
                    <li><a href="#">购买兔粮</a></li>
                    <li><a href="#">网店托管</a></li>
                
                </ul>-->
          
            </li>
        	<li class="kfbb"><a href="#">客服帮助</a>
            	<div class="kfbz">
                	<!--<h2><span>值班时间：</span> 9:00-12:00 . 13:30-17:30 . 19:00-21:00</h2>
                    <hr/>
                  　<div class="xsbz">
                    	<span>新手帮助：</span> <img src="/img/att333_08.png" /><a href="#">客服小云</a>　　　<img src="/img/att333_16.png" /><a href="#">客服小云</a>
                    </div>        
                　　<h3><span>充值提现：</span> <img src="/img/att333_16.png"/><a href="#">充值帮助</a></h3>
                	<hr/>
					<h4><span>店铺运营免费指导：</span> <img src="/img/att333_08.png" /><a href="#">客服小云</a></h4>
    
                    <h5><span>交流群：</span><img src="/img/att333_16.png"/><a href="#">5494848</a></h5><em>（注：客服不会要求操作任务、充值，谨防受骗）</em>-->
                    <div class="kf-tu">
                    <a href="#"><img onmouseover="this.src=\'/img/atte2_06.png\'" onmouseout="this.src=\'/img/atte_06.png\'" src="/img/atte_06.png" class="kf-1" / ></a>
                    <a href="#"><img onmouseover="this.src=\'/img/atte2_08.png\'" onmouseout="this.src=\'/img/atte_06.png\'" src="/img/atte_06.png" class="kf-2"  / ></a>
                    <a href="#"><img onmouseover="this.src=\'/img/atte2_12.png\'" onmouseout="this.src=\'/img/atte_12.png\'" src="/img/atte_12.png" class="kf-3"  / ></a>
                    <a href="#"><img onmouseover="this.src=\'/img/atte2_15.png\'" onmouseout="this.src=\'/img/atte_15.png\'" src="/img/atte_15.png"class="kf-4"  / ></a>
                    <a href="#"><img onmouseover="this.src=\'/img/atte2_22.png\'" onmouseout="this.src=\'/img/atte_22.png\'" src="/img/atte_22.png"class="kf-5"  / ></a>
                  	</div>  
                </div>
        			
          </li>
  
        </ul>
  </div>
';}else{echo '	
<div class="top-mid">
    	<form action="" method="get">你好，欢迎来到花兔兔网商互动平台<input type="button" class="dl" value="登陆" /><input type="button" class="zc" value="注册" /></form>
        <ul>
        	<!--<li class="xsbz1"><a href="#">新手帮助</a>　/</li>-->
             <li class="wsfbf"><a href="#">我是发布方</a>　/
           		 <ul>
                	<li><a href="#">图文教程</a></li>
                    <li><a href="#">视频教程</a></li>
                    <li><a href="#">排行榜</a></li>
                </ul>                       
            </li>
            
            
            
            <li class="wsjsf"><a href="#">我是接手方</a>　/
           		 <ul>
                	<li><a href="#">图文教程</a></li>
                    <li><a href="#">视频教程</a></li>
                    <li><a href="#">领取奖励</a></li>
                    <li><a href="#">排行榜</a></li>
                </ul>                       
            </li>
            
            
            
        	<li class="zhsz"><a href="#">账号设置</a>　/
                <ul>
                	<li><a href="#">找回密码</a></li>
                    <li><a href="#">找回操作码</a></li>
                    <li><a href="#">更多操作</a></li>
                </ul>            
            </li>
        	<!--<li class="wdtw"><a href="#">我的兔窝</a>　/
            	<ul>
                	
                    <li><a href="#">我要充值</a></li>
                    <li><a href="#">我要提现</a></li>
                    <li><a href="#">购买兔粮</a></li>
                    <li><a href="#">网店托管</a></li>
                
                </ul>
          
            </li>-->
        	<li class="kfbb"><a href="#">客服帮助</a>
            	<div class="kfbz">
                	<!--<h2><span>值班时间：</span> 9:00-12:00 . 13:30-17:30 . 19:00-21:00</h2>
                    <hr/>
                  　<div class="xsbz">
                    	<span>新手帮助：</span> <img src="/img/att333_08.png" /><a href="#">客服小云</a>　　　<img src="/img/att333_16.png" /><a href="#">客服小云</a>
                    </div>        
                　　<h3><span>充值提现：</span> <img src="/img/att333_16.png"/><a href="#">充值帮助</a></h3>
                	<hr/>
					<h4><span>店铺运营免费指导：</span> <img src="/img/att333_08.png" /><a href="#">客服小云</a></h4>
    
                    <h5><span>交流群：</span><img src="/img/att333_16.png"/><a href="#">5494848</a></h5><em>（注：客服不会要求操作任务、充值，谨防受骗）</em>-->
                    <div class="kf-tu">
                    <a href="#"><img onmouseover="this.src=\'/img/atte2_06.png\'" onmouseout="this.src=\'/img/atte_06.png\'" src="/img/atte_06.png" class="kf-1" / ></a>
                    <a href="#"><img onmouseover="this.src=\'/img/atte2_08.png\'" onmouseout="this.src=\'/img/atte_06.png\'" src="/img/atte_06.png" class="kf-2"  / ></a>
                    <a href="#"><img onmouseover="this.src=\'/img/atte2_12.png\'" onmouseout="this.src=\'/img/atte_12.png\'" src="/img/atte_12.png" class="kf-3"  / ></a>
                    <a href="#"><img onmouseover="this.src=\'/img/atte2_15.png\'" onmouseout="this.src=\'/img/atte_15.png\'" src="/img/atte_15.png"class="kf-4"  / ></a>
                    <a href="#"><img onmouseover="this.src=\'/img/atte2_22.png\'" onmouseout="this.src=\'/img/atte_22.png\'" src="/img/atte_22.png"class="kf-5"  / ></a>
                  	</div>  
                </div>
        			
          </li>
  
        </ul>
  </div>
';}echo '
</div>




<div id="head">
	<div class="head-mid">
    	<img src="/img/att_06.png" class="logo"/>
        <img src="/img/att_09.png" class="dh"/>
    </div>
</div>


<div id="nav">
	<div class="nav-mid">
    	<ul>
        	<li class="sy"><a href="#">首页</a></li>
            <li><a href="#">淘宝大厅</a></li>
            <li><a href="#">拍拍大厅</a></li>
            <li><a href="#">收藏流量</a></li>
            <li><a href="#">购买麦点</a></li>
            <li><a href="#">网店托管</a></li>
            <li class="yy"><a href="#">运营指导<em>（免费）</em></a></li>
            <li><a href="#">有问必答</a></li>
            <li><a href="#">会员中心</a></li>
        </ul>
    </div>
</div>';echo '

	<div id="content">
    ';if($_showmessage){echo '<div class=\'msg_panel\'><div>';echo $_showmessage;echo '</div></div>';}echo '
	';if($indexMessage){echo '<div class=\'error_panel\'><div>';echo $indexMessage;echo '</div></div>';}echo '
<style type="text/css">
.gold .yred {';echo ' color:#D61810;';echo '}
</style>
<style type="text/css">
.kd a:hover {';echo ' text-decoration:underline;';echo '}
#content table tr td{';echo 'padding-left:13px;_padding-left:6px;*padding-left:6px!important;';echo '}
.buyerspages a {';echo 'background:#F8F8F8; border: 1px solid #E8E8E8;display: block; float: left;height: 25px;margin: 0 2px;text-align: center;width: 25px';echo '}
.buyerspages a:hover,.buyerspages a.nov{';echo ' background:#EAF4FD; border-color: #B0D0E9;';echo '}
.autotk {';echo 'position:absolute; top:55px; right:30px; ';echo '}
.autotk input {';echo 'margin-top:5px;';echo '}
.autotk strong {';echo ' color:#FF5500;';echo '}
.rwdt_dexpress{';echo 'background:url(/images/tx_ico_28.png) no-repeat;float:left;display:block;width:145px;text-indent:20px;height:17px;line-height:17px;color:#333;';echo '}
</style>
';echo '<ul class="rwdt_info">
      <li>
        <p class="fd">账户余额：<strong class="chengse">';echo $memberFields['money'];echo '</strong> 元</p>
      <a title="将存款提取到我的网银或支付宝上" target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/payment/" class="rwdt_tx"></a></li>
      <div class="cle"></div>
      <li><p class="fd">麦点：<strong class="chengse">';echo $memberFields['fabudian'];echo '</strong> 个</p><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/exchange/" title="将保证金兑换成能发布任务的麦点" target="_blank" class="rwdt_hs"></a></li>
      <div class="cle"></div>
      <li><p>积分：<strong class="chengse">';echo $memberFields['credits'];echo '</strong> 个</p></li>
      <li><p class="fd">属于：';if($memberFields['shuake']==1){echo '职业刷客';}elseif($memberFields['vip']==1||$memberFields['vip']==2||$memberFields['vip']==3){echo '';echo $vip;echo '';}else{echo '';echo $credits;echo '';}echo '</p><span class=""></span></li>
      <div class="cle"></div>
      <li>好评率：<strong class="lvse">
买家
';$snum=$memberFields['sgrade1']+$memberFields['sgrade2']+$memberFields['sgrade3'];$shpl=$memberFields['sgrade1']/$snum*10000;$shpl=ceil($shpl)/100;if($shpl==0)echo '100';else echo $shpl;echo '%

卖家
';$bnum=$memberFields['bgrade1']+$memberFields['bgrade2']+$memberFields['bgrade3'];$bhpl=$memberFields['bgrade1']/$bnum*10000;$bhpl=ceil($bhpl)/100;if($bhpl==0)echo '100';else 
		echo $bhpl;echo '%

	      </strong></li>
      <li>有效投诉：<strong class="chengse">0</strong></li>
</ul>';echo '
		';echo '<style>
.task_header em{';echo 'color: red;font-weight: bold;';echo '}
</style>
<div class="rwdt_bk">
			<p class="sub_bt"><a id="liInput1" class="nov" href="javascript:;">支付宝充值</a><a href="javascript:;" id="liInput2">网银充值</a><a href="javascript:;" id="liInput3">购买麦点</a><a href="javascript:;" id="liInput4">人工转账</a></p>
			 <div id="buyboxcont">
				<div class="task_header" style="display:block;">
				  
						<table style="margin-top:10px;" align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
							<tbody><tr><td>收款支付宝账号：<a href="javascript:;" onclick="return copy(\'xiaomaimaila@163.com\')"><em>xiaomaimaila@163.com</em></a> (<span style="color:#FF9000;" onclick="return copy(\'胡可恬\')">胡可恬</span>) </td></tr>
							<tr><td>转账时只能备注：<span style="color:#FF9000;font-weight:700">';echo $memberLogined?$member['username']:'';echo '</span></td></tr>
							<tr><td>(转账完毕后验证交易号，1分钟到账)</td></tr>
							<tr>
                        	   <td colspan="2"><a class="tc_b" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1850/" target="_blank">查看充值教程</a><a class="tc_k" target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/?type=alipay">验证交易号</a></td>
                            </tr>
						</tbody></table>
				   
		       </div>
		       <div class="task_header" style="display:none">
					<form id="q_f_2" action="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/" method="post" target="_blank" onsubmit="return checkForm1();">
                        ';echo $sys_hash_code2;echo '
                        <table style="margin-top:10px;" align="left" border="0" cellpadding="0" cellspacing="0" width="90%">
					  <tbody><tr>
						<td height="30" align="right" valign="top" width="35%">充值用户名：</td>
						<td><input name="username" id="username" class="rwdt_inp" style="color:#666" value="';echo $member['username'];echo '" disabled="disabled" type="text"></td>
					  </tr>
					  <tr>
						<td height="30" align="right" valign="top">充值金额：</td>
						<td><input name="money" id="money" class="rwdt_inp" style="color:#666" value="100" type="text" onfocus="window.location.href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/\'">
						<span class="chengse">(1%手续费)</span></td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td><input class="rwdt_cz" type="submit" name="imageField"></td>
					  </tr>
				  </tbody></table>
				  </form>
		       </div>
			    <div class="task_header" style="display:none">
							<form id="q_f_3" action="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/BuyPoint/" method="post" onsubmit="return checkForm3();">
                                ';echo $sys_hash_code2;echo '
                                <input name="cardType" value="1" type="hidden">
							<input name="jiage" id="jiage" value="" type="hidden">
									<table style="margin-top:10px;" align="left" border="0" cellpadding="0" cellspacing="0" width="90%">
									<tbody><tr>
											<td height="30" align="right" valign="middle" width="35%">购买价格：</td>
											<td><span style="color:#D9281E; font-weight:bold;"><span id="jiage1">0.68</span>元=1个麦点</span></td>
										</tr>
									<tr>
											<td height="30" align="right" valign="middle" width="35%">购买数量：</td>
											<td><input name="nums" id="cardnums" value="1" size="10" maxlength="4" type="text" onfocus="window.location.href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/BuyPoint/\'">(最少购买1个)</td>
										</tr>
									<tr>
										<td>&nbsp;</td>
										<td><input class="rwdt_cz" type="submit" name="imageField"></td>
									</tr>
								</tbody></table>
							</form>
		       </div>
			    <div class="task_header" style="display:none">
					<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                      	<tbody>
						<tr>
                        	<td colspan="2" style="padding:5px 10px 5px 10px;">财付通直接转帐冲值，不收任何手续费用。仅接受大于100元以上的充值。充值前请联系客服，然后再打款，平台指定人工充财付通帐号：<em>273334116</em></td>
                        </tr>
                        <tr>
                        	<td style="width:50%;padding-left:20px;"><a class="rwdt_kf" href="tencent://message/?uin=188239039" target="_blank">联系客服</a></td>
                            <td><a class="rwdt_cht" target="_blank" href="https://www.tenpay.com/v2/account/pay/index.shtml?ADTAG=TENPAY_V2.FUKUAN.JIESHAO.C2C">登录财付通</a></td>
                        </tr>
                      </tbody>
					</table>
		       </div>
		  </div>
		</div>';echo '
		<div class="rwdt_bk2">
			<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/safesz/" class="szsz_btn" target="_blank"></a>
			<p class="ts">接实物任务后立即收货好评将 <span class="chengse">- 20 </span>麦点</p>
			<p class="ts">任务过程中旺旺聊到刷信誉平台相关字眼 <span class="chengse">- 5 </span>麦点</p>
			<p class="ts">为了您资金安全，接手方淘宝支付后务必在<span class="lanse">15</span>分钟内回到平台操作任务点击“已付款” </p>
		</div>
		<div class="rwdt_gg"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/userjob/" target="_blank"><img src="/images/jrw.gif"></a></div>
		<div class="rwdt_gg2"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1538/" target="_blank"><img src="/images/frw.gif"></a></div>




<script type="text/javascript">
					$(function() {';echo '
						bechange(\'.sub_bt a\',\'#buyboxcont>.task_header\');
						$("table > tr:odd").addClass("tcolor");
					';echo '});
					</script>
<script type="text/javascript">
function checkForm1() {';echo '
   var checks = [
		["isNumber", "money", "充值金额"]];
	var result = doCheck(checks);
	if (result)
		return avoidReSubmit();
	return result;
';echo '}
function checkForm2(){';echo '
  var checks = [
		["isEmpty", "cardPwd", "订单号"]];
	var result = doCheck(checks);
	if (result)
		return avoidReSubmit();
	return result;
';echo '}
function checkForm3() {';echo '
   var checks = [
		["isNumber", "cardnums", "购买麦点数量"] ];
	var result = doCheck(checks);
	if (result)
		return avoidReSubmit();
	return result;
';echo '}

</script>
		';echo '<div class="rwdt_menu">
  <a href="';echo $baseUrl;echo '"';if($m=='index'){echo ' class="nov" ';}echo ' title="淘宝任务大厅">淘宝任务大厅</a>
  <a href="';echo $baseUrl;echo '?m=taskIn" ';if($m=='taskIn'){echo ' class="nov" ';}echo ' title="已接任务">已接任务</a>
  <a href="';echo $baseUrl;echo '?m=taskOut" ';if($m=='taskOut'){echo ' class="nov" ';}echo ' title="已发任务">已发任务</a>
  <a href="';echo $baseUrl;echo '?m=tieBuyer" ';if($m=='tieBuyer'){echo ' class="nov" ';}echo ' title="绑定买号">绑定买号</a>
  <a href="';echo $baseUrl;echo '?m=tieSeller" ';if($m=='tieSeller'){echo ' class="nov" ';}echo ' title="绑定掌柜">绑定掌柜</a>
</div>





';echo '
		<div class="rwdt_xx">
			<p class="rwdt_lx">
			<a href="javascript:;" seed="0">全部任务</a>
			<a href="javascript:;" seed="1">虚拟任务</a>
			<a href="javascript:;" seed="2">实物任务</a></p>
			<ul class="rwdt_jg" id="rwdt_jg">
				<li><span class="gdt1"></span></li>
				<li><a href="#" jiages="0" title="不限" class="nov">不限</a></li>
				<li><a href="#" title="1-30元" jiages="1">1-30元</a></li>
				<li><a href="#" title="31-100元" jiages="2">31-100元</a></li>
				<li><a href="#" title="101-400元" jiages="3">101-400元</a></li>
				<li><a href="#" title="400以上" jiages="4">400以上</a></li>
				<li><span class="gdt2"></span></li>
			</ul>
			<ul class="rwdt_jg" id="rwdt_jg2" style="display:none;">
				<li><span class="gdt1"></span></li>
				<li><a href="#" title="不限" cid="6">不限</a></li>
				<li><a href="#" title="1天收货" cid="1">1天收货</a></li>
				<li><a href="#" title="2天收货" cid="2">2天收货</a></li>
				<li><a href="#" title="3天收货" cid="3">3天收货</a></li>
				<li><a href="#" title="4天以上收货" cid="4">4天以上收货</a></li>
				<li><span class="gdt2"></span></li>
			</ul>
			<div class="rwdt_btn"><a href="';echo $baseUrl;echo '?m=add" class="fb_btn"></a>
			<a href="javascript:;" class="sx_btn"></a></div>
		    <div class="autotk"><input id="nAuTotk" name="nAuTotk" type="checkbox"> <strong>自动接任务</strong>
			<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/AutoAm/" target="_blank"><strong>（配置自动接任务筛选条件）</strong></a></div>
		</div>
	<div class="cle"></div>
	    <div id="taobao-lists">
		<div id="taskList"></div>
		<table id="reAutoAM" style="width:100%;height:150px;background-color:#FBFBFB;display:none;">
            <tr>
                <td align="right" style="width:30%"><img src="/images/loading.gif" /></td>
                <td><span style="margin-left:20px;color:Red;font-weight:bold;"></span><input id="btnAutoAM" style="display:none;" /></td>
            </tr>
          </table>

		</div>
</div>
<div class="cle"></div>
<div id="divIDList" style="display:none;">
<div class="divin">
<div class="cont">
<table class="namelist" style="margin-top:0px; margin-left:0px;" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr class="trListNormal">
<td id="tdOpenNormalBa" style="background-color:#E1E1E1;color:Black; padding:6px 0px 5px 5px;cursor:pointer; border-bottom:solid 1px #FFFFFF;" onclick="OpenNormalBa(1)" colspan="2">
<span id="spanNormalHead" style="color:black;">
<img src="/images/hidden.gif" style="margin-bottom:2px;">
普通买号（可用';echo $real;echo '个，点击查看）   
</span>
</td>
</tr>
<tr id="trListNormal" class="trListNormal">
<td colspan="2">
<table class="bpage1" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
';if($bList){foreach($bList as $v){echo ' 
';if($v['isreal'] !=1){echo '
<tr name="L6">
<td class="name" style="width:29%;">
<label><input value="';echo $v['id'];echo '" id="buyer';echo $v['nickname'];echo '" name="ba" type="radio">';echo $v['nickname'];echo '</label>
</td>
<td style="width:71%;">(淘宝信用：';echo $v['score'];echo ' ';echo $v['score_ico'];echo ',本月已接：';echo $v['tswkTask'];echo ',今日已接：';echo $v['todayTask'];echo ',拉黑：';echo $v['complate'];echo ')</td>
</tr>
';}echo '
';}}echo ' 
</tbody>
</table>
<div class="buyerspages" style="height:25px;margin:10px 0px;">
<a href="javascript:;" onclick="Openbuyerspage(';echo $k;echo ');" class="nov">';echo $page;echo '</a>
</div>
</td>
</tr>
<tr id="trListTrueName">
<td id="tdOpenTrueNameBa" style="background-color:#E1E1E1;color:Black;padding:6px 0px 5px 5px;cursor:pointer;" onclick="OpenTrueNameBa(1)" colspan="2">
<span id="spanTrueNameHead" style="color:black;">
<img src="/images/show.gif" style="margin-top:2px;">
实名买号（可用';echo $isreal;echo '个，点击查看）
</span>
</td>
</tr>
<tr id="trListTrueName" style="display:none;">
<td colspan="2">
<table class="bsmpage1" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
';if($bList){foreach($bList as $v){echo ' 
';if($v['isreal']==1){echo '
<tr name="L6">
<td class="name" style="width:29%;">
<label><input value="';echo $v['id'];echo '" id="buyer';echo $v['nickname'];echo '" name="ba" type="radio">';echo $v['nickname'];echo '</label>
</td>
<td style="width:71%;">(淘宝信用：';echo $v['score'];echo ' ';echo $v['score_ico'];echo ',本月已接：';echo $v['tswkTask'];echo ',今日已接：';echo $v['todayTask'];echo ',拉黑：';echo $v['complate'];echo ')</td>
</tr>
';}echo '
';}}echo '
</tbody>
</table>
<div class="buyerspages" style="height:25px;margin:10px 0px;">
<a href="javascript:;" onclick="Openbuyersmpage(';echo $k;echo ');" class="nov">1</a>
</div>

</td>
</tr>
</tbody>
</table>
<p>注：为了安全，买号淘宝信用大于2000时，无法使用该买号接任务。</p>
</div>
</div>
</div>
<script>
var hideFlag = true;
$(window).scroll(function(){';echo '
    if(hideFlag) {';echo '
        ($(this).scrollTop() > 200) ? $("#Bottom_Bar").fadeIn() : $("#Bottom_Bar").fadeOut();
    ';echo '}
';echo '});
var closeBottomBar = function () {';echo '
    hideFlag = false;
    $("#Bottom_Bar").fadeOut();
';echo '}
</script>

<script type="text/javascript" src="/images/common.js"></script>
<!--[if lte IE 6]>
<script type="text/javascript" src="/javascript/cn/DD_belatedPNG_0.0.7a.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix(\'*\');
</script>
<![endif]-->
<script type="text/javascript" src="/images/Common.js"></script>
<script type="text/javascript" src="/images/service.js"></script>
<script type="text/javascript">
var zgMax=20;
var curMoney=';echo $memberFields['money']?'true':'false';echo ';
var curG=';echo $memberFields['fabudian']?'true':'false';echo ';
var curExam=';echo $memberFields['exam']?'true':'false';echo ';
var at_txtMinPrice = 0;
var at_txtMaxPrice = 9999;
var at_txtMinpoint = 0;
var at_NoSB=false;
var at_NoAudit=false;
var at_NoWW=false
var at_NoLHS=false;
var at_NoCart=';echo $memberFields['flowVip']?'true':'false';echo ';
var at_NoMeal=false;
var at_NoLaiLu=false;
var at_NoExpress=false;
var at_NoPinPic=false;
var at_timesBegin=1;
var at_timesBegin=8;
var at_isCartOnly=false;
var at_isMealOnly=false;
var at_isLailuOnly=false;
var at_isExOnly=false;
var at_isEnsureOnly= ';echo $memberFields['isEnsure']?'true':'false';echo ';
var at_isReal = ';echo $task['isReal']?'true':'false';echo ';
var at_isAuto = ';echo $memberFields['vip_auto']?'true':'false';echo ';
var isFlowVip = ';echo $memberFields['flowVip']?'true':'false';echo ';
var active=true;
var complain=true;
var istask=true;
var webqq = 277613662;
var webnoticeurl = "";
var webnoticetit = "";
var quick_qq = \'\';
</script>
<script type="text/javascript" src="/images/artDialog.js"></script>
<script type="text/javascript" src="/images/jquery_002.js"></script>
<script type="text/javascript" src="/images/artDialog.min2.js"></script>
<script type="text/javascript" src="/images/task.js"></script>
<script type="text/javascript">
var isGetData=false;
function sortTask(obj) {';echo '
    getObj(\'btnQuery\').click();
';echo '}
function changeSort(val) {';echo '
    setValue(\'sort\', val);
    getObj(\'btnQuery\').click();
    return false;
';echo '}

function showPanel() {';echo '
    $(\'#task_panel\').show();
';echo '}
function viptake() {';echo '                        
    alert(\'对不起，您当前不是VIP，请先申请成为VIP\');
';echo '}
function goPage(n) {';echo '
    if($("#nAuTotk").attr("checked")){';echo 'alert("请先关闭下面的的自动接任务功能！");return';echo '}
    if(!isGetData){';echo '
	isGetData=true;
	if (n==void(0)) n = 1;
    var pageSearch = \'\';
    var page = new PageQuery(window.location.search);
    for (var i=0; i<page.getLength(); i++) {';echo '
        if (page.getParameters()[i] != \'page\')
            pageSearch += \'&\' + page.keyValuePairs[i];
    ';echo '}
    pageSearch += \'&page=\' + n + \'&now=\' + (new Date()).getTime();
	var stype=$(\'.rwdt_lx .nov\').attr("seed");
	var jiages=$(\'#rwdt_jg .nov\').attr("jiages");
	var swid=$(\'#rwdt_jg2 .nov\').attr("cid");
	if(stype==1){';echo '
		pageSearch+="&stype="+stype+"&jiage="+jiages;
	 ';echo '}else if(stype==2){';echo '
	    pageSearch+="&stype="+stype+"&swid="+swid;
	 ';echo '}else{';echo '
	    pageSearch+="&jiage="+jiages;
	 ';echo '}
    getObj(\'taskList\').innerHTML = \'<div class=\\\'submiting\\\'>任务加载中.....</div>\';
    getTask(pageSearch);
	setTimeout("isGetData=false",800);
	';echo '}
';echo '}
function getTask(qs) {';echo '
   // var url = \'/ajax/getTask.php?type=1\' + \'&au=\' + $(\'#isAuto\').val() + qs;
   var url = \'/ajax/getTask.php?type=1\' + \'&au=\' + 8 + qs;
    $.ajax({';echo '
		type : \'GET\',
		url  : url,
		success : function(html){';echo '
			if (html.indexOf(\'任务进行中\')<0 && html.indexOf(\'qrw_btn\')<0 )
				html = \'<div class=\\\'pub_tip5 f_b\\\'>对不起，本互动区里所有任务都被抢光了，请过会再 <span class=\\\'btn_gl\\\' onclick=\\\'goPage(1);\\\'>刷新</span> 试试...</div>\' + html;
			$(\'#taskList\').html(html);
		';echo '},
		error:function(){';echo '
			$(\'#taskList\').html(\'<p>&nbsp;</p><p>尊敬的会员，您遇到了一个未知的错误，请稍后重新点击。　　<a href="/index.html">返回主页</a></p>\');
		';echo '}
	';echo '});
';echo '}
$(".sx_btn").click(function(){';echo 'goPage(1);';echo '});
if(at_isAuto=="0" ){';echo '
$("#nAuTotk").click(function(){';echo '
artDialog({';echo 'content:"自动接任务功能每天只能免费接到3个任务，您今日的配额已经接满，请明天再使用。<br/>您也可以购买自动接任务功能卡。",id:"alarm",yesText:"进入购买",noText:"取消"';echo '},
function(){';echo '
window.location.href="/BuyPoint/";
';echo '},
function(){';echo '
$("#nAuTotk").removeAttr("checked");
 DisabledClose();goPage(1);
';echo '});
';echo '});
';echo '}
else 
$("#nAuTotk").click(function(){';echo 'AutoRef(this);';echo '});
function AutoRef(obj){';echo '
if(obj.checked){';echo '
   if(!isGetData){';echo '
	isGetData=true;
	$.post("/ajax/autoref.php",{';echo '"type":1';echo '}, function(result){';echo '
        if(result!=null){';echo '
            AutoAMResult(result);
        ';echo '}
    ';echo '},\'json\'); 
   ';echo '}     
';echo '}else{';echo '
$("#reAutoAM").hide();
UpdateTask();
';echo '}
';echo '}

$(function(){';echo '
	$("#rwdt_jg a").click(function(){';echo '
		$("#rwdt_jg a").removeClass("nov");
		$(this).addClass("nov");
		var jiages="&jiage="+$(this).attr("jiages");
		var stype=$(\'.rwdt_lx .nov\').attr("seed");
		if(stype==1){';echo '
		jiages+="&stype="+stype;
		';echo '}
		getObj(\'taskList\').innerHTML = \'<div class=\\\'submiting\\\'>任务加载中.....</div>\';
		getTask(jiages);
		return false;
	';echo '});
	$("#rwdt_jg2 a").click(function(){';echo '
		$("#rwdt_jg2 a").removeClass("nov");
		$(this).addClass("nov");
		var sws="&swid="+$(this).attr("cid");
		getObj(\'taskList\').innerHTML = \'<div class=\\\'submiting\\\'>任务加载中.....</div>\';
		getTask(sws);
		return false;
	';echo '});
	$(".rwdt_lx a").click(function(){';echo '
		$(".rwdt_lx a").removeClass("nov");
		$(this).addClass("nov");
		var swtask=$(this).attr("seed");
		var jiages="&jiage="+$(this).attr("jiages");
		var stype="&stype="+$(this).attr("seed");
		if(swtask==2){';echo '
		$(\'#rwdt_jg\').css("display","none");
		$(\'#rwdt_jg2\').css("display","block");
		';echo '}else{';echo '
		$(\'#rwdt_jg\').css("display","block");
		$(\'#rwdt_jg2\').css("display","none");
		';echo '}
		getObj(\'taskList\').innerHTML = \'<div class=\\\'submiting\\\'>任务加载中.....</div>\';
		getTask(stype);
		return false;
	';echo '});
	showPanel();
	goPage(1);
';echo '});
$(\'.web_qq\').hover(function(){';echo '
    $(\'.quick_qq\').show();
';echo '});
</script>
';echo '<div id="footer">
	<div class="footer-mid">
    	<img src="/img/att_104.png" class="logo2"/>
  		<div class="gy"><a href="#">关于我们</a> | <a href="#">联系我们</a> | <a href="#">花兔兔规则</a> | <a href="#">淘宝信誉查询</a> | <a href="#">淘宝信誉查询</a></div>
<p>客户服务热线：02968929109 Copyright © 2012-2020 huatutu.com All RightsReserved 花兔兔版权所有 粤ICP备13037934号</p>
	
</div>

</body>
</html>';?>