<?php
class url{
	public static function uri($data){
		$rn=array();
		if($sp=explode('&',$data)){
			foreach($sp as $v){
				$sp2=explode('=',$v);
				$rn[$sp2[0]]=$sp2[1];
			}
		}
		return $rn;
	}
}
?>