<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\collect\collect.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\collect\collect.htm','D:\damaihu\xinyupingtai7\cache\default\collect\collect.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/collect/';$title='淘宝网店SEO--互动吧平台';$keywords='互动吧';$description='互动吧平台';$cssList=array(0=>'http://damaihu.tertw.net/css/index/index.css');$jsList=array(0=>'http://damaihu.tertw.net/javascript/index/silde.js');echo '
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
<SCRIPT type="text/javascript" src="/images/service.js"></SCRIPT>
<SCRIPT type="text/javascript" src="/images/collect.js"></SCRIPT>
<DIV id="content">
<DIV style="margin-top: 15px; float: left;"><IMG src="/images/sc_banner.jpg" 
width="999" height="236"></DIV>
<FORM onSubmit="return check_cs()" method="post" name="collect_form">
';echo $sys_hash_code2;echo '
<INPUT name="style" value="1" type="hidden">
<TABLE class="scly_scbk" border="0" cellSpacing="0" cellPadding="0" width="490">
  <TBODY>
  <TR>
    <TD class="scly_gmsc" height="50" colSpan="2">购买收藏</TD></TR>
  <TR>
    <TD height="45" width="120" align="right">宝贝或店铺地址：</TD>
    <TD><INPUT id="cs_url" class="scly_bk1" name="cs_url" value="http://" 
      type="text"></TD></TR>
  <TR>
    <TD height="45" align="right">收藏标签：</TD>
    <TD><INPUT id="cs_mark" class="scly_bk2" name="cs_mark" maxLength="62" 
      type="text"></TD></TR>
  <TR>
    <TD height="30" align="right">&nbsp;</TD>
    <TD vAlign="top">标签最多<SPAN class="chengse2">3</SPAN>个(每条<SPAN class="chengse2"><STRONG>10</STRONG></SPAN>个字内)，以空格区分</TD></TR>
  <TR>
    <TD height="45" align="right">购买数量：</TD>
    <TD><INPUT onBlur="cs_count_collect()" id="nums" class="scly_bk3" onClick="cs_check_collect()" 
      name="nums" maxLength="5" value="每个收藏只需0.1个麦点" 
      type="text">&nbsp;需要麦点：<SPAN class="chengse2"><STRONG 
      id="collect_price">0.00</STRONG></SPAN></TD></TR>
  <TR>
    <TD height="70" colSpan="2"><INPUT class="scly_ljgm" value="提交查询内容" type="submit"></TD></TR></TBODY></TABLE>
