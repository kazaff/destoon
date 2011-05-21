<?php


if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$reward_cove_arr = array('1'=>'100元以下',
						 '2'=>'100元—500元',
						 '3'=>'500元—1000元',
						 '4'=>'1000元—5000元',
						 '5'=>'5000元以上');


$nav_active_index = 2;

$task_obj = new Keke_witkey_task_class();

$task_ext_obj = new Keke_witkey_task_ext_class();

$indus_obj = new Keke_witkey_industry_class();

$page_obj = new Pages_Class();


$indus_p_arr = Cache_ext_Class::getIndustryList(1,0);

$indus_c_arr = Cache_ext_Class::getIndustryList(1);

$where =' a.model_id = '.$model_id.' and a.task_status in (2,3,4,7) ';


$view = $view?$view:'all';
switch ($view) {
	case 'all':
		$where = $where;
	;
	break;
	case 'proceed':
		$where .= ' and a.task_status = 2 ';
	;
	break;
	case 'sp':
		$where .= ' and a.task_status = 3 ';
	;
	break;
	case 'vote':
		$where .= ' and a.task_status = 4 ';
	;
	break;
	case 'over':
		$where .= ' and a.task_status = 7 ';
	;
	break;
	case 'vip':
		$where .= ' and a.isvip = 1 ';
	;
	break;
	case 'commend':
		$where .= ' and a.istop = 1 ';
	;
	break;
	default:
		$where = $where;
		;
	break;
}


if($indus_id){
	$where.=' and a.indus_id = '.intval($indus_id);
	$indus_obj->setWhere('indus_id = '.intval($indus_id));
	$indus_info = $indus_obj->query_keke_witkey_industry();
	$indus_info = $indus_info[0];
}

if($slt_cash_cove){
	switch (intval($slt_cash_cove)) {
		case 1:
			$where.=' and a.task_cash<100 ' ;
		break;
		case 2:
			$where.=' and a.task_cash>=100 and task_cash<500 ' ;
		break;
		case 3:
			$where.=' and a.task_cash>=500 and task_cash<1000 ' ;
		break;
		case 4:
			$where.=' and a.task_cash>=1000 and task_cash<5000 ' ;
		break;
		case 5:
			$where.=' and a.task_cash>=5000 ' ;
		break;
		default:
			;
		break;
	}
}


switch ($slt_order) {
	case 1:
		$order_where = ' order by  (CASE WHEN a.task_status in (2,3,4) and istop>0 THEN 100 ELSE 0 END) desc,  a.task_cash desc ';
	;
	break;
	case 2:
		$order_where = '  order by  (CASE WHEN a.task_status in (2,3,4) and istop>0 THEN 100 ELSE 0 END) desc,  a.task_cash asc  ';
	;
	break;
	case 3:
		$order_where = ' order by  (CASE WHEN a.task_status in (2,3,4) and istop>0 THEN 100 ELSE 0 END) desc, a.end_time desc  ';
	;
	break;
	case 4:
		$order_where = ' order by  (CASE WHEN a.task_status in (2,3,4) and istop>0 THEN 100 ELSE 0 END) desc,a.end_time asc  ';
	;
	break;
	
	default:
		$order_where = " order by (CASE WHEN a.task_status in (2,3,4) and istop>0 THEN 100 ELSE 0 END) desc,task_id desc";
		;
	break;
}

$page_size = intval($page_size)?intval($page_size):20;
	
$task_ext_obj->setWhere($where);
$count = $task_ext_obj->count_keke_witkey_task();

$url ='index.php?do=task_list&model_id='.$model_id.'&view='.$view;
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


$task_ext_obj->setWhere($where.$pages[where]);

$task_arr = $task_ext_obj->query_keke_witkey_task();

for ($i = 0; $i < count($task_arr); $i++) {
	$task_arr[$i][remaining_time] = Func_comm_class::time2Units($task_arr[$i][end_time]);
}
	
require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/tpl/'.$_K['template']."/task_list" );