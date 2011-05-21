<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$shop_info = $shop_info_arr[0];
if (!$shop_info){
	Func_comm_class::showmessage("您没有开通店铺","index.php?do=user",3,"","error");
}
$shop_enterprise_obj = new Keke_witkey_shop_tpl_econfig_class();

$shop_enterprise_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
$shop_enterprise_config = $shop_enterprise_obj->query_keke_witkey_shop_tpl_econfig();
$shop_enterprise_config = $shop_enterprise_config[0];


if($sbt_select_1){
	$shop_enterprise_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
	$shop_enterprise_obj->setTpl_direction(1);
	if ($shop_enterprise_config)
	{
		$res = $shop_enterprise_obj->edit_keke_witkey_shop_tpl_econfig();
	}
	else {
		$shop_enterprise_obj->setShop_id($shop_info['shop_id']);
		$res = $shop_enterprise_obj->create_keke_witkey_shop_tpl_econfig();
	}
	if($res){
		Func_comm_class::showmessage('横向模板选择成功！','index.php?do='.$do.'&view='.$view);
	}
}

if($sbt_select_2){
	$shop_enterprise_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
	$shop_enterprise_obj->setTpl_direction(2);
	if ($shop_enterprise_config)
	{
		$res = $shop_enterprise_obj->edit_keke_witkey_shop_tpl_econfig();
	}
	else {
		$shop_enterprise_obj->setShop_id($shop_info['shop_id']);
		$res = $shop_enterprise_obj->create_keke_witkey_shop_tpl_econfig();
	}
	if($res){
		Func_comm_class::showmessage('纵向模板选择成功！','index.php?do='.$do.'&view='.$view);
	}
}

require_once  $template_obj->template ($do."_".$view);