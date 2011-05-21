<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$nav_active_index = "tender";
$task_obj = new Keke_witkey_task_class();

$indus_obj = new Keke_witkey_industry_class();

$cash_rule_obj = new Keke_witkey_cash_rule_class;

$cash_rule_arr = Cache_ext_Class::getConfigRule('cash');

$page_obj = new Pages_Class();


$indus_p_arr = Cache_ext_Class::getIndustryList(1,0);
$indus_c_arr = Cache_ext_Class::getIndustryList(1);

$where =' model_id = '.$model_id.' and task_status in (2,3,4,5,7) ';

$view = $view?$view:'all';
switch ($view) {
	case 'all':
		$where = $where;
	;
	break;
	case 'proceed':
		$where .= ' and task_status = 2 ';
	;
	break;
	case 'over':
		$where .= ' and task_status = 7 ';
	;
	break;
	case 'vip':
		$where .= ' and isvip = 1 ';
	;
	break;
	case 'commend':
		$where .= ' and istop = 1 ';
	;
	break;
	default:
		$where = $where;
		;
	break;
}

if($indus_id){
	$where.=' and indus_id = '.intval($indus_id);
	$indus_info = $indus_obj->query_keke_witkey_industry();
	$indus_info = $indus_info[0];
}

if($slt_cash_cove){
	$where.=' and task_cash_coverage = '.intval($slt_cash_cove);
}


switch ($slt_order) {
	case 1:
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc,task_cash_coverage desc  ';
	;
	break;
	case 2:
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc,task_cash_coverage asc  ';
	;
	break;
	case 3:
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc,end_time desc  ';
	;
	break;
	case 4:
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc,end_time asc  ';
	;
	break;
	
	default:
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc,task_id desc  ';
		;
	break;
}



$page_size = intval($page_size)?intval($page_size):20;

$task_obj->setWhere($where);
$count = $task_obj->count_keke_witkey_task();

$url ='index.php?do='.$do.'&view='.$view.'&model_id='.$model_id;
if($page_size){
 	$url.='&page_size='.$page_size;
}
if(intval($indus_id)){
	$url.='&indus_id='.$indus_id;
}
if(intval($slt_cash_cove)){
	$url.='&slt_cash_cove='.$slt_cash_cove;
}
if(intval($slt_order)){
	$url.='&slt_order='.$slt_order;
}
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);

$where .= $order_where;

$task_obj->setWhere($where.$pages[where]);
$task_arr = $task_obj->query_keke_witkey_task();

for ($i = 0; $i < count($task_arr); $i++) {
	$task_arr[$i][remaining_time] = Func_comm_class::time2Units($task_arr[$i][end_time]);
}
	
require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/tpl/'.$_K['template']."/task_list" );

