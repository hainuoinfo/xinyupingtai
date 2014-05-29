<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
common::nocache();
$method=$add?'add':($del?'del':$method);
switch($method){
	case 'add':
		checkWrite();
		if(($args=url::uri($add)) && $args['action'] && $args['operation'] && ($menu=$menus[$args['action']]) && $menu['sub'][$args['operation']]){
			if(!db::exists('admin_custom_menu',array('action'=>$args['action'],'operation'=>$args['operation']))) {
				$menu_args=array('action'=>$args['action'],'operation'=>$args['operation']);
				$menu_args=common::bf_addslashes($menu_args);
				$menu_id=(int)db::insert('admin_custom_menu',$menu_args,true);
				echo '{status:true}';
			} else echo '{status:false,msg:"exists"}';
		}
		//if($menu=$menus[$args['action']]) {
			//(!$args['operation'] || !($title=$menu['sub'][$args['operation']])) && $title=$menu['name'];
			//$db->query("insert into ");
			//$menu_args=array('title'=>$title,'url'=>$admin_url.'?action='.$args['action'].($args['operation']?'&operation='.$args['operation']:''));
			
		//}
	break;
	case 'del':
		checkWrite();
		$del=(int)$del;
		db::del_id('admin_custom_menu',$del);
		echo '{status:true}';
	break;
	case 'get':
		$query=$db->query("select * from {$pre}admin_custom_menu");
		while($line=$db->fetch_array($query)){
			echo '<em id="custombar_'.$line['id'].'"><a onclick="mainFrame('.$line['id'].', this.href);doane(event)" href="'.$admin_url.'?action='.$line['action'].'&operation='.$line['operation'].'" hidefocus="true">'.$menus[$line['action']]['sub'][$line['operation']].'</a><span onclick="del_admin_menu('.$line['id'].')" title="删除">&nbsp;&nbsp;</span></em>';
		}
		//echo $db->print_all("select * from {$pre}admin_custom_menu",'<em id="custombar_{id}"><a onclick="mainFrame({id}, this.href);doane(event)" href="{url}" hidefocus="true">{title}</a><span onclick="del_admin_menu({id})" title="删除">&nbsp;&nbsp;</span></em>');
	break;
}
exit;
?>