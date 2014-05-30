<?php $_tplModify=filemtime('F:\github\xinyupingtai\cache\default\member\reg.php');if(filemtime('F:\github\xinyupingtai\templates\default\regheader.htm')>$_tplModify||filemtime('F:\github\xinyupingtai\templates\default\service.htm')>$_tplModify||filemtime('F:\github\xinyupingtai\templates\default\footer.htm')>$_tplModify){include(template::load_base('F:\github\xinyupingtai\templates\default\member\reg.htm','F:\github\xinyupingtai\cache\default\member\reg.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/member/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>';echo $title;echo '</title>
<meta name="description" content="';echo $description;echo '" />
<meta name="keywords" content="';echo $keywords;echo '" />
<script type="text/javascript" src="/images/jquery.js"></script>
<script type="text/javascript" src="/images/login_damaihu.js"></script>
<script type="text/javascript" src="/images/reg.js"></script>
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
	<div id="r_top">
	  <div class="kd">
			<p class="tb"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '" class="logo"></a><span>个人用户注册</span></p>
		
	  </div>
	</div>`
<!--头部结束-->

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
			<td><p><a target=\'_blank\' href=\'http://wpa.qq.com/msgrd?v=3&uin=1074794363&site=qq&menu=yes\'><img border=\'0\' src=\'http://wpa.qq.com/pa?p=1:1074794363:17\' alt=\'财务1号\' title=\'财务1号\' /></a><strong>财务1号</strong><br />QQ：1074794363</p>
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

<!--[if lte IE 6]>
<script type="text/javascript" src="/javascript/cn/DD_belatedPNG_0.0.7a.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix(\'*\');
</script>
<![endif]-->

</body>';echo '
<div id="content">
<div>
	<form name="myForm" method="post" id="myForm" enctype="multipart/form-data">
	';echo $sys_hash_code2;echo '
	<ul id="reg_list">
	';if($indexMessage){echo '<div class=\'error_panel\'><div>';echo $indexMessage;echo '</div></div>';}echo '
		<li class="tit2"><span class="chengse">30秒</span>，加入全国最大的互动平台！</li>
		<li>
			<p class="tit3" id="zh">账号</p>
			<p><input name="username" class="r_bk" id="username" onblur="check_username(this)" maxlength="14" type="text"   value="';echo $datas['username'];echo '"></p>
			<p id="username_tip" class="zq"></p>
		</li>
		<li>
			<p class="tit3" id="pd">密码</p>
			<p><input class="r_bk" id="password" name="password" onblur="check_password()" maxlength="20" type="password" /></p>
			<div class="zq" id="password_tip"></div>
		</li>
		<li>
			<p class="tit3" id="pdt">密码确认</p>
			<p><input class="r_bk" id="password_" name="password_" onblur="check_password_()" maxlength="20" type="password"  />
			</p><div class="zq" id="passwordt_tip"></div>
		</li>
		<li>
			<p class="tit3" id="pd2">操作码</p>
			<p><input class="r_bk" id="password2" name="password2" onblur="check_password2()" maxlength="20" type="password" /></p>
			<div class="zq" id="password2_tip"></div>
		</li>
		<li>
			<p class="tit3" id="pd2">确认操作码</p>
			<p><input class="r_bk" id="password2_" name="password2_" onblur="check_password2_()" maxlength="20" type="password"  />
			</p><div class="zq" id="password21_tip"></div>
		</li>
		<li>
			<p class="tit3" id="telt">手机号码</p>
			<p><input class="r_bk" id="mobilephone" name="mobilephone" onblur="check_mobil()" maxlength="11" type="text"></p>
			<div class="zq" id="tel_tip"></div>
		</li>
		<li>
			<p class="tit3" id="telt">真实姓名</p>
			<p><input class="r_bk" id="truename" name="truename" onblur="check_truename()" maxlength="11" type="text"></p>
			<div class="zq" id="truename_tip"></div>
		</li>
		<li>
			<p class="tit3" id="qqt">QQ</p>
			<p><input class="r_bk" id="qq" name="qq" onblur="check_qq()" maxlength="13" type="text"  value="';echo $datas['qq'];echo '"></p>
			<div class="zq" id="qq_tip"></div>
		</li>
		<li>
			<p class="tit3" id="em">E-MAIL</p>
			<p><input class="r_bk" id="email" name="email" onblur="check_email()" maxlength="30" type="text" value="';echo $datas['email'];echo '"></p>
			<div class="zq" id="em_tip"></div>
		</li>
		<li>
			<p class="tit3" id="xb">性别</p>
			<p><input name="sex" value="1" checked="checked" type="radio" id="sexBoy"';if((isset($datas)&&$datas['sex']==1)||!isset($datas)){echo ' checked="checked"';}echo '> 男
             <input name="sex" value="2" type="radio" id="sexGirl"';if($datas['sex']==2){echo ' checked';}echo '> 女</p>
		</li>
		<li>
			<p class="tit3" id="tj">推荐人</p>
			<p><input name="parent" id="parent" class="r_bk" onblur="check_parent()" maxlength="14" style="color:#999;" value="没有可不填写" onclick="if(this.value==\'没有可不填写\'){';echo 'this.value=\'\';';echo '}" type="text" emptyRunReg="false"></p>
			<div class="zq" id="tj_tip"></div>
		</li>
		
		<li>
        <INPUT id="btnSubmit" class="reg_btn" name="btnSubmit" value="提交查询内容" type="submit">
        </li>
		<li><a href="###" class="STYLE1" id="agreement">《大麦户服务协议》</a></li>
		
	</ul>
	</form>
	</div>
	<div>

	<ul id="reg_list" style="border:none;width:440px;padding-left:50px;">
		 <input name="referer" value="';echo $referer;echo '" type="hidden">
		<li class="tit2">已有账号？在此登录！</li>
		<li>
			<p class="tit3" id="loginaccount">账号</p>
			<p><input name="username" id="username" class="r_bk" onblur="check_loginuser(this)" maxlength="20" type="text" value="';echo isset($username)?$username:(isset($cookie['loginUsername'])?$cookie['loginUsername']:'');echo '"></p>
		</li>
		<li>
			<p class="tit3" id="loginpwd">密码</p>
			<p><input name="password" id="password" class="r_bk" onblur="check_loginpassword(this)" maxlength="20" type="password"></p>
		</li>
		';if($indexMessage){echo '<div style="color:#FF0000">';echo $indexMessage;echo '</div>';}echo '
		<li class="login_tip" style="height:35px; clear:both; position:inherit"></li>
		<li><input class="login_btn" style="margin-top:0px;" type="submit" id="btnSubmit" name="btnSubmit"></li>
		<li onclick="alert(\'该功能正在完善中，亲，近期上线\');">
			<span style="font-size: 14px;">合作账户登录：</span>
			<img alt="bt_blue_76X24.png" src="/images/qq.png" style="vertical-align: middle; margin-right: 10px;">
			<img alt="bt_blue_76X24.png" src="/images/sina.png" style="margin-right: 4px;vertical-align: middle;">
		</li>
	</ul>
		</div>
</div>
<div class="cle"></div>
';echo '﻿<div id="footer">
		<p><span class="chengse">官方QQ号码：1371752337</span> （加群请注明大麦户）</p>
		<p class="lanse"><a href="#">关于我们</a>|<a href="#">联系我们</a>|<a href="#">大麦户规则</a>|<a href="#">网站地图</a>|<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '" target="_blank">淘宝信誉查询</a> </p>
		<p style="text-align:center;">
	
		<p class="lanse">客户服务热线：02968929109   Copyright © 2012-2020 Damaihu.com All RightsReserved    大麦户版权所有 <a href="#" target="_blank">粤ICP备13037934号</a><span style="display:none">
</span></p>
	</div>
	</div>
    </div>';?>