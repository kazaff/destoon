<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

$views = array ('industry', 'edit_industry', 'skill', 'edit_skill','comment','report','tpl' ,'mail','custom','union_industry');



$view = (! empty ( $view ) && in_array ( $view, $views )) ? $view : 'industry';


if (file_exists ( ADMIN_ROOT . 'admin_task_' . $view . '.php' )) {
	require_once ADMIN_ROOT . 'admin_task_' . $view . '.php';
} else {
	Func_comm_class::adminshowmessage ( "您访问的页面不存在!" );
}
