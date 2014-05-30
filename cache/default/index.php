<?php $_tplModify=filemtime('F:\github\xinyupingtai\cache\default\index.php');if(filemtime('F:\github\xinyupingtai\templates\default\headerBase.htm')>$_tplModify||filemtime('F:\github\xinyupingtai\templates\default\footer.htm')>$_tplModify){include(template::load_base('F:\github\xinyupingtai\templates\default\index.htm','F:\github\xinyupingtai\cache\default\index.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/';echo '﻿';$title='快来刷信誉是最专业的淘宝信誉互刷平台专供店铺掌柜相互刷信誉淘宝免费刷钻平台';$keywords='互动吧';$description='互动吧平台';$cssList=array(0=>'http://t.hainuo.info/css/index/index.css');$jsList=array(0=>'http://t.hainuo.info/javascript/index/silde.js');echo '
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
<link href="http://t.hainuo.info/css/bbs/bbs.css" rel="stylesheet" type="text/css" />
';}echo '
<script type="text/javascript" src="http://t.hainuo.info/javascript/jquery.min.js"></script><script type="text/javascript" src="http://t.hainuo.info/javascript/common.func.js"></script>
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
                    <A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/info/?username=';echo $member['username'];echo '">';echo $member['username'];echo '</A>
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
          <A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/message/?type=setting" rel="nofollow" target="_top">提醒设置</A>
          </DIV></DIV>
          </DIV>
          </LI>
					<li style="margin-top: -2px;">|</li>
					<li class="menu-item">
						<div class="menu">
							<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/selfservice/" style="width:52px;margin:0;" class="menu-hd" tabindex="0">账号设置<b></b></a>
							<div style="width: 90px;line-height:1.7;" class="menu-bd" id="menu-0">
							  <div style="padding:8px 5px;" class="menu-bd-panel">
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/selfservice/">找回密码</a>
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/selfservice/">找回操作码</a>
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/selfservice/">更多操作</a>
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
							<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/selfservice/" style="width:52px;margin:0;" class="menu-hd" tabindex="0">账号设置<b></b></a>
							<div style="width: 90px;line-height:1.7;" class="menu-bd" id="menu-0">
							  <div style="padding:8px 5px;" class="menu-bd-panel">
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/selfservice/">找回密码</a>
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/selfservice/">找回操作码</a>
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/selfservice/">更多操作</a>
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
<script type="text/javascript" src="/images/tinyslider.js"></script>
<script type="text/javascript" src="/images/index.js"></script>
<script type="text/javascript" src="/javascript/index/task.js"></script>
<!--[if lte IE 6]>
<script type="text/javascript" src="/javascript/cn/DD_belatedPNG_0.0.7a.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix(\'*\');
</script>
<![endif]-->

<script>
	var slideshow=new TINY.slider.slide(\'slideshow\',{';echo '
		id:\'slider\',
		auto:4,
		resume:true,
		vertical:false,
		navid:\'slider_nav\',
		activeclass:\'activeSlide\',
		position:0,
		rewind:false,
		elastic:true
	';echo '});

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
<!--banner 登录框开始-->
<div id="m_banner">
    <div class="kd">
        <div class="banner" id="banner">
            <div class="slider" id="slider" style="width: 655px; height: 310px; overflow: hidden;">
            <ul style="left: 0px; width: 3930px;" class="s_u">
               <li><a class="button-1" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/user/reg/"></a>
               </li>
               <li>
                    <img src="/images/new-banner-1.gif" height="310" width="655" /><img src="/images/new-banner-2.gif" height="310" width="655">
                    <a class="button-2" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/user/reg/"></a>
                </li>
               <li>
                    <img src="/images/new-banner-3.gif" height="310" width="655">
                    <a class="button-3" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/user/reg/"></a>
               </li>
            </ul>
            </div>
            <ul class="slider_nav" id="slider_nav">
                <a class="" href="javascript:void(0)" onclick="slideshow.pos(0)">1</a>
                <a class="activeSlide" href="javascript:void(0)" onclick="slideshow.pos(1)">2</a>
                <a class="" href="javascript:void(0)" onclick="slideshow.pos(2)">3</a>
            </ul>
            
        </div>
        
        <div class="login">
		';if($memberLogined){echo '
	
			<ul id="goone">
			<li style="">
			<span style="width: 100%; float: left; text-align: center; font-size: 14px;">一个真实的淘宝信誉平台期待您的加入</span></li>
			<li style="margin: 10px 0 5px 5px;font-size:16px;display:inline;">用户名：<font style="font-size: 14px;color:#fe5500">';echo $member['username'];echo '</font></li>
			<li style="margin: 5px 0 5px 5px;font-size:16px;display:inline;">存款：
			<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/" style="font-size: 14px;color:#fe5500">';echo $memberFields['money'];echo '</a></li>
			<li style="margin: 5px 0 5px 5px;font-size:16px;display:inline;">麦点：
			<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/PayDetails/?type=2" style="font-size: 14px;color:#fe5500">';echo $memberFields['fabudian'];echo '</a></li>
			<li style="margin: 5px 0 5px 5px;font-size:16px;display:inline;">积分：
			<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/PayDetails/?type=3" style="font-size: 14px;color:#fe5500">';echo $memberFields['credits'];echo '</a></li>
			<li style="margin: 5px 0 5px 5px;font-size:16px;display:inline;">登陆次数：
			<a href="" style="font-size: 14px;color:#fe5500">';echo $member['log_count'];echo '</a></li>
			<li style="text-align: center;margin-top: 10px ;font-size:16px;">
			<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/tao/"><img src="images/goone.png" height="49/" width="275"></a></li>
			<div class="touimg"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member"><img src="';echo $memberFields['avatar'];echo '" height="100" width="100"></a></div>
			</ul>
		';}else{echo '
		
            <form method="post" name="myForm" id="myForm" onsubmit="return checkForm();">
              <div> ';echo $sys_hash_code2;echo ' </div>
               <ul>
                    <li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/reg/" class="reg">&nbsp;</a></li>
                    <li class="t1">用户名：</li>
                    <li><input name="username" id="lusername" class="u_bk" maxlength="16" type="text" value="';echo isset($username)?$username:(isset($cookie['loginUsername'])?$cookie['loginUsername']:'');echo '">
                 </li>
                    <li class="t2" id="username_msg">平台用户名</li>
                    <li class="t1">密&nbsp;&nbsp; 码：</li>
                    <li><input name="password" id="lpassword" class="u_bk" maxlength="16" type="password"></li>
                    <li class="t2" id="password_msg">输入6位以上密码</li>
					<center>';if($indexMessage){echo '<div style="color:#FF0000">';echo $indexMessage;echo '</div>';}echo '</center>
                    <li>
                   <input class="l_btn" id="login_sub" type="submit" name="btnSubmit">
                      <p class="jz">
					  <input type="checkbox" name="cookietime" id="cookietime" value="31536000" /> 记住我 
					  <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/forgotpwd/" target="_blank" class="chengse">忘记密码?</a>
					  </p>
                    </li>
                </ul>
            </form>
			';}echo '
        </div>
    </div>
</div>

<div id="content">
		<!--发布方，接收方开始-->
		<div id="c_bk">
			<p class="f_tit">发布方任务存款转化成网店收款</p>
			<ul class="fbf">
				<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/BuyPoint/"></a></li>
				<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/taskout/"></a></li>
				<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/taskout/"></a></li>
				<li style="margin-top:50px;"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/taskout/"></a></li>
			</ul>
			<div class="c_kt"></div>
			<p class="j_tit">接手方网店付款转化为平台收款</p>
			<ul class="jsf">
				<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/taskin/"></a></li>
				<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/taskin/"></a></li>
				<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/taskin/"></a></li>
				<li style="margin-top:50px;"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/taskin/"></a></li>
			</ul>
		</div>
		<!--重点布告开始-->
		<div id="c_bk2">
			<a href="#" class="sp_img" target="_blank"><img src="images/sp_img.jpg" height="154" width="227">视频操作指南</a>
              ';$forumSimple=bbs_forums::getForumSimple('skill','ename');$list=bbs_thread::getThreadList2("fid='$forumSimple[id]'",'timestamp desc',1,7);echo '
			<ul class="c_info">
				<h4 class="bt"></h4>
				';if($list){foreach($list as $thread){echo '
                  <li>
                    <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t';echo $thread['id'];echo '/" target="_blank" title="';echo $thread['title'];echo '"><strong>';echo common::cutstr($thread['title'],15);echo '</strong></a><span>';echo date('Y-m-d H:i:s',$v['stimestamp']);echo '</span>
                  </li>
                ';}}echo '
			</ul>
		</div>
		<!--正在发生开始-->
		<div id="c_bk3" class="quctl">
			<ul class="c_info ajax_i" style="left:15px;overflow:hidden;height:215px;">
				<h4 class="bt2"></h4>
                ';if($nowList){foreach($nowList as $v){echo '
				<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info.php?username=';echo $v['susername'];echo '" class="lanse" target="_blank">';echo $v['susername'];echo '</a><span style="float:left">发布任务网店提升 <strong class="chengse">+1</strong></span><span class="date">';echo date('m-d',$v['stimestamp']);echo '</span>
                </li>
                ';}}echo '
			</ul>
		</div>
        <script>
		var lastTime=1;
		var allData=[];
		function _getNowTask(){';echo '
			var data={';echo '';echo '};
			if (lastTime==1){';echo '
				data = {';echo 'frist:1';echo '};
			';echo '}else
				data = {';echo 'lastTime:lastTime';echo '};
				
			$.post(\'/ajax/getNowTask.php\',data,function(request){';echo '
				lastTime = request.nowLookTime;
				_addData(request.data);
			';echo '},\'json\');
		';echo '}
		
		function _addData(newData){';echo '
			var count=0;
			var str,newStr;
			if (newData!=null){';echo '
				str=_renderData(allData,false);
				newStr = _renderData(newData,true);
				$(\'.ajax_i li\').remove();
				$(\'.c_info .bt2\').after(str);
				$(\'.c_info .bt2\').after(newStr);
				$("[info=\'new\']").fadeIn(2000);
				if (allData.length==0)
					allData = newData;
				else{';echo '
					for(var i=newData.length-1;i>=0;i--)
						allData.unshift(newData[i]);
				';echo '}
				allData = allData.slice(0,7);
			';echo '}else{';echo '
				str=_renderData(allData,false);
				$(\'.ajax_i li\').remove();
				$(\'.c_info .bt2\').after(str);
			';echo '}
		';echo '}
		
		function _renderData(Data,type){';echo '
			var str=\'\',info=\'\';
			if (type){';echo '
				info=\'info="new" style="display:none"\';
			';echo '}
			for(var key in Data){';echo '
				str +="<li "+info+" ><a href=\'/user/info/?username="+encodeURI(Data[key].susername)+"\' class=\'lanse\' target=\'_blank\'>"+Data[key].susername+"</a><span style=\'float:left\'>  发布任务获得信誉 <strong class=\'chengse\'>+1</strong></span><span class=\'date\'>"
				if (lastTime-Data[key].ctimestamp>3000)
					 str+=\'\';
				 else if (lastTime-Data[key].ctimestamp<60)
					 str+=lastTime-Data[key].ctimestamp+3+\'秒前\';
				 else
					 str+=parseInt((lastTime-Data[key].ctimestamp)/60)+\'分钟前\';
				 str+= \'</span></li>\';
			';echo '}
			return str;
		';echo '}
		//setInterval(_getNowTask,3000);
		</script>
        
		<!--任务类表开始-->
		<div id="c_bk2" class="reListTitle" style="height:348px;">
		  <table align="center" border="0" cellpadding="0" cellspacing="0" width="95%">
              <tbody><tr>
                <td class="x_tit" height="48" align="left" valign="middle" width="164">任务编号</td>
                <td class="x_tit" height="48" align="left" valign="middle" width="75">发布人</td>
                <td class="x_tit" height="48" align="left" valign="middle" width="93">任务价格</td>
                <td class="x_tit" height="48" align="left" valign="middle">发布者要求</td>
                <td height="48" align="left" valign="middle" width="63">操作</td>
              </tr>
';$query=$db->query("select * from (select * from {$pre}task where status in ('1','2','3','4','5','6','7','8','9') order by status,svip desc,point desc,stimestamp desc$limit) t1 left join {$pre}memberfields t2 on t2.uid=t1.suid limit 5");$_sqlList=array();while($line=$db->fetch_array($query))$_sqlList[]=$line;foreach($_sqlList as $k=>$v){echo '
';$v['bLevel']=member_credit::getLevel($v['credits']);echo '			    
              <tr> 
                <td class="x_xian" height="54" align="left" valign="middle"><span class="';if($v['vistWay']==1){echo ' l ';}elseif($v['times']>=1){echo 's ';}else{echo 'x ';}echo '" title="';echo $v['credits'];echo '"></span><strong>';echo $v['id'];echo '</strong><br>
                <span class="f11">';echo date('Y-m-d H:i:s',$v['stimestamp']);echo '</span></td>
                <td class="x_xian" align="left" valign="middle"><a class="lanse" title="接任务后方可查看到对方QQ号码" target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info.php?username=';echo $v['susername'];echo '">';echo string::getXin2($v['susername']);echo '</a><br><span class="f11">exp:';echo $v['point'];echo '</span></td>
                <td class="x_xian" align="left" valign="middle"><span class="aq2" title="平台担保：此任务卖家已缴纳全额担保存款，买家可放心购买，任务完成时，买家平台账号自动获得相应存款。">';echo $v['price'];echo '</span></td>
				<td class="x_xian" align="left" valign="middle"><div style="width:117px; height:40px; text-align:center;overflow:hidden; vertical-align:middle;"><span class="yred" title="任务接手付款后，立即对宝贝进行好评并打五星！">';echo $lang['times'][$v['times']];echo '</span></div></td>
                <td class="x_xian" align="left" valign="middle"><span class="chengse">';if($v['status']==1){echo '等待接手';}else{echo '已接手，任务进行中';}echo '</span></td>
              </tr>
';}echo '

           </tbody></table>
		</div>
        <!--平台总金额-->
        <div id="c_bk3" style="height:348px;">
			<ul class="c_info" style="left:15px;">
				<h4 class="jine">
					<!--大麦户平台安全担保资金流水：<span class="sz">79958615</span>元-->
					大麦户平台安全担保资金，请您平台网店同步操作
				</h4>
				<div class="qh_btn">
					<a href="javascript:;" class="nov">充值动态</a>
					<a href="javascript:;">提现动态</a>
				</div>
				<div id="c_bnov" class="c_bnov">
               
					<div>
					';if($topList){foreach($topList as $v){echo '
					<li><span class="user lanse">';echo string::getXin($v['username'],4);echo '</span><span class="come">';if($v['type']==card){echo '充值卡充值';}echo '';if($v['type']==alipay){echo '支付宝充值';}echo '';if($v['type']==yeepay){echo '网银充值';}echo '</span><span class="jg1">';echo $v['money'];echo '</span><span class="date1">';echo date('m-d',$v['ctimestamp']);echo '</span>
					</li>
                  	';}}echo '
					</div>
					<div style="display:none;">
					';if($payList){foreach($payList as $v){echo '
					<li><span class="user lanse">';echo string::getXin($v['username'],3);echo '</span><span class="come">';if($v['type']==alipay){echo '支付宝提现';}echo '';if($v['type']==taobao){echo '淘宝商品提现';}echo '';if($v['type']==tenpay){echo '财付通提现';}echo '';if($v['type']==bank){echo '银行卡提现';}echo '</span><span class="jg1">';echo $v['money'];echo '</span><span class="date1">';echo date('m-d',$v['timestamp1']);echo '</span></li>
					';}}echo '
					</div>
				</div>			
			</ul>
		</div>
        <!--我是接收方，我是发布方-->
		<div id="c_bk" style="height:439px;">

			<div class="wb_left">
                  ';$forumSimple=bbs_forums::getForumSimple('skill','ename');$list=bbs_thread::getThreadList2("fid='$forumSimple[id]'",'timestamp desc',1,4);echo '
				<ul class="line">
					<h4 class="bt"><strong><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t';echo $thread['id'];echo '/">我是接手方</a></strong></h4>
					<p class="wb">接手淘宝信誉任务请注意不要使用阿里旺旺来催促任务，请使用对方留下的QQ联系。</p>
                    ';if($list){foreach($list as $thread){echo '
					<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t';echo $thread['id'];echo '/" target="_blank" title="';echo $thread['title'];echo '">';echo common::cutstr($thread['title'],12);echo '</a><span class="date">';echo date('Y-m-d H:i:s',$v['stimestamp']);echo '</span></li>
					';}}echo '
				</ul>
                
				<ul class="line">
					<h4 class="bt2"><strong><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t';echo $thread['id'];echo '/">我是发布方</a></strong></h4>
					<p class="wb">注册成功后需要首先设置掌柜和操作密码后才能正式开始刷信用。1个麦点≈1个信誉</p>
                     ';if($list){foreach($list as $thread){echo '
					<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t';echo $thread['id'];echo '/" target="_blank" title="';echo $thread['title'];echo '">';echo common::cutstr($thread['title'],12);echo '</a><span class="date">';echo date('Y-m-d H:i:s',$v['stimestamp']);echo '</span></li>
                    ';}}echo '
				</ul>
				<ul class="line">
					<h4 class="bt3"><strong><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t';echo $thread['id'];echo '/">掌柜经验</a></strong></h4>
					<p class="wb">我们是网商互动平台，你帮别人提升一次，别人帮你提升一次， 资金有流动，但无损失！</p>
                     ';if($list){foreach($list as $thread){echo '
					<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t';echo $thread['id'];echo '/" target="_blank" title="';echo $thread['title'];echo '">';echo common::cutstr($thread['title'],12);echo '</a><span class="date">';echo date('Y-m-d H:i:s',$v['stimestamp']);echo '</span></li>
				     ';}}echo '
				</ul>
				<ul class="line">
					<h4 class="bt4"><strong><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t';echo $thread['id'];echo '/">问题&amp;建议</a></strong></h4>
					<p class="wb">您客观坦率的意见将激励我们不断改进提高，为您提供更丰富的商品和更优质的服务。</p>
                      ';if($list){foreach($list as $thread){echo '
					<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t';echo $thread['id'];echo '/" target="_blank" title="';echo $thread['title'];echo '">';echo common::cutstr($thread['title'],12);echo '</a><span class="date">';echo date('Y-m-d H:i:s',$v['stimestamp']);echo '</span></li>
                     ';}}echo '
				</ul>
			</div>
			<div class="wb_right">
				<ul class="zgd">
					<p>掌柜的<span class="jrsj">加入时间</span></p>
					   ';if($userList){foreach($userList as $v){echo '
					   <li><a target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info.php?username=';echo $v['username'];echo '">';echo $v['username'];echo '</a><span class="date">刚刚加入</span></li>
                       ';}}echo '
				</ul>
				<div class="tg">
					<p class="text">推荐一个会员就可以产生丰厚收入!做大麦户推广,轻松赚大钱！</p>
					<a class="jp1" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info.php?username=yiboqq">yiboqq</a>
					<a class="jp2" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info.php?username=wulanyang">wulanyang</a>
					<a class="jp3" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info.php?username=bitong">bitong</a>
					<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/spread/" class="tg_btn" title="加入大麦户推广" alt="加入大麦户推广">&nbsp;</a>
				</div>
			</div>
		</div>
	</div>
	<div class="cle"></div>        






<div style="display: block;" class="_bottom_bg">
</div>
	<div style="display: block;" class="_bottom">
		<div class="_c">
			<div class="_c_i">
				<div style="background: url(/images/zcfb.png) repeat scroll 0% 0% transparent; width: 500px; height: 25px; float: left; margin-top: 15px;"></div>
			</div>
			<div class="_c_b">
			<a id="loginimg" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/login/">
				<img src="/images/dxh.gif" style="margin: 10px 15px;">
			</a>
			<a id="zhuceimg" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/reg/">&nbsp;</a></div>
			<div class="_c_cl"></div>
		</div>
	</div>
<script>
$(window).scroll( function(){';echo '
	var h = $(this).scrollTop(),o=$(\'._bottom_bg,._bottom\');
	if (h>=160 && z_userinfo==null){';echo '
		o.show();
	';echo '}else
		o.hide();
';echo '});
$(\'._c_cl\').click(function(){';echo '
	$(\'._bottom_bg,._bottom\').hide();
';echo '})
</script>

<script>
	var slideshow=new TINY.slider.slide(\'slideshow\',{';echo '
		id:\'slider\',
		auto:4,
		resume:true,
		vertical:false,
		navid:\'slider_nav\',
		activeclass:\'activeSlide\',
		position:0,
		rewind:false,
		elastic:true
	';echo '});

</script>
';echo '﻿<div id="footer">
		<p><span class="chengse">官方QQ号码：1371752337</span> （加群请注明大麦户）</p>
		<p class="lanse"><a href="#">关于我们</a>|<a href="#">联系我们</a>|<a href="#">大麦户规则</a>|<a href="#">网站地图</a>|<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '" target="_blank">淘宝信誉查询</a> </p>
		<p style="text-align:center;">
	
		<p class="lanse">客户服务热线：02968929109   Copyright © 2012-2020 Damaihu.com All RightsReserved    大麦户版权所有 <a href="#" target="_blank">粤ICP备13037934号</a><span style="display:none">
</span></p>
	</div>
	</div>
    </div>';echo '

	<div class="center">
	  <div style="top: 550px; left: auto; right: 60px; position: fixed;" id="tool_footer">
		  <a id="tool_top_footer" onclick="javascript:To_top();" title="返回顶部"></a>
		  <a id="tool_buy_footer" onclick="javascript:location.href=\'/help/taskout/\'" title="购买麦点发布任务，信誉立即提升！"></a>
		  <a id="tool_release_footer" onclick="javascript:location.href=\'/help/taskin/\'" title="我有时间接任务拍宝贝，赚取麦点换现金！"></a>
		</div>
    </div>
';?>