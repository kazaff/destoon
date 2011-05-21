<?php


if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$cus_cate_obj = new Keke_witkey_shop_cus_cate_class();

$shop_info = $shop_info_arr[0];
if (!$shop_info){
	Func_comm_class::showmessage("您没有开通店铺","index.php?do=user",3,"","error");
}
$cus_cate_obj->setWhere(' obj_type = 2 and  shop_id = '.$shop_info[shop_id]);
$cus_cate_arr = $cus_cate_obj->query_keke_witkey_shop_cus_cate();


if($cate_id){
	$cus_cate_obj->setWhere(' cus_cate_id =  '.$cate_id);
	$cus_cate_info = $cus_cate_obj->query_keke_witkey_shop_cus_cate();
	$cus_cate_info = $cus_cate_info[0];
}

if($sbt_cate){
	
	if($sbt_cate=="立即添加"){
	$cus_cate_obj->setCate_name($txt_cate_name);
	$cus_cate_obj->setShop_id($shop_info[shop_id]);
	$cus_cate_obj->setObj_type(2); 
	$res = $cus_cate_obj->create_keke_witkey_shop_cus_cate();
		if($res){
			Func_comm_class::showmessage('自定义分类添加成功！','index.php?do='.$do.'&view='.$view);
		}
	}
	if($sbt_cate=="立即编辑"){
		$cus_cate_obj->setCate_name($txt_cate_name);
		$cus_cate_obj->setShop_id($shop_info[shop_id]);
		$cus_cate_obj->setObj_type(2);
		if($hdn_cus_cate_id){
			$cus_cate_obj->setCus_cate_id($hdn_cus_cate_id);
			$res = $cus_cate_obj->edit_keke_witkey_shop_cus_cate();
		}else{
			$res = $cus_cate_obj->create_keke_witkey_shop_cus_cate();
		}
		
		if($res){
			Func_comm_class::showmessage('自定义分类编辑成功！','index.php?do='.$do.'&view='.$view);
		}
	}
}
if($ac=='del'){
	$cus_cate_obj->setCus_cate_id(intval($cate_id));
	$res = $cus_cate_obj->del_keke_witkey_shop_cus_cate();
	if($res){
		Func_comm_class::showmessage('自定义分类删除成功！','index.php?do='.$do.'&view='.$view);
	}
}


require_once  $template_obj->template ($do."_".$view);