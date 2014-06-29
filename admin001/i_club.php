<?php
$top_menu=array(
	'list' => '门派列表',
	'view' => array('name' => '申述详情', 'isHide' => true)
);
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$cStatus = array('等待被申诉方解决问题或辩解', '申诉成功', '申诉失败', '撤销申诉', '等待申诉人撤诉', '申诉人坚持申诉');
switch($method){
	case 'list':
		if ($verify = (int)$verify) {
			task_club::verify($verify);
			admin::show_message('审核成功', $base_url);
		}
		if (form::is_form_hash()) {
			if ($del = $_POST['del']) {
				db::del_ids('club', $del);
				$ids = '\''.implode('\',\'', $del).'\'';
				db::update('memberfields', 'club=\'0\'', "club in($ids)");
				admin::show_message('删除成功');
			}
		}
		if ($total = db::data_count('club')) {
			$list = db::get_list('club', '*', '', 'status,timestamp desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&method='.$method.'&page={page}', $page_style);
		}
	break;
}
?>