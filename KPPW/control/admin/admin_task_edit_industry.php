<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(19);




$indus_obj = new Keke_witkey_industry_class();


$indus_arr = Cache_ext_Class::getIndustryList(1);


if($indus_id){

	$indus_info = $indus_arr[$indus_id];
	$indus_pid = $indus_info[indus_pid];
}

if($sbt_edit){
	$indus_obj->setIndus_pid($slt_indus_id);
	$indus_obj->setIndus_type(1);
	$indus_obj->setIndus_name($txt_indus_name);
	$indus_obj->setListorder($txt_listorder?$txt_listorder:0);
	$indus_obj->setIs_recommend(intval($chk_is_recommend));
	$indus_obj->setOn_time(time());
	if($hdn_indus_id){
		$indus_obj->setIndus_id($hdn_indus_id);
		$res = $indus_obj->edit_keke_witkey_industry();
		Cache::delete('keke_witkey_industry');
		if($res){
			Func_comm_class::adminSystemLog("编辑行业$hdn_indus_id");
			Func_comm_class::adminshowmessage('行业编辑成功！','index.php?do=task&view=industry');
		}
	}else{
		$res = $indus_obj->create_keke_witkey_industry();
		Cache::delete('keke_witkey_industry');
		if($res){
			Func_comm_class::adminSystemLog("添加行业$res");
			Func_comm_class::adminshowmessage('行业编辑成功！','index.php?do=task&view=industry');
		}
	}
}



$temp_arr = array();
Func_comm_class::get_tree($indus_arr,$temp_arr,'option',$indus_pid,'indus_id','indus_pid','indus_name');
$indus_arr = $temp_arr;
unset($temp_arr);


require_once $template_obj->template ( 'control/admin/tpl/admin_task_' . $view );