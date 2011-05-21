<?php


if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

$views = array ('basic', 'pay','editpay', 'tpl' ,'mail','msg','vip','msgtpl','cove','integration','score','mark','model','nav');

$view = (! empty ( $view ) && in_array ( $view, $views )) ? $view : 'basic';

if (file_exists ( ADMIN_ROOT . 'admin_config_' . $view . '.php' )) {
	require_once ADMIN_ROOT . 'admin_config_' . $view . '.php';
} else {
	Func_comm_class::adminshowmessage ( "您访问的页面不存在!" );
}

