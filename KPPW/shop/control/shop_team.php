<?php
 
if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

 
$case_obj = new Keke_witkey_shop_case_class();
$page_obj = new Pages_Class();

if ($shop_info['shop_type']==1){
 
 
}
else{
 
	$team_obj = new Keke_witkey_shop_member_class();
	$wh = "shop_id = $shop_id";
	$team_obj->setWhere($wh);
	$count = $team_obj->count_keke_witkey_shop_member();
	
	$url ='shop.php?do='.$do.'&view='.$view.'&shop_id='.$shop_id.'&page_size='.$page_size;
	$page = $_GET ['page'] ? $_GET ['page'] : 1;
	$page_size = intval($page_size)?intval($page_size):5;
	$limit=$page_size;
	$pages = $page_obj->getPages($count,$limit,$page,$url);
	$team_obj->setWhere($wh.$pages['where']);
 
	$team_arr = $team_obj->query_keke_witkey_shop_member();
	
	
if($shop_config['tpl_direction']==1)
	{	
		require_once $template_obj->template("shop/tpl/{$_K['template']}/enterprise_{$do}_{$view}");
	}else {
		require_once $template_obj->template("shop/tpl/{$_K['template']}/enterprisev_{$do}_{$view}");
	}
}

