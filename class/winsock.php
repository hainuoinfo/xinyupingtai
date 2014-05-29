<?php
if (!function_exists('gzdecode')) { 
	function gzdecode($data,&$filename='',&$error='',$maxlength=null) {
		$len = strlen($data);
		if ($len < 18 || strcmp(substr($data,0,2),"\x1f\x8b")) {
			$error = "Not in GZIP format.";
			return null;  // Not GZIP format (See RFC 1952)
		}
		$method = ord(substr($data,2,1));  // Compression method
		$flags  = ord(substr($data,3,1));  // Flags
		if ($flags & 31 != $flags) {
			$error = "Reserved bits not allowed.";
			return null;
		}
		// NOTE: $mtime may be negative (PHP integer limitations)
		$mtime = unpack("V", substr($data,4,4));
		$mtime = $mtime[1];
		$xfl   = substr($data,8,1);
		$os    = substr($data,8,1);
		$headerlen = 10;
		$extralen  = 0;
		$extra     = "";
		if ($flags & 4) {
			// 2-byte length prefixed EXTRA data in header
			if ($len - $headerlen - 2 < 8) {
				return false;  // invalid
			}
			$extralen = unpack("v",substr($data,8,2));
			$extralen = $extralen[1];
			if ($len - $headerlen - 2 - $extralen < 8) {
				return false;  // invalid
			}
			$extra = substr($data,10,$extralen);
			$headerlen += 2 + $extralen;
		}
		$filenamelen = 0;
		$filename = "";
		if ($flags & 8) {
			// C-style string
			if ($len - $headerlen - 1 < 8) {
				return false; // invalid
			}
			$filenamelen = strpos(substr($data,$headerlen),chr(0));
			if ($filenamelen === false || $len - $headerlen - $filenamelen - 1 < 8) {
				return false; // invalid
			}
			$filename = substr($data,$headerlen,$filenamelen);
			$headerlen += $filenamelen + 1;
		}
		$commentlen = 0;
		$comment = "";
		if ($flags & 16) {
			// C-style string COMMENT data in header
			if ($len - $headerlen - 1 < 8) {
				return false;    // invalid
			}
			$commentlen = strpos(substr($data,$headerlen),chr(0));
			if ($commentlen === false || $len - $headerlen - $commentlen - 1 < 8) {
				return false;    // Invalid header format
			}
			$comment = substr($data,$headerlen,$commentlen);
			$headerlen += $commentlen + 1;
		}
		$headercrc = "";
		if ($flags & 2) {
			// 2-bytes (lowest order) of CRC32 on header present
			if ($len - $headerlen - 2 < 8) {
				return false;    // invalid
			}
			$calccrc = crc32(substr($data,0,$headerlen)) & 0xffff;
			$headercrc = unpack("v", substr($data,$headerlen,2));
			$headercrc = $headercrc[1];
			if ($headercrc != $calccrc) {
				$error = "Header checksum failed.";
				return false;    // Bad header CRC
			}
			$headerlen += 2;
		}
		// GZIP FOOTER
		$datacrc = unpack("V",substr($data,-8,4));
		$datacrc = sprintf('%u',$datacrc[1] & 0xFFFFFFFF);
		$isize = unpack("V",substr($data,-4));
		$isize = $isize[1];
		// decompression:
		$bodylen = $len-$headerlen-8;
		if ($bodylen < 1) {
			// IMPLEMENTATION BUG!
			return null;
		}
		$body = substr($data,$headerlen,$bodylen);
		$data = "";
		if ($bodylen > 0) {
			switch ($method) {
			case 8:
				// Currently the only supported compression method:
				$data = gzinflate($body,$maxlength);
				break;
			default:
				$error = "Unknown compression method.";
				return false;
			}
		}  // zero-byte body content is allowed
		// Verifiy CRC32
		$crc   = sprintf("%u",crc32($data));
		$crcOK = $crc == $datacrc;
		$lenOK = $isize == strlen($data);
		if (!$lenOK || !$crcOK) {
			$error = ( $lenOK ? '' : 'Length check FAILED. ') . ( $crcOK ? '' : 'Checksum FAILED.');
			return false;
		}
		return $data;
	}
}
class winsock{
	public static function isIp($ipStr){
		return preg_match('/^\d{1,3}(?:\.\d{1,3}){3}$/', $ipStr) > 0?true:false;
	}
	public static function args($args){
		if(is_array($args)&&count($args)>0){
			foreach($args as $k=>$v){
				$rn.="$k: $v\r\n";
			}
			return $rn;
		}
	}
	public static function parseUrl($url){
		if(strpos($url, '://')===false)$url = 'http://'.$url;
		$urlInfo = parse_url($url);
		$urlInfo['scheme'] = strtolower($urlInfo['scheme']);
		!$urlInfo['path'] && $urlInfo['path'] = '/';
		!$urlInfo['port'] && $urlInfo['port'] = ($urlInfo['scheme'] == 'https'?'443':'80');
		$urlInfo['query'] && $urlInfo['path'] .='?'.$urlInfo['query'];
		return $urlInfo;
	}
	private static function parseHead($head){
		$rn = $httpInfo = $args = array();
		$sp = explode("\r\n", $head);
		$sp2 = explode(' ', $sp[0]);
		$httpInfo['version'] = substr($sp2[0], 5);
		array_shift($sp2);
		$httpInfo['statusNum']  = $sp2[0];
		$httpInfo['statusNum1'] = substr($sp2[0],0,1);
		$httpInfo['status']     = $httpInfo['statusNum1'] == '2';
		array_shift($sp2);
		$httpInfo['info']   = implode('', $sp2);
		array_shift($sp);
		foreach($sp as $v){
			$f = strpos ( $v, ':' );
			if ($f> 0) {
				$key = trim(substr ($v, 0, $f));
				$val = trim(substr($v, $f + 1));
				$args[$key][] = $val;
			}
		}
		$rn['info'] = $httpInfo;
		$rn['args'] = $args;
		return $rn;
	}
	public static function getHead($url, $args = array()){
		$ln = chr(13).chr(10);
		$head = array();
		if($urlInfo = self::parseUrl($url)){
			if (!self::isIp($urlInfo['host'])) {
				$urlInfo['ip'] = gethostbyname($urlInfo['host']);
				$urlInfo['ip'] == $urlInfo['host'] && $urlInfo['ip'] = '';
			} else {
				$urlInfo['ip'] = $urlInfo['host'];
			}
			if ($urlInfo['ip']) {
				$chunked = $gzip = false;
				$rsize = 1024;
				$headStr = '';
				//Transfer-Encoding: chunked
				if (!$args['Accept-Encoding'] && ZLIB===true)$args['Accept-Encoding'] = 'gzip';
				$f = @fsockopen(($urlInfo['scheme'] == 'https'?'ssl://':'').$urlInfo['ip'], $urlInfo['port'], $errno, $errstr, 30);
				if($f){
					$out = 'HEAD '.$urlInfo['path'].' HTTP/1.1'.$ln;
					$out.= 'Host: '.$urlInfo['host'].$ln;
					$out.= self::args($args);
					$out.='Connection: Close'.$ln;
					$out.=$ln;
					fwrite($f, $out);
					while($r = fread($f, $rsize)){
						$headStr .= $r;
					}
					fclose($f);
					$head = self::parseHead($headStr);
				}
			}
		}
		return $head;
	}
	
