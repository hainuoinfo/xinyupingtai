<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\task\tao_tieBuyer.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\task\tao_info.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\quick.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\task\tab.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\task\tao_tieBuyer.htm','D:\damaihu\xinyupingtai7\cache\default\task\tao_tieBuyer.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/task/';$cssList=array(0=>'http://damaihu.tertw.net/css/task/task.css');$jsList=array(0=>'http://damaihu.tertw.net/javascript/index/task.js');echo '
';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>';echo $title;echo '</title>
<meta name="description" content="';echo $description;echo '" />
<meta name="keywords" content="';echo $keywords;echo '" />
';if($cssList){echo '
';if($cssList){foreach($cssList as $v){echo '
<link rel="stylesheet" type="text/css" href="';echo $v;echo '" />
';}}echo '
';}else{echo '
<link href="http://damaihu.tertw.net/css/bbs/bbs.css" rel="stylesheet" type="text/css" />
';}echo '
<script type="text/javascript" src="http://damaihu.tertw.net/javascript/jquery.min.js"></script><script type="text/javascript" src="http://damaihu.tertw.net/javascript/common.func.js"></script>
';if($jsList){foreach($jsList as $v){echo '
<script type="text/javascript" src="';echo $v;echo '"></script>
';}}echo '
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
</head>
<body>
	<!--头部开始-->
	<div id="dmh_head">
	<div class="kd">
	    <div class="kmain">
			<div class="hy">
				<a href="###" class="dmhtel">手机版</a>
				';if($memberLogined){echo '
				<DIV style="float: left;">
                    <SPAN style="color:#1595DE">|</SPAN>
                    <A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info/?username=';echo $member['username'];echo '">';echo $member['username'];echo '</A>
                    <IMG title="积分：';echo $memberFields['credits'];echo '" alt="积分" src="';echo $memberLevel['icon'];echo '">
                    <A class="col3" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/logout/">退出</A>	
                    </div>
				';}else{echo '亲，欢迎来到';echo $web_name;echo '
				<div style="float:left;">
				    <SPAN style="color:#1595DE">|</SPAN>
					<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/login/" class="chengse">登录</a>
					<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/reg/" class="lvse">免费注册</a>
				</div>
				  ';}echo '	
			</div>
			<div class="top_btn">
			
			';if($memberLogined){echo '
			<ul class="quick-menu">
			 <LI class="menu-item">
                <DIV class="menu">
                 <A style="margin: 0px; width: 50px;" class="menu-hd" tabIndex="0" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/eids/">单号搜索<b></b></A>
                <DIV style="width: 88px; line-height: 1.7;" id="menu-0" class="menu-bd">
                <DIV style="padding: 8px 5px;" class="menu-bd-panel">
                <A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t730/" rel="nofollow" target="_top">使用教程</A>
                <A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t730/" rel="nofollow" target="_top">如何激活</A></DIV>
                </DIV></DIV>
			 </LI>
 
               <LI style="margin-top: -2px;">|</LI>
               <LI class="menu-item">
                <DIV class="menu"><A style="margin: 0px;" class="menu-hd" tabIndex="0" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/">存款：<b></b>
                <SPAN style="font-weight: 700;" class="chengse moneyAll">';echo $memberFields['money'];echo '</SPAN></A>
                <DIV style="width: 88px; line-height: 1.7;" id="menu-0" class="menu-bd">
                <DIV style="padding: 8px 5px;" class="menu-bd-panel">
                <A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/" rel="nofollow" target="_top">账号充值</A>
                <A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/PayDetails/?type=1" rel="nofollow" target="_top">存款明细</A></DIV>
                </DIV></DIV>
			   </LI>
               <LI style="margin-top: -2px;">|</LI>
                <LI class="menu-item">
               <DIV class="menu"><A style="margin: 0px;" class="menu-hd" tabIndex="0" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/BuyPoint/">麦点：<b></b>
                <SPAN style="font-weight: 700;" class="chengse moneyAll"></SPAN>';echo $memberFields['fabudian'];echo '</A>
                <DIV style="width: 88px; line-height: 1.7;" id="menu-0" class="menu-bd">
                <DIV style="padding: 8px 5px;" class="menu-bd-panel">
                <A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/BuyPoint/" rel="nofollow" target="_top">购买麦点</A>
                <A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/PayDetails/?type=2" rel="nofollow" target="_top">麦点明细</A>
           </DIV></DIV></DIV>
		   </LI>
           <LI style="margin-top: -2px;">|</LI>
           <LI class="menu-item">
           <DIV class="menu">
           <A style="margin: 0px;" class="menu-hd" tabIndex="0" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/">信息：<b></b>
           <SPAN style="font-weight: 700;" class="chengse moneyAll">(';echo $memberFields['msg'];echo ')</SPAN></A>
           <DIV style="width: 90px; line-height: 1.7;" id="menu-0" class="menu-bd">
           <DIV style="padding: 8px 5px;" class="menu-bd-panel">
           <A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=inUser" rel="nofollow" target="_top">私人收件箱</A>
          <A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=inSys" rel="nofollow" target="_top">官方收件箱</A>
          <A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=setting" rel="nofollow" target="_top">站内提醒</A>
          </DIV></DIV>
          </DIV>
          </LI>
					<li style="margin-top: -2px;">|</li>
					<li class="menu-item">
						<div class="menu">
							<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/userdata/?type=index" style="width:52px;margin:0;" class="menu-hd" tabindex="0">账号设置<b></b></a>
							<div style="width: 90px;line-height:1.7;" class="menu-bd" id="menu-0">
							  <div style="padding:8px 5px;" class="menu-bd-panel">
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/forgotpwd/">找回密码</a>
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/userdata/?type=GetPass">找回操作码</a>
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/forgotpwd/">更多操作</a>
							  </div>
							</div>
						</div>
					</li>
					
				
			</ul>
			';}else{echo '
			
				<ul class="quick-menu">
					<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/help/" style="float:left;margin-top: -1px;"><b>新手帮助</b></a>
					<li style="margin-top: -2px;">|</li>
					<li class="menu-item">
						<div class="menu">
							<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/eids/" style="width:50px;margin:0;" class="menu-hd" tabindex="0">单号搜索<b></b></a>
							<div style="width: 88px;line-height:1.7;" class="menu-bd" id="menu-0">
							  <div style="padding:8px 5px;" class="menu-bd-panel">
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t730/">使用教程</a>
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t730/">如何激活</a>
							  </div>
							</div>
						</div>
					</li>
					<li style="margin-top: -2px;">|</li>
					<li class="menu-item">
						<div class="menu">
							<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/userdata/?type=index" style="width:52px;margin:0;" class="menu-hd" tabindex="0">账号设置<b></b></a>
							<div style="width: 90px;line-height:1.7;" class="menu-bd" id="menu-0">
							  <div style="padding:8px 5px;" class="menu-bd-panel">
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/forgotpwd/">找回密码</a>
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/userdata/?type=GetPass">找回操作码</a>
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/forgotpwd/">更多操作</a>
							  </div>
							</div>
						</div>
					</li>
					<li style="margin-top: -2px;">|</li>
					<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/rank.html" style="margin-top: -2px;">大麦户排行榜</a>	
				</ul>
				 ';}echo '	
			</div>
		</div>
		<div class="menu_qq">
		<a class="qq_help" onmouseover="showcsqq();" href="javascript:;">客服帮助</a>
		</div>
		<div id="service_qq" class="help_down" style="display:none;"></div>
	</div>
