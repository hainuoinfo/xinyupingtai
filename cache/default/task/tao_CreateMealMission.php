<?php $_tplModify=filemtime('D:\xinyupingtai\cache\default\task\tao_CreateMealMission.php');if(filemtime('D:\xinyupingtai\templates\default\header2_base.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\service.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\task\tabtao.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\xinyupingtai\templates\default\task\tao_CreateMealMission.htm','D:\xinyupingtai\cache\default\task\tao_CreateMealMission.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/task/';$cssList=array(0=>'http://d.hainuo.info/css/task/task.css');echo '
';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>';echo $title;echo '</title>
<meta name="description" content="';echo $description;echo '" />
<meta name="keywords" content="';echo $keywords;echo '" />
';if($cssList){foreach($cssList as $v){echo '
<link rel="stylesheet" type="text/css" href="';echo $v;echo '" />
';}}echo '
<script type="text/javascript" src="http://d.hainuo.info/javascript/jquery.min.js"></script><script type="text/javascript" src="http://d.hainuo.info/javascript/common.func.js"></script>

<style type="text/css">
.kd a:hover {';echo ' text-decoration:underline;';echo '}
#content table tr td{';echo 'padding-left:13px;_padding-left:6px;*padding-left:6px!important;';echo '}
.buyerspages a {';echo 'background:#F8F8F8; border: 1px solid #E8E8E8;display: block; float: left;height: 25px;margin: 0 2px;text-align: center;width: 25px';echo '}
.buyerspages a:hover,.buyerspages a.nov{';echo ' background:#EAF4FD; border-color: #B0D0E9;';echo '}
.autotk {';echo 'position:absolute; top:55px; right:30px; ';echo '}
.autotk input {';echo 'margin-top:5px;';echo '}
.autotk strong {';echo ' color:#FF5500;';echo '}
.rwdt_dexpress{';echo 'background:url(/images/tx_ico_28.png) no-repeat;float:left;display:block;width:145px;text-indent:20px;height:17px;line-height:17px;color:#333;';echo '}
</style>

<style type="text/css">* html body{';echo 'margin:0';echo '}.ui_title_icon,.ui_content,.ui_dialog_icon,.ui_btns span{';echo 'display:inline-block;*zoom:1;*display:inline';echo '}.ui_dialog{';echo 'text-align:left;display:none;position:absolute;top:0;left:-99999em;_overflow:hidden';echo '}.ui_dialog table{';echo 'border:0;margin:0;border-collapse:collapse';echo '}.ui_dialog td{';echo 'padding:0';echo '}.ui_title_icon{';echo 'vertical-align:middle';echo '}.ui_title_text{';echo 'overflow:hidden;cursor:default;-moz-user-select:none;user-select:none';echo '}.ui_close{';echo 'display:block;position:absolute;outline:none';echo '}.ui_content_wrap{';echo 'height:auto;text-align:center';echo '}.ui_content{';echo 'margin:10px;text-align:left';echo '}.ui_dialog_icon{';echo 'vertical-align:middle';echo '}.ui_content.ui_iframe{';echo 'margin:0;*padding:0;display:block;height:100%';echo '}.ui_iframe iframe{';echo 'width:100%;height:100%;border:none;overflow:auto';echo '}.ui_bottom{';echo 'position:relative';echo '}.ui_resize{';echo 'position:absolute;right:0;bottom:0;z-index:1;cursor:nw-resize;_font-size:0';echo '}.ui_btns{';echo 'text-align:right;white-space:nowrap';echo '}.ui_btns span{';echo 'margin:5px 10px';echo '}.ui_content em{';echo 'font-weight:700;font-style:normal;color:#ff5500;';echo '}.ui_btns button{';echo 'cursor:pointer';echo '}.ui_overlay{';echo 'display:none;position:absolute;top:0;left:0;width:100%;height:100%;filter:alpha(opacity=0);opacity:0;_overflow:hidden';echo '}.ui_overlay div{';echo 'height:100%';echo '}* html .ui_ie6_select_mask{';echo 'width:99999em;height:99999em;position:absolute;top:0;left:0;z-index:-1';echo '}.ui_move .ui_title_text{';echo 'cursor:move';echo '}html >body .ui_dialog_wrap.ui_fixed .ui_dialog{';echo 'position:fixed';echo '}* html .ui_dialog_wrap.ui_fixed .ui_dialog{';echo 'fixed:true';echo '}* html.ui_ie6_fixed{';echo 'background:url(*) fixed';echo '}* html.ui_ie6_fixed body{';echo 'height:100%';echo '}* html .ui_dialog_wrap.ui_fixed{';echo 'width:100%;height:100%;position:absolute;left:expression(documentElement.scrollLeft+documentElement.clientWidth-this.offsetWidth);top:expression(documentElement.scrollTop+documentElement.clientHeight-this.offsetHeight)';echo '}html.ui_page_lock >body{';echo 'overflow:hidden';echo '}* html.ui_page_lock{';echo 'overflow:hidden';echo '}* html.ui_page_lock select,* html.ui_page_lock .ui_ie6_select_mask{';echo 'visibility:hidden';echo '}html.ui_page_lock >body .ui_dialog_wrap.ui_lock{';echo 'width:100%;height:100%;position:fixed;top:0;left:0';echo '}</style></head>

<body>
	<!--头部开始-->
	<style>
#dmh_head {';echo 'background: #EFF6FE;border-bottom: 1px solid #DBEBFA;height: 25px;left: 0;position: fixed;width: 100%;z-index: 9999;';echo '}
#dmh_head .kd {';echo 'position: relative;';echo '}
#dmh_head .kd, #m_banner .kd {';echo 'margin: 0 auto;width: 980px;';echo '}
#dmh_head .kmain {';echo 'position: absolute;top: 0;width: 898px;';echo '}
#dmh_head .hy {';echo 'float: left;';echo '}
#dmh_head .kd .dmhtel {';echo 'background: url("/images/dmhtel.png") no-repeat scroll 7px center transparent;float: left;height: 22px;padding-left: 25px;width: 36px;';echo '}
#dmh_head .hy a {';echo 'color: #1595DE;margin: 0 5px;';echo '}
#dmh_head .hy a.col3 {';echo 'color: #666666;margin: 0 10px;';echo '}
#dmh_head .top_btn {';echo 'color: #1595DE;float: right;';echo '}
#dmh_head .top_btn a {';echo 'color: #1595DE;margin: 0 10px;';echo '}
#dmh_head .menu_qq {';echo 'text-align: right;';echo '}
#dmh_head .menu_qq a {';echo 'color: #1595DE;font-family: Tahoma,​Helvetica,​Arial,​宋体;font-size: 12px;padding-left: 26px;';echo '}
#dmh_head .menu_qq .qq_help {';echo 'background: url("/images/tx_ico.gif") no-repeat scroll 0 -958px transparent;';echo '}
#dmh_head .help_down {';echo 'background: none repeat scroll 0 0 #FFFFFF;border: 3px solid #7FC3F4;padding: 0 10px;position: absolute;right: 0;top: 25px;width: 500px;z-index: 9999;height:255px;*height:270px;';echo '}
#dmh_head .help_down ul {';echo 'border-bottom: 1px dashed #DDDDDD;padding-left: 10px;padding-top: 6px;';echo '}
#dmh_head a:hover{';echo 'color:#FE5500';echo '}
#dmh_head b{';echo 'color:#FE5500';echo '}
#dmh_head .quick-menu {';echo 'margin: 2px 0 0 0;';echo '}
#dmh_head .quick-menu li.menu-item {';echo 'padding: 1px 0 0;position: relative;margin-right: 1px;';echo '}
#dmh_head .quick-menu li {';echo 'background-position: right 6px;float: left;margin-left: -1px;background:none;border:1px solid #EFF6FE;';echo '}
#menu-0{';echo 'display:none;';echo '}	
#dmh_head .menu {';echo 'position: relative;float: left;line-height: 140%;';echo '}
#dmh_head .menu-hd {';echo 'cursor: pointer;height: 20px;padding: 1px 22px 0 16px;position: relative;z-index: 10002;';echo '}
#dmh_head .menu-hd b {';echo 'border-color: #666666 #EFF6FE #EFF6FE;border-style: solid;border-width: 4px;font-size: 0;height: 0;line-height: 0;position: absolute;right: 10px;top: 6px;transition: transform 0.2s ease-in 0s;width: 0;';echo '}
/*针对客服帮助*/
#dmh_head .help_down {';echo '
    background: none repeat scroll 0 0 #FFFFFF;
    border: 3px solid #7FC3F4;
    height:195px;
    padding: 0 10px;
    position: absolute;
    right: 0;
    top: 25px;
    width: 500px;
    z-index: 9999;
';echo '}
</style>
</head>
<body>
<!--头部开始-->
<div id="dmh_head">
	<div class="kd">
	    <div class="kmain">
			<div class="hy">
				<a href="###" class="dmhtel">手机版</a>
				
				<div style="float:left;">
					<span style="color:#1595DE">|</span>
					<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info/?username=';echo $member['username'];echo '">';echo $member['username'];echo '</a>
					<IMG title="积分：';echo $memberFields['credits'];echo '" alt="积分" src="';echo $memberLevel['icon'];echo '">
					<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/logout/" class="col3">退出</a>
				</div>
				
			</div>
			<div class="top_btn">
				
				<ul class="quick-menu">
					<li class="menu-item">
						<div class="menu">
							<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/html/express/" style="width:50px;margin:0;" class="menu-hd" tabindex="0">单号搜索<b></b></a>
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
							<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/" style="margin:0;" class="menu-hd" tabindex="0">存款：<span class="chengse moneyAll" style="font-weight:700;">';echo $memberFields['money'];echo '</span><b></b></a>
							<div style="width: 88px;line-height:1.7;" class="menu-bd" id="menu-0">
							  <div style="padding:8px 5px;" class="menu-bd-panel">
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/">账号充值</a>
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/PayDetails/?type=index">存款明细</a>
							  </div>
							</div>
						</div>
					</li>
					<li style="margin-top: -2px;">|</li>
					<li class="menu-item">
						<div class="menu">
							<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/BuyPoint/" style="margin:0;" class="menu-hd" tabindex="0">麦点：<span class="chengse moneyAll" style="font-weight:700;">';echo $memberFields['fabudian'];echo '</span><b></b></a>
							<div style="width: 88px;line-height:1.7;" class="menu-bd" id="menu-0">
							  <div style="padding:8px 5px;" class="menu-bd-panel">
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/BuyPoint/">购买麦点</a>
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/PayDetails/?type=logpoint">麦点明细</a>
							  </div>
							</div>
						</div>
					</li>
					<li style="margin-top: -2px;">|</li>
					<li class="menu-item">
						<div class="menu">
							<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/" style="margin:0;" class="menu-hd" tabindex="0">信息：<span class="chengse moneyAll" style="font-weight:700;">(';echo $memberFields['msg'];echo ')</span><b></b></a>
							<div style="width: 90px;line-height:1.7;" class="menu-bd" id="menu-0">
							  <div style="padding:8px 5px;" class="menu-bd-panel">
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=inUser">私人收件箱</a>
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=inSys">官方收件箱</a>
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=setting">提醒设置</a>
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
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/selfservice/#moreservice">找回密码</a>
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/selfservice/#moreservice">找回操作码</a>
								  <a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/selfservice/">更多操作</a>
							  </div>
							</div>
						</div>
					</li>
					<li style="margin-top: -2px;">|</li>
					<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/rank.html" style="margin-top: -2px;">大麦户排行榜</a>
				</ul>
				
			</div>
		</div>
		
		<div class="menu_qq">
			<a class="qq_help" onmouseover="showcsqq();" href="javascript:;">客服帮助</a>
		</div>
		<div id="service_qq" class="help_down" style="display:none;"></div>
	</div>
</div>
<!--头部结束-->
<!--logo开始-->
	<div id="m_logo">
		<a href="/" class="logo"><img src="';echo $web_logo;echo '" alt="大麦户_淘宝刷信誉" /></a>
		<a href="default/DmSEO.html" class="gg" target="_blank"><img src="/images/bkzl.jpg" alt="爆款教程" title="爆款教程" height="67" border="0" width="689"></a>
	</div>
<!--头部结束-->
<!--菜单开始-->
<div id="m_menu" style="position:relative; z-index:2;">
	  <div class="menu_nav">
		  <div class="m_menu_nav">
			<ul>
			<li><a href="';echo $weburl2;echo '" ';if($action=='index'){echo ' class="current"';}echo '>首页</a></li>
			<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/tao/" ';if($action=='task'&&$operation=='tao'){echo ' class="current"';}echo '>淘宝大厅</a></li>
			<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/pai/" ';if($action=='task'&&$operation=='pai'){echo ' class="current"';}echo '>拍拍大厅</a></li>
			<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/collect/" ';if($action=='collect'&&$operation=='collect'){echo ' class="current"';}echo '>收藏流量</a></li>
			<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/BuyPoint/" ';if($action=='member'&&$operation=='BuyPoint'){echo ' class="current"';}echo '>购买麦点</a></li>
			<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/Tuoguanfuwu/">网店托管</a></li>
			<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/DmSEO/">淘宝推广</a></li>
			<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/" ';if($action=='bbs'){echo ' class="current"';}echo '>有问必答</a></li>
			<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/" ';if($action=='member'&&$operation=='index'){echo ' class="current"';}echo '>会员中心</a></li>
            <li style="cursor: pointer;margin-left: 5px; background:url(../../images/121212.png) no-repeat scroll 0% 0% transparent; width: 95px; height: 49px; margin-top: -13px;" onclick="window.open(\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/guide/\')">

    <img style="margin-top: 20px; margin-left: 3px;" src="/images/321.gif"></img>

            </li>
			</ul>
		   </div>
	  </div>
</div>
';echo '<div id=\'kf2\' style=\'display:none; position:absolute;\'>
	<table class=\'tbl_kf2\' border=\'0\' cellspacing=\'1\' cellpadding=\'3\'>
		<tr>
			<td colspan=\'4\' class=\'kf_time\'>客服在线时间：09:30-17:30  19:30-22:30</td>
		</tr>
		<tr class=\'kf_bar2\'>
			<td>业务指导</td>
			<td>财务专员</td>
			<td>申诉建议</td>
			<td><span class=\'f_orange\'>VIP专员</span></td>
		</tr>
		<tr class=\'kf_txt2\'>
			<td>
				<p><a target=\'_blank\' href=\'http://wpa.qq.com/msgrd?v=3&uin=908290411&site=qq&menu=yes\'><img border=\'0\' src=\'http://wpa.qq.com/pa?p=1:908290411:17\' alt=\'1号业务客服\' title=\'1号业务客服\' /></a><strong>1号业务客服</strong><br />QQ：908290411</p>
				
			</td>
			<td><p><a target=\'_blank\' href=\'http://wpa.qq.com/msgrd?v=3&uin=8733829&site=qq&menu=yes\'><img border=\'0\' src=\'http://wpa.qq.com/pa?p=1:8733829:17\' alt=\'财务1号\' title=\'财务1号\' /></a><strong>财务1号</strong><br />QQ：8733829</p>
			</td>
			<td><p><a target=\'_blank\' href=\'http://wpa.qq.com/msgrd?v=3&uin=799808427&site=qq&menu=yes\'><img border=\'0\' src=\'http://wpa.qq.com/pa?p=1:799808427:17\' alt=\'申诉1号\' title=\'申诉1号\' /></a><strong>申诉1号</strong><br />QQ：799808427</p>
			</td>
			<td><p><a target=\'_blank\' href=\'http://wpa.qq.com/msgrd?v=3&uin=1216744756&site=qq&menu=yes\'><img border=\'0\' src=\'http://wpa.qq.com/pa?p=1:1216744756:17\' alt=\'VIP1号\' title=\'VIP1号\' /></a><strong>VIP1号</strong><br />QQ：1216744756</p>
			</td>
		</tr>
		<tr class=\'kf_txt2 f_b f_orange\'>
			<td colspan=\'4\'>QQ临时通话容易失败，请先加客服好友。　<span class=\'f_blue\'>';echo $web_name2;echo '官方客服电话：';echo $sys_phone1;echo '</span><br />
				欢迎来电或加QQ咨询刷信誉的安全方法和注意事项，<br />
				我们的客服将为您提供安全刷信誉的经验、教材和指导</td>
		</tr>
	</table>
</div>
<script language="javascript">
$(function(){';echo '
	$(\'#kf2\').hover(function(){';echo '
		$(this).show();
	';echo '}, function(){';echo '
		$(this).hide();
	';echo '});
	$(\'.service\').hover(function(){';echo '
		var myOffset = $(this).offset();
		$(\'#kf2\').show().css({';echo 'left: (myOffset.left - 400) + \'px\', top: (myOffset.top + 16) + \'px\'';echo '});
	';echo '}, function(){';echo '
		$(\'#kf2\').hide();
	';echo '});
';echo '})
function showKF2(obj) {';echo '
	var _div = document.getElementById("kf2");
	var p = fGetXY(obj);
	_div.style.top = (p.y + 16)  + "px";
	_div.style.left = (p.x - 400) + "px";
	_div.style.display = "inline";
';echo '}
function sqq(qq, name) {';echo '
    return "<p><a target=\'_blank\' href=\'http://wpa.qq.com/msgrd?v=3&uin=" + qq + "&site=qq&menu=yes\'>"
     + "<img border=\'0\' src=\'http://wpa.qq.com/pa?p=1:" + qq + ":17\' alt=\'" + name + "\' title=\'" + name + "\' /></a><strong> " + name + "</strong><br />QQ：" + qq + "</p>";
';echo '}
function fGetXY(aTag){';echo '
	var oTmp = aTag;
	var pt = new Point(0,0);
	do {';echo '
	pt.x += oTmp.offsetLeft;
	pt.y += oTmp.offsetTop;
	oTmp = oTmp.offsetParent;
	';echo '} while(oTmp.tagName!="BODY");
	return pt;
';echo '}
function Point(iX, iY){';echo '
	this.x = iX;
	this.y = iY;
';echo '}
function qqTip(qq) {';echo '
    alert(\'QQ临时通话容易失败，请先加客服好友。\');
    return true;
';echo '}
</script>';echo '
<script type="text/javascript" src="/images/jquery.js"></script>
<script type="text/javascript" src="/images/common.js"></script>
<script type="text/javascript" src="/images/tinyslider.js"></script>
<script type="text/javascript" src="/images/index.js"></script>
<script type="text/javascript" src="/images/service.js"></script>
<script>

var webqq = 176682996;
var webnoticeurl = "bbs/t6155";
var webnoticetit = "大麦户平台中秋放假通知";
var quick_qq = \'<a target="_blank" href="http://wp.qq.com/wpa/qunwpa?idkey=ad5f1355638bee53a8bef1d3161c1c6b6988bb993096ba3f2460434640462aaf"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="大麦户刷钻平台24群" title="大麦户刷钻平台24群"></a>\';
var z_userinfo = $.cookie(\'userinfo\');
if (z_userinfo){';echo '
	z_userinfo = z_userinfo.split(\',\');
';echo '}
if (z_userinfo){';echo '
		var login_info=\'<a href="###" class="dmhtel">手机版</a><div style="float:left;"><span style="color:#1595DE">|</span><a href="/user/info/?username=\'+z_userinfo[1]+\'">\'+z_userinfo[1]+\'</a> <img src="\'+z_userinfo[0]+\'" alt="积分：\'+z_userinfo[2]+\'" title="积分：\'+z_userinfo[2]+\'"> 　<a href="/user/logout/" class="col3">退出</a></div>\';
		var login_info2=login_info2 = \'<ul class="quick-menu"><li class="menu-item"><div class="menu"><a  href="/html/express/" style="width:50px;margin:0;" class="menu-hd" tabindex="0" >单号搜索<b></b></a><div style="width: 88px;line-height:1.7;" class="menu-bd" id="menu-0"><div style="padding:8px 5px;" class="menu-bd-panel"><a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t730/">使用教程</a><br><a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t730/">如何激活</a></div></div></div></li><li style="margin-top: -2px;">|</li><li class="menu-item"><div class="menu"><a  href="/user/topup/" style="margin:0;" class="menu-hd" tabindex="0" >存款：<span class="chengse moneyAll" style="font-weight:700;">\'+z_userinfo[4]+\'</span><b></b></a><div style="width: 88px;line-height:1.7;" class="menu-bd" id="menu-0"><div style="padding:8px 5px;" class="menu-bd-panel"><a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/">账号充值</a><br><a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/PayDetails/?type=index">存款明细</a></div></div></div></li><li style="margin-top: -2px;">|</li><li class="menu-item"><div class="menu"><a  href="/BuyPoint/" style="margin:0;" class="menu-hd" tabindex="0" >麦点：<span class="chengse moneyAll" style="font-weight:700;">\'+z_userinfo[5]+\'</span><b></b></a><div style="width: 88px;line-height:1.7;" class="menu-bd" id="menu-0"><div style="padding:8px 5px;" class="menu-bd-panel"><a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/BuyPoint/">购买麦点</a><br><a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/PayDetails/?type=logpoint">麦点明细</a></div></div></div></li><li style="margin-top: -2px;">|</li><li class="menu-item"><div class="menu"><a  href="/user/message/" style="margin:0;" class="menu-hd" tabindex="0" >信息：<span class="chengse moneyAll" style="font-weight:700;">\'+z_userinfo[3]+\'</span><b></b></a><div style="width: 90px;line-height:1.7;" class="menu-bd" id="menu-0"><div style="padding:8px 5px;" class="menu-bd-panel"><a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=inUser">私人收件箱</a><br><a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=inSys">官方收件箱</a><br><a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=setting">提醒设置</a></div></div></div></li><li style="margin-top: -2px;">|</li><li class="menu-item"><div class="menu"><a href="/help/selfservice/" style="width:52px;margin:0;" class="menu-hd" tabindex="0" >账号设置<b></b></a><div style="width: 90px;line-height:1.7;" class="menu-bd" id="menu-0"><div style="padding:8px 5px;" class="menu-bd-panel"><a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/selfservice/">找回密码</a><br><a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/selfservice/">找回操作码</a><br><a rel="nofollow" target="_top" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/selfservice/">更多操作</a></div></div></div></li><li style="margin-top: -2px;">|</li><a href="/rank.html" style="margin-top: -2px;">大麦户排行榜</a></ul>\';
		$(\'.kmain .hy\').html(login_info);
		$(\'.kmain .top_btn\').html(login_info2);
		
	';echo '}
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

	if (z_userinfo){';echo '
		
		if(z_userinfo[7] == 1){';echo '
			touimg = "boy";
		';echo '}else if(z_userinfo[7] == 2){';echo '
			touimg = "girl";
		';echo '}
		
		var htmcont = "<ul id=\'goone\'>";
		htmcont += "<li style=\'\'><span style=\'width: 100%; float: left; text-align: center; font-size: 14px;\'>一个真实的淘宝信誉平台期待您的加入</span></li>";
		htmcont += "<li style=\'margin: 10px 0 5px 5px;font-size:16px;display:inline;\'>用户名：<font style=\'font-size: 14px;color:#fe5500\'>"+z_userinfo[1]+"</font></li>";	
		htmcont += "<li style=\'margin: 5px 0 5px 5px;font-size:16px;display:inline;\'>存款：<a href=\'/user/PayDetails/\' style=\'font-size: 14px;color:#fe5500\'>"+z_userinfo[4]+"</a></li>";
		htmcont += "<li style=\'margin: 5px 0 5px 5px;font-size:16px;display:inline;\'>麦点：<a href=\'/user/PayDetails/?type=logpoint\' style=\'font-size: 14px;color:#fe5500\'>"+z_userinfo[5]+"</a></li>";
		htmcont += "<li style=\'margin: 5px 0 5px 5px;font-size:16px;display:inline;\'>积分：<a href=\'/user/PayDetails/?type=logcredit\' style=\'font-size: 14px;color:#fe5500\'>"+z_userinfo[2]+"</a></li>";
		htmcont += "<li style=\'margin: 5px 0 5px 5px;font-size:16px;display:inline;\'>登陆次数：<a href=\'/user/PayDetails/?type=logAccount\' style=\'font-size: 14px;color:#fe5500\'>"+z_userinfo[6]+"</a></li>";
		htmcont += "<li style=\'text-align: center;margin-top: 10px ;font-size:16px;\'><a href=\'/task/tao/\'><img src=\'/images/goone.png\' width=275 height=49/></a></li>";
		htmcont += "<div class=\'touimg\'>";
		htmcont += "<a href=\'/user/\'><img src=\'/images/user/"+ touimg +".jpg\' width=100 height=100 /></a>";
		htmcont += "</div>";
		htmcont += "</ul>";
						
		$(".login").html(htmcont)
	';echo '}
';echo '})

</script>

	<script type="text/javascript">(function(){';echo 'document.getElementById(\'___szfw_logo___\').oncontextmenu = function(){';echo 'return false;';echo '}';echo '})();</script>
	<script type="text/javascript">
	<!-- 
	(function (d) {';echo '
	window.bd_cpro_rtid="rjfLrj6";
	var s = d.createElement("script");s.type = "text/javascript";s.async = true;s.src = location.protocol + "//cpro.baidu.com/cpro/ui/rt.js";
	var s0 = d.getElementsByTagName("script")[0];s0.parentNode.insertBefore(s, s0);
	';echo '})(document);
	//-->
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

<script type="text/javascript" src="/images/common.js"></script>
<script type="text/javascript" src="/images/service.js"></script>

</body>
<!--<div class="global">
	<div class="top">
		<div class="top_left">';if($memberLogined){echo '<span class="f_gray">您的当前IP：';echo $intip;echo '，当前服务器时间：';echo date('Y-m-d H:i:s',$timestamp);echo '</span>';}echo '</div>
		<div class="top_right">
		';if($memberLogined){echo '
		您好 <span class="f_b_org">';echo $member['username'];echo '</span> 欢迎回来！　<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/" target="_blank" class="top_msg">站内信<span class=\'f_red\'>(';echo $memberFields['msg'];echo ')</span></a> 　<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/logout/">[安全退出]</a>
		';}else{echo '
		您好，欢迎来到力豪互刷网平台！ <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/login/?referer=';echo $baseUrl2;echo '">登录</a> | <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/reg/">快速注册</a> | <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/forgotpwd/">找回密码</a>
		';}echo '
		</div>
	</div>
	<div class="sys_ann"><strong style=\'color:#0051C1\'>【真实快递任务】【来路订制任务】【实名买号任务】【买号动态寿命】【任务随身申诉】【卡任务短信提醒】【旺旺聊天收货】【手机验证码服务】<br />
		力豪互刷网平台独创八大金刚为您信誉安全保驾护航！！</strong></div>
	<div class="head">
		<div class="head_left"><a href="';echo $weburl;echo '/"><img src="';echo $weburl2;echo '/images/help/logo_help.png" title="';echo $web_name;echo '" alt="';echo $web_name;echo '" border="0" /></a></div>
		<div class="head_right"> <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/">个人中心</a> | <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/">存款充值</a> | <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/">帮助中心</a> | <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/info/service.html">客户服务</a> | <a href="javascript:;" onclick="this.style.behavior=\'url(#default#homepage)\';this.setHomePage(\'';echo $weburl;echo '/\')">收藏本站</a> </div>
	</div>
	<div class="help_head">如果不能在帮助中心找到答案，或者您有其他建议与投诉，您还可以到联盟论坛，与力豪互刷网对话。 <a href="';echo $weburl2;echo 'bbs/" class="link_o">进入';echo $web_name2;echo '联盟论坛</a></div>
	<div class="nav">
		';if($nav_bar){echo '<div class="nav_bar"><strong>当前位置：</strong>
		';if($nav_bar){foreach($nav_bar as $k=>$v){echo '
		';if($k>0){echo ' &raquo; ';}echo '
		';if($v['url']){echo '
		<a href="';echo $v['url'];echo '" class="link_b_1">';echo $v['title'];echo '</a>
		';}else{echo '
		';echo $v['title'];echo '
		';}echo '
		';}}echo '
		</div>
		';}echo '
	</div>-->';echo '
<link href="/images/jcalendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/images/jquery.js"></script>
<script type="text/javascript" src="/images/common.js"></script>
<script type="text/javascript" src="/images/service.js"></script>
<script type="text/javascript" src="/images/CreateMission.js"></script>
<script type="text/javascript" src="/images/artDialog.js"></script>
<script type="text/javascript" src="/images/Common.js"></script>
<script type="text/javascript" src="/javascript/index/WdatePicker.js"></script>
<script type="text/javascript" src="/images/CreateMealMission.js"></script>
<script type="text/javascript">
var zgMax=20;
var curMoney=';echo $memberFields['money'];echo ';
var curG=';echo $memberFields['money'];echo ';
var tuoguantask=false;
var curExam=';echo $memberFields['exam']?'true':'false';echo ';
var isVip=';echo $memberFields['vip']?'true':'false';echo ';
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
.newsHelp a{';echo 'float: left; width: 25px; background: url(/images/xcj.png) repeat scroll 0px 0px ; height: 25px; margin: 46px 0px 0px 172px;';echo '}
</style>

<style>
.taskbutton {';echo ' margin: 0px 0 20px 154px;';echo '}
.taskadd {';echo ' width:162px; height:45px; margin-top:0px;*margin-top:15px;background:url(/images/rwdt_05.jpg) no-repeat; overflow:hidden; line-height:200px; border:none;';echo '}
.taskadd:hover {';echo ' background:url(/images/rwdt_05.jpg)  0px -50px no-repeat;';echo '}
</style>
<div id="content">
		<div class="h15"></div>
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
		<a id="mao1"></a>
		';echo '
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
		<form name="myForm" method="post" id="myForm">
		<div>';echo $sys_hash_code2;echo '</div>
		<div class="fabu_box2">
		   <ul class="cont">
				<li>
					<div class="name">
					<span style="color:Red;"></span>
					使用模板：
					</div>
					<div class="value">
                <select id="ddlTemplate" name=\'fromTpl\' style="width:190px;" onchange="getTpl(this);">
              <option selected="selected" value="0">请选择模板</option>
					';if($tplList){foreach($tplList as $v){echo '  
              <option value="';echo $v['id'];echo '"';if($tplId==$v['id']){echo ' selected';}echo '>';echo $v['name'];echo '</option>
			        ';}}echo '
            </select>
              </div>
					<div class="exp">
					您可以选择从已经保存的任务模板中选择一个，发布任务将更加方便快捷。
					<a target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1313/">查看使用帮助</a>
					</div>
				</li>
				<li>
					<div class="name">
					<span style="color:Red;">*</span>
					淘宝掌柜名：
					</div>
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
					<div class="name">
						<span style="color:Red;">*</span>
						套餐类型：
						</div>
						<div class="value">
						<select id="ddlMealType" name="meal">
						<option selected="selected" value="1">普通套餐任务</option>
						<option value="2">来路套餐任务</option>
						</select>
						</div>
						<div class="exp">
						普通套餐任务，
						<span>4</span>
						麦点基础消耗，来路套餐任务在此基础上再增加
						<span>1</span>
						麦点基础消耗。
					</div>
				</li>
				<li class="limeal">
					<div class="name"></div>
					<div id="divtype" class="value">
					<input id="rshop" checked="checked" name="visitWay" value="1" type="radio">
					搜店铺
					<input id="rgoods" name="visitWay" value="2" type="radio">
					搜商品
					</div>
					<div class="exp">
					需要额外支付1个麦点
					</div>
				</li>
				<li class="limeal">
					<div id="divkey" class="name">搜索店铺关键字</div>
					<div class="value">
					<input id="txtDes" class="txt" style="width:182px;color:#f50;" maxlength="100" name="visitKey" type="text">
					</div>
					<div id="divkeytip" class="exp">请输入您的“店铺名称”或者“掌柜名称”，要确保接手人在淘宝店铺搜索中正确并且唯一能搜索到您的店铺。</div>
				</li>
				<li style="height:90px;" class="limeal">
					<div id="divdes" class="name">店铺搜索提示</div>
					<div class="value">
					<textarea id="txtSearchDes" rows="3" style="width:188px" name="txtSearchDes"></textarea>
					</div>
					<div id="divdestip" class="exp">请输入提示信息，说明店铺在淘宝搜索结果列表中的位置，商品在店铺首页中的大概位置等等，例如：店铺在搜索结果第二个，商品在店铺首页第二排第一个</div>
				</li>
				<li>
					<div class="name">
					<span style="color:Red;">*</span>
					商品链接地址：
					</div>
					<div class="value long">
					<input id="txtGoodsUrl" class="txt" value="http://" style="width:100%;" name="itemurl" type="text">
					</div>
					<div class="exp">填写您要对方购买的商品地址，尽量使用不同商品来发布任务。</div>
				</li>
				<li>
					<div class="name">
					<span style="color:Red;">*</span>
					商品担保价格：
					</div>
					<div class="value"><input id="txtPrice" class="txt" value="0" style="width:152px;color:#f50;" name="price" type="text">
					  元<p style="padding-top:3px;"><input id="chssp" style="margin-left:-2px;+margin-left:-5px;" value="1" name="chssp" type="checkbox"> <span style="color:#999">打折类物品，取消商品价格限制
					</span></p></div>
					<div class="exp">
					此价格为您发布的宝贝改价后包括邮费的总价，接手者购买商品时支付给您的价钱总和！此价格不能大于您在平台的保证金！您目前平台保证金为
					<em>';echo $memberFields['money'];echo '</em>
					元，
					<a target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/menber/topup/">我要充值</a>
					</div>
				</li>
				<li>
					<div class="name">&nbsp;</div>
					<div class="value">
					 
					</div>
					<div class="exp">
					</div>
				</li>
				<li>
					<div class="name">是否需要改价：</div>
					<div class="value">
					<input id="cbxIsGJ" style="margin-left:-2px;+margin-left:-5px;" value="1" name="isPriceFit" type="checkbox">
					<br>
					<br>
					</div>
					<div class="exp">商品价格+邮费&gt;任务商品担保价格时，请勾选！改价不要超过商品价格的50%，支付宝使用率低于50%既被淘宝视为信用炒作处理。</div>
				</li>
				<li>
					<div class="name">是否商保任务：</div>
					<div class="value">
					<input id="cbxIsSB" style="margin-left:-2px;+margin-left:-5px;" value="1" name="isEnsure" type="checkbox"><input name="ensurePoint" value="0.3" type="hidden">
					<br>
					<br>
					</div>
					<div class="exp">
					要求接手方缴纳保证金后成为平台的商保用户才可以接手，需额外支付<em>0.3</em>个麦点给接手方，——
					<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/menber/ensure/">我要立即加入商保</a>
					</div>
				</li>
				
				<li>
					<div class="name">基本麦点：</div>
					<div class="value">
					<input id="txtMinMPrice" class="txt" value="0" style="width:130px;color:#f50;background:#F0F0F0;" name="txtMinMPrice" readonly="readonly" type="text">
					  个麦点
					</div>
					<div class="exp">
					发布该价格任务需要扣除的麦点，不包括增值服务.   
					<a target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t122/">查看商品的价格与最底消耗额的关系</a>
					<br>
					您目前还有麦点
					<em>';echo $memberFields['fabudian'];echo '</em>
					个，
					<a target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/BuyPoint/">我要购买</a>
					</div>
				</li>
				<li><div class="name">追加悬赏麦点：</div>
					<div class="value">
					<input id="pointExt" class="txt" style="width:130px;color:#f50;" name="pointExt" type="text">
					  个麦点
					</div>
					<div class="exp">
					追加悬赏麦点数越多，更易被人接手，刷钻效率越高！  
					</div>
				</li>
				<li>
					<div class="name">
					<span style="color:Red;">*</span>
					要求确认时间：
					</div>
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
					<p id="pOKDes">
					</p>
					<p style="padding-top:3px;"><input id="isNoword" value="1" name="isNoword" type="checkbox"> <span style="color:#999">不带字好评</span></p>
					</div>
					<div class="exp">
					24小时以上属于实物任务！平台强制接手方延迟收货！
					<br>
					马上好评则必须立刻发货，属于虚拟商品任务，如果强制要求对方延期，是会被投诉的。
					</div>
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
                            <td style="padding-left:0px;_padding-left:0px;margin:0px;" valign="top"><input id="cbxIsTip" name="cbxIsTip" value="1" type="checkbox"></td>
                            <td style="padding-left:15px;" valign="top"><div id="divTip" style="display:none;margin-bottom:10px;">
                                <div style="margin-bottom:2px;"> 请拍商品
                                <input name="txtBuyCount" maxlength="3" id="txtBuyCount" class="txt" style="width:50px;" type="text">
                                件
                                <input id="cbIsHiddenName" name="cbIsHiddenName" value="1" type="checkbox">
                                请匿名购买
                                <input id="cbIsNoneAssess" name="cbIsNoneAssess" value="1" type="checkbox">
                                请只收货等待默认好评 </div>
                                <div style="margin-bottom:2px;"> 区服请填
                                <input name="txtAreaService" maxlength="21" id="txtAreaService" class="txt" style="width:150px;" type="text">
                                &nbsp;&nbsp;
                                帐号请填
                                <input name="txtAccount" maxlength="21" id="txtAccount" class="txt" style="width:150px;" type="text">
                              </div>
                                <div style="margin-bottom:2px;"> 手机请填
                                <input name="txtMobile" maxlength="21" id="txtMobile" class="txt" style="width:150px;" type="text">
                                &nbsp;&nbsp;
                                选择规格
                                <input name="txtSpecs" maxlength="51" id="txtSpecs" class="txt" style="width:150px;" type="text">
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
                            <td style="padding-left:0px;_padding-left:0px;margin:0px;" valign="top"><input id="cbxIsAddress" name="isAddress" value="1" type="checkbox" ';if($datas['isAddress']){echo ' checked="checked"';}echo '></td>
                            <td style="padding-left:15px;" valign="top"><div id="cbxTip" style="display:none;margin-bottom:10px;">
                                <div style="margin-bottom:2px;"> </div>
                                <div style="margin-bottom:2px;"> 姓名：
                                <input name="cbxName" maxlength="8" id="cbxName" class="txt" style="width:150px;" type="text">
                                &nbsp;&nbsp;
                                手机：
                                <input name="cbxMobile" maxlength="11" id="cbxMobile" class="txt" style="width:150px;" type="text">
                              </div>
                                <div style="margin-bottom:5px;"> 邮编：
                                <input name="cbxcode" maxlength="6" id="cbxcode" class="txt" style="width:150px;" type="text">
                              </div>
                                <div style="margin-bottom:2px;"> 地址：
                                <textarea name="cbxAddress" id="cbxAddress" style="margin-left:0px;" onclick="if(this.value.indexOf(\'此处填写您要求接手人\')>=0) this.value=\'\';this.style.color=\'#333\';" title="此处填写您要求接手人的修改的收货地址，包含具体省、市、区及详细地址。">此处填写您要求接手人的修改的收货地址，包含具体省、市、区及详细地址，请不要填写“请带字好评”等引导的文字。</textarea>
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
                          <input value="1"';if($datas['isFame']){echo ' checked="checked"';}echo ' id="cbxIsFMaxCredit" name="isFame" type="checkbox">
                          </label>
                      <label class="labelstyle" style="width:160px;margin-left:10px;">接手买号信誉不高于</label>
                      <label class="labelstyle" style="width:50px">
                          <input name="fameLvl" value="10"';if(!$datas||$datas['fameLvl']==10){echo ' checked=\'checked\'';}echo ' type="radio">
                          10</label>
                      <label class="labelstyle" style="width:50px">
                          <input name="fameLvl" value="150"';if(!$datas||$datas['fameLvl']==150){echo ' checked=\'checked\'';}echo ' type="radio">
                          150</label>
                      <label class="labelstyle" style="width:50px">
                          <input name="fameLvl" value="200"';if(!$datas||$datas['fameLvl']==200){echo ' checked=\'checked\'';}echo ' type="radio">
                          200</label>
                    </div>
                        <div>
                      <label>
                          <input value="1"';if($datas['cbxIsFMaxBTSCount']){echo ' checked="checked"';}echo ' id="cbxIsFMaxBTSCount" name="FMaxBTSCount" type="checkbox">
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
                      <input name="limit" value="2"';if(!$datas||$datas['limit']==2){echo ' checked="checked"';}echo ' id="limit_2" price="0.2" id="fmaxmc_2" type="radio">
                      1天接2个(<em>0.2</em>个麦点)
                      <input name="limit" value="3"';if(!$datas||$datas['limit']==3){echo ' checked="checked"';}echo ' id="limit_3" id="fmaxmc_3" type="radio">
                      1周接1个(<em>1</em>个麦点)</div>
                      </div>
                  <div class="exp">您可以设置接手人在1天或一周内接手您发布任务的次数，需额外支付麦点</div>
                </div>
                  </li>
              <li>
                    <div class="name">买号实名认证：</div>
                    <div class="value longest">
                  <div id="divBaLevel" style="margin-bottom:5px;">
                        <input id="isReal" value="1" name="isReal" type="checkbox">
                        <input name="realname" value="1" id="isReal_1" type="radio">
                        <label for="isReal_1"> 普通实名(<em>0.5</em>个麦点) </label>
                      </div>
                  <div class="exp">限制接手买号必须是通过了支付宝实名认证才可以接手此任务</div>
                </div>
                  </li>
              <li>
                    <div class="name">淘金币：</div>
                    <div class="value longest">
                  <input id="cbxIsTaoG" value="1" name="cbxIsTaoG" type="checkbox">
                  <input name="txtTaoG" maxlength="3" id="txtTaoG" class="txt" style="width:40px;" type="text">
                  必须为10的倍数，最大不超过300，每10个淘金币需支付<em>0.1</em>个麦点给接手方 </div>
                    <div class="exp"></div>
                  </li>
              <li>
                    <div class="name">快递单号任务：</div>
                    <div class="value longest">
                  <input name="isawb" id="isawb" value="1" type="checkbox">
                  <label>
                      <input id="expressfull" name="expressfull" value="shunfeng" type="radio">
                      顺风(<em>5</em>麦点)</label>
　　 　 
不了解的用户请勿选择；                   <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t3917/" target="_blank">了解详情</a> </div>
                    <div class="exp"></div>
                  </li>
              <li>
                    <div class="name">真实签收任务：</div>
                    <div class="value longest">
                  <input name="isSign" id="isSign" value="1" type="checkbox">
                  <label>
                      <input id="Express_1" name="Express" value="1" type="radio">
                      全国(<em>1.5</em>个麦点)</label>
　　
                  <label>
                      <input id="Express_2" name="Express" value="2" cid="0" type="radio">
                      同省[](<em>2</em>个麦点)</label>
                  不了解的用户请勿选择；<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1685/" target="_blank">了解详情</a> </div>
                    <div class="exp"></div>
                  </li>
              <li>
                    <div class="name">指定接手地区：</div>
                    <div class="value longest">
                  <div style="margin-bottom:10px;">
                        <input id="isLimitCity" title="勾上才启用 Tips:如果你只想指定某个省份接手，只需要选择省份即可，不需要选择市；也可以具体指定到某个省某个市接手" value="1" name="isLimitCity" type="checkbox">
                        <script type="text/javascript" src="/images/city2.js"></script>
                        <input name="isMultiple" onclick="ChangeMultiple()" id="isMultiple" value="1" type="checkbox">
                        多选省份 </div>
                  <div style="color:#999;">例如你指定北京和上海用户才可以接手，这样可避免重复用户交易，需额外支付<font color="red">0.5</font>个发布点</div>
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
                  实现快捷方便的发布任务,普通用户最多可保存3个任务发布模板，VIP可拥有30个任务发布模板 <a target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/vip.html">查看VIP特权</a> </div>
                    <div class="exp"></div>
                  </li>
            </ul>
              </div>
        </li>
				</ul>
				<p class="taskbutton">
		<input style="cursor: pointer;" id="btnCilentAdd" class="taskadd" value="" type="button"></p>
		 <input style="display:none" id="btnAdd" type="submit"></div>
		 <input type="hidden" name="qq" id="qq" value="';echo $members['qq'];echo '" />
		</form>
		 </div>
<script type="text/javascript">
function getTpl(obj) {';echo '
    if (obj.value == \'0\')
        return ;
    var url = \'/task/tao/?m=CreateMealMission&tplId=\' + obj.value;
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
    </div>';?>