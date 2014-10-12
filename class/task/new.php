<?php
class task_new{
	public static function checkUrl($url){
		//if (preg_match('/^http:\/\/(?:[\w-]+\.)+(?:(?:taobao)|(?:tmall))\.com\/item\.htm\?(?:item_)?(?:num_)?id=(\d+).*$/i', $url, $matches)) return $matches[1];
		if (preg_match('/^(?:http:\/\/[\w-]+\.+(?:taobao|tmall)\.com\/item\.htm\?.*?id=(\d+))|(?:http:\/\/item\.(?:tmall|taobao)\.com\/mealDetail\.htm\?.*?id=(\d+))/i', $url, $matches)) return $matches[1] ? $matches[1] : $matches[2];
		return false;
	}
	private static function formatData($datas){
		//新手区没有来路 过滤掉
		$datas['visitWay'] = 0;//
		$datas['visitKey'] = '';
		$datas['visitTip'] = '';
		// THE END
		$datas['isPriceFit'] = $datas['isPriceFit']?1:0;//是否改价
		if ($datas['times'] < 1 || $datas['times'] > 4) $datas['times'] = 1;//评分类型
		if (!in_array($datas['scores'], array(0, 5))) $datas['scores'] = 5;//打分
		$datas['isRemark'] = $datas['isRemark']?1:0;
		if ($datas['isRemark']) $datas['remark'] = common::cutstr($datas['remark'], 200);
		$datas['isShare'] = $datas['isShare']?1:0;
		if (!in_array($datas['share'], array(1, 2))) $datas['share'] = 1;//分享
		//if (!$datas['isShare'])$datas['share'] = 0;
		$datas['tips'] = common::cutstr($datas['tips'], 100);
		$datas['isLimit'] = $datas['isLimit']?1:0;
		if (!in_array($datas['limit'], array(1, 2))) $datas['share'] = 1;//限制同一个买号一天只能接几个
		if ($multi) {
			//多个商品
			$datas['isExpress'] = $datas['isExpress']?1:0;
			if ($datas['isExpress']) {
				$datas['isCart']    = 0;
				$datas['isAddress'] = 0;
				$datas['address']   = '';
			} else {
				$datas['isCart']     = $datas['isCart']?1:0;//购物车
				if (!$datas['isCart']) {
					$datas['isAddress'] = 0;
					$datas['address']   = '';
				} else {
					$datas['isAddress'] = $datas['isAddress']?1:0;
					if ($datas['isAddress']) $datas['address'] = common::cutstr($datas['address'], 64);
					else $datas['address'] = '';
				}
			}
		}
		$datas['isDbssc']   = $datas['isDbssc']?1:0;//双收藏
		$datas['isVerify']    = $datas['isVerify']?1:0;//审核对方
		$datas['isReal']      = $datas['isReal']?1:0;//支付宝实名认证
		$datas['realname']    = intval($datas['realname']);//掌柜号还是普通号
		!in_array($datas['realname'], array(1, 2)) && $datas['realname'] = 1;
		$datas['isChat']      = $datas['isChat']?1:0;//拍前聊
		$datas['isChatDone']  = $datas['isChatDone']?1:0;//聊后收
		$datas['isStar']      = $datas['isStar'] ? 1 : 0;//是否星级买号
		in_array($datas['lvlStar'], array(3, 4, 5)) || $datas['lvlStar'] = 3;//买号星星级别
		$datas['isEnsure']    = $datas['isEnsure'] ? 1: 0;//是否商保
		$datas['ensurePoint'] < 0.3 && $datas['ensurePoint'] = 0.3;//奖励的商保点
		$datas['ensurePoint'] = common::formatMoney($datas['ensurePoint']);//接手方奖励的商保兔粮
		$datas['isScore']     = $datas['isScore']?1:0;//限制积分
		if (!in_array($datas['scoreLvl'], array(100, 400, 900))) $datas['scoreLvl'] = 100;//
		$datas['isCredit']    = $datas['isCredit']?1:0;//限制信誉不低于
		if (!in_array($datas['creditLvl'], array(30, 100, 300))) $datas['creditLvl'] = 30;//
		$datas['isGood']      = $datas['isGood']?1:0;//限制好评率
		if (!in_array($datas['goodLvl'], array(99, 95, 90))) $datas['goodLvl'] = 90;//
		$datas['isBlack']     = $datas['isBlack']?1:0;//限制黑名单
		if (!in_array($datas['blackLvl'], array(1, 3, 10))) $datas['blackLvl'] = 3;//
		$datas['isFame']      = $datas['isFame']?1:0;//限制信誉不大于
		if (!in_array($datas['fameLvl'], array(90, 150, 220))) $datas['fameLvl'] = 90;//
		$datas['isPlan'] = $datas['isPlan']?1:0;
		if ($datas['isPlan']) {
			$datas['planDate'] = time::get_general_timestamp($datas['planDate']);
			if ($datas['planDate'] == 0) $datas['isPlan'] = 0;
		} else $datas['planDate'] = 0;
		return $datas;
	}
	public static function add($datas, $uid, $isFree = false){
		global $sys_debug, $timestamp, $ipint;
		if ($member = member_base::getMemberAll($uid)) {
			if ($isFree && $member['attach']['freeTask']) return '对不起，您已经发布过1元免费体验任务了';
			//if (task_seller::exists(1, $uid, $datas['nickname'])) {
			if ($seller = task_seller::getSeller2(1, $datas['nickname'], $uid)) {
				if ($itemid = self::checkUrl($datas['itemurl'])) {
					//检查商品
					$datas['price']    = common::formatMoney($datas['price']);
					$datas['freeTask'] = $isFree?1:0;
					$price = $datas['price'];
					if ($isFree) {
						if ($datas['price'] != 1) return '很抱歉，1元免费体验任务担保价只能为1元';
					}
					if (!$sys_debug && !data_taobaoShop::exists($itemid)) return '您所兔粮商品不存在';
					if (!$sys_debug && data_taobaoShop::getNick($itemid) != $datas['nickname']) return '淘宝地址对应的掌柜名与您所选的掌柜不一致';
					
					$shopPrice = (float)data_taobaoShop::getPrice($itemid);
					
					if (!$sys_debug && $price > $shopPrice + 25) return '对不起，任务担保价格不能大于商品价格';
					if (!$sys_debug && $price * 2 < $shopPrice) return '对不起，任务担保价格不能低于商品价格的一半，否则您的支付宝使用率将低于50%<br /><br />任务担保价格：'.$price.'元<br /><br />淘宝商品价格：'.$shopPrice.'元';
					$title = data_taobaoShop::getTitle($itemid);//淘宝商品名称
					//if (!$title) return '获取商品名称失败';
					// THE END
					$datas = self::formatData($datas);
					// THE END
					if ($datas['price'] > 0) {
						//计算兔粮
						if ($price <= 40)       $point = 1;
						elseif ($price <= 80)   $point = 1.5;
						elseif ($price <= 120)  $point = 2;
						elseif ($price <= 200)  $point = 3;
						elseif ($price <= 500)  $point = 4;
						elseif ($price <= 1000) $point = 5;
						elseif ($price <= 1500) $point = 6;
						else                    $point = 7;
						if ($datas['times'] > 1) {
							$point *= 1.8;
							$point += $datas['times'] - 2;
						}
						$point += $datas['pointExt'];
						if ($datas['visitWay']) $point += 0.3;
						if ($datas['isRemark']) $point += 0.1;
					    if ($datas['isAddress']) $point += 0.5;
						if ($datas['isDbssc']) $point += 0.5;
						if ($datas['isVerify']) $point += 0.3;
						if ($datas['isLimit']) { 
							if ($datas['limit'] == 2)
								$point += 0.2;
							else
								$point += 0.5;
						}
						if ($datas['isShare']) { 
							if ($datas['share'] == '1')
								$point += 0.2;
							else
								$point += 0.5;
						}
						if ($datas['isScore']) $point += 0.1;
						if ($datas['isCredit']) $point += 0.1;
						if ($datas['isGood']) $point += 0.1;
						if ($datas['isBlack']) $point += 0.1;
						if ($datas['isFame']) $point += 0.1;
						if ($datas['isPlan']) $point += 0.1;
						if ($datas['isChat']) $point += 1;
						if ($datas['isChatDone']) $point += 0.5;
						if ($datas['isStar']) {
							$__p = cfg::getListValue('sys', 'buyer_level_list', (string)$datas['lvlStar']);
							if (!$__p) return '错误！';
							$point += $__p;
							/*switch ($datas['lvlStar']) {
								case 3:
									$point += 0.5;
								break;
								case 4:
									$point += 1;
								break;
								case 5:
									$point += 1.5;
								break;
							}*/
						}
						if ($datas['isEnsure']) $point += $datas['ensurePoint'];
						if ($datas['isReal']) {
							if ($datas['realname'] == 1) $point += 0.5;
							else $point += 2;
						}
						// THE END
						if ($datas['price'] <= $member['attach']['money']){
							if ($point <= $member['attach']['fabudian1']) {
								$datas = array_merge(array(
									'type'       => 4,//淘宝新手区
									'suid'       => $uid,
									'sid'        => $seller['id'],
									'susername'  => $member['base']['username'],
									'itemid'     => $itemid,
									'title'      => addslashes($title),
									'shopPrice'  => $shopPrice,
									'stimestamp' => $timestamp,
									'point'      => $point,
								), $datas, array(
									'status' => !$datas['isPlan']?1:0,
									'sip'    => $ipint
								));
								if (db::insert2('task', $datas)) {
									db::update('membertask', 'out4=out4+1'.($datas['isPlan']?',outPause4=outPause4+1':',outWaiting4=outWaiting4+1'), "uid='$uid'");
									member_base::addMoney($uid, -$datas['price'], '新手互动区发布任务');
									member_base::addFabudian($uid, -$datas['point'], 1, '新手互动区发布任务');
									$addCredit = $member['attach']['vip']?6:5;
									member_base::addCredit($uid, $addCredit, '新手互动区发任务奖励积分');//
									db::update('sellers', 'tasking=tasking+1', "id='$seller[id]'");
									if ($isFree) db::update('memberfields', "freeTask='1'", "uid='$uid'");
									return true;
								}
								return 'insert_error';
							}
							return '淘宝区兔粮不足，发布失败';
						}
						return '余额不足，发布失败';
					}
					return '商品价格不能为0';
				}
				return '淘宝商品地址格式错误';
			}
			return '淘宝掌柜不存在';
		}
		return 'user_not_exists';
	}
	public static function getList($uid, $type, $spage = 0, $spagesize = 0){
		global $db, $pre, $pagesize, $page, $timestamp;
		$spage     || $spage     = $page;
		$spagesize || $spagesize = $pagesize;
		$where = "type='4' and suid='$uid'";
		switch ($type) {
			case 'all':
			break;
			case 'waiting':
				(($where && $where .= ' and ') || !$where) && $where .= "status='1'";
			break;
			case 'pause':
				(($where && $where .= ' and ') || !$where) && $where .= "status='0'";
			break;
			case 'ing':
				(($where && $where .= ' and ') || !$where) && $where .= "status in('2','3','4','5','6','7')";
			break;
			case 'expire':
				(($where && $where .= ' and ') || !$where) && $where .= "status in('8','9')";
			break;
			case 'complate':
				(($where && $where .= ' and ') || !$where) && $where .= "status='10'";
			break;
			case 'where':
				$where = $uid;
			break;
		}
		$where && $where = ' where '.$where;
		$order = ' order by status,stimestamp desc';
		$limit = ' limit '.($spage - 1) * $spagesize.','.$spagesize;
		//$query = $db->query("select * from {$pre}task$where$order$limit");
		$query = $db->query("select t1.*,t2.qq,t3.credits,t3.isEnsure buyerIsEnsure,t4.score bscore from (select * from {$pre}task$where$order$limit) t1 left join {$pre}members t2 on t2.id=t1.buid left join {$pre}memberfields t3 on t3.uid=t1.suid left join {$pre}buyers t4 on t4.id=t1.bid order by t1.status,t1.stimestamp desc");
		$list = array();
		while ($line = $db->fetch_array($query)) {
			$line['runTimestamp'] = $timestamp - $line['btimestamp'];
			$line['runTimestamp2'] = $line['ttimestamp'] - $timestamp;
			if ($line['credits']) {
				$line['blevel'] = member_credit::getLevel($line['credits']);
			}
			if ($line['bscore']) $line['bico'] = task_buyer::getIco1($line['bscore']);
			$list[] = $line;
		}
		return $list;
	}
	public static function getList2($uid, $type, $spage = 0, $spagesize = 0){
		global $db, $pre, $pagesize, $page, $timestamp;
		$spage     || $spage     = $page;
		$spagesize || $spagesize = $pagesize;
		$where = "type='4' and buid='$uid'";
		switch ($type) {
			case 'all':
			break;
			case 'ing':
				(($where && $where .= ' and ') || !$where) && $where .= "status in('2','3','4','5','6','7')";
			break;
			case 'expire':
				(($where && $where .= ' and ') || !$where) && $where .= "status in('8','9')";
			break;
			case 'complate':
				(($where && $where .= ' and ') || !$where) && $where .= "status='10'";
			break;
			case 'where':
				$where = $uid;
			break;
		}
		$where && $where = ' where '.$where;
		$order = ' order by status,stimestamp desc';
		$limit = ' limit '.($spage - 1) * $spagesize.','.$spagesize;
		//$query = $db->query("select * from {$pre}task$where$order$limit");
		$query = $db->query("select t1.*,t2.qq,t3.credits,t3.isEnsure sellerIsEnsure,t4.score bscore from (select * from {$pre}task$where$order$limit) t1 left join {$pre}members t2 on t2.id=t1.suid left join {$pre}memberfields t3 on t3.uid=t1.suid left join {$pre}buyers t4 on t4.id=t1.bid order by t1.status,t1.stimestamp desc");
		$list = array();
		while ($line = $db->fetch_array($query)) {
			$line['runTimestamp'] = $timestamp - $line['btimestamp'];
			$line['runTimestamp2'] = $line['ttimestamp'] - $timestamp;
			$line['runTimestamp3'] = $line['etimestamp'] - $timestamp;
			$line['slevel'] = member_credit::getLevel($line['credits']);
			if ($line['bscore']) $line['bico'] = task_buyer::getIco1($line['bscore']);
			$list[] = $line;
		}
		return $list;
	}
	public static function get($id){
		return db::one('task', '*', "id='$id'");
	}
	public static function exists1($id, $uid){
		return db::exists('task', array('suid' => $uid, 'id' => $id));
	}
	public static function resume($id, $uid){
		if (self::exists1($id, $uid)) {
			if (db::update('task', array('status' => 1), "id='$id'")) {
				db::update('membertask', 'outWaiting4=outWaiting4+1,outPause4=outPause4-1', "uid='$uid'");
				task_base::addLog($id, '恢复任务', '{susername}恢复了任务{id}');
				return true;
			}
		}
		return false;
	}
	public static function resumeAll($uid){
		global $db, $pre;
		$i = 0;
		$query = $db->query("select id from {$pre}task where type='4' and suid='$uid' and status='0'");
		while ($tid = $db->fetch_array_first($query)) {
			if (db::update('task', array('status' => 1), "id='$tid'")) {
				db::update('membertask', 'outWaiting4=outWaiting4+1,outPause4=outPause4-1', "uid='$uid'");
				task_base::addLog($tid, '恢复任务', '{susername}恢复了任务{id}');
				$i++;
			}
		}
		return $i;
	}
	public static function repost($id, $uid) {
		global $timestamp;
		$onePrice = 0.5;
		if ($task = self::get($id)) {
			if ($task['suid'] == $uid) {
				if ($task['status']==0) {
					$money = member_base::getMoney($uid);
					if ($money >= $onePrice) {
						if (db::update('task', array('stimestamp' => $timestamp, 'status' => 1), "id='$id'")) {
							db::update('membertask', 'outWaiting4=outWaiting4+1,outPause4=outPause4-1', "uid='$uid'");
							member_base::addMoney($uid, - $onePrice, '重新发布任务');
							task_base::addLog($id, '重发任务', '{susername}重发了任务{id}');
							return true;
						}
					}
					return 'money_error';
				}
			}
		}
		return 'error';
	}
	public static function del($id, $uid) {
		global $timestamp;
		$onePrice = 0.5;
		if ($task = self::get($id)) {
			if ($task['suid'] == $uid) {
				if ($task['status']==1) {
					$money = member_base::getMoney($uid);
					//if ($money >= $onePrice) {
						if (db::del_id('task', $id)) {
							db::update('membertask', 'outWaiting4=outWaiting4-1,out4=out4-1', "uid='$uid'");
							member_base::addMoney($uid, - $onePrice, '取消新手互动区任务');
							member_base::addMoney($uid, $task['price'], '取消新手互动区任务');
							//member_base::addMoney($uid, -0.2, '取消新手互动区任务扣除0.2个兔粮');
							member_base::addFabudian($uid, $task['point'], 1, '取消新手互动区任务');//由于是特殊区  新手区和淘宝区共享淘宝区兔粮
							member_base::addFabudian($uid, -cfg::getMoney('sys', 'point_task_del'), 1, '取消新手区任务扣除0.2个兔粮');
							task_base::addLog($id, '取消任务', '{susername}取消了任务{id}');
							return true;
						}
					//}
					//return 'money_error';
				}
			}
		}
		return 'error';
	}
	public static function reject($id, $uid) {
		global $timestamp;
		$onePrice = 0.2;
		if ($task = self::get($id)) {
			if ($task['suid'] == $uid) {
				if (in_array($task['status'], array(2, 3))) {//5为已经付款状态 2 等待绑定买号，3 等待审核
					if ($task['reject'] > 2) {
						$getMoney = true;
						$money = member_base::getMoney($uid);
					} else $getMoney = false;
					if (!$getMoney || $money >= $onePrice) {
						task_base::addLog($id, '拒绝接手方', '{susername}拒绝了任务{id}的接手方{busername}');
						if (db::update('task', "buid='0',busername='',btimestamp='0',bip='0',bid='0',bnickname='',status='1',reject=reject+1", "id='$id'")) {
							db::update('membertask', 'outWaiting4=outWaiting4+1,outing4=outing4-1', "uid='$uid'");
							db::update('membertask', 'in4=in4-1,ining4=ining4-1', "uid='$task[buid]'");//更新买家任务数
							db::update('buyers', 'tasking=tasking-1', "id='$task[bid]'");// 更新买号正在进行的任务
							if ($getMoney) member_base::addMoney($uid, - $onePrice, '辞退任务'.$task['id'].'的第'.($task['reject'] + 1).'个接手人'.$task['busername'].', 扣除兔粮 '.$onePrice.'个');
							return true;
						}
					}
					return 'money_error';
				}
			}
		}
		return 'error';
	}
	public static function verify($id, $uid) {
		global $timestamp;
		if ($task = self::get($id)) {
			if ($task['suid'] == $uid) {
				if ($task['status']==3) {
					if (db::update('task', array('ttimestamp' => $timestamp + 900, 'status' => 4), "id='$id'")) {
						task_base::addLog($id, '任务审核', '{susername}审核了任务{id}的接手方{busername}');
						$msg = '您在'.language::get('qu'.$task['type']).'区接手的任务“'.$task['id'].'”，已通过审核';
						member_base::sendPm($task['buid'], $msg, '接手的任务“'.$task['id'].'”已通过审核', 'in_verify');
						member_base::sendSms($task['buid'], $msg, 'in_verify');
						return true;
					}
				}
			}
		}
		return 'error';
	}
	public static function addtime($id, $uid){
		global $timestamp;
		if ($task = self::get($id)) {
			if ($task['suid'] == $uid) {
				if ($task['status']==4) {
					if (db::update('task', 'ttimestamp=ttimestamp+900', "id='$id'")) {
						task_base::addLog($id, '为接手方加时', '{susername}为任务{id}加时');
						return true;
					}
				}
			}
		}
		return 'error';
	}
	public static function send($id, $uid){
		global $timestamp;
		if ($task = self::get($id)) {
			if ($task['suid'] == $uid) {
				if ($task['status']==7) {
					$etimestamp = $timestamp;
					if ($task['times'] == 2) $etimestamp += 24 * 3600;
					elseif ($task['times'] == 3) $etimestamp += 48 * 3600;
					elseif ($task['times'] == 4) $etimestamp += 72 * 3600;
					if (db::update('task', array(
						'etimestamp' => $etimestamp,
						'status'     => 8
					), "id='$id'")) {
						db::update('membertask', 'outing4=outing4-1,outExpire4=outExpire4+1', "uid='$task[suid]'");
						db::update('membertask', 'ining4=ining4-1,inExpire4=inExpire4+1', "uid='$task[buid]'");
						task_base::addLog($id, '确认发布', '{susername}确认了任务{id}的发货');
						$msg = '您在'.language::get('qu'.$task['type']).'区接手的任务“'.$task['id'].'”，卖家已发货';
						member_base::sendPm($task['buid'], $msg, '接手的任务“'.$task['id'].'”卖家已发货', 'in_send');
						member_base::sendSms($task['buid'], $msg, 'in_send');
						return true;
					}
				}
			}
		}
		return 'error';
	}
	public static function confirm($id, $uid){
		global $timestamp;
		if ($task = self::get($id)) {
			if ($task['suid'] == $uid) {
				if ($task['status']==9) {
					if (db::update('task', array(
						'ctimestamp' => $timestamp,
						'status'     => 10
					), "id='$id'")) {
						//db::update('membertask', 'outing1=outing1-1,outComplate1=outComplate1+1', "uid='$task[suid]'");
						//db::update('membertask', 'ining1=ining1-1,inComplate1=inComplate1+1', "uid='$task[buid]'");
						db::update('membertask', 'outExpire4=outExpire4-1,outComplate4=outComplate4+1,outComplate=outComplate+1', "uid='$task[suid]'");
						db::update('membertask', 'inExpire4=inExpire4-1,inComplate4=inComplate4+1,inComplate=inComplate+1', "uid='$task[buid]'");
						task_seller::addComplate($task['sid']);
						task_buyer::addComplate($task['bid']);
						member_base::addMoney($task['buid'], $task['price'], '完成任务'.$task['id']);
						member_base::addPoint($id);
						member_base::addCredit($task['buid'], (member_base::isVip($task['buid'])?6:5) * ($task['freeTask']?2:1), '完成任务'.$task['id']);
						task_base::addLog($id, '核实货款', '{susername}已核实货款任务{id}');
						$msg = '您在'.language::get('qu'.$task['type']).'区接手的任务“'.$task['id'].'”，卖家已核实货款';
						member_base::sendPm($task['buid'], $msg, '接手的任务“'.$task['id'].'”卖家已核实货款', 'in_confirm');
						member_base::sendSms($task['buid'], $msg, 'in_confirm');
						return true;
					}
				}
			}
		}
		return 'error';
	}
	public static function pause($id, $uid){
		if ($task = self::get($id)) {
			if ($task['suid'] == $uid) {
				if ($task['status']==1) {
					if (db::update('task', array('status' => 0), "id='$id'")) {
						db::update('membertask', 'outWaiting4=outWaiting4-1,outPause4=outPause4+1', "uid='$uid'");
						task_base::addLog($id, '暂停任务', '{susername}暂停了任务{id}');
						return true;
					}
				}
			}
		}
		return false;
	}
	public static function pauseAll($uid){
		global $db, $pre;
		$i = 0;
		$query = $db->query("select id from {$pre}task where type='4' and suid='$uid' and status='1'");
		while ($tid = $db->fetch_array_first($query)) {
			if (db::update('task', array('status' => 0), "id='$tid'")) {
				db::update('membertask', 'outWaiting4=outWaiting4-1,outPause4=outPause4+1', "uid='$uid'");
				task_base::addLog($tid, '暂停任务', '{susername}暂停了任务{id}');
				$i++;
			}
		}
		return $i;
	}
	public static function in($id, $uid){
		global $timestamp, $ipint, $ipint2, $today_start, $today_end, $sys_debug, $db, $pre;
		if ($task = self::get($id)) {
			if ($task['suid'] != $uid) {
				if ($task['status']==1) {
					//可以接
					$memberFields = member_base::getMemberFields($uid);
					if (!$sys_debug) {
						if (db::exists('blacks', array('fuid' => $task['suid'], 'tuid' => $uid, 'status' => 0))) return '对不起，该用户已经把您列入黑名单，您不能接手他的任务';
						//强制限制同一买号同一IP一天只能接同一掌柜一次
						$inCount = db::data_count('task', "sid='$task[sid]' and buid='$uid' and bip='$ipint2'");
						//return '['.$inCount.'|'.$task[sid].'|'.$uid.'|'.common::intip($ipint2).'|'.common::intip('3063239290').']';
						if ($inCount >0) return '对不起，同一IP只能接手同一掌柜一次任务，请更换IP并清空COOKIE！';
						//THE END
						if ($task['isLimit']) {
							//限制同一天内接手人不允许重复接手相同掌柜的任务
							$inCount = db::data_count('task', "sid='$task[sid]' and buid='$uid' and (btimestamp>=$today_start and btimestamp<=$today_end)");
							if ($inCount + 1 > $task['limit']) return '对不起，卖家限制了每天接同一掌柜的数量，你今天已经超过啦！';
						}
						if ($task['isScore']) {
							//限制接手人积分
							if ($memberFields['credits'] < $task['scoreLvl']) return '对不起，您的积分不足以接该任务';
						}
						if ($task['isCredit']) {
							//限制接手人信用值
							if ($memberFields['credit'] < $task['creditLvl']) return '对不起，您的信誉不足以接该任务';
						}
						if ($task['isGood']) {
							if (($memberFields['bgrade'] > 0 && ($memberFields['bgrade1'] / $memberFields['bgrade']) * 100 < $task['goodLvl']) || $memberFields['bgrade'] <= 0) return '对不起，刷客满意度不足以接该任务';
						}
						if ($task['isBlack']) {
							if ($memberFields['black2'] >= $task['blackLvl']) return '对不起，您被拉黑的数量导致您不能接手该任务';
						}
					}
					if ($task['isEnsure']) {
						if (!$memberFields['isEnsure']) return '对不起，该任务需要商保用户才能接手';
						if ($memberFields['ensureMoney'] < $task['price']) return '对不起，您的商保担保金小于该任务金额，不能接手';
					}
					if ($task['freeTask']) {
						if ($db->result_first("select t2.`key` from (select groupid from {$pre}members where id='$uid') t1 left join {$pre}user_groups t2 on t2.id=t1.groupid") != 'drillmaster') return '对不起，只有教官级别的才能接手该任务';
					}
					if (db::update('task', array(
						'buid'       => $uid,
						'busername'  => member_base::getUsername($uid),
						'btimestamp' => $timestamp,
						'bip'        => $ipint2,
						'status'     => 2,
						'isVisit'    => 0,
						'isSendMsg'  => 0
					), "id='$id'")) {
						db::update('membertask', 'in4=in4+1,ining4=ining4+1', "uid='$uid'");
						db::update('membertask', 'outWaiting4=outWaiting4-1,outing4=outing4+1', "uid='$task[suid]'");
						task_base::addLog($id, '接手任务', '{busername}接手了任务{id}');
						member_base::sendPm($task['suid'], '您的任务“'.$task['id'].'”被'.member_base::getUsername($uid).'接手了', '任务“'.$task['id'].'”被接手', 'out_take');
						member_base::sendSms($task['suid'], '您的任务“'.$task['id'].'”被'.member_base::getUsername($uid).'接手了', 'out_take');
						return true;
					}
				}
				return '哦，不好意思！您稍微慢了点这个任务已经被其他用户抢去了。\n\n别放弃，加油再试试吧！！ \n\n或者现在就去【点卡中心】购买“任务定制卡”立刻享用最新的“优先预定任务服务”吧！';
			}
			return '对不起， 自己不能接自己的任务';
		}
		return '不存在该任务';
	}
	public static function sys_out($id){
		if ($task = self::get($id)) {
			if ($task['status'] < 5) {
				//可以接
				if (db::update('task', array(
					'buid'       => 0,
					'busername'  => '',
					'btimestamp' => 0,
					'bip'        => 0,
					'bid'        => 0,
					'bnickname'  => '',
					'status'     => 1
				), "id='$id'")) {
					db::update('membertask', 'in4=in4-1,ining4=ining4-1', "uid='$task[buid]'");
					db::update('membertask', 'outWaiting4=outWaiting4+1,outing4=outing4-1', "uid='$task[suid]'");
					if ($task['bid']) db::update('buyers', 'tasking=tasking-1', "id='$task[bid]'");
					return true;
				}
			}
			return '哦，现在不能退出';
		}
		return '不存在该任务';
	}
	public static function out($id, $uid){
		global $timestamp;
		if ($task = self::get($id)) {
			if ($task['buid'] == $uid) {
				if ($task['status'] < 5) {
					//可以接
					$t = $timestamp - $task['btimestamp'];
					$outTime = 30;
					if ($t > $outTime) {
						task_base::addLog($id, '退出任务', '{busername}退出任务{id}');
						if (db::update('task', array(
							'buid'       => 0,
							'busername'  => '',
							'btimestamp' => 0,
							'bip'        => 0,
							'bid'        => 0,
							'bnickname'  => '',
							'status'     => 1
						), "id='$id'")) {
							db::update('membertask', 'in4=in4-1,ining4=ining4-1', "uid='$uid'");
							db::update('membertask', 'outWaiting4=outWaiting4+1,outing4=outing4-1', "uid='$task[suid]'");
							if ($task['bid']) db::update('buyers', 'tasking=tasking-1', "id='$task[bid]'");
							return true;
						}
					}
					return '对不起，刚接手的任务需要'.$outTime.'秒后才能退出，还剩'.($outTime - $t).'秒才能退出';
				}
				return '哦，现在不能退出';
			}
			return '对不起， 该任务不是您接的';
		}
		return '不存在该任务';
	}
	public static function pay($id, $uid){
		global $timestamp;
		if ($task = self::get($id)) {
			if ($task['buid'] == $uid) {
				if ($task['status'] == 4) {
					if (db::update('task', array(
						'status'     => $task['isExpress']?5:7
					), "id='$id'")) {
						task_base::addLog($id, '确认支付', '{busername}确认支付任务{id}');
						$msg = '您在'.language::get('qu'.$task['type']).'区的任务“'.$task['id'].'”，买家已经付款';
						member_base::sendPm($task['suid'], $msg, '任务“'.$task['id'].'”已付款', 'out_pay');
						member_base::sendSms($task['suid'], $msg, 'out_pay');
						return true;
					}
				}
				return '错误';
			}
			return '对不起， 该任务不是您接的';
		}
		return '不存在该任务';
	}
	public static function unpay($id, $uid){
		global $timestamp;
		if ($task = self::get($id)) {
			if ($task['buid'] == $uid) {
				if ($task['status'] == 7) {
					if (db::update('task', array(
						//'ttimestamp' => 
						'status'     => 4
					), "id='$id'")) {
						task_base::addLog($id, '取消支付', '{busername}取消了任务{id}的付款');
						return true;
					}
				}
				return '错误';
			}
			return '对不起， 该任务不是您接的';
		}
		return '不存在该任务';
	}
	public static function receive($id, $uid){
		global $timestamp;
		if ($task = self::get($id)) {
			if ($task['buid'] == $uid) {
				if ($task['status'] == 8) {
					if (db::update('task', array(
						//'ttimestamp' => 
						'status'     => 9
					), "id='$id'")) {
						task_base::addLog($id, '确认收货', '{busername}确认了任务{id}的收货');
						$msg = '您在'.language::get('qu'.$task['type']).'区的任务“'.$task['id'].'”，买家已确认收货';
						member_base::sendPm($task['suid'], $msg, '任务“'.$task['id'].'”已确认收货', 'out_receive');
						member_base::sendSms($task['suid'], $msg, 'out_receive');
						
						$msg = '您在'.language::get('qu'.$task['type']).'区的任务“'.$task['id'].'”，买家已确认好评';
						member_base::sendPm($task['suid'], $msg, '任务“'.$task['id'].'”已确认好评', 'out_comment');
						member_base::sendSms($task['suid'], $msg, 'out_comment');
						
						$msg = '您在'.language::get('qu'.$task['type']).'区的任务“'.$task['id'].'”，买家已确认收货并好评，请核实货款';
						member_base::sendPm($task['suid'], $msg, '请核实任务“'.$task['id'].'”的货款', 'out_to_grade');
						member_base::sendSms($task['suid'], $msg, 'out_to_grade');
						return true;
					}
				}
				return '错误';
			}
			return '对不起， 该任务不是您接的';
		}
		return '不存在该任务';
	}
}
?>