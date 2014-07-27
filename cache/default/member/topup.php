<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\member\topup.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\member\menu.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\member\topup.htm','D:\damaihu\xinyupingtai7\cache\default\member\topup.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/member/';$title='存款充值 - 互动吧平台';$keywords='';$description='';$cssList=array(0=>'http://damaihu.tertw.net/css/member/member.css');$jsList=array(0=>'http://damaihu.tertw.net/javascript/index/task.js');echo '
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
<SCRIPT type="text/javascript" src="/css/jquer.js"></SCRIPT>
<SCRIPT type="text/javascript" src="/css/common.func.js"></SCRIPT>
<SCRIPT type="text/javascript">
    $(function () {';echo '
        $(".left_tit").hover(function () {';echo '
            $(this).css("background-image", "url(/images/login/bg_2.png)");
            $(".left_alert").css("display", "block");
        ';echo '}, function () {';echo '
            $(this).css("background-image", "url(/images/login/bg_1.png)");
            $(".left_alert").css("display", "none")
        ';echo '})
    ';echo '});


</SCRIPT>
<SCRIPT type="text/javascript">
    $(function () {';echo '
        $(".a_father_1").each(function (i) {';echo '
            $(this).hover(function () {';echo '
                $(this).eq(i).css("background-image", "url(/images/login/icon_17.png)");
                $(".a_son_1").css("display", "block");
            ';echo '}, function () {';echo '
                $(this).eq(i).css("background-image", "url(/images/login/icon_23.png)");
                $(".a_son_1").css("display", "none");
            ';echo '})
        ';echo '})
    ';echo '});
</SCRIPT>
<SCRIPT type="text/javascript">
    $(function () {';echo '
        $(".a_father_2").each(function (e) {';echo '
            $(this).hover(function () {';echo '
                $(this).eq(e).css("background-image", "url(/images/login/icon_18.png)");
                $(".a_son_2").css("display", "block");
            ';echo '}, function () {';echo '
                $(this).eq(e).css("background-image", "url(/images/login/icon_24.png)");
                $(".a_son_2").css("display", "none");
            ';echo '})
        ';echo '})
    ';echo '});
