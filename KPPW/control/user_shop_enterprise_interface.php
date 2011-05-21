<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$shop_info = $shop_info_arr[0];
if (!$shop_info){
	Func_comm_class::showmessage("您没有开通店铺","index.php?do=user",3,"","error");
}
$shop_enterprise_obj = new Keke_witkey_shop_tpl_econfig_class();
$banner_obj = new Keke_witkey_shop_banner_class();

$indus_arr = Cache_ext_Class::getIndustryList(1,0);

$indus_all_arr = Cache_ext_Class::getIndustryList(1);

$shop_info[indus_id] = $indus_all_arr[$shop_info[indus_id]][indus_pid];

$shop_enterprise_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
$shop_enterprise_config = $shop_enterprise_obj->query_keke_witkey_shop_tpl_econfig();
$shop_enterprise_config = $shop_enterprise_config[0];

$banner_obj->setWhere(' banner_type =2 ');
$banner_arr = $banner_obj->query_keke_witkey_shop_banner();

if($shop_info[indus_id]){
	$banner_obj->setWhere(' banner_type =2 and indus_id='.$shop_info[indus_id]);
	$my_banner_arr = $banner_obj->query_keke_witkey_shop_banner();
}

if($op=='show_banner_list'){
	$banner_obj->setWhere(' banner_type =2 and indus_id='.$indus_id);
	$banner_list_arr = $banner_obj->query_keke_witkey_shop_banner();
	foreach ($banner_list_arr as $value) {
		
		$str_html.='<p>
						<img src="'.$value[img_file].'" width="160" height="50">
						<br>
						<label for="rdo_banner_id'.$value[banner_id].'"><input type="radio" id="rdo_banner_id.'.$value[banner_id].'" name="rdo_banner_id" value="'.$value[banner_id].'" onclick="showDialog(\'你确认要将此图片作为主题图片吗？\', \'confirm\', \'确认消息\',\'select_banner('.$value[banner_id].')\',0);return false;">'.$value[img_name].'</label>
					</p>';
	}
	echo($str_html);die();
}

if($op=='select_banner'){
	$shop_enterprise_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
	$shop_enterprise_obj->setBanner_img($pic);
	$shop_enterprise_obj->setBanner_id($banner_id);
	$res = $shop_enterprise_obj->edit_keke_witkey_shop_tpl_econfig();
	echo($res);die();
}

if($sbt_logo_fle){
	if ($file_pic_logo){
		$shop_enterprise_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
			$shop_enterprise_obj->setShop_logo($file_pic_logo);
			$res = $shop_enterprise_obj->edit_keke_witkey_shop_tpl_econfig();
			if($res){
				Func_comm_class::showmessage('店标设置成功！','index.php?do='.$do.'&view='.$view);
			}
	}
	
	

	
	
}

if($sbt_ad_text){
	$shop_enterprise_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
	$shop_enterprise_obj->setAd_text($text_ad_text);
	$res = $shop_enterprise_obj->edit_keke_witkey_shop_tpl_econfig();
	if($res){
		Func_comm_class::showmessage('广告语设置成功！','index.php?do='.$do.'&view='.$view);
	}
}

if($sbt_theme_fle){
	$shop_enterprise_obj->setWhere(' shop_id = '.$shop_info[shop_id]);
	$shop_enterprise_obj->setBanner_img($hdn_banner);
	$shop_enterprise_obj->setBanner_id(0);
	$res = $shop_enterprise_obj->edit_keke_witkey_shop_tpl_econfig();
	if($res){
		Func_comm_class::showmessage('主题设置成功！','index.php?do='.$do.'&view='.$view);
	}
}






require_once  $template_obj->template ($do."_".$view);