<?php $_tplModify=filemtime('D:\xinyupingtai\cache\default\founder\log_topup.php');if(filemtime('D:\xinyupingtai\templates\default\founder\h.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\founder\f.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\xinyupingtai\templates\default\founder\log_topup.htm','D:\xinyupingtai\cache\default\founder\log_topup.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
';if($method=='chinabank'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>用户名</th><th>当前余额</th><th>充值金额</th><th>实际支付</th><th>手续费百分比</th><th>奖励积分</th><th>时间</th><th>状态</th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['username'];echo '</td><td>';echo $v['money'];echo '</td><td>';echo $v['money1'];echo '</td><td>';echo $v['money2'];echo '</td><td>';echo($v['mp']*100).'%';echo '</td><td>';echo $v['credit'];echo '</td><td>';echo date('Y-m-d H:i:s',$v['ptimestamp']);echo '</td><td>';echo $v['status']?'<span style="color:green">已付款</span>':'<span style="color:red">未付款</span>';echo '</td></tr>';}}echo '<tr><td colspan="9"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="9">';echo $multipage;echo '</td></tr><tr><td colspan="9"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='card'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>用户名</th><th>当前余额</th><th>充值金额</th><th>奖励积分</th><th>时间</th><th>状态</th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['username'];echo '</td><td>';echo $v['money'];echo '</td><td>';echo $v['money1'];echo '</td><td>';echo $v['credit'];echo '</td><td>';echo date('Y-m-d H:i:s',$v['ptimestamp']);echo '</td><td>';echo $v['status']?'<span style="color:green">已付款</span>':'<span style="color:red">未付款</span>';echo '</td></tr>';}}echo '<tr><td colspan="7"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="7">';echo $multipage;echo '</td></tr><tr><td colspan="7"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='alipay'||$method=='tenpay'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>用户名</th><th>当前余额</th><th>充值金额</th><th>奖励积分</th><th>支付宝帐号</th><th>支付宝交易号</th><th>时间</th><th>状态</th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['username'];echo '</td><td>';echo $v['money'];echo '</td><td>';echo $v['money1'];echo '</td><td>';echo $v['credit'];echo '</td><td>';echo $v['remark1'];echo '</td><td>';echo $v['remark2'];echo '</td><td>';echo date('Y-m-d H:i:s',$v['ptimestamp']);echo '</td><td>';if(($v['status']==1)){echo '<span style="color:green">已付款</span>';}elseif($v['status']==2){echo '无效';}else{echo '<span style="color:red">未付款(<a href="javascript:;" onclick="confirmPayfor(\'';echo $v['id'];echo '\')">确认付款</a>|<a href="javascript:;" onclick="badPayfor(\'';echo $v['id'];echo '\')">无效付款</a>)</span>';}echo '</td></tr>';}}echo '<tr><td colspan="9"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="9">';echo $multipage;echo '</td></tr><tr><td colspan="9"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
<script language="javascript">
var confirmPayfor=function(id){';echo '
	if (confirm(\'您确定已经收到款了吗？\')) {';echo '
		location.href=\'';echo $base_url;echo '&method=';echo $method;echo '&confirm=\'+id;
	';echo '}
';echo '};
var badPayfor=function(id){';echo '
	if (confirm(\'您确定该订单无效吗？\')) {';echo '
		location.href=\'';echo $base_url;echo '&method=';echo $method;echo '&bad=\'+id;
	';echo '}
';echo '};
</script>
';}elseif($method=='setting'){echo '
';echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr class="hover"><td width="108" align="right" valign="top">是否启用网银在线</td><td class="vtop rowform" width="450"><ul><li';if($chinabank_status=='1'||!isset($chinabank_status)){echo ' class="checked"';}echo '><input type="radio" name="chinabank_status" id="chinabank_status1" value="1" class="radio"';if($chinabank_status=='1'||!isset($chinabank_status)){echo ' checked';}echo ' />&nbsp<label for="chinabank_status1">是</label></li><li';if($chinabank_status=='2'){echo ' class="checked"';}echo '><input type="radio" name="chinabank_status" id="chinabank_status2" value="2" class="radio"';if($chinabank_status=='2'){echo ' checked';}echo ' />&nbsp<label for="chinabank_status2">否</label></li></ul></td></tr><tr class="hover"><td width="108" align="right" valign="top">网银在线商户号</td><td width="450"><input type="text" name="chinabank_id" id="chinabank_id" value="';echo $chinabank_id;echo '" class="txt" style="width:240px" maxlength="8" /></td></tr><tr class="hover"><td width="108" align="right" valign="top">网银在线密钥</td><td width="450"><input type="text" name="chinabank_key" id="chinabank_key" value="';echo $chinabank_key;echo '" class="txt" style="width:240px" maxlength="64" /></td></tr><tr><td></td><td><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
';}else{echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>用户名</th><th>当前余额</th><th>充值金额</th><th>实际支付</th><th>手续费百分比</th><th>奖励积分</th><th>时间</th><th>状态</th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['username'];echo '</td><td>';echo $v['money'];echo '</td><td>';echo $v['money1'];echo '</td><td>';echo $v['money2'];echo '</td><td>';echo($v['mp']*100).'%';echo '</td><td>';echo $v['credit'];echo '</td><td>';echo date('Y-m-d H:i:s',$v['ptimestamp']);echo '</td><td>';echo $v['status']?'<span style="color:green">已付款</span>':'<span style="color:red">未付款</span>';echo '</td></tr>';}}echo '<tr><td colspan="9"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="9">';echo $multipage;echo '</td></tr><tr><td colspan="9"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}echo '
';echo '</div>
';echo '</body>
</html>';?>