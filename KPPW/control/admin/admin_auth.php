<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$views = array ('item_list','edit_item', 
'realname_list','realname_info',
'enterprise_list','enterprise_info',
'bank_list','bank_info');

$view = (! empty ( $view ) && in_array ( $view, $views )) ? $view : 'item_list';

if (file_exists ( ADMIN_ROOT . 'admin_'.$do.'_' . $view . '.php' )) {
	require_once ADMIN_ROOT . 'admin_'.$do.'_' . $view . '.php';
} else {
	Func_comm_class::adminshowmessage ( "您访问的页面不存在!" );
}