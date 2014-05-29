<?php
!defined('IN_JB')&&exit('没有权限');
class string{
	public static function save_define($arr,$path,$isStr=false){
		if(is_array($arr)){
			$define_str="<?php";
			foreach($arr as $k=>$v){
				$tmp=$v;
				if(!$isStr){
					if(!is_numeric($tmp)&&$tmp!='true'&&$tmp!='false')$tmp="'".$tmp."'";
				}else $tmp="'".$tmp."'";
				$define_str.="\ndefine('$k',$tmp);";
			}
			$define_str.="\n?>";
			savefile($path,$define_str);
		}
	}
	public static function parse_define($path){
		if(file_exists($path)){
			$data=bf_readfile($path);
			if(preg_match_all("/define\((.+?),(.+?)\);/",$data,$matches,PREG_SET_ORDER)){
				foreach($matches as $v){
					$bk_k=$v[1];
					$bk_v=$v[2];
					$bk_k=trim($bk_k);
					$bk_k=trim($bk_k,"'");
					$bk_k=trim($bk_k,'"');
					$bk_v=trim($bk_v);
					$bk_v=trim($bk_v,"'");
					$bk_v=trim($bk_v,'"');
					$rn[$bk_k]=$bk_v;
				}
				return $rn;
			}
		}
	}
	public static function format_array($arr){
		switch(gettype($arr)){
			case 'boolean':
				return $arr?"true":"false";
			break;
			case 'integer':
				return $arr;
			break;
			case 'double':
				return $arr;
			break;
			case 'string':
				return '\''.addcslashes($arr,'\'\\').'\'';
			break;
			case 'array':
				foreach($arr as $k=>$v){
					$rn&&$rn.=',';
					switch(gettype($k)){
						case 'boolean':
							$k=$k?"true":"false";
						break;
						case 'string':
							$k='\''.addcslashes($k,'\'\\').'\'';
						break;
					}
					$rn.=$k."=>".self::format_array($v);
				}
				return "array($rn)";
			break;
			case 'object':
				return '\'\'';
			break;
			case 'resource':
				return '\'\'';
			break;
			case 'NULL':
				return '\'\'';
			break;
			case 'user function':
				return '\'\'';
			break;
			case 'unknown type':
				return '\'\'';
			break;
		}
	}
	public static function show_message($message){
		
	}
	public static function str_hex($str){
		$len=strlen($str);
		$ord=0;
		$hex='';
		$a=$b=0;
		for($i=0;$i<$len;$i++){
			$ord=ord(substr($str,$i,1));
			$b=$ord%16;
			$a=($ord-$b)/16;
			($a>9&&($a=chr(97+$a-10)))||($a=chr(48+$a));
			($b>9&&($b=chr(97+$b-10)))||($b=chr(48+$b));
			$hex.=$a.$b;
		}
		return $hex;
	}
	public static function hex_str($hex){
		$len=strlen($hex);
		$a=$b=0;
		$str='';
		for($i=0;$i<$len;$i+=2){
			$a=ord(substr($hex,$i,1));
			$b=ord(substr($hex,$i+1,1));
			($a>=97&&($a=$a-97+10))||($a-=48);
			($b>=97&&($b=$b-97+10))||($b-=48);
			$str.=chr($a*16+$b);
		}
		return $str;
	}
	public static function get_object_vars_final($obj){
		if(is_object($obj)){
			$obj=get_object_vars($obj);
		}
		if(is_array($obj)){
			foreach ($obj as $key=>$value){
				$obj[$key]=self::get_object_vars_final($value);
			}
		}
		return $obj;
	}
	public static function json_encode($arr){
		if(function_exists('json_encode'))return json_encode($arr);
		else {
			global $json;
			$json || $json=new MY_JSON();
			return $json->encode($arr);
		}
	}
	public static function json_decode($str){
		//$str = preg_replace('/\s\/\/.*\n/', '', $str);
		//echo $str;print_r(json_decode($str));exit;
		//if(function_exists('json_encode'))return self::get_object_vars_final(json_decode($str));
		//else {
			global $json;
			$json || $json=new MY_JSON();
			return $json->decode($str);
		//}
	}
	public static function ubbDecode($str){
		loadFunc('ubb2html');
		return ubb2html($str);
	}
	public static function getVarString($str){
		return '\''.addcslashes($str, '\'\\').'\'';
	}
	public static function getXin($str, $start = 0, $len = -1){
		$strLen = mb_strlen($str);
		if ($start >=0 && $start <= $strLen - 1) {
			$len == -1 && $len = $strLen - $start;
			$len + $start > $strLen && $len = $strLen - $start;
			$rn = '';
			$rn .= mb_substr($str, 0, $start);
			$rn .= str_repeat('*', $len);
			$rn .= mb_substr($str, $start + $len);
			return $rn;
		}
		return str_repeat('*', $strLen);
	}
	public static function getXin2($str){
		$strLen = mb_strlen($str);
		if ($strLen >= 3) {
			return self::getXin($str, 1, $strLen - 2);
		}
		return $str;
	}
	public static function getXin3($str, $len = 1) {
		$strLen = mb_strlen($str);
		//if ($strLen == 1) return $str;
		$_l = $len;
		while ($strLen - $_l * 2 <= 0 && $_l > 0) {
			$_l--;
		}
		if ($_l > 0) {
			return self::getXin($str, $_l, $strLen - $_l * 2);
		}
		return $str;
	}
	public static function getStaticCode($arr){
		$str = '';
		foreach ($arr as $k => $v) {
			$var = '$'.$k.'=';
			switch(gettype($v)){
				case 'boolean':
					$var .= $v?"true":"false";
				break;
				case 'integer':
					$var .= $v;
				break;
				case 'double':
					$var .= $v;
				break;
				case 'string':
					$var .= '\''.addcslashes($v, '\'\\').'\'';
				break;
				case 'array':
					$var .= self::format_array($v);
				break;
				case 'object':
					$var .= '\'\'';
				break;
				case 'resource':
					$var .= '\'\'';
				break;
				case 'NULL':
					$var .= '\'\'';
				break;
				case 'user function':
					$var .= '\'\'';
				break;
				case 'unknown type':
					$var .= '\'\'';
				break;
			}
			$var.=';';
			$str .= $var;
		}
		$str = '<?php '.$str.'?>';
		return $str;
	}
	public static function setColors($string, $keys, $color){
		foreach ($keys as $key) {
			$string = str_replace($key, '<span style="color:'.$color.'">'.$key.'</span>', $string);
		}
		return $string;
	}
	public static function getRandStr($len=4,$type=7){
		$return='';
		$set_C_list=array();
		($type&1)&&($set_C_list[]=1);
		($type&2)&&($set_C_list[]=2);
		($type&4)&&($set_C_list[]=3);
		$set_C=count($set_C_list);
		$set_C>0&&($set_C--);
		for($i=0;$i<$len;$i++){
			switch($set_C_list[mt_rand(0,$set_C)]){
				case 1:
				//数字
				$return.=chr(mt_rand(0x30,0x39));
				break;
				case 2:
				//大写字母
				$return.=chr(mt_rand(0x41,0x5A));
				break;
				case 3:
				//小写字母
				$return.=chr(mt_rand(0x61,0x7A));
				break;
			}
		}
		return $return;
	}
	public static function dg_string($data,$flagA, $flagB, $start = 0){
		$flagAL=strlen($flagA);
		$flagBL=strlen($flagB);
		$rn='';
		$a=$b=0;
		if(($findA=strpos($data,$flagA, $start))!==false){
			$a=1;
			$tmpA=$findA;
			$findB=$findA+$flagAL;
			$findA=$findB;
			while($a!=$b){
				if(($findB=strpos($data,$flagB,$findB))!==false){
					$b++;
					if(($findA=strpos($data,$flagA,$findA))!==false){
						if($findA>$findB){
							if($a==$b){
								//结束
								$findB+=$flagBL;
								$rn=substr($data,$tmpA,$findB-$tmpA);
							} else {
								$a++;
								$findB=$findA+$flagAL;
								$findA=$findB;
							}
						} else {
							$a++;
							$findA+=$flagAL;
							$findB+=$flagBL;
						}
					} else {
						if($a==$b){
							//结束
							$findB+=$flagBL;
							$rn=substr($data,$tmpA,$findB-$tmpA);
						} else {
							//标记不完整
							$findB+=$flagBL;
						}
					}
				} else {
					//标记不完整
					$rn=substr($data,$tmpA);
					$rn.=str_repeat($flagB,$a-$b);
					break;
				}
			}
		}
		return $rn;
	}
	public static function dg_string2($data,$flag,$start){
		$flagA='<'.$flag;
		$flagB='</'.$flag.'>';
		$flagAL=strlen($flagA);
		$flagBL=strlen($flagB);
		$rn='';
		$a=$b=0;
		if(($findA=strpos($data,$start))!==false){
			$a=1;
			$tmpA=$findA;
			$findB=$findA+$flagAL;
			$findA=$findB;
			while($a!=$b){
				if(($findB=strpos($data,$flagB,$findB))!==false){
					$b++;
					if(($findA=strpos($data,$flagA,$findA))!==false){
						if($findA>$findB){
							if($a==$b){
								//结束
								$findB+=$flagBL;
								$rn=substr($data,$tmpA,$findB-$tmpA);
							} else {
								$a++;
								$findB=$findA+$flagAL;
								$findA=$findB;
							}
						} else {
							$a++;
							$findA+=$flagAL;
							$findB+=$flagBL;
						}
					} else {
						if($a==$b){
							//结束
							$findB+=$flagBL;
							$rn=substr($data,$tmpA,$findB-$tmpA);
						} else {
							//标记不完整
							$findB+=$flagBL;
						}
					}
				} else {
					//标记不完整
					$rn=substr($data,$tmpA);
					$rn.=str_repeat($flagB,$a-$b);
					break;
				}
			}
		}
		return $rn;
	}
	public static function formatAlert($str){
		$str = str_replace('"', '\x22', $str);
		$str = str_replace('\'', '\x27', $str);
		$str = str_replace("\r\n", "\n", $str);
		$str = str_replace("\n", '\n', $str);
		return $str;
	}
	public static function getXmlData ($strXml) {
		$pos = strpos($strXml, 'xml');
		if ($pos) {
			$xmlCode   = simplexml_load_string($strXml, 'SimpleXMLElement', LIBXML_NOCDATA);
			$arrayCode = self::get_object_vars_final($xmlCode);
			return $arrayCode ;
		} else {
			return '';
		}
	}
	public static function parseChoose($str){
		$sp = common::trimExplode("\n", $str);
		$list = array();
		foreach ($sp as $v) {
			if ($v) {
				$sp1 = common::trimExplode('=', $v);
				$list[] = array('key' => $sp1[1], 'value' => $sp1[0]);
			}
		}
		return $list;
	}
	public static function getCheckBox($arr){
		$rn = 0;
		if ($arr) {
			foreach ($arr as $v) {
				$rn |= 1 << ($v - 1);
			}
		}
		return $rn;
	}
}
?>