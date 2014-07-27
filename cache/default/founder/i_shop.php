<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\i_shop.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\h.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\f.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\i_shop.htm','D:\damaihu\xinyupingtai7\cache\default\founder\i_shop.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
';if($tab=='index'){echo '
	';if($method=='index'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>排序</th><th>分类名称</th><th>商品总数</th><th>过期数量</th><th>剩余数量</th><th></th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td><input type="text" name="sort[]" value="';echo $v['sort'];echo '" class="txt" style="width:48px" /><input type="hidden" name="ids[]" value="';echo $v['id'];echo '" /></td><td>';echo $v['name'];echo '</td><td>';echo $v['total1'];echo '</td><td>';echo $v['total2'];echo '</td><td>';echo $v['total3'];echo '</td><td>[<a href="';echo $base_url;echo '&edit=';echo $v['id'];echo '">编辑</a>][<a href="';echo $base_url;echo '&view=';echo $v['id'];echo '">进入该分类</a>]</td></tr>';}}echo '<tr><td colspan="7"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="7">';echo $multipage;echo '</td></tr><tr><td colspan="7"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
	';}elseif($method=='add'||$method=='edit'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr class="hover"><td width="48" align="right" valign="top">分类名</td><td width="450"><input type="text" name="name" id="name" value="';echo $name;echo '" class="txt" style="width:240px" maxlength="32" preg="null=请输入商品分类名称" /></td><td id="name_tip"></td></tr><tr><td></td><td><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
	';}echo '
';}elseif($tab=='sub'){echo '
	';if($method=='index'){echo '
	';echo '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding"><tr class="header"><th>删？</th><th>商品名</th><th>描述</th><th>内容</th><th>数量</th><th>价格</th><th>发布时间</th><th>过期时间</th><th>状态</th><th></th></tr>';if($list){foreach($list as $k=>$v){echo '<tr class="hover"><td><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td><td>';echo $v['name'];echo '</td><td>';echo $v['des'];echo '</td><td>';echo $v['content'];echo '</td><td>';echo $v['count'];echo '</td><td>';echo $v['price'];echo '</td><td>';echo date('Y-m-d H:i:s',$v['timestamp1']);echo '</td><td>';if($v['timestamp2']){echo '';echo date('Y-m-d H:i:s',$v['timestamp2']);echo '';}else{echo '永久有效';}echo '</td><td>';if($v['status']==1){echo '已经售完';}elseif($v['status']==2){echo '已过期';}else{echo '销售中';}echo '</td><td>[<a href="';echo $base_url;echo '&edit=';echo $v['id'];echo '">编辑</a>]</td></tr>';}}echo '<tr><td colspan="10"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr><tr><td colspan="10">';echo $multipage;echo '</td></tr><tr><td colspan="10"><input type="submit" value="提交" class="btn" /></td></tr></table></form>';echo '
	';}elseif($method=='add'||$method=='edit'){echo '
<link href="http://damaihu.tertw.net/css/jquery/ui/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://damaihu.tertw.net/javascript/jquery-ui.min.js"></script>
	';echo '<form method="post" enctype="application/x-www-form-urlencoded">';echo $sys_hash_code;echo '';if($update){echo '<input type="hidden" name="isEdit" value="yes" />';}echo '
	<table class="tb tb2 fixpadding"><tr class="hover"><td width="60" align="right" valign="top">商品名称</td><td width="450"><input type="text" name="name" id="name" value="';echo $name;echo '" class="txt" style="width:240px" maxlength="64" preg="null=请输入商品名称" /></td><td id="name_tip"></td></tr><tr class="hover"><td width="60" align="right" valign="top">商品描述</td><td width="450"><textarea name="des" id="des" class="tarea" preg="null=请输入商品描述">';echo htmlspecialchars($des);echo '</textarea></td><td id="des_tip"></td></tr><tr class="hover"><td width="60" align="right" valign="top">商品内容</td><td width="450"><textarea name="content" id="content" class="tarea" preg="null=请输入商品内容">';echo htmlspecialchars($content);echo '</textarea></td><td id="content_tip"></td></tr><tr class="hover"><td width="60" align="right" valign="top">数量</td><td width="450"><input type="text" name="count" id="count" value="';echo $count?$count:1;echo '" maxlength="5" class="txt" style="width:120px" preg="number=请输入商品数量" /></td><td id="count_tip"></td></tr><tr class="hover"><td width="60" align="right" valign="top">商品价格</td><td width="450"><input type="text" name="price" id="price" value="';echo $price;echo '" class="txt" style="width:120px" preg="money=请输入商品价格" /></td><td id="price_tip"></td></tr><tr class="hover"><td width="60" align="right" valign="top">过期时间</td><td width="450"><input type="text" name="expire_datetime" id="expire_datetime" value="';echo $expire_datetime;echo '" readonly="true" class="txt" style="width:120px" /></td><td id="expire_datetime_tip"></td></tr><tr><td></td><td><input type="submit" value="';if($update){echo '编辑';}else{echo '提交';}echo '" class="btn" /></td></tr></table></form>';echo '
<script language="javascript">
$(function(){';echo '
	$(\'#expire_datetime\').datepicker({';echo 'dateFormat: \'yy-mm-dd\', appendText: \'为空表示不限制\'';echo '});
';echo '});
</script>
	';}echo '
';}echo '
';echo '</div>
';echo '</body>
</html>';?>