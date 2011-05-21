<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$shop_member_obj = new Keke_witkey_shop_member_class();

$page_obj = new Pages_Class();
$shop_info = $shop_info_arr[0];
if (!$shop_info){
	Func_comm_class::showmessage("您没有开通店铺","index.php?do=user",3,"","error");
}


$where = ' 1 = 1 and shop_id = '.intval($shop_info[shop_id]);


$page_size = intval($page_size)?intval($page_size):10;
	

$shop_member_obj->setWhere($where);
$count = $shop_member_obj->count_keke_witkey_shop_member();


$url ='index.php?do='.$do.'&view='.$view.'&page_size='.$page_size;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);
	

$shop_member_obj->setWhere($where.$pages[where]);
$shop_member_arr = $shop_member_obj->query_keke_witkey_shop_member();


if($ac=='del'){
	$shop_member_obj->setWhere(' shop_member_id = '.$shop_member_id);
	$res = $shop_member_obj->del_keke_witkey_shop_member();
	if($res){
		Func_comm_class::showmessage('店铺成员删除成功！','index.php?do='.$do.'view='.$view);
	}
}

require_once  $template_obj->template ($do."_".$view);