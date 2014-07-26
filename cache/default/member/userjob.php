<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\member\userjob.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\member\menu.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\member\userjob.htm','D:\damaihu\xinyupingtai7\cache\default\member\userjob.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/member/';$title='任务平台 - 互动吧平台';$keywords='';$description='';$cssList=array(0=>'http://damaihu.tertw.net/css/member/member.css');$jsList=array(0=>'http://damaihu.tertw.net/javascript/index/task.js');echo '
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
<LINK rel="stylesheet" type="text/css" href="/css/task.css">
<form name="aspnetForm" method="post" id="aspnetForm">
<div>
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
</div>
<script type="text/javascript">
$(document).ready(function(){';echo '
    //$("#userjob1>p:last").remove();
    //$("#userjob2>p:last").remove();
    
    $("#btncopy").click(function(){';echo '
        copyToClipboard($("#txtlink").val());
        return false;
    ';echo '});
';echo '});

function copyToClipboard(txt) {';echo '       
    if(window.clipboardData) {';echo '           
        window.clipboardData.setData("Text", txt);       
        alert("复制成功！")      
    ';echo '}else if(navigator.userAgent.indexOf("Opera") != -1) {';echo '       
        window.location = txt;       
    ';echo '}else if(window.netscape) {';echo '       
        try{';echo '       
            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");       
        ';echo '}catch(e) {';echo '       
            alert("被浏览器拒绝！\\n请在浏览器地址栏输入\'about:config\'并回车\\n然后将 \'signed.applets.codebase_principal_support\'设置为\'true\'");       
        ';echo '}       
        var clip = Components.classes[\'@mozilla.org/widget/clipboard;1\'].createInstance(Components.interfaces.nsIClipboard);       
        if (!clip)       
            return;       
        var trans = Components.classes[\'@mozilla.org/widget/transferable;1\'].createInstance(Components.interfaces.nsITransferable);       
        if (!trans)       
            return;       
        trans.addDataFlavor(\'text/unicode\');       
        var str = new Object();       
        var len = new Object();       
        var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);       
        var copytext = txt;       
        str.data = copytext;       
        trans.setTransferData("text/unicode",str,copytext.length*2);       
        var clipid = Components.interfaces.nsIClipboard;       
        if (!clip)       
            return false;       
        clip.setData(trans,null,clipid.kGlobalClipboard);       
        alert("复制成功！")       
    ';echo '}       
';echo '} 
var theForm = document.forms[\'aspnetForm\'];
if (!theForm) {';echo '
    theForm = document.aspnetForm;
';echo '}
function __doPostBack(eventTarget, eventArgument) {';echo '
    alert(\'此功能暂未开放！\');return;
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {';echo '
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    ';echo '}
';echo '}
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
        $(this).append("<i><img src=\'/images/hyzx/dadian.png\' /></i>");
      ';echo '}
  ';echo '})
  
  //遍历链接显示下划线
  $(".left_liebiao ul li:parent:not(\'#dilei\')").hover(function(i){';echo '
  
    num = $(this).children("a:eq(1)").attr("num");
    
    $(this).children("a:eq(1)").css("background-position","-489px "+ num +"px");
    if(urlname != $(this).children(\'a:eq(1)\').attr(\'name\')){';echo '
      $(this).append("<i><img src=\'/images/hyzx/dadian.png\' /></i>");
    ';echo '}
  ';echo '},function(){';echo '
  
    $(this).children("a:eq(1)").css("background-position","-355px "+ num +"px");
    if(urlname != $(this).children(\'a:eq(1)\').attr(\'name\')){';echo '
      $(this).children("i").remove();
    ';echo '}
  ';echo '});
  
  $("#dilei").hover(function(i){';echo '
    
    $(this).children("a:eq(1)").css("background-position","-139px -232px");
    $(this).append("<i><img src=\'/images/hyzx/dadian.png\' /></i>");
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
  //  $(".left_liebiao ul li:eq(0) a:eq(1)").css("background-position","-625px 4px");
  //';echo '}
';echo '});
</script>
        <style>
a:hover{';echo 'text-decoration: underline;';echo '}
.tupian_ico{';echo 'background: url("/images/hyzx/icon1.png") repeat scroll;';echo '}
.imgdian{';echo 'background: url("/images/hyzx/1.png") repeat scroll;';echo '}
.left_lan {';echo 'background:rgb(35, 148, 228);float: left;margin-top: 25px;width: 200px;height: 630px;';echo '}
.left_lan .left_rwdt {';echo 'background:none;color: #FFFFFF;cursor: pointer;font-family: "微软雅黑";font-size: 18px;font-weight: bold;position: relative;text-align: center;z-index: 10;float: left;';echo '}
.left_lan .left_rwdt .dian1{';echo 'height: 103px;position: absolute;right: 28px;top: 102px;width: 8px;background-position:0px 0px ;';echo '}
.left_lan .left_rwdt .dian2{';echo 'height: 103px;position: absolute;right: 28px;top: 261px;width: 8px;background-position:0px 0px ;';echo '}
.left_lan .left_rwdt .dian3{';echo 'height: 103px;position: absolute;right: 28px;top: 420px;width: 8px;background-position:0px 0px ;';echo '}
.left_lan .left_rwdt .renwu1 {';echo 'background-position: -68px -387px ;height: 45px;margin: 35px 35px 15px 35px;width: 135px;';echo '}
.left_lan .left_rwdt .left_twe{';echo 'background: #FECC7F;font-size: 14px;font-weight: normal;position: absolute;right: -55px;top: 31px;width: 80px;';echo '}
.left_lan .left_rwdt .left_twe ul{';echo 'float:left;width:100%;';echo '}
.left_lan .left_rwdt .left_twe ul li{';echo 'float:left;background: #259CE3;padding: 4px;position: relative;width: 100%;height:22px;';echo '}
.left_lan .left_rwdt .left_twe ul li img{';echo 'left: 12px;position: absolute;top: 12px;';echo '}
.left_lan .left_rwdt .left_twe ul li a{';echo 'float:left;width:100%;text-align: right;color:white;';echo '}
.left_lan .left_rwdt2 {';echo 'background:none;color: #FFFFFF;cursor: pointer;font-family: "微软雅黑";font-size: 18px;font-weight: bold;position: relative;text-align: center;z-index: 10;float: left;';echo '}
.left_lan .left_rwdt2 .renwu2 {';echo 'background-position: -69px -498px;height: 45px;margin: 10px 35px 15px;width: 135px;';echo '}
.left_lan .left_rwdt2 .renwu2 a{';echo 'width:100%;height:100%;float: left;';echo '}
.left_lan .left_liebiao{';echo 'float:left;position: relative;';echo '}
.left_lan .left_liebiao ul li {';echo 'height: 32px;line-height: 32px;overflow: hidden;width:200px;float:left;';echo '}
.left_lan .left_liebiao ul li i{';echo 'float: left; height: 15px; width: 15px;margin: 4px 0 0 1px;';echo '}
.left_lan .left_liebiao .tupian_ico.li1{';echo 'background-position: 0px -4px ;float:left;height:25px;width: 25px;margin-left:35px;';echo '}
.left_lan .left_liebiao .text1{';echo 'background-position: -355px 4px;float: left;width: 100px;height:25px;margin-left: 5px;';echo '}
.dilei1 {';echo '
background: url("/images/hyzx/icon22.png") no-repeat -3px -228px;
float: left;
height: 25px;
width: 25px;
margin-left: 35px;
';echo '}
.dileiimg{';echo '
float: left;
width: 97px;
height: 25px;
margin-left: 8px;
background:url("/images/hyzx/icon11.png") no-repeat 0px -232px;
';echo '}
</style>
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
<TABLE style="height: 150px;" class="tiebuy_t" border="0" cellSpacing="0" 
cellPadding="0" width="100%">
  <TBODY>
  <TR vAlign="top">
    <TD style="padding: 10px 15px 15px 17px;">
      <DIV class="tiebuy">
      <H1>温馨提示：</H1>
      <P 
      style=\'color: rgb(68, 68, 62); font-family: "宋体"; font-size: 13px;\'>1、接发平台信誉任务，必须完成或者取消后才可以更换。请根据自身情况进行接手！<BR>
      2、任务完成后需要您返回到任务中心进行奖品认领，系统在完成任务后会发站内邮件通知，无论任务是否完成，任务进度将会在周一凌晨自动清零，请您务必在此前领取奖励！<BR>
      3、领取奖励时接发任务数量大于或者等于都可以，如果7天内某天或某几天小于任务数量，任务将失败。
</P></DIV></TD></TR></TBODY></TABLE>
<DIV class="space10"></DIV>
<DIV class="space15"></DIV>
<DIV id="userjob1" class="member-job1">
<H1><SPAN>类型1</SPAN>接发平台信誉任务</H1>
<UL>
  <LI class="to1">
  <SPAN class="li0">任务发不停，奖励送不断！</SPAN>共有12位用户完成此任务												 
  <A id="ctl00_ContentPlaceHolder2_reTaskJob_ctl00_btnDetail" class="aa" href="javascript:__doPostBack(\'reTaskJob|ctl00|btnDetail\',\'\')" 
  ></A>
  <A id="ctl00_ContentPlaceHolder2_reTaskJob_ctl00_btnCancel" class="aa03" href="javascript:__doPostBack(\'reTaskJob|ctl00|btnCancel\',\'\')"></A></LI>
  <LI>
  <SPAN id="reTaskJob_ctl00_divState" class="li1">任务正在进行...</SPAN></LI>
  <LI>您需要连续<SPAN class="li1">7</SPAN>天，每天发布<SPAN class="li1">5</SPAN>个任务，接手<SPAN 
  class="li1">5</SPAN>个任务，任务完成后，平台奖励您<SPAN class="li1">4</SPAN>个麦点 </LI></UL>
<P></P>
<UL>
  <LI class="to1">
  <SPAN class="li0">任务发不停，奖励送不断！</SPAN>共有6位用户完成此任务												<A 
  id="ctl00_ContentPlaceHolder2_reTaskJob_ctl01_btnOrderJob" class="a" href="javascript:__doPostBack(\'reTaskJob|ctl01|btnOrderJob\',\'\')"></A></LI>
  <LI>
  <SPAN id="ctl00_ContentPlaceHolder2_reTaskJob_ctl01_divState" 
  class="li1">此任务等待着接手...</SPAN></LI>
  <LI>您需要连续
  <SPAN class="li1">7</SPAN>天，每天发布<SPAN 
  class="li1">10</SPAN>个任务，接手<SPAN class="li1">10</SPAN>个任务，任务完成后，平台奖励您<SPAN 
  class="li1">8</SPAN>个麦点 </LI></UL>
<P></P>
<UL> 
  <LI class="to1">
  <SPAN class="li0">任务发不停，奖励送不断！</SPAN>共有4位用户完成此任务												<A 
  id="ctl00_ContentPlaceHolder2_reTaskJob_ctl02_btnOrderJob" class="a" href="javascript:__doPostBack(\'reTaskJob|ctl02|btnOrderJob\',\'\')"></A></LI>
  <LI>
  <SPAN id="ctl00_ContentPlaceHolder2_reTaskJob_ctl02_divState" 
  class="li1">此任务等待着接手...</SPAN></LI>
  <LI>您需要连续<SPAN class="li1">7</SPAN>天，每天发布
  <SPAN class="li1">20</SPAN>个任务，接手<SPAN class="li1">20</SPAN>个任务，任务完成后，平台奖励您
  <SPAN class="li1">16</SPAN>个麦点 </LI></UL>
<P></P>
<UL>
  <LI class="to1">
  <SPAN class="li0">任务发不停，奖励送不断！</SPAN>共有0位用户完成此任务												
  <A id="ctl00_ContentPlaceHolder2_reTaskJob_ctl03_btnOrderJob" class="a" href="javascript:__doPostBack(\'reTaskJob|ctl03|btnOrderJob\',\'\')"></A></LI>
  <LI>
  <SPAN id="ctl00_ContentPlaceHolder2_reTaskJob_ctl03_divState" class="li1">此任务等待着接手...</SPAN></LI>
  <LI>您需要连续<SPAN class="li1">7</SPAN>天，每天发布
  <SPAN class="li1">40</SPAN>个任务，接手<SPAN class="li1">40</SPAN>个任务，任务完成后，平台奖励您
  <SPAN class="li1">32</SPAN>个麦点 </LI></UL>
<P></P>
<UL>
  <LI class="to1"><SPAN class="li0">任务发不停，奖励送不断！</SPAN>共有1位用户完成此任务												<A 
  id="ctl00_ContentPlaceHolder2_reTaskJob_ctl04_btnOrderJob" class="a" href="javascript:__doPostBack(\'reTaskJob|ctl04|btnOrderJob\',\'\')"></A></LI>
  <LI><SPAN id="ctl00_ContentPlaceHolder2_reTaskJob_ctl04_divState" 
  class="li1">此任务等待着接手...</SPAN></LI>
  <LI>您需要连续<SPAN class="li1">7</SPAN>天，每天发布<SPAN class="li1">5</SPAN>个任务，接手<SPAN 
  class="li1">0</SPAN>个任务，任务完成后，平台奖励您<SPAN class="li1">5</SPAN>个麦点 </LI></UL>
<P></P>
<UL>
  <LI class="to1"><SPAN class="li0">任务发不停，奖励送不断！</SPAN>共有1位用户完成此任务												<A 
  id="ctl00_ContentPlaceHolder2_reTaskJob_ctl05_btnOrderJob" class="a" href="javascript:__doPostBack(\'reTaskJob|ctl05|btnOrderJob\',\'\')"></A></LI>
  <LI><SPAN id="ctl00_ContentPlaceHolder2_reTaskJob_ctl05_divState" 
  class="li1">此任务等待着接手...</SPAN></LI>
  <LI>您需要连续<SPAN class="li1">7</SPAN>天，每天发布<SPAN 
  class="li1">10</SPAN>个任务，接手<SPAN class="li1">0</SPAN>个任务，任务完成后，平台奖励您<SPAN 
  class="li1">10</SPAN>个麦点 </LI></UL>
<P></P>
<UL>
  <LI class="to1"><SPAN class="li0">任务发不停，奖励送不断！</SPAN>共有3位用户完成此任务								<A id="ctl00_ContentPlaceHolder2_reTaskJob_ctl06_btnOrderJob" 
  class="a" 
  href="javascript:__doPostBack(\'reTaskJob|ctl06|btnOrderJob\',\'\')"></A></LI>
  <LI><SPAN id="ctl00_ContentPlaceHolder2_reTaskJob_ctl06_divState" 
  class="li1">此任务等待着接手...</SPAN></LI>
  <LI>您需要连续<SPAN class="li1">7</SPAN>天，每天发布<SPAN 
  class="li1">20</SPAN>个任务，接手<SPAN class="li1">0</SPAN>个任务，任务完成后，平台奖励您<SPAN 
  class="li1">20</SPAN>个麦点 </LI></UL>
<P></P>
<UL>
  <LI class="to1"><SPAN class="li0">任务发不停，奖励送不断！</SPAN>共有6位用户完成此任务				<A id="ctl00_ContentPlaceHolder2_reTaskJob_ctl07_btnOrderJob" 
  class="a" 
  href="javascript:__doPostBack(\'reTaskJob|ctl07|btnOrderJob\',\'\')"></A></LI>
  <LI><SPAN id="ctl00_ContentPlaceHolder2_reTaskJob_ctl07_divState" 
  class="li1">此任务等待着接手...</SPAN></LI>
  <LI>您需要连续<SPAN class="li1">7</SPAN>天，每天发布<SPAN 
  class="li1">40</SPAN>个任务，接手<SPAN class="li1">0</SPAN>个任务，任务完成后，平台奖励您<SPAN 
  class="li1">40</SPAN>个麦点 </LI></UL>
<P></P>
<UL>
  <LI class="to1"><SPAN class="li0">任务发不停，奖励送不断！</SPAN>共有17位用户完成此任务				<A id="ctl00_ContentPlaceHolder2_reTaskJob_ctl08_btnOrderJob" 
  class="a" 
  href="javascript:__doPostBack(\'reTaskJob|ctl08|btnOrderJob\',\'\')"></A></LI>
  <LI><SPAN id="ctl00_ContentPlaceHolder2_reTaskJob_ctl08_divState" 
  class="li1">此任务等待着接手...</SPAN></LI>
  <LI>您需要连续<SPAN class="li1">7</SPAN>天，每天发布<SPAN 
  class="li1">80</SPAN>个任务，接手<SPAN class="li1">0</SPAN>个任务，任务完成后，平台奖励您<SPAN 
  class="li1">80</SPAN>个麦点 </LI></UL>
<DIV class="clear"></DIV></DIV>
<DIV class="space15"></DIV>
<DIV class="member-job2">
<DIV class="space10"></DIV>
<UL id="userjob2">
  <LI class="to1"><SPAN class="li0"><A name="#fa">任务接不停，奖励送不断！</A></SPAN><A 
  class="aa" href="javascript:location.href=\'/member/ShuaKe/\'" jobid="1"></A></LI>
  <LI><SPAN id="ctl00_ContentPlaceHolder2_reExtendJob_ctl09_divState" class="li1">任务正在进行...</SPAN></LI>
  <LI>职业刷客在本周接手任务量达到<SPAN class="li1">500</SPAN>个，平台奖励您<SPAN 
  class="li1">100</SPAN>元人民币</LI></UL>
<DIV class="clear"></DIV></DIV></DIV>
</DIV><!-- page content end and footer st --><!--弹出层-->
<DIV style="display: none;" id="divinfo1">
<DIV class="tan_lei01">
<UL id="ulcon1">
  <LI>正在读取数据，请稍侯...</LI></UL>
<TABLE style="margin-left: 25px;" id="tlist1" border="0" cellSpacing="0" 
cellPadding="0" width="100%"></TABLE></DIV></DIV>
<DIV style="display: none;" id="divinfo2">
<DIV class="tan_lei02">
<UL id="ulcon2">
  <LI>正在读取数据，请稍侯...</LI></UL>
<TABLE style="margin-left: 25px;" id="tlist2" border="0" cellSpacing="0" 
cellPadding="0" width="100%"></TABLE></DIV></DIV><!--弹出层结束-->
<DIV>
';echo $sys_hash_code2;echo '</DIV>
<DIV style="display: none;">
<INPUT id="ctl00_ContentPlaceHolder2_btnGetGoldTask" name="ctl00|ContentPlaceHolder2|btnGetGoldTask" type="submit">
<INPUT id="ctl00_ContentPlaceHolder2_btnGetGoldExtend" name="ctl00|ContentPlaceHolder2|btnGetGoldExtend" type="submit">
</DIV>
<SCRIPT type="text/javascript">
var curTaskJobId = "13822";
var curExtendJobId = "0";
var isEndTask = "0";
var isEndExtend = "0";
$(document).ready(function(){';echo '
    $("#userjob1 a[id$=_btnDetail]").click(function(){';echo '
	    queryTaskJob(curTaskJobId);
        return false;
    ';echo '});
    $("#userjob1 a[id$=_btnGetGold]").click(function(){';echo '
        queryTaskJob(curTaskJobId);
        return false;
    ';echo '});
    $("#userjob2 a[id$=_btnDetail]").click(function(){';echo '
        queryExtendJob(curExtendJobId);
        return false;
    ';echo '});
	$("#userjob3 a[id$=_btnDetail]").click(function(){';echo '
        queryExtendJob1(curExtendJobId);
        return false;
    ';echo '});
    $("#userjob2 a[id$=_btnGetGold]").click(function(){';echo '
        queryExtendJob(curExtendJobId);
        return false;
    ';echo '});
	$("#userjob3 a[id$=_btnGetGold]").click(function(){';echo '
        queryExtendJob1(curExtendJobId);
        return false;
    ';echo '});
';echo '});

function queryTaskJob(jobid){';echo '
    $("#ctl00_ContentPlaceHolder2_hJobId").val(jobid);
    var html1 = $("#divinfo1").html();
    var dialog=artDialog({';echo 'content:html1,id:"alarm",fixed:true,lock:true,yesText:"确认并关闭"';echo '},function(){';echo '
        if(isEndTask>0){';echo '
            $("#ctl00_ContentPlaceHolder2_btnGetGoldTask").click();
        ';echo '}
    ';echo '});
    $.post("/ajax/queryJobProgress.php",{';echo '"jobId":curTaskJobId,"jobType":1';echo '}, function(re){';echo '
        if(re!=null){';echo '
            var rehtml = "";
            var relist = "";
            rehtml += "<li><span>" + re.BeginAt + " 任务接手  " + re.EndAt + " 任务到期</span></li>";
            rehtml += "<li class=\\"li\\"><span>" + re.StateMsg + "</span></li>";
			/*for(i=0;i<re.jobtop.length;i++){';echo '
                rehtml += "<li class=\\"li\\"><span>"+re.jobtop[i]+"</span></li>";
            ';echo '}*/
            rehtml += "<li><strong>任务详细</strong></li>";
            
            for(i=0;i<re.PassList.length;i++){';echo '
                relist += "<tr><td>"+re.PassList[i]+"</td></tr>";
            ';echo '}
            $("#alarmContent ul[id=ulcon1]").html(rehtml);
            $("#alarmContent table[id=tlist1]").html(relist);
        ';echo '}else{';echo '
            $("#alarmContent ul[id=ulcon1]").html("<li>查询的信息不存在</li>");
        ';echo '}
    ';echo '},\'json\');
';echo '}

function queryExtendJob(jobid){';echo '
     $("#ctl00_ContentPlaceHolder2_hJobId").val(jobid);
    var html1 = $("#divinfo1").html();
    var dialog=artDialog({';echo 'content:html1,id:"alarm",fixed:true,lock:true,yesText:"确认并关闭"';echo '},function(){';echo '
        if(isEndTask>0){';echo '
            $("#ctl00_ContentPlaceHolder2_btnGetGoldTask").click();
        ';echo '}
    ';echo '});
     $.post("/ajax/queryJobProgress.php",{';echo '"jobType":2';echo '}, function(re){';echo '
        if(re!=null){';echo '
            var rehtml = "";
            var relist = "";
            rehtml += "<li><span>" + re.BeginAt + " 任务接手  " + re.EndAt + " 任务到期</span></li>";
            rehtml += "<li><span>" + re.StateMsg + "</span></li>";
			for(i=0;i<re.jobtop.length;i++){';echo '
                rehtml += "<li><span>"+re.jobtop[i]+"</span></li>";
            ';echo '}
            rehtml += "<li><strong>任务详细</strong></li>";
            
            for(i=0;i<re.PassList.length;i++){';echo '
               relist += "<tr><td>"+re.PassList[i]+"</td></tr>";
            ';echo '}
			
            $("#alarmContent ul[id=ulcon1]").html(rehtml);
            $("#alarmContent table[id=tlist1]").html(relist);
        ';echo '}else{';echo '
            $("#alarmContent ul[id=ulcon1]").html("<li>查询的信息不存在</li>");
        ';echo '}
    ';echo '},\'json\');
';echo '}
function queryExtendJob1(jobid){';echo '
     $("#ctl00_ContentPlaceHolder2_hJobId").val(jobid);
    var html1 = $("#divinfo1").html();
    var dialog=artDialog({';echo 'content:html1,id:"alarm",fixed:true,lock:true,yesText:"确认并关闭"';echo '},function(){';echo '
        if(isEndTask>0){';echo '
            $("#ctl00_ContentPlaceHolder2_btnGetGoldTask").click();
        ';echo '}
    ';echo '});
     $.post("/ajax/queryJobProgress.php",{';echo '"jobType":3';echo '}, function(re){';echo '
        if(re!=null){';echo '
            var rehtml = "";
            var relist = "";
            rehtml += "<li><span>" + re.BeginAt + " 任务接手  " + re.EndAt + " 任务到期</span></li>";
            rehtml += "<li><span>" + re.StateMsg + "</span></li>";
			for(i=0;i<re.jobtop.length;i++){';echo '
                rehtml += "<li><span>"+re.jobtop[i]+"</span></li>";
            ';echo '}
			
            rehtml += "<li><strong>任务详细</strong></li>";
            
            for(i=0;i<re.PassList.length;i++){';echo '
                relist += "<tr><td>"+re.PassList[i]+"</td></tr>";
            ';echo '}
			
            $("#alarmContent ul[id=ulcon1]").html(rehtml);
            $("#alarmContent table[id=tlist1]").html(relist);
        ';echo '}else{';echo '
            $("#alarmContent ul[id=ulcon1]").html("<li>查询的信息不存在</li>");
        ';echo '}
    ';echo '},\'json\');
';echo '}
</SCRIPT>
</FORM>
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
</BODY></HTML>
';?>