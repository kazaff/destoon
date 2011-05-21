<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$shop_info = $shop_info_arr[0];
if (!$shop_info){
	Func_comm_class::showmessage("您没有开通店铺","index.php?do=user",3,"","error");
}

$shop_member_obj = new Keke_witkey_shop_member_class();

if($shop_member_id){
	$shop_member_obj->setWhere(' shop_member_id = '.$shop_member_id);
	$member_info = $shop_member_obj->query_keke_witkey_shop_member();
	$member_info = $member_info[0];
}

if($sbt_edit){
	$shop_member_obj->setShop_id($shop_info[shop_id]);
	$shop_member_obj->setReal_name($txt_real_name);
	$upload_obj = new Upload_Class ( UPLOAD_ROOT , array ("gif", 'jpeg', 'jpg', 'png' ), UPLOAD_MAXSIZE );
	if($_FILES['fle_pic']['name']){
		$files1 = $upload_obj->run ( 'fle_pic' );
		if(is_array($files1)){
			$pic = $files1[0]['saveName'];
			$shop_member_obj->setLicen_pic('data/uploads/'.UPLOAD_RULE.$pic);
		}
	}
	
	$shop_member_obj->setJob($txt_job);
	$shop_member_obj->setExpress(intval($txt_express));
	$shop_member_obj->setTop_xl($txt_top_xl);
	$shop_member_obj->setSchool($txt_school);
	$shop_member_obj->setAboutus($tar_content);
	if($hdn_shop_member_id){
		$shop_member_obj->setShop_member_id($hdn_shop_member_id);
		$res = $shop_member_obj->edit_keke_witkey_shop_member();
	}else{
		$res = $shop_member_obj->create_keke_witkey_shop_member();
	}
	
	if($res){
		Func_comm_class::showmessage('店铺成员信息编辑成功！','index.php?do='.$do.'&view='.$view);
	}
}


require_once  $template_obj->template ($do."_".$view);