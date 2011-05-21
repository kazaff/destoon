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

if ($sbt__color){
	$shop_enterprise_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
	$txt_back_color = $txt_back_color?"#$txt_back_color":"";
	$txt_menu_color = $txt_menu_color?"#$txt_menu_color":"";
	$txt_font_color = $txt_font_color?"#$txt_font_color":"";
	$shop_enterprise_obj->setAc_menu_color($txt_menu_color);
	$shop_enterprise_obj->setBackground($txt_back_color);
	$shop_enterprise_obj->setFont_color($txt_font_color);
	$shop_enterprise_obj->edit_keke_witkey_shop_tpl_econfig();
	Func_comm_class::showmessage("配置成功","index.php?do=$do&view=$view");
}


if($op=='modifyskin'){
	$shop_enterprise_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
	$shop_enterprise_obj->setSkin_color($skin_color);
	$res = $shop_enterprise_obj->edit_keke_witkey_shop_tpl_econfig();
	echo($res);	die();
}


require_once  $template_obj->template ($do."_".$view);