</SCRIPT>
<SCRIPT>
    $(function () {';echo '
        $(".menu-item .menu-hd").hover(function () {';echo '
            $(this).next(\'#menu-0\').show();
            $(this).children(\'b\').css({';echo 'borderColor: \'#666666 white white\', transform: \'rotate(180deg\', transformOrigin: \'50% 30% 0px\'';echo '});
            $(this).parents(".menu-item").css({';echo 'background: \'rgb(255, 255, 255)\', border: \'1px solid rgb(191, 191, 191)\'';echo '})
        ';echo '});
        $(".menu-item .menu").mouseleave(function () {';echo '
            $(this).children(\'#menu-0\').hide();
            $(this).children(\'.menu-hd\').children(\'b\').css({';echo 'borderColor: \'#666666 #EFF6FE #EFF6FE\', transform: \'none\', transformOrigin: \'none\'';echo '});
            $(this).parent(".menu-item").css({';echo 'background: \'none\', border: \'1px solid #EFF6FE\'';echo '})
        ';echo '});
    ';echo '})
</SCRIPT>
<!--菜单开始-->
<DIV class="cle"></DIV>
<DIV id="content">
<!-- 左边栏 -->
';echo '<!-- 左边栏 -->
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
<DIV class="right">
';if($indexMessage){echo '
<div class=\'error_panel\'>
    <div>';echo $indexMessage;echo '</div>
</div>
';}echo '
';if($_showmessage){echo '
<div class=\'msg_panel\' style="border: 1px dashed rgb(204, 204, 204);color:red;font-size:20px; background:#FFC; margin-top:5px;padding:10px 5px; font-weight:bold;text-align:left;">
    <div>';echo $_showmessage;echo '</div>
    <script>alert(\'';echo $_showmessage;echo '\')</script>
</div>
';}echo '
';$payStatus0=$payStatus1=$onlinePayType=array();foreach(db::get_list('payfor_interface','name,ename,type',"status='1'",'sort,type',0)as $v){$payStatus0[$v['ename']]=true;$payStatus1[$v['type']]=true;if($v['type']=='1'){$onlinePayType[$v['ename']]=$v['name'];}}$payforTabs=array();if(isset($payStatus0['card']))$payforTabs['card']=1;if(isset($payStatus1[1]))$payforTabs['chinabank']=2;if(isset($payStatus0['alipay']))$payforTabs['alipay']=3;if(isset($payStatus0['tenpay']))$payforTabs['tenpay']=4;$__keys=array_keys($payforTabs);($tab&&in_array($tab,$__keys))||$tab=$__keys['0'];echo '
<DIV class="Top_box">
<DIV class="Top_h">
    <H2></H2>
</DIV>
<UL class="Top_list">
    <A id="nov0" class="nov0" href="javascript:;">
        <SPAN class="Top_list_yeepay"></SPAN>

        <P class="Top_list_txt0 Top_13"></P>
    </A>
    <A style="margin-left: 10px;" id="nov1" href="javascript:;">

        <SPAN class="Top_list_alipay"></SPAN>

        <P class="Top_list_txt1 Top_22"></P>
    </A>
    <A id="nov2" href="javascript:;">
        <SPAN class="Top_list_taobao"></SPAN>

        <P class="Top_list_txt2 Top_22"></P>
    </A>
    <A style="margin-left: 10px;" href="javascript:;">
        <SPAN class="Top_list_other"></SPAN>

        <P class="Top_list_txt3 Top_22"></P>
    </A>
</UL>
';$payStatus0=$payStatus1=$onlinePayType=array();foreach(db::get_list('payfor_interface','name,ename,type',"status='1'",'sort,type',0)as $v){$payStatus0[$v['ename']]=true;$payStatus1[$v['type']]=true;if($v['type']=='1'){$onlinePayType[$v['ename']]=$v['name'];}}$payforTabs=array();if(isset($payStatus0['card']))$payforTabs['card']=1;if(isset($payStatus1[1]))$payforTabs['chinabank']=2;if(isset($payStatus0['alipay']))$payforTabs['alipay']=3;if(isset($payStatus0['tenpay']))$payforTabs['tenpay']=4;$__keys=array_keys($payforTabs);($tab&&in_array($tab,$__keys))||$tab=$__keys['0'];echo '
<UL class="Top_cun_box">
<LI>
    <TABLE border="0" cellSpacing="0" cellPadding="0" width="100%" align="center">
        <TBODY>
        <TR>
            <TD>
                <TABLE border="0" cellSpacing="0" cellPadding="0" width="100%">
                    <TBODY>
                    <TR>
                        <TD bgColor="#c3e5b3" width="30">&nbsp;</TD>
                        <TD style="padding: 10px 0px;" class="mh_xxian" bgColor="#c3e5b3" height="35" vAlign="middle"
                            align="left"><P
                                style=\'background: url("/images/zhifubao/chu.png") no-repeat 1px 1px; width: 680px; height: 25px; font-size: 14px; border-bottom-color: rgb(102, 102, 102); border-bottom-width: 1px; border-bottom-style: dotted;\'></P>
                        </TD>
                        <TD bgColor="#c3e5b3" vAlign="middle" align="left">&nbsp;</TD>
                    </TR>
                    <FORM id="q_f_2" onSubmit="return checkForm1();" method="post" target="_blank">
                        ';echo $sys_hash_code2;echo '
                        <INPUT id="username" name="username" value="';echo $member['username'];echo '" type="hidden">
                        <INPUT name="type" value="yeepay" type="hidden">
                        <TR>
                            <TD bgColor="#c3e5b3" width="30">&nbsp;</TD>
                            <TD bgColor="#c3e5b3" height="35" vAlign="middle" align="left">
                                <TABLE border="0" cellSpacing="0" cellPadding="0" width="100%">
                                    <TBODY>
                                    <TR>
                                        <TD height="35" width="25%"><LABEL
                                                style="padding: 4px; height: 25px; float: left;">
                                            <INPUT class="inlineblock" name="radiobutton" value="radiobutton"
                                                   type="radio">
                                            <SPAN class="gs_yh inlineblock"></SPAN></LABEL></TD>
                                        <TD width="25%"><LABEL style="padding: 4px; height: 25px; float: left;">
                                            <INPUT class="inlineblock" name="radiobutton" value="radiobutton"
                                                   type="radio">
                                            <SPAN class="js_yh inlineblock"></SPAN></LABEL></TD>
                                        <TD width="25%"><LABEL style="padding: 4px; height: 25px; float: left;">
                                            <INPUT class="inlineblock" name="radiobutton" value="radiobutton"
                                                   type="radio">
                                            <SPAN class="ry_yh inlineblock"></SPAN></LABEL></TD>
                                        <TD width="25%"><LABEL style="padding: 4px; height: 25px; float: left;">
                                            <INPUT class="inlineblock" name="radiobutton" value="radiobutton"
                                                   type="radio">
                                            <SPAN class="zg_yh inlineblock"></SPAN></LABEL></TD>
                                    </TR>
                                    <TR>
                                        <TD height="35"><LABEL style="padding: 4px; height: 25px; float: left;">
                                            <INPUT class="inlineblock" name="radiobutton" value="radiobutton"
                                                   type="radio">
                                            <SPAN class="zs_yh inlineblock"></SPAN></LABEL></TD>
                                        <TD>
                                            <LABEL style="padding: 4px; height: 25px; float: left;">
                                                <INPUT class="inlineblock" name="radiobutton" value="radiobutton"
                                                       type="radio">
                                                <SPAN class="ms_yh inlineblock"></SPAN></LABEL></TD>
                                        <TD><LABEL style="padding: 4px; height: 25px; float: left;">
                                            <INPUT class="inlineblock" name="radiobutton" value="radiobutton"
                                                   type="radio">
                                            <SPAN class="jt_yh inlineblock"></SPAN></LABEL></TD>
                                        <TD><LABEL style="padding: 4px; height: 25px; float: left;">
                                            <INPUT class="inlineblock" name="radiobutton" value="radiobutton"
                                                   type="radio">
                                            <SPAN class="zx_yh inlineblock"></SPAN></LABEL></TD>
                                    </TR>
                                    <TR>
                                        <TD height="35">
                                            <LABEL style="padding: 4px; height: 25px; float: left;">
                                                <INPUT class="inlineblock" name="radiobutton" value="radiobutton"
                                                       type="radio">
                                                <SPAN class="gh_yh inlineblock"></SPAN></LABEL></TD>
                                        <TD><LABEL style="padding: 4px; height: 25px; float: left;">
                                            <INPUT class="inlineblock" name="radiobutton" value="radiobutton"
                                                   type="radio">
                                            <SPAN class="hz_yh inlineblock"></SPAN></LABEL></TD>
                                        <TD><LABEL style="padding: 4px; height: 25px; float: left;">
                                            <INPUT class="inlineblock" name="radiobutton" value="radiobutton"
                                                   type="radio">
                                            <SPAN class="np_yh inlineblock"></SPAN></LABEL></TD>
                                        <TD><LABEL style="padding: 4px; height: 25px; float: left;">
                                            <INPUT class="inlineblock" name="radiobutton" value="radiobutton"
                                                   type="radio">
                                            <SPAN class="yz_yh inlineblock"></SPAN></LABEL></TD>
                                    </TR>
                                    <TR>
                                        <TD height="35"><LABEL style="padding: 4px; height: 25px; float: left;">
                                            <INPUT class="inlineblock" name="radiobutton" value="radiobutton"
                                                   type="radio">
                                            <SPAN class="szfz_yh inlineblock"></SPAN></LABEL></TD>
                                        <TD><LABEL style="padding: 4px; height: 25px; float: left;">
                                            <INPUT class="inlineblock" name="radiobutton" value="radiobutton"
                                                   type="radio">
                                            <SPAN class="sh_yh inlineblock"></SPAN></LABEL></TD>
                                        <TD><LABEL style="padding: 4px; height: 25px; float: left;">
                                            <INPUT class="inlineblock" name="radiobutton" value="radiobutton"
                                                   type="radio">
                                            <SPAN class="shpd_yh inlineblock"></SPAN></LABEL></TD>
                                        <TD>
                                            <LABEL style="padding: 4px; height: 25px; float: left;">
                                                <INPUT class="inlineblock" name="radiobutton" value="radiobutton"
                                                       type="radio">
                                                <SPAN class="xy_yh inlineblock"></SPAN></LABEL></TD>
                                    </TR>
                                    </TBODY>
                                </TABLE>
                            </TD>
                            <TD bgColor="#c3e5b3" vAlign="middle" align="left">&nbsp;</TD>
                        </TR>
                        <TR>
                            <TD bgColor="#c3e5b3" width="30">&nbsp;</TD>
                            <TD bgColor="#c3e5b3" vAlign="middle" align="left">
                                <TABLE border="0" cellSpacing="0" cellPadding="0" width="100%" height="40">
                                    <TBODY>
                                    <TR>
                                        <TD class="Top_tit" height="80" width="150" align="right">充值金额：</TD>
                                        <TD>
                                            <DIV class="Top_submit">
                                                <INPUT id="money" class="Top_nums" name="money" maxLength="4"
                                                       value="100" type="text">
                                                <INPUT class="Top_sub" name="btnGotobank" value="提交查询内容" type="submit">
                                            </DIV>
                                        </TD>
                                    </TR>
                                    </TBODY>
                                </TABLE>
                            </TD>
                            <TD bgColor="#c3e5b3" vAlign="middle" align="left">&nbsp;</TD>
                        </TR>
                    </FORM>
                    </TBODY>
                </TABLE>
            </TD>
        </TR>
        </TBODY>
    </TABLE>
    <P style="background: rgb(195, 229, 179); padding-left: 75px;">普通用户网银充值手续费为1%，VIP会员充值手续费为0.6%。</P>

    <P class="Msg_tip_box">易宝网银充值
        -无需人工充值，自动到账，支持国内20余家银行，充值立即发布任务吧。<BR>
        充值如有问题请联系充值帮助客服：<IMG border="0" src="/images/button_old_170.gif"> <A style="color: rgb(31, 52, 21);"
                                                                             href="http://wpa.qq.com/msgrd?v=3&amp;uin=123456789&amp;site=qq&amp;menu=yes"
                                                                             target="_blank">123456789 </A></P>
</LI>
<LI style="display:none;">
    <TABLE style="border-width: medium 1px; border-style: none solid; border-color: currentColor rgb(149, 186, 222);"
           border="0" cellSpacing="0" cellPadding="0" width="100%" align="center">
        <TBODY>
        <TR>
            <TD>
                <TABLE border="0" cellSpacing="0" cellPadding="0" width="100%">
                    <TBODY>
                    <TR vAlign="top">
                        <TD bgColor="#80b6f5">&nbsp;</TD>

                        <TD bgColor="#80b6f5" align="left">
                            <TABLE border="0" cellSpacing="0" cellPadding="0" width="100%">
                                <TBODY>
                                <TR>
                                    <TD style="line-height: 28px; padding-top: 15px; padding-left: 15px;" colSpan="3">
                                        <FONT style="width: 725px; height: 35px; color: white; letter-spacing: 2px; font-size: 16px; font-weight: bold; border-bottom-color: white; border-bottom-width: 1px; border-bottom-style: dotted; float: left;">提别提醒：支付宝转账请在付款说明中填写平台登录名，转账成功后，联系客服qq，确认充值情况，因为淘宝已经关闭匿名收款服务，故而需要人工协助。</FONT><BR>
                        <SPAN style=\'padding: 9px 90px; color: rgb(0, 0, 0); font-family: "Microsoft YaHei","微软雅黑"; font-size: 13px; float: left;\'>支付宝转账账号：<FONT
                                style="font-weight: bold;" color="black">123456@qq.com</FONT>  姓名：<FONT
                                style="font-weight: bold;" color="black">吴兰洋</FONT> <BR>
                                    转账时请在付款说明填写： <SPAN style="color: black; font-weight: bold;">';echo $member['username'];echo '</SPAN><BR>
                                    转账完毕后，在此页面验证支付宝交易号，一分钟内自动到账。</SPAN></TD>
                                </TR>
                                <form method="post" onsubmit="return checkForm3();" style="">

                                    <TR style="display: block">
                                        <TD width="399" align="left"> ';echo $sys_hash_code2;echo '
                                            <input type="hidden" name="type" value="alipay"/>

                                            <DIV class="Top_tit2" align="left" height="80" width="150">提交支付宝的交易号：</DIV>
                                            <DIV class="Top_submit2">
                                                <INPUT id="alipayId" class="Top_nums2" name="alipayId" type="text">

                                                <INPUT class="Top_sub2" value="提交查询内容" type="submit">
                                            </DIV>
                                        </TD>

                                    </TR>
                                    <tr style="display: block">
                                        <TD width="399" align="left">
                                            <DIV class="Top_tit5" align="right" height="80" width="150">充值金额：&nbsp;&nbsp;&nbsp;</DIV>
                                            <DIV class="Top_submit2">
                                                <INPUT id="alipayMoney" class="Top_nums5" name="alipayMoney"
                                                       type="text">
                                            </DIV>
                                        </TD>
                                    </tr>
                                </FORM>
                                </TBODY>
                            </TABLE>
                        </TD>

                    </TR>
                    <TR>
                        <TD bgColor="#80b6f5" vAlign="middle" align="left">&nbsp;</TD>
                        <TD bgColor="#80b6f5" height="50" vAlign="middle" align="right"><A
                                style="color: white; padding-right: 75px; font-size: 14px; font-weight: bold;"
                                href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1850/"
                                target="_blank">如何获取支付宝交易号？</A></TD>
                    </TR>
                    <TR>
                        <TD bgColor="#80b6f5" colSpan="3" align="center"><IMG src="/images/dsgf.gif"></TD>
                    </TR>
                    </TBODY>
                </TABLE>
            </TD>
        </TR>
        </TBODY>
    </TABLE>
    <P class="Msg_tip_box2">支付宝转账充值 -
        自动充值，备注正确账户名验证交易号一分钟内自动到账。<BR>
        充值如有问题请联系充值帮助客服：<IMG border="0" src="/images/button_old_170.gif"> <A style="color: rgb(31, 52, 21);"
                                                                             href="http://wpa.qq.com/msgrd?v=3&amp;uin=188239038&amp;site=qq&amp;menu=yes"
                                                                             target="_blank">188239038</A></P>
    <!--<p><font style="color:#fd7601; letter-spacing:2px;font-size:15px; font-weight:bold;">提别提醒：支付宝升级，30分钟后开启。</font></p>-->
</LI>
<LI style="display: none;">
    <TABLE style="border-width: medium 1px; border-style: none solid; border-color: currentColor rgb(255, 178, 126);"
           border="0" cellSpacing="0" cellPadding="0" width="100%" bgColor="#ffac90">
        <TBODY>
        <TR>
            <TD width="20">&nbsp;</TD>
            <TD style="line-height: 28px; padding-top: 15px;" vAlign="middle" align="left">
                <form name="myForm" method="post" id="myForm" onsubmit="return checkForm();">
                    <div>';echo $sys_hash_code2;echo '</div>
                    <input type="hidden" name="type" value="card"/>
                    <TABLE border="0" cellSpacing="0" cellPadding="0" width="100%" height="40">
                        <TBODY>
                        <TR>
                            <TD style=\'color: rgb(0, 0, 0); font-family: "Microsoft YaHei","微软雅黑";\'
                                colSpan="5">点击复制充值卡商品地址： <STRONG
                                    style="color: rgb(253, 79, 19); font-size: 16px; font-weight: bold;"
                                    id="copy-100" onClick="alert();">100元</STRONG> | <STRONG
                                    style="color: rgb(253, 79, 19); font-size: 16px; font-weight: bold;"
                                    id="copy-1000">1000元</STRONG> | <STRONG
                                    style="color: rgb(253, 79, 19); font-size: 16px; font-weight: bold;"
                                    id="copy-2000">2000元</STRONG> | <STRONG
                                    style="color: rgb(253, 79, 19); font-size: 16px; font-weight: bold;"
                                    id="copy-3000">3000元</STRONG> | <STRONG
                                    style="color: rgb(253, 79, 19); font-size: 16px; font-weight: bold;"
                                    id="copy-5000">5000元</STRONG><BR>
                                第一步：在官方淘宝店铺拍下对应充值金额卡。<BR>
                                第二步：
                                拍下付款后，联系店主或是本站客服或获取卡号好密码。
                                <BR>
                                第三步：
                                登录本站，提交验证卡号和密码，存款立即到账。
                            </TD>
                        </TR>
                        <TR>
                            <TD class="Top_tit3" width="90" align="center">充值卡号：</TD>
                            <TD width="370">
                                <DIV class="Top_submit3">
                                    <INPUT id="cardId" class="Top_nums6" name="cardId" maxLength="28" type="text">
                                </DIV>
                            </TD>
                        </TR>
                        <TD class="Top_tit3" width="90" align="center"></TD>
                        <TR>

                            <TD class="Top_tit6" width="90" align="center">充值密码：</TD>
                            <TD width="370">
                                <DIV class="Top_submit3">
                                    <INPUT id="cardPwd" class="Top_nums7" name="cardPwd" maxLength="32" type="text">
                                    <INPUT class="Top_sub6" name="btnRemitnow" id="btnRemitnow" value="提交查询内容"
                                           type="submit">
                                </DIV>
                            </TD>

                        </TR>
                        </TBODY>
                    </TABLE>
                </FORM>
            </TD>
            <TD bgColor="#ffac90" vAlign="middle" align="left">&nbsp;</TD>
        </TR>
        </TBODY>
    </TABLE>
    <P class="Msg_tip_box3">淘宝购卡 - 卡密充值区。<BR>
        充值如有问题请联系充值帮助客服：<IMG
                border="0" src="/images/button_old_170.gif"> <A style="color: rgb(31, 52, 21);"
                                                                href="http://wpa.qq.com/msgrd?v=3&amp;uin=1371752337&amp;site=qq&amp;menu=yes"
                                                                target="_blank">1371752337</A></P>
    <!--<p><font style="color:#fd7601; letter-spacing:2px;font-size:15px; font-weight:bold;">提别提醒：暂停淘宝购卡充值，请使用其他方式进行充值。</font></p>-->
</LI>
<LI style="display: none;">
    <TABLE style="border-width: medium 1px; border-style: none solid; border-color: currentColor rgb(57, 130, 203);"
           border="0" cellSpacing="0" cellPadding="0" width="100%" align="center">
        <TBODY>
        <TR>
            <TD>
                <TABLE border="0" cellSpacing="0" cellPadding="0" width="100%">
                    <TBODY>
                    <TR>
                        <TD bgColor="#80b6f5" width="20">&nbsp;</TD>
                        <TD bgColor="#80b6f5" vAlign="middle" align="left">
                            <TABLE border="0" cellSpacing="0" cellPadding="0" width="100%"
                                   height="40">
                                <TBODY>
                                <TR>
                                    <TD style=\'color: rgb(0, 0, 0); line-height: 28px; padding-top: 15px; font-family: "Microsoft YaHei","微软雅黑";\'
                                        colSpan="3"><SPAN style="color: white; font-size: 16px; font-weight: bold;">财付通目前只接受直接转账，转账时请预留您的大麦户帐号名。</SPAN><BR>
                                        转账需要在上班时间联系充值客服：<IMG border="0"
                                                             src="/images/button_old_170.gif"> <A
                                                style="color: rgb(0, 0, 0);"
                                                href="http://wpa.qq.com/msgrd?v=3&amp;uin=188239038&amp;site=qq&amp;menu=yes"
                                                target="_blank">188239038</A><BR>
                                        大麦户平台唯一财付通收款帐号：<STRONG
                                                style="color: black; font-size: 16px; font-weight: bold;">273334116</STRONG>
                                        姓名：<STRONG><SPAN
                                                style="color: black; font-size: 16px; font-weight: bold;">刘杨</SPAN><BR>
                                            <BR>
                                        </STRONG></TD>
                                </TR>
                                <TR height="100">
                                    <TD width="100" align="center"><SPAN
                                            class="zh_tbcai"></SPAN></TD>
                                    <TD class="Top_tit4" width="100" align="center">财付通帐号:</TD>
                                    <TD>
                                        <DIV class="Top_submit4">
                                            <INPUT class="Top_nums4" name="textfield22"
                                                   readOnly="" value="273334116" type="text">
                                            <A class="Top_sub4"
                                               onclick="return copyComment(\'273334116\',\'复制成功\')" href="javascript:;"></A>
                                        </DIV>
                                    </TD>
                                </TR>
                                </TBODY>
                            </TABLE>
                        </TD>
                        <TD bgColor="#80b6f5" vAlign="middle"
                            align="left">&nbsp;</TD>
                    </TR>
                    </TBODY>
                </TABLE>
            </TD>
        </TR>
        </TBODY>
    </TABLE>
    <P class="Msg_tip_box4">财付通转账 -
        转账请在客服上班时间进行操作，提供转账截图加平台账号。<BR>
        充值如有问题请联系充值帮助客服：<IMG border="0" src="/images/button_old_170.gif"> <A style="color: rgb(31, 52, 21);"
                                                                             href="http://wpa.qq.com/msgrd?v=3&amp;uin=188239038&amp;site=qq&amp;menu=yes"
                                                                             target="_blank">188239038</A></P>
</LI>
</UL>
</DIV>
</DIV>
</DIV>
<DIV class="cle"></DIV>
<SCRIPT type="text/javascript">
    $(\'.Top_list > a\').click(function () {';echo '
        var tn = $(\'.Top_list > a\').index(this);
        $(\'.Top_list > a\').removeClass();
        $(this).addClass(\'nov\' + tn);
        $(\'.Top_list p:eq(\' + $(\'.Top_list > a\').index(this) + \')\').removeClass();
        $(\'.Top_list b:neq(\' + $(\'.Top_list > a\').index(this) + \')\').hide();
        $(\'.Top_list b:eq(\' + $(\'.Top_list > a\').index(this) + \')\').show();
        $(\'.Top_list p:eq(\' + $(\'.Top_list > a\').index(this) + \')\').addClass(\'Top_13 Top_list_txt\' + tn);
        $(\'.Top_cun_box li\').css({';echo 'display: \'none\'';echo '});
        $(\'.Top_cun_box li:eq(\' + $(\'.Top_list > a\').index(this) + \')\').css({';echo 'display: \'block\'';echo '});
        if (tn == 2 && !_copay) {';echo '
            copy_all();
            _copay = true;
        ';echo '}
    ';echo '});
    function copyComment(text, tip) {';echo '
        if (tip == void(0)) tip = \'复制成功\';
        if (is_ie) {';echo '
            clipboardData.setData(\'Text\', text);
            alert(tip);
        ';echo '} else if (prompt(\'请你使用 Ctrl+C 复制到剪贴板\', text)) {';echo '
            alert(tip);
        ';echo '}
        window.location.href = \'https://www.tenpay.com/v2/account/pay/index.shtml?ADTAG=TENPAY_V2.FUKUAN.JIESHAO.C2C\';
        return false;
    ';echo '}
    function checkForm1() {';echo '
        var checks = [
            ["isNumber", "money", "充值金额"]
        ];
        var result = doCheck(checks);
        if (result)
            return true;
        return result;
    ';echo '}
    function checkForm2() {';echo '
        var checks = [
            ["isNumber", "Tid", "订单编号"]
        ];
        var result = doCheck(checks);
        if (result)
            return avoidReSubmit();
        return result;
    ';echo '}
    function checkForm5() {';echo '
        var ordersn = document.getElementById(\'pay_order_sn\').value;
        var ordersn = ordersn.replace(\' \', \'\');
        if (isNum(ordersn) && (ordersn.length == 8 || ordersn.length == 16 || ordersn.length == 28)) {';echo '
            return avoidReSubmit();
        ';echo '}
        document.getElementById(\'pay_order_sn\').value = ordersn;
        alert(\'交易号必须是8位或16位或28位纯数字形式，注意不能含有空格，如果粘贴过来的不行请手工输入进去，还不行换个浏览器试下，如有疑问请联系客服帮忙解决\');
        return false;
    ';echo '}

</SCRIPT>
<script type="text/javascript">
    var tab_0 = ';if($tab=='card'){echo '
    1
    {';echo '
        elseif
        ';echo $tab;echo ' == \'chinabank\'
    ';echo '}
    2
    {';echo '
        elseif
        ';echo $tab;echo ' == \'alipay\'
    ';echo '}
    3
    {';echo '
        elseif
        ';echo $tab;echo ' == \'tenpay\'
    ';echo '}
    4
    ';}echo '
        ;
        function setTab(i) {';echo '
            getObj("tab_" + tab_0).className = "";
            getObj("tab_" + i).className = "tab_on";
            $("#box_" + tab_0).hide();
            $("#box_" + i).show();
            tab_0 = i;
        ';echo '}

        function checkForm() {';echo '
            var checks = [
                ["isNumber", "cardId", "充值卡号"],
                ["isEmpty", "cardPwd", "充值密码"]
            ];
            var result = doCheck(checks);
            if (result)
                return avoidReSubmit();
            return result;
        ';echo '}

        function checkForm2(obj) {';echo '
            var gold = parseInt(getValue("money"));
            var tax = gold * ';echo $memberFields['vip']?5:7;echo ' / 1000;
            var all = gold + tax;
            var str = "您选了充值" + gold + "元，另需支付手续费" + tax + "元\\n\\n本次充值共需支付" + all + "元\\n\\n";

            return confirm(str + "您确定要通过网上银行在线支付么？");
        ';echo '}

        function checkForm3() {';echo '
            var checks = [
                ["isEmpty", "alipayId", "支付宝交易号"],
                ["isEmpty", "alipayMoney", "充值金额"],
                ["isMoney", "alipayMoney", "充值金额"]
            ];
            var result = doCheck(checks);
            if (result) {';echo '
                if (!isMatch(/^[0-9]{';echo '16';echo '}$/, getValue("alipay")))
                    return doAlert("支付宝交易号为16位数字，请在“支付宝”的“消费记录”中查看", $("#alipayId"));
            ';echo '}
            if (result)
                return avoidReSubmit();
            return result;
        ';echo '}

        function checkForm4() {';echo '
            var checks = [
                ["isEmpty", "tenpay", "财付通帐号"]
            ];
            var result = doCheck(checks);
            if (result)
                return avoidReSubmit();
            return result;
        ';echo '}

        function checkForm5() {';echo '
            var result = true;
            if (!isMatch(/^[a-zA-Z0-9_-]+(\\.[a-zA-Z0-9_-]+)*(\\.)*@[a-zA-Z0-9_-]+(\\.[a-zA-Z0-9_-]+)+$/, getValue("alipay")) && !isMatch(/^[0-9]{';echo '11';echo '}$/, getValue("alipay")))
                return doAlert("支付宝账号必须为Email地址或是11位手机号码", $("#alipay"));
            if (result)
                return avoidReSubmit();
            return result;
        ';echo '}

        function copyAccount(text) {';echo '
            if (is_ie) {';echo '
                clipboardData.setData(\'Text\', text);
                alert("复制成功");
            ';echo '} else if (prompt(\'请你使用 Ctrl+C 复制到剪贴板\', text)) {';echo '
                alert("复制成功");
            ';echo '}
            return false;
        ';echo '}

        function countTax(obj) {';echo '
            //var num = parseInt(obj.value);
            //var tax = parseInt(num * 7);
            //getObj("yeeNum").innerHTML = num + parseFloat(tax / 1000);
            //getObj("yeeTax").innerHTML = parseFloat(tax / 1000);
        ';echo '}

        function showCardTip(url) {';echo '
            var html = \'<div style="font-size:14px; font-weight:bold; text-align:left; padding:20px;">购买时正确填写如图：<br /><img src="';echo $weburl2;echo 'images/ico/cardtip.png" alt="卡密购买正确填写图示" />\' +
                    \'<div class="f_b_red f_14" style="padding-top:10px;">卡密自动发货已升级，请认真填写【所在区/服】和【游戏账号】，否则不能自动发货充值；<span class="f_blue">填写正确则自动把卡密发送到平台站内信；</span></div> \' +
                    \'<div><div style="padding-top:20px;text-align:center;"><input name="btnCancel" type="button" class="btn_2" onclick="parent.doCut();buyCard(\\\'\' + url + \'\\\');" id="btnCancel" value="我知道了【注：请勿使用掌柜号购买】" /></div>\';
            dialog(550, 550, "如何正确购买卡密", "", html);
            return false;
        ';echo '}

        function buyCard(url) {';echo '
            copyComment(url, \'复制链接成功\');
            //return openPrdUrl(url);
        ';echo '}
</script>

<SCRIPT>
    $("input[name=\'radiobutton\']").click(function () {';echo '
        $("input[name=\'radiobutton\']").each(function () {';echo '
            $(this).parent(\'label\').css(\'border\', \'\');
        ';echo '})
        $(this).parent(\'label\').css(\'border\', \'1px solid #32870B\');

    ';echo '})
    $("#nov0").click(function () {';echo '
        $("#money").focus();
    ';echo '})
    $("#nov1").click(function () {';echo '
        $("#pay_order_sn").focus();
    ';echo '})
    $("#nov2").click(function () {';echo '
        $("#Tid").focus();
    ';echo '})

</SCRIPT>
<script type="text/javascript">
    if(\'';echo $type;echo '\' == \'alipay\')
        $(\'#nov1\').click();
</script>
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