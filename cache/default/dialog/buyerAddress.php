<?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/dialog/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head id="Head1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="http://damaihu.tertw.net/css/dialog/dialog.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://damaihu.tertw.net/javascript/jquery.min.js"></script><script type="text/javascript" src="http://damaihu.tertw.net/javascript/common.func.js"></script>
<link href="/images/dialog.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/images/jquery.js"></script>
<script type="text/javascript" src="/images/common.js"></script>
<style type="text/css">
.submiting{';echo '';echo '}
a {';echo ' font-size:12px; color:#555; text-decoration:none;';echo '}
.tb .a a:hover {';echo 'text-decoration:underline;';echo '}
</style>
<title>设置地址</title></head>
<body>
<div class="main_dl"> 
	
	
	<div style="padding:5px ; line-height:18px; font-size:12px; border:1px dashed #A3C5EA;">
	
		1．现在快递单号业务理论上支持全国所有大中城市收货，请将该小号淘宝收货地址设置完善<br>
		2．本页面填写的地址用来接手“已购买真实快递单号的任务”；请务必填写时与淘宝上本小号的收货地址保持一致！
		<a href="/bbs/t72/" class="link_o" target="_blank">如何查看修改淘宝账号收货地址</a>
	
	</div>
  
  <div class="h_10"></div>
  <ul class="tb">
  	<li class="a"><a href="javascript:;">顺风</a></li>
  </ul>
  <form name="myForm" method="post" id="myForm" class="clear" onsubmit="return checkForm();">
  <div>';echo $sys_hash_code2;echo '</div>
<div>
    <input name="area" id="area" value="';echo $area;echo '" type="hidden">
	<input name="eid" id="eid" value="';echo $e;echo '" type="hidden">
    <table class="tbl" border="0" cellpadding="4" cellspacing="0">
      <tbody><tr>
        <td class="f_b" align="right" width="110">淘宝买号：</td>
        <td class="f_b_red f_14">';echo $buyer['nickname'];echo '</td>
      </tr>
      <tr>
	  	<td class="f_b" align="right">省/市</td>
		<td class="f_14" id="area_box"><script type="text/javascript" src="/images/city.js"></script></td>
	  </tr>
      
      <tr>
        <td class="f_b" align="right" valign="top">收货人详细地址：</td>
        <td><input name="address" id="address" class="text_long" maxlength="100" type="text" value="';echo $address;echo '">
					<div>无需重复填写省/市/区/街道(镇)，具体门牌号可到百度中搜索；
					<br>不明白的可联系客服或<a href="/bbs/t73/" class="link_o" target="_blank">点这里</a>；但是<span class="f_red">必须要与淘宝上一致</span></div></td>
      </tr>
      
      <tr>
        <td class="f_b" align="right" valign="top">收货人姓名：</td>
        <td><input name="nickname" id="nickname" class="text_small" maxlength="50" type="text" value="';echo $nickname;echo '"><span class="f_red">必须与淘宝上发货人姓名相同</span></td>
      </tr>
      <tr>
        <td class="f_b" align="right" valign="top">收货人手机号码：</td>
        <td><input name="mobile" id="mobile" class="text_small" type="text" value="';echo $mobilephone;echo '">
					<div style="padding-top:5px;">请填写一个有效的手机号码，<span class="f_red">必须和淘宝上登记的发货人信息一致</span></div></td>
      </tr>
      <tr>
        <td colspan="2" style="padding-top:20px" align="center"><input name="btnSubmit" class="btn_2" id="btnSubmit" value="确定" type="submit">
          <input name="btnCancel"  class="btn_2" onclick="parent.doCut();" id="btnCancel" value="取消" type="button"></td>
      </tr>
    </tbody></table>
  </form>
</div>
<script type="text/javascript">
function checkForm() {';echo '
    var checks = [
		["isEmpty", "address", "详细地址"],
		["isLength", "address", "详细地址", 3, 50],
		["isEmpty", "nickname", "姓名"],
		["isLength", "nickname", "姓名", 1, 20],
		["isNumber", "mobile", "手机号码"],
		["isLength", "mobile", "手机号码", 11, 11] ];
	var result = doCheck(checks);
	if (result)
		return true;
	return result;
';echo '}
var City = "";
var Province = "";
if(City){';echo '
  $("#City").append(\'<option value="\'+City+\'" selected="selected">\'+City+\'</option>\');
';echo '}
if(Province){';echo '
   $("#Province option[value=\'"+Province+"\']").attr("selected", true);
';echo '}
</script>


</body></html>';?>