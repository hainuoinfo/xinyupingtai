<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
template::initialize('./templates/default/'.$action.'/', './cache/default/'.$action.'/');//设置BBS模板缓存目录
$ops = array('memberTipIndex', 'login', 'active', 'sendmsg', 'sendsms', 'viewmsg', 'pwd2', 'tip', 'upload', 'card','autotk',
'activeSeller', 'sellerTruth', 'sellerAddress', 'setTaskQuery', 'buyerPsw', 'buyerAddress', 'chooseBuyer', 'showTaskTip',
'taskVisitWay', 'taskInfo', 'confirmExpress', 'grade', 'complain', 'joinClub', 'taskBook', 'taskComment', 'reword', 'ensure',
'reflow', 'buyerInfo', 'buyerLevel', 'tyro','review','uphaoping'
);
($operation && in_array($operation, $ops)) || $operation = $ops[0];
if (!$memberLogined && !in_array($operation, array('login'))){
	common::goto_url('/'.$action.'/login/?referer='.$baseUrl2);
}
loadLib('member.base');
function showmessage($message, $title = '提示', $goto_url = ''){
	common::ob_clean();
	include(template::load('showmessage'));
	exit;
}
function tip($message, $title = '继续操作', $goto_url = ''){
	common::ob_clean();
	include(template::load('tip'));
	exit;
}
switch ($operation) {
	case 'login':
		if ($rs = form::is_form_hash2()) {
			extract($_POST);
			if ($rs === true) {
				if (vcode2::checkPost()) {
					$rs = member_base::login($username, $password, $questionid, $answer, $login_cookietime);
				} else {
					$rs = 'vcode_error';
				}
			} else {
				$rs = 'login_expire';
			}
			if ($rs === true) {
				common::goto_url($referer, true);
			} else {
				$indexMessage = language::get($rs, 'login', 'member');
			}
		}
		if (!$indexMessage)$indexShowMessage = '您需要登录后才能继续操作';
		cache::get_array('questions');
	break;
	case 'active':
		if ($member['status']) {
			$type = 'complate';
			$msg = '您的帐户已经激活';
		}
		$type || $type = 'index';
		switch($type) {
			case 'index':
				$next = true;
				if ($sendLog = db::one('vcode_log', '*', "uid='$member[id]'", 'timestamp desc')) {
					if ($timestamp - $sendLog['timestamp'] <= $msg_vcode_time) {
						$next = false;
						$indexMessage = '对不起，激活码'.$msg_vcode_time.'秒内只能发送一次';
					}
				}
				if ($next) {
					if ($rs = form::is_form_hash2()) {
						extract($_POST);
						if ($rs === true) {
							if (form::check_mobilephone($mobilephone)) {
								$rs = member_base::sendVcode($member['id'], $mobilephone, $password2);
							} else $rs = 'mobilephone_error';
						} else {
							$rs = 'form_expire';
						}
						if ($rs === true) {
							common::goto_url('/'.$action.'/'.$operation.'/?type=confirm');
						} else {
							$indexMessage = language::get($rs, 'active', 'member');
						}
					}
				}
			break;
			case 'confirm':
				if ($sendLog = db::one('vcode_log', '*', "uid='$member[id]'", 'timestamp desc')) {
					if ($rs = form::is_form_hash2()) {
						extract($_POST);
						if ($rs === true) {
							$rs = member_base::checkVcode($member['id'], $vid, $vcode);
						} else {
							$rs = 'form_expire';
						}
						if ($rs === true) {
							common::goto_url('/'.$action.'/'.$operation.'/?type=complate');
						} else {
							$indexMessage = language::get($rs, 'active', 'member');
						}
					}
				} else {
					common::goto_url('/'.$action.'/'.$operation.'/');
				}
			break;
			case 'complate':
				$msg || $msg = '验证完毕';
			break;
		}
	break;
	case 'sendmsg':
		if (!$member['checkPwd2']) {
			common::setmsg('对不起，您尚未输入操作码');
			common::goto_url('/dialog/pwd2/?referer='.$baseUrl2);
		}
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				$rs = msg::sendForm();
			} else {
				$rs = 'form_expire';
			}
			if ($rs === true) {
				common::setMsg('站内信息发送成功');
				common::goto_url('/'.$action.'/tip/');
			} else {
				$indexMessage = language::get($rs);
			}
		}
		if ($id) {
			$item = msg::get($id);
			if (!is_array($item)) $item = array();
		} else {
			if ($username) {
				$item = array('from_username' => $username);
			}
		}
	break;
	case 'autotk':
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				$rs = msg::sendForm();
			} else {
				$rs = 'form_expire';
			}
			if ($rs === true) {
				common::setMsg('站内信息发送成功');
				common::goto_url('/'.$action.'/tip/');
			} else {
				$indexMessage = language::get($rs);
			}
		}
		if ($id) {
			$item = msg::get($id);
			if (!is_array($item)) $item = array();
		} else {
			if ($username) {
				$item = array('from_username' => $username);
			}
		}
	break;
	case 'viewmsg':
		if (!$member['checkPwd2']) {
			common::setmsg('对不起，您尚未输入操作码');
			common::goto_url('/dialog/pwd2/?referer='.$baseUrl2."&id=".$id);
		}
		$item = msg::get($id);
		if (!is_array($item)) {
			common::setmsg(language::get($item));
			common::goto_url('/dialog/tip/');
		}
	break;
	case 'pwd2':
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				$rs = member_base::checkPwd2($member['id'], $_POST['password2']);
			}
			if ($rs === true) {
				common::goto_url($referer."&id=".$id, true);
			} else {
				$indexMessage = language::get($rs);
				if ($rs == 'password2_expire') {
					$indexMessage = str_replace('{x}', $sys_pwd2_err_count, $indexMessage);
				}
				if ($rs == 'password2_error') {
					if (isset($sys_pwd2_err_count)) {
						$count = db::one_one('memberlog', 'pwd2_err_count', "uid='$uid' and pwd2_err_timestamp='$today_start'");
						$c     = $sys_pwd2_err_count - $count;
						if ($c > 0) {
							$errMsg = '您今天还可以输错 ['.($c).'] 次操作码';
						} else {
							$errMsg = '您今天输错操作码的次数超过了'.$sys_pwd2_err_count.'次';
						}
					}
				}
			}
		}
	break;
	case 'tip':
		$message = $_showmessage;
		$message || $message = '对不起，系统遇到了一个意外的错误';
		$goto || $goto = '';
		showmessage($message, '提示', $goto);
	break;
	case 'upload':
		$upload = false;
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				$upload = new upload();
				$rs = $upload->toupload('filedata', 'image');
				$path  = date('Y/m/', $timestamp);
				$path1 = 'img/attach/';
				$path2 = d('./'.$path1.$path);
				if ($rs['count'] == 1) {
					!file_exists($path2) && common::create_folder($path2);
					if ($rs = $upload->move2($rs['info']['filedata']['db_id'], $path2)) {
						$pathinfo  = pathinfo($rs['source']);
						$filename  = $pathinfo['basename'];
						$filename2 = $pathinfo['filename'].'_thumb.'.$pathinfo['extension'];

						image::thumb($path2.$filename, $path2.$filename2, array('width' => 100, 'height' => 80));
						if ($aid = db::insert('attach', array(
							'uid'       => $uid,
							'filesize'  => filesize($path2.$filename),
							'filetype'  => 'img',
							'src'       => $path.$filename,
							'thumb'     => $path.$filename2,
							'timestamp' => $timestamp,
							'status'    => 0
						), true)) {
							$upload = true;
							$rs0 = $rs = array(
								'id' => $aid,
								'type'  => 'img',
								'src'   => $weburl2.$path1.$path.$filename,
								'thumb' => $weburl2.$path1.$path.$filename2,
							);

							$rs = string::json_encode($rs);
						}
					}
				}
			} else {
				$showMessage = '表单超时，请重试';
			}
		}
	break;
	case 'sendsms':
		if (!$member['checkPwd2']) {
			common::setmsg('对不起，您尚未输入操作码');
			common::goto_url('/dialog/pwd2/?referer='.$baseUrl2);
		}
		if ($memberFields['money'] < sms::onePrice($uid)) {
			common::setMsg('余额不足');
			common::goto_url('/dialog/tip/');
		}
		if ($rs = form::is_form_hash2()) {
			$_POST = common::filterHtml($_POST);
			extract($_POST);
			if ($rs === true) {
				$rs = sms::sendUser($username, $message);
			} else {
				$rs = 'form_expire';
			}
			if (is_numeric($rs) && $rs >= 0) {
				common::setMsg('发送完成，您一共发送了 '.$rs.' 条短信');

			} else {
				common::setMsg(language::get($rs));
			}
			common::goto_url('/dialog/tip/');
		}
	break;
	case 'card':
		if (!$member['checkPwd2']) {
			common::setmsg('对不起，您尚未输入操作码');
			common::goto_url('/dialog/pwd2/?referer='.$baseUrl2);
		}
		$card = card::getCard($active);
		if ($card === false) {
			common::setMsg('不存在该卡');
			common::goto_url('/dialog/tip/');
		}
		if ($card['status'] == 1) {
			common::setMsg('该卡已经激活');
			common::goto_url('/dialog/tip/');
		}
		if ($card['status'] == 2) {
			common::setMsg('该卡已经过期');
			common::goto_url('/dialog/tip/');
		}
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				$rs = card::active($active, $_POST['fType']);
			}
			if ($rs === true) {
				common::setMsg('激活成功');
				common::goto_url('/dialog/tip/?goto='.urlencode(common::getUrl('/member/cardLog/?type=1')));
			}
		}
		$title = '激活'.card::$names[$card['cid']];
	break;
	case 'activeSeller':
		$title = '激活掌柜';
		$next = true;
		if ($next) {
			if ($id) {
				if ($seller = db::one('sellers', 'type,nickname', "id='$id' and uid='$uid'")) {

				} else {
					$indexMessage = '不存在该掌柜';
					$next = false;
				}
			} else {
				$indexMessage = '参数错误';
				$next = false;
			}
		}
		/*if ($next) {
			if ($sendLog = db::one('vcode_log', '*', "uid='$member[id]'", 'timestamp desc')) {
				if ($timestamp - $sendLog['timestamp'] <= $msg_vcode_time) {
					$next = false;
					$indexMessage = '对不起，激活码'.$msg_vcode_time.'秒内只能发送一次';
				}
			}
		}*/
		if ($next) {
			if ($rs = form::is_form_hash2()) {
				extract($_POST);
				if ($rs === true) {
					if ($sendLog = db::one('vcode_log', '*', "uid='$member[id]' and status='0'", 'timestamp desc')) {
						if ($sendLog['vcode'] == $actCode) {
							db::update('vcode_log', array('status' => 1), "id='$sendLog[id]'");
							db::update('sellers', array('status' => 1), "id='$id'");
							db::update('memberfields', 'sellers'.$seller['type'].'=sellers'.$seller['type'].'+1', "uid='$uid'");
						} else $rs = 'vcode_error';
					} else $rs = 'error';
				} else {
					$rs = 'form_expire';
				}
				if ($rs === true) {
					showmessage('激活成功');
				} else {
					$indexMessage = language::get($rs, 'active', 'member');
				}
			}
		}
	break;
	case 'sellerTruth':
		$title = '设置店铺消保属性';
		$seller = task_seller::getSeller($id, $uid);
		if (!$seller) $indexMessage = '不存在该掌柜';
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				$rs = task_seller::setTruth($id, $_POST['isTruth'], $uid);
			}
			if ($rs === true) {
				showmessage('设置成功');
			} else {
				$indexMessage = language::get($rs);
			}
		}
	break;
	case 'sellerAddress':
		if ($rs = form::is_form_hash2()) {
			$datas = form::get(array('eid', 'int'), 'area', 'address', 'nickname', 'mobile');
			extract($datas);
			if ($rs === true) {
				$rs = task_seller::setAddress($id, $eid, $area, $address, $nickname, $mobile, $uid);
			}
			if ($rs === true) {
				showmessage('设置成功');
			} else {
				$indexMessage = language::get($rs);
			}
		}
		if ($eList = task_express::getList()) {
			$seller = task_seller::getSeller($id);
			$e || $e = $eList[0]['id'];
			$express = task_express::get($e);
			$sellerAddress = task_seller::getAddress($id, $e, $uid);
			$update = false;
			if ($sellerAddress) {
				$update = true;
				extract(common::filterArray($sellerAddress, array('area', 'address', 'mobilephone', 'nickname')));
			}
		}
	break;
	case 'buyerPsw':
		$buyer = task_buyer::getBuyer($id, $uid);
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				$rs = task_buyer::setPwd($id, $uid, $_POST['password']);
			}
			if ($rs === true) {
				showmessage('买号密码设置成功');
			} else {
				$indesMessage = languange::get($rs);
			}
		}
	break;
	case 'buyerAddress':
		if ($rs = form::is_form_hash2()) {
			$datas = form::get(array('eid', 'int'), 'area', 'address', 'nickname', 'mobile');
			extract($datas);
			if ($rs === true) {
				$rs = task_buyer::setAddress($id, $eid, $area, $address, $nickname, $mobile, $uid);
			}
			if ($rs === true) {
				showmessage('设置成功');
			} else {
				$indexMessage = language::get($rs);
			}
		}
		if ($eList = task_express::getList()) {
			$buyer = task_buyer::getBuyer($id, $uid);
			$e || $e = $eList[0]['id'];
			$express = task_express::get($e);
			$buyerAddress = task_buyer::getAddress($id, $e, $uid);
			$update = false;
			if ($buyerAddress) {
				$update = true;
				extract(common::filterArray($buyerAddress, array('area', 'address', 'mobilephone', 'nickname')));

			}
		}
	break;
	case 'chooseBuyer':
		$title = '绑定接手小号';
		$bStatus = array('正常', '危险', '挂起', '失效', '锁定', '暂停', '收藏');
		if ($sid) {
			if ($task = task_base::_get($sid)) {
				if ($task['status'] != 2) showmessage('该任务已经绑定过买号了');
				if ($task['buid'] == $uid) {
					if ($rs = form::is_form_hash2()) {
						if ($rs === true) {
							$rs = task_base::tieBuyer($sid, $_POST['bid'], $uid);
						}
						if ($rs === true) {
							task_base::addLog($sid, '绑定买号', '{busername}向任务{id}绑定了买号');
							if ($memberTask['inComplate'.$task['type']] < 5) {
								common::setcookie('showTaskTip', 2);
								common::setcookie('_taskId', $sid);
							}
							if ($task['isVerify']) {
								tip('1. 您已经成功为该任务选择了买号，请确保使用选择的买号购买任务商品，否则视为放弃申诉权；<br />2. 由于该任务发布方选择了“审核接手人”，请等待或联系发布方审核；');
							} else {
								tip(' 1. 您已经成功为该任务选择了买号，请确保使用选择的买号购买任务商品，否则视为放弃申诉权；<br />2. 请在十五分钟内拍下任务商品并且按任务平台担保价'.$task['price'].'元支付；<br />3. 发布方已经在发布任务时在平台扣押了等额的平台担保金，任务完成后您将获得该笔平台存款和'.$v['point'].'个发布点”；<br />4. 如果发现商品价格（包含运费）与任务担保价不等请联系发布方修改价格与延长操作时间；');
							}
						} else {
							$indexMessage = language::get($rs);
						}
					}
					$minScore = -1;//原来为12 最小接手任务的小号
					if ($task['type'] == 4) {
						$task['type'] = 1;//特殊处理
						$minScore = -1;
					}
					if ($buyerList = db::get_list2('buyers', '*', "type='$task[type]' and uid='$uid' and status in('0','1') and score>$minScore", 'timestamp desc', 1, 12)) {
						foreach ($buyerList as $k => $v) {
							if ($task['isReal']) {
								if ($task['realname'] == 1) {
									//普通的
									if (!$v['utype']) $v['disabled'] = true;
								} else {
									//掌柜的
									if (!$v['utype'] || !$v['hasShop']) $v['disabled'] = true;
								}

							}
							elseif ($task['isFame'] && $v['score'] >= $task['fameLvl']) $v['disabled'] = true;
							else $v['disabled'] = false;
							$buyerList[$k] = $v;
						}
					} else showmessage('您尚未添加买号或是买号现不可用，请您先添加买号，然后再给任务绑定具体买号');
				} else {
					showmessage('很抱歉，该任务不是您接手的，请查看是否已经超时');
				}
			} else {
				showmessage('对不起，不存在该任务');
			}
		} else {
			showmessage('参数错误');
		}
	break;
	case 'taskVisitWay':
		if ($sid) {
			if ($task = task_base::_get($sid)) {
				if ($task['status'] < 4) showmessage('错误');
				if ($task['buid'] == $uid) {
					if ($rs = form::is_form_hash2()) {
						if ($rs === true) {
							$itemurl = trim($_POST['itemurl']);
							switch ($task['type']) {
								case '1'://淘宝
									$checkRs0 = task_tao::checkUrl($itemurl);
									$checkRs1 = task_tao::checkUrl($task['itemurl']);
									if (!$checkRs0 || !$checkRs1 || $checkRs0 != $checkRs1) $rs = '地址错误！';
								break;
								case '2'://拍拍

								break;
								case '3'://有啊
									if ($itemurl != $task['itemurl']) $rs = '地址错误！';
								break;
								case '4'://新手
									$checkRs0 = task_tao::checkUrl($itemurl);
									$checkRs1 = task_tao::checkUrl($task['itemurl']);
									if (!$checkRs0 || !$checkRs1 || $checkRs0 != $checkRs1) $rs = '地址错误！';
								break;
							}

							//if ($itemurl != $task['itemurl']) $rs = '地址错误！';

						}
						if ($rs === true) {
							db::update('task', array('isVisit' => 1), "id='$sid'");
							$_showmessage = '地址正确，请刷新页面支付！';
						} else {
							$indexMessage = language::get($rs);
						}
					}
				} else {
					showmessage('很抱歉，该任务不是您接手的，请查看是否已经超时');
				}
			} else {
				showmessage('对不起，不存在该任务');
			}
		} else {
			showmessage('参数错误');
		}
	break;
	case 'taskInfo':
		if ($sid) {
			if ($task = task_base::_get($sid)) {
				if ($task['status'] < 4) showmessage('错误');
				if ($task['buid'] == $uid) {
					$shops = db::get_list('taskshops', '*', "tid='$task[id]'");
				} else {
					showmessage('很抱歉，该任务不是您接手的，请查看是否已经超时');
				}
			} else {
				showmessage('对不起，不存在该任务');
			}
		} else {
			showmessage('参数错误');
		}
	break;
	case 'grade':
		if ($sid) {
			if ($task = task_base::_get($sid)) {
				if ($task['status'] < 4) showmessage('错误');
				if ($task['buid'] == $uid) {
					$isBuyer = true;
				} elseif ($task['suid'] == $uid) {
					$isBuyer = false;
				} else {
					showmessage('错误，您不能评价该任务');
				}
				if ($rs = form::is_form_hash2()) {
					if ($rs === true) {
						$datas = form::get(array('grade', 'int'), 'remark', array('isHide', 'int'));
						$datas = common::filterHtml($datas);
						$rs = task_grade::add($task['id'], $uid, $datas['grade'], $datas['remark'], $datas['isHide'], 0);
					}
					if (is_numeric($rs) && $rs > 0) {
						if ($rs == 1) showmessage('添加评分成功');
						elseif ($rs === 2) showmessage('修改评分成功');
					} else {
						$indexMessage = language::get($rs);
					}
				}
				$grade = task_grade::get($sid, $uid);
			} else {
				showmessage('对不起，不存在该任务');
			}
		} else {
			showmessage('参数错误');
		}
		if ($isBuyer) $title = '给发布方打分';
		else $title = '给接手方打分';
	break;
	case 'confirmExpress':
		$title = '核对快递真实地址';
		if ($sid) {
			if ($task = task_base::_get($sid)) {
				if ($task['status'] != 5) showmessage('错误');

				if ($rs = form::is_form_hash2()) {
					if ($rs === true) {
						$rs = task_base::confirmExpress($task['id'], $uid);
					}
					if ($rs === true) {
						showmessage('确认成功');
					} else {
						$indexMessage = language::get($rs);
					}
				}
				if ($sellerExpress = task_seller::getExpress($task['sid'], $task['expressTM'])) {
					$sellerExpress['area'] = str_replace(' ', '', $sellerExpress['area']);
				}
				if ($buyerExpress = task_buyer::getExpress($task['bid'], $task['expressTM'])) {
					$buyerExpress['area'] = str_replace(' ', '', $buyerExpress['area']);
				}

			} else {
				showmessage('对不起，不存在该任务');
			}
		} else {
			showmessage('参数错误');
		}
	break;
	case 'showTaskTip':
		if ($sid) {
			if ($task = task_base::_get($sid)) {
				if ($task['buid'] != $uid) {
					showmessage('很抱歉，该任务不是您接手的，请查看是否已经超时');
				} else {
					$type = $task['type'];
					$task['runTimestamp2'] = $task['ttimestamp'] - $timestamp;
				}
			} else {
				showmessage('对不起，不存在该任务');
			}
		} else {
			showmessage('参数错误');
		}
	break;
	case 'complain':
		if ($sid) {
			if ($task = task_base::_get($sid)) {
				if (db::exists('complain', array('tid' => $sid))) showmessage('该任务已经提交了申诉');
				if ($task['buid'] == $uid) {
					$isBuyer = true;
					$fuid      = $task['buid'];
					$fusername = $task['busername'];
					$tuid      = $task['suid'];
					$tusername = $task['susername'];
				} elseif ($task['suid'] == $uid) {
					$isBuyer = false;
					$fuid      = $task['suid'];
					$fusername = $task['susername'];
					$tuid      = $task['buid'];
					$tusername = $task['busername'];
				} else showmessage('非法操作');
				if ($rs = form::is_form_hash2()) {
					if ($rs === true) {
						//if (!db::exists('complain', array('tid' => $sid))) {
							$datas = form::get('title', 'remark');
							$datas = common::filterHtml($datas);
							$datas && extract($datas);
							if ($title && $remark) {
								if ($cid = db::insert('complain', array(
									'type'       => $task['type'],
									'fuid'       => $fuid,
									'fusername'  => $fusername,
									'tuid'       => $tuid,
									'tusername'  => $tusername,
									'tid'        => $sid,
									'title'      => $title,
									//'remark'     => $remark,
									'status'     => 0,
									'timestamp1' => $timestamp,
									'timestamp2' => 0
								), true)) {
									db::insert('complain_message', array(
										'cid'       => $cid,
										'type'      => 0,
										'message'   => $remark,
										'timestamp' => $timestamp
									));
									db::update('task', "complain='1'", "id='$sid'");
									if ($isBuyer) {
										task_base::addLog($sid, '发起申诉', '{busername}对任务{id}发起申述，任务已锁定');
										$msg = '您在'.language::get('qu'.$task['type']).'区的任务“'.$task['id'].'”，买家已发起申诉';
										//member_base::sendPm($task['suid'], $msg, '任务“'.$task['id'].'”被发起申诉', 'out_complain');
										//member_base::sendSms($task['suid'], $msg, 'out_complain');
										member_base::sendPm($task['suid'], $msg, '任务“'.$task['id'].'”被发起申诉', 'complain');
										member_base::sendSms($task['suid'], $msg, 'complain');
									} else {
										task_base::addLog($sid, '发起申诉', '{susername}对任务{id}发起申述，任务已锁定');
										$msg = '您在'.language::get('qu'.$task['type']).'区接的任务“'.$task['id'].'”，被卖家发起申诉';
										//member_base::sendPm($task['suid'], $msg, '任务“'.$task['id'].'”被发起申诉', 'out_complain');
										//member_base::sendSms($task['suid'], $msg, 'out_complain');
										member_base::sendPm($task['buid'], $msg, '任务“'.$task['id'].'”被发起申诉', 'complain');
										member_base::sendSms($task['buid'], $msg, 'complain');
									}
								}
								showmessage('发起申述成功，该任务已经被锁定；申诉提交36小时后，申诉专员会介入处理');
							}
						//} else showmessage('该任务已经提交了申诉');
					} else {
						$indexMessage = language::get($rs);
					}
				}
			} else {
				showmessage('对不起，不存在该任务');
			}
		} else {
			showmessage('参数错误');
		}
	break;
	case 'joinClub':
		if (task_club::isJoin($uid)) showmessage('您当前已经加入某门派，加入另外一个门派需要先退出之前所在的门派');
		if ($club = task_club::get2($id)) {
			if ($rs = form::is_form_hash2()) {
				if ($rs === true) {
					$rs = task_club::goJoin($id, $uid, $_POST['password']);
				}
				if ($rs === true) {
					showmessage('加入成功', '提示', common::getUrl('/member/club/?t=my'));
				} else {
					$indexMessage = language::get($rs);
				}
			}
		} else {
			showmessage('不存在该门派');
		}
	break;
	case 'taskBook':
		if (!$member['checkPwd2']) {
			common::setmsg('对不起，您尚未输入操作码');
			common::goto_url('/dialog/pwd2/?referer='.urlencode($baseUrl.'?type='.$type));
		}
		$type = (int)$type;
		if ($type < 1 || $type > 4) showmessage('非法操作');
		$title = '预定任务设置';
		$count1 = (int)db::one_one('card', 'sum(total2)', "uid='$uid' and cid='11' and status='1' and total2>0");
		$count2 = (int)db::one_one('card', 'sum(total3)', "uid='$uid' and cid='11' and status='1' and total3>0");
		$count = $count1 + $count2;
		if ($count == 0) showmessage('对不起，您无有效预定任务卡，不能使用预定功能；请先到点卡中心购买预定任务卡；');
		if ($rs = form::is_form_hash2()) {
			$datas = form::get2(
				array('nums', 'int'),
				array('priceLow', 'float'),
				array('priceHigh', 'float'),
				array('times', 'int'),
				array('isVerify', 'int'),
				array('isReal', 'int'),
				array('isSms', 'int'),
				array('isStop', 'int'),
				              'rejects');
			if ($rs === true) {
				$datas['type'] = $type;
				$datas['uid']  = $uid;
				$rs = task_book::setConfig($datas);
			}
			if (is_numeric($rs)) {
				showmessage('设置成功，本次增加预定任务'.$rs.'个');
			} else {
				$indexMessage = language::get($rs);
			}
		}
		if ($datas = task_book::getConfig($type, $uid)) {
			$datas['priceLow'] = sprintf('%01d', $datas['priceLow']);
			$datas['priceHigh'] = sprintf('%01d', $datas['priceHigh']);
		}
	break;
	case 'taskComment':
		if ($in) {
			$title = '到期评价的已接任务';
			$fName = 'inExpire';
			$m = 'taskIn';
		} elseif ($out) {
			$title = '到期评价的已发布任务';
			$fName = 'outExpire';
			$m = 'taskOut';
		}
	break;
	case 'reword':
		if ($suid = (int)$suid) {
			if ($memberInfo = $db->fetch_first("select * from {$pre}members t1 left join {$pre}membertask t2 on t2.uid=t1.id where t1.id='$suid'")) {
				if ($memberInfo['inComplate'] + $memberInfo['outComplate'] >= 4) {
					if ($memberInfo['rewordPoint2']==0) {
						$title = '获取推广奖励';
						$rewordPoint = cfg::getMoney('sys', 'point_reword');
						if ($rs = form::is_form_hash2()) {
							member_base::addFabudian($uid, $rewordPoint, $_POST['fType'], '获取被推广用户'.$memberInfo['username'].'的奖励');
							db::update('members', "rewordPoint2='$rewordPoint'", "id='$suid'");
							db::update('members', "rewordPoint1=rewordPoint1+$rewordPoint,rewordPointMonth=rewordPointMonth+$rewordPoint", "id='$uid'");
							member_base::sendPm($uid, '获得推广奖励'.$rewordPoint.'个发布点', '获得推广奖励', 'rmd_bonus');
							member_base::sendSms($uid, '获得推广奖励'.$rewordPoint.'个发布点', 'rmd_bonus');
							showmessage('获取成功');
						} else {
							$indexMessage = language::get($rs);
						}
					} else showmessage('很抱歉，该用户您已经领取过奖励了');
				} else showmessage('对不起，该用户还没达到奖励的条件');
			} else showmessage('不存在该用户');
		} else showmessage('错误！！');
	break;
	case 'ensure':
		if ($sid) {
			if ($task = task_base::_get($sid)) {
				if ($task['shopCount'] > 1) {
					$titles = db::get_keys('taskshops', 'title', "tid='$sid'");
					$task['title'] = implode(',', $titles);
				}
				if (db::exists('ensure', array('tid' => $sid))) showmessage('该任务已经提交了商保索赔');
				if ($timestamp - $task['ctimestamp'] > 16 * 86400) showmessage('对不起，该任务结束时间已经超过了16天不能进行商保索赔');
				if ($task['buid'] == $uid) {
					$isBuyer = true;
					$fuid      = $task['buid'];
					$fusername = $task['busername'];
					$tuid      = $task['suid'];
					$tusername = $task['susername'];
				} elseif ($task['suid'] == $uid) {
					$isBuyer = false;
					$fuid      = $task['suid'];
					$fusername = $task['susername'];
					$tuid      = $task['buid'];
					$tusername = $task['busername'];
				} else showmessage('非法操作');
				if ($isBuyer) showmessage('很抱歉，商保索赔只能由卖家发起！');
				if ($rs = form::is_form_hash2()) {
					if ($rs === true) {
						//if (!db::exists('complain', array('tid' => $sid))) {
							$datas = form::get('title', 'remark');
							$datas = common::filterHtml($datas);
							$datas && extract($datas);
							if ($title && $remark) {
								if ($cid = db::insert('ensure', array(
									'type'       => $task['type'],
									'fuid'       => $fuid,
									'fusername'  => $fusername,
									'tuid'       => $tuid,
									'tusername'  => $tusername,
									'tid'        => $sid,
									'title'      => $title,
									//'remark'     => $remark,
									'status'     => 0,
									'timestamp1' => $timestamp,
									'timestamp2' => 0
								), true)) {
									db::insert('ensure_message', array(
										'cid'       => $cid,
										'type'      => 0,
										'message'   => $remark,
										'timestamp' => $timestamp
									));
									db::update('task', "ensureStatus='1'", "id='$sid'");
									if ($isBuyer) {
										task_base::addLog($sid, '发起商保索赔', '{busername}对任务{id}发起商保索赔');
									} else {
										task_base::addLog($sid, '发起商保索赔', '{susername}对任务{id}发起商保索赔');
										//member_base::sendPm($ensure['fuid'], '维权任务'.$ensure['tid'].'成功', '维权结果', 'ensure_end');
										//member_base::sendSms($ensure['fuid'], '维权任务'.$ensure['tid'].'成功', 'ensure_end');
										member_base::sendPm($task['buid'], $task['susername'].'对您发起商保索赔，任务ID：'.$task['id'], $task['susername'].'对您发起商保索赔', 'ensure');
										member_base::sendSms($task['buid'], $task['susername'].'对您发起商保索赔，任务ID：'.$task['id'], 'ensure');
									}
								}
								showmessage('发起商保索赔成功，索赔提交36小时后，申诉专员会介入处理');
							}
						//} else showmessage('该任务已经提交了申诉');
					} else {
						$indexMessage = language::get($rs);
					}
				}
			} else {
				showmessage('对不起，不存在该任务');
			}
		} else {
			showmessage('参数错误');
		}
	break;
	case 'reflow':
		$title = '来路商品访问详情';
		$check_error = cfg::getInt('reflow', 'check_error');
		if ($sid && $lid) {
			$task = task_reflow::get($sid);
			if (!empty($type) && $type == 'lock') {
				if ($check_error && intval($task['errCount']) >= $check_error) {
					task_reflow::lock($sid);
					$task = task_reflow::get($sid);
				}
			}
			$item = db::one('task_reflow_log', '*', "id='$lid' and uid='$uid'");
			if ($task && $item) {
				if ($task['id'] == $item['tid']) {
					//
					if ($task['status'] == 2) showmessage('该任务已被锁定！');
					if ($rs = form::is_form_hash2()) {
						if ($rs === true) {
							extract(form::get3('keys'));
							if ($keys) {
								$rs = task_reflow::check($sid, $lid, $uid, $keys);
								if ($rs === true) {
									showmessage('验证成功！');
								} else $indexMessage = language::get($rs);
							} else $indexMessage = '参数错误！';
							$task = task_reflow::get($sid);
						} else {
							$indexMessage = language::get($rs);
						}
					}
				} else showmessage('错误！');
			} else showmessage('错误！');
		} else {
			showmessage('参数错误！');
		}
	break;
	case 'buyerInfo':
		if ($isVip) {
			if ($uid && $id && db::exists('task', array('suid' => $uid, 'bid' => $id))) {
				$buyer = task_buyer::getFull($id);
				if ($buyer['utype'] & 1) {
					showmessage('对不起，该接手买号为卖家掌柜号，暂不能查看其买家信誉数据');
				}
			} else showmessage('对不起，您不能查看该小号信息！');
		} else {
			showmessage('对不起，只有VIP才能查看对方买号信息！');
		}
	break;
	case 'buyerLevel':
		$title = '设置星级买号';
		if ($buyer = task_buyer::getFull($id)) {
			if ($buyer['uid'] == $uid) {
				if (db::exists('sellers', array('nickname' => $buyer['nickname']))) showmessage('对不起，该接手买号为卖家掌柜号，暂时不能查看其买家信誉数据 ');
				if ($rs = form::is_form_hash2()) {
					if ($rs === true) {
						extract(form::get3('level', 'int'));
						if (isset($level)) {
							$rs = task_buyer::setLevel($id, $uid, $level);
							if ($rs === true) {
								showmessage('设置成功！');
							} else $indexMessage = language::get($rs);
						} else $indexMessage = '参数错误！';
					} else {
						$indexMessage = language::get($rs);
					}
				}
			} else showmessage('很抱歉，没有权限！');
		} else showmessage('错误！');
	break;
	case 'tyro':
		if ($view = intval($view)) $type = 'view';
		if ($complate = intval($complate)) $type = 'complate';
		$tps = array('list', 'view', 'complate');
		(!empty($type) && in_array($type, $tps)) || $type = $tps[0];
		switch ($type) {
			case 'list':
				$list = db::select("cms_tyrotask_cate|cms_tyrotask:cid=id|(SELECT * FROM `{$pre}tyro_task_list` WHERE uid='$uid'):tid=id", '|id,title,jiangli,jiangliData|uid', "t0.ename='default'", 't1.sort');
			break;
			case 'view':
				if (!($task = db::one('cms_tyrotask', '*', "id='$view'")) ) {
					showmessage('该任务不存在！');
				}
			break;
			case 'complate':
				if (!($task = db::one('cms_tyrotask', '*', "id='$complate'")) ) {
					showmessage('该任务不存在！');
				}
				if (!db::exists('tyro_task_list', array('uid' => $uid, 'tid' => $complate))) {
					switch ($task['jiangli']) {
						case 2:
							$val = intval($task['jiangliData']);
							$checkCode = $task['checkCode'];
							$checkCode = '$uid = '.$uid.';'.$checkCode;
							if (@eval($checkCode)) {
								if (db::insert('tyro_task_list', array(
									'uid' => $uid,
									'tid' => $complate
								))) {
									member_base::addCredit($uid, $val, '完成任务'.$task['title']);
									common::goto_url('/dialog/tyro/', false, '领取成功');
								}
							} else common::goto_url('/dialog/tyro/', false, '您还没有完成该任务！');
						break;
						case 3:
							$val = intval($task['jiangliData']);
							$checkCode = $task['checkCode'];
							$checkCode = '$uid = '.$uid.';'.$checkCode;
							if (@eval($checkCode)) {
								if (db::insert('tyro_task_list', array(
									'uid' => $uid,
									'tid' => $complate
								))) {
									member_base::addFabudian($uid, $val, 1, '完成任务'.$task['title']);
									common::goto_url('/dialog/tyro/', false, '领取成功');
								}
							} else common::goto_url('/dialog/tyro/', false, '您还没有完成该任务！');
						break;
						case 4:
							$val = intval($task['jiangliData']);
							$checkCode = $task['checkCode'];
							$checkCode = '$uid = '.$uid.';'.$checkCode;
							if (@eval($checkCode)) {
								if (db::insert('tyro_task_list', array(
									'uid' => $uid,
									'tid' => $complate
								))) {
									member_base::addMoney($uid, $val, '完成任务'.$task['title']);
									common::goto_url('/dialog/tyro/', false, '领取成功');
								}
							} else common::goto_url('/dialog/tyro/', false, '您还没有完成该任务！');
						break;
					}
				}
				common::goto_url('/dialog/tyro/');
			break;
		}
	break;
	case 'review':
        echo '此功能暂未开放';
        exit;
	break;
    case 'uphaoping':
         if ($task = task_base::_get($sid)) {
             //判断task中的suid和当前的uid是否相同
             if($uid==$task[buid]){
                 if($_FILES){
                     if ($rs = form::is_form_hash2()) {
                         if ($rs === true) {
                             $upload = new upload();
                             $rs = $upload->toupload('filedata', 'image');
                             $path  = date('Y/m/', $timestamp);
                             $path1 = 'img/attach/';
                             $path2 = d('./'.$path1.$path);
                             if ($rs['count'] == 1) {
                                 !file_exists($path2) && common::create_folder($path2);
                                 if ($rs = $upload->move2($rs['info']['filedata']['db_id'], $path2)) {
                                     $pathinfo  = pathinfo($rs['source']);
                                     $filename  = $pathinfo['basename'];//image
                                    // $filename2 = $pathinfo['filename'].'_thumb.'.$pathinfo['extension'];//thumb
                                    // image::thumb($path2.$filename, $path2.$filename2, array('width' => 100, 'height' => 80));
                                     if($imageType=='pinimage')
                                        $rs=db::update('task',array('pinimage'=>"/".$path1.$path.$filename),'id="'.$sid.'"');
                                     if($imageType=='shareimage')
                                        $rs=db::update('task',array('shareimage'=>"/".$path1.$path.$filename),'id="'.$sid.'"');
                                     if($rs)
                                         echo '<script>parent.location.reload();</script>';
                                 }
                             }
                         }
                     }else {
                             $showMessage = '表单超时，请重试';
                     }
                 }else{
                     if($task[ispinimage] && empty($task[pinimage]))
                         $imageType='pinimage';
                     elseif($task[isShare] && empty($task[shareimage]))
                         $imageType='shareimage';
                     else
                         $imageType='imagexxx';//用于防止用户修改上传的文件
                 }
             }
         }

    break;
}
include(template::load($operation));
?>
