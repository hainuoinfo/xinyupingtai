<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
loadLib('Dom');
if (!$memberLogined) {
	echo '对不起，请先登陆后再操作！';
	exit;
}
  $goodsUrl=$_POST['goodsUrl'];
  $seller=$_POST['seller'];
if($goodsUrl!=''){
    $dom=file_get_html($goodsUrl);
    $nick=$dom->find('div.tb-shop-seller',0)->find('dl',0)->find('dd',0)->find('a.tb-seller-name',0)->plaintext;
    if(trim($nick)=='')
        $rs=13;//地址为非淘宝正常地址时，返回  比如全球购地址则不允许发布
    elseif(empty($seller))
        $rs=3;//选择昵称为空或者有误时返回3
    elseif($seller==trim($nick)){
        $rs=0;//0表示验证通过
    }else
        $rs=11;//11表示验证结果是url正确但是url所提取到的nick与系统中发布任务页面所获得淘宝店铺卖家昵称不同，返回11
}else
    $rs=12;//goodsUrl无法获取

$rs||$rs=1;//系统错误导致$rs为空时，返回1

echo $rs;
?>