<?php


if(!defined('IN_KEKE')) {
	exit('Access Denied');
}
$_K['is_rewrite'] = 0 ;
if (!$uid)
{
	Func_comm_class::showmessage("您必须先登录","index.php?do=login",3,"",'error');
}


if (is_int(!$uid))
$view = $view?$view:'';
$views = array('index','info','choose_indus','change_password','auth_vip','auth_team','message_list','message_view','message_send',
				'cash','withdraw','release_task','join_task','collect_task','nopay',
				'success_task','edit_task','edit_tender','space','finance','auth','auth_realname','auth_email',
				'auth_bank','auth_enterprise','skill','score','studio',
                'service_favorite',
				'create_shop','service_add','service_list','service_cate','case_list','case_add','case_cate','shop_member','shop_member_add','shop_info','shop_show','sell_service',
				'pub_demand','buy_service',

				'shop_person_mytheme','shop_person_theme','shop_peson_menu','shop_peson_signature',
				'shop_enterprise_tpl','shop_enterprise_interface','shop_enterprise_menu','shop_enterprise_skin'
);
$view = in_array($view,$views)?$view:"index";



$studio_member_obj = new Keke_witkey_studio_member_class();
$studio_member_obj->setWhere(" uid = '$uid' ");
$count = $studio_member_obj->count_keke_witkey_studio_member();
if($count == 1){
	$is_studio_member = TRUE;	
}else 
{
	$is_studio_member = FALSE;
}

$studio_obj = new Keke_witkey_studio_class();
$studio_obj->setWhere(' uid = '.$uid);
$studio_info = $studio_obj->query_keke_witkey_studio();
$studio_info = $studio_info[0];



$shop_obj = new Keke_witkey_shop_class();
$shop_obj->setWhere(" uid = '$uid'");
$shop_info_arr  = $shop_obj->query_keke_witkey_shop();
if(count($shop_info_arr)==1){
   $have_shop = TRUE;
   $shope_type = $shop_info_arr[0]['shop_type'];	
}else {
	$have_shop = FALSE;
}
$shop_info = $shop_info_arr[0];

$shop_config = Cache_ext_Class::getConfig('shop');

require 'user_'.$view.'.php';
