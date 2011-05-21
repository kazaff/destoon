<?php
 
if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

 
$service_obj = new Keke_witkey_service_class();
$page_obj = new Pages_Class();

 
	$wh = " 1=1 ";
	if ($cate_id){
		$wh.=" and cus_cate_id = ".intval($cate_id);
	}
	if($key){
		$wh.= " and title like '%$key%' or content like '%$key%' "; 
	}
	$wh .= " and shop_id = $shop_id";
	if($by){
		$wh.= " order by $by desc";
	}
	$service_obj->setWhere($wh);
	$count = $service_obj->count_keke_witkey_service();
 
	$page_size = intval($page_size)?intval($page_size):3;
 
	$url ='shop.php?do='.$do.'&view='.$view.'&shop_id='.$shop_id.'&page_size='.$page_size;
	$page = $_GET ['page'] ? $_GET ['page'] : 1;
	$limit=$page_size;
	$pages = $page_obj->getPages($count,$limit,$page,$url);
		
	$service_obj->setWhere($wh.$pages[where]);
	$service_arr = $service_obj->query_keke_witkey_service();
	
 
	
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

