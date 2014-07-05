<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
$top_menu=array('index'=>'友情链接列表','add'=>'添加链接');
$top_menu_key=array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
if($edit=(int)$edit)$method='add';
$db_table_name='related_links';
switch($method){
	case 'index':
		if(form::is_form_hash()){
			form::reg('ids','sort','del');
			if($del){
				db::del_ids($db_table_name,$del);
				admin::show_message('删除成功',$base_url);
			} elseif($count=form::array_equal($ids,$sort)){
				for($i=0;$i<$count;$i++){
					$id=$ids[$i];
					$sid=$sort[$i];
					$db->query("update $pre$db_table_name set sort='$sid' where id='$id'");
				}
				admin::show_message('排序设置完成',$base_url);
			}
		}
		if($data_count=db::data_count($db_table_name)){
			$list=db::get_list($db_table_name,'*','','sort,timestamp desc');
			$multipage=multi_page::parse($data_count,$pagesize,$page,$base_url.'&page={page}',$pagestyle);
		}
	break;
	case 'add':
		if(form::is_form_hash()){
			form::reg('title','url','img','status','is_edit');
			if($title && $url){
				if($is_edit){
					db::update($db_table_name,array('title'=>$title,'url'=>$url,'img'=>$img,'status'=>$status,'timestamp'=>$timestamp),"id='$edit'");
					admin::show_message('修改成功',$base_url);
				} else {
					db::insert($db_table_name,array('title'=>$title,'url'=>$url,'img'=>$img,'status'=>$status,'timestamp'=>$timestamp));
					admin::show_message('添加成功',$base_url);
				}
			} else $info='参数错误！';
		}
		if($edit){
			if($item=db::one($db_table_name,'*',"id='$edit'")){
				$title=$item['title'];
				$url=$item['url'];
				$img=$item['img'];
				$status=$item['status'];
			} else $edit=false;
		} else $edit=false;
	break;
}
?>