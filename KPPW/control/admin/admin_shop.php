<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

$views = array ('shop','banner','edit_banner', 'cate','edit_cate','config','service','edit_service','order');
$view = (! empty ( $view ) && in_array ( $view, $views )) ? $view : 'banner';

if (file_exists ( ADMIN_ROOT . 'admin_'.$do.'_' . $view . '.php' )) {
	require_once ADMIN_ROOT . 'admin_'.$do.'_' . $view . '.php';
} else {
	Func_comm_class::adminshowmessage ( "您访问的页面不存在!" );
}