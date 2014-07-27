<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\member\userdata.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\member\menu.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\member\userdata.htm','D:\damaihu\xinyupingtai7\cache\default\member\userdata.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/member/';$title='资料维护 - 互动吧平台';$keywords='';$description='';$cssList=array(0=>'http://damaihu.tertw.net/css/member/info.css',1=>'http://damaihu.tertw.net/css/member/member.css');echo '
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
<DIV id="content">
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
';if($_showmessage){echo '<div class=\'msg_panel\'><div>';echo $_showmessage;echo '</div></div>';}echo '
';if($indexMessage){echo '<div class=\'error_panel\'><div>';echo $indexMessage;echo '</div></div>';}echo '

<DIV class="bq_menu2">
<A ';if($type=='index'){echo ' class="nov"';}echo ' href="';echo $baseUrl;echo '?type=index">修改个人资料</A>
<A ';if($type=='pass'){echo ' class="nov"';}echo ' href="';echo $baseUrl;echo '?type=pass">修改登录密码</A>
<A ';if($type=='safepass'){echo ' class="nov"';}echo ' href="';echo $baseUrl;echo '?type=safepass">修改安全操作码</A>
<A ';if($type=='GetPass'){echo ' class="nov"';}echo ' href="';echo $baseUrl;echo '?type=GetPass">取回安全操作码</A>
<A ';if($type=='ProtectPass'){echo ' class="nov"';}echo ' href="';echo $baseUrl;echo '?type=ProtectPass">修改密码保护</A></DIV><BR>
';if($type=='index'){echo '
<form name="myForm" method="post" id="myForm" enctype="multipart/form-data" onsubmit="return checkForm1();">
';echo $sys_hash_code2;echo '
<TABLE border="0" cellSpacing="0" cellPadding="0" width="100%" align="center">
  <TBODY>
  <TR>
    <TD>
      <TABLE border="0" cellSpacing="0" cellPadding="0" width="100%">
        <TBODY>
        <TR>
          <TD height="35">&nbsp;</TD>
          <TD height="40" vAlign="middle" width="20%" align="right">用户名：</TD>
          <TD vAlign="middle" width="80%" align="left"> <SPAN class="chengse2 strong">';echo $member['username'];echo '</SPAN></TD>
          <TD>&nbsp;</TD></TR>
        <TR>
          <TD height="35">&nbsp;</TD>
          <TD style="line-height: 45px;" height="40" vAlign="top" 
            align="right">头  像：</TD>
          <TD vAlign="middle" align="left">
            <TABLE border="0" cellSpacing="0" cellPadding="0" width="100%">
              <TBODY>
              <TR>
                <TD colSpan="2"><SPAN class="xginfo_tx"><IMG id="user_avatar" 
                  src="';echo $memberFields['avatar'];echo '" width="87" height="87"></SPAN>
                  <P style="margin: 25px 0px 0px;">建议图片大小 
                  :150px*150px,图片格式为.jpg，.gif，.bmp</P></TD></TR>
              <TR>
                <TD height="45" width="320">
				<input  name="userPic" type="file" style="margin-top:8px; width:228px;" id="userPic" />
				</TD>
                <TD></TD></TR></TBODY></TABLE></TD>
          <TD>&nbsp;</TD></TR>
        <TR>
          <TD height="35">&nbsp;</TD>
          <TD height="40" vAlign="middle" align="right">手机号码：</TD>
          <TD vAlign="middle" align="left"> <STRONG 
            class="chengse2">';if(!$member['status']){echo '';echo $member['mobilephone'];echo '';}else{echo '';echo string::getXin($member['mobilephone'],3,5);echo '';}echo '&nbsp;&nbsp;';if(!$member['status']){echo '账号未激活，立即 <a href="javascript:;" onclick="dialog(460,460,\'手机短信激活帐户\',\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/dialog/active/\');return false;" class="link_o">短信激活</a>';}echo '</STRONG></TD>
          <TD>&nbsp;</TD></TR>
        <TR>
          <TD height="35">&nbsp;</TD>
          <TD height="40" vAlign="middle" align="right">QQ号码：</TD>
          <TD vAlign="middle" align="left"><INPUT id="qq" class="text_normal" 
            name="qq" value="';echo $member['qq'];echo '" type="text"></TD>
          <TD>&nbsp;</TD></TR>
        <TR>
          <TD height="35">&nbsp;</TD>
          <TD height="40" vAlign="middle" align="right">真实姓名：</TD>
          <TD vAlign="middle" align="left">
		  <INPUT id="truename" class="text_normal" name="truename" value="';echo $member['truename'];echo '" type="text"></TD>
          <TD>&nbsp;</TD></TR>
        <TR>
          <TD height="35">&nbsp;</TD>
          <TD height="40" vAlign="middle" align="right">Email：</TD>
          <TD vAlign="middle" align="left">
		  <input name="email" type="text" id="email" class="text_normal" maxlength="100" value="';echo $member['email'];echo '" /></TD>
          <TD>&nbsp;</TD></TR>
        <TR>
          <TD height="35">&nbsp;</TD>
          <TD height="40" vAlign="middle" align="right">性别：</TD>
          <TD vAlign="middle" align="left">
		  <label for=\'__sex__0\'>
							<input name=\'sex\' type=\'radio\' value=\'1\' id=\'__sex__0\'';if($member['sex']==1){echo ' checked=\'checked\'';}echo ' />
							男</label>
							&nbsp;&nbsp;
							<label for=\'__sex__1000\'>
							<input name=\'sex\' type=\'radio\' value=\'2\' id=\'__sex__1000\'';if($member['sex']==2){echo ' checked=\'checked\'';}echo '  />
							女</label>
							&nbsp;&nbsp;</td>
		 
          <TD>&nbsp;</TD></TR>
        <TR>
          <TD height="35">&nbsp;</TD>
          <TD height="40" vAlign="middle" align="right">开启异地登陆短信验证：</TD>
          <TD align="left">开启：<INPUT id="remote" name="remote" value="1" type="radio"> 
            &nbsp;&nbsp;关闭：<INPUT id="remote" name="remote" value="0" type="radio">&nbsp;&nbsp;&nbsp;</TD>
          <TD></TD></TR>
        <TR>
          <TD height="35">&nbsp;</TD>
          <TD height="40" vAlign="middle" align="right">签收快递发货省份：</TD>
          <TD vAlign="middle" align="left">			   
               &nbsp;发布同省快递签收任务时的省份，一旦选定不可修改</TD>
          <TD>&nbsp;</TD></TR>
        <TR>
          <TD height="35">&nbsp;</TD>
          <TD height="40" vAlign="middle" align="right">签收快递收货省份：</TD>
          <TD vAlign="middle" align="left"><SELECT id="pin3" 
              name="pin3"><OPTION value="0">请选择</OPTION><OPTION 
              value="1">北京市</OPTION><OPTION value="2">天津市</OPTION><OPTION value="3">河北省</OPTION><OPTION 
              value="4">山西省</OPTION><OPTION value="5">内蒙古</OPTION><OPTION value="6">江苏省</OPTION><OPTION 
              value="7">安徽省</OPTION><OPTION value="8">山东省</OPTION><OPTION value="9">辽宁省</OPTION><OPTION 
              value="10">吉林省</OPTION><OPTION value="11">黑龙江</OPTION><OPTION 
              value="12">上海市</OPTION><OPTION value="13">浙江省</OPTION><OPTION 
              value="14">江西省</OPTION><OPTION value="15">福建省</OPTION><OPTION 
              value="16">湖北省</OPTION><OPTION value="17">湖南省</OPTION><OPTION 
              value="18">河南省</OPTION><OPTION value="19">广东省</OPTION><OPTION 
              value="20">广西</OPTION><OPTION value="21">海南省</OPTION><OPTION 
              value="22">重庆市</OPTION><OPTION value="23">四川省</OPTION><OPTION 
              value="24">贵州省</OPTION><OPTION value="25">云南省</OPTION><OPTION 
              value="26">西藏</OPTION><OPTION value="27">陕西省</OPTION><OPTION 
              value="28">甘肃省</OPTION><OPTION value="29">宁夏</OPTION><OPTION 
              value="30">青海省</OPTION><OPTION value="31">新疆</OPTION></SELECT>				   
               &nbsp;签收同省快递签收任务时的省份，可选3个，选定不可修改</TD>
          <TD>&nbsp;</TD></TR><!--<tr>
				    <td height="35">&nbsp;</td>
				    <td height="40" align="right" valign="middle">签收快递发货详细信息：</td>
				    <td align="left" valign="middle"><input type="text" name="name1" size="8" maxlength="8" value="发件人姓名" onclick="if(this.value==\'发件人姓名\')this.value=\'\';" /> <input type="text" name="address1"  size="30" maxlength="150" value="发货地址" onclick="if(this.value==\'发货地址\')this.value=\'\';" /> <input type="text" name="tel1" size="15" maxlength="15" value="手机号码" onclick="if(this.value==\'手机号码\')this.value=\'\';" /> <input type="text" name="code1" size="8" maxlength="8" value="邮编" onclick="if(this.value==\'邮编\')this.value=\'\';" /></td>
				  </tr>-->
        <TR>
          <TD height="35">&nbsp;</TD>
          <TD height="40" vAlign="middle" align="right">签收快递收货详细信息：</TD>
          <TD vAlign="middle" align="left">
		  <INPUT onclick="if(this.value==\'收件人姓名\')this.value=\'\';" name="name2" maxLength="8" value="收件人姓名" size="8" type="text"> 
            <INPUT onclick="if(this.value==\'收货地址\')this.value=\'\';" name="address" value="';echo $member['address'];echo '" maxLength="150" value="收货地址" size="30" type="text"> 
			<INPUT onclick="if(this.value==\'手机号码\')this.value=\'\';" name="tel2" maxLength="15" value="手机号码" size="15" type="text"> 
            <INPUT onclick="if(this.value==\'邮编\')this.value=\'\';" name="code2" maxLength="8" value="邮编" size="8" type="text"></TD>
		</TR>
      
        
        <TR>
          <TD height="35">&nbsp;</TD>
          <TD height="40" vAlign="middle" align="right">安全操作码：</TD>
          <TD vAlign="middle" align="left">
		  <INPUT id="pwd3" class="text_normal" name="password2" type="password">&nbsp; 
			<SPAN class="STYLE1">*</SPAN>修改资料需要提供安全操作码&nbsp; &nbsp; ';echo $errMsg;echo '</TD>
          <TD></TD>
		</TR>
        <TR>
          <TD height="35">&nbsp;</TD>
          <TD height="70" vAlign="middle" align="right">&nbsp;</TD>
          <TD vAlign="middle" align="left">
		  <INPUT class="xginfo_qr" value="提交查询内容" type="submit"></TD>
          <TD></TD>
		</TR>
		</TBODY></TABLE></TD></TR></TBODY></TABLE>
