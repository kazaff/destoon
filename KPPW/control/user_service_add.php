<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}


$service_obj = new Keke_witkey_service_class();
$cus_cate_obj = new Keke_witkey_shop_cus_cate_class();

$shop_info = $shop_info_arr[0];
if (!$shop_info){
	Func_comm_class::showmessage("您没有开通店铺","index.php?do=user",3,"","error");
}

$cus_cate_obj->setWhere(' obj_type = 2 and  shop_id = '.$shop_info[shop_id]);
$cus_cate_arr = $cus_cate_obj->query_keke_witkey_shop_cus_cate();


$service_arr = $indus_arr;

$service_s_info = $service_arr[$shop_info[indus_id]];

$s_service_arr = $indus_p_arr; 




$user_info = Func_comm_class::getuserinfo($uid);
$fw_allow_rule = Cache_ext_Class::getRule("service_allow",$uid,$user_info);

if($indus_pid){
	$indus_s_info = $service_arr[$indus_pid];
}

if($indus_id){
	$indus_t_info = $service_arr[$indus_id];
}

if($op=='show_s_service'){
	$t_service_arr = Cache_ext_Class::getIndustryList(1,intval($indus_pid));
	foreach ($t_service_arr as $value) {
			$str_html.='<a style="color: rgb(36, 124, 214);"  value="'.$value[indus_id].'" onclick="inset(this);">'.$value[indus_name].'</a>';
	}
	echo $str_html;die();
}
 


if(isset($ajax)&&$ajax=="cus_cate"){

	$cus_cate_obj->setCate_name($txt_cate_name);
	$cus_cate_obj->setShop_id($shop_info[shop_id]);
	$cus_cate_obj->setObj_type(2);
	$res = $cus_cate_obj->create_keke_witkey_shop_cus_cate();
	if($res){
		$cus_cate_obj->setWhere(' obj_type = 2 and  shop_id = '.$shop_info[shop_id]);
		$cus_cate_arr = $cus_cate_obj->query_keke_witkey_shop_cus_cate();
		$str = '<option value=\'\'>请选择</option>';
		foreach ($cus_cate_arr as $v) {
			 $str.="<option ";
			 if ($txt_cate_name==$v['cate_name']){
			 	$str.=" selected=\'selected\' ";
			 }
			 $str.="value=\"$v[cus_cate_id]\">$v[cate_name]</option>";
		}
		$str.='<option value="x">自定义</option>';
		Template_Class::xml_out($str);
	}
}

if($op=='show_select_indus'){
	$s_indus_info = $service_arr[intval($indus_pid)];
	$f_indus_info = $service_arr[intval($s_indus_info[indus_pid])];
	$str_html = '<input type="hidden" name="hdn_indus_id" value="'.$indus_pid.'"><font color="red">'.$f_indus_info[indus_name].'</font>><font color="red">'.$s_indus_info[indus_name].'</font>';
	echo $str_html ;die();
}

if($service_id){
	$service_obj->setWhere(' service_id =  '.intval($service_id));
	$service_info = $service_obj->query_keke_witkey_service();
	$service_info = $service_info[0];
	$service_info[area_range]=explode(',',$service_info[area_range]);
	$indus_arr = Cache_ext_Class::getIndustryList(1);
	
}

if(Func_comm_class::submitcheck('formhash')){
	if ($fw_allow_rule<0&&$rdo_service_type==1){
		Func_comm_class::showmessage("您没有权限发布服务","index.php?do=user&view=service_add",3,"",'error');
	}
	$p_indus_id = $slt_indus_id?$slt_indus_id:$slt_indus_pid;
	$indus_arr = db_factory::query("select * from ".TABLEPRE."witkey_industry where indus_id = $slt_indus_pid");
	$indus_ppid = $indus_arr[0]['indus_pid'];
	$indus_path = "|".$indus_ppid."||".$slt_indus_pid."||".$slt_indus_id."|";
	
	$service_obj->setUid($uid);
	$service_obj->setUsername($username);
	$service_obj->setIndus_id(intval($p_indus_id));
	$service_obj->setIndus_path($indus_path);
	$service_obj->setService_type(intval($rdo_service_type));
	$service_obj->setSubmit_method(intval($slt_submit_method));
	$service_obj->setTitle($txt_service_name);
	$service_obj->setCus_cate_id(intval($slt_cate_id));
	$service_obj->setObj_name($txt_obj_name);
	$service_obj->setKey_word($txt_key_word);
	$service_obj->setPrice(floatval($txt_price));
	$service_obj->setUnite_price($txt_unit_price);
	$service_obj->setService_time(intval($txt_service_time));
	$service_obj->setUnit_time($slt_unit_time);
	$upload_obj = new Upload_Class ( UPLOAD_ROOT , array ("gif", 'jpeg', 'jpg', 'png' ), UPLOAD_MAXSIZE );
	if($_FILES['fle_pic']['name']){
		$files1 = $upload_obj->run ( 'fle_pic' );
		if(is_array($files1)){
			$pic = $files1[0]['saveName'];
			$service_obj->setPic("data/uploads/".UPLOAD_RULE.$pic);
		}
	}
	if ($ad_pic)
	{
		$service_obj->setAd_pic($ad_pic);
	}

	$service_obj->setFile_path($upload_file);
	$service_obj->setShop_id($shop_info[shop_id]);
	$service_obj->setArea_range($slt_city?"$slt_province,$slt_city":$slt_province);
	$service_obj->setContent($tar_content);
	$service_obj->setOn_time(time());
	
	if($hdn_service_id){
		$service_obj->setService_id($hdn_service_id);
		$res = $service_obj->edit_keke_witkey_service();
	}else{
		$res = $service_obj->create_keke_witkey_service();
	}
	
	if($res){
		$feed_info = '<a target="_blank" href="'.$_K['siteurl'].'/index.php?do=space&member_id='.$uid.'">'.$username.'</a>发布了商品<a target="_blank" href="shop.php?do=service_info&sid='.$res.'">'.$txt_service_name.'</a> ';
		Func_comm_class::feed_add($feed_info,$uid,$username,'add_service',$res);
		Func_comm_class::showmessage('商品提交成功！','index.php?do='.$do.'&view=service_list');
	}
}
require_once  $template_obj->template ($do."_".$view);