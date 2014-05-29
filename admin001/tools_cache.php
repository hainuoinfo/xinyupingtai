<?php
if(form::is_form_hash()){
	if($type=$_POST['type']){
		foreach($type as $v){
			switch($v){
				case 'data':
					checkWrite();
					file::del_folder(d('./cache/html/tpl'),0,false);
					echo 'complate';
				break;
				case 'tpl':
					checkWrite();
					file::del_folder(d('./cache/default'),0,false);
					echo 'complate';
				break;
			}
		}
		exit;
	}
}
?>