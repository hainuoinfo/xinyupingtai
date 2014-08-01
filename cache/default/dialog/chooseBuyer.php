<?php $_tplModify=filemtime('D:\xinyupingtai\cache\default\dialog\chooseBuyer.php');if(filemtime('D:\xinyupingtai\templates\default\dialog\header.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\dialog\footer.htm')>$_tplModify){include(template::load_base('D:\xinyupingtai\templates\default\dialog\chooseBuyer.htm','D:\xinyupingtai\cache\default\dialog\chooseBuyer.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/dialog/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://d.hainuo.info/css/dialog/dialog.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://d.hainuo.info/javascript/jquery.min.js"></script><script type="text/javascript" src="http://d.hainuo.info/javascript/common.func.js"></script>
<title>';echo $title;echo '</title>
</head>
<body>
<div class="main_dl">
	';if($_showmessage)$indexMessage=$_showmessage;echo '
	';if($indexShowMessage){echo '<div class=\'msg_panel\'><div>';echo $indexShowMessage;echo '</div></div>';}echo '
	';if($indexMessage){echo '<div class=\'error_panel\'><div>';echo $indexMessage;echo '</div></div>';}echo '
  ';if($title){echo '<div class="bar_dl">';echo $title;echo '</div>';}echo '
  <form name="myForm" method="post" id="myForm" onsubmit="return checkForm();">
<div>
';echo $sys_hash_code2;echo '
</div>
<div>
<input type="hidden" name="referer" value="';echo $referer;echo '" />
</div>';echo '
<div style="padding:5px 10px;line-height:20px;">为了保障您买号以及任务发布方账号安全，联盟系统建议每个买号每日最多接手6个任务，每周最多接手35个任务，超过限额的任务只能获得一半的任务发布点与奖励积分哦，请您尽量替换使用绑定的买号！</div>
<table class="tbl" border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td width="100" align="right" class="f_b">用户名：</td>
		<td>';echo $task['busername'];echo '<span class="f_b_red">　　';if($task['isReal']){echo ' ';if($task['realname']==1){echo '本任务需要支付宝实名认证买号';}else{echo '本任务需要淘宝掌柜号才能绑定';}echo '';}echo '
		';if($task['isFame']){echo ' 本任务需要买号信誉小于';echo $task['fameLvl'];echo '';}echo '</span></td>
	</tr>
	<tr>
		<td align="right" class="f_b">任务编号：</td>
		<td>';echo $task['id'];echo ' <span class="f_red"></span></td>
	</tr>
	<tr>
		<td align="right" valign="top" class="f_b">已添加的买号：</td>
		<td valign="top" >
			';if($buyerList){foreach($buyerList as $v){echo '
			<div style="line-height:16px; padding:3px 0px;">
				<input name="bid" type="radio" value="';echo $v['id'];echo '"';if($v['disabled']){echo ' disabled="disabled"';}echo ' />
				';echo $v['nickname'];echo '　信誉:<strong>';echo $v['score'];echo '</strong>,
				日:<strong>';echo $v['todayTask'];echo '</strong>,
				周:<strong>';echo $v['tswkTask'];echo '</strong>,
				状态:<strong>';echo $bStatus[$v['status']];echo '</strong> <span class="f_b_org">';if($v['isreal']>0){echo '';if($v['hasShop']){echo '掌柜';}else{echo '实名';}echo '';}echo '</span> <img src="';echo $weburl2;echo 'images/ico/tip2.gif" title="已设置地址：" onclick="alert(this.title)" class="cursor f_b" title="';echo $v['express'];echo '" /> <span class="f_b_green">';if($v['level']){echo '';echo $v['level'];echo '星';}echo '</span></div>
			';}}echo '
			</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input name="btnSubmit" type="submit" class="btn_2" id="btnSubmit" value="确定" />
			<input name="btnCancel" type="button" class="btn_2" onclick="parent.doCut();" id="btnCancel" value="取消" /></td>
	</tr>
</table>
<script type="text/javascript">
function checkForm() {';echo '	
	if ($(\'[name=bid]\').checked()) return true;
	else {';echo '
		alert(\'请选择要绑定的买号\');
		return false;
	';echo '}

';echo '}
</script>
';echo '  </form>
</div>

</body>
</html>';?>