</FORM>
<FORM id="buyip" onSubmit="return check_buyip()" method="post" name="buyip">
';echo $sys_hash_code2;echo '
<INPUT name="style" value="2" type="hidden">
<TABLE style="margin-left: 15px;" class="scly_scbk" border="0" cellSpacing="0" 
cellPadding="0" width="490">
  <TBODY>
  <TR>
    <TD class="scly_gmll" height="50" colSpan="2">购买流量</TD></TR>
  <TR>
    <TD height="45" width="115" align="right">购买IP数量：</TD>
    <TD><SELECT id="ips" onChange="get_total_price()" name="ips"><OPTION 
        value="200">200 IP/24小时内达到，价格：3个麦点</OPTION><OPTION value="500">500 
        IP/24小时内达到，价格：4个麦点</OPTION><OPTION value="1000">1000 
        IP/24小时内达到，价格：6.8个麦点</OPTION><OPTION value="2000">2000 
        IP/24小时内达到，价格：13个麦点</OPTION><OPTION value="3000">3000 
        IP/24小时内达到，价格：19.5个麦点</OPTION><OPTION value="4000">4000 
        IP/24小时内达到，价格：27个麦点</OPTION><OPTION value="5000">5000 
        IP/24小时内达到，价格：33.7个麦点</OPTION><OPTION value="6000">6000 
        IP/24小时内达到，价格：40.4个麦点</OPTION><OPTION value="7000">7000 
        IP/24小时内达到，价格：47.2个麦点</OPTION><OPTION value="8000">8000 
        IP/24小时内达到，价格：53.9个麦点</OPTION><OPTION value="9000">9000 
        IP/24小时内达到，价格：60.6个麦点</OPTION><OPTION value="10000">10000 
        IP/24小时内达到，价格：74个麦点</OPTION></SELECT></TD></TR>
  <TR>
    <TD height="45" align="right">IP流量地址：</TD>
    <TD><INPUT id="url" class="scly_bk1" name="url" value="http://" type="text"></TD></TR>
  <TR>
    <TD height="30" align="right">&nbsp;</TD>
    <TD vAlign="top">需要麦点：<SPAN class="chengse2"><STRONG 
      id="total_price_show">3</STRONG></SPAN></TD></TR>
  <TR id="span_days">
    <TD height="30" align="right">持续天数：</TD>
    <TD>
	<INPUT onClick="get_total_price()" name="days" value="1" type="radio">持续1天                    
	<INPUT onClick="get_total_price()" name="days" value="7" type="radio">持续7天
	<INPUT onClick="get_total_price()" name="days" value="30" type="radio">持续30天
	</TD>
  </TR>
  <TR>
    <TD height="45" align="right"></TD>
    <TD><A id="open_adv" class="lanse2" onClick="function_set_adv()" href="javascript:;">设置高级流量</A></TD></TR>
  <TR>
    <TD colSpan="2">
      <TABLE style="margin: 0px auto; border: 1px solid rgb(221, 221, 221); width: 470px; display: none;" 
      id="set_adv" border="0" cellSpacing="0" cellPadding="0" align="center">
        <TBODY>
        <TR>
          <TD height="30" align="right">高级设置：<INPUT id="need_adv" name="need_adv" 
            value="0" type="hidden"></TD>
          <TD>
            <P><LABEL><INPUT id="adv_seting_1" onClick="function_need_adv()" 
            name="adv_seting[]" value="1" 
            type="checkbox">自定义流量投放时间</LABEL>&nbsp;&nbsp;                   
            <LABEL><INPUT id="adv_seting_2" onClick="function_need_adv()" name="adv_seting[]" 
            value="2" type="checkbox">自定义PV:IP的倍数</LABEL></P>&nbsp;&nbsp; 				  
            <P><LABEL><INPUT id="adv_seting_3" onClick="function_need_adv()" 
            name="adv_seting[]" value="3" 
            type="checkbox">自定义投放地区</LABEL>&nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;                    <LABEL 
            style="display: none;"><INPUT id="adv_seting_5" onClick="function_need_adv()" 
            name="adv_seting[]" value="5" 
        type="checkbox">自定义访问来源</LABEL></P></TD></TR>
        <TR style="display: none;" id="span_cut_time">
          <TD bgColor="#ffffff" align="right">&nbsp;&nbsp;自定义时间：</TD>
          <TD bgColor="#ffffff">
		  <LABEL>开始时间：
		  <INPUT id="start_time" onChange="get_total_price()" class="it date-pick1 q b" name="start_time" value="';echo date('Y-m-d H:i:s',time());echo '" 
            type="text">
		</LABEL>
			<BR>
		<LABEL>结束时间：<INPUT id="end_time" onChange="get_total_price()" 
            class="it date-pick2 q b" name="end_time" value="';echo date('Y-m-d H:i:s',time());echo '" 
            type="text"> 
		</LABEL><BR>（此服务选择后价格会提高20%）          
		</TD>
		</TR>
        <TR style="display: none;" id="span_cut_pvs">
          <TD bgColor="#ffffff" vAlign="top" 
          align="right">&nbsp;&nbsp;自定义PV：</TD>
          <TD bgColor="#ffffff"><LABEL><INPUT id="pvs" onChange="get_total_price()" 
            name="pvs" maxLength="3" value="1" size="2" type="text"> 
            </LABEL><BR>（PV:IP的倍数，如不太明白，可以不管，<BR>使用默认值， 此服务选择后价格会有相应的提高，<BR> 
            PV为2时加10%，3加30%，4加200%，5加225%，<BR>6加250%，7加300%，<BR>8加325%，9加350%，以此类推）
            		 </TD></TR>
        <TR style="display: none;" id="span_cut_location">
          <TD bgColor="#ffffff" align="right">&nbsp;&nbsp;自定义地区:&nbsp;</TD>
          <TD bgColor="#ffffff"><INPUT id="pprov1" onClick="get_total_price()" 
            name="province[]" value="北京" type="checkbox"><LABEL 
            for="pprov01">北京</LABEL><INPUT id="pprov2" onClick="get_total_price()" 
            name="province[]" value="上海" type="checkbox"><LABEL 
            for="pprov02">上海</LABEL><INPUT id="pprov3" onClick="get_total_price()" 
            name="province[]" value="天津" type="checkbox"><LABEL 
            for="pprov03">天津</LABEL><INPUT id="pprov4" onClick="get_total_price()" 
            name="province[]" value="重庆" type="checkbox"><LABEL 
            for="pprov04">重庆</LABEL><INPUT id="pprov5" onClick="get_total_price()" 
            name="province[]" value="河北" type="checkbox"><LABEL 
            for="pprov05">河北</LABEL><INPUT id="pprov6" onClick="get_total_price()" 
            name="province[]" value="山西" type="checkbox"><LABEL 
            for="pprov06">山西</LABEL><BR><INPUT id="pprov7" onClick="get_total_price()" 
            name="province[]" value="内蒙" type="checkbox"><LABEL 
            for="pprov07">内蒙</LABEL><INPUT id="pprov8" onClick="get_total_price()" 
            name="province[]" value="辽宁" type="checkbox"><LABEL 
            for="pprov08">辽宁</LABEL><INPUT id="pprov9" onClick="get_total_price()" 
            name="province[]" value="吉林" type="checkbox"><LABEL 
            for="pprov09">吉林</LABEL><INPUT id="pprov10" onClick="get_total_price()" 
            name="province[]" value="新疆" type="checkbox"><LABEL 
            for="pprov10">新疆</LABEL><INPUT id="pprov11" onClick="get_total_price()" 
            name="province[]" value="江苏" type="checkbox"><LABEL 
            for="pprov11">江苏</LABEL><INPUT id="pprov12" onClick="get_total_price()" 
            name="province[]" value="浙江" type="checkbox"><LABEL 
            for="pprov12">浙江</LABEL><BR><INPUT id="pprov13" onClick="get_total_price()" 
            name="province[]" value="安徽" type="checkbox"><LABEL 
            for="pprov13">安徽</LABEL><INPUT id="pprov14" onClick="get_total_price()" 
            name="province[]" value="福建" type="checkbox"><LABEL 
            for="pprov14">福建</LABEL><INPUT id="pprov15" onClick="get_total_price()" 
            name="province[]" value="江西" type="checkbox"><LABEL 
            for="pprov15">江西</LABEL><INPUT id="pprov16" onClick="get_total_price()" 
            name="province[]" value="山东" type="checkbox"><LABEL 
            for="pprov16">山东</LABEL><INPUT id="pprov17" onClick="get_total_price()" 
            name="province[]" value="河南" type="checkbox"><LABEL 
            for="pprov17">河南</LABEL><INPUT id="pprov18" onClick="get_total_price()" 
            name="province[]" value="湖北" type="checkbox"><LABEL 
            for="pprov18">湖北</LABEL><BR><INPUT id="pprov19" onClick="get_total_price()" 
            name="province[]" value="湖南" type="checkbox"><LABEL 
            for="pprov19">湖南</LABEL><INPUT id="pprov20" onClick="get_total_price()" 
            name="province[]" value="广东" type="checkbox"><LABEL 
            for="pprov20">广东</LABEL><INPUT id="pprov21" onClick="get_total_price()" 
            name="province[]" value="广西" type="checkbox"><LABEL 
            for="pprov21">广西</LABEL><INPUT id="pprov22" onClick="get_total_price()" 
            name="province[]" value="海南" type="checkbox"><LABEL 
            for="pprov22">海南</LABEL><INPUT id="pprov23" onClick="get_total_price()" 
            name="province[]" value="贵州" type="checkbox"><LABEL 
            for="pprov23">贵州</LABEL><INPUT id="pprov24" onClick="get_total_price()" 
            name="province[]" value="四川" type="checkbox"><LABEL 
            for="pprov24">四川</LABEL><BR><INPUT id="pprov25" onClick="get_total_price()" 
            name="province[]" value="云南" type="checkbox"><LABEL 
            for="pprov25">云南</LABEL><INPUT id="pprov26" onClick="get_total_price()" 
            name="province[]" value="西藏" type="checkbox"><LABEL 
            for="pprov26">西藏</LABEL><INPUT id="pprov27" onClick="get_total_price()" 
            name="province[]" value="陕西" type="checkbox"><LABEL 
            for="pprov27">陕西</LABEL><INPUT id="pprov28" onClick="get_total_price()" 
            name="province[]" value="甘肃" type="checkbox"><LABEL 
            for="pprov28">甘肃</LABEL><INPUT id="pprov29" onClick="get_total_price()" 
            name="province[]" value="青海" type="checkbox"><LABEL 
            for="pprov29">青海</LABEL><INPUT id="pprov30" onClick="get_total_price()" 
            name="province[]" value="宁夏" type="checkbox"><LABEL 
            for="pprov30">宁夏</LABEL><BR><INPUT id="pprov31" onClick="get_total_price()" 
            name="province[]" value="台湾" type="checkbox"><LABEL 
            for="pprov31">台湾</LABEL><INPUT id="pprov32" onClick="get_total_price()" 
            name="province[]" value="香港" type="checkbox"><LABEL 
            for="pprov32">香港</LABEL><INPUT id="pprov33" onClick="get_total_price()" 
            name="province[]" value="澳门" type="checkbox"><LABEL 
            for="pprov33">澳门</LABEL><INPUT id="pprov34" onClick="get_total_price()" 
            name="province[]" value="黑龙" type="checkbox"><LABEL 
            for="pprov34">黑龙江</LABEL><BR>（此服务选择后价格会提高3倍）                        
          </TD></TR>
        <TR style="display: none;" id="span_cut_referer">
          <TD bgColor="#ffffff" width="90" 
          align="right">&nbsp;&nbsp;自定义访问来源：</TD>
          <TD bgColor="#ffffff"><INPUT name="url_referer[]" size="30" type="text"><BR><INPUT 
            name="url_referer[]" size="30" type="text"><BR><INPUT name="url_referer[]" 
            size="30" type="text"><BR><INPUT name="url_referer[]" size="30" 
            type="text"><BR>（来源地址请填写浏览器http地址，此服务选择后价格会提高1倍，最多6个来源，最少一个，请确保来源地址能打开！） 
                     </TD></TR></TBODY></TABLE></TD></TR>
  <TR>
    <TD height="55" colSpan="2">
