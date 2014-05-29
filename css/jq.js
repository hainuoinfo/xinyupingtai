$(function(){
		$(".left_alert").css("display","none");//IE6
		//发布任务效果
		$(".left_tit .renwu1").hover(function(){
			$(this).css("background-position","-64px -335px");
			$(".left_alert").css("display","block");
		});
		
		$(".left_tit:not(.left_alert,renwu1)").mouseleave(function(){
			$(".left_tit .renwu1").css("background-position","-68px -387px");
			$(".left_alert").css("display","none")
		});
		
		
		
		//任务奖励效果
		$(".left_tit2").hover(function(){
			$(".renwu2").css("background-position","-64px -445px");
			
		},function(){
			$(".renwu2").css("background-position","-69px -498px");
			
		})
		
		//遍历图标
		$(".left_main ul li:parent:not('#dilei')").each(function(i){
			
		   if(i == 0){
				num = 4;
		   }else{
				num = i*(-44);
		   }
		   if(i == 6){
			num = -262;
		   }
		   $(this).children("a:first").css("background-position","0px "+num+"px");
		});
		
		//遍历文字图标
		$(".left_main ul li:parent:not('#dilei')").each(function(i){
			
		   if(i == 0){
				num = 4;
		   }else{
				num = i*(-40);
		   }
		   $(this).children("a:eq(1)").css("background-position","-355px "+num+"px");
		   $(this).children("a:eq(1)").attr("num",num);
		});
		
		//遍历链接显示下划线
		$(".left_main ul li:parent:not('#dilei')").hover(function(i){
		
			num = $(this).children("a:eq(1)").attr("num");
			
			$(this).children("a:eq(1)").css("background-position","-489px "+ num +"px");
			$(this).append("<i><img src='/images/hyzx/dadian.png' /></i>");
		},function(){
		
			$(this).children("a:eq(1)").css("background-position","-355px "+ num +"px");
			$(this).children("i").remove();
		});
		
		$("#dilei").hover(function(i){
			$(this).children("a:eq(1)").css("background-position","-139px -232px");
			$(this).append("<i><img src='/images/hyzx/dadian.png' /></i>");
		},function(){
		
			$(this).children("a:eq(1)").css("background-position","0px -232px");
			$(this).children("i").remove();
		});
		//任务个数 
		i = $(".renwu_icon span").text();
		if(i > 9){
			$(".renwu_icon").css({ width: "22px", background: "url('/images/hyzx/icon1.png') repeat scroll -297px -231px transparent" });
			$(".right_gr_top").css("background","#0077D3");
		}else if(i <= 0){
			$(".renwu_icon").hide();
			$('.right_gr .rw').removeAttr('href');
		}
		//申诉个数
		u = $(".shensu_icon span").text();
		if(u > 9){
			$(".shensu_icon").css({ width: "22px", background: "url('/images/hyzx/icon1.png') repeat scroll -297px -231px transparent" });
			$(".right_gr_bottom").css("background","#0077D3");
		}else if(u <= 0){
			$(".shensu_icon").hide();
			
		}
		
		//进度条指数
		var pro_1 = $('.progress .jindutiao i:eq(0)').text();
		var pro_2 = $('.progress .jindutiao i:eq(1)').text();
		prog_num = (pro_1/pro_2)*100 +"%";
		$('.progress .jindutiao b').width(prog_num);
		
		//如果超过70%
		if((pro_1/pro_2)*100 > 70){
			jdcont = $('.progress .jindutiao span').html();
			
			$('.progress .jindutiao b').html("<span style='float:right;'>"+ jdcont +"</span>");
			$('.progress .jindutiao span:last').remove();
		}
		$('.progress .jindutiao span').click(function(){
			 window.location.href="/member/vipinfo/";
		});
		
		//仅测试0.1----根据页面固定当前链接样式
		//var yelink = 'aaa';
		//if(yelink == 'aaa'){
			//$(".left_main ul li:eq(0) a:eq(1)").css("background-position","-625px 4px");
		//}
		
		//根据 type值判断是否已使用
		$(".center_gr .tweer").each(function(i){
			type = $(this).attr("type");
			if(type == 1){
				
				var bgPosition = $(this).children("a").children("#icotwe").css('background-position');
				if(typeof(bgPosition) == 'undefined') {
				
					$(this).children("a").children("#icotwe").css('background-positionY','-105px');
				}else{
					x = bgPosition.split(" ")[0] + " -105px";
					$(this).children("a").children("#icotwe").css('background-position',x);
				}
				
				$(this).children("span").text("已完成");
				//name
				$(this).children(".tweer_f1").css('background-position','-202px -552px');
				$(this).children(".tweer_f2").css('background-position','-202px -593px');
				$(this).children(".tweer_f3").css('background-position','-195px -634px');
			}
		})
		
		//鼠标焦点切换事件
		$(".tweer a").hover(function(){
			type = $(this).parent().attr("type");
			if(type == 0){
				var bgPosition = $(this).children("#icotwe").css('background-position');
				
				if(typeof(bgPosition) == 'undefined') {
				
					$(this).children("#icotwe").css('background-positionY','-105px');
				}else{
					x = bgPosition.split(" ")[0] + " -105px";
					$(this).children("#icotwe").css('background-position',x);
				}
				//name
				$(this).next(".tweer_f1").css('background-position','-202px -552px');
				$(this).next(".tweer_f2").css('background-position','-202px -593px');
				$(this).next(".tweer_f3").css('background-position','-195px -634px');
			}
		});
		
		$(".tweer a").mouseleave(function(){
			type = $(this).parent().attr("type");
			if(type == 0){
				var bgPosition = $(this).children("#icotwe").css('background-position');
				
				if(typeof(bgPosition) == 'undefined') {
				
					$(this).children("#icotwe").css('background-positionY','-178px');
				}else{
					x = bgPosition.split(" ")[0] + " -178px";
					$(this).children("#icotwe").css('background-position',x);
				}
				//name
				$(this).next(".tweer_f1").css('background-position','-113px -552px');
				$(this).next(".tweer_f2").css('background-position','-113px -593px');
				$(this).next(".tweer_f3").css('background-position','-106px -634px');
			}
		});
		
		//动态滚动
		if($(".trends").children("p").text() != ""){
			$(".trends p:not(:first)").hide();
			var B = $(".trends p:last");
			var C = $(".trends p:first");
			setInterval(function(){
				if(B.is(":visible")){
					C.fadeIn(500).addClass("in");
					B.hide();
				}else{
					$(".trends p:visible").addClass("in");
					$(".trends p.in").next().fadeIn(500);
					$("p.in").hide().removeClass("in");
				}
			},3000);
		}else{
			$(".trends").append("<p>暂无动态信息!<p>");
		}
		
		
	});