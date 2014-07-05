<?php
class data_paipai{
	public static function sellerExists($qq){
		if (is_numeric($qq)) {
			if ($rs = winsock::getHead('http://shop.paipai.com/'.$qq)) {
				if ($rs['info']['statusNum'] == 200) return true;
			}
		}
		return false;
	}
	public static function getUser($qq){
		//http://ext.paipai.com/uinfo/info?userid=$qq
		$rs = array();
		if ($html = winsock::get_html('http://ext.paipai.com/uinfo/info?userid='.$qq)) {
			//$html = string::dg_string2($html, 'div', '<div class="usr_base ">');
			//echo $html;
			if (preg_match('/<script[^>]*>\s*PP.mini.option\s*=\s*(\{.*?\}).*?<\/script>/s', $html, $matches)) {
				$html = $matches[1];
				$arr = string::json_decode($html);
				if ($arr['uin'] == $qq) {
					$rs['buyer_credit']['score'] = $arr['BuyerCredit'];
					$rs['seller_credit']['score'] = $arr['SellerCredit'];
					$rs['mobilephone_type'] = substr($arr['Property'], 0, 1) == '1'?'authentication':'not authentication';
					$rs['promoted_type'] = substr($arr['Property'], 1, 1).substr($arr['Property'], 3, 1).substr($arr['Property'], 24, 1) != '000'?'authentication':'not authentication';
				}
			}
		}
		return $rs;
	}
	public static function getShop($url){
		$rs = array();
		if ($html = winsock::get_html($url)) {
			if (preg_match('/<script[^>]*>\s*var\spageMess\s*=\s*(\{.+?\});\s*<\/script>/s', $html, $matches)) {
				$html = $matches[1];
				$arr = string::json_decode($html);
				$rs = array(
					'nickName' => $arr['qqUin'],
					'itemid'   => $arr['commodityId'],
					'price'    => common::formatMoney($arr['commodityPrice']),
					'title'    => $arr['commodityTitle']
				);
			}
		}
		return $rs;
	}
}
?>