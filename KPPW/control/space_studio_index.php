<?php

$studio_obj = new Keke_witkey_studio_class();
$studio_member_obj = new Keke_witkey_studio_member_class();
$studio_member_ext_obj = new Keke_witkey_studio_member_ext_class();
$studio_apply_obj = new Keke_witkey_studio_apply_class();

$studio_obj->setWhere(' studio_id = '.$space_info[studio_id]);
$studio_info = $studio_obj->query_keke_witkey_studio();
$studio_info = $studio_info[0];
if($uid)
{
	$user_info = Func_comm_class::getuserinfo($uid);
}

$studio_member_ext_obj->setWhere(' a.studio_id = '.$space_info[studio_id]);
$studio_member_arr = $studio_member_ext_obj->query_keke_witkey_studio_member();

if($show=='join'){
	$title = '申请加入工作室';
	require_once  $template_obj->template ('user_studio_join');
	die();
}

if($sbt_sq){
	$studio_apply_obj->setApply_type(1);
	$studio_apply_obj->setContent($tar_desc);
	$studio_apply_obj->setOn_date(time());
	$studio_apply_obj->setUid($uid);
	$studio_apply_obj->setStudio_id($hdn_studio_id);
	$studio_apply_obj->setUsername($username);
	$res = $studio_apply_obj->create_keke_witkey_studio_apply();
	if($res){
		Func_comm_class::showmessage('加入工作室申请成功！','index.php?do=user');
	}
		
}

require_once $template_obj->template ( $do . "_" . $view );