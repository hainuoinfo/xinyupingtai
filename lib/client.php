<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
template::initialize('./templates/default/'.$action.'/', './cache/default/'.$action.'/');//设置BBS模板缓存目录
$ops = array('login', 'getClientId', 'memberExists', 'getTask', 'topup', 'alipay');
($operation && in_array($operation, $ops)) || $operation = $ops[0];
$clientKey = 'jpsystem';
task_flow::upCache();
task_collect::upCache();
$taskId = 1;
function is_post(){
	global $post_data, $domains, $clientKey;
	if ($post_data) {
		if ($_POST['verify'] == md5(md5(md5($domains['host']).$clientKey).$_SERVER['HTTP_USER_AGENT'])) {
			return true;
		}
	}
	return false;
}
function encrypt($string, $key) {
	//加密用的密钥文件 
	//$key = "xxxxxxxx";
	
	//加密方法 
	$cipher_alg = MCRYPT_TRIPLEDES;
	//初始化向量来增加安全性 
	$iv = mcrypt_create_iv(mcrypt_get_iv_size($cipher_alg,MCRYPT_MODE_ECB), MCRYPT_RAND); 
	
	//开始加密 
	$encrypted_string = mcrypt_encrypt($cipher_alg, $key, $string, MCRYPT_MODE_ECB, $iv); 
	return base64_encode($encrypted_string);//转化成16进制
	//  return $encrypted_string;
}
	
