<?php



if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$xs_config = Cache_ext_Class::getConfig('xs_task');

if ($op == 'del')
{
	if (in_array($task_info['task_status'],array(1,2,3,4)))
	{
		Func_comm_class::adminshowmessage("您不能删除当前状态下的任务","index.php?do=task&view=rewardlist");
	}
	$task_obj->setWhere("task_id='{$task_id}'");
	$file_obj = new Keke_witkey_file_class();
	$file_arr = $file_obj->query_keke_witkey_file();
	$file_obj->setWhere("task_id='{$task_id}'");
	$file_obj->del_keke_witkey_file();
	
	$backup_patch = S_ROOT.'./data/uploads/';

	foreach ($file_arr as $file){
		if(file_exists($file['filename'])){
			chmod($backup_patch,777);
			chmod($file['filename'],777);
			unlink($backup_patch.$file['filename']);
		}
	}
	
	$task_obj->setWhere("task_id='{$task_id}'");
	$task_obj->del_keke_witkey_task();
	Func_comm_class::adminSystemLog("删除任务$task_id");
	Func_comm_class::notify_user("任务删除通知","您的任务 <b>{$task_info['task_title']}</b> 被删除，如有疑问请联系本站客服",$task_info['uid'],$task_info['username']);
	$ttype = $task_info['model_id']==2?"tender":"reward";
	Func_comm_class::adminshowmessage("任务删除成功","index.php?do=task&view={$ttype}list&slt_indus_id={$r_indus_id}&status={$r_status}&txt_task_id={$r_task_id}&txt_leftday={$r_leftday}&txt_lefthour={$r_lefthour}");
}

