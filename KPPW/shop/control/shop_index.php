<?php
 
if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

 
if ($shop_info['shop_type']==1){
 
	$service_obj = new Keke_witkey_service_class();
    $service_obj->setWhere(" shop_id = $shop_id order by on_time desc limit 4");
	$service_arr = $service_obj->query_keke_witkey_service();
    
	$case_obj = new Keke_witkey_shop_case_class();
	$case_obj->setWhere("  shop_id = $shop_id order by on_date desc limit 2");
	$case_arr = $case_obj->query_keke_witkey_shop_case();
	
	
	
	
	require_once $template_obj->template("shop/tpl/{$_K['template']}/person_{$do}_{$view}");
}
else{
 
 
    $case_obj = new Keke_witkey_shop_case_class();
	$case_obj->setWhere("  shop_id = $shop_id order by on_date desc limit 6");
	$case_arr = $case_obj->query_keke_witkey_shop_case();
	if($shop_config['tpl_direction']!=2)
	{
		require_once $template_obj->template("shop/tpl/{$_K['template']}/enterprise_{$do}_{$view}");
	}else {
		require_once $template_obj->template("shop/tpl/{$_K['template']}/enterprisev_{$do}_{$view}");
	}
}

