<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
$method||$method='index';
(!($look=(int)$look) && ($edit=(int)$edit)) && $method='add_cate';
switch($method){
	case 'index':
		if($look=(int)$look) {
			$cate=$db->fetch_first("select * from {$pre}cate_block where id='$look'");
			($edit=(int)$edit) && $type='add';
			if($type=='add') {
				if($edit) {
					if(form::is_form_hash()) {
						extract($_POST);
						if($name && $marker && $data) {
							if(!db::exists('block',"marker='$marker' and id<>'$edit'")){
								db::update('block',array('cid'=>$look,'name'=>$name,'marker'=>$marker,'data'=>$data,'edit_timestamp'=>$timestamp),"id='$edit'");
								common::goto_url($base_url.'&method='.$method.'&look='.$look,true);
							} else {
								$item=$_POST;
								$info='该标记已经存在！';
							}
						}
					}
					$item || $item=$db->fetch_first("select * from {$pre}block where id='$edit'");
				} else {
					if(form::is_form_hash()) {
						extract($_POST);
						if($name && $marker && $data) {
							if(!db::exists('block',array('marker'=>$marker))){
								db::insert('block',array('cid'=>$look,'name'=>$name,'marker'=>$marker,'data'=>$data,'add_timestamp'=>$timestamp,'edit_timestamp'=>$timestamp));
								db::update('cate_block','count=count+1',"id='$look'");
								common::goto_url($base_url.'&method='.$method.'&look='.$look,true);
							} else {
								$item=$_POST;
								$info='该标记已经存在！';
							}
						}
					}
				}
			} else {
				if(form::is_form_hash()) {
					if($del=$_POST['del']) {
						if($del_count=db::del_ids('block',$del)){
							db::update('cate_block','count=count-'.$del_count,"id='$look'");
						}
						common::refresh();
					}
					if(($ids=$_POST['ids']) && ($sort=$_POST['sort'])) {
						$count=count($ids);
						for($i=0;$i<$count;$i++) {
							$id=$ids[$i];
							$sort_id=$sort[$i];
							$db->query("update {$pre}block set sort='$sort_id' where id='$id'");
						}
					}
					common::refresh();
				}
				if($data_count=db::data_count('block',"cid='$look'")){
					$list=$db->fetch_all("select * from {$pre}block where cid='$look' order by sort,edit_timestamp desc limit ".($page-1)*$pagesize.','.$pagesize);
					$multipage=multi_page::parse($data_count,$pagesize,$page,$base_url.'&method='.$method.'&look='.$look.'&page={page}',$pagestyle);
				}
			}
		} else {
			$look=0;
			if(form::is_form_hash())	{
				if($del=$_POST['del']) {
					db::del_ids('cate_block',$del);
					db::del_keys('block','cid',$del);
					common::refresh();
				}
				if(($ids=$_POST['ids']) && ($sort=$_POST['sort'])) {
					$count=count($ids);
					for($i=0;$i<$count;$i++) {
						$id=$ids[$i];
						$sort_id=$sort[$i];
						$db->query("update {$pre}cate_block set sort='$sort_id' where id='$id'");
					}
				}
				common::refresh();
			}
			$list=$db->fetch_all("select * from {$pre}cate_block order by sort");
		}
	break;
	case 'add_cate':
		if(form::is_form_hash()){
			form::reg('name','is_edit');
			if($name){
				if($is_edit){
					if(db::exists('cate_block',"name='$name' and id<>'$edit'")) {
						$info='该分类名已经存在！';
					} else {
						db::update('cate_block',array('name'=>$name),"id='$edit'");
						admin::show_message('修改成功',$base_url);
					}
				} else {
					if(db::exists('cate_block',array('name'=>$name))) {
						$info='该分类名已经存在！';
					} else {
						db::insert('cate_block',array('name'=>$name));
						admin::show_message('添加成功',$base_url);
					}
				}
			}
		}
		if($edit){
			if($item=db::one('cate_block','*',"id='$edit'")){
				$name=$item['name'];
				$edit=true;
			}
			else $edit=false;
		} else $edit=false;
	break;
}
?>