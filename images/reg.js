// JavaScript Document
var formReturn=$('#formReturn');
var error=false;
var check_username=function(e){
	      var obj=$('#username');
          if(obj.val()){
			obj.css({'disabled':true});
			$.ajax({
				url: '/ajax/check.php?action=username',
				data: 'hash2=$sys_hash2&username='+encodeURI($(obj).val()),
				type: "POST",
				cache: false,
				dataType:"text",
				success: function(data){
					obj.css({'disabled':false});
					if(data=='2'){
						$('#zh').css("color","#468847");
						$('#username').css({border:"1px solid #91ED6D",color:"#468847"});
						$('#username_tip').text('').css({top:"0px",background:"url(/images/user/reg_03.jpg) 50% 50% no-repeat"});
					} else if (data=='3') {
						error=true;
						$('#zh').css("color","#EE5F5B");
						$('#username').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
						$('#username_tip').text('由英文字母、数字、中文，长度在3-14字符之内').css({color:"#EE5F5B",top:"0px",background:"none"});
					} else if (data=='1') {
					    error=true;
						$('#zh').css("color","#EE5F5B");
						$('#username').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
						$('#username_tip').text('该用户名已存在').css({color:"#EE5F5B",top:"0px",background:"none"});
					} else{
					    error=true;
						$('#zh').css("color","#EE5F5B");
						$('#username').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
						$('#username_tip').text('请刷新后在试').css({color:"#EE5F5B",background:"none",top:"0px"});
					}
				}
			});
		}
		else
		{
		  error=true;
		  $('#zh').css("color","#EE5F5B");
		  $('#username').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
		  $('#username_tip').text('用户名不能为空').css({color:"#EE5F5B",background:"none",top:"0px"});
		}
};
var check_password=function(){
       var objvalue=$('#password').val();
	   var strRegex = /^[0-9a-zA-Z]{6,20}$/g;
       var re=new RegExp(strRegex);
	   if(objvalue){
	   if(re.test(objvalue)){
			$('#pd').css("color","#468847");
			$('#password').css({border:"1px solid #91ED6D",color:"#468847"});
			$('#password_tip').text('').css({top:"0px",background:"url(/images/user/reg_03.jpg) no-repeat"});
	   }else if (objvalue.length<6){
	        error=true;
			$('#pd').css("color","#EE5F5B");
			$('#password').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
			$('#password_tip').text('密码最少6位').css({color:"#EE5F5B",background:"none",top:"0px"});
	   }else {
		   error=true;
		   $('#pd').css("color","#EE5F5B");
			$('#password').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
			$('#password_tip').text('密码格式错误').css({color:"#EE5F5B",background:"none",top:"0px"});
		   }
	   }
	   else
	   {
	        error=true;
			$('#pd').css("color","#EE5F5B");
			$('#password').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
			$('#password_tip').text('请填写密码').css({color:"#EE5F5B",background:"none",top:"0px"});
	   }
	   
};
var check_password_=function(){
       var objvalue=$('#password_').val();
	   var objvalue2=$('#password').val();
	   if(objvalue.length && (objvalue==objvalue2)){
		   if(objvalue.length>=6){
				$('#pdt').css("color","#468847");
				$('#password_').css({border:"1px solid #91ED6D",color:"#468847"});
				$('#passwordt_tip').text('').css({top:"0px",background:"url(/images/user/reg_03.jpg) no-repeat"});
		   }else if (objvalue.length<6){
		        error=true;
				$('#pd_').css("color","#EE5F5B");
				$('#password_').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
				$('#passwordt_tip').text('密码最少6位').css({color:"#EE5F5B",background:"none",top:"0px"});
		   }
	   }
	   else
	   {
	        error=true;
			$('#pdt').css("color","#EE5F5B");
			$('#passwordt').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
			$('#passwordt_tip').text('二次密码输入不一致').css({color:"#EE5F5B",background:"none",top:"0px"});
	   }
	   
};
var check_password2=function(){
       var objvalue=$('#password2').val();
	   var strRegex = /^[0-9a-zA-Z]{6,20}$/g;
       var re=new RegExp(strRegex);
	   if(objvalue){
	   if(re.test(objvalue)){
			$('#pd2').css("color","#468847");
			$('#password2').css({border:"1px solid #91ED6D",color:"#468847"});
			$('#password2_tip').text('').css({top:"0px",background:"url(/images/user/reg_03.jpg) no-repeat"});
	   }else if (objvalue.length<5){
	        error=true;
			$('#pd2').css("color","#EE5F5B");
			$('#password2').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
			$('#password2_tip').text('安全码最少为6位').css({color:"#EE5F5B",background:"none",top:"0px"});
	   }else {
		   error=true;
		    $('#pd2').css("color","#EE5F5B");
			$('#password2').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
			$('#password2_tip').text('安全码格式错误').css({color:"#EE5F5B",background:"none",top:"0px"});
		   }
	   }
	   else
	   {
	        error=true;
			$('#pd2').css("color","#EE5F5B");
			$('#password2').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
			$('#password2_tip').text('请填写安全码').css({color:"#EE5F5B",background:"none",top:"0px"});
	   }
	   
};
var check_password2_=function(){
       var objvalue=$('#password2_').val();
	   var objvalue2=$('#password2').val();
	   if(objvalue.length && (objvalue==objvalue2)){
		   if(objvalue.length>=6){
				$('#pdt').css("color","#468847");
				$('#password2_').css({border:"1px solid #91ED6D",color:"#468847"});
				$('#password21_tip').text('').css({top:"0px",background:"url(/images/user/reg_03.jpg) no-repeat"});
		   }else if (objvalue.length<6){
		        error=true;
				$('#pd_').css("color","#EE5F5B");
				$('#password2_').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
				$('#password2_tip').text('安全码最少6位').css({color:"#EE5F5B",background:"none",top:"0px"});
		   }
	   }
	   else
	   {
	        error=true;
			$('#pdt').css("color","#EE5F5B");
			$('#passwordt').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
			$('#password21_tip').text('二次安全码输入不一致').css({color:"#EE5F5B",background:"none",top:"0px"});
	   }
	   
};
var check_qq=function(){
       var objvalue=$('#qq').val();
	   var strRegex = /^\d+$/;
       var re=new RegExp(strRegex);  
	   if(re.test(objvalue)){
		    $('#qqt').css("color","#468847");
			$('#qq').css({border:"1px solid #91ED6D",color:"#468847"});
			$('#qq_tip').text('').css({top:"0px",background:"url(/images/user/reg_03.jpg) no-repeat"});
			$("#email").val($("#qq").val()+"@qq.com");
			$('#em').css("color","#468847");
			$('#email').css({border:"1px solid #91ED6D",color:"#468847"});
			$('#em_tip').text('').css({top:"0px",background:"url(/images/user/reg_03.jpg) no-repeat"});
	   }
	   else
	   {
	            error=true;
				$('#qqt').css("color","#EE5F5B");
				$('#qq').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
				$('#qq_tip').text('格式错误').css({color:"#EE5F5B",background:"none",top:"0px"});
	   }
	   
};
var check_truename=function(){
       var objvalue=$('#truename').val();  
	   if(objvalue.length>=2){
		    $('#truenamet').css("color","#468847");
			$('#truename').css({border:"1px solid #91ED6D",color:"#468847"});
			$('#truename_tip').text('').css({top:"0px",background:"url(/images/user/reg_03.jpg) no-repeat"});
			$('#em').css("color","#468847");
			$('#truename').css({border:"1px solid #91ED6D",color:"#468847"});
			$('#truename_tip').text('').css({top:"0px",background:"url(/images/user/reg_03.jpg) no-repeat"});
	   }
	   else
	   {
	            error=true;
				$('#truenamet').css("color","#EE5F5B");
				$('#truename').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
				$('#truename_tip').text('格式错误').css({color:"#EE5F5B",background:"none",top:"0px"});
	   }
	   
};
var check_mobil=function(){
       var objvalue=$('#mobilephone').val();
	   var strRegex = /^1(?:(?:3[0-9])|(?:5[0-35-9])|(?:4[0-35-9])|(?:8[0-35-9]))\d{8}$/;
       var re=new RegExp(strRegex);  
	   if(re.test(objvalue)){
		    $('#telt').css("color","#468847");
			$('#mobilephone').css({border:"1px solid #91ED6D",color:"#468847"});
			$('#tel_tip').text('').css({top:"0px",background:"url(/images/user/reg_03.jpg) no-repeat"});
	   }
	   else
	   {
	        error=true;
			$('#telt').css("color","#EE5F5B");
			$('#mobilephone').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
			$('#tel_tip').text('格式错误').css({color:"#EE5F5B",background:"none",top:"0px"});
	   }
};
var check_email=function(){
       var objvalue=$('#email').val();
	   var strRegex = /^[a-z0-9][a-z0-9_]+@[a-z0-9]+(\.[a-z0-9]+){1,3}$/i;
       var re=new RegExp(strRegex);  
	   if(re.test(objvalue)){
		    $('#em').css("color","#468847");
			$('#email').css({border:"1px solid #91ED6D",color:"#468847"});
			$('#em_tip').text('').css({top:"0px",background:"url(/images/user/reg_03.jpg) no-repeat"});
	   }
	   else
	   {
	        error=true;
			$('#em').css("color","#EE5F5B");
			$('#email').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
			$('#em_tip').text('格式错误').css({color:"#EE5F5B",background:"none",top:"0px"});
	   }
};
var check_parent=function(){
	      var obj=$('#parent');
          if(obj.val()){
			obj.attr({'disabled':true});
			$.ajax({
				url: '/ajax/check.php?action=parent',
				data: 'hash2=$sys_hash2&parent='+encodeURI($(obj).val()),
				type: "POST",
				cache: false,
				dataType:"text",
				success: function(data){
					obj.attr({'disabled':false});
					if(data=='1'){
						$('#tj').css("color","#468847");
						$('#parent').css({border:"1px solid #91ED6D",color:"#468847"});
						$('#tj_tip').text('').css({top:"0px",background:"url(/images/user/reg_03.jpg) no-repeat"});
					} else{
						$('#tj').css("color","#EE5F5B");
						$('#parent').css({border:"1px solid #EE5F5B",color:"#EE5F5B"});
						$('#tj_tip').text('推荐人不存在').css({color:"#EE5F5B",background:"none",top:"0px"});
					}
				}
			});
		}else
		{
			$('#tj').css("color","#666666");
			$('#parent').css({border:"1px solid #DDDDDD"});
			$('#tj_tip').text('');
		}
};
var checkform=function(e){
	    check_username();
		check_password();
		check_password_();
		check_password2();
		check_password2_();
		check_truename();
		check_qq();
		check_mobil();
		check_email();
		if(!error){
			return true;
		} else return false;
  };
$(document).ready(function(){
	$('#myregForm').submit(function(){
	return checkform();
    });
	$('#agreement').click(function(){
	comm_720fram(720, 335, "安全问题", "", "");
    });	
});