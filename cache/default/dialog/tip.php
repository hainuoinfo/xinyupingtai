<?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/dialog/';echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://d.hainuo.info/css/dialog/dialog.css" rel="stylesheet" type="text/css" />
<title>';echo $title;echo '</title>
</head>
<body>
<div class="tip_lot">
    ';echo $message;echo '
</div>
<div style="padding-top:50px;">
  <input name="goon" class="btn_2" type="button" id="goon" onclick="parent.doCut2(\'';echo $goto_url;echo '\');" value="确定" />
</div>
</body>
</html>
';?>