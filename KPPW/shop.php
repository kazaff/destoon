<?php
define("IN_KEKE",TRUE);
include_once 'app_comm.php';
$dos = array ('index','order','step','service_info','service_list','shop');

$do = (! empty ( $_GET ['do'] ) && in_array ( $_GET ['do'], $dos )) ? $_GET ['do'] : 'index';
if ($do=='index'){
$do = in_array($_K['template'],array('red','orange'))?'service_list':'index';
}

$basic_config = Cache_ext_Class::getConfig('basic');
$shop_config = Cache_ext_Class::getConfig('shop');
if ($shop_config['shop_is_close']){
	Func_comm_class::showmessage("商城已关闭","index.php",3,'','error');
}

$_K['website_name'] = $basic_config[website_name];

$_K['website_url'] = $basic_config[website_url];

$_K['html_title'] = $basic_config['seo_title'];
if (!$basic_config['seo_title']){
$_K['html_title'] = $basic_config[website_name];}

$_K['seo_keyword'] = $basic_config[seo_keyword];

$_K['seo_description'] = $basic_config[seo_desc];

$_K['web_logo'] = $basic_config[web_logo];

$_K['kf_phone'] = $basic_config[kf_phone];

$_K['phone'] = $basic_config[phone];

$_K['filing'] = $basic_config[filing];

$_K['stats_code'] = $basic_config[stats_code];

$_K['company']  = $basic_config[company];

$_K['address'] = $basic_config[address];

$_K['postcode'] = $basic_config[postcode];

if( $_SESSION['uid']){
	$uid = intval($_SESSION['uid']);
	$username= $_SESSION['username'];
	$msg_obj = new Keke_witkey_message_class();
	$msg_obj->setWhere("recive_uid = '$uid' and view_status=0");
	$messagecount = $msg_obj->count_keke_witkey_message();
	
	$shop_info = Func_comm_class::get_shop_info($uid);
}

if($basic_config[is_close]==1){
	Func_comm_class::showmessage('站点已被管理员关闭，暂时无法访问！','index.php',2,'站点已被管理员关闭，关闭原因：'.$basic_config[close_reason].'！','error');die();
}

if ($uid&&!$_COOKIE['header_order_list']){
	$header_order_list = db_factory::query("select * from ".TABLEPRE."witkey_service_order where 
		(ifnull(order_status,0)<1 and buy_uid ='$uid' and ifnull(buyer_status,0)>0 and ifnull(sale_status,0)>0) or
		(ifnull(order_status,0)<1 and sale_uid ='$uid' and ifnull(buyer_status,0)>0 and ifnull(sale_status,0)<1) or
		(ifnull(order_status,0)<1 and buy_uid ='$uid' and ifnull(buyer_status,0)<1 and ifnull(sale_status,0)>0) or
		(order_id in (select order_id from ".TABLEPRE."witkey_service_order_detail where step_status=2) and buy_uid = '$uid')
		limit 0,5
	");
	setcookie('header_order_list',serialize($header_order_list));
}
elseif ($uid){
	$header_order_list = unserialize($_COOKIE['header_order_list']);
}
$indus_p_arr =  Cache_ext_Class::gettabledata ( "witkey_industry", "indus_type=1 and indus_pid = 0 ", "indus_id asc ", NULL );
$indus_c_arr = $indus_sub_arr = Cache_ext_Class::gettabledata ( 'witkey_industry', 'indus_type=1 and indus_pid >0', '', NULL, 'indus_id' );
$indus_arr = Cache_ext_Class::gettabledata('witkey_industry','indus_type=1','',NULL,'indus_id');


require_once  S_ROOT.'./shop/control/' . $do . '.php';