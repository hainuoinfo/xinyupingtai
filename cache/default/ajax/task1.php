<?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/ajax/';echo '﻿<table class="tlisttable" border="0" cellpadding="0" cellspacing="0" width="100%">
          <thead>
           <tr>
            <td class="rwdt_bt1" height="39" align="center" valign="middle" width="10"></td>
            <td class="rwdt_bt2" align="center" valign="middle" width="21%">任务编号</td>
            <td class="rwdt_bt2" align="left" valign="middle" width="12%">发布人</td>
            <td class="rwdt_bt2" align="left" valign="middle" width="12%">任务价格</td>
            <td class="rwdt_bt2" align="center" valign="middle" width="23%">发布者要求</td>
            <td class="rwdt_bt2" align="left" valign="middle" width="22%">悬赏麦点</td>
            <td class="rwdt_bt2" align="center" valign="middle" width="10%">操作</td>
            <td class="rwdt_bt3" align="center" valign="middle" width="10"></td>
          </tr>
		</thead>
		<tbody class="tlisttable">
          ';$j=0;echo '
		  ';if($list){foreach($list as $v){echo '
		<tr ';if($j%2!=0){echo ' class="rwdt_list" ';}else{echo ' class="rwdt_list fbcolor"';}echo ' valign="top">
            <td width="10">&nbsp;</td>
            <td width="21%"><span ';if($v['isCart']){echo ' class="rwdt_bh7" title="购物车任务" ';}elseif($v['isExpress']){echo ' class="task_express" title="快递任务" ';}elseif($v['visitWay']){echo ' class="rwdt_bh3" title="来路任务" ';}elseif($v['times']==0){echo ' class="rwdt_bh1" title="虚拟任务" ';}elseif($v['times']>0){echo ' class="rwdt_bh2" title="实物任务" ';}echo '  ><strong class="system1">';echo $v['id'];echo '</strong></span>
			<br>
            <span ';if($v['isEnsure']){echo ' title="接任务者需要加入平台商保" class="rwdt_xbh1" ';}echo ' class="rwdt_xbh0 block">PostTime：';echo date('H:i:s',$v['stimestamp']);echo '</span></td>
            <td width="12%">
			<a title="接任务后方可查看到对方QQ号码" target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info/?username=';echo string::getXin2($v['susername']);echo '" class="chengse"><strong>';echo string::getXin2($v['susername']);echo '</strong></a><br>
            ';if($v['vip']==1){echo '<span class="fb_vip1" title="一级VIP客户"></span>';}echo '
            ';if($v['vip']==2){echo '<span class=\'fb_vip2\' title=\'钻石VIP客户\'></span>';}echo '
			 ';if($v['vip']==3){echo '<span class=\'fb_vip3\' title=\'皇冠VIP客户\'></span>';}echo '
            </td>
            <td width="12%"><span ';if($v['isPriceFit']){echo ' class="rwdt_xgj" title="拍下商品，付款前需要联系店主修改价格，使得支付费用与任务金额相等"  ';}else{echo ' class="rwdt_db" title="平台担保：此任务卖家已缴纳全额担保存款，买家可放心购买，任务完成时，买家平台账号自动获得相应存款。"';}echo '> ';echo $v['price'];echo '</span></td>
            <td class="noktime" width="23%">
			<p ';if($v['times']==0){echo 'class="yred" ';}else{echo ' class="lvse" ';}echo 'title="任务接手付款后，';echo $lang['times'][$v['times']];echo '立即对宝贝进行收货好评！">';echo $lang['times'][$v['times']];echo '</p>
			';if($v['isVerify']){echo '<em title="接任务者需要发布者核审" class="rwdt_yq1">&nbsp;</em>';}echo '
			';if($v['isChat']){echo '<em title="任务需要旺旺模拟咨询再拍下" class="rwdt_yq4">&nbsp;</em>';}echo '
			';if($v['ispinimage']){echo ' <em title="接任务者需要上传好评图片" class="rwdt_yq6">&nbsp;</em>';}echo '
			';if($v['isRemark']){echo '<em title="按发布者提供的评语进行评价" class="rwdt_yq2">&nbsp;</em>';}echo '
			';if($v['isReal']){echo '<em title="接手买号必须通过了支付宝实名认证" class="rwdt_yq21">&nbsp;</em>';}echo '
			';if($v['isAddress']){echo '<em class="rwdt_yq3" title="任务需要指定收货地址">&nbsp;</em>';}echo '
			';if($v['isLimitCity']){echo '<em class="rwdt_yqip" title="要求接手方地址是...">&nbsp;</em>';}echo '
			';if($v['isShare']){echo '<em title="好评后对宝贝进行分享" class="rwdt_yq20">&nbsp;</em>';}echo '
			';if($v['isChatDone']){echo '<em title="任务需要模拟聊天后确认收货" class="rwdt_yq17">&nbsp;</em>';}echo '
			</td>
            <td align="left" width="22%"><span class="chengse2">
			<strong>';echo $v['point'];echo '个麦点</strong></span><br>
			';if($v['pointExt']>0){echo ' 
			<font color="#fe5500">↑ 发布者追加了麦点';echo $v['pointExt'];echo '个</font>
			';}echo '
			</td>
            <td width="10%"><p class="yred">';if($v['status']==1){echo '<a class="qrw_btn" balid="0" onclick="taskin(\'';echo $v['id'];echo '\',false,this);" href="javascript:;" title=""></a>';}else{echo '任务进行中...';}echo '</p></td>
            <td width="10">&nbsp;</td>
         </tr>
		 ';$j++;echo '
          ';}}echo '
		  ';if($is_v_num==1){echo '
		  ';$j=0;echo '
		  ';if($tlist){foreach($tlist as $v){echo '
		  <tr ';if($j%2!=0){echo ' class="rwdt_list fbcolor" ';}else{echo ' class="rwdt_list"';}echo ' valign="top">
            <td width="10">&nbsp;</td>
            <td width="21%"><span ';if($v['isCart']){echo ' class="rwdt_bh7" title="购物车任务" ';}elseif($v['isExpress']){echo ' class="rwdt_bh7" title="快递任务" ';}elseif($v['visitWay']){echo ' class="rwdt_bh3" title="来路任务" ';}elseif($v['times']==0){echo ' class="rwdt_bh1" title="虚拟任务" ';}elseif($v['times']>0){echo ' class="rwdt_bh2" title="实物任务" ';}echo '  ><strong class="system1">';echo $v['id'];echo '</strong></span>
			<br>
            <span ';if($v['isEnsure']){echo ' title="接任务者需要加入平台商保" class="rwdt_xbh1" ';}echo ' class="rwdt_xbh0 block">PostTime：';echo $v['h'];echo ':';echo $v['i'];echo ':';echo $v['s'];echo '</span></td>
            <td width="12%">
			<a title="接任务后方可查看到对方QQ号码" target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info/?username=';echo string::getXin2($v['susername']);echo '" class="chengse"><strong>';echo string::getXin2($v['susername']);echo '</strong></a><br>
            ';if($v['vip']){echo '<span class="fb_vip1" title="一级VIP客户"></span>';}echo '
            ';if($v['vip2']){echo '<span class=\'fb_vip2\' title=\'钻石VIP客户\'></span>';}echo '
			 ';if($v['vip3']){echo '<span class=\'fb_vip3\' title=\'皇冠VIP客户\'></span>';}echo '
            </td>
            <td width="12%"><span ';if($v['isPriceFit']){echo ' class="rwdt_xgj" title="拍下商品，付款前需要联系店主修改价格，使得支付费用与任务金额相等"  ';}else{echo ' class="rwdt_db" title="平台担保：此任务卖家已缴纳全额担保存款，买家可放心购买，任务完成时，买家平台账号自动获得相应存款。"';}echo '> ';echo $v['price'];echo '</span></td>
            <td class="noktime" width="23%">
			<p ';if($v['times']==0){echo 'class="yred" ';}else{echo ' class="lvse" ';}echo 'title="任务接手付款后，';echo $lang['times'][$v['times']];echo '立即对宝贝进行收货好评！">';echo $lang['times'][$v['times']];echo '</p>
			';if($v['isVerify']){echo '<em title="接任务者需要发布者核审" class="rwdt_yq1">&nbsp;</em>';}echo '
			';if($v['isChat']){echo '<em title="任务需要旺旺模拟咨询再拍下" class="rwdt_yq4">&nbsp;</em>';}echo '
			';if($v['ispinimage']){echo ' <em title="接任务者需要上传好评图片" class="rwdt_yq6">&nbsp;</em>';}echo '
			';if($v['isRemark']){echo '<em title="按发布者提供的评语进行评价" class="rwdt_yq2">&nbsp;</em>';}echo '
			';if($v['isReal']){echo '<em title="接手买号必须通过了支付宝实名认证" class="rwdt_yq21">&nbsp;</em>';}echo '
			';if($v['isAddress']){echo '<em class="rwdt_yq3" title="任务需要指定收货地址">&nbsp;</em>';}echo '
			';if($v['isLimitCity']){echo '<em class="rwdt_yqip" title="要求接手方地址是...">&nbsp;</em>';}echo '
			';if($v['isShare']){echo '<em title="好评后对宝贝进行分享" class="rwdt_yq20">&nbsp;</em>';}echo '
			';if($v['isChatDone']){echo '<em title="任务需要模拟聊天后确认收货" class="rwdt_yq17">&nbsp;</em>';}echo '
			</td>
            <td align="left" width="22%"><span class="chengse2">
			<strong>';echo $v['point'];echo '个麦点</strong></span><br>
			';if($v['pointExt']>0){echo ' 
			<font color="#fe5500">↑ 发布者追加了麦点';echo $v['pointExt'];echo '个</font>
			';}echo '
			</td>
            <td width="10%"><p class="yred">';if($v['status']==1){echo '<a class="qrw_btn" balid="0" onclick="taskin(\'';echo $v['id'];echo '\',false,this);" href="javascript:;" title=""></a>';}else{echo '任务进行中...';}echo '</p></td>
            <td width="10">&nbsp;</td>
         </tr>
		  ';$j++;echo '
		 ';}}echo '
		 ';}echo '
         </tbody>
</table>

<div class="rwdt_dlm">
  <div id="page" style="float:right;">
      ';echo $multipage;echo ' 
 </div>
</div>
';?>