<INPUT id="total_price" name="total_price" value="0" type="hidden">
<INPUT id="day" name="day" value="1" type="hidden">
<INPUT class="scly_ljgm" value="提交查询内容" type="submit"></TD></TR></TBODY></TABLE>
</FORM>
<DIV class="cle"></DIV>
<TABLE class="scly_bk4" border="0" cellSpacing="0" cellPadding="0" width="490">
<TBODY>
  <TR>
    <TD class="scly_tit" height="37" vAlign="middle" align="center">最近购买</TD>
    <TD class="scly_tit" vAlign="middle" width="10%" align="center">数量</TD>
    <TD class="scly_tit" vAlign="middle" width="22%" align="center">处理时间</TD>
    <TD class="scly_tit" vAlign="middle" width="32%" align="center">操作</TD>
  </TR>
</TBODY>
</TABLE>
<TABLE style="margin-left: 15px;" class="scly_bk4" border="0" cellSpacing="0" cellPadding="0" width="490">
  <TBODY>
  <TR>
    <TD class="scly_tit" height="37" vAlign="middle" align="center">最近购买</TD>
    <TD class="scly_tit" vAlign="middle" width="17%" align="center">数量</TD>
    <TD class="scly_tit" vAlign="middle" width="22%" align="center">处理时间</TD>
    <TD class="scly_tit" vAlign="middle" width="22%" align="center">操作</TD>
  </TR>
  </TBODY>
