<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$shop_info = $shop_info_arr[0];

$order_obj = new Keke_witkey_service_order_class();

$page_obj = new Pages_Class();


$where = '  1 = 1 and a.sale_uid = '.$uid;
if($by){
	$where .= " and a.order_status=$by";
}


$page_size = intval($page_size)?intval($page_size):10;
	


$sql_str = "select  *,a.title from
					".TABLEPRE."witkey_service_order a 
					left join ".TABLEPRE."witkey_service b on a.service_id= b.service_id
					where ";
$sql_count = "select  count(*) as count from
					".TABLEPRE."witkey_service_order a
					left join ".TABLEPRE."witkey_service b on a.service_id= b.service_id
					where ";
$ct = db_factory::query($sql_count.$where);
$count = $ct[0][count];


$url ='index.php?do='.$do.'&view='.$view.'&page_size='.$page_size;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);

$order_arr = db_factory::query($sql_str.$where.$pages[where]);


require_once  $template_obj->template ($do."_".$view);