<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
$top_menu=array(
	'index' => '积分等级'
);
if($edit=(int)$edit)$method='edit';
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
loadLib('member.credit');
switch($method){
	case 'index':
		if (form::is_form_hash()) {
			extract($_POST);
			$c = $credit;
			sort($c, SORT_NUMERIC);
			//array_multisort($c, SORT_DESC, SORT_NUMERIC);
			$levels = $c2 = array();
			foreach ($c as $k => $v) {
				$c2[array_search($v, $credit)] = $v;
			}
			$c = 0;
			foreach ($c2 as $k => $v) {
				$l = array();
				$l['title']  = $title[$k];
				$l['credit'] = $v;
				$l['icon']    = $icon[$k];
				$levels[] = $l;
			}
			if (member_credit::saveLevelScript($levels)) {
				admin::show_message('添加成功', $base_url);
			} else {
				admin::show_message('添加失败');
			}
		}
		$levels = member_credit::getLevelScript();
	break;
}
?>