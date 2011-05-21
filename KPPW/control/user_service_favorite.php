<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$page_obj = new Pages_Class();

$fav_obj = new Keke_witkey_favorite_class();

if($ac=='del'&& isset($f_id)){
	
	$fav_obj->setWhere(" uid = $uid and f_id = $f_id ");
	$res = $fav_obj->del_keke_witkey_favorite();
	if($res){
		Func_comm_class::showmessage('收藏商品删除成功！','index.php?do='.$do.'&view='.$view);
	}
}


$page_size = intval($page_size)?intval($page_size):10;
	

$where = " uid = $uid and obj_type=1 ";

$fav_obj->setWhere($where);
$fav_count = $fav_obj->count_keke_witkey_favorite();

$url ='index.php?do='.$do.'&view='.$view.'&page_size='.$page_size;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$page_size;
$pages = $page_obj->getPages($fav_count,$limit,$page,$url);

$fav_obj->setWhere($where.$pages['where']);
$fav_arr  = $fav_obj->query_keke_witkey_favorite();

require_once  $template_obj->template ($do."_".$view);