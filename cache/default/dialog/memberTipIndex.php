<?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/dialog/';echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://damaihu.tertw.net/css/dialog/dialog.css" rel="stylesheet" type="text/css" />
';if($memberFields['credits']<=50){echo '
<style type="text/css">
 
.tbl_t td {';echo 'line-height:20px !important;';echo '}

</style>
';}echo '
<title>操作提醒信息</title>
</head>
<body onload="">
<div class="main_dl">
  ';if($memberFields['credits']<=50){echo '
  <div style="line-height:20px; font-weight:bold; color:#F00; padding:10px;">
		请新来平台的朋友注意平台基本规则：<br />一、严禁通过旺旺联系对方并带有平台，美乐，刷钻，刷信誉等忌讳字眼；(请使用QQ联系对方)<br />二、禁止以任何理由给对方差评及非100%好评等行为；<br />三、严禁使用任何欺骗、恐吓等办法骗取其它会员资金或存款；<br />四、禁止匿名购买对方商品或者匿名评价；(注:如对方要求匿名评价或特殊商品类如成人用品则该规定无效)<br />五、禁止任何会员在做任务时故意拖卡对方任务；<br />六、严禁好评乱写评语，广告评语或恶意乱写评语；<br />七、禁止在发布一个任务却以各种理由让接手方拍淘宝多个商品/链接；(注：真实快递单任务除外)<br />八、禁止在任务过程中，辱骂任务一方，出言不逊；<br />九、禁止接手人使用淘宝客链接赚取佣金以及使用信用卡购买任务商品；<br />十、平台禁止使用外挂，否则处罚！！！<br /><span style="color:#006600;">【注：以上一至三点违反任何一条，一经核实马上封号！四至九点凡发现初犯者警告，返还非法所得、再犯者扣罚双倍非法所得、累计三次不改者将封号处理。】<br /></span>以上信息积分&gt;50不再显示&nbsp;
  </div>
  <table class="tbl_t" width=\'100%\' border=\'0\' cellspacing=\'0\' cellpadding=\'0\'>
    <tr>
      <td width=\'140\' class=\'f_b_green\' align="right">未读站内信：</td>
      <td><a href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=inSys\' target="_blank">有<span class="f_b_org">';echo msg::getCount(1);echo '</span>封新官方站内信</a><br />
				<a href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=inUser\' target="_blank">有<span class="f_b_org">';echo msg::getCount(0);echo '</span>封新私人站内信</a></td>
    </tr>
    <tr>
      <td class=\'f_b_green\' align="right">到期收货与好评任务：</td>
      <td><a href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/dialog/taskComment/?in=1\'>到期收货与好评的已接任务<span class="f_b_org">';echo $memberTask['inExpire1']+$memberTask['inExpire2']+$memberTask['inExpire3']+$memberTask['inExpire4'];echo '</span>个</a><br /> 
				<a href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/dialog/taskComment/?out=1\'>到期收货与好评的已发任务<span class="f_b_org">';echo $memberTask['outExpire1']+$memberTask['outExpire2']+$memberTask['outExpire3']+$memberTask['outExpire4'];echo '</span>个</a></td>
    </tr>
    <tr>
      <td class=\'f_b_green\' align="right">待解决的申诉：</td>
      <td><a href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/complain/?t=post\' target=\'_blank\'>我发起的未解决申诉<span class="f_b_org">';echo db::data_count('complain',"fuid='$uid' and status not in('1','2')");echo '</span>个</a><br />
				<a href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/complain/?t=get\' target=\'_blank\'>我收到的未解决申诉<span class="f_b_org">';echo db::data_count('complain',"tuid='$uid' and status not in('1','2')");echo '</span>个</a></td>
    </tr>
    <tr>
      <td class=\'f_b_green\' align="right">同时接发任务数：</td>
      <td>最多同时接手任务数：<span class="f_b_org">';echo $maxTaskIn;echo '</span>个<br />
				最多同时发布任务数：<span class="f_b_org">';echo $maxTaskOut;echo '</span>个<br />
				<strong class="f_red">任务数指所有互动区的未完成任务总数</strong><br />
				<a href="/bbs/t11/" target="_blank" class="link_b">了解积分和任务数的关系</a></td>
    </tr>
  </table>
  ';}else{echo '
  <div class="bar_dl">操作提醒信息</div>
	
  <table class="tbl_t" width=\'100%\' border=\'0\' cellspacing=\'0\' cellpadding=\'0\'>
    <tr>
      <td width=\'140\' class=\'f_b_green\' align="right">未读站内信：</td>
      <td><a href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=inSys\' target="_blank">有<span class="f_b_org">';echo msg::getCount(1);echo '</span>封新官方站内信</a><br />
				<a href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/message/?type=inUser\' target="_blank">有<span class="f_b_org">';echo msg::getCount(0);echo '</span>封新私人站内信</a></td>
    </tr>
    <tr>
      <td class=\'f_b_green\' align="right">到期收货与好评任务：</td>
      <td><a href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/dialog/taskComment/?in=1\'>到期收货与好评的已接任务<span class="f_b_org">';echo $memberTask['inExpire1']+$memberTask['inExpire2']+$memberTask['inExpire3']+$memberTask['inExpire4'];echo '</span>个</a><br /> 
				<a href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/dialog/taskComment/?out=1\'>到期收货与好评的已发任务<span class="f_b_org">';echo $memberTask['outExpire1']+$memberTask['outExpire2']+$memberTask['outExpire3']+$memberTask['outExpire4'];echo '</span>个</a></td>
    </tr>
    <tr>
      <td class=\'f_b_green\' align="right">待解决的申诉：</td>
      <td><a href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/complain/?t=post\' target=\'_blank\'>我发起的未解决申诉<span class="f_b_org">';echo db::data_count('complain',"fuid='$uid' and status not in('1','2')");echo '</span>个</a><br />
				<a href=\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/complain/?t=get\' target=\'_blank\'>我收到的未解决申诉<span class="f_b_org">';echo db::data_count('complain',"tuid='$uid' and status not in('1','2')");echo '</span>个</a></td>
    </tr>
    <tr>
      <td class=\'f_b_green\' align="right">同时接发任务数：</td>
      <td>最多同时接手任务数：<span class="f_b_org">';echo $maxTaskIn;echo '</span>个<br />
				最多同时发布任务数：<span class="f_b_org">';echo $maxTaskOut;echo '</span>个<br />
				<strong class="f_red">任务数指所有互动区的未完成任务总数</strong><br />
				<a href="/bbs/t11/" target="_blank" class="link_b">了解积分和任务数的关系</a></td>
    </tr>
  </table>
  ';}echo '
	<div style="padding-top:10px;text-align:center;">
		<input name="goon" class="btn_2" type="button" id="goon" onclick="parent.doCut();" value="关闭" />
	</div>
</div>
';if(!$member['questionid']){echo '
<script type="text/javascript">
    alert("您当前尚未设置安全问题和回答\\n\\n为了您的账户安全建议您加强您的密码同时设置安全问题和回答\\n\\n安全问题和回答在密码维护页面");
</script>
';}echo '
</body>
</html>';?>