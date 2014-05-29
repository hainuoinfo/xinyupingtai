<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
template::initialize('./templates/default/html/', './cache/default/html/');
switch ($operation) {
	case 'express':
		$bbsNav = array(
			array('name' => $web_name, 'url' => $weburl.'/'),
			array('name' => '快递单号')
		);
		$soft = array();
		if ($softId = cfg::getInt('call', 'express')) {
			$soft = db::one('softs', '*', "id='$softId'");
		}
		$title = $web_name.'快递单号生成器 云查询技术 '.$web_name.'vip免费用-'.$web_name.'信誉互动平台';
	break;
	case 'video':
		if ($id) {
			if ($video = db::one('cms_video', '*', "id='$id'")) {
				$list = array(
					array('title' => '视频总教室', 'url' => common::getUrl('/html/video/'))
				);
				foreach (db::select('cms_video_cate|cms_video:cid=id', '|id,title', "t0.ename='default'", 't1.editTime DESC') as $v) {
					$list[] = array(
						'title' => $v['title'],
						'url'   => common::getUrl('/html/video/?id='.$v['id'])
					);
				}
				$list = array_chunk($list, 7);
				$bbsNav = array(
			array('name' => $web_name, 'url' => $weburl.'/'),
			array('name' => $web_name2.'刷信誉视频教程', 'url' => common::getUrl('/html/video/')),
			array('name' => $video['title'])
		);
			} else error::_404();
		} else {
			$bbsNav = array(
			array('name' => $web_name, 'url' => $weburl.'/'),
			array('name' => $web_name2.'刷信誉视频教程', 'url' => common::getUrl('/html/video/'))
		);
			$list = db::select('cms_video_cate|cms_video:cid=id', '|*', "t0.ename='default'", 't1.editTime DESC');
			$list = array_chunk($list, 3);
		}
	break;
}
if (template::exists($operation)) include(template::load($operation));
?>