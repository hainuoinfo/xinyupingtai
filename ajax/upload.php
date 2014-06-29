<?php
include('../class/index.php');
common::char_set();
switch ($action) {
	case 'image':
		if ($cookie['founder_login']) {
			$upload = new upload();
			$rs = $upload->toupload('filedata', 'image');
			$path = 'img/bbs/'.date('Y/m/', $timestamp);
			$path2 = d('./'.$path);
			if ($rs['count'] == 1) {
				!file_exists($path2) && common::create_folder($path2);
				if ($rs = $upload->move2($rs['info']['filedata']['db_id'], $path2)) {
					$pathinfo = pathinfo($rs['source']);
					$filename = $pathinfo['basename'];
					$pic = $weburl2.$path.$filename;
				}
			}
			$rs = array();
			$rs['err'] = '';
			$rs['msg'] = array(
				'url'=>$pic,
				'localfile'=>$filename
			);
		} else {
			$rs = array('err' => '请先登陆');
		}
		echo string::json_encode($rs);
	break;
	case 'userImage':
		if ($memberLogined || $cookie['founder_login']) {
			$upload = new upload();
			$rs = $upload->toupload('filedata', 'image');
			$path = 'img/user/'.date('Y/m/', $timestamp);
			$path2 = d('./'.$path);
			if ($rs['count'] == 1) {
				!file_exists($path2) && common::create_folder($path2);
				if ($rs = $upload->move2($rs['info']['filedata']['db_id'], $path2)) {
					$pathinfo = pathinfo($rs['source']);
					$filename = $pathinfo['basename'];
					$pic = $weburl2.$path.$filename;
				}
			}
			$rs = array();
			$rs['err'] = '';
			$rs['msg'] = array(
				'url'=>$pic,
				'localfile'=>$filename
			);
			echo string::json_encode($rs);
		} else {
			echo '登录超时，请重新登陆后再操作';
		}
	break;
}
?>