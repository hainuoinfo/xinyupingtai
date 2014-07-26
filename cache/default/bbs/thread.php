<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\bbs\thread.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\bbs\right.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\bbs\thread.htm','D:\damaihu\xinyupingtai7\cache\default\bbs\thread.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/bbs/';$cssList=array(0=>'http://damaihu.tertw.net/css/bbs/bbs.css');echo '
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
<STYLE type=text/css>.kd A:hover {';echo '
	TEXT-DECORATION: underline
';echo '}
.luntan_btn {';echo '
	BORDER-BOTTOM-STYLE: none; LINE-HEIGHT: 99px; BORDER-RIGHT-STYLE: none; TEXT-INDENT: 99px; BORDER-TOP-STYLE: none; BORDER-LEFT-STYLE: none; OVERFLOW: hidden
';echo '}
.ltlook_a A {';echo '
	COLOR: #3372a2
';echo '}
.ltlook_a A:hover {';echo '
	COLOR: #ff5500; TEXT-DECORATION: underline
';echo '}
.ltlook_do {';echo '
	TEXT-ALIGN: right; LINE-HEIGHT: 50px; PADDING-RIGHT: 30px; HEIGHT: 50px; COLOR: #cccccc
';echo '}
.luntan_topic {';echo '
	BORDER-BOTTOM: #e5e5e5 2px solid; POSITION: relative; BORDER-LEFT: #e5e5e5 2px solid; MARGIN-BOTTOM: 10px; HEIGHT: 361px; BORDER-TOP: #e5e5e5 2px solid; BORDER-RIGHT: #e5e5e5 2px solid
';echo '}
.luntan_cont {';echo '
	PADDING-BOTTOM: 0px; PADDING-LEFT: 40px; PADDING-RIGHT: 0px; PADDING-TOP: 25px
';echo '}
.luntan_cont TABLE TR TD {';echo '
	PADDING-BOTTOM: 7px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; PADDING-TOP: 7px
';echo '}
.lun_postl {';echo '
	TEXT-ALIGN: right; WIDTH: 100px; FONT-FAMILY: 微软雅黑,​雅黑,​verdana,​arial,​宋体; COLOR: #a29f9f; FONT-SIZE: 14px; FONT-WEIGHT: bold
';echo '}
.luntan_cont TEXTAREA {';echo '
	BORDER-BOTTOM: #c5c5c5 1px solid; BORDER-LEFT: #c5c5c5 1px solid; PADDING-BOTTOM: 3px; LINE-HEIGHT: 1.5; OVERFLOW-X: hidden; PADDING-LEFT: 3px; WIDTH: 570px; PADDING-RIGHT: 3px; HEIGHT: 100px; FONT-SIZE: 14px; BORDER-TOP: #c5c5c5 1px solid; BORDER-RIGHT: #c5c5c5 1px solid; PADDING-TOP: 3px
';echo '}
.qq_td {';echo '
	BORDER-BOTTOM: #f0f0ee 1px solid; BORDER-LEFT: #f0f0ee 1px solid; PADDING-BOTTOM: 1px; MARGIN: 0px; PADDING-LEFT: 1px; PADDING-RIGHT: 1px; BORDER-TOP: #f0f0ee 1px solid; CURSOR: pointer; BORDER-RIGHT: #f0f0ee 1px solid; PADDING-TOP: 1px
';echo '}
.tb_face {';echo '
	POSITION: absolute; WIDTH: 308px; BACKGROUND: #fff; HEIGHT: 196px; TOP: 142px; LEFT: 168px
';echo '}
.qq_span {';echo '
	BACKGROUND-IMAGE: url(/images/qqface.gif); WIDTH: 24px; DISPLAY: block; BACKGROUND-REPEAT: no-repeat; HEIGHT: 24px; OVERFLOW: hidden
';echo '}
.lunreplay {';echo '
	BORDER-BOTTOM-STYLE: none; LINE-HEIGHT: 99px; BORDER-RIGHT-STYLE: none; TEXT-INDENT: 999px; WIDTH: 128px; DISPLAY: block; BORDER-TOP-STYLE: none; BACKGROUND: url(/images/lunreplay.jpg) no-repeat; HEIGHT: 37px; BORDER-LEFT-STYLE: none; OVERFLOW: hidden; CURSOR: pointer
';echo '}
.luntan_hf {';echo '
	LINE-HEIGHT: 99px; OVERFLOW: hidden
';echo '}
</STYLE>
<div id="content">
  <DIV class=lt_left>
        <P style="FLOAT: none" class=lthd_wz>当前位置：
		<A class=comlink href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/">首页</A> &gt; 
		<A class=comlink href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/">有问必答</A> &gt; 
		<A class=comlink href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/';echo $forum['ename'];echo '/">';echo $forum['name'];echo '</A> &gt; 
		<SPAN title=';echo $thread['title'];echo '>';echo $thread['title'];echo '</SPAN></P>
        <DIV id=defalutpost>
      <DIV class=luntan_top>
       <FORM method=get name=bbs-search action=/bbs/search.php>
          <TABLE style="FLOAT: right" border=0 cellSpacing=0 cellPadding=0 width=365 height=37>
                <TBODY>
              <TR>
                    <TD align=right><INPUT class=luntan_inp name=keyword></TD>
                    <TD width=50><INPUT class=luntan_btn value="" type=submit></TD>
                  </TR>
            </TBODY>
              </TABLE>
        </FORM>
            <A style="FLOAT: left" class=luntan_ft href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/post.php?fid=';echo $thread['fid'];echo '"></A>
			<A style="FLOAT: left" class=luntan_hf href="javascript:void(0);">回复</A> 
		</DIV>
      <DIV class=ltlook_tit>
	  <SPAN class=ltlook_ico2></SPAN>
	  <SPAN class=ltlook_ico1></SPAN>[';echo $forum['name'];echo ']
            <H1 style="DISPLAY: inline; FONT-SIZE: 16px" title=';echo $thread['title'];echo '>';echo $thread['title'];echo '</H1>
            <SPAN class=ltlook_sz>';echo $thread['posts'];echo '/ ';echo $thread['clicks'];echo '</SPAN>
		</DIV>
		';if($postList){foreach($postList as $k=>$post){echo '
      <DIV class=luntan_bk>
        <DIV class=ltlook_user>
		<A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info.php?username=';echo urlencode($post['username']);echo '" target=_blank>
		<IMG alt=\'';echo $post['username'];echo '\' src=\'';echo $post['avatar'];echo '\' width=50 height=50></A>
          <P><STRONG>
		  <A class=ltlook_name href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info.php?username=';echo urlencode($post['username']);echo '" target=_blank>';echo $post['username'];echo '</A></STRONG></P>
          <P class=ltlook_dj>会员等级：<SPAN class=hongse>平台教官</SPAN></SPAN></P>
          <P class=ltlook_lc>';echo $k+1;echo '楼</P>
          <P class=ltlook_sj>';echo date('Y-m-d H:i:s',$post['timestamp']);echo '</P>
        </DIV>
        <DIV class="ltlook_text ltlook_a">
          <DIV class=bbs-lc-C>
