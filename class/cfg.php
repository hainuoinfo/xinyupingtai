<?php
class cfg{
	private static $tb_cate = 'sys_cfg_cate', $tb_list = 'sys_cfg_list', $cacheName = 'sys_config_';
	public static function addCate($name, $remark){
		if ($name && mb_strlen($name) <= 32 && mb_strlen($remark) <= 64) {
			if (!db::exists(self::$tb_cate, array('name' => $name))) {
				if ($cid = db::insert(self::$tb_cate, array(
					'name'   => $name,
					'remark' => $remark
				), true)) {
					return $cid;
				}
				return '添加失败！';
			}
			return '该分类名已经存在了！';
		}
		return '添加失败！';
	}
	public static function getCateTotal(){
		return intval(db::data_count(self::$tb_cate));
	}
	public static function getCates($page = 1, $pageSize = 20){
		$page = intval($page);
		//$page < 1 && $page = 1;
		return db::select(self::$tb_cate, '*', '', '', $pageSize, $page);
	}
	public static function getCate($id){
		$id = intval($id);
		return db::one(self::$tb_cate, '*', "id='$id'");
	}
	public static function editCate($name, $remark, $id){
		if ($name && mb_strlen($name) <= 32 && mb_strlen($remark) <= 64) {
			if (db::exists(self::$tb_cate, array('id' => $id))) {
				if (!db::exists(self::$tb_cate, "name='$name' and id<>'$id'")) {
					if (db::update(self::$tb_cate, array(
						'name'   => $name,
						'remark' => $remark
					), "id='$id'")) {
						return true;
					}
					return '修改失败！';
				}
			}
			return '该分类名已经存在了！';
		}
		return '修改失败！';
	}
	public static function addCfg($pid, $name, $type, $attach, $remark){
		if (db::exists(self::$tb_cate, array('id' => $pid))) {
			if (!db::exists(self::$tb_list, array(
				'cid' => $pid,
				'name' => $name
			))) {
				if ($id = db::insert(self::$tb_list, array(
					'cid'    => $pid,
					'name'   => $name,
					'type'   => $type,
					'attach' => $attach,
					'remark' => $remark
				), true)) {
					return $id;
				}
				return '添加失败！';
			}
			return '该配置名称已经存在！';
		}
		return '添加失败！';
	}
	public static function getCfgTotal($id){
		$id = intval($id);
		return db::data_count(self::$tb_list, "cid='$id'");
	}
	public static function getCfgs($cid, $page = 1, $pageSize = 20){
		$page = intval($page);
		return db::select(self::$tb_list, '*', "cid='$cid'", '', $pageSize, $page);
	}
	public static function delCfg($ids){
		is_array($ids) || $ids = array($ids);
		$sids = '\''.implode('\',\'', $ids).'\'';
		foreach (db::select(self::$tb_list, 'value', "id in($sids) and type='image' and value<>''") as $v) {
			@unlink(d('./'.$v['value']));
		}
		$cfg = self::getCfg($ids[0]);
		$rs = db::del_ids(self::$tb_list, $ids);
		if ($rs > 0) self::updateCfg($cfg['cid']);
		return $rs;
	}
	public static function getCfg($id){
		$id = intval($id);
		return db::one(self::$tb_list, '*', "id='$id'");
	}
	public static function editCfg($id, $name, $type, $attach, $remark){
			$cid = db::one_one(self::$tb_list, 'cid', "id='$id'");
			if (!db::exists(self::$tb_list, "name='$name' AND cid='$cid' AND id<>'$id'")) {
				if (db::update(self::$tb_list, array(
					'name'   => $name,
					'type'   => $type,
					'attach' => $attach,
					'remark' => $remark
				), "id='$id'")) {
					return true;
				}
				return '修改失败！';
			}
			return '该配置名称已经存在！';
		return '修改失败！';
	}
	public static function setCfg($cid, $arr){
		if ($cfgList = self::getCfgs($cid, 0, 0)) {
			$cate = self::getCate($cid);
			foreach ($cfgList as $v) {
				if (isset($arr[$v['name']])) $val = $arr[$v['name']];
				else $val = '';
				switch ($v['type']) {
					case 'text':
					break;
					case 'select':
					break;
					case 'radio':
					break;
					case 'radio2':
					break;
					case 'checkbox':
						if (is_array($val)) {
							$val = string::getCheckBox($val);
						} else {
							$val = 0;
						}
					break;
					case 'image':
						$args = array();
						if ($attach = trim($v['attach'])) {
							foreach (common::trimExplode("\r\n", $attach) as $__v) {
								$__sp = common::trimExplode('=', $__v);
								$args[$__sp[0]] = $__sp[1];
							}
						}
						$saveDir0 = 'img/cfg/'.$cate['name'].'/';
						$saveDir1 = d('./'.$saveDir0);
						common::create_folder($saveDir1);
						$img = '';
						if (!empty($args['width']) && !empty($args['height'])) {
							$args['width'] = intval($args['width']);
							$args['height'] = intval($args['height']);
							if ($args['width'] && $args['height']) {
								$img = image::getImage($v['name'], $saveDir1, $args['width'], $args['height']);
							}
						}
						if (!$img) $img = upload::uploadImage($v['name'], $saveDir1);
						if ($img) {
							$val = $saveDir0 .= $img;
							if ($v['value'] && $v['value'] != $val) @unlink(d('./'.$v['value']));
						} else $val = $v['value'];
					break;
					default:
					break;
				}
				db::update(self::$tb_list, array('value' => $val), "id='$v[id]'");
			}
			self::updateCfg($cid);
			return true;
		}
		return false;
	}
	public static function updateCfg($cid){
		if ($cate = self::getCate($cid)) {
			$cacheName = self::$cacheName.$cate['name'];
			if ($list = self::getCfgs($cid, 0, 0)) {
				$datas = array();
				foreach ($list as $v) {
					$datas[$v['name']] = $v['value'];
				}
			}
			cache::write_array($cacheName, $datas);
		}
	}
	public static function updateCfgAll(){
		foreach (self::getCates(0, 0) as $v) self::updateCfg($v['id']);
	}
	public static function delCate($ids){
		is_array($ids) || $ids = array($ids);
		foreach ($ids as $id) {
			if ($cate = self::getCate($id)) {
				$cacheName = self::$cacheName.$cate['name'];
				foreach (db::select(self::$tb_list, 'value', "cid='$cate[id]' and type='image' and value<>''") as $v) {
					@unlink(d('./'.$v['value']));
				}
				db::del_key(self::$tb_list, 'cid', $cate['id']);
				db::del_id(self::$tb_cate, $cate['id']);
				cache::delete_array($cacheName);
			}
		}
	}
	public static function get($pname, $name = ''){
		$cacheName = self::$cacheName.$pname;
		$datas = memory::get($cacheName);
		$isSet = false;
		if (isset($datas)) {
			$isSet = true;
		}
		if (!$isSet) {
			$datas = cache::get_array($cacheName, true);
			if ($datas) memory::write($cacheName, $datas);
		}
		if ($name) {
			if (isset($datas[$name])) return $datas[$name];
			return NULL;
		}
		return $datas;
	}
	public static function getInt($pname, $name){
		return intval(self::get($pname, $name));
	}
	public static function getMoney($pname, $name){
		return common::formatMoney(self::get($pname, $name));
	}
	public static function getFloat($pname, $name){
		return floatval(self::get($pname, $name));
	}
	public static function getBoolean($pname, $name){
		$data = self::get($pname, $name);
		if (isset($data)) {
			$data = strtolower($data);
			if (in_array($data, array('true', '1', 'yes' ,'ok'))) return true;
			return false;
		}
		return false;
	}
	public static function getPercent($pname, $name){
		$data = self::get($pname, $name);
		if (isset($data)) {
			$data = doubleval($data);
			$data = floor($data * 10000) / 100;
			return $data.'%';
		}
		return '0%';
	}
	public static function getImage($pname, $name){
		global $weburl2;
		$data = self::get($pname, $name);
		if (isset($data)) {
			return '<img src="'.$weburl2.$data.'" />';
		}
		return '';
	}
	public static function getList($pname, $name){
		$list = array();
		if ($str = self::get($pname, $name)) {
			foreach (explode(';', $str) as $v) {
				list($key, $value, $checked) = explode(',', $v);
				isset($checked) || $checked = false;
				$list[] = array(
					'key'     => $key,
					'value'   => $value,
					'checked' => $checked
				);
			}
		}
		return $list;
	}
	public static function getListValue($pname, $name, $key){
		if ($list = self::getList($pname, $name)) {
			foreach ($list as $v) {
				if ($v['key'] == $key) return $v['value'];
			}
		}
		return false;
	}
	public static function getListValues($pname, $name){
		if ($list = self::getList($pname, $name)) {
			$rs = array();
			foreach ($list as $v) {
				$rs[] = $v['value'];
			}
			return $rs;
		}
		return false;
	}
	public static function getNavigation($pname, $name){
		$list = array();
		if ($str = self::get($pname, $name)) {
			foreach (common::trimExplode("\n", $str) as $v) {
				if ($v = trim($v)) {
					$url = $name = $action = '';
					$__arr = common::trimExplode('|', $v);
					//list($url, $name, $action) = common::trimExplode('|', $v);
					$url    = isset($__arr[0]) ? $__arr[0] : '';
					$name   = isset($__arr[1]) ? $__arr[1] : '';
					$action = isset($__arr[2]) ? $__arr[2] : '';
					$list[] = array('url' => $url, 'name' => $name, 'action' => $action, 'actions' => explode(',', $action));
				}
			}
		}
		return $list;
	}
	public static function backupToCate($cid, $name) {
		if (!($cate = self::getCate($cid))) return '要备份的配置不存在！';
		if ($name = trim($name)) {
			$ln = chr(10);
			$savePath = d('./data/sql/backup/');
			common::create_folder($savePath);
			$saveFile = d($savePath.$name.'.sql');
			$f = fopen($saveFile, 'wb');
			fwrite($f, 'DELETE FROM `'.db::table(self::$tb_cate).'` WHERE name=\''.$cate['name'].'\';'.$ln);
			fwrite($f, 'INSERT INTO `'.db::table(self::$tb_cate).'`(`name`,`remark`) VALUES(\''.$cate['name'].'\',\''.$cate['remark'].'\');'.$ln);
			fwrite($f, 'SET @cid=LAST_INSERT_ID();'.$ln);
			fwrite($f, 'DELETE FROM `'.db::table(self::$tb_list).'` WHERE cid=\''.$cid.'\';'.$ln);
			if(db::data_count(self::$tb_list, "cid='$cid'")){
				$query = db::query('SELECT * FROM `'.db::table(self::$tb_list).'` WHERE cid=\''.$cid.'\'');
				$fields_name = db::getFieldsName($query);
				unset($fields_name[0]);
				$fields = '`'.implode('`,`', $fields_name).'`';
				$insert_one  = true;
				while($line = db::fetch($query)){
					foreach($line as $k2 => $v2){
						if (!in_array($k2, array('id'))) {
							if ($k2 == 'cid') $line[$k2] = '@cid';
							else {
							if(is_numeric($v2)){
								$line[$k2] = '\''.$v2.'\'';
							} else {
								$hex = string::str_hex($v2);
								if($hex != '')$line[$k2] = '0x'.$hex;
								else $line[$k2] = '\'\'';
							}
							}
						} else unset($line[$k2]);
					}
					fwrite($f, 'INSERT INTO `'.db::table(self::$tb_list).'`('.$fields.') VALUES('.implode(",", $line).');'.$ln);
					$insert_one=false;
				}
			}
				
			
			fclose($f);
			return true;
		
		}
		return '请输入要备份的名字！';
	}
}
?>