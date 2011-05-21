<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$shop_info = $shop_info_arr[0];
if (!$shop_info){
	Func_comm_class::showmessage("您没有开通店铺","index.php?do=user",3,"","error");
}

$banner_obj = new Keke_witkey_shop_banner_class();
$shop_person_obj = new Keke_witkey_shop_tpl_pconfig_class();

$banner_obj->setWhere(' banner_type = 1 ');
$banner_arr = $banner_obj->query_keke_witkey_shop_banner();

$shop_person_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
$shop_person_config = $shop_person_obj->query_keke_witkey_shop_tpl_pconfig();
$shop_person_config = $shop_person_config[0];

if($sbt_update_pic){
	
	$shop_person_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
	$shop_person_obj->setBanner_id(intval($rdo_banner_id));
	$shop_person_obj->setBanner_img($pic);
	$res = $shop_person_obj->edit_keke_witkey_shop_tpl_pconfig();
	if($res){
		Func_comm_class::showmessage('图片更新成功！','index.php?do='.$do.'&view='.$view);
	}
}

if($sbt_default_pic){
	$shop_person_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
	$shop_person_obj->setBanner_id(1);
	$shop_person_obj->setBanner_img('');
	$res = $shop_person_obj->edit_keke_witkey_shop_tpl_pconfig();
	if($res){
		Func_comm_class::showmessage('已还原为默认图片！','index.php?do='.$do.'&view='.$view);
	}
}

require_once  $template_obj->template ($do."_".$view);