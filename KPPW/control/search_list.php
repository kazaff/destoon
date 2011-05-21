<?php


if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}
$_K ['is_rewrite'] = 0;

$task_obj = new Keke_witkey_task_class ( ); 


$indus_obj = new Keke_witkey_industry_class ( ); 


$cash_rule_obj = new Keke_witkey_cash_rule_class ( ); 
$cash_rule_obj->setWhere ( "1=1 order by end_cove" );

$tender_cash_rule = Cache_ext_Class::getConfigRule ( 'cash' );

$cash_rule_arr = $cash_rule_obj->query_keke_witkey_cash_rule ();

$page_obj = new Pages_Class ( ); 


$indus_p_arr =$indus_p_arr; 


$indus_c_arr =$indus_arr; 

if (isset ( $t ) && isset ( $q ) && $q != "请输入搜索的关键词!") {
	$$t = $q;
}

$where = ' 1 = 1 and task_status in(2,3,4,7) ';

if (isset ( $model_id ) && $model_id) {
	$where .= " and model_id = $model_id ";
	$html_result .= $html_result ? "+" : '';
	$html_result .= $model_list [$model_id] ['model_name'];
}

if ($is_prom) {
	$where .= ' and is_prom >0 and prom_count>0 ';
}


$cash_rule_arr_index = array();
foreach ($cash_rule_arr as $v=>$k){
	$cash_rule_arr_index[$k['cash_rule_id']] = $k;
}

if ($slt_cash_cove) {
	if ($slt_cash_cove == 'min') {
		$where .= ' and (task_cash <' . ($cash_rule_arr [0] ['end_cove'] + 0) . ' and !ifnull(task_cash_coverage,0)) ';
	} elseif ($slt_cash_cove == 'max') {
		$where .= ' and (task_cash >' . ($cash_rule_arr [count ( $cash_rule_arr ) - 1] ['start_cove'] + 0) . ' and !ifnull(task_cash_coverage,0)) ';
	} else {
		$where .= ' and ((task_cash_coverage = ' . intval ( $slt_cash_cove ) . ' and ifnull(task_cash_coverage,0)>0) or (task_cash>=' . ($tender_cash_rule [$slt_cash_cove] ['start_cove'] + 0) . ' ' . (($tender_cash_rule [$slt_cash_cove] ['end_cove']) ? ' and task_cash<=' . $tender_cash_rule [$slt_cash_cove] ['end_cove'] : '') . ' and !ifnull(task_cash_coverage,0))) ';
	}
}

if ($is_delay) {
	$where .= " and (select count(*) from " . TABLEPRE . "witkey_task_delay where task_id = " . TABLEPRE . "witkey_task.task_id and delay_status>0)>0 ";
}

if ($txt_search_title && $txt_search_title != '请输入任务标题') {
	if (trim ( $txt_search_title )!='在结果中搜索') {
		$txt_search_title_arr = explode ( ' ', $txt_search_title );
		if (is_array ( $txt_search_title_arr )) {
			foreach ( $txt_search_title_arr as $value ) {
				$where_title .= ' task_title like "%' . $value . '%" or  ';
			}
			$where_title .= ' task_title = "" ';
			$where .= ' and (' . $where_title . ') ';
		} else {
			$where .= ' and task_title like "%' . $txt_search_title . '%"';
		
		}
		$html_result = '任务标题:' . $txt_search_title;
	}

}

if (intval ( $txt_search_id )) {
	$where .= ' and task_id = ' . intval ( $txt_search_id );
	//$html_result .= $html_result?"+":'';
	$html_result .= '任务编号:' . intval ( $txt_search_id );
}

if ($indus_id) {
	$indus_info = $indus_c_arr [$indus_id];
	$indus_info = $indus_info ? $indus_info : $indus_p_arr [$indus_id];
	if ($indus_info ['indus_pid'] != 0) {
		$where .= ' and indus_id = ' . intval ( $indus_id );
		$indus_p_info = $indus_p_arr [$indus_info [indus_pid]];
		$html_indus .= $html_result ? "+" : '';
		$html_indus .= '<a href="index.php">首页</a>>><a href="index.php?do=search_list&slt_indus_pid=' . $indus_p_info [indus_id] . '">' . $indus_p_info [indus_name] . '</a>>><a href="index.php?do=search_list&indus_id=' . $indus_info [indus_id] . '">' . $indus_info [indus_name] . '</a>';
	} else {
		$slt_indus_pid = $indus_id;
	}
}

if ($slt_indus_pid) {
	$indus_obj->setWhere ( ' indus_pid=' . intval ( $slt_indus_pid ) );
	$indus_new_arr = $indus_obj->query_keke_witkey_industry ();
	if (is_array ( $indus_new_arr )) {
		foreach ( $indus_new_arr as $value ) {
			$indus_new_str .= $value [indus_id] . ',';
		}
	}
	if ($indus_new_str) {
		$where .= ' and indus_id in (' . $indus_new_str . intval ( $slt_indus_pid ) . ')';
	} else {
		$where .= ' and indus_id = ' . intval ( $slt_indus_pid );
	}
	
	$html_indus .= $html_result ? "+" : '';
	$html_indus .= '<a href="index.php">首页</a>>><a href="index.php?do=search_list&slt_indus_pid=' . $slt_indus_pid . '">' . $indus_p_arr [$slt_indus_pid] [indus_name] . '</a>';
}




if (intval ( $slt_task_status )) {
	$where .= ' and task_status = ' . intval ( $slt_task_status );
}

if (intval ( $slt_task_model_id )) {
	$where .= ' and model_id = ' . intval ( $slt_task_model_id );
}


