<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\tuoguan\tuoguan.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\tuoguan\tuoguan.htm','D:\damaihu\xinyupingtai7\cache\default\tuoguan\tuoguan.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/tuoguan/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<SCRIPT type="text/javascript" src="/css/service.js"></SCRIPT>
<LINK rel="stylesheet" type="text/css" href="/css/shua.css">
<SCRIPT type="text/javascript">
$(function() {';echo '
	$("#table tr:odd").css({';echo 'background:"#e8f9fe"';echo '});
';echo '});
</SCRIPT>
<!--banner 登录框开始-->
<DIV style="margin-top: 0px;" id="ds_banner">
<DIV class="kd">
<DIV class="banner"><IMG src="/images/ds_banner.gif" width="602" height="302"></DIV>
<DIV class="ds_news">
<DIV class="ds_zxlist">
<TABLE id="table" border="0" cellSpacing="0" cellPadding="0" width="95%">
  <TBODY>
  <TR>
    <TD height="25" width="120">&nbsp; <SPAN>cai**</SPAN></TD>
    <TD>申请<SPAN class="lanse">一钻</SPAN></TD>
    <TD width="110"><STRONG class="chengse">250</STRONG>个信誉</TD></TR>
  <TR>
    <TD height="25" width="120">&nbsp; <SPAN>wya****</SPAN></TD>
    <TD>申请<SPAN class="lanse">一钻</SPAN></TD>
    <TD width="110"><STRONG class="chengse">250</STRONG>个信誉</TD></TR>
  <TR>
    <TD height="25" width="120">&nbsp; <SPAN>ith**</SPAN></TD>
    <TD>申请<SPAN class="lanse">一钻</SPAN></TD>
    <TD width="110"><STRONG class="chengse">250</STRONG>个信誉</TD></TR>
  <TR>
    <TD height="25" width="120">&nbsp; <SPAN>jua******</SPAN></TD>
    <TD>申请<SPAN class="lanse">一钻</SPAN></TD>
    <TD width="110"><STRONG class="chengse">250</STRONG>个信誉</TD></TR>
  <TR>
    <TD height="25" width="120">&nbsp; <SPAN>若兰轩****</SPAN></TD>
    <TD>申请<SPAN class="lanse">一钻</SPAN></TD>
    <TD width="110"><STRONG 
class="chengse">250</STRONG>个信誉</TD></TR>
</TBODY>
</TABLE>
</DIV>
<P class="ds_wc">已完成：<STRONG class="chengse">122147</STRONG> 个信誉</P>
<DIV class="ds_btn"><A class="btn" href="tencent://message/?uin=';echo $kefu_qq;echo '" 
target="_blank"></A><A class="btn2" href="#"></A></DIV></DIV></DIV></DIV>
<DIV id="content">
<DIV class="ds_about">
<TABLE border="0" cellSpacing="0" cellPadding="0" width="1000" height="115">
  <TBODY>
  <TR>
    <TD class="ds_a1" width="20">&nbsp;</TD>
    <TD class="ds_a2" width="290"><SPAN class="ds_fw"></SPAN>
      <P>我们的服务</P>                专业的团队，多年的经验！<BR>一直致力于淘宝网店服务研究！</TD>
    <TD class="ds_a2"><SPAN class="ds_fw2"></SPAN>
      <P>我们的承诺</P>降多少补多少，封了再帮您刷一个店！<BR>把店交给我们，将不辜负您的重托！</TD>
    <TD class="ds_a2"><SPAN class="ds_fw3"></SPAN>
      <P>我们的优势</P>价格低廉，时间短，效率高！<BR>让您用最少的付出获得最大的回报！</TD>
    <TD class="ds_a3" width="10">&nbsp;</TD></TR></TBODY></TABLE></DIV>
