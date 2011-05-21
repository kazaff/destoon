<?php
 
if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

 
$case_obj = new Keke_witkey_shop_case_class();
$page_obj = new Pages_Class();

if ($shop_info['shop_type']==1){
 
	Func_comm_class::showmessage("参数错误","shop.php",3,"参数错误",'error');
}
else{
 
	
  if($shop_config['tpl_direction']==1)
	{	
		require_once $template_obj->template("shop/tpl/{$_K['template']}/enterprise_{$do}_{$view}");
	}else {
		require_once $template_obj->template("shop/tpl/{$_K['template']}/enterprisev_{$do}_{$view}");
	}
	
}

