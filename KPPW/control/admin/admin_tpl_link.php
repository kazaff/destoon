<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(53);


$link_obj = new Keke_witkey_link_class();
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
		$where.=' order by link_id desc ';
	;
	break;
	case 2:
		$where.=' order by link_id asc ';
	;
	break;
	case 3:
		$where.=' order by on_time desc ';
	;
	break;
	case 4:
		$where.=' order by on_time asc ';
	;
	break;
	case 5:
		$where.=' order by listorder asc ';
	;
	break;
	case 6:
		$where.=' order by listorder asc ';
	;
	break;
	default:
		$where.=' order by on_time desc ';
	break;
}



$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;
	

$link_obj->setWhere($where);
$count = $link_obj->count_keke_witkey_link();


$url ='index.php?do='.$do.'&view='.$view.'&slt_page_size='.$slt_page_size.'&txt_id='.$txt_id.'&txt_title='.$txt_title;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);


$link_obj->setWhere($where.$pages[where]);
$link_arr = $link_obj->query_keke_witkey_link();



if($ac=='del'){
	if($link_id){
		$link_obj->setWhere('link_id='.$link_id);
		$res = $link_obj->del_keke_witkey_link();
		Func_comm_class::adminSystemLog("删除友情链接$link_id");
		Func_comm_class::adminshowmessage('友情链接删除成功！','index.php?do='.$do.'&view='.$view);
	}else{
		Func_comm_class::adminshowmessage('友情链接不存在，删除失败！','index.php?do='.$do.'&view='.$view);
	}
}


if (isset ( $sbt_action )) {
	$keyids = $ckb;

	 if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	 }
	if (count ( $keyids )) {
		
		$link_obj->setWhere(' link_id in ('.$ids.') ');
		switch ($sbt_action) {
		
			case '批量删除' : 
				$res = $link_obj->del_keke_witkey_link();
				Func_comm_class::adminSystemLog("删除友情链接$ids");
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


require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do . '_' . $view );