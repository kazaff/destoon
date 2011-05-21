<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$shop_info = $shop_info_arr[0];
if (!$shop_info){
	Func_comm_class::showmessage("您没有开通店铺","index.php?do=user",3,"","error");
}
$shop_person_obj = new Keke_witkey_shop_tpl_pconfig_class();
$shop_menu = new Keke_witkey_shop_menu_class();

$shop_person_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
$shop_person_config = $shop_person_obj->query_keke_witkey_shop_tpl_pconfig();
$shop_person_config = $shop_person_config[0];

$shop_menu->setWhere(' shop_id= '.$shop_info[shop_id]);
$menu_info = $shop_menu->query_keke_witkey_shop_menu();
$menu_info = $menu_info[0];
include_once 'shop/control/header_menu_default.php';
$menu = $menu_arr[$shop_info['shop_type']];
if (!$menu_info){
	$create_mode = 1;
	$menu_info = $menu;
}

if($sbt_edit){
	$shop_menu->setWhere(' shop_id= '.$shop_info[shop_id]);
	$shop_menu->setMenu_1($txt_menu_1);
	$shop_menu->setMenu_2($txt_menu_2);
	$shop_menu->setMenu_3($txt_menu_3);
	$shop_menu->setUid($uid);
	$shop_menu->setUsername($username);
	if ($create_mode){
		$res = $shop_menu->create_keke_witkey_shop_menu();
	}
	else {
		$res = $shop_menu->edit_keke_witkey_shop_menu();
	}
	if($res){
		Func_comm_class::showmessage('自定义导航编辑成功！','index.php?do='.$do.'&view='.$view);
	}
}

if($sbt_default){
	$shop_menu->setWhere(' shop_id= '.$shop_info[shop_id]);
	$shop_menu->setMenu_1($menu[menu_2]);
	$shop_menu->setMenu_2($menu[menu_3]);
	$shop_menu->setMenu_3($menu[menu_4]);
	if ($create_mode){
		$res = $shop_menu->create_keke_witkey_shop_menu();
	}
	else {
		$res = $shop_menu->edit_keke_witkey_shop_menu();
	}
	Func_comm_class::showmessage('自定义导航已恢复默认！','index.php?do='.$do.'&view='.$view);
	
}

require_once  $template_obj->template ($do."_".$view);