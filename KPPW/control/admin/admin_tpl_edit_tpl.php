<?php

if(!defined('ADMIN_KEKE')) {
	exit('Access Denied');
}

Func_comm_class::adminCheckRole(51);
$filename = S_ROOT.'./tpl/'.$tplname.'/'.$tname;
$code_content = htmlspecialchars( Template_Class::sreadfile($filename));
require_once $template_obj->template ( 'control/admin/tpl/admin_tpl_'.$view );



