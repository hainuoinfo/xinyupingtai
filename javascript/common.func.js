var common = {
	datas : {},
	backupCss : function(obj, name, keys){
		var data = {};
		for (var k in keys) {
			var v = keys[k];
			var v2 = $(obj).css(v);
			if (!v2) v2 = '';
			data[v] = v2;
		}
		this.datas[name] = data;
	},
	comebackCss : function(obj, name){
		var data = this.datas[name];
		
		for (var k in data) {
			var v = data[k];//alert(k + '|' + v);
			//if (k == 'position') $(obj).css({'position' : v});
			$(obj).css(k, v);
			//$.curCSS(obj[0], k, v);
		}
	}
};
var check_all=function(e,name){
	var check=$(e).attr('checked');
	var all_check=document.getElementsByName(name);
	for(var i=0;i<all_check.length;i++){
		if(!all_check[i].disabled){
			all_check[i].checked=check;
		}
	}
};
$.fn.waitImg=function(show){
	if(show==void(0))show=true;
	var obj=$(this);
	var id='waitImg_'+obj.attr('id');
	if(show){
		//show
		if($('#'+id).length==0){
			var offset=obj.offset();
			var left=offset.left+obj.width()/2-16;
			var top =offset.top+obj.height()/2-16;
			$(document.body).append('<img src="'+weburl2+'images/wait.gif" id="'+id+'" style="width:32px; height:32px; left:'+left+'px; top:'+top+'px; position:absolute;" />');
		}
	} else {
		//hidden
		if($('#'+id).length>0){
			$('#'+id).remove();
		}
	}
	return obj;
};
$.fn.overflow = function(show){
	if (show == void(0)) show = true;
	var id = 'css_' + $(this).attr('sourceIndex');
	if (show) {	
		common.backupCss(this, id, ['left', 'top', 'width', 'height', 'overflow', 'position', 'background', 'border']);
		var offset = $(this).offset();
		$(this).css({
			left       : (offset.left - 1) + 'px', 
			top        : (offset.top  - 1) + 'px', 
			width      : 'auto', 
			height     : 'auto', 
			position   : 'absolute', 
			background : '#FFFBFB',
			border     : '1px solid #FFAAAA'
		});
	} else {
		common.comebackCss(this, id);
	}
};
$.fn.getData=function(url,postData,callBack){
	var post=false;
	if(postData==void(0))postData=false;
	if(postData)post=true;
	if(callBack==void(0))callBack=false;
	var obj=$(this);
	if(!post){
		$.ajax({
			type:'GET',
			url:url,
			success:function(data){
				obj.val(data);
				if(callBack)callBack();
			},
			error:function(){
				if(callBack)callBack();
			}
		});
	} else {
		$.ajax({
			type:'POST',
			url:url,
			data:postData,
			success:function(data){
				obj.val(data);
				if(callBack)callBack();
			},
			error:function(){
				if(callBack)callBack();
			}
		});
	}
	return obj;
};
$.fn.resetPwd2=function(){
	if (confirm('您确认顶要重置操作码吗？')) {
		var obj=$(this);
		obj.attr({disabled: true});
		$.ajax({
			type:'POST',
			url:weburl2+'ajax/resetPwd2.php',
			data:'hash2='+sys_hash2,
			success:function(data){
				alert(data);
				obj.attr({disabled: false});
			},
			error:function(){
				alert('系统遇到错误，请重试！');
				obj.attr({disabled: false});
			}
		});
	}
};
$.fn.checked=function(checked){
	if (checked == void(0)) checked = -1;
	if (checked >=0 ) {
		var obj = $(this)[checked];
		if (obj) {
			$(obj).attr({checked:true});
			$(obj).click();
			return $(obj).val();
		}
	} else {
		var ck = false;
		$(this).each(function(){
			if ($(this).attr('checked')) {
				ck = true;
				return false;
			}
		});
		return ck;
	}
};
$.fn.rVal=function(){
	var v='';
	$(this).each(function(){
		if ($(this).attr('checked')) {
			v = $(this).val();
			return false;
		}
	});
	return v;
}
var dragStatus = {};
$.getMousePosition = function(e){
	var posx = 0;
	var posy = 0;

	if (!e) var e = window.event;

	if (e.pageX || e.pageY) {
		posx = e.pageX;
		posy = e.pageY;
	}
	else if (e.clientX || e.clientY) {
		posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
		posy = e.clientY + document.body.scrollTop  + document.documentElement.scrollTop;
	}

	return { 'x': posx, 'y': posy };
};
$.updatePosition = function(e) {
	var pos = $.getMousePosition(e);

	var spanX = (pos.x - lastMouseX);
	var spanY = (pos.y - lastMouseY);

	$(currentElement).css("top",  (lastElemTop + spanY));
	$(currentElement).css("left", (lastElemLeft + spanX));

};
$.fn.easydrag = function(allowBubbling){

	return this.each(function(){

		// if no id is defined assign a unique one
		if(undefined == this.id || !this.id.length) this.id = "easydrag"+(new Date().getTime());

		// set dragStatus 
		dragStatus[this.id] = "on";
		
		// change the mouse pointer
		$(this).css("cursor", "move");

		// when an element receives a mouse press
		$(this).mousedown(function(e){

			// set it as absolute positioned
			$(this).css("position", "absolute");

			// set z-index
			$(this).css("z-index", "10000");

			// update track variables
			isMouseDown    = true;
			currentElement = this;

			// retrieve positioning properties
			var pos    = $.getMousePosition(e);
			lastMouseX = pos.x;
			lastMouseY = pos.y;

			lastElemTop  = this.offsetTop;
			lastElemLeft = this.offsetLeft;

			$.updatePosition(e);

			return allowBubbling ? true : false;
		});
	});
};
$.fn.runfloatwin=function() {
	this.hide();
	this.easydrag(true);
	//$("#floatwin").ondrop(function(e, element){ alert(element + " Dropped"); });

	mleft=(document.documentElement.clientWidth-parseFloat (this.width()))/2+document.documentElement.scrollLeft;
	mtop=(document.documentElement.clientHeight -parseFloat (this.height()))/2+document.documentElement.scrollTop;

	this.css({ 'left': mleft, 'top': mtop, 'cursor':'default' });

	this.show("normal");
}



