<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\help\taskout.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\help\taskout.htm','D:\damaihu\xinyupingtai7\cache\default\help\taskout.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/help/';$title='职业刷客 - 互动吧平台';$keywords='';$description='';$cssList=array(0=>'http://damaihu.tertw.net/css/member/member.css');echo '

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
<link href="/css/help.css" rel="stylesheet" type="text/css">
	<div class="cle"></div>
	<div id="content">
		<div class="fbf_img">
			<ul class="fbf_menu">
				<li><a href="javascript:;" class="m1"></a></li>
				<li><a href="javascript:;" class="m2"></a></li>
				<li><a href="javascript:;" class="m3"></a></li>
				<li><a href="javascript:;" class="m4"></a></li>
				<li><a href="javascript:;" class="m5"></a></li>
				<li><a href="javascript:;" class="m6"></a></li>
				<li><a href="javascript:;" class="m7"></a></li>
				<li><a href="javascript:;" class="m8"></a></li>
			</ul>
		</div>	
		<div class="jsf_xs">
		  <p class="hnav0"><span style="color:#1271B9; font-weight:bold; font-size:14px;">大麦户如何保障信誉安全</span><br>一个买号购买一个商家发布的同一个商品每个月内只允许一次
　　　　　　　　一个买号购买一个商家的所有商品每个月内只允许两次<br>
接手同一个的商家所发布的所有任务，每个月内所有买号只允许接手10次
　　　每个买号每日最多接手3个任务，每周最多接手15个任务<br>
限制一个ip一天只能接6个任务，继续接任务得换ip
.</p>
		  <p class="hnav1" style="display:none"><span class="STYLE2">通过简单的填写资料注册，您就可以加入大麦户互动平台了，注册时</span><span class="STYLE1">请注意填写正确QQ，手机号码</span><span class="STYLE2">，方便接发任务时对方与您及时取得联系。</span></p>
		  <p class="hnav2" style="display:none"><span class="STYLE2">为了任务安全，</span><span class="STYLE1">手机认证是接手任务前必须要的途径</span><span class="STYLE2">，方便您取回密码，接收验证码等操作，如需修改，请联系网站客服。</span></p>
		  <p class="hnav3" style="display:none"><span class="STYLE1">安全操作码是保护您资金安全的密码</span><span class="STYLE2">，相当于您的二级密码。请牢记勿泄露，如忘记密码可以通过输入安全操作码页面找回。</span></p>
		  
		  <p class="hnav4" style="display:none">发布任务前，您需要在任务大厅先进行<span class="STYLE1">绑定掌柜名，然后才可以发布任务，所发布的任务掌柜名必须和商品链接的掌柜名一致</span><span class="STYLE2">，一个平台帐号可以绑定多个掌柜名。</span></p>
		  
		  <p class="hnav5" style="display:none">每个任务有不同的属性，用来奖赏接手方的麦点也不同，<span class="STYLE1">为了最便捷的发任务，您可以直接购买麦点发布</span>。 <span class="STYLE3"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t122/" target="_blank">查看麦点消耗详细</a></span></p>
		  <div class="hnav6" style="display:none">在任务大厅点击发布任务，设置好相应属性，发布成功，立即就会有接手方来接取你的任务，不过<span class="STYLE1">在发布前，你需要拥有相应的存款和麦点</span>。 <span class="STYLE3"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/user/topup/" target="_blank">我要充值存款</a></span></div>
		  <div class="hnav7" style="display:none">淘宝任务完成后，请您第一时间返回平台核实任务，这样接手方才能及时收到在淘宝付给您的款项和麦点，避免引起不必要的申诉。</div>
		 <div class="hnav8" style="display:none">在大麦户平台，我们本着<span class="STYLE1">以和为贵</span>的精神，合作双赢，这样才能给您带来最大的回报和利润，让您的信誉升升升！<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1313/" target="_blank"></a></div>
		  
		</div>
		<div class="jsf_bk">
			<h4 class="jsf_bz">我是发布方</h4>
			<ul class="jsf_list">
			    <li class="htitle"><a href="javascript:;">在大麦户平台多久我的网店可以到钻？</a></li>
				<li style="display:none;"><div class="jsf_cx"> <p>您不用多少时间，就可以快速加入钻石卖家的行列了，快则5天，慢则15-20天。平台建议循序渐进的来提高每天的营业额；您如果一个卖家信誉都没有，建议从一天3个左右开始，每三天销量翻倍，最多每天提高二十至三十个信誉都是安全的；
