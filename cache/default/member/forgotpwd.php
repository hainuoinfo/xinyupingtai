<?php $_tplModify=filemtime('D:\xinyupingtai\cache\default\member\forgotpwd.php');if(filemtime('D:\xinyupingtai\templates\default\header.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\xinyupingtai\templates\default\member\forgotpwd.htm','D:\xinyupingtai\cache\default\member\forgotpwd.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/member/';$title='找回密码 - 互动吧平台';$keywords='';$description='';$cssList=array(0=>'http://d.hainuo.info/css/member/reg.css');echo '
';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>';echo $title;echo '</title>
<meta name="description" content="';echo $description;echo '" />
<meta name="keywords" content="';echo $keywords;echo '" />
';if($cssList){echo '
';if($cssList){foreach($cssList as $v){echo '
<link rel="stylesheet" type="text/css" href="';echo $v;echo '" />
';}}echo '
';}else{echo '
<link href="http://d.hainuo.info/css/bbs/bbs.css" rel="stylesheet" type="text/css" />
';}echo '
<script type="text/javascript" src="http://d.hainuo.info/javascript/jquery.min.js"></script><script type="text/javascript" src="http://d.hainuo.info/javascript/common.func.js"></script>
';if($jsList){echo '
';if($jsList){foreach($jsList as $v){echo '
<script type="text/javascript" src="';echo $v;echo '"></script>
';}}echo '
';}echo '
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
<link href="/css/httshouye.css" rel="stylesheet" type="text/css" />
';if($memberLogined){echo '
<link href="/css/denglu.css" rel="stylesheet" type="text/css" />
';}echo '
<script src="/Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>

<body>
<div id="top">
';if($memberLogined){echo '
<div class="top-mid">
    	<form action="" method="get">你好，<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info/?username=';echo $member['username'];echo '"><em>';echo $member['username'];echo '</em></a><img title="积分：';echo $memberFields['credits'];echo '" alt="积分" src="';echo $memberLevel['icon'];echo '"><input type="button" onclick="window.location.href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/logout/\'" class="tc" value="退出" /></form>
        <ul style="width:560px;">
            <li class="ck"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/">存款：<span>';echo $memberFields['money'];echo '</span></a>　/
           		 <ul>
                	<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/topup/">账号充值</a></li>
                    <li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/PayDetails/?type=1">存款明细</a></li>
                </ul>                        
            </li>
            
            
            <li class="tl"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/BuyPoint/">兔粮：';echo $memberFields['fabudian'];echo '</a>　/
           		 <ul>
                	<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/BuyPoint/">购买兔粮</a></li>
                    <li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/PayDetails/?type=2">兔粮明细</a></li>
                </ul>            
            </li>
            
            
            <li class="xx"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/">信息：<span>(';echo $memberFields['msg'];echo ')</span></a>　/
           		 <ul>
                	<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=inUser">私人收件箱</a></li>
                    <li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=inSys">官方收件箱</a></li>
                    <li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=setting">站内信提醒</a></li>
                </ul>                       
            </li>
            
            
             <li class="wsfbf"><a href="#">我是发布方</a>　/
           		 <ul>
                	<li><a href="#">图文教程</a></li>
                    <li><a href="#">视频教程</a></li>
                    <li><a href="#">排行榜</a></li>
                </ul>                       
            </li>
            
            
            
            <li class="wsjsf"><a href="#">我是接手方</a>　/
           		 <ul>
                	<li><a href="#">图文教程</a></li>
                    <li><a href="#">视频教程</a></li>
                    <li><a href="#">领取奖励</a></li>
                    <li><a href="#">排行榜</a></li>
                </ul>                       
            </li>
            
            
            
        	<li class="zhsz"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/userdata/?type=index">账号设置</a>　/
                <ul>
                	<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/forgotpwd/">找回密码</a></li>
                    <li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/userdata/?type=GetPass">找回操作码</a></li>
                    <li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/forgotpwd/">更多操作</a></li>
                </ul>            
            </li>
        	<!--<li class="wdtw"><a href="#">我的兔窝</a>　/
            	<ul>-->
                	<!--<li><a href="#"><img onmouseover="this.src=\'img/att223_03.png\'" onmouseout="this.src=\'img/att222_03.png\'" src="img/att222_03.png"/></a></li>
                    <li><a href="#"><img onmouseover="this.src=\'img/att223_05.png\'" onmouseout="this.src=\'img/att222_05.png\'" src="img/att222_05.png"/></a></li>
                    <li><a href="#"><img onmouseover="this.src=\'img/att223_09.png\'" onmouseout="this.src=\'img/att222_09.png\'" src="img/att222_09.png"/></a></li>
                    <li><a href="#"><img onmouseover="this.src=\'img/att223_10.png\'" onmouseout="this.src=\'img/att222_10.png\'" src="img/att222_10.png"/></a></li>-->
                    <!--<li><a href="#">我要充值</a></li>
                    <li><a href="#">我要提现</a></li>
                    <li><a href="#">购买兔粮</a></li>
                    <li><a href="#">网店托管</a></li>
                
                </ul>-->
          
            </li>
        	<li class="kfbb"><a href="#">客服帮助</a>
            	<div class="kfbz">
                	<!--<h2><span>值班时间：</span> 9:00-12:00 . 13:30-17:30 . 19:00-21:00</h2>
                    <hr/>
                  　<div class="xsbz">
                    	<span>新手帮助：</span> <img src="img/att333_08.png" /><a href="#">客服小云</a>　　　<img src="img/att333_16.png" /><a href="#">客服小云</a>
                    </div>        
                　　<h3><span>充值提现：</span> <img src="img/att333_16.png"/><a href="#">充值帮助</a></h3>
                	<hr/>
					<h4><span>店铺运营免费指导：</span> <img src="img/att333_08.png" /><a href="#">客服小云</a></h4>
    
                    <h5><span>交流群：</span><img src="img/att333_16.png"/><a href="#">5494848</a></h5><em>（注：客服不会要求操作任务、充值，谨防受骗）</em>-->
                    <div class="kf-tu">
                    <a href="#"><img onmouseover="this.src=\'img/atte2_06.png\'" onmouseout="this.src=\'img/atte_06.png\'" src="img/atte_06.png" class="kf-1" / ></a>
                    <a href="#"><img onmouseover="this.src=\'img/atte2_08.png\'" onmouseout="this.src=\'img/atte_06.png\'" src="img/atte_06.png" class="kf-2"  / ></a>
                    <a href="#"><img onmouseover="this.src=\'img/atte2_12.png\'" onmouseout="this.src=\'img/atte_12.png\'" src="img/atte_12.png" class="kf-3"  / ></a>
                    <a href="#"><img onmouseover="this.src=\'img/atte2_15.png\'" onmouseout="this.src=\'img/atte_15.png\'" src="img/atte_15.png"class="kf-4"  / ></a>
                    <a href="#"><img onmouseover="this.src=\'img/atte2_22.png\'" onmouseout="this.src=\'img/atte_22.png\'" src="img/atte_22.png"class="kf-5"  / ></a>
                  	</div>  
                </div>
        			
          </li>
  
        </ul>
  </div>
';}else{echo '	
<div class="top-mid">
    	<form action="" method="get">你好，欢迎来到花兔兔网商互动平台<input type="button" class="dl" value="登陆" /><input type="button" class="zc" value="注册" /></form>
        <ul>
        	<!--<li class="xsbz1"><a href="#">新手帮助</a>　/</li>-->
             <li class="wsfbf"><a href="#">我是发布方</a>　/
           		 <ul>
                	<li><a href="#">图文教程</a></li>
                    <li><a href="#">视频教程</a></li>
                    <li><a href="#">排行榜</a></li>
                </ul>                       
            </li>
            
            
            
            <li class="wsjsf"><a href="#">我是接手方</a>　/
           		 <ul>
                	<li><a href="#">图文教程</a></li>
                    <li><a href="#">视频教程</a></li>
                    <li><a href="#">领取奖励</a></li>
                    <li><a href="#">排行榜</a></li>
                </ul>                       
            </li>
            
            
            
        	<li class="zhsz"><a href="#">账号设置</a>　/
                <ul>
                	<li><a href="#">找回密码</a></li>
                    <li><a href="#">找回操作码</a></li>
                    <li><a href="#">更多操作</a></li>
                </ul>            
            </li>
        	<!--<li class="wdtw"><a href="#">我的兔窝</a>　/
            	<ul>
                	
                    <li><a href="#">我要充值</a></li>
                    <li><a href="#">我要提现</a></li>
                    <li><a href="#">购买兔粮</a></li>
                    <li><a href="#">网店托管</a></li>
                
                </ul>
          
            </li>-->
        	<li class="kfbb"><a href="#">客服帮助</a>
            	<div class="kfbz">
                	<!--<h2><span>值班时间：</span> 9:00-12:00 . 13:30-17:30 . 19:00-21:00</h2>
                    <hr/>
                  　<div class="xsbz">
                    	<span>新手帮助：</span> <img src="/img/att333_08.png" /><a href="#">客服小云</a>　　　<img src="/img/att333_16.png" /><a href="#">客服小云</a>
                    </div>        
                　　<h3><span>充值提现：</span> <img src="/img/att333_16.png"/><a href="#">充值帮助</a></h3>
                	<hr/>
					<h4><span>店铺运营免费指导：</span> <img src="/img/att333_08.png" /><a href="#">客服小云</a></h4>
    
                    <h5><span>交流群：</span><img src="/img/att333_16.png"/><a href="#">5494848</a></h5><em>（注：客服不会要求操作任务、充值，谨防受骗）</em>-->
                    <div class="kf-tu">
                    <a href="#"><img onmouseover="this.src=\'/img/atte2_06.png\'" onmouseout="this.src=\'/img/atte_06.png\'" src="/img/atte_06.png" class="kf-1" / ></a>
                    <a href="#"><img onmouseover="this.src=\'/img/atte2_08.png\'" onmouseout="this.src=\'/img/atte_06.png\'" src="/img/atte_06.png" class="kf-2"  / ></a>
                    <a href="#"><img onmouseover="this.src=\'/img/atte2_12.png\'" onmouseout="this.src=\'/img/atte_12.png\'" src="/img/atte_12.png" class="kf-3"  / ></a>
                    <a href="#"><img onmouseover="this.src=\'/img/atte2_15.png\'" onmouseout="this.src=\'/img/atte_15.png\'" src="/img/atte_15.png"class="kf-4"  / ></a>
                    <a href="#"><img onmouseover="this.src=\'/img/atte2_22.png\'" onmouseout="this.src=\'/img/atte_22.png\'" src="/img/atte_22.png"class="kf-5"  / ></a>
                  	</div>  
                </div>
        			
          </li>
  
        </ul>
  </div>
';}echo '
</div>




<div id="head">
	<div class="head-mid">
    	<img src="/img/att_06.png" class="logo"/>
        <img src="/img/att_09.png" class="dh"/>
    </div>
</div>


<div id="nav">
	<div class="nav-mid">
    	<ul>
        	<li class="sy"><a href="#">首页</a></li>
            <li><a href="#">淘宝大厅</a></li>
            <li><a href="#">拍拍大厅</a></li>
            <li><a href="#">收藏流量</a></li>
            <li><a href="#">购买麦点</a></li>
            <li><a href="#">网店托管</a></li>
            <li class="yy"><a href="#">运营指导<em>（免费）</em></a></li>
            <li><a href="#">有问必答</a></li>
            <li><a href="#">会员中心</a></li>
        </ul>
    </div>
</div>';echo '

';echo '

<link href="/css/selfservice.css" rel="stylesheet" type="text/css">
<div class="cle"></div>
<div id="service">
    ';if($indexMessage){echo '<div class=\'error_panel\'><div>';echo $indexMessage;echo '</div></div>';}echo '
	';if($_showmessage){echo '<div class=\'error_panel\'><div>';echo $_showmessage;echo '</div></div>';}echo '
	<div class="box">
      <div class="top">您可以方便快捷地自助完成修改联系方式、找回登录密码、找回操作密码等服务。</div>
      <div class="con">
        <ul>
          <li class="l_pas">
            <h4><em></em>找回登录密码</h4>
            <div class="gray">通过账号与绑定的手机号码，自助找回登录密码。</div>
            <div class="but">
              <button onclick="openurl(\'/member/forgotpwd/\',\'iframe\');">点击开始</button>
            </div>
          </li>
          <li class="p_pas">
            <h4><em></em>找回操作密码</h4>
            <div class="gray">通过账号与绑定的手机号码，自助找回操作密码。</div>
            <div class="but">
              <button onclick="openurl(\'/member/userdata/?type=GetPass\');">点击开始</button>
            </div>
          </li>
          <li class="count">
            <h4><em></em>修改联系方式</h4>
            <div class="gray">自助修改QQ号码、联系邮箱等个人联系信息。</div>
            <div class="but">
              <button onclick="openurl(\'/member/userdata/?type=index\');">点击开始</button>
            </div>
          </li>
          <li class="tixian">
            <h4><em></em>账户充值</h4>
            <div class="gray">通过网银在线、淘宝店铺等方式给账户在线充值。</div>
            <div class="but">
              <button onclick="openurl(\'/member/topup/\');">点击开始</button>
            </div>
          </li>
          <li class="renz">
            <h4><em class="icon5"></em>账号认证</h4>
            <div class="gray">进行手机认证、绑定掌柜、绑定买号等操作。</div>
            <div class="but">
              <button onclick="openurl(\'/member/active/\');">点击开始</button>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <div class="ico"></div>
    <div class="tab2">
    	<div class="tops" style="display: block;">更多自助服务</div>
    	<div class="zhpass" style="display: block;">
	    	<div class="top">
				<span class="icos"></span>
				<div class="title">
					<strong>找回登录密码</strong><br>忘记登录密码了？不用着急，您可以在这里找回来：）
				</div>
			</div>
			<div class="con">
				<div class="item1">
				<FORM name="myform2" onsubmit="return checkmyform();" method="post">
				  ';echo $sys_hash_code2;echo '
				   <input type="hidden" value="mobilephone" name="type">
					<table cellspacing="0" cellpadding="0">
						<tbody><tr>
							<td class="t1"><strong>手机找回密码</strong></td>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td class="t1">请输入您的账号:</td>
							<td class="t2">
								<input type="text" maxlength="15" class="input" name="username" id="username">
							</td>
							<td class="t3"> </td>
						</tr>
						<tr>
							<td class="t1">请输入您的手机:</td>
							<td class="t2">
								<input type="text" maxlength="11" class="input" name="mobile" id="mobile">
							</td>
							<td class="t3">输入绑定的手机号</td>
						</tr>
						<tr>
							<td class="t1"> </td>
							<td colspan="2">
								<button class="slefsub" id="sendToMobile">确定</button>
							</td>
						</tr>
					</tbody>
					</table>
				</FORM>
				</div>
			</div>
			<div style="float:left;" class="con">
				<div class="item1">
				<FORM name="myform" onsubmit="return checkmyform();" method="post">
				    ';echo $sys_hash_code2;echo '
					<input type="hidden" value="email" name="type">
					<table cellspacing="0" cellpadding="0">
						<tbody><tr>
							<td class="t1"><strong>邮箱找回密码</strong></td>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td class="t1">请输入您的账号:</td>
							<td class="t2">
								<input type="text" maxlength="15" class="input" name="username" tabindex="4" id="username2">
							</td>
							<td class="t3"> </td>
						</tr>
						<tr>
							<td class="t1">请输入Email地址:</td>
							<td class="t2">
								<input type="text" maxlength="26" class="input" name="email" tabindex="4" id="email">
							</td>
							<td class="t3">输入绑定的邮箱地址</td>
						</tr>
						<tr>
							<td class="t1"> </td>
							<td colspan="2">
							<input type="hidden" value="1">
									<button class="slefsub" id="sendToEmail">确定</button>
							</td>
						</tr>
					</tbody>
					</table>
				</FORM>
				</div>
			</div>
		</div>
    </div>
    <div style="clear:both; margin:10px 0px;">
  <div style="float:left; width:480px;"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/taskin/" target="_blank"><img src="/images/gg_02.gif" width="480"></a></div>
  <div style="float:right; width:480px;"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/help/taskout/" target="_blank"><img src="/images/gg_05.gif" width="480"></a></div>
  </div>
</div>
<div class="cle"></div>
<script type="text/javascript">
function checkForm() {';echo '
    var checks = [
		["isEmpty", "username", "用户名"],
		["isEmail", "email", "您的Email地址", "true"] ];
	var result = doCheck(checks);
	if (result)
		return avoidReSubmit("btnEmail");
	return result;
';echo '}

function checkForm2() {';echo '
    var checks = [
		["isEmpty", "username2", "用户名"],
		["isNumber", "mobile", "您的手机号码"] ];
	var result = doCheck(checks);
	if (result)
		return avoidReSubmit();
	return result;
';echo '}
    function openurl(url){';echo '
        window.location.href=weburl +url;
    ';echo '}
</script>
';echo '<div id="footer">
	<div class="footer-mid">
    	<img src="/img/att_104.png" class="logo2"/>
  		<div class="gy"><a href="#">关于我们</a> | <a href="#">联系我们</a> | <a href="#">花兔兔规则</a> | <a href="#">淘宝信誉查询</a> | <a href="#">淘宝信誉查询</a></div>
<p>客户服务热线：02968929109 Copyright © 2012-2020 huatutu.com All RightsReserved 花兔兔版权所有 粤ICP备13037934号</p>
	
</div>

</body>
</html>';?>