( function() {
	var ua = navigator.userAgent.toLowerCase();
	var is = (ua.match(/\b(chrome|opera|safari|msie|firefox)\b/) || [ '',
			'mozilla' ])[1];
	var r = '(?:' + is + '|version)[\\/: ]([\\d.]+)';
	var v = (ua.match(new RegExp(r)) || [])[1];
	jQuery.browser.is = is;
	jQuery.browser.ver = v;
	jQuery.browser[is] = true;

})();

( function(jQuery) {

	/*
	 * 
	 * jQuery Plugin - Messager
	 * 
	 * Author: corrie Mail: corrie@sina.com Homepage: www.corrie.net.cn
	 * 
	 * Copyright (c) 2008 corrie.net.cn
	 * 
	 * @license http://www.gnu.org/licenses/gpl.html [GNU General Public
	 * License]
	 * 
	 * 
	 * 
	 * $Date: 2008-12-26
	 * 
	 * $Vesion: 1.5 @ how to use and example: Please Open index.html
	 * 
	 */

	this.version = '@1.5';
	this.layer = {
		'width' :300,
		'height' :150
	};
	this.title = '信息提示';
	this.time = 4000;
	this.anims = {
		'type' :'slide',
		'speed' :600
	};
	this.timer1 = null;
	this.showFunc = this.closeFunc = null;
	this.inits = function(title, text) {

		if ($("#message").is("div")) {
			return;
		}
		$(document.body)
				.prepend(
						'<div id="message" style="border:#b9c9ef 1px solid;z-index:100;width:'
								+ this.layer.width
								+ 'px;height:'
								+ this.layer.height
								+ 'px;position:absolute; display:none;background:#cfdef4; bottom:0; right:0; overflow:hidden;"><div style="border:1px solid #fff;border-bottom:none;width:100%;height:25px;font-size:12px;overflow:hidden;color:#1f336b;"><span id="message_close" style="float:right;padding:5px 0 5px 0;width:16px;line-height:auto;color:red;font-size:12px;font-weight:bold;text-align:center;cursor:pointer;overflow:hidden;">×</span><div style="padding:5px 0 5px 5px;line-height:18px;text-align:left;overflow:hidden;">'
								+ title
								+ '</div><div style="clear:both;"></div></div> <div style="padding-bottom:5px;border:1px solid #fff;border-top:none;width:100%;height:auto;font-size:12px;"><div id="message_content" style="margin:0 5px 0 5px;border:#b9c9ef 1px solid;padding:10px 0 10px 5px;font-size:12px;width:'
								+ (this.layer.width - 17)
								+ 'px;height:'
								+ (this.layer.height - 50)
								+ 'px;color:#1f336b;text-align:left;overflow:hidden;">'
								+ text + '</div></div></div>');

		$("#message_close").click( function() {
			setTimeout('this.close()', 1);
		});
		$("#message").hover( function() {
			clearTimeout(timer1);
			timer1 = null;
		}, function() {
			if (time > 0)
				timer1 = setTimeout('this.close()', time);
			});

		$(window).scroll(
				function() {
					var bottomHeight =  "-"+document.documentElement.scrollTop;
					$("#message").css("bottom", bottomHeight + "px");
				});

	};

	this.show = function(title, text, time) {
		if ($("#message").is("div")) {
			return;
		}
		if (title == 0 || !title)
			title = this.title;
		this.inits(title, text);
		if (time >= 0)
			this.time = time;
		switch (this.anims.type) {
		case 'slide':
			$("#message").slideDown(this.anims.speed);
			break;
		case 'fade':
			$("#message").fadeIn(this.anims.speed);
			break;
		case 'show':
			$("#message").show(this.anims.speed);
			break;
		default:
			$("#message").slideDown(this.anims.speed);
			break;
		}
		var bottomHeight =  "-"+document.documentElement.scrollTop;
		$("#message").css("bottom", bottomHeight + "px");
		
		if ($.browser.is == 'chrome') {
			setTimeout( function() {
				$("#message").remove();
				this.inits(title, text);
				$("#message").css("display", "block");
			}, this.anims.speed - (this.anims.speed / 5));
		}
		if (this.showFunc) this.showFunc();
		this.rmmessage(this.time);
	};

	this.lays = function(width, height) {

		if ($("#message").is("div")) {
			return;
		}
		if (width != 0 && width)
			this.layer.width = width;
		if (height != 0 && height)
			this.layer.height = height;
	}

	this.anim = function(type, speed) {
		if ($("#message").is("div")) {
			return;
		}
		if (type != 0 && type)
			this.anims.type = type;
		if (speed != 0 && speed) {
			switch (speed) {
			case 'slow':
				;
				break;
			case 'fast':
				this.anims.speed = 200;
				break;
			case 'normal':
				this.anims.speed = 400;
				break;
			default:
				this.anims.speed = speed;
			}
		}
	}

	this.rmmessage = function(time) {
		if (time > 0) {
			timer1 = setTimeout('this.close()', time);
		}
	};
	this.close = function() {
		switch (this.anims.type) {
		case 'slide':
			$("#message").slideUp(this.anims.speed);
			break;
		case 'fade':
			$("#message").fadeOut(this.anims.speed);
			break;
		case 'show':
			$("#message").hide(this.anims.speed);
			break;
		default:
			$("#message").slideUp(this.anims.speed);
			break;
		}
		;
		setTimeout(function(){
			$("#message").remove();
			if (this.closeFunc) this.closeFunc();
		}, this.anims.speed);
		this.original();
	}

	this.original = function() {
		this.layer = {
			'width' :300,
			'height' :150
		};
		this.title = '信息提示';
		this.time = 4000;
		this.anims = {
			'type' :'slide',
			'speed' :600
		};
	};
	jQuery.messager = this;
	return jQuery;
})(jQuery);
var MediaPlayer=function(a)
{
	if(a!=void(0))this.a=a;
	this.Width=0;
	this.Height=0;
	this.Visiable=false;
	this.loop = true;
	this.Player = null;
	this.Create=function(id)
	{
		this.CreateID();
		var obj="<OBJECT "+(this.Visiable===true?"style=\"display:none;\"":"")+"id=\""+this.id+"\" type=\"application/x-oleobject\" height=\""+this.Height+"\" width=\""+this.Width+"\" classid=\"CLSID:6BF52A52-394A-11D3-B153-00C04F79FAA6\">";
		if(this.a)
		{
			for(key in this.a)
			{
				obj+="<PARAM NAME=\""+key+"\" VALUE=\""+this.a[key]+"\">";
			}
		}
		obj+="</object>";
		if (this.loop) {
			obj+="<SCRIPT FOR=\""+this.id+"\" EVENT=\"PlayStateChange(lOldState,lNewState)\" LANGUAGE=\"javascript\">var e=document.getElementById('"+this.id+"');if(lOldState==1&&e.currentPlaylist.count>0&&e.controls.currentPosition==0)e.controls.play();<\/SCRIPT> ";
		}
		if(id!=void(0))
		{
			var e=document.getElementById(id);
			if(e)
			{
				if(typeof(e.innerHTML)!="undefined")
				{
					var tmp_media;
					e.innerHTML=obj;
					this.Player=document.getElementById(this.id);
					if(this.Play_list){
						for(var i=0;i<this.Play_list.length;i++){
							tmp_media=this.Player.newMedia(this.Play_list[i]);
							try{
								this.Player.currentPlaylist.appenditem(tmp_media);
							} catch(e) {
								if(this.Player.settings.mediaAccessRights!="full"){
								  this.Player.settings.requestMediaAccessRights("full");
								}
								this.Player.currentPlaylist.appenditem(tmp_media);
							}
						}
						this.Player.controls.play();
					}
				}
				else if(typeof(e.value)!="undefined")e.value=obj;
				else return obj;
			}
			else return obj;
		}
	}
	this.CreateID=function()
	{
		var start=1;
		var id="";
		var tmp="";
		var tmp_player;
		var tmp_media;
		while(id=="")
		{
			tmp="MediaPlayer"+start;
			tmp_player=document.getElementById(tmp);
			if(tmp_player)
			{
				if(tmp_player.playState!=1)tmp_player.controls.stop();
				if(tmp_player.currentPlaylist.count>0)
				{
					while(tmp_player.currentPlaylist.count>0)
					{
						var tmp_media=tmp_player.currentPlaylist.item(0);
						tmp_player.currentPlaylist.removeitem(tmp_media);
					}
				}
				tmp_player.parentElement.removeChild(tmp_player);
				start++;
			}
			else
			{
				id=tmp;
			}
		}
		this.id=id;
	}
	this.Set=function(name,value)
	{
		this.a[name]=value;
	}
	this.Play=function(url)
	{
		if(url != void(0))
		{
			//var media = this.Player;//document.getElementById(this.id);
			//playState:integer; 播放状态，1=停止，2=暂停，3=播放，6=正在缓冲，9=正在连接，10=准备就绪
			if(this.Player.playState!=1) this.Player.controls.stop();
			this.Player.URL=url;
			this.Player.controls.Play();
		} else {
			if(this.Player.playState!=1) this.Player.controls.stop();
			this.Player.controls.Play();
		}
		
	}
};
var msgSound = function(url, id){
	this.url = url;
	this.player = new MediaPlayer();
	this.player.loop = false;
	this.player.Visiable = true;
	this.player.Create(id);
	this.isSetUrl = false;
	this.play = function(){
		if (!this.isSetUrl) {
			this.player.Play(this.url);
			this.isSetUrl = true;
		} else {
			this.player.Play();
		}
	};
};
var msgInfo = null;
var msgIndex = 0;
var setMsgRead = function(id) {
	$.getJSON(weburl+'/ajax/getMsg.php?type=setRead&id='+id, function(json){
		if (json.status) {
			$('.top_msg .f_red').html('('+json.total+')');
		} else {
			alert(json.msg);
		}
	});
}
var showMsg = function(){
	if (msgInfo.status) {
		if (msgInfo.total > 0) {
			if (msgIndex > 0) {
				setMsgRead(msgInfo.list[msgIndex - 1].id);
			}
			if (msgIndex < msgInfo.total) {
				$.messager.show(msgInfo.list[msgIndex].title, msgInfo.list[msgIndex].message+'<br /><br />'+msgInfo.list[msgIndex].date, 20000);
				msgIndex++;
			} else {
				if (msgInfo.pagesize * (msgInfo.page - 1) + msgInfo.total < msgInfo.allTotal) {
					msgIndex = 0;
					getMsg(msgInfo.nextPage);
				}
			}
		}
	}
};
var getMsg = function(page){
	if (page == void(0)) page = 1;
	$.getJSON(weburl+'/ajax/getMsg.php?page='+page+'&pagesize=5', function(json){
		if (json.status) {
			msgInfo = json;
			showMsg();
		}
	});
};
$(function(){
	if (memberLogined) {
		$(document.body).append('<div id="msgPlayer"></div>');
		var sound = new msgSound(weburl2+'images/vcode.wav', 'msgPlayer');
		$.messager.showFunc = function(){
			sound.play();
		};
		$.messager.closeFunc = function(){
			showMsg();
		}
		$.messager.anim('fade', 2000);
		if (userShowMsg) getMsg();
	}
});