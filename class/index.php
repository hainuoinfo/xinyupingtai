<?php
error_reporting(0);
header("Content-Type:text/html;charset=utf-8");
set_magic_quotes_runtime(0);
define('VERSION', '1.0');
define('SYSTEM_NAME', '优科网络互刷系统');
define('D', DIRECTORY_SEPARATOR);
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
$_SERVER['DOCUMENT_ROOT'] = D_R($_SERVER['DOCUMENT_ROOT']);
$_SERVER['SCRIPT_FILENAME'] = D_R($_SERVER['SCRIPT_FILENAME']);
define('SCRIPT_ROOT', dirname($_SERVER['SCRIPT_FILENAME']) . D); //执行文件的目录
define('WEB_ROOT', $_SERVER['DOCUMENT_ROOT'] . D); //根目录
define('isLinux', substr(WEB_ROOT, 0, 1) == '/');
define('COMMON_ROOT', dirname(__FILE__) . D); //配置目录
define('ENCODING', 'utf-8');
define('IN_JB', true);
define('ZLIB', extension_loaded('zlib') && function_exists('gzinflate'));
if (ZLIB) { //先判断一下是否支持zlib扩展
    ini_set('zlib.output_compression', 'Off');
    ini_set('zlib.output_compression_level', '9');
}

if ($acceptEncoding = $_SERVER['HTTP_ACCEPT_ENCODING']) {
    $sp = explode(',', $acceptEncoding);
    foreach ($sp as $v) {
        if ($v = strtoupper(trim($v))) {
            define('ACCEPT_ENCODING_' . $v, true);
        }
    }
    unset($sp, $v);
} else {
    define('ACCEPT_ENCODING_GZIP', false);
    define('ACCEPT_ENCODING_DEFLATE', false);
}
mb_internal_encoding(ENCODING);
$this_dirname = D_R(dirname(__FILE__));
$find = strrpos($this_dirname, D);
if ($find !== false) {
    $this_dirname = substr($this_dirname, 0, $find);
    define('WROOT', $this_dirname . D); //网站目录
    define('WEB_FOLDER', $this_dirname != $_SERVER['DOCUMENT_ROOT'] && $_SERVER['DOCUMENT_ROOT'] != '' ? str_replace(D, '/', substr($this_dirname, strlen($_SERVER['DOCUMENT_ROOT']) + 1)) : '');
}
define('PLUGIN_ROOT', WROOT . 'plugins' . D); //插件根目录
$weburl = "http://" . $_SERVER['HTTP_HOST'];
if ($_SERVER['HTTP_X_REWRITE_URL']) {
    if (substr($_SERVER['HTTP_X_REWRITE_URL'], 0, 21) == '/rewrite.php?rewrite=') {
        $_SERVER['HTTP_X_REWRITE_URL'] = substr($_SERVER['HTTP_X_REWRITE_URL'], 21);
        $__sp = explode('&', $_SERVER['HTTP_X_REWRITE_URL']);
        $_SERVER['HTTP_X_REWRITE_URL'] = $__sp[0];
        unset($__sp[0]);
        $__sp = array_filter($__sp);
        if (count($__sp) > 0) $_SERVER['HTTP_X_REWRITE_URL'] .= '?' . implode('&', $__sp);
        unset($__sp);
    }
    $nowurl = $weburl . $_SERVER['HTTP_X_REWRITE_URL'];
} else $nowurl = $weburl . $_SERVER['REQUEST_URI'];
$rooturl = $weburl;
$weburl2 = '/';
defined('WEB_FOLDER') && WEB_FOLDER && ($weburl .= '/' . WEB_FOLDER) && $weburl2 .= WEB_FOLDER . '/';
$weburl3 = substr($weburl2, 0, -1);
function D_R($s)
{
    if (DIRECTORY_SEPARATOR == '/') return str_replace('\\', '/', $s);
    return str_replace('/', '\\', $s);
}

function __autoload($name)
{
    $class_file = d('./class/' . $name . '.php');
    if (file_exists($class_file)) {
        include($class_file);
    } else {
        if (strpos($name, '_') !== false) {
            $name = strtr($name, '_', '.');
            if (!loadLib($name)) {
                //exit('class '.$name.' not include');
                return false;
            }
        } else {
            //exit('class '.$name.' not include');
            return false;
        }
    }
}

