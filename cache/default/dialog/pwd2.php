<?php $_tplModify=filemtime('D:\xinyupingtai\cache\default\dialog\pwd2.php');if(filemtime('D:\xinyupingtai\templates\default\dialog\header.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\dialog\footer.htm')>$_tplModify){include(template::load_base('D:\xinyupingtai\templates\default\dialog\pwd2.htm','D:\xinyupingtai\cache\default\dialog\pwd2.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/dialog/';$title='请输入操作码';echo '
';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
		<table class="tbl" border="0" cellspacing="0" cellpadding="6">
			<tr>
				<td width="150" align="right" class="f_14">用户名：</td>
				<td>';echo $member['username'];echo '</td>
			</tr>
			<tr>
				<td align="right" class="f_14">操作码：</td>
				<td><input name="password2" type="password" class="text_normal" id="password2" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>输入正确的操作码后您才能继续操作';if($errMsg){echo '<br /><span class=\'f_red\'>';echo $errMsg;echo '</span>';}echo '</td>
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
$(function(){';echo '
	$(\'#password2\').focus();
';echo '});
function checkForm() {';echo '
    var checks = [
		["isEmpty", "password2", "操作码"]];
	var result = doCheck(checks);
	if (result)avoidReSubmit();
	return result;
';echo '}
</script>
';echo '  </form>
</div>

</body>
</html>';echo '
';?>