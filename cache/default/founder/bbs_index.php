<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\bbs_index.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\h.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\f.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\bbs_index.htm','D:\damaihu\xinyupingtai7\cache\default\founder\bbs_index.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>排序</th><th>版块名称</th><th>版主</th><th>最近修改</th><th></th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td><input type="text" name="sort[]" value="';echo $v['sort'];echo '" class="txt" style="width:48px" /><input type="hidden" name="ids[]" value="';echo $v['id'];echo '" /></td><td>';echo $v['name'];echo '</td><td>';if($v['moderator']){foreach($v['moderator'] as $k2=>$v2){echo '';if($k2>0){echo '';echo "&nbsp\x3b\x7c&nbsp\x3b";echo '';}echo '';echo $v2['username'];echo '(<a href="';echo $base_url;echo '&method=delModerator&fid=';echo $v['id'];echo '&mid=';echo $v2['uid'];echo '">删除</a>)';}}echo '</td><td>';echo date('Y-m-d H:i:s',$v['timestamp']);echo '</td><td>[<a href="';echo $base_url;echo '&method=addModerator&fid=';echo $v['id'];echo '">添加版主</a>][<a href="';echo $base_url;echo '&edit=';echo $v['id'];echo '">编辑</a>]</td></tr>';}}echo '<tr><td colspan="6"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="6">';echo $multipage;echo '</td></tr><tr><td colspan="6"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='add'||$method=='edit'){echo '

';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr><td class="partition" colspan="3">添加新模板</td></tr><tr class="hover"><td width="84" align="right" valign="top"></td><td width="450"></td><td id="_tip"></td></tr><tr class="hover"><td width="84" align="right" valign="top">版块名称</td><td width="450"><input type="text" name="name" id="name" value="';echo $name;echo '" class="txt" style="width:240px" maxlength="64" preg="null=请输入版块名称" /></td><td id="name_tip"></td></tr><tr class="hover"><td width="84" align="right" valign="top">英文名</td><td width="450"><input type="text" name="ename" id="ename" value="';echo $ename;echo '" class="txt" style="width:240px" maxlength="32" preg="null=请输入版块英文名或拼音" /></td><td id="ename_tip"></td></tr><tr class="hover"><td width="84" align="right" valign="top">版块简介</td><td width="450"><script type="text/javascript" src="http://damaihu.tertw.net/js_lib/xheditor/xheditor-zh-cn.min.js"></script><script type="text/javascript" src="http://damaihu.tertw.net/js_lib/xheditor/xheditor_plugins/ubb.min.js"></script>
		<textarea name="des" id="des" style="width:300px;height:80px">';echo htmlspecialchars($des);echo '</textarea>
<script language="javascript">
var editor;
$(function(){';echo 'editor=$(\'#des\').xheditor({';echo 'tools:\'Bold,Italic,Underline,FontColor,BackColor,Align,Link\',emotPath:\'';echo $weburl2;echo 'img/e/\',beforeSetSource:ubb2html,beforeGetSource:html2ubb,upImgUrl:\'';echo $weburl2;echo 'ajax/upload.php?action=image\',upImgExt:\'jpg,jpeg,gif,png\'';echo '});';echo '});
</script></td><td id="des_tip"></td></tr><tr class="hover"><td width="84" align="right" valign="top">浏览权限</td><td width="450"><select name="view_group_id" id="view_group_id">';$__group=false;echo '';if($groups){foreach($groups as $k=>$v){echo '';if(is_array($v)&&$v['type']=='-'){echo '';if($__group){echo '</optgroup>';}echo '';$__group=true;echo '<optgroup label="';echo $v['name'];echo '">';}else{echo '<option value="';echo $v;echo '"';if($v==$view_group_id){echo ' selected';}echo '>';echo $k;echo '</option>';}echo '';}}echo '';if($__group){echo '</optgroup>';}echo '</select></td><td id="view_group_id_tip"></td></tr><tr class="hover"><td width="84" align="right" valign="top">发帖权限</td><td width="450"><select name="post_group_id" id="post_group_id">';$__group=false;echo '';if($groups){foreach($groups as $k=>$v){echo '';if(is_array($v)&&$v['type']=='-'){echo '';if($__group){echo '</optgroup>';}echo '';$__group=true;echo '<optgroup label="';echo $v['name'];echo '">';}else{echo '<option value="';echo $v;echo '"';if($v==$post_group_id){echo ' selected';}echo '>';echo $k;echo '</option>';}echo '';}}echo '';if($__group){echo '</optgroup>';}echo '</select></td><td id="post_group_id_tip"></td></tr><tr class="hover"><td width="84" align="right" valign="top">浏览所需积分</td><td width="450"><input type="text" name="view_credits" id="view_credits" value="';echo $view_credits;echo '" class="txt" style="width:64px" maxlength="32" preg="number=请输入浏览所需积分，0为不限制" /></td><td id="view_credits_tip"></td></tr><tr class="hover"><td width="84" align="right" valign="top">发帖所需积分</td><td width="450"><input type="text" name="post_credits" id="post_credits" value="';echo $post_credits;echo '" class="txt" style="width:64px" maxlength="32" preg="number=请输入发帖所需积分，0为不限制" /></td><td id="post_credits_tip"></td></tr><tr><td></td><td colspan="2"><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
';}elseif($method=='addModerator'){echo '
';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr class="hover"><td width="48" align="right" valign="top">用户名</td><td width="450"><input type="text" name="username" id="username" value="';echo $username;echo '" class="txt" style="width:240px" maxlength="16" preg="null=请输入你要添加的版主用户名" /></td><td id="username_tip"></td></tr><tr><td></td><td><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
';}echo '
';echo '</div>
';echo '</body>
</html>';?>