function loadLib($libName, $returnClass = false)
{
    global $_libraryLoadLog;
    if (!isset($_libraryLoadLog[$libName])) {
        $libPath = WROOT . 'class' . D . strtr($libName, '.', D) . '.php';
        if (file_exists($libPath)) {
            if (($f = strrpos($libName, '.')) !== false) {
                $libP = substr($libName, 0, $f) . '.'; //library parent
            } else {
                $libP = '';
            }
            include($libPath);
            $_libraryLoadLog[$libName] = strtr($libName, '.', '_');
        } else {
            $_libraryLoadLog[$libName] = '';
        }
    }
    if ($_libraryLoadLog[$libName]) {
        if ($returnClass) {
            $className = $_libraryLoadLog[$libName];
            $class = new $className();
            return $class;
        } else {
            return true;
        }
    }
    return false;
}

function loadFunc($funcName)
{
    global $_functionLoadLog;
    if (!isset($_functionLoadLog[$funcName])) {
        $libPath = WROOT . 'function' . D . strtr($funcName, '.', D) . '.php';
        if (file_exists($libPath)) {
            include($libPath);
            $_functionLoadLog[$funcName] = strtr($funcName, '.', '_');
        } else {
            $_libraryLoadLog[$funcName] = '';
        }
    }
    if ($_functionLoadLog[$funcName]) {
        return true;
    }
    return false;
}

function d($path, $simple = true)
{
    $path2 = $prefix = $suffix = '';
    $path = strtr($path, '\\', '/');
    $flag1 = substr($path, 0, 1);
    if ($flag1 == '/' && isLinux === true) return $path;
    if ($simple) {
        if ($flag1 == '/') {
            $prefix = WEB_ROOT;
            $path = substr($path, 1);
        } elseif ($flag1 == '.' && substr($path, 1, 1) == '/') {
            $prefix = WROOT;
            $path = substr($path, 2);
        }
        $path = strtr($path, '/', D);
        return $prefix . $path;
    }
    $find = false;
    if ($flag1 == '/') {
        $prefix = WROOT;
        $path = substr($path, 1);
    } elseif ($flag1 == '.' && substr($path, 1, 1) == '/') {
        $prefix = WEB_ROOT;
        $path = substr($path, 2);
    }
    if (substr($path, -1) == '/') {
        $suffix = D;
        $path = substr($path, 0, -1);
    } else {
        $find = strrpos($path, '/');
        $suffix = D . substr($path, $find + 1);
        $path = substr($path, 0, $find);
    }
    $folders = explode('/', $path);
    foreach ($folders as $folder) {
        if ($folder == '.') {
            //ignore
        } elseif ($folder == '..') {
            if (($find = strrpos($path2, D)) !== false) {
                $path2 = substr($path2, 0, $find);
            }
        } else {
            $path2 && $path2 .= D;
            $path2 .= $folder;
        }
    }
    return $prefix . $path2 . $suffix;
}

function u($path, $full_path = false)
{
    global $weburl, $rooturl;
    switch (substr($path, 0, 1)) {
        case '.':
            return ($full_path ? $weburl : (WEB_FOLDER ? '/' . WEB_FOLDER : '')) . substr($path, 1);
            break;
        case '/':
            return ($full_path ? $rooturl : '') . (isLinux ? '/' . str_replace(D, '/', substr($path, strlen(WEB_ROOT))) : $path);
            break;
        default:
            return ($full_path ? $rooturl : '') . '/' . str_replace(D, '/', substr($path, strlen(WROOT)));
            break;
    }
}
function convertUrlQuery($query)//手工解析url参数
{ 
    $queryParts = explode('&', $query); 
    
    $params = array(); 
    foreach ($queryParts as $param) 
	{ 
        $item = explode('=', $param); 
        $params[$item[0]] = $item[1]; 
    } 
    
    return $params; 
}