这里是互动担保信誉平台，可以理解为和支付宝一样功能的交易担保平台，希望大家遵守这里的规定，营造一个良好的互动氛围。</p></div></li>
				<li class="htitle"><a href="javascript:;">这个平台安全吗？</a></li>
				<li style="display:none;"><div class="jsf_cx"> <p>1、一个买号购买一个商家发布的同一个商品每个月内只允许一次</p>
                                <p>2、一个买号购买一个商家的所有商品每个月内只允许两次</p>
                                <p>3、接手同一个的商家所发布的所有任务，每个月内所有买号只允许接手10次</p>
                                <p>4、每个买号每日最多接手6个任务，每周最多接手30个任务</p>
                                <p>5、限制一个ip一天只能接6个任务，继续接任务得换ip。</p>
                                <p>6、为了防止淘宝监控平台的ip，平台服务器永不访问淘宝服务器。您的店铺信息只有接任务的人才能看到，而且，平台定期清理历史记录。哪怕拿到平台的数据库资料，也没有人知道您一个月以前在平台刷信的记录。</p>
                                <p>7、平台严格实行实物交易确认时间限制，没到确认时间不让确认。真实交易不可能对方付款了您发货了就立刻确认。而有的平台这么做的！平台做了这个限制，确保更加逼真模拟真实交易。</p>
                                <p>8、平台上的会员来自全国各地，跟您真实交易的买家来自全国各地一样真实。</p></div></li>
				<li class="htitle"><a href="javascript:;">任务操作过程中关于资金的疑问？</a></li>
				<li style="display:none;"><div class="jsf_cx"> <p>有刷友会问，如果我在淘宝确认了收货并评价，但是A用户不在平台确认的话怎么办？</p>
                                <p>不要惊慌，您的钱还在平台上，由平台担保着呢，这时候您需要先QQ联系A用户，通知他完成交易，其实

他也会急着完成交易的，因为不完成的话他也无法发布后面的任务；</p>
                                <p>如果联系不上或者交涉未果，这时候就QQ联系平台管理员，并且提供任务编号和已经完成淘宝交易的证

据，管理员会通过和双方联系确认后，将这笔存款立即打还到您的帐户上。</p>
                                <p>还有刷友会问，如果B根本没在淘宝上付款，但是却在平台上点了确认付款怎么办？</p>
                                <p>这时候您也不用慌，您还没有任何经济损失不是？呵呵，还是先联系B，催促他付款，如果他是新人，这

种错误有可能发生，大家都要谅解一下，这样才和谐；如果他也联系不上或者其他原因拒绝付款，那么

就投诉他吧，由管理员来处理，管理员确认情况属实后，会将任务返回到未接受状态，您可以等待其他

接手人来完成任务，同样没有任何经济损失。值得注意的是，如果B被人投诉了6次，系统会自动封号的

