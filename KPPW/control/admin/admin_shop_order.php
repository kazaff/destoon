<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$order_obj = new Keke_witkey_service_order_class();

$page_obj = new Pages_Class();

$indus_arr = Cache_ext_Class::getIndustryList(1);


$where = ' 1 = 1 ';




switch ($ord) {
	case 1:
		$where.=' order by order_id desc ';
	;
	break;
	case 2:
		$where.=' order by order_id asc ';
	;
	break;
	case 3:
		$where.=' order by count_cash desc ';
	;
	break;
	case 4:
		$where.=' order by count_cash asc ';
	;
	break;
	default:
		$where.=' order by order_id desc ';
	break;
}


$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;
	

$order_obj->setWhere($where);
$count = $order_obj->count_keke_witkey_service_order();


$url ='index.php?do='.$do.'&view='.$view;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);


$order_obj->setWhere($where.$pages[where]);
$order_arr = $order_obj->query_keke_witkey_service_order();




switch ($ac) {	
	case 'del':
		if($order_id){
			$order_obj->setWhere('order_id='.$order_id);
			$res = $order_obj->del_keke_witkey_service_order();
			Func_comm_class::adminSystemLog("删除订单$order_id");
			Func_comm_class::adminshowmessage('订单删除成功！','index.php?do='.$do.'&view='.$view);
		}else{
			Func_comm_class::adminshowmessage('订单不存在，删除失败！','index.php?do='.$do.'&view='.$view);
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
		$order_obj->setWhere(' order_id in ('.$ids.') ');
		switch ($sbt_action) {
			case '直接删除' : 
				$res = $order_obj->del_keke_witkey_service_order();
				Func_comm_class::adminSystemLog("删除订单$ids");
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