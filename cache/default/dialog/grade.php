<?php $_tplModify=filemtime('D:\xinyupingtai\cache\default\dialog\grade.php');if(filemtime('D:\xinyupingtai\templates\default\dialog\header.htm')>$_tplModify||filemtime('D:\xinyupingtai\templates\default\dialog\footer.htm')>$_tplModify){include(template::load_base('D:\xinyupingtai\templates\default\dialog\grade.htm','D:\xinyupingtai\cache\default\dialog\grade.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/dialog/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<div style="padding:10px;line-height:20px;font-weight:bold;">请给对方刷客在任务进行中的表现进行评分；您的该次评价将直接影响对方的信用级别；信用级别过低的刷客将会被限制权限；情节严重者将做封号处理；所以请您认真客观的给对方评价；有了您的帮助，我们有信心会做的更好。</div>
  <div style="padding-bottom:5px;padding-left:10px;line-height:20px;" class="f_b_org">';if($isBuyer){echo '我是接手方：';echo $task['busername'];echo '，以下是给发布方：';echo $task['susername'];echo ' 打分';}else{echo '我是发布方：';echo $task['susername'];echo '，以下是给接手方：';echo $task['busername'];echo ' 打分';}echo '</div>
    <table class="tbl" width="100%" border="0" cellspacing="0" cellpadding="8">
      <tr>
        <td width="40%" align="center"><strong>任务信息</strong></td>
        <td><strong>任务过程满意</strong>　 <strong>任务过程一般</strong>　<strong>任务过程很差</strong></td>
      </tr>
      <tr>
        <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="80">任务编号：</td>
              <td align="left">';echo $task['id'];echo '</td>
            </tr>
            <tr>
              <td>商品名称：</td>
              <td align="left">';echo $task['title'];echo '</td>
            </tr>
          </table></td>
        <td><p>
          <input type="radio" name="grade" id="radio" value="1"';if(!$grade||$grade['score']==1){echo ' checked';}echo '  />满意<img src="';echo $weburl2;echo 'images/face/dg_1.gif" alt="满意" align="absmiddle" />
          　
          <input type="radio" name="grade" id="radio2" value="2"';if($grade&&$grade['score']==0){echo ' checked';}echo '';if(isset($grade)&&$grade['score']>0&&$grade['type']!=1){echo ' disabled';}echo ' />一般<img src="';echo $weburl2;echo 'images/face/dg_2.gif" alt="一般" align="absmiddle" />
          　
          <input type="radio" name="grade" id="radio3" value="3"';if($grade&&$grade['score']==-1){echo ' checked';}echo '';if(isset($grade)&&$grade['score']>-1&&$grade['type']!=1){echo ' disabled';}echo ' />很差<img src="';echo $weburl2;echo 'images/face/dg_3.gif" alt="很差" align="absmiddle" /></p>
          <p style="padding-top:5px;">
            <textarea name="remark" cols="30" rows="6" id="remark">';echo $grade['remark'];echo '</textarea> 
            <input name="isHide" type="checkbox" id="isHide" value="1"';if(isset($grade)&&$grade['isHide']){echo ' checked="checked"';}echo ' />匿名</p>
          <p style="padding-top:5px;"><a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/black/?username=';if($isBuyer){echo '';echo urlencode($task['susername']);echo '';}else{echo '';echo urlencode($task['busername']);echo '';}echo '" target="_blank" class="link_b">拉入黑名单</a></p></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
			';if($grade){echo '
			';if($grade['type']==0&&$grade['remark']&&$grade['score']==1){echo '
			已不能修改评分
			';}else{echo '
			<input name="btnSubmit" type="submit" class="btn_2" id="btnSubmit" value="修改评价" />
			';}echo '
			';}else{echo '
          <input name="btnSubmit" type="submit" class="btn_2" id="btnSubmit" value="添加评价" />
		  ';}echo '
          <input name="btnCancel" type="button" class="btn_2" onclick="parent.doCut();" id="btnCancel" value="取消" />
          </td>
      </tr>
    </table>
	<script type="text/javascript">
function checkForm() {';echo '
    if (getObj("radio3").checked && getValue("remark").length<20) {';echo '
        alert("差评的评论不能少于20个字");
        return false;
    ';echo '}
	return true;
';echo '}
</script>
';echo '  </form>
</div>

</body>
</html>';?>