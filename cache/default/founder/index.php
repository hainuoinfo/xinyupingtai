<?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>阿里CMS 管理中心</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="Comsenz Inc." name="Copyright" />
<link href="http://damaihu.tertw.net/css/founder/founder.css" rel="stylesheet" type="text/css" /><script type="text/javascript" src="http://damaihu.tertw.net/javascript/common.js"></script>
</head>
<body style="margin: 0px" scroll="no">
<div id="append_parent"></div>
<table cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="2" height="90"><div class="mainhd">
				<div class="logo">Administrator\'s Control Panel</div>
				<div class="uinfo">
					<p>您好, <em>';echo $admin['username'];echo '</em> [ <a href="index.php?action=logout" target="_top">退出</a> ]</p>
					<p class="btnlink"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/" target="_blank">网站首页</a></p>
				</div>
				<div class="navbg"></div>
				<div class="nav">
					<ul id="topmenu">
						';if($menus){foreach($menus as $k=>$v){echo '
						<li><em><a href="javascript:;" id="header_';echo $k;echo '" hidefocus="true" onClick="toggleMenu(\'';echo $k;echo '\', \'\');">';echo $v['name'];echo '</a></em></li>
						';}}echo '
						
					</ul>
					<div class="currentloca">
						<p id="admincpnav"></p>
					</div>
					<div class="navbd"></div>
					<div class="sitemapbtn">
						<div style="float: left; margin:-5px 10px 0 0">
							
						</div>
						<span id="add2custom"></span>  </div>
				</div>
			</div></td>
	</tr>
	<tr>
		<td valign="top" width="160" class="menutd"><div id="leftmenu" class="menu">
				';if($menus){foreach($menus as $k=>$v){echo '
				<ul id="menu_';echo $k;echo '" style="display: none">
					';if($v['sub']){foreach($v['sub'] as $k2=>$v2){echo '
					';if(!is_array($v2)||!$v2['hide']){echo '
					<li><a href="index.php?action=';echo $k;echo '&operation=';echo $k2;echo '" hidefocus="true" target="main">';if(is_array($v2)){echo '';echo $v2['name'];echo '';}else{echo '';echo $v2;echo '';}echo '</a></li>
					';}echo '
					';}}echo '
				</ul>
				';}}echo '
			</div></td>
		<td valign="top" width="100%" class="mask" id="mainframes"><iframe src="" id="main" name="main" onload="mainFrame(0)" width="100%" height="100%" frameborder="0" scrolling="yes" style="overflow: visible;display:"></iframe></td>
	</tr>
</table>
<div class="custombar" id="custombarpanel"> &nbsp;<span id="custombar"></span><span id="custombar_add"></span> </div>
<div id="scrolllink" style="display: none"> <span onClick="menuScroll(1)"><img src="';echo $weburl2;echo 'css/founder/scrollu.gif" /></span> <span onClick="menuScroll(2)"><img src="';echo $weburl2;echo 'css/founder/scrolld.gif" /></span> </div>
<div class="copyright">
	<p>Powered by <a href="http://www.szwlweb.com/" target="_blank">优科网络</a> 1.0</p>
	<p>&copy; 2012-2015, <a href="http://www.szwlweb.com/" target="_blank">szwl Inc.</a></p>
</div>
<div id="cpmap_menu" class="custom" style="display: none">
	<div class="cside">
		<h3><span class="ctitle1"></span><a href="javascript:;" onClick="toggleMenu(\'tool\', \'misc&operation=custommenu\');hideMenu();" class="cadmin">管理</a></h3>
		<ul class="cslist" id="custommenu">
		</ul>
	</div>
	<div class="cmain" id="cmain"></div>
	<div class="cfixbd"></div>
