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
$jiage= (int)$jiage;
$swid= $_GET['swid'];
if($swid){
$stype=2;
}else{
$stype= (int)$stype;
}
$pagesize=$r_num;	
$lang = array(
	'status'     => array('暂停中', '已发布，等待接手人接手', ''),
	'isPriceFit' => array('不需要', '需要'),
	'times'      => array('马上好评', '24小时好评', '48小时好评', '72小时好评','96小时好评','120小时好评','144小时好评','168小时好评'),
	'times_ico'  => array('&nbsp;', '&nbsp;', '<span class=\'task_24\' title=\'24小时好评\'></span>', '<span class=\'task_48\' title=\'48小时好评\'></span>', '<span class=\'task_72\' title=\'72小时好评\'></span>'),
	'scores'     => array('', 1 => '全部打1分', 2 => '全部打2分', 3 => '全部打3分', 4 => '全部打4分', 5 => '全部打5分'),
	'bStatus'    => array('正常', '危险', '挂起', '失效', '锁定', '暂停', '收藏'),
	'cardType'   => array('', '单钻信托卡', '双钻信托卡', '三钻信托卡', '四钻信托卡', '五钻信托卡', '至尊皇冠卡')
);
//自动任务	
//随机任务编号
$task_tid =virtual::create_rand($v_num);
//创建随机用户名
$task_name=virtual::create_name($v_num);
//随机价格
$task_price=virtual::create_type(1,200,0,$v_num);
//随机悬赏兔粮
$task_fabudian=virtual::create_type(1,30,9,$v_num);
//追加兔粮
$task_maidian=virtual::create_fabudian(0,9,0,$v_num);
//任务时间
 $task_claim =virtual::create_stype(0,6,$v_num);
//是否需改价
 $task_danbao =virtual::create_stype(0,1,$v_num);
 //是否VIP
 $task_vip = virtual::create_stype(0,3,$v_num);
 //是否实名
  $task_real = virtual::create_stype(0,1,$v_num);
 //是否拍前聊
  $task_chat = virtual::create_stype(0,1,$v_num);
 //是否聊后收
  $task_liao = virtual::create_stype(0,1,$v_num);
 //是否评图
  $task_tu = virtual::create_stype(0,1,$v_num);
 //是否分享
  $task_fen = virtual::create_stype(0,1,$v_num);
 //是否审核
  $task_shen = virtual::create_stype(0,1,$v_num);
 //是否来路
  $task_lu = virtual::create_stype(0,1,$v_num);
 //是否商保
  $task_bao = virtual::create_stype(0,1,$v_num);
 //是否指定收获地址
  $task_add = virtual::create_stype(0,1,$v_num);
 //是否购物车
  $task_cart = virtual::create_stype(0,1,$v_num);
 //是否快递单号
  $task_expess = virtual::create_stype(0,1,$v_num);
  //限制接手人地址
  $task_jieshou = virtual::create_stype(0,1,$v_num);
  //规定评价内容
  $task_Remark = virtual::create_stype(0,1,$v_num);
   //任务状态
  $task_status = virtual::create_stype(1,1,$v_num);
  //任务时间(时)
   $task_h=virtual::create_time($v_num);
   //任务时间(分)
   $task_i = virtual::create_stype(10,59,$v_num);
   //任务时间(秒)
   $task_s = virtual::create_stype(10,59,$v_num);
