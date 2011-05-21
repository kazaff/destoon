<?php


if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}
$_K['is_rewrite']=0;
$member_id = intval($member_id);

if(intval($member_id)){
	$space_info = Func_comm_class::getuserinfo($member_id);
	$shop_info = Cache_ext_Class::gettabledata('witkey_shop',"uid = $member_id","",0);
	$shop_info = $shop_info[0];
	if($space_info[studio_id]){
		$views = array('person_index','person_log','person_mark','studio_index','studio_zb_task','studio_fb_task','studio_mark');
		$studio_obj = new Keke_witkey_studio_class();
		$studio_obj->setWhere("studio_id = {$space_info[studio_id]}");
		$studio_info = $studio_obj->query_keke_witkey_studio();
		$studio_info = $studio_info[0];
		$view = in_array($view,$views)?$view:"person_index";
	}else{
		$views = array('person_index','person_log','person_mark');
		$view = in_array($view,$views)?$view:"person_index";
	}
	if($uid){
		if($member_id!=$uid){
			Func_comm_class::update_score_value($uid,'view_space',3);
		}
	}
	
} else{
	Func_comm_class::showmessage('用户空间提示','index.php',2,'您访问的用户不存在！','error');
}

require 'space_'.$view.'.php';
