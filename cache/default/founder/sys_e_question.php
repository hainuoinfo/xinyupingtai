<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\sys_e_question.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\h.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\f.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\sys_e_question.htm','D:\damaihu\xinyupingtai7\cache\default\founder\sys_e_question.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>排序</th><th>问题</th><th></th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td><input type="text" name="sort[]" value="';echo $v['sort'];echo '" class="txt" style="width:48px" /><input type="hidden" name="ids[]" value="';echo $v['id'];echo '" /></td><td>';echo $v['title'];echo '</td><td>[<a href="';echo $base_url;echo '&edit=';echo $v['id'];echo '">编辑</a>]</td></tr>';}}echo '<tr><td colspan="4"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="4">';echo $multipage;echo '</td></tr><tr><td colspan="4"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='add'||$method=='edit'){echo '
<script language="javascript">
var sIndexStart = 65;
var sIndex = 0;
var s_add=function(data){';echo '
	if (data==void(0))data=\'\';
	var i = String.fromCharCode(sIndexStart + sIndex);
	$(\'#e_select\').append(\'<tr class="hover"><td><input type="checkbox" name="answer[]" id="s_\'+i+\'" value="\'+sIndex+\'" class="checkbox" /><label for="s_\'+i+\'">\' + i + \'</label></td><td><input type="text" name="select[]" maxlength="120" value="\'+data+\'" class="txt" style="width:640px" /></td><td><a href="javascript:;" onclick="s_pre(this)">上移</a>&nbsp;<a href="javascript:;" onclick="s_next(this)">下移</a>&nbsp;<a href="javascript:;" onclick="s_remove(this)">移除</a></td></tr>\');
	sIndex++;
';echo '}
var s_remove=function(e){';echo '
	var t=$(e).parent().parent();
	var p=t.parent();
	var j = p.children().length;
	if (p.children().length > 1) {';echo '
		var i = t.index();
		for (var k = i + 1; k < j; k++) {';echo '
			var o = $(p.children()[k]);
			var iS = String.fromCharCode(k + sIndexStart);
			var iS2 = String.fromCharCode(sIndexStart + k -1);
			o.find(\'#s_\'+iS).attr(\'s_\'+iS2);
			o.find(\'label\').html(iS2);
			o.find(\'input[name=answer[]]\').val(k - 1);
		';echo '}
	';echo '}
	t.remove();
	sIndex--;
';echo '};
var s_pre=function(e){';echo '
	var t=$(e).parent().parent();
	var i = t.index();
	if (i > 0) {';echo '
		var i2 = i - 1;
		var p=t.parent();
		var o = $(p.children()[i]);
		var o2 = $(p.children()[i2]);
		var s = o.find(\'input[name=select[]]\').val();
		o.find(\'input[name=select[]]\').val(o2.find(\'input[name=select[]]\').val());
		o2.find(\'input[name=select[]]\').val(s);
		var check = o.find(\'input[name=answer[]]\').attr(\'checked\');
		o.find(\'input[name=answer[]]\').attr({';echo 'checked: o2.find(\'input[name=answer[]]\').attr(\'checked\')';echo '});
		o2.find(\'input[name=answer[]]\').attr({';echo 'checked: check';echo '});
		
	';echo '}
';echo '};
var s_next=function(e){';echo '
	var t=$(e).parent().parent();
	var i = t.index();
	var p=t.parent();
	var j = p.children().length - 1;
	if (i < j) {';echo '
		var o = $(p.children()[i + 1]);
		var o2 = $(p.children()[i]);
		var s = o.find(\'input[name=select[]]\').val();
		o.find(\'input[name=select[]]\').val(o2.find(\'input[name=select[]]\').val());
		o2.find(\'input[name=select[]]\').val(s);
		var check = o.find(\'input[name=answer[]]\').attr(\'checked\');
		o.find(\'input[name=answer[]]\').attr({';echo 'checked: o2.find(\'input[name=answer[]]\').attr(\'checked\')';echo '});
		o2.find(\'input[name=answer[]]\').attr({';echo 'checked: check';echo '});
		
	';echo '}
';echo '};
var form_submit=function(){';echo '
	var trs=$(\'#e_select\').find(\'tr\');
	if (trs.length > 0) {';echo '
		var rn = true;
		var s = 0;
		trs.each(function(){';echo '
			if ($(this).find(\'input[name=select[]]\').val().replace(/^\\s+|\\s+$/g, \'\')==\'\'){';echo '
				rn = false;
				return false;
			';echo '}
			if ($(this).find(\'input[name=answer[]]\').attr(\'checked\'))s++;
		';echo '});
		if (!rn){';echo '
			alert(\'请检查提问选项是否完整\');
			return false;
		';echo '}
		if (s == 0){';echo '
			alert(\'问卷答案没有设置，最少设置一个选项\');
			return false;
		';echo '}
		return true;
	';echo '}
	alert(\'请添加提问选项\');
	return false;
';echo '};
var add_datas=function(datas){';echo '
	datas=datas.replace(/^\\s+|\\s+$/g, \'\');
	datas=datas.replace(/\\n+/g, "\\n");
	datas=datas.replace(/^[0-9]+\\.\\s*/, \'\');
	datas=datas.replace(/\\n[a-zA-z]\\s*/g, "\\n");
	if (datas!=""){';echo '
		sp=datas.split("\\n");
		sIndex=0;
		$(\'#question\').val(sp[0]);
		$(\'#e_select\').html(\'\');
		var l = sp.length;
		for(var i=1;i<l;i++){';echo '
			s_add(sp[i]);
		';echo '}
	';echo '} else alert(\'请输入要插入的数据\');
';echo '}
$(function(){';echo '
	$(\'#add_e_select\').click(function(){';echo '
		s_add();
	';echo '});
';echo '});
</script>
<form method="post">
';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding">
		<tr class="hover">
			<td width="60">题目</td>
			<td width="700"><input type="text" name="question" id="question" value="';echo $questionInfo['title'];echo '" class="txt" maxlength="120" style="width:640px" preg="null=请输问卷题目" /></td>
			<td id="question_tip"></td>
		</tr>
		<tr class="partition">
			<td colspan="2"><span style="color:red;font-weight:bold">问卷选项，注：选中为答案</span></td>
			<td><a href="javascript:;" id="add_e_select">增加一个选项</a></td>
		</tr>
		<tbody id="e_select">
		';if($selectList){foreach($selectList as $k=>$v){echo '
		<tr class="hover">
			<td><input type="checkbox" name="answer[]" id="s_';echo chr(65+$v['sort']);echo '" value="';echo $v['sort'];echo '" class="checkbox"';if($questionInfo['answer']&1<<$v['sort']){echo ' checked';}echo ' /><label for="s_\'+i+\'">';echo chr(65+$v['sort']);echo '</label></td>
			<td><input type="text" name="select[]" maxlength="120" class="txt" style="width:640px" value="';echo $v['title'];echo '" /></td>
			<td><a href="javascript:;" onclick="s_pre(this)">上移</a>&nbsp;<a href="javascript:;" onclick="s_next(this)">下移</a>&nbsp;<a href="javascript:;" onclick="s_remove(this)">移除</a></td>
		</tr>
		';}}echo '
		</tbody>
		<tr class="partition">
			<td colspan="2"><span style="color:red;font-weight:bold">批量添加，注：第一行为问题，其它为选项，一行一个，空白行包忽略</span></td>
			<td></td>
		</tr>
		<tr class="hover">
			<td></td>
			<td><textarea cols="100" rows="10" id="datas"></textarea>
			</td>
			<td align="left" valign="bottom"><input type="button" value="插入" class="btn" onclick="add_datas($(\'#datas\').val())" /></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2"><input type="submit" value="';if($update){echo '编辑';}else{echo '添加';}echo '" class="btn" /></td>
		</tr>
	</table>
</form>
';}echo '
';echo '</div>
';echo '</body>
</html>';?>