foreach ($task_h as $k => $v){
    $tlist[$k]['h']=$v;
}
foreach ($task_i as $k => $v){
    $tlist[$k]['i']=$v;
}
foreach ($task_s as $k => $v){
    $tlist[$k]['s']=$v;
}
foreach ($task_tid as $k => $v){
    $tlist[$k]['id']=$v;
}
foreach ($task_name as $k => $v){
    $tlist[$k]['susername']=$v;
}
foreach ($task_price as $k => $v){
    $tlist[$k]['price']=$v;
}
foreach ($task_claim as $k => $v){
    $tlist[$k]['times']=$v;
}
foreach ($task_fabudian as $k => $v){
    $tlist[$k]['point']=$v;
}
foreach ($task_maidian as $k => $v){
    $tlist[$k]['pointExt']=$v;
}
foreach ($task_shen as $k => $v){
    $tlist[$k]['isVerify']=$v;
}
foreach ($task_real as $k => $v){
    $tlist[$k]['isReal']=$v;
}
foreach ($task_Remark as $k => $v){
    $tlist[$k]['isRemark']=$v;
}
foreach ($task_tu as $k => $v){
    $tlist[$k]['ispinimage']=$v;
}
foreach ($task_cart as $k => $v){
    $tlist[$k]['isChat']=$v;
}
foreach ($task_liao as $k => $v){
    $tlist[$k]['isChatDone']=$v;
}
foreach ($task_fen as $k => $v){
    $tlist[$k]['isShare']=$v;
}
foreach ($task_jieshou as $k => $v){
    $tlist[$k]['isLimitCity']=$v;
}
foreach ($task_add as $k => $v){
    $tlist[$k]['isAddress']=$v;
}
foreach ($task_bao as $k => $v){
    $tlist[$k]['isEnsure']=$v;
}
foreach ($task_lu as $k => $v){
    $tlist[$k]['visitWay']=$v;
}
foreach ($task_vip as $k => $v){
    $tlist[$k]['vip']=$v;
}
foreach ($task_expess as $k => $v){
    $tlist[$k]['isExpress']=$v;
}
foreach ($task_status as $k => $v){
    $tlist[$k]['status']=$v;
}
foreach ($$task_danbao as $k => $v){
    $tlist[$k]['isPriceFit']=$v;
}
//虚拟任务结束
$urls = array('', 'tao', 'pai', 'you', 'new');
if ($fromInstation && $au >= 8 && $type >= 1 && $type <= 4) {
	$thisUrl = common::getUrl('/task/'.$urls[$type].'/');
	$tpl = 'task'.$type;
	$list = array();
	
	if ($total = db::data_count('task', "type='$type' and status in('1','2','3','4','5','6','7','8','9')")) {
		$limit = ' limit '.($page - 1) * $pagesize.','.$pagesize;
		$query = $db->query("select t1.*,t2.credits,t2.vip,t2.vip2,t2.vip3,t1.isEnsure from (select * from {$pre}task where type='$type' and status in ('1','2','3','4','5','6','7','8','9') order by status,svip desc,point desc,stimestamp desc$limit) t1 left join {$pre}memberfields t2 on t2.uid=t1.suid");
		
		 while ($line = $db->fetch_array($query)) {
			$line['slevel'] = member_credit::getLevel($line['credits']);
		//$total=450;	
	if($stype==1){
	   if($line['times']==0){
			if($jiage==0){
			$list[] = $line;
			$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}', 15, 'task');
	        }
			if($jiage==1){
			if($line['price']<=30){
			$list[] = $line;
			$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}', 15, 'task');
			}
	        }
	        if($jiage==2){
	        if(30<$line['price'] && $line['price']<=100){
			$list[] = $line;
			$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}', 15, 'task');
			}
	        }
	        if($jiage==3){
	        if(100<$line['price'] && $line['price']<=400){
			$list[] = $line;
			$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}', 15, 'task');
			}
        	}
	        if($jiage==4){
	        if(400<$line['price'] && $line['price']<=600){
			$list[] = $line;
			$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}', 15, 'task');
			}
	        }
		}
	}
	if($stype==2){
	    if($swid==0){
	       if($line['times']>=1){
			$list[] = $line;
			$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}', 15, 'task');
			}
	    }
	    if($swid==6){
	       if($line['times']>=1){
			$list[] = $line;
			$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}', 15, 'task');
			}
	    }
		if($swid==1){
	       if($line['times']==1){
			$list[] = $line;
			$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}', 15, 'task');
			}
	    }
		if($swid==2){
	       if($line['times']==2){
			$list[] = $line;
			$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}', 15, 'task');
			}
	    }
		if($swid==3){
	       if($line['times']==3){
			$list[] = $line;
			$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}', 15, 'task');
			}
	    }
		if($swid==4){
	       if($line['times']>=4){
			$list[] = $line;
			$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}', 15, 'task');
			}
	    }
	}
    
	if($stype==0){
	   if($line['times']>=0){
			if($jiage==0){
			$list[] = $line;
			$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}', 15, 'task');
	        }
			if($jiage==1){
			if($line['price']<=30){
			$list[] = $line;
			$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}', 15, 'task');
			}
	        }
	        if($jiage==2){
	        if(30<$line['price'] && $line['price']<=100){
			$list[] = $line;
			$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}', 15, 'task');
			}
	        }
	        if($jiage==3){
	        if(100<$line['price'] && $line['price']<=400){
			$list[] = $line;
			$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}', 15, 'task');
			}
        	}
	        if($jiage==4){
	        if(400<$line['price'] && $line['price']<=600){
			$list[] = $line;
			$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}', 15, 'task');
			}
	        }
		}
	 }		
			
}
	
		
	}
} else {
	$tpl = 'error';
}
include(template::load($tpl));
?>