</TABLE>
<DIV class="cle"></DIV>
<TABLE class="scly_bk4" border="0" cellSpacing="0" cellPadding="0" width="490"><TBODY>
  <TR>
    <TD style="text-indent: 24px;" class="scly_tit" height="37" vAlign="middle" 
    align="left">购买收藏常见问题</TD></TR>
  <TR>
    <TD style="padding: 20px 25px;" class="scly_wtbg" height="37" vAlign="top" 
    align="left">
      <P class="scly_tit2">购买收藏后是一下全到吗?</P>答：购买后可能需要24-48小时才会进行哦，敬请耐心等待。<BR>
      <P class="scly_tit2">我的网店有多少信誉时就该刷收藏了呢？</P>
      			答：卖家信誉在十以上就可以开始了，最晚在卖家信誉到100之前也要开始了；<BR>
      <P class="scly_tit2">我的网店大概需要刷多少收藏是合理的呢？</P>
      			答：这个要根据您网店当前的信誉度来决定，一般淘宝上收藏数是卖家信誉度的：10%--85%之间为一个比较合乎逻辑的范围；当然最合理的范围是20%-55%； 
      举例说明您现在的卖家信誉度是：100 那么您对应网店的合理收藏人气应该是：20-55个;<BR></TD></TR></TBODY></TABLE>
