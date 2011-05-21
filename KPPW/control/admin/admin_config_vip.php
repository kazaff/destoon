<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(45);

$vip_rul_obj = new Keke_witkey_vip_rule_class ();
$vip_rul_arr = $vip_rul_obj->query_keke_witkey_vip_rule ();
$vip_rul_count = count($vip_rul_arr)?count($vip_rul_arr):1;
if (isset ( $sbt_edit )) {

	if ($vip_cash_rul_count) {
		for($i = 1; $i <= $vip_cash_rul_count; $i ++) {
			if ($i > 1) {
				if ($_POST ['txt_vip_cash_' . ($i - 1)] >= $_POST ['txt_vip_cash_' . $i] or $_POST ['txt_vip_day_' . ($i - 1)] >= $_POST ['txt_vip_day_' . $i]) {
					Func_comm_class::adminshowmessage ( "规则中第(" . ($i) . ")条规则的时间与金额须大于前一条", "index.php?do=config&view=vip", 10 );
					die ();
				}
			}
		}
	}
	

	$vip_rul_obj->setWhere ( 1 );
	$vip_rul_obj->del_keke_witkey_vip_rule ();
	
	
	for($i = 1; $i <= $vip_cash_rul_count; $i ++) {
		$txt_vip_cash_value = $_POST ['txt_vip_cash_' . $i];
		$txt_vip_day_value = $_POST ['txt_vip_day_' . $i];
		$vip_rul_obj->setVip_rule_id(null);
		$vip_rul_obj->setVip_cash($txt_vip_cash_value);
		$vip_rul_obj->setVip_day($txt_vip_day_value);
	    $vip_rul_obj->create_keke_witkey_vip_rule();
		 
	}
	Cache::delete('keke_witkey_vip_rule');

	Func_comm_class::adminSystemLog("修改招标规则");
    Func_comm_class::adminshowmessage("vip收费规则保存成功！","index.php?do=config&view=vip");
}

require_once $template_obj->template ( 'control/admin/tpl/admin_config_' . $view );