<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(45);


$ad_obj = new Keke_witkey_ad_class();
$page_obj = new Pages_Class();

$where = ' 1 = 1  ';





if(isset($sbt_search)){
	if($slt_ad_type){
		$where.=' and ad_type = '.$slt_ad_type;
	}
	if($txt_id){
		$where.=' and ad_id = '.$txt_id;
	}
	if($txt_title){
		$where.=' and ad_name like '.'"%'.$txt_title.'%" ';
	}
}


switch ($ord) {
	case 1:
		$where.=' order by ad_id desc ';
	;
	break;
	case 2:
		$where.=' order by ad_id asc ';
	;
	break;
	case 3:
		$where.=' order by start_time desc ';
	;
	break;
	case 4:
		$where.=' order by start_time asc ';
	;
	break;
	case 5:
		$where.=' order by end_time desc ';
	;
	break;
	case 6:
		$where.=' order by end_time asc ';
	;
	break;
	case 7:
		$where.=' order by listorder desc ';
	;
	break;
	case 8:
		$where.=' order by listorder asc ';
	;
	break;
	case 9:
		$where.=' order by ad_cash desc ';
	;
	break;
	case 10:
		$where.=' order by ad_cash asc ';
	;
	break;
	default:
		$where.=' order by start_time desc ';
	break;
}



$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;
	

$ad_obj->setWhere($where);
$count = $ad_obj->count_keke_witkey_ad();


$url ='index.php?do='.$do.'&view='.$view.'&slt_page_size='.$slt_page_size.'&txt_id='.$txt_id.'&txt_title='.$txt_title;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);


$ad_obj->setWhere($where.$pages[where]);
$ad_arr = $ad_obj->query_keke_witkey_ad();


if($ac=='del'){
	if($ad_id){
		$ad_obj->setWhere('ad_id='.$ad_id);
		$res = $ad_obj->del_keke_witkey_ad();
		Func_comm_class::adminSystemLog("删除广告$ad_id");
		Func_comm_class::adminshowmessage('广告删除成功！','index.php?do='.$do.'&view='.$view);
	}else{
		Func_comm_class::adminshowmessage('广告不存在，删除失败！','index.php?do='.$do.'&view='.$view);
	}
}


if (isset ( $sbt_action )) {
	$keyids = $ckb;

	 if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	 }
	if (count ( $keyids )) {
		
		$ad_obj->setWhere(' ad_id in ('.$ids.') ');
		switch ($sbt_action) {
		
			case '批量删除' : 
				$res = $ad_obj->del_keke_witkey_ad();
				Func_comm_class::adminSystemLog("删除广告$ids");
				break;
			default : 
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


require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do . '_' . $view );