<?php
if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(42);

$indus_obj = new Keke_witkey_industry_class();
$skill_obj = new Keke_witkey_skill_class();


$indus_arr = Cache_ext_Class::getIndustryList();
sort($indus_arr);

if($skill_id){
	$skill_obj->setWhere('skill_id='.intval($skill_id));
	$skill_info = $skill_obj->query_keke_witkey_skill();
	$skill_info = $skill_info[0];
	$indus_id = $skill_info[indus_id];
}


if($sbt_edit){
	$skill_obj->setIndus_id($slt_indus_id);
	$skill_obj->setSkill_name($txt_skill_name);
	$skill_obj->setListorder($txt_listorder?$txt_listorder:0);
	$skill_obj->setOn_time(time());
	if($hdn_skill_id){
		$skill_obj->setSkill_id($hdn_skill_id);
		$res = $skill_obj->edit_keke_witkey_skill();
		Cache::delete('keke_witkey_industry');
		if($res){
			Func_comm_class::adminSystemLog("编辑技能$res");
			Func_comm_class::adminshowmessage('技能编辑成功！','index.php?do='.$do.'&view=skill');
		}
	}else{
		$res = $skill_obj->create_keke_witkey_skill();
		Cache::delete('keke_witkey_industry');
		if($res){
			Func_comm_class::adminSystemLog("添加任务$res");
			Func_comm_class::adminshowmessage('技能编辑成功！','index.php?do='.$do.'&view=skill');
		}
	}
}


$temp_arr = array();
Func_comm_class::get_tree($indus_arr,$temp_arr,'option',NULL,'indus_id','indus_pid','indus_name');
$indus_arr = $temp_arr;
unset($temp_arr);


require_once $template_obj->template ( 'control/admin/tpl/admin_task_' . $view );