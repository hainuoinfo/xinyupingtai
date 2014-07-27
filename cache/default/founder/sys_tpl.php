<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\sys_tpl.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\sys_tpl.htm','D:\damaihu\xinyupingtai7\cache\default\founder\sys_tpl.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
var textareasize=function(obj, op) {';echo '
	if(!op) {';echo '
		if(obj.scrollHeight > 70) {';echo '
			obj.style.height = (obj.scrollHeight < 300 ? obj.scrollHeight : 300) + \'px\';
			if(obj.style.position == \'absolute\') {';echo '
				obj.parentNode.style.height = obj.style.height;
			';echo '}
		';echo '}
	';echo '} else {';echo '
		if(obj.style.position == \'absolute\') {';echo '
			obj.style.position = \'\';
			obj.style.width = \'\';
			obj.parentNode.style.height = \'\';
		';echo '} else {';echo '
			obj.parentNode.style.height = obj.parentNode.offsetHeight + \'px\';
			obj.style.width = $.browser.version > 6 || !$.browser.msie ? \'90%\' : \'600px\';
			obj.style.position = \'absolute\';
		';echo '}
	';echo '}
';echo '}
var textareasize=function(obj, op) {';echo '
	if(!op) {';echo '
		if(obj.scrollHeight > 70) {';echo '
			obj.style.height = (obj.scrollHeight < 300 ? obj.scrollHeight : 300) + \'px\';
			if(obj.style.position == \'absolute\') {';echo '
				obj.parentNode.style.height = obj.style.height;
			';echo '}
		';echo '}
	';echo '} else {';echo '
		if(obj.style.position == \'absolute\') {';echo '
			obj.style.position = \'\';
			obj.style.width = \'\';
			obj.parentNode.style.height = \'\';
		';echo '} else {';echo '
			obj.parentNode.style.height = obj.parentNode.offsetHeight + \'px\';
			obj.style.width = $.browser.version > 6 || !$.browser.msie ? \'90%\' : \'600px\';
			obj.style.position = \'absolute\';
		';echo '}
	';echo '}
';echo '}
$(function(){';echo '
	/*$(\'input\').each(function(){';echo '
		if(\'radio|checkbox|\'.indexOf($(this).attr(\'type\')+\'|\')>=0){';echo '
			if($(this).parent().parent().attr(\'tagName\')==\'LI\'){';echo '
				$(this).click(function(){';echo '
					$(this).parent().parent().find(\'li.checked\').removeClass(\'checked\');
					$(this).parent().addClass(\'checked\');
				';echo '});
			';echo '}
		';echo '}
	';echo '});*/
	$(\'.hasdropmenu\').each(function(){';echo '
		$(\'#\'+$(this).attr(\'id\')+\'child\').css({';echo 'left:$(this).offset().left,top:$(this).offset().bottom,position:\'absolute\',\'z-index\':1000';echo '})
		$(this).hover(function(){';echo '
			var id=$(this).attr(\'id\')+\'child\';
			$(\'#\'+id).show();
		';echo '},function(){';echo '
			var id=$(this).attr(\'id\')+\'child\';
			$(\'#\'+id).hide();
		';echo '});
	';echo '});
';echo '});
</script>
<script language="javascript">
$(function(){';echo '
	var i=';echo count($cache_sys_tpl_marker);echo ';
	$(\'#btn_add\').click(function(){';echo '
		i++;
		var html=\'<tr class="hover">\'+$(\'#tb_tpl_b_m\').html()+\'</tr>\';
		html=html.replace(/o\\[0\\]/g,\'o[\'+i+\']\');
		$(\'#tb_tpl_b\').append(html);
	';echo '});
';echo '});
</script>
<div class="container" id="cpcontainer">
	<form method="post" enctype="application/x-www-form-urlencoded">
	';echo $sys_hash_code;echo '
		<table class="tb tb2 fixpadding" id="tb_tpl">
			<tr>
				<th colspan="5" class="partition">模板解析器</th>
			</tr>
			<tr>
				<td colspan="5" class="tipsblock"><ul id="tipslis">
						<li>注：该操作仅适合熟手，请谨慎操作。</li>
						<li>修改模板解析标记，标记的开始和结束用{';echo '';echo '}表示，标记里面的数字代表该数字位置的数据，解析代码中的对应数字被替换成该数字对应的数据。</li>
						<li>立即输出代表在解析模板的时候就生成静态数据。</li>
					</ul></td>
			</tr>
			<tr class="header">
				<th>模板标记</th>
				<th>解析代码</th>
				<th>立即输出</th>
				<th>附加参数</th>
				<th>备注</th>
				<th>编辑</th>
			</tr>
			<tbody id="tb_tpl_b">
				<tr class="hover" style="display:none" id="tb_tpl_b_m">
					<td valign="top"><textarea cols="20" rows="2" name="m[]"></textarea></td>
					<td><textarea  rows="2" cols="40" name="d[]"></textarea></td>
					<td class="vtop rowform">
						<ul>
							<li>
								<label><input name="o[0]" class="radio" type="radio" value="1" />
								&nbsp;是</label>
							</li>
							<li class="checked">
								<label><input name="o[0]" class="radio" type="radio" value="0" checked />
								&nbsp;否</label>
							</li>
						</ul></td>
					<td><textarea rows="2" cols="20" name="a[]"></textarea></td>
					<td><input type="text" name="b[]" />
					</td>
					<td>[<a href="javascript:" onclick="$(this).parent().parent().remove()">删除</a>]</td>
				</tr>
				';if($cache_sys_tpl_marker){foreach($cache_sys_tpl_marker as $k=>$v){echo '
				<tr class="hover">
					<td valign="top"><textarea cols="20" rows="2" name="m[]">';echo $v['m'];echo '</textarea></td>
					<td><textarea  rows="2" cols="40" name="d[]">';echo $v['d'];echo '</textarea></td>
					<td class="vtop rowform">
						<ul>
							<li>
								<label><input name="o[';echo $k+1;echo ']" class="radio" type="radio" value="1"';if($v['o']){echo ' checked';}echo ' />
								&nbsp;是</label>
							</li>
							<li class="checked">
								<label><input name="o[';echo $k+1;echo ']" class="radio" type="radio" value="0"';if(!$v['o']){echo ' checked';}echo ' />
								&nbsp;否</label>
							</li>
						</ul></td>
					<td><textarea rows="2" cols="20" name="a[]">';echo $v['a'];echo '</textarea></td>
					<td><input type="text" name="b[]" value="';echo $v['b'];echo '" />
					</td>
					<td>[<a href="javascript:" onclick="$(this).parent().parent().remove()">删除</a>]</td>
				</tr>
				';}}echo '
			</tbody>
			<tr>
				<td colspan="5"><div class="fixsel">
						<input type="submit" class="btn" id="submit_tasksubmit" name="tasksubmit" title="按 Enter 键可随时提交您的修改" value="提交" />
						<input type="button" class="btn" value="添加" id="btn_add" />
					</div></td>
			</tr>
		</table>
	</form>
</div>
';echo '</body>
</html>';?>