<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(20);

$indus_obj = new Keke_witkey_industry_class();

$where = ' 1 = 1 and indus_type = 1 ';


if(isset($sbt_search)){
	if($slt_indus_id){
		$where.=' and indus_pid = '.$slt_indus_id;
	}
	
	if($txt_id){
		$where.=' and indus_id = '.$txt_id;
	}
	if($txt_title){
		$where.=' and indus_name like '.'"%'.$txt_title.'%" ';
	}
}



switch ($ord) {
	case 1:
		$where.=' order by indus_id desc ';
	;
	break;
	case 2:
		$where.=' order by indus_id asc ';
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
		$where.=' order by listorder desc ';
	;
	break;
	case 6:
		$where.=' order by listorder asc ';
	;
	break;
	default:
		;
	break;
}




$indus_obj->setWhere($where);
$indus_show_arr = $indus_obj->query_keke_witkey_industry();

$temp_arr = array();
Func_comm_class::get_tree($indus_show_arr,$temp_arr,'list',NULL,'indus_id','indus_pid','indus_name');
$indus_show_arr = $temp_arr;
unset($temp_arr);

$indus_arr = Cache_ext_Class::getIndustryList();


if($ac=='del'){
	if($indus_id){
		$indus_obj->setWhere('indus_id='.$indus_id);
		$res = $indus_obj->del_keke_witkey_industry();
		Cache::delete('keke_witkey_industry');
		Func_comm_class::adminSystemLog("删除行业$indus_id");
		Func_comm_class::adminshowmessage('行业删除成功！','index.php?do='.$do.'&view='.$view);
	}else{
		Func_comm_class::adminshowmessage('行业不存在，删除失败！','index.php?do='.$do.'&view='.$view);
	}
}


if (isset ( $sbt_action )) {
	$keyids = $ckb;
	
	 if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	 }
	if (count ( $keyids )) {
		$indus_obj->setWhere(' indus_id in ('.$ids.') ');
		switch ($sbt_action) {
			
			case '批量删除' : 
				Func_comm_class::adminSystemLog("删除行业$ids");
				$res = $indus_obj->del_keke_witkey_industry();
				break;
			default : 
				break;
		}
		Cache::delete(Cache::delete('keke_witkey_industry'));
		
		if($res){
			Func_comm_class::adminshowmessage('批量操作成功！','index.php?do='.$do.'&view='.$view);
		}else{
			Func_comm_class::adminshowmessage('批量操作失败，请重新操作！','index.php?do='.$do.'&view='.$view);
		}
	} else {
		Func_comm_class::adminshowmessage('请选择要操作的项！','index.php?do='.$do.'&view='.$view);
	}
}






$temp_arr = array();
Func_comm_class::get_tree($indus_arr,$temp_arr,'option',NULL,'indus_id','indus_pid','indus_name');
$indus_arr = $temp_arr;
unset($temp_arr);

require_once $template_obj->template ( 'control/admin/tpl/admin_'.$do.'_' . $view );