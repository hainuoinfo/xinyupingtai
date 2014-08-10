<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
loadLib('member.base');
loadLib('member.credit');
common::char_set();
common::nocache();
if (!$memberLogined) {
	echo '对不起，请先登陆后再操作！';
	exit;
}
template::initialize('./templates/default/ajax/', './cache/default/ajax/');
  $bid = $_POST['bid'];
  $new = $_POST['taskid'];
   if ($new) {
        $is_real = db::one('task', '*', "id='$new'");
		$real =$is_real['isReal'];
			$rs = task_tao::in($new, $uid,$bid); 
			if ($rs == true) {
			    if($rs==1){
			        $result =array(
				    'StateCode'=> 1,
					'StateMsg'=> "您还未通过新手考试"
				   );
				}
				elseif($rs==2){
			        $result =array(
				    'StateCode'=> 2,
					'StateMsg'=> "请您先手机激活帐号"
				   );
				}
				elseif($rs==3){
			        $result =array(
				    'StateCode'=> 3,
					'StateMsg'=> "对不起，您的商保担保金小于该任务金额，不能接手"
				   );
				}
				elseif($rs==4){
			        $result =array(
				    'StateCode'=> 4,
					'StateMsg'=> "对不起，该任务需要商保用户才能接手"
				   );
				}
				elseif($rs==5){
			        $result =array(
				    'StateCode'=> 5,
					'StateMsg'=> "温馨提示：您必须绑定一个支付宝实名买号才可以接手此任务！"
				   );
				}
				elseif($rs==10){
			        $result =array(
				    'StateCode'=> 0,
					'StateMsg'=> "绑定买号"
				   );
				}
				elseif($rs==11){
			        $result =array(
				    'StateCode'=> 11,
					'StateMsg'=> "对不起，您被投诉次数导致您不能接手该任务"
				   );
				}
				elseif($rs==12){
			        $result =array(
				    'StateCode'=> 12,
					'StateMsg'=> "您接的任务数量过多"
				   );
				}
				else{
				    $result =array(
				    'StateCode'=> '-1',
					'StateMsg'=> "$rs"
				   );
				}
			} else {
				$result =array(
				'StateCode'=> 0, 
				'IsReal'=>$real,
				'StateMsg'=> "$rs"
				);	
			}		
	}
echo json_encode($result);
?>