/*系统变量*/
$sys_config_file = d('./config.php');
/**/
if (file_exists($sys_config_file)) {
    include($sys_config_file);
    define('AUTHKEY', $config['auth_key']);
    $pre = $config['db_table_pre'];
    define('PRE', $config['db_table_pre']);
    define('SYS_INSTALL', true);
    define('ADMIN_FOLDER', $config['sys_admin_folder']);
} else {
    define('SYS_INSTALL', false);
}
    common::initialize();
    $ipint = common::ipint();
    $intip = common::intip();
    $domains = common::domain_parse();
    if (SYS_INSTALL === true) {
        if ($config['db_host'] && $config['db_port'] && $config['db_user'] && $config['db_pwd'] && $config['db_name']) $db = new mysql($config['db_host'] . ':' . $config['db_port'], $config['db_user'], $config['db_pwd'], $config['db_name']);
        if ($db && $db->connected) define('DB_CONNECT', true);
        else define('DB_CONNECT', false);
    }
//初始化插件
    include(PLUGIN_ROOT . 'common.php');
    plugins::loadPlugins();
//
    /******************************/
    $timestamp = time::$time_stamp;
    $today_start = time::$today_start;
    $today_end = time::$today_end;
    $tmp = time::tswk();
    $tswkStart = $tmp['start'];
    $tswkEnd = $tmp['end'];
    $tmp = time::tsm();
    $tsmStart = $tmp['start'];
    $tsmEnd = $tmp['end'];
//($page=$_GET['page'])||($page=1);
//($pagesize=$_GET['pagesize'])||($pagesize=20);
    $pagestyle = '[{page}/{maxpage}]{page>minpage}[<a href="{url minpage}">首页</a>][<a href="{url page-1}"><</a>]{/page}{pages}{select}[{page}]{else}[<a href="{url}">{page}</a>]{/select}{/pages}{page<maxpage}[<a href="{url page+1}">></a>][<a href="{url maxpage}">尾页</a>]{/page}';
    $sys_hash = md5($_SERVER['HTTP_USER_AGENT'] . $intip);
    $sys_hash_code = '<input type="hidden" name="hash" value="' . $sys_hash . '" />';
    $sys_hash2 = base64_encode(common::authcode($sys_hash, true, cfg::getInt('sys', 'formExpireTime')));
    $sys_hash_code2 = '<input type="hidden" name="hash2" value="' . $sys_hash2 . '" />';
    cache::get_array('base');
    $base && extract($base);
    if($web_rewrite==1)
        $web_rewrite=true;// 强制指定路径重写功能
    cache::get_array('vars');
    cache::get_array('userGroups');
    $userGroups2 = array();
    if ($userGroups) {
        foreach ($userGroups as $k => $v) {
            $userGroups2[$v['id']] = array(
                'id' => $v['id'],
                'sort' => $v['sort'],
                'key' => $v['key'],
                'name' => $v['name']
            );
        }
    }
    $ignoreVars = array_merge(
        array('config', 'weburl', 'weburl2', 'rooturl', 'cookie', 'timestamp', 'today_start', 'today_end', 'pagestyle', 'sys_hash', 'sys_hash_code', 'sys_config_file', 'user', 'isLogin', 'admin', 'isAdmin', 'cookietime', 'db', 'pre', 'ipint', 'intip', 'userGroups', 'sys_hash', 'sys_hash2', 'sys_hash_code', 'sys_hash_code2', 'questions', 'uid'),
        array_keys($base),
        array_keys($vars)
    );
    $setNumVars = array(
        'id',
        'cid',
        'fid',
        'tid',
        'pid',
        'page',
        'pagesize'
    );
    if ($vars) {
        extract($vars);
        unset($vars);
    }
    /******************************/
