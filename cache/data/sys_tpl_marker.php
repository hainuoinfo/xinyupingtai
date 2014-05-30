<?php $cache_sys_tpl_marker=array(0=>array('m'=>'{++ 0}','d'=>'<?php echo 0+1;?>','o'=>false,'a'=>'array(1=>\'1\')','b'=>''),1=>array('m'=>'{stripslashes 0}','d'=>'<?php echo stripslashes(0);?>','o'=>false,'a'=>'','b'=>''),2=>array('m'=>'{clear}','d'=>'<?php common::ob_clean();?>','o'=>false,'a'=>'','b'=>''),3=>array('m'=>'{end_clear}','d'=>'<?php ob_end_clean();?>','o'=>false,'a'=>'','b'=>''),4=>array('m'=>'{exit}','d'=>'<?php exit();?>','o'=>false,'a'=>'','b'=>''),5=>array('m'=>'{eval\\s+0}','d'=>'<?php 0?>','o'=>false,'a'=>'','b'=>''),6=>array('m'=>'{if 0}','d'=>'<?php if(0){?>','o'=>false,'a'=>'','b'=>''),7=>array('m'=>'{else}','d'=>'<?php } else {?>','o'=>false,'a'=>'','b'=>''),8=>array('m'=>'{elseif 0}','d'=>'<?php } elseif(0) {?>','o'=>false,'a'=>'','b'=>''),9=>array('m'=>'{/if}','d'=>'<?php }?>','o'=>false,'a'=>'','b'=>''),10=>array('m'=>'{loop 0 1 2}','d'=>'<?php if(0){foreach(0 as 1[=>2?]){?>','o'=>false,'a'=>'','b'=>''),11=>array('m'=>'{/loop}','d'=>'<?php }}?>','o'=>false,'a'=>'','b'=>''),12=>array('m'=>'{js_select 0}','d'=>'echo template::js_select(\'0\');','o'=>true,'a'=>'','b'=>''),13=>array('m'=>'{css_select 0}','d'=>'echo template::css_select(\'0\');','o'=>true,'a'=>'','b'=>''),14=>array('m'=>'{date 0}','d'=>'<?php echo date(\'Y-m-d H:i:s\',0);?>','o'=>false,'a'=>'','b'=>''),15=>array('m'=>'{teval 0}','d'=>'0','o'=>true,'a'=>'','b'=>''),16=>array('m'=>'{template 0}','d'=>'<?php include(template::load(\'0\'));?>','o'=>false,'a'=>'','b'=>''),17=>array('m'=>'{subtemplate 0}','d'=>'echo template::loadsubtemplate(\'0\');','o'=>true,'a'=>'','b'=>''),18=>array('m'=>'{tpl_eval 0}','d'=>'0','o'=>true,'a'=>'','b'=>''),19=>array('m'=>'{switch 0 1}','d'=>'<?php switch(0){case 1:?>','o'=>false,'a'=>'','b'=>''),20=>array('m'=>'{case 0}','d'=>'<?php break;case 0:?>','o'=>false,'a'=>'','b'=>''),21=>array('m'=>'{case_else}','d'=>'<?php break;default:?>','o'=>false,'a'=>'','b'=>''),22=>array('m'=>'{/switch}','d'=>'<?php break;}?>','o'=>false,'a'=>'','b'=>''),23=>array('m'=>'{html 0}','d'=>'<?php echo htmlspecialchars(0);?>','o'=>false,'a'=>'','b'=>''),24=>array('m'=>'{block 0}','d'=>'echo template::stripblock(\'0\');','o'=>true,'a'=>'','b'=>''),25=>array('m'=>'{lang 0}','d'=>'echo language::get(\'0\',\'index\',\'default\');','o'=>true,'a'=>'','b'=>''),26=>array('m'=>'{lang2 0}','d'=>'<?=language::get(0)?>','o'=>false,'a'=>'','b'=>''),27=>array('m'=>'{ip 0}','d'=>'<?php echo common::intip(0);?>','o'=>false,'a'=>'','b'=>''),28=>array('m'=>'{rewrite}','d'=>'<?php
if(!$web_rewrite)echo $weburl2.\'rewrite.php?rewrite=\';
?>','o'=>false,'a'=>'','b'=>''),29=>array('m'=>'{cut 0,1}','d'=>'<?php
echo common::cutstr(0,1);
?>','o'=>false,'a'=>'','b'=>''),30=>array('m'=>'{url 0}','d'=>'<?php
echo urlencode(0);
?>','o'=>false,'a'=>'','b'=>''),31=>array('m'=>'{adminForm\\s+0}','d'=>'echo admin::form(\'0\');','o'=>true,'a'=>'','b'=>''),32=>array('m'=>'{adminList\\s+0}','d'=>'echo admin::getTplList(\'0\');','o'=>true,'a'=>'','b'=>''),33=>array('m'=>'{echo 0}','d'=>'<?php
 echo 0;
?>','o'=>false,'a'=>'','b'=>''),34=>array('m'=>'{sub 0}','d'=>'echo template::loadsubtemplate(\'0\');','o'=>true,'a'=>'','b'=>''),35=>array('m'=>'{pa 0}','d'=>'if($data=db::one_one(\'page_article\',\'content\',"marker=\'0\'")){
echo string::ubbDecode($data);
}','o'=>true,'a'=>'','b'=>''),36=>array('m'=>'{ad 0}','d'=>'echo background::getAd(\'0\');','o'=>true,'a'=>'','b'=>''),37=>array('m'=>'{ad2 0}','d'=>'echo background::getAd2(\'0\');','o'=>true,'a'=>'array(2=>\'2\')','b'=>''),38=>array('m'=>'{cutstr 0,1}','d'=>'<?php echo common::cutstr(0,1);?>','o'=>false,'a'=>'','b'=>''),39=>array('m'=>'{xheditor 0,1,2,3}','d'=>'echo xheditor::getEditorCode(\'1\', 2, 3, \'0\');','o'=>true,'a'=>'','b'=>''),40=>array('m'=>'{for 0 1}','d'=>'<?php for($i=0;$i<=1;$i++){?>','o'=>false,'a'=>'','b'=>''),41=>array('m'=>'{/for}','d'=>'<?php }?>','o'=>false,'a'=>'','b'=>''),42=>array('m'=>'{sql\\s+0}','d'=>'echo \'<?php
$query=$db->query("\'.trim(\'0\').\'");
$_sqlList=array();
while($line=$db->fetch_array($query))$_sqlList[]=$line;
foreach($_sqlList as $k=>$v){
?>\';','o'=>true,'a'=>'','b'=>''),43=>array('m'=>'{/sql}','d'=>'<?php }?>','o'=>false,'a'=>'','b'=>''),44=>array('m'=>'{plugin 0}','d'=>'<?php plugins::callName(\'0\');?>','o'=>false,'a'=>'','b'=>''),45=>array('m'=>'{r}','d'=>'<?php
if(!$web_rewrite)echo $weburl2.\'rewrite.php?rewrite=\';
?>','o'=>false,'a'=>'','b'=>''),46=>array('m'=>'{u}','d'=>'<?php echo $weburl2;?>','o'=>false,'a'=>'','b'=>''),47=>array('m'=>'{?}','d'=>'<?php echo $web_rewrite?\'?\':\'&\';?>','o'=>false,'a'=>'','b'=>''),48=>array('m'=>'{cache 0,1,2}','d'=>'<?php
if (cacheData::cacheStart(__FILE__, 0[,1?][,2?])){
?>','o'=>false,'a'=>'','b'=>''),49=>array('m'=>'{/cache}','d'=>'<?php
}
cacheData::cacheEnd(__FILE__);
?>','o'=>false,'a'=>'','b'=>''),50=>array('m'=>'{nocache}','d'=>'<?php
}
cacheData::nocacheStart(__FILE__);
?>','o'=>false,'a'=>'','b'=>''),51=>array('m'=>'{/nocache}','d'=>'<?php
if (cacheData::nocacheEnd(__FILE__)){
?>','o'=>false,'a'=>'','b'=>''),52=>array('m'=>'{cfg 0,1}','d'=>'<?php
echo cfg::get(\'0\', \'1\');
?>','o'=>false,'a'=>'','b'=>''),53=>array('m'=>'{date2 0}','d'=>'<?php echo 0>1?date(\'Y-m-d H:i:s\',0):\'\';?>','o'=>false,'a'=>'array(1=>\'0\')','b'=>''),54=>array('m'=>'{kefu_qq}','d'=>'123456789','o'=>false,'a'=>'','b'=>''));