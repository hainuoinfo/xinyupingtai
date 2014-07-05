<?php
$top_menu=array(
	'buyers1' => '淘宝买号管理',
	'buyers2' => '拍拍买号管理',
	'buyers3' => '有啊买号管理',
	'sellers1'   => '淘宝掌柜管理',
	'sellers2'   => '拍拍掌柜管理',
	'sellers3'   => '有啊掌柜管理',
);
if($edit=(int)$edit)$method='edit';
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$buyerStatus = array('正常', '危险', '挂起', '失效', '锁定', '暂停', '收藏', '删除');
$sellerStatus = array('未激活', '已经激活');
switch($method){
	case 'buyers1':
		$tbName = 'buyers';
		if ($stop = (int)$stop) {
			db::update('buyers', "status='2'", "id='$stop'");
			admin::show_message('挂起成功', $referer);
		}
		if ($unstop = (int)$unstop) {
			db::update('buyers', "status='0'", "id='$unstop'");
			admin::show_message('恢复挂起成功', $referer);
		}
		if ($lock = (int)$lock) {
			db::update('buyers', "status='4'", "id='$lock'");
			admin::show_message('锁定成功', $referer);
		}
		if ($unlock = (int)$unlock) {
			db::update('buyers', "status='0'", "id='$unlock'");
			admin::show_message('恢复锁定成功', $referer);
		}
		if ($undel = (int)$undel) {
			if ($buyer = db::one('buyers', '*', "id='$undel'")) {
				db::update('buyers', "status='0'", "id='$undel'");
				db::update('memberfields', 'buyers'.$buyer['type'].'=buyers'.$buyer['type'].'+1', "uid='$buyer[uid]'");
			}
			admin::show_message('恢复删除成功', $referer);
		}
		if (form::is_form_hash()) {
			$_POST && extract($_POST);
			if ($m == 'search') {
				$list = db::get_list($tbName, '*', "type='1' and nickname='$nickname'");
			} else {
				if ($del = $_POST['del']) {
					foreach ($del as $id) {
						if ($buyer = db::one($tbName, '*', "id='$id'")) {
							if ($buyer['tasking'] == 0) {
								db::del_id($tbName, $id);
								db::update('memberfields', $method.'='.$method.'-1', "uid='$buyer[uid]'");
							}
						}
					}
					admin::show_message('删除成功', $base_url.'&method='.$method);
				}
			}
		}
		if ($m != 'search') {
			if ($total = db::data_count($tbName, "type=1")) {
				$list = db::get_list2($tbName, '*', "type='1'", 'timestamp desc', $page, $pagesize);
				$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&page={page}', $pagestyle);
			}
		}
	break;
	case 'buyers2':
		$tbName = 'buyers';
		if ($stop = (int)$stop) {
			db::update('buyers', "status='2'", "id='$stop'");
			admin::show_message('挂起成功', $referer);
		}
		if ($unstop = (int)$unstop) {
			db::update('buyers', "status='0'", "id='$unstop'");
			admin::show_message('恢复挂起成功', $referer);
		}
		if ($lock = (int)$lock) {
			db::update('buyers', "status='4'", "id='$lock'");
			admin::show_message('锁定成功', $referer);
		}
		if ($unlock = (int)$unlock) {
			db::update('buyers', "status='0'", "id='$unlock'");
			admin::show_message('恢复锁定成功', $referer);
		}
		if ($undel = (int)$undel) {
			if ($buyer = db::one('buyers', '*', "id='$undel'")) {
				db::update('buyers', "status='0'", "id='$undel'");
				db::update('memberfields', 'buyers'.$buyer['type'].'=buyers'.$buyer['type'].'+1', "uid='$buyer[uid]'");
			}
			admin::show_message('恢复删除成功', $referer);
		}
		if (form::is_form_hash()) {
			$_POST && extract($_POST);
			if ($m == 'search') {
				$list = db::get_list($tbName, '*', "type='2' and nickname='$nickname'");
			} else {
				if ($del = $_POST['del']) {
					foreach ($del as $id) {
						if ($buyer = db::one($tbName, '*', "id='$id'")) {
							if ($buyer['tasking'] == 0) {
								db::del_id($tbName, $id);
								db::update('memberfields', $method.'='.$method.'-1', "uid='$buyer[uid]'");
							}
						}
					}
					admin::show_message('删除成功', $base_url.'&method='.$method);
				}
			}
		}
		if ($m != 'search') {
			if ($total = db::data_count($tbName, "type=2")) {
				$list = db::get_list2($tbName, '*', "type='2'", 'timestamp desc', $page, $pagesize);
				$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&page={page}', $pagestyle);
			}
		}
	break;
	case 'buyers3':
		$tbName = 'buyers';
		if ($stop = (int)$stop) {
			db::update('buyers', "status='2'", "id='$stop'");
			admin::show_message('挂起成功', $referer);
		}
		if ($unstop = (int)$unstop) {
			db::update('buyers', "status='0'", "id='$unstop'");
			admin::show_message('恢复挂起成功', $referer);
		}
		if ($lock = (int)$lock) {
			db::update('buyers', "status='4'", "id='$lock'");
			admin::show_message('锁定成功', $referer);
		}
		if ($unlock = (int)$unlock) {
			db::update('buyers', "status='0'", "id='$unlock'");
			admin::show_message('恢复锁定成功', $referer);
		}
		if ($undel = (int)$undel) {
			if ($buyer = db::one('buyers', '*', "id='$undel'")) {
				db::update('buyers', "status='0'", "id='$undel'");
				db::update('memberfields', 'buyers'.$buyer['type'].'=buyers'.$buyer['type'].'+1', "uid='$buyer[uid]'");
			}
			admin::show_message('恢复删除成功', $referer);
		}
		if (form::is_form_hash()) {
			$_POST && extract($_POST);
			if ($m == 'search') {
				$list = db::get_list($tbName, '*', "type='3' and nickname='$nickname'");
			} else {
				if ($del = $_POST['del']) {
					foreach ($del as $id) {
						if ($buyer = db::one($tbName, '*', "id='$id'")) {
							if ($buyer['tasking'] == 0) {
								db::del_id($tbName, $id);
								db::update('memberfields', $method.'='.$method.'-1', "uid='$buyer[uid]'");
							}
						}
					}
					admin::show_message('删除成功', $base_url.'&method='.$method);
				}
			}
		}
		if ($m != 'search') {
			if ($total = db::data_count($tbName, "type=3")) {
				$list = db::get_list2($tbName, '*', "type='3'", 'timestamp desc', $page, $pagesize);
				$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&page={page}', $pagestyle);
			}
		}
	break;
	case 'sellers1':
		$tbName = 'sellers';
		if (form::is_form_hash()) {
			$_POST && extract($_POST);
			if ($m == 'search') {
				$list = db::get_list($tbName, '*', "type='1' and nickname='$nickname'");
			} else {
				if ($del = $_POST['del']) {
					foreach ($del as $id) {
						if ($seller = db::one($tbName, '*', "id='$id'")) {
							if ($buyer['tasking'] == 0) {
								db::del_id($tbName, $id);
								db::update('memberfields', $method.'='.$method.'-1', "uid='$seller[uid]'");
							}
						}
					}
					admin::show_message('删除成功', $base_url.'&method='.$method);
				}
			}
		}
		if ($m != 'search') {
			if ($total = db::data_count($tbName, "type=1")) {
				$list = db::get_list2($tbName, '*', "type='1'", 'timestamp1 desc', $page, $pagesize);
				$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&page={page}', $pagestyle);
			}
		}
	break;
	case 'sellers2':
		$tbName = 'sellers';
		if (form::is_form_hash()) {
			$_POST && extract($_POST);
			if ($m == 'search') {
				$list = db::get_list($tbName, '*', "type='2' and nickname='$nickname'");
			} else {
				if ($del = $_POST['del']) {
					foreach ($del as $id) {
						if ($seller = db::one($tbName, '*', "id='$id'")) {
							if ($buyer['tasking'] == 0) {
								db::del_id($tbName, $id);
								db::update('memberfields', $method.'='.$method.'-1', "uid='$seller[uid]'");
							}
						}
					}
					admin::show_message('删除成功', $base_url.'&method='.$method);
				}
			}
		}
		if ($m != 'search') {
			if ($total = db::data_count($tbName, "type=2")) {
				$list = db::get_list2($tbName, '*', "type='2'", 'timestamp1 desc', $page, $pagesize);
				$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&page={page}', $pagestyle);
			}
		}
	break;
	case 'sellers3':
		$tbName = 'sellers';
		if (form::is_form_hash()) {
			$_POST && extract($_POST);
			if ($m == 'search') {
				$list = db::get_list($tbName, '*', "type='3' and nickname='$nickname'");
			} else {
				if ($del = $_POST['del']) {
					foreach ($del as $id) {
						if ($seller = db::one($tbName, '*', "id='$id'")) {
							if ($buyer['tasking'] == 0) {
								db::del_id($tbName, $id);
								db::update('memberfields', $method.'='.$method.'-1', "uid='$seller[uid]'");
							}
						}
					}
					admin::show_message('删除成功', $base_url.'&method='.$method);
				}
			}
		}
		if ($m != 'search') {
			if ($total = db::data_count($tbName, "type=3")) {
				$list = db::get_list2($tbName, '*', "type='3'", 'timestamp1 desc', $page, $pagesize);
				$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&page={page}', $pagestyle);
			}
		}
	break;
}
?>