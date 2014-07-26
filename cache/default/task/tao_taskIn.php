<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\task\tao_taskIn.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\task\tao_info.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\quick.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\task\tab.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\task\tao_taskIn.htm','D:\damaihu\xinyupingtai7\cache\default\task\tao_taskIn.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/task/';$cssList=array(0=>'http://damaihu.tertw.net/css/task/task.css');$jsList=array(0=>'http://damaihu.tertw.net/javascript/index/task.js');echo '
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
<script type="text/javascript" src="/images/jquery.js"></script>
<style type="text/css">
.kd a:hover {';echo ' text-decoration:underline;';echo '}
.link_t {';echo ' display:block; width:52px; height:22px;color:#a68d8b; background:url(/images/buyers_btn.png) no-repeat; margin-bottom:2px;';echo '}
#showtask {';echo ' margin:0 auto; width:940px;';echo '}
.yf_review {';echo 'background: url(/images/yfrw_zjpl.jpg) no-repeat;display: block;height: 30px; text-align:center; line-height:30px; width: 67px;overflow: hidden;';echo '}
.yf_review:hover{';echo 'background:url(/images/yfrw_zjpl_hov.jpg) no-repeat;';echo '}
.rwdt_xx .task_search {';echo 'position: absolute; right: 20px; top: 55px;';echo '}
.rwdt_xx .task_search input {';echo 'height:25px;line-height:25px; border:1px #cedede solid; width:192px; text-indent:5px; color:#b0afae;';echo '}
.rwdt_xx .task_search .search {';echo 'background:#fff5e1;border:1px solid #dcca9c;color:#333;display:inline-block; padding:0 7px;margin:0px 5px 0px 10px;height:25px;line-height:25px;text-align:center;';echo '}
.rwdt_xx .rwdt_sort {';echo 'left: 10px; position: absolute;top: 66px;';echo '}
.rwdt_xx .rwdt_sort2 {';echo 'left: 90px; position: absolute;top: 66px;';echo '}
.rwdt_xx .rwdt_sort2  li a{';echo 'width:85px;';echo '}
.rwdt_xx .rwdt_sort a, .rwdt_xx .rwdt_sort2 a {';echo '
    color: #3372A2;
    display: inline-block;
    height: 25px;
    line-height: 25px;
    text-align: center;
    z-index: 1;
';echo '}
.rwdt_marquee {';echo 'position: absolute;width:680px;top:9px;';echo '}
.rwdt_marquee_close {';echo 'position: absolute;font-size:14px; font-weight:700;left:705px; top:9px;cursor:pointer;';echo '}
.rwdt_dexpress{';echo 'background:url(/images/tx_ico_28.png) no-repeat;float:left;display:block;width:145px;text-indent:20px;height:17px;line-height:17px;color:#333;';echo '}
.yf_wexpress{';echo 'background: url(/images/tx_ico_2013530xy.png) no-repeat;display: block;height: 30px;text-align: center;line-height: 30px;width: 158px;overflow: hidden;';echo '}
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
		<div class="rwdt_gg"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/userjob/" target="_blank"><img src="/images/taobaoke.jpg"></a></div>
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
<script language="javascript">
	$(function(){';echo '
		$(\'#btnQuery\').click(function(){';echo '
			var sid=$(\'#sid\').val();
			if (sid) sid = \'&sid=\'+sid;
			var susername=$(\'#susername\').val();
			if (susername) susername = \'&susername=\'+susername;
			var sqq=$(\'#sqq\').val();
			if (sqq) sqq = \'&sqq=\'+sqq;
			var bnickname=$(\'#bnickname\').val();
			if (bnickname) bnickname = \'&bnickname=\'+bnickname;
			location.href=\'';echo $thisUrl;echo '&t=\'+$(\'#status\').val()+sid+susername+sqq+bnickname;
		';echo '});
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
<div class="rwdt_xx">
		    <p class="rwdt_marquee_close" onclick="marquee_close();">X</p>
		    <p class="rwdt_marquee"><marquee onmouseover="this.stop()" onmouseout="this.start()" height="18" width="100%">　<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t4492/" style="color:red;" target="_blank">接手方容易造成损失的几大误区</a></marquee></p>
			<ul class="yfrw_sub">
				<li><a  href="javascript:;" onclick="window.location.href=\'';echo $thisUrl;echo '&t=ing\'" ';if($t=='ing'){echo ' class="nov" ';}echo '>可处理(';echo $memberTask['ining1'];echo ')</a></li>
				<li><a href="javascript:;" onclick="window.location.href=\'';echo $thisUrl;echo '&t=tWatting2\'"';if($t=='tWatting2'){echo ' class="nov" ';}echo '>等待付款发货(0)</a></li>
				<li><a href="javascript:;" onclick="window.location.href=\'';echo $thisUrl;echo '&t=expire\'"';if($t=='expire'){echo ' class="nov" ';}echo '>等待收货好评(';echo $memberTask['inExpire'.$taskId];echo ')</a></li>
				<li><a href="javascript:;" onclick="window.location.href=\'';echo $thisUrl;echo '&t=complate\'" ';if($t=='complate'){echo ' class="nov" ';}echo '>已完成任务(';echo $memberTask['inComplate'.$taskId];echo ')</a></li>
				<li><a href="javascript:;" onclick="window.location.href=\'';echo $thisUrl;echo '&t=all\'" ';if($t=='all'){echo ' class="nov" ';}echo '>全部任务(';echo $memberTask['in1'];echo ')</a></li>
			</ul>
			<div class="rwdt_btn"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/tao/?m=add" class="fb_btn"></a><a href="javascript:;" onclick="goPage(1);" class="sx_btn"></a></div>
            
			<div class="rwdt_sort">
            <ul>
              <li>
              <a href=\'javascript:getTask("t=ing&amp;bsort=1")\'>按买号排序</a>
              </li>
            </ul>
            </div>
            <div class="rwdt_sort2">
              <ul>
                <li>
                <a href=\'javascript:getTask("t=ing&amp;bsort=0")\'>按接手时间排序</a>&nbsp;&nbsp;&nbsp;
                <a href=\'javascript:getTasksort("ing")\'>按收货时间排序</a>&nbsp;&nbsp;&nbsp;
                </li>
              </ul>
            </div>
			<div class="task_search">
			<input name="task_keys" id="task_keys" onclick="if(this.value.indexOf(\'搜索任务ID\') >= 0)this.value=\'\';" value="搜索任务ID,掌柜,买号,QQ" type="text"><a href="javascript:;" class="search" onclick="task_search();">搜索</a></div>
		</div>
	<div class="cle"></div>
		<div class="taobaopage_detail" id="taskList">			<!--开始-->
  <div class="cle"></div>
   	    <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody><tr>
            <td class="rwdt_bt1" align="center" height="39" valign="middle" width="10"></td>
            <td class="rwdt_bt2" align="center" valign="middle" width="200">任务编号</td>
            <td class="rwdt_bt2" align="center" valign="middle" width="12%">任务价格</td>
            <td class="rwdt_bt2" align="center" valign="middle" width="18%">发布者要求</td>
            <td class="rwdt_bt2" align="center" valign="middle" width="12%">悬赏麦点</td>
            <td class="rwdt_bt2" align="center" valign="middle" width="12%">任务状态</td>
            <td class="rwdt_bt2" align="center" valign="middle" width="1%"></td>
            <td class="rwdt_bt2" align="center" valign="middle" width="24%">操作</td>
            <td class="rwdt_bt3" align="center" valign="middle" width="10"></td>
          </tr>
        </tbody></table>
        ';$allPrice=0;echo '
        ';$allPoint=0;echo '
		';if($tList){foreach($tList as $v){echo '
        <table class="yfrw_list" border="0" cellpadding="0" cellspacing="0" width="100%">
		  <tbody>
          <tr>
            <td class="yf_pd2" width="180"><span ';if($v['isCart']){echo ' class="rwdt_bh7" title="购物车任务—';echo $v['shopCount'];echo '个商品" ';}elseif($v['isExpress']){echo ' class="task_express" title="真实快递任务—';echo $v['shopCount'];echo '个商品" ';}elseif($v['visitWay']){echo ' class="rwdt_bh3" title="来路任务" ';}elseif($v['times']==0){echo ' class="rwdt_bh1" title="虚拟任务" ';}elseif($v['times']>=1){echo ' class="rwdt_bh2" title="实物任务" ';}echo '  ><strong class="system1">';echo $v['id'];echo '</strong></span><p class="cle"></p>
            <span class="block">发布时间：';echo date('m-d H:i:s',$v['stimestamp']);echo '</span><span class="rwdt_xbh0">发布方:<a class="comlink" title="接任务后方可查看到对方QQ号码" target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info/?username=';echo urlencode($v['susername']);echo '">';echo $v['susername'];echo '</a></span></td>
            <td class="yf_pd2" width="90"><span ';if($v['isPriceFit']){echo ' class="rwdt_xgj" ';}else{echo ' class="rwdt_db" ';}echo '>';echo $v['price'];echo '</span></td>
            <td class="noktime" width="23%">
			<p ';if($v['times']==0){echo 'class="yred" ';}else{echo ' class="lvse" ';}echo 'title="任务接手付款后，';echo $lang['times'][$v['times']];echo '立即对宝贝进行收货好评！">';echo $lang['times'][$v['times']];echo '</p>
			';if($v['isVerify']){echo '<em title="接任务者需要发布者核审" class="rwdt_yq1">&nbsp;</em>';}echo '
			';if($v['isChat']){echo '<em title="任务需要旺旺模拟咨询再拍下" class="rwdt_yq4">&nbsp;</em>';}echo '
			';if($v['ispinimage']){echo ' <em title="接任务者需要上传好评图片" class="rwdt_yq6">&nbsp;</em>';}echo '
			';if($v['isRemark']){echo '<em title="按发布者提供的评语进行评价" class="rwdt_yq2">&nbsp;</em>';}echo '
			';if($v['isReal']){echo '<em title="接手买号必须通过了支付宝实名认证" class="rwdt_yq21">&nbsp;</em>';}echo '
			';if($v['isAddress']){echo '<em class="rwdt_yq3" title="任务需要指定收货地址">&nbsp;</em>';}echo '
			';if($v['isLimitCity']){echo '<em class="rwdt_yqip" title="要求接手方地址是...">&nbsp;</em>';}echo '
			';if($v['isShare']){echo '<em title="好评后对宝贝进行分享" class="rwdt_yq20">&nbsp;</em>';}echo '
			';if($v['isChatDone']){echo '<em title="任务需要模拟聊天后确认收货" class="rwdt_yq17">&nbsp;</em>';}echo '
			</td>
            <td class="yf_pd" align="center" width="120"><span class="chengse"><strong>';echo $v['point'];echo '个麦点</strong></span></td>
            <td class="yf_pd" align="center" width="120">
            ';if($v['complain']){echo '
				<span class="chengse">申诉裁定中,任务锁定</span>
			';}else{echo '
            <span class="chengse"><strong>';echo $lang['status'][$v['status']];echo '</strong></span>
			';}echo '
            </td>


        <td class="yf_pd2" style="padding:0px;" align="right" valign="top" width="240">

		<div style="height:30px; position:relative; top:5px;" id="';echo $v['id'];echo '">
		';if(!$v['bid']){echo '<a href="javascript:;" onclick="dialog(550,460,\'绑定买号\',\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/dialog/chooseBuyer/?sid=';echo $v['id'];echo '\');return false;" class="yf_buyer">绑定买号</a>
		接手方剩余<script type="text/javascript">flesh Time(';echo 180-$v['runTimestamp'];echo ')</script>钟可绑定买号
		';}echo '
		';if($v['status']==3){echo '
		<a class="yf_ico1" onclick="return copyComment(\'';echo $v['itemurl'];echo '\')" href="javascript:;">等待发布方审核</a>
		<script type="text/javascript">IsOutTask(';echo $v['runTimestamp'];echo ', "';echo $v['id'];echo '");</script>
		';}elseif($v['status']==4){echo '
		';if($v['visitWay']&&$v['isVisit']==0){echo '

		<a href="javascript:;" onclick="dialog(650,450,\'查看商品详情\',\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/dialog/taskVisitWay/?sid=';echo $v['id'];echo '\');return false;" class="yf_ico2 float_r"></a>
		';}else{echo '
		<a href="';echo $thisUrl;echo '&pay=';echo $v['id'];echo '" class="yf_payfor1 float_r" onclick="return IsPayTask(\'淘宝\',';echo $v['times'];echo ')">已经支付</a>
		<a style="margin-right:7px;" class="yf_ico3 float_r" onclick="return copyComment(\'';echo $v['itemurl'];echo '\')" href="javascript:;"></a>
		';}echo '
		';}elseif($v['status']==7){echo '
		<a href="';echo $thisUrl;echo '&unpay=';echo $v['id'];echo '" class="yf_hwfk" onclick="return IsUnpayTask(\'淘宝\')">还未支付</a>
		';}elseif($v['status']==8){echo '
		';if($v['runTimestamp3']<=0){echo '
		<a href="';echo $thisUrl;echo '&receive=';echo $v['id'];echo '" class="yf_haopinsh" onclick="return IsReceiveTask(\'淘宝\', ';echo $v['isRemark'];echo ', 0, ';echo $v['isShare'];echo ')">我已收货</a>
		';}echo '
		';if($v['runTimestamp3']>0){echo '
		<span class=\'yf_wdshsj\'>等待收获</span>
		<font color="#fe5500">';echo time::hours($v['runTimestamp3']);echo '</font>小时后允许收货
		';}echo '
		';}elseif($v['status']==9){echo '
		<a class="yf_waito" href="';echo $thisUrl;echo '&confirm=';echo $v['id'];echo '" onclick="return IsConfirmTask(\'淘宝\')">等待卖家核实货款</a>
		';}elseif($v['status']==10){echo '
		<a href="javascript:;" onclick="dialog(600,500,\'';echo $web_name;echo '平台任务满意度评分\',\'/dialog/grade/?sid=';echo $v['id'];echo '\');return false;" style="margin-left:5px;" class="yf_pinjia float_r" title="给发布方打分" id="grade_';echo $v['id'];echo '">&nbsp;</a>
		<p style="clear:both; line-height:20px;height:20px;">评价状态：<font color="#fe5500">';echo $lang['cStatus'][$v['credit']];echo '</font></p>
		';}echo '
		</div>
		';if($v['status']==4){echo '
		 <p style="clear:both; line-height:30px;height:30px;">
			    剩余付款时间：<span class="lvse strong" id="iidd_1"><script type="text/javascript">flesh Time(';echo $v['runTimestamp2'];echo ')</script></span>
		</p>
		';}else{echo '
		<p style="clear:both; line-height:30px;height:30px;"></p>
		';}echo '
			<p class="task-border">
				联系对方：<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=';echo $v['qq'];echo '&site=qq&menu=yes">
<img border="0" src="http://wpa.qq.com/pa?p=2:';echo $v['qq'];echo ':41" alt="联系我" title="联系我">
</a><a href="javascript:;" onclick="dialog(460,460,\'给卖家发送手机短信\',\'/dialog/sendsms/?username=';echo urlencode($v['susername']);echo '\');return false;" title="给卖家发送手机短信" alt="给卖家发送手机短信" class="yf_sj"></a> |
				';if($v['isVerify']&&$v['status']==2){echo '<script type="text/javascript">IsOutTask(';echo $v['runTimestamp'];echo ', "';echo $v['id'];echo '");</script>';}elseif($v['status']<5){echo '<a href=\'';echo $thisUrl;echo '&out=';echo $v['id'];echo '\' class=\'yf_wz\' title="退出任务" onclick=\'return IsQuitTask();\'>退出</a>';}elseif($v['status']<9){echo '<a title="发起申诉" onclick="dialog(950,550,\'发起申诉\',\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/dialog/complain/?sid=';echo $v['id'];echo '\');return false;" class="comlink" href="javascript:;">申诉</a>|';}echo '<a href="javascript:;" style="background:url(/images/';if($v['b_memo']){echo 'memo.png';}else{echo 'bz_no.png';}echo ') no-repeat 8px; height:12px;top:2px;" onclick="ShowRemark(\'';echo $v['id'];echo '\',\'';echo $v['b_memo'];echo '\');" class="yf_bz"></a>
		    </p>
            </td>
            <td width="15">&nbsp;</td>
          </tr>

          <tr>
            <td colspan="9" class="yfrw_listxia" align="right" valign="middle">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
			  <tr>
                 <td style="padding-left:20px; color:#3372A2;" align="left" width="40%">不按规定修改地址、好评的的接手人将给予严厉处分
				 </td>
                <td align="left" width="40%">
				<span style="float:left;">
				<span class="yf_wwtx">
				</span>掌柜名：<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info.php?username=';echo $v['nickname'];echo '" class="comlink" title="查看掌柜信息">';echo $v['nickname'];echo '</a>
				</span>
				<span class="yf_wwtx"></span>
				<span style="float:left;">采用买号：
				<span class="lvse3">
				<a href="#" class="comlink" target="_blank" title="查看买号信息">';if($v['bid']){echo '';echo $v['bnickname'];echo ' ';echo $v['bico'];echo '';}echo ' </a>
				</span>
				</span>
				</td>
                ';if(!$v['visitWay']&&!$v['isCart']){echo '<td align="left" width="12%"><a href="javascript:;" onclick="return copyComment(\'';echo $v['itemurl'];echo '\')" class="vse3 strong">查看淘宝商品</a></td>
				';}echo '
              </tr>
			  ';if($v['cbxIsTip']){echo '
		  <tr>
                <td class="yf_ts1" height="40" colspan="9"><span class="yf_mjly"></span><span class="chengse strong" style="color:##FE5500;">';echo $v['tips'];echo '</span></td>
          </tr>
		  ';}echo '
		  ';if($v['isRemark']){echo '
		  <tr>
                <td colspan="9" class="yf_ts2" align="right" valign="middle">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
			  <tr>
			    <td style="padding-left:0px; color:#3372A2;"  align="left" width="85%">
				<span class="yf_gdhp"></span>
				<span class="chengse strong" style="color:#FE5500;">';echo $v['remark'];echo '</span>
				<span class="chengse strong"></span>
				</td>
                <td align="right" width="15%">　

				<span class="in_block"><a href="javascript:;" onclick="return copyComment(\'';echo $v['remark'];echo '\')" class="yf_fz1"></a>
				</span>
				</td>
              </tr>
             </tbody>
			</table>
			</td>
          </tr>
		  ';}echo '
';if($v['isAddress']){echo '
<td colspan="9" class="yf_ts2" align="right" valign="middle">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
			  <tr>
<td style="padding-left:0px; color:#3372A2;"  align="left" width="85%">
<span class="yf_gdsh"></span>
<span>姓名：</span>
<strong class="orange" style="color:red;">';echo $v['cbxName'];echo '</strong>
<span class="address-title">地址：</span>
<strong class="orange" style="color:red;">';echo $v['cbxAddress'];echo '</strong>
<span class="address-title">电话：</span>
<strong class="orange" style="color:red;">';echo $v['cbxMobile'];echo '</strong>
<span class="address-title">邮编：</span>
<strong class="orange" style="color:red;">';echo $v['cbxcode'];echo '</strong>
<span class="yf_fzhp"></span>
</td>
                <td align="right" width="15%">　

				<span class="in_block"><a href="javascript:;" onclick="return copyComment(\'';echo $v['cbxName'];echo ',';echo $v['cbxAddress'];echo ',';echo $v['cbxMobile'];echo ',';echo $v['cbxcode'];echo '\')" class="yf_fz2"></a>
				</span>
				</td>
              </tr>
             </tbody>
			</table>
</td>
';}echo '
        </tbody>
	</table>
</td>
          </tr>
		   </tbody>
		   </table>
		   ';$allPrice+=$v['price'];echo '
           ';$allPoint+=$v['point'];echo '
		   ';}}echo '
		
          
					
       
		<div style="padding-top:10px;">本页任务的资金合计：<span class="chengse">';echo $allPrice;echo '</span> 元　麦点合计：<span class="chengse">';echo $allPoint;echo '</span> 个</div>
			<div class="rwdt_dlm">
		
			<div id="page" style="margin:0px 10px 10px;">
				
		  </div>
		</div>

<div id="showtask" style="display:none;">
<div style="height:350px;"><iframe name="contentframe" id="contentframe" src="" frameborder="0" height="350" width="540" scrolling="no"></iframe> </div>
</div>	
			<!--结束-->
</div>
<!--taopage_detail end-->
</div>
<div class="cle"></div>
</div>

<script type="text/javascript" src="/images/common.js"></script>
<!--[if lte IE 6]>
<script type="text/javascript" src="/javascript/cn/DD_belatedPNG_0.0.7a.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix(\'*\');
</script>
<![endif]-->
<script type="text/javascript" src="/images/artDialog.js"></script>
<script type="text/javascript" src="/images/Common.js"></script>
<script type="text/javascript">
var zgMax=20;

var curMoney=1.00;
var curG=0.00;

var curExam=false;


var webqq = 239087160;
var webnoticeurl = "";
var webnoticetit = "";
var thisUrl=\'/task/tao/?m=taskIn\';
</script>
<script type="text/javascript" src="/images/service.js"></script>
<script language="javascript">
	var qs=\'t=ing\';
	$(function(){';echo '
	getTask(qs);
	//getTasknav();
	$("#rebutton").click(function(){';echo '
		$("#rebutton").hide();
		$("#rebutton2").show(10).delay(200).hide(10,function(){';echo '$("#rebutton").show();';echo '});
	getTask(qs);
	';echo '});

';echo '});
function task_search(){';echo '
      var task_keys =  encodeURIComponent($(\'#task_keys\').val());
	  var qs=\'search=\'+task_keys;
	  if(task_keys.indexOf(\'搜索任务ID\') >= 0 || !task_keys ){';echo '
       $(\'#task_keys\').val("");
	  ';echo '} else {';echo '
	   getTask(qs);
	  ';echo '}
';echo '}
var sorts=\'asc\';
function getTasksort(t){';echo '
        var qs=\'t=\'+t;
		sorts = (sorts==\'asc\')?\'desc\':\'asc\';
		getTask(qs+"&etimestamp="+sorts);
';echo '}
function goPage(n) {';echo '
	if (n==void(0)) n = 1;
    var pageSearch = \'\';
    var page = new PageQuery(window.location.search);
	var task_keys = encodeURIComponent($(\'#task_keys\').val());
    for (var i=0; i<page.getLength(); i++) {';echo '
        if (page.getParameters()[i] != \'page\')
            pageSearch += \'&\' + page.keyValuePairs[i];
    ';echo '}
    pageSearch += \'&page=\' + n + \'&now=\' + (new Date()).getTime();
	if(task_keys.indexOf(\'搜索任务ID\') < 0 && task_keys ){';echo '
       pageSearch += \'&search=\' + task_keys;
	';echo '}
    getObj(\'taskList\').innerHTML = \'<div class=\\\'submiting\\\'>任务加载中.....</div>\';
    getTask(pageSearch);
';echo '}
function getTasknav(){';echo '
    var url = \'/ajax/getTasknav.php?type=1&m=taskIn&now=\' + (new Date()).getTime();
	$(\'#yfrw_sub\').html(\'<li class=\\\'submiting clear\\\'>加载中.....</li>\');
	   $.ajax({';echo '
		type : \'GET\',
		url  : url,
		success : function(html){';echo '
			$(\'#yfrw_sub\').html(html);
		';echo '},
		error:function(){';echo '
			$(\'#yfrw_sub\').html(\'<p>尊敬的会员，您遇到了一个未知的错误。</p>\');
		';echo '}
	';echo '});
';echo '}
function ShowRemark(id,remark){';echo '
    remarkHtm = "<textarea id=\\"txtremark\\" cols=\\"50\\" rows=\\"10\\" style=\\"width:200px;height:100px;\\">"+ remark +"</textarea>";
    artDialog({';echo 'content:remarkHtm,id:"alarm",fixed:true,yesText:"保存并关闭",noText:"关闭"';echo '},
        function(){';echo '
            var ramark = $("#alarmContent textarea[id=txtremark]").val();
            if(ramark.length<=100){';echo '
                $.post("/ajax/updateremark.php",{';echo '"taskid":id,"remark":ramark';echo '}, function(result){';echo '
                    if(result>0){';echo '
                        goPage();
                    ';echo '}else{';echo '
					alert(result);
					window.location.reload();
					';echo '}
                ';echo '});
            ';echo '}else{';echo '
                alert("备注不能超过100个字符！");
                return false;
            ';echo '}
        ';echo '},function(){';echo '';echo '});
';echo '}
    function getTask(qs) {';echo '
        //alert(qs);
        var url = \'/ajax/getTaskinOut.php?type=1&au=8&m=taskIn&\' + qs+"&t=';echo $t;echo '";
        $(\'#taskList\').html(\'<div class=\\\'submiting clear\\\'>加载中.....</div>\');
        $.ajax({';echo '
            type : \'GET\',
            url  : url,
            success : function(html){';echo '
                //alert(html);
                $(\'#taskList\').html(html);
            ';echo '},
            error:function(){';echo '
                $(\'#taskList\').html(\'<p>&nbsp;</p><p>尊敬的会员，您遇到了一个未知的错误，请稍后重新点击。　　<a href="\'+weburl2+\'">返回主页</a></p>\');
            ';echo '}
        ';echo '});
    ';echo '}
</script>

<script type="text/javascript" src="/images/task.js"></script>
<script type="text/javascript">
var obj;
function viewTaskList(obj,url) {';echo '

var d = new Date();
var e = document.getElementById("showtask"); 

e.style.position = "absolute"; 
e.style.right = "-89px";

e.style.top = getT(obj)+document.getElementById(obj).offsetHeight+"px";

if(document.all["showtask"].style.display=="none")
{';echo '
document.all["showtask"].style.display="";
document.all.contentframe.src=url+"&rndid="+d.getMinutes()+d.getSeconds();
';echo '}else{';echo '
document.all["showtask"].style.display="none";
document.all.contentframe.src="about:blank";
';echo '}
';echo '}
function getL(id){';echo '  
var e=document.getElementById(id);
var l=e.offsetLeft;  

while(e=e.offsetParent){';echo '  
l+=e.offsetLeft;  
';echo '}  
return  l  
';echo '}  
function marquee_close(){';echo '
   $(\'.rwdt_marquee_close\').hide();
   $(\'.rwdt_marquee\').hide();
';echo '}
function getT(id){';echo '  
var e=document.getElementById(id);
var  t=e.offsetTop;  
while(e=e.offsetParent){';echo '  
t+=e.offsetTop;  
';echo '}  
return  t  
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