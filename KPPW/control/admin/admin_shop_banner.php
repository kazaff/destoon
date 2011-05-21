<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$banner_obj = new Keke_witkey_shop_banner_class();

$page_obj = new Pages_Class();

$indus_arr = Cache_ext_Class::getIndustryList(1);

$where = ' 1 = 1 ';


if(isset($sbt_search)){
	if($txt_id){
		$where.=' and banner_id = '.$txt_id;
	}
	if($txt_title){
		$where.=' and img_name like '.'"%'.$txt_title.'%" ';
	}
	if($slt_banner_type){
		$where.=' and banner_type = '.intval($slt_banner_type);
	}
	if($slt_indus_id){
		$where.=' and indus_id ='.intval($slt_indus_id);
	}
}



switch ($ord) {
	case 1:
		$where.=' order by banner_id desc ';
	;
	break;
	case 2:
		$where.=' order by banner_id asc ';
	;
	break;
	case 3:
		$where.=' order by banner_id desc ';
	;
	break;
	case 4:
		$where.=' order by banner_id asc ';
	;
	break;
	default:
		$where.=' order by banner_id desc ';
	break;
}



$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;
	

$banner_obj->setWhere($where);
$count = $banner_obj->count_keke_witkey_shop_banner();


$url ='index.php?do='.$do.'&view='.$view.'&slt_page_size='.$slt_page_size.'&txt_id='.$txt_id.'&txt_title='.$txt_title;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);


$banner_obj->setWhere($where.$pages[where]);
$banner_arr = $banner_obj->query_keke_witkey_shop_banner();




switch ($ac) {	
	case 'del':
		if($banner_id){
			$banner_obj->setWhere('banner_id='.$banner_id);
			$res = $banner_obj->del_keke_witkey_shop_banner();	
			Func_comm_class::adminSystemLog("删除主题申请$bank_a_id");
			Func_comm_class::adminshowmessage('主题删除成功！','index.php?do='.$do.'&view='.$view);
		}else{
			Func_comm_class::adminshowmessage('主题不存在，删除失败！','index.php?do='.$do.'&view='.$view);
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
		$banner_obj->setWhere(' banner_id in ('.$ids.') ');
		switch ($sbt_action) {
			case '直接删除' : 
				$res = $banner_obj->del_keke_witkey_shop_banner();	
				Func_comm_class::adminSystemLog("删除主题申请$ids");
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