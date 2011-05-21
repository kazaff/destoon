<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$shop_obj = new Keke_witkey_shop_class();

$service_obj = new Keke_witkey_service_class();

$indus_arr = Cache_ext_Class::getIndustryList();

$service_obj->setWhere("service_id = $service_id");
$service_info = $service_obj->query_keke_witkey_service();
$service_info  = $service_info[0];

if(isset($sbt_edit)){
	$upload_obj = new Upload_Class(UPLOAD_ROOT,array("gif",'jpeg','jpg','png'),UPLOAD_MAXSIZE);
	$service_obj->setWhere("service_id = $service_id");
	$service_obj->setTitle($txt_title);
	$service_obj->setIndus_id($slt_indus_id);
	
	$files = $upload_obj->run('file_ad_pic',1);


	if($files!='The uploaded file is Unallowable!'){
	
		$ad_pic = $files[0]['saveName'];
		if($ad_pic){
			$ad_pic = "data/uploads/".UPLOAD_RULE.$ad_pic;
		}
	}
	
	$service_obj->setAd_pic($ad_pic);
	$service_obj->setIs_stop($chk_is_stop);
	$service_obj->edit_keke_witkey_service();
	
	Func_comm_class::adminshowmessage("更新成功","index.php?do=shop&view=service");
}

$temp_arr = array();
Func_comm_class::get_tree($indus_arr,$temp_arr,'option',$service_info['indus_id'],'indus_id','indus_pid','indus_name');
$indus_arr = $temp_arr;
unset($temp_arr);


require_once $template_obj->template ( 'control/admin/tpl/admin_'.$do.'_' . $view );