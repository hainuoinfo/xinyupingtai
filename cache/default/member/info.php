<?php $_tplModify=filemtime('D:\xinyupingtai\cache\default\member\info.php');if(filemtime('D:\xinyupingtai\templates\default\header.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\headerBase.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\footer.htm')>$_tplModify){include(template::load_base('D:\xinyupingtai\templates\default\member\info.htm','D:\xinyupingtai\cache\default\member\info.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/member/';if($type=='post')$title="卖家";else
		$title="买家";$title.=$memberInfo['base']['username']."信誉---".$web_name;$keywords='{$web_name2}';$description='{$web_name}';$title=common::replaceVars($title);$keywords=common::replaceVars($keywords);$description=common::replaceVars($description);echo string::getStaticCode(array('title'=>$title,'keywords'=>$keywords,'description'=>$description));echo '
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
<DIV class="cle"></DIV>
<DIV id="content">
	<UL id="u_info">
		<LI class="tx">
			<IMG src="';echo $memberInfo['attach']['avatar'];echo '" width="86" height="86">
		</LI>
		<LI class="name">';echo $memberInfo['base']['username'];echo '</LI>
		<LI name="">男
				<SPAN class="jf_ico">';echo $memberInfo['attach']['credits'];echo '分 积分越高,信誉越高</SPAN>
		</LI>
		<LI class="pj">
			 <SPAN class="hp">';if($type=='get'){echo '';echo $memberInfo['attach']['sgrade1'];echo '';}else{echo '';echo $memberInfo['attach']['bgrade1'];echo '';}echo '</SPAN>
			 <SPAN class="zp">';if($type=='get'){echo '';echo $memberInfo['attach']['sgrade2'];echo '';}else{echo '';echo $memberInfo['attach']['bgrade2'];echo '';}echo '</SPAN>
			 <SPAN class="cp">';if($type=='get'){echo '';echo $memberInfo['attach']['sgrade3'];echo '';}else{echo '';echo $memberInfo['attach']['bgrade3'];echo '';}echo '</SPAN>
		</LI>
		<LI class="jj">好评率：
				<STRONG class="chengse">
';if($type=='get'){$num=$memberInfo['attach']['sgrade1']+$memberInfo['attach']['sgrade2']+$memberInfo['attach']['sgrade3'];if($num!=0)$hpl=$memberInfo['attach']['sgrade1']/$num;else 
			$hpl=1;}else{$num=$memberInfo['attach']['bgrade1']+$memberInfo['attach']['bgrade2']+$memberInfo['attach']['bgrade3'];if($num!=0)$hpl=$memberInfo['attach']['bgrade1']/$num;else 
			$hpl=1;}$haoping=ceil($hpl*10000)/100;echo $haoping;echo '%</STRONG>
		</LI>
		<LI class="jj">注册时间：
				<SPAN class="time">';echo date('Y年m月d日',$memberInfo['base']['reg_timestamp']);echo '</SPAN>
		</LI>
		<!--<li class="jj">最后登录：<span class="time">2013-10-15 11:52:06</span></li>-->
		<LI class="jj">已被';echo $memberInfo['attach']['black2'];echo '人加入黑名单啦！
			<A class="jh_btn" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/black/?quickblack=1&amp;blackname=';echo $memberInfo['base']['username'];echo '"></A>
		</LI>
	</UL>
	<UL id="lt_info">';if($list){foreach($list as $thread){echo '
		<LI>
				<A title="thread[title]" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t';echo $thread['id'];echo '/" target="_blank">·';echo common::cutstr($thread['title'],20);echo '</A>
				<SPAN class="date">07-25</SPAN>
		</LI>';}}echo '
		<LI>
				<A title="你是麦友中的职业接手方吗？大麦户可以申请职业接手方咯！" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1689/" target="_blank">·你是麦友中的职业接手方吗？大麦户可以申请职业接手…</A>
				<SPAN class="date">09-09</SPAN>
		</LI>
		<LI>
				<A title="【新手必读】发布任务麦点扣除标准" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t122/" target="_blank">·【新手必读】发布任务麦点扣除标准</A>
				<SPAN class="date">02-27</SPAN>
		</LI>
		<LI>
				<A title="官方绿色回收大行动 0.35元/麦点 日赚百元就是那么简单 " href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t411/" target="_blank">·官方绿色回收大行动 0.35元/麦点 日赚百元就…</A>
				<SPAN class="date">05-16</SPAN>
		</LI>
		<LI>
				<A title="淘宝店铺自动充值图文教程" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t196/" target="_blank">·淘宝店铺自动充值图文教程</A>
				<SPAN class="date">08-14</SPAN>
		</LI>
		<LI>
				<A title="什么是真实快递签收任务？" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1685/" target="_blank">·什么是真实快递签收任务？</A>
				<SPAN class="date">12-30</SPAN>
		</LI>
		<LI>
				<A title="新人必看+常见问题+精华归纳+会员经验+大麦户教程" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t372/" target="_blank">·新人必看+常见问题+精华归纳+会员经验+大麦户教程</A>
				<SPAN class="date">07-17</SPAN>
		</LI>
	</UL>
	<DIV class="cle"></DIV>
	<TABLE border="0" cellSpacing="0" cellPadding="0" width="100%">
		<TBODY>
			<TR class="u_tit">
				<TD class="u_left" height="38" vAlign="middle" width="10px" align="center">&nbsp;</TD>
				<TD height="38" vAlign="middle" width="100px" align="center">好评用户</TD>
				<TD height="38" vAlign="middle" width="100px" align="center">被好评用户</TD>
				<TD height="38" vAlign="middle" width="500px" align="center">内容</TD>
				<TD height="38" vAlign="middle" width="130px" align="center">提交时间</TD>
				<TD vAlign="middle" width="50px" align="center">类型</TD>
				<TD class="u_right" vAlign="middle" width="10px" align="center">&nbsp;</TD>
			</TR>
';if($cList){foreach($cList as $v){echo '			
			<TR class="u_tit">
				<TD class="u_left" height="38" vAlign="middle" align="center">&nbsp;</TD>
				<TD height="38" vAlign="middle"  align="center">';echo $v['fusername'];echo '</TD>
				<TD height="38" vAlign="middle"  align="center">';echo $v['tusername'];echo '</TD>
				<TD height="38" vAlign="middle"  align="center" title="';echo $v['remark'];echo '" style="overflow: hidden;white-space: nowrap;">';echo $v['remark'];echo '</TD>
				<TD height="38" vAlign="middle" align="center">
';echo date('Y-m-d H:i:s',$v['timestamp']);echo '
					
				</TD>
				<TD vAlign="middle" align="center">
';if($v['score']=='1')echo '好评';elseif($v['score']=='0')echo '中评';elseif($v['score']=='-1')echo '差评';echo '
					
				</TD>
				<TD class="u_right" vAlign="middle" width="10" align="center">&nbsp;</TD>
			</TR>
';}}echo '
		</TBODY>
	</TABLE>
	<DIV id="page">';echo $multipage;echo '</DIV>
</DIV>
<DIV class="cle"></DIV>';echo '<div id="footer">
	<div class="footer-mid">
    	<img src="/img/att_104.png" class="logo2"/>
  		<div class="gy"><a href="#">关于我们</a> | <a href="#">联系我们</a> | <a href="#">花兔兔规则</a> | <a href="#">淘宝信誉查询</a> | <a href="#">淘宝信誉查询</a></div>
<p>客户服务热线：02968929109 Copyright © 2012-2020 huatutu.com All RightsReserved 花兔兔版权所有 粤ICP备13037934号</p>
	
</div>

</body>
</html>';?>