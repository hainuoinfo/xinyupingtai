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
$urls = array('', 'tao', 'pai', 'you', 'new');
if ($fromInstation && $type == 1) {
	//$thisUrl = common::getUrl('/task/'.$urls[$type].'/');
	$tpl = 'collect'.$type;
	$list = array();
	if ($total = db::data_count('task_collect', "type='$type' and status='1'")) {
		$limit = ' limit '.($page - 1) * $pagesize.','.$pagesize;
		$query = $db->query("select t1.*,t2.username,t3.credits,t3.vip,t3.vip2,t3.isEnsure from (select * from {$pre}task_collect where type='$type' and status='1' order by timestamp desc$limit) t1 left join {$pre}members t2 on t2.id=t1.uid left join {$pre}memberfields t3 on t3.uid=t2.id");
		while ($line = $db->fetch_array($query)) {
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
	}
} else {
	$tpl = 'error';
}
include(template::load($tpl));
?>