</FORM>

<!--修改登陆密码-->
';}elseif($type=='pass'){echo '
<FORM method="post" name="myForm1" onsubmit="return checkForm2();">
<input type="hidden" name="type" value="pass">
';echo $sys_hash_code2;echo '
<TABLE border="0" cellSpacing="0" cellPadding="0" width="625">
  <TBODY>
  <TR>
    <TD style="border-bottom-color: rgb(204, 204, 204); border-bottom-width: 1px; border-bottom-style: solid;" 
    height="30" vAlign="middle" width="89" align="right">安全操作码：</TD>
    <TD style="color: rgb(135, 135, 135); border-bottom-color: rgb(204, 204, 204); border-bottom-width: 1px; border-bottom-style: solid;">
	<INPUT id="pwd3" class="aninput" name="pwd2" type="password"></TD>
   </TR>
  <TR>
    <TD height="30" vAlign="middle" align="right">新登录密码：</TD>
    <TD style="color: rgb(135, 135, 135);">
	<INPUT id="password" class="aninput" name="password" type="password"></TD>
  </TR>
  <TR>
    <TD height="30" vAlign="middle" align="right">确认密码：</TD>
    <TD><INPUT id="password2" class="aninput" name="password_" type="password"></TD>
  </TR>
  <TR>
    <TD> </TD>
    <TD><!--<input type="submit" class="xginfo_fs">-->
	<INPUT class="xginfo_qr" value="提交查询内容" type="submit"></TD></TR></TBODY></TABLE>
	</FORM>

