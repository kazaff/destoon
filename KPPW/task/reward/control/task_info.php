<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$nav_active_index = "reward";

$kf_phones = $basic_config ['kf_phone'];
$kf_phone_arr = explode ( ',', $kf_phones );
if (is_array ( $kf_phone_arr )) {
	$kf_phone = $kf_phone_arr [0];
}

$reward_status_arr = array ('0' => '任务未付款', '1' => '任务待审核', '2' => '任务进行中', '3' => '任务公示中', '4' => '任务投票中', '5' => '任务失败', '6' => '任务冻结', '7' => '任务完成' );

$reward_config = Cache_ext_Class::getConfig ( 'xs_task' );

$deduct_scale = $reward_config ['deduct_scale'] / 100;

$reward_day_rule = Cache_ext_Class::gettabledata ( "witkey_day_rule", "model_id='{$model_info['model_id']}'", "rule_cash", null, "day_rule_id" );

if ($uid) {
	$userinfo = Func_comm_class::getuserinfo ( $uid );
}
$task_obj = new Keke_witkey_task_class ( );
$task_ext_obj = new Keke_witkey_task_ext_class ( );

$indus_obj = new Keke_witkey_industry_class ( );

$space_obj = new Keke_witkey_space_class ( );

$sign_obj = new Keke_witkey_sign_class ( );

$comment_obj = new Keke_witkey_comment_class ( );

$work_obj = new Keke_witkey_work_class ( );

$page_obj = new Pages_Class ( );

$kf_info = Func_comm_class::getuserinfo ( $task_info ['kf_uid'] );

function is_mark($work_id, $task_id, $user_type, $uid) {
	$mark_obj = new Keke_witkey_mark_log_class ( );
	if ($user_type == 2) {
		$mark_obj->setWhere ( ' work_id= ' . $work_id . ' and mark_status !="" and by_uid =' . $uid );
		$mark_info = $mark_obj->query_keke_witkey_mark_log ();
	} else {
		$mark_obj->setWhere ( ' mark_type = 1 and  obj_id = ' . $task_id . ' and mark_status !="" and by_uid =' . $uid );
		$mark_info = $mark_obj->query_keke_witkey_mark_log ();
	}
	
	if ($mark_info) {
		return 1;
	} else {
		return 0;
	}
}

//load  attachment
$file_obj = new Keke_witkey_file_class ( );
$file_obj->setWhere ( "task_id = '{$task_id}'" );
$file_list = $file_obj->query_keke_witkey_file ();

//附付检查
function check_attchment($f){
	if(file_exists($f)){
		return Func_comm_class::formatBytes($f);
	}else {
		return "0Bytes";
	}
}

$view = $view ? $view : 'demand';

$task_id = intval ( $task_id );

//收藏任务
if (isset ( $ajax ) && $ajax == 'favor') {
	
	$user_info = Func_comm_class::getuserinfo ( $uid );
	$access_rule = Cache_ext_Class::getRule ( "taskfav", $uid, $user_info, $model_info ['model_id'] );
	if ($access_rule < 0) {
		Func_comm_class::echojson ( '', - 1 );
	}
	
	$task_favor_obj = new Keke_witkey_task_favor_class ( );
	$task_favor_obj->setWhere ( " uid = $uid and task_id = $task_id" );
	$count = $task_favor_obj->count_keke_witkey_task_favor ();
	if ($count) {
		Func_comm_class::echojson ( '', 0 );
	} else {
		$task_favor_obj->setTask_id ( $task_id );
		if (strtolower ( $_K ['charset'] ) != 'UTF-8') {
			$task_title = Func_comm_class::utftogbk ( $task_title );
		}
		$task_favor_obj->setTask_title ( $task_title );
		$task_favor_obj->setUid ( $uid );
		$task_favor_obj->setUsername ( $username );
		$task_favor_obj->setFav_time ( time () );
		$res = $task_favor_obj->create_keke_witkey_task_favor ();
		Func_comm_class::update_score_value ( $uid, 'collect_task', 3 );
		if ($res) {
			Func_comm_class::echojson ( '', 1 );
		}
	}
	die ();
} else if (isset ( $ajax ) && $ajax == 'comment') {
	//添加任务评论
	//每个用户每浏览器只留言一次
	if ($_SESSION ['task_comment_' . $task_id . "_" . $uid] != 1) {
		$comment_obj->setComment_type ( 1 );
		$html = Func_comm_class::str_filter ( $html );
		$comment_obj->setContent ( $html );
		$comment_obj->setObj_id ( $task_id );
		$comment_obj->setOn_time ( time () );
		$comment_obj->setUid ( $uid );
		$comment_obj->setUsername ( $username );
		$res = $comment_obj->create_keke_witkey_comment ();
		$_SESSION ['task_comment_' . $task_id . "_" . $uid] = 1;
		if ($res) {
			Func_comm_class::echojson ( '0', 1 );
		}
	} else {
	     Func_comm_class::echojson(0,0);
	}
}

