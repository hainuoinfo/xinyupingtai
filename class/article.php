<?php
class article{
	public static function add($cate_id,$title,$content,$alias=''){
		global $db,$pre;
		if($title&&$cate_id&&$content){
			$db->query("insert into {$pre}article(`title`,`alias`,`cate_id`,`content`,`time_stamp`) values('$title','$alias','$cate_id','$content','".time::$time_stamp."')");
			return true;
		} else return '信息填写不全';
	}
	public static function edit($cate_id,$title,$content,$alias,$id){
		global $db,$pre;
		if($title&&$cate_id&&$content){
			if($item=$db->fetch_first("select alias from {$pre}article where id='$id'")){
				$db->query("update {$pre}article set title='$title',alias='$alias',cate_id='$cate_id',content='$content',time_stamp='".time::$time_stamp."' where id='$id'");
				if($item['alias']!=$alias){
					if(!$item['alias'])html::cache_del($id);
					else html::cache_del($item['alias']);
				}
			}
			return true;
		} else return '信息填写不全';
	}
	public static function del_cate($id){
		global $db,$pre;
		$query=$db->query("select id,alias from {$pre}article where cate_id='$id'");
		while($item=$db->fetch_array($query)){
			if($item['alias'])html::cache_del($item['alias']);
			else html::cache_del($item['id']);
		}
	}
	public static function del($id){
		global $db,$pre;
		if($item=$db->fetch_first("select alias from {$pre}article where id='$id'")){
			if($item['alias'])html::cache_del($item['alias']);
			else html::cache_del($id);
			$db->query("delete from {$pre}article where id='$id'");
		}
	}
	public static function get_count($cate_id=0){
		global $db,$pre;
		return $db->result_first("select count(*) from {$pre}article".($cate_id?" where cate_id='$cate_id'":""));
	}
	public static function get_list($page,$pagesize,$cate_id=0){
		global $db,$pre;
		return $db->fetch_all("select id,cate_id,title,alias,time_stamp,show_index from {$pre}article ".($cate_id?" where cate_id='$cate_id'":"")." order by show_index,time_stamp desc limit ".($page-1)*$pagesize.",$pagesize");
	}
	public static function set_index($show_index,$ids){
		global $db,$pre;
		if(is_array($show_index)&&is_array($ids)&&count($show_index)==count($ids)){
			foreach($show_index as $k=>$v){
				$db->query("update {$pre}article set show_index='$v' where id='".($ids[$k])."'");
			}
		}
	}
}
?>