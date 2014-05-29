<?php
(!defined('IN_JB') || IN_JB!==true) && exit('error');
template::initialize('./templates/default/', './cache/default/');//设置BBS模板缓存目录
$lang = array(
	'status'     => array('暂停中', '已发布，等待接手人接手', ''),
	'isPriceFit' => array('不需要', '需要'),
	'times'      => array('马上好评', '24小时好评', '48小时好评', '72小时好评','96小时好评','120小时好评','144小时好评','168小时好评'),
	'times_ico'  => array('&nbsp;', '&nbsp;', '<span class=\'task_24\' title=\'24小时好评\'></span>', '<span class=\'task_48\' title=\'48小时好评\'></span>', '<span class=\'task_72\' title=\'72小时好评\'></span>'),
	'scores'     => array('', 1 => '全部打1分', 2 => '全部打2分', 3 => '全部打3分', 4 => '全部打4分', 5 => '全部打5分'),
	'cardType'   => array('', '单钻信托卡', '双钻信托卡', '三钻信托卡', '四钻信托卡', '五钻信托卡', '至尊皇冠卡')
);
set_time_limit(0);
//检查更新排行榜
$cachePrefix = 'tops_cache_update_';
//更新积分排名 一周排行
$t = $tswkStart;
$cacheName = $cachePrefix.'credit';
$arr = cache::get_array($cacheName, true);
if (!$arr || $arr['lasttime'] != $t) $update = true;
else $update = false;
if ($updateCache) $update = true;
if ($update) {
	$loak = new lock(1, 300, false, 0, __FILE__);
	if (!$lock->islock) {
		db::querys("
update {$pre}top_credit set lastTop=top;
update {$pre}top_credit set top=0;
set @i=0;
update {$pre}top_credit t1 inner join (select uid,@i:=@i+1 newTop from {$pre}memberfields order by credits DESC) t2 on t2.uid=t1.uid set t1.top=t2.newTop;
");
		cache::write_array($cacheName, array('lasttime' => $t));
	}
}
//更新发布排行榜 一周排行
$t = $tswkStart;
$cacheName = $cachePrefix.'seller';
$arr = cache::get_array($cacheName, true);
if (!$arr || $arr['lasttime'] != $t) $update = true;
else $update = false;
if ($updateCache) $update = true;
if ($update) {
	$loak = new lock(2, 300, false, 0, __FILE__);
	if (!$lock->islock) {
		/*db::querys("
update {$pre}top_seller set lastTop=top;
set @i=0;
update {$pre}top_seller t1 inner join (select uid,@i:=@i+1 newTop from {$pre}membertask order by outComplate) t2 on t2.uid=t1.uid set t1.top=t2.newTop;
");*/
		db::querys("
		UPDATE {$pre}top_seller SET lastTop=top;
		UPDATE {$pre}top_seller SET top=0;
		SET @i=0;
		UPDATE {$pre}top_seller t1 INNER JOIN (SELECT uid,@i:=@i+1 newTop FROM (SELECT suid uid,COUNT(suid) total FROM {$pre}task WHERE status='10' AND stimestamp>='$tswkStart' AND stimestamp<='$tswkEnd' GROUP BY suid) t ORDER BY total DESC) t2 ON t2.uid=t1.uid SET t1.top=t2.newTop;
");
		cache::write_array($cacheName, array('lasttime' => $t));
	}
}
//更新接手排行榜 一周排行
$t = $tswkStart;
$cacheName = $cachePrefix.'buyer';
$arr = cache::get_array($cacheName, true);
if (!$arr || $arr['lasttime'] != $t) $update = true;
else $update = false;
if ($updateCache) $update = true;
if ($update) {
	$loak = new lock(3, 300, false, 0, __FILE__);
	if (!$lock->islock) {
		/*db::querys("
update {$pre}top_buyer set lastTop=top;
set @i=0;
update {$pre}top_buyer t1 inner join (select uid,@i:=@i+1 newTop from {$pre}membertask order by inComplate) t2 on t2.uid=t1.uid set t1.top=t2.newTop;
");*/
		db::querys("
		UPDATE {$pre}top_buyer SET lastTop=top;
		UPDATE {$pre}top_buyer SET top='0';
		SET @i=0;
		UPDATE {$pre}top_buyer t1 INNER JOIN (SELECT uid,@i:=@i+1 newTop FROM (SELECT buid uid,COUNT(buid) total FROM {$pre}task WHERE status='10' AND btimestamp>='$tswkStart' AND btimestamp<='$tswkEnd' GROUP BY buid) t ORDER BY total DESC) t2 ON t2.uid=t1.uid SET t1.top=t2.newTop;
");
		cache::write_array($cacheName, array('lasttime' => $t));
	}
}
//更新推广排行榜 一月排行
$t = $tsmStart;
$cacheName = $cachePrefix.'spread';
$arr = cache::get_array($cacheName, true);
if (!$arr || $arr['lasttime'] != $t) $update = true;
else $update = false;
if ($updateCache) $update = true;
if ($update) {
	$loak = new lock(4, 300, false, 0, __FILE__);
	if (!$lock->islock) {
		/*db::querys("
update {$pre}top_spread set lastTop=top;
set @i=0;
update {$pre}top_spread t1 inner join (select id uid,@i:=@i+1 newTop from {$pre}members order by child2) t2 on t2.uid=t1.uid set t1.top=t2.newTop;
");*/
		db::querys("
		UPDATE {$pre}top_spread SET lastTop=top;
		UPDATE {$pre}top_spread SET top='0';
		SET @i=0;
		UPDATE {$pre}top_spread t1 INNER JOIN (select uid,@i:=@i+1 newTop from (SELECT parent uid,COUNT(parent) total FROM {$pre}members WHERE parent>0 AND status='1' AND reg_timestamp>='$tsmStart' AND reg_timestamp<='$tsmEnd' GROUP BY parent) t ORDER BY total DESC) t2 on t2.uid=t1.uid set t1.top=t2.newTop;
");
		cache::write_array($cacheName, array('lasttime' => $t));
	}
}
    //获取刚加入用户
	$userList = array();
		$query = $db->query("select username from {$pre}members  ORDER BY reg_timestamp desc limit 0,5");
		while ($line = $db->fetch_array($query)) {
			$userList[] = $line;
		}
	//获取正在发生动态
	$nowList = array();
		$query = $db->query("select susername,stimestamp from {$pre}task  ORDER BY stimestamp desc limit 0,7");
		while ($line = $db->fetch_array($query)) {
			$nowList[] = $line;
		}
	//获取充值动态
	$topList = array();
		$query = $db->query("select username,money,type,ctimestamp from {$pre}topup where status=1 ORDER BY ptimestamp desc limit 0,9");
		while ($line = $db->fetch_array($query)) {
			$topList[] = $line;
		}
	//获取提现动态
	$payList = array();
		$query = $db->query("select username,money,type,timestamp1 from {$pre}payment ORDER BY timestamp1 desc limit 0,9");
		while ($line = $db->fetch_array($query)) {
			$payList[] = $line;
		}
    //登录验证
		if ($rs = form::is_form_hash2()) {
			extract($_POST);
			if ($rs === true) {
				
				$rs = member_base::login($username, $password, $questionid, $answer, $login_cookietime,$$log_count);
				
			} else {
				$rs = 'login_expire';
			}
			if ($rs === true) {
				common::goto_url($referer, true);
			} else {
				if ($rs == 'accountException') common::goto_url('/member/checkAccount/?username='.urlencode($username), false, '帐号异常，请验证！');
				$indexMessage = language::get($rs, 'login', 'member');
			}
		}
		cache::get_array('questions');
		$cssList = array(
			css::getUrl('login', 'member')
		);
// THE END
include(template::load('index'));
?>