if ($op == 'setstatus1')
{
	
	if ($task_info['task_status']!=1){
		Func_comm_class::adminshowmessage("该任务并不在待审核状态","index.php?do=task&view=rewardlist");
	}
	$task_obj->setWhere("task_id='{$task_id}'");
	
	$task_obj->setTask_status(2);
	$xs_task_config = Cache_ext_Class::getConfig('xs_task');
	$task_day = 0;
	
	$end_time = $task_info['end_time']-$task_info['start_time']+time();
	$task_obj ->setEnd_time($end_time);
	
	$task_obj->edit_keke_witkey_task();
	
	Func_comm_class::adminSystemLog("审核任务$task_id");
	
	if ($task_info['model_id']==1){
		Func_comm_class::feed_add('<a href="index.php?do=space&member_id='.$task_info['uid'].'" target="_blank">'.$task_info['username'].'</a>发布了任务 <a target="_blank" href="index.php?do=task&task_id='.$task_info['task_id'].'">'.$task_info['task_title'].'</a>',$task_info['uid'],$task_info['username'],'pub_task',$task_info['task_id']);
		
		$message_obj = new Message_Class();
		if ($message_obj->validate('task_auth_success_isnotice')){
			$message_obj->setUid($task_info['uid']);
			$message_obj->setUsername($task_info['username']);
			$message_obj->setValue('任务编号',$task_info['task_id']);
			$message_obj->setValue('任务标题',$task_info['task_title']);
			$url= "<a href =\'index.php?do=task&task_id={$task_info['task_id']}\' target=\'_blank\' >{$task_info['task_title']}</a>";
			$message_obj->setValue ( '任务链接', $url );
			$message_obj->setValue('开始时间',date('Y-m-d H:i:s',time()));
			$message_obj->setValue('结束时间',date('Y-m-d H:i:s',$end_time));
			$message_obj->setTitle('任务通过审核');
			$message_obj->send();
		}
		
		db_factory::execute("update ".TABLEPRE."witkey_finance set site_profit='".$task_info['task_cash']*$xs_config['deduct_scale']."' where task_id={$task_info['task_id']} and fina_narrate = 4");
		Func_comm_class::adminshowmessage("任务审核成功","index.php?do=task&view=rewardlist");}
	else {
		Func_comm_class::feed_add('<a href="index.php?do=space&member_id='.$task_info['uid'].'" target="_blank">'.$task_info['username'].'</a>发布了任务 <a target="_blank" href="index.php?do=task&task_id='.$task_info['task_id'].'">'.$task_info['task_title'].'</a>',$task_info['uid'],$task_info['username'],'pub_task',$task_info['task_id']);
		Func_comm_class::adminshowmessage("任务审核成功","index.php?do=task&view=tenderlist");
	}
	
}
if ($op == 'setstatus5'){
	if ($task_info['task_status']!=1){
		Func_comm_class::adminshowmessage("该任务并不在待审核状态","index.php?do=task&view=rewardlist");
	}
	
	$task_obj->setWhere("task_id='{$task_id}'");
	$task_obj->setTask_status(10);
	if(!$task_info['uid'])
	{
		Func_comm_class::adminshowmessage("发布者信息错误","index.php?do=task&view=rewardlist");
	}
	
	$user_obj = new Keke_witkey_space_class();
	$user_info = new Keke_witkey_space_class();
	$user_info = $user_obj->setWhere("uid='{$task_info['uid']}'");
	$user_info = $user_info[0];
	
	
	
	$return_cash =0;
	
	$flag = false;
	
	$fina_obj = new Keke_witkey_finance_class();
	$fina_obj->setFina_type(2);
	$fina_obj->setFina_narrate(8);
	$fina_obj->setUid($task_info['uid']);
	$fina_obj->setUsername($task_info['username']);
	$fina_obj->setTask_id($task_info['task_id']);
	$fina_obj->setFina_cash($task_info['cash_cost']);
	$fina_obj->setFina_credit($task_info['credit_cost']);
	$fina_obj->setFina_time(time());
	if ($task_info['cash_cost'])
	{
		$fina_obj->setUser_balance($user_info['balance']+$task_info['cash_cost']);
		db_factory::execute("update ".TABLEPRE."witkey_space set balance=balance+{$task_info['cash_cost']} where uid='{$task_info['uid']}'");
	}
	if ($task_info['credit_cost'])
	{
		$fina_obj->setUser_credit($user_info['credit']+$task_info['credit_cost']);
		db_factory::execute("update ".TABLEPRE."witkey_space set credit=credit+{$task_info['credit_cost']} where uid='{$task_info['uid']}'");
	}
	$fina_obj->create_keke_witkey_finance();
	
	if ($task_info['is_prom'])
	{
		$user_info = Func_comm_class::getuserinfo($user_info['uid']);
		$fina_obj2 = new Keke_witkey_finance_class();
		$fina_obj2->setFina_type(2);
		$fina_obj2->setFina_narrate(9);
		$fina_obj2->setUid($task_info['uid']);
		$fina_obj2->setUsername($task_info['username']);
		$fina_obj2->setTask_id($task_info['task_id']);
		$fina_obj2->setFina_cash($task_info['prom_cash']);
		$fina_obj2->setFina_credit($task_info['prom_credit']);
		$fina_obj2->setUser_balance($user_info['balance']+$task_info['prom_cash']);
		$fina_obj2->setUser_credit($user_info['credit']+$task_info['prom_credit']);
		$fina_obj2->setFina_time(time());
		$fina_obj2->create_keke_witkey_finance();
		db_factory::execute("update ".TABLEPRE."witkey_space set balance=balance+{$task_info['prom_cash']},credit=credit+{$task_info['prom_credit']} where uid='{$task_info['uid']}'");
	
	}
	
	
	
	
	$task_obj->edit_keke_witkey_task();
	Func_comm_class::adminSystemLog("否决任务$task_id的审核");
	
	$message_obj = new Message_Class();
	if ($message_obj->validate('task_auth_fail_isnotice')){
		$message_obj->setUid($task_info['uid']);
		$message_obj->setUsername($task_info['username']);
		$message_obj->setValue('任务编号',$task_info['task_id']);
		$url= "<a href =\'index.php?do=task&task_id={$task_info['task_id']}\' target=\'_blank\' >{$task_info['task_title']}</a>";
		$message_obj->setValue ( '任务链接', $url );
		$message_obj->setValue('任务标题',$task_info['task_title']);
		$message_obj->setTitle('任务未通过审核');
		$message_obj->send();
	}
	if ($task_info['model_id']==1){
	Func_comm_class::adminshowmessage("操作成功","index.php?do=task&view=rewardlist");}
	else {Func_comm_class::adminshowmessage("操作成功","index.php?do=task&view=tenderlist");}
}
if ($op == 'setstatus6')
{
	if (!in_array($task_info['task_status'],array(2,3,4))){
		Func_comm_class::adminshowmessage("该任务无法冻结","index.php?do=task&view=rewardlist");
	}
	$task_obj->setWhere("task_id='{$task_id}'");
	
	$task_obj->setTask_status(6);
	$task_frost_obj = new Keke_witkey_task_frost_class();
	$task_frost_obj->setTask_id($task_id);
	$task_frost_obj->setFrost_status($task_info['task_status']);
	$task_frost_obj->setFrost_time(time('now()'));
	$task_frost_obj->setAdmin_uid($myinfo_arr['uid']);
	$task_frost_obj->setAdmin_username($myinfo_arr['username']);
	$task_frost_obj->create_keke_witkey_task_frost();
	$task_obj->edit_keke_witkey_task();
	
	Func_comm_class::adminSystemLog("冻结任务$task_id");
	
	$message_obj = new Message_Class();
	if ($message_obj->validate('task_freeze_isnotice')){
        $message_obj->setUid($task_info['uid']);
		$message_obj->setUsername($task_info['username']);
		$message_obj->setValue('任务编号',$task_info['task_id']);
		$url= "<a href =\'index.php?do=task&task_id={$task_info['task_id']}\' target=\'_blank\' >{$task_info['task_title']}</a>";
		$message_obj->setValue ( '任务链接', $url );
		$message_obj->setValue('任务标题',$task_info['task_title']);
		$message_obj->setTitle('任务冻结');
		$message_obj->send();
	}
	if ($task_info['model_id']==1){
	Func_comm_class::adminshowmessage("任务冻结成功","index.php?do=task&view=rewardlist");}
	else {Func_comm_class::adminshowmessage("任务冻结成功","index.php?do=task&view=tenderlist");}
}
if ($op == 'restore')
{
	if ($task_info['task_status']!=6){
		Func_comm_class::adminshowmessage("该任务不在冻结状态","index.php?do=task&view=rewardlist");
	}
	
	$task_obj->setWhere("task_id='{$task_id}'");
	$task_frost_obj = new Keke_witkey_task_frost_class();
	$task_frost_obj->setWhere("task_id = '{$task_id}' order by frost_time desc limit 0,1");
	$frost_arr = $task_frost_obj->query_keke_witkey_task_frost();
	$frost_arr = $frost_arr[0];
	$task_frost_obj->setRestore_time(time('now()'));
	$task_obj->setTask_status($frost_arr['frost_status']);
	$task_obj->setEnd_time( $task_info['end_time']+ (time('now()')-$frost_arr['frost_time'])  );
	$task_obj->edit_keke_witkey_task();
	$task_frost_obj->setWhere("frost_id = '{$frost_arr['frost_id']}'");
	$task_frost_obj->edit_keke_witkey_task_frost();
	$task_obj->edit_keke_witkey_task();
	
	Func_comm_class::adminSystemLog("恢复任务$task_id");
	Func_comm_class::notify_user("任务恢复通知","您的任务 <b>{$task_info['task_title']}</b> 的冻结状态已被恢复，",$task_info['uid'],$task_info['username']);
	if ($task_info['model_id']==1){
	Func_comm_class::adminshowmessage("任务已恢复","index.php?do=task&view=rewardlist");}
	else {Func_comm_class::adminshowmessage("任务已恢复","index.php?do=task&view=tenderlist");}
}
