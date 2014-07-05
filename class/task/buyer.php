<?php
class task_buyer{
	private static $cachePrefix = 'task_buyer_cache_update_';
	public static function updateCache(){
		self::upCache1();
		self::upCache2();
	}
	private static function upCache1(){
		global $today_start;
		$t = $today_start;
		$cacheName = self::$cachePrefix.'task1';
		$arr = cache::get_array($cacheName, true);
		if (!$arr || $arr['lasttime'] != $t) $update = true;
		else $update = false;
		if ($update) {
			$loak = new lock(1, 30, false, 0, __FILE__);
			if (!$lock->islock) {
				db::update('buyers', 'status=0', 'status in(1,2)');
				db::update('buyers', 'todayTask=0');
				cache::write_array($cacheName, array('lasttime' => $t));
			}
		}
	}
	private static function upCache2(){
		global $tswkStart;
		$t = $tswkStart;
		$cacheName = self::$cachePrefix.'task2';
		$arr = cache::get_array($cacheName, true);
		if (!$arr || $arr['lasttime'] != $t) $update = true;
		else $update = false;
		if ($update) {
			$loak = new lock(2, 30, false, 0, __FILE__);
			if (!$lock->islock) {
				db::update('buyers', 'tswkTask=0');
				cache::write_array($cacheName, array('lasttime' => $t));
			}
		}
	}
	public static function tie($uid, $type, $nickname,$isreal=0){
		global $timestamp;
		$username = member_base::getUsername($uid);//现获取当前登陆用户
		if ($username) {
			if ($nickname = trim($nickname)) {
				if (!db::exists('buyers', array('type' => $type, 'nickname' => $nickname))) {
					//$func = 'getMember'.$type;
					//$member = self::$func($nickname);
                    //var_dump($member);exit;
					if (1 == 1) {
					    $score = data_taobaoUser::credit($nickname);
						//$score = $member['buyer_credit']['score'];
						$utype = 0;
						$maxScore = 0;
						if ($isreal==1) {//支付包认证
							$maxScore = 50000;
							$utype |= 1;
							}
						if ($isreal==3) {//3是手机认证
							$maxScore = 50000;
							$utype |= 2;
							}
						if($isreal==2) $isreal=0;
						if ($maxScore == 0) 
							$maxScore = $score + rand(40, 800);
						$datas = array(
							'type'      => $type,
							'uid'       => $uid,
							'username'  => $username,
							'nickname'  => $nickname,
							'password'  => '',
							'isreal'    => $isreal,
							'score0'    => $score,
							'score'     => $score,
							'maxScore'  => $maxScore,
							'utype'     => $utype,
							'status'    => 0,
							'timestamp' => $timestamp,
							'express'   => 0
						);
						if (db::insert('buyers', $datas)) {
							db::update('memberfields', 'buyers'.$type.'=buyers'.$type.'+1', "uid='$uid'");
							return true;
						}
						return 'error';
					}
					return language::get('qu'.$type).'平台上没有发现该用户';
				}
				return '该小号已经被绑定了';
			}
			return 'data_error';
		}
		return 'user_not_exists';
	}
	public static function getMember1($nickname){
		return data_taobaoUser::getUser($nickname);
	}
	public static function getMember2($nickname){
		return data_paipai::getUser($nickname);
	}
	public static function updateScore($id, $uid){
		global $timestamp;
		if ($buyer = self::getBuyer($id, $uid)) {
			if ($timestamp - $buyer['updateTimestamp'] > 15 * 60) {
				$func = 'getMember'.$buyer['type'];
				$member = self::$func($buyer['nickname']);
				if ($member) {
					$score = $member['buyer_credit']['score'];
					db::update('buyers', array('score' => $score, 'updateTimestamp' => $timestamp), "id='$id'");
					return '更新成功，'.$buyer['nickname'].'的最新信誉为：'.$score;
				}
				return '更新失败';
			}
			return '对不起，为了您的账户安全，每次更新必须间隔为15分钟';
		}
		return '不存在该买号';
	}
	public static function setPwd($id, $uid, $pwd){
		if ($buyer = self::getBuyer($id, $uid)) {
			db::update('buyers', array('password' => $pwd), "id='$id'");
			return true;
		}
		return '不存在该买号';
	}
	public static function pause($id, $uid){
		global $timestamp;
		if ($buyer = self::getBuyer($id, $uid)) {
			if ($buyer['status'] <= 1) {
				db::update('buyers', array('status' => 5, 'pauseTimestamp' => $timestamp), "id='$id'");
				return true;
			}
			return '错误';
		}
		return '不存在该买号';
	}
	public static function resume($id, $uid){
		global $timestamp;
		if ($buyer = self::getBuyer($id, $uid)) {
			if ($buyer['status'] == 5) {
				$t = $timestamp - $buyer['pauseTimestamp'];
				$add = 0;
				if ($buyer['score'] < 350 && $t > 86400 * 3) {
					$day = $t / 86400;
					$add = floor($day * 10);
					$add *= rand(1, 20);
				}
				db::update('buyers', "status='0'".($add > 0?",maxScore=maxScore+$add":''), "id='$id'");
				return true;
			}
			return '错误';
		}
		return '不存在该买号';
	}
	public static function resumeMore($ids, $uid){
		$sp = explode(',', $ids);
		$ids = $rs = array();
		foreach ($sp as $v) {
			if (($v = trim($v)) && is_numeric($v)) $ids[] = $v;
		}
		if ($ids) {
			foreach ($ids as $id) $rs[$id] = self::resume($id, $uid);
		}
		return $rs;
	}
	public static function del($id, $uid){
		global $timestamp;
		if ($buyer = self::getBuyer($id, $uid)) {
			if ($buyer['tasking'] == 0) {
				//db::update('buyers', array('status'=>7,'type'=>0), "id='$id'");
				db::delete('buyers',"id='$id'");
				db::update('memberfields', 'buyers'.$buyer['type'].'=buyers'.$buyer['type'].'-1', "uid='$buyer[uid]'");
				return '删除成功';
			}
			return '该小号目前还有任务没有完成，请完成后再删除';
		}
		return '不存在该买号';
	}
	public static function setCollect($id, $uid){
		global $timestamp;
		if ($buyer = self::getBuyer($id, $uid)) {
			if ($buyer['password'] !='') {
				db::update('buyers', array('status' => 6, 'runTimestamp' => $timestamp), "id='$id'");
				return true;
			}
			return '错误';
		}
		return '不存在该买号';
	}
	public static function cancelCollect($id, $uid){
		global $timestamp;
		if ($buyer = self::getBuyer($id, $uid)) {
			if ($buyer['status'] == 6) {
				if ($buyer['ing'] == 0) {
					db::update('buyers', array('status' => 0, 'runTimestamp' => $timestamp), "id='$id'");
					return true;
				}
				return '当前买号有任务没有完成，不能取消！';
			}
			return '错误';
		}
		return '不存在该买号';
	}
	public static function activeCollect($id, $uid){
		global $timestamp;
		if ($buyer = self::getBuyer($id, $uid)) {
			if (db::data_count('buyers', "type='$buyer[type]' and uid='$uid' and status='6' and cStatus='1'") == 0) {
				if ($buyer['status'] == 6) {
					if ($buyer['cStatus'] == 0) {
						db::update('buyers', array('cStatus' => 1, 'runTimestamp' => $timestamp, 'msg' => ''), "id='$id'");
						return true;
					}
					return '收藏买号已经激活过了';
				}
				return '错误';
			}
			return '对不起，收藏买号只能设置一个';
		}
		return '不存在该买号';
	}
	public static function frostCollect($id, $uid, $msg = ''){
		global $timestamp;
		if ($buyer = self::getBuyer($id, $uid)) {
			if ($buyer['status'] == 6) {
				if ($buyer['cStatus'] == 1) {
					db::update('buyers', array('cStatus' => 0, 'runTimestamp' => $timestamp, 'msg' => $msg), "id='$id'");
					return true;
				}
				return '收藏买号还未激活';
			}
			return '错误';
		}
		return '不存在该买号';
	}
	public static function total($type, $status){
		return db::data_count('buyers', "type='$type'".($status>=0?" and status='$status'":''));
	}
	public static function total1($uid,$type){
		return db::data_count('buyers', "uid='$uid' and type='$type' and status<7");
	}
	public static function getList($type, $uid, $status = 0, $spage = 0, $spagesyze = 0) {
		global $page, $pagesize;
		$spage     || $spage     = $page;
		$spagesize || $spagesize = $pagesize;
		$where = "type='$type' and uid='$uid'";
		if ($status >= 0) $where .= " and status='$status'";
		if ($list = db::get_list2('buyers', '*', $where, 'status,timestamp desc', $spage, $spagesize)) {
			$icoFunc = 'getIco'.$type;
			foreach ($list as $k => $v) {
				$v['score0_ico'] = self::$icoFunc($v['score0']);
				$v['score_ico']  = self::$icoFunc($v['score']);
				$list[$k] = $v;
			}
			return $list;
		}
	}
	public static function getList1($type, $uid, $status = 0, $spage = 0, $spagesyze = 0) {
		global $page, $pagesize;
		$spage     || $spage     = $page;
		$spagesize || $spagesize = $pagesize;
		$where = "type='$type' and uid='$uid' and status<7";
		if ($list = db::get_list2('buyers', '*', $where, 'status,timestamp desc', $spage, $spagesize)) {
			$icoFunc = 'getIco'.$type;
			foreach ($list as $k => $v) {
				$v['score0_ico'] = self::$icoFunc($v['score0']);
				$v['score_ico']  = self::$icoFunc($v['score']);
				$list[$k] = $v;
			}
			return $list;
		}
	}
	public static function getBuyer($id, $uid) {
		return db::one('buyers', '*', "uid='$uid' and id='$id'");
	}
	public static function get($id) {
		return db::one('buyers', '*', "id='$id'");
	}
	public static function getFull($id) {
		global $timestamp, $today_start, $today_end;
		if ($rs = db::one('buyers', '*', "id='$id'")) {
			$t1 = $today_start;
			$t2 = $today_end;
			$rs['todayTask'] = db::data_count('task', "bid='$rs[id]' and btimestamp>='$t1' and btimestamp<='$t2'");
			$t1 = $timestamp - 7 * 86400;
			$t2 = $timestamp;
			$rs['tswkTask']  = db::data_count('task', "bid='$rs[id]' and btimestamp>='$t1' and btimestamp<='$t2'");
			$t1 = $timestamp - 30 * 86400;
			$t2 = $timestamp;
			$rs['tsmTask']   = db::data_count('task', "bid='$rs[id]' and btimestamp>='$t1' and btimestamp<='$t2'");
			$t1 = $timestamp - 178 * 86400;
			$t2 = $timestamp;
			$rs['tsyTask']   = db::data_count('task', "bid='$rs[id]' and btimestamp>='$t1' and btimestamp<='$t2'");
			return $rs;
		}
		return false;
	}
	public static function getCBuyer($type, $uid){
		return db::one('buyers', '*', "type='$type' and uid='$uid' and status='6' and cStatus='1'");
	}
	public static function getLevel1($score){
		if ($score < 11)           $level = 0;
		elseif ($score < 41)       $level = 1;
		elseif ($score < 91)       $level = 2;
		elseif ($score < 151)      $level = 3;
		elseif ($score < 251)      $level = 4;
		
		elseif ($score < 501)      $level = 10;
		elseif ($score < 1001)     $level = 11;
		elseif ($score < 2001)     $level = 12;
		elseif ($score < 5001)     $level = 13;
		elseif ($score < 10001)    $level = 14;
		
		elseif ($score < 20001)    $level = 20;
		elseif ($score < 50001)    $level = 21;
		elseif ($score < 100001)   $level = 22;
		elseif ($score < 200001)   $level = 23;
		elseif ($score < 500001)   $level = 24;
		
		elseif ($score < 1000001)  $level = 30;
		elseif ($score < 2000001)  $level = 31;
		elseif ($score < 5000001)  $level = 32;
		elseif ($score < 10000001) $level = 33;
		else                       $level = 34;
		return $level;
	}
	public static function getLevel2($score){
		if ($score < 5)            $level = 0;
		elseif ($score < 11)       $level = 1;
		elseif ($score < 21)       $level = 2;
		elseif ($score < 41)       $level = 3;
		elseif ($score < 101)      $level = 4;
		
		elseif ($score < 301)      $level = 10;
		elseif ($score < 1001)     $level = 11;
		elseif ($score < 3001)     $level = 12;
		elseif ($score < 5001)     $level = 13;
		elseif ($score < 10001)    $level = 14;
		
		elseif ($score < 20001)    $level = 20;
		elseif ($score < 50001)    $level = 21;
		elseif ($score < 100001)   $level = 22;
		elseif ($score < 200001)   $level = 23;
		elseif ($score < 500001)   $level = 24;
		
		elseif ($score < 1000001)  $level = 30;
		elseif ($score < 2000001)  $level = 31;
		elseif ($score < 5000001)  $level = 32;
		elseif ($score < 10000001) $level = 33;
		else                       $level = 34;
		return $level;
	}
	public static function getIco1($score){
		global $weburl2;
		$img = '';
		if ($score >= 4) {
			/*
4-10
11-40
41-90
91-150
151-250

251-500
501-1000
1001-2000
2001-5000
5001-10000

10001-20000
20001-50000
50001-100000
100001-200000
200001-500000

500001-1000000
1000001-2000000
2000001-5000000
5000001-10000000
10000001
*/
			if ($score < 11)           $img = 'b_red_1.gif';
			elseif ($score < 41)       $img = 'b_red_2.gif';
			elseif ($score < 91)       $img = 'b_red_3.gif';
			elseif ($score < 151)      $img = 'b_red_4.gif';
			elseif ($score < 251)      $img = 'b_red_5.gif';
			
			elseif ($score < 501)      $img = 'b_blue_1.gif';
			elseif ($score < 1001)     $img = 'b_blue_2.gif';
			elseif ($score < 2001)     $img = 'b_blue_3.gif';
			elseif ($score < 5001)     $img = 'b_blue_4.gif';
			elseif ($score < 10001)    $img = 'b_blue_5.gif';
			
			elseif ($score < 20001)    $img = 'b_cap_1.gif';
			elseif ($score < 50001)    $img = 'b_cap_2.gif';
			elseif ($score < 100001)   $img = 'b_cap_3.gif';
			elseif ($score < 200001)   $img = 'b_cap_4.gif';
			elseif ($score < 500001)   $img = 'b_cap_5.gif';
			
			elseif ($score < 1000001)  $img = 'b_crown_1.gif';
			elseif ($score < 2000001)  $img = 'b_crown_2.gif';
			elseif ($score < 5000001)  $img = 'b_crown_3.gif';
			elseif ($score < 10000001) $img = 'b_crown_4.gif';
			else                       $img = 'b_crown_5.gif';
		}
		if ($img) return '<img src="'.$weburl2.'images/lvl/tao/'.$img.'" title="分值：'.$score.'" />';
	}
	public static function getIco2($score){
		global $weburl2;
		$img = '';
		$level = 0;
		if ($score > 0) {
			/*
1-4
5-10
11-20
21-40
41-100

101-300
301-1000
1001-3000
3001-5000
5001-10000

10001-20000
20001-50000
50001-100000
100001-200000
200001-500000
500001-1000000

1000001-2000000
2000001-5000000
5000001-10000000
10000001
*/
			if ($score < 5)            $level = 1;
			elseif ($score < 11)       $level = 2;
			elseif ($score < 21)       $level = 3;
			elseif ($score < 41)       $level = 4;
			elseif ($score < 101)      $level = 5;
			
			elseif ($score < 301)      $level = 6;
			elseif ($score < 1001)     $level = 7;
			elseif ($score < 3001)     $level = 8;
			elseif ($score < 5001)     $level = 9;
			elseif ($score < 10001)    $level = 10;
			
			elseif ($score < 20001)    $level = 11;
			elseif ($score < 50001)    $level = 12;
			elseif ($score < 100001)   $level = 13;
			elseif ($score < 200001)   $level = 14;
			elseif ($score < 500001)   $level = 15;
			
			elseif ($score < 1000001)  $level = 16;
			elseif ($score < 2000001)  $level = 17;
			elseif ($score < 5000001)  $level = 18;
			elseif ($score < 10000001) $level = 19;
			else                       $level = 20;
			$level--;
			$l2 = $level % 5;
			$l1 = ($level - $l2) / 5;
			$l1++;
			$l2++;
			return '<img src="'.$weburl2.'images/lvl/pai/credit_b'.$l1.$l2.'.gif" title="分值：'.$score.'" />';
		}
	}
	public static function updateExpress($id, $uid){
		global $db, $pre;
		if (db::exists('sellers', array('id' => $id, 'uid' => $uid))) {
			$names = '';
			$query = $db->query("select eid from {$pre}express_buyers where bid='$id' and uid='$uid'");
			while ($eid = $db->fetch_array_first($query)) {
				$names && $names.=',';
				$names .= db::one_one('express', 'name', "id='$eid'");
			}
			db::update('buyers', array('express' => $names), "id='$id'");
		}
	}
	public static function setAddress($bid, $eid, $area, $address, $nickName, $mobilephone, $uid){
		global $timestamp;
		$addr = self::getAddress($bid, $eid, $uid);
		if ($addr) {
			if (db::update('express_buyers', array(
				'area'        => $area,
				'address'     => $address,
				'nickname'    => $nickName,
				'mobilephone' => $mobilephone,
				'timestamp'   => $timestamp
			), "id='$addr[id]'")) {
				self::updateExpress($bid, $uid);
				return true;
			}
			return 'update_error';

		} else {
			if ($id = db::insert('express_buyers', array(
				'bid'         => $bid,
				'eid'         => $eid,
				'uid'         => $uid,
				'username'    => member_base::getUsername($uid_),
				'area'        => $area,
				'address'     => $address,
				'nickname'    => $nickName,
				'mobilephone' => $mobilephone,
				'timestamp'   => $timestamp
			), true)) {
				self::updateExpress($bid, $uid);
				return true;
			}
			return 'insert_error';
		}
	}
	public static function getAddress($bid, $eid, $uid) {
		return db::one('express_buyers', '*', "bid='$bid' and eid='$eid' and uid='$uid'");
	}
	public static function addComplate($id){
		if ($buyer = db::one('buyers', '*', "id='$id'")) {
			if (db::update('buyers', 'score=score+1,task=task+1,tasking=tasking-1,todayTask=todayTask+1,tswkTask=tswkTask+1', "id='$id'")) {
				$buyer['task']++;
				$buyer['todayTask']++;
				if ($buyer['todayTask'] == 5) {
					db::update('buyers', 'status=1', "id='$id'");
					$msg = '您'.language::get('qu'.$buyer['type']).'区的小号“'.$buyer['nickname'].'”今日接手已达到5次，再接手会被挂起';
					member_base::sendPm($buyer['uid'], $msg, '小号“'.$buyer['nickname'].'”信誉过高', 'acc_high');
					member_base::sendSms($buyer['uid'], $msg, 'acc_high');
				}
				if ($buyer['todayTask'] == 6) {
					db::update('buyers', 'status=2', "id='$id'");
					member_base::addCredit($buyer['uid'], -200, '买号'.$buyer['nickname'].'被挂起');
					$msg = '您'.language::get('qu'.$buyer['type']).'区的小号“'.$buyer['nickname'].'”今日接手已达到6次，已被挂起';
					member_base::sendPm($buyer['uid'], $msg, '小号“'.$buyer['nickname'].'”被挂起', 'acc_ban');
					member_base::sendSms($buyer['uid'], $msg, 'acc_ban');
				}
			}
		}
	}
	public static function getExpress($bid, $eid){
		return db::one('express_buyers', '*', "bid='$bid' and eid='$eid'");
	}
	public static function setLevel($id, $uid, $level){
		if ($buyer = self::getBuyer($id, $uid)) {
			if ($buyer['level'] != $level) {
				//修改等级
				if ($buyer['todayTask'] != 0 || $buyer['tswkTask'] != 0 || $buyer['tasking'] != 0) {
					return '设置失败，请检查7天内是否有接过任务';
				}
				db::update('buyers', array('level' => $level), "id='$id'");
				return true;
			}
			return true;
		}
		return '不存在该买号！';
	}
}
?>