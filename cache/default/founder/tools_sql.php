<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\tools_sql.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\tools_sql.htm','D:\damaihu\xinyupingtai7\cache\default\founder\tools_sql.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<div class="container">
	<div class="floattop">
		<div class="itemtitle">
			<h3>';echo $menu_sub_name;echo '</h3>
			<ul class="tab1">
				<li';if($method=='index'){echo ' class="current"';}echo '><a href="';echo $base_url;echo '&method=index"><span>已创建SQL</span></a></li>
				<li';if($method=='create'){echo ' class="current"';}echo '><a href="';echo $base_url;echo '&method=create"><span>创建SQL</span></a></li>
			</ul>
		</div>
	</div>
	<div class="floattopempty"></div>
	';if($method=='index'){echo '
	<table class="tb tb2 fixpadding">
			<tr class="header">
				<th>备注</th>
				<th></th>
			</tr>
			';if($list){foreach($list as $v){echo '
			<tr class="hover">
				<td>';echo $v['name'];echo '</td>
				<td>[<a href="';echo $base_url;echo '&create=';echo $v['id'];echo '">创建</a>][<a href="';echo $base_url;echo '&edit=';echo $v['id'];echo '">编辑</a>][<a href="';echo $base_url;echo '&del=';echo $v['id'];echo '">删除</a>]</td>
			</tr>
			';}}echo '
		</table>
	';}elseif($method=='create'){echo '
	<script language="javascript">
	$(function(){';echo '
		var add_f=function(name){';echo '
			$(\'#f\').append(\'<tr class="hover"><td align="right">标记“\'+name+\'”的描述：</td><td><input type="text" name="\'+name+\'" /></td></tr>\');
		';echo '}
		$(\'#btn_ini\').click(function(){';echo '
			$(\'#f\').children().each(function(){';echo '$(this).remove();';echo '});
			var matches=$(\'#sql\').val().match(/\\{';echo '([a-zA-Z0-9_]+)\\';echo '}/g);
			if(matches){';echo '
				var tagLog = \'\';
				for(var i=0;i<matches.length;i++){';echo '
					if(matches[i]!==\'{';echo 'pre';echo '}\') {';echo '
						var tagName = matches[i].substring(1,matches[i].length-1);
						if (tagLog.indexOf(tagName+\'|\') == -1){';echo '
							add_f(tagName);
							tagLog += tagName+\'|\';
						';echo '}
					';echo '}
				';echo '}
			';echo '}
		';echo '});
	';echo '})
	</script>
	<form method="post" enctype="application/x-www-form-urlencoded">
		<input type="hidden" name="hash" value="';echo $sys_hash;echo '" />
		';if($edit){echo '<input type="hidden" name="is_edit" value="yes" />';}echo '
		<table class="tb tb2 fixpadding">
			<tr>
				<td colspan="2" class="tipsblock">
					<ul id="tipslis">
						<li>需要填写的名字用“{';echo '”+标记+“';echo '}”，如：{';echo 'name';echo '}</li>
						<li>例：create table {';echo 'name';echo '}(`id` int unsigned not null,`title` varchar(74),primary key(`id`))</li>
						<li>数据库表前缀为：“';echo $pre;echo '”可以用{';echo 'pre';echo '}代替</li>
					</ul></td>
			</tr>
			<tr class="hover">
				<td valign="top" align="right" width="150">备注：</td>
				<td><input type="text" name="name" value="';echo $item['name'];echo '" /></td>
			</tr>
			<tr class="hover">
				<td valign="top" align="right" width="150">SQL语句：</td>
				<td><textarea cols="120" rows="12" id="sql" name="sql">';echo htmlspecialchars($item['sql']);echo '</textarea></td>
			</tr>
			<tbody id="f">
			';if($args){foreach($args as $k=>$v){echo '
				<tr class="hover">
					<td align="right">标记“';echo $k;echo '”的描述：</td><td><input type="text" name="';echo $k;echo '" value="';echo $v;echo '" /></td>
				</tr>
			';}}echo '
			</tbody>
			<tr>
				<td></td>
				<td><input type="submit" value="';if($edit){echo '编辑';}else{echo '添加';}echo '" class="btn" /><input type="button" value="初始化" id="btn_ini" class="btn" /></td>
			</tr>
		</table>
	</form>
	';}elseif($method=='create2'){echo '
	<form method="post" enctype="application/x-www-form-urlencoded">
		<input type="hidden" name="hash" value="';echo $sys_hash;echo '" />
		';if($edit){echo '<input type="hidden" name="is_edit" value="yes" />';}echo '
		<table class="tb tb2 fixpadding">
			<tr>
				<th colspan="4" class="partition">执行“';echo $item['name'];echo '”</th>
			</tr>
			';if($args){foreach($args as $k=>$v){echo '
				<tr class="hover">
					<td align="right">';echo $v;echo '：</td><td><input type="text" name="';echo $k;echo '" value="" class="txt" style="width:200px" /></td>
				</tr>
			';}}echo '
			<tr>
				<td></td>
				<td><input type="submit" value="执行" class="btn" /></td>
			</tr>
		</table>
	</form>
	';}echo '
</div>
';echo '</body>
</html>';?>