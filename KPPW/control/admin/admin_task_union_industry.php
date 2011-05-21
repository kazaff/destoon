<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(20);

$indus_arr = Cache_ext_Class::getIndustryList(1);


if (isset($sbt_edit)){

	db_factory::execute("update ".TABLEPRE."witkey_industry set indus_pid = $to_indus_id where indus_pid = $slt_indus_id");
	
	
	$indus_path = '';
	$k = $to_indus_id;
	while ($indus_arr[$k]){
		$ti = $indus_arr[$k];
		$indus_path = '|'.$ti['indus_id'].'|'.$indus_path;
		$k = $ti['indus_pid'];
	}
	db_factory::execute("update ".TABLEPRE."witkey_service set indus_id = $to_indus_id,indus_path = '$indus_path' where indus_id = $slt_indus_id");
	
	
	db_factory::execute("update ".TABLEPRE."witkey_shop set indus_id = $to_indus_id where indus_id = $slt_indus_id");
	
	db_factory::execute("update ".TABLEPRE."witkey_skill set indus_id = $to_indus_id where indus_id = $slt_indus_id");
	
	db_factory::execute("update ".TABLEPRE."witkey_task set indus_id = $to_indus_id where indus_id = $slt_indus_id");
	
	db_factory::execute("delete from ".TABLEPRE."witkey_industry where indus_id = $slt_indus_id");
	
	Func_comm_class::adminshowmessage("行业合并成功","index.php?do=task&view=industry");
	
}

$temp_arr = array();
Func_comm_class::get_tree($indus_arr,$temp_arr,'option',$indus_pid,'indus_id','indus_pid','indus_name');

require_once $template_obj->template ( 'control/admin/tpl/admin_'.$do.'_' . $view );
