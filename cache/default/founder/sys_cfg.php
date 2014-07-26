<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\sys_cfg.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\h.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\f.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\sys_cfg.htm','D:\damaihu\xinyupingtai7\cache\default\founder\sys_cfg.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
';if($tab=='cate'){echo '
';if($method=='cateList'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>名称</th><th>备注</th><th></th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['name'];echo '</td><td>';echo $v['remark'];echo '</td><td>[<a href="';echo $base_url;echo '&method=editCate&id=';echo $v['id'];echo '">修改</a>][<a href="';echo $base_url;echo '&view=';echo $v['id'];echo '">管理配置</a>][<a href="';echo $base_url;echo '&method=backup&cid=';echo $v['id'];echo '">备份数据</a>]</td></tr>';}}echo '<tr><td colspan="4"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="4">';echo $multipage;echo '</td></tr><tr><td colspan="4"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='addCate'||$method=='editCate'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr class="hover"><td width="60" align="right" valign="top">分类名称</td><td width="450"><input type="text" name="name" id="name" value="';echo $name;echo '" class="txt" style="width:240px" maxlength="32" preg="null=请输入分类名称" /></td><td id="name_tip"></td></tr><tr class="hover"><td width="60" align="right" valign="top">分类备注</td><td width="450"><input type="text" name="remark" id="remark" value="';echo $remark;echo '" class="txt" style="width:240px" maxlength="64" preg="null=请输入分类备注" emptyRunReg="false" /></td><td id="remark_tip"></td></tr><tr><td></td><td><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='backup'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr class="hover"><td width="60" align="right" valign="top">备份名称</td><td width="450"><input type="text" name="name" id="name" value="';echo $name;echo '" class="txt" style="width:240px" maxlength="32" preg="null=请输入备份名称" /></td><td id="name_tip"></td></tr><tr><td></td><td><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
';}echo '
';}elseif($tab=='cfg'){echo '
	';if($method=='cfgList'){echo '
		';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>配置名</th><th>类型</th><th>备注</th><th></th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['name'];echo '</td><td>';echo $v['type'];echo '</td><td>';echo $v['remark'];echo '</td><td>[<a href="';echo $base_url;echo '&method=editCfg&id=';echo $v['id'];echo '">编辑</a>]</td></tr>';}}echo '<tr><td colspan="5"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="5">';echo $multipage;echo '</td></tr><tr><td colspan="5"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
	';}elseif($method=='cfgListInfo'){echo '
		<form method="post" enctype="multipart/form-data">
		';echo $sys_hash_code;echo '
			<table class="tab_view">
				<tr class="tip">
					<td colspan="2">';echo $cate['name'];echo '配置信息</td>
				</tr>
				';if($list){foreach($list as $v){echo '
				';if(in_array($v['type'],array('select','radio','checkbox'))){$__list=string::parseChoose($v['attach']);}echo '
				<tr>
					<th>';echo $v['remark'];echo '(';echo $v['name'];echo ')</th>
					<td>
						';switch($v['type']){case 'text':echo '
						<input type="text" name="';echo $v['name'];echo '" value="';echo $v['value'];echo '" class="txt" style="width:240px" />
						';break;case 'textarea':echo '
						<textarea name="';echo $v['name'];echo '" class="tarea">';echo htmlspecialchars($v['value']);echo '</textarea>
						';break;case 'select':echo '
						<select name="';echo $v['name'];echo '">
						';if($__list){foreach($__list as $__v){echo '
						<option value="';echo $__v['value'];echo '"';if($v['value']==$__v['value']){echo ' selected="selected"';}echo '>';echo $__v['key'];echo '</option>
						';}}echo '
						</select>
						';break;case 'radio':echo '
						';if($__list){foreach($__list as $__v){echo '
						<label><input type="radio" name="';echo $v['name'];echo '" value="';echo $__v['value'];echo '"';if($v['value']==$__v['value']){echo ' checked="checked"';}echo ' class="radio" />';echo $__v['key'];echo '</label>
						';}}echo '
						';break;case 'radio2':echo '
						';function __replaceRadio2($str){global $v;$sp=common::trimExplode('=',$str);return '<label><input type="radio" name="'.$v['name'].'" value="'.$sp['0'].'"'.($v['value']==$sp['0']?' checked="checked"':'').' class="radio" />'.$sp[1].'</label>';}echo preg_replace('/{(.+?)}/e','__replaceRadio2(\'$1\')',$v['attach']);echo '
						';break;case 'checkbox':echo '
						';if($__list){foreach($__list as $__v){echo '
						<label><input type="checkbox" name="';echo $v['name'];echo '[]" value="';echo $__v['value'];echo '"';if($v['value']&1<<$__v['value']-1){echo ' checked="checked"';}echo ' class="checkbox" />';echo $__v['key'];echo '</label>
						';}}echo '
						';break;case 'image':echo '
						<input type="file" name="';echo $v['name'];echo '" class="txt" style="width:240px"  />
						';if($v['value']){echo '<br />
						<a href="';echo $weburl2;echo '';echo $v['value'];echo '" target="_blank"><img src="';echo $weburl2;echo '';echo $v['value'];echo '" width="100" /></a>
						';}echo '
						';break;default:echo '
						<input type="text" name="';echo $v['name'];echo '" value="';echo $v['value'];echo '" class="txt" style="width:240px" />
						';break;}echo '
					</td>
				</tr>
				';}}echo '
				<tr>
					<th></th>
					<td><input type="submit" value="提交" class="btn" /></td>
				</tr>
			</table>
		</form>
	';}elseif($method=='addCfg'||$method=='editCfg'){echo '
		';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr class="hover"><td width="60" align="right" valign="top">配置名称</td><td width="450"><input type="text" name="name" id="name" value="';echo $name;echo '" class="txt" style="width:240px" maxlength="32" preg="null=请输入配置名称" /></td><td id="name_tip"></td></tr><tr class="hover"><td width="60" align="right" valign="top">配置类型</td><td width="450"><select name="type" id="type"><option value="text"';if($type=='text'){echo ' selected';}echo '>单行字符</option><option value="textarea"';if($type=='textarea'){echo ' selected';}echo '>多行字符</option><option value="select"';if($type=='select'){echo ' selected';}echo '>下拉</option><option value="radio"';if($type=='radio'){echo ' selected';}echo '>单选</option><option value="radio2"';if($type=='radio2'){echo ' selected';}echo '>单选自定义</option><option value="checkbox"';if($type=='checkbox'){echo ' selected';}echo '>多选</option><option value="image"';if($type=='image'){echo ' selected';}echo '>图片</option></select></td><td id="type_tip"></td></tr><tr class="hover"><td width="60" align="right" valign="top">配置参数</td><td width="450"><textarea name="attach" id="attach" class="tarea" preg="null=多选、单选、下拉使用" emptyRunReg="false">';echo htmlspecialchars($attach);echo '</textarea></td><td id="attach_tip"></td></tr><tr class="hover"><td width="60" align="right" valign="top">配置备注</td><td width="450"><input type="text" name="remark" id="remark" value="';echo $remark;echo '" class="txt" style="width:240px" maxlength="64" preg="null=请输入配置备注" emptyRunReg="false" /></td><td id="remark_tip"></td></tr><tr><td></td><td><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
	';}echo '
';}echo '
';echo '</div>
';echo '</body>
</html>';?>