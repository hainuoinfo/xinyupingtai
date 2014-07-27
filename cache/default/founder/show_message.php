<?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<link href="http://damaihu.tertw.net/css/founder/founder.css" rel="stylesheet" type="text/css" /><script type="text/javascript" src="http://damaihu.tertw.net/javascript/common.js"></script>
</head>
<body>
<div id="append_parent"></div>
<div class="container" id="cpcontainer">
	<h3>';echo SYSTEM_NAME;echo ' 提示</h3>
	<div class="infobox">
		<h4 class="infotitle2">';echo $message;echo '</h4>
		<p class="marginbot"><a href="';echo $goto;echo '" class="lightlink"';if($parent){echo ' target="_top"';}echo '>如果您的浏览器没有自动跳转，请点击这里</a></p>
		<script type="text/JavaScript">setTimeout(function(){';echo '
			';if($parent){echo 'parent.';}echo 'location.href=\'';echo $goto;echo '\';
		';echo '}, 2000);</script>
	</div>
</div>
</body>
</html>
';?>