';if($post['first']){echo '
<h1>';echo $thread['title'];echo '</h1>
';echo $post['message'];echo '
';}else{echo '
';if($post['title']){echo '
<h2>';echo $post['title'];echo '</h2>
';}echo '
';echo $post['message'];echo '
';}echo ' 

		  </DIV>
          <P>&nbsp;</P>
        </DIV>
            <DIV class="ltlook_do ltlook_a">　
			<A href="javascript:void(0);">回复</A></DIV>
          </DIV>
		';}}echo '

      <DIV style="MARGIN: 25px 0px 30px" id=page>
	  ';echo $multipage;echo '
	  </DIV>
      <DIV class=cle></DIV>
      <DIV style="MARGIN-TOP: 10px" class=luntan_topic>
            <TABLE style="DISPLAY: none" id=tb_face class=tb_face cellSpacing=2 cellPadding=0>
          <TBODY>
              </TBODY>
        </TABLE>
            <FORM id=myForm onsubmit="return checkForm();" method=post name=myForm action="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/reply.php?tid=';echo $tid;echo '&pid=';echo $post['id'];echo '">
          ';echo $sys_hash_code2;echo '
          <INPUT value=1 type=hidden name=isQuick>
          <DIV class=luntan_cont>
                <TABLE style="Z-INDEX: 1" border=0 cellSpacing=0 cellPadding=0 width="100%">
              <TBODY>
                    <TR>
                  <TD class=lun_postl vAlign=top>快速回复：</TD>
                  <TD><TEXTAREA id=message name=message></TEXTAREA>
                        <P style="MARGIN-TOP: 3px; HEIGHT: 26px">
						<A onclick=show_fase(); href="javascript:;"><IMG src="/images/bbs_face.jpg" width=26 
      height=26></A></P>
	  </TD>
                </TR>
                    <TR>
                  <TD class=lun_postl vAlign=top>图片：</TD>
                  <TD><INPUT style="WIDTH: 375px" id=ImageUrl value=http:// name=ImageUrl>
                      </TD>
                </TR>
                <TR>
                  <TD class=lun_postl vAlign=top>验证码：</TD>
                  <TD><INPUT style="WIDTH: 70px" id=vcode name=vcode>
                        <SPAN><img id="imgCode" src="';echo $weburl2;echo 'images/vcode2.php" style="cursor:pointer" onclick="$(this).attr({';echo 'src:\'';echo $weburl2;echo 'images/vcode2.php?\'+Math.random()';echo '});" alt="点击刷新校验码" align="absmiddle" /></SPAN></SPAN></TD>
                </TR>
                    <TR>
                  <TD class=lun_postl>&nbsp;</TD>
                  <TD>
				  <INPUT id="btnSubmit" class="lunreplay" value="" type="submit" name="btnSubmit">
                      </TD>
                </TR>
                  </TBODY>
            </TABLE>
              </DIV>
        </FORM>
          </DIV>
    </DIV>
      </DIV>
  ';echo '  <DIV class="lt_right">
    <P style="height: 92px; margin-top: 10px;"><A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/fpcs/" 
