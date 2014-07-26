<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\task\tao_add.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\task\tabtao.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\task\tao_add.htm','D:\damaihu\xinyupingtai7\cache\default\task\tao_add.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/task/';$cssList=array(0=>'http://damaihu.tertw.net/css/task/task.css');echo '

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
    <link href="/images/jcalendar.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/images/jquery.js"></script>
    <script type="text/javascript" src="/images/common.js"></script>
    <script type="text/javascript" src="/images/service.js"></script>
    <script type="text/javascript" src="/images/CreateMission.js"></script>
    <script type="text/javascript" src="/images/artDialog.js"></script>
	<script type="text/javascript" src="/javascript/index/WdatePicker.js"></script>
<script type="text/javascript">
var zgMax=20;
var curMoney=';echo $memberFields['money'];echo ';
var curG=';echo $memberFields['money'];echo ';
var tuoguantask=false;
var curExam=';echo $memberFields['exam']?'true':'false';echo ';
var isVip=';if($memberFields['vip']>0){echo 'true';}else{echo 'false';}echo ';
var webqq = 1371752337;
var webnoticeurl = "";
var webnoticetit = "";
var basePriceDouble=1.5;
var validDomains = new Array();
validDomains[0]="http://meal.taobao.com/";
validDomains[1]="http://detail.taobao.com/";
validDomains[2]="http://item.beta.taobao.com/";
validDomains[3]="http://item.taobao.com/";
validDomains[4]="http://item.tmall.com/";
validDomains[5]="http://item.lp.taobao.com/";
validDomains[6]="http://kezhan.trip.taobao.com/";
validDomains[7]="http://ju.taobao.com/";
validDomains[8]="http://ershou.taobao.com/";
validDomains[9]="http://detail.tmall.com/";
validDomains[10]="http://wk.taobao.com/";
validDomains[11]="http://wt.taobao.com/";
validDomains[12]="http://bang.taobao.com/";
validDomains[13]="http://zxn.taobao.com/";
</script>
    <script type="text/javascript" src="/images/jcalendar.js"></script>
    <style type="text/css">
.kd a:hover {';echo ' text-decoration:underline;';echo '}
.newsHelp{';echo 'cursor: pointer;width: 999px; height: 87px; background: url(/images/hhbj.gif) repeat scroll 0px 0px ; margin: 10px 0;';echo '}
.newsHelp a{';echo 'float: left; width: 25px; background: url() repeat scroll 0px 0px ; height: 25px; margin: 46px 0px 0px 172px;';echo '}
</style>
    <style>
.taskbutton {';echo ' margin: 0px 0 20px 154px;';echo '}
.taskadd {';echo ' width:162px; height:45px; margin-top:0px;*margin-top:15px;background:url(/images/rwdt_05.jpg) no-repeat; text-indent:162px; border:none;overflow:hidden; display:block;';echo '}
.taskadd:hover {';echo ' background:url(/images/rwdt_05.jpg)  0px -50px no-repeat;';echo '}
</style>
    <div id="content">
  <div class="h15">';if($_showmessage){echo '
        <div class=\'msg_panel\'>
      <div>';echo $_showmessage;echo '</div>
    </div>
        ';}echo '
        ';if($indexMessage){echo '
        <div class=\'error_panel\'>
      <div>';echo $indexMessage;echo '</div>
    </div>
        ';}echo '</div>
  <div class="fabu_box1">
        <div class="fabu_title"><span class="fabu_left"></span><span class="fabu_h2">发布任务须知（*号为必填项）</span><span class="fabu_right"></span></div>
        <div class="cle"></div>
        <div class="fabu_cont">
      <ul>
            <li>马上好评任务：淘宝交易的物品为虚拟物品，买卖双方可以即时确认完成交易并付款。</li>
            <li>24-72小时确认任务：淘宝交易的物品为实际存在的物品，可能包含运费和物流等，需要1－3天后方能确认收货并评价。</li>
            <li>要尽量保证平台任务担保价大于 (淘宝商品价格+快递运费)/2 ，否则接手人拍下商品后您的淘宝改价将会导致您的支付宝使用率低于50%既被淘宝视为信用炒作处理；</li>
            <li>您发任务时，平台中的保证金不得少于任务价，成功发布任务将会在平台中扣押相应的任务保证金；接手人完成您的任务时等额的资金会作为商品款返回给您网店的帐户中；</li>
            <li>您想发布任务的时候，必须保证您拥有相应的麦点，每次发布都会根据商品价格不同扣除相应的麦点数。您如果想让任务排名靠前就可以追加麦点奖励，追加的越多排名就越靠前；</li>
            <li class="chengse">请确认商品地址绝对正确，否则会造成不必要的纠纷。</li>
            <li class="chengse">为了您的店铺安全，发布“实物任务”商品价格请大于10元！</li>
          </ul>
    </div>
      </div>
  <div class="newsHelp"> <a href=\'tencent://message/?uin=';echo $v['qq'];echo '\'></a> </div>
  <a id="mao1"></a> ';echo '
