<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
//设置安全级别
define('DT_DEBUG', 1);
error_reporting(DT_DEBUG ? E_ALL : 0);

//安全参数检测：GLOBALS关键字提交说明请求出现入侵
if(isset($_REQUEST['GLOBALS']) || isset($_FILES['GLOBALS'])) exit('Request Denied');

//关闭全局引用
@set_magic_quotes_runtime(0);
$MQG = get_magic_quotes_gpc();

//因为后面会把POST和GET数组中的元素提取出来，所以这里先把已经存在的冲突的变量名下的内容unset，节省内存空间，避免垃圾数据
foreach(array('_POST', '_GET') as $R) {
	if($$R) { 
		foreach($$R as $k=>$v) {
			if(isset($$k) && $$k == $v)
				unset($$k);
		} 
	}
}

//URL分析
if(defined('DT_REWRITE')) {
	$pstr = '';
	if($_SERVER['QUERY_STRING']) {	//动态URL结构
		if(preg_match("/^(.*)\.html$/", $_SERVER['QUERY_STRING'], $_match)) {
			$pstr = $_match[1];
		} else if(preg_match("/^(.*)\/$/", $_SERVER['QUERY_STRING'], $_match)) {
			$pstr = $_match[1];
		}
	} else if($_SERVER["REQUEST_URI"] != $_SERVER["SCRIPT_NAME"]) {		//伪静态URL结构
		$string = str_replace($_SERVER["SCRIPT_NAME"], '', $_SERVER["REQUEST_URI"]);
		if($string && preg_match("/^\/(.*)\/$/", $string, $_match)) $pstr = $_match[1];
	}
	
	if($pstr && strpos($pstr, '-') !== false) {
		$pstr = explode('-', $_match[1]);
		$pstr_count = count($pstr);
		if($pstr_count%2 == 1) --$pstr_count;	//处理成偶数对，键值对应
		for($i = 0; $i < $pstr_count; $i++) { 
			$_GET[$pstr[$i]] = $MQG ? addslashes($pstr[++$i]) : $pstr[++$i]; 	//这里$MQG检查，是为了让GET数据格式统一，方便后面的统一处理
		}
	}
}

define('IN_DESTOON', true);	
define('DT_ROOT', str_replace("\\", '/', dirname(__FILE__)));	//根目录

//全局配置文件
require DT_ROOT.'/config.inc.php';

define('DT_PATH', $CFG['absurl'] ? $CFG['url'] : $CFG['path']);
define('DT_DOMAIN', $CFG['cookie_domain'] ? substr($CFG['cookie_domain'], 1) : '');
define('DT_CHMOD', $CFG['file_mod'] ? $CFG['file_mod'] : '');
define('DT_URL', $CFG['url']);
define('DT_LANG', $CFG['language']);
define('DT_KEY', $CFG['authkey']);
define('DT_CHARSET', $CFG['charset']);
define('DT_CACHE', $CFG['cache_dir'] ? $CFG['cache_dir'] : DT_ROOT.'/cache');
define('DT_SKIN', DT_PATH.'skin/'.$CFG['skin'].'/');
define('DT_PHP', '.php');
define('SKIN_PATH', DT_PATH.'skin/'.$CFG['skin'].'/');//For 2.x
define('VIP', $CFG['com_vip']);
define('errmsg', 'Invalid Request');

$L = array();	//标签本地化语言数组
include DT_ROOT.'/lang/'.DT_LANG.'/lang.inc.php';	//本地化语言

require DT_ROOT.'/version.inc.php';		//版本授权参数,升级补丁比对信息
require DT_ROOT.'/include/global.func.php';	//全局功能函数
require DT_ROOT.'/include/tag.func.php';	//风骚的tag函数^_^
require DT_ROOT.'/api/im.func.php';		//即时通讯工具的API
require DT_ROOT.'/api/extend.func.php';		//扩展函数HOOK

if(!$MQG && $_POST) $_POST = daddslashes($_POST);	//POST加斜杠
if(!$MQG && $_GET) $_GET = daddslashes($_GET);		//GET加斜杠

$DT_PRE = $CFG['tb_pre'];	//表前缀
$DT_QST = $_SERVER['QUERY_STRING'];		//查询（query）的字符串（URL 中第一个问号 ? 之后的内容）
$DT_TIME = time() + $CFG['timediff'];	//时间
$DT_IP = get_env('ip');		//访问IP
$DT_URL = get_env('url');	//获取请求URL
$DT_REF = get_env('referer');	//获取来源地址
if(function_exists('date_default_timezone_set')) date_default_timezone_set($CFG['timezone']);	//设置时区 Etc/GMT-8（东八区）

//设置页面编码
header("Content-Type:text/html;charset=".DT_CHARSET);

require DT_ROOT.'/include/db_'.$CFG['database'].'.class.php';	//加载数据库操作类
require DT_ROOT.'/include/session.class.php';	//session类
require DT_ROOT.'/include/file.func.php';	//文件操作函数库，和global.func.php配合工作

//如果不是管理员身份，就对用户提交数据进行过滤，访问IP过滤
if(!defined('DT_ADMIN')) {
	if(!empty($_SERVER['REQUEST_URI'])) {
		$uri = urldecode($_SERVER['REQUEST_URI']);
		if(strpos($uri, '<') !== false || strpos($uri, '"') !== false || strpos($uri, '0x') !== false) dalert(errmsg, 'goback');
	}
	if($_POST) $_POST = strip_sql($_POST);
	if($_GET) $_GET = strip_sql($_GET);
	$BANIP = cache_read('banip.php');
	if($BANIP) banip($BANIP);	//如果访问IP（DT_IP）为禁用，则报错
	$destoon_task = '';
}