if (isset ( $member_id )) {
	if ($uid && $uid != $member_id && intval ( $member_id ) > 0) {
		$c = db_factory::query ( "select count(*) as count from " . TABLEPRE . "witkey_promotion where task_id = $task_id and join_uid =$uid" );
		if ($c [0] [count] == 0) {
			$c2 = db_factory::query ( "select count(*) as count from " . TABLEPRE . "witkey_sign where task_id = $task_id and uid=$uid" );
			if ($c2 [0] [count] == 0) {
				$prom_obj = new Keke_witkey_promotion_class ( );
				$prom_obj->setProm_uid ( $member_id );
				$prom_obj->setJoin_uid ( $uid );
				$prom_obj->setTask_id ( $task_id );
				$prom_obj->setProm_time ( time () );
				$prom_obj->create_keke_witkey_promotion ();
			}
		}
	} else if (! $uid) {
		
		if (isset ( $_COOKIE ['prom_cke'] )) {
			$prom_arr = unserialize ( $_COOKIE ['prom_cke'] );
			if (! $prom_arr [$task_id]) {
				$prom_arr [$task_id] = array ($task_id => $member_id, 'time' => time () );
				setcookie ( 'prom_cke', serialize ( $prom_arr ) );
			}
		} else {
			$prom_arr [$task_id] = array ($task_id => $member_id, 'time' => time () );
			setcookie ( 'prom_cke', serialize ( $prom_arr ) );
		}
	
	}

}

if ($task_info [model_id] == 2) {
	Func_comm_class::showmessage ( '该任务属于招标任务', 'index.php?do=task&task_id=' . intval ( $task_info [task_id] ), 1 );
}

if ($task_info [task_status] == 0 && $uid != $task_info ['uid']) {
	Func_comm_class::showmessage ( '当前任务未发布成功！' );
} elseif ($task_info [task_status] == 1 && $uid != $task_info ['uid']) {
	Func_comm_class::showmessage ( '当前任务还未审核！' );
} elseif ($task_info [task_status] == 6 && $uid != $task_info ['uid']) {
	Func_comm_class::showmessage ( '当前任务已被冻结！' );
} else {
}

if (in_array ( $task_info ['task_status'], array (2, 3, 4 ) )) {
	$time_traveler_obj = new Reward_time_class ( );
	$res = $time_traveler_obj->validtaskstatus ( 0, $task_info );
	if ($res) {
		$task_obj->setWhere ( 'task_id=' . intval ( $task_id ) );
		$task_info = $task_obj->query_keke_witkey_task ();
		$task_info = $task_info [0];
	}
}

$task_info [remaining_time] = Func_comm_class::time2Units ( $task_info [end_time] );

$prize_obj = new Keke_witkey_task_prize_class ( );
$prize_obj->setWhere ( 'task_id = ' . $task_id );
$prize_arr = $prize_obj->query_keke_witkey_task_prize ();

if ($uid == $task_info ['uid'] && $task_info ['task_status'] == 2 && $reward_config ['vote_limit_time']) {
	$work_obj->setWhere ( "task_id = '$task_id' and work_status=5" );
	if ($work_obj->count_keke_witkey_work () >= 2) {
		$button_arr ['set_vote'] = 1;
	}
}

$defer_rule_arr = Cache_ext_Class::gettabledata ( "witkey_defer_rule", "model_id = '{$model_info['model_id']}'", "defer_times", 0, "defer_rule_id" );
$delay_obj = new Keke_witkey_task_delay_class ( );
$delay_obj->setWhere ( "task_id='{$task_id}' and delay_status>0 " );
$delaycount = $delay_obj->count_keke_witkey_task_delay ();

if ($delaycount < count ( $defer_rule_arr )) {
	$button_arr ['task_delay'] = 1;
}
$delaycount += 1;
$temp = array ();
foreach ( $defer_rule_arr as $xzx ) {
	$temp [$xzx ['defer_times']] = $xzx;
}
$defer_rule_arr = $temp;
$url_this = 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'] . "&member_id=$uid";

$work_obj->setWhere ( 'task_id=' . intval ( $task_id ) );
$work_count = $work_obj->count_keke_witkey_work ();
$work_count = intval ( $work_count );

$work_obj->setWhere ( 'task_id=' . intval ( $task_id ) . ' and work_status in (1,2,3,4,6) ' );
$selected_count = $work_obj->count_keke_witkey_work ();
$selected_count = intval ( $selected_count );

$left_work_count = intval ( $work_count - $selected_count );

$work_obj->setWhere ( ' task_id = ' . intval ( $task_id ) . ' and work_status = 4 ' );
$work_info = $work_obj->query_keke_witkey_work ();
$work_info = $work_info [0];