</div>
	<!--logo开始-->

	<div id="m_logo">
		<a href="/" class="logo"><img src="';echo $web_logo;echo '" alt="大麦户_淘宝刷信誉" /></a>
		<a href="default/DmSEO.html" class="gg" target="_blank"><img src="/images/bkzl.jpg" alt="爆款教程" title="爆款教程" height="67" border="0" width="689"></a>
	</div>
<!--头部结束-->
<!--菜单开始-->
<div id="m_menu" style="position:relative; z-index:2;">
	  <div class="menu_nav">
		
			<ul class="m_menu_nav">
			<li><a ';if($action=='index'){echo ' class="current"';}echo ' href="';echo $weburl2;echo '">首页</a></li>
			<li><a ';if($action=='task'&&$operation=='tao'){echo ' class="current"';}echo ' href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/tao/">淘宝大厅</a></li>
			<li><a ';if($action=='task'&&$operation=='pai'){echo ' class="current"';}echo ' href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/pai/">拍拍大厅</a></li>
			<li><a ';if($action=='collect'&&$operation=='collect'){echo ' class="current"';}echo ' href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/collect/">收藏流量</a></li>
	       <li><a ';if($action=='BuyPoint'&&$operation=='BuyPoint'){echo ' class="current"';}echo ' href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/BuyPoint/">购买麦点</a></li>
			<li><a ';if($action=='tuoguan'&&$operation=='tuoguan'){echo ' class="current"';}echo ' href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/tuoguan/">网店托管</a></li>
			<li><a ';if($action=='tbseo'&&$operation=='tbseo'){echo ' class="current"';}echo ' href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/tbseo/">淘宝推广</a></li>
			<li><a ';if($action=='bbs'){echo ' class="current"';}echo ' href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/">有问必答</a></li>
			<li><a ';if($action=='member'){echo ' class="current"';}echo ' href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/">会员中心</a></li>
			</ul>
		  
	  </div>
