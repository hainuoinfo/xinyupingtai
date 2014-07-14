
function UpdateTask(){
    $("#taskList").show(); 
}
function GetDatingResult(result){
   
}

var curMisIsDisWW=false;
function taskin(mid,isDisWW,btn){
	if(!curExam){
        artDialog({content:"您还未通过新手考试，通过考试还能获得1个麦点哦！",id:"alarm",fixed:true,yesText:"立即去考试",lock:true},function(){
            window.location.href="/member/exam/";
        });
        DisabledClose();
        return;
    }

    if($("#divIDList input").length==0){
        artDialog({content:"您还未绑定您的淘宝买号，或您绑定的淘宝买号未启用，请点击此处绑定您的淘宝买号。",id:"alarm",fixed:true,yesText:"立即去绑定",lock:true},function(){
            window.location.href="/task/tao/?m=tieBuyer";
        });
        DisabledClose();
        return;
    }
    $(btn).attr("disabled","disabled");
    var tipsDialog=artDialog({content:"处理中，请稍候...",id:"tips",lock:true});
    DisabledClose();
    
    $.post("/ajax/MyTaskIn.php",{"taskid":mid}, function(result){
        tipsDialog.close();     
        if(result.StateCode==0){
            var $accountList=$("#divIDList");
            curMisIsDisWW = isDisWW;
            SelectBuyerAccountNew(mid,btn,$accountList,result.IsReal);
        }else{
            $(btn).removeAttr("disabled");
            switch(result.StateCode){
                case 1:{
                    artDialog({content:result.StateMsg,id:"alarm",fixed:true,yesText:"进入考试",lock:true},function(){
                        window.location.href="/member/exam/";
                    },function(){goPage(1);});
                    break;
                }
				case 2:{
                    artDialog({content:result.StateMsg,id:"alarm",fixed:true,yesText:"激活账号",lock:true},function(){
                        window.location.href="/member/active/";
                    },function(){goPage(1);});
                    break;
                }
				case 3:{
                    artDialog({content:result.StateMsg,id:"alarm",fixed:true,yesText:"查看商保保证金",lock:true},function(){
                        window.location.href="/member/ensure/";
                    },function(){goPage(1);});
                    break;
                }
                case 4:{
                    artDialog({content:result.StateMsg,id:"alarm",fixed:true,lock:true,yesText:"立即加入商保",noText:"取消"},function(){window.location.href="/member/ensure/"},function(){ tipsDialog.close();goPage(1);});
                    break;
                } 
				case 5:{
                    artDialog({content:result.StateMsg,id:"alarm",fixed:true,lock:true,yesText:"绑定实名买号",noText:"取消"},function(){window.location.href="/task/tao/?m=tieBuyer"},function(){ tipsDialog.close();goPage(1);});
                    break;
                }
                case 11:{
                    artDialog({content:result.StateMsg,id:"alarm",fixed:true,yesText:"查看投诉处理情况",lock:true},function(){
                        window.location.href="/member/complain/";
                    });
                    break;
                }
				case 12:{
                    artDialog({content:result.StateMsg,id:"alarm",fixed:true,yesText:"进入已接任务",lock:true},function(){
                        window.location.href="/task/tao/?m=taskIn";
                    });
                    break;
                }
                default:{
                    artDialog({content:result.StateMsg,id:"alarm",fixed:true,yesText:"关闭",lock:true},
                    function(){
                        if(result.StateCode==1||result.StateCode==2||result.StateCode==5){
                            $(buffHtml).find("tr:contains("+ mid +")").remove();
                        }
                        goPage(1);
                    });
                    break;
                }
            }
            DisabledClose();
            return;
        }
    },'json');
}
function DisabledClose(){
    $(".ui_close").hide();
    document.onkeyup = null;
}
function Openbuyerspage($k){
	if($k>1){
		$pk=$k-1;
		$pn=$k+1;
		if($(".bpage"+$pk)){
		  $(".bpage"+$pk).css({'display':'none'});
		  }
		if($(".bpage"+$pn)){
		  $(".bpage"+$pn).css({'display':'none'});
		  }
	  $(".bpage1").css({'display':'none'});
	  $(".bpage"+$k).css({'display':'block'});
	}else if($k==1){
		if($(".bpage2")){
		  $(".bpage2").css({'display':'none'});
		  }
		$(".bpage1").css({'display':'block'});
	}
	
}
function Openbuyersmpage($k){
	if($k>1){
		$pk=$k-1;
		$pn=$k+1;
		if($(".bsmpage"+$pk)){
		  $(".bsmpage"+$pk).css({'display':'none'});
		  }
		if($(".bsmpage"+$pn)){
		  $(".bsmpage"+$pn).css({'display':'none'});
		  }
	 $(".bsmpage1").css({'display':'none'});
	 $(".bsmpage"+$k).css({'display':'block'});
	}else if($k==1){
		if($(".bsmpage2")){
		  $(".bsmpage2").css({'display':'none'});
		  }
		$(".bsmpage1").css({'display':'block'});
	}
	
}
function SelectBuyerAccountNew(mid,btn,$accountList,IsReal){
    var dislen = $accountList.find("input:radio[disabled]").size();
    var alllen = $accountList.find("input:radio").size();
	var Reallen = $("#trListTrueName").find("input:radio[disabled]").size();
	var AllReallen = $("#trListTrueName").find("input:radio").size();
	var Normal = $(".trListNormal");
    if(Reallen = AllReallen && IsReal==1){
	    artDialog({content:"温馨提示：您必须绑定一个支付宝实名买号才可以接手此任务！",id:"al1",fixed:true,yesText:"绑定实名买号",noText:"取消",lock:true},function(){
                    window.open("/task/tao/?m=tieBuyer");
                },function(){
                    CancelAcceptMission(mid);
                });
                DisabledClose();
                return;
	}else if(dislen==alllen){
        artDialog({content:"温馨提示：您所有的买号信誉超过2000或买号已经挂起，无法接手此任务，请绑定新买号！",id:"al1",fixed:true,yesText:"关闭",lock:true},function(){
            CancelAcceptMission(mid);
        });
        DisabledClose();
        return;
    }else{
	    if(isFlowVip){
		  $.post("/ajax/Buyantidownright.php",{"taskid":mid}, function(result){  
                        if(result.StateCode==1 && result.Buyantlist){
                            for(i=0;i<result.Buyantlist.length;i++){
                                   $accountList.find("#buyer"+result.Buyantlist[i]).attr("disabled","disabled");
							}
                        }
                    },'json');
		}
        $accountList.find("input:radio[checked]").removeAttr("checked");
		if(IsReal==1){
		$(".trListNormal").hide();
        $("#trListTrueName").show();
		}
		artDialog({content:$accountList.html(),title:"为任务"+mid+"选择买号" ,id:"al",fixed:true,lock:true},function(){            
            var $divin = $("#alContent .divin").clone();
            var $aId=$divin.find("input:radio[name=ba][checked]");             
            var aId=$aId.val();
            if(aId==undefined){
                $aId=$("#alContent input:radio[name=ba][checked]");
                aId = $aId.val();
            }
            if(aId==undefined){
                artDialog({content:"大麦户温馨提示：请选择好买号再提交!<br/>如果没有买号，请到【会员中心-绑定买号】里面先绑定买号再接任务",id:"alarm",fixed:true,yesText:"立即去绑定",noText:"重选买号",lock:true},function(){
                    window.open("/member/buytao/");
                },function(){
                    SelectBuyerAccountNew(mid,btn,$divin.wrap("<div></div>").parent());
                });
                DisabledClose();
                return;
            }else{
                $(btn).attr("disabled","disabled");
                var tipsDialog=artDialog({content:"处理中，请稍候...",id:"tips",lock:true});
                DisabledClose();
                /*if(iiww()){*/
				if(false){
                   alert("平台检测到您安装了旺旺客户端；\r\n为了卖家的安全，请先卸载旺旺客户端，然后重启电脑再通过网页旺旺进行聊天任务！");
                   tipsDialog.close();  
                   $(btn).removeAttr("disabled");
                   CancelAcceptMission(mid);
                }else{
                    $.post("/ajax/choosebuyer.php",{"taskid":mid,"buyAccount":aId}, function(result){  
                        tipsDialog.close();          
                        if(result.StateCode==0){
                            artDialog({content:result.StateMsg,id:"alarm",fixed:true,lock:true},function(){
                                window.open("/task/"+result.url+"/?m=taskIn&t=ing","_self");
                            });
                            DisabledClose();
                            return;
                        }else if( result.StateCode==-2){                       
                            $(btn).removeAttr("disabled");
                            artDialog({content:result.StateMsg,id:"alarm",fixed:true,yesText:"完善收货地址",noText:"重选买号",lock:true},function(){
                    window.open("/task/tao/?m=tieBuyer");
                },function(){
                                $divin.find("input:radio[name=ba][checked]").removeAttr("checked").attr("disabled","disabled");
                                SelectBuyerAccountNew(mid,btn,$divin.wrap("<div></div>").parent());
                            });
                            DisabledClose();
                            return;
                        }else{                       
                            $(btn).removeAttr("disabled");
                            artDialog({content:result.StateMsg,id:"alarm",fixed:true,yesText:"重选买号",lock:true},function(){
                                $divin.find("input:radio[name=ba][checked]").removeAttr("checked").attr("disabled","disabled");
                                SelectBuyerAccountNew(mid,btn,$divin.wrap("<div></div>").parent());
                            });
                            DisabledClose();
                            return;
                        }
                    },'json');
                }
            }
        },function(){
            if( $(btn).attr("id") == "btnAutoAM" )
                $("#reAutoAM").hide();            
            CancelAcceptMission(mid);
        });
        
        DisabledClose();
    }
}
function CancelAcceptMission(mid){
    var tipsDialog=artDialog({content:"正在取消接手任务，请稍候...",id:"tips",lock:true});
    DisabledClose();
    $.post("/ajax/MyTaskOut.php",{"taskid":mid}, function(result){  
		tipsDialog.close(); 
        $("#taskList").show();		
        goPage(1);
		
    });
}

