<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\task\pai_index.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\task\pai_info.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\quick.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\task\pai_tab.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\task\pai_index.htm','D:\damaihu\xinyupingtai7\cache\default\task\pai_index.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/task/';$cssList=array(0=>'http://damaihu.tertw.net/css/task/task.css');echo '
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

';echo '
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
<script type="text/javascript">
var zgMax=20;
var curMoney=';echo $memberFields['money']?'true':'false';echo ';;
var curG=';echo $memberFields['fabudian']?'true':'false';echo ';;
var curExam=';echo $memberFields['exam']?'true':'false';echo ';;
var isGetData=false;
var webqq = 195230378;
var webnoticeurl = "";
var webnoticetit = "";
var quick_qq ="13592747";
</script>
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
		<div id="content">
	';if($_showmessage){echo '<div class=\'msg_panel\'><div>';echo $_showmessage;echo '</div></div>';}echo '
	';if($indexMessage){echo '<div class=\'error_panel\'><div>';echo $indexMessage;echo '</div></div>';}echo ' 

 ';echo '<ul class="rwdt_info">
      <li>
        <p class="fd">账户余额：<strong class="chengse">';echo $memberFields['money'];echo '</strong> 元</p>
      <a title="将存款提取到我的网银或支付宝上" target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/payment/" class="rwdt_tx"></a></li>
      <div class="cle"></div>
      <li><p class="fd">麦点：<strong class="chengse">';echo $memberFields['fabudian2'];echo '</strong> 个</p><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/exchange/" title="将保证金兑换成能发布任务的麦点" target="_blank" class="rwdt_hs"></a></li>
      <div class="cle"></div>
      <li><p>积分：<strong class="chengse">';echo $memberFields['credits'];echo '</strong> 个</p></li>
      <li><p class="fd">属于：普通会员</p><span class=""></span></li>
      <div class="cle"></div>
      <li>好评率：<strong class="lvse">暂无评论信息</strong></li>
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
		';echo '<div class="rwdt_menu">
  <a href="';echo $baseUrl;echo '" ';if($m=='index'){echo ' class="nov" ';}echo ' title="拍拍任务大厅">拍拍任务大厅</a>
  <a href="';echo $baseUrl;echo '?m=taskIn" ';if($m=='taskIn'){echo ' class="nov" ';}echo ' title="已接任务">已接任务</a>
  <a href="';echo $baseUrl;echo '?m=taskOut" ';if($m=='taskOut'){echo ' class="nov" ';}echo ' title="已发任务">已发任务</a>
  <a href="';echo $baseUrl;echo '?m=tieBuyer" ';if($m=='tieBuyer'){echo ' class="nov" ';}echo ' title="绑定买号">绑定买号</a>
  <a href="';echo $baseUrl;echo '?m=tieSeller" ';if($m=='tieSeller'){echo ' class="nov" ';}echo ' title="绑定掌柜">绑定掌柜</a>
</div>





';echo '
		<div class="rwdt_xx">
			<p class="rwdt_lx"><a href="#" class="nov" seed="0">全部任务</a><a href="#"';if($stype==1){echo ' class="nov" ';}echo ' seed="1">虚拟任务</a><a href="#" ';if($stype==2){echo ' class="nov" ';}echo '  seed="2">实物任务</a></p>
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
				<li><a href="#" cid="6" title="不限" class="nov">不限</a></li>
				<li><a href="#" title="1天收货" cid="2">1天收货</a></li>
				<li><a href="#" title="2天收货" cid="3">2天收货</a></li>
				<li><a href="#" title="3天收货" cid="4">3天收货</a></li>
				<li><a href="#" title="4天以上收货" cid="5">4天以上收货</a></li>
				<li><span class="gdt2"></span></li>
			</ul>
			<div class="rwdt_btn" >
			<a href="';echo $baseUrl;echo '?m=add" class="fb_btn"></a>
			<a href="javascript:;" class="sx_btn" ></a>
			<div id="task_panel" style="display:none"><input type="hidden" name="isAuto" id="isAuto" value="8" /></div>
			</div>
			
		</div>
	   <div class="cle"></div>
	   <div id="taobao-lists">
		<div id="taskList"></div>
</div>
</div>
	<div class="cle"></div>
<div id="divIDList" style="display:none;">
<div class="divin">
<div class="cont">
<table class="namelist" style="margin-top:0px; margin-left:0px;" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr class="trListNormal">
<td id="tdOpenNormalBa" style="background-color:#E1E1E1;color:Black; padding:6px 0px 5px 5px;cursor:pointer; border-bottom:solid 1px #FFFFFF;" onclick="OpenNormalBa()" colspan="2">
<span id="spanNormalHead" style="color:black;">
<img src="/images/hidden.gif" style="margin-bottom:2px;">
普通买号
</span>
</td>
</tr>
<tr id="trListNormal" class="trListNormal">
<td colspan="2">

