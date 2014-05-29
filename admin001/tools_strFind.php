<?php
$top_menu=array(
	'find'    => '查找',
	'replace' => '替换'
);
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
set_time_limit(0);
function fileFind($dir, $key){
	$rs = array();
	if ($dh = opendir($dir)) {
		while ($filename = readdir($dh)) {
			if (!in_array($filename, array('.', '..'))) {
				$file = $dir.$filename;
				if (filetype($file) == 'dir') {
					//$rs += fileFind($file.D, $key);
					$rs = array_merge($rs, fileFind($file.D, $key));
				} else {
					$data = file::read($file);
					if (strpos($data, $key)) {
						$rs[] = $file;
					}
				}
			}
		}
	}
	return $rs;
}
switch ($method) {
	case 'find':
		if (form::is_form_hash()) {
			$keys = $_POST['keys'];
			if ($keys = trim($keys)) {
				$folder = d('./templates/');
				$files = fileFind($folder, $keys);
				//array_multisort($files, SORT_ASC, SORT_NUMERIC);
				//print_r($files);
			}
		}
	break;
	case 'replace':
		if (form::is_form_hash()) {
			$keys = $_POST['keys'];
			$replace = $_POST['replace'];
			if (($keys = trim($keys)) && ($replace = trim($replace))) {
				$folder = d('./templates/');
				$files = fileFind($folder, $keys);
				foreach ($files as $file) {
					$data = file::read($file);
					$data = str_replace($keys, $replace, $data);
					file::write($file, $data);
				}
			}
		}
	break;
}
?>