<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(53);

$link_obj = new Keke_witkey_link_class();

if($link_id){
	$link_info = $link_obj->setWhere('link_id='.$link_id);
	$link_info = $link_obj->query_keke_witkey_link();
	$link_info = $link_info[0];
}

if($sbt_edit){
	$link_obj->setLink_type($slt_link_type);
	$link_obj->setLink_name($txt_link_name);
	$link_obj->setLink_pic($txt_link_pic);
	$link_obj->setLink_url($txt_link_url);
	$link_obj->setLink_status(1);
	$link_obj->setListorder(intval($txt_listorder));
	$link_obj->setOn_time(time());
	if($hdn_link_id){
		$link_obj->setLink_id($hdn_link_id);
		$res = $link_obj->edit_keke_witkey_link();
		if($res){
			Func_comm_class::adminSystemLog("编辑友情链接$hdn_link_id");
			Func_comm_class::adminshowmessage('友情链接编辑成功！','index.php?do='.$do.'&view=link');
		}
	}else{
		$res = $link_obj->create_keke_witkey_link();
		if($res){
			Func_comm_class::adminSystemLog("添加友情链接$res");
			Func_comm_class::adminshowmessage('友情链接编辑成功！','index.php?do='.$do.'&view=link');
		}
	}
}


require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do . '_' . $view );