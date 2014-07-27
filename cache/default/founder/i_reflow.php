<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\i_reflow.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\h.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\f.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\i_reflow.htm','D:\damaihu\xinyupingtai7\cache\default\founder\i_reflow.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
';if($method!='view'&&$method !='getList'){echo '
<br />
<div class="itemtitle">
	<h3></h3>
	<ul class="tab1">
		';if($top_menu2){foreach($top_menu2 as $k=>$v){echo '
		';if(!is_array($v)||$v['hide']===false||$k==$method2){echo '
		<li';if($k==$method2){echo ' class="current"';}echo '><a href="';if(is_array($v)&&$v['hide']){echo '';echo $nowurl;echo '';}else{echo '';echo $base_url;echo '&method=';echo $method;echo '&method2=';echo $k;echo '';if(is_array($v)&&$v['attach']){echo '';echo $v['attach'];echo '';}echo '';}echo '"><span>';echo is_array($v)?$v['name']:$v;echo '</span></a></li>
		';}echo '
		';}}echo '
	</ul>
</div>
';}echo '
';if($method=='tao'||$method=='new'||$method=='pai'||$method=='you'){echo '
';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>发布人</th><th>发布点</th><th>发布流量</th><th>剩余流量</th><th>发布时间</th><th>完成时间</th><th>锁定时间</th><th>状态</th><th></th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['susername'];echo '</td><td>';echo $v['point'];echo '</td><td>';echo $v['flowAll'];echo '</td><td>';echo $v['flowTotal'];echo '</td><td>';echo date('Y-m-d H:i:s',$v['time']);echo '</td><td>';echo $v['ctime']>0?date('Y-m-d H:i:s',$v['ctime']):'';echo '</td><td>';echo $v['lockTime']>0?date('Y-m-d H:i:s',$v['lockTime']):'';echo '</td><td>';echo $status[$v['status']];echo '</td><td>[<a href="';echo $base_url;echo '&lock=';echo $v['id'];echo '">';if($v['lock']){echo '解锁';}else{echo '锁定';}echo '</a>][<a href="';echo $base_url;echo '&method=view&sid=';echo $v['id'];echo '">详情</a>][<a href="';echo $base_url;echo '&method=getList&sid=';echo $v['id'];echo '">查看接手人</a>]</td></tr>';}}echo '<tr><td colspan="10"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="10">';echo $multipage;echo '</td></tr><tr><td colspan="10"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='view'){echo '
<form method="post" enctype="application/x-www-form-urlencoded">
';echo $sys_hash_code;echo '
	<table class="tab_view" style="width:800px">
		<tr class="tip">
			<td colspan="2">任务详情</td>
		</tr>
		<tr>
			<th>任务ID</th>
			<td>';echo $task['id'];echo '</td>
		</tr>
		<tr>
			<th>发布者</th>
			<td>';echo $task['susername'];echo '</td>
		</tr>
		<tr>
			<th>掌柜</th>
			<td>';echo $task['snickname'];echo '</td>
		</tr>
		<tr>
			<th>任务流量</th>
			<td>';echo $task['flowAll'];echo '</td>
		</tr>
		<tr>
			<th>剩余流量</th>
			<td>';echo $task['flowTotal'];echo '</td>
		</tr>
		<tr>
			<th>发布点</th>
			<td>';echo $task['point'];echo '</td>
		</tr>
		<tr>
			<th>商品地址</th>
			<td>';echo $task['itemurl'];echo '</td>
		</tr>
		<tr>
			<th>验证方式</th>
			<td>
				<table class="tab_view">
					
				';switch($task['wayId']){case '0':echo '
					<tr class="tip">
						<td colspan="2">淘宝宝贝搜索</td>
					</tr>
					<tr>
						<th>宝贝搜索关键字</th>
						<td>';echo $task['visitKey'];echo '</td>
					</tr>
					
				';break;case '1':echo '
					<tr class="tip">
						<td colspan="2">淘宝店铺搜索</td>
					</tr>
					<tr>
						<th>搜索店铺关键字</th>
						<td>';echo $task['visitKey'];echo '</td>
					</tr>
				';break;case '2':echo '
					<tr class="tip">
						<td colspan="2">链接搜索</td>
					</tr>
				';break;}echo '
				<tr>
					<th>搜索提示</th>
					<td>';echo $task['visitTip'];echo '</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th>验证要求</th>
			<td>
				<table class="tab_view">
					<tr class="tip">
						<td colspan="2">';switch($task['checkType']){case '0':echo '验证链接';break;case '1':echo '宝贝价格';break;case '2':echo '验证字符';break;}echo '</td>
					</tr>
					<tr>
						<th>验证结果</th>
						<td>';echo $task['checkValue'];echo '</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th>每天限制IP</th>
			<td>';if($task['isIP']){echo '';echo $task['numIP'];echo '次';}else{echo '不限制';}echo '</td>
		</tr>
		<tr>
			<th>限制接手人</th>
			<td>';if($task['isLimit']){echo '';echo $task['numUser'];echo '次';}else{echo '不限制';}echo '</td>
		</tr>
		<tr>
			<th>来路访问频率</th>
			<td>';if($task['isRate']){echo '';echo $task['minute'];echo '分钟';}else{echo '不限制';}echo '</td>
		</tr>
		<tr>
			<th>竞价发布点</th>
			<td>';echo $task['bidUp'];echo '</td>
		</tr>
		<tr>
			<th>任务状态</th>
			<td>';echo $status[$task['status']];echo '</td>
		</tr>
		<tr>
			<th></th>
			<td><input type="button" value="返回" class="btn" onclick="history.back(-1)" /></td>
		</tr>
	</table>
</form>
<br /><br /><br />
';}elseif($method=='getList'){echo '
';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>接手人</th><th>接手时间</th><th>接手IP</th><th>完成时间</th><th>验证次数</th><th>状态</th><th>是否结算</th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['username'];echo '</td><td>';echo date('Y-m-d H:i:s',$v['time']);echo '</td><td>';echo common::intip($v['ip']);echo '</td><td>';echo $v['ctime']>0?date('Y-m-d H:i:s',$v['ctime']):'';echo '</td><td>';echo $v['checkCount'];echo '</td><td>';if($v['status']==0){echo '进行中';}elseif($status[1]){echo '已退出';}elseif($v['status']==2){echo '已完成';}echo '</td><td>';if($v['pay']){echo '是';}else{echo '否';}echo '</td></tr>';}}echo '<tr><td colspan="8"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="8">';echo $multipage;echo '</td></tr><tr><td colspan="8"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}echo '
';echo '</div>
';echo '</body>
</html>';?>