if ($slt_task_cash) {
	switch (intval ( $slt_task_cash )) {
		case 1 :
			$where .= ' and task_cash<100 ';
			break;
		case 2 :
			$where .= ' and task_cash>=100 and task_cash<500 ';
			break;
		case 3 :
			$where .= ' and task_cash>=500 and task_cash<1000 ';
			break;
		case 4 :
			$where .= ' and task_cash>=1000 and task_cash<5000 ';
			break;
		case 5 :
			$where .= ' and task_cash>=5000 ';
			break;
		default :
			;
			break;
	}
}

if ($txt_left_day) {
	switch ($txt_left_day) {
		case 1 :
			$where .= " and  date(from_unixtime(end_time)) BETWEEN CURDATE() and DATE_add(CURDATE(), INTERVAL $txt_left_day day) ";
			break;
		case 3 :
			$where .= "  and  date(from_unixtime(end_time)) BETWEEN CURDATE() and DATE_add(CURDATE(), INTERVAL $txt_left_day day) ";
			break;
		case 7 :
			$where .= " and  date(from_unixtime(end_time)) BETWEEN CURDATE() and DATE_add(CURDATE(), INTERVAL $txt_left_day day)";
			break;
		case 30 :
			$where .= " and  date(from_unixtime(end_time)) BETWEEN CURDATE() and DATE_add(CURDATE(), INTERVAL $txt_left_day day)";
			break;
		case 'max' :
			$where .= " and DATE_add(CURDATE(), INTERVAL  30 day) <= date(from_unixtime(end_time))";
			break;
	
	}
	$html_result .= $html_result ? "+" : '';
	$html_result .= '剩余' . $txt_left_day . '天';
}

if ($txt_pub_day) {
	switch ($txt_pub_day) {
		case 1 :
			$where .= " and date(from_unixtime(start_time)) >= DATE_SUB(CURDATE(), INTERVAL  '$txt_pub_day' day) ";
			break;
		case 3 :
			$where .= " and DATE_SUB(CURDATE(), INTERVAL  '$txt_pub_day' day) <= date(from_unixtime(start_time)) ";
			break;
		case 7 :
			$where .= " and DATE_SUB(CURDATE(), INTERVAL  '$txt_pub_day' day) <= date(from_unixtime(start_time))";
			break;
		case 30 :
			$where .= " and DATE_SUB(CURDATE(), INTERVAL  '$txt_pub_day' day) <= date(from_unixtime(start_time))";
			break;
		case 'max' :
			$where .= " and DATE_SUB(CURDATE(), INTERVAL  30 day) >= date(from_unixtime(start_time))";
			break;
	
	}
	
	$html_result .= $html_result ? "+" : '';
	$html_result .= $txt_pub_day . '天内发布';
}

if ($slt_city) {
	$schcity = str_replace ( "省", "", $slt_city );
	$schcity = str_replace ( "市", "", $schcity );
	$schcity = str_replace ( "县", "", $schcity );
	$where .= ' and city like \'%' . $slt_city . '%\'';
}


$case_sql = "";
foreach ( $cash_rule_arr as $cash ) {
	$case_sql .= ' WHEN ifnull(task_cash_coverage,0)=' . $cash ['cash_rule_id'] . ' THEN ' . $cash ['start_cove'];
}

switch ($slt_order) {
	case 1 :
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc, start_time desc  '; 
		;
		break;
	case 2 :
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc, start_time asc  '; 
		;
		break;
	case 3 :
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc, (end_time-start_time)  asc '; 
		;
		break;
	case 4 :
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc, (end_time-start_time)  desc '; 
		;
		break;
	case 5 :
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc, (CASE ' . $case_sql . ' ELSE task_cash END ) asc '; 
		;
		break;
	case 6 :
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc,  (CASE ' . $case_sql . ' ELSE task_cash END ) desc '; 
		;
		break;
	case 7 :
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc, view_num asc  '; 
		;
		break;
	case 8 :
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc,  view_num desc  '; 
		;
		break;
	case 9 :
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc, sign asc  '; 
		;
		break;
	case 10 :
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc,sign desc  '; 
		;
		break;
	default : 
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc, isvip desc ,task_cash_coverage desc ,start_time desc ,end_time asc  ';
		;
		break;
}


$page_size = intval ( $page_size ) ? intval ( $page_size ) : 20;

$task_obj->setWhere ( $where );
$count = $task_obj->count_keke_witkey_task ();

$url = 'index.php?do=' . $do . '&view=' . $view . '&page_size=' . $page_size . '&indus_id=' . $indus_id . '&slt_cash_cove=' . $slt_cash_cove . '&slt_order=' . $slt_order . '&is_prom=' . $is_prom . '&is_delay=' . $is_delay . "&txt_search_title=" . ($_K ['charset'] == 'GBK' ? $txt_search_title : urldecode ( $txt_search_title )) . '&slt_task_status=' . $slt_task_status . '&txt_left_day=' . $txt_left_day . '&txt_pub_day=' . $txt_pub_day . '&slt_city=' . $slt_city . '&taskuser=' . $taskuser;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit = $page_size;
$pages = $page_obj->getPages ( $count, $limit, $page, $url );

$where .= $order_where;

$task_sql = 'select *,(select count(work_id) from ' . TABLEPRE . 'witkey_work where task_id=' . TABLEPRE . 'witkey_task.task_id)+(select count(bid_id) from ' . TABLEPRE . 'witkey_bid where task_id=' . TABLEPRE . 'witkey_task.task_id) sign_num from ' . TABLEPRE . 'witkey_task where ' . $where . $pages [where];
$task_arr = db_factory::query ( $task_sql );

for($i = 0; $i < count ( $task_arr ); $i ++) {
	$task_arr [$i] [remaining_time] = Func_comm_class::time2Units ( $task_arr [$i] [end_time] );
}

require_once $template_obj->template ( $do );