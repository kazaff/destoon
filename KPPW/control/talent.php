<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$nav_active_index = "talent";
$space_obj = new Keke_witkey_space_class();
$page_obj = new Pages_Class();

$indus_p_arr = Cache_ext_Class::getIndustryList(1,0);

$indus_c_arr = Cache_ext_Class::getIndustryList(1,NULL);




if(isset($ajax) && $indus_pid){
$sql4= "select * from ".TABLEPRE."witkey_studio as a left join ".TABLEPRE."witkey_space 
       as b on a.uid = b.uid left join ".TABLEPRE."witkey_industry as c
       on b.indus_id = c.indus_id
       where c.indus_pid = $indus_pid order by a.on_date desc limit 0,5 ";
$sql5 = "select * from ".TABLEPRE."witkey_space as a left join ".TABLEPRE."witkey_industry as b
         on a.indus_id = b.indus_id  where b.indus_pid = $indus_pid and a.take_num >0 
         and a.uid !=1          
         order by a.uid desc limit 0,7";
        
$sql6 = "select a.task_title,a.task_cash,b.* from ".TABLEPRE."witkey_task a right join ".TABLEPRE."witkey_work b on a.task_id = b.task_id where b.work_status in (4) and a.indus_id in(select indus_id from ".TABLEPRE."witkey_industry where indus_pid =$indus_pid) order by work_time desc limit 0,5";
         
$studio_arr = db_factory::query($sql4);

$talent_arr = db_factory::query($sql5);

$talent_top_arr = db_factory::query($sql6);

Func_comm_class::echojson('',1,array("studio_arr"=>$studio_arr,"talent_arr"=>$talent_arr,"talent_top_arr"=>$talent_top_arr));
	
}else {

foreach ($indus_p_arr as $indus_i) {
$indus_id =$indus_i['indus_id']+0;
break;
}
$sql= "select * from ".TABLEPRE."witkey_studio as a left join ".TABLEPRE."witkey_space 
       as b on a.uid = b.uid left join ".TABLEPRE."witkey_industry as c
       on b.indus_id = c.indus_id
       where c.indus_pid = $indus_id order by a.on_date desc limit 0,5";
$sql2 = "select * from ".TABLEPRE."witkey_space as a left join ".TABLEPRE."witkey_industry as b
         on a.indus_id = b.indus_id  where b.indus_pid = $indus_id and a.take_num >0 
         and a.uid !=1          
         order by a.uid desc limit 0,7";

$sql3 = "select a.task_title,a.task_cash,b.* from ".TABLEPRE."witkey_task a right join ".TABLEPRE."witkey_work b on a.task_id = b.task_id where b.work_status in (4) and a.indus_id in(select indus_id from ".TABLEPRE."witkey_industry where indus_pid =$indus_id) order by work_time desc limit 0,5";
         
$studio_arr = db_factory::query($sql);


$talent_arr = db_factory::query($sql2);

$talent_top_arr = db_factory::query($sql3);

$telent_wk_count = Cache::get("telent_index_wk_count");
if (!$telent_wk_count){
	$telent_wk_count = db_factory::query("select count(*) c from ".TABLEPRE."witkey_space where take_num>0");
	$telent_wk_count = $telent_wk_count[0]['c'];
}
$telent_case_count = Cache::get("telent_index_case_count");
if (!$telent_case_count){
	$telent_case_count = db_factory::query("select count(*) c from ".TABLEPRE."witkey_task where task_status=7");
	$telent_case_count = $telent_case_count[0][7];
}

$sql= "select * from ".TABLEPRE."witkey_studio as a left join ".TABLEPRE."witkey_space 
       as b on a.uid = b.uid left join ".TABLEPRE."witkey_industry as c
       on b.indus_id = c.indus_id
       where c.indus_pid = $indus_id order by a.on_date desc limit 0,9";

$nd_t_studio_arr = db_factory::query($sql);
$sql= "select * from ".TABLEPRE."witkey_space as a left join ".TABLEPRE."witkey_industry as b
         on a.indus_id = b.indus_id  where b.indus_pid = $indus_id and a.take_num >0 
         and a.uid !=1          
         order by a.take_num desc limit 0,9";
}
$nd_t_user_arr = db_factory::query($sql);


require_once  $template_obj->template ( $do );