var isSubmitFlag = false;
var isAlert = true;
var userAgent = navigator.userAgent.toLowerCase();
var is_opera = userAgent.indexOf("opera") != -1 && opera.version();
var is_moz = (navigator.product == "Gecko") && userAgent.substr(userAgent.indexOf("firefox") + 8, 3);
var is_ie = (userAgent.indexOf("msie") != -1 && !is_opera) && userAgent.substr(userAgent.indexOf("msie") + 5, 3);
var is_ie7 = parseFloat(userAgent.substr(userAgent.indexOf("msie") + 5, 3)) > 6;
String.prototype.trim = function() {
	return this.replace(/(^\s*)|(\s*$)/g, "");
};
function copy(a) {
	if (is_ie) {
		clipboardData.setData("Text", a);
		alert("复制成功");
	} else {
		if (prompt("请你使用 Ctrl+C 复制到剪贴板", a)) {
			alert("复制成功")
		}
	}
	return false;
}
var copyText=function(text){
	window.clipboardData.setData('Text',text);
}
function avoidReSubmit(a) {
	dialog(400, 250, "正在提交数据", "", "<div class='submiting'>正在提交数据，请耐心等待!</div>");
	if (a) {
		$('#'+a).attr({disabled: true});
	}
	allReadonly();
	if (isSubmitFlag) {
		alert("正在提交数据，请耐心等待，无需重复提交");
		return false
	} else {
		isSubmitFlag = true
	}
	return true
}

