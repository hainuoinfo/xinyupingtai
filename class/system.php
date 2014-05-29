<?php
class system{
	public static function function_exists(){
		$func_list=array();
		if(func_num_args()>0){
			foreach(func_get_args() as $func){
				$func_list[$func]=function_exists($func);
			}
		}
		return $func_list;
	}
	public static function dirfile_check(&$dirfile_items) {
		$rn=true;
		foreach($dirfile_items as $key => $item) {
			$item_path = $item['path'];
			if($item['type'] == 'dir') {
				if(!self::dir_writeable(WEB_ROOT.$item_path)) {
					if(is_dir(WEB_ROOT.$item_path)) {
						$dirfile_items[$key]['status'] = 0;
						$dirfile_items[$key]['current'] = '+r';
						$rn=false;
					} else {
						$dirfile_items[$key]['status'] = -1;
						$dirfile_items[$key]['current'] = 'nodir';
					}
				} else {
					$dirfile_items[$key]['status'] = 1;
					$dirfile_items[$key]['current'] = '+r+w';
				}
			} else {
				if(file_exists(WEB_ROOT.$item_path)) {
					if(is_writable(WEB_ROOT.$item_path)) {
						$dirfile_items[$key]['status'] = 1;
						$dirfile_items[$key]['current'] = '+r+w';
					} else {
						$dirfile_items[$key]['status'] = 0;
						$dirfile_items[$key]['current'] = '+r';
						$rn=false;
					}
				} else {
					if(self::dir_writeable(dirname(WEB_ROOT.$item_path))) {
						$dirfile_items[$key]['status'] = 1;
						$dirfile_items[$key]['current'] = '+r+w';
					} else {
						$dirfile_items[$key]['status'] = -1;
						$dirfile_items[$key]['current'] = 'nofile';
					}
				}
			}
		}
		return $rn;
	}
	public static function dir_writeable($dir) {
		$writeable = 0;
		if(!is_dir($dir)) {
			@mkdir($dir, 0777);
		}
		if(is_dir($dir)) {
			if($fp = @fopen("$dir/test.txt", 'w')) {
				@fclose($fp);
				@unlink("$dir/test.txt");
				$writeable = 1;
			} else {
				$writeable = 0;
			}
		}
		return $writeable;
	}
	public static function env_check(&$env_items) {
		$rn=true;
		foreach($env_items as $key => $item) {
			if($key == 'php') {
				$env_items[$key]['current'] = PHP_VERSION;
			} elseif($key == 'attachmentupload') {
				$env_items[$key]['current'] = @ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'unknow';
			} elseif($key == 'gdversion') {
				$tmp = function_exists('gd_info') ? gd_info() : array();
				$env_items[$key]['current'] = empty($tmp['GD Version']) ? 'noext' : $tmp['GD Version'];
				unset($tmp);
			} elseif($key == 'diskspace') {
				if(function_exists('disk_free_space')) {
					$env_items[$key]['current'] = floor(disk_free_space(WEB_ROOT) / (1024*1024)).'M';
				} else {
					$env_items[$key]['current'] = 'unknow';
				}
			} elseif(isset($item['c'])) {
				$env_items[$key]['current'] = constant($item['c']);
			}
	
			$env_items[$key]['status'] = 1;
			if($item['r'] != 'notset' && strcmp($env_items[$key]['current'], $item['r']) < 0) {
				$env_items[$key]['status'] = 0;
				$rn=false;
			}
		}
		return $rn;
	}
}
?>