function decrypt($string, $key) {
	$string = base64_decode($string);
	//加密用的密钥文件 
	//$key = "xxxxxxxx";
	
	//加密方法 
	$cipher_alg = MCRYPT_TRIPLEDES;
	//初始化向量来增加安全性 
	$iv = mcrypt_create_iv(mcrypt_get_iv_size($cipher_alg,MCRYPT_MODE_ECB), MCRYPT_RAND); 
	
	//开始加密 
	$decrypted_string = mcrypt_decrypt($cipher_alg, $key, $string, MCRYPT_MODE_ECB, $iv); 
	return trim($decrypted_string);
}
function toSimpleXml($arr){
	$str = '<?xml version="1.0" encoding="'.ENCODING.'"?><result> ';
	$str .= getXml($arr);
	$str.='</result>';
	return $str;
}
function getXml($arr){
	switch(gettype($arr)){
		case 'boolean':
			return $arr?"true":"false";
		break;
		case 'integer':
			return $arr;
		break;
		case 'double':
			return $arr;
		break;
		case 'string':
			return '<![CDATA['.$arr.']]>';
		break;
		case 'array':
			$str = '';
			foreach ($arr as $k=>$v) {
				$str .= ' <'.$k.'>'.getXml($v).'</'.$k.'>';
			}
			return $str;
		break;
		case 'object':
			return '';
		break;
		case 'resource':
			return '';
		break;
		case 'NULL':
			return '';
		break;
		case 'user function':
			return '';
		break;
		case 'unknown type':
			return '';
		break;
	}
}
function getXmlData ($strXml) {
	$pos = strpos($strXml, 'xml');
	if ($pos) {
		$xmlCode=simplexml_load_string($strXml,'SimpleXMLElement', LIBXML_NOCDATA);
		$arrayCode=get_object_vars_final($xmlCode);
		return $arrayCode ;
	} else {
		return '';
	}
}
function get_object_vars_final($obj){
	if(is_object($obj)){
		$obj=get_object_vars($obj);
	}
	if(is_array($obj)){
		foreach ($obj as $key=>$value){
			$obj[$key]=get_object_vars_final($value);
		}
	}
	return $obj;
}
$rn = array();
switch ($operation) {
	case 'memberExists':
		if (is_post() && $fromInstation) {
			if ($data = $_POST['data']) {
				$data = decrypt($data, $clientKey);
				$rs = getXmlData($data);
				$clientId = $rs['clientId'];
				if ($cUid = member_client::getUid($clientId)) {
					$rn['exists'] = true;
					$rn['uid'] = $cUid;
				} else {
					$rn['exists'] = false;
				}
			}
		}
	break;
	case 'login':
		//if (!$memberLogined) {
			if (is_post() && $fromInstation) {
				extract($_POST);
				if (vcode2::checkPost()) {
					$rs = member_base::login($username, $password, $questionid, $answer, $login_cookietime, true);
				} else {
					$rs = 'vcode_error';
				}
				if ($rs === true) {
					$rn = array(
						'status'       => true//,
						//'userClientId' => member_base::getClientId($uid)
					);
				} else {
					$indexMessage = language::get($rs, 'login', 'member');
					$rn = array(
						'status' => false,
						'error'  => $indexMessage
					);
				}
			}
		//} else {
			//$clientId = member_base::getClientId($uid);
		//}
	break;
	case 'getClientId':
		if ($memberLogined) {
			$rn = array(
				'status'   => true,
				'clientId' => member_base::getClientId($uid)
			);
		} else {
			$rn = array(
				'status' => true,
				'error'  => '请先登陆'
			);
		}
	break;
	case 'getTask':
		/*$post_data     = true;
		$fromInstation = true;
		$_POST = array(
			'verify' => md5(md5(md5($domains['host']).$clientKey).$_SERVER['HTTP_USER_AGENT']),
			'data'   => encrypt(toSimpleXml(array(
				'clientId' => member_base::getClientId($uid),//$member['clientId'],
				'taskType' => 'collect',
				'type'     => 'get'
			)), $clientKey)
		);*/
		if (is_post() && $fromInstation) {
			if ($data = $_POST['data']) {
				$data = decrypt($data, $clientKey);
				$rs = getXmlData($data);
				$clientId = $rs['clientId'];
				$taskType = $rs['taskType'];
				$type     = $rs['type'];
				$taskType || $taskType = 'flow';
				$type     || $type = 'get';
				if ($cUid = member_client::getUid($clientId)) {
					if ($taskType == 'flow') {
						
						$query = $db->query("
						select
							t1.type,t1.id,t1.itemid,t1.itemurl,t1.sign,flowTotal,t1.times,t1.uid,t2.total
						from
							bf_task_flow t1
						left join
							bf_flow_cache t2
						on
							t1.type=t1.type and t2.uid=t1.uid and t2.ip='$ipint'
						where
							t1.type='1' and t1.status='1' and t1.flowTotal>0 and (t1.isIp='0' or (t1.isIp='1' and (t2.total is null or t2.total<t1.times)))
						limit 20
						");
						//t1.type=t1.type and t2.uid=t1.uid and t2.ip='2130706433'
						$list = array();
						while ($line = $db->fetch_array($query)) {
							if (!db::exists('flow_cache', array('type' => $line['type'], 'uid' => $line['uid'], 'ip' => $ipint))) {
								$db->query("insert into {$pre}flow_cache values('$line[type]','$line[uid]','$ipint','1')");
							} else {
								$db->query("update {$pre}flow_cache set total=total+1 where type='$line[type]' and uid='$line[uid]' and ip='$ipint'");
							}
							db::update('task_flow', 'flowTotal=flowTotal-1,flowComplate=flowComplate+1'.($line['flowTotal'] - 1 == 0?",status='2'":''), "id='$line[id]'");
							db::update('memberfields', 'liuliang=liuliang+1', "uid='$cUid'");//增加流量
							$list[] = $line['itemid'].','.$line['sign'].','.urlencode($line['itemurl']);
						}
						$rn['status'] = true;
						$rn['taskType'] = 'flow';
						$rn['taskCount'] = count($list);
						$rn['taskData'] = implode('|', $list);
					
					} elseif ($taskType == 'collect') {
						switch ($type) {
							case 'get':					
								if (db::data_count('task_collects', "type='$taskId' and uid='$cUid' and status='0'") == 0) {
									//开始接手任务
									if ($buyer = task_buyer::getCbuyer($taskId, $cUid)) {
										$i = 0;
										//$query = $db->query("select t1.id,t1.type from {$pre}task_collect t1 left join {$pre}task_collects t2 on t2.tid=t1.id where t1.type='$taskId' and t1.status='1' and t1.total>t1.totalComplate and t1.uid<>'$cUid' and (t2.bid is null or t2.bid<>'$buyer[id]') limit 5");
										$query = $db->query("select t1.id,t1.type from {$pre}task_collect t1 where t1.type='$taskId' and t1.status='1' and t1.total>t1.totalComplate and t1.uid<>'$cUid' and not exists(select * from {$pre}task_collects t2 where t2.tid=t1.id and t2.bid='$buyer[id]') limit 5");
										while ($line = $db->fetch_array($query)) {
											db::update('task_collect', 'totalIng=totalIng+1', "id='$line[id]'");
											db::insert('task_collects', array(
												'type'      => $line['type'],
												'tid'       => $line['id'],
												'uid'       => $cUid,
												'count'     => 1,
												'bid'       => $buyer['id'],
												'nickname'  => $buyer['nickname'],
												'timestamp1' => $timestamp
											));
											$i++;
										}
										if ($i > 0) db::update('buyers', 'ing=ing+1', "id='$buyer[id]'");
									} else {
										$rn['status']   = false;
										$rn['taskType'] = $taskType;
										$rn['error']    = '没有绑定收藏小号';
									}
								}
								if (!$rn) {
									$query = $db->query("select t1.id,t2.url,t2.curl,t3.nickname,password from {$pre}task_collects t1 left join {$pre}task_collect t2 on t2.id=t1.tid left join {$pre}buyers t3 on t3.id=t1.bid where t1.type='$taskId' and t1.uid='$cUid' and t1.status='0'");
									$list = array();
									while ($line = $db->fetch_array($query)) {
										$list[] = $line['id'].','.urlencode($line['url']).','.urlencode($line['curl']).','.urlencode($line['nickname']).','.urlencode($line['password']);
									}
									$rn = array(
										'status'    => true,
										'taskType'  => $taskType,
										'taskCount' => count($list),
										'taskData'  => implode('|', $list)
									);
								}
							break;
							case 'update':
								$arr = array();
								$sp = explode('|', $rs['data']);
								foreach ($sp as $v) {
									$sp2 = explode(',', $v);
									$arr[] = array('id' => $sp2[0], 'status' => $sp2[1]);
								}
								if ($arr) {
									foreach ($arr as $v) {
										if ($task = db::one('task_collects', '*', "id='$v[id]' and uid='$cUid'")) {
											switch ($v['status']) {
												case '0':
													//买号登陆失败造成的
													if ($task0 = db::one('task_collect', '*', "id='$task[tid]'")) {
														task_buyer::frostCollect($task['bid'], $task['uid'], '出现验证码，请检查密码');
														$db->query("update {$pre}task_collect set totalIng=totalIng-1 where id='$task[tid]'");
														$db->query("update {$pre}buyers set ing=ing-1 where id='$task[bid]' AND ing>'0'");
														$db->query("delete from {$pre}task_collects where id='$task[id]'");
													}
												break;
												case '1':
													//成功的
													if ($task0 = db::one('task_collect', '*', "id='$task[tid]'")) {
														if ($task0['totalIng'] > 0) {
															$db->query("update {$pre}task_collect set totalIng=totalIng-1,totalComplate=totalComplate+1".($task0['totalComplate'] + 1 == $task0['total']?",status='2'":"")." where id='$task[tid]'");
															$db->query("update {$pre}buyers set ing=IF(ing>0,ing-1,0),complate=complate+1 where id='$task[bid]'");
															$db->query("update {$pre}task_collects set timestamp2='$timestamp',status='1' where id='$task[id]'");
														}
													}
												break;
												case '2':
													//收藏过的
													if ($task0 = db::one('task_collect', '*', "id='$task[tid]'")) {
														if ($task0['totalIng'] > 0) {
															$db->query("update {$pre}task_collect set totalIng=totalIng-1 where id='$task[tid]'");
															$db->query("update {$pre}buyers set ing=IF(ing>0,ing-1,0),complate=complate+1 where id='$task[bid]'");
															$db->query("update {$pre}task_collects set timestamp2='$timestamp',status='1',isChange='1' where id='$task[id]'");
														}
													}
												break;
											}
										}
									}
								}
								$rn['status'] = true;
							break;
						}
					} else {
						$rn['status'] = false;
						$rn['error'] = '错误';
					}
				} else {
					$rn['status'] = false;
					$rn['error'] = '错误，请先登陆';
				}
			}
		}
	break;
	case 'topup':
		if (is_post() && $fromInstation) {
			$username = $price = $count = '';
			if ($data = $_POST['data']) {
				$data = decrypt($data, $clientKey);
				$rs = getXmlData($data);
				$username = $rs['username'];
				$price = $rs['price'];
				$count = $rs['count'];
			}
			if ($username && $price && $count) {//$username = 'abc123';
				$uid = member_base::getUid($username);
				if ($uid) {
					$price = common::formatMoney($price);
					$card = new payfor_card();
					$cardList = array();
					if ($card->createCard($price, $count, $cardList) == $count) {
						foreach ($cardList as $v) {
							payfor_topup::payfor2($uid, 'card', $v['id'], $v['key'], false);
						}
						$rn['status'] = true;
					} else {
						$rn['status'] = false;
						$rn['error'] = "生成充值卡失败！";
					}
				} else {
					$rn['status'] = false;
					$rn['error']  = '帐号：'.$username.'不存在';
				}
			} else {
				$rn['status'] = false;
				$rn['error']  ='参数错误！';
			}
		} else {
			$rn['status'] = false;
			$rn['error'] = '非法操作！';
		}
	break;
	case 'alipay':
		$tps = array('list', 'topup');
		(!empty($type) && in_array($type, $tps)) || $type = $tps[0];
		switch ($type) {
			case 'list':
				if (is_post() && $fromInstation) {
				//if (1) {
					//$_POST['data'] = encrypt(toSimpleXml(array('count' => 20)), $clientKey);
					if ($data = $_POST['data']) {
						$data = decrypt($data, $clientKey);
						$rs = getXmlData($data);
						if ($count = intval($rs['count'])) {
							$list = db::select('topup', 'id,remark1,remark2,money1', "type='alipay' AND softIsGet='0' AND status='0' AND remark1<>'' AND remark2<>''");
							$total = count($list);
							$aids = '';
							if ($total > 0) {
								$ids = '\''.implode('\',\'', common::arrid($list, 'id')).'\'';
								db::query("UPDATE `{$pre}topup` SET softIsGet='1' WHERE id IN($ids)");
								//更新订单已经被软件读取了
								foreach ($list as $v) {
									$aids && $aids .= ',';
									$aids .= $v['remark2'].':'.$v['remark1'].':'.$v['money1'];
								}
								//$aids = '\''.implode('\',\'', common::arrid($list, 'remark2')).'\'';
							}
							$rn['status'] = true;
							$rn['total']  = $total;
							$rn['ids']    = $aids;
						} else {
							$rn = array(
								'status' => false,
								'error'  => '参错错误！'
							);
						}
					} else {
						$rn = array(
							'status' => false,
							'error'  => '参错错误！'
						);
					}
				} else {
					$rn = array(
						'status' => false,
						'error'  => '非法操作！'
					);
				}
			break;
			case 'topup':
				if (is_post() && $fromInstation) {
					if ($data = $_POST['data']) {
						$data = decrypt($data, $clientKey);
						$rs = getXmlData($data);
						$oid = $rs['oid'];
						$status = intval($rs['status']);
						if ($oid) {
							if ($item = db::one('topup', "*", "remark2='$oid'")) {
								if ($status) {
									if (payfor_topup::complateOrder($item['id'], '支付宝转账')) {
										$rn = array(
											'status' => true,
											'msg'    => '充值成功！'
										);
									} else {
										$rn = array(
											'status' => false,
											'error'  => '订单'.$oid.'充值失败！'
										);
									}
								} else {
									db::update('topup', array('status' => 2), "id='$item[id]'");
									$rn = array(
										'status' => true,
										'msg'    => '已经设为无效！'
									);
								}
							} else {
								$rn = array(
									'status' => false,
									'error'  => '订单'.$oid.'不存在！'
								);
							}
						} else {
							$rn = array(
								'status' => false,
								'error'  => '参错错误！|'.$rs['oid'].'|'.$rs['status']
							);
						}
					} else {
						$rn = array(
							'status' => false,
							'error'  => '参错错误！'
						);
					}
				} else {
					$rn = array(
						'status' => false,
						'error'  => '非法操作！'
					);
				}
			break;
		}
	break;
}
$rn = toSimpleXml($rn);
$rn = encrypt($rn, $clientKey);
echo $rn;
//include(template::load($operation));
?>