<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$shop_obj = new Keke_witkey_shop_class();

$space_obj = new Keke_witkey_space_class();

$link_obj = new Keke_witkey_link_class();

$op =$op?$op:"info";

$shop_info = $shop_info_arr[0];
if (!$shop_info){
	Func_comm_class::showmessage("您没有开通店铺","index.php?do=user",3,"","error");
}

$shop_info[city]=explode(',',$shop_info[city]);


$service_all_arr = Cache_ext_Class::getIndustryList(1);

$service_index_arr = Cache_ext_Class::getIndusIndex(1);

$s_service_arr = $indus_p_arr; //Cache_ext_Class::getIndustryList(1,$service_s_info[indus_pid]);


$select_service_arr = explode(",",$shop_info['service_range']);

if($op=='show_s_service'){
	if ($indus_pid&&$service_index_arr[$indus_pid])
	foreach ($service_index_arr[$indus_pid] as $value) {
		$str_html.='<span><label for="cbk_t_service_id['.$value['indus_id'].']">&nbsp;<input type="checkbox" name="cbk_s_service_id" value="'.$value[indus_id].'" onclick="if(this.checked){show_t_service(this.value)}else{kill_t_service(this.value)}">'.$value[indus_name].'</label>&nbsp;&nbsp;&nbsp;&nbsp;</span>';
	}
	echo $str_html;die();
}

if($op=='show_t_service'){
	$str_htm2.='<li id="li_t_service_item_'.$indus_pid.'b">';
	if ($service_index_arr[$indus_pid])
	foreach ($service_index_arr[$indus_pid] as $value) {
			$str_htm2.='<span><label for="cbk_t_service_id">&nbsp;<input type="checkbox" name="cbk_t_service_id['.$value[indus_id].']" value="'.$value[indus_id].'">'.$value[indus_name].'</label>&nbsp;&nbsp;&nbsp;&nbsp;</span>';
	}
	$str_htm2.='</li>';
	echo $str_htm2;die();
}

switch ($op) {
	case 'info':
		if($sbt_shop_info){
			$shop_obj->setShop_id($shop_info[shop_id]);
			$shop_obj->setJob($txt_job);
			$shop_obj->setIndus_id(intval($slt_indus_pid));
			if($cbk_t_service_id){
				$service_range_ids = implode(',',$cbk_t_service_id);
			}
			$service_range_ids = $service_range_ids?$service_range_ids:'';
			$shop_obj->setWork_year($slt_work_year);
			$shop_obj->setService_range($service_range_ids);
			
			
			$shop_obj->setShop_name($txt_shop_name);
			$shop_obj->setCity("$slt_province,$slt_city");
			$res = $shop_obj->edit_keke_witkey_shop();
			
			Func_comm_class::showmessage('店铺基本信息编辑成功！','index.php?do='.$do.'&view='.$view.'&op='.$op);
			
		}
	;
	break;
	case 'desc':
		if($sbt_shop_desc){
			$shop_obj->setShop_id($shop_info[shop_id]);
			$shop_obj->setAboutus(Func_comm_class::str_filter($tar_content));
			$res = $shop_obj->edit_keke_witkey_shop();
			if($res){
				Func_comm_class::showmessage('店铺简介编辑成功！','index.php?do='.$do.'&view='.$view.'&op='.$op);
			}
		}
	;
	break;
	case 'contact':
		$user_info = Func_comm_class::getuserinfo($uid);
		if($sbt_shop_contact){
			$space_obj->setUid($uid);
			$space_obj->setAddress($txt_address);
			$space_obj->setPhone($txt_phone);
			$space_obj->setMobile($txt_mobile);
			$space_obj->setMsn($txt_msn);
			$space_obj->setFax($txt_fax);
			$res = $space_obj->edit_keke_witkey_space();
			if($res){
				Func_comm_class::showmessage('店铺联系方式编辑成功！','index.php?do='.$do.'&view='.$view.'&op='.$op);
			}
		}
	;
	break;
	case 'link':
		$link_obj->setWhere(' shop_id =  '.intval($shop_info[shop_id]));
		$link_arr = $link_obj->query_keke_witkey_link();
		
		if($link_id){
			$link_obj->setWhere(' link_id  ='.intval($link_id));
			$link_info = $link_obj->query_keke_witkey_link();
			$link_info = $link_info[0];
		}
		
		if($sbt_shop_link){
			$link_obj->setLink_name($txt_link_name);
			$link_obj->setLink_url($txt_link_url);
			$link_obj->setShop_id($shop_info[shop_id]);
			$link_obj->setLink_type(4);
			if($hdn_link_id){
				$link_obj->setLink_id(intval($hdn_link_id));
				$res = $link_obj->edit_keke_witkey_link();
			}else{
				$res = $link_obj->create_keke_witkey_link();
			}
			if($res){
				Func_comm_class::showmessage('友情链接编辑成功！','index.php?do='.$do.'&view='.$view.'&op='.$op);
			}
		}
		
		if($ac=='del'){
			$link_obj->setLink_id(intval($link_id));
			$res = $link_obj->del_keke_witkey_link();
			if($res){
				Func_comm_class::showmessage('友情链接删除成功！','index.php?do='.$do.'&view='.$view.'&op='.$op);
			}
		}
	;
	break;
	default:
		;
	break;
}

require_once  $template_obj->template ($do."_".$view);