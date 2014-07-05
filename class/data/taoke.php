<?php
!defined('IN_JB') && exit('error');
class data_taoke extends data_taobaoBase {
	public static function exists($num_iid){
		$args = array(
			'method'   => 'taobao.taobaoke.items.detail.get',
			'fields'   => 'num_iid,nick,price,click_url',//'num_iid,nick,price,click_url,shop_click_url,seller_credit_score'
			'num_iids' => $num_iid,
			'nick'     => 'ljazxxybbx'
		);
		if ($rs = parent::get($args)) {
			if ($rs['total_results'] == 1) {
				if ($rs['taobaoke_item_details']['taobaoke_item_detail']['click_url']) return true;
			}
		}
		return false;
	}
}
?>