if($_POST) extract($_POST, EXTR_SKIP);
if($_GET) extract($_GET, EXTR_SKIP);

//实例化DB对象
$db_class = 'db_'.$CFG['database'];
$db = new $db_class;
$db->halt = DT_DEBUG ? 1 : 0;
$db->pre = $CFG['tb_pre'];
$db->connect($CFG['db_host'], $CFG['db_user'], $CFG['db_pass'], $CFG['db_name'], $CFG['db_expires'], $CFG['db_charset'], $CFG['pconnect']);

//全局数组变量
$DT = $DEXT = $DCAT = $DTM = $MOD = array();

//缓存的配置数据
$CACHE = cache_read('module.php');
if(!$CACHE) {
	require_once DT_ROOT.'/admin/global.func.php';
	require_once DT_ROOT.'/include/cache.func.php';
    cache_all();
	$CACHE = cache_read('module.php');
}

$DT = $CACHE['dt'];	//网站设置
$MODULE = $CACHE['module'];	//各个模块的基本信息

if(!defined('DT_ADMIN')) {		//非管理员访问
	if($DT['close']) message($DT['close_reason'].'&nbsp;');		//网站暂时关闭效果
	if($DT['defend_cc'] || $DT['defend_reload'] || $DT['defend_proxy']) include DT_ROOT.'/include/defend.inc.php';		//系统安全系数，防止刷新，限制代理访问
}

//清除重要数据
unset($CACHE, $CFG['timezone'], $CFG['db_host'], $CFG['db_user'], $CFG['db_pass'], $db_class, $db_file);

//
if(!isset($moduleid)) {
	$moduleid = 1;
	$module = 'destoon';
} else if($moduleid == 1) {
	$module = 'destoon';
} else {
	$moduleid = intval($moduleid);
	isset($MODULE[$moduleid]) or dheader(DT_PATH);		//如果访问的未定义模块，则跳转到定制的首页
	$module = $MODULE[$moduleid]['module'];		//模块名，对应模块的文件夹名称
	$MOD = cache_read('module-'.$moduleid.'.php');
	include DT_ROOT.'/lang/'.DT_LANG.'/'.$module.'.inc.php';	//加载指定模块的语言配置文件
}

//如果设置了页面Gzip压缩，就打开
($DT['gzip_enable'] && !$_POST && !defined('DT_WAP') && !headers_sent()) ? ob_start('ob_gzhandler') : ob_start();

$forward = isset($forward) ? urldecode($forward) : $DT_REF;		//来源地址，如果传参指定了参数，就按照指定参数设置
$action = isset($action) ? trim($action) : '';		//动作

//如果有页面提交，就处理验证码和回答
$submit = isset($_POST['submit']) ? true : false;
if($submit) {
	isset($captcha) or $captcha = '';
	isset($answer) or $answer = '';
}


$catid = isset($catid) ? intval($catid) : 0;
$itemid = isset($itemid) ? (is_array($itemid) ? $itemid : intval($itemid)) : 0;

//分页
$page = isset($page) ? max(intval($page), 1) : 1;
$pagesize = $DT['pagesize'] ? $DT['pagesize'] : 30;
$offset = ($page-1)*$pagesize;

//搜索关键字
$kw = isset($kw) ? htmlspecialchars(str_replace(array("\'"), array(''), trim(urldecode($kw)))) : '';	
$keyword = $kw ? str_replace(array(' ', '*'), array('%', '%'), $kw) : '';

$today_endtime = strtotime(date('Y-m-d', $DT_TIME).' 23:59:59');

$seo_title = $head_title = $head_keywords = $head_description = '';
$head_keywords = $DT['seo_keywords'];
$head_description = $DT['seo_description'];

$_userid = $_message = $_money = $_credit = $_sms = 0;
$_username = $_company = $_passport = '';
$_groupid = 3;	//默认游客组

//分析cookie对访问者身份进行判断
$destoon_auth = get_cookie('auth');
if($destoon_auth) {
	$_dauth = explode("\t", decrypt($destoon_auth, md5(DT_KEY.$_SERVER['HTTP_USER_AGENT'])));
	$_userid = isset($_dauth[0]) ? intval($_dauth[0]) : 0;
	$_username = isset($_dauth[1]) ? trim($_dauth[1]) : '';
	$_groupid = isset($_dauth[2]) ? intval($_dauth[2]) : 3;
	if($_userid && !defined('DT_NONUSER')) {
		$_password = isset($_dauth[3]) ? trim($_dauth[3]) : '';
		$user = $db->get_one("SELECT username,passport,company,truename,password,groupid,email,message,sms,credit,money,loginip,admin,edittime FROM {$db->pre}member WHERE userid=$_userid");
		if($user && $user['password'] == $_password) {
			if($user['groupid'] == 2) dalert(lang('message->common_forbidden'));
			extract($user, EXTR_PREFIX_ALL, '');
			if($user['loginip'] != $DT_IP && ($DT['ip_login'] == 2 || ($DT['ip_login'] == 1 && defined('DT_ADMIN')))) {
				$_userid = 0; set_cookie('auth', '');
				dalert(lang('message->common_login', array($user['loginip'])), DT_PATH);
			}
		} else {
			$_userid = 0; set_cookie('auth', '');
		}
		unset($destoon_auth, $user, $_dauth, $_password);
	}
}
if($_userid == 0) $_groupid = 3;	//如果不是用户，则定义为游客组(groupid=3)
if($_groupid == 1 && !defined('DT_ADMIN')) include DT_ROOT.'/module/member/admin.inc.php';		//groupid=1代表管理员组，如果是1的话，就载入admin.inc.php进行验证身份
$MG = cache_read('group-'.$_groupid.'.php');	//加载对用用户组的配置
?>