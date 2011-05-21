<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(8);


$finace_obj = new Keke_witkey_finance_class();
$page_obj = new Pages_Class();


$where = ' 1 = 1 ';


if(isset($sbt_search)){
	if($slt_fina_type){
		$where.=' and fina_type = '.$slt_fina_type;
	}
	if($slt_fina_narrate){
		$where.=' and fina_narrate = '.$slt_fina_narrate;
	}
	if($txt_id){
		$where.=' and fina_id = '.$txt_id;
	}
	if($txt_title){
		$where.=' and username like '.'"%'.$txt_title.'%" ';
	}
}


switch ($ord) {
	case 1:
		$where.=' order by fina_id desc ';
	;
	break;
	case 2:
		$where.=' order by fina_id asc ';
	;
	break;
	case 3:
		$where.=' order by fina_time desc ';
	;
	break;
	case 4:
		$where.=' order by fina_time asc ';
	;
	break;
	default:
		$where.=' order by fina_time desc ';
	break;
}



$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;
	

$finace_obj->setWhere($where);
$count = $finace_obj->count_keke_witkey_finance();


$url ='index.php?do='.$do.'&view='.$view.'&slt_page_size='.$slt_page_size.'&txt_id='.$txt_id.'&txt_title='.$txt_title;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);


$finace_obj->setWhere($where.$pages[where]);
$finace_arr = $finace_obj->query_keke_witkey_finance();




switch ($ac) {	
	case 'del':
		if($fina_id){
			$finace_obj->setWhere('fina_id='.$fina_id);
			$res = $finace_obj->del_keke_witkey_finance();	
			Func_comm_class::adminSystemLog("删除财务记录$fina_id");
			Func_comm_class::adminshowmessage('财务清单删除成功！','index.php?do='.$do.'&view='.$view);
		}else{
			Func_comm_class::adminshowmessage('财务清单不存在，删除失败！','index.php?do='.$do.'&view='.$view);
		}
	;
	break;
	
	default:
		;
	break;
}



if (isset ( $sbt_del )) {
	//$o_p = $rdo;
	$keyids = $ckb;

	 if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	 }
	if (count ( $keyids )) {
		if ($ids){
			$finace_obj->setWhere(' fina_id in ('.$ids.') ');
			switch ($sbt_del) {
				case '批量删除' : 
					$finace_obj->del_keke_witkey_finance();
					Func_comm_class::adminSystemLog("批量删除财务记录$ids");
					break;
				default : 
					break;
			}
			Func_comm_class::adminshowmessage('批量操作成功！','index.php?do='.$do.'&view='.$view);
		} else {
			Func_comm_class::adminshowmessage('请选择要执行的动作！','index.php?do='.$do.'&view='.$view);
		}
	} else {
		Func_comm_class::adminshowmessage('请选择要操作的项！','index.php?do='.$do.'&view='.$view);
	}
}

require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do . '_' . $view );