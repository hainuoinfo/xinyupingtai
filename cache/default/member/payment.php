<?php $_tplModify=filemtime('D:\xinyupingtai\cache\default\member\payment.php');if(filemtime('D:\xinyupingtai\templates\default\header.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\member\menu.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\xinyupingtai\templates\default\member\payment.htm','D:\xinyupingtai\cache\default\member\payment.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/member/';$title='申请提现 - 互动吧平台';$keywords='';$description='';$cssList=array(0=>'http://d.hainuo.info/css/member/member.css');$jsList=array(0=>'http://d.hainuo.info/javascript/index/task.js');echo '
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
<link href="http://d.hainuo.info/css/bbs/bbs.css" rel="stylesheet" type="text/css" />
';}echo '
<script type="text/javascript" src="http://d.hainuo.info/javascript/jquery.min.js"></script><script type="text/javascript" src="http://d.hainuo.info/javascript/common.func.js"></script>
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
  <DIV id="cash" class="right">
  ';if($indexMessage){echo '<div class=\'error_panel\'><div>';echo $indexMessage;echo '</div></div>';}echo '
		';if($_showmessage){echo '<div class=\'msg_panel\'><div>';echo $_showmessage;echo '</div></div>';}echo '
    <DIV class="tixian_text">
      <P class="f16">下一个提现处理时间：<SPAN class="lvse">12:00点 </SPAN></P>
      <P>请在<SPAN class="lanse"><STRONG>0小时59分</STRONG></SPAN>内申请提现，您是';if($memberFields['shuake']==1){echo '职业刷客';}elseif($memberFields['vip']==1||$memberFields['vip']==2||$memberFields['vip']==3){echo '';echo $vip;echo '';}else{echo '';echo $credits;echo '';}echo ' ，今日您还可以进行
	  <SPAN class="hongse"><STRONG>';echo $paymentCountMax;echo ' </STRONG></SPAN>次提现，每日最大可提现额度为 ￥';echo $paymentMoneyMax;echo ' 元。今天已经使用 ';echo $paymentCount;echo ' 次，还能提现￥';echo  $paymentMoneyMax-$paymentMoney;echo '元。<A class="hongse" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/vip/?type=add" target="_blank">立即申请
      <SPAN style="font-weight: bold;">VIP</SPAN></A>提高提现次数。</P>
      <P>提现客服 <IMG border="0" src="/images/button_old_170.gif"> 
	  <A href="http://wpa.qq.com/msgrd?v=3&amp;uin=';echo $kefu_qq;echo '&amp;site=qq&amp;menu=yes" target="_blank">';echo $kefu_qq;echo '</A></P>
    </DIV>
    <DIV class="bq_menu">
	<A id="tab_1" ';if($m=='bank'){echo ' class="nov"';}echo ' href="';echo $baseUrl;echo '?m=bank">银行卡提现</A>
	<A id="tab_2" ';if($m=='alipay'){echo ' class="nov"';}echo ' href="';echo $baseUrl;echo '?m=alipay">支付宝提现</A>
	<A id="tab_3" ';if($m=='taobao'){echo ' class="nov"';}echo ' href="';echo $baseUrl;echo '?m=taobao">淘宝商品提现</A>
	<A id="tab_4" ';if($m=='paylog'){echo ' class="nov"';}echo ' href="';echo $baseUrl;echo '?m=paylog">提现记录</A></DIV>
	';if($m=='bank'){echo '
    <DIV id="box_1">
	';if(cfg::getBoolean('payment','bankStatus')){echo '
      <form method="post" onsubmit="return checkbank();">
		<div>';echo $sys_hash_code2;echo '</div>
        <INPUT name="type" value="bank" type="hidden">
        <TABLE style="font-size: 14px; margin-top: 20px;" border="0" cellSpacing="0" cellPadding="0" width="95%" align="center">
          <TBODY>  
		 
            <TR>
              <TD height="30" vAlign="middle" width="20%" align="right">提现用户：</TD>
              <TD><STRONG id="bankname" class="lanse">';echo $member['username'];echo '/';echo $member['truename'];echo '</STRONG></TD>
            </TR>
            <TR>
              <TD height="40" vAlign="middle" width="20%" align="right">银行卡号：</TD>
              <TD>
			  <INPUT id="bankId" class="txbk1" name="bankId" type="text"></TD>
            </TR>
			<TR>
              <TD height="40" vAlign="middle" width="20%" align="right">银行户名：</TD>
              <TD>
			  <INPUT id="truename" class="txbk1" name="truename" type="text"></TD>
            </TR>
			<TR>
              <TD height="40" vAlign="middle" width="20%" align="right">银行开户所在地：</TD>
              <TD>
			  <INPUT id="bankAddress" class="txbk1" name="bankAddress" type="text"></TD>
            </TR>
			<TR>
              <TD height="40" vAlign="middle" width="20%" align="right">提现银行：</TD>
              <TD>
			  <select class="txbk" name="bankType">
													';$__list=cfg::getList('payment','bankType');echo '
													';if($__list){foreach($__list as $v){echo '
													<option value="';echo $v['value'];echo '"';if($v['checked']){echo ' selected="selected"';}echo '>';echo $v['key'];echo '</option>
													';}}echo '
												</select>
            </TR>
            <TR>
              <TD height="40" vAlign="middle" width="20%" align="right">提现金额：</TD>
              <TD>
			  <INPUT id="money" class="txbk" name="money" type="text">/元&nbsp;&nbsp;&nbsp;
			  可用余额:<STRONG class="hongse">';echo $memberFields['money'];echo '</STRONG>元</TD>
            </TR>
			<TR>
              <TD height="40" vAlign="middle" width="20%" align="right">操作码：</TD>
              <TD>
			  <INPUT id="pwd2" class="txbk" name="pwd2" type="password"></TD>
            </TR>
            <TR>
              <TD style="position: relative;" height="30" vAlign="middle" colSpan="2" align="left">
	          <P style="left: 123px; width: 175px; position: relative;">
                  <INPUT class="tjsq_btn" value="提交查询内容" type="submit">
                </P></TD>
            </TR>
          </TBODY>
        </TABLE>
      </FORM>
	  ';}else{echo '
	<div style="text-align:center" class="f_b_red">银行卡提现已禁用</div>
		';}echo '
    </DIV>
	';}elseif($m=='alipay'){echo '
		<div id="box_2">
			';if(cfg::getBoolean('payment','alipayStatus')){echo '
			<form method="post" onsubmit="return checkalipay();">
			<div>';echo $sys_hash_code2;echo '</div>
			<input name="type" value="alipay" type="hidden">
	        <table style="margin-top:20px;font-size:14px;" align="center" border="0" cellpadding="0" cellspacing="0" width="95%">
			  <tbody>
			  <TR>
              <TD height="30" vAlign="middle" width="20%" align="right">提现用户：</TD>
              <TD><STRONG id="realname" class="lanse">';echo $member['username'];echo '/';echo $member['truename'];echo '</STRONG></TD>
            </TR>
            <TR>
              <TD height="40" vAlign="middle" width="20%" align="right">支付宝账号：</TD>
              <TD>
			  <INPUT id="alipay" class="txbk1" name="alipay" type="text"></TD>
            </TR>
			<TR>
              <TD height="40" vAlign="middle" width="20%" align="right">支付宝户名：</TD>
              <TD>
			  <INPUT id="nickname" class="txbk1" name="nickname" value="wulanyang" type="text"></TD>
              <tr>
                <td align="right" height="40" valign="middle" width="20%">提现金额：</td>
                <td><input name="money" class="txbk" id="money" type="text">
                  /元&nbsp;&nbsp;&nbsp; 可用余额:<strong class="hongse">';echo $memberFields['money'];echo '</strong>元(手续费: ';echo $mp;echo ' 元)</td>
              </tr>
			  <TR>
              <TD height="40" vAlign="middle" width="20%" align="right">操作码：</TD>
              <TD>
			  <INPUT id="pwd2" class="txbk" name="pwd2" type="password"></TD>
            </TR>
              <tr>
                <td colspan="2" style="position:relative;" align="left" height="30" valign="middle"><p style="width:175px; position:relative; left:123px;"><input class="tjsq_btn" type="submit">
				</p></td>
              </tr>
            </tbody></table>
			</form>
			';}else{echo '
			<div style="text-align:center" class="f_b_red">支付宝提现已禁用</div>
			';}echo '
			</div>
			';}elseif($m=='taobao'){echo ' 
			 <div id="box_3">
			';if(cfg::getBoolean('payment','taobaoStatus')){echo '
			<form name="myForm" method="post" id="myForm" onsubmit="return checktao();">
            <div>';echo $sys_hash_code2;echo '</div>
			<input name="type" value="taobao" type="hidden">
	        <table style="margin-top:20px;font-size:14px;" align="center" border="0" cellpadding="0" cellspacing="0" width="95%">
              
			  <tbody>
            <TR>
              <TD height="30" vAlign="middle" width="20%" align="right">提现用户：</TD>
              <TD><STRONG id="username" name="username" class="lanse">';echo $member['username'];echo '/';echo $member['truename'];echo '</STRONG></TD>
            </TR>
            <TR>
              <TD height="40" vAlign="middle" width="20%" align="right">掌柜账号：</TD>
              <TD>
			  <INPUT id="nickname" class="txbk" name="nickname" type="text"></TD>
            </TR>
			<TR>
              <TD height="40" vAlign="middle" width="20%" align="right">提现淘宝商品地址：</TD>
              <TD>
			  <INPUT id="shopurl" class="txbk2" name="shopurl" type="text"></TD>
                
              </tr>
              
              <tr>
                <td align="right" height="40" valign="middle" width="20%">提现金额：</td>
                <td><input name="money" class="txbk" id="money" type="text">
                  /元&nbsp;&nbsp;&nbsp; 可用余额:<strong class="hongse">';echo $memberFields['money'];echo '</strong>元</td>
              </tr>
			  <TR>
              <TD height="40" vAlign="middle" width="20%" align="right">操作码：</TD>
              <TD>
			  <INPUT id="pwd2" class="txbk" name="pwd2" type="password"></TD>
            </TR>
              <tr>
                <td colspan="2" style="position:relative;" align="left" height="30" valign="middle">
				<p style="width:175px; position:relative; left:123px;">
				<input class="tjsq_btn" type="submit">
				</p>
				</td>
              </tr>
            </tbody></table>
			</form>
			';}else{echo '
			<div style="text-align:center" class="f_b_red">淘宝商品提现已禁用</div>
			';}echo '
			</div>
			';}elseif($m=='paylog'){echo '
	      <div id="box_4">
	        <table align="center" border="0" cellpadding="0" cellspacing="0" width="95%">
              <tbody><tr>
                <td height="45"><p class="tx_jl">提现记录&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 已成功提现：<strong class="hongse">';if($allMoney>0){echo '';echo $allMoney;echo ' ';}else{echo ' 0 ';}echo '</strong> 元</p> </td>
              </tr>
              <tr>
                <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tbody>
				  <tr>
                    <td class="txjl_bg1" height="37" width="10"></td>
                    <td class="txjl_bg2" align="center" height="37" valign="middle" width="20%">流水号</td>
                    <td class="txjl_bg2" align="center" height="37" valign="middle" width="25%">创建时间</td>
                    <td class="txjl_bg2" align="center" height="37" valign="middle" width="12%">金额(元)</td>
                    <td class="txjl_bg2" align="center" height="37" valign="middle" width="25%">资金渠道</td>
                    <td class="txjl_bg2" align="center" height="37" valign="middle" width="25%">状态</td>
                    <td class="txjl_bg3" height="37" width="10"></td>
                  </tr>
	';if($payList){foreach($payList as $v){echo ' 
	<TR>
    <TD class="x_xian" height="25">&nbsp;</TD>
    <TD class="xuxian" vAlign="middle" width="10%" align="center">';echo $v['id'];echo '</TD>
    <TD class="xuxian" vAlign="middle" width="33%" align="center">';echo date('Y-m-d H:i:s',$v['timestamp1']);echo '</TD>
    <TD class="xuxian" vAlign="middle" width="15%" align="center">
	<STRONG class="lvse">';echo $v['money'];echo '</STRONG></TD>
    <TD class="xuxian" vAlign="middle" width="15%" align="center">';if($v['type']=='taobao'){echo '淘宝商品';}elseif($v['type']=='alipay'){echo '支付宝转账';}elseif($v['type']=='bank'){echo '银行卡提现';}elseif($v['type']=='yeepay'){echo '易宝提现';}echo '</TD>
    <TD class="time xuxian" vAlign="middle" width="15%" align="center">';echo $status[$v['status']];echo '</TD>
    <TD class="x_xian" height="25">&nbsp;</TD>
   </TR>
	';}}echo '			  
                </tbody></table></td>
              </tr>
              
            </tbody></table>
			  <div id="page"></div>
			  <div class="cle"></div>
			</div>
			
    <P style="height: 25px;"></P>
    <DIV>
      <UL>
        <LI style="font-size: 13px; font-weight: bold;" 
  class="lanse">每天几次处理我的提现呢,多久到账？</LI>
        <LI style="padding-bottom: 5px;">我们将在每天12点，19点，22点处理统一处理之前的提现申请，处理后1小时内完成。</LI>
        <LI style="font-size: 13px; font-weight: bold;" class="lanse">为什么提现说：信息不符？</LI>
        <LI style="padding-bottom: 5px;">此类情况分为两种，一是提现预留的真实姓名跟卡号不符，第二类是要旗帜鲜明执行的：不支持信用卡提现，提现资金来源必须是接手任务，推广奖励，回收麦点。充值的存款无法直接提现。</LI>
        <LI style="font-size: 13px; font-weight: bold;" class="lanse">我的存款只有500以下，如何提现？</LI>
        <LI>亲，由于提现量日益增大，500元以下请通过发布任务，或者财付通提现，500元以上支持网银免手续费提现。</LI>
      </UL>
    </DIV>
    <P style="height: 35px;"></P>
	';}echo '
  </DIV>
