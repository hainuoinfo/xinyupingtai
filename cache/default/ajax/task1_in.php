<?php !defined("IN_JB")&&exit("error");$__tplUrl = '/templates/default/ajax/';echo '<table class="tlisttable" border="0" cellpadding="0" cellspacing="0" width="100%">
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
    ';$allPrice=0;echo '
    ';$allPoint=0;echo '
    ';$timesId=1;echo '
    ';if($tList){foreach($tList as $v){echo '
    <tr>
    <table class="yfrw_list" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
        <tr>
            <td class="yf_pd2" width="180"><span ';if($v['isCart']){echo ' class="rwdt_bh7" title="购物车任务—';echo $v['shopCount'];echo '个商品" ';}elseif($v['isExpress']){echo ' class="task_express" title="真实快递任务—';echo $v['shopCount'];echo '个商品" ';}elseif($v['visitWay']){echo ' class="rwdt_bh3" title="来路任务" ';}elseif($v['times']==0){echo ' class="rwdt_bh1" title="虚拟任务" ';}elseif($v['times']>=1){echo ' class="rwdt_bh2" title="实物任务" ';}echo '  >
                <strong class="system1">';echo $v['id'];echo '</strong></span><p class="cle"></p>
                <span class="block">发布时间：';echo date('m-d H:i:s',$v['stimestamp']);echo '</span><span class="rwdt_xbh0">发布方:<a class="comlink" title="接任务后方可查看到对方QQ号码" target="_blank" href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info/?username=';echo urlencode($v['susername']);echo '">';echo $v['susername'];echo '</a></span></td>
            <td class="yf_pd2" width="90"><span ';if($v['isPriceFit']){echo ' class="rwdt_xgj" ';}else{echo ' class="rwdt_db" ';}echo '>';echo $v['price'];echo '</span></td>
            <td class="noktime" width="23%">
                <p ';if($v['times']==0){echo 'class="yred" ';}else{echo ' class="lvse" ';}echo 'title="任务接手付款后，';echo $lang['times'][$v['times']];echo '立即对宝贝进行收货好评！">';echo $lang['times'][$v['times']];echo '</p>
                ';if($v['isVerify']){echo '<em title="接任务者需要发布者核审" class="rwdt_yq1">&nbsp;</em>';}echo '
                ';if($v['isChat']){echo '<em title="任务需要旺旺模拟咨询再拍下" class="rwdt_yq4">&nbsp;</em>';}echo '
                ';if($v['ispinimage']){echo ' <em title="接任务者需要上传好评图片" class="rwdt_yq6">&nbsp;</em>';}echo '
                ';if($v['isRemark']){echo '<em title="按发布者提供的评语进行评价" class="rwdt_yq2">&nbsp;</em>';}echo '
                ';if($v['isReal']){echo '<em title="接手买号必须通过了支付宝实名认证" class="rwdt_yq21">&nbsp;</em>';}echo '
                ';if($v['isAddress']){echo '<em class="rwdt_yq3" title="任务需要指定收货地址">&nbsp;</em>';}echo '
                ';if($v['isLimitCity']){echo '<em class="rwdt_yqip" title="要求接手方地址是';$prov=unserialize($v['Province']);echo implode(',',$prov);echo '">&nbsp;</em>';}echo '
                ';if($v['isShare']){echo '<em title="好评后对宝贝进行分享" class="rwdt_yq20">&nbsp;</em>';}echo '
                ';if($v['isChatDone']){echo '<em title="任务需要模拟聊天后确认收货" class="rwdt_yq17">&nbsp;</em>';}echo '
            </td>
            <td class="yf_pd" align="center" width="120"><span class="chengse"><strong>';echo $v['point'];echo '个麦点</strong></span></td>
            <td class="yf_pd" align="center" width="120">
                ';if($v['complain']){echo '
                <span class="chengse">申诉裁定中,任务锁定</span>
                ';}else{echo '
                <span class="chengse"><strong>';echo $lang['status'][$v['status']];echo ' </strong></span><br />
                ';if($v['status']==8){echo '
                	';if($v['ispinimage']&&!$v['pinimage']){echo '<a href="javascript:dialog(600,500,\'淘宝平台任务截图上传\',\'/dialog/uphaoping/?sid=';echo $v['id'];echo '\');">上传好评截图</a><br />';}echo '
                	';if($v['isShare']&&!$v['shareimage']){echo '<a href="javascript:dialog(600,500,\'淘宝平台任务截图上传\',\'/dialog/uphaoping/?sid=';echo $v['id'];echo '\');">上传分享截图</a><br />';}echo '
                	';if($v['ispinimage']||$v['isShare']){echo '截图上传后，请点击右侧绿色按钮，提交任务！';}echo '
                ';}echo '
                ';}echo '
            </td>
            <td class="yf_pd2" style="padding:0px;" align="right" valign="top" width="240">

                <div style="height:30px; position:relative; top:5px;" id="';echo $v['id'];echo '">
                    ';if(!$v['bid']){echo '<a href="javascript:;" onclick="dialog(550,460,\'绑定买号\',\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/dialog/chooseBuyer/?sid=';echo $v['id'];echo '\');return false;" class="yf_buyer">绑定买号</a>
                    接手方剩余<span class="f_b_red" id="bdmh_';echo $timesId;echo '"></span><script type="text/javascript">flushTime(';echo 180-$v['runTimestamp'];echo ',"bdmh_';echo $timesId;echo '")</script>钟可绑定买号
                    ';}echo '
                    ';if($v['status']==3){echo '
                    <a class="yf_ico1" onclick="contact(\'';echo $v['qq'];echo '\')" href="javascript:;">等待发布方审核</a>';echo '
                    
                    <span id="outTask"></span>
                    <!--<script type="text/javascript">IsOutTask(';echo $v['runTimestamp'];echo ', "';echo $v['id'];echo '");</script>-->
                    ';}elseif($v['status']==4){echo '
                    ';if($v['visitWay']&&$v['isVisit']==0){echo '

                    <a href="javascript:;" onclick="dialog(650,450,\'查看商品详情\',\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/dialog/taskVisitWay/?sid=';echo $v['id'];echo '\');return false;" class="yf_ico2 float_r"></a>
                    ';}else{echo '
                    <a href="';echo $thisUrl;echo '&pay=';echo $v['id'];echo '" class="yf_payfor1 float_r" onclick="return IsPayTask(\'淘宝\',';echo $v['times'];echo ')">已经支付</a>
                    <a style="margin-right:7px;" class="yf_ico3 float_r" onclick="return copyComment(\'';echo $v['itemurl'];echo '\')" href="javascript:;"></a>
                    ';}echo '
                    ';}elseif($v['status']==7){echo '
                    <a href="';echo $thisUrl;echo '&unpay=';echo $v['id'];echo '" class="yf_hwfk" onclick="return IsUnpayTask(\'淘宝\')">还未支付</a>
                    ';}elseif($v['status']==8){echo '
                    ';if($v['runTimestamp3']<=0){echo '
