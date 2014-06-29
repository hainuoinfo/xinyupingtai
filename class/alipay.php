<?php
class alipay{
	public static $config=array(
		'partner'			=>	"2088302786578022"								,//合作身份者ID
		'security_code'		=>	"33zwnfq6zwhf20y0a3hvver94ga2mnvz"				,//安全检验码
		'seller_email'		=>	"alishuashua@163.com"						,//签约支付宝账号或卖家支付宝帐户
		'_input_charset'	=>	"utf-8"											,//字符编码格式 目前支持 GBK 或 utf-8
		'transport'			=>	"http"											,//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		'notify_url'		=>	"http://www.xxx.cn/db_php_utf8/notify_url.php"	,//交易过程中服务器通知的页面 要用 http://格式的完整路径，不允许加?id=123这类自定义参数
		'return_url'		=>	"http://www.xxx.cn/db_php_utf8/return_url.php"	,//付完款后跳转的页面 要用 http://格式的完整路径，不允许加?id=123这类自定义参数
		'show_url'			=>	"http://www.nianmen.cn"							,//网站商品的展示地址，不允许加?id=123这类自定义参数
		'sign_type'			=>	"MD5"											,//加密方式 不需修改
		'mainname'			=>	"首信老人手机"
	);
	public static function payfor($oid,$subject,$content,$price,$buy_name,$buy_address,$buy_zip,$buy_telephone,$buy_mobilephone){
		extract(self::$config);
		$out_trade_no	= $oid;				//请与贵网站订单系统中的唯一订单号匹配
		$subject		= $subject;		//订单名称，显示在支付宝收银台里的“商品名称”里，显示在支付宝的交易管理的“商品名称”的列表里。
		$body			= $content;		//订单描述、订单详细、订单备注，显示在支付宝收银台里的“商品描述”里
		$price			= $price;		//订单总金额，显示在支付宝收银台里的“应付总额”里
		
		$logistics_fee		= "40.00";				//物流费用，即运费。
		$logistics_type		= "EXPRESS";			//物流类型，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
		$logistics_payment	= "SELLER_PAY";			//物流支付方式，两个值可选：SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）
		
		$quantity		= "1";						//商品数量，建议默认为1，不改变值，把一次交易看成是一次下订单而非购买一件商品。
		
		//扩展参数——买家收货信息（推荐作为必填）
		//该功能作用在于买家已经在商户网站的下单流程中填过一次收货信息，而不需要买家在支付宝的付款流程中再次填写收货信息。
		//若要使用该功能，请至少保证receive_name、receive_address有值
		$receive_name		= $buy_name;			//收货人姓名，如：张三
		$receive_address	= $buy_address;			//收货人地址，如：XX省XXX市XXX区XXX路XXX小区XXX栋XXX单元XXX号
		$receive_zip		= $buy_zip;			//收货人邮编，如：123456
		$receive_phone		= $buy_telephone;		//收货人电话号码，如：0571-81234567
		$receive_mobile		= $buy_mobilephone;		//收货人手机号码，如：13312341234
		
		//扩展参数——第二组物流方式
		//物流方式是三个为一组成组出现。若要使用，三个参数都需要填上数据；若不使用，三个参数都需要为空
		//有了第一组物流方式，才能有第二组物流方式，且不能与第一个物流方式中的物流类型相同，
		//即logistics_type="EXPRESS"，那么logistics_type_1就必须在剩下的两个值（POST、EMS）中选择
		$logistics_fee_1	= "";					//物流费用，即运费。
		$logistics_type_1	= "";					//物流类型，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
		$logistics_payment_1= "";					//物流支付方式，两个值可选：SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）
		
		//扩展参数——第三组物流方式
		//物流方式是三个为一组成组出现。若要使用，三个参数都需要填上数据；若不使用，三个参数都需要为空
		//有了第一组物流方式和第二组物流方式，才能有第三组物流方式，且不能与第一组物流方式和第二组物流方式中的物流类型相同，
		//即logistics_type="EXPRESS"、logistics_type_1="EMS"，那么logistics_type_2就只能选择"POST"
		$logistics_fee_2	= "";					//物流费用，即运费。
		$logistics_type_2	= "";					//物流类型，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
		$logistics_payment_2= "";					//物流支付方式，两个值可选：SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）
		
		//扩展功能参数——其他
		$buyer_email		= '';					//默认买家支付宝账号
		$discount	 		= '';					//折扣，是具体的金额，而不是百分比。若要使用打折，请使用负数，并保证小数点最多两位数
		
		/////////////////////////////////////////////////
		$parameter = array(
				"service"			=> "create_partner_trade_by_buyer",	//接口名称，不需要修改
				"payment_type"		=> "1",               				//交易类型，不需要修改
		
				//获取配置文件(alipay_config.php)中的值
				"partner"			=> $partner,
				"seller_email"		=> $seller_email,
				"return_url"		=> $return_url,
				"notify_url"		=> $notify_url,
				"_input_charset"	=> $_input_charset,
				"show_url"			=> $show_url,
		
				//从订单数据中动态获取到的必填参数
				"out_trade_no"		=> $out_trade_no,
				"subject"			=> $subject,
				"body"				=> $body,
				"price"				=> $price,
				"quantity"			=> $quantity,
				
				"logistics_fee"		=> $logistics_fee,
				"logistics_type"	=> $logistics_type,
				"logistics_payment"	=> $logistics_payment,
				
				//扩展功能参数——买家收货信息
				"receive_name"		=> $receive_name,
				"receive_address"	=> $receive_address,
				"receive_zip"		=> $receive_zip,
				"receive_phone"		=> $receive_phone,
				"receive_mobile"	=> $receive_mobile,
				
				//扩展功能参数——第二组物流方式
				"logistics_fee_1"	=> $logistics_fee_1,
				"logistics_type_1"	=> $logistics_type_1,
				"logistics_payment_1"=> $logistics_payment_1,
				
				//扩展功能参数——第三组物流方式
				"logistics_fee_2"	=> $logistics_fee_2,
				"logistics_type_2"	=> $logistics_type_2,
				"logistics_payment_2"=> $logistics_payment_2,
		
				//扩展功能参数——其他
				"discount"			=> $discount,
				"buyer_email"		=> $buyer_email
		);
		$parameter=self::para_filter($parameter);
		$sort_array   = self::arg_sort($parameter);
		$mysign =self::build_mysign($sort_array,$security_code,$sign_type);
		//print_r($sort_array);
        return 'https://www.alipay.com/cooperate/gateway.do?'.self::create_linkstring_urlencode($sort_array)."&sign=" .$mysign ."&sign_type=".$sign_type;
		//echo self::create_linkstring_urlencode($sort_array);
	}
	public static function notify_verify() {
        extract(self::$config);
		if($transport == "https") {
            $gateway = "https://www.alipay.com/cooperate/gateway.do?";
        }else {
            $gateway = "http://notify.alipay.com/trade/notify_query.do?";
        }
        if($transport == "https") {
            $veryfy_url = $gateway. "service=notify_verify" ."&partner=" .$partner. "&notify_id=".$_POST["notify_id"];
        } else {
            $veryfy_url = $gateway. "partner=".$partner."&notify_id=".$_POST["notify_id"];
        }
        $veryfy_result = self::get_verify($veryfy_url);

        //生成签名结果
		if(empty($_POST)) {							//判断POST来的数组是否为空
			return false;
		} else {		
			$post          = self::para_filter($_POST);	    //对所有POST返回的参数去空
			$sort_post     = self::arg_sort($post);	    //对所有POST反馈回来的数据排序
			$mysign  = self::build_mysign($sort_post,$security_code,$sign_type);   //生成签名结果
	
			//写日志记录
			//log_result("veryfy_result=".$veryfy_result."\n notify_url_log:sign=".$_POST["sign"]."&mysign=".$this->mysign.",".create_linkstring($sort_post));
	
			//判断veryfy_result是否为ture，生成的签名结果mysign与获得的签名结果sign是否一致
			//$veryfy_result的结果不是true，与服务器设置问题、合作身份者ID、notify_id一分钟失效有关
			//mysign与sign不等，与安全校验码、请求时的参数格式（如：带自定义参数等）、编码格式有关
			if (preg_match("/true$/i",$veryfy_result) && $this->mysign == $_POST["sign"]) {
				return true;
			} else {
				return false;
			}
		}
    }
	private static function get_verify($url,$time_out = "60") {
        $urlarr     = parse_url($url);
        $errno      = "";
        $errstr     = "";
        $transports = "";
        if($urlarr["scheme"] == "https") {
            $transports = "ssl://";
            $urlarr["port"] = "443";
        } else {
            $transports = "tcp://";
            $urlarr["port"] = "80";
        }
        $fp=@fsockopen($transports . $urlarr['host'],$urlarr['port'],$errno,$errstr,$time_out);
        if(!$fp) {
            die("ERROR: $errno - $errstr<br />\n");
        } else {
            fputs($fp, "POST ".$urlarr["path"]." HTTP/1.1\r\n");
            fputs($fp, "Host: ".$urlarr["host"]."\r\n");
            fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
            fputs($fp, "Content-length: ".strlen($urlarr["query"])."\r\n");
            fputs($fp, "Connection: close\r\n\r\n");
            fputs($fp, $urlarr["query"] . "\r\n\r\n");
            while(!feof($fp)) {
                $info[]=@fgets($fp, 1024);
            }
            fclose($fp);
            $info = implode(",",$info);
            return $info;
        }
    }
	private static function para_filter($parameter) {
		$para = array();
		while (list ($key, $val) = each ($parameter)) {
			if($key == "sign" || $key == "sign_type" || $val == "")continue;
			else	$para[$key] = $parameter[$key];
		}
		return $para;
	}
	private static function arg_sort($array) {
		ksort($array);
		reset($array);
		return $array;
	}
	private static function build_mysign($sort_array,$security_code,$sign_type = "MD5") {
		$prestr = self::create_linkstring($sort_array);     	//把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
		$prestr = $prestr.$security_code;				//把拼接后的字符串再与安全校验码直接连接起来
		$mysgin = self::sign($prestr,$sign_type);			    //把最终的字符串加密，获得签名结果
		return $mysgin;
	}
	private static function create_linkstring($array) {
		$arg  = "";
		while (list ($key, $val) = each ($array)) {
			$arg.=$key."=".$val."&";
		}
		$arg = substr($arg,0,count($arg)-2);		     //去掉最后一个&字符
		return $arg;
	}
	private static function create_linkstring_urlencode($array) {
		$arg  = "";
		while (list ($key, $val) = each ($array)) {
			if ($key != "service" && $key != "_input_charset")
				$arg.=$key."=".urlencode($val)."&";
			else $arg.=$key."=".$val."&";
		}
		$arg = substr($arg,0,count($arg)-2);		     //去掉最后一个&字符
		return $arg;
	}
	private static function sign($prestr,$sign_type) {
		$sign='';
		if($sign_type == 'MD5') {
			$sign = md5($prestr);
		}elseif($sign_type =='DSA') {
			//DSA 签名方法待后续开发
			die("DSA 签名方法待后续开发，请先使用MD5签名方式");
		}else {
			die("支付宝暂不支持".$sign_type."类型的签名方式");
		}
		return $sign;
	}
}
?>