<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}
$_K['is_rewrite']=0;

$task_obj = new Keke_witkey_task_class();

$indus_obj = new Keke_witkey_industry_class();

$cash_rule_obj = new Keke_witkey_cash_rule_class;
$cash_rule_obj->setWhere("1=1 order by end_cove");

$tender_cash_rule = Cache_ext_Class::getConfigRule ( 'cash' );

$cash_rule_arr = $cash_rule_obj->query_keke_witkey_cash_rule();

$page_obj = new Pages_Class();


$where =' 1 = 1 and task_status in(2,3,4,7) ';


if(isset($model_id)&& $model_id){
	$where .= " and model_id = $model_id ";
	$html_result .= $html_result?"+":'';
	$html_result .= $model_list[$model_id]['model_name']; 
}

if ($is_prom){
	$where.=' and is_prom >0 and prom_count>0 ';
}

$cash_rule_arr_index = array();
foreach ($cash_rule_arr as $v=>$k){
	$cash_rule_arr_index[$k['cash_rule_id']] = $k;
}
 

if ($is_delay){
	$where .=" and (select count(*) from ".TABLEPRE."witkey_task_delay where task_id = ".TABLEPRE."witkey_task.task_id and delay_status>0)>0 ";
}




if($p&&$indus_id){
	static $ids = array(0);
	foreach ($indus_arr as $k=>$v){
	   if($v['indus_pid']==$indus_id){
	   	array_push($ids,$v['indus_id']);
	   }
	}
	$where.= " and indus_id in (".implode(',',$ids).")";
}elseif($indus_id){
	$where.=' and indus_id = '.intval($indus_id);
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




if(intval($slt_task_status)){
	$where.=' and task_status = '.intval($slt_task_status);
}




$case_sql = "";
foreach ($cash_rule_arr as $cash){
	$case_sql .= ' WHEN ifnull(task_cash_coverage,0)='.$cash['cash_rule_id'].' THEN '.$cash['start_cove'];
}


switch ($slt_order) {
	case 1:
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc, start_time desc  ';
	;
	break;
	case 2:
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc, start_time asc  ';
	;
	break;
	case 3:
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc, (end_time-start_time)  asc '; 
	;
	break;
	case 4:
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc, (end_time-start_time)  desc '; 
	;
	break;
	case 5:
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc, (CASE '.$case_sql.' ELSE task_cash END ) asc ';
	;
	break;
	case 6:
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc,  (CASE '.$case_sql.' ELSE task_cash END ) desc ';
	;
	break;
	case 7:
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc, view_num asc  ';
	;
	break;
	case 8:
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc,  view_num desc  ';
	;
	break;
	case 9:
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc, sign asc  ';
	;
	break;
	case 10:
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc,sign desc  ';
	;
	break;
	default:
		$order_where = ' order by (CASE WHEN task_status in (2,3,4) THEN 100 ELSE 0 END) desc,(CASE WHEN task_status in (2,3,4) and istop>0 THEN 50 ELSE 0 END) desc, isvip desc ,task_cash_coverage desc ,start_time desc ,end_time asc  ';
		;
	break;
}



$page_size = intval($page_size)?intval($page_size):20;
	
$task_obj->setWhere($where);
$count = $task_obj->count_keke_witkey_task();


$url ='index.php?do='.$do.'&view='.$view.'&page_size='.$page_size.'&indus_id='.$indus_id.'&slt_cash_cove='.$slt_cash_cove.'&slt_order='.$slt_order.'&is_prom='.$is_prom.'&is_delay='.$is_delay."&txt_search_title=".($_K['charset']=='GBK'?$txt_search_title:urldecode($txt_search_title)).'&slt_task_status='.$slt_task_status.'&txt_left_day='.$txt_left_day.'&txt_pub_day='.$txt_pub_day.'&slt_city='.$slt_city.'&taskuser='.$taskuser;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);


$where .= $order_where;
$sql = "select *,(select count(work_id) from ".TABLEPRE."witkey_work where task_id=".TABLEPRE."witkey_task.task_id)+(select count(bid_id) from ".TABLEPRE."witkey_bid where task_id=".TABLEPRE."witkey_task.task_id) sign_num from ".TABLEPRE."witkey_task where $where $pages[where]";


$task_arr = db_factory::query($sql);




for ($i = 0; $i < count($task_arr); $i++) {
	$task_arr[$i][remaining_time] = Func_comm_class::time2Units($task_arr[$i][end_time]);
}


$case_sql = "SELECT\n".
			"a.obj_id,\n".
			"a.case_id,\n".
			"a.case_img,\n".
			"TRUNCATE(a.case_price,0) case_price,\n".
			"b.work_num,b.indus_id\n".
			"FROM\n".
			"".TABLEPRE."witkey_case as a\n".
			"LEFT JOIN ".TABLEPRE."witkey_task as b ON a.obj_id = b.task_id\n".
			"where  a.obj_type = 'task' \n";
if($p){
	$case_sql .= "and b.indus_id in(".implode(',',$ids).")";
	
	$indus_str = " b.indus_id in (".implode(',',$ids).") group by b.indus_pid ";
}else{
	$case_sql .= "and b.indus_id = $indus_id";
	
	$indus_str = " b.indus_id = $indus_id group by b.indus_id ";
}
	$case_sql .=" limit 5";
	
$case_arr = db_factory::query($case_sql);




$indus_sql = "select b.indus_id , \n".
"SUM(a.task_cash) as sum_cash,\n".
"COUNT(a.indus_id)as task_num, \n".
"round(SUM(a.task_cash)/COUNT(a.indus_id),2) as total_cash ,\n".
"(select count(*) from ".TABLEPRE."witkey_task c left join ".TABLEPRE."witkey_work d on c.task_id = d.task_id left join ".TABLEPRE."witkey_industry e on c.indus_id = e.indus_id where e.indus_id = a.indus_id ) as work_num ,\n".
"(select COUNT(*) from ".TABLEPRE."witkey_space s where s.indus_id = b.indus_id  ) as talent_num \n".
"FROM ".TABLEPRE."witkey_industry as b \n".
"LEFT JOIN ".TABLEPRE."witkey_task as a ON b.indus_id = a.indus_id \n".
"left JOIN ".TABLEPRE."witkey_space as s on s.indus_id = b.indus_id\n".
"where $indus_str ";
$census_arr = db_factory::query($indus_sql);

$average_arr = array();
$avg = $census_arr[0]['total_cash'];
for ($i=0;$i<strlen($avg);$i++){
	array_push($average_arr,substr($avg,$i,1));
}
	
require_once  $template_obj->template ( $do );