<TABLE style="margin-left: 15px;" class="scly_bk4" border="0" cellSpacing="0" 
cellPadding="0" width="490">
  <TBODY>
  <TR>
    <TD style="text-indent: 24px;" class="scly_tit" height="37" vAlign="middle" 
    align="left">购买流量常见问题</TD></TR>
  <TR>
    <TD style="padding: 20px 25px;" class="scly_wtbg" height="37" vAlign="top" 
    align="left">
      <P class="scly_tit2">购买流量后是一下全到吗?</P>答：在您成功订购并通过核审后24小时内到达您的指定地址<BR>
      <P class="scly_tit2">一天需要买多少流量合适呢？</P>              
      答：首先保证你每天的成交单数（包括刷信誉）与当日的流量IP比例为1-3%，并且在以后最好也不要停止购买流量。我们建议一红星卖家从200流量开始买起，200为一个档次增加，循序渐进。<BR>
      <P class="scly_tit3"></P>			  
      淘宝浏览量也称作淘宝浏览次数，淘宝浏览量直接影响商品的排名，浏览量高了以后如果搜索时按“人气”排的话就会排的前点，这样看的人多了卖的也可能就更多！
       排名和搜索会靠前，浏览量多了，意味着你的店人气高了，那销量一般会跟着升起来的；对于经常刷信誉的我们来说，淘宝流量=淘宝来路，如果刷流量的话，你的来路从此就不会单一，<STRONG>最重要的是这样来路都是真实的ip，量子统计均可查，这样的话就能非常有效的避免降权。</STRONG> 
    </TD></TR></TBODY></TABLE></DIV>
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