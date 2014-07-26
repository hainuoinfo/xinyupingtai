<?php $_tplModify=filemtime('D:\damaihu\xinyupingtai7\cache\default\founder\i_task.php');if(filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\h.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\header.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\f.htm')>$_tplModify||filemtime('D:\damaihu\xinyupingtai7\templates\default\founder\footer.htm')>$_tplModify){include(template::load_base('D:\damaihu\xinyupingtai7\templates\default\founder\i_task.htm','D:\damaihu\xinyupingtai7\cache\default\founder\i_task.php',true));exit;}?><?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/founder/';echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<script type="text/javascript" src="http://damaihu.tertw.net/javascript/jquery.min.js"></script><script type="text/javascript" src="http://damaihu.tertw.net/javascript/form_hack.js"></script>
<link href="http://damaihu.tertw.net/css/founder/founder.css" rel="stylesheet" type="text/css" /><script type="text/javascript" src="http://damaihu.tertw.net/javascript/common.func.js"></script>
<script language="javascript">
$.ajaxSetup({';echo 'cache:false';echo '});
var goto=function(name){';echo '
	location.href=\'index.php?action=';echo $action;echo '&operation=';echo $operation;echo '&method=\'+name;
';echo '}
';if($info){echo '
alert(\'';echo addcslashes($info,'\'\\');echo '\');
';}echo '
</script>
</head>
<body>
<script type="text/JavaScript">
if(parent.$(\'admincpnav\')) parent.$(\'admincpnav\').innerHTML=\'';echo $menu_name;echo '&nbsp;&raquo;&nbsp;';echo $menu_sub_name;echo '\';
if(parent.$(\'add2custom\')) parent.$(\'add2custom\').innerHTML=\'<a href="admincp.php?action=misc&operation=custommenu&do=add&title=cplog_tasks&url=action%3Dtasks" target="main"><img src="images/admincp/btn_add2menu.gif" title="添加到常用操作" width="19" height="18" /></a>\';
if(parent.$(\'custombar_add\')) parent.$(\'custombar_add\').innerHTML=\'';if(!$custom_menu_exists){echo '<span onclick="add_admin_menu(\\\'';echo $action;echo '\\\',\\\'';echo $operation;echo '\\\')" title="把当前页面添加到任务栏" />&nbsp;&nbsp;&nbsp;&nbsp;添加到任务栏</span>';}echo '\';
</script>';echo '
<script language="javascript">
$(function(){';echo '
	$(\'input\').each(function(){';echo '
		if(\'radio|checkbox|\'.indexOf($(this).attr(\'type\')+\'|\')>=0){';echo '
			if($(this).parent().attr(\'tagName\')==\'LI\'){';echo '
				$(this).click(function(){';echo '
					$(this).parent().parent().find(\'li.checked\').removeClass(\'checked\');
					$(this).parent().addClass(\'checked\');
				';echo '});
			';echo '}
		';echo '}
	';echo '});
';echo '});
</script>
<div class="container" id="cpcontainer">
	<div class="floattop">
		<div class="itemtitle">
			<h3>';echo $menu_sub_name;echo '</h3>
			<ul class="tab1">
				';if($top_menu){foreach($top_menu as $k=>$v){echo '
				';if(!is_array($v)||$v['hide']===false||$k==$method){echo '
				<li';if($k==$method){echo ' class="current"';}echo '>
					';if(is_array($v)){echo '
						';if(!empty($v['url'])){echo '
						<a href="';echo $v['url'];echo '"><span>';echo $v['name'];echo '</span></a>
						';}else{echo '
						<a href="';if($v['hide']){echo '';echo $nowurl;echo '';}else{echo '';echo $base_url;echo '&method=';echo $k;echo '';if($v['attach']){echo '';echo $v['attach'];echo '';}echo '';}echo '"><span>';echo $v['name'];echo '</span></a>
						';}echo '
					';}else{echo '
						<a href="';echo $base_url;echo '&method=';echo $k;echo '"><span>';echo $v;echo '</span></a>
					';}echo '
					
				</li>
				';}echo '
				';}}echo '
			</ul>
		</div>
	</div>
	<div class="floattopempty"></div>';echo '
';if($method!='view'){echo '
<br />
<div class="itemtitle">
 	<h3></h3>
	<ul class="tab1">
		';if($top_menu2){foreach($top_menu2 as $k=>$v){echo '
		';if(!is_array($v)||$v['hide']===false||$k==$method2){echo '
		<li';if($k==$method2){echo ' class="current"';}echo '><a href="';if(is_array($v)&&$v['hide']){echo '';echo $nowurl;echo '';}else{echo '';echo $base_url;echo '&method=';echo $method;echo '&method2=';echo $k;echo '';if(is_array($v)&&$v['attach']){echo '';echo $v['attach'];echo '';}echo '';}echo '"><span>';echo is_array($v)?$v['name']:$v;echo '</span></a></li>
		';}echo '
		';}}echo '
	</ul>
</div>
';}echo '
';if($method=='tao'||$method=='new'||$method=='pai'||$method=='you'){echo '
<form method="post" enctype="application/x-www-form-urlencoded">
';echo $sys_hash_code;echo '
	<table class="tb tb2 fixpadding">
		<tr>
			<th class="partition" colspan="9">该状态的任务，总担保价：';echo $taskInfo['priceAll'];echo '￥，总发布点：';echo $taskInfo['pointAll'];echo '</th>
		</tr>
		<tr class="header">
			<th>删？</th>
			<th>发布人</th>
			<th>接手人</th>
			<th>类型</th>
			<th>商品总价</th>
			<th>发布点</th>
			<th>发布时间</th>
			<td>状态</td>
			<th></th>
		</tr>
		';if($list){foreach($list as $v){echo '
		<tr class="hover">
			<td><!--<input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox"';if($v['status']>=1&&$v['status']<10){echo ' disabled="disabled"';}echo ' />--><input type="checkbox" name="del[]" value="';echo $v['id'];echo '" class="checkbox" /></td>
			<td>';echo $v['susername'];echo '</td>
			<td>';echo $v['busername'];echo '</td>
			<td>';if($v['isCart']){echo '购物车';}elseif($v['isExpress']){echo '真实快递';}else{echo '普通商品';}echo '</td>
			<td>';echo $v['price'];echo '</td>
			<td>';echo $v['point'];echo '</td>
			<td>';echo date('Y-m-d H:i:s',$v['stimestamp']);echo '</td>
			<td>';echo $status[$v['status']];echo '</td>
			<td>[<a href="';echo $base_url;echo '&method=view&sid=';echo $v['id'];echo '">详情</a>]</td>
		</tr>
		';}}echo '
		<tr>
			<td><label><input type="checkbox" onclick="check_all(this,\'del[]\')" class="checkbox" />全选</label></td>
			<td colspan="8">';echo $multipage;echo '</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="9"><input type="submit" value="提交" class="btn" /></td>
		</tr>
	</table>
</form>
';}elseif($method=='view'){echo '
<form method="post" enctype="application/x-www-form-urlencoded">
';echo $sys_hash_code;echo '
	<table class="tab_view" style="width:800px">
		<tr class="tip">
			<td colspan="2">任务详情</td>
		</tr>
		<tr>
			<th>任务ID</th>
			<td>';echo $task['id'];echo '</td>
		</tr>
		<tr>
			<th>所属区域</th>
			<td>';echo $types[$task['type']];echo '</td>
		</tr>
		<tr>
			<th>发布者</th>
			<td>';echo $task['susername'];echo '';if($task['vip']){echo '(VIP)';}echo '</td>
		</tr>
		<tr>
			<th>掌柜</th>
			<td>';echo $task['nickname'];echo '</td>
		</tr>
		<tr class="tip">
			<td colspan="2">商品详情</td>
		</tr>
		<tr>
			<th>商品类型</th>
			<td>';if($task['isCart']){echo '购物车';}elseif($task['isExpress']){echo '真实快递';}else{echo '普通商品';}echo '</td>
		</tr>
		<tr>
			<th>是否修改价格</th>
			<td>';if($task['isPriceFit']){echo '是';}else{echo '否';}echo '</td>
		</tr>
		<tr>
			<th>好评时限要求</th>
			<td>';echo $times[$task['times']];echo '</td>
		</tr>
		<tr>
			<th>店铺动态评分</th>
			<td>';echo $lang['scores'][$task['scores']];echo '</td>
		</tr>
		';if($v['isRemark']){echo '
		<tr>
			<th>规定好评内容</th>
			<td>';echo $task['remark'];echo '</td>
		</tr>
		';}echo '
		<tr>
			<th>留言提醒</th>
			<td>';echo $task['tips'];echo '</td>
		</tr>
		';if($v['isAddress']){echo '
		<tr>
			<th>指定收货地址</th>
			<td>';echo $task['address'];echo '</td>
		</tr>
		';}echo '
		';if($v['isShare']){echo '
		<tr>
			<th>购物分享</th>
			<td>';echo $lang['share'][$task['share']];echo '</td>
		</tr>
		';}echo '
		';if($v['isLimit']){echo '
		<tr>
			<th>限制接手人</th>
			<td>一天接';echo $task['limit'];echo '个</td>
		</tr>
		';}echo '
		<tr>
			<th>认证方式</th>
			<td>';if($task['isVerify']){echo '需要审核,';}echo '';if($task['isReal']){echo '实名认证,';}echo '';if($task['isChat']){echo '旺旺聊天,';}echo '';if($task['isChatDone']){echo '旺旺确认,';}echo '</td>
		</tr>
		<tr>
			<th>过滤条件</th>
			<td>
				';if($task['isScore']){echo '接手人积分不低于';echo $task['scoreLvl'];echo '<br />';}echo '
				';if($task['isCredit']){echo '接手人信用额度不低于';echo $task['creditLvl'];echo '<br />';}echo '
				';if($task['isGood']){echo '接手人刷客满意度不低于';echo $task['goodLvl'];echo '<br />';}echo '
				';if($task['isBlack']){echo '接手人被拉黑名单数不大于';echo $task['blackLvl'];echo '<br />';}echo '
				';if($task['isFame']){echo '接手买号买家信誉度不高于';echo $task['fameLvl'];echo '<br />';}echo '
			</td>
		</tr>
		';if($task['isCart']||$task['isExpress']){echo '
		';if($shops){foreach($shops as $k=>$v){echo '
		<tr>
			<th>第';echo $k+1;echo '个商品</th>
			<td>
				<table class="tab_view" style="width:550px">
					<tr>
						<th style="width:100px">名称</th>
						<td>';echo $v['title'];echo '</td>
					</tr>
					<tr>
						<th style="width:100px">地址</th>
						<td>';echo $v['itemurl'];echo '</td>
					</tr>
					<tr>
						<th style="width:100px">担保价格</th>
						<td>';echo $v['price'];echo '</td>
					</tr>
					<tr>
						<th style="width:100px">追加发布点</th>
						<td>';echo $v['pointExt'];echo '</td>
					</tr>
				</table>
			</td>
		</tr>
		';}}echo '
		<tr>
			<th>商品总价</th>
			<td>';echo $task['price'];echo '</td>
		</tr>
		<tr>
			<th>共发布点</th>
			<td>';echo $task['point'];echo '</td>
		</tr>
		';}else{echo '
		<tr>
			<th>商品名称</th>
			<td>';echo $task['title'];echo '</td>
		</tr>
		<tr>
			<th>商品价格</th>
			<td>';echo $task['price'];echo '</td>
		</tr>
		<tr>
			<th>商品地址</th>
			<td>';echo $task['itemurl'];echo '</td>
		</tr>
		';}echo '

		<tr>
			<th>指定收货地址</th>
			<td>';echo $task['address'];echo '</td>
		</tr>
		<tr>
			<th>访问方式</th>
			<td>
				';if($task['visitWay']==0){echo '直接访问';}elseif($task['visitWay']==1){echo '搜索店铺-';echo $task['visitKey'];echo '-';echo $task['visitTip'];echo '';}elseif($task['visitWay']==2){echo '搜索宝贝-';echo $task['visitKey'];echo '-';echo $task['visitTip'];echo '';}elseif($task['visitWay']==3){echo '信用页面打开-';echo $task['visitKey'];echo '-';echo $task['visitTip'];echo '';}echo '
			</td>
		</tr>
		';if($task['isExpress']&&$task['status']==6){echo '
		<tr class="tip">
			<td colspan="2">快递信息</td>
		</tr>
		<tr>
			<th>快递名称</th>
			<td>';echo $task['expressName'];echo '</td>
		</tr>
		<tr>
			<th>收件人信息</th>
			<td>
				<table class="tab_view" style="width:550px">
					<tr>
						<th style="width:100px">姓名</th>
						<td>';echo $buyerExpress['nickname'];echo '</td>
					</tr>
					<tr>
						<th style="width:100px">地址</th>
						<td>';if($task['isAddress']&&$task['address']){echo '';echo $task['address'];echo '';}else{echo '';echo $buyerExpress['area'];echo '';echo $buyerExpress['address'];echo '';}echo '</td>
					</tr>
					<tr>
						<th style="width:100px">手机</th>
						<td>';echo $buyerExpress['mobilephone'];echo '</td>
					</tr>
					<tr>
						<th style="width:100px">电话</th>
						<td></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th>发件人</th>
			<td>
				<table class="tab_view" style="width:550px">
					<tr>
						<th style="width:100px">姓名</th>
						<td>';echo $sellerExpress['nickname'];echo '</td>
					</tr>
					<tr>
						<th style="width:100px">地址</th>
						<td>';echo $sellerExpress['area'];echo '';echo $sellerExpress['address'];echo '</td>
					</tr>
					<tr>
						<th style="width:100px">手机</th>
						<td>';echo $sellerExpress['mobilephone'];echo '</td>
					</tr>
					<tr>
						<th style="width:100px">电话</th>
						<td></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th>快递运单号</th>
			<td><input type="text" name="expressNum" maxlength="16" class="txt" value="';echo $task['expressNum'];echo '" style="width:240px" /></td>
		</tr>
		<tr>
			<th></th>
			<td><input type="submit" value="提交" class="btn" /></td>
		</tr>
		';}echo '
	</table>
</form>
<br /><br /><br />
';}echo '
';echo '</div>
';echo '</body>
</html>';?>