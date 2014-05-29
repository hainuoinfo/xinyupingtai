<?php
class upload{
	public $suffix;
	public $insertDB = true;
	function __construct(){
		$this->clear_cache();
	}
	function __destruct(){}
	function toupload($obj_name='',$ftype='',$file_size=-1){
		$rs=array('count'=>0,'error'=>0,'info'=>array());
		if($obj_name){
			if($ftype=='image')$this->suffix="jpg|jpeg|png|gif|";
			if($files=$_FILES[$obj_name]){
				if($files['name']){
					if(is_array($files['name'])){
						//数组
						foreach($files['name'] as $k=>$v){
							$next=true;
							if($ftype){
								if(!preg_match("/^$ftype/",$files['type'][$k]))$next=false;
							}
							if($next){
								$info['name']=$files['name'][$k];
								$info['type']=$files['type'][$k];
								$info['tmp_name']=$files['tmp_name'][$k];
								$info['error']=$files['error'][$k];
								$info['size']=$files['size'][$k];
								$msg=$this->upload($info,$k,$file_size);
								if($msg['status']===true){
									$rs['count']++;
									$rs['info'][$obj_name][]=$msg;
								} else {
									$rs['error']++;
									$rs['errors'][$obj_name][$k]=$msg['error'];
								}
							}
						}
						if($rs['count']>0)if(count($rs['info'][$obj_name])==1)$rs['info'][$obj_name]=$rs['info'][$obj_name][0];
					} else {
						$msg=$this->upload($files,0,$file_size);
						if($msg['status']===true){
							$rs['count']++;
							$rs['info'][$obj_name]=$msg;
						} else {
							$rs['error']++;
							$rs['errors'][$obj_name]=$msg['error'];
						}
					}
				}
			}
		} else {
			if($_FILES){
				foreach($_FILES as $obj_name=>$files){
					if($files['name']){
						if(is_array($files['name'])){
							//数组
							foreach($files['name'] as $k=>$v){
								$info['name']=$files['name'][$k];
								$info['type']=$files['type'][$k];
								$info['tmp_name']=$files['tmp_name'][$k];
								$info['error']=$files['error'][$k];
								$info['size']=$files['size'][$k];
								$msg=$this->upload($info,$k,$file_size);
								if($msg['status']===true){
									$rs['count']++;
								}
								$rs['info'][$obj_name][]=$msg;
							}
						} else {
							$msg=$this->upload($files,0,$file_size);
							if($msg['status']===true){
								$rs['count']++;
							}
							$rs['info'][$obj_name]=$msg;
						}
					}
				}
			}
		}
		return $rs;
	}
	function upload($info,$k=0,$file_size=-1){
		global $db,$pre,$timestamp;
		if($info['name']){
			$msg['errno']=$info['error'];
			switch($info['error']){
				case UPLOAD_ERR_OK:
					$save=tempnam(d('./cache/upload/'),'');
					//list($msec,$sec)=explode(" ",microtime());
					//$tmp_name=date("YmdHis",$sec)."_{$msec}_$k";
					$save_info=pathinfo($save);
					$tmp_name=$save_info['basename'];
					if(preg_match("/(?>)(.*)\.(.+)/",$info['name'],$matches)){
						$name=$matches[1];
						$suffix=$matches[2];
					} else {
						$name=$files['name'];
						$suffix='';
					}
					if($this->suffix){
						if(!$suffix){
							$msg['status']=false;
							$msg['error'] = lg('suffixEmpty');
							break;
						} else {
							if(strpos(strtolower($this->suffix),strtolower($suffix)."|")===false){
								$msg['status']=false;
								$msg['error'] = lg('ffSuffix');
								break;
							}
						}
					}
					$type=$info['type'];
					$size=$info['size'];
					if($file_size==-1 || $size<=$file_size){
						if(@move_uploaded_file($info['tmp_name'],$save)||@copy($info['tmp_name'],$save)){
							if ($this->insertDB) {
								$db->query("insert into {$pre}cache_upload set tmp_name='$tmp_name',name='$name',suffix='$suffix',type='$type',size=$size,dateline='$timestamp'");
								if($db->affected_rows()==1){
									$msg['status']=true;
									$msg['db_id']=$db->insert_id();
								} else {
									$msg['status']=false;
									$msg['error'] = lg('inDbErr');
									@unlink($save);
								}
							} else {
								$msg['status']   = true;
								$msg['tmp_name'] = $tmp_name;
								$msg['name']     = $name;
								$msg['suffix']   = $suffix;
								$msg['type']     = $type;
								$msg['size']     = $size;
								$msg['file']     = $save;
							}
							@unlink($info['tmp_name']);
						} else {
							$msg['status']=false;
							$msg['error'] = lg('moveFileErr');
						}
					} else {
						$msg['status']=false;
						$msg['error'] = lgArg('filesizeMTx', array('x' => $file_size));
					}
				break;
				case UPLOAD_ERR_INI_SIZE:
					$msg['status'] = false;
					$msg['error']  = lg('upErrIniSize');
				break;
				case UPLOAD_ERR_FORM_SIZE:
					$msg['status'] = false;
					$msg['error']  = lg('upErrFormSize');
				break;
				case UPLOAD_ERR_PARTIAL:
					$msg['status'] = false;
					$msg['error']  = lg('upErrPartial');
				break;
				case UPLOAD_ERR_NO_FILE:
					$msg['status'] = false;
					$msg['error'] = lg('upErrNotFile');
				break;
				case UPLOAD_ERR_NO_TMP_DIR:
					$msg['status'] = false;
					$msg['error'] = lg('upErrNoTmpDir');
				break;
				case UPLOAD_ERR_CANT_WRITE:
					$msg['status'] = false;
					$msg['error'] = lg('upErrCantWrite');
				break;
			}
		}
		return $msg;
	}
	function clear($id=false){
		global $db,$pre;
		if($id)$where=" where id=$id";
		$query=$db->query("select * from {$pre}cache_upload$where");
		while($line=$db->fetch_array($query)){
			@unlink(WROOT."./cache/upload/$line[tmp_name]");
			$db->query("delete from {$pre}cache_upload where id=$line[id]",'UNBUFFERED');
			$rs[]=$line;
		}
		return $rs;
	}
	function get($id){
		if ($item = db::one('cache_upload', '*', "id='$id'")) {
			$item['file'] = d('./cache/upload/'.$item['tmp_name']);
			return $item;
		}
		return false;
	}
	function move($id,$folder,$tmpname=false){
		global $db,$weburl,$pre;
		if($line=$db->fetch_first("select * from {$pre}cache_upload where id=$id")){
			$file=d('./cache/upload/'.$line['tmp_name']);
			//!file_exists(WEB_ROOT.$folder)&&mkdirs($folder);
			if(!preg_match("/^(?>).*\\/([^\\/]+)$/",$folder)){
				if($tmpname){
					list($msec,$sec)=explode(' ',microtime());
					$fname=$sec.sprintf('%03d',floor($msec*1000+0.5)).'.'.$line['suffix'];
					while(file_exists(WEB_ROOT.$folder.$fname)){
						list($msec,$sec)=explode(' ',microtime());
						$fname=$sec.sprintf('%03d',floor($msec*1000+0.5)).'.'.$line['suffix'];
					}
					@touch(WROOT.$folder.$fname);
					//$fname=$line['tmp_name'].'.'.$line['suffix'];
				} else $fname=$line['name'].'.'.$line['suffix'];
				$folder.=$fname;
			}
			file_exists($file)&&@copy($file,WEB_ROOT.$folder);
			@unlink($file);
			$db->query("delete from {$pre}cache_upload where id=$line[id]",'UNBUFFERED');
			$url=preg_replace("/^\.\\//","/",$folder);
			return array('source'=>$file,'des'=>$folder,'url'=>$url,'fullurl'=>$weburl.$url,'name'=>$fname);
		}
	}
	function move2($id, $folder){
		global $db, $weburl, $pre;
		if($line = $db->fetch_first("select * from {$pre}cache_upload where id=$id")){
			$file = d('./cache/upload/'.$line['tmp_name']);
			$tmpFile = tempnam($folder, '');
			$pathInfo = pathinfo($tmpFile);
			$filename = $pathInfo['filename'];
			$basename = $filename.'.'.$line['suffix'];
			$saveFile = $pathInfo['dirname'].D.$basename;
			file_exists($file) && @copy($file, $saveFile);
			@unlink($file);
			@unlink($tmpFile);
			$db->query("delete from {$pre}cache_upload where id=$line[id]",'UNBUFFERED');
			return array('source' => $saveFile, 'basename' => $basename, 'filename' =>$filename, 'suffix' => $line['suffix']);
		}
	}
	public static function tempname($dir, $suffix = 'tmp'){
		if ($suffix == 'tmp') return tempnam($dir, '');
		!in_array(substr($dir, -1), array('/', '\\')) && $dir .= D;
		list($msec, $sec) = explode(' ', microtime());
		$fname = $sec . sprintf('%03d', floor($msec * 1000 + 0.5)) . '.' . $suffix;
		while(file_exists($dir . $fname)){
			list($msec, $sec) = explode(' ', microtime());
			$fname = $sec . sprintf('%03d', floor($msec * 1000 + 0.5)) . '.' . $suffix;
		}
		return $dir . $fname;
	}
	public static function getSoft($name, $dir){
		$upload = new self();
		$upload->suffix='exe|rar|zip|msi|7z|';
		$rs = $upload->toupload($name);
		if ($rs['count'] == 1) {
			!file_exists($dir) && common::create_folder($dir);
			if ($rs = $upload->move2($rs['info'][$name]['db_id'], $dir)) {
				return $rs['basename'];
			}
		}
		return false;
	}
	public static function getFile($name, $suffix = '') {
		$upload = new self();
		$upload->suffix   = $suffix;
		$upload->insertDB = false;
		$rs = $upload->toupload($name);
		if ($rs['count'] == 1) {
			return $rs['info'][$name]['file'];
		}
		return false;
	}
	public static function uploadFile($name, $dir, $suffix = ''){
		!file_exists($dir) && common::create_folder($dir);
		if (file_exists($dir)) {
			$upload = new self();
			$upload->suffix   = $suffix;
			$upload->insertDB = false;
			$rs = $upload->toupload($name);
			if ($rs['count'] == 1) {
				$file = self::tempname($dir, $rs['info'][$name]['suffix']);
				if (@copy($rs['info'][$name]['file'], $file)) {
					$pathinfo = pathinfo($file);
					@unlink($rs['info'][$name]['file']);
					return $pathinfo['basename'];
				}
				@unlink($rs['info'][$name]['file']);
			}
		}
		return false;
	}
	public static function uploadImage($name, $dir, $returnArr = false){
		!file_exists($dir) && common::create_folder($dir);
		if (file_exists($dir)) {
			$upload = new self();
			$upload->suffix   = 'jpg|jpeg|png|gif|';
			$upload->insertDB = false;
			$rs = $upload->toupload($name);
			if ($rs['count'] == 1) {
				$sourceFile = $rs['info'][$name]['file'];
				$checkInfo = getimagesize($sourceFile);
				if ($checkInfo !== false) {
					if (in_array($checkInfo['mime'], array('image/jpeg', 'image/gif', 'image/png'))) {
						$file = self::tempname($dir, $rs['info'][$name]['suffix']);
						if (@copy($sourceFile, $file)) {
							$pathinfo = pathinfo($file);
							@unlink($rs['info'][$name]['file']);
							if ($returnArr) {
								return array(
									'name'     => $rs['info'][$name]['name'],
									'size'     => $rs['info'][$name]['size'],
									'suffix'   => $rs['info'][$name]['suffix'],
									'basename' => $pathinfo['basename'],
									'filename' => $pathinfo['filename']
								);
							}
							return $pathinfo['basename'];
						}
						@unlink($rs['info'][$name]['file']);
					}
				}
			}
		}
		return false;
	}
	function write($id){
		global $db,$pre;
		if($db->exe("select * from {$pre}cache_upload where id=$id")){
			$line=$db->line();
			$file=WEB_ROOT."./cache/upload/$line[tmp_name]";
			if(file_exists($file)){
				echo file_get_contents($file);
			}
		}
	}
	function cache_count(){
		global $db,$pre;
		$line=$db->fetch_first("select count(*) c from {$pre}cache_upload");
		return $line['c'];
	}
	function clear_cache(){
		global $db,$timestamp,$pre;
		//$BF_GLOBAL['db']->nexe("delete from ".$this->tname("cache_upload")." where $BF_GLOBAL[timestamp]-dateline>");
		$query=$db->query("select id,tmp_name from {$pre}cache_upload where $timestamp-dateline>300");
		while($line=$db->fetch_array($query)){
			@unlink(WROOT."./cache/upload/$line[tmp_name]");
			$db->query("delete from {$pre}cache_upload where id=$line[id]",'UNBUFFERED');
		}
	}
}
?>