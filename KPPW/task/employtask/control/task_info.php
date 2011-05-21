<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$nav_active_index = 2;

$kf_phones = $basic_config['kf_phone'];	
$kf_phone_arr = explode(',',$kf_phones);
if(is_array($kf_phone_arr)){
	$kf_phone= $kf_phone_arr[0];
}


$reward_status_arr = array ('0' => '任务未付款', '1' => '任务待审核', '2' => '任务确认中', '3' => '进行中', '4' => '任务投票中', '5' => '任务失败', '6' => '任务冻结', '7' => '任务完成' );
$model_id=6;


$file_path = S_ROOT."./task/".$model_list[$model_id]['model_code']."/control/admin/task_config.xml";
$reward_config = Xml_Oper_Class::get_xml_toarr($file_path);


$deduct_scale = $reward_config ['deduct_scale']/100;


if ($uid){
$userinfo = Func_comm_class::getuserinfo($uid);
}
else {
	Func_comm_class::showmessage("您需要先登录",'index.php?do=login');
}
$task_obj = new Keke_witkey_task_class ( ); 
$task_ext_obj = new Keke_witkey_task_ext_class();

$indus_obj = new Keke_witkey_industry_class ( );

$space_obj = new Keke_witkey_space_class ( );


$sign_obj = new Keke_witkey_sign_class ( );


$comment_obj = new Keke_witkey_comment_class ( );


$work_obj = new Keke_witkey_work_class ( ); 

	

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

$file_obj = new Keke_witkey_file_class();
$file_obj->setWhere("task_id = '{$task_id}'");
$file_list = $file_obj->query_keke_witkey_file();

$view = $view ? $view : 'demand';

$task_id = intval ( $task_id );

if (isset ( $ajax )) {
	
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
	
	if ($task_info [task_status] == 0&&$uid!=$task_info['uid']) {
		Func_comm_class::showmessage ( '当前任务未发布成功！' );
	} elseif ($task_info [task_status] == 1&&$uid!=$task_info['uid']) {
		Func_comm_class::showmessage ( '当前任务还未审核！' );
	} elseif ($task_info [task_status] == 6&&$uid!=$task_info['uid']) {
		Func_comm_class::showmessage ( '当前任务已被冻结！' );
	} else {
	}
	
	if(in_array($task_info['task_status'],array(2,3,4))){
		$time_traveler_obj = new Employtask_time_class();
		$res = $time_traveler_obj->validtaskstatus(0,$task_info);
		if ($res){
			$task_obj->setWhere ( 'task_id=' . intval ( $task_id ) );
			$task_info = $task_obj->query_keke_witkey_task ();
			$task_info = $task_info [0];
		}
	}
	
	$task_info [remaining_time] = Func_comm_class::time2Units ( $task_info [end_time] );
	
	$url_this = 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'] . "&member_id=$uid";
	
	
	
	$work_obj->setWhere ( 'task_id=' . intval ( $task_id ) );
	$work_count = $work_obj->count_keke_witkey_work ();
	$work_count = intval ( $work_count );
		

	$work_obj->setWhere ( 'task_id=' . intval ( $task_id ) . ' and work_status in (1,2,3,4,6) ' );
	$selected_count = $work_obj->count_keke_witkey_work ();
	$selected_count = intval ( $selected_count );
	
	
	$work_obj->setWhere ( ' task_id = ' . intval ( $task_id ) . ' and work_status = 4 ' );
	$work_info = $work_obj->query_keke_witkey_work ();
	$work_info = $work_info [0];
	
	
	
	if ($task_info [uid]) {
		$space_obj->setWhere ( 'uid=' . $task_info [uid] );
		$space_info = $space_obj->query_keke_witkey_space ();
		$space_info = $space_info [0];
	}
	$indus_obj->setWhere("indus_type=1");
	$indus_arr = $indus_obj->query_keke_witkey_industry ();
	
	if ($task_info [indus_id]) {
		$indus_p_id = $indus_arr [$task_info [indus_id] - 1] [indus_pid];
		$indus_c_id = $indus_arr [$task_info [indus_id] - 1] [indus_id];
		$indus_c_name = $indus_arr [$task_info [indus_id] - 1] [indus_name];
	}
	
	if ($indus_c_name) {
		$indus_p_name = $indus_arr [$indus_p_id - 1] [indus_name];
	}
	
	if ($view == 'work') {
		include 'inc_task_work_list.php';
	}
	elseif($view=='favorable'){
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


require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/tpl/'.$_K['template']."/task_info" );