<?php
class task_express{
	public static function getList($f = 'id,name,marker'){
		return db::get_list2('express', $f, "status='0'", 'sort,timestamp desc');
	}
	public static function get($id){
		if ($e = db::one('express', 'id,name,marker', "id='$id'")){
			$e['city1'] = cache::get_text('citys_'.$id.'_city1');
			$e['city2'] = cache::get_text('citys_'.$id.'_city2');
			$e['city3'] = cache::get_text('citys_'.$id.'_city3');
			return $e;
		}
		return false;
	}
	public static function getName($id) {
		return db::one_one('express', 'name', "id='$id'");
	}
}
?>