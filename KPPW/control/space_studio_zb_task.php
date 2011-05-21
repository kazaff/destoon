<?php

$studio_obj = new Keke_witkey_studio_class();
$studio_member_obj = new Keke_witkey_studio_member_class();
$task_obj = new Keke_witkey_task_class();
$mark_obj = new Keke_witkey_mark_log_class();
$task_ext_obj = new Keke_witkey_task_ext_class();
$page_obj = new Pages_Class();


$cash_rule_arr = Cache_ext_Class::getConfigRule('cash');


$studio_obj->setWhere(' studio_id = '.$space_info[studio_id]);
$studio_info = $studio_obj->query_keke_witkey_studio();
$studio_info = $studio_info[0];

$studio_member_obj->setWhere(' studio_id = '.$space_info[studio_id]);
$studio_member_arr = $studio_member_obj->query_keke_witkey_studio_member();

$where = ' 1 = 1  ';

if (is_array($studio_member_arr)){
	foreach ($studio_member_arr as $value) {
		$uids.=$value[uid].',' ;
	}
}
$uids.='0';

$mark_obj->setWhere('  mark_type = 1 and  uid in ('.$uids.') ');
$mark_arr = $mark_obj->query_keke_witkey_mark_log();

if(is_array($mark_arr)){
	foreach ($mark_arr as $value) {
		$task_ids.=$value[obj_id].',' ;
	}
}
$task_ids.='0';

$where .= ' and a.task_id in('.$task_ids.')';


$page_size = intval($page_size)?intval($page_size):15;
	

$task_ext_obj->setWhere($where);
$count = $task_ext_obj->count_keke_witkey_task();


$url ='index.php?do='.$do.'&view='.$view.'&op='.$op.'&page_size='.$page_size.'&indus_id='.$indus_id.'&slt_cash_cove='.$slt_cash_cove.'&slt_order='.$slt_order.'&member_id='.$member_id;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);


$task_ext_obj->setWhere($where.$pages[where]);
$task_arr = $task_ext_obj->query_keke_witkey_task();


for ($i = 0; $i < count($task_arr); $i++) {
	$task_arr[$i][remaining_time] = Func_comm_class::time2Units($task_arr[$i][end_time]);
}
require_once $template_obj->template ( $do . "_" . $view );