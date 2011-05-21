<?php


if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}
$task_obj = new Keke_witkey_task_class();
$page_obj = new Pages_Class();

if($uid){

	$where = " task_status<1 ";
	
	

	$page_size = intval($page_size)?intval($page_size):17;
		
	

	$task_obj->setWhere($where);
	$count = $task_obj->count_keke_witkey_task();
	

	$url ='index.php?do='.$do;
	$page = $_GET ['page'] ? $_GET ['page'] : 1;
	$limit=$page_size;
	$pages = $page_obj->getPages($count,$limit,$page,$url);
	

	$order_where = ' order by start_time desc ';
	

	$where .= $order_where;
	

	$task_obj->setWhere($where.$pages[where]);
	$task_arr = $task_obj->query_keke_witkey_task();
	

	for ($i = 0; $i < count($task_arr); $i++) {
		$task_arr[$i][remaining_time] = Func_comm_class::time2Units($task_arr[$i][end_time]);
	}
	
	
}else{
	Func_comm_class::showmessage('您还没有登录，无法进行此操作！','index.php',3,"","error");
}


require_once  $template_obj->template ($do."_".$view);