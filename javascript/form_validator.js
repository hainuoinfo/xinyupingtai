$.fn.formValidator=function(flag0){
	if(typeof(formValidator)=='undefined')formValidator={};
	var flag={
		pluginName:'formValidator',
		constStatic:{
			setAction:1,
			setRight:2,
			setWrong:3,
			setNone:4
		},
		regexpName:'RegStr',
		messageName:'Message',
		clearDef:true,
		messageOrder:{
			action:0,
			wrong:1,
			right:2,
			none:3
		},
		style:{
			idName:'mid',
			tipSuffix:'_tip',
			action:null,
			right:null,
			wrong:null,
			none:null,
			set:false,
			defColor:'#bbbbbb',
			txtColor:'#000000'
		}
	};
	if(flag0!=void(0))jQuery.extend(flag,flag0);
	if(flag.style.action!=null || flag.style.right!=null || flag.style.wrong!=null || flag.style.none!=null)flag.style.set=true;
	formValidator[this.attr('id')]=new function(f,flag){
		var o=this;
		this.id=f.attr('id');
		this.form=f;
		this.checkForm=false;
		this.self=this;
		this.flag=flag;
		this.setTipInfo=function(tid, info, infotype) {
			//$(obj).show();
			$('#'+tid+flag.style.tipSuffix).html(info);
			if(flag.style.set){
				if(infotype==flag.constStatic.setAction){
					//action
					this.setClass(tid,flag.style.action,'remove');
					this.setClass(tid,flag.style.right,'remove');
					this.setClass(tid,flag.style.wrong,'remove');
					this.setClass(tid,flag.style.none,'remove');
					this.setClass(tid,flag.style.action,'add');
				} else if(infotype==flag.constStatic.setRight){
					//right
					this.setClass(tid,flag.style.action,'remove');
					this.setClass(tid,flag.style.right,'remove');
					this.setClass(tid,flag.style.wrong,'remove');
					this.setClass(tid,flag.style.none,'remove');
					this.setClass(tid,flag.style.right,'add');
				} else if(infotype==flag.constStatic.setWrong){
					//wrong
					this.setClass(tid,flag.style.action,'remove');
					this.setClass(tid,flag.style.right,'remove');
					this.setClass(tid,flag.style.wrong,'remove');
					this.setClass(tid,flag.style.none,'remove');
					this.setClass(tid,flag.style.wrong,'add');
				} else if(infotype==flag.constStatic.setNone){
					this.setClass(tid,flag.style.action,'remove');
					this.setClass(tid,flag.style.right,'remove');
					this.setClass(tid,flag.style.wrong,'remove');
					this.setClass(tid,flag.style.none,'remove');
					this.setClass(tid,flag.style.none,'add');
				}
			}
		};
		this.setClass=function(id,args,type){
			if(args){
				for(var i=0;i<args.length;i++){
					if(type=='add'){
						$('#'+id+args[i].idSuffix).addClass(args[i].className);
					} else if(type=='remove'){
						$('#'+id+args[i].idSuffix).removeClass(args[i].className);
					}
				}
			}
		};
		this.objectFocus=function(e0){
			if(e0.attr('formReturn')=='false')return false;
			var tid=e0.attr(this.flag.style.idName) || e0.attr('id');
			if(e0.attr(this.flag.messageName))this.setTipInfo(tid,e0.attr(this.flag.messageName).split('|')[this.flag.messageOrder.action],this.flag.constStatic.setAction);
		};
		this.objectBlur=function(e0){
			if(e0.attr('formReturn')=='false')return false;
			var tid=e0.attr(this.flag.style.idName) || e0.attr('id');
			if(e0.attr('ajaxCheck')=='true'){
				this.setTipInfo(tid,'正在检查，请稍后...',this.flag.constStatic.setAction);
				return false;
			}
			var e=$('#'+tid+this.flag.style.tipSuffix);
			if(e.length>0){
				if(e0.attr('emptyRunReg')=='true'||(e0.attr('emptyRunReg')=='false' && e0.val())){
					if(e0.attr(this.flag.regexpName)){
						e0.attr(this.flag.regexpName).match(/^\/(.+)\/([^\/]*)$/ig);
						if(RegExp.$1){
							var re=new RegExp(RegExp.$1,RegExp.$2);
							var val=e0.val();
							if(re.test(val)){
								if(e0.attr(this.flag.messageName).split('|')[this.flag.messageOrder.right]){
									e.html(e0.attr(this.flag.messageName).split('|')[this.flag.messageOrder.right]);
									this.setTipInfo(tid,e0.attr(this.flag.messageName).split('|')[this.flag.messageOrder.right],this.flag.constStatic.setRight);
								} else {
									this.setTipInfo(tid,'',this.flag.constStatic.setRight);
								}
								return true;
							} else {
								this.setTipInfo(tid,e0.attr(this.flag.messageName).split('|')[this.flag.messageOrder.wrong],this.flag.constStatic.setWrong);
								return false;
							}
						}
					} else {
						this.setTipInfo(tid,'',this.flag.constStatic.setNone);
						return true;
					}
				} else if(e0.attr('preg')=='syn'){
					if($('#'+e0.attr(this.flag.messageName).split('|')[3]).val()==e0.val()){
						if(e0.val()!=''){
							if(e0.attr(this.flag.messageName).split('|')[this.flag.messageOrder.right])this.setTipInfo(tid,e0.attr(this.flag.messageName).split('|')[this.flag.messageOrder.right],this.flag.constStatic.setRight);
							else this.setTipInfo(tid,'',this.flag.constStatic.setRight);
							return true;
						} else {
							this.setTipInfo(tid,'',this.flag.constStatic.setNone);
						}
					} else {
						this.setTipInfo(tid,e0.attr(this.flag.messageName).split('|')[this.flag.messageOrder.wrong],this.flag.constStatic.setWrong);
						return false;
					}
				} else {
					this.setTipInfo(tid,'',this.flag.constStatic.setNone);
					return true;
				}
			}
			return true;
		};
		this.check=function(e){
			var error=false;
			if(this.form.attr('formValidatorCheck')=='true'){
				for(var i=0;i<e.length;i++){
					var e2=e[i];
					if(!this.objectBlur(e2)){
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
						if(e2.attr('def') && e2.val()==e2.attr('def')){
							if(o.flag.clearDef)e2.val('');
						}
					}
				}
			}
			return !error;
		};
		this.checkElement=function(e){
			var rn=false;
			if(e.attr('preg')){
				var sp=(e.attr('preg')).split(':');
				var f=false;
				if(sp.length>1){
					if(sp[0]=='not'){
						sp[0]='';
						f=true;
					}
				}
				var preg=sp.join('');
				var pregs=preg.split('|');
				sp=preg.split('=');
				var sp2=sp[1].split('|');
				if(sp[0]=='null'){
					if(!f)e.attr(o.flag.regexpName,'/^[\\s\\S]+$/m');
					else e.attr(o.flag.regexpName,'/^$/');
				} else if(sp[0]=='number') {
					if(!f)e.attr(o.flag.regexpName,'/^\\d+$/');
					else e.attr(o.flag.regexpName,'/^$/');
				} else if(sp[0]=='float') {
					if(!f)e.attr(o.flag.regexpName,'/^\\d+(\\.\\d+)?$/');
					else e.attr(o.flag.regexpName,'/^$/');
				} else if(sp[0]=='email') {
					if(!f)e.attr(o.flag.regexpName,'/^[a-z0-9][a-z0-9_]+@[a-z0-9]+(\\.[a-z0-9]+){1,3}$/i');
					else e.attr(o.flag.regexpName,'/^$/');
				} else if(sp[0]=='qq') {
					if(!f)e.attr(o.flag.regexpName,'/^[1-9]\\d{4,10}$/i');
					else e.attr(o.flag.regexpName,'/^$/');
				} else if(sp[0]=='phone') {
					if(!f)e.attr(o.flag.regexpName,'/(?:^1(?:(?:[0-9][0-9]))\\d{8}$)|(?:^\\d{2,4}-\\d{7,8}$)|(?:^\\d{7,8}$)/');
					else e.attr(o.flag.regexpName,'/^$/');
				} else if(sp[0]=='telephone') {
					if(!f)e.attr(o.flag.regexpName,'/(?:^\\d{2,4}-\\d{7,8}$)|(?:^\\d{7,8}$)/');
					else e.attr(o.flag.regexpName,'/^$/');
				} else if(sp[0]=='mobilephone') {
					if(!f)e.attr(o.flag.regexpName,'/^1(?:(?:[0-9][0-9]))\\d{8}$/');
					else e.attr(o.flag.regexpName,'/^$/');
				} else if(sp[0]=='postcode') {
					if(!f)e.attr(o.flag.regexpName,'/^\\d{6}$/');
					else e.attr(o.flag.regexpName,'/^$/');
				} else if(sp[0]=='syn') {
					e.attr('preg','syn');
					e.focus(function(){
						o.self.objectFocus($(this))	;
					});
					e.blur(function(){
						o.self.objectBlur($(this));
					});
				}
				if(sp[1]){
					if(!sp2[1])e.attr(o.flag.messageName,sp2[0]+'|'+sp2[0]);
					else e.attr(o.flag.messageName,sp[1]);
				}
			}
			if(e.attr(o.flag.regexpName)){
				if(!e.attr('emptyRunReg'))e.attr('emptyRunReg','true');
				rn=true;
			}
			if((e.attr(o.flag.messageName)) || e.attr('def')){
				e.attr(this.pluginName,'true');
				if(e.val()==''){
					if(e.attr('def')){
						e.val(e.attr('def'));
						e.css({color:o.flag.style.defColor});
					}
				}
				e.focus(function(){
					if(e.attr(o.flag.messageName))o.self.objectFocus($(this));
					if(e.attr('def')){
						if(e.val()==$(this).attr('def')){
							e.val('');
							e.css({color:o.flag.style.txtColor});
						}
					}
				});
				e.blur(function(){
					if(e.attr(o.flag.messageName))o.self.objectBlur($(this));
					if(e.attr('def')){
						if(e.val()==''){
							e.val(e.attr('def'));
							e.css({color:o.flag.style.defColor});
						}
					}
				});
			}
			return rn;
		};
		var checkElements=[];
		var formEach=function(f){
			//if(f.children().length>0 && 'SELECT|TEXTAREA|'.indexOf(f.attr('tagName')+'|')==-1){
			if(f.children().length>0 && !f.attr(o.flag.regexpName)){
				f.children().each(function(){
					formEach($(this));
				});
			} else {
				if(o.checkElement(f)){
					checkElements[checkElements.length]=f;
					o.checkForm=true;
				}
			}
		}
		formEach(this.form);
		if(this.checkForm){
			this.form.attr({formValidatorCheck:'true'});
			$(this.form).submit(function(){
				return o.check(checkElements);
			});
		}
		
	}(this,flag);
};