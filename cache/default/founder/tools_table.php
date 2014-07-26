<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\tools_table.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\tools_table.htm','D:\damaihu\xinyupingtai7\cache\default\founder\tools_table.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<div class="container" id="cpcontainer">
	<div class="floattop">
		<div class="itemtitle">
			<h3>';echo $menu_sub_name;echo '</h3>
			<ul class="tab1">
				<li';if($method=='index'){echo ' class="current"';}echo '><a href="';echo $base_url;echo '&method=index"><span>数据库表列表</span></a></li>
				<li';if($method=='replaceAll'){echo ' class="current"';}echo '><a href="';echo $base_url;echo '&method=replaceAll"><span>批量替换字符</span></a></li>
				';if($method=='edit'){echo '
				<li class="current"><a href="';echo $base_url;echo '&edit=';echo $edit;echo '"><span>编辑数据表：';echo $edit;echo '</span></a></li>
				';}echo '
			</ul>
		</div>
	</div>
	<div class="floattopempty"></div>
	';if($method=='index'){echo '
	<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">
		<input type="hidden" name="hash" value="';echo $sys_hash;echo '" />
		<table class="tb tb2 fixpadding">
			<tr class="header">
				<th>删？</th>
				<th>表名</th>
				<th></th>
			</tr>
			';if($list){foreach($list as $k=>$v){echo '
			<tr class="hover">
				<td><input type="checkbox" name="del[]" value="';echo $v['table0'];echo '" /></td>
				<td>';echo $v['table1'];echo '</td>
				<td>[<a href="';echo $base_url;echo '&edit=';echo $v['table0'];echo '">详情</a>][<a href="';echo $base_url;echo '&replace=';echo $v['table0'];echo '">替换字符串</a>]</td>
			</tr>
			';}}echo '
			<tr>
				<td></td>
				<td><input type="submit" class="btn" value="提交" /></td>
				<td></td>
			</tr>
		</table>
	</form>
	';}elseif($method=='edit'){echo '
	<pre>';echo $create_info;echo '</pre>
	';}elseif($method=='replace'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr><td class="partition" colspan="3">请慎用，使用前最好先备份一下数据库表</td></tr><tr class="hover"><td width="72" align="right" valign="top"></td><td width="450"></td><td id="_tip"></td></tr><tr class="hover"><td width="72" align="right" valign="top">源字符串</td><td width="450"><textarea name="source" id="source" class="tarea" preg="null=请输入要替换的字符串">';echo htmlspecialchars($source);echo '</textarea></td><td id="source_tip"></td></tr><tr class="hover"><td width="72" align="right" valign="top">目标字符串</td><td width="450"><textarea name="destination" id="destination" class="tarea" preg="null=请输入想要替换为的字符串">';echo htmlspecialchars($destination);echo '</textarea></td><td id="destination_tip"></td></tr><tr><td></td><td colspan="2"><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
	';}elseif($method=='replaceAll'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr><td class="partition" colspan="3">请慎用，使用前最好先备份一下数据库表</td></tr><tr class="hover"><td width="72" align="right" valign="top"></td><td width="450"></td><td id="_tip"></td></tr><tr class="hover"><td width="72" align="right" valign="top">源字符串</td><td width="450"><textarea name="source" id="source" class="tarea" preg="null=请输入要替换的字符串">';echo htmlspecialchars($source);echo '</textarea></td><td id="source_tip"></td></tr><tr class="hover"><td width="72" align="right" valign="top">目标字符串</td><td width="450"><textarea name="destination" id="destination" class="tarea" preg="null=请输入想要替换为的字符串">';echo htmlspecialchars($destination);echo '</textarea></td><td id="destination_tip"></td></tr><tr><td></td><td colspan="2"><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
	';}echo '
</div>
';echo '</body>
</html>';?>