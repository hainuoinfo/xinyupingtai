<?php
include dirname(__FILE__).DIRECTORY_SEPARATOR.'../class/index.php';
define('ADMIN_ROOT', dirname(__FILE__).D);
global $web_theme;
template::initialize('./templates/default/founder/','./cache/default/founder/');
$admin_url=$weburl.'/'.$config['sys_admin_folder'].'/index.php';
$adminId = 0;
$admin = array();
if ($cookie['admin_login'])
{
	$adminId = $cookie['admin_login'];
	$admin   = admin::get($adminId);
}
else
{
	$admin = array(
		'username' => $config['sys_user']
	);
}
define('IN_ADMIN', $cookie['founder_login'] || $adminId?true:false);
define('IN_FOUNDER', $cookie['founder_login']?true:false);

function checkRead()
{
	global $admin, $action, $operation;
    if (IN_ADMIN === true)
    {
        if (IN_FOUNDER === true)
        {
			return true;
        }
        else
        {
			$key = $action.'_'.$operation;
            if ($admin['authority'][$key] & 1)
			return true;
            else
                admin::show_message('对不起，您没有权限查看该页数据！');
        }
    }
}

function checkWrite()
{
    global $admin, $action, $operation;
    if (IN_ADMIN === true)
    {
        if (IN_FOUNDER === true)
        {
            return true;
        }
        else
        {
			$key = $action.'_'.$operation;
            if ($admin['authority'][$key] & 2)
                return true;
            else
                admin::show_message('对不起，您没有权限修改该页数据！');
        }
    }
}

if (IN_ADMIN === true)
{
	admin::updateLogin();
	//$_GET&&extract($_GET);
    if ($action == 'logout')
    {
		//common::setcookie("founder_login",'');
		admin::logout();
		common::goto_url($admin_url,true);
	}
	$defTab = 'sys';
	$menus=array(
		'sys'=>array(
			'name'=>'系统设置',
			'sub'=>array(
				'nav'        => '后台导航设置',
				'setting'    => '系统设置',
				'founder'    => '修改创始人',
				'base'       => '基本设置',
				'var'        => '系统变量',
				'cfg'        => '配置管理',
				'tpl'        => '模板解析标记',
//				'js'         => 'JS文件库',
//				'css'        => 'CSS文件库',
//				'clearTpl'   => '清理不相关模板',
				'reg'        => '注册相关',
				'credits'    => '积分相关',
				'kefu'       => '客服管理',
				'help'       => '帮助中心',
				'menu'       => array('name' => '菜单', 'hide' => true),
				'e_question' => '考试系统',
				'from'       => '来路管理',
				'express'    => '快递管理'
			)
		),
		'user'=>array(
			'name'=>'用户管理',
			'sub'=>array(
				'user'  => '普通用户管理',
				'group' => '普通用户组',
				'admin' => '管理员列表'
			)
		),
		'data'=>array(
			'name'=>'数据管理',
			'sub' =>array(
				'block'       => '模板数据块',
				'pageArticle' => '页面信息管理',
				'article'     => '文章管理',
				'ad'          => '广告管理'
			)
		),
		'tools'=>array(
			'name'=>'工具',
			'sub'=>array(
				'database' => '数据库管理',
				'table'    => '数据表管理',
				'sql'      => '通用SQL语句',
				'cache'    => '更新缓存',
				'js'       => 'JS工具',
				'strFind'  => '模板字符查找替换'
			)
		),
		'info'=>array(
			'name'=>'信息管理',
			'sub'=>array(
				'related_links' => '友情链接',
				'message'       => '短信管理',
				'email'         => '邮件管理',
				'msg'           => '站内信'
			)
		),
		'bbs'=>array(
			'name'=>'论坛管理',
			'sub'=>array(
//				'settings' => '基本设置',
				'icon'     => '主题图标',
				'index'    => '版块管理'
			)
		),
		'log' => array(
			'name' => '日志管理',
			'sub'  => array(
				'users'   => '用户日志',
				'topup'   => '充值记录',
				'payment' => '提现记录',
				'finance' => '财务报表'
			)
		),
		'i' => array(
			'name' => '前台管理',
			'sub'  => array(
				'rcard'    => '充值卡管理',
				'shop'     => '商品管理',
				'soft'     => '软件管理',
				'collect'     => '收藏管理',
				'rate'     => '流量管理',
				'store'     => '网店托管',
				'bs'       => '掌柜买号管理',
				'task'     => '刷钻任务管理',
				'reflow'   => '来路任务管理',
				'complain' => '申诉处理',
				'ensure'   => '维权处理',
				'club'     => '门派管理',
				'eids'     => 'VIP快递单号',
				'payfor'   => '支付接口'/*,
				'debug'    => '数据核对'*/
			)
		)
	);
	$menus2 = b_nav::getCacheMenus();
	$menus += $menus2;
	unset($menus2);
	$admin_url='index.php';
	$base_url=$admin_url.($action||$operation?'?'.($action?'action='.$action:'').($operation?'&operation='.$operation:''):'');
    if ($action)
    {
		$menu_name=$menus[$action]['name'];
        if ($operation)
        {
			$menu_sub_name=$menus[$action]['sub'][$operation];
			$custom_menu_exists=db::exists('admin_custom_menu',array('action'=>$action,'operation'=>$operation));
            if (file_exists(SCRIPT_ROOT . './' . $action . '_' . $operation . '.php'))
            {
				checkRead();
				include(SCRIPT_ROOT.'./'.$action.'_'.$operation.'.php');
            }
            elseif (file_exists(SCRIPT_ROOT . './' . $action . '.php'))
                include(SCRIPT_ROOT . './' . $action . '.php');
            else
            {
				echo 'action:'.$action.' not exists';
				exit;
			}
            if (template::exists($action . '_' . $operation))
                include(template::load($action . '_' . $operation));
            elseif (template::exists($operation))
                include(template::load($operation));
            else
			include(template::load($action));
        } else
        {
            if (file_exists(SCRIPT_ROOT . './' . $action . '.php'))
                include(SCRIPT_ROOT . './' . $action . '.php');
            else
            {
                echo 'action:' . $action . ' not exists';
                exit;
            }
            include(template::load($action));
        }
    } else
        include template::load('index');
} else
{
	//没有登录
    if (($error = admin::login()) === true)
    {
		common::refresh();
	}
	common::nocache();
	include template::load('login');
}
?>