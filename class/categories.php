<?php
!defined('IN_JB') && exit('没有权限');
class categories{
	public static function cate_first($tbname, $pid=0, $fields = '*'){
		global $db,$pre;
		if(!$pid){
			db::query("set @l=1");
		} else {
			if(!db::exists($tbname, array('id' => $pid), '@l:=l+1')) return array();
			//"select @l:=l+1 from $pre$tbname where id='$pid'"))
		}
		$fields = preg_replace('/([^`,]+)/i','t.\\1', $fields);
		return $db->fetch_all("select @l:=r+1, $fields, floor((r-l-1)/2) sub_num from (select * from $pre$tbname order by l) t where l=@l");
		
	}
	public static function cate_nextChild($tbname,$pid=0,$fields='*'){
		global $db;
		if($item=db_one($tbname,"l,r","id=$pid")){
			extract($item);
			if($r-$l==1)return array($pid);
			else {
				return db::get_ids($tbname, "l>$l and r<$r and r-l=1");
			}
		}
	}
	public static function cate_firstChild2($tbname,$pid=0,$fields='*'){
		global $db,$pre;
		if(!$pid){
			db::query("set @l=1");
		} else {
			if(!db::exists($tbname, array('id' => $pid), '@l:=l+1')) return array();
		}
		$fields=preg_replace('/([^`,]+)/i','t.\\1',$fields);
		if($db->exe("select @l:=r+1,$fields,floor((r-l-1)/2) count from (select * from $pre$tbname order by l) t where l=@l")){
			while($line=$db->line()){
				if($line['count']==0){
					$rn[]=$line;
				}
			}
			return $rn;
		}
		return $db->fetch_all("select * from
		(select @l:=r+1,$fields,floor((r-l-1)/2) count from (select * from $pre$tbname order by l) t where l=@l) t where count=0");
	}
	public static function cate_firstChild_Count($tbname,$pid=0){
		global $db, $pre;
		if(!$pid){
			db::query("set @l=1");
		} else {
			if(!db::exists($tbname, array('id' => $pid), '@l:=l+1')) return array();
		}
		return $db->result_first("select count(*) from (select @l:=r+1 from (select l,r from $tbname order by l) t where l=@l) t2");
	}
	public static function cate_Child_Count($tbname,$pid){
		global $BF_GLOBAL;
		if($line = db::one($tbname, 'l, r', "id='$pid'")){
			@extract($line);
			return db::one_one($tbname, 'count(*)', "l>$l and r<$r");
		}
	}
	public static function cate_parent($tbname, $id, $fields='*'){
		global $db,$pre;
		if($line = db::one($tbname, 'l, r', "id='$pid'")){
			@extract($line);
			return db::one($tbname, $fields, "l<$l and r>$r", "l desc");
		}
	}
	public static function cate_parent_all($tbname,$id,$endid=0,$fields='*',$order='desc',$len=0){
		global $db,$pre;
		if($line = db::one($tbname, 'l, r', "id='$pid'")){
			@extract($line);
			if($endid){
				if($line = db::one($tbname, 'l, r', "id='$endid'")){
					@extract($line);
					$endl=$line['l'];$endr=$line['r'];
				}
			}
			return $db->fetch_all("select $fields from $pre$tbname where (l<=$l and r>=$r)".($endl&&$endr?" and (l>$endl and r<$endr)":"")." order by l $order".($len?" limit $len":""));
		}
	}
	public static function cate_insert($list,$tbname,$pid=0){
		global $db, $pre;
		$insert=sql::get_insert($list);
		if($insert){
			if($pid){
				if($line = db::one($tbname, 'l, r', "id='$pid'")){
					@extract($line);
					if($db->query_unbuffered("update $pre$tbname set l=l+2 where l>$r")>=0){
						if($db->query_unbuffered("update $pre$tbname set r=r+2 where r>=$r")>=0){
							if($db->query_unbuffered("insert into $pre$tbname set $insert,l=$r,r=$r+1")==1){
								return $db->insert_id();
							} else {
								$db->query("update $pre$tbname set l=l-2 where l>$r+2");
								$db->query("update $pre$tbname set r=r-2 where r>=$r+2");
								return false;
							}
						} else {
							$db->query("update $pre$tbname set l=l-2 where l>$r+2");
							return false;
						}
					}
				}
			} else {
				$r = (int)$db->result_first("select max(r) from $pre$tbname");
				if($db->query_unbuffered("insert into $pre$tbname set $insert,l=$r+1,r=$r+2")==1){
					return $db->insert_id();
				} else {
					return false;
				}
			}
		}
	}
	public static function cate_delete($tbname,$ids){
		global $db,$pre;
		if($ids){
			if(!is_array($ids))$ids=array($ids);
			foreach($ids as $v){
				if($line = db::one($tbname, 'l, r', "id='$v'")){
					@extract($line);
					if($l && $r){
						$db->query("delete from $pre$tbname where l>=$l and r<=$r");
						$len = $r - $l + 1;
						$db->query("update $pre$tbname set l=l-$len where l>$r");
						$db->query("update $pre$tbname set r=r-$len where r>$r");
					}
				}
			}
		}
	}
	public static function cate_this($tbname,$id=0,$fields='*'){
		global $db, $pre;
		return $db->fetch_first("select $fields,floor((r-l-1)/2) sub_num from $pre$tbname where id=$id limit 1");
	}
	public static function cate_child_all($tbname,$id,$fields='*'){
		global $db,$pre;
		if($line = db::one($tbname, 'l, r', "id='$id'")){
			@extract($line);
			return $db->fetch_all("select $fields from $pre$tbname where l>$l and r<$r");
		}
	}
	public static function cate_all_ids($tbname){
		global $db, $pre;
		return db::get_ids($tbname);
	}
	public static function cate_child_ids($tbname,$id){
		$items = self::cate_child_all($tbname,$id,'id');
		if(!$items)return;
		foreach($items as $v){
			$ids[]=$v['id'];
		}
		return $ids;
	}
	public static function cate_thisChild($tbname,$id,$fields='*'){
		$parent = self::cate_parent($tbname,$id,'id');
		if($parent){
			return self::cate_firstChild($tbname,$parent['id'],$fields);
		}
	}
}
?>