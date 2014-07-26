<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\sys_base.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\sys_base.htm','D:\damaihu\xinyupingtai7\cache\default\founder\sys_base.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
				<th colspan="3" class="partition">';echo $menu_sub_name;echo '</th>
			</tr>
			';if($base_list){foreach($base_list as $k=>$v){echo '
			<tr>
				<th valign="top" style="text-align:right">';if(is_array($v['0'])){echo '';echo $v['0']['name'];echo '';}else{echo '';echo $v['0'];echo '';}echo '：</th>
				<td>
					';if(is_array($v['0'])&&$v['0']['name']){echo '
					';if($v['0']['type']=='textarea'){echo '
					<textarea name="';echo $k;echo '" rows="6" cols="60"';if($v['0']['style']){echo ' style="';echo $v['0']['style'];echo '"';}echo '>';echo $base[$k]?htmlspecialchars($base[$k]):$v[2];echo '</textarea>
					';}elseif($v['0']['type']=='radio'){echo '
					';if($v['0']['values']){foreach($v['0']['values'] as $k2=>$v2){echo '
					';if($v2==='br'){echo '
					<br />
					';}else{echo '
					<label><input type="radio" name="';echo $k;echo '" value="';echo $v2;echo '"';if((isset($base[$k])&&$base[$k]==$v2)||(!isset($base[$k])&&$v['0']['default']==$v2)){echo ' checked';}echo ' />';echo $k2;echo '</label>
					';}echo '
					';}}echo '
					';}else{echo '
					<input type="text" name="';echo $k;echo '" value="';echo $base[$k]?htmlspecialchars($base[$k]):$v[2];echo '" />
					';}echo '
					';}else{echo '
					<input type="text" name="';echo $k;echo '" value="';echo $base[$k]?htmlspecialchars($base[$k]):$v[2];echo '" />
					';}echo '
				</td>
				<td>';echo $v[1];echo '</td>
			</tr>
			';}}echo '
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