。</p></div></li>
				
				<li class="htitle"><a href="javascript:;">实物任务发货要如何填快递单号? </a></li>
				<li style="display:none;"><div class="jsf_cx"><p>很多在平台刷信誉的掌柜都很关心这个问题；一般情况下，我们都是这么填写快递单号的；</p>
                                    <p>（1）可以填写一些当天的真实单号，或者稍微过期的单号，如果知道收货地址可以修改一下。 </p>
                                    <p>（2）一般都是选自己联系物流-其它物流-公司名自己起（可以写本土的一些快递，只要淘宝上没有就可以了），单号自己编一个。 </p>
                                    <p class="esp">第一步：在发货时选择【自己联系物流】</p>
                                    <p class="esp">第二步：选择【其他物流】</p>
                                    <p class="esp">第三步：选择【其他】，然后自己编一个快递公司名字；</p>
                                    <p class="esp">第四步：编写一个快递单号（快递单号一般的填写规则可以参考<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/">这个贴子</a>）；</p>
                                    <p>（3）直接选择不需要物流（虚拟物品），推荐用前2种方法。</p></div></li>
			   <li class="htitle"><a href="javascript:;">新人免费发布一元体验任务功能介绍</a></li>
				<li style="display:none;"><div class="jsf_cx"><p>好消息，新用户的福音来了呵呵！平台采纳了大家的意见，为了广大刷友能够尽快的掌握平台刷信誉的操作流程，特意为每位新用户提供一次免费发布“一元体验任务”的机会</p>
                                    <p>只要成功注册平台，将自动奖励1个麦点和1元的存款，无需充值或者兑换麦点就可以马上发布一个体验任务，并且免费增加一个网店信誉点。</p>
                                    <p>发布一元体验任务有什么注意事项： </p>
                                    <p class="esp">1.因为任务值已经固定为一元钱了，所以切记这个任务里发布的您的淘宝店商品价格改为一元哦！</p>
                                    <p class="esp">2.必须将任务发布在虚拟大厅里面；任务是立即确认收货的，一定要记得快速发货哦！</p>
                                    <p>设置小窍门：如果您的网店商品，都比较贵，建议新建一个1元的充值类商品作为任务商品，来体验我们的免费任务！</p></div></li>
        </ul>
		<ul class="jsf_list">
				
				<li class="htitle"><a href="javascript:;">发布任务是什么意思？</a></li>
				<li style="display:none;"><div class="jsf_cx"><p>发布任务就是把您的网店中一个商品发布到互动区中，让别人来接手任务，然后来淘宝您的网店中购买这个商品，交易结束后您的信誉就长了一个值；</p>
                                    <p class="esp">注意：发布任务时平台需要冻结您大麦户账户内的任务存款（存款金额=商品标价+快递运费），和相应的【发布点（麦点）】；在任务结束后发放给接手人；</p></div></li>
				<li class="htitle"><a href="javascript:;">我要如何发任务呢？</a></li>
				<li style="display:none;"><div class="jsf_cx"><p>发任务需要具备三个前提： </p>
                                    <p class="esp">1、淘宝店铺的掌柜名和平台注册时绑定的掌柜名完全一致（必须区分英文大小写）</p>
                                    <p class="esp">2、平台拥有足够的麦点和存款（存款数量=您要拍卖的商品金额+运费金额)，存款不会损耗，发布任务智慧损耗麦点。</p>
                                    <p class="esp">3、淘宝有对应金额的商品，比如您发布的任务是10元任务，那么淘宝就应该有一个商品的金额为10元（实物任务需要商品+运费的金额等于10元）</p>
                                    <p>准备好了这一切，那就开始任务吧。</p></div></li>
	            <li class="htitle"><a href="javascript:;">什么是麦点(发布点)？</a></li>
				<li style="display:none;"><div class="jsf_cx"><p>也可称为“发布点”，平台每发一个刷信誉的任务所需要的权限，可以通过帮助别人刷信用来免费获得</p>
                                    <p class="esp">1麦点=1个淘宝信用</p>
                                    <p>麦点分为实物麦点和虚拟麦点，分别对应发布不同商品的任务。
