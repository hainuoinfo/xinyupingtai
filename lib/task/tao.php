<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
$m || $m = 'index';
$ms = array('index', 'add', 'adds', 'tieBuyer', 'tieSeller', 'taskOut', 'taskIn', 'tpl', 'viprob','CreateLaiLuMission','CreateMealMission','CreateCartMission','CreateBatchMission');
($m && in_array($m, $ms)) || $m = $ms[0];
$tplName.= '_'.$m;
$pName = '淘宝互动区';
$title = $pName;
$lanP = $lanP0.'tao_';
$minCredit = 0;
$taskStatus = true;
$taskId = 1;//如同type=1一样 d都是淘宝区
if( $memberFields['credits'] < $minCredit) {
	language::get(array('name' => $lanP.'credit_less_than', 'args' => array('x' => $minCredit)));
	$taskStatus = false;
}
$thisUrl = $baseUrl0.'?m='.$m;
$lang = array(
	/*'status'     => array('暂停中', '已发布，等待接手人接手', '已接手，等待接手人绑定买号', '等待发布方审核', '已绑定买号，等待接手方支付', '已支付，等待发布人发货', '已发货，等待收货与好评', '已确认，等待卖家确认', '交易完成'),*/
 	'status'     => array(
		'暂停中',
		'等待接手',
		'已接手，等待绑定买号', '等待发布方审核', '等待接手人对商品付款', '已支付，待核对快递地址', '准备发货，等待快递单号', '已支付，等待发布人发货',
		'已发货，等待收货与好评', '已确认，等待卖家核实货款', '交易完成'),
	'isPriceFit' => array('不需要', '需要'),
	'times'      => array('马上好评', '24小时好评', '48小时好评', '72小时好评','96小时好评','120小时好评','144小时好评','168小时好评'),
	'times_ico'  => array('&nbsp;', '&nbsp;', '<span class=\'task_24\' title=\'24小时好评\'></span>', '<span class=\'task_48\' title=\'48小时好评\'></span>', '<span class=\'task_72\' title=\'72小时好评\'></span>', '<span class=\'task_96\' title=\'96小时好评\'></span>', '<span class=\'task_120\' title=\'120小时好评\'></span>', '<span class=\'task_114\' title=\'114小时好评\'></span>', '<span class=\'task_168\' title=\'168小时好评\'></span>'),
	'scores'     => array('', 1 => '全部打1分', 2 => '全部打2分', 3 => '全部打3分', 4 => '全部打4分', 5 => '全部打5分'),
	'bStatus'    => array('正常', '危险', '挂起', '失效', '锁定', '暂停', '收藏'),
	'cStatus'    => array('双方未评分', '接手方已评分', '发布方已评分', '双方已评分')
);
$allCount = db::data_count('task', "type='$taskId'");
$complateCount = db::data_count('task', "type='$taskId' and status='10'");
if (!($taskBook = task_book::getConfig($taskId, $uid))) {
	$taskBook = array('ing' => 0);
}
//增加的
$flowAll = (int)db::one_one('task_reflow', 'sum(flowComplate)', "type='$taskId'");

if ($m == 'index') {
	$bbsNav[] = $pName;
} else {
	$bbsNav[] = array('name' => $pName, 'url' => $baseUrl0);
}

//增加进来的
task_reflow::upCache();
function __parseLimitCount($str){
	$rs = array();
	foreach (explode(';', $str) as $v) {
		list($count, $point, $check) = explode(',', $v);
		$count = intval($count);
		$point = common::formatMoney($point);
		$check = isset($check) ? ($check == '1' ? true : false) : false;
		$rs[] = array(
			'count' => $count,
			'point' => $point,
			'check' => $check
		);
	}
	return $rs;
}

