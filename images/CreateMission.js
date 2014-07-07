$(document).ready(function(){
    if( curG < 1){
        artDialog({content:"对不起！您的麦点不够了，发布任务最少需要1个麦点，请充值购买麦点或者接任务免费获得麦点。",id:"alarm",fixed:true,lock:true,yesText:"立即购买麦点",noText:"马上去接任务"},
            function(){window.location.href="/member/BuyPoint/"},function(){window.location.href="/task/tao/"});
        $(".ui_close").hide();
    }
    else{
        $("#txtMinMPrice").attr("readonly","readonly");
        $("#txtPrice").blur(function(){
            var curGoodsPrice = this.value;
            if( curGoodsPrice != ""){     
                if(curGoodsPrice>0)
                     ValidPrice(parseFloat(curGoodsPrice));
                else
                 artDialog({content:"对不起！输入的商品总价格式错误，请重新输入。",id:"alarm"},function(){},null,function(){Init();ToMao();});  
            }
            else{
                Init();
            }
        });
		$("#pointExt").blur(function(){
			if (this.value<0){
				this.value=0;
				artDialog({content:"悬赏麦点不能小于0。",id:"alarm"},function(){},null,function(){Init();ToMao();});
			}
		});
		
        var szgIndex = -1;
		$("#txtPrice").blur(function(){
                if (this.value <= 40)
					setValue('txtMinMPrice', 1);
				if (this.value > 40 && this.value <= 80)
					setValue('txtMinMPrice', 1.5);
				if (this.value > 80 && this.value <= 120)
					setValue('txtMinMPrice', 2);
				if (this.value > 120 && this.value <= 200)
					setValue('txtMinMPrice', 3);
				if (this.value > 200 && this.value <= 500)
					setValue('txtMinMPrice', 4);
				if (this.value > 500 && this.value <= 1000)
					setValue('txtMinMPrice', 5);
				if (this.value > 1000 && this.value <= 1500)
					setValue('txtMinMPrice', 6);
				if (this.value > 1500)
					setValue('txtMinMPrice', 7);									 
		});
        $("#btnCilentAdd").click(function(){
            szgIndex =  $("#ddlZGAccount").val();
            if(szgIndex==-1){
                artDialog({content:"对不起！请选择一个淘宝掌柜名。",id:"alarm"},function(){},null,function(){Init();ToMao();});
		        return false;
            }
            var goodsPrice=$("#txtPrice").val();
            if(goodsPrice<=0){
		        artDialog({content:"对不起！商品总价格必需大于0，请重新输入。",id:"alarm"},function(){},null,function(){Init();ToMao();});
		        return false;
	        }
			if($("#cbxIsMsg").is(':checked')){
				if($("#txtMessage").val().length>200){
					artDialog({content:"对不起！给接手人的规定好评内容请保持在200个字符以内。",id:"alarm"},function(){},null,function(){Init();ToMao2();});
					return false;
				}
			}
	        if($("#cbxIsAddress").is(':checked')){
				if($("#cbxAddress").val().length>100){
		            artDialog({content:"对不起！给接手人的规定收货地址请保持在100个字符以内。",id:"alarm"},function(){},null,function(){Init();ToMao2();});
		            return false;
	            }
	        }
			
	        if($("#cbxIsTip").is(':checked')){
	            var buycount=$.trim($("#txtBuyCount").val());
	            if(buycount!=""){
	                buycount=parseInt(buycount);
                    if(isNaN(buycount) || buycount<1 || buycount>999){
	                    artDialog({content:"对不起！商品购买数量有效值为1到999之间的正整数。",id:"alarm"},function(){$("#txtBuyCount").focus();});
	                    return false;
                    }
	            }
	        }
	        
           if($("#cbxIsTaoG").is(":checked")){
                var taoG=$.trim($("#txtTaoG").val());
	            taoG=parseInt(taoG);
	            if(isNaN(taoG) || taoG<=0 || taoG>300 || taoG%10!=0){
		            artDialog({content:"对不起，请输入正确的淘金币。淘金币为0到300之间的整数，且为10的倍数。",id:"alarm"},function(){});
		            return false;
	            }
            }
	        if($("#cbxIsSetTime1").is(':checked')){
	            var minute=$("#txtSetTime").val();
	            minute=parseInt(minute);
	            if(isNaN(minute) || minute<=0){
		            artDialog({content:"对不起！请输入正整数的延迟分钟数。",id:"alarm"},function(){});
		            return false;
	            }
	        }
			if($("#cbxIsSetTime2").is(':checked')){
	            var txtdelaydate=$("#txtdelaydate").val().substr(0,10);
				var txtdelayhh=$("#txtdelayhh").val();
				var txtdelaymm=$("#txtdelaymm").val();
				var NowDate = new Date();
				addDate=txtdelaydate.split("-");
				addDate1=new Date(addDate[0], addDate[1]-1, addDate[2],txtdelayhh,txtdelaymm);
				addDate2=addDate1.getTime();
				addDate3=NowDate.getTime();
				if(addDate2<addDate3){
				 artDialog({content:"对不起！请输入正整数的延迟时间。",id:"alarm"},function(){});
		         return false;
				}
	        }
			if($("#isTpl").is(':checked')){
				if($("#tplTo").val().length<1){
		            artDialog({content:"对不起！请输入创建的任务模版名称",id:"alarm"},function(){},null,function(){$("#tplTo").focus();});
		            return false;
	            }
	        }
	        var goodsUrl=$("#txtGoodsUrl").val();
	        var validGoodsUrl=goodsUrl.toLowerCase();
            //TODO 对淘宝地址进行验证确认地址所在的与卖家是同一个
	        if(!validGoodsUrl|| !ValidDomainF(validGoodsUrl) || validGoodsUrl.indexOf("meal")>0){
		        artDialog({content:"对不起，您还未输入商品URL地址或者地址有错误。（特别注意：此地址为您店铺需要买方拍的商品地址，而非淘宝店地址）",id:"alarm",yesText:"确定"/*,noText:"查看URL地址帮助"*/},function(){ToMao();}/*,function(){window.open("http://shua.114.acd8.com/");}*/);
				$(".ui_close").hide();
		        return false;
	        }else{
	            var dialog=artDialog({content:"正在验证您输入的商品url地址，请稍候...",id:"VGU",fixed:true,lock:true});
	            $(".ui_close").hide();
				
	            $.post("/ajax/checkshop.php",{"seller":szgIndex,"goodsUrl":goodsUrl}, function(result){
	                dialog.close();
	                //$(".ui_close").show(); 
	                if(result==0){
	                        $("#txtGoodsUrl").val(goodsUrl.replace("&#",""));
							addconfirm();
					} else if (result=='1'){
                           artDialog({content:"系统繁忙 请刷新后再试",id:"alarm"},function(){ToMao();});
					}else if (result=='2'){
                           artDialog({content:"对不起！您提交的参数错误，请重选选择后提交。",id:"alarm"},function(){ToMao();});
					} else if (result=='3'){
                            artDialog({content:"对不起！您选择的淘宝掌柜名有误。",id:"alarm"},function(){ToMao();});
					} else if (result=='11'){
                            artDialog({content:"对不起！您输入的商品url地址对应的掌柜名与您在本平台选择的掌柜名不一致。请注意核对掌柜名是否正确（大小写以及繁体请注意区分），如有错误，请联系在线客服进行解决。",id:"alarm"},function(){ToMao();});
					} else if (result=='12'){
                            artDialog({content:"对不起！您输入的商品url地址无法读取。",id:"alarm"},function(){ToMao();});
	                }else if (result=='13'){
                            artDialog({content:"禁止发布此商品链接~~",id:"alarm"},function(){ToMao();});
	                }
                })
                return false;
            }
        }).css("cursor","pointer");
        
 
        
        $("#ddlOKDay").change(function(){
            var okDay=parseInt(this.value);
            if( okDay==0 )
                $("#pOKDes").html("");
            else{
                var minPrice=$("#txtMinMPrice").val();
                var addPrice=(minPrice*basePriceDouble + okDay - 1) - minPrice;
                $("#pOKDes").html("额外支出麦点<em>"+addPrice+"</em>个");
            }
        });
        
       $("#cbxIsSetTime1").click(function(){
            if(this.checked){
                if( $("#cbxIsSetTime1").attr("checked") || $("#cbxIsSetTime2").attr("checked")){
                    this.checked = false;
                    artDialog({content:"设置任务延迟发布后，不论您是否在线您的任务都将在大厅显示，系统自动取消审核",id:"alarm"},function(){});
                }
            }
        });
		$("#isLimitCity,#isMultiple").click(function(){
		if(isVip===false){
		    $("#isLimitCity").removeAttr("checked");
			$("#isMultiple").removeAttr("checked");
			artDialog({content:"目前限制接手人IP功能仅针对大麦户VIP开放！",id:"alarm",yesText:"加入VIP",noText:"返回修改"},
        function(){window.open("/BuyPoint/");},
        function(){},function(){Init();});
			}
		});	
        $("#isProvince").click(function(){
				 if(this.checked){
				     if($("#isProvince").attr("cid")==0){
					    this.checked=false;	 
						artDialog({content:"您未设置同省签收的发货省份，请先在【会员中心】->【资料密码】中设置",id:"alarm"},function(){});
					 }	 
				 }		   
		});
        $("#cbxIsTip").click(function(){
            if($(this).attr("checked")){
                $("#divTip").show();
            }else{
                $("#divTip").hide();
            }
        });
        $("#cbxIsAddress").click(function(){
                if($(this).attr("checked")){
					if (getObj('isSign').checked || getObj('isawb').checked){
					this.checked=false;
					artDialog({content:"对不起，真实签收任务、快递单号任务与规定收货地址不能同时选择",id:"alarm"},function(){});
					}
					$("#cbxTip").show();
				}else{
					$("#cbxTip").hide();
				}
			
        });
		$("#isSign").click(function(){
                if($(this).attr("checked")){
					if (getObj('cbxIsAddress').checked || getObj('isawb').checked){
					this.checked=false;
					artDialog({content:"对不起，真实签收任务、快递单号任务与规定收货地址不能同时选择",id:"alarm"},function(){});
					}
				}
			
        });
		$("#isawb").click(function(){
                if($(this).attr("checked")){
					if (getObj('cbxIsAddress').checked || getObj('isSign').checked){
					this.checked=false;
					artDialog({content:"对不起，真实签收任务、快递单号任务与规定收货地址不能同时选择",id:"alarm"},function(){});
					}
				}
			
        });
		$("#isNoword").click(function(){
                if($(this).attr("checked")){
					if (getObj('cbxIsMsg').checked){
					this.checked=false;
					artDialog({content:"对不起，不带字好评任务与规定好评内容不能同时选择",id:"alarm"},function(){});
					}
				}
			
        });
		$("#cbxIsMsg").click(function(){
                if($(this).attr("checked")){
					if (getObj('isNoword').checked){
					this.checked=false;
					artDialog({content:"对不起，规定好评内容与不带字好评任务不能同时选择",id:"alarm"},function(){});
					}
				}
			
        });
        BindFilterFun();
        
        $("#cbxIsSetTime1,#cbxIsSetTime2").click(function(){
            if(this.checked){
                if($(this).attr("id")=="cbxIsSetTime1"){
                    $("#cbxIsSetTime2").attr("checked",false);
                }else{
                    $("#cbxIsSetTime1").attr("checked",false);
                }
                if( $("#cbxIsAudit").attr("checked") ){
                    $("#cbxIsAudit").removeAttr("checked");
                    artDialog({content:"设置任务延迟发布后，不论您是否在线您的任务都将在大厅显示，系统自动取消审核",id:"alarm"},function(){});
                }
            }
        });
        
        var price=parseFloat($("#txtPrice").val());
        if( price == 0 )
            Init();
        else
            ValidPrice(price);
            
        $("#txtdelaydate").click(function(){
            displayCalendar(this,"yyyy-mm-dd",this);
        }).attr("readonly",true);
        
        $("#txtdelayhh").blur(function(){
            var v = $.trim($(this).val());
            if(isNaN(v)){
                $(this).val("0");
            }else{
                v=parseInt(v);
                if(v<0||v>23){
                    $(this).val("0");
                }
            }
        });
        $("#txtdelaymm").blur(function(){
            var v = $.trim($(this).val());
            if(isNaN(v)){
                $(this).val("0");
            }else{
                v=parseInt(v);
                if(v<0||v>59){
                    $(this).val("0");
                }
            }
        });
    }
});
var curPrice=0;
function Init(){
    $("#txtPrice").val("0");
    $("#txtMinMPrice").val("0");
}