if ($task_info [task_status] == 3) {
	$sql = "SELECT b.username AS prom_username,a.prom_id,a.prom_uid,a.pub_uid,a.join_uid,a.task_id,a.prom_money,a.prom_status,a.prom_time,c.username AS join_username
				FROM " . TABLEPRE . "witkey_promotion AS a Left Join " . TABLEPRE . "witkey_member AS b ON b.uid = a.prom_uid
				left Join " . TABLEPRE . "witkey_member AS c ON c.uid = a.join_uid	Left Join " . TABLEPRE . "witkey_work AS d on d.task_id = a.task_id
				where d.work_status in(1,2,3,4,6) and  a.task_id =$task_id";
	$promer_arr = db_factory::query ( $sql );
}
if ($uid) {
	$sign_obj->setWhere ( 'task_id=' . $task_id . ' and uid = ' . $uid );
	$is_sign = $sign_obj->count_keke_witkey_sign ();
}

if ($task_info [uid]) {
	$space_obj->setWhere ( 'uid=' . $task_info [uid] );
	$space_info = $space_obj->query_keke_witkey_space ();
	$space_info = $space_info [0];
}

if ($task_info [indus_id]) {
	$indus_p_id = $indus_arr [$task_info ['indus_id']] ['indus_pid'];
}

$sign_obj->setWhere ( 'task_id=' . $task_id );
$sign_arr = $sign_obj->query_keke_witkey_sign ();
$sign_count = intval ( count ( $sign_arr ) );

//if ($view == 'work' || 1) { 
	include 'inc_task_work_list.php';
//} elseif ($view == 'comment' || 1) {
	$comment_obj->setWhere ( 'obj_id=' . $task_id . ' and comment_type=1' );
	$comment_count = $comment_obj->count_keke_witkey_comment ();
	
	$page_size = 10;
	$url = 'index.php?do=task&view=' . $view . '&page_size=' . $page_size . '&task_id=' . $task_id;
	$page = $_GET ['page'] ? $_GET ['page'] : 1;
	$limit = $page_size;
	$comment_pages = $page_obj->getPages ( $count, $limit, $page, $url );
	
	$comment_obj->setWhere ( 'obj_id=' . $task_id . $comment_pages [where] );
	$comment_arr = $comment_obj->query_keke_witkey_comment ();
	
if ($view == 'favorable') {
	$mark_obj = new Keke_witkey_mark_log_class ( );
	
	$where = ' 1= 1 and mark_type = 1 and mark_status !=0 and obj_id = ' . $task_id;
	
	if ($slt_mark_type) {
		$where .= ' and mark_status = ' . intval ( $slt_mark_type );
	}
	if ($slt_mark_content) {
		if (intval ( $slt_mark_content ) == 1) {
			$where .= ' and mark_content !="" ';
		} else {
			$where .= ' and mark_content ="" ';
		}
	}
	
	if ($slt_mark_from) {
		if (intval ( $slt_mark_from ) == 1) {
			$where .= ' and  user_type = 1';
		} else if (intval ( $slt_mark_from ) == 2) {
			$where .= ' and user_type = 2 ';
		} else {
			$where .= ' and  user_type = 1';
		}
	} else {
		$where .= ' and  user_type = 1';
	}
	
	$order_where = ' order by mark_time desc ';
	$where = $where . $order_where;
	
	$mark_obj->setWhere ( $where );
	$count = $mark_obj->count_keke_witkey_mark_log ();
	
	$page_size = 10;
	$url = 'index.php?do=task&view=' . $view . '&page_size=' . $page_size . '&task_id=' . $task_id;
	
	if ($slt_mark_type) {
		$url .= '&slt_mark_type=' . $slt_mark_type;
	}
	if ($slt_mark_content) {
		$url .= '&slt_mark_content=' . $slt_mark_content;
	}
	if ($slt_mark_from) {
		$url .= '&slt_mark_from=' . $slt_mark_from;
	}
	
	$page = $_GET ['page'] ? $_GET ['page'] : 1;
	$limit = $page_size;
	$mark_log_pages = $page_obj->getPages ( $count, $limit, $page, $url );
	
	$mark_obj->setWhere ( $where . $mark_log_pages [where] );
	$mark_log_arr = $mark_obj->query_keke_witkey_mark_log ();

}

if ($ac == 'message') {
	
	require_once $template_obj->template ( $ac );
}

if (! $_SESSION ['task_views_' . $task_id]) {
	$_SESSION ['task_views_' . $task_id] = 1;
	db_factory::execute ( "update " . TABLEPRE . "witkey_task set view_num=view_num+1 where task_id='$task_id'" );
}

//感兴趣的任务

$gxqrw_arr = db_factory::query("select task_id , substr(task_title,1,20)as task_title ,task_cash from keke_witkey_task where indus_id = $task_info[indus_id] and task_id >{$task_info['task_id']} limit 0,2");

//最新任务
$zxrw_arr = db_factory::query("select task_id , substr(task_title,1,20)as task_title,task_cash from keke_witkey_task where task_id !={$task_info['task_id']} order by start_time desc limit 0,2 ");

//重金任务
$zjrw_arr = db_factory::query("select task_id , substr(task_title,1,20)as task_title,task_cash from keke_witkey_task where indus_id = $task_info[indus_id] and task_id >{$task_info['task_id']} limit 0,2");



require_once $template_obj->template ( 'task/' . $model_info ['model_dir'] . '/tpl/' . $_K ['template'] . "/task_info" );