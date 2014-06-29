<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
if(form::is_form_hash()){
	foreach(form::get('auth_key','sys_admin_folder','db_host','db_port','db_name','db_user','db_pwd','db_table_pre') as $k=>$v) {
		$config[$k]=$v;
	}
	if($config['db_table_pre']!=$pre){
		$query=$db->query("show tables like '".str_replace('_','\_',$pre)."%'");
		$p_len=strlen($pre);
		$pre2=$config['db_table_pre'];
		while($line=$db->fetch_array($query,MYSQL_NUM)){
			$table_name=$line[0];
			$sql="alter table `$table_name` rename `$pre2".substr($table_name,$p_len)."`";
			$db->query($sql);
		}
	}
	file::write($sys_config_file,'<?php !defined(\'IN_JB\')&&exit(\'ERROR\');$config='.string::format_array($config).';?>');
	admin::show_message('系统设置修改成功！');
}
?>