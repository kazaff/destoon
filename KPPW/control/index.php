<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$nav_active_index = "index";
if ($_K['template']=='default'){
$witkeyinfo = Cache::get ( "witkey_index_info_cache" );
if (! $witkeyinfo) {
	$witkeyinfo = array ();
	$task_obj = new Keke_witkey_task_class ( );
	$task_obj->setWhere ( "task_status=2" );
	$witkeyinfo ['tasknowcount'] = $task_obj->count_keke_witkey_task ();
	$task_obj->setWhere ( "task_status>0" );
	$witkeyinfo ['taskallcount'] = $task_obj->count_keke_witkey_task ();
	$task_obj->setWhere ( "task_status=2 and task_mode in (1,2,3)" );
	$witkeyinfo ['taskrewardnowcount'] = $task_obj->count_keke_witkey_task ();
	$space_obj = new Keke_witkey_space_class ( );
	$witkeyinfo ['userallcount'] = $space_obj->count_keke_witkey_space ();
	$space_obj->setWhere ( "isvip>0" );
	$witkeyinfo ['uservipcount'] = $space_obj->count_keke_witkey_space ();
	$studio_obj = new Keke_witkey_studio_class ( );
	$studio_obj->setWhere ( "studio_status>0" );
	$witkeyinfo ['userteamcount'] = $studio_obj->count_keke_witkey_studio ();
	$fina_ext_obj = new Keke_witkey_finance_ext_class ( );
	$fina_ext_obj->setWhere ( ' fina_narrate = 4 ' );
	$titl_cash = $fina_ext_obj->get_total_cash ();
	$witkeyinfo ['taskcash'] = $titl_cash [0] [cash];
	Cache::write ( $witkeyinfo, "witkey_index_info_cache", 5 * 3600 );
}


$hero_week = Cache::get ( "hero_week_cache" );
$hero_month = Cache::get ( "hero_month_cache" );
$hero_all = Cache::get ( "hero_all_cache" );

if (! $hero_week) {
	$hero_week = db_factory::query ( "SELECT uid,username,sum(fina_cash) as cash,count(*) as count,(select reg_time from " . TABLEPRE . "witkey_space where uid =" . TABLEPRE . "witkey_finance.uid) as reg_time FROM " . TABLEPRE . "witkey_finance where fina_type=2 and fina_narrate in (2,3) and WEEKOFYEAR(from_unixtime(fina_time))=WEEKOFYEAR(NOW()) group by uid order by cash desc limit 0,5" );
}

if (! $hero_month) {
	$hero_month = db_factory::query ( "SELECT uid,username,sum(fina_cash) as cash,count(*) as count,(select reg_time from " . TABLEPRE . "witkey_space where uid =" . TABLEPRE . "witkey_finance.uid) as reg_time   FROM " . TABLEPRE . "witkey_finance where fina_type=2 and fina_narrate in (2,3) and MONTH(from_unixtime(fina_time))=MONTH(NOW()) and year(from_unixtime(fina_time))=year(now()) group by uid order by cash desc limit 0,5" );
}

if (! $hero_all) {
	$hero_all = db_factory::query ( "SELECT uid,username,sum(fina_cash) as cash,count(*) as count,(select reg_time from " . TABLEPRE . "witkey_space where uid =" . TABLEPRE . "witkey_finance.uid) as reg_time   FROM " . TABLEPRE . "witkey_finance where fina_type=2 and fina_narrate in (2,3) group by uid order by cash desc limit 0,5" );
}
foreach ( $model_list as $model ) {
	$new_task_list [$model ['model_id']] = Cache_ext_Class::gettabledata ( "witkey_task", "model_id = {$model['model_id']} and task_status in (2,3,4,7)", "task_id desc", 180, '', 40 );
}
}



$link_obj = new Keke_witkey_link_class ( );
$link_obj->setWhere ( ' link_type = 1 and link_status = 1 order by listorder asc' );
$link_arr = $link_obj->query_keke_witkey_link ();



