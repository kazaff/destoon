<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(21);

$skill_obj = new Keke_witkey_skill_class();
$skill_obj = new Keke_witkey_skill_class();
$indus_obj = new Keke_witkey_industry_class();

$where = ' 1 = 1 ';


if(isset($sbt_search)){
	if($slt_indus_id){
		$where.=' and indus_id = '.$slt_indus_id;
	}
	if($txt_id){
		$where.=' and skill_id = '.$txt_id;
	}
	if($txt_title){
		$where.=' and skill_name like '.'"%'.$txt_title.'%" ';
	}
}


switch ($ord) {
	case 1:
		$where.=' order by skill_id desc ';
	;
	break;
	case 2:
		$where.=' order by skill_id asc ';
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
		$where.=' order by listorder asc ';
	break;
}



$skill_obj->setWhere($where);
$skill_show_arr = $skill_obj->query_keke_witkey_skill();



$indus_arr = Cache_ext_Class::getIndustryList();
$induss_arr = Cache_ext_Class::getIndustryList();

if($ac=='del'){
	if($skill_id){
		$skill_obj->setWhere('skill_id='.$skill_id);
		$res = $skill_obj->del_keke_witkey_skill();
		Cache::delete("keke_witkey_skill");
		Func_comm_class::adminSystemLog("删除技能$skill_id");
		Func_comm_class::adminshowmessage('技能删除成功！','index.php?do='.$do.'&view='.$view);
	}else{
		Func_comm_class::adminshowmessage('技能不存在，删除失败！','index.php?do='.$do.'&view='.$view);
	}
}

if (isset ( $sbt_action )) {
	$o_p = $rdo;
	$keyids = $ckb;
	
	 if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	 }
	if (count ( $keyids )) {
		
		$skill_obj->setWhere(' skill_id in ('.$ids.') ');
		switch ($sbt_action) {
		
			case '批量删除' : 
				$res = $skill_obj->del_keke_witkey_skill();
				break;
			default : 
				break;
		}
		Cache::delete("keke_witkey_skill");
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



require_once $template_obj->template ( 'control/admin/tpl/admin_task_' . $view );