</DIV>
</DIV>
    <DIV class="cle"></DIV>
    <DIV class="cle"></DIV>
<script type="text/javascript">
$(function(){';echo '
	$(\'#shopurl\').blur(function(){';echo '
		var obj=$(this);
		var shopUrl=obj.val();
		if (/^http:\\/\\/(?:[\\w-]+\\.)+(?:(?:taobao)|(?:tmall))\\.com\\/item\\.htm\\?(?:item_)?(?:num_)?id=(\\d+).*$/i.test(shopUrl)){';echo '
			var shopId=RegExp.$1
			$(\'#nickname\').waitImg().getData(\'';echo $weburl2;echo 'ajax/data.php?action=taobao&operation=nickName&shopId=\'+shopId,false,function(){';echo '
				$(\'#nickname\').waitImg(false);
			';echo '});
		';echo '}
	';echo '});
';echo '});
var tab_0 = 1;
function setTab(i) {';echo '
	getObj("tab_" + tab_0).className = "";
	getObj("tab_" + i).className = "tab_on";
	$("#box_" + tab_0).hide();
	$("#box_" + i).show();
	tab_0 = i;
';echo '}

function checktao() {';echo '
   var checks = [
		["isEmpty", "nickname", "掌柜名"],
		["isEmpty", "shopurl", "提现淘宝商品地址"],
		["isNumber", "money", "提现金额"], 
		["isEmpty", "pwd2", "操作码"] ];
	var result = doCheck(checks);
	var urlPattern = /^http:\\/\\/([\\w-]+\\.)+((taobao)|(tmall))\\.com\\/item\\.htm\\?(item_)?(num_)?id=\\d+(.)*$/i;
	if (result && !urlPattern.test(getValue("shopurl"))) {';echo '
		return doAlert("商品网址不正确，商品网址格式应为：\\n\\nhttp://item.taobao.com/item.htm?id=xxxxx\\n\\n请在店铺首页打开商品然后再复制商品网址", getObj("shopurl"));		
	';echo '}
	if (result && getValue("money")<';echo $taobaoMinMoney;echo ') {';echo '
	    doAlert("淘宝商品地址提现金额不能低于';echo $taobaoMinMoney;echo '元", getObj("money"));
	    return false;
	';echo '}
	';if(cfg::getFloat('payment','taobaoSXF')>0){echo '
	if (result) {';echo '
	    var gold = parseInt(getValue("money"));
	    var tax = gold * ';echo cfg::getFloat('payment','taobaoSXF');echo ';
	    var all = gold + tax;
	    result = confirm("本次提现" + gold + "元，手续费" + tax + "元\\n\\n将扣除存款" + all + "元\\n\\n您确认要进行提现么？");
	';echo '}
	';}echo '
	if (result)
		return avoidReSubmit();
	return result;
';echo '}

