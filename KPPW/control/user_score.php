<?php

if(!defined('IN_KEKE')) {
	exit('Access Denied');
}


$task_obj = new Keke_witkey_task_class();
$mark_obj = new Keke_witkey_mark_log_class();
$work_obj = new Keke_witkey_work_class();
$bid_obj = new Keke_witkey_bid_class();
$fina_ext_obj = new Keke_witkey_finance_ext_class();
$page_obj = new Pages_Class();


$member_id = intval($uid);


$mark_obj->setWhere('by_uid ='.$member_id);
$zb_task_count = $mark_obj->count_keke_witkey_mark_log();


$task_obj->setWhere('uid='.$member_id);
$fb_task_count = $task_obj->count_keke_witkey_task();


$fina_ext_obj->setWhere(' fina_type = 2 and fina_narrate = 2 and uid = '.$member_id);
$get_task_cash = $fina_ext_obj->get_total_cash();

$fina_ext_obj->setWhere(' fina_type = 1 and fina_narrate = 4 and uid = '.$member_id);
$pay_task_cash = $fina_ext_obj->get_total_cash();


$mark_obj->setWhere('uid ='.$member_id.' and user_type =1 and mark_status =1 and DATE_SUB(CURDATE(), INTERVAL  1 MONTH) <= date(from_unixtime(mark_time))');
$g_good_mark_count_1 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =1 and mark_status =1 and DATE_SUB(CURDATE(), INTERVAL  3 MONTH) <= date(from_unixtime(mark_time))');
$g_good_mark_count_3 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =1 and mark_status =1 and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) <= date(from_unixtime(mark_time))');
$g_good_mark_count_6 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =1 and mark_status =1 and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) >= date(from_unixtime(mark_time))');
$g_good_mark_count_half = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =1 and mark_status =1 ');
$g_good_mark_count_all = $mark_obj->count_keke_witkey_mark_log();


$mark_obj->setWhere('uid ='.$member_id.' and user_type =1 and mark_status =2 and DATE_SUB(CURDATE(), INTERVAL  1 MONTH) <= date(from_unixtime(mark_time))');
$g_middle_mark_count_1 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =1 and mark_status =2 and DATE_SUB(CURDATE(), INTERVAL  3 MONTH) <= date(from_unixtime(mark_time))');
$g_middle_mark_count_3 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =1 and mark_status =2 and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) <= date(from_unixtime(mark_time))');
$g_middle_mark_count_6 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =1 and mark_status =2 and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) >= date(from_unixtime(mark_time))');
$g_middle_mark_count_half = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =1 and mark_status =2 ');
$g_middle_mark_count_all = $mark_obj->count_keke_witkey_mark_log();


$mark_obj->setWhere('uid ='.$member_id.' and user_type =1 and mark_status =3 and DATE_SUB(CURDATE(), INTERVAL  1 MONTH) <= date(from_unixtime(mark_time))');
$g_bad_mark_count_1 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =1 and mark_status =3 and DATE_SUB(CURDATE(), INTERVAL  3 MONTH) <= date(from_unixtime(mark_time))');
$g_bad_mark_count_3 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =1 and mark_status =3 and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) <= date(from_unixtime(mark_time))');
$g_bad_mark_count_6 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =1 and mark_status =3 and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) >= date(from_unixtime(mark_time))');
$g_bad_mark_count_half = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =1 and mark_status =3 ');
$g_bad_mark_count_all = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =2 and mark_status =1 and DATE_SUB(CURDATE(), INTERVAL  1 MONTH) <= date(from_unixtime(mark_time))');
$w_good_mark_count_1 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =2 and mark_status =1 and DATE_SUB(CURDATE(), INTERVAL  3 MONTH) <= date(from_unixtime(mark_time))');
$w_good_mark_count_3 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =2 and mark_status =1 and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) <= date(from_unixtime(mark_time))');
$w_good_mark_count_6 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =2 and mark_status =1 and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) >= date(from_unixtime(mark_time))');
$w_good_mark_count_half = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =2 and mark_status =1 ');
$w_good_mark_count_all = $mark_obj->count_keke_witkey_mark_log();