<!--安全码-->
';}elseif($type=='safepass'){echo '
<FORM method="post" name="myForm1" onsubmit="return checkForm3();">
<input type="hidden" name="type" value="safepass">
';echo $sys_hash_code2;echo '
<TABLE border="0" cellSpacing="0" cellPadding="0" width="625">
  <TBODY>
  <TR>
    <TD style="border-bottom-color: rgb(204, 204, 204); border-bottom-width: 1px; border-bottom-style: solid;" 
    height="30" vAlign="middle" width="89" align="right">原安全操作码：</TD>
    <TD style="color: rgb(135, 135, 135); border-bottom-color: rgb(204, 204, 204); border-bottom-width: 1px; border-bottom-style: solid;">
	<INPUT id="pwd3" class="aninput" name="pwd2" type="password"></TD></TR>
  <TR>
    <TD height="30" vAlign="middle" align="right">新操作密码：</TD>
    <TD style="color: rgb(135, 135, 135);">
	<INPUT id="password2" class="aninput" name="password2" type="password"></TD></TR>
  <TR>
    <TD height="30" vAlign="middle" align="right">确认密码：</TD>
    <TD>
	<INPUT id="password2_" class="aninput" name="password2_" type="password"></TD></TR>
  <TR>
    <TD height="30" vAlign="middle" colSpan="2" align="left">';echo $errMsg;echo '</TD></TR>
  <TR>
    <TD> </TD>
    <TD><!--<input type="submit" class="xginfo_fs">-->
	<INPUT class="xginfo_qr" value="提交查询内容" type="submit"></TD></TR></TBODY></TABLE>
