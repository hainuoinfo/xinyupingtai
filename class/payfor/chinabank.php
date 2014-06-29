<?php
(!defined('IN_JB') || IN_JB !== true) && exit('error');
class payfor_chinabank{
	private $id, $key, $url;
	public $status, $name;
	public function __construct(){
		$payfor_config = cache::get_array('payfor_config', true);
		if ($info = db::one('payfor_interface', '*', "ename='chinabank'")) {
			$this->name   = $info['name'];
			$this->id     = $info['userid'];
			$this->key    = $info['userpwd'];
			$this->status = $info['status'];
		} else {
			$this->status = false;
			$this->name   = '未知充值方式';
		}
		$this->url  = 'https://pay3.chinabank.com.cn/PayGate';
	}
	public function payfor($id, $money){
		global $weburl, $sys_debug;
		if ($this->status) {
			//if ($sys_debug) $money = 0.01;
			$v_mid       = $this->id;
			$v_oid       = $id;
			$v_amount    = $money;
			$v_moneytype = 'CNY';
			$v_url       = $weburl.'/payfor/chinabank/Receive.php';
			$v_md5info   = strtoupper(md5($v_amount.$v_moneytype.$v_oid.$v_mid.$v_url.$this->key));
			$args = array(
				'url'   => $this->url,
				'type'  => 'post',
				'datas' => array(
					'v_mid'       => $v_mid,
					'v_oid'       => $v_oid,
					'v_amount'    => $v_amount,
					'v_moneytype' => $v_moneytype,
					'v_url'       => $v_url,
					'v_md5info'   => $v_md5info
				)
			);
			return $args;
		}
		return false;
	}
	public function checkReturnA(){
		if ($this->status) {	
			$v_oid        =trim($_POST['v_oid']);       // 商户发送的v_oid定单编号   
			$v_pmode      =trim($_POST['v_pmode']);    // 支付方式（字符串）   
			$v_pstatus    =trim($_POST['v_pstatus']);   //  支付状态 ：20（支付成功）；30（支付失败）
			$v_pstring    =trim($_POST['v_pstring']);   // 支付结果信息 ： 支付完成（当v_pstatus=20时）；失败原因（当v_pstatus=30时,字符串）； 
			$v_amount     =trim($_POST['v_amount']);     // 订单实际支付金额
			$v_moneytype  =trim($_POST['v_moneytype']); //订单实际支付币种    
			$remark1      =trim($_POST['remark1' ]);      //备注字段1
			$remark2      =trim($_POST['remark2' ]);     //备注字段2
			$v_md5str     =trim($_POST['v_md5str' ]);   //拼凑后的MD5校验值  
								   
			$md5string = strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$this->key));//检查MD5值
			if ($v_md5str == $md5string){
				if($v_pstatus=="20"){
					return $v_oid;
				}
			}
		}
		return false;
	}
	public static function checkReturnB(){
		return $this->checkReturnA();
	}
}
?>