function dialog(k, c, j, a, e) {
	if ($('#'+"shadow").length > 0) {
		return false;
	}
	var l = $('<div id="shadow" class="shadow" style="width:'+$(document).width()+'px;height:'+$(document).height()+'px"></div>');
	$(document.body).append(l);
	var f = $('#'+"dialog");
	if (f.length > 0) {
		f.remove();
	}
	f = $('<div id="dialog" class="dialog"></div>');
	f.css({
		marginLeft: "-" + k / 2 + "px",
		width     : k + 'px',
		height    : c + 'px'
	});
	if (is_ie7 || is_moz) {
		f.css({
			marginTop: "-" + c / 2 + "px",
			position : "fixed"
		});
	} else {
		var d = parent.document.body.scrollTop + parent.document.documentElement.scrollTop;
		var b = d + 80;
		var g = b > 0 ? b: 0;
		f.css({top: g + 'px'});
	}
	var m = '<div class="dialog_t"></div><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="dialog_s"></td><td><div class="dialog_r"><div class="dialog_bar"><span style="float:left; padding-left:10px;" id="dialog_title">' + j + '</span><span onclick="doCut();" id="ff_ss" style="cursor:pointer;float:right; padding-right:10px;">×</span></div><div id="dialogBody" style="background:#FFF; height:' + (c - 16) + 'px;border:1px solid #FFF">';
	if (a) {
		if (a.indexOf("?") < 0) {
			a += "?";
		}
		a += "&thime=" + Math.random();
		m += '<iframe src="' + a + '" width="' + (k - 16) + 'px" height="' + (c - 16) + 'px" frameborder="0" scrolling="auto"></iframe>';
	} else {
		m += e;
	}
	m += '</div></div></td><td class="dialog_s"></td></tr></table><div class="dialog_t"></div>';
	f.html(m);
	$(document.body).append(f);
	this.doCut = function() {
		//f.style.display = "none";
		//document.body.removeChild(l);
		f.hide();
		l.remove();
	};
	this.doCut2 = function(h) {
		reflesh(h)
		/*if (h)reflesh(h);
		else {
			f.hide();
			l.remove();
		}*/
	}
}

function reflesh(a) {
	if (a) {
		window.location.href = a;
	} else {
		//window.location.href = window.location.href;
		window.location.reload();
	}
}

function allReadonly() {
	/*var b = document.getElementsByTagName("input");
	for (var a = 0; a < b.length; a++) {
		b[a].readOnly = true
	}
	b = document.getElementsByTagName("textarea");
	for (var a = 0; a < b.length; a++) {
		b[a].readOnly = true
	}*/
	$('input').each(function(){
		$(this)	.attr({readOnly: true});
	});
	$('textarea').each(function(){
		$(this).attr({readOnly: true});
	});
}

