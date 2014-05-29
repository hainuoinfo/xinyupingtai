<?php
class background{
	public static function getAd($marker){
		return db::one_one('ad', 'content', "marker='$marker'");
	}
	public static function getAd2($marker){
		$sp = explode(',', $marker);
		$varName = $sp[1];
		$varName || $varName = $sp[0];
		$varName = '$'.$varName;
		$code = self::getAd($sp[0]);
		return '<?php '.$varName.'='.string::getVarString($code).';?>';
	}
}
?>