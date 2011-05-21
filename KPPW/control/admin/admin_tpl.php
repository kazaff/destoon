<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$views = array ('link','edit_link', 'ad','edit_ad', 'taglist', 'edit_tag','preview_tag','edit_tagtpl','tpllist','edit_tpl','export');

$view = (! empty ( $view ) && in_array ( $view, $views )) ? $view : 'link';

if (file_exists ( ADMIN_ROOT . 'admin_'.$do.'_' . $view . '.php' )) {
	require_once ADMIN_ROOT . 'admin_'.$do.'_' . $view . '.php';
} else {
	Func_comm_class::adminshowmessage ( "您访问的页面不存在!" );
}