</FORM>
<!--取回安全码-->
';}elseif($type=='GetPass'){echo '
<FORM method="post" name="myForm1" onsubmit="return checkForm4();">
<input type="hidden" name="type" value="GetPass">
';echo $sys_hash_code2;echo '
<TABLE border="0" cellSpacing="0" cellPadding="0" width="625">
  <TBODY>
  <TR>
    <TD height="30" vAlign="middle" align="right">输入您的账号邮箱：</TD>
    <TD><INPUT style="width: 200px;" id="email" class="aninput" name="email" type="text"></TD>
  </TR>
  <TR>
    <TD> </TD>
    <TD><!--<input type="submit" class="xginfo_fs">-->
	<INPUT class="xginfo_qr" value="提交查询内容" type="submit"></TD>
   </TR>
  </TBODY>
</TABLE>
</FORM>
<!--修改密码保护-->
';}elseif($type=='ProtectPass'){echo '
<FORM method="post" name="myForm1" onsubmit="return checkForm5();">
<input type="hidden" name="type" value="ProtectPass">
';echo $sys_hash_code2;echo '
<TABLE border="0" cellSpacing="0" cellPadding="0" width="625">
  <TBODY>
  <TR>
    <TD height="30" vAlign="middle" width="89" align="right">选择问题：</TD>
    <TD style="color: rgb(135, 135, 135);">
	                            <select name=\'questionId\' id=\'questionId\' class=\'slt_normal\'>
									<option value=\'0\'';if(!$member['questionid']){echo ' selected=\'selected\'';}echo '>无安全问题</option>
									';if($questions){foreach($questions as $k=>$v){echo '
									<option value="';echo $k;echo '"';if($member['questionid']==$k){echo ' selected="selected"';}echo '>';echo $v;echo '</option>
									';}}echo '
								</select></TR>
  <TR>
    <TD height="30" vAlign="middle" align="right">问题的答案：</TD>
    <TD style="color: rgb(135, 135, 135);">
	<input name="answer" type="text" class="text_normal" id="answer" value="';echo $member['answer'];echo '" maxlength="20" /></TD></TR>
  <TR>
    <TD height="30" vAlign="middle" align="right">安全操作码：</TD>
    <TD><INPUT id="pwd3" class="aninput" name="pwd2" type="password"></TD></TR>
  <TR>
    <TD> </TD>
    <TD><!--<input type="submit" class="xginfo_fs">-->
	<INPUT class="xginfo_qr" value="提交查询内容" type="submit"></TD></TR></TBODY></TABLE>
	</FORM>
