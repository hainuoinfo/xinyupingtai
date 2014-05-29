<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
loadLib('member.base');
$top_menu=array(
	'index' => '管理员列表',
	'add'   => '添加管理员',
	'edit'  => array('name' => '编辑管理员', 'hide' => true)
);
if($edit=(int)$edit)$method='edit';
if ($view = (int)$view)$method = 'view';
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
$tbName = 'admins';
switch($method) {
	case 'index':
		admin::getList($tbName);
	break;
	case 'add':
		if (form::is_form_hash()) {
			$datas = form::get2('username', 'password', 'keys');
			$datas && $datas = common::filterHtml($datas);
			$datas && extract($datas);
			if ($username && $password && $keys) {
				if ($username == $config['sys_user'] || db::exists($tbName, array('username' => $username))) {
					admin::show_message('对不起，该帐号已经存在了');
				}
				$keys2 = array();
				foreach ($keys as $k => $v) {
					$val = 0;
					foreach ($v as $v2) {
						$v2 = (int)$v2;
						$val |= 0xFFFFFFFF & 1 << $v2 - 1;
					}
					$keys2[$k] = $val;
				}
				
				$salt = common::salt();
				$password = common::salt_pwd($salt, $password);
				if ($aid = db::insert($tbName, array(
					'username'           => $username,
					'salt'               => $salt,
					'password'           => $password,
					'regTimestamp'       => $timestamp,
					'lastLoginTimestamp' => 0,
					'loginTimes'         => 0
				), true)) {
					$values = '';
					foreach ($keys2 as $k => $v) {
						$values && $values .= ',';
						$values .= '(\''.$aid.'\', \''.$k.'\', \''.$v.'\')';
					}
					db::query("insert into {$pre}admin_authority values$values");
					admin::show_message('添加成功', $base_url.'&method=index');
				} else {
					admin::show_message('添加失败！！');
				}
			} else {
				admin::show_message('参数错误！！');
			}
		}
	break;
	case 'edit':
		if (form::is_form_hash()) {
			$aid = $edit;
			$datas = form::get2('username', 'password', 'keys');
			$datas && $datas = common::filterHtml($datas);
			$datas && extract($datas);
			if ($username && $keys) {
				if ($username == $config['sys_user'] || db::exists($tbName, "username='$username' and id<>'$edit'")) {
					admin::show_message('对不起，该帐号已经存在了');
				}
				$keys2 = array();
				foreach ($keys as $k => $v) {
					$val = 0;
					foreach ($v as $v2) {
						$v2 = (int)$v2;
						$val |= 0xFFFFFFFF & 1 << $v2 - 1;
					}
					$keys2[$k] = $val;
				}
				$args = array(
					'username' => $username
				);
				if ($password) {
					$salt     = db::one_one($tbName, 'salt', "id='$aid'");
					$password = common::salt_pwd($salt, $password);
					$args['password'] = $password;
				}
				if (db::update($tbName, $args, "id='$aid'")) {
					db::del_key('admin_authority', 'aid', $aid);
					$values = '';
					foreach ($keys2 as $k => $v) {
						$values && $values .= ',';
						$values .= '(\''.$aid.'\', \''.$k.'\', \''.$v.'\')';
					}
					db::query("insert into {$pre}admin_authority values$values");
					admin::show_message('修改成功', $base_url.'&method=index');
				} else {
					admin::show_message('修改失败！！');
				}
			} else {
				admin::show_message('参数错误！！');
			}
		}
		$keys = array();
		if ($username = db::one_one($tbName, 'username', "id='$edit'")) {
			if ($line = db::get_list('admin_authority', '`key`,value', "aid='$edit'", '', 0)) {
				foreach ($line as $v) {
					$val = (int)$v['value'];
					for ($i = 0; $i < 32; $i++) {
						if ($val & 1 << $i) $keys[$v['key']][$i] = $i + 1;
					}
				}
			}
		}
	break;
}
?>