$mark_obj->setWhere('uid ='.$member_id.' and user_type =2 and mark_status =2 and DATE_SUB(CURDATE(), INTERVAL  1 MONTH) <= date(from_unixtime(mark_time))');
$w_middle_mark_count_1 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =2 and mark_status =2 and DATE_SUB(CURDATE(), INTERVAL  3 MONTH) <= date(from_unixtime(mark_time))');
$w_middle_mark_count_3 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =2 and mark_status =2 and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) <= date(from_unixtime(mark_time))');
$w_middle_mark_count_6 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =2 and mark_status =2 and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) >= date(from_unixtime(mark_time))');
$w_middle_mark_count_half = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =2 and mark_status =2 ');
$w_middle_mark_count_all = $mark_obj->count_keke_witkey_mark_log();


$mark_obj->setWhere('uid ='.$member_id.' and user_type =2 and mark_status =3 and DATE_SUB(CURDATE(), INTERVAL  1 MONTH) <= date(from_unixtime(mark_time))');
$w_bad_mark_count_1 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =2 and mark_status =3 and DATE_SUB(CURDATE(), INTERVAL  3 MONTH) <= date(from_unixtime(mark_time))');
$w_bad_mark_count_3 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =2 and mark_status =3 and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) <= date(from_unixtime(mark_time))');
$w_bad_mark_count_6 = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =2 and mark_status =3 and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) >= date(from_unixtime(mark_time))');
$w_bad_mark_count_half = $mark_obj->count_keke_witkey_mark_log();

$mark_obj->setWhere('uid ='.$member_id.' and user_type =2 and mark_status =3 ');
$w_bad_mark_count_all = $mark_obj->count_keke_witkey_mark_log();


$where = ' 1 = 1 ';

$ops = array('mark_g','mark_w','mark_other','mark_bad');

switch (intval($show)) {
	case 1:
		$title = '雇主的好评';
		$mark_where = ' and mark_status = 1 and  user_type = 1  and uid = '.$member_id;
	break;
	case 2:
		$title = '雇主的中评';
		$mark_where = ' and mark_status = 2 and  user_type = 1  and uid = '.$member_id;
	break;
	case 3:
		$title = '雇主的差评';
		$mark_where = ' and mark_status = 3 and  user_type = 1  and uid = '.$member_id;
	break;
	case 4:
		$title = '威客的好评';
		$mark_where = ' and mark_status = 1 and  user_type = 2 and uid = '.$member_id;
	break;
	case 5:
		$title = '威客的中评';
		$mark_where = ' and mark_status = 2 and  user_type = 2 and uid = '.$member_id;
	break;
	
	case 6:
		$title = '威客的差评';
		$mark_where = ' and mark_status = 3 and  user_type = 2 and uid = '.$member_id;
	break;
	default:
		$title = '雇主的好评';
		
	break;
}

switch ($d) {
	case '1':
		$date_title = '最近一个月';
		$date_where = ' and DATE_SUB(CURDATE(), INTERVAL  1 MONTH) <= date(from_unixtime(mark_time))';

	break;
	case '3':
		$date_title = '最近三个月';
		$date_where = ' and DATE_SUB(CURDATE(), INTERVAL  3 MONTH) <= date(from_unixtime(mark_time))';
	break;
	case '6':
		$date_title = '最近六个月';
		$date_where = ' and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) <= date(from_unixtime(mark_time))';
	break;
	case 'half':
		$date_title = '半年前';
		$date_where = ' and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) >= date(from_unixtime(mark_time))';
	break;
	
	case 'all':
		$date_title = '全部'
	;
	break;
	default:
		$date_title = '最近三个月';
		$date_where = ' and DATE_SUB(CURDATE(), INTERVAL  3 MONTH) <= date(from_unixtime(mark_time))';
	break;
}


$html_title = $date_title.$title;


switch ($op) {
	case 'mark_g':
		$where_op.=' and user_type = 1  and uid = '.$member_id;
	;
	break;
	case 'mark_w':
		$where_op.=' and user_type = 2  and uid = '.$member_id;
	;
	break;
	case 'mark_other':
		$where_op.=' and by_uid = '.$member_id;
	;
	break;
	case 'mark_bad':
		$where_op.=' and mark_status = 3 and uid = '.$member_id;
	;
	break;
	default:
		;
	break;
}



$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;

if($op){
	$where = $where.$where_op;
}else{
	$where = $where.$mark_where.$date_where;
}


$mark_obj->setWhere($where);
$count = $mark_obj->count_keke_witkey_mark_log();


$url ='index.php?do='.$do.'&view='.$view.'&op='.$op.'&member_id='.$member_id;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);

$mark_obj->setWhere($where.$pages[where]);
$mark_arr = $mark_obj->query_keke_witkey_mark_log();

$space_info = Func_comm_class::getuserinfo($uid);


require_once  $template_obj->template ($do."_".$view);