</div>
<script type="text/JavaScript">
	var headers = new Array(\'';echo implode("','",array_keys($menus));echo '\');
	var admincpfilename = \'index.php\';
	var menukey = \'\', custombarcurrent = 0;
	var get_admin_menu=function(){';echo '
		var x=new Ajax(\'HTML\');
		x.get(\'';echo $admin_url;echo '?action=sys&operation=menu&method=get\',function(html){';echo '
			$(\'custombar\').innerHTML=html;
			top.custombar_resize();
		';echo '});
	';echo '}
	var add_admin_menu=function(action,operation){';echo '
		if(action==void(0))action=\'\';
		if(operation==void(0))operation=\'\';
		var x=new Ajax(\'HTML\');
		x.get(\'';echo $admin_url;echo '?action=sys&operation=menu&add=action%3D\'+action+\'%26operation%3D\'+operation,function(html){';echo '
			var get_menu=false;
			try{';echo '
				eval(\'var rs=\'+html);
				if(rs.status)get_menu=true;
				else get_menu=false;
			';echo '} catch(e) {';echo '
				
			';echo '}
			get_menu && get_admin_menu();
		';echo '})
	';echo '}
	var del_admin_menu=function(id){';echo '
		if(id==void(0))id=0;
		var x=new Ajax(\'HTML\');
		if(id){';echo '
			x.get(\'';echo $admin_url;echo '?action=sys&operation=menu&del=\'+id,function(html){';echo '
				var get_menu=false;
				try{';echo '
					eval(\'var rs=\'+html);
					if(rs.status)get_menu=true;
					else get_menu=false;
				';echo '} catch(e) {';echo '
					
				';echo '}
				get_menu && get_admin_menu();
			';echo '})
		';echo '}
	';echo '}
	function toggleMenu(key, url) {';echo '
		
		menukey = key;
		for(var k in headers) {';echo '
			if($(\'menu_\' + headers[k])) {';echo '
				$(\'menu_\' + headers[k]).style.display = headers[k] == key ? \'\' : \'none\';
			';echo '}
		';echo '}
		var lis = $(\'topmenu\').getElementsByTagName(\'li\');
		for(var i = 0; i < lis.length; i++) {';echo '
			if(lis[i].className == \'navon\') lis[i].className = \'\';
		';echo '}
		$(\'header_\' + key).parentNode.parentNode.className = \'navon\';
		if(url) {';echo '
			parent.mainFrame(0);
			parent.main.location = admincpfilename + \'?action=\' + url;
			var hrefs = $(\'menu_\' + key).getElementsByTagName(\'a\');
			for(var j = 0; j < hrefs.length; j++) {';echo '
				hrefs[j].className = hrefs[j].href.substr(hrefs[j].href.indexOf(admincpfilename + \'?action=\') + 19) == url ? \'tabon\' : (hrefs[j].className == \'tabon\' ? \'\' : hrefs[j].className);
			';echo '}
		';echo '}
		setMenuScroll();
		return false;
	';echo '}
	function setMenuScroll() {';echo '
		var obj = $(\'menu_\' + menukey);
		var scrollh = document.body.offsetHeight - 160;
		obj.style.overflow = \'visible\';
		obj.style.height = \'\';
		$(\'scrolllink\').style.display = \'none\';
		if(obj.offsetHeight + 150 > document.body.offsetHeight && scrollh > 0) {';echo '
			obj.style.overflow = \'hidden\';
			obj.style.height = scrollh + \'px\';
			$(\'scrolllink\').style.display = \'\';
		';echo '}
		custombar_resize();
	';echo '}
	function menuScroll(op, e) {';echo '
		var obj = $(\'menu_\' + menukey);
		var scrollh = document.body.offsetHeight - 160;
		if(op == 1) {';echo '
			obj.scrollTop = obj.scrollTop - scrollh;
		';echo '} else if(op == 2) {';echo '
			obj.scrollTop = obj.scrollTop + scrollh;
		';echo '} else if(op == 3) {';echo '
			if(!e) e = window.event;
			if(e.wheelDelta <= 0 || e.detail > 0) {';echo '
				obj.scrollTop = obj.scrollTop + 20;
			';echo '} else {';echo '
				obj.scrollTop = obj.scrollTop - 20;
			';echo '}
		';echo '}
	';echo '}
	function initCpMenus(menuContainerid) {';echo '
		var key = \'\';
		var hrefs = $(menuContainerid).getElementsByTagName(\'a\');
		for(var i = 0; i < hrefs.length; i++) {';echo '
			if(menuContainerid == \'leftmenu\' && !key && \'action=home\'.indexOf(hrefs[i].href.substr(hrefs[i].href.indexOf(admincpfilename + \'?action=\') + 12)) != -1) {';echo '
				key = hrefs[i].parentNode.parentNode.id.substr(5);
				hrefs[i].className = \'tabon\';
			';echo '}
			if(!hrefs[i].getAttribute(\'ajaxtarget\')) hrefs[i].onclick = function() {';echo '
				if(menuContainerid != \'custommenu\') {';echo '
					var lis = $(menuContainerid).getElementsByTagName(\'li\');
					for(var k = 0; k < lis.length; k++) {';echo '
						if(lis[k].firstChild.className != \'menulink\') lis[k].firstChild.className = \'\';
					';echo '}
					if(this.className == \'\') this.className = menuContainerid == \'leftmenu\' ? \'tabon\' : \'bold\';
				';echo '}
				if(menuContainerid != \'leftmenu\') {';echo '
					var hk, currentkey;
					var leftmenus = $(\'leftmenu\').getElementsByTagName(\'a\');
					for(var j = 0; j < leftmenus.length; j++) {';echo '
						hk = leftmenus[j].parentNode.parentNode.id.substr(5);
						if(this.href.indexOf(leftmenus[j].href) != -1) {';echo '
							leftmenus[j].className = \'tabon\';
							if(hk != \'index\') currentkey = hk;
						';echo '} else {';echo '
							leftmenus[j].className = \'\';
						';echo '}
					';echo '}
					if(currentkey) toggleMenu(currentkey);
					hideMenu();
				';echo '}
			';echo '}
		';echo '}
		return key;
	';echo '}
	var header_key = initCpMenus(\'leftmenu\');
	toggleMenu(header_key ? header_key : \'';echo $defTab;echo '\');
	function initCpMap() {';echo '
		var ul, hrefs, s;
		s = \'<ul class="cnote"><li><img src="images/admincp/btn_map.gif" /></li><li> 按 “ ESC ” 键展开 / 关闭此菜单</li></ul><table class="cmlist" id="mapmenu"><tr>\';

		for(var k in headers) {';echo '
			if(headers[k] != \'index\' && headers[k] != \'uc\') {';echo '
				s += \'<td valign="top"><ul class="cmblock"><li><h4>\' + $(\'header_\' + headers[k]).innerHTML + \'</h4></li>\';
				ul = $(\'menu_\' + headers[k]);
				hrefs = ul.getElementsByTagName(\'a\');
				for(var i = 0; i < hrefs.length; i++) {';echo '
					s += \'<li><a href="\' + hrefs[i].href + \'" target="\' + hrefs[i].target + \'" k="\' + headers[k] + \'">\' + hrefs[i].innerHTML + \'</a></li>\';
				';echo '}
				s += \'</ul></td>\';
			';echo '}
		';echo '}
		s += \'</tr></table>\';
		return s;
	';echo '}
	$(\'cmain\').innerHTML = initCpMap();
	initCpMenus(\'mapmenu\');
	var cmcache = false;
	function showMap() {';echo '
		showMenu({';echo '\'ctrlid\':\'cpmap\',\'evt\':\'click\', \'duration\':3, \'pos\':\'00\'';echo '});
		if(!cmcache) ajaxget(admincpfilename + \'?action=misc&operation=custommenu&\' + Math.random(), \'custommenu\', \'\');
	';echo '}
	function resetEscAndF5(e) {';echo '
		e = e ? e : window.event;
		actualCode = e.keyCode ? e.keyCode : e.charCode;
		if(actualCode == 27) {';echo '
			if($(\'cpmap_menu\').style.display == \'none\') {';echo '
				showMap();
			';echo '} else {';echo '
				hideMenu();
			';echo '}
		';echo '}
		if(actualCode == 116 && parent.main) {';echo '
			if(custombarcurrent) {';echo '
				parent.$(\'main_\' + custombarcurrent).contentWindow.location.reload();
			';echo '} else {';echo '
				parent.main.location.reload();
			';echo '}
			if(document.all) {';echo '
				e.keyCode = 0;
				e.returnValue = false;
			';echo '} else {';echo '
				e.cancelBubble = true;
				e.preventDefault();
			';echo '}
		';echo '}
	';echo '}
	function uc_left_menu(uc_menu_data) {';echo '
		var leftmenu = $(\'menu_uc\');
		leftmenu.innerHTML = \'\';
		var html_str = \'\';
		for(var i=0;i<uc_menu_data.length;i+=2) {';echo '
			html_str += \'<li><a href="\'+uc_menu_data[(i+1)]+\'" hidefocus="true" onclick="uc_left_switch(this)" target="main">\'+uc_menu_data[i]+\'</a></li>\';
		';echo '}
		leftmenu.innerHTML = html_str;
		toggleMenu(\'uc\', \'\');
		$(\'admincpnav\').innerHTML = \'UCenter\';
	';echo '}
	var uc_left_last = null;
	function uc_left_switch(obj) {';echo '
		if(uc_left_last) {';echo '
			uc_left_last.className = \'\';
		';echo '}
		obj.className = \'tabon\';
		uc_left_last = obj;
	';echo '}
	function uc_modify_sid(sid) {';echo '
		$(\'header_uc\').href = \'http://www.bbs.com/uc/admin.php?m=frame&a=main&iframe=1&sid=\' + sid;
	';echo '}

	function mainFrame(id, src) {';echo '
		var setFrame = !id ? \'main\' : \'main_\' + id, obj = $(\'mainframes\').getElementsByTagName(\'IFRAME\'), exists = 0, src = !src ? \'\' : src;
		for(i = 0;i < obj.length;i++) {';echo '
			if(obj[i].name == setFrame) {';echo '
				exists = 1;
			';echo '}
			obj[i].style.display = \'none\';
		';echo '}
		if(!exists) {';echo '
			if(BROWSER.ie) {';echo '
				frame = document.createElement(\'<iframe name="\' + setFrame + \'" id="\' + setFrame + \'"></iframe>\');
			';echo '} else {';echo '
				frame = document.createElement(\'iframe\');
				frame.name = setFrame;
				frame.id = setFrame;
			';echo '}
			frame.width = \'100%\';
			frame.height = \'100%\';
			frame.frameBorder = 0;
			frame.scrolling = \'yes\';
			frame.style.overflow = \'visible\';
			frame.style.display = \'none\';
			if(src) {';echo '
				frame.src = src;
			';echo '}
			$(\'mainframes\').appendChild(frame);
		';echo '}
		if(id) {';echo '
			custombar_set(id);
		';echo '}
		$(setFrame).style.display = \'\';
		if(!src && custombarcurrent) {';echo '
			$(\'custombar_\' + custombarcurrent).className = \'\';
			custombarcurrent = 0;
		';echo '}
	';echo '}

	function custombar_update(deleteid) {';echo '
		var extra = !deleteid ? \'\' : \'&deleteid=\' + deleteid;
		if(deleteid && $(\'main_\' + deleteid)) {';echo '
			$(\'mainframes\').removeChild($(\'main_\' + deleteid));
			if(deleteid == custombarcurrent) {';echo '
				mainFrame(0);
			';echo '}
		';echo '}
		ajaxget(admincpfilename + \'?action=misc&operation=custombar\' + extra, \'custombar\', \'\', \'\', \'\', function () {';echo 'custombar_resize();';echo '});
	';echo '}
	function custombar_resize() {';echo '
		custombarfixw = document.body.offsetWidth - 180;
		$(\'custombarpanel\').style.width = custombarfixw + \'px\';
	';echo '}
	function custombar_scroll(op, e) {';echo '
		var obj = $(\'custombarpanel\');
		var step = 40;
		if(op == 1) {';echo '
			obj.scrollLeft = obj.scrollLeft - step;
		';echo '} else if(op == 2) {';echo '
			obj.scrollLeft = obj.scrollLeft + step;
		';echo '} else if(op == 3) {';echo '
			if(!e) e = window.event;
			if(e.wheelDelta <= 0 || e.detail > 0) {';echo '
				obj.scrollLeft = obj.scrollLeft + step;
			';echo '} else {';echo '
				obj.scrollLeft = obj.scrollLeft - step;
			';echo '}
		';echo '}
	';echo '}
	function custombar_set(id) {';echo '
		var currentobj = $(\'custombar_\' + custombarcurrent), obj = $(\'custombar_\' + id);
		if(currentobj == obj) {';echo '
			obj.className = \'current\';
			return;
		';echo '}
		if(currentobj) {';echo '
			currentobj.className = \'\';
		';echo '}
		obj.className = \'current\';
		custombarcurrent = id;
	';echo '}

	get_admin_menu();
	_attachEvent(document.documentElement, \'keydown\', resetEscAndF5);
	_attachEvent(window, \'resize\', setMenuScroll, document);
	if(BROWSER.ie){';echo '
		$(\'leftmenu\').onmousewheel = function(e) {';echo ' menuScroll(3, e) ';echo '};
		$(\'custombarpanel\').onmousewheel = function(e) {';echo ' custombar_scroll(3, e) ';echo '};
	';echo '} else {';echo '
		$(\'leftmenu\').addEventListener("DOMMouseScroll", function(e) {';echo ' menuScroll(3, e) ';echo '}, false);
		$(\'custombarpanel\').addEventListener("DOMMouseScroll", function(e) {';echo ' custombar_scroll(3, e) ';echo '}, false);
	';echo '}
</script>
</body>
</html>
';?>