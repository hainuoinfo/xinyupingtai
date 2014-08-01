<?php $_tplModify=filemtime('D:\xinyupingtai\cache\default\founder\log_users.php');if(filemtime('D:\xinyupingtai\templates\default\founder\h.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\founder\f.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\xinyupingtai\templates\default\founder\log_users.htm','D:\xinyupingtai\cache\default\founder\log_users.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<script type="text/javascript" src="http://d.hainuo.info/javascript/jquery.min.js"></script><script type="text/javascript" src="http://d.hainuo.info/javascript/form_hack.js"></script>
<link href="http://d.hainuo.info/css/founder/founder.css" rel="stylesheet" type="text/css" /><script type="text/javascript" src="http://d.hainuo.info/javascript/common.func.js"></script>
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
';if($method=='credits'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>用户名</th><th>积分</th><th>时间</th><th>备注</th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['username'];echo '</td><td>';echo $v['val'];echo '</td><td>';echo date('Y-m-d H:i:s',$v['timestamp']);echo '</td><td>';echo $v['remark'];echo '</td></tr>';}}echo '<tr><td colspan="5"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="5">';echo $multipage;echo '</td></tr><tr><td colspan="5"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='money'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>用户名</th><th>金钱</th><th>时间</th><th>备注</th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['username'];echo '</td><td>';echo $v['val'];echo '</td><td>';echo date('Y-m-d H:i:s',$v['timestamp']);echo '</td><td>';echo $v['remark'];echo '</td></tr>';}}echo '<tr><td colspan="5"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="5">';echo $multipage;echo '</td></tr><tr><td colspan="5"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='fabudian'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>用户名</th><th>发布点</th><th>时间</th><th>备注</th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['username'];echo '</td><td>';echo $v['val'];echo '</td><td>';echo date('Y-m-d H:i:s',$v['timestamp']);echo '</td><td>';echo $v['remark'];echo '</td></tr>';}}echo '<tr><td colspan="5"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="5">';echo $multipage;echo '</td></tr><tr><td colspan="5"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='vipLog'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>用户名</th><th>申请月数</th><th>申请时间</th><th>是否自动续费</th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['username'];echo '</td><td>';echo $v['month'];echo '</td><td>';echo date('Y-m-d H:i:s',$v['timestamp']);echo '</td><td>';if($v['auto']){echo '是';}else{echo '否';}echo '</td></tr>';}}echo '<tr><td colspan="5"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="5">';echo $multipage;echo '</td></tr><tr><td colspan="5"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='ensureLog'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>用户名</th><th>担保金</th><th>备注</th><th>变化时间</th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['username'];echo '</td><td>';echo $v['money'];echo '</td><td>';echo $v['remark'];echo '</td><td>';echo date('Y-m-d H:i:s',$v['timestamp']);echo '</td></tr>';}}echo '<tr><td colspan="5"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="5">';echo $multipage;echo '</td></tr><tr><td colspan="5"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}echo '
';echo '</div>
';echo '</body>
</html>';?>