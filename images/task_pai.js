var pageSize=15;
var interval;
var buffTime=500;
var buffHtml="";
var lastPage=1;
var isBuff=true;
function GoPageLast(index){
    if( buffHtml != "" && lastPage==index ){
        isBuff = true;
        setTimeout("UpdateTask()",buffTime);
    }
    else
        isBuff = false;
    
    var htm=""
    if(index>1)
        htm+="<a class=\"page-prev\" href=\"javascript:GoPage("+(index-1)+");\">上一页</a>";
    for(i=1;i<=3;i++){
        if( index==i )
            htm+="<a class=\"on\">"+i+"</a>";
        else
            htm+="<a href=\"javascript:GoPage("+i+");\">"+i+"</a>"
    }
    if(index<10)
        htm+="<a class=\"page-next\" href=\"javascript:GoPage("+(index+1)+");\">下一页</a>";
    $(".pageno").html(htm);
    lastPage=index;
}
function UpdateTask(){
    $("#TaskItem").html(buffHtml);
    $("#reLoad").hide();
    $(".reListTitle tbody>tr:odd").addClass("tcolor");
    $("#divTaskBody").show(); 
}
function GetDatingResult(result){
    if( result.state == 1 ){
        artDialog({content:"服务器拒绝获取数据。原因：您的登录已失效，或者您已在其他地方登录！",id:"alarm"},function(){});
        isBuff=false;
    }
    else if( result.state==2){
        artDialog({content:"服务器拒绝获取数据。原因：为了平台接任务的公平，以及减少平台服务器的压力，此页请不要打开多个！<br/>如果您长期没有操作，只需要按F5刷新本页即可！",id:"alarm"},function(){});
        isBuff=false;
    }
    else{
        var htm="";
        for(i=0;i<result.itemList.length;i++){
            htm+="<tr>";
            htm+="<td class=\"id\">";
            if(result.itemList[i].goodsUrl=="CART"){
                htm+="<p class=\"c\" title=\"购物车任务\">";
            }else if(result.itemList[i].goodsUrl=="LAILU"){
                htm+="<p class=\"l\" title=\"来路任务\">";
            }else if(result.itemList[i].goodsUrl=="MEAL1"||result.itemList[i].goodsUrl=="MEAL2"){
                htm+="<p class=\"t\" title=\"套餐任务\">";
            }else{
                if(result.itemList[i].OKDay==0){
                    htm+="<p class=\"x\" title=\"虚拟任务\">";
                }else{
                    htm+="<p class=\"s\" title=\"实物任务\">";
                }
            }
            
            htm+=result.itemList[i].mId+"</p><em>"+ (result.itemList[i].isSB?"<i class=\"comma\"></i>":"") +"<i>Post Time："+result.itemList[i].createAt+"</i></em></td>";
            htm+="<td class=\"poster\"><a "+(result.itemList[i].memberClass==1 ? "class=\"vip\"" : "")+" href='/member/"+result.itemList[i].sellerName+"' target='_blank' title='接任务后方可查看到对方QQ号码'>"+result.itemList[i].sellerName+"</a>";
            switch(result.itemList[i].memberLevel){
                case 5:
                    htm+="<em class=\"vip1\" title=\"一级VIP客户\">&nbsp;</em>&nbsp;";
                    break;
                case 6:
                    htm+="<em class=\"vip2\" title=\"钻石VIP客户\">&nbsp;</em>&nbsp;";
                    break;
                case 10:
                    htm+="<em class=\"vip3\" title=\"皇冠VIP客户\">&nbsp;</em>&nbsp;";
                    break;
            }
            htm+="Exp:"+Math.round(result.itemList[i].memberGrade)+"</td>";
            var price=result.itemList[i].goodsPrice.toFixed(2);
            if (result.itemList[i].isGJ)
                htm+="<td class=\"price\"><p class=\"edit\" title=\"拍下商品，付款前需联系店主修改商品价格，使得支付费用与任务金额相等，即为"+price+"元\">"+price+"</p></td>";
            else
                htm+="<td class=\"price\"><p>"+price+"</p></td>";
            htm+="<td class=\"oktime\">";
            htm+="<p class=\"d"+(result.itemList[i].OKDay==0 ? "0" : "24")+"\">"+(result.itemList[i].OKDay == 0 ? "立即" : (result.itemList[i].OKDay * 24)+"小时")+(result.itemList[i].isMsg ? "带字" : "")+"五星好评</p>";
            if (result.itemList[i].isAuit)
                htm+="<em class=\"sh\" title=\"接任务者需要发布者审核\">&nbsp;</em>";
            if (result.itemList[i].isWW)
                htm+="<em class=\"wang\" title=\"此任务需要拍前在旺旺上模拟购买聊天\">&nbsp;</em>";
            if (result.itemList[i].isLHS)
                htm+="<em class=\"chata\" title=\"此任务需要旺旺确认收货\">&nbsp;</em>";
            if (result.itemList[i].taoG>0)
                htm+="<em class=\"golda\" title=\"此任务需要"+ result.itemList[i].taoG +"个淘兔粮\">&nbsp;</em>";
            if (result.itemList[i].isMsg)
                htm+="<em class=\"anping\" title=\"按发布者提供的评语进行评价\">&nbsp;</em>";
            if (result.itemList[i].isMultiMsg)
                htm+="<em class=\"duoping\" title=\"按发布者提供的评语进行评价\">&nbsp;</em>";
            if (result.itemList[i].isMsg2!="")
                htm+="<em class=\"gai\" title=\"按发布者要求的收货地址填写\">&nbsp;</em>";
            if (result.itemList[i].IsHaoPinImage)
                htm+="<em class=\"hpimage\" title=\"此任务需要上传好评截图\">&nbsp;</em>";
            if (result.itemList[i].BaLevelId>0)
                htm+="<em class=\"balevel"+ result.itemList[i].BaLevelId +"\" title=\""+ result.itemList[i].BaLevelTitle  +"\">&nbsp;</em>";
            htm+="</td>";
            htm+="<td class=\"gold\">";            
            if (result.itemList[i].OKDay > 0)
            {
                if (result.itemList[i].mPrice > result.itemList[i].vPrice)
                    htm+="<em style=\"color:#090;\">"+result.itemList[i].mPrice.toFixed(2)+"&nbsp;个兔粮</em><b>↑&nbsp;发布者增加了任务发布兔粮"+Number(result.itemList[i].mPrice-result.itemList[i].vPrice).toFixed(2)+"个</b>";
                else
                    htm+="<em style=\"color:#090;\">"+result.itemList[i].mPrice.toFixed(2)+"&nbsp;个兔粮</em>";
            }
            else
            {
                if (result.itemList[i].mPrice > result.itemList[i].vPrice)
                    htm+="<em>"+result.itemList[i].mPrice.toFixed(2)+"&nbsp;个兔粮</em><b>↑&nbsp;发布者增加了任务发布兔粮"+Number(result.itemList[i].mPrice-result.itemList[i].vPrice).toFixed(2)+"个</b>";
                else
                    htm+="<em>"+result.itemList[i].mPrice.toFixed(2)+"&nbsp;个兔粮</em>";
            }
            htm+="</td>";
            htm+="<td class=\"do\">";
            switch (result.itemList[i].mState)
            {
                case 1:;
                    var isDisWW = (result.itemList[i].isWW || result.itemList[i].isLHS) ? true : false;
                    htm+="<a class=\"button4_a\" href=\"javascript:void(0);\" balId=\""+ result.itemList[i].BaLevelId +"\" balTitle=\""+ result.itemList[i].BaLevelTitle +"\" onclick=\"AccceptMis('"+result.itemList[i].mId+"',"+isDisWW+",this);\">抢此任务</a>";
                    break;
                case 255:
                    htm+="<p class=\"s_3\">任务已结束...</p>";
                    break;
                default:
                    htm+="<p class=\"s_2\">任务进行中...</p>";
                    break;
            }
            htm+="</td>";
        } 
        if( !isBuff )
            $("#TaskItem").html(htm);
        buffHtml=htm;
    }
    if( !isBuff ){
        $("#reLoad").hide();
        $(".reListTitle tbody>tr:odd").addClass("tcolor");
        $("#divTaskBody").show(); 
    }
    setTimeout("isGetData=false",800);
}

