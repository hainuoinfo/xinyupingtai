// JavaScript Document
var error2=false;
var check_loginuser=function(){
	var username=$('#lusername').val();
	if(username=='' || username=='undefined')
		username=$('#username').val();
	console.log(username);
	if(!username)username=$('#username').val();
	console.log(username);
	
	if(username.length<3){
				
				$('#loginaccount').css("color","#B94A48");
				$('#lusername').css({border:"1px solid #EE5F5B",color:"#B94A48"});
				error2=true;
	}
	else
	{ 
	            $('#loginaccount').css("color","#468847");
				$('#lusername').css({border:"1px solid #91ED6D",color:"#468847"});
				error2=false;
				
	}
};
var check_loginpassword=function(){
	var password=$('#lpassword').val();
	if(!password) password=$('#password').val();
	if(password.length<6 || password.length>20){
				
				$('#loginpwd').css("color","#B94A48");
				$('#lpassword').css({border:"1px solid #EE5F5B",color:"#B94A48"});
				error2=true;
	}
	else
	{
	            $('#loginpwd').css("color","#468847");
				$('#lpassword').css({border:"1px solid #91ED6D",color:"#468847"});
				error2=false;
				
	}
};
var check_question=function(e,f){
	 var hash     =$("input[name=hash2]").val();
	 if(e){
			$.ajax({
				url: '/ajax/ckquestion.php',
				data: 'hash2='+ hash +'&username='+encodeURI(e)+'&password='+f,
				type: "POST",
				cache: false,
				dataType:"text",
				success: function(data){
					if(data=='1'){
						$(".login_tip").html('参数错误').css({color:'#ff0000'});
					} else if (data=='2'){
						 $(".login_tip").html('账号或者密码错误').css({color:'#ff0000'});
					} else if (data=='3'){
						 safequestion(e,f,hash);
					} else if (data=='4'){
						 $(".login_tip").html('账号或者密码错误').css({color:'#ff0000'});
					} else if (data=='5'){
							window.location.href='/member/';
					} else if (data=='6'){
						 $(".login_tip").html('已经登录').css({color:'#ff0000'});
					} else if (data=='0') {
						$(".login_tip").html('提交错误').css({color:'#ff0000'});
					} else if (data=='7'){
						 window.location.href='/member/checkAccount/';
					} else if (data=='8'){
						 $(".login_tip").html('密码错误次数超过限制').css({color:'#ff0000'});
					} else{
						$(".login_tip").html('登录失败，请刷新后重新登录').css({color:'#ff0000'});
					}
				}
			});
			return false;
		}
	
};
var safequestion=function(e,f,hash){
	comm_fram(413, 255, "安全问题", "", "<form id=qtform action='/user/login/' method=post name=myform><div class=safetyvalidate><div id=uv_content class=content><div class=in_content><p id=top_tip class=title>绑定安全问题到账号，请您验证安全问题。</p><div class='check clearfix'><div id=selsecter><ul><li><span class=label>选择安全问题：</span><select id=questionid class=ipt_select tabindex=3 name=questionid><option value='0' selected='selected'>无安全问题</option><option value='1'>早上几点起床？</option><option value='2'>最爱吃的菜？</option><option value='3'>好朋友的名字？</option><option value='4'>你的理想体重？</option><option value='5'>爱人的生日？</option></select></select></li></ul></div><div id=mbitems><div id=question style=><ul><li><span class=label>答案：</span><input class=inputstyle type=text tabindex=4 name='answer' style='color:#ccc;'></li></ul></div></div><div id='answer_msg'></div></div></div><p id='question_reset_tip' class='tips_area li_warn'><a tabindex=11 target=_blank href='http://wpa.qq.com/msgrd?v=3&uin=188239038&site=qq&menu=yes'>忘记安全问题，无法验证？</a></p></div><div class=btn><input type=hidden value="+hash+" name='hash2'><input type=hidden value="+e+" name='username'><input type=hidden value="+f+" name='password'><input class=btn_em type='submit' tabindex='8' value='确 定'><input onclick='doCut();' class=btn_dft type='button' tabindex='9' value='取 消'></div></div></form>");
	};
$(document).ready(function(){
	$('#myForm').submit(function(){
	var username=$('#lusername').val();
	if(username=='' || username=='undefined')
	username=$('#username').val();
	var password=$('#lpassword').val();
	check_loginuser();
	check_loginpassword();
	if(!error2){
			return check_question(username,password);
		} else return false;
    });
});