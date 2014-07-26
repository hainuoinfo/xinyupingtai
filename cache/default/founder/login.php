<?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>阿里CMS管理员登录</title>
<link href="http://damaihu.tertw.net/css/founder/main.css" rel="stylesheet" type="text/css" /><link href="http://damaihu.tertw.net/css/founder/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://damaihu.tertw.net/javascript/jquery.min.js"></script>
<script type="text/javascript" src="http://damaihu.tertw.net/javascript/form_hack.js"></script>
<script language="javascript">
$(function(){';echo '
	$(\'.msout\').each(function(){';echo '
		$(this).mousemove(function(){';echo '
			$(this).removeClass(\'msout\');
			$(this).addClass(\'msmove\');
		';echo '});
		$(this).mouseout(function(){';echo '
			$(this).removeClass(\'msmove\');
			$(this).addClass(\'msout\');
		';echo '})
	';echo '});
	if(!$(\'#founder_name\').val())$(\'#founder_name\').focus();
	else $(\'#founder_password\').focus();
';echo '});
</script>
</head>

<body>
	<div class="login">
		<div class="left">
			<div class="h">互刷信誉网站管理</div>
			<div class="d">优科网络互刷网信息系统团队——打造更好的系统</div>
		</div>
		<div class="right">
			<form method="post">
			<div>Login</div>
			';if($error){echo '<div class="show_message">';echo $error;echo '</div>';}echo '
			<table>
				<tr>
					<td>管理员：</td>
					<td><input type="text" name="founder_name" id="founder_name" class="msout" preg="null=请输入管理员帐号|管理员帐号不能为空" value="';echo $_POST['founder_name'];echo '" /></td>
					<td id="founder_name_tip"></td>
				</tr>
				<tr>
					<td>密	码：</td>
					<td><input type="password" name="founder_password" id="founder_password" class="msout" preg="null=请输入管理员密码|管理员密码不能为空" value="" /></td>
					<td id="founder_password_tip"></td>
				</tr>
				<tr>
					<td>验证码：</td>
					<td><input type="text" name="vcode" id="vcode" maxlength="4" class="msout" RegStr="/^\\d{';echo '4';echo '}$/" Message="请输入四位数字验证码|请输入四位数字验证码" /></td>
					<td id="vcode_tip"></td>
				</tr>
				<tr>
					<td valign="top">验证码：</td>
					<td><img id="img_vcode" src="/images/vcode.php" /></td>
					<td><a href="javascript:;" onclick="$(\'#img_vcode\').attr({';echo 'src:\'/images/vcode.php?\'+Math.random()';echo '});$(\'#vcode\').focus();">看不清，换一张</a></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="登 录" /></td>
					<td></td>
				</tr>
			</table>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</body>
</html>
';?>