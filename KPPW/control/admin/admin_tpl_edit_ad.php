<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(45);

$ad_obj = new Keke_witkey_ad_class();

$upload_obj = new Upload_Class(UPLOAD_ROOT,array("gif",'jpeg','jpg','png','swf'),UPLOAD_MAXSIZE);


if($ad_id){
	$ad_info = $ad_obj->setWhere('ad_id='.$ad_id);
	$ad_info = $ad_obj->query_keke_witkey_ad();
	$ad_info = $ad_info[0];
	$ad_day = ($ad_info[end_time]-$ad_info[start_time])/3600;
}


if($sbt_edit){
	$ad_obj->setAd_type($slt_ad_type);
	$ad_obj->setAd_name($txt_ad_name);
	$ad_obj->setAd_cash($txt_ad_cash);
	$ad_obj->setAd_url($txt_ad_url);
	$ad_obj->setAd_content($tar_ad_content);
	$ad_obj->setListorder(intval($txt_listorder));
	$ad_obj->setUid($uid);
	$ad_obj->setUsername($txt_username);
	$ad_obj->setStart_time(time());
	$ad_obj->setWidth($txt_width);
	$ad_obj->setHeight($txt_height);
	if($hdn_ad_id){
		$ad_obj->setad_id($hdn_ad_id);
	
		$files = $upload_obj->run('fle_ad_file',1);//上传文件
		if ($files == 'The uploaded file exceeds the upload_max_filesize directive in php.ini.')
		{
			echo '上传的文件超过了php.ini里的最大限制';
			die();
		}
		
		if($files!='The uploaded file is Unallowable!'){
		
			$ad_file = $files[0]['saveName'];
			if($ad_file){
				$ad_file = "data/uploads/".UPLOAD_RULE.$ad_file;
			}
		}
		
		$ad_obj->setAd_file($ad_file?$ad_file:$hdn_ad_file);
		
		
		$ad_obj->setEnd_time((intval($txt_ad_day)*3600*24)+time());
		$res = $ad_obj->edit_keke_witkey_ad();
		Func_comm_class::adminSystemLog("编辑广告$hdn_ad_id");
		if($res){
			Func_comm_class::adminshowmessage('广告编辑成功！','index.php?do='.$do.'&view=ad');
		}
	}else{
		
		$files = $upload_obj->run('fle_ad_file',1);

		if($files!='The uploaded file is Unallowable!'){
			
			$ad_file = $files[0]['saveName'];
			if($ad_file){
				$ad_file = "data/uploads/".UPLOAD_RULE.$ad_file;
			}
		}
		
		$ad_obj->setAd_file($ad_file?$ad_file:'resource/img/nopic.jpg');
		
		$res = $ad_obj->create_keke_witkey_ad();//添加广告
		Func_comm_class::adminSystemLog("添加广告$res");
		if($res){
			Func_comm_class::adminshowmessage('广告编辑成功！','index.php?do='.$do.'&view=ad');
		}
	}
}


require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do . '_' . $view );