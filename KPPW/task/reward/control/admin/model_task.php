<?php


if(!defined('ADMIN_KEKE')) {
	exit('Access Denied');
}


if ($op == 'del')
{
	$task_id = $task_id?$task_id:Func_comm_class::adminshowmessage("错误的参数","index.php?do=model&model_id=$model_id&view=list");
	$task_obj = new Keke_witkey_task_class();
	$task_obj->setWhere("task_id='{$task_id}'");
	$task_arr = $task_obj->query_keke_witkey_task();
	if (in_array($task_arr[0]['task_status'],array(1,2,3,4)))
	{
		Func_comm_class::adminshowmessage("您不能删除当前状态下的任务","index.php?do=model&model_id=$model_id&view=list");
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
	Func_comm_class::notify_user("任务删除通知","您的任务 <b><a href=\"index.php?do=task&task_id={$task_arr[0]['task_id']}\">{$task_arr[0]['task_title']}</a></b> 被删除，如有疑问请联系本站客服",$task_arr[0]['uid'],$task_arr[0]['username']);
	$ttype = $task_arr[0]['model_id']==2?"tender":"reward";
	Func_comm_class::adminshowmessage("任务删除成功","index.php?do=model&model_id=$model_id&view=list");
}

if ($op == 'setstatus1')
{
	$task_id = $task_id?$task_id:Func_comm_class::adminshowmessage("错误的参数","index.php?do=model&model_id=$model_id&view=list");
	$task_obj = new Keke_witkey_task_class();
	
	$task_obj->setWhere("task_id='{$task_id}'");
	$task_arr = $task_obj->query_keke_witkey_task();
	
	if ($task_arr[0]['task_status']!=1){
		Func_comm_class::adminshowmessage("该任务并不在待审核状态","index.php?do=model&model_id=$model_id&view=list");
	}
	$task_obj->setWhere("task_id='{$task_id}'");
	
	$task_obj->setTask_status(2);
	$xs_task_config = Cache_ext_Class::getConfig('xs_task');
	$task_day = 0;
	
	$end_time = $task_arr[0]['end_time']-$task_arr[0]['start_time']+time();
	$task_obj ->setEnd_time($end_time);
	
	$task_obj->edit_keke_witkey_task();
	
	Func_comm_class::adminSystemLog("审核任务$task_id");
	
	if ($task_arr[0]['model_id']==1){
		Func_comm_class::feed_add('<a href="index.php?do=space&member_id='.$task_arr[0]['uid'].'" target="_blank">'.$task_arr[0]['username'].'</a>发布了任务 <a target="_blank" href="index.php?do=task&task_id='.$task_arr[0]['task_id'].'">'.$task_arr[0]['task_title'].'</a>',$task_arr[0]['uid'],$task_arr[0]['username'],'pub_task',$task_arr[0]['task_id']);
		
		$message_obj = new Message_Class();
		if ($message_obj->validate('task_auth_success_isnotice')){
			$message_obj->setUid($task_arr[0]['uid']);
			$message_obj->setUsername($task_arr[0]['username']);
			$message_obj->setValue('任务编号',$task_arr[0]['task_id']);
			$message_obj->setValue('任务标题',$task_arr[0]['task_title']);
			$url= "<a href =\'index.php?do=task&task_id={$task_arr[0][task_id]}\' target=\'_blank\' >{$task_arr[0]['task_title']}</a>";
			$message_obj->setValue ( '任务链接', $url );
			$message_obj->setValue('开始时间',date('Y-m-d H:i:s',time()));
			$message_obj->setValue('结束时间',date('Y-m-d H:i:s',$end_time));
			$message_obj->setTitle('任务通过审核');
			$message_obj->send();
		}
		Func_comm_class::adminshowmessage("任务审核成功","index.php?do=model&model_id=$model_id&view=list");}
	else {
		Func_comm_class::feed_add('<a href="index.php?do=space&member_id='.$task_arr[0]['uid'].'" target="_blank">'.$task_arr[0]['username'].'</a>发布了任务 <a target="_blank" href="index.php?do=task&task_id='.$task_arr[0]['task_id'].'">'.$task_arr[0]['task_title'].'</a>',$task_arr[0]['uid'],$task_arr[0]['username'],'pub_task',$task_arr[0]['task_id']);
		Func_comm_class::adminshowmessage("任务审核成功","index.php?do=model&model_id=$model_id&view=list");
	}
	
}
if ($op == 'setstatus5'){
	
	$task_id = $task_id?$task_id:Func_comm_class::adminshowmessage("错误的参数","index.php?do=task&view=rewardlist");
	$task_obj = new Keke_witkey_task_class();
	
	$task_obj->setWhere("task_id='{$task_id}'");
	$task_arr = $task_obj->query_keke_witkey_task();
	if ($task_arr[0]['task_status']!=1){
		Func_comm_class::adminshowmessage("该任务并不在待审核状态","index.php?do=model&model_id=$model_id&view=list");
	}
	
	$task_obj->setWhere("task_id='{$task_id}'");
	$task_obj->setTask_status(10);
	if(!$task_arr[0]['uid'])
	{
		Func_comm_class::adminshowmessage("发布者信息错误","index.php?do=model&model_id=$model_id&view=list");
	}
	
	$user_obj = new Keke_witkey_space_class();
	$user_info = new Keke_witkey_space_class();
	$user_info = $user_obj->setWhere("uid='{$task_arr[0]['uid']}'");
	$user_info = $user_info[0];
	
	
	$return_cash =0;
	
	$flag = false;
	
	$fina_obj = new Keke_witkey_finance_class();
	$fina_obj->setFina_type(2);
	$fina_obj->setFina_narrate(8);
	$fina_obj->setUid($task_arr[0]['uid']);
	$fina_obj->setUsername($task_arr[0]['username']);
	$fina_obj->setTask_id($task_arr[0]['task_id']);
	$fina_obj->setFina_cash($task_arr[0]['cash_cost']);
	$fina_obj->setFina_credit($task_arr[0]['credit_cost']);
	$fina_obj->setFina_time(time());
	if ($task_arr[0]['cash_cost'])
	{
		$fina_obj->setUser_balance($user_info['balance']+$task_arr[0]['cash_cost']);
		db_factory::execute("update ".TABLEPRE."witkey_space set balance=balance+{$task_arr[0]['cash_cost']} where uid='{$task_arr[0]['uid']}'");
	}
	if ($task_arr[0]['credit_cost'])
	{
		$fina_obj->setUser_credit($user_info['credit']+$task_arr[0]['credit_cost']);
		db_factory::execute("update ".TABLEPRE."witkey_space set credit=credit+{$task_arr[0]['credit_cost']} where uid='{$task_arr[0]['uid']}'");
	}
	$fina_obj->create_keke_witkey_finance();
	
	
	if ($task_arr[0]['is_prom'])
	{
		$user_info = Func_comm_class::getuserinfo($task_arr[0]['uid']);
		$fina_obj2 = new Keke_witkey_finance_class();
		$fina_obj2->setFina_type(2);
		$fina_obj2->setFina_narrate(9);
		$fina_obj2->setUid($task_arr[0]['uid']);
		$fina_obj2->setUsername($task_arr[0]['username']);
		$fina_obj2->setTask_id($task_arr[0]['task_id']);
		$fina_obj2->setFina_cash($task_arr[0]['prom_cash']);
		$fina_obj2->setFina_credit($task_arr[0]['prom_credit']);
		$fina_obj2->setUser_balance($user_info['balance']+$task_arr[0]['prom_cash']);
		$fina_obj2->setUser_credit($user_info['credit']+$task_arr[0]['prom_credit']);
		$fina_obj2->setFina_time(time());
		$fina_obj2->create_keke_witkey_finance();
		db_factory::execute("update ".TABLEPRE."witkey_space set balance=balance+".($task_arr[0]['prom_cash']+0).",credit=credit+".($task_arr[0]['prom_credit']+0)." where uid='{$task_arr[0]['uid']}'");
	
	}
	
	
	
	
	$task_obj->edit_keke_witkey_task();
	Func_comm_class::adminSystemLog("否决任务$task_id的审核");
	
	$message_obj = new Message_Class();
	if ($message_obj->validate('task_auth_fail_isnotice')){
		$message_obj->setUid($task_arr[0]['uid']);
		$message_obj->setUsername($task_arr[0]['username']);
		$message_obj->setValue('任务编号',$task_arr[0]['task_id']);
		$message_obj->setValue('任务标题',$task_arr[0]['task_title']);
		$url= "<a href =\'index.php?do=task&task_id={$task_arr[0][task_id]}\' target=\'_blank\' >{$task_arr[0]['task_title']}</a>";
		$message_obj->setValue ( '任务链接', $url );
		$message_obj->setTitle('任务未通过审核');
		$message_obj->send();
	}
	if ($task_arr[0]['model_id']==1){
	Func_comm_class::adminshowmessage("操作成功","index.php?do=model&model_id=$model_id&view=list");}
	else {Func_comm_class::adminshowmessage("操作成功","index.php?do=model&model_id=$model_id&view=list");}
}
if ($op == 'setstatus6')
{
	$task_id = $task_id?$task_id:Func_comm_class::adminshowmessage("错误的参数","index.php?do=model&model_id=$model_id&view=list");
	$task_obj = new Keke_witkey_task_class();
	
	$task_obj->setWhere("task_id='{$task_id}'");
	$task_arr = $task_obj->query_keke_witkey_task();
	if (!in_array($task_arr[0]['task_status'],array(2,3,4))){
		Func_comm_class::adminshowmessage("该任务无法冻结","index.php?do=model&model_id=$model_id&view=list");
	}
	$task_obj->setWhere("task_id='{$task_id}'");
	
	$task_obj->setTask_status(6);
	$task_frost_obj = new Keke_witkey_task_frost_class();
	$task_frost_obj->setTask_id($task_id);
	$task_frost_obj->setFrost_status($task_arr[0]['task_status']);
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
		$message_obj->setValue("任务标题",$task_info['task_title']);
		$url= "<a href =\'index.php?do=task&task_id={$task_arr[0][task_id]}\' target=\'_blank\' >{$task_arr[0]['task_title']}</a>";
		$message_obj->setValue ( '任务链接', $url );
		$message_obj->setValue("任务编号",$task_info['task_id']);
		$message_obj->setTitle('任务冻结');
		$message_obj->send();
	}
	if ($task_arr[0]['model_id']==1){
	Func_comm_class::adminshowmessage("任务冻结成功","index.php?do=model&model_id=$model_id&view=list");}
	else {Func_comm_class::adminshowmessage("任务冻结成功","index.php?do=model&model_id=$model_id&view=list");}
}
if ($op == 'restore')
{
	$task_id = $task_id?$task_id:Func_comm_class::adminshowmessage("错误的参数","index.php?do=model&model_id=$model_id&view=list");
	$task_obj = new Keke_witkey_task_class();
	
	$task_obj->setWhere("task_id='{$task_id}'");
	$task_arr = $task_obj->query_keke_witkey_task();
	if ($task_arr[0]['task_status']!=6){
		Func_comm_class::adminshowmessage("该任务不在冻结状态","index.php?do=model&model_id=$model_id&view=list");
	}
	
	$task_obj->setWhere("task_id='{$task_id}'");
	$task_frost_obj = new Keke_witkey_task_frost_class();
	$task_frost_obj->setWhere("task_id = '{$task_id}' order by frost_time desc limit 0,1");
	$frost_arr = $task_frost_obj->query_keke_witkey_task_frost();
	$frost_arr = $frost_arr[0];
	$task_frost_obj->setRestore_time(time('now()'));
	$task_obj->setTask_status($frost_arr['frost_status']);
	$task_obj->setEnd_time( $task_arr[0]['end_time']+ (time('now()')-$frost_arr['frost_time'])  );
	$task_obj->edit_keke_witkey_task();
	$task_frost_obj->setWhere("frost_id = '{$frost_arr['frost_id']}'");
	$task_frost_obj->edit_keke_witkey_task_frost();
	$task_obj->edit_keke_witkey_task();
	
	Func_comm_class::adminSystemLog("恢复任务$task_id");
	Func_comm_class::notify_user("任务恢复提示","您的任务 <b><a href=\"index.php?do=task&task_id={$task_arr[0]['task_id']}\">{$task_arr[0]['task_title']}</a></b> 的冻结状态已被恢复，",$task_arr[0]['uid'],$task_arr[0]['username']);
	if ($task_arr[0]['model_id']==1){
	Func_comm_class::adminshowmessage("任务已恢复","index.php?do=model&model_id=$model_id&view=list");}
	else {Func_comm_class::adminshowmessage("任务已恢复","index.php?do=model&model_id=$model_id&view=list");}
}