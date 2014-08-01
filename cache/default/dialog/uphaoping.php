<?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/dialog/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>文件上传</title>
    <style>
        body{';echo '
            padding:5px;
            margin:0px;
            font-size:12px;
            background:#EEEEEE
        ';echo '}
        .box{';echo '
            width:100%;
        ';echo '}
        .box .up{';echo '
            width:400px;
            margin:auto;
        ';echo '}
        .up input{';echo '
            height:25px;
            line-height:20px;
        ';echo '}
        .up #filedata{';echo '
            width:300px;
        ';echo '}
    </style>
    <script>
        function upload()
        {';echo '
            callback(';echo $rs;echo ');
        ';echo '}
        function closewindow()
        {';echo '
            unloadme();
        ';echo '}
        var $=function(id){';echo 'return document.getElementById(id);';echo '}
        var checkSuffix=function(){';echo '
            var path = $(\'filedata\').value;
            if (path) {';echo '
                if (/\\.(jpg|jpeg|gif|png)$/i.test(path)) return true;
                else {';echo '
                    alert(\'图片格式不正确，只能上传jpg,jpeg,gif,png格式的图片\');
                    return false;
                ';echo '}
            ';echo '}
            $(\'filedata\').focus();
            return false;
        ';echo '}
        var checkForm=function(){';echo '
            if (checkSuffix()) return true;
            return false;
        ';echo '}
        ';if($showMessage){echo '
            alert(\'';echo $showMessage;echo '\');
            ';}echo '
    </script>
</head>
<body>
';if($task['status']<8){echo '
	<span style="color: red;font-size: 14px;font-weight:bold;"> 亲，你太着急了，本任务还未进行到截图上传步骤，请核对本任务的进度后再进行此操作！ </span><br/>
';}echo '
';if($uid==$task['buid']){echo '<span style="color: red;">请注意如果卖家选择了好评截图和分享截图两个上传项目，在你点击确认时会看到本页面两次，一次是用来上传好评截图，一次是用来上传分享截图，在下方都会明确提示你当前需要上传的项目名称，由于你无法对上传后的截图进行修改，所以请务必按照下方的提示进行上传。</span><br />';}echo '
';if($task['ispinimage']){echo '需要上传好评截图！
';if($uid==$task['suid']&&!$task['pinimage']){echo '<span style="color: red;">买家 还未上传好评截图！</span>';}echo '
';if($task['pinimage']){echo '<span style="color: red;">好评图已上传</span>';}echo '
<br />
';}echo '
';if($task['isShare']){echo '需要上传分享截图！
';if($uid==$task['suid']&&!$task['shareimage']){echo '<span style="color: red;">买家 还未上传分享截图！</span>';}echo '
';if($task['shareimage']){echo '<span style="color: red;">分享图已上传</span>';}echo '
<br />
';}echo '
';if($task['buid']==$uid&&$imageType!='imagexxx'){echo '<!--/* 只有买家才能够看到上传界面 */-->
<div class="box">
<h1>
    ';if($imageType=='pinimage'){echo '上传好评截图';}echo '
    ';if($imageType=='shareimage'){echo '上传分享截图';}echo '
</h1>
    <div class="up">
        <form method="post" enctype="multipart/form-data" onsubmit="return checkForm()">
            ';echo $sys_hash_code2;echo '
            <input type="file" name="filedata" id="filedata" onchange="checkSuffix()" />
            <input  type="hidden" name="imageType" value="';echo $imageType;echo '"/>
            <input type="submit" value="上传" />
        </form>
    </div>
</div>
';}echo '
';if($task['pinimage']){echo '<div ><h6>好评图</h6><img src="';echo $task['pinimage'];echo '" width="100px" onclick="window.open(\'';echo $task['pinimage'];echo '\')"/></div>';}echo '
';if($task['shareimage']){echo '<div ><h6>分享图</h6><img src="';echo $task['shareimage'];echo '" width="100px" onclick="window.open(\'';echo $task['shareimage'];echo '\')"/></div>';}echo '
</body>
</html>';?>