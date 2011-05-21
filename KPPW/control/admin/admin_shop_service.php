<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$service_obj = new Keke_witkey_service_class();

$page_obj = new Pages_Class();

$indus_arr = Cache_ext_Class::getIndustryList(1);


$where = ' 1 = 1 ';


if(isset($sbt_search)){
	if($txt_id){
		$where.=' and service_id = '.$txt_id;
	}
	if($txt_title){
		$where.=' and title like '.'"%'.$txt_title.'%" ';
	}
	if($slt_service_type){
		$where.=' and service_type = '.intval($slt_service_type);
	}
	if($slt_indus_id){
		$where.=' and indus_id ='.intval($slt_indus_id);
	}
}


switch ($ord) {
	case 1:
		$where.=' order by shop_id desc ';
	;
	break;
	case 2:
		$where.=' order by shop_id asc ';
	;
	break;
	default:
		$where.=' order by shop_id desc ';
	break;
}



$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;
	

$service_obj->setWhere($where);
$count = $service_obj->count_keke_witkey_service();


$url ='index.php?do='.$do.'&view='.$view.'&slt_page_size='.$slt_page_size.'&txt_id='.$txt_id.'&txt_title='.$txt_title.'&slt_service_type='.$slt_service_type.'&slt_indus_id='.$slt_indus_id.'&ord='.$ord;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);


$service_obj->setWhere($where.$pages[where]);
$service_arr = $service_obj->query_keke_witkey_service();




switch ($ac) {	
	case 'del':
		if($service_id){
			$service_obj->setWhere('service_id='.$service_id);
			$res = $service_obj->del_keke_witkey_service();	
			Func_comm_class::adminSystemLog("删除商品$bank_a_id");
			Func_comm_class::adminshowmessage('商品删除成功！','index.php?do='.$do.'&view='.$view);
		}else{
			Func_comm_class::adminshowmessage('商品不存在，删除失败！','index.php?do='.$do.'&view='.$view);
		}
	;
	break;
	default:
		;
	break;
}




if (isset ( $sbt_action )) {
	$keyids = $ckb;
	
	 if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	 }
	if (count ( $keyids )) {
		$service_obj->setWhere(' service_id in ('.$ids.') ');
		switch ($sbt_action) {
			case '直接删除' : 
				$res = $service_obj->del_keke_witkey_service();
				Func_comm_class::adminSystemLog("删除商品$ids");
				break;
			break;
		}
		
		if($res){
			Func_comm_class::adminshowmessage('批量操作成功！','index.php?do='.$do.'&view='.$view);
		}else{
			Func_comm_class::adminshowmessage('批量操作失败，请重新操作！','index.php?do='.$do.'&view='.$view);
		}
		
	} else {
		Func_comm_class::adminshowmessage('请选择要操作的项！','index.php?do='.$do.'&view='.$view);
	}
}


require_once $template_obj->template ( 'control/admin/tpl/admin_'.$do.'_' . $view );