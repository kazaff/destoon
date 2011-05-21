<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}



$auth_item_obj = new Keke_witkey_auth_item_class();
$page_obj = new Pages_Class();

$where = ' 1 = 1  ';


if(isset($sbt_search)){
	if($slt_link_type){
		$where.=' and link_type = '.$slt_link_type;
	}
	if($txt_id){
		$where.=' and link_id = '.$txt_id;
	}
	if($txt_title){
		$where.=' and link_name like '.'"%'.$txt_title.'%" ';
	}
}



switch ($ord) {
	case 1:
		$where.=' order by auth_id desc ';
	;
	break;
	case 2:
		$where.=' order by auth_id asc ';
	;
	break;
	case 3:
		$where.=' order by update_time desc ';
	;
	break;
	case 4:
		$where.=' order by update_time asc ';
	;
	break;
	default:
		$where.=' order by update_time desc ';
	break;
}



$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;
	

$auth_item_obj->setWhere($where);
$count = $auth_item_obj->count_keke_witkey_auth_item();


$url ='index.php?do='.$do.'&view='.$view.'&slt_page_size='.$slt_page_size.'&txt_id='.$txt_id.'&txt_title='.$txt_title;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);


$auth_item_obj->setWhere($where.$pages[where]);
$auth_item_arr = $auth_item_obj->query_keke_witkey_auth_item();


if($ac=='del'){
	if($item_id){
		$auth_item_obj->setWhere('auth_id='.$item_id);
		$res = $auth_item_obj->del_keke_witkey_auth_item();
		Func_comm_class::adminSystemLog("删除认证项目$item_id");
		Func_comm_class::adminshowmessage('认证项目删除成功！','index.php?do='.$do.'&view='.$view);
	}else{
		Func_comm_class::adminshowmessage('认证项目不存在，删除失败！','index.php?do='.$do.'&view='.$view);
	}
}


if (isset ( $sbt_action )) {
	$keyids = $ckb;

	 if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	 }
	if (count ( $keyids )) {
		
		$auth_item_obj->setWhere(' auth_id in ('.$ids.') ');
		switch ($sbt_action) {
		
			case '批量删除' : 
				$res = $auth_item_obj->del_keke_witkey_auth_item();
				Func_comm_class::adminSystemLog("删除认证项目$ids");
				break;
			default : 
				break;
		}
		
		if($res){
			Func_comm_class::adminshowmessage('批量操作成功！','index.php?do='.$do.'&view='.$view);
		}else{
			Func_comm_class::adminshowmessage('批量操作失败，请重新操作！','index.php?do='.$do.'&view='.$view);
		}
	} else {
		Func_comm_class::adminshowmessage('请选择要操作的项！','index.php?do='.$do.'&view='.$view);
	}
}


require_once $template_obj->template ( 'control/admin/tpl/admin_'.$do.'_' . $view );