var curMisIsDisWW=false;
function taskin(mid,isDisWW,btn){
	if(!curExam){
        artDialog({content:"您还未通过新手考试，通过考试还能获得1个兔粮哦！",id:"alarm",fixed:true,yesText:"立即去考试",lock:true},function(){
            window.open("/member/exam/");
        });
        DisabledClose();
        return;
    }
    if($("#divIDList input").length==0){
        artDialog({content:"您还未绑定您的拍拍买号，或您绑定的拍拍买号未启用，请点击此处绑定您的拍拍买号。",id:"alarm",fixed:true,yesText:"立即去绑定",lock:true},function(){
            window.open("/member/buytao/");
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
            SelectBuyerAccountNew(mid,btn,$accountList);
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
                        window.location.href="/member/smsactivation/";
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
		  $(".bpage"+$pk).hide(); 
		  }
		if($(".bpage"+$pn)){
		  $(".bpage"+$pn).hide(); 
		  }
	}else if($k==1){
		if($(".bpage2")){
		  $(".bpage2").hide(); 
		  }
	}
	$(".bpage"+$k).css({'display':'block'});
}
function Openbuyersmpage($k){
	if($k>1){
		$pk=$k-1;
		$pn=$k+1;
		if($(".bsmpage"+$pk)){
		  $(".bsmpage"+$pk).hide(); 
		  }
		if($(".bsmpage"+$pn)){
		  $(".bsmpage"+$pn).hide(); 
		  }
	}else if($k==1){
		if($(".bsmpage2")){
		  $(".bsmpage2").hide(); 
		  }
	}
	$(".bsmpage"+$k).css({'display':'block'});
}
function SelectBuyerAccountNew(mid,btn,$accountList){
    var dislen = $accountList.find("input:radio[disabled]").size();
    var alllen = $accountList.find("input:radio").size();
    if(dislen==alllen){
        artDialog({content:"花兔兔温馨提示：您所有的买号都不能接手此任务。",id:"al1",fixed:true,yesText:"关闭，继续抢其它任务",lock:true},function(){
            CancelAcceptMission(mid);
        });
        DisabledClose();
        return;
    }else{
        $accountList.find("input:radio[checked]").removeAttr("checked");
        artDialog({content:$accountList.html(),title:"为任务"+mid+"选择买号" ,id:"al",fixed:true,lock:true},function(){            
            var $divin = $("#alContent .divin").clone();
            var $aId=$divin.find("input:radio[name=ba][checked]");             
            var aId=$aId.val();
            if(aId==undefined){
                $aId=$("#alContent input:radio[name=ba][checked]");
                aId = $aId.val();
            }
            if(aId==undefined){
                artDialog({content:"花兔兔温馨提示：请选择好买号再提交!<br/>如果没有买号，请到【会员中心-绑定买号】里面先绑定买号再接任务",id:"alarm",fixed:true,yesText:"立即去绑定",noText:"重选买号",lock:true},function(){
                    window.open("/member/buypai/");
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
                                window.open("/task/"+result.urlpai+"/?m=taskIn&t=ing","_self");
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
        goPage(1);
		
    });
}

var showImage = "<img style=\"margin-top:2px;\" src=\"/images/show.gif\" /> ";
var hiddenImage = "<img style=\"margin-bottom:2px;\" src=\"/images/hidden.gif\" /> ";
function OpenTrueNameBa(obj){
    $("#alContent tr[id=trListNormal]").hide();
    $("#alContent tr[id=trListTrueName]").show();
    $("#alContent span[id=spanNormalHead]").html(showImage + "普通买号（点击查看普通买号）").next().hide();
    $("#alContent span[id=spanTrueNameHead]").html(hiddenImage + "实名买号").next().show();
}
function OpenNormalBa(){
    $("#alContent tr[id=trListTrueName]").hide();
    $("#alContent tr[id=trListNormal]").show();
    $("#alContent span[id=spanNormalHead]").html(hiddenImage + "普通买号").next().show();
    $("#alContent span[id=spanTrueNameHead]").html(showImage + "实名买号（点击查看实名买号）").next().hide();
}

function AutoAMResult(result){
    if( result.state == 1 ){
        artDialog({content:"服务器拒绝获取数据。原因：您的登录已失效，或者您已在其他地方登录！",id:"alarm"},function(){});
        StopAutoAM();
    }
    else if( result.state==2){
        artDialog({content:"服务器拒绝获取数据。原因：为了平台接任务的公平，以及减少平台服务器的压力，此页请不要打开多个！<br/>如果您长期没有操作，只需要按F5刷新本页即可！",id:"alarm"},function(){});
        StopAutoAM();
    }
    else{
        if($("#divIDList input").length==0){
            artDialog({content:"您还未绑定您的拍拍买号，或您绑定的拍拍买号未启用，请点击此处绑定您的拍拍买号。",id:"alarm",fixed:true,yesText:"立即去绑定",lock:true},function(){
                window.open("/member/buytao/");
            });
            DisabledClose();
            StopAutoAM();
        }
        else{
            var curTimeDes=GetCurTime();
            ShowAMTip(" "+curTimeDes+"，正在分析任务数据，请稍候...");
            var MList = new Array();
            for(i=0;i<result.itemList.length;i++){
                var misItem = result.itemList[i];
                if( misItem.mState == 1 ){
                    //过滤黑名单
                    var isHMD=false;
                    for(hi=0;hi<hmdList.length;hi++){
                        if(hmdList[hi]==misItem.sellerName){
                            isHMD=true;
                            break;
                        }
                    }
                    if(isHMD)
                        continue;
                    if( misItem.goodsPrice < am_MinPrice || misItem.goodsPrice > am_MaxPrice)
                        continue;
                    if( misItem.mPrice < am_MinG)
                        continue;
                    if( misItem.taoG < am_MinTaoG || misItem.taoG > am_MaxTaoG)
                        continue;
                    if( am_IsNoSB && misItem.isSB)
                        continue;
                    if( am_IsNoAudit && misItem.isAuit)
                        continue;
                    if( am_IsNoWW && misItem.isWW)
                        continue;
                    if( am_IsNoTaoG && misItem.taoG>0)
                        continue;
                    if( am_IsNoLHS && misItem.isLHS)
                        continue;
                    if( am_IsNoCart && misItem.goodsUrl=="CART")
                        continue;
                    if( am_IsNoMeal && (misItem.goodsUrl=="MEAL1" || misItem.goodsUrl=="MEAL2"))
                        continue;   
                    if( am_IsNoLaiLu && misItem.goodsUrl=="LAILU")
                        continue;
                    if( am_IsNoPinPic && misItem.IsHaoPinImage)
                        continue;
                    if( misItem.OKDay < am_BeginOKAt || misItem.OKDay > am_EndOKAt)
                        continue;
                    if( am_IsOnlyCart && misItem.goodsUrl != "CART")
                        continue;
                    if( am_IsOnlyMeal && misItem.goodsUrl != "MEAL1" && misItem.goodsUrl != "MEAL2")
                        continue;   
                    if( am_IsOnlyLaiLu && misItem.goodsUrl != "LAILU")
                        continue;
                    if( am_IsOnlyTaoG && misItem.taoG==0)
                        continue;
                    if( am_IsOnlySB && !misItem.isSB)
                        continue;
                    if( am_NoBALevel != "" && am_NoBALevel.indexOf(","+misItem.BaLevelId+",") >= 0 )
                        continue;
                        
                    MList[MList.length] = result.itemList[i];
                }
            }
            if( MList.length > 0 ){
                var mItem=RanArr(MList);                                 
                var mid = mItem.mId;
                $.postJOSN("/Action/AjaxSer.asmx/AcceptMission1",{"mId":mid}, function(result){     
                    if(result.StateCode==0){
                        StopAutoAM();
                        setTimeout("playSound()",1000);
                        var $accountList=$("#divIDList");
                        var btn = document.getElementById("btnAutoAM");
                        $(btn).attr("balId",mItem.BaLevelId).attr("balTitle",mItem.BaLevelTitle);
                        curMisIsDisWW = (mItem.isWW || mItem.isLHS) ? true : false;
                        SelectBuyerAccountNew(mid,btn,$accountList);
                    }else{
                        switch(result.StateCode){
                            case 11:{
                                artDialog({content:"您正在被投诉中，请立即处理！自动抢任务程序停止。",id:"alarm"},function(){});
                                StopAutoAM();
                                break;
                            }
                            case 8:{
                                artDialog({content:"接任务失败！原因一：您未完成的任务数已达上限，请先完成现有的任务！或者升级为vip会员接更多任务！原因二：新注册用户积分小于1无法接手任务，请发布1个任务并完成后获取接任务权！自动抢任务程序停止。",id:"alarm"},function(){});
                                StopAutoAM();
                                break;
                            }
                            case 15:{
                                artDialog({content:"您所在IP在今天已接6次任务！自动抢任务程序停止。",id:"alarm"},function(){});
                                StopAutoAM();
                                break;
                            }
                            case 22:{
                                artDialog({content:"您有一个任务还未选择买号，系统将在1分钟后自动释放该任务！自动抢任务程序停止。",id:"alarm"},function(){});
                                StopAutoAM();
                                break;
                            }
                            case 23:{
                                artDialog({content:"您目前有多个任务还未处理，请先处理了再来接任务！自动抢任务程序停止。",id:"alarm"},function(){});
                                StopAutoAM();
                                break;
                            }
                            default:{
                                ShowAMTip(" "+curTimeDes+"，"+result.StateMsg);
                                break;
                            }
                        }
                    }
                });
            }
            
            setTimeout("isGetData=false;AutoRef(document.getElementById('cbxAutoRef'))",800);
        }
    }
}
function ShowAMTip(msg){
    $("#divTaskBody").hide();
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
    //clearInterval(interval);
    $("#cbxAutoRef").removeAttr("checked");
}
$(".dating").ready(function(){
    $("#aAutoAM").html("（配置自动接任务筛选条件）");
});
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
