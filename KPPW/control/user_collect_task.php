<?php


if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$task_obj = new Keke_witkey_task_class();

$page_obj = new Pages_Class();

$task_fav_obj = new Keke_witkey_task_favor_class();

$task_fav_ext_obj = new Keke_witkey_task_favor_ext_class();
							

$reward_status_arr = array('0'=>'任务未付款',
							'1'=>'任务待审核',
							'2'=>'任务进行中',
							'3'=>'任务公示中',
							'4'=>'任务投票中',
							'5'=>'任务失败',
							'6'=>'任务冻结',
							'7'=>'任务完成');

$tender_status_arr = array('0'=>'任务未付款',
							'1'=>'任务待审核',
							'2'=>'任务招标中',
							'3'=>'任务进行中',
							'4'=>'任务进行中',
							'7'=>'任务完成'
							);



$tender_cash_rule = Cache_ext_Class::getConfigRule('cash');
							
if($uid){
	
	$where = ' 1 = 1 and a.uid = '.$uid;
	

	if($slt_task_type){
		$where.=' and b.model_id='.intval($slt_task_type);
	}
	

	if($txt_task_title){
		$where.=' and b.task_title like "%'.$txt_task_title.'%"';
	}
	
	

	$txt_start_time = strtotime($txt_start_time);
	$txt_end_time = strtotime($txt_end_time);
	
	if(intval($txt_start_time)&&intval($txt_end_time)){
		if(intval($txt_start_time)>=intval($txt_end_time)){
			Func_comm_class::showmessage('搜索失败','index.php?do='.$do.'&view='.$view,2,'开始时间不能大于结束时间','error');
		}elseif(intval($txt_start_time)==intval($txt_end_time)){
			$where.= ' and b.start_time = '.intval($txt_start_time);
		}else{
			$where.= ' and b.start_time >= '.intval($txt_start_time).' and b.start_time <= '.intval($txt_end_time);
		}
	}
	

	$page_size = intval($page_size)?intval($page_size):17;
		

	$task_fav_ext_obj->setWhere($where);
	$count = $task_fav_ext_obj->count_keke_witkey_task_favor();
	

	$url ='index.php?do='.$do.'&view='.$view.'&page_size='.$page_size.'&indus_id='.$indus_id.'&slt_cash_cove='.$slt_cash_cove.'&slt_order='.$slt_order;
	$page = $_GET ['page'] ? $_GET ['page'] : 1;
	$limit=$page_size;
	$pages = $page_obj->getPages($count,$limit,$page,$url);
	

	$order_where = ' order by a.fav_time desc ';
	

	$where .= $order_where;
	

	$task_fav_ext_obj->setWhere($where.$pages[where]);
	$task_arr = $task_fav_ext_obj->query_keke_witkey_task_favor();
	

	for ($i = 0; $i < count($task_arr); $i++) {
		$task_arr[$i][remaining_time] = Func_comm_class::time2Units($task_arr[$i][end_time]);
	}
	
	if($ac=='del'){
		$task_fav_obj->setWhere(' fav_id = '.intval($fav_id));
		$res = $task_fav_obj->del_keke_witkey_task_favor();
		if($res){
			Func_comm_class::showmessage('删除成功！','index.php?index.php&do='.$do.'&view='.$view,1,'收藏夹中的任务删除成功！');
		}else{
			Func_comm_class::showmessage('删除失败！','index.php?index.php&do='.$do.'&view='.$view,1,'','error');
		}
	}
}else{
	Func_comm_class::showmessage('您还没有登录，无法进行此操作！','index.php',3,"",'error');
}


require_once  $template_obj->template ($do."_".$view);