target="_blank"><IMG title="防骗常识" alt="防骗常识" src="/images/DM_2293137b.jpg" 
width="245" height="92"></A></P>
    <H4 class="luntan_zt">最近发表</H4>
	';$list=bbs_thread::getThreadList2('','timestamp desc',1,8);echo '
    <UL class="luntan_rmbk">
				';if($list){foreach($list as $thread){echo '
				<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t';echo $thread['id'];echo '/" class="link_b_1" target="_blank" title="';echo $thread['title'];echo '">';if($thread['title_style']){echo '
				<span style="';echo $thread['title_style'];echo '">';echo common::cutstr($thread['title'],16);echo '</span>';}else{echo '';echo common::cutstr($thread['title'],16);echo '';}echo '</a></li>
				';}}echo '
	  
    </UL>
	';$forumSimple=bbs_forums::getForumSimple('gonggao','ename');$list=bbs_thread::getThreadList2("fid='$forumSimple[id]'",'timestamp desc',1,7);echo '
    <IMG style="margin-top: 10px;" border="0" src="/images/wsxs_img.jpg" 
useMap="#Map">
    <MAP id="Map" name="Map">
      <AREA href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/" shape="rect" coords="19,145,105,177">
    </MAP>
    <H4 class="luntan_zt">精华主题</H4>
	
    <UL class="luntan_rmbk">
      ';if($list){foreach($list as $thread){echo '
				<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t';echo $thread['id'];echo '/" class="link_b_1" target="_blank" title="';echo $thread['title'];echo '">';if($thread['title_style']){echo '
				<span style="';echo $thread['title_style'];echo '">';echo common::cutstr($thread['title'],14);echo '</span>';}else{echo '';echo common::cutstr($thread['title'],14);echo '';}echo '</a></li>
				';}}echo '
    </UL>
	
    <IMG style="margin-top: 10px;" 
border="0" src="/images/wsxdz_img.jpg" useMap="#Map2">
    <MAP id="Map2" name="Map2">
      <AREA 
  href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/Tuoguanfuwu/" shape="rect" coords="18,156,104,187">
    </MAP>
  </DIV>';echo ' </div>
    </div>
    <div class="cle"></div>
<SCRIPT type=text/javascript src="/images/service.js"></SCRIPT>
<SCRIPT type=text/javascript src="/images/task.js"></SCRIPT>
<SCRIPT type=text/javascript>
    $("a:contains(\'回复\')").click(function(){';echo '
	$("#btnSubmit").focus();
	';echo '}); 
