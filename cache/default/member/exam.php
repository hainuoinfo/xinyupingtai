<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\member\exam.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\member\exam.htm','D:\damaihu\xinyupingtai7\cache\default\member\exam.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/member/';$title='考试 - 互动吧平台';$keywords='';$description='';$cssList=array(0=>'http://damaihu.tertw.net/css/member/member.css');echo '
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
 <div id="content">
  <div class="ks-clear">
        <div class="col-main">
      <div class="main-wrap ks-clear" style="width:940px; margin:0 auto; padding-bottom:20px;padding-top:5px;">
            <p>您现在的位置：<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/">首页</a> &gt; <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/exam/">考试</a></p>
			';if($memberFields['exam']){echo '
			<div id="divsuccess" style="">
          <div class="succee">
                <p>恭喜您！您的调查问卷已经完成，此时您可以<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/new/?m=add">发布任务</a> <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/tao/">接手任务</a>发布任务注意事项：</p>
                <ul>
              <li>设置审核对象：<span>请关注<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/new/?m=taskOut">“已发任务”</a>中任务是否被接手</span></li>
              <li>保持联系畅通：<span>请随时登录好QQ，刷友正在四处找您</span></li>
              <li>规定好评内容：<span>注意任务规定的好评内容和收货地址</span></li>
              <li>设定发布时间：<span>发布的任务最好是不改价不审核的</span></li>
            </ul>
                <div class="clear">&nbsp;</div>
              </div>
          <div class="cont" style="padding-left:130px;"> <a class="button_all" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/tao/?m=add">立即去发布任务</a> <a class="button_all" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/tao/">立即接手任务</a> <a class="button_all" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/">进入我的后台管理</a> </div>
        </div>
		';}else{echo '
            <div class="kaoshi-left" id="kaoshi-left">
			
             <div id="examnum">
                <div class="kaoshi-sub">
			
              <ul>
                                    	<li ';if($errCount==12){echo ' class="kaoshi-sub-current" ';}else{echo ' class=""index="1" ';}echo '>一题</li>
										<li ';if($errCount==11){echo ' class="kaoshi-sub-current" ';}else{echo ' class=""index="2" ';}echo '>二题</li>
										<li ';if($errCount==10){echo ' class="kaoshi-sub-current" ';}else{echo ' class=""index="3" ';}echo '>三题</li>
										<li ';if($errCount==9){echo ' class="kaoshi-sub-current" ';}else{echo ' class=""index="4" ';}echo '>四题</li>
										<li ';if($errCount==8){echo ' class="kaoshi-sub-current" ';}else{echo ' class=""index="5" ';}echo '>五题</li>
										<li ';if($errCount==7){echo ' class="kaoshi-sub-current" ';}else{echo ' class=""index="6" ';}echo '>六题</li>
										<li ';if($errCount==6){echo ' class="kaoshi-sub-current" ';}else{echo ' class=""index="7" ';}echo '>七题</li>
										<li ';if($errCount==5){echo ' class="kaoshi-sub-current" ';}else{echo ' class=""index="8" ';}echo '>八题</li>
										<li ';if($errCount==4){echo ' class="kaoshi-sub-current" ';}else{echo ' class=""index="9" ';}echo '>九题</li>
										<li ';if($errCount==3){echo ' class="kaoshi-sub-current" ';}else{echo ' class=""index="10" ';}echo '>十题</li>
										<li ';if($errCount==2){echo ' class="kaoshi-sub-current" ';}else{echo ' class=""index="11" ';}echo '>十一题</li>
										<li ';if($errCount==0){echo ' class="kaoshi-sub-current" ';}else{echo ' class=""index="12" ';}echo '>十二题</li>
                                    	
               </ul>
			  
              </div>
			   	';$i=0;echo '
				';if($questions){foreach($questions as $k=>$v){echo '
				';$i++;echo '
				<form name="myForm" method="post" id="myForm" onsubmit="return checkForm();">
					<div>';echo $sys_hash_code;echo '</div>	
					
                <div id="exam';echo $i;echo '" ';if($k==$errCount){echo '  style="" ';}else{echo ' style="display: none;" ';}echo '>
              <p class="kaoshi-tishi">加油！回答完这个问题您还有<b>';echo $errCount;echo '</b>题就可以完成<b>调查问卷</b>了</p>
              <div class="kaoshi-timu">
			  <INPUT id="type" name="type" value="';echo $k;echo '" type="hidden">
                    <p style="margin-bottom:10px;">';echo $v['title'];echo '</p>
                    ';$j=0;echo '
                    ';if($v['list']){foreach($v['list'] as $k2=>$v2){echo '
                <p> ';if($v['multi']){echo '
                  <input type=\'checkbox\' name=\'ques_';echo $v['id'];echo '[]\' id=\'ques_';echo $v['id'];echo '_';echo $j;echo '\' value=\'';echo $j;echo '\' />
                  ';}else{echo '
                  <input type=\'radio\' name=\'ques_';echo $v['id'];echo '\' id=\'ques_';echo $v['id'];echo '_';echo $j;echo '\' value=\'';echo $j;echo '\' />
                  ';}echo '
                 <b>';echo chr(65+$j);echo '</b>&nbsp;
                  <label for="ques_';echo $v['id'];echo '_';echo $j;echo '">';echo $v2;echo ' </label>
                </p>
                    ';$j++;echo '
                    ';}}echo '
                    <p class="kaoshi-next">
					<input type="image" name="btnSave" value="提交数据" src="/images/kaoshi-next.jpg" />
					 </p>
                  </div>
			  
				
              <div class="kaoshi-xiaotishi">
                    <h3>答案小提示：</h3>
                    <p> 注意平台问题字母提示 </p>
              </div>
            </div>
			</form>
			';}}echo '
              </div>
        </div>
		
            <div class="kaoshi-right">
          <div class="kaoshi-user">
                <div class="kaoshi-user-top">
              <h4>会员信息</h4>
            </div>
                <div class="kaoshi-user-cen">
              <p style="font-size:14px; border-bottom:#c8e0a0 1px solid;">欢迎来';echo $web_name;echo ',<b>';echo $member['truename'];echo '</b></p>
              <p>您当前拥有: </p>
              <p>平台存款：<b>';echo $memberFields['money'];echo '</b> 元</p>
              <p>平台麦点：<b>';echo $memberFields['fabudian'];echo ' </b> 个</p>
              <p>平台积分：<b>';echo $memberFields['credits'];echo '</b>个</p>
              <p>属于：<b>';if($memberFields['shuake']==1){echo '职业刷客';}elseif($memberFields['vip']==1||$memberFields['vip2']==1||$memberFields['vip3']==1){echo '';echo $vip;echo '';}else{echo '';echo $credits;echo '';}echo '</b></p>
              <p style="border-top:#c8e0a0 1px solid; padding-top:10px; margin-top:10px;"> <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/tao/" style="background:url(/images/kaoshi-icon2.jpg) no-repeat left; padding-left:18px;">接任务赚存款</a> <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/" style="background:url(/images/kaoshi-icon3.jpg) no-repeat left; padding-left:18px;">直接购买存款</a> </p>
              <p><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/">操作更多</a> <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/"><b>进入后台</b></a> <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/logout/"><b>退出登录</b></a></p>
            </div>
              </div>
          <p style="margin-top:15px;"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t626/"><img src="/images/kaoshi-ad.jpg"></a></p>
        </div>
		';}echo '
          </div>
    </div>
      </div>
</div>
    <DIV class="cle"></DIV>
    <DIV class="cle"></DIV>

<script type="text/javascript">
function checkForm() {';echo '
	var rn = true;
	$(\'#myForm radio\').each(function(){';echo '
		if($(this).find(\'input[name*=ques_]:checked\').length==0){';echo '
			rn = false;
			return false;
		';echo '}
	';echo '});
	if (!rn){';echo '
		alert(\'您还有题目没有回答哦，请仔细检查一下^_^\');
	';echo '}
	return rn;
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
    </div>';echo ' ';?>