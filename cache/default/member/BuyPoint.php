<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\member\BuyPoint.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\member\BuyPoint.htm','D:\damaihu\xinyupingtai7\cache\default\member\BuyPoint.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/member/';$title='麦点购买--互动吧平台';$keywords='互动吧';$description='互动吧平台';$cssList=array(0=>'http://damaihu.tertw.net/css/index/index.css');$jsList=array(0=>'http://damaihu.tertw.net/javascript/index/silde.js');echo '
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
<link href="/css/shua.css" rel="stylesheet" type="text/css">
<DIV class="cle"></DIV>
<DIV style="background: rgb(236, 236, 236); margin: 0px auto; width: 1000px;" id="content">
<DIV id="gm_kd">
';if($indexMessage){echo '<div class=\'error_panel\'><div>';echo $indexMessage;echo '</div></div>';}echo '
';if($_showmessage){echo '<div class=\'msg_panel\' style="border: 1px dashed rgb(204, 204, 204);color:red;font-size:20px; background:#FFC; margin-top:5px;padding:10px 5px; font-weight:bold;text-align:center;"><div>';echo $_showmessage;echo '

<script type="text/javascript">
  alert(\'';echo $_showmessage;echo '\');

</script>
</div></div>';}echo '
<FORM id="myForm" onSubmit="return checkForm();" method="post" name="myForm" action="">
';echo $sys_hash_code2;echo '
  <DIV class="line">
  <P style="left: 140px; top: 100px; height: 30px; line-height: 30px; font-weight: bold; position: absolute;">
  <A href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/BuyPoint/#"></A>&nbsp;</P>
  <P class="STYLE5">购买数量：</P>
  <INPUT name="Type" value="1" type="hidden">
<!--  <input name="jiage" id="jiage" value="';echo card::$onePrice[1];echo '" type="hidden">-->
  <input name="jiage" id="jiage" value="0.68" type="hidden">
  <INPUT id="nums" class="in_bk" name="nums" maxLength="4" value="20" type="text">
  <P class="t2"><SPAN class="STYLE3">个</SPAN>
<!--  <SPAN class="STYLE4">(每个<STRONG id="jiage1">';echo card::$onePrice[1];echo '</STRONG>元)</SPAN></P>-->
  <SPAN class="STYLE4">(每个<STRONG id="jiage1">0.68</STRONG>元)</SPAN></P>
  <INPUT class="gm_btn" name="submit" value="提交查询内容" type="submit">
  </DIV>
</FORM>
<FORM id="myForm1" onSubmit="return confirm(\'你确定购买VIP，立即享受18重平台特权吗？\');" method="post" name="myForm1">
';echo $sys_hash_code2;echo '
<DIV class="line bg2">
<P>
<SELECT id="viptype" name="viptype">
  <OPTION value="1">一级VIP客户</OPTION>
  <OPTION value="2">钻石VIP客户</OPTION>
  <OPTION value="3">皇冠VIP客户</OPTION>
</SELECT>

<SELECT name="months">
  <OPTION id="months"  value=""></OPTION>
</SELECT>
</P>
<DIV class="jiage">
<SPAN class="STYLE7">价格：
<SPAN id="price"></SPAN>元</SPAN><A 
class="tq" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/vipinfo/" 
target="_blank">查看VIP特权</A>
</DIV>
<INPUT name="Type" value="2" type="hidden">
<INPUT class="gm_btn" name="submit" value="提交查询内容" type="submit">
</DIV>
</FORM>
<UL id="list">
  <LI class="k1">
  <DIV class="kp" onClick="">
  <FORM id="forma" onSubmit="return checkForm1()" method="post" name="forma" action="">
     ';echo $sys_hash_code2;echo '
  <INPUT name="Type" value="3" type="hidden">
  <INPUT name="nums" value="260" type="hidden">
  <INPUT name="jiage" value="156" type="hidden">
  <INPUT class="btn2" value="提交查询内容" type="submit">
  </FORM>
  </DIV>
  <P class="text">为您增加<SPAN 
  class="hongse"><STRONG>260</STRONG></SPAN>个麦点，尽情发布任务去吧</P>
  </LI>
  <LI class="k2">
  <DIV class="kp">
  <FORM id="formb" onSubmit="return checkForm1();" method="post" name="formb" action="">
  ';echo $sys_hash_code2;echo '
  <INPUT name="Type" value="4" type="hidden">
  <INPUT name="nums" value="501" type="hidden">
  <INPUT name="jiage" value="290" type="hidden">
  <INPUT class="btn2" value="提交查询内容" type="submit"></FORM></DIV>
  <P class="text">卡内含
  <SPAN class="hongse"><STRONG>501</STRONG></SPAN>个麦点，发布任务也如此激情</P></LI>
  <LI class="k3">
  <DIV class="kp">
  <FORM id="formc" onSubmit="return checkForm1();" method="post" name="formc" action="">
  ';echo $sys_hash_code2;echo '
  <INPUT name="Type" value="5" type="hidden">
  <INPUT name="nums" value="1001" type="hidden">
  <INPUT name="jiage" value="570" type="hidden">
  <INPUT class="btn2" value="提交查询内容" type="submit"></FORM></DIV>
  <P class="text">卡内含<SPAN 
  class="hongse"><STRONG>1001</STRONG></SPAN>个麦点，畅快淋漓尊享三钻</P></LI>
  <LI class="k4">
  <DIV class="kp">
  <FORM id="formd" onSubmit="return checkForm1();" method="post" name="formd" action="">
  ';echo $sys_hash_code2;echo '
  <INPUT name="Type" value="6" type="hidden">
  <INPUT name="nums" value="2001" type="hidden">
  <INPUT name="jiage" value="1080" type="hidden">
  <INPUT class="btn2" value="提交查询内容" type="submit"></FORM></DIV>
  <P class="text">内含<SPAN 
  class="hongse"><STRONG>2001</STRONG></SPAN>个麦点，四钻到手莫着急</P></LI>
  <LI class="k5">
  <DIV class="kp">
  <FORM id="forme" onSubmit="return checkForm1();" method="post" name="forme" action="">
  ';echo $sys_hash_code2;echo '
  <INPUT name="Type" value="7" type="hidden">
  <INPUT name="nums" value="5001" type="hidden">
  <INPUT name="jiage" value="2600" type="hidden">
  <INPUT class="btn2" value="提交查询内容" type="submit"></FORM></DIV>
  <P class="text">内含
  <SPAN class="hongse"><STRONG>5001</STRONG></SPAN>个麦点，五钻是幸福的</P></LI>
  <LI class="k6">
  <DIV class="kp">
  <FORM id="formf" onSubmit="return checkForm1();" method="post" name="formf" action="">
  ';echo $sys_hash_code2;echo '
  <INPUT name="Type" value="8" type="hidden">
  <INPUT name="nums" value="10001" type="hidden">
  <INPUT name="jiage" value="5000" type="hidden">
  <INPUT class="btn2" value="提交查询内容" type="submit">
  </FORM>
  </DIV>
  <P class="text">内含<SPAN class="hongse"><STRONG>10001</STRONG></SPAN>个麦点，<SPAN 
  class="STYLE1">至尊信誉，皇冠在手</SPAN></P></LI>
  <LI class="k7">
  <DIV style="cursor: pointer;" id="formj" class="kp"></DIV>
  <P class="text">价格：<SPAN class="hongse">3元/张</SPAN></P>
  <FORM method="post" name="formj" action="">
  ';echo $sys_hash_code2;echo '
  <INPUT name="Type" value="9" type="hidden">
  <INPUT name="cardType" value="9" type="hidden">
  <INPUT name="jiage" value="3" type="hidden">
  </FORM>
  </LI>
  <LI class="k8">
  <DIV style="cursor: pointer;" id="formk" class="kp"></DIV>
  <P class="text">价格：<SPAN class="hongse">16元/张</SPAN></P>
  <FORM method="post" name="formk" action="">
  ';echo $sys_hash_code2;echo '
  <INPUT name="Type" value="10" type="hidden">
  <INPUT name="cardType" value="10" type="hidden">
  <INPUT name="jiage" value="16" type="hidden">
  </FORM>
  </LI>
  <LI class="k9">
  <DIV style="cursor: pointer;" id="autotask" class="kp"></DIV>
  <P class="text">价格：<SPAN class="hongse">1元/天</SPAN></P>
  <FORM method="post" name="form10" action="">
  ';echo $sys_hash_code2;echo '
  <INPUT name="Type" value="11" type="hidden">
  <INPUT name="cardType" value="11" type="hidden">
  <INPUT name="jiage" value="1" type="hidden">
  </FORM>
  </LI>
  <LI class="k10">
  <DIV style="cursor: pointer;" id="removegrade" class="kp"></DIV>
  <P class="text">价格：<SPAN class="hongse">5元/张</SPAN></P>
  <FORM method="post" name="formm" action="">
  ';echo $sys_hash_code2;echo '
  <INPUT name="Type" value="12" type="hidden">
  <INPUT name="cardType" value="12" type="hidden">
  <INPUT name="jiage" value="5" type="hidden">
  </FORM>
  </LI>
  <LI class="k11">
  <DIV style="cursor: pointer;" id="forml" class="kp"></DIV>
  <P class="text">价格：<SPAN class="hongse">5元/张</SPAN></P>
  <FORM method="post" name="forml" action="">
  ';echo $sys_hash_code2;echo '
  <INPUT name="Type" value="13" type="hidden">
  <INPUT name="cardType" value="l3" type="hidden">
  <INPUT name="jiage" value="5" type="hidden">
  </FORM>
  </LI>
  </UL>
<DIV style="clear: both;"></DIV></DIV></DIV>
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
<!--[if lte IE 6]>
<script type="text/javascript" src="/javascript/cn/DD_belatedPNG_0.0.7a.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix(\'*\');
</script>
<![endif]-->
<SCRIPT type="text/javascript">
$(function() {';echo '
    getvipjiage(1);
    $(\'#viptype\').change(function(){';echo '  
    var viptype=$(this).children(\'option:selected\').val();
	getvipjiage(viptype);
	var viprice=$(\'#months\').children(\'option:selected\').val();
    ';echo '});
	
	$(\'#months\').change(function(){';echo '  
    var vipmonths=$(this).children(\'option:selected\').val();
	getviptotal(vipmonths);
    ';echo '}); 

';echo '});
function getvipjiage(t) {';echo '
		if(t){';echo '
			$.ajax({';echo '
				url: \'/ajax/vipprice.php\',
				data: \'viptype=\'+t,
				type: "POST",
				cache: false,
				dataType:"json",
				success: function(data){';echo '
					if(data!=false){';echo '
					    $("#vipbuy").removeAttr("disabled");
						$(\'#months\').html(data.detailed);
						$(\'#price\').html(data.mounth);
					';echo '} else {';echo '
					    $(\'#vipbuy\').attr({';echo '\'disabled\':\'disabled\'';echo '});
						$(\'#months\').html(\'读取数据失败\');
					';echo '}
				';echo '}
			';echo '});
		';echo '}		
';echo '}
function getviptotal(m) {';echo '
        var viptype=$(\'#viptype\').children(\'option:selected\').val();
		if(m){';echo '
			$.ajax({';echo '
				url: \'/ajax/viptotal.php\',
				data: \'vipmonths=\'+m+\'&viptype=\'+viptype,
				type: "POST",
				cache: false,
				dataType:"text",
				success: function(data){';echo '
					if(data!=false){';echo '
					    $("#vipbuy").removeAttr("disabled");
						$(\'#price\').html(data);
					';echo '} else {';echo '
					    $(\'#vipbuy\').attr({';echo '\'disabled\':\'disabled\'';echo '});
						$(\'#price\').html(\'参数错误\');
					';echo '}
				';echo '}
			';echo '});
		';echo '}		
';echo '}
function checkForm() {';echo '
   var n=$("#nums").val();
   var j=$("#jiage").val();
   var checks = [
		["isNumber", "nums", "购买麦点数量"] ];
	var result = doCheck(checks);
	if(n>9999){';echo 'alert(\'购买数量不能超过9999\');return false;';echo '}
	if (result){';echo '
	  if(confirm(\'请确定购买信息\' + \'\\n麦点价格：\' + j + \'\\n麦点数量：\' + n + \'\\n消耗存款：\'+ (j*n).toFixed(2)+\'元\')){';echo '
	  return avoidReSubmit();
	  ';echo '}else{';echo '
	  return false;';echo '}
	';echo '}else{';echo '
	  return result;
	';echo '}
';echo '}
$(document).ready(function(){';echo '
    var hash     =$("input[name=hash2]").val();
	$(\'#forma\').submit(function(){';echo '
	return kefu_cx(\'a\',hash,\'购买一钻卡获得：260个麦点 0.6元/个\',\'156\');
    ';echo '});
	$(\'#formb\').submit(function(){';echo '
	return kefu_cx(\'b\',hash,\'购买二钻卡获得：501个麦点 0.58元/个\',\'290\');
    ';echo '});
	$(\'#formc\').submit(function(){';echo '
	return kefu_cx(\'c\',hash,\'购买三钻卡获得：1001个麦点 0.57元/个\',\'570\');
    ';echo '});
	$(\'#formd\').submit(function(){';echo '
	return kefu_cx(\'d\',hash,\'购买四钻卡获得：2001个麦点 0.56元/个\',\'1080\');
    ';echo '});
	$(\'#forme\').submit(function(){';echo '
	return kefu_cx(\'e\',hash,\'购买五钻卡获得：5001个麦点 0.55元/个\',\'2600\');
    ';echo '});
	$(\'#formf\').submit(function(){';echo '
	return kefu_cx(\'f\',hash,\'购买皇冠卡获得：10001个麦点 0.5元/个\',\'5000\');
    ';echo '});
	$(\'#formj\').click(function(){';echo '
	  if(confirm(\'新平台用户积分增长利器，早日成为万人敬仰的平台皇冠达人！\\n购买后积分实效为24小时，\\n不与会员等级相累计！您确定购买吗？\')){';echo '
	
      document.formj.submit();  

	  ';echo '}
    ';echo '});
	$(\'#formk\').click(function(){';echo '
	  if(confirm(\'新平台用户积分增长利器，早日成为万人敬仰的平台皇冠达人！\\n购买后积分实效为7天，\\n不与会员等级相累计！您确定购买吗？\')){';echo '
	 
	   document.formk.submit();  
	  ';echo '}
    ';echo '});
	$(\'#forml\').click(function(){';echo '
	  if(confirm(\'购买后您的平台有效投诉率将-1，确定购买吗？\\n（此卡一月只可以购买一次）\\n您确定购买吗？\')){';echo '
	 
	   document.forml.submit();  
	  ';echo '}
    ';echo '});
	$(\'#removegrade\').click(function(){';echo '
	  if(confirm(\'此卡仅限一月使用一次，购买后将清理您的一个中评，或者差评，让您的满意度提升！\\n您确定购买吗？\')){';echo '
	 
	   document.formm.submit();  
	  ';echo '}
    ';echo '});
	$(\'#autotask\').click(function(){';echo '
	  if(confirm(\'平台任务那么快就被别人抢走了，又慢了一步？使用预定任务次卡可以享有单次任务优先预定权，坐等满足条件的任务自己送上门，节省宝贵时间省去麻烦的拼抢任务！\\n您确定购买吗？\')){';echo '
	 
	   document.formm.submit();  
	  ';echo '}
    ';echo '});
';echo '});
$(\'.web_qq\').hover(function(){';echo '
    $(\'.quick_qq\').show();
';echo '});
</SCRIPT>
<script type="text/javascript">
function checkForm1() {';echo '
    return confirm("您确定要购买么？");
';echo '}
</script>

';?>