var showImage = "<img style=\"margin-top:2px;\" src=\"/images/show.gif\" /> ";
var hiddenImage = "<img style=\"margin-bottom:2px;\" src=\"/images/hidden.gif\" /> ";
function OpenTrueNameBa(count){
    $("#alContent tr[id=trListNormal]").hide();
    $("#alContent tr[id=trListTrueName]").show();
    $("#alContent span[id=spanNormalHead]").html(showImage + "普通买号（可用"+count+"个，点击查看）").next().hide();
    $("#alContent span[id=spanTrueNameHead]").html(hiddenImage + "实名买号").next().show();
}
function OpenNormalBa(count){
    $("#alContent tr[id=trListTrueName]").hide();
    $("#alContent tr[id=trListNormal]").show();
    $("#alContent span[id=spanNormalHead]").html(hiddenImage + "普通买号").next().show();
    $("#alContent span[id=spanTrueNameHead]").html(showImage + "实名买号（可用"+count+"个，点击查看）").next().hide();
}

function AutoAMResult(result){
    if( result.state == 1 ){
        artDialog({content:"服务器拒绝获取数据。原因：您的登录已失效，或者您已在其他地方登录",id:"alarm"},function(){});
        StopAutoAM();
    }
    else if( result.state==2){
        artDialog({content:"服务器拒绝获取数据。原因：自动接任务功能每天只能免费接到3个任务，您今日的配额已经接满，请明天再使用。",id:"alarm"},function(){});
        StopAutoAM();
    }
    else{
        if($("#divIDList input").length==0){
            artDialog({content:"您还未绑定您的淘宝买号，或您绑定的淘宝买号未启用，请点击此处绑定您的淘宝买号。",id:"alarm",fixed:true,yesText:"立即去绑定",lock:true},function(){
                window.open("/member/buytao/");
            });
            DisabledClose();
            StopAutoAM();
        }
        else{
            var curTimeDes=GetCurTime();
            ShowAMTip(" "+curTimeDes+"，正在分析任务数据，请稍候...");
            var MList = new Array();
			var waitMList = new Array();  
			if( result.itemList.length<10 )
                waitMList=result.itemList;
            else{
			    waitMList[0]=result.itemList[0];
                waitMList[1]=result.itemList[1];
                waitMList[2]=result.itemList[2];
                waitMList[3]=result.itemList[3];
				waitMList[4]=result.itemList[4];
                waitMList[5]=result.itemList[5];
				waitMList[6]=result.itemList[6];
                waitMList[7]=result.itemList[7];
				waitMList[8]=result.itemList[8];
				waitMList[9]=result.itemList[9];
            } 
            for(i=0;i<waitMList.length;i++){
                var misItem = result.itemList[i];
                if( misItem.status == 1 ){
                    if( misItem.price < at_txtMinPrice || misItem.price > at_txtMaxPrice){
					    ShowAMTip(" "+curTimeDes+"，接任务失败！原因是不在期望所接任务的价格范围内");
                        continue;
					}	
                    if( misItem.point < at_txtMinpoint){
					    ShowAMTip(" "+curTimeDes+"，接任务失败！原因是任务奖励的麦点低于"+at_txtMinpoint); 
                        continue;
					}	
                    if( at_NoSB && misItem.isEnsure>0){
					    ShowAMTip(" "+curTimeDes+"，接任务失败！原因是您过滤了商保任务"); 
                        continue;
					}	
                    if( at_NoAudit && misItem.isVerify>0){
					    ShowAMTip(" "+curTimeDes+"，接任务失败！原因是您过滤了审核任务");
                        continue;
					}	
                    if( at_NoWW && misItem.isChat>0){
					    ShowAMTip(" "+curTimeDes+"，接任务失败！原因是您过滤了拍前聊任务");
                        continue;
					}	
                    if( at_NoLHS && misItem.isChatDone>0){
					    ShowAMTip(" "+curTimeDes+"，接任务失败！原因是您过滤了聊后收任务");
                        continue;
					}	
                    if( at_NoCart && misItem.isCart>0){
                        ShowAMTip(" "+curTimeDes+"，接任务失败！原因是您过滤了购物车任务");
						continue;
					}	
                    if( at_NoMeal && misItem.isMeal>0){
                        ShowAMTip(" "+curTimeDes+"，接任务失败！原因是您过滤了套餐任务");
						continue;   
					}	
                    if( at_NoLaiLu && misItem.visitWay>0){
                        ShowAMTip(" "+curTimeDes+"，接任务失败！原因是您过滤了来路任务");
						continue;
					}	
					if( at_NoExpress && misItem.isExpress>0){
                        ShowAMTip(" "+curTimeDes+"，接任务失败！原因是您过滤了真实签收任务");
						continue;
					}	
                    if( at_NoPinPic && misItem.pinimage>0){
					    ShowAMTip(" "+curTimeDes+"，接任务失败！原因是您过滤了评图任务");
                        continue;
					}	
                    if( misItem.times < at_timesBegin || misItem.times > at_timesEnd){
                        ShowAMTip(" "+curTimeDes+"，接任务失败！原因是要求确认好评时间不在期望天数区间");
						continue;
					}	
                    if( at_isCartOnly && misItem.isCart==0){
					    ShowAMTip(" "+curTimeDes+"，接任务失败！原因是不是购物车任务");
                        continue;
					}	
                    if( at_isMealOnly && misItem.isMeal==0){
                        ShowAMTip(" "+curTimeDes+"，接任务失败！原因是不是套餐任务");
						continue;   
					}	
                    if( at_isLailuOnly && misItem.visitWay==0){
					    ShowAMTip(" "+curTimeDes+"，接任务失败！原因是不是来路任务");
                        continue;
					}	
                    if( at_isExOnly && misItem.isExpress==0){
					    ShowAMTip(" "+curTimeDes+"，接任务失败！原因是不是真实签收任务");
                        continue;
					}	
                    if( at_isEnsureOnly && misItem.isEnsure==0){
					    ShowAMTip(" "+curTimeDes+"，接任务失败！原因是不是商保任务");
                        continue;
					}	
                    if( at_isReal==1 && misItem.isReal==0){
					    ShowAMTip(" "+curTimeDes+"，接任务失败！原因是不是实名买号任务");
                        continue;
					}	
					if( at_isReal==2 && misItem.isReal==1){
					    ShowAMTip(" "+curTimeDes+"，接任务失败！原因是不是普通买号任务");
						continue;
					}	
                    MList[MList.length] = result.itemList[i];
                }
            }
            if( MList.length > 0 ){
                var mItem=RanArr(MList);                                 
                var taskid = mItem.id;
                $.post("/ajax/autotk.php",{"taskid":taskid}, function(result){  
				    if(result.StateCode==0){
                        StopAutoAM();
                        var $accountList=$("#divIDList");
						var btn = document.getElementById("btnAutoAM");
						SelectBuyerAccountNew(taskid,btn,$accountList);
                    }else{
                        switch(result.StateCode){
                case 1:{
                    artDialog({content:result.StateMsg,id:"alarm"},function(){});
                    StopAutoAM();
				    break;
                }
				case 2:{
                    artDialog({content:result.StateMsg,id:"alarm"},function(){});
                    StopAutoAM();
				    break;
                }
				case 3:{
                    artDialog({content:result.StateMsg,id:"alarm"},function(){});
                    StopAutoAM();
				    break;
                }
				case 4:{
                    artDialog({content:result.StateMsg,id:"alarm"},function(){});
                    StopAutoAM();
				    break;
                }
                default:{
                    ShowAMTip(" "+curTimeDes+"，"+result.StateMsg);
                    break;
                }
                        }
                    }
                },'json');
            }
            
            setTimeout("isGetData=false;AutoRef(document.getElementById('nAuTotk'))",800);
        }
    }
}
function ShowAMTip(msg){
    $("#taskList").hide();
    $("#reAutoAM").show().find("span").html(msg);
}
function GetCurTime(){
    var today = new Date();
    var sec = today.getSeconds();
    var hr = today.getHours();
    var min = today.getMinutes();
    if (hr <= 9) hr = "0" + hr;
    if (min <= 9) min = "0" + min;
    if (sec <= 9) sec = "0" + sec;
    var clocktext = hr + ":" + min + ":" + sec;
    return clocktext;
}
function RanArr(oArr)
{
    if( oArr.length == 1 )
        return oArr[0];
    else
        return oArr[Math.round(Math.random()*10000) % oArr.length];
}
function StopAutoAM(){
    $("#nAuTotk").removeAttr("checked");
}

function getPlayer(movieName){
	if(navigator.appName.indexOf("Microsoft") != -1){
	    return window[movieName];
    }else{
	    return document[movieName];
    }
}
function iiww() {
    var c, b = true;
    try {
        c = new ActiveXObject("aliimx.wangwangx")
    } catch(d) {
        try {
            c = new ActiveXObject("WangWangX.WangWangObj")
        } catch(d) {
            b = false
        }
    } finally {
        c = null
    }
    if (!b) {
        try {
            var a = navigator.mimeTypes["application/ww-plugin"];
            if (a) {
                b = true
            }
        } catch(d) {}
    }
    return b
}
