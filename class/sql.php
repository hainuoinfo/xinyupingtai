<?php
class sql{
	public static function get_insert($arr, $null = true){
		if($arr){
			foreach($arr as $k => $v){
				if(($v = trim($v)) == '' && !$null)continue;
				if($rn)$rn .= ',';
				$rn .= "`$k`='$v'";
			}
			return $rn;
		}
	}
}
?>