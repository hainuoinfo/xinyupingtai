<?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/dialog/';echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" href="../css/dialog.css" rel="stylesheet" />
<style type="text/css">
.tbl td {';echo 'border-bottom:1px solid #E8F2FC;';echo '}
.bar_dl {';echo 'margin:0px !important;';echo '}
</style>
<link href="http://d.hainuo.info/css/dialog/dialog.css" rel="stylesheet" type="text/css" /><link href="http://d.hainuo.info/css/task/task.css" rel="stylesheet" type="text/css" /><script type="text/javascript" src="http://d.hainuo.info/javascript/index/task.js"></script>
<script type="text/javascript" src="http://d.hainuo.info/javascript/jquery.min.js"></script><script type="text/javascript" src="http://d.hainuo.info/javascript/common.func.js"></script>
<title>来路商品详情</title>
</head>
<body>
<div class="main_dl">
	';if($_showmessage){echo '<div class=\'msg_panel\'><div>';echo $_showmessage;echo '</div></div>';}echo '
	';if($indexMessage){echo '<div class=\'error_panel\'><div>';echo $indexMessage;echo '</div></div>';}echo '
	<div style="padding:5px ; line-height:18px; border:1px dashed #A3C5EA;">
		该任务属于商品来路任务，接手方需要完成下列来路步骤后方能查看商品网址
	</div>
	
	<div class="bar_dl">来路商品详情</div>
<form name="myForm" method="post" id="myForm" onsubmit="return checkForm();">
<div>';echo $sys_hash_code2;echo '</div>

  <table class="tbl" width=\'100%\' border=\'0\' cellspacing=\'0\' cellpadding=\'6\'>
	
    <tr>
      <td width=\'80\' class=\'f_b_green\' valign="top" align="right">第一步：</td>
      <td>
	  ';if($task['visitWay']==1){echo '
	  请在淘宝首页搜索店铺：
	  ';}elseif($task['visitWay']==2){echo '
	  请在淘宝首页搜索宝贝：
	  ';}elseif($task['visitWay']==3){echo '
	  请打开信用地址：
	  ';}echo '
	  <strong>';echo $task['visitKey'];echo '</strong>　
				<span class=\'btn_gl cursor\' onclick=\'return copy("';echo $task['visitKey'];echo '")\'>复制</span></td>
    </tr>
    <tr>
      <td class=\'f_b_green\' valign="top" align="right">第二步：</td>
      <td>根据搜索提示打开搜索结果列表中掌柜名为：<strong>';if(!$task['isVisit']){echo '';echo string::getXin2($task['nickname']);echo '';}else{echo '';echo $task['nickname'];echo '';}echo '</strong> 的商品</td>
    </tr>
    
    <tr>
      <td class=\'f_b_green\' valign="top" align="right">第三步：</td>
      <td>复制商品页面地址栏的地址，并黏贴到下面, 然后点击【验证商品】按钮；<span class="f_b_red">';if($task['isVisit']){echo '已通过验证';}echo '</span></td>
    </tr>
    ';if(!$task['isVisit']){echo '
    <tr>
			<td>&nbsp;</td>
			<td><input type="text" name="itemurl" id="itemurl" value="';echo $itemurl;echo '" style="width:400px" /> <input type="submit" name="btnSubmit" value="验证商品" /></td>
    </tr>
    <tr>
			<td class=\'f_b_green\' valign="top" align="right">搜索提示：</td>
			<td>';echo $task['visitTip'];echo '</td>
    </tr>
	<tr>
			<td class=\'f_b_green\' valign="top" align="right">图片位置：</td>
			<td>';if($task['photourl']){echo '<a target="_blank" style="padding:10px; color:#F00;" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/';echo $task['photourl'];echo '">查看图片提示</a>';}else{echo '无提示';}echo '</td>
    </tr>
	';}echo '
  </table>
  </form>
  <div style="padding:20px; color:#F00; font-weight:bold;">注意：请接手人一定在通过验证商品后再淘宝拍下与支付，否则将无法继续任务得到任务保证金！</div>
	<div style="padding-top:20px;text-align:center;">
		<input name="goon" class="btn_2" type="button" id="goon" onclick="parent.doCut2();" value="关闭" />
	</div>
</div>
<script type="text/javascript">
	function checkForm() {';echo '
		var checks = [
        ["isEmpty", "itemurl", "商品地址"] ];
		var result = doCheck(checks);
		if (result)
			return avoidReSubmit();
		return result;
	';echo '}
</script>
</body>
</html>
';?>