function checkalipay() {';echo '
   var checks = [
		["isEmpty", "alipay", "提现支付宝账号"],
		["isEmpty", "nickname", "支付宝真实姓名"],
		["isNumber", "money", "提现金额"], 
		["isEmpty", "pwd2", "操作码"] ];
	var result = doCheck(checks);
	if (result) {';echo '
	    if (!isMatch(/^[a-zA-Z0-9_-]+(\\.[a-zA-Z0-9_-]+)*@[a-zA-Z0-9_-]+(\\.[a-zA-Z0-9_-]+)+$/, getValue("alipay")) && !isMatch(/^[0-9]{';echo '11';echo '}$/, getValue("alipay")))
	        return doAlert("提现支付宝账号必须为Email地址或是11位手机号码", $("#alipay"));
	    if (getValue("money")<';echo $alipayMinMoney;echo ')
	        return doAlert("支付宝提现金额不能低于';echo $alipayMinMoney;echo '元", $("#money"));
	';echo '}
	if (result) {';echo '
	    var gold = parseInt(getValue("money"));
	    var tax = gold * ';echo cfg::getFloat('payment','alipaySXF');echo ';
	    var all = gold + tax;
	    result = confirm("本次提现" + gold + "元，手续费" + tax + "元\\n\\n将扣除存款" + all + "元\\n\\n您确认要进行提现么？");
	';echo '}
	if (result)
		return avoidReSubmit();
	return result;
';echo '}
function checkbank() {';echo '
   var checks = [
		["isEmpty", "bankId", "银行卡号"],
		["isEmpty", "truename", "银行户名"],
		[\'isEmpty\', \'bankAddress\', \'银行卡开户地\'],
		["isNumber", "money", "提现金额"], 
		["isEmpty", "pwd2", "操作码"] ];
	var result = doCheck(checks);
	if (result) {';echo '
	    if (getValue("money")<';echo $bankMinMoney;echo ')
	        return doAlert("支付宝提现金额不能低于';echo $bankMinMoney;echo '元", $("#money"));
	';echo '}
	if (result) {';echo '
	    var gold = parseInt(getValue("money"));
	    var tax = gold * ';echo cfg::getFloat('payment','bankSXF');echo ';
	    var all = gold + tax;
	    result = confirm("本次提现" + gold + "元，手续费" + tax + "元\\n\\n将扣除存款" + all + "元\\n\\n您确认要进行提现么？");
	';echo '}
	if (result)
		return avoidReSubmit();
	return result;
';echo '}

function getPswTwo(obj) {';echo '
    if (!confirm("点击【确定】将会重置您的操作码\\n\\n您确定要重置您的操作码么？"))
        return false;
    obj.disabled = true;
	
	return false;
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