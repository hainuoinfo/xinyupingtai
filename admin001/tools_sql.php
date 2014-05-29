<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
$method || $method='index';
($edit=(int)$edit) && $method='create';
if($del=(int)$del){
	db::del_id('sql',$del);
	common::goto_url($base_url,true);
}
($create=(int)$create) && $method='create2';
switch($method){
	case 'index':
		$list=$db->fetch_all("select id,name from {$pre}sql order by id");
	break;
	case 'create':
		if(common::is_form_hash()){
			if(($sql=$_POST['sql']) && ($name=$_POST['name'])){
				$args=array();
				if(preg_match_all("/\{([a-zA-Z0-9_]+)\}/",$sql,$matches,PREG_SET_ORDER)){
					foreach($matches as $v){
						if($v[1]!='pre'){
							if(!$_POST[$v[1]])admin::show_message("参数填写不完整");
							$args[$v[1]]=$_POST[$v[1]];
						}
					}
				}
				($args && $args=addslashes(serialize($args))) || $args='';
				if($_POST['is_edit'])db::update('sql',array('name'=>$name,'sql'=>$sql,'args'=>$args),"id='$edit'");
				else db::insert('sql',array('name'=>$name,'sql'=>$sql,'args'=>$args));
				admin::show_message(($_POST['is_edit']?'编辑':'添加').'成功',$base_url);
			} else admin::show_message('参数填写不完整');
		}
		$edit && ($item=$db->fetch_first("select * from {$pre}sql where id='$edit'")) && $item['args'] && $args=unserialize($item['args']);
		$item || $edit=0;
	break;
	case 'create2':
		$item=$db->fetch_first("select name,args from {$pre}sql where id='$create'");
		if($item['args'])$args=unserialize($item['args']);
		else $args=array();
		if(common::is_form_hash()){
			if($args){
				foreach($args as $k=>$v){
					if(!$_POST[$k])admin::show_message("参数填写不完整");
				}
			}
			$sql=$db->result_first("select `sql` from {$pre}sql where id='$create'");
			$sql=str_replace('{pre}',$pre,$sql);
			$args && $sql=preg_replace('/\{([a-zA-Z0-9_]+)\}/e','$_POST[\'$1\']',$sql);
			$sp = common::trimExplode(';', $sql);
			foreach ($sp as $v){
				if ($v) {
					$db->query($v);
				}
			}
			admin::show_message("执行：$sql 完毕！",$base_url);
		}
	break;
}
?>