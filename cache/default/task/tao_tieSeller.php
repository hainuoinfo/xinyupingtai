<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\task\tao_tieSeller.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\header2_base.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\service.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\task\tao_info.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\quick.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\task\tab.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\task\tao_tieSeller.htm','D:\damaihu\xinyupingtai7\cache\default\task\tao_tieSeller.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/task/';$cssList=array(0=>'http://damaihu.tertw.net/css/task/task.css');echo '
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
<script type="text/javascript" src="http://damaihu.tertw.net/javascript/jquery.min.js"></script><script type="text/javascript" src="http://damaihu.tertw.net/javascript/common.func.js"></script>

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
<style type="text/css">
.kd a:hover {';echo ' text-decoration:underline;';echo '}
.link_tt {';echo ' display:block; width:52px; height:22px;color:#a68d8b; background:url(/images/sellers_btn.png) no-repeat; margin-bottom:2px;';echo '}
</style>
<style type="text/css">
.bq_menu{';echo '
	height:32px;
	background:url(/images/fy_ico.jpg) 0 -1342px repeat;
	';echo '}
.bq_menu a{';echo '
	float:left;
	margin-right:3px;
	background:url(/images/fy_ico.jpg)  -4px -806px no-repeat;
	display:block;
	font-size:14px;
	text-align:center;
	width:96px;
	height:32px;
	line-height:30px;
	';echo '}
.bq_menu a:hover,.bq_menu a.nov{';echo '
	background:url(/images/fy_ico.jpg)  -4px -758px no-repeat;
	font-weight:bold;
	';echo '}
.mh_bdbtn2 {';echo 'margin-left:218px;';echo '}
.tx_jl{';echo '
	background:url(/images/tx_btn.gif) 0 -187px no-repeat;
	height:30px;
	line-height:30px;
	font-size:14px;
	font-weight:bold;
	text-indent:25px;
	';echo '}
.txjl_bg1{';echo 'background:url(/images/tx_btn.gif) 0 -225px no-repeat;';echo '}
.txjl_bg2{';echo '
	background:url(/images/tx_btn.gif) 0 -264px repeat-x;
	color:#1996e6;
	font-size:14px;
	font-weight:bold;
	';echo '}
.txjl_bg3{';echo 'background:url(/images/tx_btn.gif) right -303px no-repeat';echo '}
</style>
<div id="content">
  <div class="taobaopage_detail">
<style type="text/css">
.gold .yred {';echo ' color:#D61810;';echo '}
</style>

';echo '<ul class="rwdt_info">
      <li>
        <p class="fd">账户余额：<strong class="chengse">';echo $memberFields['money'];echo '</strong> 元</p>
      <a title="将存款提取到我的网银或支付宝上" target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/payment/" class="rwdt_tx"></a></li>
      <div class="cle"></div>
      <li><p class="fd">麦点：<strong class="chengse">';echo $memberFields['fabudian'];echo '</strong> 个</p><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/exchange/" title="将保证金兑换成能发布任务的麦点" target="_blank" class="rwdt_hs"></a></li>
      <div class="cle"></div>
      <li><p>积分：<strong class="chengse">';echo $memberFields['credits'];echo '</strong> 个</p></li>
      <li><p class="fd">属于：';if($memberFields['shuake']==1){echo '职业刷客';}elseif($memberFields['vip']==1||$memberFields['vip']==2||$memberFields['vip']==3){echo '';echo $vip;echo '';}else{echo '';echo $credits;echo '';}echo '</p><span class=""></span></li>
      <div class="cle"></div>
      <li>好评率：<strong class="lvse">
买家
';$snum=$memberFields['sgrade1']+$memberFields['sgrade2']+$memberFields['sgrade3'];$shpl=$memberFields['sgrade1']/$snum*10000;$shpl=ceil($shpl)/100;if($shpl==0)echo '100';else echo $shpl;echo '%

卖家
';$bnum=$memberFields['bgrade1']+$memberFields['bgrade2']+$memberFields['bgrade3'];$bhpl=$memberFields['bgrade1']/$bnum*10000;$bhpl=ceil($bhpl)/100;if($bhpl==0)echo '100';else 
		echo $bhpl;echo '%

	      </strong></li>
      <li>有效投诉：<strong class="chengse">0</strong></li>
</ul>';echo '
		';echo '<style>
.task_header em{';echo 'color: red;font-weight: bold;';echo '}
</style>
<div class="rwdt_bk">
			<p class="sub_bt"><a id="liInput1" class="nov" href="javascript:;">支付宝充值</a><a href="javascript:;" id="liInput2">网银充值</a><a href="javascript:;" id="liInput3">购买麦点</a><a href="javascript:;" id="liInput4">人工转账</a></p>
			 <div id="buyboxcont">
				<div class="task_header" style="display:block;">
				  
						<table style="margin-top:10px;" align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
							<tbody><tr><td>收款支付宝账号：<a href="javascript:;" onclick="return copy(\'xiaomaimaila@163.com\')"><em>xiaomaimaila@163.com</em></a> (<span style="color:#FF9000;" onclick="return copy(\'胡可恬\')">胡可恬</span>) </td></tr>
							<tr><td>转账时只能备注：<span style="color:#FF9000;font-weight:700">';echo $memberLogined?$member['username']:'';echo '</span></td></tr>
							<tr><td>(转账完毕后验证交易号，1分钟到账)</td></tr>
							<tr>
                        	   <td colspan="2"><a class="tc_b" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1850/" target="_blank">查看充值教程</a><a class="tc_k" target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/?type=alipay">验证交易号</a></td>
                            </tr>
						</tbody></table>
				   
		       </div>
		       <div class="task_header" style="display:none">
					<form id="q_f_2" action="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/" method="post" target="_blank" onsubmit="return checkForm1();">
                        ';echo $sys_hash_code2;echo '
                        <table style="margin-top:10px;" align="left" border="0" cellpadding="0" cellspacing="0" width="90%">
					  <tbody><tr>
						<td height="30" align="right" valign="top" width="35%">充值用户名：</td>
						<td><input name="username" id="username" class="rwdt_inp" style="color:#666" value="';echo $member['username'];echo '" disabled="disabled" type="text"></td>
					  </tr>
					  <tr>
						<td height="30" align="right" valign="top">充值金额：</td>
						<td><input name="money" id="money" class="rwdt_inp" style="color:#666" value="100" type="text" onfocus="window.location.href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/\'">
						<span class="chengse">(1%手续费)</span></td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td><input class="rwdt_cz" type="submit" name="imageField"></td>
					  </tr>
				  </tbody></table>
				  </form>
		       </div>
			    <div class="task_header" style="display:none">
							<form id="q_f_3" action="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/BuyPoint/" method="post" onsubmit="return checkForm3();">
                                ';echo $sys_hash_code2;echo '
                                <input name="cardType" value="1" type="hidden">
							<input name="jiage" id="jiage" value="" type="hidden">
									<table style="margin-top:10px;" align="left" border="0" cellpadding="0" cellspacing="0" width="90%">
									<tbody><tr>
											<td height="30" align="right" valign="middle" width="35%">购买价格：</td>
											<td><span style="color:#D9281E; font-weight:bold;"><span id="jiage1">0.68</span>元=1个麦点</span></td>
										</tr>
									<tr>
											<td height="30" align="right" valign="middle" width="35%">购买数量：</td>
											<td><input name="nums" id="cardnums" value="1" size="10" maxlength="4" type="text" onfocus="window.location.href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/BuyPoint/\'">(最少购买1个)</td>
										</tr>
									<tr>
										<td>&nbsp;</td>
										<td><input class="rwdt_cz" type="submit" name="imageField"></td>
									</tr>
								</tbody></table>
							</form>
		       </div>
			    <div class="task_header" style="display:none">
					<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                      	<tbody>
						<tr>
                        	<td colspan="2" style="padding:5px 10px 5px 10px;">财付通直接转帐冲值，不收任何手续费用。仅接受大于100元以上的充值。充值前请联系客服，然后再打款，平台指定人工充财付通帐号：<em>273334116</em></td>
                        </tr>
                        <tr>
                        	<td style="width:50%;padding-left:20px;"><a class="rwdt_kf" href="tencent://message/?uin=188239039" target="_blank">联系客服</a></td>
                            <td><a class="rwdt_cht" target="_blank" href="https://www.tenpay.com/v2/account/pay/index.shtml?ADTAG=TENPAY_V2.FUKUAN.JIESHAO.C2C">登录财付通</a></td>
                        </tr>
                      </tbody>
					</table>
		       </div>
		  </div>
		</div>';echo '
		<div class="rwdt_bk2">
			<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/safesz/" class="szsz_btn" target="_blank"></a>
			<p class="ts">接实物任务后立即收货好评将 <span class="chengse">- 20 </span>麦点</p>
			<p class="ts">任务过程中旺旺聊到刷信誉平台相关字眼 <span class="chengse">- 5 </span>麦点</p>
			<p class="ts">为了您资金安全，接手方淘宝支付后务必在<span class="lanse">15</span>分钟内回到平台操作任务点击“已付款” </p>
		</div>
		<div class="rwdt_gg"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/userjob/" target="_blank"><img src="/images/jrw.gif"></a></div>
		<div class="rwdt_gg2"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1538/" target="_blank"><img src="/images/frw.gif"></a></div>

<script type="text/javascript">
					$(function() {';echo '
						bechange(\'.sub_bt a\',\'#buyboxcont>.task_header\');
						$("table > tr:odd").addClass("tcolor");
					';echo '});
					</script>
		';echo '<div class="rwdt_menu">
  <a href="';echo $baseUrl;echo '"';if($m=='index'){echo ' class="nov" ';}echo ' title="淘宝任务大厅">淘宝任务大厅</a>
  <a href="';echo $baseUrl;echo '?m=taskIn" ';if($m=='taskIn'){echo ' class="nov" ';}echo ' title="已接任务">已接任务</a>
  <a href="';echo $baseUrl;echo '?m=taskOut" ';if($m=='taskOut'){echo ' class="nov" ';}echo ' title="已发任务">已发任务</a>
  <a href="';echo $baseUrl;echo '?m=tieBuyer" ';if($m=='tieBuyer'){echo ' class="nov" ';}echo ' title="绑定买号">绑定买号</a>
  <a href="';echo $baseUrl;echo '?m=tieSeller" ';if($m=='tieSeller'){echo ' class="nov" ';}echo ' title="绑定掌柜">绑定掌柜</a>
</div>





';echo '
	<div class="cle"></div>
	<div class="lst_info" style="background:none;"></div>
	';if($_showmessage){echo '<div class=\'error_panel\'><div>';echo $_showmessage;echo '</div></div>';}echo '
	';if($indexMessage){echo '<div class=\'error_panel\'><div>';echo $indexMessage;echo '</div></div>';}echo '
	<div class="mh_tishi">
				1、最多绑定30个掌柜号，每次添加需要收取5元手续费，首次绑定免费，<span class="chengse">VIP用户免费；掌柜号是您开店的淘宝登录帐号，不是店铺名，需要区分大小写，请一定注意！</span><br>
2、如果您的帐号还没有发布过任务，可以联系客服QQ给予免费修改一次；发布过任务的帐号不提供修改！ 
<br>

			</div>
			<div class="bq_menu">
				<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/tao/?m=tieSeller" ';if($action=='task'&&$operation=='tao'){echo ' class="nov" ';}echo '>绑定淘宝掌柜</a>
				<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/pai/?m=tieSeller"  ';if($action=='task'&&$operation=='pai'){echo ' class="nov" ';}echo ' >绑定拍拍掌柜</a>
			</div>
			<form name="myForm" method="post" id="myForm" onSubmit="return checkForm();">
			<div>';echo $sys_hash_code2;echo '</div>
			<table style="margin-top:20px;font-size:14px;" class="zg_tb" align="center" border="0" cellpadding="0" cellspacing="0" width="95%">
              <tbody><tr>
                <td align="left" height="30" valign="middle" width="20%"><span class="mh_taobao"></span></td>
              </tr>
			  
	
              <tr>
                <td align="left" height="40" valign="middle" width="20%"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tbody><tr>
                    <td width="22%">淘宝掌柜名（旺旺名）：</td>
                    <td width="78%" align="left"><input name="nickName" id="nickName" class="mh_bk" type="text" style="width:280px;"></td>
                  </tr>
                </tbody></table></td>
              </tr>
			 
              <tr>
                <td align="left" height="60" valign="middle"> <input class="mh_bdbtn2" type="submit" name="btnSave"></td>
              </tr>
			  
              <tr>
                <td class="mh_xian" align="left" height="40" valign="middle" width="20%">您目前是';echo $user_group['name'];echo '用户，可以绑定';echo $maxTieCount;echo '个掌柜！ <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/vip/" class="chengse2">申请VIP</a>最高可绑定30个掌柜！ <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/vipinfo/" target="_blank" class="lanse">查看VIP限权</a></td>
              </tr>
            </tbody></table> </form>
	        <table align="center" border="0" cellpadding="0" cellspacing="0" width="95%">
              <tbody><tr>
                <td height="25">&nbsp;</td>
              </tr>
              <tr>
                <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tbody><tr>
                    <td class="txjl_bg1" height="37" width="10"></td>
                    <td class="txjl_bg2" style="color:#333;" align="center" height="37" valign="middle" width="25%">淘宝掌柜帐号</td>
					<td class="txjl_bg2" style="color:#333;" align="center" height="37" valign="middle" width="10%">总发布任务</td>
                    <td class="txjl_bg2" style="color:#333;" align="center" height="37" valign="middle" width="30%">绑定时间</td>
                    <td class="txjl_bg2" style="color:#333;" align="center" height="37" valign="middle" width="15%">是否激活</td>
                    <td class="txjl_bg2" style="color:#333;" align="center" height="37" valign="middle" width="20%">&nbsp;</td>
                    <td class="txjl_bg3" height="37" width="10"></td>
                  </tr>
				  ';if($sList){foreach($sList as $v){echo '
                  <tr>
                    <td>&nbsp;</td>
                    <td class="mh_xxian" align="center" height="35" valign="middle">
					<table style="margin:0 0 0 45px;" border="0" cellpadding="0" cellspacing="0" width="70%">
                      <tbody><tr>
                        <td align="center" valign="middle" width="25"><span class="zg_tbico"></span></td>
                        <td align="left" valign="middle">';echo $v['nickname'];echo '</td>
                      </tr>
                      <tr>
                        <td colspan="2" class="chengse2" align="left" valign="middle">
                        ';if($v['status']){echo '
						<span class="hongse"> 已激活</span>
                         ';}else{echo ' 激活掌柜 ';}echo '
						</td>
                      </tr>
                    </tbody></table></td>
					<td class="mh_xxian" align="center" valign="middle">0</td>
                    <td class="mh_xxian" align="center" valign="middle">';echo date('Y-m-d H:i:s',$v['timestamp1']);echo '</td>
                    <td class="mh_xxian" align="center" valign="middle">
		<input checked="checked" onClick="return noactive(';echo $v['id'];echo ');" type="checkbox">
		</td>
                    <td class="mh_xxian" align="center" valign="middle"><a href="javascript:;" onClick="dialog(650,500,\'设置掌柜发货地址\',\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/dialog/sellerAddress/?id=';echo $v['id'];echo '\');return false;" class="link_tt">&nbsp;</a><a href="javascript:;" onClick="return IsDelAcc(this,';echo $v['id'];echo ');" class="mh_cz"></a></td>
                    <td>&nbsp;</td>
                  </tr>
                  ';}}echo '
				  
                </tbody></table></td>
              </tr>
            </tbody></table>
	        <p>&nbsp;</p>
	        <p>&nbsp;</p>
            <div class="rwdt_dlm">
			  <div id="page">

			  </div>
			</div>
			<div class="cle"></div>
			<!--结束-->
			
					
	</div><!--taopage_detail end-->
</div>

<link type="text/css" rel="stylesheet" href="/images/jcalendar.css">
<script type="text/javascript" src="/images/artDialog.js"></script>
<script type="text/javascript" src="/images/Common.js"></script>
<script type="text/javascript">
function IsDelAcc(obj, id) {';echo '
  if (confirm("如果掌柜有发布过任务，需要扣除5元，未发布任务可以免费删除，您确定要删除此掌柜么？")) {';echo '
    location.href=\'/task/tao/?m=tieSeller&del=\' + id;
    return true;
  ';echo '} else {';echo '
    return false;
  ';echo '}
';echo '}
function checkForm() {';echo '
  var nickname=$(\'#nickName\').val();
  if (nickname.length>1)
		{';echo '
		return true;
		';echo '}
		else {';echo '
	    alert(\'淘宝掌柜帐号不能为空\');
		$(\'#nickName\').focus();
		return false;
	';echo '}
';echo '}
function noactive(id)
{';echo '
	if (confirm(\'您确定要取消激活此帐号么？\')) {';echo '
    location.href=\'/task/tao/?m=tieSeller&noactive=\'+id;
    return true;
  ';echo '} else {';echo '
    return false;
  ';echo '}
';echo '}
function isactive(id)
{';echo '
	if (confirm(\'您确定要激活此帐号么？\')) {';echo '
    location.href=\'/task/tao/?m=tieSeller&isactive=\'+id;
    return true;
  ';echo '} else {';echo '
    return false;
  ';echo '}
';echo '}
</script>

<div class="cle"></div>
<script type="text/javascript">
var webnoticeurl = "";
var webnoticetit = "";
var quick_qq = \'<a target="_blank" href="http://wp.qq.com/wpa/qunwpa?idkey=0fa4d251b350d03b020586387709ac11b8f101a2b60eaf80b4d6a93cb9fbe8fc"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="大麦户网商平台30群" title="大麦户网商平台30群"></a>\';
$(\'.web_qq\').hover(function(){';echo '
    $(\'.quick_qq\').show();
';echo '});
</script>

<div id="" class="ui_dialog_wrap"><div style="" class="ui_dialog"><table class=""><tbody><tr><td class="ui_border r0d0"></td><td class="ui_border r0d1"></td><td class="ui_border r0d2"></td></tr><tr><td class="ui_border r1d0"></td><td><table class="ui_dialog_main"><tbody><tr><td class="ui_title_wrap"><div class="ui_title"><div class="ui_title_text"></div><a href="javascript:void(0)" class="ui_close">×</a></div></td></tr><tr><td style="width: auto; height: auto;" class="ui_content_wrap"><div id="" class="ui_content "></div></td></tr><tr><td class="ui_bottom_wrap"><div class="ui_bottom"><div class="ui_btns"></div><div class="ui_resize"></div></div></td></tr></tbody></table></td><td class="ui_border r1d2"></td></tr><tr><td class="ui_border r2d0"></td><td class="ui_border r2d1"></td><td class="ui_border r2d2"></td></tr></tbody></table></div></div>
';echo '<div id="footer">
		<p><span class="chengse">官方QQ号码：1371752337</span> （加群请注明大麦户）</p>
		<p class="lanse"><a href="#">关于我们</a>|<a href="#">联系我们</a>|<a href="#">大麦户规则</a>|<a href="#">网站地图</a>|<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '" target="_blank">淘宝信誉查询</a> </p>
		<p style="text-align:center;">
	
		<p class="lanse">客户服务热线：02968929109   Copyright © 2012-2020 Damaihu.com All RightsReserved    大麦户版权所有 <a href="#" target="_blank">粤ICP备13037934号</a><span style="display:none">
</span></p>
	</div>
	</div>
    </div>';?>