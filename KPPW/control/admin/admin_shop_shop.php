<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}



$shop_obj = new Keke_witkey_shop_class();

$page_obj = new Pages_Class();

$indus_arr = Cache_ext_Class::getIndustryList(1);
$shop_member_obj=new Keke_witkey_shop_member_class();

$shop_menu_obj=new Keke_witkey_shop_menu_class();

$shop_tpl_pconfig_obj=new Keke_witkey_shop_tpl_pconfig_class();

$shop_case_obj=new Keke_witkey_shop_case_class();

$shop_cus_cate=new Keke_witkey_service_class();


$where = ' 1 = 1 ';

if(isset($sbt_search)){
	if($txt_id){
		$where.=' and shop_id = '.$txt_id;
	}
	if($txt_title){
		$where.=' and shop_name like '.'"%'.$txt_title.'%" ';
	}
	if($slt_banner_type){
		$where.=' and shop_type = '.intval($slt_banner_type);
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
	case 3:
		$where.=' order by shop_id desc ';
	;
	break;
	case 4:
		$where.=' order by shop_id asc ';
	;
	break;
	default:
		$where.=' order by shop_id desc ';
	break;
}


$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;
	

$shop_obj->setWhere($where);
$count = $shop_obj->count_keke_witkey_shop();


$url ='index.php?do='.$do.'&view='.$view.'&slt_page_size='.$slt_page_size.'&txt_id='.$txt_id.'&txt_title='.$txt_title.'&slt_banner_type='.$slt_banner_type.'&slt_indus_id='.$slt_indus_id.'&ord='.$ord;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);


$shop_obj->setWhere($where.$pages[where]);
$shop_arr = $shop_obj->query_keke_witkey_shop();


switch ($ac) {	
	case 'del':
		if($shop_id){
			$shop_obj->setWhere('shop_id='.$shop_id);
			$shop_member_obj->setWhere("shop_id=$shop_id");
		 	$shop_member_obj->del_keke_witkey_shop_member();
			  	
		 	$shop_menu_obj->setWhere("shop_id=$shop_id");
		  	$shop_menu_obj->del_keke_witkey_shop_menu();
				
			$shop_tpl_pconfig_obj->setWhere("shop_id=$shop_id");
			$shop_tpl_pconfig_obj->del_keke_witkey_shop_tpl_pconfig();
			
			$shop_case_obj->setWhere("shop_id=$shop_id");
			$shop_case_obj->del_keke_witkey_shop_case();
				
			$shop_cus_cate->setWhere("shop_id=$shop_id");
			$shop_cus_cate->del_keke_witkey_service();
			$res = $shop_obj->del_keke_witkey_shop();	
			Func_comm_class::adminSystemLog("删除店铺$bank_a_id");
			Func_comm_class::adminshowmessage('店铺删除成功！','index.php?do='.$do.'&view='.$view);
		}else{
			Func_comm_class::adminshowmessage('店铺不存在，删除失败！','index.php?do='.$do.'&view='.$view);
		}
	;
	break;
	default:
		;
	break;
}


if (isset ( $sbt_action )) {
	$keyids = $ckb;
	//var_dump($keyids);die();
	 if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	 }
	if (count ( $keyids )) {
		$shop_obj->setWhere(' shop_id in ('.$ids.') ');
		switch ($sbt_action) {
			case '直接删除' : 
				$shop_member_obj->setWhere(' shop_id in ('.$ids.') ');
			 	$shop_member_obj->del_keke_witkey_shop_member();
				  	
			 	$shop_menu_obj->setWhere(' shop_id in ('.$ids.') ');
			  	$shop_menu_obj->del_keke_witkey_shop_menu();
					
				$shop_tpl_pconfig_obj->setWhere(' shop_id in ('.$ids.') ');
				$shop_tpl_pconfig_obj->del_keke_witkey_shop_tpl_pconfig();
				
				$shop_case_obj->setWhere(' shop_id in ('.$ids.') ');
				$shop_case_obj->del_keke_witkey_shop_case();
					
				$shop_cus_cate->setWhere(' shop_id in ('.$ids.') ');
				$shop_cus_cate->del_keke_witkey_service();
				$res = $shop_obj->del_keke_witkey_shop();
				Func_comm_class::adminSystemLog("删除店铺$ids");
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