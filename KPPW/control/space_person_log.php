<?php

$work_obj = new Keke_witkey_work_class();
$task_obj = new Keke_witkey_task_class();
$sign_obj = new Keke_witkey_sign_class();
$bid_obj = new Keke_witkey_bid_class();
$task_ext_obj = new Keke_witkey_task_ext_class();
$page_obj = new Pages_Class();

$cash_rule_arr = Cache_ext_Class::getConfigRule('cash');


$task_obj->setWhere('uid ='.$member_id.' and DATE_SUB(CURDATE(), INTERVAL  1 MONTH) <= date(from_unixtime(start_time))');
$task_count_1 = $task_obj->count_keke_witkey_task();

$task_obj->setWhere('uid ='.$member_id.' and DATE_SUB(CURDATE(), INTERVAL  3 MONTH) <= date(from_unixtime(start_time))');
$task_count_3 = $task_obj->count_keke_witkey_task();

$task_obj->setWhere('uid ='.$member_id.' and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) <= date(from_unixtime(start_time))');
$task_count_6 = $task_obj->count_keke_witkey_task();

$task_obj->setWhere('uid ='.$member_id.' and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) >= date(from_unixtime(start_time))');
$task_count_half = $task_obj->count_keke_witkey_task();

$task_obj->setWhere('uid ='.$member_id);
$task_count_all = $task_obj->count_keke_witkey_task();


$sign_obj->setWhere('uid ='.$member_id.' and DATE_SUB(CURDATE(), INTERVAL  1 MONTH) <= date(from_unixtime(bid_time))');
$sign_count_1 = $sign_obj->count_keke_witkey_sign();

$sign_obj->setWhere('uid ='.$member_id.' and DATE_SUB(CURDATE(), INTERVAL  3 MONTH) <= date(from_unixtime(bid_time))');
$sign_count_3 = $sign_obj->count_keke_witkey_sign();

$sign_obj->setWhere('uid ='.$member_id.' and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) <= date(from_unixtime(bid_time))');
$sign_count_6 = $sign_obj->count_keke_witkey_sign();

$sign_obj->setWhere('uid ='.$member_id.' and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) >= date(from_unixtime(bid_time))');
$sign_count_half = $sign_obj->count_keke_witkey_sign();

$sign_obj->setWhere('uid ='.$member_id);
$sign_count_all = $sign_obj->count_keke_witkey_sign();


$work_count_1 = db_factory::query('SELECT count(distinct task_id) as count FROM '.TABLEPRE.'witkey_work where uid ='.$member_id.' and work_status in(1,2,3,4,6) and DATE_SUB(CURDATE(), INTERVAL  1 MONTH) <= date(from_unixtime(work_time))');
$work_count_1 = $work_count_1[0][count];
$work_count_3 = db_factory::query('SELECT count(distinct task_id) as count FROM '.TABLEPRE.'witkey_work where uid ='.$member_id.' and work_status in(1,2,3,4,6) and DATE_SUB(CURDATE(), INTERVAL  3 MONTH) <= date(from_unixtime(work_time))');
$work_count_3 = $work_count_3[0][count];
$work_count_6 = db_factory::query('SELECT count(distinct task_id) as count FROM '.TABLEPRE.'witkey_work where uid ='.$member_id.' and work_status in(1,2,3,4,6) and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) <= date(from_unixtime(work_time))');
$work_count_6 = $work_count_6[0][count];
$work_count_half = db_factory::query('SELECT count(distinct task_id) as count FROM '.TABLEPRE.'witkey_work where uid ='.$member_id.' and work_status in(1,2,3,4,6) and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) >= date(from_unixtime(work_time))');
$work_count_half = $work_count_half[0][count];
$work_count_all = db_factory::query('SELECT count(distinct task_id) as count FROM '.TABLEPRE.'witkey_work where uid ='.$member_id.' and work_status in(1,2,3,4,6)');
$work_count_all = $work_count_all[0][count];


