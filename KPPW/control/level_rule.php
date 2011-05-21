<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$title = 'KPPW 信誉规则';

$mc_rule = Cache_ext_Class::gettabledata("witkey_mark_config","","max_cash","0","mark_config_id");

require_once  $template_obj->template ( $do );