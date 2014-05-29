// JavaScript Document
$(function(){
   $("form[0]").submit(function(){
       var username =$("#username").val();
       var password =$("#password").val();
	   var error=false;
       if(username==""){
		  error=true;
		  $("#username_msg").html("平台用户名不能为空");
	   }
	   if(password==""){
		  error=true;
		  $("#password_msg").html("密码不能为空");
	   }
	   if(password.length<6 && password.length>0){
		  error=true;
		  $("#password_msg").html("密码不能少于6位");
	   }
	   if(!error){
			return check_question(username,password);
		} else return false;
   });
  $("#username").blur(function(){
	var uerror=false;
	if(this.value==""){
		uerror=true;
		$("#username_msg").html("平台用户名不能为空");
		}
		if(!uerror){
			$("#username_msg").html("正确");
		}
  });
  $("#password").blur(function(){
    var pserror=false;							   
    if(this.value==""){
		  pserror=true;	
		  $("#password_msg").html("密码不能为空");
	}							   
    if(this.value.length<6 && this.value.length>0){
		 pserror=true;	
		$("#password_msg").html("密码不能少于6位");
		}
		if(!pserror){
			$("#password_msg").html("正确").css({color:'#999999'});
		}
  });
  $('.qh_btn > a').mouseover(function(){  
            $('.qh_btn > a').removeClass('nov');
            $(this).addClass('nov');
			$('#c_bnov div').css({display:'none'});
            $('#c_bnov div:eq(' + $('.qh_btn > a').index(this) + ')').css({display:'block'});  
      });
});

var check_question=function(e,f){
	 var username =$("#username").val();
     var password =$("#password").val();
	 var login_cookietime =$("input[name=login_cookietime]").val();
	  if(e){
			$.ajax({
				url: '/ajax/ckquestion.php',
				data: 'username='+encodeURI(e)+'&password='+f+'&login_cookietime='+login_cookietime,
				type: "POST",
				cache: false,
				dataType:"text",
				success: function(data){
					if(data=='1'){
						$("#password_msg").html('参数错误').css({color:'#ff0000'});
					} else if (data=='2'){
						 $("#username_msg").html('账号或者密码错误').css({color:'#ff0000'});
					} else if (data=='3'){
						 safequestion('login_sub',username,password);
					} else if (data=='4'){
						 $("#password_msg").html('账号或者密码错误').css({color:'#ff0000'});
					} else if (data=='5'){
						 window.location.href='/user/';
					} else if (data=='6'){
						 $("#password_msg").html('已经登录').css({color:'#ff0000'});
					} else if (data=='7'){
						 window.location.href='/user/checkAccount/';
					} else if (data=='8'){
						 $(".login_tip").html('密码错误次数超过限制').css({color:'#ff0000'});
					}   else {
						$("#password_msg").html('登录失败，请刷新后重新登录').css({color:'#ff0000'});
					}
				}
			});
			return false;
		}
	
};
$('#login_sub').attr({disabled: false});


jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        var path = options.path ? '; path=' + options.path : '';
        var domain = options.domain ? '; domain=' + options.domain : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};