switch ($m) {
	case 'index':
		if ($total = task_buyer::total($taskId, $status2)) {
		    $isreal = db::data_count('buyers', "type='1' and uid='$uid' and isreal='1' and status='0'");
			$real = db::data_count('buyers', "type='1' and uid='$uid' and isreal='0' and status='0'");
			$bList = task_buyer::getList(1, $uid, $status2);
			$multipage = multi_page::parse($total, $pagesize, $page, $thisUrl.'&status='.$status.'&page={page}', $pageStyle, 10, 'member1');
		}

	break;
	case 'add'://发布任务
		$ensurePoint = 0.3;
		if ($memberFields['sellers'.$taskId] == 0 || db::data_count('sellers', "type='$taskId' and status='1'") == 0) {
			common::setMsg('对不起，请先绑定掌柜', 'indexMessage');
			common::goto_url($baseUrl0.'?m=tieSeller');
		}
		checkPwd2();
		$members = member_base::getMember($uid);
		if ($isHot && !$isVip) error::bbsMsg('对不起，只有VIP会员才可以使用掌柜热卖发布功能');
		if ($rs = form::is_form_hash2()) {
			$datas = form::get('nickname', 'itemurl', 'visitTip', 'visitKey', array('visitWay', 'int'), array('price', 'float'), array('isPriceFit', 'int'), array('pointExt', 'float'), array('times', 'int'),  array('scores', 'int'), array('isRemark', 'int'), 'remark', array('isShare', 'int'),array('isAddress', 'int'), 'address',array('share', 'int'), 'tips', array('isDbssc', 'int'),array('isVerify', 'int'),
			 array('issphb', 'float'),'sphbdz',array('isLimit', 'int'), array('limit', 'int'), array('chssp','int'),array('isNoword', 'int'),
				array('isReal', 'int'), array('cbxIsTip', 'int'),'txtBuyCount','cbIsHiddenName','cbIsNoneAssess','txtAreaService','txtAccount','txtMobile','txtSpecs','ddlDeliver','cbxName','cbxMobile','cbxcode','Province',
				array('realname', 'int'),'isFMaxBTSCount'.'FMaxBTSCount','cbxIsTaoG','txtTaoG','isawb','expressfull','isSign',
				array('isChat', 'int'), array('isChatDone', 'int'),'Express','isLimitCity','isMultiple',
				array('isStar', 'int'),'qq','cbxAddress',
				array('lvlStar', 'int'),//星级别
				array('isEnsure', 'int'),//是否商保
				array('ispinimage', 'int'),
				array('ensurePoint', 'float'),
				array('isScore', 'int'),
                array('scoreLvl', 'int'),
                array('isCredit', 'int'),//没找到这个地方  查看模板源文件后，修正到信誉限制项目
                array('creditLvl', 'int'),//没找到这个地方 查看模板源文件后，修正到信誉限制项目
                array('isGood', 'int'),
                array('goodLvl', 'int'),
                array('isBlack', 'int'),
                array('blackLvl', 'int'),
                array('isFame', 'int'),//定义项不对 已经更改 现在没有相关设置项保留
                array('fameLvl', 'int'),//定义项不对 已经更改  现在没有相关设置项保留
                array('isPlan', 'int'), 'planDate');

			if ($isHot) $count = (int)$_POST['count'];
			else $count = 1;

			if ($rs === true) {
				$datas3=$datas;
				if($datas['isLimitCity'])
					$datas['Province']=serialize($datas['Province']);
				else
					$datas['Province']='';
				//echo '<pre>';
				//var_dump($datas);exit;
				$rs = task_tao::add($datas, $uid, $count);
			}
			if ($rs === true) {
				//保存模板
				$datas2 = form::get(array('isTpl', 'int'), 'tplTo');
				$datas2 && extract($datas2);
				if ($isTpl && $tplTo) {
					$tplTo = common::cutstr($tplTo, 64);
	             	if ($members[groupid]==4) $maxTplCount = 30;
		            if ($members[groupid]==5) $maxTplCount = 15;
		            if ($members[groupid]==6) $maxTplCount = 9;
		            if ($members[groupid]==7) $maxTplCount = 6;
		            if ($members[groupid]==8) $maxTplCount = 5;
		            if ($members[groupid]==9) $maxTplCount = 4;
		            if ($members[groupid]==10) $maxTplCount = 3;
		            if ($members[groupid]==11) $maxTplCount = 3;

					/* if ($isVip) $maxTplCount = 10;
					elseif ($isVip2) $maxTplCount = 5;
					else $maxTplCount = 3; */
					if (db::data_count('task_tpl', "uid='$uid'") < $maxTplCount) {
						db::insert('task_tpl', array(
							'type'      => 1,
							'uid'       => $uid,
							'isAdds'    => 0,
							'stype'      => 1,
							'name'      => $tplTo,
							'datas'     => addslashes(serialize($datas3)),
							'timestamp' => $timestamp
						));
					}
				}
				// THE END
				common::setMsg('发布成功');
				common::goto_url($baseUrl0.'?m=taskOut');
			} else {
				$indexMessage = language::get($rs);
			}
		}
		$tplList = db::get_list2('task_tpl', 'id,name', "type='1' and uid='$uid' and stype='1'", 'timestamp desc');
		if (($tplId = (int)$tplId) && !$datas) {
			$datas = db::one_one('task_tpl', 'datas', "type='1' and uid='$uid' and stype='1' and id='$tplId'");
			$datas && $datas = unserialize($datas);
		}
		$sellers = task_seller::getSellers($uid, 1);
	break;
	case 'adds':
		$ensurePoint = 0.5;
		if ($memberFields['sellers'.$taskId] == 0 || db::data_count('sellers', "type='$taskId' and status='1'") == 0) {
			common::setMsg('对不起，请先绑定掌柜', 'indexMessage');
			common::goto_url($baseUrl0.'?m=tieSeller');
		}
		checkPwd2();
		if ($rs = form::is_form_hash2()) {
			$datas = form::get2('nickname', 'itemurl', array('price', 'float'), array('isPriceFit', 'int'), array('pointExt', 'float'), array('times', 'int'),  array('scores', 'int'), array('isRemark', 'int'), 'remark', array('isShare', 'int'), array('share', 'int'), 'tips', array('isVerify', 'int'), array('issphb', 'float'),array('isDbssc', 'int'),'Province',
				'sphbdz',array('isLimit', 'int'), array('limit', 'int'), array('isCart', 'int'), array('isAddress', 'int'), 'address', array('isExpress', 'int'), array('expressTM', 'int'),
			array('isReal', 'int'),
			array('realname', 'int'),
			array('isChat', 'int'), array('isChatDone', 'int'),
			array('isStar', 'int'),//是否星级任务
				array('lvlStar', 'int'),//星级别
				array('isEnsure', 'int'),//是否商保
				array('ensurePoint', 'float'),
			 array('isScore', 'int'), array('scoreLvl', 'int'), array('isCredit', 'int'), array('creditLvl', 'int'), array('isGood', 'int'), array('goodLvl', 'int'), array('isBlack', 'int'), array('blackLvl', 'int'), array('isFame', 'int'), array('fameLvl', 'int'), array('isPlan', 'int'), 'planDate');
			if ($rs === true) {
				$rs = task_tao::adds($datas, $uid);
			}
			if ($rs === true || is_numeric($rs)) {
				//保存模板
				$datas2 = form::get(array('isTpl', 'int'), 'tplTo');
				$datas2 && extract($datas2);
				if ($isTpl && $tplTo) {
					$tplTo = common::cutstr($tplTo, 64);
					$members = member_base::getMember($uid);
	             	if ($members[groupid]==4) $maxTplCount = 30;
		            if ($members[groupid]==5) $maxTplCount = 15;
		            if ($members[groupid]==6) $maxTplCount = 9;
		            if ($members[groupid]==7) $maxTplCount = 6;
		            if ($members[groupid]==8) $maxTplCount = 5;
		            if ($members[groupid]==9) $maxTplCount = 4;
		            if ($members[groupid]==10) $maxTplCount = 3;
		            if ($members[groupid]==11) $maxTplCount = 3;
					if (db::data_count('task_tpl', "uid='$uid'") < $maxTplCount) {
						db::insert('task_tpl', array(
							'type'      => 1,
							'stype'      => 1,
							'uid'       => $uid,
							'isAdds'    => 1,
							'name'      => $tplTo,
							'datas'     => addslashes(serialize($datas)),
							'timestamp' => $timestamp
						));
					}
				}
				// THE END
				if (is_numeric($rs)) common::setMsg('发布成功'.$rs.'个任务');
				else common::setMsg('发布成功');
				common::goto_url($baseUrl0.'?m=taskOut');
			} else {
				$indexMessage = language::get($rs);
			}
		}
		$tplList = db::get_list2('task_tpl', 'id,name', "type='1' and uid='$uid' and isAdds='1'", 'timestamp desc');
		if (($tplId = (int)$tplId) && !$datas) {
			$datas = db::one_one('task_tpl', 'datas', "type='1' and uid='$uid' and isAdds='1' and id='$tplId'");
			$datas && $datas = unserialize($datas);
		}
		$sellers = task_seller::getSellers($uid, 1);
		$eList = task_express::getList();
	break;
	case 'taskIn'://已接任务
		checkPwd2();

		if ($new) {
			if (!$taskStatus && !$memberFields['exam']) {
				common::setMsg('平台认为您的接手经验尚浅，为了您的安全，强烈要求您先通过平台的小小测试');
				common::goto_url('/member/exam/');
			}
			$rs = task_tao::in($new, $uid);
			if ($rs === true) {
				if ($memberTask['inComplate'.$taskId] < 5) common::setcookie('showTaskTip', 1);
				common::goto_url($thisUrl.'&t=ing');
			} else {
				common::goto_url($referer, true, $rs);
			}
		} else {
			$bbsNav[] = '已接任务';
			$t || $t='img';
			//$t = 'all';
			if ($out){
				$rs = task_tao::out($out, $uid);
				if ($rs === true){
					common::setMsg('退出成功');
					common::goto_url($thisUrl.'&t=all');
				} else{
					common::setMsg($rs, 'indexMessage');
					common::goto_url($referer, true);
				}
			} elseif ($pay){
				$rs = task_tao::pay($pay, $uid);
				if ($rs === true){
					common::setMsg('您已经确认支付，请联系发布方发货！');
					common::goto_url($referer, true);
				} else{
					common::setMsg($rs, 'indexMessage');
					common::goto_url($referer, true);
				}
			} elseif ($unpay){
				$rs = task_tao::unpay($unpay, $uid);
				if ($rs === true) {
					common::setMsg('任务已经返回未支付状态！');
					common::goto_url($referer, true);
				} else {
					common::setMsg($rs, 'indexMessage');
					common::goto_url($referer, true);
				}
			} elseif ($receive){
                $task = task_base::_get($receive);//先判断是否需要上传图片，如果需要上传图片，则跳转回原先的网址
                if ($task&&($task['isShare']||$task['ispinimage'])) {
                    if($task['ispinimage']&&$task['pinimage']=='')
                        $upimage=true;
                    if($task['isshare']&&$task['shareiamge']=='')
                        $upimage=true;
                }
                if($upimage){
                    common::setMsg('你尚未上传好评图！请返回上传好评图');
                    common::goto_url($referer, true);
                    exit;
                }
				$rs = task_tao::receive($receive, $uid);
				if ($rs === true){
					common::setMsg('已经确认收货，等待卖家确认');
					common::goto_url($referer, true);
				} else {
					common::setMsg($rs, 'indexMessage');
					common::goto_url($referer, true);
				}
			}
			if ($sid || $susername || $sqq || $bnickname) $search = true;
			else $search = false;
			if ($search) {
				$where = "type='1' and buid='$uid'";
				switch ($t) {
					case 'all':
					    (($where && $where .= ' and ') || !$where) && $where .= "status in('8','9')";
					break;
					case 'tWatting2':
					    (($where && $where .= ' and ') || !$where) && $where .= "status in('8','9')";
					break;
					case 'ing'://因为前台合并所以将状态8 9 合并进来
						(($where && $where .= ' and ') || !$where) && $where .= "status in('2','3','4','5','6','7','8','9')";
					break;
					case 'expire':
						(($where && $where .= ' and ') || !$where) && $where .= "status in('8','9')";
					break;
					case 'complate':
						(($where && $where .= ' and ') || !$where) && $where .= "status='10'";
					break;
				}
				$urlSuffix = '';
				if ($sid) {
					(($where && $where .= ' and ') || !$where) && $where .= "id='$sid'";
					$urlSuffix .= '&sid='.$sid;
				}
				if ($susername) {
					(($where && $where .= ' and ') || !$where) && $where .= "susername='$susername'";
					$urlSuffix .= '&susername'.urlencode($susername);
				}
				if ($sqq) {
					$suid = (int)db::one_one('members', 'id', "qq='$sqq'");
					(($where && $where .= ' and ') || !$where) && $where .= "suid='$suid'";
					$urlSuffix .= '&sqq='.$sqq;
				}
				if ($bnickname) {
					(($where && $where .= ' and ') || !$where) && $where .= "bnickname='$bnickname'";
					$urlSuffix .= '&bnickname='.urlencode($bnickname);
				}
				if ($total = db::data_count('task', $where)) {
					$tList = task_tao::getList2($where, 'where');
					$multipage = multi_page::parse($total, $pagesize, $page, $thisUrl.'&t='.$t.$urlSuffix.'&page={page}', $pageStyle, 10, 'member1');
				}
			} else {
				switch ($t) {
					case 'all':
						$total = $memberTask['in1'];
					break;
					case 'ing'://因为前台合并所以将expire 合并过来
						if ($showTaskTip = $cookie['showTaskTip']) {
							$_taskId = $cookie['_taskId'];
							common::unsetcookie('showTaskTip', '_taskId');
						}
						$total = $memberTask['ining1']+$memberTask['inExpire1'];
					break;
					case 'expire':
						$total = $memberTask['inExpire1'];
					break;
					case 'complate':
						$total = $memberTask['inComplate1'];
					break;
				}
				if ($total){
					$tList = task_tao::getList2($uid, $t);
					$multipage = multi_page::parse($total, $pagesize, $page, $thisUrl.'&t='.$t.'&page={page}', $pageStyle, 10, 'member1');
				}
			}

		}
	break;
	case 'taskOut'://已发任务
		checkPwd2();
		$bbsNav[] = '已发任务';
		$t || $t = 'ing';
		//$t = 'all';
		$total = 0;
		$where = "type='1' and suid='$uid'";
		if ($resume) {
			task_tao::resume($resume, $uid);
			common::setMsg('恢复成功');
			common::goto_url($thisUrl.'&t=waiting');
		} elseif ($pause) {
			task_tao::pause($pause, $uid);
			common::setMsg('暂停成功');
			common::goto_url($thisUrl.'&t=pause');
		} elseif ($repost) {
			$rs = task_tao::repost($repost, $uid);
			if ($rs === true) {
				common::setMsg('重新发布成功');
				common::goto_url($thisUrl.'&t=waiting');
			} else {
				common::setMsg(language::get($rs), 'indexMessage');
				common::goto_url($referer, true);
			}
		} elseif ($del) {
			$rs = task_tao::del($del, $uid);
			if ($rs === true) {
				common::setMsg('取消成功');
				common::goto_url($thisUrl.'&t=waiting');
			} else {
				common::setMsg(language::get($rs), 'indexMessage');
				common::goto_url($referer, true);
			}
		} elseif ($reject) {
			$rs = task_tao::reject($reject, $uid);
			if ($rs === true) {
				common::setMsg('辞退成功');
				common::goto_url($thisUrl.'&t=waiting');
			} else {
				common::setMsg(language::get($rs), 'indexMessage');
				common::goto_url($referer, true);
			}
		} elseif ($verify) {
			$rs = task_tao::verify($verify, $uid);
			if ($rs === true) {
				common::setMsg('审核成功');
				common::goto_url($referer, true);
			} else {
				common::setMsg(language::get($rs), 'indexMessage');
				common::goto_url($referer, true);
			}
		} elseif ($addtime) {
			$rs = task_tao::addtime($addtime, $uid);
			if ($rs === true) {
				common::setMsg('该任务已成功加时');
				common::goto_url($referer, true);
			} else {
				common::setMsg(language::get($rs), 'indexMessage');
				common::goto_url($referer, true);
			}
		} elseif ($send) {
			$rs = task_tao::send($send, $uid);
			if ($rs === true) {
				common::setMsg('您已发货完毕，请联系接手人确认收货！');
				common::goto_url($thisUrl.'&t=expire');
			} else {
				common::setMsg(language::get($rs), 'indexMessage');
				common::goto_url($referer, true);
			}
		} elseif ($confirm) {
			$rs = task_tao::confirm($confirm, $uid);
			if ($rs === true) {
				common::setMsg('恭喜您，交易完成');
				common::goto_url($thisUrl.'&t=complate');
			} else {
				common::setMsg(language::get($rs), 'indexMessage');
				common::goto_url($referer, true);
			}
		}
		if ($sid || $busername || $bqq || $bnickname) $search = true;
		else $search = false;
		if ($search) {
			$where = "type='1' and suid='$uid'";
			switch ($t) {
				case 'all':
				break;
				case 'waiting':
					(($where && $where .= ' and ') || !$where) && $where .= "status='1'";
				break;
				case 'pause':
					(($where && $where .= ' and ') || !$where) && $where .= "status='0'";
				break;
				case 'ing': //因为前台合并所以将状态8 9 合并过来
					(($where && $where .= ' and ') || !$where) && $where .= "status in('2','3','4','5','6','7','8','9')";
				break;
				case 'expire':
					(($where && $where .= ' and ') || !$where) && $where .= "status in('8','9')";
				break;
				case 'complate':
					(($where && $where .= ' and ') || !$where) && $where .= "status='10'";
				break;
			}
			$urlSuffix = '';
			if ($sid) {
				(($where && $where .= ' and ') || !$where) && $where .= "id='$sid'";
				$urlSuffix .= '&sid='.$sid;
			}
			if ($busername) {
				(($where && $where .= ' and ') || !$where) && $where .= "busername='$busername'";
				$urlSuffix .= '&busername'.urlencode($busername);
			}
			if ($bqq) {
				$buid = (int)db::one_one('members', 'id', "qq='$bqq'");
				(($where && $where .= ' and ') || !$where) && $where .= "buid='$buid'";
				$urlSuffix .= '&bqq='.$bqq;
			}
			if ($bnickname) {
				(($where && $where .= ' and ') || !$where) && $where .= "bnickname='$bnickname'";
				$urlSuffix .= '&bnickname='.urlencode($bnickname);
			}
			if ($total = db::data_count('task', $where)) {
				$tList = task_tao::getList($where, 'where');
				$multipage = multi_page::parse($total, $pagesize, $page, $thisUrl.'&t='.$t.$urlSuffix.'&page={page}', $pageStyle, 10, 'member1');
			}
		} else {
			switch ($t) {
				case 'all':
					$total = $memberTask['out1'];
				break;
				case 'waiting':
					$total = $memberTask['outWaiting1'];
					if ($pauseAll) {
						task_tao::pauseAll($uid);
						common::setMsg('全部暂停成功');
						common::goto_url($thisUrl.'&t=pause');
					}
				break;
				case 'pause':
					$total = $memberTask['outPause1'];
					if ($resumeAll) {
						task_tao::resumeAll($uid);
						common::setMsg('全部恢复成功');
						common::goto_url($thisUrl.'&t=waiting');
					}
				break;
				case 'ing'://因为前台合并所以将expire waiting 合并过来
					$total = $memberTask['outing1']+$memberTask['outExpire1']+$memberTask['outWaiting1'];
				break;
				case 'expire':
					$total = $memberTask['outExpire1'];
				break;
				case 'complate':
					$total = $memberTask['outComplate1'];
				break;
			}
			if ($total) {
				$tList = task_tao::getList($uid, $t);
				$multipage = multi_page::parse($total, $pagesize, $page, $thisUrl.'&t='.$t.'&page={page}', $pageStyle, 10, 'member1');
			}
		}
	break;
	case 'tieSeller'://绑定卖家
		checkPwd2();
		$members = member_base::getMember($uid);
		if ($members[groupid]==4) $maxTieCount = 30;
		if ($members[groupid]==5) $maxTieCount = 20;
		if ($members[groupid]==6) $maxTieCount = 10;
		if ($members[groupid]==7) $maxTieCount = 6;
		if ($members[groupid]==8) $maxTieCount = 5;
		if ($members[groupid]==9) $maxTieCount = 4;
		if ($members[groupid]==10) $maxTieCount = 3;
		if ($members[groupid]==11) $maxTieCount = 2;
		$user_group = db::one('user_groups', 'name', "id='$members[groupid]'");
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
				if ($memberFields['sellers1'] + 1 > $maxTieCount)
					$rs = '对不起，您不可以绑定更多的掌柜了';
				else {
					$datas = form::get('nickName', array('isTruth', 'int'));
					$datas && extract($datas);
					/* if (data_taobaoUser::usercheck($nickName)){ */
						if (!db::exists('sellers', array('type' => $taskId, 'nickname' => $nickName))) {
							if (db::insert('sellers', array(
								'type'       => $taskId,
								'uid'        => $uid,
								'username'   => $member['username'],
								'nickname'   => $nickName,
								'truth'      => $isTruth,
								'express'    => '',
								'timestamp1' => $timestamp,
								'status'     => 1
							))) {
								db::update('memberfields', 'sellers1=sellers1+1', "uid='$uid'");
							$totalcount=db::data_count('sellers', "uid='$uid'");
								
								//从第二次绑定掌柜开始每次绑定一个扣除五元
							if($totalcount>0)
								member_base::redMoney($uid,'5','添加掌柜扣除5元');
							}
						} else {
							$rs = '很抱歉，该掌柜已经被别人绑定了';
						}
					/* } else {
						$rs = '淘宝平台上没有检测到该用户名';
					} */
				}
			}
			if ($rs === true) {
				common::setMsg('添加成功');
				common::refresh();
			} else {
				$indexMessage = language::get($rs);
			}

		  }

			$del=$_GET['del'];
			if($del){
				if(task_seller::del($del, $uid)){
					db::update('memberfields', 'sellers1=sellers1-1', "uid='$uid'");//删除绑定淘宝帐号是，刷新绑定的数量
					//扣除5元钱
					//db::update('memberfields', 'money=money-5', "uid='$uid'");
					member_base::redMoney($uid,'5','删除掌柜扣除5元');
				    common::setMsg('删除成功');
				    common::goto_url($thisUrl);
				}else{
				     common::setMsg('删除失败');
				}
				print_r($del);
		    }
			$sList = db::get_list2('sellers', '*', "type='1' and uid='$uid'");
	break;
	case 'tieBuyer'://绑定买家
		checkPwd2();
		$members = member_base::getMember($uid);
		if ($members[groupid]==4) $maxTieCount = 100;
		if ($members[groupid]==5) $maxTieCount = 60;
		if ($members[groupid]==6) $maxTieCount = 30;
		if ($members[groupid]==7) $maxTieCount = 18;
		if ($members[groupid]==8) $maxTieCount = 16;
		if ($members[groupid]==9) $maxTieCount = 14;
		if ($members[groupid]==10) $maxTieCount = 12;
		if ($members[groupid]==11) $maxTieCount = 5;
		$user_group = db::one('user_groups', 'name', "id='$members[groupid]'");
		$status = (int)$status;
		if ($pause = (int)$pause) {
			task_buyer::pause($pause, $uid);
			common::setMsg('暂停成功');
			common::goto_url($thisUrl.'&status=6');
		} elseif ($resume = (int)$resume) {
			task_buyer::resume($resume, $uid);
			common::setMsg('恢复成功');
			common::goto_url($thisUrl.'&status=1');
		} elseif ($resumeMore) {
			task_buyer::resumeMore($resumeMore, $uid);
			common::setMsg('恢复成功');
			common::goto_url($thisUrl.'&status=1');
		} elseif ($del = (int)$del) {
			if($result=task_buyer::del($del, $uid)){
			common::setMsg($result);
			common::goto_url($thisUrl.'&status=1');
			}
		} elseif ($setCollect) {
			task_buyer::setCollect($setCollect, $uid);
			common::setMsg('设置收藏买号成功');
			common::goto_url('/task/collect/?m=buyer');
		}
		if ($rs = form::is_form_hash2()) {
			if ($rs === true) {
                $row=data_taobaoUser::realname($_POST['nickname']);
			    if($row){
				    if ($maxTieCount > 0 && $memberFields['buyers1'] + 1 > $maxTieCount){
				          $rs='对不起，您不可以绑定更多的买号了';
				    }else {
					      $nickname = $_POST['nickname'];
					      $rs = task_buyer::tie($uid, 1, $nickname,$row);
				    }
				}else{
				    $rs='对不起，您的买号不存在！';
				}
			}
			if ($rs === true) {
			    common::setMsg('买号添加成功');
				common::refresh();
			} else {
				$indexMessage = language::get($rs);
			}
		}
		$status2 = $status - 1;
		//if ($status2 < 0 || $status2 > 6) $status2 = 0;
		if ($status2 > 6) $status2 = -1;
		//if ($total = $memberFields['buyers1']) {
		if ($total = task_buyer::total1($uid, 1)) {
			$bList = task_buyer::getList1(1, $uid, $status2);
			$multipage = multi_page::parse($total, $pagesize, $page, $thisUrl.'&status='.$status.'&page={page}', $pageStyle, 10, 'buyers');
		}
	break;
	case 'tpl'://任务模板
		$bbsNav[] = '任务模板';
		if ($del = (int)$del) {
			db::delete('task_tpl', "id='$del' and uid='$uid'");
			common::setMsg('删除成功');
			common::goto_url($thisUrl);
		}
		if ($tplList = db::get_list2('task_tpl', '*', "type='1' and uid='$uid'", 'timestamp desc')) {
			foreach ($tplList as $k => $v) {
				$v['datas'] = unserialize($v['datas']);
				$tplList[$k] = $v;
			}
		}
	break;
	case 'viprob'://vip相关
		if ($rob == 1) {
			if ($isVip) {
				if ($sid = db::one_one('task', 'id', "type='$taskId' and status='1' order by svip desc,stimestamp desc")) {
					common::goto_url($baseUrl0.'?m=taskIn&new='.$sid.'&referer='.urlencode($referer));
				} else {
					common::setMsg('没有抢到');
					common::goto_url($baseUrl0);
				}
			} else {
				common::setMsg('您当前不是VIP，不能使用此功能，请先到联盟中心申请成为VIP');
				common::goto_url($baseUrl0);
			}
		} else {
			common::setMsg('参数错误');
			common::goto_url($baseUrl0);
		}
	break;
	case 'CreateMealMission':
		$ensurePoint = 0.3;
		if ($memberFields['sellers'.$taskId] == 0 || db::data_count('sellers', "type='$taskId' and status='1'") == 0) {
			common::setMsg('对不起，请先绑定掌柜', 'indexMessage');
			common::goto_url($baseUrl0.'?m=tieSeller');
		}
		checkPwd2();
		$members = member_base::getMember($uid);
		if ($rs = form::is_form_hash2()) {
			$datas = form::get('nickname', 'itemurl', 'visitTip', 'visitKey', array('visitWay', 'int'), array('price', 'float'), array('isPriceFit', 'int'), array('pointExt', 'float'), array('times', 'int'),  array('scores', 'int'), array('isRemark', 'int'), 'remark', array('isShare', 'int'),array('isAddress', 'int'), 'address',array('share', 'int'), 'tips', array('isDbssc', 'int'),array('isVerify', 'int'), array('issphb', 'float'),'sphbdz',array('isLimit', 'int'), array('limit', 'int'), 
			array('chssp', 'int'),array('isNoword', 'int'),
				array('isReal', 'int'), array('cbxIsTip', 'int'),'txtBuyCount','cbIsHiddenName','cbIsNoneAssess','txtAreaService','txtAccount','txtMobile','txtSpecs','ddlDeliver','cbxName','cbxMobile','cbxcode',
				array('realname', 'int'),'isFMaxBTSCount'.'FMaxBTSCount','cbxIsTaoG','txtTaoG','isawb','expressfull','isSign','Province',
				array('isChat', 'int'), array('isChatDone', 'int'),'Express','isLimitCity','isMultiple',
				array('isStar', 'int'),'qq','cbxAddress',
				array('lvlStar', 'int'),//星级别
				array('isEnsure', 'int'),//是否商保
				array('ispinimage', 'int'),
				array('ensurePoint', 'float'),
				array('isScore', 'int'), array('scoreLvl', 'int'), array('isCredit', 'int'), array('creditLvl', 'int'), array('isGood', 'int'), array('goodLvl', 'int'), array('isBlack', 'int'), array('blackLvl', 'int'), array('isFame', 'int'), array('fameLvl', 'int'), array('isPlan', 'int'), 'planDate');
			if ($isHot) $count = (int)$_POST['count'];
			else $count = 1;
			if ($rs === true) {
				$datas3=$datas;
				if($datas['isLimitCity'])
					$datas['Province']=serialize($datas['Province']);
				else
					$datas['Province']='';				
				$rs = task_tao::add($datas, $uid, $count);
			}
			if ($rs === true) {
				//保存模板
				$datas2 = form::get(array('isTpl', 'int'), 'tplTo');
				$datas2 && extract($datas2);
				if ($isTpl && $tplTo) {
					$tplTo = common::cutstr($tplTo, 64);
					$members = member_base::getMember($uid);
	             	if ($members[groupid]==4) $maxTplCount = 30;
		            if ($members[groupid]==5) $maxTplCount = 15;
		            if ($members[groupid]==6) $maxTplCount = 9;
		            if ($members[groupid]==7) $maxTplCount = 6;
		            if ($members[groupid]==8) $maxTplCount = 5;
		            if ($members[groupid]==9) $maxTplCount = 4;
		            if ($members[groupid]==10) $maxTplCount = 3;
		            if ($members[groupid]==11) $maxTplCount = 3;
					if (db::data_count('task_tpl', "uid='$uid'") < $maxTplCount) {
						db::insert('task_tpl', array(
							'type'      => 1,
							'uid'       => $uid,
							'isAdds'    => 0,
							'stype'      => 2,
							'name'      => $tplTo,
							'datas'     => addslashes(serialize($datas3)),
							'timestamp' => $timestamp
						));
					}
				}
				// THE END
				common::setMsg('发布成功');
				common::goto_url($baseUrl0.'?m=taskOut');
			} else {
				$indexMessage = language::get($rs);
			}
		}
		$tplList = db::get_list2('task_tpl', 'id,name', "type='1' and uid='$uid' and stype='2'", 'timestamp desc');
		if (($tplId = (int)$tplId) && !$datas) {
			$datas = db::one_one('task_tpl', 'datas', "type='1' and uid='$uid' and stype='2' and id='$tplId'");
			$datas && $datas = unserialize($datas);
		}
		$sellers = task_seller::getSellers($uid, 1);
	break;


	case 'CreateLaiLuMission':
		$ensurePoint = 0.3;
		if ($memberFields['sellers'.$taskId] == 0 || db::data_count('sellers', "type='$taskId' and status='1'") == 0) {
			common::setMsg('对不起，请先绑定掌柜', 'indexMessage');
			common::goto_url($baseUrl0.'?m=tieSeller');
		}
		checkPwd2();
		$members = member_base::getMember($uid);
		if ($rs = form::is_form_hash2()) {
			$datas = form::get('nickname', 'itemurl', 'visitTip', 'visitKey', array('visitWay', 'int'), array('price', 'float'), array('isPriceFit', 'int'), array('pointExt', 'float'), array('times', 'int'),  array('scores', 'int'), array('isRemark', 'int'), 'remark', array('isShare', 'int'),array('isAddress', 'int'), 'address',array('share', 'int'), 'tips',array('isVerify', 'int'),array('isLimit', 'int'), array('limit', 'int'), array('chssp', 'int'),array('isNoword', 'int'),
				array('isReal', 'int'), array('cbxIsTip', 'int'),'txtBuyCount','cbIsHiddenName','cbIsNoneAssess','txtAreaService','txtAccount','txtMobile','txtSpecs','ddlDeliver','cbxName','cbxMobile','cbxcode',
				array('realname', 'int'),'FMaxBTSCount','cbxIsTaoG','txtTaoG','isawb','expressfull','isSign',
				array('isChat', 'int'), array('isChatDone', 'int'),'Express','isLimitCity','isMultiple',
				'qq','cbxAddress','Province',
				array('isEnsure', 'int'),//是否商保
				array('ispinimage', 'int'),
				array('ensurePoint', 'float'),
				array('isScore', 'int'),
				array('scoreLvl', 'int'),
				array('isCredit', 'int'),
				array('creditLvl', 'int'),
				array('isGood', 'int'),
				array('goodLvl', 'int'),
				array('isBlack', 'int'),
				array('blackLvl', 'int'),
				array('isFame', 'int'),
				array('fameLvl', 'int'),
				array('isPlan', 'int'),
				'photourl',
				'planDate');
			if ($isHot) $count = (int)$_POST['count'];
			else $count = 1;
			if ($rs === true) {
				$rs = task_tao::add($datas, $uid, $count ,'photourl');
			}
			if ($rs === true) {
				//保存模板
				$datas2 = form::get(array('isTpl', 'int'), 'tplTo');
				$datas2 && extract($datas2);
				if ($isTpl && $tplTo) {
					$tplTo = common::cutstr($tplTo, 64);
					$members = member_base::getMember($uid);
	             	if ($members[groupid]==4) $maxTplCount = 30;
		            if ($members[groupid]==5) $maxTplCount = 15;
		            if ($members[groupid]==6) $maxTplCount = 9;
		            if ($members[groupid]==7) $maxTplCount = 6;
		            if ($members[groupid]==8) $maxTplCount = 5;
		            if ($members[groupid]==9) $maxTplCount = 4;
		            if ($members[groupid]==10) $maxTplCount = 3;
		            if ($members[groupid]==11) $maxTplCount = 3;
					if (db::data_count('task_tpl', "uid='$uid'") < $maxTplCount) {
						db::insert('task_tpl', array(
							'type'      => 1,
							'uid'       => $uid,
							'isAdds'    => 0,
							'stype'      => 3,
							'name'      => $tplTo,
							'datas'     => addslashes(serialize($datas)),
							'timestamp' => $timestamp
						));
					}
				}
				// THE END
				common::setMsg('发布成功');
				common::goto_url($baseUrl0.'?m=taskOut');
			} else {
				$indexMessage = language::get($rs);
			}
		}
		$tplList = db::get_list2('task_tpl', 'id,name', "type='1' and uid='$uid' and stype='3'", 'timestamp desc');
		if (($tplId = (int)$tplId) && !$datas) {
			$datas = db::one_one('task_tpl', 'datas', "type='1' and uid='$uid' and stype='3' and id='$tplId'");
			$datas && $datas = unserialize($datas);
		}
		$sellers = task_seller::getSellers($uid, 1);
	break;
	case 'CreateCartMission'://购物车任务
		$ensurePoint = 0.5;
		checkPwd2();
		$members = member_base::getMember($uid);
		if ($rs = form::is_form_hash2()) {
			$datas = form::get2('nickname', 'itemurl', array('price', 'float'), array('isPriceFit', 'int'), array('pointExt', 'float'), array('times', 'int'),  array('scores', 'int'), array('isRemark', 'int'), 'remark', array('isShare', 'int'), array('share', 'int'), 'tips', array('isVerify', 'int'),
				'sphbdz',array('isLimit', 'int'), array('limit', 'int'), array('isCart', 'int'), array('isAddress', 'int'), 'address', array('isExpress', 'int'), array('expressTM', 'int'),
			array('isReal', 'int'), 'c_text','c_chsp','c_title','c_chssp','c_price',
			array('realname', 'int'),'Province',
			array('isChat', 'int'), array('isChatDone', 'int'),
			array('isStar', 'int'),//是否星级任务
				array('lvlStar', 'int'),//星级别
				array('isEnsure', 'int'),//是否商保
				array('ensurePoint', 'float'),
			 array('isScore', 'int'), array('scoreLvl', 'int'), array('isCredit', 'int'), array('creditLvl', 'int'), array('isGood', 'int'), array('goodLvl', 'int'), array('isBlack', 'int'), array('blackLvl', 'int'), array('isFame', 'int'), array('fameLvl', 'int'), array('isPlan', 'int'), 'planDate');

			if ($rs === true) {
				$rs = task_tao::adds($datas, $uid);
			}
			if ($rs === true || is_numeric($rs)) {
				//保存模板
				$datas2 = form::get(array('isTpl', 'int'), 'tplTo');
				$datas2 && extract($datas2);
				if ($isTpl && $tplTo) {
					$tplTo = common::cutstr($tplTo, 64);
					$members = member_base::getMember($uid);
	             	if ($members[groupid]==4) $maxTplCount = 30;
		            if ($members[groupid]==5) $maxTplCount = 15;
		            if ($members[groupid]==6) $maxTplCount = 9;
		            if ($members[groupid]==7) $maxTplCount = 6;
		            if ($members[groupid]==8) $maxTplCount = 5;
		            if ($members[groupid]==9) $maxTplCount = 4;
		            if ($members[groupid]==10) $maxTplCount = 3;
		            if ($members[groupid]==11) $maxTplCount = 3;
					if (db::data_count('task_tpl', "uid='$uid'") < $maxTplCount) {
						db::insert('task_tpl', array(
							'type'      => 1,
							'uid'       => $uid,
							'isAdds'    => 1,
							'stype'    => 4,
							'name'      => $tplTo,
							'datas'     => addslashes(serialize($datas)),
							'timestamp' => $timestamp
						));
					}
				}
				// THE END
				if (is_numeric($rs)) common::setMsg('发布成功'.$rs.'个任务');
				else common::setMsg('发布成功');
				common::goto_url($baseUrl0.'?m=taskOut');
			} else {
				$indexMessage = language::get($rs);
			}
		}
		$tplList = db::get_list2('task_tpl', 'id,name', "type='1' and uid='$uid' and stype='4'", 'timestamp desc');
		if (($tplId = (int)$tplId) && !$datas) {
			$datas = db::one_one('task_tpl', 'datas', "type='1' and uid='$uid' and stype='4' and id='$tplId'");
			$datas && $datas = unserialize($datas);
		}
		$sellers = task_seller::getSellers($uid, 1);
		$eList = task_express::getList();
	break;
}
?>
