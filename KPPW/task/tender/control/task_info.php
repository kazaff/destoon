<?php


if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$nav_active_index = "tender";

$tender_status_arr = array ('0' => '任务未付款', '1' => '任务待审核', '2' => '任务招标中', '3' => '任务进行中', '4' => '任务进行中', '6' => '任务冻结中', '7' => '任务完成' );


$basic_config = Cache_ext_Class::getConfig ( 'basic' );
$kf_phones = $basic_config ['kf_phone'];
$kf_phone_arr = explode ( ',', $kf_phones );
if (is_array ( $kf_phone_arr )) {
	$kf_phone = $kf_phone_arr [0];
}


$tender_config = Cache_ext_Class::getConfig ( 'zb_task' );


$tender_cash_rule = Cache_ext_Class::getConfigRule ( 'cash' );

$task_obj = new Keke_witkey_task_class ( ); 


$indus_obj = new Keke_witkey_industry_class ( );


$space_obj = new Keke_witkey_space_class ( ); 


$sign_obj = new Keke_witkey_sign_class ( ); 


$comment_obj = new Keke_witkey_comment_class ( ); 


$bid_obj = new Keke_witkey_bid_class ( );


$page_obj = new Pages_Class ( ); 

$kf_info = Func_comm_class::getuserinfo($task_info['kf_uid']);

function is_mark($work_id ,$task_id,$user_type,$uid){
	$mark_obj = new Keke_witkey_mark_log_class();
	if($user_type==2){
		$mark_obj->setWhere(' work_id= '.$work_id.' and mark_status !="" and by_uid ='.$uid);
		$mark_info = $mark_obj->query_keke_witkey_mark_log();
	}else{
		$mark_obj->setWhere(' mark_type = 1 and  obj_id = '.$task_id.' and mark_status !="" and by_uid ='.$uid);
		$mark_info = $mark_obj->query_keke_witkey_mark_log();
	}

	if($mark_info){
		return 1;
	}else{
		return 0;
	}
}

//load  attachment
$file_obj = new Keke_witkey_file_class();
$file_obj->setWhere("task_id = '{$task_id}'");
$file_list = $file_obj->query_keke_witkey_file();

$view = $view ? $view : 'demand';

if (isset ( $ajax )) {
	
	$user_info = Func_comm_class::getuserinfo($uid);
	$access_rule = Cache_ext_Class::getRule("taskfav",$uid,$user_info,$model_info['model_id']);
	if ($access_rule<0){
			Func_comm_class::echojson ( '', -1 );
	}
	
	$task_favor_obj = new Keke_witkey_task_favor_class ( );
	
	$task_favor_obj->setWhere ( " uid = $uid and task_id = $task_id" );
	$count = $task_favor_obj->count_keke_witkey_task_favor ();
	if ($count) {
		Func_comm_class::echojson ( '', 0 );
	} else {
		$task_favor_obj->setTask_id ( $task_id );
		if (strtolower($_K['charset'])!='UTF-8'){
			$task_title = Func_comm_class::utftogbk ( $task_title );
		}
		$task_favor_obj->setTask_title (  $task_title );
		$task_favor_obj->setUid ( $uid );
		$task_favor_obj->setUsername ( $username );
		$task_favor_obj->setFav_time ( time () );
		$res = $task_favor_obj->create_keke_witkey_task_favor ();
		Func_comm_class::update_score_value($uid,'collect_task',3);
		if ($res) {
			Func_comm_class::echojson ( '', 1 );
		}
	}
	die ();
}

if ($task_info [task_status] == 0 && $uid != $task_info ['uid']) {
	Func_comm_class::showmessage ( '当前任务未发布成功！','index.php',3,'','error' );
} elseif ($task_info [task_status] == 1 && $uid != $task_info ['uid']) {
	Func_comm_class::showmessage ( '当前任务还未审核！','index.php',3,'','error' );
} elseif ($task_info [task_status] == 6 && $uid != $task_info ['uid']) {
	Func_comm_class::showmessage ( '当前任务已被冻结！','index.php',3,'','error' );
}

if(in_array($task_info['task_status'],array(2,3))){
	$time_traveler_obj = new Tender_time_class();
	$res = $time_traveler_obj->validtaskstatus(0,$task_info);
	if ($res){
		$task_obj->setWhere ( 'task_id=' . intval ( $task_id ) );
		$task_info = $task_obj->query_keke_witkey_task ();
		$task_info = $task_info [0];
	}
}

