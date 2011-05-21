<?php

if(!defined('ADMIN_KEKE')) {
	exit('Access Denied');
}
 

$unit_image_obj = new Keke_witkey_unit_image_class();

$page_obj = new Pages_Class();
$wh = " 1 = 1 ";

if(isset($sbt_search)){
	if($slt_unit_type){
		$wh .= " and unit_type = '$slt_unit_type' ";
	}
	if($txt_unit_name){
		$wh .= " and unit_name like '%'.$txt_title.'%' ";
	}
	
}

switch ($ord) {
	case 1:
	  $wh .= "order by unit_id  desc";		
	break;
	
	case 2:
		$wh .= "order by unit_id asc";
	break;
}




$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;
	

$unit_image_obj->setWhere( $wh );
$count = $unit_image_obj->count_keke_witkey_unit_image();



$url ='index.php?do='.$do.'&slt_unit_type='.$slt_unit_type.'&txt_unit_name='.$txt_unit_name.'&slt_page_size='.$slt_page_size;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);



$unit_image_obj->setWhere($wh.$pages[where]);
$unit_show_arr = $unit_image_obj->query_keke_witkey_unit_image();



if(isset($ac) && $ac == "del")
{
	$unit_image_obj->setWhere(" unit_id = '$unit_id'" );
	$res = $unit_image_obj->del_keke_witkey_unit_image();
	if($res){
		Func_comm_class::adminshowmessage("删除成功！","index.php?do=$do");
	}else{
		Func_comm_class::adminshowmessage("删除失败！","index.php?do=$do");
	}
	
}


if(isset($sbt_action)){
   $keyids = $ckb;
	if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	}
	$unit_image_obj->setWhere( "unit_id  in ('$ids')" );
	$res = $unit_image_obj->del_keke_witkey_unit_image();
	if($res){
		Func_comm_class::adminshowmessage("批量删除成功！","index.php?do=$do");
	}else{
		Func_comm_class::adminshowmessage("批量删除失败！","index.php?do=$do");
	}
}

require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do );