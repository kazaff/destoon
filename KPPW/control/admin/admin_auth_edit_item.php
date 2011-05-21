<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$auth_item_obj = new Keke_witkey_auth_item_class();
$upload_obj = new Upload_Class ( UPLOAD_ROOT . "ico/", array ("gif", 'jpeg', 'jpg', 'png' ), UPLOAD_MAXSIZE );



if($item_id){
	$auth_item_obj->setWhere('auth_id='.$item_id);
	$item_info = $auth_item_obj->query_keke_witkey_auth_item();
	$item_info = $item_info[0];
}



if($sbt_edit){
	if($_FILES['fle_auth_big_ico']['name']){
		$files1 = $upload_obj->run ( 'fle_auth_big_ico' );
		if(is_array($files1)){
			$big_ico = "data/uploads/".UPLOAD_RULE.$files1[0]['saveName'];
		}
	}
	if($_FILES['fle_auth_small_ico']['name']){
		$files2 = $upload_obj->run ( 'fle_auth_small_ico' );
		if(is_array($files2)){
			$small_ico = "data/uploads/".UPLOAD_RULE.$files2[1]['saveName'];
		}
	}

	$auth_item_obj->setAuth_title($txt_auth_title);
	$auth_item_obj->setAuth_day($txt_auth_day);
	$auth_item_obj->setAuth_cash($txt_auth_cash);
	$auth_item_obj->setAuth_period(intval($txt_auth_period));
	$auth_item_obj->setAuth_small_ico($small_ico);
	$auth_item_obj->setAuth_big_ico($big_ico);
	$auth_item_obj->setAuth_desc($tar_auth_desc);
	$auth_item_obj->setAuth_show(intval($rdo_auth_show));
	$auth_item_obj->setAuth_open(intval($rdo_auth_open));
	$auth_item_obj->setUpdate_time(time());
	if($hdn_item_id){
		$auth_item_obj->setAuth_id($hdn_item_id);
		$res = $auth_item_obj->edit_keke_witkey_auth_item();
		if($res){
			Func_comm_class::adminSystemLog("编辑认证项目$hdn_link_id");
			Func_comm_class::adminshowmessage('认证项目编辑成功！','index.php?do='.$do.'&view=item_list');
		}
	}else{
		$res = $auth_item_obj->create_keke_witkey_auth_item();
		if($res){
			Func_comm_class::adminSystemLog("添加认证项目$res");
			Func_comm_class::adminshowmessage('认证项目编辑成功！','index.php?do='.$do.'&view=item_list');
		}
	}
}


require_once $template_obj->template ( 'control/admin/tpl/admin_'.$do.'_' . $view );