function goBack() {
	window.location.href = document.referrer;
	return false
}
function getObj(a) {
	return (typeof(a) == "object") ? a: document.getElementById(a)
}
function getValue(a) {
	return $('#'+a).val();
}
function getRV(b) {
	var d = "";
	var a = document.getElementsByName(b);
	for (var c = 0; c < a.length; c++) {
		if (a[c].checked) {
			d = a[c].value
		}
	}
	return d
}
function setValue(b, a) {
	$('#'+b).val(a);
}
function hide(b) {
	var a = $('#'+b);
	if (a) {
		a.style.display = "none"
	}
}
function show(b) {
	var a = $('#'+b);
	if (a) {
		a.style.display = ""
	}
}
function PageQuery(a) {
	if (a.length > 1) {
		this.q = a.substr(1)
	} else {
		this.q = null
	}
	this.keyValuePairs = new Array();
	if (this.q) {
		for (var b = 0; b < this.q.split("&").length; b++) {
			this.keyValuePairs[b] = this.q.split("&")[b]
		}
	}
	this.getKeyValuePairs = function() {
		return this.keyValuePairs
	};
	this.getValue = function(d) {
		for (var c = 0; c < this.keyValuePairs.length; c++) {
			if (this.keyValuePairs[c].split("=")[0] == d) {
				return this.keyValuePairs[c].split("=")[1]
			}
		}
		return false
	};
	this.getParameters = function() {
		var c = new Array(this.getLength());
		for (var d = 0; d < this.keyValuePairs.length; d++) {
			c[d] = this.keyValuePairs[d].split("=")[0]
		}
		return c
	};
	this.getLength = function() {
		return this.keyValuePairs.length
	}
}
function setQS() {
	var b = new PageQuery(window.location.search);
	var c = "";
	for (var a = 0; a < b.getLength(); a++) {
		c = b.getParameters()[a];
		if ($('#'+c)) {
			$('#'+c).value = unescape(decodeURI(b.getValue(c)))
		}
	}
}
function getQuery(a) {
	var b = document.location.search.substr(1).split("&");
	for (i = 0; i < b.length; i++) {
		var c = b[i].split("=");
		if (c.length > 1 && c[0] == a) {
			return c[1]
		}
	}
	return ""
}
function addClass(b, a) {
	var c = b.className.trim();
	if (c.indexOf(a) < 0) {
		b.className = c + " " + a
	}
}
function removeClass(b, a) {
	var c = b.className.trim();
	if (c.indexOf(a) >= 0) {
		b.className = c.replace(a, "")
	}
}
function showQQ(a) {
	if (a) {
		document.write("<a href='tencent://message/?uin=" + a + "'><img width='25' height='17' border='0'  src='http://wpa.qq.com/pa?p=1:" + a + ":17' alt='' /></a>")
	}
}
function addEvent(c, b, a) {
	if (c.attachEvent) {
		c["e" + b + a] = a;
		c[b + a] = function() {
			c["e" + b + a](window.event)
		};
		c.attachEvent("on" + b, c[b + a])
	} else {
		c.addEventListener(b, a, false)
	}
}
function removeEvent(c, b, a) {
	if (c.detachEvent) {
		c.detachEvent("on" + b, c[b + a]);
		c[b + a] = null
	} else {
		c.removeEventListener(b, a, false)
	}
}
function doCheck(checks) {
	var result = true;
	isAlert = true;
	for (var i = 0; i < checks.length; i++) {
		var check = checks[i];
		var str = "";
		try {
			for (var j = 0; j < check.length; j++) {
				if (j == 0) {
					str = check[0] + "('"
				}
				if (j == (check.length - 1)) {
					str += check[j] + "')"
				} else {
					if (j > 0) {
						str += check[j] + "','"
					}
				}
			}
			result = eval(str)
		} catch(e) {
			alert(str)
		}
		if (!result && isAlert) {
			isAlert = false
		}
	}
	result = result && isAlert;
	isAlert = true;
	return result
}
function isMatch(b, a) {
	return b.test(a.trim())
}
function doAlert(c, b) {
	b.addClass('txt_fail');
	b.keyup(function(){
		if (event.keyCode > 30) {
			$(this).removeClass("txt_fail");
		}
	});
	b.attr({title:c});
	if (isAlert) {
		alert(c);
		try {
			b.focus()
		} catch(a) {
			
		}
	}
	return false
}
function isEmpty(c, a) {
	if (arguments.length == 1) {
		if (c.trim() == "") {
			return false
		} else {
			return true
		}
	} else {
		var b = $('#'+c);
		if (b.val().trim() == "") {
			return doAlert(a + "  不能为空", b)
		} else {
			return true
		}
	}
}
function isLength(e, b, c, a) {
	var d = $('#'+e);
	if (d.val().trim().length < c || d.val().trim().length > a) {
		if (c == a) {
			return doAlert(b + "  长度必须为 " + c + "位", d)
		} else {
			return doAlert(b + "  长度范围为 " + c + "～" + a, d)
		}
	} else {
		return true
	}
}
function isEqual(c, b, g, f, a) {
	if (arguments.length == 2) {
		return c.trim() == b.trim()
	} else {
		var e = $('#'+c);
		var d = $('#'+b);
		if (e.val().trim() == d.val().trim()) {
			if (a) {
				return doAlert(g + " 和 " + f + "  不允许相同", d)
			} else {
				return true
			}
		} else {
			if (a) {
				return true
			} else {
				return doAlert(g + " 和 " + f + "  不一致", d)
			}
		}
	}
}
function isRange(e, b, c, a) {
	var d = $('#'+e);
	if (parseFloat(d.val().trim()) < c || parseFloat(d.val().trim()) > a) {
		return doAlert(b + "  数值范围为 " + c + "～" + a, d)
	} else {
		return true
	}
}
function isNum(c, a) {
	if (arguments.length == 1) {
		return isMatch(/^\d*$/, c.trim())
	} else {
		var b = $('#'+c);
		if (!isMatch(/^\d*$/, b.val())) {
			return doAlert(a + "  必须为数字", b)
		} else {
			return true
		}
	}
}
function isNumber(c, a) {
	if (arguments.length == 1) {
		return isMatch(/^\d*$/, c.trim())
	} else {
		var b = $('#'+c);
		if (!isMatch(/^\d+$/, b.val())) {
			return doAlert(a + "  必须为整数", b)
		} else {
			return true
		}
	}
}
function isEmail(e, b, a) {
	if (arguments.length == 1) {
		if (isEmpty(e)) {
			return false
		}
		var c = /^[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
		return isMatch(c, e)
	} else {
		var d = $('#'+e);
		if (!a) {
			if (!isEmpty(d.val())) {
				return true
			}
		}
		var c = /^[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
		if (!isMatch(c, d.val())) {
			return doAlert(b + "  不是有效的电子邮件地址", d)
		} else {
			return true
		}
	}
}
function isStock(c, a) {
	if (arguments.length == 1) {
		return isMatch(/^\d+(\.\d{1,2})?$/, c.trim())
	} else {
		var b = $('#'+c);
		if (!isMatch(/^\d+(\.\d{1,2})?$/, b.val())) {
			return doAlert(a + "  小数点后只允许两位", b)
		} else {
			return true
		}
	}
}
function isMoney(c, a) {
	if (arguments.length == 1) {
		return isMatch(/^[+-]?\d*(,\d{3})*(\.\d+)?$/g, c.trim())
	} else {
		var b = $('#'+c);
		if (!isMatch(/^[+-]?\d*(,\d{3})*(\.\d+)?$/g, b.val())) {
			return doAlert(a + "  不是有效的数字", b)
		} else {
			return true
		}
	}
}
function checkAll(c, d, b) {
	var b = b ? b: "chkall";
	for (var a = 0; a < c.elements.length; a++) {
		var f = c.elements[a];
		if (f.name && f.name != b && (!d || (d && f.name.match(d)))) {
			f.checked = c.elements[b].checked
		}
	}
}
function thumbImg(b, a) {
	if (b.width > a) {
		b.height = b.height * a / b.width;
		b.width = a;
		b.title = "新窗口打开预览";
		b.style.cursor = "pointer";
		b.onclick = function() {
			openDynaWin("图片预览", "<img src='" + b.src + "' />")
		}
	}
}
function openDynaWin(c, b) {
	var d = "<html><head><title>" + c + " - 花兔兔</title></head><body><table align='center' width='100%'><tr><td align='center' >";
	d += b + "</td></tr><tr><td align='center'><input type='button' style='font-size:9pt' value='关闭窗口' onclick='javascript:window.close()'></td></tr></table></body></html>";
	var a = window.open();
	a.document.write(d);
	a.document.close()
};
var htmlspecialchars = function(string){
	var data = [];
	for(var i = 0 ;i <string.length;i++) {
		data.push( "&#"+string.charCodeAt(i)+";");
	}
	return data.join("");
};