$url_this = 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'];

if (time () >= $task_info [start_time] + $tender_config [zb_max_time] * 3600 * 24) {
	$task_obj->setTask_id ( $task_id );
	$task_obj->setTask_status ( 7 );
	$task_obj->edit_keke_witkey_task ();
}


$bid_obj->setWhere ( 'task_id=' . intval ( $task_id ) . ' and  bid_status = 1' );
$is_selected = $bid_obj->query_keke_witkey_bid ();
	

$bid_obj->setWhere ( 'task_id=' . intval ( $task_id ) . ' and  uid  = ' . intval ( $uid ) );
$is_bid = $bid_obj->count_keke_witkey_bid ();
	

if ($task_info [uid]) {
	$space_obj->setWhere ( 'uid=' . $task_info [uid] );
	$space_info = $space_obj->query_keke_witkey_space ();
	$space_info = $space_info [0];
}

$indus_arr = Cache_ext_Class::getIndustryList(1);
if ($task_info [indus_id]) {
	$indus_p_id = $indus_arr[$task_info['indus_id']]['indus_pid'];
}





$sign_obj->setWhere ( 'task_id=' . $task_id );
$sign_arr = $sign_obj->query_keke_witkey_sign ();
$sign_count = intval ( count ( $sign_arr ) );

if ($view == 'bid') {
	include 'inc_task_bid_list.php';
} elseif ($view == 'comment') {
	
	$comment_obj->setWhere ( 'obj_id=' . $task_id .' and comment_type=1');
	$count = $comment_obj->count_keke_witkey_comment ();
	
	$page_size = $page_size?$page_size:10;
	$url = 'index.php?do=task&view=' . $view . '&page_size=' . $page_size . '&task_id=' . $task_id;
	$page = $_GET ['page'] ? $_GET ['page'] : 1;
	$limit = $page_size;
	$comment_pages = $page_obj->getPages ( $count, $limit, $page, $url );
	
	$comment_obj->setWhere ( 'obj_id=' . $task_id . $comment_pages [where] );
	$comment_arr = $comment_obj->query_keke_witkey_comment ();
}elseif($view=='favorable'){
		$mark_obj = new Keke_witkey_mark_log_class();
	
		$where =' 1= 1 and mark_type = 1 and mark_status !=0 and obj_id = '.$task_id;
		
		if($slt_mark_type){
			$where.=' and mark_status = '.intval($slt_mark_type);
		}
		if($slt_mark_content){
			if(intval($slt_mark_content)==1){
				$where.=' and mark_content !="" ';
			}else{
				$where.=' and mark_content ="" ';
			}
		}
		
		if($slt_mark_from){
			if(intval($slt_mark_from)==1){
				$where.=' and  user_type = 1';
			}else if(intval($slt_mark_from)==2){
				$where.=' and user_type = 2 ';
			}else{
				$where.=' and  user_type = 1';
			}
		}else{
			$where.=' and  user_type = 1';
		}
		
		$order_where=' order by mark_time desc ';
		$where=$where.$order_where;
		
		$mark_obj->setWhere($where);
		$count = $mark_obj->count_keke_witkey_mark_log();
		
 
		$page_size = 10;
		$url = 'index.php?do=task&view=' . $view . '&page_size=' . $page_size . '&task_id=' . $task_id;
		
		if($slt_mark_type){
			$url.='&slt_mark_type='.$slt_mark_type;
		}
		if($slt_mark_content){
			$url.='&slt_mark_content='.$slt_mark_content;
		}
		if($slt_mark_from){
			$url.='&slt_mark_from='.$slt_mark_from;
		}
		
		$page = $_GET ['page'] ? $_GET ['page'] : 1;
		$limit = $page_size;
		$mark_log_pages = $page_obj->getPages ( $count, $limit, $page, $url );
		
		$mark_obj->setWhere($where.$mark_log_pages[where]);
		$mark_log_arr = $mark_obj->query_keke_witkey_mark_log();

}



if ($ac == 'message') {
	require_once $template_obj->template ( $ac );
}

if (!$_SESSION['task_views_'.$task_id]){
	$_SESSION['task_views_'.$task_id]=1;
	db_factory::execute("update ".TABLEPRE."witkey_task set view_num=view_num+1 where task_id='$task_id'");
}


require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/tpl/'.$_K['template']."/task_info" );



