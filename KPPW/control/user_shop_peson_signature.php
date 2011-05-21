<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$shop_info = $shop_info_arr[0];
if (!$shop_info){
	Func_comm_class::showmessage("您没有开通店铺","index.php?do=user",3,"","error");
}
$shop_person_obj = new Keke_witkey_shop_tpl_pconfig_class();

$shop_person_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
$shop_person_config = $shop_person_obj->query_keke_witkey_shop_tpl_pconfig();
$shop_person_config = $shop_person_config[0];

if($sbt_edit){
	$shop_person_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
	$shop_person_obj->setAd_text($tar_content);
	$res = $shop_person_obj->edit_keke_witkey_shop_tpl_pconfig();
	if($res){
		Func_comm_class::showmessage('个性签名编辑成功！','index.php?do='.$do.'&view='.$view);
	}
}


require_once  $template_obj->template ($do."_".$view);