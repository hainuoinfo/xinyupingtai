<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\bbs_icon.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\h.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\f.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\bbs_icon.htm','D:\damaihu\xinyupingtai7\cache\default\founder\bbs_icon.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	$(\'input\').each(function(){';echo '
		if(\'radio|checkbox|\'.indexOf($(this).attr(\'type\')+\'|\')>=0){';echo '
			if($(this).parent().attr(\'tagName\')==\'LI\'){';echo '
				$(this).click(function(){';echo '
					$(this).parent().parent().find(\'li.checked\').removeClass(\'checked\');
					$(this).parent().addClass(\'checked\');
				';echo '});
			';echo '}
		';echo '}
	';echo '});
';echo '});
</script>
<div class="container" id="cpcontainer">
	<div class="floattop">
		<div class="itemtitle">
			<h3>';echo $menu_sub_name;echo '</h3>
			<ul class="tab1">
				';if($top_menu){foreach($top_menu as $k=>$v){echo '
				';if(!is_array($v)||$v['hide']===false||$k==$method){echo '
				<li';if($k==$method){echo ' class="current"';}echo '>
					';if(is_array($v)){echo '
						';if(!empty($v['url'])){echo '
						<a href="';echo $v['url'];echo '"><span>';echo $v['name'];echo '</span></a>
						';}else{echo '
						<a href="';if($v['hide']){echo '';echo $nowurl;echo '';}else{echo '';echo $base_url;echo '&method=';echo $k;echo '';if($v['attach']){echo '';echo $v['attach'];echo '';}echo '';}echo '"><span>';echo $v['name'];echo '</span></a>
						';}echo '
					';}else{echo '
						<a href="';echo $base_url;echo '&method=';echo $k;echo '"><span>';echo $v;echo '</span></a>
					';}echo '
					
				</li>
				';}echo '
				';}}echo '
			</ul>
		</div>
	</div>
	<div class="floattopempty"></div>';echo '
';if($method=='index'){echo '
<script language="javascript">
var add = function(){';echo '
	$(\'#tbList\').append(\'<tr class="hover"><td></td><td><input type="text" name="sort[]" class="txt" style="width:36px" /></td><td><input type="text" name="icon[]" class="txt" style="width:240px" /></td><td><input type="text" name="title[]" class="txt" /></td><td><a href="javascript:" onclick="$(this).parent().parent().remove()">移除</a></td></tr>\');
';echo '};
</script>
<form method="post" enctype="application/x-www-form-urlencoded">
';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding">
		<tr>
			<th colspan="5" class="partition">提示</th>
		</tr>
		<tr>
			<td colspan="5" class="tipsblock"><ul id="tipslis">
					<li>一旦设定好以后不要轻易改变顺序</li>
				</ul></td>
		</tr>
		
		<tr class="header">
			<th>ID</th>
			<th>排序</th>
			<th>图标</th>
			<th>名称</th>
			<th>&nbsp;</th>
		</tr>
		';if($icons){foreach($icons as $k=>$v){echo '
		<tr class="hover">
			<td>';echo $k+1;echo '</td>
			<td><input type="text" name="sort[]" value="';echo $v['sort'];echo '" class="txt" style="width:36px" /></td>
			<td><input type="text" name="icon[]" class="txt" value="';echo $v['icon'];echo '" style="width:240px" />';if($v['icon']){echo '<img src="';echo $v['icon'];echo '" />';}echo '</td>
			<td><input type="text" name="title[]" class="txt" value="';echo $v['title'];echo '" /></td><td><a href="javascript:" onclick="$(this).parent().parent().remove()">移除</a></td>
		</tr>
		';}}echo '
		<tbody id="tbList">
			
		</tbody>
		<tr>
			<td><a href="javascript:;" onclick="add()">添加一个图标</a></td>
			<td colspan="4"><input type="submit" value="提交" class="btn" /></td>
		</tr>
	</table>
</form>
';}echo '
';echo '</div>
';echo '</body>
</html>';?>