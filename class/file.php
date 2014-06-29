<?php
class file{
	public static function write($file,$data){
		$fp = fopen($file,"w");
		flock($fp, LOCK_EX) ;
		fwrite($fp,$data);
		flock($fp, LOCK_UN); 
		fclose($fp);
		return true;
	}
	public static function read($file){
		$fp = fopen($file,"rb");	
		flock($fp, LOCK_SH) ;
		$data=@fread($fp,filesize($file));
		flock($fp, LOCK_UN); 
		fclose($fp);
		return $data;
	}
	public static function back(){
		if(func_num_args()>0){
			foreach(func_get_args() as $v){
				if(file_exists($v)){
					@rename($v,$v.'.bak');
				}
			}
		}
	}
	public static function unback(){
		if(func_num_args()>0){
			foreach(func_get_args() as $v){
				if(file_exists($v.'.bak')){
					@rename($v.'.bak',$v);
				}
			}
		}
	}
	public static function download($file, $del = true){
		set_time_limit(0);
		if(file_exists($file)){
			common::ob_end_clean();
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
			$del && @unlink($file);
			return true;
		} else return false;
	}
	public static function class_include_js($class_name,$include_name){
		$file=WEB_ROOT.'./class_include/'.$class_name.'/'.$include_name.'.js';
		if(file_exists($file)){
			return self::read($file);
		}
	}
	public static function class_include_html($class_name,$include_name){
		$file=WEB_ROOT.'./class_include/'.$class_name.'/'.$include_name.'.htm';
		if(file_exists($file)){
			return self::read($file);
		}
	}
	public static function copy_file($source,$dest){
		return @copy(WEB_ROOT.$source,WEB_ROOT.$dest);
	}
	public static function mkdir($d){
		if(!file_exists(WEB_ROOT.$d)){
			return @mkdir(WEB_ROOT.$d);
		}
		return false;
	}
	public static function createfile($d){
		if(!file_exists(WROOT.$d)){
			//return @mkdir(WEB_ROOT.$d);
			touch(WROOT.$d);
		}
		//return false;
	}
	public static function move_file($source,$dest){
		if(@copy(WEB_ROOT.$source,WEB_ROOT.$dest)){
			return @unlink(WEB_ROOT.$source);
		} else {
			return false;
		}
	}
	public static function del_folder($s,$fullpath=1,$del_folder=true){
		if($fullpath)$folder.=WROOT.$s;
		else $folder=$s;
		$folder .= D;
		$files=scandir($folder);
		foreach($files as $v){
			if($v!='.'&&$v!='..'){
				$this_file=$folder.$v;
				$type=filetype($this_file);
				if($type=='dir'){
					self::del_folder($this_file,0,$del_folder);
					$del_folder&&@rmdir($this_file);
				} elseif($type=='file') {
					@unlink($this_file);
				}
			}
		}
		return $del_folder&&@rmdir($folder);
	}
	public static function rmDir($dir){
		if (in_array(substr($dir, -1), array('/', '\\'))) $dir = substr($dir, 0, -1);
		if ($o = opendir($dir)) {
			while ($filename = readdir($o)) {
				if (!in_array($filename, array('.', '..'))) {
					$file = $dir.D.$filename;
					if (filetype($file) == 'dir') self::rmDir($file);
					else @unlink($file);
				}
			}
			closedir($o);
		}
		return @rmdir($dir);
	}
	public static function copy_folder($s,$d,$move=0,$fullpath=1){
		if($fullpath){
			$s=WEB_ROOT.$s;
			$d=WEB_ROOT.$d;
			if(!file_exists($d)){
				if(!mkdir($d))return false;
			}
		}
		$s.='/';
		$files=scandir($s);
		foreach($files as $v){
			if($v!='.'&&$v!='..'){
				$this_file=$s.$v;
				$d_file=$d.$v;
				$type=filetype($this_file);
				if($type=='dir'){
					if(!file_exists($d_file)){
						if(!mkdir($d_file))return false;
					}
					self::copy_folder($this_file,$d_file.'/',$move,0);
					if($move)@rmdir($this_file);
				} elseif($type=='file'){
					@copy($this_file,$d_file);
					if($move)@unlink($this_file);
				}
			}
		}
		if($fullpath){
			if($move)return @rmdir($s);
			else
			return true;
		}
	}
	public static function move_folder($s,$d){
		return self::copy_folder($s,$d,1);
	}
	public static function list_folders($s){
		$s=WROOT.$s;
		if (is_dir($s)) {
			if ($dh = opendir($s)) {
				while (($file = readdir($dh)) !== false) {
					filetype($s.$file)=='dir'&&!in_array($file,array('.','..'))&&($rn[]=$file);
				}
				closedir($dh);
			}
		}
		return $rn;
	}
	public static function list_file_all($dir){
		$dir0=WEB_ROOT.$dir;
		$rn=array();
		if(is_dir($dir0)){
			if($dh=opendir($dir0)){
				while(($file=readdir($dh))!==false){
					if(filetype($dir0.$file)=='dir'){
						if(!in_array($file,array('.','..')))if($list=self::list_file_all($dir.$file.'/'))$rn=array_merge($rn,$list);
					} else $rn[]=$dir.$file;
				}
			}
		}
		return $rn;
	}
	public static function getFiles($dir, $ignore = ''){
		$rn = array();
		strpos('/\\', substr($dir, -1)) === false && $dir.=D;
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
					if(filetype($dir.$file)=='file'){
						if($ignore){
							if(preg_match($ignore, $file))
							$rn[] = $file;
						} else {
							$rn[] = $file;
						}
					}
				}
				closedir($dh);
			}
		}
		return $rn;
	}
	public static function list_files($s,$gl=''){
		$s=WROOT.$s;
		if (is_dir($s)) {
			if ($dh = opendir($s)) {
				while (($file = readdir($dh)) !== false) {
					if(filetype($s.$file)=='file'){
						if($gl){
							if(preg_match($gl,$file))
							$rn[]=$file;
						} else {
							$rn[]=$file;
						}
					}
				}
				closedir($dh);
			}
		}
		return $rn;
	}
	function list_folder_file($s=''){
		$s=WROOT.$s;
		$rs=scandir($s);
		foreach($rs as $k=>$v){
			if($v!='.'&&$v!='..'){
				//if(($type=filetype($s.$v))=='file'){
				//	$files[]=array('name'=>$v,'filectime'=>filectime($s.$v),'filemtime'=>filemtime($s.$v));
				//} elseif($type=='dir') {
				//	$folders[]=$v;
				//}
				$this_file=$s.'/'.$v;
				unset($file_info);
				$file_info['filectime']=filectime($this_file);
				$file_info['filemtime']=filemtime($this_file);
				$file_info['is_write']=is_writable($this_file);
				$file_info['is_read']=is_readable($this_file);
				$file_info['size']=filesize($this_file);
				$files[]=array('name'=>$v,'is_dir'=>is_dir($this_file),'info'=>$file_info);
			}
		}
		if($files){
			$is_dir=common::arrid($files,'is_dir');
			$name=common::arrid($files,'name');
			array_multisort($is_dir,SORT_DESC,SORT_NUMERIC,$name,SORT_ASC,SORT_STRING,$files);
		}
		return $files;
		//return array('folder'=>$folders,'files'=>$files);
	}
}
?>