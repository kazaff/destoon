<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}
$temp = Cache_ext_Class::gettabledata("witkey_rule","","",null);
$rule_list = array();
foreach ($temp as $t){
	$rule_list[$t['rule_key']][$t['rule_group']]=$t['rule'];
}
include 'task_config.php';
$score_rule = Cache_ext_Class::gettabledata("witkey_score_rule","","max_score",null);


$config_tender_obj = new Keke_witkey_zb_task_config_class();

$cove_arr = Cache_ext_Class::getConfigRule('cash');
$cove_count = count($cove_arr)?count($cove_arr):1;

$config_tender_obj->setWhere(' 1 limit 1 ');
$config_tender_info = $config_tender_obj->query_keke_witkey_zb_task_config();
$config_tender_info = $config_tender_info[0];


if(isset($sbt_edit)){
	$config_tender_obj->setIs_open_zb($rdo_is_open_zb?$rdo_is_open_zb:2);
	$txt_zb_fees = floatval($txt_zb_fees);
	$config_tender_obj->setZb_fees($txt_zb_fees?$txt_zb_fees:0);
	$config_tender_obj->setZb_max_time(intval($txt_zb_max_time)?intval($txt_zb_max_time):0);
	$config_tender_obj->setZb_audit($ckb_zb_audit?$ckb_zb_audit:2);
	$config_tender_obj->setVip_task_istop($ckb_vip_task_istop?$ckb_vip_task_istop:2);
	$config_tender_obj->setVip_sign_istop($ckb_vip_sign_istop?$ckb_vip_sign_istop:2);
	$config_tender_obj->setOn_time(time());

	
	if($hdn_zb_config_id){
		$config_tender_obj->setZb_config_id($hdn_zb_config_id);
		$res = $config_tender_obj->edit_keke_witkey_zb_task_config();
		$config_tender_obj->setWhere(" 1 limit 1");
		$config_tender_arr = $config_tender_obj->query_keke_witkey_zb_task_config();
		if($res){
			Cache::delete("keke_witkey_zb_task_config");
			Cache::write($config_tender_arr,"keke_witkey_zb_task_config");
			Func_comm_class::adminSystemLog("修改招标任务配置");
			Func_comm_class::adminshowmessage('招标任务配置修改成功！',"index.php?do=model&model_id=$model_id&view=config");
		}		
	}else{
		$res = $config_tender_obj->create_keke_witkey_zb_task_config();
		$config_tender_obj->setWhere(" 1 limit 1");
		$config_tender_arr = $config_tender_obj->query_keke_witkey_zb_task_config();
		if($res){
			Cache::write($config_tender_arr,"keke_witkey_zb_task_config");
			Func_comm_class::adminshowmessage('招标任务配置保存成功！',"index.php?do=model&model_id=$model_id&view=config");
		}	
	}
}

require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/control/admin/tpl/model_' . $view );