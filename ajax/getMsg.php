<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
$rs = array();
if ($memberLogined) {
	$tps = array('list', 'setRead');
	(!empty($type) && in_array($type, $tps)) || $type = $tps[0];
	if ($type == 'list') {
		$rs['status'] = true;
		$total = db::data_count('msg', "to_uid='$uid' AND `read`='0'");
		$rs['allTotal'] = $total;
		if ($total > 0) {
			$list = array();
			foreach (db::select('msg', 'id,title,message,timestamp', "to_uid='$uid' AND `read`='0'", 'timestamp DESC', $pagesize, $page) as $v) {
				$v['date'] = date('Y-m-d H:i:s', $v['timestamp']);
				unset($v['timestamp']);
				$list[] = $v;
			}
			$rs['list'] = $list;
			$rs['page'] = $page;
			$rs['pagesize'] = $pagesize;
			$rs['nextPage'] = $page + 1;
			$rs['total'] = count($rs['list']);
		}
	} else {
		if ($id) {
			$item = db::one('msg', 'id,type', "id='$id'");
			if ($item) {
				if (msg::setRead($id, $item['type']) == 1) {
					$rs['status'] = true;
					$rs['total'] = db::data_count('msg', "to_uid='$uid' AND `read`='0'");
				} else {
					$rs = array(
						'status' => false,
						'msg'    => '非法操作！'
					);
				}
			} else {
				$rs = array(
					'status' => false,
					'msg'    => '非法操作！'
				);
			}
		} else {
			$rs = array(
				'status' => false,
				'msg'    => '参数错误！'
			);
		}
	}
} else {
	$rs = array(
		'status' => false,
		'msg'    => '请先登录',
	);
}
echo string::json_encode($rs);
?>