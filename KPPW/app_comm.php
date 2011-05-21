<?php
ob_end_clean();
ob_start();
//error_reporting('E_ERROR | E_WARNING | E_PARSE & ~E_NOTICE');
define('S_ROOT', dirname(__FILE__).DIRECTORY_SEPARATOR); //S_ROOT ：为系统跟目录

require_once S_ROOT.'./config/config.inc.php';
require_once S_ROOT.'./config/keke_version.php'; 

$_K = array();
$mtime = explode(' ',microtime());
$_K['is_debug'] = 1;  //0.默认关闭 1开启
$_K['refer'] = empty($_SERVER['HTTP_REFERER'])?'':$_SERVER['HTTP_REFERER'];//跳转的前一个页面
$_K['timestamp'] = $mtime[1]; 
$_K['tplrefresh'] = '1';
$_K['charset'] = 'UTF-8'; //定义模板字符
$_K['block_search']='';//待定义 屏蔽关键词
$_K['block_replace']='';//待定义 替换关键词
$_K['tpl_path']='tpl';
$_K['time_trave_time']=300;
if (! $i_model) {
	$basic_config = Cache_ext_Class::getConfig ( 'basic' );
	$model_list = Cache_ext_Class::gettabledata('witkey_model','model_status=1','',null,'model_id');
	$nav_list = Cache_ext_Class::gettabledata("witkey_nav","ishide!=1","listorder",null,"nav_id");
	$default_template = Cache_ext_Class::gettemplate ();
	if ($basic_config ['user_intergration'] == "2") {
		require S_ROOT."./config/config_ucenter.php";
	}
}
$_K['is_rewrite'] = $basic_config['is_rewrite'];
$_K['template'] = $default_template?$default_template['temp_path']:'default'; //定义模板文件夹
$_K['siteurl'] = $basic_config['website_url'];
define('SKIN_PATH', $_K['tpl_path'].'/'.$_K['template']); 
define ( 'UPLOAD_FRONT', 1 ); //是否允许前台上传附件
define ( 'UPLOAD_ROOT', S_ROOT . '/data/uploads/'.UPLOAD_RULE ); //附件保存物理路径
define ( 'UPLOAD_ALLOWEXT', '' . $basic_config ['file_type'] ); //允许上传的文件后缀，多个后缀用“|”分隔
define ( 'UPLOAD_MAXSIZE', '' . $basic_config ['max_size'] * 1024 * 1024 ); //允许上传的附件最大值

if($_REQUEST)
{
	if(get_magic_quotes_gpc())
	{
		if (!$tpl_mode){
		$_REQUEST = $_REQUEST;
		if($_COOKIE) $_COOKIE = $_COOKIE;
		}
		@extract($_REQUEST);
	}
	else
	{
		if (!$tpl_mode){
			@extract(Func_comm_class::k_addslashes($_POST));
			@extract(Func_comm_class::k_addslashes($_GET));
			@extract(Func_comm_class::k_addslashes($_COOKIE));
		}else {
			@extract($_POST);
			@extract($_GET);
			@extract($_COOKIE);
		}

	}
  
	
}
unset($uid);
unset($username);
if($_SERVER['QUERY_STRING'] && strpos($_SERVER['QUERY_STRING'], '=') === false && preg_match("/^(.*)\.(htm|html|shtm|shtml)$/", $_SERVER['QUERY_STRING'], $urlvar))
{
	parse_str(str_replace(array('/', '-', ' '), array('&', '=', ''), $urlvar[1]));
} 
//
//是否执行刷新的
$exec_time_traver = Cache_ext_Class::get('time_traveler_last_exec_cache');
$exec_time_traver = !$exec_time_traver;



session_start();
header("Content-Type:text/html; charset={$_K['charset']}");

$template_obj = new Template_Class();