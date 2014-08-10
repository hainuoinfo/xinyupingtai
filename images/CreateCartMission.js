$(document).ready(function(){
	$("#pointExt").blur(function(){
			if (this.value<0){
			this.value=0;
				artDialog({content:"悬赏麦点不能小于0。",id:"alarm"},function(){},null,function(){Init();ToMao();});
			}
		});
    if(curG<2){
        artDialog({content:"对不起！您的麦点不够了，发布购物车任务最少需要2个麦点，请充值购买麦点或者接任务免费获得麦点。",id:"alarm",fixed:true,lock:true,yesText:"立即购买麦点",noText:"马上去接任务"},
            function(){window.location.href="/member/BuyPoint/"},function(){window.location.href="/task/tao/"});
        $(".ui_close").hide();
    }else{
        $("#txtMinMPrice").attr("readonly","readonly");
        $("li.ligoods input:text[name=txturl]").each(function(){
            var $li = $(this).parents(".ligoods");
            if($(this).val()==""){
                $(this).val("http://");
            }else{
                $li.data("url",$(this).val());
                $li.data("price",$(this).attr("price"));
                $li.data("gtitle",$(this).attr("gtitle"));
                $li.data("hptext",$(this).attr("hptext"));
                $li.data("urlok","1");
                $li.data("priceok","1");
                $li.data("minprice",$(this).attr("minprice"));
            }
        });
        $("li.ligoods a[name=addli]").hide();
        $("li.ligoods:gt(1) a[name=delli]").show();
        var lisize = $("li.ligoods").size();
        if(lisize==2){
            $("li.ligoods:last a[name=addli]").show();
            $("li.ligoods:last a[name=delli]").hide();
        }else if(lisize==6){
            $("li.ligoods:last a[name=addli]").hide();
            $("li.ligoods:last a[name=delli]").show();
        }else{
            $("li.ligoods:last a[name=addli]").show();
            $("li.ligoods:last a[name=delli]").show();
        }
        
        calcAddedExpend();
        
        $("li.ligoods a[name=addli]").click(function(){
            var $newli = $("li.ligoods:eq(1)").clone(true);
            $newli.find("div.vc").hide();
            $newli.find("div.nyy02").removeClass().addClass("nyy01");
            $newli.find("input:text[name=txturl]").val("http://");
            $newli.find("input:text[name=txtprice]").val("0");
            $newli.find("input:text[name=txtgtitle]").val("");
            $newli.find("textarea[name=txthptext]").val("");
            $newli.find("input:checkbox[name=cbhp]").removeAttr("checked");
            $newli.removeData("url");
            $newli.removeData("price");
            $newli.removeData("gtitle");
            $newli.removeData("hptext");
            $newli.removeData("urlok");
            $newli.removeData("priceok");
            $newli.removeData("minprice");
            $newli.insertAfter($("li.ligoods:last"));
            $(this).hide();
            var lisize = $("li.ligoods").size();
            $("li.ligoods:last>div[name=url]").html("商品链接地址" + lisize + "：");
            $("li.ligoods:last a[name=delli]").show();
            if(lisize==6){
                $("li.ligoods:last a[name=addli]").hide();
            }else{
                $("li.ligoods:last a[name=addli]").show();
            }
        });
        $("li.ligoods a[name=delli]").click(function(){
            $(this).parents(".ligoods").remove();
            var lisize = $("li.ligoods").size();
            $("li.ligoods:last a[name=addli]").show();
            if(lisize==2){
                $("li.ligoods:last a[name=delli]").hide();
            }else{
                $("li.ligoods:last a[name=delli]").show();
            }
            calcPrice(null);
        });
        var szgIndex = $("#ddlZGAccount").val();
        $("li.ligoods input:text[name=txturl]").blur(function(){
            var $li = $(this).parents(".ligoods");
            var $msg = $li.find("div.vc");
            var goodsUrl=$(this).val();
            szgIndex = $("#ddlZGAccount").val();
            if(szgIndex==-1){
                alert("请先选择一个掌柜名");
                clear();
                return false;
            }
            if($li.data("url")!=null && $li.data("url")==goodsUrl){
                return false;
            }
            $li.data("url",goodsUrl);
            if(!goodsUrl){
                $msg.html("<img src=\"/images/false.gif\" /><span>对不起！您还未输入商品url地址或者地址有错误。注意：此地址为您的商品地址非淘宝店地址</span>").show();
                $li.data("urlok","0");
                return false;
            }else{
                var validGoodsUrl=goodsUrl.toLowerCase();
                if( !ValidDomainF(validGoodsUrl) || validGoodsUrl.indexOf("meal")>0){
                    $msg.html("<img src=\"/images/false.gif\" /><span>对不起！购物车中的每个商品必须是一个单独的淘宝商品！</span>").show();
                    $li.data("urlok","0");
                    return false;
                }else{
                    var samecount = 0;
                    $("li.ligoods").each(function(){
                        var url = $(this).data("url");
                        if(url!=null&&url!=""){
                            if(goodsUrl==url){
                                samecount+=1;
                            }
                        }
                    });
                    if(samecount>1){
                        $msg.html("<img src=\"/images/false.gif\" /><span>对不起！您输入的商品url地址有错误。注意：Url地址不能重复</span>").show();
                        $li.data("urlok","0");
                        return false;
                    }
                    $msg.html("<img src=\"/images/wen.gif\" /><span>正在验证您输入的商品url地址，请稍候...</span>").show();
                    $("#btnCilentAdd").attr("disabled",true);
                    $.post("/ajax/checkshop.php",{"seller":szgIndex,"goodsUrl":goodsUrl}, function(result){
                        $("#btnCilentAdd").removeAttr("disabled");
                        if(result=='0'){
	                        $("#txtGoodsUrl").val(goodsUrl.replace("&#",""));
							    $msg.html("<img src=\"/images/true.gif\" /><span>商品Url地址填写正确.</span>");
                                $li.find("input:text[name=txturl]").val(goodsUrl.replace("&#",""));
                                $li.data("url",goodsUrl);
                                $li.data("urlok","1");
							} else if (result=='2'){
								    $msg.html("<img src=\"/images/false.gif\" /><span>对不起！您输入的商品url地址无法读取。</span>");
                                    $li.data("urlok","0");
							} else if (result=='3'){
									$msg.html("<img src=\"/images/false.gif\" /><span>对不起！您输入的商品url地址对应的掌柜名与您在本平台绑定的掌柜名不一致。</span>");
                                    $li.data("urlok","0");
							} else if (result=='11'){
									$msg.html("<img src=\"/images/false.gif\" /><span>对不起！您输入的商品url地址对应的掌柜名与您在本平台绑定的掌柜名不一致。</span>");
                                    $li.data("urlok","0");
							} else if (result=='12'){
									$msg.html("<img src=\"/images/false.gif\" /><span>对不起！您输入的商品url地址无法读取。</span>");
                                    $li.data("urlok","0");
							}	else if (result=='13'){
									$msg.html("<img src=\"/images/false.gif\" /><span>禁止发布此商品链接~~</span>");
                                    $li.data("urlok","0");
							}
					});   
                }
            }
        });
        function clear(){
            $("li.ligoods").each(function(){
                $(this).find("div.vc").hide();
                $(this).find("div.nyy02").removeClass().addClass("nyy01");
                $(this).find("input:text[name=txturl]").val("http://");
                $(this).find("input:text[name=txtprice]").val("0");
                $(this).find("input:text[name=txtgtitle]").val("");
                $(this).find("textarea[name=txthptext]").val("");
                $(this).find("input:checkbox[name=cbhp]").removeAttr("checked");
                $(this).removeData("url");
                $(this).removeData("price");
                $(this).removeData("gtitle");
                $(this).removeData("hptext");
                $(this).removeData("urlok");
                $(this).removeData("priceok");
                $(this).removeData("minprice");
            });
            $("#hPrice").val("0");
            $("#txtMinMPrice").val("0");
            calcAddedExpend();
        }
        $("#ddlZGAccount").change(function(){
            szgIndex = $(this).find("option[selected]").val();
            clear();
        });
        $("li.ligoods input:text[name=txtprice]").blur(function(){
            var $li = $(this).parents(".ligoods");
            var $msg = $li.find("div.vc");
            var curGoodsPrice = $(this).val();
            if(curGoodsPrice != ""){     
                if(curGoodsPrice <= 0 ){
                    $msg.html("<img src=\"/images/false.gif\" /><span>对不起！您输入的商品担保价格有误。商品担保价格必需大于0！</span>").show();
                    $li.data("priceok","0");
                    $li.data("price","0");
                    $li.data("minprice","0");
                    $(this).val("0");
                }else{
                    ValidPrice($li,parseFloat(curGoodsPrice));
                }
            }else{
                $li.data("priceok","0");
                $li.data("price","0");
                $li.data("minprice","0");
                $(this).val("0");
            }
        });
        $("li.ligoods input:checkbox[name=cbhp]").click(function(){
            if($(this).attr("checked")){
                $(this).parent().next().next().removeClass().addClass("nyy02");
            }else{
                $(this).parent().next().next().removeClass().addClass("nyy01");
            }
        });
        $("#btnCilentAdd").click(function(){
            szgIndex = $("#ddlZGAccount").val();
            if(szgIndex==-1){
                artDialog({content:"对不起！请选择一个淘宝掌柜名",id:"alarm"},function(){},null,function(){ToMao();});
		        return false;
            }
            var fillcount = 0;
            $("li.ligoods").each(function(){
                if($(this).data("url")!=null && $(this).data("url")!=""){
                    fillcount+=1;
                }
            });
            if(fillcount<2){
                artDialog({content:"对不起！请至少填写两个商品地址。如果只有一个商品地址请使用单个商品任务发布",id:"alarm"},function(){},null,function(){ToMao();});
                return false;
            }
            var allurlok=true;
            $("li.ligoods").each(function(){
	            var $urlok = $(this).data("urlok");
	            if($urlok==null || $urlok=="0"){
	                artDialog({content:"对不起！请确保每一个商品链接地址都填写正确。如果不需要，该商品地址可删除！",id:"alarm"},function(){},null,function(){ToMao();});
	                allurlok=false;
	                return false;
	            }
	        });
			if($("#isTpl").is(':checked')){
				if($("#tplTo").val().length<1){
		            artDialog({content:"对不起！请输入创建的任务模版名称",id:"alarm"},function(){},null,function(){$("#tplTo").focus();});
		            return false;
	            }
	        }
	        if(!allurlok){return false;}
            var allpriceok=true;
            var allprice = 0;
            var isqm = false;
            $("li.ligoods").each(function(){
	            var $priceok = $(this).data("priceok");
	            if($priceok==null || $priceok=="0"){
	                artDialog({content:"对不起！请确保每一个商品担保价格都填写正确。如果不需要，该商品地址可删除！",id:"alarm"},function(){},null,function(){ToMao();});
	                allpriceok=false;
	                return false;
	            }else{
	                if($(this).data("price")!=null){
                        allprice+=parseFloat($(this).data("price"));
                    }
                    if(allprice>curMoney){
                        artDialog({content:"对不起！您当前保证金不足。",id:"alarm",yesText:"立即充值",noText:"返回修改"},
                        function(){window.open("/user/topup/");},
                        function(){},function(){ToMao();});
                        isqm=true;
                    }
	            }
	        });
	        if(!allpriceok||isqm){return false;}
	        var allhpok=true;
            $("li.ligoods").each(function(){
	            if($(this).find("input:checkbox[name=cbhp]").attr("checked")){
	                var gtitle = $(this).find("input:text[name=txtgtitle]").val();
	                var hptext = $(this).find("textarea[name=txthptext]").val();
	                if(gtitle!="" && hptext!=""){
	                    if(hptext.length>200){
	                        artDialog({content:"对不起！给接手人的规定好评内容请保持在200个字符以内。",id:"alarm"},function(){ToMao();});
	                        allhpok=false;
	                        return false;
                        }
	                    $(this).data("gtitle",gtitle);
	                    $(this).data("hptext",hptext);
	                }else{
	                    artDialog({content:"对不起！如果您选择了规定好评内容选项，请填写好评内容和商品名称！",id:"alarm"},function(){},null,function(){ToMao();});
	                    allhpok=false;
	                    return false;
	                }
	            }else{
	                $(this).data("gtitle","");
	                $(this).data("hptext","");
	            }
	        });
	        if(!allhpok){return false;}
	        
	        if($("#cbxIsTip").attr("Checked")){
	            var buycount=$.trim($("#txtBuyCount").val());
	            if(buycount!=""){
	                buycount=parseInt(buycount);
                    if(isNaN(buycount) || buycount<1 || buycount>999){
	                    artDialog({content:"对不起！商品购买数量有效值为1到999之间的正整数。",id:"alarm"},function(){$("#txtBuyCount").focus();});
	                    return false;
                    }
	            }
	        }
	        $("#isProvince").click(function(){
				 if(this.checked){
				     if($("#isProvince").attr("cid")==0){
					    this.checked=false;	 
						artDialog({content:"您未设置同省签收的发货省份，请先在【会员中心】->【资料密码】中设置",id:"alarm"},function(){});
					 }	 
				 }		   
		    });
			if($("#cbxIsTaoG").attr("checked")){
                var taoG=$.trim($("#txtTaoG").val());
	            taoG=parseInt(taoG);
	            if(isNaN(taoG) || taoG<=0 || taoG>300 || taoG%10!=0){
		            artDialog({content:"对不起，请输入正确的淘金币。淘金币为0到300之间的整数，且为10的倍数。",id:"alarm"},function(){});
		            return false;
	            }
            }
	        if($("#cbxIsSetTime1").attr("Checked")){
	            var minute=$("#txtSetTime").val()
	            minute=parseInt(minute);
	            if(isNaN(minute) || minute<0 ){
		            artDialog({content:"对不起！请输入正整数的延迟分钟数。",id:"alarm"},function(){});
		            return false;
	            }
	        }
	        
	        var urls = "";
            var prices = "";
            var gtitles = "";
            var hptexts = "";
            var pricecount = 0;
            var chssp = "";
			var cbhp = "";
            $("li.ligoods").each(function(){
                var url = $(this).data("url");
                var price = $(this).data("price");
                var gtitle = $(this).data("gtitle");
                var hptext = $(this).data("hptext");
				if($(this).find("input:checkbox[name=cbhp]").attr("checked")){
				  cbhp+='1*;;;*';   
				}
				if($(this).find("input:checkbox[name=chssp]").attr("checked")){
				  chssp+='1*;;;*';   
				}
                urls+=url + "*;;;*";
                prices+=price + "*;;;*";
                gtitles+=gtitle + "*;;;*";
                hptexts+=hptext + "*;;;*";
                pricecount+=parseFloat(price);
            });
            $("#itemurl").val(urls.replace("&#",""));
            $("#c_price").val(prices);
            $("#c_title").val(gtitles);
            $("#c_texts").val(hptexts);
            $("#price").val(pricecount);
			$("#c_cbhp").val(cbhp);
			$("#c_chssp").val(chssp);
			addconfirm();
        }).css("cursor","pointer");
        
       $("#ddlOKDay").change(function(){
            var okDay=parseInt(this.value);
            if(okDay==0)
                $("#pOKDes").html("");
            else{
                var minPrice=$("#txtMinMPrice").val();
                var addPrice=(parseFloat(minPrice)*basePriceDouble + okDay - 1) - parseFloat(minPrice);
                $("#pOKDes").html("额外支出麦点<em>"+addPrice+"</em>个");
            }
        });
		$("#isLimitCity,#isMultiple").click(function(){
		if(isVip===false){
		    $("#isLimitCity").removeAttr("checked");
			$("#isMultiple").removeAttr("checked");
			artDialog({content:"目前限制接手人IP功能仅针对花兔兔VIP开放！",id:"alarm",yesText:"加入VIP",noText:"返回修改"},
        function(){window.open("/member/BuyPoint/");},
        function(){},function(){Init();});
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
        $("#cbxIsAudit").click(function(){
            if(this.checked){
                if( $("#cbxIsSetTime1").attr("checked") || $("#cbxIsSetTime2").attr("checked")){
                    this.checked = false;
                    artDialog({content:"设置任务延迟发布后，不论您是否在线您的任务都将在大厅显示，系统自动取消审核",id:"alarm"},function(){});
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

function ValidPrice($li,price){
	var curPrice = 0;
	var lisize = $("li.ligoods").size();
    if($li.data("price")!=null){
        curPrice = $li.data("price");
    }
    if( price > curMoney )
	{
        artDialog({content:"对不起！您当前存款不足。",id:"alarm",yesText:"立即充值",noText:"返回修改"},
        function(){window.open("/member/topup/");},
        function(){},function(){ToMao();});
    }else{
        if( price != curPrice){
            $li.find("div.vc").html("<img src=\"/images/true.gif\" />商品担保价格填写正确");
            $li.data("price",price);
            $li.data("priceok","1");
            minprice=getminprice(price);
			$li.data("minprice",minprice);
			calcPrice($li);
           
        }
    }
}

function calcPrice($li){
    var allprice = 0;
    var allminprice = 0;
    $("li.ligoods").each(function(){
        if($(this).data("price")!=null){
            allprice+=parseFloat($(this).data("price"))
        }
		if($(this).data("minprice")!=null){
            allminprice+=parseFloat($(this).data("minprice"));
        }
        $("#hPrice").val(allprice);
        $("#txtMinMPrice").val(allminprice);
        calcAddedExpend();
        if($li!=null){
            if(allprice>curMoney){
                $li.data("priceok","0");
                artDialog({content:"对不起！您当前存款不足。",id:"alarm",yesText:"立即充值",noText:"返回修改"},
                    function(){window.open("/member/topup/");},
            function(){},function(){});
            }
        }
        $li.data("priceok","1");
    });
}

function getFloat(id) {
	var d = parseFloat(getValue(id));
	if (isNaN(d))
		return 0;
	else
		return d;
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
function calcAddedExpend(){
    //var okDay=parseInt($("#ddlOKDay>option[selected]").val());
    var okDay=parseInt($("#ddlOKDay").val());
    if(okDay==0)
        $("#pOKDes").html("");
    else{
        var minPrice=$("#txtMinMPrice").val();
        var addPrice=(parseFloat(minPrice)*basePriceDouble + okDay - 1) - parseFloat(minPrice);
        $("#pOKDes").html("额外支出麦点<em>"+addPrice+"</em>个");
    }
}

function ToMao(){
    $("html,body").animate({scrollTop: $("#mao1").offset().top}, 1000);
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
function getminprice(goodsprice){
	    if (goodsprice <= 40)
		    return 1;
		if (goodsprice > 40 && goodsprice <= 80)
			return 1.5;
		if (goodsprice > 80 && goodsprice <= 120)
			return 2;
		if (goodsprice > 120 && goodsprice <= 200)
			return 3;
		if (goodsprice > 200 && goodsprice <= 500)
			return 4;
		if (goodsprice > 500 && goodsprice <= 1000)
			return 5;
		if (goodsprice > 1000 && goodsprice <= 1500)
			return 6;
		if (this.value > 1500)
		    return 7;
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
}

function addconfirm(){
	var price_count=getFloat('price');
	var point_count=countPoint();
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
	if(price_count<1 || point_count<1){
		artDialog({content:"对不起！发布失败，商品价格或者消耗麦点不得低于1",id:"alarm",fixed:true,lock:true,yesText:"返回修改"},function(){ToMao();});
		return false;
		}
	if(curG<point_count){
        artDialog({content:"对不起！您的麦点不够了，发布此次任务需要"+point_count+"个麦点，请充值购买麦点或者修改任务信息。",id:"alarm",fixed:true,lock:true,yesText:"立即购买麦点",noText:"返回修改"},
            function(){window.location.href="/BuyPoint/"},function(){},function(){ToMao();});
        $(".ui_close").hide();
    }
	if(pointExt>10 &&  price_count < 2000 ){
	    artDialog({content:"对不起！金额小于2000,追加悬赏麦点不能超过10个麦点。",id:"alarm",fixed:true,lock:true,noText:"返回修改"},
            function(){},function(){ToMao();});
        $(".ui_close").hide();
	}else if (pointExt>20 && price_count >= 2000){
		artDialog({content:"对不起！金额大于2000,追加悬赏麦点不能超过20个麦点。",id:"alarm",fixed:true,lock:true,noText:"返回修改"},
            function(){},function(){ToMao();});
        $(".ui_close").hide();
	}
	artDialog({content:s,id:"alarm",title:"请确认任务信息",yesText:"立即发布",noText:"返回修改"},function(){$("#btnAdd").click();},function(){ToMao();});
}
function countPoint() {
   var p=getFloat('txtMinMPrice');
   var minPrice=$("#txtMinMPrice").val();
   var okDay = getFloat('ddlOKDay');
   var addPrice=(minPrice*basePriceDouble + okDay - 1) - minPrice;
   if(okDay>0)p += addPrice;
   p += getFloat('pointExt');
   if (getObj('cbxIsAudit').checked) p += 0.3;
   if (getObj('cbxIsWW').checked) p += 1;
   if (getObj('cbxIsLHS').checked) p += 0.5;
   if (getObj('cbxIsSB').checked) p += 0.3;
   if (getObj('cbxIsAddress').checked) p += 0.1;
   if (getObj('isShare').checked) p += 0.2;
   if (getObj('cbxIsFMinGrade').checked) p += 0.2;
   if (getObj('cbxIsFMaxBBC').checked) p += 0.2;
   if (getObj('cbxIsFMaxABC').checked) p += 0.2;
   if (getObj('cbxIsFMaxCredit').checked) p += 0.2;
   if (getObj('cbxIsFMaxBTSCount').checked) p += 0.2;
   if (getObj('ispinimage').checked) p += 0.2;
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
   if (getObj('isReal').checked) p += 0.5;
   if (getObj('cbxIsTaoG').checked) p += 0.1;   
   if (getObj('isMultiple').checked) p += 0.5;
   if (getObj('isLimitCity').checked) p += 0.5;
   if(getObj('isPlan').checked) p += 0.1;
   p=p.toFixed(2);
   return p;
}