<P style="display: none;" class="Discount">优惠活动剩余时间：<SPAN 
id="sale_times">0</SPAN>秒</P>
<DIV class="ds_cplist">
<H4 class="ds_tit">收费标准</H4>
<H5 class="ds_qq"><A class="kf2gre" href="tencent://message/?uin=';echo $kefu_qq;echo '"><IMG 
border="0" src="/images/button_old_171.gif"></A><A class="kf2gre" href="tencent://message/?uin=';echo $kefu_qq;echo '">客服小粉</A>　<A 
class="kf2gre" href="tencent://message/?uin=';echo $kefu_qq;echo '"><IMG border="0" src="/images/button_old_171.gif"></A><A 
class="kf2gre" href="tencent://message/?uin=';echo $kefu_qq;echo '">客服小麦</A>　<A class="kf2gre" 
href="tencent://message/?uin=';echo $kefu_qq;echo '"><IMG border="0" src="/images/button_old_171.gif"></A><A 
class="kf2gre" href="tencent://message/?uin=';echo $kefu_qq;echo '">客服小芸</A>　<A class="kf2gre" 
href="tencent://message/?uin=';echo $kefu_qq;echo '"><IMG border="0" src="/images/button_old_171.gif"></A><A 
class="kf2gre" href="tencent://message/?uin=';echo $kefu_qq;echo '">客服小黄</A>　<A href="#"><IMG 
align="absmiddle" src="/images/heshenguan.jpg" width="117" 
height="35"></A></H5>
<DIV class="cle"></DIV>
<DIV class="ds_line">
<P class="name">打理250笔交易</P><SPAN class="ds_dj1"></SPAN>
<UL class="text">
  <LI class="chengse2"><SPAN>价格：<STRONG>599</STRONG>元</SPAN>-<SPAN style="text-decoration: line-through;">原价：<STRONG>699</STRONG>元</SPAN></LI>
  <LI>时间：<STRONG class="lanse">30</STRONG>天左右</LI>
  <LI>属性：赠送收藏流量</LI>
  <LI>
  <FORM id="myForm1" method="post" name="myForm1">
  ';echo $sys_hash_code2;echo '
  <INPUT name="store_price" value="599" type="hidden">
  <INPUT name="store_day" value="30" type="hidden">
  <INPUT name="store_deal" value="200" type="hidden">
  <INPUT name="store_style" value="1" type="hidden">
  <INPUT name="store_att" value="1" type="hidden">
  <A class="ds_btn" onclick="javascript:if(confirm(\'订购托管后，将有客服与您取得联系，请保持QQ，手机通信正常。确定订购吗？\'))document.getElementById(\'myForm1\').submit();" 
  href="javascript:;"></A>
  </FORM>
  </LI>
  </UL>
  </DIV>
<DIV class="ds_line">
<P class="name">打理500笔交易</P><SPAN class="ds_dj2"></SPAN>
<UL class="text">
  <LI class="chengse2"><SPAN>价格：<STRONG>1198</STRONG>元</SPAN>-<SPAN style="text-decoration: line-through;">原价：<STRONG>1298</STRONG>元</SPAN></LI>
  <LI>时间：<STRONG class="lanse">60</STRONG>天左右</LI>
  <LI>属性：赠送收藏流量</LI>
  <LI>
  <FORM id="myForm2" method="post" name="myForm2">
 ';echo $sys_hash_code2;echo '
  <INPUT name="store_price" value="1198" type="hidden">
  <INPUT name="store_day" value="60" type="hidden">
  <INPUT name="store_deal" value="500" type="hidden">
  <INPUT name="store_style" value="2" type="hidden">
  <INPUT name="store_att" value="1" type="hidden">
 <A class="ds_btn" onclick="javascript:if(confirm(\'订购托管后，将有客服与您取得联系，请保持QQ，手机通信正常。确定订购吗？\'))document.getElementById(\'myForm2\').submit();" 
  href="javascript:;"></A></FORM></LI></UL></DIV>
<DIV class="ds_line">
<P class="name">打理1000笔交易</P><SPAN class="ds_dj3"></SPAN>
<UL class="text">
  <LI class="chengse2"><SPAN>价格：<STRONG>2396</STRONG>元</SPAN>-<SPAN style="text-decoration: line-through;">原价：<STRONG>2498</STRONG>元</SPAN></LI>
  <LI>时间：<STRONG class="lanse">80</STRONG>天左右</LI>
  <LI>属性：赠送收藏流量</LI>
  <LI>
  <FORM id="myForm3" method="post" name="myForm3">
  ';echo $sys_hash_code2;echo '
  <INPUT name="store_price" value="2396" type="hidden">
  <INPUT name="store_day" value="80" type="hidden">
  <INPUT name="store_deal" value="1000" type="hidden">
  <INPUT name="store_style" value="3" type="hidden">
  <INPUT name="store_att" value="1" type="hidden"><A class="ds_btn" 
  onclick="javascript:if(confirm(\'订购托管后，将有客服与您取得联系，请保持QQ，手机通信正常。确定订购吗？\'))document.getElementById(\'myForm3\').submit();" 
  href="javascript:;"></A></FORM></LI></UL></DIV>
