<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}
Func_comm_class::adminCheckRole(2);


$config_pay_obj = new Keke_witkey_paypal_config_class();
$config_pay_info = $config_pay_obj->query_keke_witkey_paypal_config();
$config_pay_info = $config_pay_info[0];
if(isset($sbt_edit)){
	$config_pay_obj->setCurrency($ckb_currency);
	$config_pay_obj->setRecharge_min($txt_recharge_min);
	$config_pay_obj->setWithdraw_min($txt_withdraw_min);
	$config_pay_obj->setWithdraw_max($txt_withdraw_max);
	$config_pay_obj->setWhere("1");
		$res = $config_pay_obj->edit_keke_witkey_paypal_config();
		$config_pay_obj->setWhere("1 limit 1");
		$config_pay_arr = $config_pay_obj->query_keke_witkey_paypal_config();
		if($res){
			Cache::delete("keke_witkey_paypal_config");
			Cache::write($config_pay_arr,"keke_witkey_paypal_config");
			Func_comm_class::adminSystemLog("修改支付接口配置");
			Func_comm_class::adminshowmessage('支付配置设置成功！','index.php?do=config&view=pay');		
		}else{
	
			Func_comm_class::adminshowmessage('支付配置设置失败！','index.php?do=config&view=pay');
		}	
	
}

$payment_list =Cache_ext_Class::getPaymentConfig();

require_once $template_obj->template ( 'control/admin/tpl/admin_config_' . $view );