<?php


if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}



$cove_obj = new Keke_witkey_cash_rule_class ();

if($cove_id){
	$cove_obj->setWhere('cash_rule_id='.intval($cove_id));
	$cove_info = $cove_obj->query_keke_witkey_cash_rule();
	$cove_info = $cove_info[0];
}

if($sbt_edit){
	$cove_obj->setStart_cove($txt_start_cove);
	$cove_obj->setEnd_cove($txt_end_cove);
	$cove_obj->setCove_desc($txt_start_cove.'元—'.$txt_end_cove.'元');
	$cove_obj->setOn_time(time());
	
	if($hdn_cove_id){
		$cove_obj->setWhere("cash_rule_id = '$hdn_cove_id'");
		$res = $cove_obj->edit_keke_witkey_cash_rule();
		if($res){
			Cache::delete("keke_witkey_cash_rule");
			Func_comm_class::adminSystemLog("编辑招标区间$hdn_cove_id");
			Func_comm_class::adminshowmessage('招标区间编辑成功！',"index.php?do=model&model_id=$model_id&view=config");
		}
	}else{
		$res = $cove_obj->create_keke_witkey_cash_rule();
		if($res){
			Cache::delete("keke_witkey_cash_rule");
			Func_comm_class::adminSystemLog("添加招标区间$res");
			Func_comm_class::adminshowmessage('招标区间编辑成功！',"index.php?do=model&model_id=$model_id&view=config");
		}
	}
}

	
if ($ac=='del'){
	if (!$cove_id)Func_comm_class::adminshowmessage('参数错误');
	$cove_obj->setWhere("cash_rule_id=$cove_id");
	$cove_obj->del_keke_witkey_cash_rule();
	Cache::delete("keke_witkey_cash_rule");
	Func_comm_class::adminshowmessage('删除成功！',"index.php?do=model&model_id=$model_id&view=config");
}

require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/control/admin/tpl/model_' . $view );