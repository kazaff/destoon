<?php


if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

if($shop_info){
	Func_comm_class::showmessage('操作提示','index.php?do=user&view=service_list',3,'您的店铺已经开通了!',"error");
}

$shop_obj = new Keke_witkey_shop_class();
$menu_obj = new Keke_witkey_shop_menu_class();

$service_all_arr = Cache_ext_Class::getIndustryList(1);

$service_index_arr = Cache_ext_Class::getIndusIndex(1);
$s_service_arr = $indus_p_arr; //Cache_ext_Class::getIndustryList(1,$service_s_info[indus_pid]);


require_once 'shop/control/header_menu_default.php';

if($op=='show_s_service'){
	if ($indus_pid&&$service_index_arr[$indus_pid])
	foreach ($service_index_arr[$indus_pid] as $value) {
		$str_html.='<span><label for="cbk_t_service_id">&nbsp;<input type="checkbox" name="cbk_s_service_id['.$value['indus_id'].']" value="'.$value[indus_id].'" onclick="if(this.checked){show_t_service(this.value)}else{kill_t_service(this.value)}">'.$value[indus_name].'</label>&nbsp;&nbsp;&nbsp;&nbsp;</span>';
	}
	echo $str_html;die();
}

if($op=='show_t_service'){
	
	$str_htm2.='<li id="li_t_service_item_'.$indus_pid.'b">';
	if ($service_index_arr[$indus_pid])
	foreach ($service_index_arr[$indus_pid] as $value) {
			$str_htm2.='<span><label for="cbk_t_service_id">&nbsp;<input type="checkbox" name="cbk_t_service_id[]" value="'.$value[indus_id].'">'.$value[indus_name].'</label>&nbsp;&nbsp;&nbsp;&nbsp;</span>';
	}
	$str_htm2.='</li>';
	echo $str_htm2;die();
}

$user_info = Func_comm_class::getuserinfo($uid);


$p_allow_rule = Cache_ext_Class::getRule("personshop_create",$uid,$user_info);
$e_allow_rule = Cache_ext_Class::getRule("enterpriseshop_create",$uid,$user_info);

if ($p_allow_rule<0&&$e_allow_rule<0){
	Func_comm_class::showmessage("您所在的用户组不允许创建店铺","index.php?do=user",3,"",'error');
}
elseif ($p_allow_rule<0){
	$shop_type = 2;
}
elseif ($e_allow_rule<0){
	$shop_type = 1;
}
 
$menu_1 = $menu_arr[1];

$menu_2 = $menu_arr[2];

if($sbt_shop){
	$shop_obj->setUid($uid);
	$shop_obj->setUsername($username);
	$shop_obj->setShop_type($shop_type);
	$shop_obj->setLinkman($txt_linkman);
	$shop_obj->setShop_name($txt_shop_name);

	$shop_obj->setIndus_id(intval($slt_indus_pid));
	$shop_obj->setCity($slt_province.','.$slt_city);
	if(is_array($cbk_s_service_id)){
		$service_range=implode(',',$cbk_s_service_id);
	}
	$shop_obj->setService_range($service_range);
	$shop_obj->setJob($txt_job);
	$shop_obj->setWork_year($slt_work_year);
	$shop_obj->setOn_time(time());
	$res = $shop_obj->create_keke_witkey_shop();
	if($shop_type==1){
		$str='个人店铺';
		$rurl = "index.php?do=user&view=shop_person_mytheme";
	}elseif($shop_type==2){
		$str='企业店铺';
		$rurl = "index.php?do=user&view=shop_enterprise_tpl";
	}
	if($res){
		if($shop_type==1){
			$menu_obj->setShop_id($res);
			$menu_obj->setMenu_1($menu_1[menu_2]);
			$menu_obj->setMenu_2($menu_1[menu_3]);
			$menu_obj->setMenu_3($menu_1[menu_4]);
			$menu_obj->setUid($uid);
			$menu_obj->setUsername($username);
			$menu_obj->create_keke_witkey_shop_menu();
			
			$person_shop_obj = new Keke_witkey_shop_tpl_pconfig_class();
			$person_shop_obj->setShop_id($res);
			$person_shop_obj->setUid($uid);
			$person_shop_obj->create_keke_witkey_shop_tpl_pconfig();
		}elseif($shop_type==2){
			$menu_obj->setShop_id($res);
			$menu_obj->setMenu_1($menu_2[menu_2]);
			$menu_obj->setMenu_2($menu_2[menu_3]);
			$menu_obj->setMenu_3($menu_2[menu_4]);
			$menu_obj->setMenu_4($menu_2[menu_5]);
			$menu_obj->setMenu_5($menu_2[menu_6]);
			$menu_obj->setUid($uid);
			$menu_obj->setUsername($username);
			$menu_obj->create_keke_witkey_shop_menu();
			
			$enterprise_shop_obj = new Keke_witkey_shop_tpl_econfig_class();
			$enterprise_shop_obj->setShop_id($res);
			$enterprise_shop_obj->setTpl_direction(1);
			$enterprise_shop_obj->setUid($uid);
			$enterprise_shop_obj->create_keke_witkey_shop_tpl_econfig();
			
		}
		Func_comm_class::update_score_value($uid,'create_shop',2);
		Func_comm_class::showmessage('恭喜您，开通了'.$str,'index.php?do='.$do.'&view=service_add',2,'您已经开通了'.$str.',请设置模板');
	}
}

require_once  $template_obj->template ($do."_".$view);
