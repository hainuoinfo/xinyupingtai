<?php
class task_book{
	public static function setConfig($datas){
		global $db, $pre;
		$sp = explode(',', $datas['rejects']);
		$arr = array();
		$i = 0;
		foreach ($sp as $v) {
			if ($v = trim($v)) {
				$arr[] = $v;
				$i++;
				if ($i == 20) break;
			}
		}
		$datas['rejects'] = implode(',', $arr);
		$uIds = array();
		if ($arr) {
			$str = '\''.implode('\',\'', $arr).'\'';
			$uIds = db::get_ids('members', "username in($str)");
			/*if ($uIds = db::get_ids('members', "username in($str)")) {
				$datas['rejectIds'] = implode(',', $uIds);
			} else {
				$datas['rejectIds'] = '';
			}*/
		} else {
			//$datas['rejectIds'] = '';
		}
		$count1 = (int)db::one_one('card', 'sum(total2)', "uid='$datas[uid]' and cid='11' and status='1' and total2>0");
		if ($datas['nums'] >=0 && $datas['nums'] <= $count1) {
			//正确
			$oldDatas = self::getConfig($datas['type'], $datas['uid']);
			!$oldDatas && $oldDatas = array('ing' => 0);
			$datas['ing'] = $datas['nums'];
			unset($datas['nums']);
			if ($datas['ing'] > 0) {
				$num = $datas['ing'];
				$query = $db->query("select id,total2 from {$pre}card where uid='$datas[uid]' and cid='11' and status='1' and total2>0");
				while ($line = $db->fetch_array($query)) {
					$num -= $line['total2'];
					if ($num <= 0) {
						db::update('card', 'total2='.($line['total2'] - $datas['ing']).',total3=total3+'.$datas['ing'], "id='$line[id]'");
						break;
					} else {
						db::update('card', 'total2=0,total3='.$line['total2'], "id='$line[id]'");
					}
				}
				if ($num > 0) $datas['ing'] -= $num;
			}
			$datas['ing'] += $oldDatas['ing'];
			db::replace('task_book', $datas);
			db::del_key('task_book_filter', 'uid', $datas['uid']);
			if ($uIds) {
				$insert = "('$datas[type]','$datas[uid]','".implode("'),('$datas[type]','$datas[uid]','", $uIds)."')";
				$db->query("insert into {$pre}task_book_filter(type,uid,fuid) values$insert");
			}
			return $datas['ing'] - $oldDatas['ing'];
		}
		return 'error';
	}
	public static function getConfig($type, $uid){
		return db::one('task_book', '*', "type='$type' and uid='$uid'");
	}
}
?>