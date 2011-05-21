<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$views = array ('index', 'shop_list', 'order','service_list','step');

$view = (! empty ( $view ) && in_array ( $view, $views )) ? $view : 'index';
if (file_exists ( S_ROOT . './shop/control/' . $view . '.php' )) {
	require_once S_ROOT . '/shop/control/' . $view . '.php';
} else {
	Func_comm_class::showmessage("错误提示！",$_K['siteurl'],'','您访问的页面不存在','error');
} 