//session_start();
    if ($_GET) { //ignore get vars
        $unGets = array();
        foreach (array_keys($_GET) as $key) {
            if (in_array($key, $ignoreVars)) $unGets[] = $key;
        }
        foreach ($unGets as $key) {
            unset($_GET[$key]);
        }
    }
    foreach ($setNumVars as $key) {
        if (isset($_GET[$key])) $_GET[$key] = intval($_GET[$key]);
        else $_GET[$key] = 0;
    }
    if (SYS_INSTALL === true && $post_data && !$cookie['founder_login']) { //ignore post vars
        $unGets = array();
        foreach (array_keys($_POST) as $key) {
            if (in_array($key, $ignoreVars)) $unGets[] = $key;
        }
        foreach ($unGets as $key) {
            unset($_POST[$key]);
        }
        foreach ($setNumVars as $key) {
            if (isset($_POST[$key])) $_POST[$key] = intval($_POST[$key]);
        }
    }
    $_GET && extract($_GET);
    ($referer && ($referer = urldecode($referer))) || ($podt_data && ($referer = $_POST['referer'])) || ($referer = $_SERVER['HTTP_REFERER']) || ($referer = $weburl . '/');
    $fromInstation = false;
    if ($_SERVER['HTTP_REFERER']) {
        $urlInfo = parse_url($_SERVER['HTTP_REFERER']);
        if ($domains['host'] == $urlInfo['host']) {
            $fromInstation = true;
        }
    }
    if(!empty($urlInfo['query']) && strpos($urlInfo['query'],'type') && strpos($urlInfo['path'],'userdata')){
        $referer = strpos($referer, '?') ? $referer . '&' : $referer . '?';
        $referer.=$urlInfo['query'];
        $referer=str_replace('&&','&',$referer);
    }
    $page || $page = 1;
    $pagesize || $pagesize = 20;
    (isset($sys_debug) && $sys_debug && $sys_debug = true) || $sys_debug = false;
    $webArgs = array(
        'webName' => $web_name,
        'webName2' => $web_name2,
        'webUrl' => $weburl
    );
    $_showmessage = false;
    if ($cookie['_showmessage']) {
        $_showmessage = $cookie['_showmessage'];
        common::unsetcookie('_showmessage');
    }
    $indexMessage = false;
    if ($cookie['indexMessage']) {
        $indexMessage = $cookie['indexMessage'];
        common::unsetcookie('indexMessage');
    }
    if (DB_CONNECT === true) {
//用户处理
        loadLib('member.base'); //
        $member = array();
        $memberLogined = false;
        if ($cookie['loginUid']) {
            $__t1 = cfg::getInt('sys', 'sys_logout');
            $__t2 = intval($cookie['memberLastTime']);
            if ($__t1 == 0 || ($__t2 == 0 || $timestamp - $__t2 <= $__t1)) {
                $uid = $cookie['loginUid'];
                if ($member = member_base::getMember($uid)) {
                    //$memberFields = member_base::getMemberFields($member['id']);
                    $memberLogined = true;
                }
                common::setcookie('memberLastTime', $timestamp);
                db::update('members', array('lastActTime' => $timestamp), "id='$uid'");
            } else {
                if ($__t2 > 0) {
                    common::unsetcookie('loginUid', 'checkPwd2', 'firstOpen', 'memberLastTime');
                }
            }
        }
        elseif (!empty($cookie['memberAuth']) || !empty($cookie['memberAuth2']))
        {
            $__auth = !empty($cookie['memberAuth']) ? $cookie['memberAuth'] : $cookie['memberAuth2'];
            $arr = unserialize($__auth);
            if (member_base::loginUid($arr['uid'], $arr['password'])) {
                $uid = $arr['uid'];
                if ($member = member_base::getMember($uid)) {
                    //$memberFields = member_base::getMemberFields($member['id']);
                    $memberLogined = true;
                }
            }
            unset($arr);
        }
        $isAdmin = $isModerator = $isVip = $isVip2 = $isFlowVip = $isEnsure = false;
        if ($memberLogined) {
            if (!$cookie['ipint2']) {
                $ipint2 = $ipint;
                common::setcookie('ipint2', $ipint2, 365 * 86400);
            } else {
                $ipint2 = $cookie['ipint2'];
            }
            $memberFields = member_base::getMemberFields($member['id']);
            $memberTask = member_base::getMemberTask($member['id']);
            $memberTask['ining'] = $memberTask['ining1'] + $memberTask['ining2'] + $memberTask['ining3'] + $memberTask['ining4'];
            $memberTask['outing'] = $memberTask['outing1'] + $memberTask['outing2'] + $memberTask['outing3'] + $memberTask['outing4'];
            if ($cookie['checkPwd2'])
                $member['checkPwd2'] = true;
            else
                $member['checkPwd2'] = false;
            $memberGroup = $userGroups2[$member['groupid']];
            if ($memberGroup['key'] == 'admin')
                $isAdmin = true;
            $memberLevel = member_credit::getLevelAll($memberFields['credits']);
            if ($memberFields['vip'])
                $isVip = true;
            if ($memberFields['vip2'])
                $isVip2 = true;
            if ($memberFields['flowVip'])
                $isFlowVip = true;
            if ($memberFields['isEnsure'])
                $isEnsure = true;
            /*
            积分对应的同时接手 发布最大数量
            0-100 10 10
            101-1000 20 20
            1001-3000 70 35
            3000或VIP 130 100
            VIP+卡信托 130 1000
            */
            if ($isVip) {
                if ($isVip2) {
                    $maxTaskIn = 130;
                    $maxTaskOut = 1000;
                } else {
                    $maxTaskIn = 130;
                    $maxTaskOut = 100;
                }
            } else {
                if ($memberFileds['credits'] < 101) {
                    $maxTaskIn = 10;
                    $maxTaskOut = 10;
                } elseif ($memberFields['credits'] < 1001) {
                    $maxTaskIn = 20;
                    $maxTaskOut = 20;
                } elseif ($memberFields['credits'] < 3000) {
                    $maxTaskIn = 70;
                    $maxTaskOut = 35;
                } else {
                    $maxTaskIn = 130;
                    $maxTaskOut = 100;
                }
            }
            $maxTaskIn2 = $maxTaskIn - $memberTask['ining'];
            $maxTaskOut2 = $maxTaskOut - $memberTask['outing'];
        }
// THE END
//更新模块
//更新过期商品
        if (db::data_count('shops', "status='0'")) {
            $query = $db->query("select id,cid from {$pre}shops where status='0' and timestamp2<>'0' and timestamp2<$timestamp");
            while ($line = $db->fetch_array($query)) {
                $db->query("update {$pre}shops set status='2' where id='$line[id]'");
                $db->query("update {$pre}shop_cate set total2=total2+1 where id='$line[cid]'");
            }
        }
//更新双倍积分卡
        $query = $db->query("select id,uid from {$pre}card where (cid='9' or cid='10') and status='1' and timestamp3<$timestamp");
        while ($line = $db->fetch_array($query)) {
            $db->query("update {$pre}card set status='2' where id='$line[id]'");
            $db->query("update {$pre}memberfields set double_credit='0' where uid='$line[uid]'");
        }
//VIP体验卡
        $query = $db->query("select id,uid from {$pre}card where cid='12' and status='1' and timestamp3<$timestamp");
        while ($line = $db->fetch_array($query)) {
            $db->query("update {$pre}card set status='2' where id='$line[id]'");
            $revip = true;
            if (($m_vip_expire = db::one_one('memberfields', 'vip_expire', "uid='$line[uid]'")) && $m_vip_expire > $timestamp) $revip = false;
            if ($revip) {
                $db->query("update {$pre}memberfields set vip='0' where uid='$line[uid]'");
            }
        }
//回收系统奖励的卡
        $query = $db->query("select id,uid from {$pre}card where cid='0' and status='0' and timestamp3<$timestamp");
        while ($line = $db->fetch_array($query)) {
            $db->query("update {$pre}card set status='2' where id='$line[id]'");
        }
//VIP处理
        $query = $db->query("select uid,vip_auto from {$pre}memberfields where vip='1' and vip_expire<$timestamp");
        while ($_m = $db->fetch_array($query)) {
            $db->query("update {$pre}memberfields set vip='0',vip_expire='0' where uid='$_m[uid]'");
            member_base::sendPm($_m['uid'], '您的VIP已经到期，为了不影响您正常使用，请即使充值', '', 'vip_end');
            member_base::sendSms($_m['uid'], '您的VIP已经到期，为了不影响您正常使用，请即使充值', 'vip_end');
            if ($_m['vip_auto']) {
                member_base::addVipMin($_m['uid'], $_m['vip_auto'], true);
            }
        }
//流量VIP处理
        $query = $db->query("select uid from {$pre}memberfields where flowVip='1' and flowVipExpire<'$timestamp'");
        while ($_m = $db->fetch_array($query)) {
            $db->query("update {$pre}memberfields set flowVip='0',flowVipExpire='0' where uid='$_m[uid]'");
            member_base::sendPm($_m['uid'], '您的流量VIP已经到期，为了不影响您正常使用，请即使充值', '', 'vip_end');
            member_base::sendSms($_m['uid'], '您的流量VIP已经到期，为了不影响您正常使用，请即使充值', 'vip_end');
        }

//更新缓存
        task_buyer::updateCache(); //更新买号缓存
//预定发布任务
        $query = $db->query("select id,type,suid from {$pre}task where status='0' and isPlan>0 and planDate<$timestamp");
        while ($line = $db->fetch_array($query)) {
            db::update('task', array('status' => 1, 'isPlan' => 0, 'planDate' => 0), "id='$line[id]'");
            db::update('membertask', 'outWaiting' . $line['type'] . '=outWaiting' . $line['type'] . '+1,outPause' . $line['type'] . '=outPause' . $line['type'] . '-1', "uid='$line[suid]'");
        }
//回收180秒没有绑定小号的任务
        $_t = 180;
        $_t = $timestamp - $_t;
        $query = $db->query("select id,type from {$pre}task where status='2' and btimestamp<$_t");
        while ($line = $db->fetch_array($query)) {
            task_base::addLog($line['id'], '绑定小号超时', '未在规定时间内绑定买号，系统撤销了接手人{busername}的任务{id}');
            switch ($line['type']) {
                case 1:
                    task_tao::sys_out($line['id']);
                    break;
                case 2:
                    task_pai::sys_out($line['id']);
                    break;
                case 3:
                    break;
                case 4:
                    task_new::sys_out($line['id']);
                    break;
                case 5:
                    task_truth::sys_out($line['id']);
                    break;
            }
        }
//回收没15分钟没人支付的任务
        $query = $db->query("select id,type from {$pre}task where status='4' and ttimestamp<$timestamp");
        while ($line = $db->fetch_array($query)) {
            task_base::addLog($line['id'], '支付超时', '未在规定时间内支付，系统撤销了接手人{busername}的任务{id}');
            switch ($line['type']) {
                case 1:
                    task_tao::sys_out($line['id']);
                    break;
                case 2:
                    task_pai::sys_out($line['id']);
                    break;
                case 3:
                    break;
                case 4:
                    task_new::sys_out($line['id']);
                    break;
                case 5:
                    task_truth::sys_out($line['id']);
                    break;
            }
        }
//回收黑名单
        $query = $db->query("select id from {$pre}blacks where status='0' and daysTimestamp<$timestamp");
        while ($_id = $db->fetch_array_first($query)) {
            db::update('blacks', "status='1'", "id='$_id'");
        }
//自动好评
        $_t = 15 * 86400;
        $_t = $timestamp - $_t;
        $query = $db->query("select id,suid,buid,credit from {$pre}task where status='8' and credit in('1','2') and ctimestamp<$_t");
        while ($line = $db->fetch_array($query)) {
            task_grade::add($line['id'], $line['credit'] & 1 ? $line['suid'] : $line['buid'], 1, '', 0, 1);
        }
//发送到期好评的消息
        $query = db::query('SELECT id,type,buid,isSendMsg FROM `' . db::table('task') . '` WHERE status=\'8\' AND isSendMsg&1=\'0\' AND etimestamp<\'' . $timestamp . '\'');
        while ($task = db::fetch($query)) {
            $__msg = '您在' . language::get('qu' . $task['type']) . '区接手的任务“' . $task['id'] . '”，请尽快收货好评';
            member_base::sendPm($task['buid'], $msg, '接手的任务“' . $task['id'] . '”已到期，请收货好评', 'in_to_grade');
            member_base::sendSms($task['buid'], $msg, 'in_to_grade');
            db::update('task', array('isSendMsg' => $task['isSendMsg'] | 1), "id='$task[id]'");
        }
//the end
    }
?>