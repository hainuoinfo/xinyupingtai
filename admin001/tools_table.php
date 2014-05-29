<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
(!defined('DB_CONNECT') || DB_CONNECT !== true) && admin::show_message('数据库没有链接，不能操作！');
$method || $method='index';
$edit && $method='edit';
$replace && $method = 'replace';
set_time_limit(0);
switch($method){
	case 'index':
		if(form::is_form_hash()){
			if($del=$_POST['del']) {
				foreach($del as $v) {
					$db->query("drop table $v");
				}
			}
			common::refresh();
		}
		$list=array();
		$query=$db->query("show tables",MYSQL_NUM);
		$pre_len=strlen($pre);
		while($table0=$db->fetch_array_first($query)){
			//$table1=preg_replace("/^$pre/",'<span style="color:red">'.$pre.'</span>',$table0);
			if(substr($table0,0,$pre_len)==$pre)$table1='<span style="color:red">'.$pre.'</span>'.substr($table0,$pre_len);
			else $table1='<span style="color:green">'.$table0.'</span>';
			$list[]=array('table0'=>$table0,'table1'=>$table1);
		}
	break;
	case 'edit':
		if($line=$db->fetch_first("show create table `$edit`")){
			$create_info=$line['Create Table'];
			/*if(preg_match('/^[^(]*\((.+)\)[^)]*$/s',$create_info,$matches)){
				if(preg_match('/^(.+?)((?:PRIMARY\s)?KEY\s\(.*?)?$/s',$matches[1],$matches)){
					print_r($matches);exit;
				}
			}*/
		}
	break;
	case 'replace':
		if (form::is_form_hash()) {
			extract($_POST);
			if ($source && $destination) {
				if($line=$db->fetch_first_all("SELECT COLUMN_NAME
FROM  `information_schema`.`COLUMNS` 
where `TABLE_SCHEMA`='$config[db_name]' and `TABLE_NAME`='$replace' and (DATA_TYPE='varchar' or DATA_TYPE='text' or DATA_TYPE='char' or DATA_TYPE='tinytext' or DATA_TYPE='bigtext' or DATA_TYPE='mediumtext')
order by COLUMN_NAME;")){
					$rs = array();
					foreach ($line as $v) {
						$sql = "update `$replace` set `$v`=replace(`$v`,'$source','$destination')";
						$rs[$v] = $db->query_unbuffered($sql);
					}
					$msg = '';
					foreach ($rs as $k => $v) {
						$msg && $msg .= '<br />';
						$msg .= $k.':更新了'.$v.'条';
					}
					$msg = '更新表《'.$replace.'》中字段结果如下：<br />'.$msg;
					admin::show_message($msg);
				}
			} else {
				$info = '参数错误';
			}
		}
	break;
	case 'replaceAll':
		if (form::is_form_hash()) {
			extract($_POST);
			if ($source && $destination) {
				$query = $db->query("show tables like '$pre%'");
				$rs = array();
				while ($tableName = $db->fetch_array_first($query)) {
					if($line=$db->fetch_first_all("SELECT COLUMN_NAME
FROM  `information_schema`.`COLUMNS` 
where `TABLE_SCHEMA`='$config[db_name]' and `TABLE_NAME`='$tableName' and (DATA_TYPE='varchar' or DATA_TYPE='text' or DATA_TYPE='char' or DATA_TYPE='tinytext' or DATA_TYPE='bigtext' or DATA_TYPE='mediumtext')
order by COLUMN_NAME;")){
						foreach ($line as $v) {
							$sql = "update `$tableName` set `$v`=replace(`$v`,'$source','$destination')";
							$rs[$tableName][$v] = $db->query_unbuffered($sql);
						}
					}
				}
				$msg = '';
				foreach ($rs as $k => $v) {
					$msg .= '表：'.$k;
					foreach ($v as $k2 => $v2) {
						$msg && $msg .= '<br />';
						$msg .= $k2.':更新了'.$v2.'条';
					}
					$msg .= '<br /><br />';
				}
				$msg = '所有表中字段替换结果如下：<br />'.$msg;
				admin::show_message($msg);
			} else {
				$info = '参数错误';
			}
		}
	break;
}
?>