<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\tools_database.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\tools_database.htm','D:\damaihu\xinyupingtai7\cache\default\founder\tools_database.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
				<li';if($method=='sql'){echo ' class="current"';}echo '><a href="';echo $base_url;echo '&method=sql"><span>SQL工具</span></a></li>
				<li';if($method=='import'){echo ' class="current"';}echo '><a href="';echo $base_url;echo '&method=import"><span>导入备份</span></a></li>
				<li';if($method=='export'){echo ' class="current"';}echo '><a href="';echo $base_url;echo '&method=export"><span>备份数据</span></a></li>
			</ul>
		</div>
	</div>
	<div class="floattopempty"></div>
	';if($method=='sql'){echo '
<script language="javascript">
var sql_create_table=function(){';echo '
	var sql=$(\'#sql\').val();
	if(sql!=\'\'){';echo '
		if(sql.substr(sql.length-1,1)!=\';\')sql+=\';\';
		sql+=\'\\n\';
	';echo '}
	$(\'#sql\').val(sql+\'CREATE TABLE `';echo $config['db_table_pre'];echo 'table_name` (\\n\\t`id` int unsigned not null auto_increment,\\n\\t`column_name` column_type,\\n\\tPRIMARY KEY (`id`)\\n) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;\');
';echo '}
var post_sql=function(sql){';echo '
	if (sql != void(0))$(\'#sql\').val(sql);
	$(\'#form1\').submit();
';echo '}
var sql_show_tables=function(){';echo '
	$(\'#sql\').val(\'show tables;\');
	post_sql();
	
';echo '}
var sql_show_databases=function(){';echo '
	$(\'#sql\').val(\'show databases;\');
	post_sql();
';echo '}
var sql_create_user=function(){';echo '
	$(\'#sql\').val(\'grant all privileges on db_name.';echo $config['db_table_pre'];echo 'table_name to \\\'username\\\'@\\\'localhost\\\' identified by \\\'password\\\'/*创建用户*/;\');
';echo '}
var sql_drop_user=function(){';echo '
	$(\'#sql\').val(\'drop user \\\'username\\\'@\\\'localhost\\\'/*删除用户*/;\');
';echo '};
$.ajaxSetup({';echo 'cache:false';echo '});
var sqlList = ';echo string::json_encode($sqlList1);echo ';
$(function(){';echo '
	$(\'#addSql\').click(function(){';echo '
		var saveName = $(\'#saveName\').val().replace(/^\\s+|\\s+$/g, \'\');
		var sql      = $(\'#sql\').val().replace(/^\\s+|\\s+$/g, \'\');
		if (!saveName) {';echo '
			alert(\'请输入保存的名字\');
			return;
		';echo '}
		if (!sql) {';echo '
			alert(\'请输入要保存的SQL\');
		';echo '}
		$.ajax({';echo '
			type:\'post\',
			url:\'';echo $weburl2;echo 'ajax/sql.php?action=data&operation=save\',
			data:\'hash=\'+encodeURI(\'';echo $sys_hash;echo '\')+\'&name=\'+encodeURI(saveName)+\'&sql=\'+encodeURI(sql),
			dataType:\'json\',
			success:function(json){';echo '
				if (json.err) alert(err);
				else if (json.status) {';echo '
					$(\'#sqlList\').append(\'<option value="\'+json.id+\'">\'+saveName+\'</option>\');
					sqlList[json.id] = sql;
					alert(\'添加成功\');
				';echo '} else alert(\'未知错误\');
			';echo '},
			error:function(){';echo '
				alert(\'添加失败，请重试！\');
			';echo '}
		';echo '});
	';echo '});
	$(\'#sqlList\').change(function(){';echo '
		if ($(this).val() != \'\') {';echo '
			var id = $(this).val();
			var sql = sqlList[id];
			post_sql(sql);
		';echo '}
	';echo '});
';echo '});
</script>
<form method="post" enctype="application/x-www-form-urlencoded" id="form1">
<input type="hidden" name="exesql" value="yes" />
<input type="hidden" name="hash" value="';echo $sys_hash;echo '" />
	<table class="tb tb2 fixpadding">
		<tr class="hover">
			<td><textarea name="sql" cols="100" rows="10" id="sql">';echo htmlspecialchars($sql);echo '</textarea></td>
		</tr>
		<tr class="hover">
			<td><input type="submit" name="Submit2" value="执行" class="btn" />
					<input type="button" value="创建表" onclick="sql_create_table()" class="btn" />
					<input type="button" value="显示所有表" onclick="sql_show_tables()" class="btn" />
					<input type="button" value="显示所有数据库" onclick="sql_show_databases()" class="btn" />
					<input type="button" value="创建用户" onclick="sql_create_user()" class="btn" />
					<input type="button" value="删除用户" onclick="sql_drop_user()" class="btn" />
			</td>
		</tr>
		<tr class="hover">
			<td>
				SQL保存为：<input type="text" id="saveName" class="txt" style="width:120px" maxlength="32" /><input type="button" value="添加" class="btn" id="addSql" />&nbsp;
				快捷SQL：<select id="sqlList">
					<option value="">请选择要执行的SQL</option>
					';if($sqlList2){foreach($sqlList2 as $k=>$v){echo '
					<option value="';echo $k;echo '">';echo $v;echo '</option>
					';}}echo '
				</select>
			</td>
		</tr>
		<tr class="hover">
			<td><div style="width: 620px;border: 1px solid #CCCCCC;overflow-y: scroll;height: 200px;white-space: pre;">';echo $show_result;echo '</div></td>
		</tr>
	</table>
</form>
';}elseif($method=='import'){echo '
';if(!$complate){echo '
<table width="100%" class="tb tb2 fixpadding">
	<tr class="header">
		<th>文件名</th>
		<th>文件大小</th>
		<th>最后修改时间</th>
		<th></th>
	</tr>
	';if($sql_file_list){foreach($sql_file_list as $v){echo '
	<tr class="hover">
		<td><a href="';echo $base_url;echo '&download=';echo urlencode($v['name']);echo '" title="下载">';echo $v['name'];echo '</a></td>
		<td>';echo $v['file_size'];echo 'Byte</td>
		<td>';echo $v['filemtime'];echo '</td>
		<td>[<a href="';echo $nowurl;echo '&import=';echo urlencode($v['name']);echo '&encoding=gbk">导入GBK</a>][<a href="';echo $nowurl;echo '&import=';echo urlencode($v['name']);echo '&encoding=utf-8">导入UTF-8</a>][<a href="';echo $nowurl;echo '&del=';echo urlencode($v['name']);echo '">删除</a>]</td>
	</tr>
	';}}echo '
</table>
';}else{echo '
<div>成功导入：';echo $import;echo '</div>
';}echo '
';}elseif($method=='export'){echo '
';if(!$complate){echo '
<style type="text/css">
.tables{';echo 'width:600px;clear:both';echo '}
.tables li{';echo 'width:200px;float:left;height:25px;line-height:25px;';echo '}
</style>
<form method="post" enctype="application/x-www-form-urlencoded">
<table class="tb tb2 fixpadding">
	<tr class="hover">
		<td align="right">备份名称：</td>
		<td align="left">./<input type="text" name="save_name" value="';echo date('Y-m-d H_i_s',$timestamp);echo '" class="txt" style="width:200px" />.sql</td>
	</tr>
	<tr class="hover">
		<td valign="top" align="right">要备份的表：</td>
		<td align="left"><input type="checkbox" id="back_all" checked onclick="check_all(this,\'backup_tables[]\')" class="checkbox" /><label for="bach_all">全部</label>
			<ul class="tables">
				';if($tables){foreach($tables as $v){echo '
				<li><input type="checkbox" value="';echo $v;echo '" name="backup_tables[]" id="';echo $v;echo '" checked class="checkbox" /><label for="';echo $v;echo '">';echo $v;echo '</label></li>
				';}}echo '
			</ul>
		</td>
	</tr>
	<tr>
		<td></td>
		<td align="left"><input type="submit" value="提交" class="btn" /></td>
	</tr>
</table>
</form>
';}else{echo '
<div>备份成功：./data/sql/backup/';echo $complate;echo '.sql</div>
';}echo '
';}echo '

</div>
';echo '</body>
</html>';echo '
';?>