<?php
class rewrite{
	private static $args=array();
	public static function add($source,$destination){
		global $db,$pre;
		if($source&&$destination){
			$db->query("insert into {$pre}rewrite(`source`,`destination`) values('$source','$destination')");
			self::update_cache();
			return true;
		} else return false;
	}
	public static function remove($id){
		global $db,$pre;
		if($item=$db->result_first("select * from {$pre}rewrite where id='$id'")){
			$db->query("delete from {$pre}rewrite where id='$id'");
			self::update_cache();
		}
	}
	public static function parse($source,$destination){
		self::$args=array();
		$source=preg_replace('/([\/|.?])/','\\\$1',$source);
		$source=preg_replace("/\((\w+)\)/ie","self::get_args_name('$1')",$source);
		foreach(self::$args as $v){
			$args[]=$v;
		}
		$sp=explode('?',$destination);
		$destination=$sp[0];
		if($sp[1]){
			$sp=explode('&',$sp[1]);
			foreach($sp as $v){
				$sp2=explode('=',$v);
				if($sp2[1]!='')$args[]=array('name'=>$sp2[0],'value'=>$sp2[1]);
			}
		}
		$rewrite['source']=$source;
		$rewrite['destination']=$destination;
		$rewrite['args']=$args;
		return $rewrite;
	}
	private static function get_args_name($name){
		self::$args[]=$name;
		return '(?P<'.$name.'>.+?)';
	}
	public static function update_cache(){
		global $db,$pre;
		$query=$db->query("select * from {$pre}rewrite");
		while($line=$db->fetch_array($query)){
			if($args=self::parse($line['source'],$line['destination'])){
				$rewrite[]=$args;
			}
		}
		cache::write_rewrite('index','<?php $rewrite_list='.string::format_array($rewrite).';?>');
	}
}
?>