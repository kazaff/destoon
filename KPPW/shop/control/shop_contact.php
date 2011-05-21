<?php
 
if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

 

 

if ($shop_info['shop_type']==1){
 
	
	
	
	
	require_once $template_obj->template("shop/tpl/{$_K['template']}/person_{$do}_{$view}");
}
else{
 
	
	
	
	
	
if($shop_config['tpl_direction']==1)
	{	
		require_once $template_obj->template("shop/tpl/{$_K['template']}/enterprise_{$do}_{$view}");
	}else {
		require_once $template_obj->template("shop/tpl/{$_K['template']}/enterprisev_{$do}_{$view}");
	}
}

