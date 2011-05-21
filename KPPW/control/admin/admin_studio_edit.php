<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

$studio_obj = new Keke_witkey_studio_class();//实例化工作室表对象

$studio_obj->setWhere(' studio_id = '.$studio_id);
$studio_info = $studio_obj->query_keke_witkey_studio();
$studio_info = $studio_info[0];

require_once $template_obj->template ( 'control/admin/tpl/admin_'.$do.'_' . $view );