function ValidPrice(price){
    if( price > 4000 )
            artDialog({content:"对不起！只能发布4000元以下的商品。",id:"alarm",yesText:"返回修改",noText:"取消"},
            function(){Init();ToMao();},
            function(){},function(){Init();ToMao();});
    else if( price > curMoney && !tuoguantask ){
		artDialog({content:"对不起！您当前存款不足。",id:"alarm",yesText:"立即充值",noText:"返回修改"},
        function(){window.open("/member/topup/");},
        function(){},function(){Init();ToMao();});
    }
}
function ToMao(){
    $("html,body").animate({scrollTop: $("#mao1").offset().top}, 1000);
}
function ToMao2(){
    $("html,body").animate({scrollTop: $("#mao2").offset().top}, 1000);
}
function ValidDomainF(url){
    var isValid = false;
    for(i=0;i<validDomains.length;i++){
        if(url.indexOf(validDomains[i])==0){
            isValid=true;
            break;
        }
    }
    return isValid;
}
function countPoint() {
   var p=getFloat('txtMinMPrice');
   
   var minPrice=$("#txtMinMPrice").val();
   var okDay = getFloat('ddlOKDay');
   var addPrice=(minPrice*basePriceDouble + okDay - 1) - minPrice;
   
   if(okDay>0)p += addPrice;
   p += getFloat('pointExt');
   if (getObj('isSign').checked) { 
       if (getObj('Express_1').checked){
            p += 1.5;
		}	
        else if(getObj('Express_2').checked){
            p += 2;
		}	
		$("#cbxIsAddress").removeAttr("checked");
    }
   if (getObj('cbxIsAudit').checked) p += 0.3;
   if (getObj('cbxIsWW').checked) p += 1;
   if (getObj('cbxIsLHS').checked) p += 0.5;
   if (getObj('cbxIsMsg').checked) p += 0.1;
   if (getObj('cbxIsSB').checked) p += 0.3;
   if (getObj('cbxIsAddress').checked) p += 0.1;
   if (getObj('isShare').checked) p += 0.2;
   if (getObj('cbxIsFMinGrade').checked) p += 0.5;
   if (getObj('cbxIsFMaxBBC').checked) p += 0.5;
   if (getObj('cbxIsFMaxABC').checked) p += 0.5;
   if (getObj('cbxIsFMaxCredit').checked) p += 0.5;
   if (getObj('cbxIsFMaxBTSCount').checked) p += 0.5;
   if (getObj('ispinimage').checked) p += 0.2;
   if (getObj('cbxIsFMaxMCount').checked) { 
        if (getObj('fmaxmc_2').checked)
            p += 0.2;
		else if (getObj('fmaxmc_3').checked)
		    p += 1;
        else
            p += 0.5;
    }
   if (getObj('isReal').checked) p += 0.5;
   if (getObj('cbxIsTaoG').checked) p += 0.1;  
   if (getObj('isMultiple').checked) p += 0.5;
   if (getObj('isLimitCity').checked) p += 0.5;
   if(getObj('isPlan').checked) p += 0.1;
   p=p.toFixed(2);
   return p;
}
function getFloat(id) {
	var d = parseFloat(getValue(id));
	if (isNaN(d))
		return 0;
	else
		return d;
}
function addconfirm(){
	var point_count=countPoint();
	var price_count=getFloat('txtPrice');
	var okDay=parseInt($('#ddlOKDay').val());
	var txtSetTime=parseInt($('#txtSetTime').val());
	var txtdelaydate=$('#txtdelaydate').val();
	var txtdelayhh=parseInt($('#txtdelayhh').val());
	var txtdelaymm=parseInt($('#txtdelaymm').val());
	var pointExt = getFloat('pointExt');
	var s = '<div style="line-height:20px;width:280px;" class="addtice">';
	s += '<p>好评时限：';
	if (okDay == 0) s += '马上好评';
    if (okDay == 1) s += '24小时好评';
    if (okDay == 2) s += '48小时好评';
    if (okDay == 3) s += '72小时好评';
	if (okDay == 4) s += '96小时好评';
	if (okDay == 5) s += '120小时好评';
	if (okDay == 6) s += '144小时好评';
	if (okDay == 7) s += '168小时好评';
	s +='</p>';
    if (getObj('isPlan').checked) s += '<p>定时发布：'+txtdelaydate+'日'+txtdelayhh+'时'+txtdelayhh+'分时发布任务</p>';
	if (getObj('isawb').checked) s +='<p>快递单号费用：<em>3</em>元</p>';
	s += '<p>商品价格<em>'+ price_count +'</em>元　　消耗麦点<em>'+ point_count +'</em>个</p></div>';
	
	if(curG<point_count){
        artDialog({content:"对不起！您的麦点不够了，发布此次任务需要"+point_count+"个麦点，请充值购买麦点或者修改任务信息。",id:"alarm",fixed:true,lock:true,yesText:"立即购买麦点",noText:"返回修改"},
            function(){window.location.href="/member/BuyPoint/"},function(){},function(){ToMao();});
        $(".ui_close").hide();
    }
	
	artDialog({content:s,id:"alarm",title:"请确认任务信息",yesText:"立即发布",noText:"返回修改"},function(){$("#btnAdd").click();},function(){ToMao();});
}	
function setValue(b, a) {
	$('#'+b).val(a);
}
function getValue(a) {
	return $('#'+a).val();
}
function getRV(b) {
	var d = "";
	var a = $('#'+b);
	for (var c = 0; c < a.length; c++) {
		if (a[c].checked) {
			d = a[c].value
		}
	}
	return d
}
function BindFilterFun(){
    $("input:radio[name=fmingrade]").click(function(){
        if($(this).attr("checked")){
            $("#cbxIsFMinGrade").attr("checked",true);
        }
    });
    $("input:radio[name=fmaxbbc]").click(function(){
        if($(this).attr("checked")){
            $("#cbxIsFMaxBBC").attr("checked",true);
        }
    });
    $("input:radio[name=fmaxabc]").click(function(){
        if($(this).attr("checked")){
            $("#cbxIsFMaxABC").attr("checked",true);
        }
    });
    $("input:radio[name=fmaxcredit]").click(function(){
        if($(this).attr("checked")){
            $("#cbxIsFMaxCredit").attr("checked",true);
        }
    });
    $("input:radio[name=Express]").click(function(){
        if($(this).attr("checked")){
            $("#isSign").attr("checked",true);
			$("#isawb").attr("checked",false);
        }
    });
	$("input:radio[name=expressName]").click(function(){
        if($(this).attr("checked")){
            $("#isawb").attr("checked",true);
			$("#isSign").attr("checked",false);
        }
    });
	$("input:radio[name=fmaxbtsc]").click(function(){
        if($(this).attr("checked")){
            $("#cbxIsFMaxBTSCount").attr("checked",true);
        }
    });
    $("input:radio[name=fmaxmc]").click(function(){
        if($(this).attr("checked")){
            $("#cbxIsFMaxMCount").attr("checked",true);
        }
    });
	$("input:radio[name=realname]").click(function(){
        if($(this).attr("checked")){
            $("#isReal").attr("checked",true);
        }
    });
}