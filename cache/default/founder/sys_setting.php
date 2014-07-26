<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\sys_setting.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\sys_setting.htm','D:\damaihu\xinyupingtai7\cache\default\founder\sys_setting.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<script type="text/javascript" src="http://damaihu.tertw.net/javascript/jquery.min.js"></script><script type="text/javascript" src="http://damaihu.tertw.net/javascript/form_hack.js"></script>
<link href="http://damaihu.tertw.net/css/founder/founder.css" rel="stylesheet" type="text/css" /><script type="text/javascript" src="http://damaihu.tertw.net/javascript/common.func.js"></script>
<script language="javascript">
$.ajaxSetup({';echo 'cache:false';echo '});
var goto=function(name){';echo '
	location.href=\'index.php?action=';echo $action;echo '&operation=';echo $operation;echo '&method=\'+name;
';echo '}
';if($info){echo '
alert(\'';echo addcslashes($info,'\'\\');echo '\');
';}echo '
</script>
</head>
<body>
<script type="text/JavaScript">
if(parent.$(\'admincpnav\')) parent.$(\'admincpnav\').innerHTML=\'';echo $menu_name;echo '&nbsp;&raquo;&nbsp;';echo $menu_sub_name;echo '\';
if(parent.$(\'add2custom\')) parent.$(\'add2custom\').innerHTML=\'<a href="admincp.php?action=misc&operation=custommenu&do=add&title=cplog_tasks&url=action%3Dtasks" target="main"><img src="images/admincp/btn_add2menu.gif" title="添加到常用操作" width="19" height="18" /></a>\';
if(parent.$(\'custombar_add\')) parent.$(\'custombar_add\').innerHTML=\'';if(!$custom_menu_exists){echo '<span onclick="add_admin_menu(\\\'';echo $action;echo '\\\',\\\'';echo $operation;echo '\\\')" title="把当前页面添加到任务栏" />&nbsp;&nbsp;&nbsp;&nbsp;添加到任务栏</span>';}echo '\';
</script>';echo '
<script language="javascript">
$(function(){';echo '
	$(\'table\').addClass(\'tb tb2 fixpadding\');
	$(\'table tr\').each(function(){';echo '
		if($(this).addClass(\'hover\').find(\'@input[type=text]\').addClass(\'txt\').css({';echo 'width:\'300px\'';echo '}).length==1)
			$(this).find(\'th\').css({';echo '\'text-align\':\'right\'';echo '});
	';echo '});
';echo '});
</script>
<div class="container" id="cpcontainer">
	<form method="post" enctype="application/x-www-form-urlencoded">
	<input type="hidden" name="hash" value="';echo $sys_hash;echo '" />
		<table>
			<tr>
				<th colspan="3" class="partition">系统设置</th>
			</tr>
			<tr>
				<th>数据加密密钥：</th>
				<td><input type="text" name="auth_key" value="';echo $config['auth_key'];echo '" /></td>
				<td>用于一些重要的数据加密，一旦设定，不要轻易改动，否则后果不可预料！</td>
			</tr>
			<tr>
				<th>后台路径：</th>
				<td><input type="text" name="sys_admin_folder" value="';echo $config['sys_admin_folder'];echo '" /></td>
				<td>路径前后不要加“/”</td>
			</tr>
			<tr>
				<th>MYSQL服务器：</th>
				<td><input type="text" name="db_host" value="';echo $config['db_host'];echo '" size="64" /></td>
				<td>默认为：localhost</td>
			</tr>
			<tr>
				<th>MYSQL服务器端口：</th>
				<td><input type="text" name="db_port" value="';echo $config['db_port'];echo '" size="64" /></td>
				<td>默认为：3306</td>
			</tr>
			<tr>
				<th>MYSQL数据库：</th>
				<td><input type="text" name="db_name" value="';echo $config['db_name'];echo '" size="64" /></td>
				<td>MYSQL数据库名字</td>
			</tr>
			<tr>
				<th>MYSQL数据库帐号：</th>
				<td><input type="text" name="db_user" value="';echo $config['db_user'];echo '" size="64" /></td>
				<td>填写你数据库的用户名</td>
			</tr>
			<tr>
				<th>MYSQL数据库密码：</th>
				<td><input type="text" name="db_pwd" value="';echo $config['db_pwd'];echo '" size="64" /></td>
				<td>填写你数据库的密码</td>
			</tr>
			<tr>
				<th>数据库表前缀：</th>
				<td><input type="text" name="db_table_pre" value="';echo $config['db_table_pre'];echo '" size="64" /></td>
				<td>整个网站的数据库表前缀</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn" id="submit_tasksubmit" name="tasksubmit" title="按 Enter 键可随时提交您的修改" value="提交" /></td>
				<td></td>
			</tr>
		</table>
	</form>
</div>
';echo '</body>
</html>';?>