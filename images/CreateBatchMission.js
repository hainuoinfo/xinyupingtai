$(document).ready(function(){
	$("#pointExt").blur(function(){
			if (this.value<0){
			this.value=0;
				artDialog({content:"悬赏兔粮不能小于0。",id:"alarm"},function(){},null,function(){Init();ToMao();});
			}
		});
    if( curG < 1 ){
        artDialog({content:"对不起！您的兔粮不够了，发布任务最少需要1个兔粮，请充值购买兔粮或者接任务免费获得兔粮。",id:"alarm",fixed:true,lock:true,yesText:"立即购买兔粮",noText:"马上去接任务"},
            function(){window.location.href="/BuyPoint/"},function(){window.location.href="/task/tao/"});
        $(".ui_close").hide();
    }
    else{
        $("#txtMinMPrice").attr("readonly","readonly");
        $("#txtPrice").blur(function(){
            var curGoodsPrice = this.value;
            if( curGoodsPrice != ""){     
                if( !IsMoeny(curGoodsPrice))
                    artDialog({content:"对不起！输入的商品总价格式错误，请重新输入。",id:"alarm"},function(){},null,function(){Init();ToMao();});
                else
                    ValidPrice(parseFloat(curGoodsPrice));
            }
            else{
                Init();
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
		$("#ddlMissionType").change(function(){
        var mtype = parseInt(this.value);
        if(mtype==2||mtype==4){
            $(".fabu_box2 li.limeal").show();
        }else{
            $(".fabu_box2 li.limeal").hide();
        }
        
        var price=parseFloat($("#txtPrice").val());
        if( price == 0 ){
            Init();
        }else{
            ValidPrice(price);
        }
    });
        $("#btnCilentAdd").click(function(){
            szgIndex =  $("#ddlZGAccount").val();
            if(szgIndex==-1){
                artDialog({content:"对不起！请选择一个淘宝掌柜名。",id:"alarm"},function(){},null,function(){Init();ToMao();});
		        return false;
            }
			var mtype = parseInt($("#ddlMissionType").val());
            if(mtype==2||mtype==4){
                var des=$.trim($("#txtDes").val());
				if($("#rshop").is(':checked'))
			  {
			  destype='店铺';
			  }else{ 
			  destype='商品';
			  }
                if(des==""){
                    artDialog({content:"对不起！请输入"+destype+"说明。",id:"alarm"},function(){ToMao();});
		            return false;
                }
                var searchDes=$.trim($("#txtSearchDes").val());
                if(searchDes==""){
                    artDialog({content:"对不起！请输入"+destype+"搜索说明。",id:"alarm"},function(){ToMao();});
		            return false;
                }else{
                    if(searchDes.length>100){
                        artDialog({content:"对不起！"+destype+"搜索说明不能超过100个字符。",id:"alarm"},function(){ToMao();});
		                return false;
                    }
                }
            }
            var goodsPrice=$("#txtPrice").val();
            if(!IsMoeny(goodsPrice) || goodsPrice<=0){
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
	        if($("#isTpl").is(':checked')){
				if($("#tplTo").val().length<1){
		            artDialog({content:"对不起！请输入创建的任务模版名称",id:"alarm"},function(){},null,function(){$("#tplTo").focus();});
		            return false;
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
	        var fCount = $.trim($("#txtFCount").val());
			fCount=parseInt(fCount);
			if(isNaN(fCount) || fCount< 2 || fCount> 20 ){
				artDialog({content:"对不起！发布数量必须为正整数，范围在2-99之间。",id:"alarm"},function(){$("#txtFCount").focus();});
				return false;
			}
			
			var second=$("#txtFTime").val()
			second=parseInt(second);
			if(isNaN(second) || second< 30){
				artDialog({content:"对不起！发布间隔必须为正整数，不小于30秒。",id:"alarm"},function(){});
				return false;
			}
	        var goodsUrl=$("#txtGoodsUrl").val();
	        var validGoodsUrl=goodsUrl.toLowerCase();
	        if(!IsURL(validGoodsUrl)|| !ValidDomainF(validGoodsUrl)){
		        artDialog({content:"对不起，您还未输入商品URL地址或者地址有错误。（特别注意：此地址为您店铺需要买方拍的商品地址，而非淘宝店地址）",id:"alarm",yesText:"确定",noText:"查看URL地址帮助"},function(){ToMao();},function(){window.open("http://www.damaihu.com.cn/bbs/t1288/");});
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
					} else if (result=='2'){
                           artDialog({content:"对不起！您提交的参数错误，请重选选择后提交。",id:"alarm"},function(){ToMao();});
					} else if (result=='3'){
                            artDialog({content:"对不起！您选择的淘宝掌柜名有误。",id:"alarm"},function(){ToMao();});
					} else if (result=='11'){
                            artDialog({content:"对不起！您输入的商品url地址对应的掌柜名与您在本平台选择的掌柜名不一致。请注意核对掌柜名是否正确（大小写以及繁体请注意区分），如有错误，请联系在线客服进行解决。",id:"alarm"},function(){ToMao();});
					} else if (result=='12'){
                            artDialog({content:"对不起！您输入的商品url地址无法读取。",id:"alarm"},function(){ToMao();});
	                } else if (result=='13'){
                            artDialog({content:"禁止发布此商品链接~~",id:"alarm"},function(){ToMao();});
	                } else {
						 artDialog({content:"系统错误",id:"alarm"},function(){ToMao();});
						}
                });
                return false;
            }
        }).css("cursor","pointer");
        $("#divtype>input:radio").click(function(){
	     changetype($(this).attr("id"));
       });

		function changetype(radioid){
			if(radioid=="rshop"){
				$("#divkey").html("搜索店铺关键字");
				$("#divkeytip").html("请输入您的“店铺名称”或者“掌柜名称”，要确保接手人在淘宝店铺搜索中正确并且唯一能搜索到您的店铺。");
				$("#divdes").html("店铺搜索提示");
				$("#divdestip").html("请输入提示信息，说明店铺在淘宝搜索结果列表中的位置，商品在店铺首页中的大概位置等等，例如：店铺在搜索结果第二个，商品在店铺首页第二排第一个");
			}else{
				$("#divkey").html("搜索商品关键字");
				$("#divkeytip").html("请输入能够在淘宝搜索中搜索到您商品的关键字，平台推荐使用商品全名，如果您商品在淘宝中重名过多，建议先修改商品名或者使用搜店铺的方式设置来路");
				$("#divdes").html("商品搜索提示");
				$("#divdestip").html("请输入搜索提示信息，说明商品在淘宝搜索结果列表中的位置，例如：搜索结果第一页第三个。");
			}
		}
		 
       $("#ddlOKDay").change(function(){
            var okDay=parseInt(this.value);
            if( okDay==0 )
                $("#pOKDes").html("");
            else{
                var minPrice=$("#txtMinMPrice").val();
                var addPrice=(minPrice*basePriceDouble + okDay - 1) - minPrice;
                $("#pOKDes").html("额外支出兔粮<em>"+addPrice+"</em>个");
            }
        });
        
        $("#isLimitCity,#isMultiple").click(function(){
		if(isVip===false){
		    $("#isLimitCity").removeAttr("checked");
			$("#isMultiple").removeAttr("checked");
			artDialog({content:"目前限制接手人IP功能仅针对花兔兔VIP开放！",id:"alarm",yesText:"加入VIP",noText:"返回修改"},
        function(){window.open("/BuyPoint/");},
        function(){},function(){Init();});
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
					if (getObj('isSign').checked){
					this.checked=false;
					artDialog({content:"对不起，真实签收任务与规定收货地址不能同时选择",id:"alarm"},function(){});
					}
					$("#cbxTip").show();
				}else{
					$("#cbxTip").hide();
				}
			
        });
		$("#isSign").click(function(){
                if($(this).attr("checked")){
					if (getObj('cbxIsAddress').checked){
					this.checked=false;
					artDialog({content:"对不起，真实签收任务与规定收货地址不能同时选择",id:"alarm"},function(){});
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
         $("#isProvince").click(function(){
				 if(this.checked){
				     if($("#isProvince").attr("cid")==0){
					    this.checked=false;	 
						artDialog({content:"您未设置同省签收的发货省份，请先在【会员中心】->【资料密码】中设置",id:"alarm"},function(){});
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
    else if( price > curMoney ){
		artDialog({content:"对不起！您当前存款不足。",id:"alarm",yesText:"立即充值",noText:"返回修改"},
        function(){window.open("/user/topup/");},
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
   var ddlMissionType =$("#ddlMissionType").val();
   var addPrice=(minPrice*basePriceDouble + okDay - 1) - minPrice;
   if(okDay>0)p += addPrice;
   p += getFloat('pointExt');
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
   if (getObj('cbxIsFMaxMCount').checked) { 
        if (getObj('fmaxmc_2').checked)
            p += 0.2;
		else if (getObj('fmaxmc_3').checked)
		    p += 1;
        else
            p += 0.5;
    }
    if (getObj('isSign').checked) { 
	    if (getObj('Express_1').checked){
            p += 1.5;
		}	
        else if(getObj('Express_2').checked){
            p += 2;
		}
    }
   if (getObj('pinimage').checked) p += 0.2;
   if (getObj('isReal').checked) p += 0.5;
   if (getObj('cbxIsTaoG').checked) p += 0.1;  
   if (getObj('isMultiple').checked) p += 0.5;
   if (getObj('isLimitCity').checked) p += 0.5;
   if(ddlMissionType==2) p += 0.5;
   if(ddlMissionType==3) p += 4;
   if(ddlMissionType==4) p += 4.5;
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
	var point_count=countPoint()*parseInt($('#txtFCount').val());
	var price_count=getFloat('txtPrice');
	var okDay=parseInt($('#ddlOKDay').val());
	var txtFCount=parseInt($('#txtFCount').val());
	var txtFTime=parseInt($('#txtFTime').val());
	var ddlMissionType =$("#ddlMissionType").val();
	var pointExt = getFloat('pointExt');
	var visitWay=parseInt($("input[name='visitWay']:checked").val());
	var s = '<div style="line-height:20px;width:280px;" class="addtice">';
	if (ddlMissionType==1) s +='<p>任务类型:单商品任务</p>';
	if (ddlMissionType==2) s +='<p>任务类型:来路任务</p>'
	if (ddlMissionType==3) s +='<p>任务类型:普通套餐任务</p>';
	if (ddlMissionType==4) s +='<p>任务类型:来路套餐任务</p>'
	if (visitWay==1 && (ddlMissionType==2 || ddlMissionType==4)) s +='<p>来路任务方式:搜索商铺</p>';
	if (visitWay==2 && (ddlMissionType==2 || ddlMissionType==4)) s +='<p>来路任务方式:搜索商品</p>';
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
	s += '<p>发布数量：'+txtFCount+'个</p>';
    s += '<p>发布间隔：'+txtFTime+'秒</p>';
	s += '<p>商品价格<em>'+ (price_count*txtFCount).toFixed(2) +'</em>元　　消耗兔粮<em>'+ point_count +'</em>个</p></div>';
	if(curG<point_count){
        artDialog({content:"对不起！您的兔粮不够了，发布此次任务需要"+point_count+"个兔粮，请充值购买兔粮或者修改任务信息。",id:"alarm",fixed:true,lock:true,yesText:"立即购买兔粮",noText:"返回修改"},
            function(){window.location.href="/BuyPoint/"},function(){},function(){ToMao();});
        $(".ui_close").hide();
    }
	if(pointExt>10 &&  price_count < 2000){
	    artDialog({content:"对不起！金额小于2000,追加悬赏兔粮不能超过10个兔粮。",id:"alarm",fixed:true,lock:true,noText:"返回修改"},
            function(){},function(){ToMao();});
        $(".ui_close").hide();
	}else if (pointExt>20 && price_count >= 2000){
		artDialog({content:"对不起！金额大于2000,追加悬赏兔粮不能超过20个兔粮。",id:"alarm",fixed:true,lock:true,noText:"返回修改"},
            function(){},function(){ToMao();});
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