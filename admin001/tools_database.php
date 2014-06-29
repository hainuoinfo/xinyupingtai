<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
$method || $method='sql';
if($download){
	$file=d('./data/sql/backup/'.$download);
	file::download($file);
	exit;
}
switch($method){
	case 'sql':
		if(($sql=$_POST['sql'])&&DB_CONNECT===true){
			checkWrite();
			$db->query_halt=false;
			$sql=stripslashes($sql);
			$sql_list=explode(';',$sql);
			foreach($sql_list as $run){
				if($run=trim($run)){
					if(($s=strpos($run,' '))!==false){
						$sql_pre=strtoupper(substr($run,0,$s));
						$show=false;
						if ($sql_pre == 'EXPLAIN') $sql_pre = 'SELECT';
						switch($sql_pre){
							case 'USE':
								$db->query($run);
							break;
							case 'SELECT':
								$query=$db->query($run);
								if($rs_count=$db->num_rows($query)){
									$fields_name=$db->get_fields_name($query);
									$columns_count=count($fields_name);
									$show_result.='<table border="1" cellpadding="0" cellspacing="0" style="white-space: pre"><tr>';
									foreach($fields_name as $v){
										$show_result.='<td>'.$v.'</td>';
									}
									$show_result.='</tr>';
									while($line=$db->fetch_array($query)){
										//$show_result.="\n";
										//$show_result.=implode("\t",$line);
										$show_result.='<tr>';
										foreach($line as $v){
											$show_result.='<td>'.$v.'</td>';
										}
										$show_result.='</tr>';
									}
									//$show_result.="\n\n共：$rs_count 条";
									$show_result.='<tr><td colspan="'.$columns_count.'">共：'.$rs_count.' 条</td></tr></table>';
								} else {
									$show_result.='<table border="1" cellpadding="0" cellspacing="0"><tr><td>共：0 条</td></tr></table>';
								}
							break;
							case 'SHOW':
								$query=$db->query($run);
								if($rs_count=$db->num_rows($query)){
									$fields_name=$db->get_fields_name($query);
									$columns_count=count($fields_name);
									$show_result.='<table border="1" cellpadding="0" cellspacing="0" style="white-space: pre"><tr>';
									foreach($fields_name as $v){
										$show_result.='<td>'.$v.'</td>';
									}
									$show_result.='</tr>';
									while($line=$db->fetch_array($query)){
										//$show_result.="\n";
										//$show_result.=implode("\t",$line);
										$show_result.='<tr>';
										foreach($line as $v){
											$show_result.='<td>'.$v.'</td>';
										}
										$show_result.='</tr>';
									}
									//$show_result.="\n\n共：$rs_count 条";
									$show_result.='<tr><td colspan="'.$columns_count.'">共：'.$rs_count.' 条</td></tr></table>';
								} else {
									$show_result.='<table border="1" cellpadding="0" cellspacing="0"><tr><td>共：0 条</td></tr></table>';
								}
							break;
							case 'INSERT':
								$db->query($run);
								$show_result.='<table border="1" cellpadding="0" cellspacing="0"><tr><td>共影响：'.$db->affected_rows().' 条</td></tr></table>';
							break;
							case 'UPDATE':
								$show=false;
								$db->query($run);
								$show_result.='<table border="1" cellpadding="0" cellspacing="0"><tr><td>共影响：'.$db->affected_rows().' 条</td></tr></table>';
							break;
							default:
								$db->query($run);
							break;
						}
						if($errno=$db->errno()){
							$show_result.='<table border="1" cellpadding="0" cellspacing="0"><tr><td>'.$errno.'：'.$db->error().'</td></tr></table>';
						}
						switch($sql_pre){
							case 'CREATE':
								if($errno)$show_result.='<table border="1" cellpadding="0" cellspacing="0"><tr><td>创建表失败</td></tr></table>';
								else $show_result.='<table border="1" cellpadding="0" cellspacing="0"><tr><td>创建表成功</td></tr></table>';
							break;
						}
					}
				}
			}
		}
		$sqlList1 = $sqlList2 = array();
		$query = $db->query("select * from {$pre}sql_log order by timestamp desc");
		while ($line = $db->fetch_array($query)) {
			$sqlList1[$line['id']] = $line['sql'];
			$sqlList2[$line['id']] = $line['name'];
		}
	break;
	case 'import':
		if($del){
			checkWrite();
			@unlink(WROOT.'./data/sql/backup/'.$del);
		}
		if(!$import&&!$complate){
			checkWrite();
			if($list=file::list_files('./data/sql/backup/')){
				foreach($list as $v){
					$file=d('./data/sql/backup/'.$v);
					$sql_file_list[]=array('name'=>$v,'file_size'=>filesize($file),'filemtime'=>date('Y-m-d H:is',filemtime($file)));
				}
			}
		} elseif(!$complate) {
			checkWrite();
			if(DB_CONNECT===true){
				$ln = chr(10);
				$encoding || ($encoding = ENCODING);
				$sqlFile = d('./data/sql/backup/'.$import);
				if($f = fopen($sqlFile, 'rb')){
					$sql = '';
					while (!feof($f)) {
						$str = fgets($f);
						if (substr($str, -2)==';'.$ln) {
							$sql .= substr($str, 0, -2);
							$db->query($sql);
							$sql = '';
						} else {
							$sql .= $str;
						}
					}
					fclose($f);
				} else {
					admin::show_message('读取SQL文件失败');
				}
				/*if($sql=file::read($sqlFile)){
					$encoding!=ENCODING&&($sql=iconv($encoding,ENCODING,$sql));
					$sql_list=explode(';',$sql);
					foreach($sql_list as $sql){
						if($sql=trim($sql))$db->query($sql);
					}
				}*/
			}
			common::goto_url($nowurl.'&complate=true',true);
		}
	break;
	case 'export':
		if($post_data && ($save_name = $_POST['save_name']) && ($tables = $_POST['backup_tables'])){
			checkWrite();
			$ln = chr(10);
			$savePath = d('./data/sql/backup/');
			common::create_folder($savePath);
			$saveFile = d($savePath.$save_name.'.sql');
			$f=fopen($saveFile, 'wb');
			foreach($tables as $v){
				$rs=$db->fetch_first("show create table `$v`");
				if($rs['Create Table']){
					fwrite($f,'drop table if exists `'.$rs['Table'].'`;'.$ln);
					fwrite($f,$rs['Create Table'].';'.$ln);
					if($db->result_first("select count(*) from `$v`")>0){
						$query=$db->query("select * from `$v`");
						$fields_name=$db->get_fields_name($query);
						//fwrite($f,"insert into `$v`(`".implode('`,`',$fields_name)."`) values");
						//fwrite($f,"insert into `$v` values");
						$insert_one=true;
						while($line=$db->fetch_array($query)){
							//!$insert_one&&(fwrite($f,','));
							//$line=common::bf_addslashes($line);
							foreach($line as $k2=>$v2){
								if(is_numeric($v2)){
									$line[$k2] = '\''.$v2.'\'';
								} else {
									$hex = string::str_hex($v2);
									if($hex != '')$line[$k2] = '0x'.$hex;
									else $line[$k2] = '\'\'';
								}
							}
							//fwrite($f,"('".implode("','",$line)."')");
							fwrite($f, 'insert into `'.$v.'` values('.implode(",",$line).');'.$ln);
							$insert_one=false;
						}
						//fwrite($f,';'.$ln);
					}
				}
			}
			fclose($f);
			common::goto_url($nowurl.'&complate='.base64_encode($save_name),true);
		}
		if(!$complate){
			checkWrite();
			$query=$db->query('show tables');
			while($line=$db->fetch_array($query,MYSQL_NUM)){
				$tables[]=$line[0];
			}
		} else $complate=base64_decode($complate);
	break;
}
?>