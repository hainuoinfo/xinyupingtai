<?php
include(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'index.php');
loadLib('Dom');
if (!$memberLogined){
     echo '对不起，请先登陆后再操作！';
     exit;
     }
$goodsUrl = $_POST['goodsUrl'];
$seller = $_POST['seller'];
if($goodsUrl != '' && $seller != ''){
	ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727;http://www.9qc.com)');
     $content = file_get_contents($goodsUrl);
     //$content=mb_convert_encoding($content,'UTF-8','GBK');
     $content=str_replace('<meta charset="gbk" />','<meta charset="UTF-8" />',$content);
     $seller=iconv('UTF-8','GBK',$seller);
	$v=preg_match('/'.$seller.'/',$content,$maches);
     if($v == '')
     //    $rs = 13; //地址为非淘宝正常地址时，返回  比如全球购地址则不允许发布
     //elseif(empty($seller))
         $rs = 12; //选择昵称为空或者有误时返回3
     if($v>=1)
         $rs = 1; //1表示验证通过
         //}else{
         //$rs = 11; //11表示验证结果是url正确但是url所提取到的nick与系统中发布任务页面所获得淘宝店铺卖家昵称不同，返回11
         //}
     }else
     $rs = 12; //goodsUrl无法获取







// $rs===0||$rs=1;//系统错误导致$rs为空时，返回1
echo $rs;
?>
