<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
common::char_set();
common::nocache();
if (!$memberLogined) {
	echo '对不起，请先登陆后再操作！';
	exit;
}
template::initialize('./templates/default/ajax/', './cache/default/ajax/');
$au = (int)$au;
$type = (int)$type;
/*
 * TODO      需要增加type的说明
 * type=1表示淘宝区
 * type=2是拍拍区？
 *
 */

//$fromInstation = 1;
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
$urls = array('', 'tao', 'pai', 'you', 'new');
if ($fromInstation && $au >= 8 && $type >= 1 && $type <= 4) {
	$thisUrl = common::getUrl('/task/'.$urls[$type].'/');
    $thisUrl.="?m=".$m;
    $t || $t=ing;
    $thisUrl.="&t=".$t;
	$tpl = 'task'.$type;
	$list = array();
    switch($m){
        case 'taskIn':
            $tpl.="_in";
            switch ($t) {
                case 'all':
                    $total = $memberTask['in1'];
                    break;
                case 'ing':
                    if ($showTaskTip = $cookie['showTaskTip']) {
                        $_taskId = $cookie['_taskId'];
                        common::unsetcookie('showTaskTip', '_taskId');
                    }
                    $total = $memberTask['ining1'];
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
            break;

        case 'taskOut':
            $tpl.="_out";
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
                 case 'ing':
                     $total = $memberTask['outing1'];
                     break;
                 case 'expire':
                     $total = $memberTask['outExpire1'];
                     break;
                 case 'complate':
                     $total = $memberTask['outComplate1'];
                     break;
             }
             if ($total) {
                 $list = task_tao::getList($uid, $t);
                 $multipage = multi_page::parse($total, $pagesize, $page, $thisUrl.'&t='.$t.'&page={page}', $pageStyle, 10, 'member1');
             }
            break;
    }

	/*这里因为不符合逻辑去掉，重新写这个方法
	 * if ($total = db::data_count('task', "type='$type' and status in('1','2','3','4','5','6','7','8','9')")) {
		//$query = $db->query("select t1.id,t1.susername,t1.times,t1.price,t1.point,isShare,isRemark,visitWay,isReal,isChat,isChatDone,t1.status,t1.stimestamp,t2.credits,t2.vip,t2.vip2 from {$pre}task t1 left join {$pre}memberfields t2 on t2.uid=t1.suid where t1.type='$type' and t1.status in ('1','2','3','4','5','6','7')");
		$limit = ' limit '.($page - 1) * $pagesize.','.$pagesize;
		$query = $db->query("select t1.*,t2.credits,t2.vip,t2.vip2,t1.isEnsure from (select * from {$pre}task where type='$type' and status in ('1','2','3','4','5','6','7','8','9') order by status,svip desc,point desc,stimestamp desc$limit) t1 left join {$pre}memberfields t2 on t2.uid=t1.suid");
		while ($line = $db->fetch_array($query)) {
			//这里加入预定的代码
			if ($line['status'] == 1) {
				//查询预定的会员
				$line2 = $db->fetch_first("select t1.* from {$pre}task_book t1 where uid<>'$line[suid]' and isStop='0' and ing>0 and type='$line[type]' and priceLow<='$line[price]' and priceHigh>='$line[price]' and(times='$line[times]' or times='0') and (isVerify='$line[isVerify]') and (isReal='0' or isReal<>'$line[isReal]') and not exists(select * from {$pre}task_book_filter t2 where t2.type=t1.type and t2.uid=t1.uid and t2.fuid='$line[suid]') limit 1");
				if ($line2) {
					switch ($line['type']) {
						case 1:
							//淘宝区
							$rs = task_tao::in($line['id'], $line2['uid']);
							if ($rs === true) {
								db::update('task_book', 'ing=ing-1', "type='$line2[type]' and uid='$line2[uid]'");
								db::update('card', 'total3=total3-1,total4=total4+1', "uid='$line2[uid]' and status='1' and total3>0", 1);
								$msg = '恭喜您在'.language::get('qu'.$line['type']).'区成功预定了一个任务“'.$line['id'].'”，请尽快完成';
								member_base::sendPm($line2['uid'], $msg, '成功预定到任务“'.$line['id'], 'in_book');
								member_base::sendSms($line2['uid'], $msg, 'in_book');
							}
						break;
						case 2:
							//拍拍区
							$rs = task_pai::in($line['id'], $line2['uid']);
							if ($rs === true) {
								db::update('task_book', 'ing=ing-1', "type='$line2[type]' and uid='$line2[uid]'");
								db::update('card', 'total3=total3-1,total4=total4+1', "uid='$line2[uid]' and status='1' and total3>0", 1);
								$msg = '恭喜您在'.language::get('qu'.$line['type']).'区成功预定了一个任务“'.$line['id'].'”，请尽快完成';
								member_base::sendPm($line2['uid'], $msg, '成功预定到任务“'.$line['id'], 'in_book');
								member_base::sendSms($line2['uid'], $msg, 'in_book');
							}
						break;
						case 3:
							//有啊区      因为百度有啊已经撤销，所以不再使用
                        break;
						case 4:
							//新手区
						break;
					}
				}
			}
			$line['slevel'] = member_credit::getLevel($line['credits']);
			$list[] = $line;
		}
		$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}
				<a href="{url page-1}" class="pre"><</a>
				{/page}
				{pages}{select}<strong>{page}</strong>{else}<a href="{url}">{page}</a>{/select}{/pages}
				{page<maxpage}
				<a href="{url page+1}" class="next">></a>
				{/page}
				', 10, 'task');
	}*/
} else {
	$tpl = 'error';
}

include(template::load($tpl));
?>