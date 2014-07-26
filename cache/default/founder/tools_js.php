<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\tools_js.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\h.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\f.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\tools_js.htm','D:\damaihu\xinyupingtai7\cache\default\founder\tools_js.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
';if($method=='replace'){echo '
<table class="tb tb2 fixpadding">
	<tr>
		<th class="partition" colspan="2">正则表达式替换</th>
	</tr>
	<tr class="hover">
		<td width="120" align="right" valign="top">目标字符串：</td>
		<td>
			<textarea class="textarea" id="source" style="width:400px;height:100px"></textarea>
		</td>
	</tr>
	<tr class="hover">
		<td width="120" align="right" valign="top">结果：</td>
		<td>
			<textarea class="textarea" id="destination" style="width:400px;height:100px"></textarea>
		</td>
	</tr>
	<tr class="hover">
		<td width="120" align="right" valign="top">正则表达式：</td>
		<td>
			<textarea class="textarea" id="regStr" style="width:400px;height:100px"></textarea>
		</td>
	</tr>
	<tr class="hover">
		<td width="120" align="right" valign="top">&nbsp;</td>
		<td>
			<input type="button" value="替换" class="btn" onclick="$(\'#destination\').val(preg_replace($(\'#regStr\').val(), $(\'#source\').val()))" />
			<input type="button" value="切换" class="btn" onclick="$(\'#source\').val($(\'#destination\').val());$(\'#destination\').val(\'\')" />
			<input type="button" value="复制" class="btn" onclick="copyText($(\'#destination\').val())" />
			<input type="button" value="粘贴" class="btn" onclick="$(\'#source\').val(window.clipboardData.getData(\'Text\'));window.status=\'内容已经粘贴\'" />
			<input type="button" value="运行" class="btn" onclick="eval($(\'#source\').val())" />
			<input type="button" value="预览" class="btn" onclick="preview()" />
			<input type="button" value="行间倒序" class="btn" onclick="strLineReverse()" />
		</td>
	</tr>
</table>
<script language="javascript">
	var preg_replace=function(regStr,data){';echo '
		var arr=regStr.split(\'\\r\\n\');
		for(var i=0;i<arr.length;i++){';echo '
			var tmp_data=arr[i];
			var tmp_arr=tmp_data.split(\' \');
			if(!tmp_arr[1])tmp_arr[1]=\'\';
			if(tmp_arr[1])tmp_arr[1]=tmp_arr[1].replace(/\\\\n|\\\\r\\\\n/g,\'\\r\\n\').replace(/\\\\s/g,\' \').replace(/\\\\t/g,\'\\t\');
			if(tmp_arr[0].match(/^\\/(.+)\\/([^\\/]*)$/ig)){';echo '
				var re=new RegExp(RegExp.$1,RegExp.$2);
				data=data.replace(re,tmp_arr[1]);
			';echo '} else if(tmp_arr[0]) {';echo '
				data=data.replace(tmp_arr[0],tmp_arr[1]);
			';echo '}
		';echo '}
		var find_i=-1;
		var find_j=0;
		while((find_i=data.indexOf(\'$\'+\'i\',find_i))>=0){';echo '
			var next=true;
			if(find_i>0){';echo '
				
			';echo '}
			if(next){';echo '
				find_j++;
				var data2=data;
				if(find_i>0)data=data2.substring(0,find_i);
				else data=\'\';
				data+=find_j;
				if(find_i+2<=data2.length)data+=data2.substring(find_i+2);
			';echo '}
		';echo '}
		return data;
	';echo '}
	var preview=function(){';echo '
		var wd=window.open(\'about:blank\',\'_blank\');
		wd.document.write($(\'#destination\').val());
	';echo '};
	var strLineReverse=function(){';echo '
		var source = $(\'#source\').val();
		var des = \'\';
		if (source) {';echo '
			source = source.replace(/\\r\\n/g, "\\n");
			var sp = source.split("\\n");
			var len = sp.length;
			for (var i = 0; i < len; i++) {';echo '
				if (des) des = "\\r\\n" + des;
				des = sp[i] + des;
			';echo '}
		';echo '}
		$(\'#destination\').val(des);
	';echo '}
</script>
';}echo '
';echo '</div>
';echo '</body>
</html>';?>