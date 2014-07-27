<?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/ajax/';echo '<table class="tlisttable" border="0" cellpadding="0" cellspacing="0" width="100%">
          <thead>
            <tr><td class="rwdt_bt1" align="center" height="39" valign="middle" width="10"></td>
            <td class="rwdt_bt2" align="center" valign="middle" width="21%">任务编号</td>
            <td class="rwdt_bt2" align="left" valign="middle" width="12%">发布人</td>
            <td class="rwdt_bt2" align="left" valign="middle" width="12%">任务价格</td>
            <td class="rwdt_bt2" align="center" valign="middle" width="23%">发布者要求</td>
            <td class="rwdt_bt2" align="left" valign="middle" width="22%">悬赏麦点</td>
            <td class="rwdt_bt2" align="center" valign="middle" width="10%">操作</td>
            <td class="rwdt_bt3" align="center" valign="middle" width="10"></td>
          </tr>
		</thead>
		<tbody>
	   ';if($list){foreach($list as $v){echo '
          <tr class="rwdt_list" valign="top">	   
          <tr ';if($v['isCart']){echo ' class="task_cart" ';}elseif($v['isExpress']){echo ' class="task_express" ';}elseif($v['reflow']){echo ' class="rwdt_bh3" ';}elseif($v['isExpress']){echo ' ';}elseif($v['isExpress']){echo ' ';}elseif($v['isExpress']){echo ' ';}elseif($v['isExpress']){echo ' ';}elseif($v['isExpress']){echo ' class="rwdt_list" ';}echo ' valign="top"></tr>
            <td width="10">&nbsp;</td>
            <td width="21%">
			<span ';if($v['isCart']){echo ' class="rwdt_bh7" title="购物车任务—';echo $v['shopCount'];echo '个商品" ';}elseif($v['isExpress']){echo ' class="task_express" title="真实快递任务—';echo $v['shopCount'];echo '个商品" ';}elseif($v['visitWay']){echo ' class="rwdt_bh3" title="来路任务" ';}elseif($v['times']==1){echo ' class="rwdt_bh1" title="虚拟任务" ';}elseif($v['times']>1){echo ' class="rwdt_bh2" title="实物任务" ';}echo '  ><strong class="system1">';echo $v['id'];echo '</strong></span>
			<br>
            <span ';if($v['isEnsure']){echo ' title="接任务者需要加入平台商保" class="rwdt_xbh1" ';}echo ' class="rwdt_xbh0 block">PostTime：';echo date('H:i:s',$v['stimestamp']);echo '</span>
			</td>
            <td width="12%">
			<a title="接任务后方可查看到对方QQ号码" target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info/?username=';echo $v['susername'];echo '" class="lanse2">';echo string::getXin2($v['susername']);echo '</a><br>
             ';if($v['vip']){echo '<span class="fb_vip1" title="一级VIP客户"></span>';}echo '
            ';if($v['vip2']){echo '<span class=\'fb_vip1\' title=\'';echo $lang['cardType'][$v['vip2']];echo '\'></span>';}echo '
			';if($v['isEnsure']){echo '<span class=\'fb_vip1\' title=\'商保\'></span>';}echo '
			</td>
            <td width="12%">
			 <span ';if($v['isPriceFit']){echo ' class="rwdt_xgj2" title="拍下商品，付款前需要联系店主修改价格，使得支付费用与任务金额相等"  ';}else{echo ' class="rwdt_db" title="平台担保：此任务卖家已缴纳全额担保存款，买家可放心购买，任务完成时，买家平台账号自动获得相应存款。"';}echo '> ';echo $v['price'];echo '</span>
			</td>
            <td class="noktime" width="23%">
			<p ';if($v['isRemark']){echo ' class="lvse" ';}else{echo ' class="yred"';}echo 'title="任务接手付款后，';echo $lang['times'][$v['times']];echo '立即对宝贝进行好评并打五星！">';echo $lang['times'][$v['times']];echo '';if($v['isRemark']){echo '带字';}echo '
			</p>
			';if($v['isVerify']){echo '<em title="接任务者需要发布者核审" class="rwdt_yq1">&nbsp;</em>';}echo '
			';if($v['isChat']){echo '<em title="任务需要旺旺模拟咨询再拍下" class="rwdt_yq4">&nbsp;</em>';}echo '
			';if($v['ispinimage']){echo ' <em title="接任务者需要上传好评图片" class="rwdt_yq6">&nbsp;</em>';}echo '
			';if($v['isRemark']){echo '<em title="按发布者提供的评语进行评价" class="rwdt_yq7">&nbsp;</em>';}echo '
			';if($v['isReal']){echo '<em title="接手买号必须通过了支付宝实名认证" class="rwdt_yq21">&nbsp;</em>';}echo '
			';if($v['isAddress']){echo '<em class="rwdt_yqip" title="要求接手方地址是...">&nbsp;</em>';}echo '
			';if($v['isShare']){echo '<em title="好评后对宝贝进行分享" class="rwdt_yq20">&nbsp;</em>';}echo '
			';if($v['isChatDone']){echo '<em title="任务需要模拟聊天后确认收货" class="rwdt_yq17">&nbsp;</em>';}echo '
		    </td>
            <td align="left" width="22%"><span class="lvse"><strong>';echo $v['point'];echo '个麦点</strong></span></td>
            <td width="10%"><p class="yred">';if($v['status']==1){echo '<a class="qrw_btn" balid="0" onclick="taskin(\'';echo $v['id'];echo '\',false,this);" href="javascript:;">&nbsp;</a>';}echo '</p></td>
            <td width="10">&nbsp;</td>
          </tr>
		';}}echo '
		 </tbody>
 </table>

<div class="rwdt_dlm">
  <a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/bbs/t1509/" target="_blank" class="rwdt_tbhelp"></a>
  <div id="page" style="float:right;">
      <a href="javascript:goPage(';echo $multipage;echo ');" class="nov">';echo $multipage;echo '</a>
      <a href="javascript:goPage(';echo $multipage;echo ');" class="next">&gt;</a>
 </div>
</div>';?>