';}echo '

</DIV>
</DIV>
<DIV class="cle"></DIV>
<SCRIPT type="text/javascript">
function checkForm1() {';echo '
    var pwd3=$(\'#pwd3\').val();
    if (pwd3.length<6){';echo '
	alert(\'请输入安全操作码\');
	$(\'#pwd3\').focus();
	return false;
	';echo '}else{';echo '
	return true;
	';echo '}
';echo '}
function checkForm2() {';echo '
    var pwd3=$(\'#pwd3\').val();
	var password=$(\'#password\').val();
	var password2=$(\'#password2\').val();
    if (pwd3.length<6){';echo '
	alert(\'请输入您操作码\');
	$(\'#pwd3\').focus();
	return false;
	';echo '}
    else if (password.length<6){';echo '
	alert(\'新密码不少于6位\');
	$(\'#password\').focus();
	return false;
	';echo '}
    else if (password2.length<6){';echo '
	alert(\'确认密码不少于6位\');
	$(\'#password2\').focus();
	return false;
	';echo '}else{';echo '
	return true;
	';echo '}
';echo '}
function checkForm3() {';echo '
    var pwd3=$(\'#pwd3\').val();
	var password2=$(\'#password2\').val();
	var password2_=$(\'#password2_\').val();
    if (pwd3.length<6){';echo '
	alert(\'请输入您的操作码\');
	$(\'#pwd3\').focus();
	return false;
	';echo '}
	else if (password2.length<6){';echo '
	alert(\'请输入您的新操作码,长度不少于6位\');
	$(\'#password2\').focus();
	return false;
	';echo '}
	else if (password2_.length<6){';echo '
	alert(\'请确认您的新操作码,长度不少于6位\');
	$(\'#password2_\').focus();
	return false;
	';echo '}
	else{';echo '
	return true;
	';echo '}
';echo '}
function checkForm4() {';echo '
    var email=$(\'#email\').val();
    if (email.length<3){';echo '
	alert(\'请输入您的邮箱\');
	$(\'#email\').focus();
	return false;
	';echo '}else{';echo '
	return true;
	';echo '}
';echo '}
function checkForm5() {';echo '
    var answer=$(\'#answer\').val();
	var pw3=$(\'#pw3\').val();
    if (answer.length<1){';echo '
	alert(\'请输入您的问题答案\');
	$(\'#answer\').focus();
	return false;
	';echo '}
	else if (pw3.length<6){';echo '
	alert(\'请输入您的操作操作码\');
	$(\'#pw3\').focus();
	return false;
	';echo '}
	else{';echo '
	return true;
	';echo '}
';echo '}
</SCRIPT>

<DIV class="cle"></DIV>
</div>
';echo '<div id="footer">
		<p><span class="chengse">官方QQ号码：1371752337</span> （加群请注明大麦户）</p>
		<p class="lanse"><a href="#">关于我们</a>|<a href="#">联系我们</a>|<a href="#">大麦户规则</a>|<a href="#">网站地图</a>|<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '" target="_blank">淘宝信誉查询</a> </p>
		<p style="text-align:center;">
	
		<p class="lanse">客户服务热线：02968929109   Copyright © 2012-2020 Damaihu.com All RightsReserved    大麦户版权所有 <a href="#" target="_blank">粤ICP备13037934号</a><span style="display:none">
</span></p>
	</div>
	</div>
    </div>';?>