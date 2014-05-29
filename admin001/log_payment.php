<?php
$top_menu=array(
	'taobao' => '淘宝商品提现记录',
	'alipay' => '支付宝转账提现记录',
	'bank'   => '银行卡快速提现记录',
);
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$tbName = 'payment';
$status = array('待审核', '已撤销', '未验证', '已拒绝', '处理中', '已发放');
switch ($method) {
	case 'taobao':
		if ($setStatus = (int)$setStatus) {
			checkWrite();
			if ($item = db::one('payment', '*', "id='$sid'")) {
				if (!$item['status'] || $item['status'] == 4) {
					db::update('payment', array('timestamp2' => $timestamp, 'status' => $setStatus), "id='$sid'");
					if ($setStatus != 5 && $setStatus != 4) {
						member_base::addMoney($item['uid'], $item['money'], $status[$item['status']].' 返回冻结资金');
					} elseif ($setStatus == 5) {
						//msg::sendSys($item['uid'], '您申请的￥'.$item['money'].'提现已经成功', '网站提醒：提现成功');
						member_base::sendPm($item['uid'], '您通过淘宝商品申请的￥'.$item['money'].'提现已经放款', '网站提醒：提现成功', 'payment');
						member_base::sendSms($item['uid'], '您通过淘宝商品申请的￥'.$item['money'].'提现已经放款', 'payment');
					} elseif ($setStatus != 4) {
						//msg::sendSys($item['uid'], '您申请的￥'.$item['money'].'提现'.$status[$item['status']], '网站提醒：提现失败');
					}
				}
			}
			common::goto_url($referer, true);
		}
		admin::getList($tbName, '*', "type='$method'" ,'status,timestamp1 desc');
	break;
	case 'alipay':
		if ($setStatus = (int)$setStatus) {
			checkWrite();
			if ($item = db::one('payment', '*', "id='$sid'")) {
				if (!$item['status'] || $item['status'] == 4) {
					db::update('payment', array('timestamp2' => $timestamp, 'status' => $setStatus), "id='$sid'");
					if ($setStatus != 5 && $setStatus != 4) {
						member_base::addMoney($item['uid'], $item['money2'], $status[$item['status']].' 返回冻结资金');
					} elseif ($setStatus == 5) {
						//msg::sendSys($item['uid'], '您申请的￥'.$item['money'].'提现已经成功', '网站提醒：提现成功');
						member_base::sendPm($item['uid'], '您通过支付宝转账申请的￥'.$item['money'].'提现已经放款', '网站提醒：提现成功', 'payment');
						member_base::sendSms($item['uid'], '您通过支付宝转账申请的￥'.$item['money'].'提现已经放款', 'payment');
					} elseif ($setStatus != 4) {
						//msg::sendSys($item['uid'], '您申请的￥'.$item['money'].'提现'.$status[$item['status']], '网站提醒：提现失败');
					}
				}
			}
			common::goto_url($referer, true);
		}
		admin::getList($tbName, '*', "type='$method'" ,'status,timestamp1 desc');
	break;
	case 'bank':
		if ($setStatus = (int)$setStatus) {
			checkWrite();
			if ($item = db::one('payment', '*', "id='$sid'")) {
				if (!$item['status'] || $item['status'] == 4) {
					db::update('payment', array('timestamp2' => $timestamp, 'status' => $setStatus), "id='$sid'");
					if ($setStatus != 5 && $setStatus != 4) {
						member_base::addMoney($item['uid'], $item['money2'], $status[$item['status']].' 返回冻结资金');
					} elseif ($setStatus == 5) {
						//msg::sendSys($item['uid'], '您申请的￥'.$item['money'].'提现已经成功', '网站提醒：提现成功');
						member_base::sendPm($item['uid'], '您通过银行卡提现申请的￥'.$item['money'].'提现已经放款', '网站提醒：提现成功', 'payment');
						member_base::sendSms($item['uid'], '您通过银行卡提现申请的￥'.$item['money'].'提现已经放款', 'payment');
					} elseif ($setStatus != 4) {
						//msg::sendSys($item['uid'], '您申请的￥'.$item['money'].'提现'.$status[$item['status']], '网站提醒：提现失败');
					}
				}
			}
			common::goto_url($referer, true);
		}
		admin::getList($tbName, '*', "type='$method'" ,'status,timestamp1 desc');
	break;
}
?>