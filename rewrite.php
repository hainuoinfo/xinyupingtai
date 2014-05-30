<?php
//include(dirname(__FILE__))
function __download($file){
	/*set_time_limit(0);
	if(file_exists($file)){
		$info=pathinfo($file);
		$size=filesize($file);
		header("Content-type: application/octet-stream");
		header("Accept-Ranges: bytes");
		header("Accept-Length: ".$size);
		header("Content-Length: ".$size);
		header("Content-Disposition:attachment;filename=".iconv(ENCODING,'gbk',$info['basename']));
		if($f=fopen($file,'rb')){
			while($r = fread($f, 1024)){
				echo $r;
			}
			fclose($f);
		} else echo 'error';
		return true;
	} else return false;*/
	set_time_limit(0);
	if(file_exists($file)){

		$info = pathinfo($file);
		$fsize = filesize($file);
		if (isset($_SERVER['HTTP_RANGE']) && ($_SERVER['HTTP_RANGE'] != "") && preg_match("/^bytes=([0-9]+)-$/i", $_SERVER['HTTP_RANGE'], $match) && ($match[1] < $fsize)) {
			$start = $match[1];
		} else {
			$start = 0;
		}
		header("Cache-control: public");
		header("Pragma: public");
		if ($start > 0) {
			header("HTTP/1.1 206 Partial Content");
			header("Accept-Ranges: bytes");
			header("Content-Ranges: bytes ".$start."-".($fsize - 1) . "/" . $fsize);
			header("Content-Length: ".($fsize - $start));
		} else {
			header("Accept-Ranges: bytes");
			header("Accept-Length: $fsize");
			header("Content-Length: $fsize");

		}
		header("Content-Type: application/octet-stream");
		header("Content-Disposition:attachment;filename=".$info['basename']);
		if($f=fopen($file,'rb')){fseek($f, $start);
			while($r = fread($f, 1024)){
				echo $r;
			}
			fclose($f);
		} else echo 'error';
		return true;
	} else return false;
}
function __outFile($file, $contentType){
	if ($contentType == 'application/octet-stream') {
		__download($file);
	} else {
		$gmt_mtime = gmdate('D, d M Y H:i:s', filemtime($file)).' GMT';
		if((isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && array_shift(explode(';', $_SERVER['HTTP_IF_MODIFIED_SINCE'])) ==  $gmt_mtime)){
			header("HTTP/1.1 304 Not Modified");
			header("Expires: ");
			header("Cache-Control: ");
			header("Pragma: ");
			header('Content-Type: '.$contentType);
			header("Tips: Cache Not Modified");
			header('Content-Length: 0');
			return true;
		}
		header("Last-Modified:" . $gmt_mtime);
		header("Expires: ");
		header("Cache-Control: ");
		header("Pragma: ");
		header('Content-Type: '.$contentType);
		header("Tips: Normal Respond");
		//header('Content-Type: '.$imgInfo['mime']);
		if ($f = fopen($file, 'rb')) {
			while ($r = fread($f, 1024)) {
				echo $r;
			}
			fclose($f);
		}
	}
	return true;
}
function __rewrite(){
	global $r_rewrite,$r_uri,$r_d,$r_dir,$r_content_type_list;
	$matching=false;
	foreach($r_rewrite as $v){
		if(preg_match($v[0],$r_uri,$matches)){
			$r_uri=$v[1];
			$r_uri=preg_replace('/\$(\d+)/e','$matches[$1]',$r_uri);
			$matching=true;
			break;
		}
	}
	if($matching){
		$url_info=parse_url($r_uri);
		$r_include=str_replace('/',$r_d,$r_dir.$url_info['path']);
		if(file_exists($r_include) && filetype($r_include)=='file'){
			if($query=$url_info['query']){
				$sp=explode('&',$query);
				foreach($sp as $v){
					$sp2=explode('=',$v);
					$_GET[$sp2[0]]=addslashes(urldecode($sp2[1]));//重要
				}
				$_SERVER['QUERY_STRING']=$query;
			}
			//if($url_info[''])
			return $r_include;
		} else return __rewrite();
	} else return false;
}
$r_marker='rewrite';
$r_marker_len=strlen($r_marker);
if($r_q=$_SERVER['QUERY_STRING']){
	if(substr($r_q,0,$r_marker_len)===$r_marker){

		if(($r_f1=strpos($r_q,'&'))!==false){
			$r_=substr($r_q,0,$r_f1);
			if(($r_f2=strpos($r_,'='))!==false){
				$r_=substr($r_,$r_f2+1);
				$_SERVER['QUERY_STRING']=substr($r_q,$r_f1+1);
				if(strpos($_SERVER['QUERY_STRING'],$r_marker.'=')===false)
                    unset($_GET[$r_marker]);
			} else header("HTTP/1.1 404 Not Found");
		} else {
			$r_=$_GET[$r_marker];
			$_SERVER['QUERY_STRING']='';
			$_GET=array();
		}
		/*rewrite start*/
		unset($r_marker,$r_marker_len,$r_f1,$r_f2,$r_q);//unset var
		$r_!='' && substr($r_,0,1)=='/' && $r_=substr($r_,1);
		if($r_){
			//if not null
			$r_='/'.$r_;
			$r_dir=dirname(__FILE__);
			$r_d=DIRECTORY_SEPARATOR;
			//if exists out
			$r_include=str_replace('/',$r_d,$r_dir.$r_);
			$r_content_type_list=array(
				'001'=>'application/x-001',
				'301'=>'application/x-301',
				'323'=>'text/h323',
				'906'=>'application/x-906',
				'907'=>'drawing/907',
				'a11'=>'application/x-a11',
				'acp'=>'audio/x-mei-aac',
				'ai'=>'application/postscript',
				'aif'=>'audio/aiff',
				'aifc'=>'audio/aiff',
				'aiff'=>'audio/aiff',
				'anv'=>'application/x-anv',
				'asa'=>'text/asa',
				'asf'=>'video/x-ms-asf',
				'asp'=>'text/asp',
				'asx'=>'video/x-ms-asf',
				'au'=>'audio/basic',
				'avi'=>'video/avi',
				'awf'=>'application/vnd.adobe.workflow',
				'biz'=>'text/xml',
				'bmp'=>'application/x-bmp',
				'bot'=>'application/x-bot',
				'c4t'=>'application/x-c4t',
				'c90'=>'application/x-c90',
				'cal'=>'application/x-cals',
				'cat'=>'application/vnd.ms-pki.seccat',
				'cdf'=>'application/x-netcdf',
				'cdr'=>'application/x-cdr',
				'cel'=>'application/x-cel',
				'cer'=>'application/x-x509-ca-cert',
				'cg4'=>'application/x-g4',
				'cgm'=>'application/x-cgm',
				'cit'=>'application/x-cit',
				'class'=>'java/*',
				'cml'=>'text/xml',
				'cmp'=>'application/x-cmp',
				'cmx'=>'application/x-cmx',
				'cot'=>'application/x-cot',
				'crl'=>'application/pkix-crl',
				'crt'=>'application/x-x509-ca-cert',
				'csi'=>'application/x-csi',
				'css'=>'text/css',
				'cut'=>'application/x-cut',
				'dbf'=>'application/x-dbf',
				'dbm'=>'application/x-dbm',
				'dbx'=>'application/x-dbx',
				'dcd'=>'text/xml',
				'dcx'=>'application/x-dcx',
				'der'=>'application/x-x509-ca-cert',
				'dgn'=>'application/x-dgn',
				'dib'=>'application/x-dib',
				'dll'=>'application/x-msdownload',
				'doc'=>'application/msword',
				'dot'=>'application/msword',
				'drw'=>'application/x-drw',
				'dtd'=>'text/xml',
				'dwf'=>'Model/vnd.dwf',
				'dwf'=>'application/x-dwf',
				'dwg'=>'application/x-dwg',
				'dxb'=>'application/x-dxb',
				'dxf'=>'application/x-dxf',
				'edn'=>'application/vnd.adobe.edn',
				'emf'=>'application/x-emf',
				'eml'=>'message/rfc822',
				'ent'=>'text/xml',
				'epi'=>'application/x-epi',
				'eps'=>'application/x-ps',
				'eps'=>'application/postscript',
				'etd'=>'application/x-ebx',
				'exe'=>'application/x-msdownload',
				'fax'=>'image/fax',
				'fdf'=>'application/vnd.fdf',
				'fif'=>'application/fractals',
				'fo'=>'text/xml',
				'frm'=>'application/x-frm',
				'g4'=>'application/x-g4',
				'gbr'=>'application/x-gbr',
				'gif'=>'image/gif',
				'gl2'=>'application/x-gl2',
				'gp4'=>'application/x-gp4',
				'hgl'=>'application/x-hgl',
				'hmr'=>'application/x-hmr',
				'hpg'=>'application/x-hpgl',
				'hpl'=>'application/x-hpl',
				'hqx'=>'application/mac-binhex40',
				'hrf'=>'application/x-hrf',
				'hta'=>'application/hta',
				'htc'=>'text/x-component',
				'htm'=>'text/html',
				'html'=>'text/html',
				'htt'=>'text/webviewhtml',
				'htx'=>'text/html',
				'icb'=>'application/x-icb',
				'ico'=>'image/x-icon',
				'ico'=>'application/x-ico',
				'iff'=>'application/x-iff',
				'ig4'=>'application/x-g4',
				'igs'=>'application/x-igs',
				'iii'=>'application/x-iphone',
				'img'=>'application/x-img',
				'ins'=>'application/x-internet-signup',
				'isp'=>'application/x-internet-signup',
				'IVF'=>'video/x-ivf',
				'java'=>'java/*',
				'jfif'=>'image/jpeg',
				'jpe'=>'image/jpeg',
				'jpe'=>'application/x-jpe',
				'jpeg'=>'image/jpeg',
				'jpg'=>'image/jpeg',
				'jpg'=>'application/x-jpg',
				'js'=>'application/x-javascript',
				'jsp'=>'text/html',
				'la1'=>'audio/x-liquid-file',
				'lar'=>'application/x-laplayer-reg',
				'latex'=>'application/x-latex',
				'lavs'=>'audio/x-liquid-secure',
				'lbm'=>'application/x-lbm',
				'lmsff'=>'audio/x-la-lms',
				'ls'=>'application/x-javascript',
				'ltr'=>'application/x-ltr',
				'm1v'=>'video/x-mpeg',
				'm2v'=>'video/x-mpeg',
				'm3u'=>'audio/mpegurl',
				'm4e'=>'video/mpeg4',
				'mac'=>'application/x-mac',
				'man'=>'application/x-troff-man',
				'math'=>'text/xml',
				'mdb'=>'application/msaccess',
				'mdb'=>'application/x-mdb',
				'mfp'=>'application/x-shockwave-flash',
				'mht'=>'message/rfc822',
				'mhtml'=>'message/rfc822',
				'mi'=>'application/x-mi',
				'mid'=>'audio/mid',
				'midi'=>'audio/mid',
				'mil'=>'application/x-mil',
				'mml'=>'text/xml',
				'mnd'=>'audio/x-musicnet-download',
				'mns'=>'audio/x-musicnet-stream',
				'mocha'=>'application/x-javascript',
				'movie'=>'video/x-sgi-movie',
				'mp1'=>'audio/mp1',
				'mp2'=>'audio/mp2',
				'mp2v'=>'video/mpeg',
				'mp3'=>'audio/mp3',
				'mp4'=>'video/mpeg4',
				'mpa'=>'video/x-mpg',
				'mpd'=>'application/vnd.ms-project',
				'mpe'=>'video/x-mpeg',
				'mpeg'=>'video/mpg',
				'mpg'=>'video/mpg',
				'mpga'=>'audio/rn-mpeg',
				'mpp'=>'application/vnd.ms-project',
				'mps'=>'video/x-mpeg',
				'mpt'=>'application/vnd.ms-project',
				'mpv'=>'video/mpg',
				'mpv2'=>'video/mpeg',
				'mpw'=>'application/vnd.ms-project',
				'mpx'=>'application/vnd.ms-project',
				'mtx'=>'text/xml',
				'mxp'=>'application/x-mmxp',
				'net'=>'image/pnetvue',
				'nrf'=>'application/x-nrf',
				'nws'=>'message/rfc822',
				'odc'=>'text/x-ms-odc',
				'out'=>'application/x-out',
				'p10'=>'application/pkcs10',
				'p12'=>'application/x-pkcs12',
				'p7b'=>'application/x-pkcs7-certificates',
				'p7c'=>'application/pkcs7-mime',
				'p7m'=>'application/pkcs7-mime',
				'p7r'=>'application/x-pkcs7-certreqresp',
				'p7s'=>'application/pkcs7-signature',
				'pc5'=>'application/x-pc5',
				'pci'=>'application/x-pci',
				'pcl'=>'application/x-pcl',
				'pcx'=>'application/x-pcx',
				'pdf'=>'application/pdf',
				'pdf'=>'application/pdf',
				'pdx'=>'application/vnd.adobe.pdx',
				'pfx'=>'application/x-pkcs12',
				'pgl'=>'application/x-pgl',
				'pic'=>'application/x-pic',
				'pko'=>'application/vnd.ms-pki.pko',
				'pl'=>'application/x-perl',
				'plg'=>'text/html',
				'pls'=>'audio/scpls',
				'plt'=>'application/x-plt',
				'png'=>'image/png',
				'pot'=>'application/vnd.ms-powerpoint',
				'ppa'=>'application/vnd.ms-powerpoint',
				'ppm'=>'application/x-ppm',
				'pps'=>'application/vnd.ms-powerpoint',
				'ppt'=>'application/vnd.ms-powerpoint',
				'ppt'=>'application/x-ppt',
				'pr'=>'application/x-pr',
				'prf'=>'application/pics-rules',
				'prn'=>'application/x-prn',
				'prt'=>'application/x-prt',
				'ps'=>'application/x-ps',
				'ps'=>'application/postscript',
				'ptn'=>'application/x-ptn',
				'pwz'=>'application/vnd.ms-powerpoint',
				'r3t'=>'text/vnd.rn-realtext3d',
				'ra'=>'audio/vnd.rn-realaudio',
				'ram'=>'audio/x-pn-realaudio',
				'ras'=>'application/x-ras',
				'rat'=>'application/rat-file',
				'rdf'=>'text/xml',
				'rec'=>'application/vnd.rn-recording',
				'red'=>'application/x-red',
				'rgb'=>'application/x-rgb',
				'rjs'=>'application/vnd.rn-realsystem-rjs',
				'rjt'=>'application/vnd.rn-realsystem-rjt',
				'rlc'=>'application/x-rlc',
				'rle'=>'application/x-rle',
				'rm'=>'application/vnd.rn-realmedia',
				'rmf'=>'application/vnd.adobe.rmf',
				'rmi'=>'audio/mid',
				'rmj'=>'application/vnd.rn-realsystem-rmj',
				'rmm'=>'audio/x-pn-realaudio',
				'rmp'=>'application/vnd.rn-rn_music_package',
				'rms'=>'application/vnd.rn-realmedia-secure',
				'rmvb'=>'application/vnd.rn-realmedia-vbr',
				'rmx'=>'application/vnd.rn-realsystem-rmx',
				'rnx'=>'application/vnd.rn-realplayer',
				'rp'=>'image/vnd.rn-realpix',
				'rpm'=>'audio/x-pn-realaudio-plugin',
				'rsml'=>'application/vnd.rn-rsml',
				'rt'=>'text/vnd.rn-realtext',
				'rtf'=>'application/msword',
				'rtf'=>'application/x-rtf',
				'rv'=>'video/vnd.rn-realvideo',
				'sam'=>'application/x-sam',
				'sat'=>'application/x-sat',
				'sdp'=>'application/sdp',
				'sdw'=>'application/x-sdw',
				'sit'=>'application/x-stuffit',
				'slb'=>'application/x-slb',
				'sld'=>'application/x-sld',
				'slk'=>'drawing/x-slk',
				'smi'=>'application/smil',
				'smil'=>'application/smil',
				'smk'=>'application/x-smk',
				'snd'=>'audio/basic',
				'sol'=>'text/plain',
				'sor'=>'text/plain',
				'spc'=>'application/x-pkcs7-certificates',
				'spl'=>'application/futuresplash',
				'spp'=>'text/xml',
				'ssm'=>'application/streamingmedia',
				'sst'=>'application/vnd.ms-pki.certstore',
				'stl'=>'application/vnd.ms-pki.stl',
				'stm'=>'text/html',
				'sty'=>'application/x-sty',
				'svg'=>'text/xml',
				'swf'=>'application/x-shockwave-flash',
				'tdf'=>'application/x-tdf',
				'tg4'=>'application/x-tg4',
				'tga'=>'application/x-tga',
				'tif'=>'image/tiff',
				'tif'=>'application/x-tif',
				'tiff'=>'image/tiff',
				'tld'=>'text/xml',
				'top'=>'drawing/x-top',
				'torrent'=>'application/x-bittorrent',
				'tsd'=>'text/xml',
				'txt'=>'text/plain',
				'uin'=>'application/x-icq',
				'uls'=>'text/iuls',
				'vcf'=>'text/x-vcard',
				'vda'=>'application/x-vda',
				'vdx'=>'application/vnd.visio',
				'vml'=>'text/xml',
				'vpg'=>'application/x-vpeg005',
				'vsd'=>'application/vnd.visio',
				'vsd'=>'application/x-vsd',
				'vss'=>'application/vnd.visio',
				'vst'=>'application/vnd.visio',
				'vst'=>'application/x-vst',
				'vsw'=>'application/vnd.visio',
				'vsx'=>'application/vnd.visio',
				'vtx'=>'application/vnd.visio',
				'vxml'=>'text/xml',
				'wav'=>'audio/wav',
				'wax'=>'audio/x-ms-wax',
				'wb1'=>'application/x-wb1',
				'wb2'=>'application/x-wb2',
				'wb3'=>'application/x-wb3',
				'wbmp'=>'image/vnd.wap.wbmp',
				'wiz'=>'application/msword',
				'wk3'=>'application/x-wk3',
				'wk4'=>'application/x-wk4',
				'wkq'=>'application/x-wkq',
				'wks'=>'application/x-wks',
				'wm'=>'video/x-ms-wm',
				'wma'=>'audio/x-ms-wma',
				'wmd'=>'application/x-ms-wmd',
				'wmf'=>'application/x-wmf',
				'wml'=>'text/vnd.wap.wml',
				'wmv'=>'video/x-ms-wmv',
				'wmx'=>'video/x-ms-wmx',
				'wmz'=>'application/x-ms-wmz',
				'wp6'=>'application/x-wp6',
				'wpd'=>'application/x-wpd',
				'wpg'=>'application/x-wpg',
				'wpl'=>'application/vnd.ms-wpl',
				'wq1'=>'application/x-wq1',
				'wr1'=>'application/x-wr1',
				'wri'=>'application/x-wri',
				'wrk'=>'application/x-wrk',
				'ws'=>'application/x-ws',
				'ws2'=>'application/x-ws',
				'wsc'=>'text/scriptlet',
				'wsdl'=>'text/xml',
				'wvx'=>'video/x-ms-wvx',
				'xdp'=>'application/vnd.adobe.xdp',
				'xdr'=>'text/xml',
				'xfd'=>'application/vnd.adobe.xfd',
				'xfdf'=>'application/vnd.adobe.xfdf',
				'xhtml'=>'text/html',
				'xls'=>'application/vnd.ms-excel',
				'xls'=>'application/x-xls',
				'xlw'=>'application/x-xlw',
				'xml'=>'text/xml',
				'xpl'=>'audio/scpls',
				'xq'=>'text/xml',
				'xql'=>'text/xml',
				'xquery'=>'text/xml',
				'xsd'=>'text/xml',
				'xsl'=>'text/xml',
				'xslt'=>'text/xml',
				'xwd'=>'application/x-xwd',
				'x_b'=>'application/x-x_b',
				'x_t'=>'application/x-x_t',
				'*'=>'application/octet-stream'
			);
			if(file_exists($r_include)){
				if(filetype($r_include)=='file'){
					$r_pathinfo=pathinfo($r_include);
					$r_extension=$r_pathinfo['extension'];
					$r_content_type='';
					if($r_extension){
						$r_extension=strtolower($r_extension);
						if($r_extension=='php'){
							$_SERVER['SCRIPT_FILENAME']=$r_include;
							$_SERVER['PHP_SELF']=$r_;
							chdir($r_pathinfo['dirname']);
							unset($r_,$r_dir,$r_d,$r_extension,$r_pathinfo,$r_content_type_list);
							include($r_include);
							exit;
						}
						if(!($r_content_type=$r_content_type_list[$r_extension]))$r_content_type=$r_content_type_list['*'];
					} else $r_content_type=$r_content_type_list['*'];
					/*header('Content-Type:'.$r_content_type);
					if($f=fopen($r_include,'rb')){
						while($r=fread($f,1024))echo $r;
						fclose($f);
					}*/
					__outFile($r_include, $r_content_type);
					unset($r_,$r_dir,$r_d,$r_extension,$r_pathinfo,$r_content_type_list,$r_content_type,$r_include,$f,$r);
				} else {
					//folder
					substr($r_include,-1) != DIRECTORY_SEPARATOR && $r_include.= DIRECTORY_SEPARATOR;
					$r_include.='index.php';
					if(file_exists($r_include)){
						$_SERVER['SCRIPT_FILENAME'] = $r_include;
						unset($r_,$r_dir,$r_d,$r_content_type_list);
						include($r_include);
					} else header("HTTP/1.1 404 Not Found");
				}
			} else {
				//exe rewrite
				$r_rewrite_file='./cache/array/rewrite.php';
				if(file_exists($r_rewrite_file)){
					$fp = fopen($r_rewrite_file,"rb");
					flock($fp, LOCK_SH) ;
					$r_rewrite=@fread($fp,filesize($r_rewrite_file));
					flock($fp, LOCK_UN);
					fclose($fp);
					unset($fp);
					$r_rewrite=unserialize(substr($r_rewrite,13));//rewrite_rule
					//if($_SERVER['HTTP_X_REWRITE_URL'])$r_uri=$_SERVER['HTTP_X_REWRITE_URL'];
					//else $r_uri=$r_uri.$_SERVER['REQUEST_URI'];
					$_GET=array();
					$r_uri=$r_.($_SERVER['QUERY_STRING']?'?'.$_SERVER['QUERY_STRING']:'');
					if(($r_include=__rewrite())!==false){
						$r_pathinfo=pathinfo($r_include);
						$r_extension=$r_pathinfo['extension'];
						$r_content_type='';
						if($r_extension){
							$r_extension=strtolower($r_extension);
							if($r_extension=='php'){
								$_SERVER['PHP_SELF']=$r_;
								$_SERVER['SCRIPT_FILENAME']=$r_include;
								chdir($r_pathinfo['dirname']);
								unset($r_,$r_dir,$r_d,$r_extension,$r_pathinfo,$r_content_type_list);
								include($r_include);
								exit;
							}
							if(!($r_content_type=$r_content_type_list[$r_extension]))$r_content_type=$r_content_type_list['*'];
						} else $r_content_type=$r_content_type_list['*'];
						/*header('Content-Type:'.$r_content_type);
						if($f=fopen($r_include,'rb')){
							while($r=fread($f,1024))echo $r;
							fclose($f);
						}*/
						__outFile($r_include, $r_content_type);
					} else header("HTTP/1.1 404 Not Found");
					unset($r_,$r_dir,$r_d,$r_content_type_list,$r_rewrite_file);
				} else header("HTTP/1.1 404 Not Found");
				//
			}
		} else {
			unset($r_);
			include('./index.php');//index
		}
		/*rewrite end*/
	} else header("HTTP/1.1 404 Not Found");
}
else
	include('./index.php');
?>