if ($_K['template']=='orange'){
if ($uid){
		$studio_member_obj = new Keke_witkey_studio_member_class();
		$studio_member_obj->setWhere(" uid = '$uid' ");
		$count = $studio_member_obj->count_keke_witkey_studio_member();
		if($count == 1){
			$is_studio_member = TRUE;	
		}else 
		{
			$is_studio_member = FALSE;
		}
		
	
		$studio_obj = new Keke_witkey_studio_class();
		$studio_obj->setWhere(' uid = '.$uid);
		$studio_info = $studio_obj->query_keke_witkey_studio();
		$studio_info = $studio_info[0];
		
	
		
		$shop_obj = new Keke_witkey_shop_class();
		$shop_obj->setWhere(" uid = '$uid'");
		$shop_info_arr  = $shop_obj->query_keke_witkey_shop();
		if(count($shop_info_arr)==1){
		   $have_shop = TRUE;
		   $shope_type = $shop_info_arr[0]['shop_type'];	
		}else {
			$have_shop = FALSE;
		}
}

$task_ext_obj = new Keke_witkey_task_ext_class ( );

$pb_num = 0;

$wz_num = 0;

$xz_num = 0;

$yy_num = 0;
foreach ( $indus_sub_arr as $k => $v ) {
	if ($v ['indus_pid'] == 1) {
		$pb_num += 1;
	} else if ($v ['indus_pid'] == 2) {
		$wz_num += 1;
	} else if ($v ['indus_pid'] == 3) {
		$xz_num += 1;
	} elseif ($v ['indus_pid'] == 124) {
		$yy_num += 1;
	}
}

$pb_arr = Cache::get ( 'pb_arr' );
$wz_arr = Cache::get ( 'wz_arr' );
$xz_arr = Cache::get ( 'xz_arr' );
$yy_arr = Cache::get ( 'yy_arr' );
if (! $pb_arr) {
	$task_ext_obj->setWhere ( 'a.task_status in(2,3) and b.indus_pid=1 order by a.start_time desc limit 0,9' );
	$pb_arr = $task_ext_obj->query_keke_witkey_task_industry ();
	Cache::write ( $pb_arr, 'pb_arr', 3600 );
}

if (! $wz_arr) {
	$task_ext_obj->setWhere ( 'a.task_status in(2,3) and b.indus_pid=2 order by a.start_time desc' );
	$wz_arr = $task_ext_obj->query_keke_witkey_task_industry ();
	Cache::write ( $wz_arr, 'wz_arr', 3600 );
}
if (! $xz_arr) {
	$task_ext_obj->setWhere ( 'a.task_status in(2,3) and b.indus_pid=3 order by a.start_time desc' );
	$xz_arr = $task_ext_obj->query_keke_witkey_task_industry ();
	Cache::write ( $xz_arr, 'xz_arr', 3600 );
}
if (! $yy_arr) {
	$task_ext_obj->setWhere ( 'a.task_status in(2,3) and b.indus_pid=124 order by a.start_time desc' );
	$yy_arr = $task_ext_obj->query_keke_witkey_task_industry ();
	Cache::write ( $yy_arr, 'kf_arr', 3600 );
}



$service_arr = Cache_ext_Class::gettabledata('witkey_service',"is_stop !=1 GROUP BY indus_id","",200,"indus_id");




$sql = "select  b.indus_id ,\n".
			"SUM(a.task_cash) as sum_cash,COUNT(a.indus_id)as task_num,\n".
			"round(SUM(a.task_cash)/COUNT(a.indus_id),2) as total_cash\n".
			",(select count(*) from ".TABLEPRE."witkey_task c left join ".TABLEPRE."witkey_work d on c.task_id = d.task_id\n".
			"left join ".TABLEPRE."witkey_industry e on c.indus_id = e.indus_id\n".
			"where  e.indus_id = a.indus_id\n".
			") as work_num\n".
			"FROM\n".
			"".TABLEPRE."witkey_industry as b\n".
			"LEFT JOIN  ".TABLEPRE."witkey_task as a ON b.indus_id = a.indus_id\n".
			"where b.indus_pid in (1,2,3,124)\n".
			"group by b.indus_id";

$fenglei_arr = db_factory::query($sql);

$temp_arr = array();
foreach ($fenglei_arr as $k=>$v) {
   $temp_arr[$v['indus_id']] = $v;	
}
$fenglei_arr = $temp_arr;

unset($temp_arr);

$ta_pub_task_arr = db_factory::query("select username,feed_time,SUBSTRING_INDEX(title,'任务',-1) as title from keke_witkey_feed where feedtype='pub_task' order by feed_id desc limit 15");

$ta_work_accept_arr = db_factory::query("select username,feed_time,SUBSTRING_INDEX(title,'任务',-1) as title from keke_witkey_feed where feedtype='work_accept' order by feed_id desc limit 15");

$page_description = $_K ['seo_description'];
$page_keyword = $_K ['seo_keyword'];



}


if ($_K['template']=='red'){
	$indus_index_arr = Cache_ext_Class::getIndusIndex();
	$indus_p_arr = Cache_ext_Class::getIndustryList(1,0);
	
	
	$week_cash_top = Cache_ext_Class::gettabledata("witkey_task","task_status in (2,3,4,7)","task_cash desc",3000,'',8);
	$week_view_top = Cache_ext_Class::gettabledata("witkey_task","task_status in (2,3,4,7)","view_num desc",3000,'',8);
	$week_sign_top = Cache_ext_Class::gettabledata("witkey_task","task_status in (2,3,4,7)","sign_num desc",3000,'',8);
	$hero_week = db_factory::query ( "SELECT uid,username,sum(fina_cash) as cash,count(*) as count,(select reg_time from " . TABLEPRE . "witkey_space where uid =" . TABLEPRE . "witkey_finance.uid) as reg_time FROM " . TABLEPRE . "witkey_finance where fina_type=2 and fina_narrate in (2,3) and WEEKOFYEAR(from_unixtime(fina_time))=WEEKOFYEAR(NOW()) group by uid order by cash desc limit 0,5" );
	

	$cash_rule_arr = Cache_ext_Class::getConfigRule('cash');
	
	
	$istop_task_arr = Cache_ext_Class::gettabledata("witkey_task","task_status in (2,3,4,7) and istop>0","start_time desc",3000,'',20);
	$xs_task_arr = Cache_ext_Class::gettabledata("witkey_task","task_status in (2,3,4,7) and model_id=1","start_time desc",3000,'',20);
	$zb_task_arr = Cache_ext_Class::gettabledata("witkey_task","task_status in (2,3,4,7) and model_id=2","start_time desc",3000,'',20);
	$prom_task_arr = Cache_ext_Class::gettabledata("witkey_task","task_status in (2,3,4,7) and is_prom>0 and model_id=2","start_time desc",3000,'',20);
	$delay_task_arr = Cache_ext_Class::gettabledata("witkey_task","task_status in (2,3,4,7) and model_id=2","start_time desc",3000,'',20);
	
	
	$w_service_arr = Cache_ext_Class::gettabledata("witkey_service","service_type =2","service_id desc",3000,'',8);
	$s_service_arr = Cache_ext_Class::gettabledata("witkey_service","service_type =1","service_id desc",3000,'',8);
	$hot_service_arr = Cache_ext_Class::gettabledata("witkey_service","","views desc",3000,'',8);
}





require_once $template_obj->template ( $do );