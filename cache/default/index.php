<?php $_tplModify=filemtime('D:\xinyupingtai\cache\default\index.php');if(filemtime('D:\xinyupingtai\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\xinyupingtai\templates\default\index.htm','D:\xinyupingtai\cache\default\index.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/';$title='互动吧平台';$keywords='互动吧';$description='互动吧平台';$cssList=array(0=>'http://d.hainuo.info/css/index/index.css');echo '
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

<div id="banner">
<div class="banner-mid">
    	<div class="sht"> 
        	<div class="fg">
        	<a href="#"><img src="/img/att_14.png" class="sht-1"/></a>
            <a href="#"><img src="/img/att_14.png" class="sht-2"/></a>
            <a href="#"><img src="/img/att_16.png" class="sht-3"/></a>
            </div>
      </div>
    	<div class="zck">';echo '
';if($memberLogined){echo '
       	  <h2>一个<span>真实的</span>淘宝信誉平台期待为您服务</h2>
          <div class="zxxinxi">
          		<label><strong>用户名：</strong><a href="/member/info/?username=';echo $member['username'];echo '"> <span >';echo $member['username'];echo '</span></a></label>
                <label><strong>存款：</strong><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/PayDetails/?type=1" ><span>';echo $memberFields['money'];echo '</span></a></label>
                <label><strong>兔粮：</strong><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/PayDetails/?type=2" ><span>';echo $memberFields['fabudian'];echo '</span></a></label>
                <label><strong>积分：</strong><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/PayDetails/?type=3" ><span>';echo $memberFields['credits'];echo '</span></a></label>
                <label><strong>登陆次数：</strong><a href="/member/PayDetails/?type=7" ><span>';echo $member['log_count'];echo '</span></a></label>
          </div>
		  <img src="/img/attgg_27.png" class="qzxtu"/>
             <div  class="form3"><input type="button" value="马上开始" onclick="window.location.href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/task/tao/\'"  class="msks"/></div>
';}else{echo '
       	  <h2>立即注册花兔兔</h2>
            <form method="post" name="myForm" id="myForm" onsubmit="return checkForm();">
              <div style="display:none;"> ';echo $sys_hash_code2;echo ' </div>
            <div class="form1"><input name="username" id="lusername" type="text" value="';echo isset($username)?$username:(isset($cookie['loginUsername'])?$cookie['loginUsername']:'');echo '" maxlength="16" class="yhm"/></div>
          <div class="form2"><input type="password"  name="password" id="lpassword" maxlength="16" value="" class="mm"/></div>
             <div class="form3"><input id="login_sub" type="submit" name="btnSubmit" value="登陆"  class="dlx"/></div>
             <p>';if($indexMessage){echo '<div style="color:#FF0000">';echo $indexMessage;echo '</div>';}else{echo '<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/forgotpwd/">忘记密码？</a>';}echo '</p>
            </form>
';}echo '
   		</div>
  </div>
</div>
<div id="main-top">
  	<div class="rwdt">
   	  	<img src="/img/att_07.png" class="rwdttu"/>
    	<h2>任务大厅</h2>
      	<div class="wrhd">
       	<p><a href="#">万人互动平台<br />
花几毛钱N人帮你做任务</a></p>	
		<h3><a href="#">只为满意的好评买单</a></h3>
    	</div>
  	</div>
	<div class="yyzd">
	  		<h2>运营指导</h2>
			<div class="yyzd-l">
  		<p><a href="#">店铺<span>没销量？</span><br />
		<em>　　　　　　其他痛点？</em></a></p>	
		<h3><a href="#">运营指导师免费在线解答</a></h3>
  		<a href="#"><img  onmouseover="this.src=\'/img/att2_31.png\'" onmouseout="this.src=\'/img/att_31.png\'" src="/img/att_31.png" class="zxjd"  /></a>
  		</div>
    
    
    
    	<div class="yyzd-y"> 
		<a href="#"><img onmouseover="this.src=\'/img/att2_27.png\'" onmouseout="this.src=\'/img/att_27.png\'" src="/img/att_27.png" class="spjx"/></a>
		 	</div>
	</div>



	<div class="wdtg">
	 		 <img src="/img/att_08.png" class="wdtu"/>
		 <h2>网店托管</h2>
 		 <div class="bhg">
  		 <img src="/img/att_23.png" class="hg"/>
   		<p><a href="#">10天变<span>皇冠</span>的秘密在这里</a></p>	
		<h3><a href="#">指定类目托管、个性化定制</a></h3>
        </div>
    </div>
    <div class="gaod">
			<div class="xxjt">
			  <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="50" height="50">
			    <param name="movie" value="/flash/222.swf" />
			    <param name="quality" value="high" />
			    <param name="wmode" value="opaque" />
			    <param name="swfversion" value="6.0.65.0" />
			    <!-- 此 param 标签提示使用 Flash Player 6.0 r65 和更高版本的用户下载最新版本的 Flash Player。如果您不想让用户看到该提示，请将其删除。 -->
			    <param name="expressinstall" value="/Scripts/expressInstall.swf" />
			    <!-- 下一个对象标签用于非 IE 浏览器。所以使用 IECC 将其从 IE 隐藏。 -->
			    <!--[if !IE]>
			    <object type="application/x-shockwave-flash" data="/flash/222.swf" width="50" height="50">
			      <![endif]--->
			      <param name="quality" value="high" />
			      <param name="wmode" value="opaque" />
			      <param name="swfversion" value="6.0.65.0" />
			      <param name="expressinstall" value="/Scripts/expressInstall.swf" />
			      <!-- 浏览器将以下替代内容显示给使用 Flash Player 6.0 和更低版本的用户。 -->
			      <div>
			        <h4>此页面上的内容需要较新版本的 Adobe Flash Player。</h4>
			        <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="获取 Adobe Flash Player" width="112" height="33" /></a></p>
		          </div>
			      <!--[if !IE]>-->
		        </object>
			    <!--<![endif]-->
		      </object>
			</div>
            <a href="#"><img onmouseover="this.src=\'/img/att3_41.png\'"  onmouseout="this.src=\'/img/att_41.png\'" src="/img/att_41.png" class="jjfa"/></a>
			<script type="text/javascript">
			swfobject.registerObject("FlashID");
			</script>
  	</div> 
</div> 
</div>
<div id="main-m">
	<div class="fb">
    	<h2>发布方任务存款转化成网店收款</h2>
        <div class="fbnr">
         <a href="#"><img onmouseover="this.src=\'/img/att2_53.png\'"  onmouseout="this.src=\'/img/att_53.png\'" src="/img/att_53.png" class="ltu-1"/>
         </a><img src="/img/att_63.png" class="j1" />
         <a href="#"><img onmouseover="this.src=\'/img/att2_55.png\'"  onmouseout="this.src=\'/img/att_55.png\'" src="/img/att_55.png" class="ltu-2"/></a>
         <img src="/img/att_60.png" class="j2"/>
         <a href="#"><img onmouseover="this.src=\'/img/att2_57.png\'"  onmouseout="this.src=\'/img/att_57.png\'" src="/img/att_57.png" class="ltu-3"/></a>
         <a href="#"><img onmouseover="this.src=\'/img/att3_88.png\'"  onmouseout="this.src=\'/img/att_71.png\'" src="/img/att_71.png" class="shang"/></a>
        </div>
    </div>
    <div class="js">
    	<h2>接手方网店付款转化为平台收款</h2>
        <div class="jsnr">
         <a href="#"><img onmouseover="this.src=\'/img/att4_59.png\'"  onmouseout="this.src=\'/img/att3_59.png\'" src="/img/att3_59.png" class="rtu-1"/>
         </a><img src="/img/att_63.png" class="j1" />
         <a href="#"><img onmouseover="this.src=\'/img/att4_61.png\'"  onmouseout="this.src=\'/img/att3_61.png\'" src="/img/att3_61.png" class="rtu-2"/></a>
         <img src="/img/att_60.png" class="j2"/>
         <a href="#"><img onmouseover="this.src=\'/img/att4_63.png\'"  onmouseout="this.src=\'/img/att3_63.png\'" src="/img/att3_63.png" class="rtu-3"/></a>
         <a href="#"><img onmouseover="this.src=\'/img/att4_91.png\'"  onmouseout="this.src=\'/img/att3_91.png\'" src="/img/att3_91.png" class="zuo"/></a>
        </div>
    </div>
</div>
<div id="ty">
	<div class="zqtg"><h2 class="wytg"><a href="#">我要推广</a></h2>
    </div>
    
	<div class="ys">
    	<!--<h1><a href="#">花兔兔互动平台的<span>优势</span></a></h1>
        <h2><a href="#">免费<br />的运营指导</a></h2>
        <h3><a href="#">免费的服务平台</a></h3>
        <h4><a href="#">绝对的<br />安全保证</a></h4>
        <h5><a href="#">合理的定时发布</a></h5>
        <h6><a href="#">万人互动</a></h6>-->     
        <a href="#"><img onmouseover="this.src=\'/img/att2_100.png\'"  onmouseout="this.src=\'/img/att_1050.png\'" src="/img/att_1050.png" class="ys-1"/></a>
        <a href="#"><img onmouseover="this.src=\'/img/att2_101.png\'"  onmouseout="this.src=\'/img/att_101.png\'" src="/img/att_101.png" class="ys-2"/></a>
        <a href="#"><img onmouseover="this.src=\'/img/arr2_102.png\'"  onmouseout="this.src=\'/img/att102.png\'" src="/img/att102.png" class="ys-3"/></a>
        <a href="#"><img onmouseover="this.src=\'/img/att2_103_104.png\'"  onmouseout="this.src=\'/img/att103_104.png\'" src="/img/att103_104.png" class="ys-4"/></a>
        <a href="#"><img onmouseover="this.src=\'/img/att2_104_107.png\'"  onmouseout="this.src=\'/img/att104_107.png\'" src="/img/att104_107.png" class="ys-5"/></a>
        <a href="#"><img onmouseover="this.src=\'/img/att2_99.png\'"  onmouseout="this.src=\'/img/att_99.png\'" src="/img/att_99.png" class="ys-z"/></a>
    </div>
</div>
<div id="main-f">
	<div class="shipin">
    <img src="/img/att_100.png" class="sp"/>
    <a href="#">视频操作指南</a>
    </div>
    <div class="bugao">
    	<div class="bugaox">
    		<div class="bg">
              ';$forumSimple=bbs_forums::getForumSimple('skill','ename');$list=bbs_thread::getThreadList2("fid='$forumSimple[id]'",'timestamp desc',1,7);echo '	    		
            	<ul>
				';if($list){foreach($list as $thread){echo '
                  <li>
                    <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t';echo $thread['id'];echo '/" target="_blank" title="';echo $thread['title'];echo '"><strong>';echo common::cutstr($thread['title'],15);echo '</strong></a><span>';echo date('Y-m-d H:i:s',$v['stimestamp']);echo '</span>
                  </li>
                ';}}echo '               
                </ul>
            </div>
            <div class="fs">
            	<ul>
                ';if($nowList){foreach($nowList as $v){echo '
				<li><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info.php?username=';echo $v['susername'];echo '" class="lanse" target="_blank">';echo $v['susername'];echo '</a><span style="float:left">发布任务网店提升 <strong class="chengse">+1</strong></span><span class="date">';echo date('m-d',$v['stimestamp']);echo '</span>
                </li>
                ';}}echo '
                </ul>
		<script>';echo '
		var lastTime=1;
		var allData=[];
		function _getNowTask(){';echo '
			var data={';echo '';echo '};
			if (lastTime==1){';echo '
				data = {';echo 'frist:1';echo '};
			';echo '}else
				data = {';echo 'lastTime:lastTime';echo '};
				
			$.post(\'/ajax/getNowTask.php\',data,function(request){';echo '
				lastTime = request.nowLookTime;
				_addData(request.data);
			';echo '},\'json\');
		';echo '}
		
		function _addData(newData){';echo '
			var count=0;
			var str,newStr;
			if (newData!=null){';echo '
				str=_renderData(allData,false);
				newStr = _renderData(newData,true);
				$(\'.ajax_i li\').remove();
				$(\'.c_info .bt2\').after(str);
				$(\'.c_info .bt2\').after(newStr);
				$("[info=\'new\']").fadeIn(2000);
				if (allData.length==0)
					allData = newData;
				else{';echo '
					for(var i=newData.length-1;i>=0;i--)
						allData.unshift(newData[i]);
				';echo '}
				allData = allData.slice(0,7);
			';echo '}else{';echo '
				str=_renderData(allData,false);
				$(\'.ajax_i li\').remove();
				$(\'.c_info .bt2\').after(str);
			';echo '}
		';echo '}
		
		function _renderData(Data,type){';echo '
			var str=\'\',info=\'\';
			if (type){';echo '
				info=\'info="new" style="display:none"\';
			';echo '}
			for(var key in Data){';echo '
				str +="<li "+info+" ><a href=\'/member/info/?username="+encodeURI(Data[key].susername)+"\' class=\'lanse\' target=\'_blank\'>"+Data[key].susername+"</a><span style=\'float:left\'>  发布任务获得信誉 <strong class=\'chengse\'>+1</strong></span><span class=\'date\'>"
				if (lastTime-Data[key].ctimestamp>3000)
					 str+=\'\';
				 else if (lastTime-Data[key].ctimestamp<60)
					 str+=lastTime-Data[key].ctimestamp+3+\'秒前\';
				 else
					 str+=parseInt((lastTime-Data[key].ctimestamp)/60)+\'分钟前\';
				 str+= \'</span></li>\';
			';echo '}
			return str;
		';echo '}
		//setInterval(_getNowTask,3000);
		</script>                
            </div>
        </div>
    </div>
</div>
';echo '<div id="footer">
	<div class="footer-mid">
    	<img src="/img/att_104.png" class="logo2"/>
  		<div class="gy"><a href="#">关于我们</a> | <a href="#">联系我们</a> | <a href="#">花兔兔规则</a> | <a href="#">淘宝信誉查询</a> | <a href="#">淘宝信誉查询</a></div>
<p>客户服务热线：02968929109 Copyright © 2012-2020 huatutu.com All RightsReserved 花兔兔版权所有 粤ICP备13037934号</p>
	
</div>

</body>
</html>';?>