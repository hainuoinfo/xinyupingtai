<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\data_pageArticle.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\h.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\f.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\data_pageArticle.htm','D:\damaihu\xinyupingtai7\cache\default\founder\data_pageArticle.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>排序</th><th>分类名</th><th></th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td><input type="text" name="sort[]" value="';echo $v['sort'];echo '" class="txt" style="width:48px" /><input type="hidden" name="ids[]" value="';echo $v['id'];echo '" /></td><td>';echo $v['name'];echo '</td><td>[<a href="';echo $base_url;echo '&view=';echo $v['id'];echo '">查看</a>][<a href="';echo $base_url;echo '&edit=';echo $v['id'];echo '">编辑</a>]</td></tr>';}}echo '<tr><td colspan="4"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="4">';echo $multipage;echo '</td></tr><tr><td colspan="4"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='add'||$method=='edit'){echo '
';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr class="hover"><td width="60" align="right" valign="top">分类名称</td><td width="450"><input type="text" name="f_name" id="f_name" value="';echo $f_name;echo '" class="txt" style="width:240px" maxlength="32" preg="null=请输入分类名" /></td><td id="f_name_tip"></td></tr><tr><td></td><td><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='view'){echo '
';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>备注</th><th>调用标记</th><th></th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['remark'];echo '</td><td>';echo $v['marker'];echo '</td><td>[<a href="';echo $base_url;echo '&view=';echo $view;echo '&editInfo=';echo $v['id'];echo '">编辑</a>]</td></tr>';}}echo '<tr><td colspan="4"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="4">';echo $multipage;echo '</td></tr><tr><td colspan="4"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='add_info'){echo '
';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr class="hover"><td width="60" align="right" valign="top">备注</td><td width="450"><input type="text" name="f_remark" id="f_remark" value="';echo $f_remark;echo '" class="txt" style="width:240px" maxlength="32" preg="null=请输入信息备注" /></td><td id="f_remark_tip"></td></tr><tr class="hover"><td width="60" align="right" valign="top">标记</td><td width="450"><input type="text" name="f_marker" id="f_marker" value="';echo $f_marker;echo '" class="txt" style="width:240px" maxlength="32" preg="null=调用信息的标记" /></td><td id="f_marker_tip"></td></tr><tr class="hover"><td width="60" align="right" valign="top">信息内容</td><td width="450"><script type="text/javascript" src="http://damaihu.tertw.net/js_lib/xheditor/xheditor-zh-cn.min.js"></script><script type="text/javascript" src="http://damaihu.tertw.net/js_lib/xheditor/xheditor_plugins/ubb.min.js"></script>
		<textarea name="f_content" id="f_content" style="width:600px;height:400px">';echo htmlspecialchars($f_content);echo '</textarea>
<script language="javascript">
var editor;
$(function(){';echo 'editor=$(\'#f_content\').xheditor({';echo 'tools:\'Bold,Italic,Underline,FontColor,BackColor,Align,Link\',emotPath:\'';echo $weburl2;echo 'img/e/\',beforeSetSource:ubb2html,beforeGetSource:html2ubb,upImgUrl:\'';echo $weburl2;echo 'ajax/upload.php?action=image\',upImgExt:\'jpg,jpeg,gif,png\'';echo '});';echo '});
</script></td><td id="f_content_tip"></td></tr><tr><td></td><td><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
';}echo '
';echo '</div>
';echo '</body>
</html>';?>