</div>
<script type="text/javascript" src="/images/jquery.js"></script>
<script type="text/javascript" src="/images/common.js"></script>
<script type="text/javascript" src="/images/index.js"></script>
<script type="text/javascript" src="/javascript/index/task.js"></script>
<!--[if lte IE 6]>
<script type="text/javascript" src="/javascript/cn/DD_belatedPNG_0.0.7a.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix(\'*\');
</script>
<![endif]-->

    <script type="text/javascript" src="/images/service.js"></script>

<script>

var z_userinfo = $.cookie(\'userinfo\');
if (z_userinfo){';echo '
	z_userinfo = z_userinfo.split(\',\');
';echo '}else
	z_userinfo=null;
</script>
<script type="text/javascript">

$(\'#tool_footer\')
	.css({';echo '
	    \'top\': $(window).height()-270,
		\'left\':"auto",
	    \'right\': ($(window).width() - 1000)>0?($(window).width() - 1000)/2-$(\'#tool_footer\').width()-5:0 ,
		\'position\':"fixed"
	';echo '});
function To_top(){';echo '
    $("html,body").animate({';echo 'scrollTop: $("#m_menu").offset().top';echo '}, 100);
';echo '}
</script>
<script type="text/javascript">
$(function(){';echo '
	$(".menu-item .menu-hd").hover(function(){';echo '
		$(this).next(\'#menu-0\').show();
		$(this).children(\'b\').css({';echo 'borderColor:\'#666666 white white\',transform:\'rotate(180deg\',transformOrigin:\'50% 30% 0px\'';echo '});
		$(this).parents(".menu-item").css({';echo 'background:\'rgb(255, 255, 255)\',border:\'1px solid rgb(191, 191, 191)\'';echo '})
	';echo '});
	$(".menu-item .menu").mouseleave(function(){';echo '
		$(this).children(\'#menu-0\').hide();
		$(this).children(\'.menu-hd\').children(\'b\').css({';echo 'borderColor:\'#666666 #EFF6FE #EFF6FE\',transform:\'none\',transformOrigin:\'none\'';echo '});
		$(this).parent(".menu-item").css({';echo 'background:\'none\',border:\'1px solid #EFF6FE\'';echo '})
	';echo '}); 
';echo '})	
</script>
</body>';echo '
<link rel="stylesheet" type="text/css" href="/images/task.css">
<style type="text/css">
.kd a:hover {';echo ' text-decoration:underline;';echo '}
.link_tt{';echo ' display:block; width:52px; height:22px;color:#a68d8b; background:url(/images/buyers_btn.png) no-repeat; margin-bottom:2px;';echo '}
</style>
<style type="text/css">
.bq_menu{';echo '
	height:32px;
	background:url(/images/fy_ico.jpg) 0 -1342px repeat;
	';echo '}
.bq_menu a{';echo '
	float:left;
	margin-right:3px;
	background:url(/images/fy_ico.jpg)  -4px -806px no-repeat;
	display:block;
	font-size:14px;
	text-align:center;
	width:96px;
	height:32px;
	line-height:30px;
	';echo '}
.bq_menu a:hover,.bq_menu a.nov{';echo '
	background:url(/images/fy_ico.jpg)  -4px -758px no-repeat;
	font-weight:bold;
	';echo '}
.mh_bdbtn2 {';echo 'margin-left:218px;';echo '}
.tx_jl{';echo '
	background:url(/images/tx_btn.gif) 0 -187px no-repeat;
	height:30px;
	line-height:30px;
	font-size:14px;
	font-weight:bold;
	text-indent:25px;
	';echo '}
.txjl_bg1{';echo 'background:url(/images/tx_btn.gif) 0 -225px no-repeat;';echo '}
.txjl_bg2{';echo '
	background:url(/images/tx_btn.gif) 0 -264px repeat-x;
	color:#1996e6;
	font-size:14px;
	font-weight:bold;
	';echo '}
.txjl_bg3{';echo 'background:url(/images/tx_btn.gif) right -303px no-repeat';echo '}
</style>
<div id="content">
	<div class="taobaopage_detail">
<style type="text/css">
.gold .yred {';echo ' color:#D61810;';echo '}
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

		';echo '<div class="rwdt_menu">
  <a href="';echo $baseUrl;echo '"';if($m=='index'){echo ' class="nov" ';}echo ' title="淘宝任务大厅">淘宝任务大厅</a>
  <a href="';echo $baseUrl;echo '?m=taskIn" ';if($m=='taskIn'){echo ' class="nov" ';}echo ' title="已接任务">已接任务</a>
  <a href="';echo $baseUrl;echo '?m=taskOut" ';if($m=='taskOut'){echo ' class="nov" ';}echo ' title="已发任务">已发任务</a>
  <a href="';echo $baseUrl;echo '?m=tieBuyer" ';if($m=='tieBuyer'){echo ' class="nov" ';}echo ' title="绑定买号">绑定买号</a>
  <a href="';echo $baseUrl;echo '?m=tieSeller" ';if($m=='tieSeller'){echo ' class="nov" ';}echo ' title="绑定掌柜">绑定掌柜</a>
</div>





';echo '
	<div class="cle"></div>
		<div class="lst_info" style="background:none;">
		  ';if($_showmessage){echo '<div class=\'error_panel\'><div>';echo $_showmessage;echo '</div></div>';}echo '
	';if($indexMessage){echo '<div class=\'error_panel\'><div>';echo $indexMessage;echo '</div></div>';}echo '
	<div class="mh_tishi">
				1、该页面主要用来绑定和维护用来接任务，购买任务商品的淘宝买号；  <a href="/bbs/t24/" class="chengse">什么是买号？</a><br>
2、根据淘宝的最新安全策略，所有买号都要求必须是完整填写个人信息后才能进行绑定；为了您的买号与任务发布方网店安全请您先将买号信息完善； <a href="/bbs/t71/" class="chengse">如何更安全的使用买号?</a><br>
3、注册的淘宝买号请不要使用同一个开头，后面跟一串排号的数字，这种买号很容易被淘宝封(类似短命的买号就是 shua001，shua002，shua003......） <br>
4、一个买号一天只可以接手6个任务，接手高于6个任务，系统将挂起买号，第二天才进行继续接手任务<br>
			</div>
			<div class="bq_menu">
				<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/tao/?m=tieBuyer" ';if($action=='task'&&$operation=='tao'){echo ' class="nov" ';}echo '>绑定淘宝买号</a>
				<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/pai/?m=tieBuyer" ';if($action=='task'&&$operation=='pai'){echo ' class="nov" ';}echo '>绑定拍拍买号</a>
			</div>
            <form name="myForm" method="post" id="myForm" onsubmit="return checkForm();">
            <div>';echo $sys_hash_code2;echo '</div>
			<input name="px" value="1" type="hidden">
            <table style="margin-top:20px;font-size:14px;" align="center" border="0" cellpadding="0" cellspacing="0" width="95%">
              <tbody><tr>
                <td align="left" height="30" valign="middle" width="20%"><span class="mh_taobao"></span></td>
              </tr>
			 
	          
              <tr>
                <td align="left" height="40" valign="middle" width="20%"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tbody><tr>
                    <td width="138">淘宝买家帐号：</td>
                    <td width="196"><input name="nickname" class="mh_bk" id="nickname" type="text"></td>
                    <td width="618">&nbsp;</td>
                  </tr>
                </tbody></table></td>
              </tr>
              <tr>
                <td align="left" height="60" valign="middle">    
				<input class="mh_bdbtn" name="btnSave" type="submit"></td>
              </tr>
			  
              <tr>
                <td class="mh_xian" align="left" height="40" valign="middle" width="20%">您目前是';echo $user_group['name'];echo '用户，可以绑定';echo $maxTieCount;echo '个买号！ <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/vip/" class="chengse2">申请VIP</a>最高可绑定100个买号！ <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/vipinfo/" target="_blank" class="lanse">查看VIP限权</a></td>
              </tr>
            </tbody>
			</table>
			</form>
			<form name="pxform" method="post" id="pxform">
			<div>';echo $sys_hash_code2;echo '</div>
			<input name="px" value="2" type="hidden">
	        <table align="center" border="0" cellpadding="0" cellspacing="0" width="95%">
              <tbody>
			  <tr>
                <td style="padding-bottom:10px;" height="15">每次登陆绑定买号页面，我们会为您自动更新买号信息（包括认证是否实名，买号动态等）。</td>
              </tr>
              <tr>
                <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tbody><tr>
                    <td class="txjl_bg1" height="37" width="10"></td>
                    <td class="txjl_bg2" style="color:#333;" align="center" height="37" valign="middle" width="12%">淘宝账号</td>
                    <td class="txjl_bg2" style="color:#333;" align="center" height="37" valign="middle" width="20%">初始信誉-现信誉</td>
                    <td class="txjl_bg2" style="color:#333;" align="center" height="37" valign="middle" width="23%">当日/本周/已完成任务数</td>
                    <td class="txjl_bg2" style="color:#333;" align="center" height="37" valign="middle" width="10%">买号状态</td>
                    <td class="txjl_bg2" style="color:#333;" align="center" height="37" valign="middle" width="10%">买号排序</td>
					<td class="txjl_bg2" style="color:#333;" align="center" height="37" valign="middle" width="10%">是否启用</td>
					<td class="txjl_bg2" style="color:#333;" align="center" height="37" valign="middle" width="13%">操作</td>
                    <td class="txjl_bg3" height="37" width="10"></td>
                  </tr>
				 ';if($bList){foreach($bList as $v){echo ' 
                  <tr>
                    <td>&nbsp;</td>
                    <td class="mh_xxian" align="center" height="35" valign="middle"><span class="p_l_20">';echo $v['nickname'];echo '</span></br>';if($v['isreal']){echo '<span class="rwdt_yq21" title="支付宝实名认证">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';}echo '</td>
                    <td class="mh_xxian" align="center" valign="middle">';echo $v['score0'];echo ' ';echo $v['score0_ico'];echo '/';echo $v['score'];echo ' ';echo $v['score_ico'];echo ' </td>
                    <td class="mh_xxian" align="center" valign="middle">';echo $v['todayTask'];echo '/';echo $v['tswkTask'];echo '/';echo $v['task'];echo '</td>
                    <td class="mh_xxian" align="center" valign="middle">
		  ';if($v['status']==5){echo '
		  <span class=\'lvse2\'>已暂停[';echo time::days($timestamp-$v['pauseTimestamp']);echo '天]</span>
		  ';}else{echo '
		  ';echo $lang['bStatus'][$v['status']];echo '
		  ';}echo '
		  ';if($v['status']<=1){echo '
          <a href="javascript:;" onclick="return IsStopAcc(this,';echo $v['id'];echo ');" class="lvse2">暂停</a>
		  ';}elseif($v['status']==5){echo '
		  <a href="javascript:;" onclick="return IsResumeAcc(this,';echo $v['id'];echo ');" class="lvse2">恢复</a>
		  ';}echo '
		</td>
                    <td class="mh_xxian" align="center" valign="middle"><input size="3" name="pxvar[]" value="0" class="mh_bk2" type="text">
		<input value="';echo $v['id'];echo '" name="idarr[]" <="" td="" type="hidden">
                    </td><td class="mh_xxian" align="center">
		<input checked="checked" onclick="return IsStopAcc(this,';echo $v['id'];echo ');" type="checkbox">
		</td>
					<td class="mh_xxian" align="center">
					';if($v['status']!=6){echo '
					<a href="javascript:;" onclick="dialog(650,500,\'设置买号收货地址\',\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/dialog/buyerAddress/?id=';echo $v['id'];echo '\');return false;" class="link_tt">收货地址</a>
					';}echo '
					';if($v['status']==0){echo '
			        <a href="javascript:;" onclick="return IsDelAcc(this,';echo $v['id'];echo ');" class="mh_cz">删除</a>
                     ';}echo '
					</td>
					<td>&nbsp;</td>
                  </tr>
                  ';}}echo '
				 
				</tbody></table></td>
              </tr>
              <tr>
                <td align="left" valign="middle"><input class="mh_xg" type="submit"></td>
              </tr>
            </tbody></table>
		</form>
            <div class="rwdt_dlm">
			  <div id="page">
';echo $multipage;echo '
			  </div>
			</div>
			<div class="cle"></div>
			<!--结束-->
			</div>	
	</div><!--taopage_detail end-->
</div>
<div class="cle"></div>
<link type="text/css" rel="stylesheet" href="/images/jcalendar.css">
<script type="text/javascript" src="/images/artDialog.js"></script>
<script type="text/javascript">
function IsDelAcc(obj, id) {';echo '
  if (confirm("您确定要删除此买号么？\\n\\n删除后，任何平台账号都将无法再次绑定此买号！")) {';echo '
    obj.href=\'';echo $thisUrl;echo '&del=\' + id;
    return true;
  ';echo '} else {';echo '
    return false;
  ';echo '}
';echo '}
function IsCollect(obj, id) {';echo '
  if (confirm(\'您确定要将此买号置为收藏买号么？\\n\\n收藏买号仅仅用于收藏，不能用于刷信誉的任务\')) {';echo '
    obj.href=\'';echo $thisUrl;echo '&setCollect=\'+id;
    return true;
  ';echo '} else {';echo '
    return false;
  ';echo '}
';echo '}
function IsStopAcc(obj, id) {';echo '
	if (confirm(\'您确定要将此买号置为暂停买号么？\\n\\n暂停后的买号不能用于绑定到接手的任务\')) {';echo '
    obj.href=\'';echo $thisUrl;echo '&pause=\'+id;
    return true;
  ';echo '} else {';echo '
    return false;
  ';echo '}
';echo '}
function IsResumeAcc(obj, id) {';echo '
	if (confirm(\'您确定要恢复此买号么？\')) {';echo '
    obj.href=\'';echo $thisUrl;echo '&resume=\'+id;
    return true;
  ';echo '} else {';echo '
    return false;
  ';echo '}
';echo '}
function sltAll(obj) {';echo '
    var boxs = document.getElementsByName("accId");
    for (var i = 0; i < boxs.length; i++) {';echo '
        boxs[i].checked = obj.checked;
    ';echo '}
';echo '}
function resumeMore(obj) {';echo '
    var s = "";
    var boxs = document.getElementsByName("bIds");
    for(var i=0; i<boxs.length; i++) {';echo '
        if (boxs[i].checked)
            s += boxs[i].value + ",";
    ';echo '}
    if (s == ""){';echo '
        alert("请选择买号");
        return false;
    ';echo '}
    if (confirm(\'您确定要恢复买号么？\')) {';echo '
        obj.href=\'';echo $thisUrl;echo '&resumeMore=\'+s;
        return true;
    ';echo '} else {';echo '
        return false;
    ';echo '}
';echo '}

function checkForm() {';echo '
  var checks = [
  ["isLength", "nickname", "淘宝买家号", 1, 20] ];
	var result = doCheck(checks);//用的是common.js中的方法  检查长度是否够长

	if (result)
		return avoidReSubmit();
	return result;
';echo '}
</script>

 ';echo '<div id="footer">
		<p><span class="chengse">官方QQ号码：1371752337</span> （加群请注明大麦户）</p>
		<p class="lanse"><a href="#">关于我们</a>|<a href="#">联系我们</a>|<a href="#">大麦户规则</a>|<a href="#">网站地图</a>|<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '" target="_blank">淘宝信誉查询</a> </p>
		<p style="text-align:center;">
	
		<p class="lanse">客户服务热线：02968929109   Copyright © 2012-2020 Damaihu.com All RightsReserved    大麦户版权所有 <a href="#" target="_blank">粤ICP备13037934号</a><span style="display:none">
</span></p>
	</div>
	</div>
    </div>';?>