';if($v['ispinimage']&&$v['pinimage'])$upimage1=1;if($v['isShare']&&$v['shareimage'])$upimage2=2;if($upimage1&&$upimage2)$upimage=1;elseif($upimage1&&!$v['isShare'])$upimage=1;elseif($upimage2&&!$v['ispinimage'])$upimage=1;else
                        $upimage=0;if($upimage==0){if(!$v['isShare']&&!$v['ispinimage'])$upimage=1;}echo '
                    <a href="';if($upimage==1){echo '';echo $thisUrl;echo '&receive=';echo $v['id'];echo '';}else{echo 'javascript:dialog(600,500,\'淘宝平台任务截图上传\',\'/dialog/uphaoping/?sid=';echo $v['id'];echo '\');';}echo '" class="yf_haopinsh" onclick="';if($v['haopingtu']){echo 'return IsReceiveTask(\'淘宝\', ';echo $v['isRemark'];echo ', 0, ';echo $v['isShare'];echo ') ;';}echo '">我已收货</a>
                    ';}echo '
                    ';if($v['runTimestamp3']>0){echo '
                    <span class=\'yf_wdshsj\'>等待收货</span>
                    <font color="#fe5500">';echo time::hours($v['runTimestamp3']);echo '</font>小时后允许收货
                    ';}echo '
                    ';}elseif($v['status']==9){echo '
                    <a class="yf_waito">等待卖家核实货款</a>
                    ';echo ' 
                    ';}elseif($v['status']==10){echo '
                    <a href="javascript:;" onclick="dialog(600,500,\'';echo $web_name;echo '平台任务满意度评分\',\'/dialog/grade/?sid=';echo $v['id'];echo '\');return false;" style="margin-left:5px;" class="yf_pinjia float_r" title="给发布方打分" id="grade_';echo $v['id'];echo '">&nbsp;</a>
                    <p style="clear:both; line-height:20px;height:20px;">评价状态：<font color="#fe5500">';echo $lang['cStatus'][$v['credit']];echo '</font></p>
                    ';}echo '
                </div>
                ';if($v['status']==4){echo '
                <p style="clear:both; line-height:30px;height:30px;">
                    剩余付款时间：<span class="f_b_red lvse strong " id="iidd_1_';echo $timesId;echo '"></span><script type="text/javascript">flushTime(';echo $v['runTimestamp2'];echo ',"iidd_1_';echo $timesId;echo '")</script>
                </p>
                ';}else{echo '
                <p style="clear:both; line-height:30px;height:30px;"></p>
                ';}echo '
                <p class="task-border">
                    联系对方：<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=';echo $v['qq'];echo '&site=qq&menu=yes">
                    <img border="0" src="http://wpa.qq.com/pa?p=2:';echo $v['qq'];echo ':41" alt="联系我" title="联系我">
                </a><a href="javascript:;" onclick="dialog(460,460,\'给卖家发送手机短信\',\'/dialog/sendsms/?username=';echo urlencode($v['susername']);echo '\');return false;" title="给卖家发送手机短信" alt="给卖家发送手机短信" class="yf_sj"></a> |
                    ';if($v['isVerify']&&$v['status']==2){echo '<script type="text/javascript">IsOutTask(';echo $v['runTimestamp'];echo ', "';echo $v['id'];echo '");</script>';}elseif($v['status']<5){echo '<a href=\'';echo $thisUrl;echo '&out=';echo $v['id'];echo '\' class=\'yf_wz\' title="退出任务" onclick=\'return IsQuitTask();\'>退出</a>';}elseif($v['status']<9){echo '<a title="发起申诉" onclick="dialog(950,550,\'发起申诉\',\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/dialog/complain/?sid=';echo $v['id'];echo '\');return false;" class="comlink" href="javascript:;">申诉</a>|';}echo '<a href="javascript:;" style="background:url(/images/';if($v['b_memo']){echo 'memo.png';}else{echo 'bz_no.png';}echo ') no-repeat 8px; height:12px;top:2px;" onclick="ShowRemark(\'';echo $v['id'];echo '\',\'';echo $v['b_memo'];echo '\');" class="yf_bz"></a>
                </p>
            </td>
            <td width="15">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="9" class="yfrw_listxia" align="right" valign="middle">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                    <tr>
                        <td style="padding-left:20px; color:#3372A2;" align="left" width="40%">不按规定修改地址、好评的的接手人将给予严厉处分
                        </td>
                        <td align="left" width="40%">
				<span style="float:left;">
				<span class="yf_wwtx">
				</span>掌柜名：<a href="';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/member/info.php?username=';echo $v['nickname'];echo '" class="comlink" title="查看掌柜信息">';echo $v['nickname'];echo '</a>
				</span>
                            <span class="yf_wwtx"></span>
				<span style="float:left;">采用买号：
				<span class="lvse3">
				';if($v['bid']){echo '<a href="javascript:;" onclick="dialog(460,460,\'买号信息查看\',\'';if(!$web_rewrite)echo $weburl2.'rewrite.php?rewrite=';echo '/dialog/buyerInfo/?id=';echo $v['bid'];echo '\');return false;"  class="comlink" target="_blank" title="查看买号信息">';echo $v['bnickname'];echo ' ';echo $v['bico'];echo ' </a>';}echo '
				</span>
				</span>
                        </td>
                        ';if(!$v['visitWay']&&!$v['isCart']){echo '<td align="left" width="12%"><a href="javascript:;" onclick="return copyComment(\'';echo $v['itemurl'];echo '\')" class="vse3 strong">查看淘宝商品</a></td>
                        ';}echo '
                    </tr>
                    ';if($v['cbxIsTip']){echo '
                    <tr>
                        <td class="yf_ts1" height="40" colspan="9"><span class="yf_mjly"></span><span class="chengse strong" style="color:##FE5500;">';echo $v['tips'];echo '</span></td>
                    </tr>
                    ';}echo '
                    ';if($v['isRemark']){echo '
                    <tr>
                        <td colspan="9" class="yf_ts2" align="right" valign="middle">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
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
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    ';}echo '
                    ';if($v['isAddress']){echo '
                    <td colspan="9" class="yf_ts2" align="right" valign="middle">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
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
                            </tbody>
                        </table>
                    </td>
                    ';}echo '
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
    </tr>
    ';$allPrice+=$v['price'];echo '
    ';$timesId++;echo '
    ';$allPoint+=$v['point'];echo '
    ';}}echo '
    </tbody>
</table>
    <div style="padding-top:10px;">本页任务的资金合计：<span class="chengse">';echo $allPrice;echo '</span> 元　麦点合计：<span class="chengse">';echo $allPoint;echo '</span> 个</div>
<div class="rwdt_dlm">
    <div id="page" style="float:right;">
        ';echo $multipage;echo '
    </div>
</div>
<link rel="stylesheet" href="/css/bbs/layout.css" type="text/css" />';?>