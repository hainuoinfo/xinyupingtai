<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\i_bs.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\h.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\f.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\i_bs.htm','D:\damaihu\xinyupingtai7\cache\default\founder\i_bs.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<script language="javascript">
var _stop=function(){';echo 'return confirm(\'确定要挂起吗？\');';echo '}
var _unstop=function(){';echo 'return confirm(\'确定要恢复挂起吗？\');';echo '}
var _lock=function(){';echo 'return confirm(\'确定要锁定吗？\');';echo '}
var _unlock=function(){';echo 'return confirm(\'确定要恢复锁定吗？\');';echo '}
var _undel=function(){';echo 'return confirm(\'确定要恢复该删除帐号吗？\');';echo '}
</script>
<form method="post">
';echo $sys_hash_code;echo '
<input type="hidden" name="m" value="search" />
	<table class="tb tb2 fixpadding">
		<tr>
			<td width="60" align="right">昵称</td>
			<td width="100"><input name="nickname" id="nickname" value="';echo $nickname;echo '" maxlength="16" class="txt" style="width:100px" /></td>
			<td><input type="submit" value="搜索" class="btn" /></td>
		</tr>
	</table>
</form>
';if($method=='buyers1'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>昵称</th><th>密码</th><th>所属用户</th><th>初始信誉</th><th>当前信誉</th><th>寿命值</th><th>正在进行任务</th><th>已经完成任务</th><th>状态</th><th></th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['nickname'];echo '</td><td>';echo $v['password'];echo '</td><td>';echo $v['username'];echo '</td><td>';echo $v['score0'];echo '</td><td>';echo $v['score'];echo '</td><td>';echo $v['maxScore'];echo '</td><td>';echo $v['tasking'];echo '</td><td>';echo $v['task'];echo '</td><td>';echo $buyerStatus[$v['status']];echo '</td><td>';if($v['status']!=3&&$v['status']!=7&&$v['tasking']==0){echo '';if($v['status']!=2){echo '[<a href="';echo $base_url;echo '&stop=';echo $v['id'];echo '" onclick="return _stop()">挂起</a>]';}elseif($v['status']==2){echo '[<a href="';echo $base_url;echo '&unstop=';echo $v['id'];echo '" onclick="return _unstop()">恢复挂起</a>]';}echo '';if($v['status']!=4){echo '[<a href="';echo $base_url;echo '&lock=';echo $v['id'];echo '" onclick="return _lock()">锁定</a>]';}elseif($v['status']==4){echo '[<a href="';echo $base_url;echo '&unlock=';echo $v['id'];echo '" onclick="return _unlock()">恢复锁定</a>]';}echo '';}echo '';if($v['status']==7){echo '[<a href="';echo $base_url;echo '&undel=';echo $v['id'];echo '" onclick="return _del()">恢复删除</a>]';}echo '</td></tr>';}}echo '<tr><td colspan="11"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="11">';echo $multipage;echo '</td></tr><tr><td colspan="11"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='buyers2'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>昵称</th><th>密码</th><th>所属用户</th><th>初始信誉</th><th>当前信誉</th><th>寿命值</th><th>正在进行任务</th><th>已经完成任务</th><th>状态</th><th></th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['nickname'];echo '</td><td>';echo $v['password'];echo '</td><td>';echo $v['username'];echo '</td><td>';echo $v['score0'];echo '</td><td>';echo $v['score'];echo '</td><td>';echo $v['maxScore'];echo '</td><td>';echo $v['tasking'];echo '</td><td>';echo $v['task'];echo '</td><td>';echo $buyerStatus[$v['status']];echo '</td><td>';if($v['status']!=3&&$v['status']!=7&&$v['tasking']==0){echo '';if($v['status']!=2){echo '[<a href="';echo $base_url;echo '&stop=';echo $v['id'];echo '" onclick="return _stop()">挂起</a>]';}elseif($v['status']==2){echo '[<a href="';echo $base_url;echo '&unstop=';echo $v['id'];echo '" onclick="return _unstop()">恢复挂起</a>]';}echo '';if($v['status']!=4){echo '[<a href="';echo $base_url;echo '&lock=';echo $v['id'];echo '" onclick="return _lock()">锁定</a>]';}elseif($v['status']==4){echo '[<a href="';echo $base_url;echo '&unlock=';echo $v['id'];echo '" onclick="return _unlock()">恢复锁定</a>]';}echo '';}echo '';if($v['status']==7){echo '[<a href="';echo $base_url;echo '&undel=';echo $v['id'];echo '" onclick="return _del()">恢复删除</a>]';}echo '</td></tr>';}}echo '<tr><td colspan="11"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="11">';echo $multipage;echo '</td></tr><tr><td colspan="11"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='buyers3'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>昵称</th><th>密码</th><th>所属用户</th><th>初始信誉</th><th>当前信誉</th><th>寿命值</th><th>正在进行任务</th><th>已经完成任务</th><th>状态</th><th></th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['nickname'];echo '</td><td>';echo $v['password'];echo '</td><td>';echo $v['username'];echo '</td><td>';echo $v['score0'];echo '</td><td>';echo $v['score'];echo '</td><td>';echo $v['maxScore'];echo '</td><td>';echo $v['tasking'];echo '</td><td>';echo $v['task'];echo '</td><td>';echo $buyerStatus[$v['status']];echo '</td><td>';if($v['status']!=3&&$v['status']!=7&&$v['tasking']==0){echo '';if($v['status']!=2){echo '[<a href="';echo $base_url;echo '&stop=';echo $v['id'];echo '" onclick="return _stop()">挂起</a>]';}elseif($v['status']==2){echo '[<a href="';echo $base_url;echo '&unstop=';echo $v['id'];echo '" onclick="return _unstop()">恢复挂起</a>]';}echo '';if($v['status']!=4){echo '[<a href="';echo $base_url;echo '&lock=';echo $v['id'];echo '" onclick="return _lock()">锁定</a>]';}elseif($v['status']==4){echo '[<a href="';echo $base_url;echo '&unlock=';echo $v['id'];echo '" onclick="return _unlock()">恢复锁定</a>]';}echo '';}echo '';if($v['status']==7){echo '[<a href="';echo $base_url;echo '&undel=';echo $v['id'];echo '" onclick="return _del()">恢复删除</a>]';}echo '</td></tr>';}}echo '<tr><td colspan="11"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="11">';echo $multipage;echo '</td></tr><tr><td colspan="11"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='sellers1'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>昵称</th><th>所属用户</th><th>正在进行任务</th><th>已经完成任务</th><th>状态</th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['nickname'];echo '</td><td>';echo $v['username'];echo '</td><td>';echo $v['tasking'];echo '</td><td>';echo $v['task'];echo '</td><td>';echo $sellerStatus[$v['status']];echo '</td></tr>';}}echo '<tr><td colspan="6"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="6">';echo $multipage;echo '</td></tr><tr><td colspan="6"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='sellers2'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>昵称</th><th>所属用户</th><th>正在进行任务</th><th>已经完成任务</th><th>状态</th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['nickname'];echo '</td><td>';echo $v['username'];echo '</td><td>';echo $v['tasking'];echo '</td><td>';echo $v['task'];echo '</td><td>';echo $sellerStatus[$v['status']];echo '</td></tr>';}}echo '<tr><td colspan="6"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="6">';echo $multipage;echo '</td></tr><tr><td colspan="6"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='sellers3'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>昵称</th><th>所属用户</th><th>正在进行任务</th><th>已经完成任务</th><th>状态</th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['nickname'];echo '</td><td>';echo $v['username'];echo '</td><td>';echo $v['tasking'];echo '</td><td>';echo $v['task'];echo '</td><td>';echo $sellerStatus[$v['status']];echo '</td></tr>';}}echo '<tr><td colspan="6"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="6">';echo $multipage;echo '</td></tr><tr><td colspan="6"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}echo '
';echo '</div>
';echo '</body>
</html>';?>