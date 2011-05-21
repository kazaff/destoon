<?php

if(!defined('IN_KEKE')) {
	exit('Access Denied');
}


$indus_obj  = new Keke_witkey_industry_class();
$indus_obj->setWhere(' indus_type=1 and is_recommend =1 limit 8');
$indus_arr = $indus_obj->query_keke_witkey_industry();
$indus_all = Cache_ext_Class::getIndustryList(1);

if(isset($ajax)&& $ajax == 'get_service'){
   	$indus_index_arr = Cache_ext_Class::getIndusIndex(1);
	$indus_arr = $indus_index_arr[$indus_id];
	
    $service_arr = db_factory::query("select * from ".TABLEPRE."witkey_service where indus_path like '%|$indus_id|%' and  is_stop<1 limit 0,8   ");
    Func_comm_class::echojson('',1,array('indus'=>$indus_arr,'service'=>$service_arr));
    die();
    	
}


$newshop = Cache_ext_Class::gettabledata("witkey_shop","","shop_id desc",300,"",1,1);
$newshop_config = Cache_ext_Class::gettabledata("witkey_shop_tpl_econfig","shop_logo is not null and shop_logo!=''","shop_id desc ",3000,"",1,1);


$newshopgood = Cache_ext_Class::gettabledata("witkey_service","ad_pic is not null and ad_pic != '' and is_stop<1","service_id desc",3000,'',3);

$feedlist = Cache_ext_Class::gettabledata("witkey_feed","feedtype like '%service%'","feed_id desc",360,'',8);

$new_list = Cache_ext_Class::gettabledata("witkey_service","is_stop!=1","service_id desc",360,'',8);

$hot_zp_list = Cache_ext_Class::gettabledata("witkey_service","is_stop!=1 and service_type=2","sale_num desc",360,'',6);

$hot_fw_list = Cache_ext_Class::gettabledata("witkey_service","is_stop!=1 and service_type=1","sale_num desc",360,'',6);


$order_list = Cache_ext_Class::gettabledata("witkey_service_order","order_status=5","order_id desc",360,'',10);

$buyer_help_arr = Cache_ext_Class::gettabledata("witkey_article", "art_cat_id = 145",'pub_time desc',3600,'',3);

$saler_help_arr = Cache_ext_Class::gettabledata("witkey_article", "art_cat_id = 146",'pub_time desc',3600,'',3);

$faq_help_arr = Cache_ext_Class::gettabledata("witkey_article", "art_cat_id = 147",'pub_time desc',3600,'',3);

if ($uid){
	$shop_obj = new Keke_witkey_shop_class();
	$shop_obj->setWhere("uid=$uid");
	$shop_info = $shop_obj->query_keke_witkey_shop();
	$shop_info = $shop_info[0];
}

$hotp_shop_list = Cache_ext_Class::gettabledata("witkey_shop a inner join ".TABLEPRE."witkey_space b on a.uid=b.uid","(is_close is null or is_close<1) and shop_type = 1","w_m_credit_value desc",3600,"",7);
$hote_shop_list = Cache_ext_Class::gettabledata("witkey_shop a inner join ".TABLEPRE."witkey_space b on a.uid=b.uid","(is_close is null or is_close<1) and shop_type = 2","w_m_credit_value desc",3600,"",7);

$top_sale_list = db_factory::query("select *,(select count(*) from ".TABLEPRE."witkey_service_order b where a.service_id =b.service_id and b.order_status=7 )totalcount,(select sum(count_cash) from ".TABLEPRE."witkey_service_order b where a.service_id =b.service_id and b.order_status=7 )totalcash from ".TABLEPRE."witkey_service a where (select sum(count_cash) from ".TABLEPRE."witkey_service_order b where a.service_id =b.service_id and b.order_status=7 )>0 order by (select sum(count_cash) from ".TABLEPRE."witkey_service_order b where a.service_id =b.service_id and b.order_status=7 )desc limit 0,6");

require_once $template_obj->template("shop/tpl/{$_K['template']}/$do");