<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(76);


$comment_obj = new Keke_witkey_comment_class();
$comment_ext_obj = new Keke_witkey_comment_ext_class();
$page_obj = new Pages_Class();

$where = ' 1 = 1 and comment_type = 5 ';

if(isset($sbt_search)){
	if($txt_task_id){
		$where.=' and task_id = '.$txt_task_id;
	}
	if($slt_task_type){
		$where.=' and model_id = '.$slt_task_type;
	}
	if($txt_id){
		$where.=' and comment_id = '.$txt_id;
	}
	if($txt_title){
		$where.=' and content like '.'"%'.$txt_title.'%" ';
	}
}


switch ($ord) {
	case 1:
		$where.=' order by comment_id desc ';
	;
	break;
	case 2:
		$where.=' order by comment_id asc ';
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
	default:
		;
	break;
}


$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;
	
$comment_ext_obj->setWhere($where);
$count = $comment_ext_obj->count_keke_witkey_comment();

$url ='index.php?do='.$do.'&view='.$view.'&slt_page_size='.$slt_page_size.'&txt_id='.$txt_id.'&txt_title='.$txt_title;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);

$comment_ext_obj->setWhere($where.$pages[where]);
$comment_arr = $comment_ext_obj->query_keke_witkey_comment();

if($ac=='del'){
	if($comment_id){
		$comment_obj->setWhere('comment_id='.$comment_id);
		$res = $comment_obj->del_keke_witkey_comment();
		Func_comm_class::adminshowmessage('评论删除成功！','index.php?do='.$do.'&view='.$view);
	}else{
		Func_comm_class::adminshowmessage('评论不存在，删除失败！','index.php?do='.$do.'&view='.$view);
	}
}

if (isset ( $sbt_action )) {
	$keyids = $ckb;
	
	 if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	 }
	if (count ( $keyids )) {
		
		$comment_obj->setWhere(' comment_id in ('.$ids.') ');
		switch ($sbt_action) {
		
			case '批量删除' :
				$res = $comment_obj->del_keke_witkey_comment();
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

 

require_once $template_obj->template ( 'control/admin/tpl/admin_task_' . $view );