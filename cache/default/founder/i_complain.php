<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\i_complain.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\h.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\f.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\i_complain.htm','D:\damaihu\xinyupingtai7\cache\default\founder\i_complain.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
';if($method!='view'){echo '
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
';if($method=='tao'||$method=='pai'||$method=='you'||$method=='new'){echo '
<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">
';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding">
		<tr class="header">
			<th>删？</th>
			<th>任务ID</th>
			<th>申诉标题</th>
			<th>申诉人</th>
			<th>被申诉人</th>
			<th>申诉时间</th>
			<td>状态</td>
			<th></th>
		</tr>
		';if($list){foreach($list as $v){echo '
		<tr class="hover">
			<td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td>
			<td>';echo $v['tid'];echo '</td>
			<td>';echo $v['title'];echo '</td>
			<td>';echo $v['fusername'];echo '</td>
			<td>';echo $v['tusername'];echo '</td>
			<td>';echo date('Y-m-d H:i:s',$v['timestamp1']);echo '</td>
			<td>';echo $cStatus[$v['status']];echo '</td>
			<td>[<a href="';echo $base_url;echo '&method=view&id=';echo $v['id'];echo '">详情</a>]</td>
		</tr>
		';}}echo '
		<tr>
			<td><label><input type="checkbox" onclick="check_all(this,\'del[]\')" class="checkbox" />全选</label></td>
			<td colspan="8">';echo $multipage;echo '</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="9"><input type="submit" value="提交" class="btn" /></td>
		</tr>
	</table>
</form>
';}elseif($method=='view'){echo '
<form method="post" enctype="application/x-www-form-urlencoded">
';echo $sys_hash_code;echo '
	<table class="tab_view" style="width:800px">
		<tr class="tip">
			<td colspan="2">申诉详情</td>
		</tr>
		<tr>
			<th>任务ID</th>
			<td>';echo $complain['tid'];echo '</td>
		</tr>
		<tr>
			<th>所属区域</th>
			<td>';echo language::get('qu'.$complain['type']);echo '</td>
		</tr>
		<tr>
			<th>申诉人</th>
			<td>';echo $complain['fusername'];echo '</td>
		</tr>
		<tr>
			<th>被申诉人</th>
			<td>';echo $complain['tusername'];echo '</td>
		</tr>
		<tr>
			<th>申诉标题</th>
			<td>';echo $complain['title'];echo '</td>
		</tr>
		<tr>
			<th>申诉内容</th>
			<td>
				';if($complainMessage['0']){foreach($complainMessage['0'] as $v){echo '
				[';echo date('Y-m-d H:i:s',$v['timestamp']);echo ']<br />';echo $v['message'];echo '<br /><br />
				';}}echo '
			</td>
		</tr>
		';if($complainMessage[1]){echo '
		<tr>
			<th>辩解内容</th>
			<td>
				';if($complainMessage[1]){foreach($complainMessage[1] as $v){echo '
				[';echo date('Y-m-d H:i:s',$v['timestamp']);echo ']<br />';echo $v['message'];echo '<br /><br />
				';}}echo '
			</td>
		</tr>
		';}echo '
		<tr>
			<th>申诉时间</th>
			<td>';echo date('Y-m-d H:i:s',$complain['timestamp1']);echo '</td>
		</tr>
		<tr>
			<th>状态</th>
			<td>';echo $cStatus[$complain['status']];echo '</td>
		</tr>
		';if(!in_array($complain['status'],array(1,2,3))){echo '
		<tr>
			<th>退回金额</th>
			<td><input type="text" name="backPrice" value="';echo $task['price'];echo '" class="txt" /></td>
		</tr>
		<tr>
			<th>退回发布点</th>
			<td><input type="text" name="backPoint" value="';echo $task['point'];echo '" class="txt" /></td>
		</tr>
		<tr>
			<th>给发布方增加金钱</th>
			<td><input type="text" name="sprice" value="0"  class="txt"/></td>
		</tr>
		<tr>
			<th>给发布方增加发布点</th>
			<td><input type="text" name="spoint" value="0"  class="txt"/></td>
		</tr>
		<tr>
			<th>给接手方增加金钱</th>
			<td><input type="text" name="bprice" value="0"  class="txt"/></td>
		</tr>
		<tr>
			<th>给接手方增加发布点</th>
			<td><input type="text" name="bpoint" value="0"  class="txt"/></td>
		</tr>
		';}else{echo '
		<tr>
			<th>退回金额</th>
			<td>￥';echo $complain['price'];echo '</td>
		</tr>
		<tr>
			<th>退回发布点</th>
			<td>';echo $complain['point'];echo '</td>
		</tr>
		<tr>
			<th>给发布方增加金钱</th>
			<td>￥';echo $complain['sprice'];echo '</td>
		</tr>
		<tr>
			<th>给发布方增加发布点</th>
			<td>￥';echo $complain['spoint'];echo '</td>
		</tr>
		<tr>
			<th>给接手方增加金钱</th>
			<td>￥';echo $complain['bprice'];echo '</td>
		</tr>
		<tr>
			<th>给接手方增加发布点</th>
			<td>￥';echo $complain['bpoint'];echo '</td>
		</tr>
		';}echo '
		<tr>
			<th>操作</th>
			<td>';if(!in_array($complain['status'],array(1,2,3))){echo '
				<label><input type="radio" name="status" value="1" class="radio" checked="checked" />申诉成功</label>
				<label><input type="radio" name="status" value="2" class="radio" />申诉失败</label>
				';}echo '
			</td>
		</tr>
		<tr>
			<th>任务详情</th>
			<td><a href="';echo $admin_url;echo '?action=i&operation=task&method=view&sid=';echo $complain['tid'];echo '" target="_blank">点击查看</a></td>
		</tr>
		<tr>
			<th></th>
			<td><input type="submit" value="提交" class="btn" /><input type="button" value="返回" class="btn" onclick="history.back(-1)" /></td>
		</tr>
	</table>
</form>
<br /><br /><br />
';}echo '
';echo '</div>
';echo '</body>
</html>';?>