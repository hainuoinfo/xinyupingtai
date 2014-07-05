<?php
!defined('IN_JB')&&exit('没有权限');
class database{
	public static $mysql_field_type=array(
		array(
			'name'=>'TINYINT',
			'byte'=>'1 字节',
			'type'=>0
		),
		array(
			'name'=>'SMALLINT',
			'byte'=>'2 字节',
			'type'=>0
		),
		array(
			'name'=>'MEDIUMINT',
			'byte'=>'3 字节',
			'type'=>0
		),
		array(
			'name'=>'INT',
			'byte'=>'4 字节',
			'type'=>0
		),
		array(
			'name'=>'INTEGER',
			'byte'=>'4 字节',
			'type'=>0
		),
		array(
			'name'=>'BIGINT',
			'byte'=>'8 字节',
			'type'=>0
		),
		array(
			'name'=>'FLOAT(X)',
			'byte'=>'4字节(X<=24)或8字节(25<=X<=53)',
			'X'=>array(0,53),
			'type'=>0
		),
		array(
			'name'=>'FLOAT',
			'byte'=>'4 字节',
			'type'=>0
		),
		array(
			'name'=>'DOUBLE',
			'byte'=>'8 字节',
			'type'=>0
		),
		array(
			'name'=>'DOUBLE PRECISION',
			'byte'=>'8 字节',
			'type'=>0
		),
		array(
			'name'=>'REAL',
			'byte'=>'8 字节',
			'type'=>0
		),
		array(
			'name'=>'DECIMAL(M,D)',
			'byte'=>'M字节(M>=D)或D+2字节(M<D)',
			'type'=>0
		),
		array(
			'name'=>'NUMERIC(M,D)',
			'byte'=>'M字节(M>=D)或D+2字节(M<D)',
			'type'=>0
		),
		array(
			'name'=>'DATE',
			'byte'=>'3 字节',
			'type'=>1
		),
		array(
			'name'=>'DATETIME',
			'byte'=>'8 字节',
			'type'=>1
		),
		array(
			'name'=>'TIMESTAMP',
			'byte'=>'4 字节',
			'type'=>1
		),
		array(
			'name'=>'TIME',
			'byte'=>'3 字节',
			'type'=>1
		),
		array(
			'name'=>'YEAR',
			'byte'=>'1 字节',
			'type'=>1
		),
		array(
			'name'=>'CHAR(M)',
			'byte'=>'M字节，1 <= M <= 255 ',
			'M'=>array(1,255),
			'type'=>2
		),
		array(
			'name'=>'VARCHAR(M)',
			'byte'=>"L+1 字节, 在此L <= M和1 <= M <= 255 ",
			'M'=>array(1,255),
			'type'=>2
		),
		array(
			'name'=>'TINYTEXT',
			'byte'=>"L+1 字节, 在此L< 2 ^ 8",
			'type'=>2
		),
		array(
			'name'=>'TEXT',
			'byte'=>"L+2 字节, 在此L< 2 ^ 16",
			'type'=>2
		),
		array(
			'name'=>'MEDIUMTEXT',
			'byte'=>"L+3 字节, 在此L< 2 ^ 24",
			'type'=>2
		),
		array(
			'name'=>'LONGTEXT',
			'byte'=>"L+4 字节, 在此L< 2 ^ 32",
			'type'=>2
		),
		array(
			'name'=>'ENUM(\'value1\',\'value2\',...)',
			'byte'=>"1 或 2 个字节, 取决于枚举值的数目(最大值65535）",
			'type'=>2
		),
		array(
			'name'=>'SET(\'value1\',\'value2\',...)',
			'byte'=>"1，2，3，4或8个字节, 取决于集合成员的数量(最多64个成员）",
			'type'=>2
		),
		array(
			'name'=>'TINYBLOB',
			'byte'=>"L+1 字节, 在此L< 2 ^ 8",
			'type'=>3
		),
		array(
			'name'=>'BLOB',
			'byte'=>"L+2 字节, 在此L< 2 ^ 16",
			'type'=>3
		),
		array(
			'name'=>'MEDIUMBLOB',
			'byte'=>"L+3 字节, 在此L< 2 ^ 24",
			'type'=>3
		),
		array(
			'name'=>'LONGBLOB',
			'byte'=>"L+4 字节, 在此L< 2 ^ 32",
			'type'=>3
		),
	),$mysql_field_type_name=array('数字','日期','字符','二进制');
	public static function split_name($id,$bin=20){
		return str_pad(dechex($id>>$bin),3,'0',STR_PAD_LEFT);
	}
	public static function connect_mysql($host,$user,$password,$dbname='',$port=3306){
		return new mysql($host.':'.$port,$user,$password,$dbname);
	}
	public static function mysql_type_html(){
		javascript::select_lib('jquery');
		$select_html='<select id="field_type"><option>选择类型...</option>';
		$byte_html='<div id="byte_title0" style="display:none"></div>';
		$this_type=-1;
		$field_length_js='var field_length={';
		foreach(self::$mysql_field_type as $k=>$field){
			$byte_html.='<div id="byte_title'.($k+1).'" style="display:none">'.htmlspecialchars($field['byte']).'</div>';
			$this_type!=$field['type']&&($select_html.='<optgroup label="'.self::$mysql_field_type_name[$field['type']].'">')&&($this_type=$field['type']);
			if(preg_match("/^[a-z]+\((.+?)\)$/i",$field['name'],$matches)){
				$sp=explode(',',$matches[1]);
				foreach($sp as $f){
					if($field[$f]){
						$field_length_js.=$f.($k+1).':{min:'.$field[$f][0].',max:'.$field[$f][0].'},';
					}
				}
			}
			$field['name']=htmlspecialchars($field['name']);
			$select_html.='<option value="'.$field['name'].'">'.$field['name'].'</option>';
		}
		$select_html.='</select>';
		$field_length_js.='};';
		$field_length_js=str_replace('},}','}}',$field_length_js);
		javascript::add_code('<script language="javascript">'.$field_length_js.file::class_include_js(__CLASS__,'mysql_field').'</script>');
		$html=$byte_html.'<table>
		<tr>
			<td>字段类型：</td>
			<td><input type="text" name="field_info" id="field_info" /></td>
		</tr>
		<tr>
			<td>选择类型：</td>
			<td>'.$select_html.'</td>
		</tr>
		<tr id="byte_title_tr" style="display:none">
			<td>所需存储：</td>
			<td id="byte_title"></td>
		</tr>
		<tr id="field_other_tr" style="display:none">
			<td>其它选项：</td>
			<td id="field_other"></td>
		</tr>
		</table>
		';
		return $html;
	}
}
?>