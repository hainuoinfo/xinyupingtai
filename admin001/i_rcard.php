<?php
$top_menu=array(
	'index' => '充值卡列表',
	'create'   => '生成充值卡'
);
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$tbName = 'log';
switch ($method) {
	case 'index':
		admin::getList('rcard', '*', '' ,'status,ctimestamp desc');
	break;
	case 'create':
		if (form::is_form_hash()) {
			$datas = form::get(array('money', 'int'), array('count', 'int'));
			$datas && extract($datas);
			if ($money && $count) {
				$card = new payfor_card();
				$count = $card->createCard($money, $count);
				admin::show_message('成功生成了'.$count.'张面值'.$money.'元的充值卡', $base_url);
			} else admin::show_message('参数错误');
		}
	break;
}
?>