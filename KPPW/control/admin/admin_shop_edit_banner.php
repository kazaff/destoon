<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

$banner_obj = new Keke_witkey_shop_banner_class();

$indus_arr = Cache_ext_Class::getIndustryList(1,0);

if($banner_id){
	$banner_obj->setWhere(' banner_id = '.$banner_id);
	$banner_info = $banner_obj->query_keke_witkey_shop_banner();
	$banner_info = $banner_info[0];
}

if($sbt_edit){
	$banner_obj->setBanner_type($slt_banner_type);
	$banner_obj->setIndus_id($slt_indus_id);
	$banner_obj->setImg_name($txt_img_name);
	
	$upload_obj = new Upload_Class ( UPLOAD_ROOT.'banner/' , array ("gif", 'jpeg', 'jpg', 'png' ), UPLOAD_MAXSIZE );
	if($_FILES['fle_pic']['name']){
		$files1 = $upload_obj->run ( 'fle_pic' );
		if(is_array($files1)){
			$pic ='data/uploads/banner/'. $files1[0]['saveName'];
		}
	}
	
	$banner_obj->setImg_file($pic);
	
	if($hdn_banner_id){
		$banner_obj->setWhere(' banner_id='.$hdn_banner_id);
		$res = $banner_obj->edit_keke_witkey_shop_banner();
	}else{
		$res = $banner_obj->create_keke_witkey_shop_banner();
	}
	
	if($res){
		Func_comm_class::adminshowmessage('主题编辑成功！','index.php?do='.$do.'&view='.$view.'banner_id='.$hdn_banner_id);
	}
	
}

require_once $template_obj->template ( 'control/admin/tpl/admin_'.$do.'_' . $view );