	public static function open($url,$post_data='',$args=array(),$full=false,$head_append=true,$saveFile=''){
		$ln = chr(13).chr(10);
		if($urlInfo = self::parseUrl($url)){
			if (!self::isIp($urlInfo['host'])) {
				$urlInfo['ip'] = gethostbyname($urlInfo['host']);
				$urlInfo['ip'] == $urlInfo['host'] && $urlInfo['ip'] = '';
				$urlInfo['ip'] || $urlInfo['ip'] = $urlInfo['host'];
			} else {
				$urlInfo['ip'] = $urlInfo['host'];
			}
			if ($urlInfo['ip']) {
				$headStr = '';
				$head = array();
				$getHead=false;
				$chunked = $gzip = false;
				$chunksize=0;
				$readsize=0;
				$rsize=1024;
				$this_size=0;
				$html='';
				//Transfer-Encoding: chunked
				if (!$args['Accept-Encoding'] && ZLIB===true)$args['Accept-Encoding'] = 'gzip';
				if($saveFile && ($saveF = @fopen($saveFile,'wb')))$save=true;
				$f = @fsockopen(($urlInfo['scheme'] == 'https'?'ssl://':'').$urlInfo['ip'], $urlInfo['port'], $errno, $errstr, 30);
				if($f){
					$out = ($post_data?'POST':'GET').' '.$urlInfo['path'].' HTTP/1.1'.$ln;
					$out.= 'Host: '.$urlInfo['host'].$ln;
					$out.= self::args($args);
					if($post_data){
						$out.='Content-Type: application/x-www-form-urlencoded\r\n'.$ln;
						$out.='Content-Length: '.strlen($post_data).$ln;
					}
					$out.='Connection: Close'.$ln;
					$out.=$ln;
					$out.=$post_data;
					fwrite($f, $out);
					while($r = fread($f,$rsize)){
						if(!$getHead){
							if(($fa=strpos($r,$ln.$ln))===false)$headStr.=$r;
							else {
								$headStr.=substr($r,0,$fa);
								$head = self::parseHead($headStr);
								if($head['info']['status']){
									if($head['args']['Content-Encoding'] && $head['args']['Content-Encoding'][0] == 'gzip' && ZLIB === true)$gzip = true;
									if($head['args']['Transfer-Encoding'] && $head['args']['Transfer-Encoding'][0] == 'chunked'){
										$chunked = true;
										$html    = substr($r, $fa+4);
									} else {
										if($save)fwrite($saveF,substr($r, $fa+4));
										else $html=substr($r, $fa+4);
									}
									$getHead=true;
								} else {
									break;
								}
							}
						} else {
							if($save && !$chunked && !$gzip)fwrite($saveF, $r);
							else $html.=$r;
						}
					}
					fclose($f);
					if($chunked){
						$fa=strpos($html,"\r\n");
						$last_fa=0;
						$rn = '';
						while($fa!==false){
							$chunksize=hexdec(substr($html,$last_fa,$fa-$last_fa));
							if($chunksize==0)break;
							$fa+=2;
							$rn.=substr($html,$fa,$chunksize);
							
							$last_fa=$fa+2+$chunksize;
							$fa=strpos($html,"\r\n",$last_fa);
							
						}
						$html=$rn;
						unset($rn);
						if($save && !$gzip){
							fwrite($saveF, $html);
						}
					}
					if ($gzip) {
						$html = gzdecode($html);
						if($save)fwrite($saveF, $html);
					}
					if($save){
						fclose($saveF);
						return true;
					} else {
						if($full){
							if($head_append)return $headStr."\r\n\r\n".$html;
							else return array('head'=>$head,'data'=>$html);
						}
						return $html;
					}
				}
			}
		}
	}
	public static function get_html($url,$args=array(),$return_encoding=ENCODING){
		if($rs=self::open($url, '', $args, true, false)){
			$head = $rs['head'];
			$data = $rs['data'];
			unset($rs);
			switch($head['info']['statusNum1']){
				case '2':
					$encoding='';
					if($head['args']['Content-Type']){
						if(preg_match('/charset=(.+)/', $head['args']['Content-Type'][0], $matches)){
							$encoding = $matches[1];
						}
					}
					if(!$encoding){
						if(preg_match('/<meta.*?http-equiv="Content-Type".*content=.*?charset=(.+)>/i', $data, $matches)){
							$encoding = $matches[1];
							$sp = preg_split('/\'|"/', $encoding);
							$encoding = trim($sp[0]);
						}
					}
					$encoding || $encoding=$return_encoding;
					return iconv($encoding, $return_encoding."//IGNORE", $data);
				break;
				case '3':
					$goto_url = $head['args']['Location'][0];
					$info0 = parse_url($goto_url);
					if(!$info0['scheme']){
						$info1 = parse_url($url);
						if(substr($goto_url,0,1)=='/')$goto_url=$info1['scheme'].'://'.$info1['host'].$goto_url;
						else {
							!$info1['path'] && $info1['path']='/';
							$path=$info1['path'];
							if(substr($path,-1,1)=='/')$goto_url=$path.$goto_url;
							else $goto_url=substr($path,0,strrpos($path,'/')).'/'.$goto_url;
							$goto_url=$info1['scheme'].'://'.$info1['host'].$goto_url;
						}
					}
					if($goto_url){
						return self::get_html($goto_url);
					} else return '';
				break;
				case '4':
					return false;
				break;
			}
		}
	}
	public static function get($url,$args=array(),$full=false,$head_append=true){
		return self::open($url,'',$args,$full,$head_append);
	}
	public static function post($url,$data,$args=array(),$full=false,$head_append=true){
		return self::open($url,$data,$args,$full,$head_append);
	}
	public static function download($url,$save,$args=array()){
		return self::open($url,'',$args,false,true,$save);
	}
}
?>