<div class="rwdt_menu">
  <a title="单个任务商品" href="';echo $baseUrl;echo '?m=add" ';if($m=='add'){echo ' class="nov" ';}echo '>单个任务商品</a>
  <a title="来路任务" href="';echo $baseUrl;echo '?m=CreateLaiLuMission" ';if($m=='CreateLaiLuMission'){echo ' class="nov" ';}echo '>来路任务</a>
  <a title="套餐任务" href="';echo $baseUrl;echo '?m=CreateMealMission" ';if($m=='CreateMealMission'){echo ' class="nov" ';}echo '>套餐任务</a>
  <a title="购物车任务" href="';echo $baseUrl;echo '?m=CreateCartMission" ';if($m=='CreateCartMission'){echo ' class="nov" ';}echo '>购物车任务</a>
  <a title="任务模版" href="';echo $baseUrl;echo '?m=tpl" ';if($m=='tpl'){echo ' class="nov" ';}echo '>任务模版</a>
  <a title="已发任务" href="';echo $baseUrl;echo '?m=taskOut" ';if($m=='taskOut'){echo ' class="nov" ';}echo '>已发任务</a>
</div>





';echo '
  <div class="cle"></div>
  <form name="myForm" method="post" id="myForm"onsubmit="return checkForm();">
        <div>';echo $sys_hash_code2;echo '</div>
        <div class="fabu_box2">
      <ul class="cont">
            <li>
          <div class="name"> <span style="color:Red;"></span> 使用模板： </div>
          <div class="value">
                <select id="ddlTemplate" name=\'fromTpl\' style="width:190px;" onchange="getTpl(this);">
              <option selected="selected" value="0">请选择模板</option>
              
					';if($tplList){foreach($tplList as $v){echo '
			         
              <option value="';echo $v['id'];echo '"';if($tplId==$v['id']){echo ' selected';}echo '>';echo $v['name'];echo '</option>
              
			        ';}}echo '
					
            </select>
              </div>
          <div class="exp"> 您可以选择从已经保存的任务模板中选择一个，发布任务将更加方便快捷。 <a target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1313/">查看使用帮助</a> </div>
        </li>
            <li>
          <div class="name"> <span style="color:Red;">*</span> 淘宝掌柜名： </div>
          <div class="value">
                <select id="ddlZGAccount" name=\'nickname\' style="width:190px;">
              
					';if($sellers){foreach($sellers as $k=>$v){echo '
					
              <option selected="selected" value=\'';echo $v['nickname'];echo '\' ';if($datas['nickname']==$v['nickname']){echo ' selected="selected"';}echo '>
              ';echo $v['nickname'];echo '
              </option>
              
					';}}echo '
					
            </select>
              </div>
          <div class="exp">就是您想提升信誉的淘宝帐号，接任务的朋友用来确认您的身份。</div>
        </li>
            <li>
          <div class="name"> <span style="color:Red;">*</span> 商品链接地址： </div>
          <div class="value long">
                <input id="txtGoodsUrl" class="txt" value="';echo $datas['itemurl'];echo '" style="width:100%;" name="itemurl" type="text">
              </div>
          <div class="exp">填写您要对方购买的商品地址，尽量使用不同商品来发布任务。</div>
        </li>
            <li>
          <div class="name"> <span style="color:Red;">*</span> 商品担保价格： </div>
          <div class="value">
                <input id="txtPrice" class="txt" value="';echo $datas['price'];echo ' " style="width:152px;color:#f50;" name="price" type="text">
                元
                <p style="padding-top:3px;">
              <input id="chssp" style="margin-left:-2px;+margin-left:-5px;" ';if($datas['chssp']){echo ' checked="checked"';}echo ' value="1" name="chssp" type="checkbox">
              <span style="color:#999">打折类物品，取消商品价格限制</span></p>
              </div>
          <div class="exp"> 此价格为您发布的宝贝改价后包括邮费的总价，接手者购买商品时支付给您的价钱总和！此价格不能大于您在平台的保证金！您目前平台存款为 <em>';echo $memberFields['money'];echo '</em> 元， <a target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/">我要充值</a> </div>
        </li>
            <li>
          <div class="name">是否需要改价：</div>
          <div class="value">
                <input id="cbxIsGJ" style="margin-left:-2px;+margin-left:-5px;" value="1"';if($datas['isPriceFit']){echo ' checked="checked"';}echo '  name="isPriceFit" type="checkbox">
                <br>
                <br>
              </div>
          <div class="exp">商品价格+邮费&gt;任务商品担保价格时，请勾选！改价不要超过商品价格的50%，支付宝使用率低于50%既被淘宝视为信用炒作处理。</div>
        </li>
            <li>
          <div class="name">是否商保任务：</div>
          <div class="value">
                <input id="cbxIsSB" style="margin-left:-2px;+margin-left:-5px;" value="1" name="isEnsure" type="checkbox" ';if($datas['isEnsure']){echo ' checked';}echo '>
                <input name="ensurePoint"  value="';echo $ensurePoint;echo '" type="hidden">
                <br>
                <br>
              </div>
          <div class="exp"> 要求接手方缴纳保证金后成为平台的商保用户才可以接手，需额外支付<em>0.3</em>个麦点给接手方，—— <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/ensure/" target="_blank">我要立即加入商保</a> </div>
        </li>
            <li>
          <div class="name">基本麦点：</div>
          <div class="value">
                <input id="txtMinMPrice" class="txt" value="0" style="width:130px;color:#f50;background:#F0F0F0;" name="txtMinMPrice" readonly="readonly" type="text">
                个麦点 </div>
          <div class="exp"> 发布该价格任务需要扣除的麦点，不包括增值服务. <a target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t30/">查看商品的价格与最底消耗额的关系</a> <br>
                您目前还有麦点 <em>';echo $memberFields['fabudian'];echo '</em> 个， <a target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/BuyPoint/">我要购买</a> </div>
        </li>
            <li>
          <div class="name">追加悬赏麦点：</div>
          <div class="value">
                <input id="pointExt" class="txt" style="width:130px;color:#f50;"  name="pointExt" type="text" value="';echo $datas['pointExt'];echo '">
                个麦点 </div>
          <div class="exp"> 追加悬赏麦点数越多，更易被人接手，刷钻效率越高！ </div>
        </li>
            <li>
          <div class="name"> <span style="color:Red;">*</span> 要求确认时间： </div>
          <div class="value">
                <select id="ddlOKDay" style="width:230px; height:20px;" name="times">
              <option value="0" selected="selected">马上好评（虚拟任务）</option>
              <option value="1">24小时好评实物任务(基本麦点×1.5+0)</option>
              <option value="2">48小时好评实物任务(基本麦点×1.5+1)</option>
              <option value="3">72小时好评实物任务(基本麦点×1.5+2)</option>
              <option value="4">96小时好评实物任务(基本麦点×1.5+3)</option>
              <option value="5">120小时好评实物任务(基本麦点×1.5+4)</option>
              <option value="6">144小时好评实物任务(基本麦点×1.5+5)</option>
              <option value="7">168小时好评实物任务(基本麦点×1.5+6)</option>
            </select>
                <p id="pOKDes"> </p>
                <p style="padding-top:3px;">
              <input id="isNoword" value="1" ';if($datas['isNoword']){echo ' checked';}echo ' name="isNoword" type="checkbox">
              <span style="color:#999">不带字好评</span></p>
              </div>
          <div class="exp"> 24小时以上属于实物任务！平台强制接手方延迟收货！ <br>
                马上好评则必须立刻发货，属于虚拟商品任务，如果强制要求对方延期，是会被投诉的。<br>
                如勾选了不带字好评，又设置了好评内容，则系统自动取消不带字好评勾选 </div>
        </li>
            <a id="mao2"></a>
            <li class="add">
          <div class="name">增值服务：</div>
          <div class="addvalue">
                <ul>
              <li>
                    <div class="name">留言提醒：</div>
                    <div class="value longest">
                  <table border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                      <tr>
                            <td style="padding-left:0px;_padding-left:0px;margin:0px;" valign="top">
							<input id="cbxIsTip" name="cbxIsTip"';if($datas['cbxIsTip']){echo ' checked';}echo '   value="1" type="checkbox"></td>
                            <td style="padding-left:15px;" valign="top"><div id="divTip" style="display:none;margin-bottom:10px;">
                                <div style="margin-bottom:2px;"> 请拍商品
                                <input name="txtBuyCount" maxlength="3" id="txtBuyCount" value="';echo $datas['txtBuyCount'];echo '" class="txt" style="width:50px;" type="text">
                                件
                                <input id="cbIsHiddenName" name="cbIsHiddenName" ';if($datas['cbIsHiddenName']){echo ' checked';}echo ' value="1" type="checkbox">
                                请匿名购买
                                <input id="cbIsNoneAssess" name="cbIsNoneAssess" ';if($datas['cbIsNoneAssess']){echo ' checked';}echo ' value="1" type="checkbox">
                                请只收货等待默认好评 </div>
                                <div style="margin-bottom:2px;"> 区服请填
                                <input name="txtAreaService" maxlength="21" value="';echo $datas['txtAreaService'];echo '" id="txtAreaService" class="txt" style="width:150px;" type="text">
                                &nbsp;&nbsp;
                                帐号请填
                                <input name="txtAccount" maxlength="21" value="';echo $datas['txtAccount'];echo '" id="txtAccount" class="txt" style="width:150px;" type="text">
                              </div>
                                <div style="margin-bottom:2px;"> 手机请填
                                <input name="txtMobile" maxlength="21" value="';echo $datas['txtMobile'];echo '"  id="txtMobile" class="txt" style="width:150px;" type="text">
                                &nbsp;&nbsp;
                                选择规格
                                <input name="txtSpecs" maxlength="51" value="';echo $datas['txtSpecs'];echo '" id="txtSpecs" class="txt" style="width:150px;" type="text">
                              </div>
                                <div style="margin-bottom:2px;"> 动态评分
                                <select name="scores" id="scores" style="width:70px;">
                                    <option value="0" selected="selected">请选择</option>
                                    <option value="1">1 分</option>
                                    <option value="2">2 分</option>
                                    <option value="3">3 分</option>
                                    <option value="4">4 分</option>
                                    <option value="5">5 分</option>
                                  </select>
                                分，
                                物流选择
                                <select name="ddlDeliver" id="ddlDeliver" style="width:70px;">
                                    <option selected="selected" value="">请选择</option>
                                    <option value="平邮">平邮</option>
                                    <option value="快递">快递</option>
                                    <option value="EMS">EMS</option>
                                  </select>
                              </div>
                              </div>
                          <div style="color:#999;padding-left:1px;">您可在此给接手方留言提醒。<em>留言提醒不能作为申诉理由，但总不理会留言的接手方客户酌情处罚，广告留言则重罚。</em><a target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t431/">查看留言规范</a></div></td>
                          </tr>
                    </tbody>
                      </table>
                </div>
                  </li>
              <li>
                    <div class="name">设置审核对象：</div>
                    <div class="value short">
                  <input id="cbxIsAudit"  name="isVerify" value="1"';if($datas['isVerify']){echo ' checked="checked"';}echo ' type="checkbox">
                </div>
                    <div class="exp"> 接手方接任务后，要您亲自审核后，接手方才可看到商品地址，对刷实物和规定旺旺聊天的商家很有用!可以事先QQ联系对方商量好。需要额外支付 <em>0.3</em> 个麦点给接手方 </div>
                  </li>
              <li>
                    <div class="name">需要旺旺聊天：</div>
                    <div class="value short">
                  <input id="cbxIsWW" value="1" name="isChat"';if($datas['isChat']){echo ' checked="checked"';}echo ' type="checkbox">
                </div>
                    <div class="exp"> 要求接手方先在旺旺上聊几句， <em>强烈建议开启审核先使用QQ约定好</em> 。需额外支付 <em>1</em> 个麦点给接手方 </div>
                  </li>
              <li>
                    <div class="name">旺旺确认收货：</div>
                    <div class="value short">
                  <input id="cbxIsLHS" value="1" name="isChatDone"';if($datas['isChatDone']){echo ' checked="checked"';}echo ' type="checkbox">
                </div>
                    <div class="exp">要求接手方收货前登录旺旺与卖家确认收到“货物/服务”同时声明对收到“货物/服务”满意以作为收货证据，需额外支付<em>0.5</em>个麦点给接手方</div>
                  </li>
              <li>
                    <div class="name">规定好评内容：</div>
                    <div class="value long">
                  <input id="cbxIsMsg" name="isRemark" value="1"';if($datas['isRemark']){echo ' checked="checked"';}echo ' type="checkbox">
                  <textarea name="remark" id="txtMessage" onclick="if(this.value.indexOf(\'此处填写您希望接手\')>=0) this.value=\'\';this.style.color=\'#333\';" title="此处填写您希望接手人对您的任务商品的评语内容，例如：“掌柜妹妹很热情，发货速度很快，商品拿到了,感觉比图片上还要漂亮”请不要填写“请带字好评”等引导的文字">';if($datas){echo '';echo $datas['remark'];echo '';}else{echo '此处填写您希望接手人对您的任务商品的评语内容，例如：“掌柜妹妹很热情，发货速度很快，商品拿到了,感觉比图片上还要漂亮”。请不要填写“请带字好评”等引导的文字';}echo '</textarea>
                </div>
                    <div class="exp">您可以规定接手方在淘宝交易好评时填写规定的内容。额外支付的<em>0.1</em>个麦点将奖励给接手方</div>
                  </li>
              <li>
                    <div class="name">规定收货地址：</div>
                    <div class="value longest">
                  <table border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                      <tr>
                            <td style="padding-left:0px;_padding-left:0px;margin:0px;" valign="top">
							<input id="cbxIsAddress" name="isAddress" value="1" type="checkbox" ';if($datas['isAddress']){echo ' checked="checked"';}echo '></td>
                            <td style="padding-left:15px;" valign="top"><div id="cbxTip" style="display:none;margin-bottom:10px;">
                                <div style="margin-bottom:2px;"> </div>
                                <div style="margin-bottom:2px;"> 姓名：
                                <input name="cbxName" maxlength="8" value="';echo $datas['cbxName'];echo '" id="cbxName" class="txt" style="width:150px;" type="text">
                                &nbsp;&nbsp;
                                手机：
                                <input name="cbxMobile" maxlength="11" value="';echo $datas['cbxMobile'];echo '" id="cbxMobile" class="txt" style="width:150px;" type="text">
                              </div>
                                <div style="margin-bottom:5px;"> 邮编：
                                <input name="cbxcode" maxlength="6" value="';echo $datas['cbxcode'];echo '" id="cbxcode" class="txt" style="width:150px;" type="text">
                              </div>
                                <div style="margin-bottom:2px;"> 地址：
                                <textarea name="cbxAddress" id="cbxAddress"  style="margin-left:0px;" onclick="if(this.value.indexOf(\'此处填写您要求接手人\')>=0) this.value=\'\';this.style.color=\'#333\';" title="此处填写您要求接手人的修改的收货地址，包含具体省、市、区及详细地址。">此处填写您要求接手人的修改的收货地址，包含具体省、市、区及详细地址，请不要填写“请带字好评”等引导的文字。</textarea>
                              </div>
                              </div>
                          <div style="color:#999;">您可以规定接手方在淘宝购买商品时填写您指定的收货地址。额外支付<em>0.1</em>个麦点将奖励给接手方</div></td>
                          </tr>
                    </tbody>
                      </table>
                </div>
                  </li>
              <li>
                    <div class="name">好评需要截图：</div>
                    <div class="value short">
                  <input id="ispinimage" name="ispinimage" value="1"';if($datas['ispinimage']){echo ' checked="checked"';}echo ' type="checkbox">
                </div>
                    <div class="exp">您可以规定接手方好评后，必须上传截图证明好评内容。额外支付的<em>0.2</em>个麦点将奖励给接手方</div>
                  </li>
              <li>
                    <div class="name">购物分享：</div>
                    <div class="value short">
                  <input id="isShare" name="isShare" value="1"';if($datas['isShare']){echo ' checked="checked"';}echo ' type="checkbox">
                </div>
                    <div class="exp">淘宝购物分享，分享内容同好评内容，额外支付<em>0.2</em>个麦点将奖励给接手方</div>
                  </li>
              <li>
                    <div class="name">过滤接手人：</div>
                    <div class="value longest">
                  <div id="divFilter" style="margin-bottom:10px;">
                        <div>
                      <label>
                          <input  value="1"';if($datas['isScore']){echo ' checked="checked"';}echo ' id="cbxIsFMinGrade" name="isScore" type="checkbox">
                          </label>
                      <label class="labelstyle" style="width:160px;margin-left:10px;">接手人积分不低于</label>
                      <label class="labelstyle" style="width:50px">
                          <input name="scoreLvl" value="10"';if(!$datas||$datas['scoreLvl']==10){echo ' checked=\'checked\'';}echo ' type="radio">
                          10</label>
                      <label class="labelstyle" style="width:50px">
                          <input name="scoreLvl" value="30"';if(!$datas||$datas['scoreLvl']==30){echo ' checked=\'checked\'';}echo ' type="radio">
                          30</label>
                      <label class="labelstyle" style="width:50px">
                          <input name="scoreLvl" value="50"';if(!$datas||$datas['scoreLvl']==50){echo ' checked=\'checked\'';}echo ' type="radio">
                          50</label>
                      <label class="labelstyle" style="width:50px">
                          <input name="scoreLvl" value="100"';if(!$datas||$datas['scoreLvl']==100){echo ' checked=\'checked\'';}echo ' type="radio">
                          100</label>
                    </div>
                        <div>
                      <label>
                          <input value="1"';if($datas['isBlack']){echo ' checked="checked"';}echo ' id="cbxIsFMaxBBC" name="isBlack" type="checkbox">
                          </label>
                      <label class="labelstyle" style="width:160px;margin-left:10px;">接手买号被拉黑次数不大于</label>
                      <label class="labelstyle" style="width:50px">
                          <input name="blackLvl" value="5"';if($datas['blackLvl']==5){echo ' checked=\'checked\'';}echo ' type="radio">
                          5</label>
                      <label class="labelstyle" style="width:50px">
                          <input  name="blackLvl" value="10"';if($datas['blackLvl']==10){echo ' checked=\'checked\'';}echo ' type="radio">
                          10</label>
                      <label class="labelstyle" style="width:50px">
                          <input  name="blackLvl" value="15" ';if($datas['blackLvl']==15){echo ' checked=\'checked\'';}echo ' type="radio">
                          15</label>
                    </div>
                        <div>
                      <label>
                          <input value="1"';if($datas['isGood']){echo ' checked="checked"';}echo ' id="cbxIsFMaxABC"  name="isGood"  type="checkbox">
                          </label>
                      <label class="labelstyle" style="width:160px;margin-left:10px;">接手人刷客满意度不低于</label>
                      <label class="labelstyle" style="width:50px">
                          <input name="goodLvl" value="98" ';if($datas['goodLvl']==98){echo ' checked=\'checked\'';}echo ' type="radio">
                          98%</label>
                      <label class="labelstyle" style="width:50px">
                          <input name="goodLvl" value="95" ';if($datas['goodLvl']==95){echo ' checked=\'checked\'';}echo ' type="radio">
                          95%</label>
                      <label class="labelstyle" style="width:50px">
                          <input name="goodLvl" value="90" ';if($datas['goodLvl']==90){echo ' checked=\'checked\'';}echo ' type="radio">
                          90%</label>
                    </div>
                        <div>
                      <label>
                          <input value="1"';if($datas['isCredit']){echo ' checked="checked"';}echo ' id="cbxIsFMaxCredit" name="isCredit" type="checkbox">
                          </label>
                      <label class="labelstyle" style="width:160px;margin-left:10px;">接手买号信誉不高于</label>
                      <label class="labelstyle" style="width:50px">
                          <input name="creditLvl" value="10"';if(!$datas||$datas['creditLvl']==10){echo ' checked=\'checked\'';}echo ' type="radio">
                          10</label>
                      <label class="labelstyle" style="width:50px">
                          <input name="fameLvl" value="150"';if(!$datas||$datas['creditLvl']==150){echo ' checked=\'checked\'';}echo ' type="radio">
                          150</label>
                      <label class="labelstyle" style="width:50px">
                          <input name="creditLvl" value="200"';if(!$datas||$datas['creditLvl']==200){echo ' checked=\'checked\'';}echo ' type="radio">
                          200</label>
                    </div>
                        <div>
                      <label>
                          <input value="1"';if($datas['isFMaxBTSCount']){echo ' checked="checked"';}echo ' id="cbxIsFMaxBTSCount" name="isFMaxBTSCount" type="checkbox">
                          </label>
                      <label class="labelstyle" style="width:160px;margin-left:10px;">接手人被有效投诉次数不大于</label>
                      <label class="labelstyle" style="width:50px">
                          <input name="FMaxBTSCount" value="2"';if($datas['FMaxBTSCount']==2){echo ' checked=\'checked\'';}echo ' type="radio">
                          2</label>
                      <label class="labelstyle" style="width:50px">
                          <input name="FMaxBTSCount" value="3"';if($datas['FMaxBTSCount']==3){echo ' checked=\'checked\'';}echo ' type="radio">
                          3</label>
                      <label class="labelstyle" style="width:50px">
                          <input name="FMaxBTSCount" value="4"';if($datas['FMaxBTSCount']==4){echo ' checked=\'checked\'';}echo ' type="radio">
                          4</label>
                    </div>
                      </div>
                  <div style="color:#999;">您可以设置接手人的最低资质要求，系统将自动为您过滤掉不合格的接手人。每条任务需额外支付<em>0.5</em>个麦点给接手方。 <a target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1314/">如何设置筛选条件</a></div>
                </div>
                  </li>
              <li>
                    <div class="name">限制接手人：</div>
                    <div class="value longest">
                  <div id="divFMCount" style="margin-bottom:5px;">
                        <div>
                      <label>
                          <input value="1"';if($datas['isLimit']){echo ' checked="checked"';}echo ' id="cbxIsFMaxMCount" name="isLimit" type="checkbox">
                          </label>
                      <input name="limit" value="1"';if(!$datas||$datas['limit']==1){echo ' checked="checked"';}echo ' id="fmaxmc_1"price="0.5" type="radio">
                      1天接1个(<em>0.5</em>个麦点)
                      <input name="limit" value="2"';if(!$datas||$datas['limit']==2){echo ' checked="checked"';}echo '  price="0.2" id="fmaxmc_2" type="radio">
                      1天接2个(<em>0.2</em>个麦点)
                      <input name="limit" value="3"';if(!$datas||$datas['limit']==3){echo ' checked="checked"';}echo '  id="fmaxmc_3" type="radio">
                      1周接1个(<em>1</em>个麦点)</div>
                      </div>
                  <div class="exp">您可以设置接手人在1天或一周内接手您发布任务的次数，需额外支付麦点</div>
                </div>
                  </li>
              <li>
                    <div class="name">买号实名认证：</div>
                    <div class="value longest">
                  <div id="divBaLevel" style="margin-bottom:5px;">
                        <input id="isReal" ';if($datas['isReal']){echo ' checked="checked"';}echo ' value="1" name="isReal" type="checkbox">
                        <input name="realname"  ';if($datas['realname']){echo ' checked="checked"';}echo ' value="1" id="isReal_1" type="radio">
                        <label for="isReal_1"> 普通实名(<em>0.5</em>个麦点) </label>
                      </div>
                  <div class="exp">限制接手买号必须是通过了支付宝实名认证才可以接手此任务</div>
                </div>
                  </li>
              <li>
                    <div class="name">淘金币：</div>
                    <div class="value longest">
                  <input id="cbxIsTaoG" value="1" ';if($datas['cbxIsTaoG']){echo ' checked="checked"';}echo ' name="cbxIsTaoG" type="checkbox">
                  <input name="txtTaoG" maxlength="3" value="';echo $datas['txtTaoG'];echo '" id="txtTaoG" class="txt" style="width:40px;" type="text">
                  必须为10的倍数，最大不超过300，每10个淘金币需支付<em>0.1</em>个麦点给接手方 </div>
                    <div class="exp"></div>
                  </li>
              <li>
                    <div class="name">快递单号任务：</div>
                    <div class="value longest">
                  <input name="isawb" id="isawb" ';if($datas['isawb']){echo ' checked="checked"';}echo ' value="1" type="checkbox">
                  <label>
                      <input id="expressfull" name="expressfull" value="shunfeng" type="radio">
                      顺风(<em>5</em>麦点)</label>
　　 　 
