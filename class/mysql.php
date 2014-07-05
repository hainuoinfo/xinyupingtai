<?php
!defined('IN_JB')&&exit('没有权限');
class mysql{

	var $version = '';
	var $querynum = 0;
	var $link = null;
	var $connected=false;
	var $query_halt=true;
	function __construct($dbhost, $dbuser, $dbpw, $dbname = '', $pconnect = 0, $halt = TRUE, $dbcharset = 'utf8') {

		$func = empty($pconnect) ? 'mysql_connect' : 'mysql_pconnect';
		if(!$this->link = @$func($dbhost, $dbuser, $dbpw, 1)) {
			$halt && $this->halt('Can not connect to MySQL server');
		} else {
			$this->connected=true;
			if($this->version() > '4.1') {
				$serverset = $dbcharset ? 'character_set_connection='.$dbcharset.', character_set_results='.$dbcharset.', character_set_client=binary' : '';
				$serverset .= $this->version() > '5.0.1' ? ((empty($serverset) ? '' : ',').'sql_mode=\'\'') : '';
				$serverset && mysql_query("SET $serverset", $this->link);
			}
			$dbname && @mysql_select_db($dbname, $this->link);
		}

	}

	function select_db($dbname) {
		return mysql_select_db($dbname, $this->link);
	}
	function fetch_array_first($query){
		$line=mysql_fetch_array($query,MYSQL_NUM);
		return $line[0];
	}
	function fetch_array($query, $result_type = MYSQL_ASSOC) {
		return mysql_fetch_array($query, $result_type);
	}
	function fetch_all($sql,$result_type = MYSQL_ASSOC){
		$list=array();
		$query=$this->query($sql);
		while($line=$this->fetch_array($query,$result_type)){
			$list[]=$line;
		}
		return $list;
	}
	function fetch_first_all($sql){
		$list=array();
		$query=$this->query($sql);
		while($line=$this->fetch_array($query,MYSQL_NUM)){
			$list[]=$line[0];
		}
		return $list;
	}
	function print_all($sql,$tpl,$result_type = MYSQL_ASSOC){
		$query=$this->query($sql);
		$rn='';
		while($line=$this->fetch_array($query,$result_type)){
			$rn.=preg_replace('/\{([a-zA-Z0-9_]+?)\}/e','$line[$1]',$tpl);
		}
		return $rn;
	}
	function fetch_first($sql) {
		return $this->fetch_array($this->query($sql));
	}

	function result_first($sql) {
		return $this->result($this->query($sql), 0);
	}

	function query($sql, $type = '') {
		$func = $type == 'UNBUFFERED' && @function_exists('mysql_unbuffered_query')?'mysql_unbuffered_query' : 'mysql_query';
		if(!($query = $func($sql, $this->link))) {
			if($this->query_halt){
				if(in_array($this->errno(), array(2006, 2013)) && substr($type, 0, 5) != 'RETRY') {
					$this->close();
					$this->halt('连接超时', $sql);
					return $this->query($sql, 'RETRY'.$type);
				} elseif($type != 'SILENT' && substr($type, 5) != 'SILENT') {
					$this->halt('MySQL Query Error', $sql);
				}
			}
		}
		$this->querynum++;
		return $query;
	}
	function query_unbuffered($sql){
		$this->query($sql,'UNBUFFERED');
		return $this->affected_rows();
	}
	public function get_fields_name($query){
		if(is_resource($query)){
			if($num=mysql_num_fields($query)){
				for($i=0;$i<$num;$i++){
					$rn[]=mysql_field_name($query,$i);
				}
			}
			return $rn;
		}
	}
	function affected_rows($link=NULL) {
		$link||$link=$this->link;
		return mysql_affected_rows($link);
	}

	function error() {
		return (($this->link) ? mysql_error($this->link) : mysql_error());
	}

	function errno() {
		return intval(($this->link) ? mysql_errno($this->link) : mysql_errno());
	}

	function result($query, $row = 0) {
		$query = @mysql_result($query, $row);
		return $query;
	}

	function num_rows($query) {
		$query = mysql_num_rows($query);
		return $query;
	}

	function num_fields($query) {
		return mysql_num_fields($query);
	}

	function free_result($query) {
		return mysql_free_result($query);
	}

	function insert_id() {
		return ($id = mysql_insert_id($this->link)) >= 0 ? $id : $this->result($this->query("SELECT last_insert_id()"), 0);
	}

	function fetch_row($query) {
		$query = mysql_fetch_row($query);
		return $query;
	}

	function fetch_fields($query) {
		return mysql_fetch_field($query);
	}

	function version() {
		if(empty($this->version)) {
			$this->version = mysql_get_server_info($this->link);
		}
		return $this->version;
	}
	
	function __destruct(){
		$this->close();
	}
	
	function close() {
		return mysql_close($this->link);
	}

	public function halt($message, $sql=''){
		$t = time();
		$logDir = d('./cache/error/sql/'.date('Y/m', $t).'/');
		!file_exists($logDir) && common::create_folder($logDir);
		$logFile = $logDir.date('d', $t).'.log';
		error_log(date('Y-m-d H:i:s', $t)."\r\nSQL:\r\n$sql\r\nmessage:\r\n".$this->error()."\r\n\r\n", 3, $logFile);
		common::show_message($message.($sql?' <br />'.$sql:'').'<br />'.$this->error());
	}
}
?>