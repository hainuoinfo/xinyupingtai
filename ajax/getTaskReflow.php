<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
common::char_set();
common::nocache();
if (!$memberLogined) {
	echo '对不起，请先登陆后再操作！';
	exit;
}
template::initialize('./templates/default/ajax/', './cache/default/ajax/');
$type = (int)$type;
//$fromInstation = 1;
if ($fromInstation && $type >= 1 && $type <= 1) {
	$pagesize = 300;
	$bgColors = array('#FFEEEE', '#EEFFEE','#EEEEFF');
	$thisUrl = common::getUrl('/task/'.$urls[$type].'/');
	$tpl = 'taskReflow'.$type;
	$where = "type='$type' and status='1' and (isRate='0' or isRate='1' and (lastTime='0' or lastTime>'0' and rateTime<=$timestamp-lastTime))";
	$list = array();
	if ($total = db::data_count('task_reflow', $where)) {
		/*$limit = ($page - 1) * $pagesize.','.$pagesize;
		$limit = ' limit '. $limit;
		$query = $db->query("select t1.*,t2.username,t3.vip,t3.vip2,t3.credits,t3.isEnsure from (select * from {$pre}task_reflow where $where order by status,bidUp DESC,time desc$limit) t1 left join {$pre}members t2 on t2.id=t1.suid left join {$pre}memberfields t3 on t3.uid=t2.id");
		while ($line = $db->fetch_array($query)) {
			$line['level'] = member_credit::getLevel($line['credits']);
			$list[] = $line;
		}*/
		$list = db::select('task_reflow', '*', $where, 'bidUp DESC,time DESC', $pagesize, $page);
		$multipage = multi_page::parse($total, $pagesize, $page, 'javascript:goPage({page});', '{page>minpage}
				<a href="{url page-1}" class="pre"><</a>
				{/page}
				{pages}{select}<strong>{page}</strong>{else}<a href="{url}">{page}</a>{/select}{/pages}
				{page<maxpage}
				<a href="{url page+1}" class="next">></a>
				{/page}
				', 10, 'task');
		$__list = array();
		$listMulti = array();
		$size = count($bgColors);
		$i = 0;
		foreach ($list as $v) {
			$__list[$i][] = $v;
			$i++;
			$i == $size && $i = 0;
		}
		$i = 0;
		foreach ($__list as $k => $v) {
			$listMulti[$k] = array(
				'bgColor' => $bgColors[$k],
				'open'    => true,
				'datas'   => $v
			);
			$i ++;
		}
		for ($j = $i; $j < $size; $j++) {
			$listMulti[$j] = array(
				'bgColor' => $bgColors[$j],
				'open'    => false,
				'datas'   => array()
			);
		}
		foreach ($listMulti as $k => $v) {
			if ($v['datas']) {
				$__lsBid = common::arrid($v['datas'], 'bidUp');
				$__ls = common::arrid($v['datas'], 'flowTotal');
				foreach ($__ls as $__k => $__v) $__ls[$__k] = $__v > 0 ? 1 : 0;
				array_multisort($__ls, SORT_DESC, SORT_NUMERIC, $__lsBid, SORT_DESC, SORT_NUMERIC, $v['datas']);
				$listMulti[$k] = $v;
			}
		}
		/*foreach ($listMulti as $k => $v) {
			if ($v['datas']) {
				$__ls = common::arrid($v['datas'], 'flowTotal');
				foreach ($__ls as $__k => $__v) $__ls[$k] = $__v > 0 ? 1 : 0;
				//array_multisort($__ls, SORT_DESC, SORT_NUMERIC, $v['datas']);
				//$listMulti[$k] = $v;
			}
		}*/
	}
} else {
	$tpl = 'error';
}
include(template::load($tpl));
?>