<?php
class message{
//http://service.winic.org/webservice/public/remoney.asp?uid=Tyiser&pwd=TIANHUI!!!  余额查询
//http://service.winic.org/sys_port/gateway/?id=Tyiser&pwd=TIANHUI!!!&to=13982017238&content=新政网，短信网管测试
	private $one_money = 0.1;
	public $money, $username, $password, $logined;
	function __construct($username,$password){
		$this->logined  = false;
		$this->money    = 0;
		$this->username = $username;
		$this->password = $password;
		$html = $this->open_url("http://service.winic.org/webservice/public/remoney.asp?uid=$username&pwd=$password");
		if(is_numeric($html)){
			$this->logined = true;
			$this->money   = (float)$html;
		}
	}
	function __destruct(){
		
	}
	function send($phone,$content){
		//$c_len=mb_strlen($content,'GBK');
		if($this->money<0.1 || !$phone || !$content)return false;
		$content = mb_substr($content,0,70,"GBK");
		$content = urlencode($content);
		$html = $this->open_url("http://service.winic.org/sys_port/gateway/?id=$this->username&pwd=$this->password&to=$phone&content=$content");
		//echo "http://service.winic.org/sys_port/gateway/?id=$this->username&pwd=$this->password&to=$phone&content=$content";
		//echo $html;
		if(preg_match("/^\s*(\d{3}|-\d{2})\\/Send:(\d{1,100})\\/Consumption:([\d\.]+)\\/Tmoney:([\d\.]+)\\/sid:(\d+)$/is",$html,$rs)){
			$status=array(
			'000'=>array('state' => true,  'info' => '成功'),
			'-01'=>array('state' => false, 'info' => '当前余额不足'),
			'-02'=>array('state' => false, 'info' => '当前用户ID错误'),
			'-03'=>array('state' => false, 'info' => '当前密码错误'),
			'-04'=>array('state' => false, 'info' => '参数不够或参数内容的类型错误'),
			'-05'=>array('state' => false, 'info' => '手机号码格式不对'),
			'-06'=>array('state' => false, 'info' => '短信内容编码不对'),
			'-07'=>array('state' => false, 'info' => '短信内容含有敏感字符'),
			'-08'=>array('state' => false, 'info' => '账号已冻结或锁定'),
			'-09'=>array('state' => false, 'info' => '系统维护中'),
			'-10'=>array('state' => false, 'info' => '手机号码数量超长'),
			'-11'=>array('state' => false, 'info' => '短信内容超长'),
			'-12'=>array('state' => false, 'info' => '其它错误')
			);
			if($status[$rs[1]]['state']){
				$this->money=(float)$rs[4];
				return true;
			} else {
				$this->errstr=$status[$rs[1]]['info'];
				return false;	
			}
		} else {
			//
			$this->errarr=array('html'=>$html,'rs'=>$rs);
			$this->errstr='匹配错误';
		}
	}
	public function TelCall($host_call,$caller){
		if(preg_match("/^\d{10,13}$/",$host_call)&&preg_match("/^\d{10,13}$/",$caller)){
			$html=$this->post_url("http://service2.winic.org/Service.asmx",$host_call,$caller);
			//echo "uid=$this->username&pwd=$this->password&Host_call=$host_call&caller=$caller";
			//echo "|",$html,"|";
			if(preg_match("/<TelCallResult>(\d{16})<\/TelCallResult>/i",$html)){
				return true;
			} else {
				$this->errstr="呼叫失败 $html";
				return false;
			}
		} else {
			$this->errstr="电话格式错误";
			return false;
		}
	}
	private function open_url($url){
		if(preg_match("/^(?:http:\\/\\/)?([^\\/:]+)(?::(\d+))?(.*)$/i",$url,$rs)){
			$host=$rs[1];
			$port=$rs[2] or $port=80;
			$target=$rs[3] or $target="/";
			$f=@fsockopen($host,$port,$errno,$errstr,30);
			if($f){
				$out="GET $target HTTP/1.1\r\n";
				$out.="Host: $host\r\n";
				$out.="Connection: Close\r\n";
				$out.="\r\n";
				fwrite($f,$out);
				while($r=fread($f,1024)){
					$html.=$r;
				}
				fclose($f);
				if($html){
					$html=substr($html,strpos($html,"\r\n\r\n"));
				}
				return $html;
			}
		}
	}
	private function post_url($url,$host_call,$caller){
		if(preg_match("/^(?:http:\\/\\/)?([^\\/:]+)(?::(\d+))?(.*)$/i",$url,$rs)){
			$host=$rs[1];
			$port=$rs[2] or $port=80;
			$target=$rs[3] or $target="/";
			$f=@fsockopen($host,$port,$errno,$errstr,30);
			if($f){
				$data="<?xml version=\"1.0\" encoding=\"utf-8\"?>
<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">
  <soap:Body>
    <TelCall xmlns=\"http://tempuri.org/\">
      <uid>$this->username</uid>
      <pwd>$this->password</pwd>
      <host_call>$host_call</host_call>
      <caller>$caller</caller>
    </TelCall>
  </soap:Body>
</soap:Envelope>";
				$out="POST $target HTTP/1.1\r\n";
				$out.="Host: $host\r\n";
				$out.="Content-Type: text/xml; charset=utf-8\r\n";
				$out.="Content-Length: ".strlen($data)."\r\n";
				$out.="Connection: Close\r\n";
				$out.="SOAPAction: http://tempuri.org/TelCall\r\n\r\n";
				$out.=$data;
				fwrite($f,$out);
				while($r=fread($f,1024)){
					$html.=$r;
				}
				fclose($f);
				if($html){
					$html=substr($html,strpos($html,"\r\n\r\n"));
				}
				return $html;
			}
		}
	}
}
?>