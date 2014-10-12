<?php
class task_flow{
	private static $taskId = 1;
	public static function upCache(){
		global $today_start, $db, $pre, $timestamp;
		//更新每天缓存
		$cachePrefix = 'task_flow_cache_update_';
		//更新积分排名 一周排行
		$t = $today_start;
		$cacheName = $cachePrefix.'taobao';
		$arr = cache::get_array($cacheName, true);
		if (!$arr || $arr['lasttime'] != $t) $update = true;
		else $update = false;
		if ($update) {
			$loak = new lock(1, 300, false, 0, __FILE__);
			if (!$lock->islock) {
				db::query("delete from {$pre}flow_cache");
				cache::write_array($cacheName, array('lasttime' => $t));
			}
		}
		//更新定时发布的任务
		$query = $db->query("select id from {$pre}task_flow where status='0' and isPlan='1' and planDate<$timestamp");
		while ($tid = $db->fetch_array_first($query)) {
			$db->query("update {$pre}task_flow set status='1',isPlan='0',planDate='0' where id='$tid'");
		}
	}
	public static function checkUrl($url){
		if (preg_match('/^http:\/\/(?:[\w-]+\.)+(?:(?:taobao)|(?:tmall))\.com\/item\.htm\?(?:item_)?(?:num_)?id=(\d+).*$/i', $url, $matches)) return $matches[1];
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
		$datas['itemurl'] = self::ignoreEmpty($datas['itemurl']);
		$datas['flow']    = self::ignoreEmpty($datas['flow']);
		$datas['isIp']    = $datas['isIp']?1:0;
		$datas['isPlan']  = $datas['isPlan']?1:0;
		if ($datas['isPlan']) {
			$datas['planDate'] = time::get_general_timestamp($datas['planDate']);
			if ($datas['planDate'] == 0) $datas['isPlan'] = 0;
		} else $datas['planDate'] = 0;
	}
	public static function add($datas, $uid){
		global $timestamp;
		if ($member = member_base::getMemberAll($uid)) {
			if ($member['attach']['vip']) $maxCount = 20;
			elseif ($member['attach']['vip2']) $maxCount = 10;
			else $maxCount = 5;
			self::formatData($datas);
			if (($count = form::array_equal($datas['itemurl'], $datas['flow'])) !== false) {
				if ($count <= $maxCount) {
					$flow = array_sum($datas['flow']);
					if ($flow <= $member['attach']['liuliang']) {
						$urls  = $datas['itemurl'];
						$flows = $datas['flow'];
						$shops = $ids = array();
						foreach ($urls as $url){
							if ($itemid = self::checkUrl($url)) {
								$ids[] = $itemid;
							} else {
								return '商品网址格式错误';
							}
						}
						foreach ($urls as $k => $url) {
							$shop = data_taobaoShop::getShop2($url);
							if ($shop === false) {
								return '第'.($k + 1).'个商品不存在';
							}
							$shops[] = $shop;
						}
						$minute = $datas['minute'];
						$t0 = $minute * 60;
						$t = 0;
						unset($datas['itemurl'], $datas['flow'], $datas['minute']);
						foreach ($urls as $k => $url) {
							$t += $t0;
							$datas['type']      = self::$taskId;
							$datas['uid']       = $uid;
							$datas['itemid']    = $ids[$k];
							$datas['title']     = $shops[$k]['title'];
							$datas['itemurl']   = $url;
							$datas['sign']      = $shops[$k]['sign'];
							$datas['flowAll']   = $flows[$k];
							$datas['flowLock']  = 0;
							$datas['flowTotal'] = $flows[$k];
							$datas['timestamp'] = $timestamp;
							$datas['status']    = $datas['isPlan']?0:1;
							if ($datas['isPlan']) $datas['planDate'] += $t;
							db::insert2('task_flow', $datas);
						}
						db::update('memberfields', 'liuliang=liuliang-'.$flow, "uid='$uid'");
						return true;
					}
					return '流量兔粮不足';
				}
				return '发布任务数量超过'.$maxCount.'条';
			}
			return 'error';
		}
		return 'user_not_exists';
	}
	public static function get($tid, $uid = 0){
		return db::one('task_flow', '*', "type='".self::$taskId."'".($uid?" and uid='$uid'":"")." and id='$tid'");
	}
	public static function resume($tid, $uid){
		if ($task = self::get($tid, $uid)) {
			if ($task['status'] == 0) {
				if (db::update('task_flow', array('isPlan' => 0, 'planDate' => 0, 'status' => 1), "id='$tid'")) {
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
				if (db::update('task_flow', array('status' => 0), "id='$tid'")) {
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