虚拟麦点是用来发布不需要物流信息的任务，比如点卡或者充值业务或者QQ号码等商品；</p>
                                    <p>而实物麦点则是用来发布需要物流信息的任务的，比如服装等等，为了模拟真实的交易，需要接收方在24-72小时内确认收货，完全模拟淘宝真实的交易，让淘宝官方查无可查</p></div></li>
				<li class="htitle"><a href="javascript:;">什么是存款？</a></li>
				<li style="display:none;"><div class="jsf_cx"><p>很多会员问：我的资金是否会损失掉，那么这一点一定要仔细阅读，存款是绝对不会损失的，因为平台的存在除了保证让您安全的刷皇冠，还有一个任务就是保障您的资金安全。</p>
                                    <p>这是您在平台上的存款，可以通过充值，将人民币转到平台上，同时也可以通过平台提现到您的支付宝帐号。</p>
                                    <p>存款的作用在于：您每发布一个任务需要首先扣除和这个任务商品价格所对应的存款，然后帮您刷信用的刷友 接手任务后，会通过支付宝将存款等值的现金返还到您的支付宝账号中。过程中不会出现任何的资金损耗。</p></div></li>
				
				<div class="cle"></div>
			</ul>
			<div class="cle"></div>
		</div>
		<div class="jsf_bk">
			<h4 class="jsf_bz1">平台名称解释</h4>
			<table class="jsf_table" align="center" cellpadding="0" cellspacing="0" width="98%">
              <tbody><tr>
                <td align="center" bgcolor="#D2E7FF" width="15%">专用名词</td>
                <td bgcolor="#D2E7FF" width="85%">名词解释</td>
              </tr>
              <tr>
                <td align="center"><strong>任务</strong></td>
                <td class="jsf_padd" align="left"><p align="left">平台提高信誉都是围绕任务的形式来进行的，任务也就是让别人来拍自己店里的商品(提供商品地址)，在平台里每个人都可以发布任务来提高自己店铺的信誉，也可以通过接手任务来获取平台存款</p></td>
              </tr>
              <tr>
                <td align="center" bgcolor="#FFFFFF"><strong>发布方</strong></td>
                <td class="jsf_padd" bgcolor="#FFFFFF"><p align="left">就是任务的发起人，发起人必须要有存款和麦点才可以发布任务。</p></td>
              </tr>
              <tr>
                <td align="center"><strong>接手方</strong></td>
                <td><p class="jsf_padd" align="left">就是任务的接手人，接手任务需要有接手任务的小号。</p></td>
              </tr>
              <tr>
                <td align="center" bgcolor="#FFFFFF"><strong>存款</strong></td>
                <td class="jsf_padd" bgcolor="#FFFFFF"><p align="left">发布任务的人需要把钱存入到平台作为担保金，才能发布同等金额的任务。接手任务的人需要真实付款给发布任务的店主的，这是为接手人付款后作担保的。任务完成后接手方已支付宝付款给发布方，担保金则归接手方所有，实际无损耗。</p></td>
              </tr>
              <tr>
                <td align="center"><strong>麦点</strong></td>
                <td><p class="jsf_padd" align="left">为了尽量避免大家只发任务而不接任务，我们引入了麦点概念，接手一个任务获取任务相应的麦点，发布任务扣除相应的麦点。</p></td>
              </tr>
              <tr>
                <td align="center" bgcolor="#FFFFFF"><strong>收藏点</strong></td>
                <td class="jsf_padd" bgcolor="#FFFFFF"><p align="left">发布收藏任务时须要的，同麦点概念一样，只不过是用于收藏区的收藏任务，目前收藏点暂时取消，用户可以直接再<strong>收藏流量</strong>区购买。 </p></td>
              </tr>
              <tr>
                <td align="center"><strong>积分</strong></td>
                <td><p class="jsf_padd" align="left">积分是平台等级的一个标识，积分越高使用对应权限功能越多，接发任务与推广用户均可获得积分，积分还可以兑换成麦点。</p></td>
              </tr>
              <tr>
                <td align="center" bgcolor="#FFFFFF"><strong>小号</strong></td>
                <td class="jsf_padd" bgcolor="#FFFFFF"><p align="left">这是一个俗称，小号是用来接手任务用的，其实就是假装到店铺买东西的账号(非平台用户名)，是淘宝登录的用户名<strong>旺旺号</strong>，无需身份认证，直接申请使用的。</p></td>
              </tr>
              <tr>
                <td align="center"><strong>大号</strong></td>
                <td><p class="jsf_padd" align="left">其实就是需要提高信誉的主店帐号（淘宝登录的用户名<strong>旺旺号</strong>）。</p></td>
              </tr>
            </tbody></table>
		</div>
		<div class="fbf_an">
			<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/VideoCourses/" class="fbf_btn1"></a>
			<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/diagram/index/" class="fbf_btn2"></a>
		</div>
	</div>
	

<div class="cle"></div>
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