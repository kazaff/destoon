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
	

if(isset($ajax)&& $ajax =="sbt_upload_fle"){
	
	$shop_person_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
	$shop_person_obj->setBanner_id(0);
	$shop_person_obj->setBanner_img($file_path);
	$res = $shop_person_obj->edit_keke_witkey_shop_tpl_pconfig();
	if($res){
		Func_comm_class::echojson('ok',1);
	}else {
		Func_comm_class::echojson('fail',0);
	}
}

if(isset($ajax)&& $ajax=="sbt_default_pic"){
	$shop_person_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
	$shop_person_obj->setBanner_id(1);
	$shop_person_obj->setBanner_img('');
	$res = $shop_person_obj->edit_keke_witkey_shop_tpl_pconfig();
	if($res){
		Func_comm_class::echojson('ok',1);
	}else {
		Func_comm_class::echojson('fail',0);
	}
}


if(isset($ajax)&& $ajax=="sbt_font_color"){
	$shop_person_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
	if(!stristr($rdo_font_color,'#')){
		$rdo_font_color =$rdo_font_color?'#'.$rdo_font_color:"";
	}
	$shop_person_obj->setFont_color($rdo_font_color);
	$res = $shop_person_obj->edit_keke_witkey_shop_tpl_pconfig();
	if($res){
		 Func_comm_class::echojson('ok',1);
	}else {
		Func_comm_class::echojson('fail',0);
	}
}

if(isset($ajax)&& $ajax=="sbt_bgcolor"){
	$shop_person_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
	if(!stristr($txt_back_color,'#')){
		$txt_back_color =$txt_back_color?'#'.$txt_back_color:"";
	}
	$shop_person_obj->setBackground($txt_back_color);
	$res = $shop_person_obj->edit_keke_witkey_shop_tpl_pconfig();
	if($res){
		 Func_comm_class::echojson('ok',1);
	}else {
		Func_comm_class::echojson('fail',0);
	}
}
$shop_banner = $shop_person_config['banner_img'];
if (!$shop_banner&&$shop_person_config['banner_id']){
	$banner_info = Cache_ext_Class::gettabledata("witkey_shop_banner","banner_id = '{$shop_info['banner_id']}'","",null,"",1,1);
	$shop_banner = $banner_info['img_file'];
}

require_once  $template_obj->template ($do."_".$view);