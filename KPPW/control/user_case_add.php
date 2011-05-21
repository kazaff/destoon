<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$case_obj = new Keke_witkey_shop_case_class();
$work_obj = new Keke_witkey_work_class();
$cus_cate_obj = new Keke_witkey_shop_cus_cate_class();

$shop_info = $shop_info_arr[0];

$cus_cate_obj->setWhere(' obj_type = 1 and  shop_id = '.$shop_info[shop_id]);
$cus_cate_arr = $cus_cate_obj->query_keke_witkey_shop_cus_cate();

$indus_arr = Cache_ext_Class::getIndustryList(1);

$work_obj->setWhere(' uid = '.$uid.' and work_status in(1,2,3,4) ');
$work_arr = $work_obj->query_keke_witkey_work();
if($case_id){
$case_obj->setWhere(" case_id = $case_id");
$case_info = $case_obj->query_keke_witkey_shop_case();
$case_info = $case_info[0]; 
}
if(isset($ajax)&&$ajax=="cus_cate"){

	$cus_cate_obj->setCate_name($txt_cate_name);
	$cus_cate_obj->setShop_id($shop_info[shop_id]);
	$cus_cate_obj->setObj_type(1);
	$res = $cus_cate_obj->create_keke_witkey_shop_cus_cate();
	if($res){
		$cus_cate_obj->setWhere(' obj_type = 1 and  shop_id = '.$shop_info[shop_id]);
		$cus_cate_arr = $cus_cate_obj->query_keke_witkey_shop_cus_cate();
		$str = '<option value=\'\'>请选择</option>';
		foreach ($cus_cate_arr as $v) {
			 $str.="<option value=\"$v[cus_cate_id]\">$v[cate_name]</option>";
		}
		$str.='<option value="x">自定义</option>';
		Template_Class::xml_out($str);
	}
}

if($sbt_edit){
	$case_obj->setUid($uid);
	$case_obj->setUsername($username);
	$case_obj->setIndus_id(intval($slt_indus_id));
	$case_obj->setCase_type($shop_info[shop_type]);
	$case_obj->setCus_cate_id(intval($slt_cate_id));
	$case_obj->setCase_name($txt_case_name);
	$txt_express=$txt_express?Func_comm_class::sstrtotime($txt_express):'';
	$case_obj->setExpress(intval($txt_express));
	$upload_obj = new Upload_Class ( UPLOAD_ROOT , array ("gif", 'jpeg', 'jpg', 'png' ), UPLOAD_MAXSIZE );
	if($_FILES['fle_pic']['name']){
		$files1 = $upload_obj->run ( 'fle_pic' );
		if(is_array($files1)){
			$pic = $files1[0]['saveName'];
			$case_obj->setPic('data/uploads/'.UPLOAD_RULE.$pic);
		}
	}
	
	
	$case_obj->setShop_id($shop_info[shop_id]);
	$case_obj->setContent($tar_content);
	$case_obj->setOn_date(time());
	
	if($hdn_case_id){
		$case_obj->setCase_id($hdn_case_id);
		$res = $case_obj->edit_keke_witkey_shop_case();
	}else{
		$res = $case_obj->create_keke_witkey_shop_case();
	}
	
	if($res){
		Func_comm_class::showmessage('成功案例编辑成功！','index.php?do='.$do.'&view=case_list');
	}
}

$s_service_arr = $indus_p_arr; 

require_once  $template_obj->template ($do."_".$view);