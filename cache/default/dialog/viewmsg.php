<?php $_tplModify=filemtime('D:\xinyupingtai\cache\default\dialog\viewmsg.php');if(filemtime('D:\xinyupingtai\templates\default\dialog\header.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\dialog\footer.htm')>$_tplModify){include(template::load_base('D:\xinyupingtai\templates\default\dialog\viewmsg.htm','D:\xinyupingtai\cache\default\dialog\viewmsg.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/dialog/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://d.hainuo.info/css/dialog/dialog.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://d.hainuo.info/javascript/jquery.min.js"></script><script type="text/javascript" src="http://d.hainuo.info/javascript/common.func.js"></script>
<title>';echo $title;echo '</title>
</head>
<body>
<div class="main_dl">
	';if($_showmessage)$indexMessage=$_showmessage;echo '
	';if($indexShowMessage){echo '<div class=\'msg_panel\'><div>';echo $indexShowMessage;echo '</div></div>';}echo '
	';if($indexMessage){echo '<div class=\'error_panel\'><div>';echo $indexMessage;echo '</div></div>';}echo '
  ';if($title){echo '<div class="bar_dl">';echo $title;echo '</div>';}echo '
  <form name="myForm" method="post" id="myForm" onsubmit="return checkForm();">
<div>
';echo $sys_hash_code2;echo '
</div>
<div>
<input type="hidden" name="referer" value="';echo $referer;echo '" />
</div>';echo '
  <div style="line-height:26px; padding-left:40px;"><strong>';if($item['type']==1){echo '';echo $web_name;echo '';}else{echo '';echo $item['from_username'];echo '';}echo '</strong> 发给 <strong>';echo $item['to_username'];echo '</strong> 的信息 <span class="f_gray">';echo date('Y-m-d H:i:s',$item['timestamp']);echo '</span></div>
  <table width="90%" border="0" cellspacing="0" cellpadding="8">
    <tr>
      <td colspan="2" align="right"></td>
    </tr>
    <tr>
      <td width="70" align="right"><strong>标题：</strong></td>
      <td>';echo $item['title'];echo '</td>
    </tr>
    <tr>
      <td align="right"  style="line-height:20px; vertical-align:text-top;"><strong>内容：</strong></td>
      <td style="line-height:20px; font-size:14px; vertical-align:text-top;">';echo $item['message'];echo '</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center" style="padding-right:40px; padding-top:20px;" class="linkbtn">
        ';if($item['type']==0){echo '
		<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/';echo $action;echo '/sendmsg/?id=';echo $item['id'];echo '">回复</a>
		';}echo '
        <a href="javascript:;" onclick="parent.doCut2();return false;" >关闭</a></td>
    </tr>
  </table>
';echo '  </form>
</div>

</body>
</html>';?>