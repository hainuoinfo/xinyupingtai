<?php
class htmlcode{
	public static function upload($type='image'){
		switch($type){
			case 'image':
				$html='<iframe name="file_upload" id="file_upload" src="'.$weburl.'/index.php?action=upload&operation=image" frameborder="0" height="30" scrolling="no" width="300"></iframe>';
			break;
		}
		return $html;
	}
}
?>