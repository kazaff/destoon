<?php


if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

$task_obj = new Keke_witkey_task_class();

$page_obj = new Pages_Class();

$sign_obj = new Keke_witkey_sign_class();

$reward_status_arr = array('0'=>'任务未付款',
							'1'=>'任务待审核',
							'2'=>'任务进行中',
							'3'=>'任务公示中',
							'4'=>'任务投票中',
							'5'=>'任务失败',
							'6'=>'任务冻结',
							'7'=>'任务完成');

if($uid){

	
	$sign_obj->setWhere(' uid = '.$uid);
	$sign_arr = $sign_obj->query_keke_witkey_sign();
	
	foreach ($sign_arr as $value) {
		$task_ids .= $value[task_id].',';
	}
	
	$task_ids.='0';
	
	$where = " model_id = {$model_id} ";
	
	$where .= ' and task_id in ('.$task_ids.')';
	
	if(isset($slt_task_status)){
		$where.=' and  task_status ='.intval($slt_task_status);
	}
	
	if($txt_task_title){
		$where.=' and task_title like "%'.$txt_task_title.'%"';
	}
	
	
	$txt_start_time = strtotime($txt_start_time);
	$txt_end_time = strtotime($txt_end_time);
	
	if(intval($txt_start_time)&&intval($txt_end_time)){
		if(intval($txt_start_time)>=intval($txt_end_time)){
			Func_comm_class::showmessage('搜索失败','index.php?do='.$do.'&view='.$view,2,'开始时间不能大于结束时间','error');
		}elseif(intval($txt_start_time)==intval($txt_end_time)){
			$where.= ' and start_time = '.intval($txt_start_time);
		}else{
			$where.= ' and start_time >= '.intval($txt_start_time).' and start_time <= '.intval($txt_end_time);
		}
	}
	
	if($slt_cash_cove){
		switch (intval($slt_cash_cove)) {
			case 1:
				$where.=' and task_cash<100 ' ;
			break;
			case 2:
				$where.=' and task_cash>=100 and task_cash<500 ' ;
			break;
			case 3:
				$where.=' and task_cash>=500 and task_cash<1000 ' ;
			break;
			case 4:
				$where.=' and task_cash>=1000 and task_cash<5000 ' ;
			break;
			case 5:
				$where.=' and task_cash>=5000 ' ;
			break;
			default:
				;
			break;
		}
	}
	
	
	
	
	$page_size = intval($page_size)?intval($page_size):17;
		
	
	$task_obj->setWhere($where);
	$count = $task_obj->count_keke_witkey_task();
	
	$url ='index.php?do='.$do.'&model_id='.$model_id.'&view='.$view.'&page_size='.$page_size.'&slt_task_status='.$slt_task_status.'&txt_task_title='.$txt_task_title.'&txt_start_time='.$txt_start_time.'&txt_end_time='.$txt_end_time.'&slt_cash_cove='.$slt_cash_cove.'&slt_order='.$slt_order;
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
	Func_comm_class::showmessage('您还没有登录，无法进行此操作！','index.php');
}


require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/tpl/'.$_K['template']."/user_join_task" );