$rw_work_count_1 = db_factory::query('SELECT count(distinct task_id) as count FROM '.TABLEPRE.'witkey_work where uid ='.$member_id.' and work_status = 5 and DATE_SUB(CURDATE(), INTERVAL  1 MONTH) <= date(from_unixtime(work_time))');
$rw_work_count_1 = $rw_work_count_1[0][count];
$rw_work_count_3 = db_factory::query('SELECT count(distinct task_id) as count FROM '.TABLEPRE.'witkey_work where uid ='.$member_id.' and work_status = 5 and DATE_SUB(CURDATE(), INTERVAL  3 MONTH) <= date(from_unixtime(work_time))');
$rw_work_count_3 = $rw_work_count_3[0][count];
$rw_work_count_6 = db_factory::query('SELECT count(distinct task_id) as count FROM '.TABLEPRE.'witkey_work where uid ='.$member_id.' and work_status = 5 and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) <= date(from_unixtime(work_time))');
$rw_work_count_6 = $rw_work_count_6[0][count];

$rw_work_count_half = db_factory::query('SELECT count(distinct task_id) as count FROM '.TABLEPRE.'witkey_work where uid ='.$member_id.' and work_status = 5 and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) >= date(from_unixtime(work_time))');
$rw_work_count_half = $rw_work_count_half[0][count];
$rw_work_count_all = db_factory::query('SELECT count(distinct task_id) as count FROM '.TABLEPRE.'witkey_work where uid ='.$member_id.' and work_status = 5 ');
$rw_work_count_all = $rw_work_count_all[0][count];



$bid_obj->setWhere('uid ='.$member_id.' and DATE_SUB(CURDATE(), INTERVAL  1 MONTH) <= date(from_unixtime(bid_time))');
$bid_count_1 = $bid_obj->count_keke_witkey_bid();
$bid_obj->setWhere('uid ='.$member_id.' and  DATE_SUB(CURDATE(), INTERVAL  3 MONTH) <= date(from_unixtime(bid_time))');
$bid_count_3 = $bid_obj->count_keke_witkey_bid();
$bid_obj->setWhere('uid ='.$member_id.' and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) <= date(from_unixtime(bid_time))');
$bid_count_6 = $bid_obj->count_keke_witkey_bid();
$bid_obj->setWhere('uid ='.$member_id.' and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) >= date(from_unixtime(bid_time))');
$bid_count_half = $bid_obj->count_keke_witkey_bid();
$bid_obj->setWhere('uid ='.$member_id);
$bid_count_all = $bid_obj->count_keke_witkey_bid();



$bid_obj->setWhere('uid ='.$member_id.' and bid_status =1 and DATE_SUB(CURDATE(), INTERVAL  1 MONTH) <= date(from_unixtime(bid_time))');
$zb_bid_count_1 = $bid_obj->count_keke_witkey_bid();
$bid_obj->setWhere('uid ='.$member_id.' and bid_status =1 and  DATE_SUB(CURDATE(), INTERVAL  3 MONTH) <= date(from_unixtime(bid_time))');
$zb_bid_count_3 = $bid_obj->count_keke_witkey_bid();
$bid_obj->setWhere('uid ='.$member_id.' and bid_status =1  and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) <= date(from_unixtime(bid_time))');
$zb_bid_count_6 = $bid_obj->count_keke_witkey_bid();
$bid_obj->setWhere('uid ='.$member_id.' and bid_status =1  and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) >= date(from_unixtime(bid_time))');
$zb_bid_count_half = $bid_obj->count_keke_witkey_bid();
$bid_obj->setWhere('uid ='.$member_id.' and bid_status =1 ');
$zb_bid_count_all = $bid_obj->count_keke_witkey_bid();


