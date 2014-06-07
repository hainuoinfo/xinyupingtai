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
var is_ie6 = parseFloat(userAgent.substr(userAgent.indexOf("msie") + 5, 3)) < 7;
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
	dialog(400, 250, "正在提交数据", "", "<div class='submiting'>正在提交数据，请耐心等待</div>");
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
function avoidReSubmit1(a) {
	dialog(510, 240, "正在提交数据", "", "<div class='xbox'><h2>充值遇到问题？ </h2><div class='ui-tip ui-tip-info'><span class='ui-tip-icon'></span><div class='ui-tip-text'>充值完成前请不要关闭此窗口。完成充值后请根据你的情况点击下面的按钮：</div></div><p class='clearf'><strong>请在新开网上储蓄卡页面完成付款后再选择。</strong></p><div class='active-link'><a class='ui-round-btn' href='/user/topupLog/' target='_parent'><span>已完成充值</span></a>　　　　　　<a class='ui-round-btn' href='http://wpa.qq.com/msgrd?v=3&uin=188239038&site=qq&menu=yes' target='_blank' ><span>充值遇到问题</span></a></div><p><a href='/user/topup/' target='_parent'><span class='ui-black'>返回重新选择充值方式</span></a></p></div>");
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
function safequestion(a,u,p,hash,time){
     comm_fram(413, 205, "安全问题", "", "<form id=qtform action='/user/login/' method=post name=myform><div class=safetyvalidate><div id=uv_content class=content><div class=in_content><p id=top_tip class=title>绑定安全问题到账号，请您验证安全问题。</p><div class='check clearfix'><div id=selsecter><ul><li><span class=label>选择安全问题：</span><select id=questionid class=ipt_select tabindex=3 name=questionid><option value='0' selected='selected'>无安全问题</option><option value='1'>早上几点起床？</option><option value='2'>最爱吃的菜？</option><option value='3'>好朋友的名字？</option><option value='4'>你的理想体重？</option><option value='5'>爱人的生日？</option></select></select></li></ul></div><div id=mbitems><div id=question style=><ul><li><span class=label>答案：</span><input class=inputstyle type=text name='answer' tabindex=4></li></ul></div></div><div id='answer_msg'></div></div></div><p id='question_reset_tip' class='tips_area li_warn'><a tabindex=11 target=_blank href='http://wpa.qq.com/msgrd?v=3&uin=188239038&site=qq&menu=yes'>忘记安全问题，无法验证？</a></p></div><div class=btn><input type=hidden value="+hash+" name='hash2'><input type=hidden value="+time+" name='login_cookietime'><input type=hidden value="+u+" name='username'><input type=hidden value="+p+" name='password'><input class=btn_em type='submit' tabindex='8' value='确 定'><input onclick='doCut();' class=btn_dft type='button' tabindex='9' value='取 消'></div></div></form>");
	if (a) {
		$('#'+a).attr({disabled: true});
	}
	if (isSubmitFlag) {
		alert("正在提交数据，请耐心等待，无需重复提交");
		return false
	} else {
		isSubmitFlag = true
	}
	return true
}
function dialog(k, c, j, a, e) {
	var k=615;
	if ($('#'+"fulldiv").length > 0) {
		return false;
	}
	var l = $('<div id="fulldiv" style="position:absolute; z-index:1000;left:0px;clear:both; top:0px;width:'+$(document).width()+'px;height:'+$(document).height()+'px;"></div>');
	$(document.body).append(l);
	var f = $('#'+"comm_615fram");
	if (f.length > 0) {
		f.remove();
	}
	f = $('<div id="comm_615fram" class="comm_615fram"></div>');
	f.css({
		marginLeft: "-" + k / 2 + "px",
		width     : k + 'px'
	});
	if (is_ie7 || is_moz) {
		f.css({
			marginTop: "-100px",
			position : "fixed"
		});
	} else {
		var d = parent.document.body.scrollTop + parent.document.documentElement.scrollTop;
		var b = d + 80;
		var g = b > 0 ? b: 0;
		f.css({top: g + 'px'});
	}
	var m = '<div class="comm_615fram_top"></div><div class="fram_615container"><div class="r_615title"><span id="round_615container">'+ j +'</span><a href="javascript:;" class="r_close" onclick="doCut();"></a></div><div class="fram_content">';
	if (a) {
		if (a.indexOf("?") < 0) {
			a += "?";
		}
		a += "&thime=" + Math.random();
		if(e=='scrool'){
			m += '<iframe src="' + a + '" width="' + (k - 16) + 'px" height="' + (c - 16) + 'px" frameborder="0" scrolling="yes"></iframe>';
		}else
		{
			m += '<iframe src="' + a + '" width="' + (k - 16) + 'px" height="' + (c - 16) + 'px" frameborder="0" scrolling="no"></iframe>';
		}
	} else {
		m += e;
	}
	m += '</div></div><div class="comm_615fram_bottom"></div>';
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
	};
	this.doCutgrade = function(h) {
		if (h){
		  getObj('grade_'+h).style.display="none";
		}
		f.hide();
		l.remove();
		
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
            alert(str);
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
	var d = "<html><head><title>" + c + " - 大麦户网</title></head><body><table align='center' width='100%'><tr><td align='center' >";
	d += b + "</td></tr><tr><td align='center'><input type='button' style='font-size:9pt' value='关闭窗口' onclick='javascript:window.close()'></td></tr></table></body></html>";
	var a = window.open();
	a.document.write(d);
	a.document.close()
};
//tab切换
//bechange('.tab a','.contchange>ul');
function bechange(tabswitch,curshow) {
        $(tabswitch).mouseover(function()
		{
            $(tabswitch).removeClass();
            $(this).addClass('nov');
            $(curshow).css('display','none');
            $( curshow +':nth-child(' + ($(tabswitch).index($(this)) + 1) + ')').css('display','block');
        });
}
function comm_720fram(k, c, j, a, e) {
	if ($('#'+"fulldiv").length > 0) {
		return false;
	}
	var l = $('<div id="fulldiv" style="position:absolute; clear:both; z-index:1000;left:0px; top:0px;width:100%; height:100%;"></div>');
	$(document.body).append(l);
	var f = $('#'+"comm_720fram");
	if (f.length > 0) {
		f.remove();
	}
	
	f = $('<div id="comm_720fram" class="comm_720fram"></div>');
	f.css({
		marginLeft: "-390px",
		marginTop: "-100px"
	});
	if (is_ie7 || is_moz) {
		f.css({
			position : "fixed"
		});
	} else {
		var d = parent.document.body.scrollTop + parent.document.documentElement.scrollTop;
		var b = d + 80;
		var g = b > 0 ? b: 0;
		f.css({top: g + 'px'});
	}
	var m = '<div class="comm_720fram_top"></div><div class="fram_720container"><div class="fram_720content">';
	if (a) {
		if (a.indexOf("?") < 0) {
			a += "?";
		}
		a += "&thime=" + Math.random();
		m += '<iframe src="' + a + '" width="' + (k - 56) + 'px" height="' + (c - 16) + 'px" frameborder="0" scrolling="no"></iframe>';
	} else {
		m += e;
	}
	m += '</div></div><div class="comm_720fram_bottom"></div>';
	f.html(m);
	$(document.body).append(f);
	this.doCut = function() {
		f.hide();
		l.remove();
	};
	this.doCut2 = function(h) {
		reflesh(h)
	}
}
function kefu_x(a,hash,tit,price){
     comm_fram(413, 205, "请确定购买信息", "", "<form id=qtform action='/user/buycards/' method=post name=myform><div style='height:150px;margin:0px 10px;'><p>"+tit+"</p><p>花费:"+price+"元，你确定购买吗？</p><p>请选择推荐人</p><p><select name='spreader'><option value=''> 无推荐人，自行购买</option><option value='xing'> 客服小粉推荐</option><option value='淡意的攸柔'> 客服小黄推荐</option><option value='wheat'> 客服小麦推荐</option><option value='小云123'> 客服小芸推荐</option><option value='wcx19910229'> 客服小雅推荐</option><option value='xieyun07302568'> 客服小丽推荐</option><option value='1347166276'> 客服小汤推荐</option><option value='chaofen'> 充值客服推荐</option></select></p><p style='text-align:right;padding:10px;'><input type='hidden' value="+hash+" name='hash2'><input type=hidden value="+a+" name='card'><input type=hidden value='add' name='type'><input type='submit' class='btn_em' value='确 定'><input onclick='doCut();' class=btn_dft type='button' tabindex='9' value='取 消'></p></div></form>");
}
function kefu_cx(a,hash,tit,price,val){
     comm_fram(413, 205, "请确定购买信息", "", "<form id=qtform  method=post name=myform><div style='height:150px;margin:0px 10px;'><p>"+tit+"</p><p>花费:"+price+"元，你确定购买吗？</p><p>请选择推荐人</p><p><select name='spreader'><option value=''> 无推荐人，自行购买</option><option value='xing'> 客服小粉推荐</option><option value='淡意的攸柔'> 客服小黄推荐</option><option value='wheat'> 客服小麦推荐</option><option value='小云123'> 客服小芸推荐</option><option value='wcx19910229'> 客服小雅推荐</option><option value='xieyun07302568'> 客服小丽推荐</option><option value='1347166276'> 客服小汤推荐</option><option value='chaofen'> 充值客服推荐</option></select></p><p style='text-align:right;padding:10px;'><input type='hidden' value="+hash+" name='hash2'><input type=hidden value="+a+" name='card'><input type=hidden value='add' name='type'><input type='submit' class='btn_em' value='确 定'><input name='cardType' type='hidden' value="+val+" /><input onclick='doCut();' class=btn_dft type='button' tabindex='9' value='取 消'></p></div></form>");
}
function dmhaddbank(hash,mobil,cashtype){
	 comm_fram(413, 235, "添加提现卡号", "", "<form id=qtform action='/user/addcasher/' method=post name=myform onsubmit='return checkcash();'><div style='height:200px;margin:0px 10px;'><div style='height:150px;font-size:13px;'><p style='height:25px;'>　您的提现银行：<select name='blank' style='width:155px;color:#333;'><option value='icbc'>中国工商银行</option><option value='boc'>中国银行</option><option value='ccb'>中国建设银行</option><option value='cmb'>中国招商银行</option><option value='comm'>中国交通银行</option><option value='abc'>中国农业银行</option></select></p><p style='height:25px;'>　　　真实姓名：<input type='text' name='blanktruename' style='text-indent:3px;width:220px;color:#999;' maxlength='7' id='casher_blanktruename' value='如银行户名：李四' onclick='if(this.value==\"如银行户名：李四\")this.value=\"\";' onblur='if(this.value==\"\")this.value=\"如银行户名：李四\";'></p><p>　您的银行账号：<input type='text' name='blankname' id='casher_blankname' maxlength='26' style='text-indent:3px;width:250px;color:#999;' value='如银行账号：6222023100032381111' onclick='if(this.value==\"如银行账号：6222023100032381111\")this.value=\"\";' onblur='if(this.value==\"\")this.value=\"如银行账号：6222023100032381111\";'></p><p style='height:25px;'>绑定的手机号码："+mobil+"</p><p style='height:25px;'>　　　　校验码：<input type='text' name='vcode' id='vcode' style='color:#999;'></p><p>　　　　　　　　<input type='button' name='getvcode' id='getvcode' value='获取验证码' onclick=\"parent.getvcode('120','"+hash+"','"+cashtype+"');\"></p></div><p class='btn' style='text-align:right;'><input type='hidden' value="+cashtype+" name='cashtype'><input type='hidden' value="+hash+" name='hash2'><input type='hidden' value='bank' name='type'><input type='submit' class='btn_em' value='立即绑定'><input onclick='doCut();' class=btn_dft type='button' tabindex='9' value='取 消'></p></div></form>");
	}
function dmhaddalipay(hash,mobil,cashtype){
	 comm_fram(413, 215, "添加提现卡号", "", "<form id=qtform action='/user/addcasher/' method=post name=myform onsubmit='return checkalipay();'><div style='height:180px;margin:0px 10px;'><div style='height:135px;font-size:13px;'><p>财付通真实姓名：<input type='text' name='blanktruename' id='casher_blankname' maxlength='26' style='text-indent:3px;width:250px;color:#999;'></p><p style='height:25px;'>您的财付通账号：<input type='text' name='blankname' style='text-indent:3px;width:220px;color:#999;' maxlength='26' id='casher_blanktruename'></p><p style='height:25px;'>绑定的手机号码："+mobil+"</p><p style='height:25px;'>　　　　校验码：<input type='text' style='coloe:#999' name='vcode' id='vcode'></p><p>　　　　　　　　<input type='button' name='getvcode' id='getvcode' value='获取验证码' onclick=\"parent.getvcode('120','"+hash+"','"+cashtype+"');\"></p></div><p class='btn' style='text-align:right;'><input type='hidden' value="+hash+" name='hash2'><input type='hidden' value="+cashtype+" name='cashtype'><input type='hidden' value='alipay' name='type'><input type='submit' class='btn_em' value='立即绑定'><input onclick='doCut();' class=btn_dft type='button' tabindex='9' value='取 消'></p></div></form>");
	}
function dmhaddtaobao(hash,mobil,cashtype){
	 comm_fram(413, 215, "添加提现卡号", "", "<form id=qtform action='/user/addcasher/' method=post name=myform onsubmit='return checktaobao();'><div style='height:180px;margin:0px 10px;'><div style='height:135px;font-size:13px;'><p>　　淘宝掌柜名：<input type='text' name='blanktruename' id='casher_blankname' maxlength='26' style='text-indent:3px;width:250px;color:#999;'></p><p style='height:25px;'>　淘宝商品地址：<input type='text' name='blankname' style='text-indent:3px;width:220px;color:#999;' maxlength='100' id='casher_blanktruename'></p><p style='height:25px;'>绑定的手机号码："+mobil+"</p><p style='height:25px;'>　　　　校验码：<input type='text' name='vcode' style='color:#999;' id='vcode'></p><p>　　　　　　　　<input type='button' name='getvcode' id='getvcode' value='获取验证码' onclick=\"parent.getvcode('120','"+hash+"','"+cashtype+"');\"></p></div><p class='btn' style='text-align:right;'><input type='hidden' value="+hash+" name='hash2'><input type='hidden' value="+cashtype+" name='cashtype'><input type='hidden' value='taobao' name='type'><input type='submit' class='btn_em' value='立即绑定'><input onclick='doCut();' class=btn_dft type='button' tabindex='9' value='取 消'></p></div></form>");
	}
function shua(type){
	dialog(615,554,'开始代刷服务　　无法加载到弹窗内容的用户,请点击<a href="/Shua/Order/" target="_blank" class="chengse">这里</a>','/dialog/shua/?type='+type);
	}
function comm_fram(k, c, j, a, e) {
	if ($('#'+"fulldiv").length > 0) {
		return false;
	}
	var l = $('<div id="fulldiv" style="position:absolute; clear:both; z-index:1000;left:0px; top:0px;width:100%; height:100%;"></div>');
	$(document.body).append(l);
	var f = $('#'+"comm_fram");
	if (f.length > 0) {
		f.remove();
	}
	f = $('<div id="comm_fram" class="comm_fram"></div>');
	f.css({
		marginLeft: "-" + k / 2 +30 + "px",
		marginTop: "-" + c / 2 + 70+ "px"
		
	});
	if (is_ie7 || is_moz) {
		f.css({
			position : "fixed"
		});
	}else if(is_ie6){
		f.css({top: '550px'});
	} else {
		var d = parent.document.body.scrollTop + parent.document.documentElement.scrollTop;
		var b = d + 80;
		var g = b > 0 ? b: 0;
		f.css({top: g + 'px'});
	}
	var m = '<div class="comm_fram_top"></div><div class="fram_container"><div class="r_title"><span id="round_container">'+ j +'</span><a href="javascript:;" class="r_close" onclick="doCut();"></a></div><div class="fram_content">';
	if (a) {
		if (a.indexOf("?") < 0) {
			a += "?";
		}
		a += "&thime=" + Math.random();
		m += '<iframe src="' + a + '" width="' + (k - 56) + 'px" height="' + (c - 16) + 'px" frameborder="0" scrolling="no"></iframe>';
	} else {
		m += e;
	}
	m += '</div></div><div class="comm_fram_bottom"></div>';
	f.html(m);
	$(document.body).append(f);
	this.doCut = function() {
		f.hide();
		l.remove();
	};
	this.doCut2 = function(h) {
		reflesh(h)
	}
}
function getvcode(time,hash,cashtype){
	artDialog({
	content:'<div style="width:230px;"><p style="height:25px;"><input type="radio" value="1" checked name="smspass">短信通道1</p><p style="height:25px;"><input type="radio" value="2" name="smspass">短信通道2</p><input type="radio" value="3" name="smspass">短信通道3</p></div>',
	title:'选择短信通道',
	lock:true,
	ok:function(){
		var time;
		var smspass = $("[name='smspass']:checked").val();
		$("#getvcode").attr({disabled: true});
		$("#getvcode").val('120秒后重新发送');
		$.ajax({
			url: '/ajax/getvcode.php',
			data: 'hash2='+hash+'&cashtype='+cashtype+'&smspass='+smspass,
			type: "POST",
			cache: false,
			dataType:"text",
			success: function(data){
				alert(data);
			}
		});
		gettimeout(120);
	}
	});
	
}
function gettimeout(time){
	var time;
	$("#getvcode").attr({disabled: true});
	$("#getvcode").val(time+'秒后可重新发送');
	if(time==0){
	$("#getvcode").attr({disabled: false});
	$("#getvcode").val('获取验证码');
	}else{
	time--;
	setTimeout("gettimeout(" + time + ")",1000);
	}
}