<table class="bpage1" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
';if($paiList){foreach($paiList as $v){echo '
<tr name="L6">
<td class="name" style="width:35%;">
<label><input value="';echo $v['id'];echo '" name="ba" type="radio">
';echo $v['nickname'];echo '</label>
</td>
<td style="width:65%;">(拍拍信用：0,本月已接：0,今日已接：0,拉黑：0)</td>
</tr>
';}}echo '
</tbody>
</table>



<div class="buyerspages" style="height:25px;margin:10px 0px;"><a href="javascript:;" onclick="Openbuyerspage(1);" class="nov">1</a>
</div>

</td>
</tr>
<tr>
<td id="tdOpenTrueNameBa" style="background-color:#E1E1E1;color:Black;padding:6px 0px 5px 5px;cursor:pointer;" onclick="OpenTrueNameBa()" colspan="2">
<span id="spanTrueNameHead" style="color:black;">
<img src="/images/show.gif" style="margin-top:2px;">
实名买号（点击查看实名买号）
</span>
</td>
</tr>
<tr id="trListNormal" class="trListNormal">
<td colspan="2">

<table class="bpage1" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
';if($paiList){foreach($paiList as $v){echo '
<tr name="L6">
<td class="name" style="width:35%;">
<label><input value="';echo $v['id'];echo '" name="ba" type="radio">
';echo $v['nickname'];echo '</label>
</td>
<td style="width:65%;">(拍拍信用：0,本月已接：0,今日已接：0,拉黑：0)</td>
</tr>
';}}echo '
</tbody>
</table>



<div class="buyerspages" style="height:25px;margin:10px 0px;"><a href="javascript:;" onclick="Openbuyerspage(1);" class="nov">1</a>
</div>

</td>
</tr>
</tbody>
</table>
<p></p>
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
<script type="text/javascript" src="/images/jquery.js"></script>
<script type="text/javascript" src="/images/common.js"></script>
<!--[if lte IE 6]>
<script type="text/javascript" src="/javascript/cn/DD_belatedPNG_0.0.7a.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix(\'*\');
</script>
<![endif]-->
<script type="text/javascript" src="/images/artDialog.js"></script>
<script type="text/javascript" src="/images/Common.js"></script>
<script type="text/javascript" src="/images/task_pai.js"></script> 
<script type="text/javascript">
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
	setTimeout("isGetData=false",1500);
	';echo '}
';echo '}
$(".sx_btn").click(function(){';echo 'goPage(1);';echo '});
function getTask(qs) {';echo '
   // var url = \'/ajax/getTask.php?type=1\' + \'&au=\' + $(\'#isAuto\').val() + qs;
   var url = \'/ajax/getTask.php?type=2\' + \'&au=\' + 8 + qs;
    $.ajax({';echo '
		type : \'GET\',
		url  : url,
		success : function(html){';echo '
			if (html.indexOf(\'任务进行中\')<0 && html.indexOf(\'qrw_btn\')<0 )
				html = \'<div class=\\\'pub_tip5 f_b\\\'>对不起，本互动区里所有任务都被抢光了，请过会再 <span class=\\\'btn_gl\\\' onclick=\\\'goPage(1);\\\'>刷新</span> 试试...</div>\' + html;
			$(\'#taskList\').html(html);
		';echo '},
		error:function(){';echo '
			$(\'#taskList\').html(\'<p>&nbsp;</p><p>尊敬的会员，您遇到了一个未知的错误，请稍后重新点击。　　<a href="\'+weburl2+\'">返回主页</a></p>\');
		';echo '}
	';echo '});
';echo '}
function autoTask() {';echo '
    $(\'#taskList\').html(\'<div class=\\\'submiting\\\'>任务加载中.....</div>\');
	var chkAuto = getObj(\'isAuto\');
	var auto = function() {';echo '
		if (chkAuto && chkAuto.checked) {';echo '
			goPage(1);
		';echo '}
	';echo '};
    var t = parseInt(getValue(\'isAuto\'));
    if (t < 5) t = 20;
	var tt_1 = window.setInterval(auto, t * 1000);
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
		<p><span class="chengse">官方QQ号码：1371752337</span> （加群请注明大麦户）</p>
		<p class="lanse"><a href="#">关于我们</a>|<a href="#">联系我们</a>|<a href="#">大麦户规则</a>|<a href="#">网站地图</a>|<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '" target="_blank">淘宝信誉查询</a> </p>
		<p style="text-align:center;">
	
		<p class="lanse">客户服务热线：02968929109   Copyright © 2012-2020 Damaihu.com All RightsReserved    大麦户版权所有 <a href="#" target="_blank">粤ICP备13037934号</a><span style="display:none">
</span></p>
	</div>
	</div>
    </div>';?>