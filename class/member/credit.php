<?php
!defined('IN_JB') && exit('error');
loadLib('member.base');
class member_credit extends member_base{
	private static $levelScript = array(), $load = false, $maxLevel;
	private static $saveName = 'member_cache_credit';
	private static function reloadLevelScript(){
		self::$levelScript = cache::get_array(self::$saveName, true);
		self::$maxLevel = count(self::$levelScript);
	}
	private static function checkLevelScript(){
		if (!self::$load) {
			self::reloadLevelScript();
			self::$load = true;
		}
	}
	public static function ini(){
		self::checkLevelScript();
	}
	public static function saveLevelScript($data){
		if (is_array($data)) {
			cache::write_array(self::$saveName, $data);
			self::reloadLevelScript();
			return true;
		}
		return false;
	}
	public static function getLevelScript(){
		return self::$levelScript;
	}
	public static function getLevel($credit){
		$l = -1;
		foreach (self::$levelScript as $k => $level){
			if ($credit >= $level['credit']) $l = $k;
		}
		if ($l < 0) $l = 0;//新加的
		if ($l >= 0) {
			$level = array();
			$levelInfo = self::$levelScript[$l];
			$level = array(
				'level' => $l+1,
				'icon'  => $levelInfo['icon'],
				'title' => $levelInfo['title']
			);
			return $level;
		}
		return false;
	}
	public static function getLevelAll($credit){
		if ($level = self::getLevel($credit)) {
			//$level['nextCredit'] = self::nextLevelNeedCredit($credit);
			$level['isMaxLevel'] = $level['level'] == self::maxLevel();
			if (!$level['isMaxLevel']) {
				$nextLevel = self::$levelScript[$level['level']];
				$nextLevel['level'] = $level['level'] + 1;
				$level['nextCredit'] = $nextLevel['credit'] - $credit;
				$level['nextLevel']  = $nextLevel;
			}
			return $level;
		}
	}
	public static function nextLevelCredit($level){
		if ($level > 0) {
			if ($levelInfo = self::$levelScript[$level]) {
				return $levelInfo['credit'];
			}
		}
		return 0;
	}
	public static function nextLevelNeedCredit($credit){
		if ($levelInfo = self::getLevel($credit)) {
			$nextCredit = self::nextLevelCredit($levelInfo['level']);
			if ($nextCredit > 0) {
				return $nextCredit - $credit;
			}
		}
		return 0;
	}
	public static function maxLevel(){
		return self::$maxLevel;
	}
}
member_credit::ini();
?>