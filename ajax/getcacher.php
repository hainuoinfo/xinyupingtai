<?php
include('../class/index.php');
common::nocache();
$ctype='';
if(form::is_form_hash2()){
			if($cid = $_POST['cid']){
           $db->query("delete from {$pre}payment where cid='$cid'");
			common::goto_url('/'.$action.'/'.$operation.'/?type='.$type);	
			} else 
				 {
				$rs = '-1';
			}
		} else {
			$rs = '0';
		}
?>