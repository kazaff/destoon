<?php


if(!defined('IN_KEKE')) {
	exit('Access Denied');
}
$skill_obj = new Keke_witkey_skill_class();

$user_info = Func_comm_class::getuserinfo($uid);



$basic_config = Cache_ext_Class::getConfig("basic");
$indus_arr = Cache_ext_Class::getIndustryList(1);

if($user_info[skill_ids]){
	$skill_obj->setWhere(' skill_id in ( '.$user_info[skill_ids].') ');
	$user_skill_arr = $skill_obj->query_keke_witkey_skill();
}
$task_obj = new Keke_witkey_task_class();
$task_obj->setWhere("uid = '$uid' and task_status<1");
$nopay_task = $task_obj->count_keke_witkey_task();




require_once  $template_obj->template ($do."_".$view);