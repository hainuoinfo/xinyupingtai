<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\i_rcard.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\h.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\f.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\i_rcard.htm','D:\damaihu\xinyupingtai7\cache\default\founder\i_rcard.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	<script type="text/javascript" src="http://damaihu.tertw.net/javascript/jquery-ui.min.js"></script>
	<link href="http://damaihu.tertw.net/css/jquery/ui/jquery-ui.css" rel="stylesheet" type="text/css" />
<div id="dialog" style="display:none">
	<div id="dialog_message"></div>
</div>
<script language="javascript">
var sendCard = function(id){';echo '
	var html=\'\';
	html=\'<table width="300">\';
	html+=\'<tr>\';
	html+=\'<td width="150" align="right">卡号：</td>\';
	html+=\'<td align="left">\'+id+\'</td>\';
	html+=\'</tr>\';
	html+=\'<tr>\';
	html+=\'<td width="150" align="right">用户名：</td>\';
	html+=\'<td align="left"><input type="text" id="username" value="" class="txt" style="width:200px" /></td>\';
	html+=\'</tr>\';
	html+=\'</table>\';
	$(\'#dialog\').html(html);
	$("#dialog").dialog({';echo '
		title:\'发送卡密给用户\',
		buttons: {';echo '
			"发送": function() {';echo '
				var username = $(\'#username\').val().replace(/^\\s+|\\s+$/g, \'\');
				if (username) {';echo '
					$(this).html(\'<div align="center">发送中，请稍后......</div>\');
					$("#dialog" ).dialog( "option", "buttons",{';echo '
						
					';echo '});
					$.getJSON(\'ajax/index.php?action=topup&operation=card&method=send&cardid=\'+id+\'&username=\'+encodeURI(username), function(json){';echo '
						if (json.status) {';echo '
							$(\'#dialog\').html(\'<span style="color:red">发送成功</span>\');
						';echo '} else {';echo '
							$(\'#dialog\').html(\'<span style="color:red">\'+json.msg+\'</span>\');
						';echo '}
						$("#dialog" ).dialog( "option", "buttons",{';echo '
							\'确定\':function(){';echo '
								$(this).dialog(\'close\');
							';echo '}
						';echo '});
					';echo '});
				';echo '} else {';echo '
					$(\'#username\').focus();
				';echo '}
			';echo '},
			\'取消\':function(){';echo '
				$(this).dialog(\'close\');
			';echo '}
		';echo '},
		modal:true,//模式窗口（显示遮罩层）
		resizable:false,//是否允许改变大小
		draggable:false,//是否可以拖动
		bgiframe: true,
		overlay: {';echo '   
				backgroundColor: \'#000\',   
				opacity: 0.5   
			';echo '},  
		show: \'slide\',//显示样式
		width:400,
		height:160
	';echo '});
';echo '}
</script>
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>卡号</th><th>密码</th><th>发送</th><th>面额</th><th>创建时间</th><th>充值时间</th><th>充值帐号</th><th>状态</th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['id'];echo '</td><td><a href="javascript:;" onclick="copyText(\'';echo $v['pwd'];echo '\');alert(\'复制成功\');return false;">复制密码</a></td><td><a href="javascript:;" onclick="sendCard(\'';echo $v['id'];echo '\');return false;">发送给用户</a></td><td>';echo $v['money'];echo '</td><td>';echo date('Y-m-d H:i:s',$v['ctimestamp']);echo '</td><td>';echo $v['status']?date('Y-m-d H:i:s',$v['utimestamp']):'还未使用';echo '</td><td>';echo $v['status']?$v['username']:'还未使用';echo '</td><td>';echo $v['status']?'<span style="color:green">已使用</span>':'<span style="color:red">未使用</span>';echo '</td></tr>';}}echo '<tr><td colspan="9"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="9">';echo $multipage;echo '</td></tr><tr><td colspan="9"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='create'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr><td class="partition" colspan="3">注：面值为整数</td></tr><tr class="hover"><td width="36" align="right" valign="top"></td><td width="450"></td><td id="_tip"></td></tr><tr class="hover"><td width="36" align="right" valign="top">面值</td><td width="450"><input type="text" name="money" id="money" value="';echo $money;echo '" class="txt" style="width:240px" maxlength="10" preg="number=请输入充值卡面值" /></td><td id="money_tip"></td></tr><tr class="hover"><td width="36" align="right" valign="top">数量</td><td width="450"><input type="text" name="count" id="count" value="';echo $count;echo '" class="txt" style="width:240px" maxlength="10" preg="number=请输入生成的数量" /></td><td id="count_tip"></td></tr><tr><td></td><td colspan="2"><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
';}echo '
';echo '</div>
';echo '</body>
</html>';?>