</SCRIPT>

<SCRIPT type=text/javascript>
	function checkForm() {';echo '
		var s = getValue("message");
		var sof = s.indexOf("[emot=qq,");
		var sreplace = s.replace(/\\[emot=qq,\\d+\\/\\]/ig, "");
		var txtCheckCode=$(\'#vcode\').val().trim().length;
		if (sreplace.trim().length<5) {';echo '
			alert("回复不允许纯表情，且必须至少5个字符");
			return false;		
		';echo '}
		if (txtCheckCode!=4) {';echo '
		alert(\'验证码不正确\');
		$(\'#vcode\').focus();
		return false;
		';echo '}
		return avoidReSubmit();
	';echo '}
	function setCaret(textObj) {';echo '
		if(textObj.createTextRange)
			textObj.caretPos = document.selection.createRange().duplicate();
    ';echo '} 
	function insertFace(i) {';echo '
		i = "[emot=qq," + i + "/]";
		var obj = getObj("message");
		if (document.all){';echo '
				var caretPos = obj.caretPos;
			if (obj.createTextRange && caretPos)
				caretPos.text = caretPos.text.charAt(caretPos.text.length-1)==\'\'?i+\'\':i;
			else
				obj.value = obj.value + i;
		';echo '} else {';echo '
			if(obj.setSelectionRange){';echo '   
				var rangeStart = obj.selectionStart;   
				var rangeEnd = obj.selectionEnd;   
				var tempStr1 = obj.value.substring(0,rangeStart);   
				var tempStr2 = obj.value.substring(rangeEnd);   
				obj.value = tempStr1 + i + tempStr2;   
			';echo '} else
				alert("对不起，您的浏览器不支持插入表情");   
		';echo '}
	';echo '}
	function show_fase(){';echo '
		var face_dis=$(\'#tb_face\').css("display");
		if(face_dis==\'none\'){';echo '
		$(\'#tb_face\').css({';echo '"display":"block"';echo '});
		';echo '}else{';echo '
		$(\'#tb_face\').css({';echo '"display":"none"';echo '});
		';echo '}
	';echo '}

	$(document).ready(function(){';echo '
			var table = getObj("tb_face");
			var num = 0;
			for (var i = 0; i < 7; i++) {';echo '
				var row = table.insertRow(i);
				for (var j = 0; j < 11; j++) {';echo '
					var cell = row.insertCell(j);
					cell.className = \'qq_td\';
					cell.onmouseover = function() {';echo ' this.style.borderColor = \'#000000\'; ';echo '}
					cell.onmouseout = function() {';echo ' this.style.borderColor = \'#F0F0EE\'; ';echo '}
					cell.onclick = new Function(\'insertFace(\' + num + \')\');
					var span = document.createElement(\'span\');
					span.className = \'qq_span\';
					span.style.backgroundPosition = \'-\' + (24 * num) + \'px 0px\';
					cell.appendChild(span);
					num++;
				';echo '}
			';echo '}
			
	';echo '});
$(window).load(function() {';echo '   
    $("#defalutpost img").each( function() {';echo '
  var maxwidth = 670;
  if ($(this).width() > maxwidth) {';echo '
   $(this).width(maxwidth);
  ';echo '}
';echo '});  
';echo '});
$(\'.web_qq\').hover(function(){';echo '
    $(\'.quick_qq\').show();
';echo '});
</SCRIPT>
    ';echo '<div id="footer">
		<p><span class="chengse">官方QQ号码：1371752337</span> （加群请注明大麦户）</p>
		<p class="lanse"><a href="#">关于我们</a>|<a href="#">联系我们</a>|<a href="#">大麦户规则</a>|<a href="#">网站地图</a>|<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '" target="_blank">淘宝信誉查询</a> </p>
		<p style="text-align:center;">
	
		<p class="lanse">客户服务热线：02968929109   Copyright © 2012-2020 Damaihu.com All RightsReserved    大麦户版权所有 <a href="#" target="_blank">粤ICP备13037934号</a><span style="display:none">
</span></p>
	</div>
	</div>
    </div>';?>