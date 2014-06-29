<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'lib.php');
empty($type) && $type = '';
define('UP_ROOT', dirname(__FILE__).D);
define('UP_DATA_ROOT', UP_ROOT.'datas'.D);
replaceFiles(WROOT, UP_DATA_ROOT.'replace', false);
$fields = $db->fetch_first_all("SELECT COLUMN_NAME
FROM  `information_schema`.`COLUMNS` 
where `TABLE_SCHEMA`='$config[db_name]' and `TABLE_NAME`='{$pre}buyers'
order by COLUMN_NAME;");
if (!in_array('hasShop', $fields)) {
	db::query("ALTER TABLE `{$pre}buyers` ADD hasShop tinyint unsigned NOT NULL DEFAULT '0'");
}//升级买号字段
$fields = $db->fetch_first_all("SELECT COLUMN_NAME
FROM  `information_schema`.`COLUMNS` 
where `TABLE_SCHEMA`='$config[db_name]' and `TABLE_NAME`='{$pre}task'
order by COLUMN_NAME;");
if (!in_array('realname', $fields)) {
	db::query("ALTER TABLE `{$pre}task` ADD realname tinyint unsigned NOT NULL DEFAULT '0' AFTER isReal");
}
if ($type == 'all') {
	$query = db::query("SELECT id,nickname FROM `{$pre}buyers`");
	while ($line = db::fetch($query)) {
		$info = data_taobaoUser::getUser($line['nickname']);
		db::update('buyers', array('hasShop' => $info['has_shop'] == 'true' ? 1 : 0), "id='$line[id]'");
	}
}
echo '升级完成！';
?>