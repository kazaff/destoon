<?php


if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}


$shop_info = $shop_info_arr[0];
if (!$shop_info){
	Func_comm_class::showmessage("您没有开通店铺","index.php?do=user",3,"","error");
}

$service_obj = new Keke_witkey_service_class();

$page_obj = new Pages_Class();


if($ac=='del'){
	$service_obj->setService_id(intval($service_id));
	$res = $service_obj->del_keke_witkey_service();
	if($res){
		Func_comm_class::showmessage('商品删除成功！','index.php?do='.$do.'&view='.$view);
	}
}

$where = '  1 = 1 and a.shop_id = '.$shop_info[shop_id];


$page_size = intval($page_size)?intval($page_size):10;


$sql_str = "select  * from
					".TABLEPRE."witkey_service a 
					left join ".TABLEPRE."witkey_shop_cus_cate b on a.cus_cate_id= b.cus_cate_id
					where ";
$sql_count = "select  count(*) as count from
					".TABLEPRE."witkey_service a
					left join ".TABLEPRE."witkey_shop_cus_cate b on a.cus_cate_id= b.cus_cate_id
					where ";
$ct = db_factory::query($sql_count.$where);
$count = $ct[0][count];


$url ='index.php?do='.$do.'&view='.$view.'&page_size='.$page_size;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);
	

$service_arr = db_factory::query($sql_str.$where.$pages[where]);


require_once  $template_obj->template ($do."_".$view);