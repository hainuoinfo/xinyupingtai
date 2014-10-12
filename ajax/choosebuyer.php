<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
loadLib('task.base');
if (!$memberLogined) {
	echo '对不起，请先登陆后再操作！';
	exit;
}
template::initialize('./templates/default/ajax/', './cache/default/ajax/');
    $taskid = $_POST['taskid'];
    $insertDb=$_POST['insertDb'];
    $bid = $_POST['buyAccount'];
	if ($taskid) {
		if ($task = task_base::_get($taskid)) {
		if($bid && $insertDb==1){
				    $members = member_base::getMember($uid);
					$buyer = task_buyer::getBuyer($bid, $uid);
				    if($task['isawb']){
					    $state=db::exists('express_buyers', array('uid' => $uid, 'bid' => $bid));
				        if ($state==0){
					        $result =array(
				            'StateCode'=> -2, 
				            'url'=>'tao',
					        'urlpai'=>'pai',
				            'StateMsg'=> '您没有填写签收快递收货详细信息，无法接手该任务!'
				            );
					    }
			        }
					
					task_base::tieBuyer($taskid, $bid, $uid);
				    task_base::addLog($taskid, '绑定买号', '{busername}向任务{id}绑定了买号');
					member_base::sendPm($task['suid'], '您的任务“'.$task['id'].'”被'.member_base::getUsername($uid).'接手了', '任务“'.$task['id'].'”被接手', 'out_take');
						member_base::sendSms($task['suid'], '您的任务“'.$task['id'].'”被'.member_base::getUsername($uid).'接手了', 'out_take');
					if ($task['isVerify']){
					       $result =array(
				           'StateCode'=> 0, 
				           'url'=>'tao',
					       'urlpai'=>'pai',
				           'StateMsg'=> '1. 您已经成功为该任务选择了买号，请确保使用选择的买号购买任务商品，否则视为放弃申诉权；<br />2. 由于该任务发布方选择了“审核接手人”，请等待或联系发布方审核；'
				          );
					} else {
					       $result =array(
				           'StateCode'=> 0, 
				           'url'=>'tao',
					       'urlpai'=>'pai',
				           'StateMsg'=> '1. 您已经成功为该任务选择了买号，请确保使用选择的买号购买任务商品，否则视为放弃申诉权；<br />2. 请在十五分钟内拍下任务商品并且按任务平台担保价'.$task['price'].'元支付；<br />3. 发布方已经在发布任务时在平台扣押了等额的平台担保金，任务完成后您将获得该笔平台存款和'.$task['point'].'个兔粮”；<br />4. 如果发现商品价格（包含运费）与任务担保价不等请联系发布方修改价格与延长操作时间；'
				           );
					}
					
				}else
				{
					$result =array(
						'StateCode'=> 0, 
						'url'=>'tao',
						'urlpai'=>'pai',
						'StateMsg'=> '你已经成功选择了买号，点击确定后将检查该买号是否能够接手此任务！'
					);
				}
				
        }
	}
				
echo json_encode($result);
?>