<?php
$base_list=array(
	'save_path_base'=>array('基本缓存目录','以“./”开头“./”代表网站根目录','./cache/'),
	'save_path_html'=>array('HTML缓存目录','以“./”开头“./”代表网站根目录','./cache/html/'),
	'save_path_article'=>array('内容页缓存目录','以“./”开头“./”代表网站根目录','./cache/html/article/'),
	'user_avatar_path'=>array('用户头像保存目录','以“./”开头“./”代表网站根目录','./images/avatars/'),
	'user_avatar_width'=>array('用户头像宽度','','48'),
	'user_avatar_height'=>array('用户头像高度','','48'),
	'web_rewrite'=>array(array('name'=>'开启地址重写','type'=>'radio','values'=>array('是'=>1,'否'=>0),'default'=>0),'优化地址，强化百度收录'),
	'web_rewrite_rule'=>array(array('name'=>'伪静态规则','type'=>'textarea','style'=>'width:650px;height:200px')),
	'web_name'=>array('网站名称'),
	'web_name2'=>array('网站别称'),
	'web_title'=>array('网站标题'),
	'web_keywords'=>array(array('name'=>'关键词','type'=>'textarea')),
	'web_description'=>array(array('name'=>'描述','type'=>'textarea')),
	'web_logo'=>array('网站LOGO地址'),
	'web_watermark'=>array(array('name'=>'开启水印','type'=>'radio','values'=>array('是'=>1,'否'=>0),'default'=>0)),
	'web_watermark_img'=>array('水印图片','要添加的水印图片'),
	'web_watermark_position'=>array(array('name'=>'水印位置','type'=>'radio','values'=>array(
		'#1'=>1,'#2'=>2,'#3'=>3,'br',
		'#4'=>4,'#5'=>5,'#6'=>6,'br',
		'#7'=>7,'#8'=>8,'#9'=>9
	),'default'=>9)),
	'web_icp'=>array('网站备案号'),
	'web_tip_post'=>array('禁止发布信息提示','当禁止发布信息的时候提示','网站维护中...'),
	'web_statcode'=>array(array('name'=>'网站统计代码','type'=>'textarea')),
	'web_post'=>array(array('name'=>'允许发布信息','type'=>'radio','values'=>array('是'=>1,'否'=>0),'default'=>1)),
	'sys_update'=>array('网站升级维护')
);
if(form::is_form_hash()){
	$base_list_keys=array_keys($base_list);
	$base || $base=array();
	$save=true;
	foreach($base_list_keys as $k){
		$v=$_POST[$k];
		$v && $v=stripslashes($v);
		$base[$k]=$v;
	}
	if($save){
		if($base['web_rewrite']){
			file::unback(d('./.htaccess'),d('./httpd.ini'));
		} else {
			file::back(d('./.htaccess'),d('./httpd.ini'));
		}
		//
		common::create_folder(d($base['tuan_path_image']));
		common::create_folder(d($base['tuan_path_image']).'source/');
		common::create_folder(d($base['tuan_path_image']).'head/');
		common::create_folder(d($base['tuan_path_image']).'ico/');
		//
		$rewrite_rule=$base['web_rewrite_rule'];
		$rewrite_list=array();
		$sp=explode("\r\n",$rewrite_rule);
		foreach($sp as $v){
			if($v=trim($v)){
				//$sp2=explode(' ',$v);
				$sp2=preg_split('/\s+/',$v);
				//$sp2[0]='/^'.addcslashes($sp2[0],'/[]{}.+^$\\').'$/';
				$sp2[0]='/^'.$sp2[0].'$/';
				$rewrite_list[]=$sp2;
			}
		}
		cache::write_array('rewrite',$rewrite_list);
		cache::write_array('base',$base);
		admin::show_message('设置成功');
	}
}
?>