不了解的用户请勿选择；                   <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t3917/" target="_blank">了解详情</a> </div>
                    <div class="exp"></div>
                  </li>
              <li>
                    <div class="name">真实签收任务：</div>
                    <div class="value longest">
                  <input name="isSign" id="isSign" ';if($datas['isSign']){echo ' checked="checked"';}echo ' value="1" type="checkbox">
                  <label>
                      <input id="Express_1" name="Express" ';if($datas['Express']==1){echo ' checked="checked"';}echo ' value="1" type="radio">
                      全国(<em>1.5</em>个麦点)</label>
　　
                  <label>
                      <input id="Express_2" name="Express" ';if($datas['Express']==2){echo ' checked="checked"';}echo ' value="2" cid="0" type="radio">
                      同省[](<em>2</em>个麦点)</label>
                  不了解的用户请勿选择；<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1685/" target="_blank">了解详情</a> </div>
                    <div class="exp"></div>
                  </li>
              <li>
                    <div class="name">指定接手地区：</div>
                    <div class="value longest">
                  <div style="margin-bottom:10px;">
                        <input id="isLimitCity" title="勾上才启用，现在只能具体到省" value="1" name="isLimitCity" type="checkbox">
                        <script type="text/javascript" src="/images/city2.js"></script>
                        <!--<input name="isMultiple" onclick=" " id="isMultiple" value="1" type="checkbox">-->
                        <!--多选省份--> </div>
                  <div style="color:#999;">使用方法按住ctrl在所需要的省份上单击鼠标左键可以实现多选。<br>例如你指定接手地区，避免重复用户交易，需额外支付<font color="red">0.5</font>个发布点</div>
                </div>
                  </li>
              <li>
                    <div class="name" style="padding-top:5px\\9;+padding-top:10px;">任务发布时间：</div>
                    <div class="value longest">
                  
                  <div>
                        <input id="isPlan" value="1" name="isPlan" type="checkbox">
                        <span style="color:#000">定时发布</span>此任务将于
                        <input type="text" name="planDate" id="planDate" class="task_text" value="';echo $datas['planDate'];echo '" readonly="readonly" onclick="WdatePicker({';echo 'dateFmt:\'yyyy-MM-dd HH:mm:ss\'';echo '});" /> 显示在大厅 </div>
                  <p>定时发布需额外支付<em>0.1</em>个麦点给接者</p>
                  <p>(设置延迟发布后，不论您是否在线，都会显示在任务大厅，请保持您的联系方式畅通，长时间不响应会被接手方投诉的)</p>
                </div>
                  </li>
              <li>
                    <div class="name"> 保存任务模版：</div>
                    <div class="value longest">
                  <input id="isTpl" value="1" name="isTpl" type="checkbox">
                  <span style="color:#000">模版名称</span>
                  <input name="tplTo" id="tplTo" class="txt" maxlength="50" type="text">
                  <br>
                  实现快捷方便的发布任务,普通用户最多可保存3个任务发布模板，VIP可拥有30个任务发布模板 <a target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/vipinfo/">查看VIP特权</a> </div>
                    <div class="exp"></div>
                  </li>
            </ul>
              </div>
        </li>
            
          </ul>
		  
		 <p class="taskbutton">
				<input style="cursor: pointer;" name="btnAdd" id="btnCilentAdd" class="taskadd" value="立即发布" type="button" onsubmit="return checkForm();">
		</p>
				 <input type="hidden" name="qq" id="qq" value="';echo $members['qq'];echo '" />
		 <input style="display:none" id="btnAdd" type="submit" name="btnAdd" value="提交查询内容">
   
    </div>
      </form>
</div>
<script type="text/javascript">
function getTpl(obj) {';echo '
    if (obj.value == \'0\')
        return ;
    var url = \'/task/tao/?m=add&tplId=\' + obj.value;
    window.location.href = url;
';echo '}
</script>
    <div class="cle"></div>
    ';echo '<div id="footer">
		<p><span class="chengse">官方QQ号码：1371752337</span> （加群请注明大麦户）</p>
		<p class="lanse"><a href="#">关于我们</a>|<a href="#">联系我们</a>|<a href="#">大麦户规则</a>|<a href="#">网站地图</a>|<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '" target="_blank">淘宝信誉查询</a> </p>
		<p style="text-align:center;">
	
		<p class="lanse">客户服务热线：02968929109   Copyright © 2012-2020 Damaihu.com All RightsReserved    大麦户版权所有 <a href="#" target="_blank">粤ICP备13037934号</a><span style="display:none">
</span></p>
	</div>
	</div>
    </div>';echo ' ';?>