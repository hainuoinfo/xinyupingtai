<?php
(!defined('IN_ADMIN') || IN_ADMIN!==true) && die('error');
$top_menu=array(
	'index' => '问题列表',
	'add'   => '添加提问',
	'edit'  => array('name' => '编辑分类', 'isHide' => true)
);
if($edit=(int)$edit)$method='edit';
$top_menu_key = array_keys($top_menu);
($method && in_array($method,$top_menu_key)) || $method=$top_menu_key[0];
switch($method){
	case 'index':
		/*if (form::is_form_hash()) {
			extract($_POST);
			if ($del) {
				kefu::delCate($del);
				admin::show_message('删除完毕', $base_url);
			}
			kefu::setSort($ids, $sort);
			admin::show_message('设置排序完成', $base_url);
		}
		if ($total = db::data_count('e_question')) {
			$list = db::get_list('e_question', '*', '', 'sort,timestamp desc', $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $base_url.'&page={page}', $pagestyle);
		}*/
		admin::getList('e_question');
	break;
	case 'add':
		if (form::is_form_hash()) {
			extract($_POST);
			$multi = count($answer) > 1?true:false;
			$a = 0;
			foreach ($answer as $v) {
				$a |= 1 << ($v);
			}
			$answer = $a;
			if ($eid = db::insert('e_question', array(
				'title'     => $question,
				'answer'    => $answer,
				'multi'     => $multi?1:0,
				'timestamp' => $timestamp
			), true)) {
				foreach ($select as $k => $v) {
					db::insert('e_select', array(
						'eid'   => $eid,
						'sort'  => $k,
						'title' => $v
					));
				}
				admin::show_message('添加成功', $base_url);
			} else {
				admin::show_message('插入数据库失败，请重试！');
			}
		}
	break;
	case 'edit':
		if (form::is_form_hash()) {
			extract($_POST);
			$multi = count($answer) > 1?true:false;
			$a = 0;
			foreach ($answer as $v) {
				$a |= 1 << ($v);
			}
			$answer = $a;
			if (db::update('e_question', array(
				'title'     => $question,
				'answer'    => $answer,
				'multi'     => $multi?1:0,
				'timestamp' => $timestamp
			), "id='$edit'")) {
				db::del_key('e_select', 'eid', $edit);
				foreach ($select as $k => $v) {
					db::insert('e_select', array(
						'eid'   => $edit,
						'sort'  => $k,
						'title' => $v
					));
				}
				admin::show_message('编辑成功', $base_url);
			} else {
				admin::show_message('更新数据库失败，请重试！');
			}
		}
		$update = false;
		if ($questionInfo = db::one('e_question', '*', "id='$edit'")) {
			$selectList = db::get_list('e_select', '*', "eid='$edit'", 'sort');
			$update = true;
		}
	break;
}
?>