<DIV class="ds_line">
<P class="name">打理2000笔交易</P><SPAN class="ds_dj4"></SPAN>
<UL class="text">
  <LI class="chengse2"><SPAN>价格：<STRONG>4500</STRONG>元</SPAN>-<SPAN style="text-decoration: line-through;">原价：<STRONG>4688</STRONG>元</SPAN></LI>
  <LI>时间：<STRONG class="lanse">120</STRONG>天左右</LI>
  <LI>属性：赠送收藏流量</LI>
  <LI>
  <FORM id="myForm4" method="post" name="myForm4">
  ';echo $sys_hash_code2;echo '
  <INPUT name="store_price" value="4500" type="hidden">
  <INPUT name="store_day" value="120" type="hidden">
  <INPUT name="store_deal" value="2000" type="hidden">
  <INPUT name="store_style" value="4" type="hidden">
  <INPUT name="store_att" value="1" type="hidden"><A class="ds_btn" 
  onclick="javascript:if(confirm(\'订购托管后，将有客服与您取得联系，请保持QQ，手机通信正常。确定订购吗？\'))document.getElementById(\'myForm4\').submit();" 
  href="javascript:;"></A></FORM></LI></UL></DIV>
<DIV class="ds_line">
<P class="name">打理5000笔交易</P><SPAN class="ds_dj5"></SPAN>
<UL class="text">
  <LI class="chengse2"><SPAN>价格：<STRONG>8500</STRONG>元</SPAN>-<SPAN style="text-decoration: line-through;">原价：<STRONG>8688</STRONG>元</SPAN></LI>
  <LI>时间：<STRONG class="lanse">180</STRONG>天左右</LI>
  <LI>属性：赠送收藏流量</LI>
  <LI>
  <FORM id="myForm5" method="post" name="myForm5">
  ';echo $sys_hash_code2;echo '
  <INPUT name="store_price" value="8500" type="hidden">
  <INPUT name="store_day" value="180" type="hidden">
  <INPUT name="store_deal" value="5000" type="hidden">
  <INPUT name="store_style" value="5" type="hidden">
  <INPUT name="store_att" value="1" type="hidden"><A class="ds_btn" 
  onclick="javascript:if(confirm(\'订购托管后，将有客服与您取得联系，请保持QQ，手机通信正常。确定订购吗？\'))document.getElementById(\'myForm5\').submit();" 
  href="javascript:;"></A></FORM></LI></UL></DIV>
<DIV class="ds_line">
<P class="name">打理10001笔交易</P><SPAN class="ds_dj6"></SPAN>
<UL class="text">
  <LI class="chengse2"><SPAN>价格：<STRONG>16000</STRONG>元</SPAN>-<SPAN style="text-decoration: line-through;">原价：<STRONG>16668</STRONG>元</SPAN></LI>
  <LI>时间：<STRONG class="lanse">360</STRONG>天左右</LI>
  <LI>属性：赠送收藏流量</LI>
  <LI>
  <FORM id="myForm6" method="post" name="myForm6">
  ';echo $sys_hash_code2;echo '
  <INPUT name="store_price" value="16000" type="hidden">
  <INPUT name="store_day" value="360" type="hidden">
  <INPUT name="store_deal" value="10001" type="hidden">
  <INPUT name="store_style" value="6" type="hidden">
  <INPUT name="store_att" value="1" type="hidden"><A class="ds_btn" 
  onclick="javascript:if(confirm(\'订购托管后，将有客服与您取得联系，请保持QQ，手机通信正常。确定订购吗？\'))document.getElementById(\'myForm6\').submit();" 
  href="javascript:;"></A></FORM></LI></UL></DIV>
<DIV class="ds_line">
<P class="name">打理20001笔交易</P><SPAN class="ds_dj7"></SPAN>
<UL class="text">
  <LI class="chengse2">价格：<STRONG class="chengse">35000</STRONG>元</LI>
  <LI>时间：<STRONG class="lanse">520</STRONG>天左右</LI>
  <LI>属性：赠送收藏流量</LI>
  <LI>
  <FORM id="myForm7" method="post" name="myForm7">
  ';echo $sys_hash_code2;echo '
  <INPUT name="store_price" value="35000" type="hidden">
  <INPUT name="store_day" value="520" type="hidden">
  <INPUT name="store_deal" value="20001" type="hidden">
  <INPUT name="store_style" value="7" type="hidden">
  <INPUT name="store_att" value="1" type="hidden"><A class="ds_btn" 
  onclick="javascript:if(confirm(\'订购托管后，将有客服与您取得联系，请保持QQ，手机通信正常。确定订购吗？\'))document.getElementById(\'myForm7\').submit();" 
  href="javascript:;"></A></FORM></LI></UL></DIV>