switch (intval($show)) {
	case 1:
		$title = '我发布的全额任务';
		$task_where = 'a.uid =('.$member_id.')';
		
	break;
	case 2:
		$title = '参加的全款悬赏任务';
		$sign_obj->setWhere(' uid ='.$member_id.'');
		$sign_arr = $sign_obj->query_keke_witkey_sign();
		if(is_array($sign_arr)){
			foreach ($sign_arr as $value) {
				$task_ids.= $value['task_id'].',';
			}
		}
		if($task_ids){
			$task_ids.='0';
		}else{
			$task_ids.='0';
		}
		$task_where = ' model_id = 1 and  a.task_id in('.$task_ids.')';
	break;
	case 3:
		$title = '中标的全款悬赏任务';
		$work_obj->setWhere('  uid ='.$member_id.' and work_status in (1,2,3,4,6)');
		$work_arr = $work_obj->query_keke_witkey_work();
		if(is_array($work_arr)){
			foreach ($work_arr as $value) {
				$task_ids.= $value['task_id'].',';
			}
		}
		if($task_ids){
			$task_ids.='0';
		}else{
			$task_ids.='0';
		}
		$task_where = ' model_id = 1 and a.task_id in('.$task_ids.')';
		
	break;
	case 4:
		$title = '入围的全款悬赏任务';
		$work_obj->setWhere('uid ='.$member_id.' and work_status = 5');
		$work_arr = $work_obj->query_keke_witkey_work();
		if(is_array($work_arr)){
			foreach ($work_arr as $value) {
				$task_ids.= $value['task_id'].',';
			}
		}
		if($task_ids){
			$task_ids.='0';
		}else{
			$task_ids.='0';
		}
		$task_where = 'a.task_id in('.$task_ids.')';
	break;
	case 5:
		$title = '参加的订金招标任务';
		$bid_obj->setWhere('uid ='.$member_id);
		$bid_arr = $bid_obj->query_keke_witkey_bid();
		if(is_array($bid_arr)){
			foreach ($bid_arr as $value) {
				$task_ids.= $value['task_id'].',';
			}
		}
		if($task_ids){
			$task_ids.='0';
		}else{
			$task_ids.='0';
		}
		$task_where = 'a.task_id in('.$task_ids.')';
	break;
	
	case 6:
		$title = '中标的订金招标任务';
		$bid_obj->setWhere('uid ='.$member_id.' and bid_status =1  ');
		$bid_arr = $bid_obj->query_keke_witkey_bid();
		if(is_array($bid_arr)){
			foreach ($bid_arr as $value) {
				$task_ids.= $value['task_id'].',';
			}
		}
		if($task_ids){
			$task_ids.='0';
		}else{
			$task_ids.='0';
		}
		$task_where = 'a.task_id in('.$task_ids.')';
	break;
	default:
		$title = '参加的全款悬赏任务';
		$work_obj->setWhere('uid ='.$member_id);
		$work_arr = $work_obj->query_keke_witkey_work();
		if(is_array($work_arr)){
			foreach ($work_arr as $value) {
				$task_ids = $value['task_id'].',';
			}
		}
		if($task_ids){
			$task_ids.='0';
		}else{
			$task_ids.='0';
		}
		$task_where = 'a.task_id in('.$task_ids.')';
	break;
}

switch ($d) {
	case '1':
		$date_title = '最近一个月';
		$date_where = ' and DATE_SUB(CURDATE(), INTERVAL  1 MONTH) <= date(from_unixtime(a.start_time))';

	break;
	case '3':
		$date_title = '最近三个月';
		$date_where = ' and DATE_SUB(CURDATE(), INTERVAL  3 MONTH) <= date(from_unixtime(a.start_time))';
	break;
	case '6':
		$date_title = '最近六个月';
		$date_where = ' and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) <= date(from_unixtime(a.start_time))';
	break;
	case 'half':
		$date_title = '半年前';
		$date_where = ' and DATE_SUB(CURDATE(), INTERVAL  6 MONTH) >= date(from_unixtime(a.start_time))';
	break;
	
	case 'all':
		$date_title = '全部'
	;
	break;
	default:
		$date_title = '最近三个月';
		$date_where = ' and DATE_SUB(CURDATE(), INTERVAL  3 MONTH) <= date(from_unixtime(a.start_time))';
	break;
}


$html_title = $date_title.$title;

$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;
	
$where = $task_where.$date_where;
$task_ext_obj->setWhere($where);
$count = $task_ext_obj->count_keke_witkey_task_industry();

$url ='index.php?do='.$do.'&view='.$view.'&op='.$op.'&show='.$show.'&d='.$d.'&member_id='.$member_id;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);

$task_ext_obj->setWhere($where.$pages[where]);
$task_arr = $task_ext_obj->query_keke_witkey_task_industry();



require_once $template_obj->template ( $do . "_" . $view );