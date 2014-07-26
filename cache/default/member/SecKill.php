<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\member\SecKill.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\member\menu.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\member\SecKill.htm','D:\damaihu\xinyupingtai7\cache\default\member\SecKill.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/member/';$title='麦点秒杀 - 互动吧平台';$keywords='';$description='';$cssList=array(0=>'http://damaihu.tertw.net/css/member/member.css');echo '
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
<DIV id="content">';echo '<!-- 左边栏 -->
<SCRIPT>
$(function(){';echo '
	$(".left_twe").css("display","none");//IE6
	//发布任务效果
	$(".left_rwdt .renwu1").hover(function(){';echo '
		$(this).css("background-position","-64px -335px");
		$(".left_twe").css("display","block");
	';echo '});
	
	$(".left_rwdt:not(.left_twe,renwu1)").mouseleave(function(){';echo '
		$(".left_rwdt .renwu1").css("background-position","-68px -387px");
		$(".left_twe").css("display","none")
	';echo '});
	
	//任务奖励效果
	$(".left_rwdt2").hover(function(){';echo '
		$(".renwu2").css("background-position","-64px -445px");
		
	';echo '},function(){';echo '
		$(".renwu2").css("background-position","-69px -498px");
		
	';echo '})
	
	//遍历图标
	$(".left_liebiao ul li:parent:not(\'#dilei\')").each(function(i){';echo '
		
	   if(i == 0){';echo '
			num = 4;
	   ';echo '}else{';echo '
			num = i*(-44);
	   ';echo '}
	   if(i == 6){';echo '
		num = -262;
	   ';echo '}
	   $(this).children("a:first").css("background-position","0px "+num+"px");
	';echo '});
	
	//遍历文字图标
	$(".left_liebiao ul li:parent:not(\'#dilei\')").each(function(i){';echo '
		
	   if(i == 0){';echo '
			num = 4;
	   ';echo '}else{';echo '
			num = i*(-40);
	   ';echo '}
	   $(this).children("a:eq(1)").css("background-position","-355px "+num+"px");
	   $(this).children("a:eq(1)").attr("num",num);
	';echo '});
	
	var urlname = getCurrUrlFileName();
	$(".left_liebiao ul li").each(function(i){';echo '
			v = $(this).children(\'a:last\').attr(\'name\');
			if(v == urlname){';echo '
				//$(this).children(\'a:last\').css(\'background\',\'red\');
				$(this).append("<i><img src=\'/images/dadian.png\' /></i>");
			';echo '}
	';echo '})
	
	//遍历链接显示下划线
	$(".left_liebiao ul li:parent:not(\'#dilei\')").hover(function(i){';echo '
	
		num = $(this).children("a:eq(1)").attr("num");
		
		$(this).children("a:eq(1)").css("background-position","-489px "+ num +"px");
		if(urlname != $(this).children(\'a:eq(1)\').attr(\'name\')){';echo '
			$(this).append("<i><img src=\'/images/dadian.png\' /></i>");
		';echo '}
	';echo '},function(){';echo '
	
		$(this).children("a:eq(1)").css("background-position","-355px "+ num +"px");
		if(urlname != $(this).children(\'a:eq(1)\').attr(\'name\')){';echo '
			$(this).children("i").remove();
		';echo '}
	';echo '});
	
	$("#dilei").hover(function(i){';echo '
		
		$(this).children("a:eq(1)").css("background-position","-139px -232px");
		$(this).append("<i><img src=\'/images/dadian.png\' /></i>");
	';echo '},function(){';echo '
	
		$(this).children("a:eq(1)").css("background-position","0px -232px");
		$(this).children("i").remove();
	';echo '});

	function getCurrUrlFileName(){';echo '
				var url = window.location.pathname;
				while (url.indexOf("/") > -1) {';echo '
					url = url.substring(url.indexOf("/") + 1, url.length);
				';echo '}
				return url;
	';echo '}
	
	//仅测试0.1----根据页面固定当前链接样式
	//var yelink = \'aaa\';
	//if(yelink == \'aaa\'){';echo '
	//	$(".left_liebiao ul li:eq(0) a:eq(1)").css("background-position","-625px 4px");
	//';echo '}
';echo '});
</SCRIPT>
<DIV class="left_lan">
 <DIV class="left_rwdt">
<DIV class="tupian_ico renwu1"></DIV>
<DIV class="left_twe">
<UL>
  <LI><IMG src="/images/dian.png"><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/tao/">淘宝任务</A></LI>
  <LI><IMG src="/images/dian.png"><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/pai/">拍拍任务</A></LI>
 </UL>
 </DIV>
   <SPAN class="imgdian dian1"></SPAN>
   <SPAN class="imgdian dian2"></SPAN>
   <SPAN class="imgdian dian3"></SPAN>
 </DIV>
<DIV class="left_liebiao">
<UL>
  <LI><A class="tupian_ico li1"></A><A class="tupian_ico text1" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/" name="topup"></A></LI>
  <LI><A class="tupian_ico li1"></A><A class="tupian_ico text1" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/payment/?m=bank" name="payment"></A></LI>
  <LI><A class="tupian_ico li1"></A><A class="tupian_ico text1" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/PayDetails/?type=1" name="PayDetails"></A></LI>
  <LI><A class="tupian_ico li1"></A><A class="tupian_ico text1" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/exchange/" name="exchange"></A></LI>
  <LI></LI>
  <LI><A class="tupian_ico li1"></A><A class="tupian_ico text1" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/express/" name="express"></A></LI>
  <LI><A class="tupian_ico li1"></A><A class="tupian_ico text1" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/SecKill/" name="SecKill"></A></LI>
  <LI id="dilei"><A class="dilei1"></A><A class="dileiimg" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/mineaction/" target="_blank"></A></LI>
  <LI><A class="tupian_ico li1"></A><A class="tupian_ico text1" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/black/?type=index" name="black"></A></LI>
  <LI></LI>
  <LI><A class="tupian_ico li1"></A><A class="tupian_ico text1" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/userdata/?type=index" name="userdata"></A></LI>
  <LI><A class="tupian_ico li1"></A><A class="tupian_ico text1" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/spread/" name="spread"></A></LI>
  <LI><A class="tupian_ico li1"></A><A class="tupian_ico text1" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/thread/" name="thread"></A></LI>
  <LI><A class="tupian_ico li1"></A><A class="tupian_ico text1" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/" name="message"></A></LI></UL></DIV>
<DIV class="left_rwdt2">
<DIV class="tupian_ico renwu2"><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/userjob/"></A></DIV></DIV>
</DIV>



';echo '
	<DIV class="right">';if($indexMessage){echo '
		<div class=\'error_panel\'>
			<div>';echo $indexMessage;echo '</div>
		</div>';}echo ' ';if($_showmessage){echo '
		<div class=\'msg_panel\' style="border: 1px dashed rgb(204, 204, 204); background:#FFC; margin-top:5px;padding:10px 5px; color:#0F3; font-weight:bold;">
			<div>';echo $_showmessage;echo ' <SCRIPT>alert(\'';echo $_showmessage;echo '\')</SCRIPT></div>
		</div>';}echo '
		<FORM method="post" action="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/SecKill/">';echo $sys_hash_code2;echo '
			<DIV class="SecKill">
				<P class="SecKill_down">
					
<SPAN class="dleft">

<SPAN id="SecKill_times">正在读取数据...</SPAN>　开始秒杀！</SPAN>
					
<SPAN class="dright">当前时间：星期';echo date('w',time());echo '</SPAN>
				</P>
				<P class="SecKill_sub">麦点秒杀
					<SPAN>';echo $kill_price;echo '</SPAN>元一个</P>
				<P class="SecKill_txt">
					
<SPAN class="SecKill_txt1">

<INPUT id="nums" name="nums" maxLength="4" type="text"></SPAN>
					<INPUT name="jiage" value="';echo $kill_price;echo '" type="hidden">
					
<SPAN id="SecKill_buy" class="SecKill_buy">

<INPUT type="button"></SPAN>
				</P>
				<P class="SecKill_explain">
					<SPAN>1</SPAN>个起售（剩余
					<SPAN>';echo $seckill;echo '</SPAN>个）
					<BR>拥有麦点，就可以发布自己的任务，获得好评</P>
			</DIV>
		</FORM>
		<DIV class="SecKill_ftCon">活动介绍：
			<BR>麦点惊喜特惠价！每个
			<SPAN>麦点低至';echo $kill_price;echo '</SPAN>元，低到不行的麦点，小成本涨信誉有木有
			<BR>每周五0:00起，大麦户特别发送
			<SPAN>';echo $kill_all;echo '个麦点供秒杀</SPAN>，数量有限，真的是先到先得咯！
			<BR>
		</DIV>
	</DIV>
</DIV>
<DIV class="cle"></DIV>
<SCRIPT type="text/javascript">
	function SecKillRefreshTime(t) {';echo '
	var t=20
	    if (t <0 ) t = 0;
	    var id = "#SecKill_times";
		var sub = $("#SecKill_buy input");
		$(id).html(parseInt(t/3600) + ":" + parseInt((t-(parseInt(t/3600))*3600)/60) + ":" + (t-(parseInt(t/3600))*3600)%60 +"后");
	    var uptime = function() {';echo '
	        t = t - 1;
			m = parseInt((t-(parseInt(t/3600))*3600)/60);
			s = (t-(parseInt(t/3600))*3600)%60;
			if(m<10)m=\'0\'+m;
			if(s<10)s=\'0\'+s;
	        if (t <= 0) {';echo '
			    window.clearInterval(tt_0);
				$(".dleft").html("秒杀活动进行中！");
				$("#SecKill_buy").removeClass("SecKill_buy").addClass("SecKill_buy1").html("<input type=\\"submit\\" />");
	            t = 0;
	        ';echo '}
			$(id).html(parseInt(t/3600) + ":" + m + ":" + s +"后" );
	    ';echo '}
	    var tt_0 = window.setInterval(uptime, 1000);
	';echo '}
	SecKillRefreshTime(484868);
</SCRIPT>
<DIV class="cle"></DIV>';echo '<div id="footer">
		<p><span class="chengse">官方QQ号码：1371752337</span> （加群请注明大麦户）</p>
		<p class="lanse"><a href="#">关于我们</a>|<a href="#">联系我们</a>|<a href="#">大麦户规则</a>|<a href="#">网站地图</a>|<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '" target="_blank">淘宝信誉查询</a> </p>
		<p style="text-align:center;">
	
		<p class="lanse">客户服务热线：02968929109   Copyright © 2012-2020 Damaihu.com All RightsReserved    大麦户版权所有 <a href="#" target="_blank">粤ICP备13037934号</a><span style="display:none">
</span></p>
	</div>
	</div>
    </div>';echo '</BODY>

</HTML>
';?>