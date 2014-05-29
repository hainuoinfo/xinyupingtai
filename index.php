<?php
include(dirname(__FILE__).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
$action    || $action = 'index';
$operation || $operation = 'index';
$libRoot = d('./lib/');
$include = $libRoot.$action.'.php';//d('./lib/'.$action.'.php');
if ($member['forbidden']) error::bbsMsg('对不起，该用户暂时被禁止使用，如果想正常使用，请联系客服进行审核。');
if (file_exists($include)) {
	$baseUrl0 = '/'.$action.'/'.$operation.'/';
	$baseUrl  = $weburl.($web_rewrite?'':'/rewrite.php?rewrite=').$baseUrl0;
	$baseUrl2 = urlencode($baseUrl);
    $baseParamUrl = strpos($baseUrl0, '?') ? $baseUrl0 . '&' : $baseUrl0 . '?';
    $baseParamUrlFull = strpos($baseUrl, '?') ? $baseUrl . '&' : $baseUrl . '?';
    $paramUrl = strpos($baseUrl, '?') ? $baseUrl . '&' : $baseUrl . '?';
	$pageStyle = '
				{page>minpage}
				<a href="{url minpage}" class="pre">首 页</a>
				<a href="{url page-1}" class="pre"><</a>
				{/page}
				{pages}
				{select}<strong>{page}</strong>{else}<a href="{url}">{page}</a>{/select}
				{/pages}
				{page<maxpage}
				<a href="{url page+1}" class="next">></a>
				<a href="{url maxpage}" class="next">尾 页</a>
				{/page}
				';
	function checkPwd2(){
		global $action, $operation, $member, $baseUrl2, $nowurl;
		if (!$member['checkPwd2']) {
			common::setmsg('对不起，您尚未输入操作码');
			//common::goto_url('/member/pwd2/?referer='.$baseUrl2);
			common::goto_url('/member/pwd2/?referer='.urlencode($nowurl));
		}
	}
	plugins::callHeader();
	include($include);
	plugins::callFooter();
} else {
	error::_404();
}
?>