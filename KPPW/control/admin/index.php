<?php
require '../../app_comm.php';
define('ADMIN_KEKE',TRUE);

$_K['is_rewrite'] = 0 ;
define('ADMIN_ROOT',S_ROOT.'./control/admin/');

$_K['admin_tpl_path']= S_ROOT.'./control/admin/tpl/';

$dos = array('main','side','menu','tpl','index','config','article','edit_article','art_cat','edit_art_cat','finance','task','model','tool','user','login','logout','button_a','user_integration','score_config','score_rule','mark_config','mark_rule','mark_addico','mark_mangeico','auth','studio','shop','group','rule','case');

$do = (! empty ( $_GET ['do'] ) && in_array ( $_GET ['do'], $dos )) ? $_GET ['do'] : 'index';


if ($do!='login'&&$do!='logout'&&!$_SESSION['auid']){
   
   header("location:index.php?do=login");
}
if($do!='login'&&$do!='logout'&&!$_SESSION['uid']){
	header("location:index.php?do=login");
}


$admin_info = Cache_ext_Class::getAdminUserinfo($_SESSION['uid']);


if ($do!='login'&&$do!='logout'&&$_SESSION['uid']!=ADMIN_UID&&$admin_info['group_id']==0){
	Func_comm_class::adminshowmessage("您没有管理权限!!!!",$_K['siteurl']);
	header("location:../../index.php");
	die();
}

$menu_arr = array(
	'config'=>'系统配置',
	'article'=>'文章管理',
	'task'=>'任务管理',
	'shop'=>'商店管理',
	'finance'=>'财务管理',
	'user'=>'用户管理',
	'tool'=>'系统工具',
	'tpl'=>'模板标签',
);


require_once ADMIN_ROOT.'admin_'.$do.'.php';
?>