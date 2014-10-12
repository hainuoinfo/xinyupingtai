<?php
class task_collect{
	private static $taskId = 1;
	public static function upCache(){
		global $db, $pre, $timestamp;
		$t = $timestamp - 30 * 60;
		$query = $db->query("select id,tid,bid from {$pre}task_collects where status='0' and timestamp1<$t");
		while ($line = $db->fetch_array($query)) {
			$db->query("update {$pre}task_collect set totalIng=totalIng-1 where id='$line[tid]'");
			$db->query("update {$pre}buyers set ing=ing-1 where id='$line[bid]'");
			$db->query("delete from {$pre}task_collects where id='$line[id]'");
		}
	}
	private static function checkStoreUrl($url){
		if (preg_match('/^http:\/\/([\w-]+)\.+(?:taobao|tmall)\.com\/$/', $url, $matches)) return $matches[1];
		return false;
	}
	private static function checkShopUrl($url){
		if (preg_match('/^(?:http:\/\/[\w-]+\.+(?:taobao|tmall)\.com\/item\.htm\?.*?id=(\d+))|(?:http:\/\/item\.(?:tmall|taobao)\.com\/mealDetail\.htm\?.*?id=(\d+))/i', $url, $matches)) return $matches[1] ? $matches[1] : $matches[2];
		return false;
	}
	private static function ignoreEmpty($arr){
		$rn = array();
		foreach($arr as $v){
			if ($v = trim($v)) {
				$rn[] = $v;
			}
		}
		return $rn;
	}
	private static function formatData(&$datas){
		
	}
	public static function add($datas, $uid){
		global $timestamp;
		$onePrice = 0.1;//每条价格(兔粮)
		if ($member = member_base::getMemberAll($uid)) {
			if ($seller = task_seller::getSeller2(self::$taskId, $datas['nickname'], $uid)) {
				
				if ($datas['ctype'] == 0) {
					$datas['url'] = $datas['shopurl'];
					if ($shopKey = self::checkStoreUrl($datas['url'])) {
						$info = data_taobaoShop::getStoreCollect($datas['url']);
						if ($info !== false && is_array($info)) {
							if ($info['nickname'] != $datas['nickname']) return '店铺掌柜与您所选掌柜不一致！';
						} else {
							return '获取店铺信息失败，请检查店铺地址是否正确';
						}
						$datas['curl'] = $info['url'];
					} else {
						return '商铺地址格式错误';
					}
				} elseif ($datas['ctype'] == 1) {
					$datas['url'] = $datas['itemurl'];
					if ($shopKey = self::checkShopUrl($datas['url'])) {
						$info = data_taobaoShop::getShopCollect($datas['url']);
						if ($info !== false && is_array($info)) {
							if ($info['nickname'] != $datas['nickname']) return '商品掌柜与您所选掌柜不一致！';
						} else {
							return '获取店铺信息失败，请检查店铺地址是否正确';
						}
						$datas['curl'] = $info['url'];
					} else {
						return '商品地址格式错误';
					}
				} else {
					return '参数错误';
				}
				$point = $datas['total'] * $onePrice;
				if ($point > $member['attach']['fabudian'.self::$taskId]) return '对不起， 您的兔粮不足';
				unset($datas['shopurl'], $datas['itemurl']);
				$datas = array_merge(array(
					'type'          => self::$taskId,
					'uid'           => $uid,
					'shopKey'       => $shopKey,
					'point'         => $point,
					'totalIng'      => 0,
					'totalComplate' => 0,
					'status'        => 1,
					'timestamp'     => $timestamp
				), $datas);
				if (db::insert2('task_collect', $datas)) {
					member_base::addFabudian($uid, -$point, self::$taskId, '发布收藏任务');
					return true;
				}
				return 'error';
			}
			return '掌柜不存在';
		}
		return 'user_not_exists';
	}
	public static function get($tid, $uid = 0){
		return db::one('task_collect', '*', "type='".self::$taskId."'".($uid?" and uid='$uid'":"")." and id='$tid'");
	}
	public static function resume($tid, $uid){
		if ($task = self::get($tid, $uid)) {
			if ($task['status'] == 0) {
				if (db::update('task_collect', array('status' => 1), "id='$tid'")) {
					return true;
				}
				return 'update_error';
			}
			return 'error';
		}
		return '不存在该任务';
	}
	public static function pause($tid, $uid){
		if ($task = self::get($tid, $uid)) {
			if ($task['status'] == 1) {
				if (db::update('task_collect', array('status' => 0), "id='$tid'")) {
					return true;
				}
				return 'update_error';
			}
			return 'error';
		}
		return '不存在该任务';
	}
}
?>