<DIV class="ds_line">
<P class="name">打理50001笔交易</P><SPAN class="ds_dj8"></SPAN>
<UL class="text">
  <LI><SPAN class="chengse2">价格：<STRONG class="chengse">需详谈</STRONG></SPAN></LI>
  <LI>时间：<STRONG class="lanse">需详谈</STRONG></LI>
  <LI>属性：赠送收藏流量</LI>
  <LI><A class="ds_btn" 
href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/guanfuwu/"></A></LI></UL></DIV></DIV>
<DIV style="height: 112px;" id="c_bk3"><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/guanfuwu/backdoor" 
target="_blank"><IMG src="/images/shua_banner.gif"></A></DIV>
<DIV style="height: 344px; margin-top: 0px;" id="c_bk3">
<UL style="left: 15px;" class="c_info">
  <H4 class="dsym_bt"></H4>
  <LI><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1331/" 
  target="_blank">大麦户平台托管业务介绍</A></LI>
  <LI><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1332/" 
  target="_blank">大麦户平台托管业务细则（会员必看，请仔细阅读）</A></LI>
  <LI><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1330/" 
  target="_blank">为何要托管提升信誉，亲们知道吗？</A></LI>
  <LI><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1333/" 
  target="_blank">客户托管前的准备</A></LI>
  <LI><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1334/" 
  target="_blank">需要提供的店铺资料</A></LI>
  <LI><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1335/" 
  target="_blank">托管提交方法？</A></LI>
  <LI><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1482/" 
  target="_blank">关于托管物品以及物品金额</A></LI></UL></DIV>
<DIV style="height: 95px;" id="c_bk3"><IMG 
src="/images/shua_banner.jpg"></DIV>
<DIV style="height: 344px; margin-top: 0px;" id="c_bk3">
<UL style="left: 15px;" class="c_info">
  <H4 class="dsym_bt2"></H4>
  <LI><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1336/" 
  target="_blank">你托管，或是不托管，托管就在这里</A></LI>
  <LI><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1342/" 
  target="_blank">怎么开通淘宝E客服帐号？</A></LI>
  <LI><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1341/" 
  target="_blank">并不是非选我们不可</A></LI>
  <LI><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1340/" 
  target="_blank">店铺被释放是为什么？</A></LI>
  <LI><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1339/" 
  target="_blank">托管信誉过程中，支付宝被冻结如何处理！</A></LI>
  <LI><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1338/" target="_blank">托管注意事项 
  （重要的）</A></LI>
  <LI><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1337/" 
  target="_blank">谨防托管信誉骗子！</A></LI></UL></DIV></DIV>
<DIV class="cle"></DIV>
<SCRIPT type="text/javascript">
function SaleRefreshTime(t) {';echo '
    if (t <0 ) t = 0;
    var id = "#sale_times";
	$(id).html(parseInt(t/3600) + ":" + parseInt((t-(parseInt(t/3600))*3600)/60) + ":" + (t-(parseInt(t/3600))*3600)%60);
    var uptime = function() {';echo '
        t = t - 1;
		m = parseInt((t-(parseInt(t/3600))*3600)/60);
		s = (t-(parseInt(t/3600))*3600)%60;
		if(m<10)m=\'0\'+m;
		if(s<10)s=\'0\'+s;
		if (t <= 0) {';echo '
		    window.clearInterval(tt_0);
			$("#sale_times").html("0");
            t = 0;
        ';echo '}
		$(id).html(parseInt(t/3600) + ":" + m + ":" + s);
    ';echo '}
    var tt_0 = window.setInterval(uptime, 1000);
';echo '}

</SCRIPT>

<DIV class="cle"></DIV>
';echo '<div id="footer">
		<p><span class="chengse">官方QQ号码：1371752337</span> （加群请注明大麦户）</p>
		<p class="lanse"><a href="#">关于我们</a>|<a href="#">联系我们</a>|<a href="#">大麦户规则</a>|<a href="#">网站地图</a>|<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '" target="_blank">淘宝信誉查询</a> </p>
		<p style="text-align:center;">
	
		<p class="lanse">客户服务热线：02968929109   Copyright © 2012-2020 Damaihu.com All RightsReserved    大麦户版权所有 <a href="#" target="_blank">粤ICP备13037934号</a><span style="display:none">
</span></p>
	</div>
	</div>
    </div>';echo ' 
';?>