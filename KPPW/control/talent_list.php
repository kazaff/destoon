<?php

$nav_active_index = "talent";

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}
$nav_active_index = "talent";
if(isset($ajax)&& $ajax){
	if($mid){
		
		$user_info = Func_comm_class::getuserinfo($mid);
		
		$task_obj = new Keke_witkey_task_class();
		$task_obj->setWhere( "task_status = 7 and uid = $mid order by end_time desc limit 0,4 " );
		$task_arr = $task_obj->query_keke_witkey_task();
		
		$service_obj = new Keke_witkey_service_order_class();
		$service_obj->setWhere("sale_uid = $mid and order_status in (2,7) and service_type=1 ");
		$sale_service = $service_obj->count_keke_witkey_service_order();
		$service_obj->setWhere("sale_uid = $mid and order_status in (2,7) and service_type=2");
		$sale_good = $service_obj->count_keke_witkey_service_order();
		
		$sql = "select * from ".TABLEPRE."witkey_service  where uid = $mid order by on_time desc limit 0,5 ";
	    $service_arr = db_factory::query($sql);
		
 	    require_once $template_obj->template ( 'ajax_menu' );
	    die();
	}
}





$space_obj = new Keke_witkey_space_class();
$page_obj = new Pages_Class();


$where = " 1 = 1 ";

$where.= " and a.take_num>0 ";

if($txt_search_title){
	$where.=" and  a.username like '%".$txt_search_title."%'";
}

if(intval($txt_search_id)){
	$where.=" and  a.uid = ".intval($txt_search_id);
}

if(intval($ckb_vip_auth)){
	$where.=" and a.isvip = 1 ";
}

if(intval($ckb_realname_auth)){
	$where.=" and a.realname_auth = 1 ";
}

if(intval($ckb_email_auth)){
	$where.=" and a.email_auth = 1 ";
}

if(intval($ckb_bank_auth)){
	$where.=" and a.bank_auth = 1 ";
}

if(intval($ckb_enterprise_auth)){
	$where.=" and a.enterprise_auth = 1 ";
}

if(intval($slt_indus_id)){
	
	$where .= " and a.indus_id = $slt_indus_id";
	
}else{
	if($slt_indus_pid){
		$indus_arr = Cache_ext_Class::getIndustryList(1,$slt_indus_pid);
		foreach ($indus_arr as $v) {
		  $indus_ids .= $indus_ids?',':'';
		  $indus_ids .= $v['indus_id'];
		}
	  $where.=" and a.indus_id in(".$indus_ids.") ";	
	}
	
	
}

if($slt_province&&$slt_city){
	$where.=" and (a.residency   like '%".$slt_province."%' and a.residency   like '%".$slt_city."%' )";
}elseif($slt_province){
	$where.=" and a.residency   like '%".$slt_province."%'";
}



if($wike_type){
	if(intval($wike_type) == 1)
	{
		$where .= " and a.studio_id<0";
	}elseif (intval($wike_type) ==2 ){
		$where .= " and a.studio_id>0";
	}
}

if(isset($shop_type)){
	if(intval($shop_type)==1){
		$where.="and b.shop_type != 1";
	}elseif(intval($shop_type)==2){
		$where.="and b.shop_type == 1";
	}
}

if(isset($auth_type)){
	if(intval($auth_type)==1){
		$where.="and a.isvip = 1";
	}elseif(intval($auth_type)==2){
		$where.="and a.realname_auth = 1";
	}elseif(intval($auth_type)==3){
		$where.="and a.email_auth = 1";
	}elseif(intval($auth_type)==4){
		$where.="and a.bank_auth = 1";
	}elseif(intval($auth_type)==5){
		$where.="and a.enterprise_auth = 1";
	}
}


switch ($slt_order) {
	case 1:
		$order_where = ' order by a.reg_time desc  ';
	;
	break;
	case 2:
		$order_where = ' order by a.reg_time asc  ';
	;
	break;
	case 3:
		$order_where = ' order by a.w_m_credit_value  asc ';
	;
	break;
	case 4:
		$order_where = ' order by a.w_m_credit_value  desc ';
	;
	break;
	case 5:
		$order_where = ' order by a.experience_value asc  ';
	;
	break;
	case 6:
		$order_where = ' order by a.experience_value desc ';
	;
	break;
	case 7:
		$order_where = ' order by a.buyer_good_rate asc  ';
	;
	break;
	case 8:
		$order_where = ' order by a.buyer_good_rate desc  ';
	;
	break;
	case 9:
		$order_where = ' order by a.seller_good_rate asc  ';
	;
	break;
	case 10:
		$order_where = ' order by a.seller_good_rate desc  ';
	;
	break;
	default:
		$order_where = ' order by a.reg_time asc  ';
		;
	break;
}

$sql_str = "select  
a.uid ,a.username,a.indus_id,a.skill_ids,a.summary,a.residency,
a.reg_time,a.studio_id,a.qq,a.experience_value,a.w_m_credit_value,
a.realname_auth,a.email_auth,a.enterprise_auth,a.bank_auth,a.isvip,
b.shop_id,b.shop_name,b.indus_id,b.job,b.aboutus,b.shop_type,
c.indus_id,c.indus_name,
d.indus_id,d.indus_name as shop_indus_name

from  ".TABLEPRE."witkey_space a 
left join ".TABLEPRE."witkey_shop b on a.uid= b.uid
left join ".TABLEPRE."witkey_industry c on a.indus_id = c.indus_id
left join ".TABLEPRE."witkey_industry d on b.indus_id = d.indus_id where ";

$sql_count = "select  count(*) as count from ".TABLEPRE."witkey_space a
left join ".TABLEPRE."witkey_shop b on a.uid= b.uid
left join ".TABLEPRE."witkey_industry c on a.indus_id = c.indus_id
left join ".TABLEPRE."witkey_industry d on b.indus_id = d.indus_id where ";
$ct = db_factory::query($sql_count.$where);
$count = $ct[0][count];


$order_where = ' order by a.reg_time asc ';


$where=$where.$order_where;

$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;
	
 
$url ="index.php?do=$do&wike_type=$wike_type&cert_type=$cert_type&shop_type=$shop_type&auth_type=$auth_type&slt_page_size=$slt_page_size";
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);
	 
$talent_arr = db_factory::query($sql_str.$where.$pages[where]);


$skill_arr=Cache_ext_Class::gettabledata("witkey_skill","","",null,"skill_id");

$serv_arr = array();
foreach ($talent_arr as $t){
	$serv_arr[$t['uid']]=db_factory::query("select * from ".TABLEPRE."witkey_service where uid={$t['uid']} and !ifnull(is_stop,0) limit 0,2");
}

require_once  $template_obj->template ( $do );