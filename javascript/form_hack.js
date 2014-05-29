$(function(){
	var fh_static_action=1,fh_static_right=2,fh_static_wrong=3,fh_static_none=4;
	var fh_set_class=false;
	if(typeof(fh_tip_suffix)=='undefined')var fh_tip_suffix='_tip';
	if(typeof(fh_class_action)!='undefined' || typeof(fh_class_right)!='undefined' || typeof(fh_class_wrong)!='undefined')fh_set_class=true;
	if(fh_set_class){
		if(typeof(fh_class_id_suffix)=='undefined')var fh_class_id_suffix='_cls';
	}
	var SetTipInfo=function(tid, info, infotype) {
		//$(obj).show();
		$('#'+tid+fh_tip_suffix).html(info);
		if(fh_set_class){
			if(infotype==1){
				//action
				class_set(tid,fh_class_action,'remove');
				class_set(tid,fh_class_right,'remove');
				class_set(tid,fh_class_wrong,'remove');
				class_set(tid,fh_class_none,'remove');
				class_set(tid,fh_class_action,'add');
			} else if(infotype==2){
				//right
				class_set(tid,fh_class_action,'remove');
				class_set(tid,fh_class_right,'remove');
				class_set(tid,fh_class_wrong,'remove');
				class_set(tid,fh_class_none,'remove');
				class_set(tid,fh_class_right,'add');
			} else if(infotype==3){
				//wrong
				class_set(tid,fh_class_action,'remove');
				class_set(tid,fh_class_right,'remove');
				class_set(tid,fh_class_wrong,'remove');
				class_set(tid,fh_class_none,'remove');
				class_set(tid,fh_class_wrong,'add');
			} else if(infotype==4){
				class_set(tid,fh_class_action,'remove');
				class_set(tid,fh_class_right,'remove');
				class_set(tid,fh_class_wrong,'remove');
				class_set(tid,fh_class_none,'remove');
				class_set(tid,fh_class_none,'add');
			}
		}
	}
	if(typeof(SetTipInfo_backup)!='undefined')SetTipInfo_backup=SetTipInfo;
	var class_set=function(id,args,type){
		if(args){
			for(var i=0;i<args.length;i++){
				if(type=='add'){
					$('#'+id+args[i].id_suffix).addClass(args[i].class_name);
				} else if(type=='remove'){
					$('#'+id+args[i].id_suffix).removeClass(args[i].class_name);
				}
			}
		}
	}
	var msg_focus=function(e0){
		if($(e0).attr('form_return')=='false')return false;
		var tid=$(e0).attr('tip_id')||e0.id;
		//var e=document.getElementById(tid+fh_tip_suffix);
		//if(e!=null){
			if($(e0).attr('Message'))SetTipInfo(tid,$(e0).attr('Message').split('|')[0],fh_static_action);
		//}
	}
	var msg_blur=function(e0){
		if($(e0).attr('form_return')=='false')return false;
		var tid=$(e0).attr('tip_id')||e0.id;
		if($(e0).attr('ajax_check')=='true'){
			SetTipInfo(tid,'正在检查，请稍后...',fh_static_action);
			return false;
		}
		var e=document.getElementById(tid+fh_tip_suffix);
		if(e!=null){
			if($(e0).attr('EmptyRunReg')=='true'||($(e0).attr('EmptyRunReg')=='false'&&$(e0).val())){
				if($(e0).attr('RegStr')){
					$(e0).attr('RegStr').match(/^\/(.+)\/([^\/]*)$/ig);
					if(RegExp.$1){
						var re=new RegExp(RegExp.$1,RegExp.$2);
						var val=e0.value;
						if(re.test(val)){
							if($(e0).attr('Message').split('|')[2]){
								$(e).html($(e0).attr('Message').split('|')[2]);
								SetTipInfo(tid,$(e0).attr('Message').split('|')[2],fh_static_right);
							} else {
								SetTipInfo(tid,'',fh_static_right);
							}
							return true;
						} else {
							SetTipInfo(tid,$(e0).attr('Message').split('|')[1],fh_static_wrong);
							return false;
						}
					}
				} else {
					SetTipInfo(tid,'',fh_static_none);
					return true;
				}
			} else if($(e0).attr('preg')=='syn'){
				if($('#'+$(e0).attr('Message').split('|')[3]).val()==$(e0).val()){
					if($(e0).val()!=''){
						if($(e0).attr('Message').split('|')[2])SetTipInfo(tid,$(e0).attr('Message').split('|')[2],fh_static_right);
						SetTipInfo(tid,'',fh_static_right);
						return true;
					} else {
						SetTipInfo(tid,'',fh_static_none);
					}
				} else {
					SetTipInfo(tid,$(e0).attr('Message').split('|')[1],fh_static_wrong);
					return false;
				}
			} else {
				SetTipInfo(tid,'',fh_static_none);
				return true;
			}
		}
		return true;
	}
	if(typeof(msg_blur_backup)!='undefined')msg_blur_backup=msg_blur;
	var checkform=function(e){
		var error=false;
		for(var i=0;i<e.length;i++){
			var e2=e[i];
			if(!msg_blur(e2)){
				error=true;
				try{
					e2.focus();
				} catch(e) {
					//
				}
				break;
			}
		}
		if(!error){
			for(var i=0;i<e.length;i++){
				var e2=e[i];
				if($(e2).attr('def')&&$(e2).val()==$(e2).attr('def'))$(e2).val('');
			}
		}
		if(!error){
			if(typeof(form_submit)!='undefined'){
				return form_submit();
			} else return true;
		} else return false;
	}
	var forms=document.forms;
	for(var i=0;i<forms.length;i++){
		var form=forms[i];
		var v=new Array();
		var form_check=false;
		for(var j=0;j<form.elements.length;j++){
			var e=form.elements[j];
			if($(e).attr('preg')){
				var sp=($(e).attr('preg')).split(':');
				var f=false;
				if(sp.length>1){
					if(sp[0]=='not'){
						sp[0]='';
						f=true;
					}
				}
				var preg=sp.join('');
				var pregs=preg.split('|');
				//for(var k=0;k<pregs.length;k++){
					//sp=pregs[k].split('=');
					sp=preg.split('=');
					var sp2=sp[1].split('|');
					if(sp[0]=='null'){
						if(!f)$(e).attr('RegStr','/^[\\s\\S]+$/m');
						else $(e).attr('RegStr','/^$/');
					} else if(sp[0]=='number') {
						if(!f)$(e).attr('RegStr','/^-?\\d+$/');
						else $(e).attr('RegStr','/^$/');
					} else if(sp[0]=='money') {
						if(!f)$(e).attr('RegStr','/^\\d+(?:\\.\\d+)?$/');
						else $(e).attr('RegStr','/^$/');
					} else if(sp[0]=='float') {
						if(!f)$(e).attr('RegStr','/^-?\\d+(\\.\\d+)?$/');
						else $(e).attr('RegStr','/^$/');
					} else if(sp[0]=='email') {
						if(!f)$(e).attr('RegStr','/^[a-z0-9][a-z0-9_]+@[a-z0-9]+(\\.[a-z0-9]+){1,3}$/i');
						else $(e).attr('RegStr','/^$/');
					} else if(sp[0]=='phone') {
						if(!f)$(e).attr('RegStr','/(?:^1(?:(?:[0-9][0-9]))\\d{8}$)|(?:^\\d{2,4}-\\d{7,8}$)|(?:^\\d{7,8}$)/');
						else $(e).attr('RegStr','/^$/');
					} else if(sp[0]=='telephone') {
						if(!f)$(e).attr('RegStr','/(?:^\\d{2,4}-\\d{7,8}$)|(?:^\\d{7,8}$)/');
						else $(e).attr('RegStr','/^$/');
					} else if(sp[0]=='mobilephone') {
						if(!f)$(e).attr('RegStr','/^1(?:(?:[0-9][0-9]))\\d{8}$/');
						else $(e).attr('RegStr','/^$/');
					} else if(sp[0]=='postcode') {
						if(!f)$(e).attr('RegStr','/^\\d{6}$/');
						else $(e).attr('RegStr','/^$/');
					} else if(sp[0]=='syn') {
						$(e).attr('preg','syn');
						$(e).focus(function(){
							msg_focus(this)	;
						});
						$(e).blur(function(){
							msg_blur(this);
						});
					}
					if(sp[1]){
						if(!sp2[1])$(e).attr('Message',sp2[0]+'|'+sp2[0]);
						else $(e).attr('Message',sp[1]);
					}
				//}
			}
			if($(e).attr('RegStr')){
				if(!$(e).attr('EmptyRunReg'))$(e).attr('EmptyRunReg','true');
				form_check=true;
			}
			if(($(e).attr('Message'))||$(e).attr('def')){
				v[v.length]=e;
				if(e.value==''){
					if($(e).attr('def')){
						e.value=$(e).attr('def');
						$(e).css({color:'#bbbbbb'});
					}
				}
				$(e).focus(function(){
					msg_focus(this);
					if($(this).attr('def')){
						if(this.value==$(this).attr('def')){
							this.value='';
							$(this).css({color:'#000000'});
						}
					}
				});
				$(e).blur(function(){
					msg_blur(this);
					if($(this).attr('def')){
						if(this.value==''){
							this.value=$(this).attr('def');
							$(this).css({color:'#bbbbbb'});
						}
					}
				});
			}
		}
		if(form_check){
			$(form).submit(function(){
				return checkform(this);
			});
		}
	}
});