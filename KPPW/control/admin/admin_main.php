<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

$task_obj = new Keke_witkey_task_class ( ); 
$user_obj = new Keke_witkey_space_class ( ); 

$mysql_ver = mysql_get_server_info (); 

$notice_obj = new Keke_witkey_admin_notice_class();
$notice_obj->setWhere("uid = {$_SESSION['uid']}");
$notice_info = $notice_obj->query_keke_witkey_admin_notice();
$notice_text = $notice_info[0]['content'];

if ($ac == 'ajnotice')
{
	if (strtolower($_K['charset'])!='UTF-8')
	{
		$val = Func_comm_class::utftogbk($val);
	}
		$notice_obj->setContent($val);
		if ($notice_info[0]){
			$notice_obj->setWhere("uid = {$_SESSION['uid']}");
			$notice_obj->edit_keke_witkey_admin_notice();
		}
		else{
			$notice_obj->setUid($_SESSION['uid']);
			$notice_obj->create_keke_witkey_admin_notice();
		} 
	
	
	die();
}


$sys_info ['os'] = PHP_OS;
$sys_info ['ip'] = $_SERVER ['SERVER_ADDR'];
$sys_info ['web_server'] = $_SERVER ['SERVER_SOFTWARE'];
$sys_info ['php_ver'] = PHP_VERSION;
$sys_info ['mysql_ver'] = $mysql_ver;
$sys_info ['safe_mode'] = ( boolean ) ini_get ( 'safe_mode' ) ? $_LANG ['yes'] : $_LANG ['no'];
$sys_info ['safe_mode_gid'] = ( boolean ) ini_get ( 'safe_mode_gid' ) ? $_LANG ['yes'] : $_LANG ['no'];
$sys_info ['timezone'] = function_exists ( 'date_default_timezone_set' ) ? date_default_timezone_set ( 'Asia/Shanghai' ) : date_default_timezone_set ( 'Asia/Shanghai' );


$sys_info ['max_filesize'] = ini_get ( 'upload_max_filesize' );


$total_task_count = $task_obj->count_keke_witkey_task ();


$task_obj->setWhere ( 'task_mode in (1,2,3)' );
$xs_task_count = $task_obj->count_keke_witkey_task ();


$task_obj->setWhere ( '!IFNULL(task_mode,0)' );
$zb_task_count = $task_obj->count_keke_witkey_task ();


$total_user_count = $user_obj->count_keke_witkey_space ();


$user_obj->setWhere ( 'isvip = 1' );
$vip_user_count = $user_obj->count_keke_witkey_space ();


$user_obj->setWhere ( 'realname_auth>0 or enterprise_auth>0 or email_auth>0 or bank_auth>0' );
$auth_user_count = $user_obj->count_keke_witkey_space ();

 

$pars = array ('ac' =>'run','sitename' => urlencode ( $basic_config['website_name'] ), 'siteurl' =>htmlentities($basic_config['website_url']), 'charset' => $_K['charset'], 'version' =>KEKE_VERSION, 'release' =>KEKE_RELEASE, 'os' => PHP_OS, 'php' =>$_SERVER['SERVER_SOFTWARE'], 'mysql' => $mysql_ver, 'browser' => urlencode ( $_SERVER ['HTTP_USER_AGENT'] ), 'username' => urlencode ($_SESSION['username']), 'email' =>$basic_config ['email']?$basic_config ['email']:'noemail','p_name'=>P_NAME);
$data = http_build_query ( $pars );

if(file_exists(S_ROOT."./config/keke.lic")){
$lic = Template_Class::sreadfile(S_ROOT."./config/keke.lic");
}

$verify = md5 ( $data . $lic );
$notice = "http://www.kekezu.com/update.php?".$data."&lic=".urlencode($lic)."&verify=".$verify."&p_name=".P_NAME; 
$sys = array("ac"=>"sysinfo",'charset' => $_K['charset'],'p_name'=>P_NAME);
$sysinfo = "http://www.kekezu.com/news.php?".http_build_query($sys);
require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do );