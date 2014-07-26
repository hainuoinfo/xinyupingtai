<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\user_user.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\h.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\f.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\user_user.htm','D:\damaihu\xinyupingtai7\cache\default\founder\user_user.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<form method="post">
';echo $sys_hash_code;echo '
<input type="hidden" name="m" value="search" />
	<table class="tb tb2 fixpadding">
		<tr>
			<td width="60" align="right">用户名</td>
			<td width="100"><input name="username" id="username" value="';echo $username;echo '" maxlength="16" class="txt" style="width:100px" /></td>
			<td><input type="submit" value="搜索" class="btn" /></td>
		</tr>
	</table>
</form>
';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>用户名</th><th>所属用户组</th><th>注册时间</th><th>注册IP</th><th>最近登陆时间</th><th>最近登陆IP</th><th>是否禁用</th><th></th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['username'];echo '</td><td>';echo $userGroups2[$v['groupid']]['name'];echo '</td><td>';echo date('Y-m-d H:i:s',$v['reg_timestamp']);echo '</td><td>';echo common::intip($v['reg_ip']);echo '</td><td>';echo date('Y-m-d H:i:s',$v['last_login_timestamp']);echo '</td><td>';echo common::intip($v['last_login_ip']);echo '</td><td>';if($v['forbidden']){echo '<span style="color:red">是</span>(<a href="';echo $base_url;echo '&check=';echo $v['id'];echo '">可用</a>)';}else{echo '否(<a href="';echo $base_url;echo '&check=';echo $v['id'];echo '">禁用</a>)';}echo '</td><td>[<a href="';echo $base_url;echo '&view=';echo $v['id'];echo '">详情</a>]</td></tr>';}}echo '<tr><td colspan="9"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="9">';echo $multipage;echo '</td></tr><tr><td colspan="9"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='add'||$method=='edit'){echo '
';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr><td class="partition" colspan="3">注意：添加后就不要随便删掉</td></tr><tr class="hover"><td width="72" align="right" valign="top"></td><td width="450"></td><td id="_tip"></td></tr><tr class="hover"><td width="72" align="right" valign="top">用户组名称</td><td width="450"><input type="text" name="f_name" id="f_name" value="';echo $f_name;echo '" class="txt" style="width:240px" maxlength="32" preg="null=请输入用户组名称" /></td><td id="f_name_tip"></td></tr><tr class="hover"><td width="72" align="right" valign="top">用户组标记</td><td width="450"><input type="text" name="f_key" id="f_key" value="';echo $f_key;echo '" class="txt" style="width:240px" maxlength="32" preg="null=请输入用户组标记" /></td><td id="f_key_tip"></td></tr><tr><td></td><td colspan="2"><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='add_credits'){echo '
';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr class="hover"><td width="276" align="right" valign="top">注：如果要减掉用户积分的话，就把积分写成负数</td><td width="450"></td><td id="_tip"></td></tr><tr class="hover"><td width="276" align="right" valign="top">用户名</td><td width="450"><input type="text" name="username" id="username" value="';echo $username;echo '" class="txt" style="width:240px" maxlength="16" preg="null=请输入要增加的用户名" /></td><td id="username_tip"></td></tr><tr class="hover"><td width="276" align="right" valign="top">增加积分</td><td width="450"><input type="text" name="credits" id="credits" value="';echo $credits;echo '" class="txt" style="width:240px" preg="float=要增加的积分" /></td><td id="credits_tip"></td></tr><tr><td></td><td><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='add_money'){echo '
';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr class="hover"><td width="300" align="right" valign="top">注：如果要减掉用户RMB的话，就把RMB写成负数</td><td width="450"></td><td id="_tip"></td></tr><tr class="hover"><td width="300" align="right" valign="top">用户名</td><td width="450"><input type="text" name="username" id="username" value="';echo $username;echo '" class="txt" style="width:240px" maxlength="16" preg="null=请输入要余额的用户名" /></td><td id="username_tip"></td></tr><tr class="hover"><td width="300" align="right" valign="top">增加余额</td><td width="450"><input type="text" name="money" id="money" value="';echo $money;echo '" class="txt" style="width:240px" preg="float=要增加的余额" /></td><td id="money_tip"></td></tr><tr><td></td><td><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='add_fabudian'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr class="hover"><td width="300" align="right" valign="top">注：如果要减掉用户发布点的话，就把发布点写成负数</td><td width="450"></td><td id="_tip"></td></tr><tr class="hover"><td width="300" align="right" valign="top">用户名</td><td width="450"><input type="text" name="username" id="username" value="';echo $username;echo '" class="txt" style="width:240px" maxlength="16" preg="null=请输入要余额的用户名" /></td><td id="username_tip"></td></tr><tr class="hover"><td width="300" align="right" valign="top">增加发布点</td><td width="450"><input type="text" name="fabudian" id="fabudian" value="';echo $fabudian;echo '" class="txt" style="width:240px" preg="float=要增加的发布点" /></td><td id="fabudian_tip"></td></tr><tr class="hover"><td width="300" align="right" valign="top">要增加的区域</td><td width="450"><select name="type"><option value="1">淘宝区</option><option value="2">拍拍区</option></select></td><td id="type_tip"></td></tr><tr><td></td><td><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='minusPoint'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr><td class="partition" colspan="3">扣除用户发布掉</td></tr><tr class="hover"><td width="84" align="right" valign="top"></td><td width="450"></td><td id="_tip"></td></tr><tr class="hover"><td width="84" align="right" valign="top">用户名</td><td width="450"><input type="text" name="username" id="username" value="';echo $username;echo '" class="txt" style="width:240px" maxlength="16" preg="null=请输入要扣除发布点的用户名" /></td><td id="username_tip"></td></tr><tr class="hover"><td width="84" align="right" valign="top">扣除发布点</td><td width="450"><input type="text" name="count" id="count" value="';echo $count;echo '" class="txt" style="width:240px" maxlength="10" preg="null=请输入要扣除的发布点" /></td><td id="count_tip"></td></tr><tr class="hover"><td width="84" align="right" valign="top">要扣除的区域</td><td width="450"><select name="type"><option value="1">淘宝区</option><option value="2">拍拍区</option></select></td><td id="type_tip"></td></tr><tr class="hover"><td width="84" align="right" valign="top">扣除理由</td><td width="450"><textarea name="remark" id="remark" class="tarea">';echo htmlspecialchars($remark);echo '</textarea></td><td id="remark_tip"></td></tr><tr><td></td><td colspan="2"><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='view'){echo '
<form enctype="application/x-www-form-urlencoded" method="post" onsubmit="return confirm(\'确定吗？\')">
';echo $sys_hash_code;echo '
	<table class="tab_view">
		<tr class="tip">
			<td colspan="2">基本信息</td>
		</tr>
		<tr>
			<th>所属用户组</th>
			<td>
				<select name="groupid">
				';if($userGroups){foreach($userGroups as $v){echo '
				<option value="';echo $v['id'];echo '"';if($memberInfo['base']['groupid']==$v['id']){echo ' selected="selected"';}echo '>';echo $v['name'];echo '</option>
				';}}echo '
				</select>
			</td>
		</tr>
		<tr>
			<th><span style="color:red">所属快递</span></th>
			<td>
				<select name="expressId">
				<option value="0">无</option>
				';$query=$db->query("select id,name from {$pre}express order by sort");$_sqlList=array();while($line=$db->fetch_array($query))$_sqlList[]=$line;foreach($_sqlList as $k=>$v){echo '
				<option value="';echo $v['id'];echo '"';if($v['id']==$memberInfo['base']['expressId']){echo ' selected="selected"';}echo '>';echo $v['name'];echo '</option>
				';}echo '
				</select>
			</td>
		</tr>
		<tr>
			<th>是否禁用</th>
			<td>
				<label><input type="radio" name="forbidden" value="1"';if($memberInfo['base']['forbidden']==1){echo ' checked="checked"';}echo ' class="checkbox" />是</label>
				<label><input type="radio" name="forbidden" value="0"';if($memberInfo['base']['forbidden']==0){echo ' checked="checked"';}echo ' class="checkbox" />否</label>
			</td>
		</tr>
		<tr>
			<th>用户ID</th>
			<td>';echo $memberInfo['base']['id'];echo '</td>
		</tr>
		<tr>
			<th>用户名</th>
			<td>';echo $memberInfo['base']['username'];echo '</td>
		</tr>
		<tr class="tip">
			<td colspan="2">修改密码(不改请留空)</td>
		</tr>
		<tr>
			<th>登录密码</th>
			<td><input name="password" type="input" value="" /></td>
		</tr>
		<tr>
			<th>操作码</th>
			<td><input name="opt_password" type="input" value="" /></td>
		</tr>
		<tr>
			<th>积分</th>
			<td>';echo $memberInfo['attach']['credits'];echo '</td>
		</tr>
		<tr>
			<th>余额</th>
			<td>￥';echo $memberInfo['attach']['money'];echo '</td>
		</tr>
		<tr>
			<th>淘宝区发布点</th>
			<td>';echo $memberInfo['attach']['fabudian1'];echo '</td>
		</tr>
		<tr>
			<th>拍拍区发布点</th>
			<td>';echo $memberInfo['attach']['fabudian2'];echo '</td>
		</tr>
		<tr>
			<th>QQ</th>
			<td>';echo $memberInfo['base']['qq'];echo '</td>
		</tr>
		<tr>
			<th>E-Mail</th>
			<td>';echo $memberInfo['base']['email'];echo '</td>
		</tr>
		<tr>
			<th>手机</th>
			<td>';echo $memberInfo['base']['mobilephone'];echo '</td>
		</tr>
		<tr>
			<th>地址</th>
			<td>';echo $memberInfo['base']['address'];echo '</td>
		</tr>
		
		<tr class="tip">
			<td colspan="2">其它信息</td>
		</tr>
		<tr>
			<th>TA的推荐人</th>
			<td>';if($memberInfo['base']['parent']){echo '';echo member_base::getUsername($memberInfo['base']['parent']);echo '';}else{echo '无';}echo '</td>
		</tr>
		<tr>
			<th>TA推荐的总人数</th>
			<td>';echo $memberInfo['base']['child1'];echo '</td>
		</tr>
		<tr>
			<th>TA成功推荐的总人数</th>
			<td>';echo $memberInfo['base']['child2'];echo '</td>
		</tr>
		<tr>
			<th>注册时间</th>
			<td>';echo date('Y-m-d H:i:s',$memberInfo['base']['reg_timestamp']);echo '</td>
		</tr>
		<tr>
			<th>注册IP</th>
			<td>';echo common::intip($memberInfo['base']['ip']);echo '</td>
		</tr>
		<tr>
			<th>最后登陆时间</th>
			<td>';echo date('Y-m-d H:i:s',$memberInfo['base']['last_login_timestamp']);echo '</td>
		</tr>
		<tr>
			<th>最后登陆IP</th>
			<td>';echo common::intip($memberInfo['base']['last_login_ip']);echo '</td>
		</tr>
		<tr>
			<th>密码提问</th>
			<td>';if($memberInfo['base']['questionid']){echo '';echo $questions[$memberInfo['base']['questionid']];echo '';}else{echo '未设置';}echo '</td>
		</tr>
		';if($memberInfo['base']['questionid']){echo '
		<tr>
			<th>密码答案</th>
			<td>';echo $memberInfo['base']['answer'];echo '</td>
		</tr>
		';}echo '
        
		<tr>
			<th></th>
			<td><input type="submit" value="提交" class="btn" /><input type="button" value="返回" onclick="history.back(-1)" class="btn" /></td>
		</tr>
	</table>
</form>
';}echo '
';echo '</div>
';echo '</body>
</html>';?>