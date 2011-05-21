<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$studio_obj = new Keke_witkey_studio_class();
$space_obj = new Keke_witkey_space_class();
$page_obj = new Pages_Class();


$where = ' 1 = 1 ';

if(isset($sbt_search)){
	if($txt_id){
		$where.=' and studio_id = '.$txt_id;
	}
	if($txt_title){
		$where.=' and title like '.'"%'.$txt_title.'%" ';
	}
}


switch ($ord) {
	case 1:
		$where.=' order by studio_id desc ';
	;
	break;
	case 2:
		$where.=' order by studio_id asc ';
	;
	break;
	case 3:
		$where.=' order by studio_id desc ';
	;
	break;
	case 4:
		$where.=' order by studio_id asc ';
	;
	break;
	default:
		$where.=' order by studio_id desc ';
	break;
}


$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;

$studio_obj->setWhere($where);
$count = $studio_obj->count_keke_witkey_studio();

$url ='index.php?do='.$do.'&view='.$view.'&slt_page_size='.$slt_page_size.'&txt_id='.$txt_id.'&txt_title='.$txt_title;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);

$studio_obj->setWhere($where.$pages[where]);
$studio_arr = $studio_obj->query_keke_witkey_studio();


switch ($ac) {	
	case 'pass':
		if($studio_id){
			$studio_obj->setWhere('studio_id='.$studio_id);
			$studio_info = $studio_obj->query_keke_witkey_studio();
			$studio_info = $studio_info[0];
			$studio_obj->setWhere('studio_id='.$studio_id);
			$studio_obj->setStudio_status(1);
			$res = $studio_obj->edit_keke_witkey_studio();
			if($res){
				Func_comm_class::notify_user("工作室审核通过","您的工作室已通过审核。",$studio_info['uid'],$studio_info['username']);
				Func_comm_class::adminSystemLog("通过工作室申请$studio_id");
				Func_comm_class::adminshowmessage('工作室申请审核通过！','index.php?do='.$do.'&view='.$view);
			}
		}else{
			Func_comm_class::adminshowmessage('工作室申请不存在，审核失败！','index.php?do='.$do.'&view='.$view);
		}
	;
	break;
	case 'del':
		if($studio_id){
			$studio_obj->setWhere('studio_id='.$studio_id);
			$studio_info = $studio_obj->query_keke_witkey_studio();
			$studio_info = $studio_info[0];
			$studio_obj->setWhere('studio_id='.$studio_id);
			$studio_obj->setStudio_status(1);
			$studio_obj->del_keke_witkey_studio();
			$studio_apply_obj = new Keke_witkey_studio_apply_class();
			$studio_apply_obj->setWhere("studio_id = $studio_id");
			$studio_apply_obj->del_keke_witkey_studio_apply();
			$studio_member_obj = new Keke_witkey_studio_member_class();
			$studio_member_obj->setWhere("studio_id = $studio_id");
			$studio_member_obj->del_keke_witkey_studio_member();
			db_factory::execute("update ".TABLEPRE."witkey_space set studio_id = null where studio_id = $studio_id");
			Func_comm_class::notify_user("工作室审核失败","您的工作室未通过审核。",$studio_info['uid'],$studio_info['username']);
			
			
			Func_comm_class::adminSystemLog("删除工作室申请$studio_id");
			Func_comm_class::adminshowmessage('工作室申请删除成功！','index.php?do='.$do.'&view='.$view);
		}else{
			Func_comm_class::adminshowmessage('工作室申请不存在，删除失败！','index.php?do='.$do.'&view='.$view);
		}
	;
	break;
	default:
		;
	break;
}



if (isset ( $sbt_action )) {
	$keyids = $ckb;
	 if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	 }
	if (count ( $keyids )) {
		$studio_obj->setWhere(' studio_id in ('.$ids.') ');
		switch ($sbt_action) {
			case '直接删除' : 
				$res = $studio_obj->del_keke_witkey_studio();
				db_factory::execute("update ".TABLEPRE."witkey_space set studio_id = null where studio_id in ('.$ids.')");
				Func_comm_class::adminSystemLog("删除工作室申请$ids");
				break;
			case '批量审核' : 
				$studio_obj->setStudio_status(1);
				$res = $studio_obj->edit_keke_witkey_studio();
				Func_comm_class::adminSystemLog("审核工作室申请$ids");
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