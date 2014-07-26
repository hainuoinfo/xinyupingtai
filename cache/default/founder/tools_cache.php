<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\tools_cache.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\tools_cache.htm','D:\damaihu\xinyupingtai7\cache\default\founder\tools_cache.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<div class="container" id="cpcontainer">
	<div class="itemtitle">
		<h3>更新缓存</h3>
		<ul class="stepstat">
			<li class="current" id="step1">1.确认开始</li>
			<li id="step2">2.开始更新</li>
			<li id="step3">3.更新结果</li>
		</ul>
	</div>
	<table class="tb tb2 " id="tips">
		<tr>
			<th  class="partition">技巧提示</th>
		</tr>
		<tr>
			<td class="tipsblock"><ul id="tipslis">
					<li>当论坛进行了数据恢复、升级或者工作出现异常的时候，您可以使用本功能重新生成缓存。更新缓存的时候，可能让服务器负载升高，请尽量避开会员访问的高峰时间</li>
					<li>数据缓存：更新论坛的版块设置、全局设置、用户组设置、权限设置等缓存</li>
					<li>模板缓存：更新论坛模板、风格等缓存文件，当您修改了模板或者风格，但是没有立即生效的时候使用</li>
				</ul></td>
		</tr>
	</table>
	<script language="javascript">
	var cache_update=function(){';echo '
		var type=\'\';
		$(\'@input[name=type[]]\').each(function(){';echo '
			if($(this).attr(\'checked\')){';echo '
				if(type)type+=\'&\';
				type+=\'type[]=\'+$(this).val();
			';echo '}
		';echo '})
		if(type){';echo '
			$(\'#step1\').removeClass(\'current\');
			$(\'#step2\').addClass(\'current\');
			type+=\'&hash=\'+$(\'#hash\').val();
			$(\'.infobox\').html(\'<h4 class="infotitle1">正在更新缓存，请稍候......</h4><img src="';echo $weburl2;echo 'images/ajax_loader.gif" class="marginbot" /><p class="marginbot"><a href="javascript:;" onclick="cache_update()" class="lightlink">如果您的浏览器没有自动跳转，请点击这里</a></p>\');
			$.ajax({';echo '
				type:\'post\',
				url:\'';echo $base_url;echo '\',
				data:type,
				success:function(html){';echo '
					$(\'#step2\').removeClass(\'current\');
					$(\'#step3\').addClass(\'current\');
					$(\'.infobox\').html(\'<h4 class="infotitle2">全部缓存更新完毕。</h4>\');
				';echo '}
			';echo '});
		';echo '}
	';echo '}
	$(function(){';echo '
		$(\'#confirmed\').click(function(){';echo '
			cache_update();
		';echo '});
	';echo '})
	</script>
	<div class="infobox">
		<form method="post" action="admincp.php?action=tools&operation=updatecache&step=2">
			<input type="hidden" name="hash" id="hash" value="';echo $sys_hash;echo '">
			<br />
			<h4 class="marginbot normal">
				<input type="checkbox" name="type[]" value="data" id="datacache" class="checkbox" checked />
				<label for="datacache">数据缓存</label>
				<input type="checkbox" name="type[]" value="tpl" id="tplcache" class="checkbox" checked />
				<label for="tplcache">模板缓存</label>
			</h4>
			<br />
			<p class="margintop">
				<input type="button" class="btn" name="confirmed" id="confirmed" value="确定">
				&nbsp;
				<input type="button" class="btn" value="取消" onClick="history.go(-1);">
			</p>
		</form>
		<br />
	</div>
</div>

';echo '</body>
</html>';?>