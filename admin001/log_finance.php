<?php
$top_menu=array(
	'index'      => '常规记录',
	'dataVerify' => '数据校验'
);
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
switch ($method) {
	case 'index':
		$cardOnePrice = array(
			0, 
			cfg::getMoney('card', 'card1'), 
			cfg::getMoney('card', 'card2'), 
			cfg::getMoney('card', 'card3'), 
			cfg::getMoney('card', 'card4'), 
			cfg::getMoney('card', 'card5'), 
			cfg::getMoney('card', 'card6'), 
			cfg::getMoney('card', 'card7'), 
			cfg::getMoney('card', 'card8'), 
			cfg::getMoney('card', 'card9'), 
			cfg::getMoney('card', 'card10'), 
			cfg::getMoney('card', 'card11'), 
			cfg::getMoney('card', 'card12')
		);
		$cardOnePrice1 = array(3 => 1, 1, 1, 1, 1, 1);
		$cardNames = array(
			'', '单次发布点卡', '流量点卡', '单钻信托卡', '双钻信托卡', '三钻信托卡', '四钻信托卡', '五钻信托卡', '至尊皇冠卡', '24小时双倍积分卡', '双倍积分周卡', '预定任务次卡', '至尊VIP体验卡'
	);
		$cardNames2 = array('', '单钻信托卡', '双钻信托卡', '三钻信托卡', '四钻信托卡', '五钻信托卡', '至尊皇冠卡');
		$userCount = db::data_count('members');
		$vipCount  = db::data_count('memberfields', "vip='1'");
		$cardMoneyList = array();
		foreach ($cardNames as $k => $v) {
			if ($k > 0) {
				$_count = (int)db::one_one('card', 'sum(total1)', "cid='$k'");
				$_price = $cardOnePrice1[$k];
				isset($_price) || $_price = $cardOnePrice[$k];
				$cardMoneyList[$k] = $_count * $_price;
			}
		}
		$line = db::one('memberfields', 'sum(money) money,sum(fabudian) point,sum(ensureMoney) ensureMoney');
		$moneyAll = (float)$line['money'];
		$pointAll = (float)$line['point'];
		$ensureMoneyAll = common::formatMoney($line['ensureMoney']);
		$vipMoneyAll = 0;
		$query = $db->query("SELECT month,sum(month) AS `all` FROM `{$pre}log_vip` GROUP BY `month`;");
		while ($line = $db->fetch_array($query)) {
			if ($line['month'] == 1)      $vipMoneyAll += $line['all'] * 30;
			elseif ($line['month'] == 3)  $vipMoneyAll += $line['all'] / 3 * 78;
			elseif ($line['month'] == 6)  $vipMoneyAll += $line['all'] / 6 * 138;
			elseif ($line['month'] == 12) $vipMoneyAll += $line['all'] / 12 * 248;
			else                          $vipMoneyAll += $line['all'] * 20;
		}
		$topupMoney = (float)db::one_one('topup', 'sum(money1)', "ctimestamp>=$today_start and ctimestamp<=$today_end");
		$paymentMoney = (float)db::one_one('payment', 'sum(money)', "timestamp2>=$today_start and timestamp2<=$today_end");
		$logMoney1 = (float)db::one_one('log', 'sum(val)', "timestamp>=$today_start and timestamp<=$today_end and type='money' and val>0");
		$logMoney2 = (float)db::one_one('log', 'sum(val)', "timestamp>=$today_start and timestamp<=$today_end and type='money' and val<0");
		$logMoney3 = $logMoney1 + $logMoney2;
		$logPoint1 = (float)db::one_one('log', 'sum(val)', "timestamp>=$today_start and timestamp<=$today_end and type='fabudian' and val>0");
		$logPoint2 = (float)db::one_one('log', 'sum(val)', "timestamp>=$today_start and timestamp<=$today_end and type='fabudian' and val<0");
		$logPoint3 = $logPoint1 + $logPoint2;
		$line = db::one('task', 'sum(price) price,sum(point) point', "status='10' and stimestamp>=$today_start and stimestamp<=$today_end");
		$taskCMoney = (float)$line['price'];
		$taskCPoint = (float)$line['point'];
		$line = db::one('task', 'sum(price) price,sum(point) point', "status<>'10' and stimestamp>=$today_start and stimestamp<=$today_end");
		$taskMoney = (float)$line['price'];
		$taskPoint = (float)$line['point'];
	break;
	case 'dataVerify':
		
	break;
}
?>