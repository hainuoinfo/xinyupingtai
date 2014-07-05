<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
//if (!$memberLogined) exit('');
$rs = array(
	'status' => false,
	'msg'    => '未知错误'
);
if ($memberLogined) {
	switch($action){
		case 'data':
			switch($operation){
				case 'taobao':
					switch ($method) {
						case 'price':
							if ($sid) {
								if ($price = data_taobaoShop::getPrice($sid)) {
									$rs['status'] = true;
									$rs['price']  = $price;
								} else {
									$rs['msg'] = '获取失败！';
								}
							} else $rs['msg'] = '参数错误！';
						break;
					}
				break;
			}
		break;
	}
} else $rs['msg'] = '请先登录！';
echo json_encode($rs);
?>