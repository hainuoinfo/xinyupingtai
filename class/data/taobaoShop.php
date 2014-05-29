<?php
!defined('IN_JB') && exit('error');
loadLib($libP.'taobaoBase');
class data_taobaoShop extends data_taobaoBase {
	public static function getShop($num_iid){
		if ($rs = common::getCache('taobao_shop_'.$num_iid)) return $rs;
		$args = array(
			'method' => 'taobao.item.get',
			'num_iid'=>$num_iid,
			'fields'=>'detail_url,num_iid,title,nick,price'
		);
		if(($rs = parent::get($args)) && $rs['item']){
			common::setCache('taobao_shop_'.$num_iid, $rs['item']);
			return $rs['item'];
		} else {
			return false;
		}
	}
	public static function getNick($num_iid){
		if (parent::$useApi) {
			if (($rs = self::getShop($num_iid)) && $rs['nick']) {
				return $rs['nick'];
			} else {
				return false;
			}
		} else {
			//用网页读取
			$shopUrl = parent::getShopUrl($num_iid);
			if ($html = winsock::get_html($shopUrl)) {
				if(preg_match('/nickName:\s*\'(.+?)\'/', $html, $matches)){//匹配昵称
					return urldecode($matches[1]);
				}
			} else {
				return false;
			}
		}
	}
	public static function getPrice($num_iid){
		if (($rs = self::getShop($num_iid)) && $rs['price']) {
			return $rs['price'];
		} else {
			return false;
		}
	}
	public static function getTitle($num_iid){
		if (($rs = self::getShop($num_iid)) && $rs['title']) {
			return $rs['title'];
		} else {
			return false;
		}
	}
	public static function exists($num_iid){
		if (($rs = self::getShop($num_iid)) && $rs['title']) {
			return true;
		} else {
			return false;
		}
	}
	public static function getShop2($url){
		$cacheId = md5($url);
		if ($rs = common::getCache('taobao_shop2_'.$cacheId)) return $rs;
		if ($html = winsock::get_html($url)) {
			if (preg_match('/<input type="hidden" name="title" value="(.+?)" \/>/', $html, $matches)) {
				$title = $matches[1];
				if (preg_match('/"apiItemViews": "(.+?)"/', $html, $matches)) {
					$url = $matches[1];
					$sign = substr($url, -32);
					$datas = array('title' => $title, 'sign' => $sign);
					common::setCache('taobao_shop2_'.$cacheId, $datas);
					return $datas;
				}
			}
		}
		return false;
	}
	public static function getStoreCollect($url){
		$cacheId = md5($url);
		if ($rs = common::getCache('taobao_storeCollect_'.$cacheId)) return $rs;
		if ($html = winsock::get_html($url)) {
			if(preg_match('/nickName:\s*\'(.+?)\'/', $html, $matches)){//匹配昵称
				$nickName = urldecode($matches[1]);
				if (preg_match('/<a\s*id="xshop_collection_href"[^>]*href="(.+?)"[^>]*>/', $html, $matches)) {
					$url = $matches[1];
					$sp = explode('?', $url);
					//array_shift($sp);
					$url = $sp[1];
					return array('nickname' => $nickName, 'url' => $url);
				}
			}
		}
		return false;
	}
	public static function getShopCollect($url){
		$cacheId = md5($url);
		if ($rs = common::getCache('taobao_storeCollect_'.$cacheId)) return $rs;
		if ($html = winsock::get_html($url)) {
			if(preg_match('/nickName:\s*\'(.+?)\'/', $html, $matches)){//匹配昵称
				$nickName = urldecode($matches[1]);
				if (preg_match('/<div class="collection-btn">\s*<a[^>]*href="(.+?)"[^>]*>\s*<span class="collection-title"><s class="ico-item"><\/s>收藏宝贝<\/span>.*?<\/a>/s', $html, $matches)) {
					$url = $matches[1];
					$sp = explode('?', $url);
					//array_shift($sp);
					$url = $sp[1];
					return array('nickname' => $nickName, 'url' => $url);
				}
			}
		}
		return false;
	}
}
?>