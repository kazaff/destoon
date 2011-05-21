<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$views = array ('list','add');

$view = (! empty ( $view ) && in_array ( $view, $views )) ? $view : 'list';

if (file_exists ( ADMIN_ROOT . 'admin_case_' . $view . '.php' )) {
	require_once ADMIN_ROOT . 'admin_case_' . $view . '.php';
} else {
	Func_comm_class::adminshowmessage ( "您访问的页面不存在!" );
}

