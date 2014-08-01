<?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/ajax/';echo '<table class="tlisttable" border="0" cellpadding="0" cellspacing="0" width="100%">
    <thead>
    <tr>
        <td class="rwdt_bt2" align="center" valign="middle" width="200">任务编号</td>
        <td class="rwdt_bt2" align="center" valign="middle" width="12%">任务价格</td>
        <td class="rwdt_bt2" align="center" valign="middle" width="18%">发布者要求</td>
        <td class="rwdt_bt2" align="center" valign="middle" width="12%">悬赏麦点</td>
        <td class="rwdt_bt2" align="center" valign="middle" width="12%">任务状态</td>
        <td class="rwdt_bt2" align="center" valign="middle" width="24%">操作</td>
    </tr>
    </thead>
    <tbody class="tlisttable">
    ';$allPrice=0;echo '
    ';$allPoint=0;echo '
    ';if($list){foreach($list as $v){echo '
    <tr>
        <td class="yf_pd2" width="180">
            <span ';if($v['isCart']){echo ' class="rwdt_bh7" title="购物车任务—';echo $v['shopCount'];echo '个商品" ';}elseif($v['isExpress']){echo ' class="task_express" title="真实快递任务—';echo $v['shopCount'];echo '个商品" ';}elseif($v['visitWay']){echo ' class="rwdt_bh3" title="来路任务" ';}elseif($v['times']==0){echo ' class="rwdt_bh1" title="虚拟任务" ';}elseif($v['times']>=1){echo ' class="rwdt_bh2" title="实物任务" ';}echo '  ><strong class="system1">';echo $v['id'];echo '</strong></span><p class="cle"></p>
            <span class="block">发布时间：';echo date('m-d H:i:s',$v['stimestamp']);echo '</span><span class="rwdt_xbh0">发布方:<a class="comlink" title="接任务后方可查看到对方QQ号码" target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info/?username=';echo urlencode($v['susername']);echo '">';echo $v['susername'];echo '</a></span>
        </td>
        <td class="yf_pd2" width="90"><span ';if($v['isPriceFit']){echo 'class="rwdt_xgj"';}else{echo 'class="rwdt_db"';}echo ' >';echo $v['price'];echo '</span>
        </td>
        <td class="noktime" width="23%">
            <p ';if($v['times']==0){echo 'class="yred" ';}else{echo ' class="lvse" ';}echo 'title="任务接手付款后，';echo $lang['times'][$v['times']];echo '立即对宝贝进行收货好评！">';echo $lang['times'][$v['times']];echo '</p>
            ';if($v['isVerify']){echo '<em title="接任务者需要发布者核审" class="rwdt_yq1">&nbsp;</em>';}echo '
            ';if($v['isChat']){echo '<em title="任务需要旺旺模拟咨询再拍下" class="rwdt_yq4">&nbsp;</em>';}echo '
            ';if($v['ispinimage']){echo ' <em title="接任务者需要上传好评图片" class="rwdt_yq6" onclick="dialog(600,500,\'淘宝平台任务截图上传\',\'/dialog/uphaoping/?sid=';echo $v['id'];echo '\');">&nbsp;</em>';}echo '
            ';if($v['isRemark']){echo '<em title="按发布者提供的评语进行评价" class="rwdt_yq2">&nbsp;</em>';}echo '
            ';if($v['isReal']){echo '<em title="接手买号必须通过了支付宝实名认证" class="rwdt_yq21">&nbsp;</em>';}echo '
            ';if($v['isAddress']){echo '<em class="rwdt_yq3" title="任务需要指定收货地址">&nbsp;</em>';}echo '
            ';if($v['isLimitCity']){echo '<em class="rwdt_yqip" title="要求接手方地址是';$prov=unserialize($v['Province']);echo implode(',',$prov);echo '">&nbsp;</em>';}echo '
            ';if($v['isShare']){echo '<em title="好评后对宝贝进行分享" class="rwdt_yq20">&nbsp;</em>';}echo '
            ';if($v['isChatDone']){echo '<em title="任务需要模拟聊天后确认收货" class="rwdt_yq17">&nbsp;</em>';}echo '

        </td>
        <td class="yf_pd" align="center" width="120">
            <span class="chengse" ><strong style="color:#390;">';echo $v['point'];echo '个麦点</strong></span>
        </td>
        <td class="yf_pd" align="center" width="120">
            ';if($v['complain']){echo '
            <span class="chengse">申诉裁定中,任务锁定</span>
            ';}else{echo '
            <span class="chengse"><strong>';echo $lang['status'][$v['status']];echo '</strong></span><br />
	            ';if($v['status']==9){echo '
                	';if($v['ispinimage']&&$v['pinimage']){echo '<a href="javascript:dialog(600,500,\'淘宝平台任务截图上传\',\'/dialog/uphaoping/?sid=';echo $v['id'];echo '\');">查看好评截图</a><br />';}echo '
                	';if($v['isShare']&&$v['shareimage']){echo '<a href="javascript:dialog(600,500,\'淘宝平台任务截图上传\',\'/dialog/uphaoping/?sid=';echo $v['id'];echo '\');">查看分享截图</a><br />';}echo '
	            ';}echo '
            ';}echo '
        </td>
        <td class="yf_pd2" style="padding:0px;" align="right" valign="top" width="280">
            ';if($v['status']==0){echo '

            <p style="height:30px; position:relative; top:5px;" id="';echo $v['id'];echo '">
                <a href="';echo $thisUrl;echo '&resume=';echo $v['id'];echo '" onclick="return confirm(\'您确定要恢复任务么？\');" class="yf_hfrw">恢复任务</a>
            </p>
            <p style="clear:both; line-height:30px;height:30px;"></p>

            ';}elseif($v['status']==1){echo '
            <p style="height:30px; position:relative; top:5px;" id="';echo $v['id'];echo '">
                <a href="javascript:;"  onclick="return copyComment(\'';echo $v['itemurl'];echo '\')" class="yf_check">等待接手</a>
            </p>
            <p style="clear:both; line-height:30px;height:30px;"></p>

            ';}elseif($v['status']==3){echo '
            <p style="height:30px; position:relative; top:5px;" id="';echo $v['id'];echo '">
                <a  class="yf_shtg" href="';echo $thisUrl;echo '&verify=';echo $v['id'];echo '" onclick="return IsConfirmTask(\'淘宝\')" >接手方已确认，等待您核实</a>
            </p>
            ';}elseif($v['status']==4){echo '
            <p style="height:30px; position:relative; top:5px;" id="';echo $v['id'];echo '">
                <a class="yf_addtime" href="';echo $thisUrl;echo '&addtime=';echo $v['id'];echo '">等待接手人对商品付款</a>
            </p>
            <p style="clear:both; line-height:30px;height:30px;">
                剩余付款时间：<span class="lvse strong" id="iidd_1"><script type="text/javascript">fleshTime(';echo $v['runTimestamp2'];echo ')</script></span>
            </p>


            ';}elseif($v['status']==7){echo '
            <p style="height:30px; position:relative; top:5px;" id="';echo $v['id'];echo '">
                <a href="';echo $thisUrl;echo '&send=';echo $v['id'];echo '" onclick="return IsSendTask()" class="yf_fahuo">我已发货</a>
            </p>
            <p style="clear:both; line-height:30px;height:30px;">
                核对买号<span class="lvse strong" onclick="return copyComment(\'';echo $v['bnickname'];echo '\')">';echo $v['bnickname'];echo '</span>付款后再发货
            </p>
            ';}elseif($v['status']==8){echo '
            <p style="height:30px; position:relative; top:5px;" id="';echo $v['id'];echo '">
                <a href="javascript:;" class="yf_haopin">等待接手方收货好评</a>
            </p>
            ';if($v['runTimestamp3']<=0){echo '
            <p style="clear:both; line-height:30px;height:30px;">
                核对买号<span class="lvse strong" onclick="return copyComment(\'';echo $v['bnickname'];echo '\')">';echo $v['bnickname'];echo '</span>收货好评后再确认
            </p>
            ';}echo '
            ';if($v['runTimestamp3']>0){echo '
            <font color="#fe5500">';echo time::hours($v['runTimestamp3']);echo '</font>小时后允许收货
            ';}echo '

            ';}elseif($v['status']==9){echo '
            <p style="height:30px; position:relative; top:5px;" id="';echo $v['id'];echo '">
                <a  class="yf_haopinck" href="';echo $thisUrl;echo '&confirm=';echo $v['id'];echo '" onclick="return IsConfirmTask(\'淘宝\')" >接手方已确认，等待您核实</a>
            </p>
            <p style="clear:both; line-height:30px;height:30px;">收货时间已到，等待对方淘宝确认收货</p>

            ';}elseif($v['status']==10){echo '
            <p style="height:60px; position:relative; top:5px;" id="';echo $v['id'];echo '">
                                    <a href="javascript:;" onclick="dialog(600,500,\'';echo $web_name;echo '平台任务满意度评分\',\'/dialog/grade/?sid=';echo $v['id'];echo '\');return false;" style="margin-left:5px;" class="yf_pinjia float_r" title="给发布方打分" id="grade_';echo $v['id'];echo '">&nbsp;</a>
                <!--a href="javascript:;" onclick="dialog(600,500,\'发布追评任务\',\'/dialog/review/?sid=';echo $v['id'];echo '\');return false;" class="yf_review float_r" style="margin-left:5px;color:#86454f;">追加评论</a-->
            </p>
            <p style="clear:both; line-height:20px;height:20px;">评价状态：<font color="#fe5500">';echo $lang['cStatus'][$v['credit']];echo '</font></p>
            ';}echo '
            ';if($v['status']==0){echo '
            <p class="task-border">
                | <a href="';echo $thisUrl;echo '&repost=';echo $v['id'];echo '" onclick="return IsReTask();" title="重新发布" style="color:#999">重新发布</a>
                | <a href="';echo $thisUrl;echo '&del=';echo $v['id'];echo '" onclick="return IsDelTask();" title="取消发布" class="yf_wz" style="color:#999">取消</a>
                |<a href="javascript:;" style="background:url(/images/';if($v['s_memo']){echo 'memo.png';}else{echo 'bz_no.png';}echo ') no-repeat 8px; height:12px;top:2px;" onclick="ShowRemark(\'';echo $v['id'];echo '\',\'';echo $v['s_memo'];echo '\');" class="yf_bz"></a>
            </p>

            ';}elseif($v['status']==1){echo '
            <p class="task-border">
                | <a href="';echo $thisUrl;echo '&pause=';echo $v['id'];echo '" onclick="return confirm(\'您确定要暂停任务么？\')" style="color:#999">暂停</a>
                | <a href="';echo $thisUrl;echo '&del=';echo $v['id'];echo '" onclick="return IsDelTask();" title="取消发布" class="yf_wz" style="color:#999">取消</a>
                |<a href="javascript:;" style="background:url(/images/';if($v['s_memo']){echo 'memo.png';}else{echo 'bz_no.png';}echo ') no-repeat 8px; height:12px;top:2px;" onclick="ShowRemark(\'';echo $v['id'];echo '\',\'';echo $v['s_memo'];echo '\');" class="yf_bz"></a>
            </p>
            ';}else{echo '
            <p class="task-border" >
                <span style="color:#999">联系对方：</span><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=';echo $v['qq'];echo '&site=qq&menu=yes">
                <img border="0" src="http://wpa.qq.com/pa?p=2:';echo $v['qq'];echo ':41" alt="联系我" title="联系我"> <a href="javascript:;" onclick="dialog(460,460,\'给买家发送手机短信\',\'/dialog/sendsms/?username=';echo urlencode($v['susername']);echo '\');return false;" title="给买家发送手机短信" alt="给买家发送手机短信" class="yf_sj"></a>
                |<a href="';echo $thisUrl;echo '&repost=';echo $v['id'];echo '" onclick="return IsReTask();" style="color:#999">重新发布</a>
                |<a href="javascript:;" style="background:url(/images/';if($v['s_memo']){echo 'memo.png';}else{echo 'bz_no.png';}echo ') no-repeat 8px; height:12px;top:2px;" onclick="ShowRemark(\'';echo $v['id'];echo '\',\'';echo $v['s_memo'];echo '\');" class="yf_bz"></a>

            </p>
            ';}echo '
        </td>
        <td width="15">&nbsp;</td>
    </tr>

    <tr>
        <!-- jifen_date -->
        <td colspan="9" class="yfrw_listxia" align="right" valign="middle">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td style="padding-left:20px; color:#3372A2;" align="left" width="40%">客服不会主动联系操作任务、平台没有充值活动谨防假冒<br>如果选择了好评截图，请点击<span style="color: red;">评图图标</span>查看买家上传的好评图。</td>
                    <td align="right" width="50%">　
                        ';if($v['status']>=3){echo ' 
				<span class="in_block">';echo '
				接手方：<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info/?username=';echo urlencode($v['busername']);echo '" target="_blank" class="comlink">';echo $v['busername'];echo '<img src="';echo $memberLevel['icon'];echo '" alt="积分：';echo $memberFields['credits'];echo '" /></a></a>
				</span>
				<span class="col33 in_block">(IP：';echo common::intip($ipint);echo ')
				</span>
				<span class="in_block"><span class="yf_wwtx"></span>
				采用买号：';if($v['bid']){echo '<a href="javascript:;" onclick="dialog(460,460,\'买号信息查看\',\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/dialog/buyerInfo/?id=';echo $v['bid'];echo '\');return false;" class="comlink">';echo $v['bnickname'];echo '</a> ';echo $v['bico'];echo '';}echo '
				</span>
                        ';}echo '
				<span class="in_block"><a href="javascript:;" onclick="return copyComment(\'';echo $v['itemurl'];echo '\')" class="vse3 strong">复制宝贝地址</a>
				</span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    ';if($v['cbxIsTip']){echo '
    <tr>
        <td class="yf_ts1" height="40" colspan="9">
            <span class="yf_mjly"></span>
            <span class="chengse strong" style="color:##FE5500;">';echo $v['tips'];echo '</span>
        </td>
    </tr>
    ';}echo '
    ';if($v['isRemark']){echo '
    <tr>
        <td colspan="9" class="yf_ts2" align="right" valign="middle">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td style="padding-left:0px; color:#3372A2;"  align="left" width="85%">
                        <span class="yf_gdhp"></span>
                        <span class="chengse strong" style="color:#FE5500;">';echo $v['remark'];echo '</span>
                        <span class="chengse strong"></span>
                    </td>
                    <td align="right" width="15%">　

				<span class="in_block"><a href="javascript:;" onclick="return copyComment(\'';echo $v['remark'];echo '\')" class="yf_fz1"></a>
				</span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    ';}echo '
    ';if($v['isAddress']){echo '
    <tr>
    <td colspan="9" class="yf_ts2" align="right" valign="middle">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td style="padding-left:0px; color:#3372A2;"  align="left" width="85%">
                    <span class="yf_gdsh"></span>
                    <span>姓名：</span>
                    <strong class="orange" style="color:red;">';echo $v['cbxName'];echo '</strong>
                    <span class="address-title">地址：</span>
                    <strong class="orange" style="color:red;">';echo $v['cbxAddress'];echo '</strong>
                    <span class="address-title">电话：</span>
                    <strong class="orange" style="color:red;">';echo $v['cbxMobile'];echo '</strong>
                    <span class="address-title">邮编：</span>
                    <strong class="orange" style="color:red;">';echo $v['cbxcode'];echo '</strong>
                    <span class="yf_fzhp"></span>
                </td>
                <td align="right" width="15%">　

				<span class="in_block"><a href="javascript:;" onclick="return copyComment(\'';echo $v['cbxName'];echo ',';echo $v['cbxAddress'];echo ',';echo $v['cbxMobile'];echo ',';echo $v['cbxcode'];echo '\')" class="yf_fz2"></a>
				</span>
                </td>
            </tr>
        </table>
    </td></tr>
    ';}echo '
    ';$allPrice+=$v['price'];echo '
    ';$allPoint+=$v['point'];echo '
    ';}}echo '
    <div style="padding-top:10px;">本页任务的资金合计：<span class="chengse">';echo $allPrice;echo ' </span> 元　麦点合计：<span class="chengse">';echo $allPoint;echo '</span> 个</div>
    <div class="rwdt_dlm">
        <div id="page" style="margin:0px 10px 10px;">

        </div>
    </div>
    <div class="cle"></div>
    <div id="showtask" style="display:none;">
        <div style=" height:350px;"><iframe name="contentframe" id="contentframe" src="" frameborder="0" height="350" width="540" scrolling="no"></iframe> </div>
    </div>
    </tbody>
</table>

<div class="rwdt_dlm">
    <div id="page" style="float:right;">
        ';echo $multipage;echo '
    </div>
</div>
<link rel="stylesheet" href="/css/bbs/layout.css" type="text/css" />
';?>