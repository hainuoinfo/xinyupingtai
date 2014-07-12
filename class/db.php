<?php
if(DB_CONNECT !== true){
     common :: char_set();
     common :: show_message('mysql database cannot connected!');
    }
class db{
     public static function table($tableName){
         return PRE . $tableName;
         }
     public static function get_insert($arr, $null = true){
         if($arr){
             foreach($arr as $k => $v){
                 if(($v = trim($v)) == '' && !$null)continue;
                 if($rn)$rn .= ',';
                 $rn .= "`$k`='$v'";
                 }
             return $rn;
             }
         }
     public static function query($sql){
         global $db;
         return $db -> query($sql);
         }
     public static function querys($sqls){
         global $db;
         $sp = explode(';', $sqls);
         foreach ($sp as $sql){
             if ($sql = trim($sql)){
                 $db -> query($sql);
                 }
             }
         }
     public static function fetch($query, $result_type = MYSQL_ASSOC){
         global $db;
         return $db -> fetch_array($query, $result_type);
         }
     public static function fetchAll($sql, $result_type = MYSQL_ASSOC){
         global $db;
         return $db -> fetch_all($sql, $result_type);
         }
     public static function fetchArrayFirst($query, $result_type = MYSQL_ASSOC){
         global $db;
         return $db -> fetch_array_first($query, $result_type);
         }
     public static function fetchFirst($sql){
         global $db;
         return $db -> fetch_first($sql);
         }
     public static function resultFirst($sql){
         global $db;
         return $db -> result_first($sql);
         }
     public static function insert($tbname, $args, $return_insert_id = false){
         global $pre, $db;
         $insert = '';
         if(is_array($args) && count($args) > 0){
             $keys = '';
             $vals = '';
             foreach($args as $k => $v){
                 $keys && $keys .= ',';
                 $keys .= '`' . $k . '`';
                 $vals && $vals .= ',';
                 $vals .= '\'' . $v . '\'';
                 }
             $insert = "($keys) values($vals)";
             }else{
             $insert = trim($args);
             if(substr($insert, 0, 1) != '('){
                 strtolower(substr($insert, 0, 3)) != 'set' && $insert = 'set ' . $insert;
                 $insert = ' ' . $insert;
                 }
             }
         if($insert){
             $insert = 'insert into ' . $pre . $tbname . $insert;
             if($db -> query($insert)){
                 if($return_insert_id)
                     return $db -> insert_id();
                 else
                     return true;
                 }
             }
        else
             return false;
         }
     public static function insert2($tbname, $args, $return_insert_id = false){
         global $db, $pre;
         $db -> query("lock table `$pre$tbname` write");
        /**
         * $oid_pre=date('YmdHis',time());
         * $i=0;
         * $i_suffix=sprintf('%06d',$i);
         * while(db::exists($tbname,"id='$db_pre$i_suffix'")){
         * $i++;
         * $i_suffix=sprintf('%06d',$i);
         * }
         * $oid=$oid_pre.$i_suffix;
         */
         do{
             $id = self :: createId();
             } while(db :: exists($tbname, array('id' => $id)));
         $args = array_merge(array('id' => $id), $args);
         self :: insert($tbname, $args);
         $db -> query("unlock tables");
         if($return_insert_id)return $id;
         return true;
         }
     private static function createId(){
         list($millisecond, $second) = explode(' ', microtime());
         $millisecond = (float)$millisecond;
         $second = (int)$second;
         $millisecond *= 1000000;
         $millisecond = sprintf('%06d', floor($millisecond));
         // $salt = substr(uniqid(rand()), -5);
        $id = 'TB' . date('mdHis', $second) . $millisecond;
         return $id;
         }
     private static function createPId(){
         list($millisecond, $second) = explode(' ', microtime());
         $millisecond = (float)$millisecond;
         $second = (int)$second;
         $millisecond *= 1000000;
         $millisecond = sprintf('%06d', floor($millisecond));
         // $salt = substr(uniqid(rand()), -5);
        $id = date('YmdHis', $second) . $millisecond;
         return $id;
         }
     public static function update($tbname, $args, $where = '', $count = -1){
         global $pre, $db;
         $set = '';
         if(is_array($args) && count($args) > 0){
             $keys = '';
             $vals = '';
             foreach($args as $k => $v){
                 $set && $set .= ',';
                 $set .= "`$k`='$v'";
                 }
             }else $set = $args;
         strtolower(substr($set, 0, 3)) != 'set' && $set = ' set ' . $set;
         if($set){
             $set = 'update ' . $pre . $tbname . $set . ($where?' where ' . $where:'') . ($count != -1?' limit ' . $count:'');
             return $db -> query($set)?true:false;
             }
         return false;
         }
     public static function replace($tbname, $args, $where = ''){
         global $pre, $db;
         $set = '';
         if(is_array($args) && count($args) > 0){
             $keys = '';
             $vals = '';
             foreach ($args as $k => $v){
                 $set && $set .= ',';
                 $set .= "`$k`='$v'";
                 }
             }else $set = $args;
         strtolower(substr($set, 0, 3)) != 'set' && $set = ' set ' . $set;
         if($set){
             $set = 'replace ' . $pre . $tbname . $set . ($where?' where ' . $where:'');
             return $db -> query($set)?true:false;
             }
         return false;
         }
     public static function delete($tbname, $where){
         global $pre, $db;
         $db -> query("delete from {$pre}$tbname where $where");
         return $db -> affected_rows();
         }
     public static function changeRows(){
         global $db;
         return $db -> affected_rows();
         }
     public static function del_key($tbname, $key, $val){
         return self :: delete($tbname, '`' . $key . '`=\'' . $val . '\'');
         }
     public static function del_keys($tbname, $key, $val){
         if(is_array($val) && count($val) > 0){
             return self :: delete($tbname, '`' . $key . '` in(\'' . implode('\',\'', $val) . '\')');
             }
         return 0;
         }
     public static function del_id($tbname, $id){
         return self :: del_key($tbname, 'id', $id);
         }
     public static function del_ids($tbname, $id){
         return self :: del_keys($tbname, 'id', $id);
         }
     public static function exists($tbname, $args, $f = ''){
         global $pre, $db;
         $where = '';
         if(is_array($args)){
             foreach($args as $k => $v){
                 $where && $where .= ' and ';
                 $where .= '`' . $k . '`=\'' . $v . '\'';
                 $f == '' && $f = $k;
                 }
             }else $where = $args;
         $f || $f = '*';
         return $db -> fetch_first("select $f from {$pre}$tbname where $where")?true:false;
         }
     public static function data_count($tbname, $where = ''){
         global $pre, $db;
         $sql = "select count(*) from {$pre}$tbname" . ($where?' where ' . $where:'');
         return $db -> result_first($sql);
         }
     public static function one($tbname, $f = '*', $where = '', $order = ''){
         global $db, $pre;
         $where && $where = ' where ' . $where;
         $order && $order = ' order by ' . $order;
         return $db -> fetch_first("select $f from $pre$tbname$where$order limit 1");
         }
     public static function one_one($tbname, $f = '*', $where = '', $order = ''){
         global $db, $pre;
         $where && $where = ' where ' . $where;
         $order && $order = ' order by ' . $order;
         $sql = "select $f from $pre$tbname$where$order limit 1";
         return $db -> result_first($sql);
         }
     public static function get_list($tbname, $f = '*', $where = '', $order = '', $page = 1, $pagesize = 20){
         global $db, $pre;
         $where && $where = ' where ' . $where;
         $order && $order = ' order by ' . $order;
         $limit = '';
         $page > 0 && $limit = ' limit ' . ($page-1) * $pagesize . ',' . $pagesize;
         return $db -> fetch_all("select $f from $pre$tbname$where$order$limit");
         }
     public static function get_list2($tbname, $f = '*', $where = '', $order = '', $page = 1, $pagesize = 20){
         global $db, $pre;
         $where && $where = ' where ' . $where;
         $order && $order = ' order by ' . $order;
         $limit = '';
         $page > 0 && $limit = ' limit ' . ($page-1) * $pagesize . ',' . $pagesize;
         // 通过where中的用户信息，获取到当前需要的所有日志的id数组
        if($ids = $db -> fetch_first_all("select id from $pre$tbname$where$order$limit")){
             return $db -> fetch_all("select $f from $pre$tbname where id in('" . implode('\',\'', $ids) . "')$order");
             }
         }
     public static function get_list3($tbname, $f = '*', $where = '', $order = '', $page = 1, $pagesize = 4){
         global $db, $pre;
         $where && $where = ' where ' . $where;
         $order && $order = ' order by ' . $order;
         $limit = '';
         $page > 0 && $limit = ' limit ' . ($page-1) * $pagesize . ',' . $pagesize;
         if($ids = $db -> fetch_first_all("select id from $pre$tbname$where$order$limit")){
             return $db -> fetch_all("select $f from $pre$tbname where id in('" . implode('\',\'', $ids) . "')$order");
             }
         }
     public static function get_ids($tbName, $where = '', $page = 0, $pagesize = 0){
         return self :: get_keys($tbName, 'id', $where, $page, $pagesize);
         }
     public static function get_keys($tbName, $key, $where = '', $page = 0, $pagesize = 0){
         global $db, $pre;
         $limit = '';
         $where && $where = ' where ' . $where;
         $order && $order = ' order by ' . $order;
         $page > 0 && $limit = ' limit ' . ($page-1) * $pagesize . ',' . $pagesize;
         return $db -> fetch_first_all("select $key from $pre$tbName$where$order$limit");
         }
     private static function fieldsAddPrefix($fields, $prefix){
         $rn = '';
         $sp = explode(',', $fields);
         foreach ($sp as $v){
             $rn && $rn .= ',';
             $rn .= $prefix . '.' . $v;
             }
         return $rn;
         }
     public static function sqlSelect($tables, $fields, $wheres = false, $orders = false, $pageSize = 0, $page = 0){
         if (strpos($tables, '|') !== false){
             $tablesArr = explode('|', $tables);
             $fieldsArr = $fields != '*' ? explode('|', $fields) : $fields;
             $wheresArr = $wheres ? explode('|', $wheres) : array();
             $ordersArr = $orders ? explode('|', $orders) : array();
             $sql = 'SELECT ';
             // 初始化字段
            if (is_array($fieldsArr)){
                 $tmpFields = '';
                 foreach ($fieldsArr as $k => $v){
                     if ($v){
                         $tmpFields && $tmpFields .= ',';
                         $tmpFields .= self :: fieldsAddPrefix($v, 't' . $k);
                         }
                     }
                 $sql .= $tmpFields;
                 }else{
                 $sql .= $fieldsArr;
                 }
             $tmpTables = '';
             $tmpTableLastAs = '';
             foreach ($tablesArr as $k => $v){
                 $tmpTableAs = 't' . $k;
                 $tmpTables && $tmpTables .= ' LEFT JOIN ';
                 if (strpos($v, ':') !== false){
                     $tmpOn = '';
                     $sp0 = explode(':', $v);
                     $sp1 = explode(',', $sp0[1]);
                     $tmpTables .= (substr($sp0[0], 0, 1) == '(' ? $sp0[0] : self :: table($sp0[0])) . ' AS ' . $tmpTableAs;
                     foreach($sp1 as $v1){
                         $tmpOn && $tmpOn .= ',';
                         list($tmpA, $tmpB) = explode('=', $v1);
                         strpos($tmpA, '.') === false && $tmpA = $tmpTableAs . '.' . $tmpA;
                         strpos($tmpB, '.') === false && $tmpB = $tmpTableLastAs . '.' . $tmpB;
                         $tmpOn .= $tmpA . '=' . $tmpB;
                         }
                     $tmpTables .= ' ON ' . $tmpOn;
                     }else{
                     $tmpTables .= (substr($v, 0, 1) == '(' ? $v : self :: table($v)) . ' AS ' . $tmpTableAs;;
                     }
                 $tmpTableLastAs = $tmpTableAs;
                 }
             $sql .= ' FROM ' . $tmpTables . '';
             $sql .= ($wheres ? ' WHERE ' . $wheres : '') . ($orders ? ' ORDER BY ' . $orders : '');
             $pageSize > 0 && $sql .= ' LIMIT ' . ($page > 0 ? ($page - 1) * $pageSize . ',' : '') . $pageSize;
             }else{
             $sql = 'SELECT ' . $fields . ' FROM ' . self :: table($tables) . ($wheres ? ' WHERE ' . $wheres : '') . ($orders ? ' ORDER BY ' . $orders : '');
             $pageSize > 0 && $sql .= ' LIMIT ' . ($page > 0 ? ($page - 1) * $pageSize . ',' : '') . $pageSize;
             }
         return $sql;
         }
     public static function select($tables, $fields, $wheres = false, $orders = false, $pageSize = 0, $page = 0){
         global $db;
         $sql = self :: sqlSelect($tables, $fields, $wheres, $orders, $pageSize, $page);
         return $db -> fetch_all($sql);
         }
     public static function getFieldsName($query){
         global $db;
         return $db -> get_fields_name($query);
         }
    }
?>