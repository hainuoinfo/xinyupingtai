<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\data_block.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\data_block.htm','D:\damaihu\xinyupingtai7\cache\default\founder\data_block.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
			';if($method=='index'){echo '
				';if($look){echo '
					<h3>';echo $cate['name'];echo '数据模块</h3>
					<ul class="tab1">
						<li><a href="';echo $base_url;echo '&method=';echo $method;echo '"><span>数据模块分类列表</span></a></li>
						<li';if(!$type){echo ' class="current"';}echo '><a href="';echo $base_url;echo '&method=';echo $method;echo '&look=';echo $look;echo '"><span>';echo $cate['name'];echo '数据模块</span></a></li>
						<li';if($type=='add'){echo ' class="current"';}echo '><a href="';echo $base_url;echo '&method=';echo $method;echo '&look=';echo $look;echo '&type=add"><span>添加';echo $cate['name'];echo '数据模块</span></a></li>
					</ul>
				';}else{echo '
			<h3>';echo $menu_sub_name;echo '</h3>
			<ul class="tab1">
				<li';if($method=='index'){echo ' class="current"';}echo '><a href="';echo $base_url;echo '"><span>数据模块分类列表</span></a></li>
				<li';if($method=='add_cate'){echo ' class="current"';}echo '><a href="';echo $base_url;echo '&method=add_cate"><span>添加分类</span></a></li>
			</ul>
				';}echo '
			';}elseif($method=='add_cate'){echo '
			<h3>';echo $menu_sub_name;echo '</h3>
			<ul class="tab1">
				<li class="current"><a href="';echo $base_url;echo '&method=';echo $method;echo '"><span>添加数据模块分类</span></a></li>
				<li><a href="';echo $base_url;echo '&method=index"><span>数据模块分类列表</span></a></li>
			</ul>
			';}echo '
		</div>
	</div>
	<div class="floattopempty"></div>
	';switch($method){case 'index':echo '
	';if($look){echo '
		';if($type=='add'){echo '
		<form name="cpform" method="post" id="cpform" >
		';echo $sys_hash_code;echo '
			<table class="tb tb2 fixpadding">
				<tr class="hover">
					<th width="60">分类名：</th>
					<td width="80"><input type="text" class="txt" name="name" id="name" value="';echo $item['name'];echo '" preg="null=请输入分类名" /></td>
					<td><span id="name_tip"></span></td>
				</tr>
				<tr class="hover">
					<th width="60">调用标记：</th>
					<td width="80"><input type="text" class="txt" name="marker" id="marker" value="';echo $item['marker'];echo '" preg="null=请输入模块调用标记" /></td>
					<td><span id="marker_tip"></span></td>
				</tr>
				<tr class="hover">
					<th width="60" valign="top">模块数据：</th>
					<td width="80"><textarea name="data" id="data" rows="20" cols="120">';echo htmlspecialchars($item['data']);echo '</textarea></td>
					<td><span id="data_tip"></span></td>
				</tr>
				<tr class="hover">
					<th width="60" valign="top"></th>
					<td width="80"><input type="submit" value="';if($edit){echo '编辑';}else{echo '添加';}echo '" class="btn" /></td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</form>
		';}else{echo '
		<form method="post" enctype="application/x-www-form-urlencoded">
		';echo $sys_hash_code;echo '
			<table class="tb tb2 fixpadding">
				<tr class="header">
					<th>删？</th>
					<th>排序</th>
					<th>模块名</th>
					<th>模块标记</th>
					<th>添加时间</th>
					<th>修改时间</th>
					<th></th>
				</tr>
				';if($list){foreach($list as $k=>$v){echo '
				<tr class="hover">
					<td><input type="hidden" name="ids[]" value="';echo $v['id'];echo '" /><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" /></td>
					<td><input type="text" name="sort[]" value="';echo $v['sort'];echo '"  size="3"/></td>
					<td>';echo $v['name'];echo '</td>
					<td>';echo $v['marker'];echo '</td>
					<td>';echo date('Y-m-d H:i:s',$v['add_timestamp']);echo '</td>
					<td>';echo date('Y-m-d H:i:s',$v['edit_timestamp']);echo '</td>
					<td><a href="';echo $base_url;echo '&method=';echo $method;echo '&look=';echo $look;echo '&edit=';echo $v['id'];echo '" class="act">编辑</a></td>
					<td></td>
				</tr>
				';}}echo '
				<tr>
					<td colspan="7" align="center">';echo $multipage;echo '</td>
				</tr>
				<tr>
					<td colspan="7">
						<div class="fixsel">
							<input type="submit" class="btn" id="submit_tasksubmit" name="tasksubmit" title="按 Enter 键可随时提交您的修改" value="提交" />
						</div></td>
				</tr>
				
			</table>
		</form>
		';}echo '
	';}else{echo '
	<form method="post" enctype="application/x-www-form-urlencoded">
	';echo $sys_hash_code;echo '
		<table class="tb tb2 fixpadding">
			<tr class="header">
				<th>删？</th>
				<th>排序</th>
				<th>名称</th>
				<th>模块数</th>
				<th></th>
			</tr>
			';if($list){foreach($list as $k=>$v){echo '
			<tr class="hover">
				<td><input type="hidden" name="ids[]" value="';echo $v['id'];echo '" /><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" /></td>
				<td><input type="text" name="sort[]" value="';echo $v['sort'];echo '"  size="3"/></td>
				<td>';echo $v['name'];echo '</td>
				<td>';echo $v['count'];echo '</td>
				<td>[<a href="';echo $base_url;echo '&method=';echo $method;echo '&look=';echo $v['id'];echo '" class="act">查看</a>][<a href="';echo $base_url;echo '&method=';echo $method;echo '&edit=';echo $v['id'];echo '" class="act">编辑</a>]</td>
				<td></td>
			</tr>
			';}}echo '
			<tr>
				<td colspan="5"><div class="fixsel">
						<input type="submit" class="btn" id="submit_tasksubmit" name="tasksubmit" title="按 Enter 键可随时提交您的修改" value="提交" />
					</div></td>
			</tr>
			
		</table>
	</form>
	';}echo '
	';break;case 'add_cate':echo '
	<form name="cpform" method="post" id="cpform" >
	';echo $sys_hash_code;echo '
	';if($edit){echo '<input type="hidden" name="is_edit" value="yes" />';}echo '
		<table class="tb tb2 fixpadding">
			<tr class="hover">
				<th width="60">分类名：</th>
				<td width="80"><input type="text" class="txt" name="name" id="name" value="';echo $name;echo '" preg="null=请输入分类名" /></td>
				<td width="60"><input type="submit" value="';if($edit){echo '编辑';}else{echo '添加';}echo '" class="btn" /></td>
				<td><span id="name_tip"></span></td>
			</tr>
			
		</table>
	</form>
	';break;}echo '
</div>
';echo '</body>
</html>';?>