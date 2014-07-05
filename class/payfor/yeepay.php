<?php
(!defined('IN_JB') || IN_JB !== true) && exit('error');
class payfor_yeepay{
	private $id, $key, $url;
	public $status, $name;
	public function __construct(){
		//$payfor_config = cache::get_array('payfor_config', true);
		if ($info = db::one('payfor_interface', '*', "ename='yeepay'")) {
			$this->name   = $info['name'];
			$this->id     = $info['userid'];
			$this->key    = $info['userpwd'];
			$this->status = $info['status'];
		} else {
			$this->status = false;
			$this->name   = '未知充值方式';
		}
		$this->url  = 'https://www.yeepay.com/app-merchant-proxy/node';//'http://tech.yeepay.com:8080/robot/debug.action'
	}
	public function payfor($id, $money){
		global $weburl, $sys_debug, $web_name;
		if ($this->status) {
			//if ($sys_debug) 
			//$money = '0.01';
			$p2_Order			= $id; //订单ID;
			$p3_Amt				= $money;//支付金额 小数点后两位;
			$p4_Cur				= "CNY";//交易币种
			$p5_Pid				= $web_name.'在线充值';//商品名称;
			$p6_Pcat			= '';//商品种类
			$p7_Pdesc			= $web_name.'在线充值';//$this->iconv($web_name.'在线充值');//商品描述;
			$p8_Url				= $weburl.'/payfor/yeepay/callback.php';//回调URL;											
			$pa_MP				= '';//扩展信息 为空就好;		
			$pd_FrpId			= '';//ENCODING;//编码
			$pr_NeedResponse	= '1';//回调 1 是
			$hmac = $this->getReqHmacString($p2_Order, $p3_Amt, $p4_Cur, $p5_Pid, $p6_Pcat, $p7_Pdesc, $p8_Url, $pa_MP, $pd_FrpId, $pr_NeedResponse);//签名
			$args = array(
				'url'   => $this->url,
				'type'  => 'post',
				'encoding' => 'GBK',
				'datas' => array(
					'p0_Cmd'          => 'Buy',
					'p1_MerId'        => $this->id,
					'p2_Order'        => $p2_Order,
					'p3_Amt'          => $p3_Amt,
					'p4_Cur'          => $p4_Cur,
					'p5_Pid'          => $p5_Pid,
					'p6_Pcat'         => $p6_Pcat,
					'p7_Pdesc'        => $p7_Pdesc,
					'p8_Url'          => $p8_Url,
					'p9_SAF'          => '0',
					'pa_MP'           => $pa_MP,
					'pd_FrpId'        => $pd_FrpId,
					'pr_NeedResponse' => $pr_NeedResponse,
					'hmac'            => $hmac
				)
			);
			return $args;
		}
		return false;
	}
	private function iconv($arr, $AToB = true){
		if (is_array($arr)) {
			foreach ($arr as $k => $v) {
				$arr[$k] = $this->iconv($v, $AToB);
			}
			return $arr;
		} else return $AToB ? iconv(ENCODING, 'GBK', $arr) : iconv('GBK', ENCODING, $arr);
	}
	private function HmacMd5($data, $key){
		// RFC 2104 HMAC implementation for php.
		// Creates an md5 HMAC.
		// Eliminates the need to install mhash to compute a HMAC
		// Hacked by Lance Rushing(NOTE: Hacked means written)
		//需要配置环境支持iconv，否则中文参数不能正常处理
		//$key  = iconv("GB2312","UTF-8", $key);
		//$data = iconv("GB2312","UTF-8", $data);
		
		$b = 64; // byte length for md5
		if (strlen($key) > $b) {
			$key = pack("H*",md5($key));
		}
		$key    = str_pad($key, $b, chr(0x00));
		$ipad   = str_pad(''  , $b, chr(0x36));
		$opad   = str_pad(''  , $b, chr(0x5c));
		$k_ipad = $key ^ $ipad ;
		$k_opad = $key ^ $opad;
		return md5($k_opad . pack("H*",md5($k_ipad . $data)));
	}
	private function getReqHmacString($p2_Order,$p3_Amt,$p4_Cur,$p5_Pid,$p6_Pcat,$p7_Pdesc,$p8_Url,$pa_MP,$pd_FrpId,$pr_NeedResponse){
		$p0_Cmd      = 'Buy';
		$p9_SAF      = '0';
		$p1_MerId    = $this->id;
		$merchantKey = $this->key;
		#进行签名处理，一定按照文档中标明的签名顺序进行
		$sbOld = "";
		#加入业务类型
		$sbOld = $sbOld.$p0_Cmd;
		#加入商户编号
		$sbOld = $sbOld.$p1_MerId;
		#加入商户订单号
		$sbOld = $sbOld.$p2_Order;     
		#加入支付金额
		$sbOld = $sbOld.$p3_Amt;
		#加入交易币种
		$sbOld = $sbOld.$p4_Cur;
		#加入商品名称
		$sbOld = $sbOld.$p5_Pid;
		#加入商品分类
		$sbOld = $sbOld.$p6_Pcat;
		#加入商品描述
		$sbOld = $sbOld.$p7_Pdesc;
		#加入商户接收支付成功数据的地址
		$sbOld = $sbOld.$p8_Url;
		#加入送货地址标识
		$sbOld = $sbOld.$p9_SAF;
		#加入商户扩展信息
		$sbOld = $sbOld.$pa_MP;
		#加入支付通道编码
		$sbOld = $sbOld.$pd_FrpId;
		#加入是否需要应答机制
		$sbOld = $sbOld.$pr_NeedResponse;
		return $this->HmacMd5($sbOld, $merchantKey);
	}
	private function getCallbackHmacString($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType){
		//$p0_Cmd      = 'Buy';
		//$p9_SAF      = '0';
		$p1_MerId    = $this->id;
		$merchantKey = $this->key;
		#取得加密前的字符串
		$sbOld = "";
		#加入商家ID
		$sbOld = $sbOld.$p1_MerId;
		#加入消息类型
		$sbOld = $sbOld.$r0_Cmd;
		#加入业务返回码
		$sbOld = $sbOld.$r1_Code;
		#加入交易ID
		$sbOld = $sbOld.$r2_TrxId;
		#加入交易金额
		$sbOld = $sbOld.$r3_Amt;
		#加入货币单位
		$sbOld = $sbOld.$r4_Cur;
		#加入产品Id
		$sbOld = $sbOld.$r5_Pid;
		#加入订单ID
		$sbOld = $sbOld.$r6_Order;
		#加入用户ID
		$sbOld = $sbOld.$r7_Uid;
		#加入商家扩展信息
		$sbOld = $sbOld.$r8_MP;
		#加入交易结果返回类型
		$sbOld = $sbOld.$r9_BType;
		return $this->HmacMd5($sbOld,$merchantKey);
	
	}
	public function checkReturnA(){
		if ($this->status) {
			//echo $_REQUEST['r5_Pid'], '<br />', iconv('GBK', ENCODING, $_REQUEST['r5_Pid']), '<br />', $this->iconv($_REQUEST['r5_Pid'], false);exit;
			$_REQUEST = $this->iconv($_REQUEST, false);
			$r0_Cmd		= $_REQUEST['r0_Cmd'];
			$r1_Code	= $_REQUEST['r1_Code'];
			$r2_TrxId	= $_REQUEST['r2_TrxId'];
			$r3_Amt		= $_REQUEST['r3_Amt'];
			$r4_Cur		= $_REQUEST['r4_Cur'];
			$r5_Pid		= $_REQUEST['r5_Pid'];
			$r6_Order	= $_REQUEST['r6_Order'];
			$r7_Uid		= $_REQUEST['r7_Uid'];
			$r8_MP		= $_REQUEST['r8_MP'];
			$r9_BType	= $_REQUEST['r9_BType']; 
			$hmac		= $_REQUEST['hmac'];
			//if ($r1_Code == '1') {
				if ($this->getCallbackHmacString($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType) == $hmac) return $r6_Order;
			//}
		}
		return false;
	}
	public function checkReturnB(){
		return $this->checkReturnA();
	}
}
?>