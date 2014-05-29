<?php
class b_nav{
	private static $tbName = 'b_navs', $cacheName = 'b_navs';
	public static function add($name, $ename, $curl, $pid, $type = 0){
		$pid = (int)$pid;
		if (db::insert(self::$tbName, array('pid' => $pid, 'name' => $name, 'ename' => $ename, 'curl' => $curl, 'type' => $type))) {
			if ($pid > 0) db::update(self::$tbName, 'total=total+1', "id='$pid'");
			self::upCache();
			return true;
		}
		return false;
	}
	public static function add2($name, $ename, $pename, $type = 0){
		$pid = self::getId($pename);
		if ($id = db::insert(self::$tbName, array('pid' => $pid, 'name' => $name, 'ename' => $ename, 'type' => $type), true)) {
			if ($pid > 0) db::update(self::$tbName, 'total=total+1', "id='$pid'");
			self::upCache();
			return $id;
		}
		return false;
	}
	public static function del2($ename, $pename = ''){
		$id = self::getId($ename, $pename);
		return self::del($id);
	}
	public static function exists($ename, $pename = ''){
		return self::getId($ename, $pename) ? true : false;
	}
	public static function getId($ename, $pename = ''){
		$pid = $pename ? (int)db::one_one(self::$tbName, 'id', "ename='$pename'") : 0;
		return (int)db::one_one(self::$tbName, 'id', ($pid > 0 ? "pid='$pid' and ": '')."ename='$ename'");
	}
	public static function getName($id){
		return db::one_one(self::$tbName, 'name', "id='$id'");
	}
	public static function getEname($id){
		if (is_numeric($id)) {
			return db::one_one(self::$tbName, 'ename', "id='$id'");
		}
		return false;
	}
	public static function edit($name, $ename, $curl, $id){
		if (db::update(self::$tbName, array('name' => $name, 'ename' => $ename, 'curl' => $curl), "id='$id'")) {
			self::upCache();
			return true;
		}
		return false;
	}
	public static function upCache(){
		global $db, $pre, $admin_url;
		$menus = $cache = array();
		$query = $db->query("select * from {$pre}".self::$tbName." where pid='0' order by sort");
		while ($line = $db->fetch_array($query)) {
			$menus[$line['id']] = array('name' => $line['name'], 'ename' => $line['ename'], 'sub' => array());
		}
		if ($menus) {
			$query = $db->query("select * from {$pre}".self::$tbName." where pid>0 order by pid,sort");
			while ($line = $db->fetch_array($query)) {
				if ($line['ename'] || $line['curl']) {
					if ($line['curl']) {
						$curl = $line['curl'];
						substr($curl, 0, 1) == '?' && ($curl = $admin_url.$curl);
						$menus[$line['pid']]['sub'][] = array('name' => $line['name'], 'url' => $curl);
					} else {
						$menus[$line['pid']]['sub'][$line['ename']] = $line['name'];
					}
				}
			}
		}
		$cache = $menus;
		$menus = array();
		foreach ($cache as $v) {
			$menus[$v['ename']] = array('name' => $v['name'], 'sub' => $v['sub']);
		}
		cache::write_array(self::$cacheName, $menus);
	}
	public static function getMenus(){
		return db::get_list(self::$tbName, '*', 'pid=\'0\'', 'sort', 0);
	}
	public static function getSubMenus($pid){
		return db::get_list(self::$tbName, '*', "pid='$pid'", 'sort', 0);
	}
	public static function setSort($ids, $sorts){
		if (is_array($ids) && is_array($sorts) && count($ids) == count($sorts)) {
			$count = count($ids);
			for ($i = 0; $i < $count; $i++) {
				$id   = $ids[$i];
				$sort = $sorts[$i];
				db::update(self::$cacheName, array('sort' => $sort), "id='$id'");
			}
		}
		self::upCache();
	}
	public static function del($ids){
		is_array($ids) || $ids = array($ids);
		foreach ($ids as $id) {
			if ($id) {
				$menu = self::getMenu($id);
				db::del_id(self::$tbName, $id);
				if ($menu['pid'] > 0) {
					//子菜单
					db::update(self::$tbName, 'total=total-1', "id='$menu[pid]'");
				} else {
					db::del_key(self::$tbName, 'pid', $id);
				}
			}
		}
		self::upCache();
	}
	public static function getCacheMenus(){
		return cache::get_array(self::$cacheName, true);
	}
	public static function getMenuName($id){
		return db::one_one(self::$tbName, 'name', "id='$id'");
	}
	public static function getMenu($id){
		return db::one(self::$tbName, '*', "id='$id'");
	}
}
?>