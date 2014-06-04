var _iidd = 1;
function isIE() {
    var t = false;
    try {
        t = ! -[1, ]; //true or false
    } catch (e) { }
    return t;
}
function openPrdUrl(url, obj) {
    if (isIE()) {
        try {
            window.open(url);
        } catch (e) {
            try {
                alert('对不起，可能你使用了遨游或搜狐浏览器，弹出的网址无法打开，请再一次点击');
                obj.onclick = function() { window.open(url); }
            } catch (ex) { }
        }
    } else if (prompt('请你使用 Ctrl+C 复制到剪贴板', url)) {
        alert("您已经成功复制了网址，请粘贴到浏览器的地址栏，然后打开");
    }
    return false;
}

function fleshTime(t) {
    if (t <0 ) t = 0;
    var id = "iidd_" + (_iidd++);
    var str = "<span class='f_b_red' id='" + id + "'>" + parseInt(t/60) + "分" + t%60 + "秒</span>";
    $('#iidd_1').html(str);
    var uptime = function() {
        t = t - 1;
        if (t <= 0) {
            window.clearInterval(tt_0);
            t = 0;
        }
        document.getElementById(id).innerHTML = parseInt(t/60) + "分" + t%60 + "秒";
    }
    var tt_0 = window.setInterval(uptime, 1000);
}

function copyComment(text, tip) {
	if (tip == void(0)) tip = '复制成功';
    if(is_ie) {
		clipboardData.setData('Text', text);
		alert(tip);
	} else if(prompt('请你使用 Ctrl+C 复制到剪贴板', text)) {
		alert(tip);
	}
	return false;
}

function IsGetTask() {
    return confirm("您确定要接手此任务么？");
}

function IsDelTask() {
    return confirm("取消该任务将返回您全部扣押的平台任务担保金和任务发布点，\n\n但要额外扣除0.2个发布点\n\n您确定取消发布该任务么？");
}

function IsReTask() {
    return confirm("重新发布该任务将更新该任务发布时间从而使您的任务排名更加靠前，\n\n但是每重新发布一次扣除发布点0.5个，\n\n您确定要重新发布么？");
}

function IsRejectTask(i) {
    if (i < 3)
        return confirm("您确定要辞退该接手人，将任务返回到“已发布，等待接手人”状态么？");
    else
        return confirm("您已辞退" + i + "个该任务的接手人了，再辞退接手人需要额外支付0.2个发布点；\n\n您确定要辞退么？");
}

function IsOutTask(t, id) {
    if (t >= 30) {
        document.write("<a href='"+thisUrl+"&out=" + id + "' class='link_t' onclick='return IsQuitTask();'>退出任务</a>");
    } else {
    document.write("<a href='"+thisUrl+"&out=" + id + "' class='link_t' id='out_" + id + "' onclick='alert(\"还需要" + (30 - t) + "秒可以退出\");return false;' disabled='disabled'>退出任务</a>");
        var obj;
        var uptime = function() {
            t = t + 1;
            if (!obj)
                obj = document.getElementById("out_" + id);
            if (t >= 30) {
                window.clearInterval(tt_1);
                obj.innerHTML = "退出任务";
                obj.disabled = false;
                obj.onclick = function() { return IsQuitTask(); };
            } else {
                obj.innerHTML = "退出[" + (30 - t) + "]";
                obj.onclick = function() { alert("还需要" + (30 - t) + "秒可以退出"); return false; };
            }
        }
        var tt_1 = window.setInterval(uptime, 1000);
    }
}

function IsQuitTask() {
    return confirm("您确定要退出该任务么？");
}

function IsPayTask(plat, times) {
		if (times == 4)
			return confirm("请确保" + plat + "上已经支付货款后，才进行平台确认，否则一经投诉将做封号处理！\n\n【注意】该任务为72小时好评任务，请在发布人发货后72小时再确认收货");			
		else if (times == 3)
			return confirm("请确保" + plat + "上已经支付货款后，才进行平台确认，否则一经投诉将做封号处理！\n\n【注意】该任务为48小时好评任务，请在发布人发货后48小时再确认收货");
		else if (times == 2)
			return confirm("请确保" + plat + "上已经支付货款后，才进行平台确认，否则一经投诉将做封号处理！\n\n【注意】该任务为24小时好评任务，请在发布人发货后24小时再确认收货");
		else
			return confirm("请确保" + plat + "上已经支付货款后，才进行平台确认，否则一经投诉将做封号处理！");
}

function IsUnpayTask(plat) {
    return confirm("您确定" + plat + "还未支付货款？\n\n确认返回后，任务将返回到“已绑定，等待接手人支付”状态！");
}

function IsSendTask() {
    return confirm("您确认已经完成发货了么？");
}

function IsReceiveAheadTask() {
    return confirm("该任务为百分百真实任务，联盟要求发货满十二小时后才能确认收货\n\n您现在确认收货，在任务结束后只能得到一半任务发布点");
}

function IsReceiveTask(plat, isStr, isIP, isShared) {
    if (isIP == 1) {
        alert("为了发布人的安全，请您更换IP后再进行确认收货");
        return false;
    }
    var tip = ""; 
    if (isStr)
        tip = "该任务为带字好评，请务必【复制好评内容】给对方带字的评价";
    if (isShared == 1)
        tip = "该任务为带字好评且需要购物分享，请务必【复制好评内容】给对方带字的评价；\n\n同时完成购物分享，分享的内容请复制评价的内容";
    if (tip)
        alert(tip);
    
    return confirm("请再次检查" + plat + "上已经确认收货了，并且已经提交了好评\n\n如果提交不属实将视为放弃申诉权\n\n");    
}

function IsConfirmTask(plat) {
    return confirm("确认审核后，您的该任务担保金与发布点将发放到接手方账户。\n\n请您确认" + plat + "已经收到买方的全额货款，且已经收到对方好评！\n");
}

function IsGradeTask(h, plat) {
    if (h <= 0)
        return confirm("确认交易好评后您将获得该任务全部奖励发布点。\n\n您确认" + plat + "上已经按照任务要求进行好评么？\n\n请真实提交，否则视为放弃申诉权！");
    else
        return confirm("该任务还未到规定好评期。\n\n现在提交好评您将只能获得50%的任务奖励发布点，确认提交好评么？");
}

function changeNewTip() {
    if (getObj("new_tip").style.display=='none')
        show('new_tip');
    else
        hide("new_tip");
    return false;
}

function changeIPTip(plat) {
    alert("为了您和发布人的安全，请您先更换IP然后清空Cookies；\n\n再使用查询的买号登录" + plat + "去确认收货和提交好评");
}

function examTip(score, t) {
    if (score >= 150 && t <= 5)
        alert("您尚未通过美乐考试，我们建议您进行美乐考试\n\n本次登录后提醒5次后不再提醒，这是第" + t + "次\n\n考试请进入【联盟中心】-->【美乐考试】");
}

