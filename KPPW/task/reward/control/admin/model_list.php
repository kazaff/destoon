<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

$xs_config = Cache_ext_Class::getConfig('xs_task');


$task_obj = new Keke_witkey_task_class();


if (isset ( $sbt_action )) {
	$o_p = $rdo;
	$keyids = $ckb;
	
	 $ids =$keyids?implode(',',$keyids):Func_comm_class::adminshowmessage("您没有选择项","index.php?do=model&model_id=$model_id&view=list");
	 
		if (count ( $keyids )) {
			$task_obj->setWhere("task_id in ({$ids})");
			if ($sbt_action == "批量删除"){
				$task_arr = $task_obj->query_keke_witkey_task();
				foreach ($task_arr as $task)
				{
					if (in_array($task['task_status'],array(2,3,4)))
					{
						continue;
					}
					$file_obj = new Keke_witkey_file_class();
					$file_obj->setWhere("task_id='{$task['task_id']}'");
					$file_arr = $file_obj->query_keke_witkey_file();
					$file_obj->setWhere("task_id='{$task['task_id']}'");
					$file_obj->del_keke_witkey_file();
					$backup_patch = S_ROOT.'./data/uploads/';
					foreach ($file_arr as $file)
					{
						unlink($backup_patch.$file['filename']);
					}
					$task_obj->setWhere("task_id='{$task['task_id']}'");
					$task_obj->del_keke_witkey_task();
					Func_comm_class::notify_user("任务删除通知",'您的任务 <b>'.$task['task_title'].'</b> 被删除，如有疑问请联系本站客服',$task['uid'],$task['username']);
				}
				Func_comm_class::adminSystemLog("删除任务$ids");
			}
			elseif ($sbt_action == "批量审批"){
				$setstatus = "&status=2";
				$task_arr = $task_obj->query_keke_witkey_task();
				$xs_task_config = Cache_ext_Class::getConfig('xs_task');
				$task_rule_config = Cache_ext_Class::gettabledata("witkey_day_rule","model_id='{$model_info['model_id']}'","rule_cash",null,"day_rule_id");
				foreach ($task_arr as $task)
				{
					if ($task['task_status']!=1)
					{
						continue;
					}
					$end_time = $task['end_time']-$task['start_time']+time();
					$task_obj ->setEnd_time($end_time);
					$task_obj->setStart_time(time());
					$task_obj->setTask_status(2);
					$task_obj->setWhere("task_id='{$task['task_id']}'");
					$task_obj->edit_keke_witkey_task();
					Func_comm_class::feed_add('<a href="index.php?do=space&member_id='.$task['uid'].'" target="_blank">'.$task['username'].'</a>发布了任务 <a target="_blank" href="index.php?do=task&task_id='.$task['task_id'].'">'.$task['task_title'].'</a>',$task['uid'],$task['username'],'pub_task',$task['task_id']);
					
					$message_obj = new Message_Class();
					if ($message_obj->validate('task_auth_success_isnotice')){
						$message_obj->setUid($task['uid']);
						$message_obj->setUsername($task['username']);
						$message_obj->setValue('任务编号',$task['task_id']);
						$message_obj->setValue('任务标题',$task['task_title']);
						$url= "<a href =\'index.php?do=task&task_id={$task[task_id]}\' target=\'_blank\' >{$task['task_title']}</a>";
						$message_obj->setValue ( '任务链接', $url );
						$message_obj->setValue('开始时间',date('Y-m-d H:i:s',time()));
						$message_obj->setValue('结束时间',date('Y-m-d H:i:s',$end_time));
						$message_obj->setTitle('任务通过审核');
						$message_obj->send();
					}
					db_factory::execute("update ".TABLEPRE."witkey_finance set site_profit='".$task['task_cash']*$xs_config['deduct_scale']."' where task_id={$task['task_id']} and fina_narrate = 4");
				}	
				Func_comm_class::adminSystemLog("审批任务$ids");
				
			}
			elseif ($sbt_action == "批量冻结"){
			$setstatus = "&status=6";
			$task_frost_obj = new Keke_witkey_task_frost_class();
				$task_arr = $task_obj->query_keke_witkey_task();
				foreach ($task_arr as $task)
				{
					$task_frost_obj->_frost_id=null;
					if (!in_array($task['task_status'],array(2,3,4))){
						continue;
					}
					$task_frost_obj->setTask_id($task['task_id']);
					$task_frost_obj->setFrost_status($task['task_status']);
					$task_frost_obj->setFrost_time(time('now()'));
					$task_frost_obj->setAdmin_uid($myinfo_arr['uid']);
					$task_frost_obj->setAdmin_username($myinfo_arr['username']);
					$task_frost_obj->setFrost_id(null);
					$task_frost_obj->create_keke_witkey_task_frost();
					$task_obj->setWhere("task_id='{$task['task_id']}'");
					$task_obj->setTask_status(6);
					$task_obj->edit_keke_witkey_task();
					
					$message_obj = new Message_Class();
					if ($message_obj->validate('task_freeze_isnotice')){
						$message_obj->setUid($task['uid']);
						$message_obj->setUsername($task['username']);
						$message_obj->setValue("任务标题",$task['task_title']);
						$url= "<a href =\'index.php?do=task&task_id={$task[task_id]}\' target=\'_blank\' >{$task['task_title']}</a>";
						$message_obj->setValue ( '任务链接', $url );
						$message_obj->setValue("任务编号",$task['task_id']);
						$message_obj->setTitle('任务冻结');
						$message_obj->send();
					}
				}
				Func_comm_class::adminSystemLog("冻结任务$ids");
			}
			elseif ($sbt_action == "批量恢复")
			{
				$setstatus = "&status=6";
				$task_frost_obj = new Keke_witkey_task_frost_class();
				$task_arr = $task_obj->query_keke_witkey_task();
				foreach ($task_arr as $task)
				{
					if ($task['task_status']!=6){
						continue;
					}
					$task_frost_obj = new Keke_witkey_task_frost_class();
					$task_frost_obj->setWhere("task_id = '{$task['task_id']}' order by frost_time desc limit 0,1");
					$frost_arr = $task_frost_obj->query_keke_witkey_task_frost();
					$frost_arr = $frost_arr[0];
					$task_frost_obj->setRestore_time(time('now()'));
					$task_obj->setTask_status($frost_arr['frost_status']);
					$task_obj->setEnd_time( $task['end_time']+ (time('now()')-$frost_arr['frost_time'])  );
					$task_frost_obj->setWhere("frost_id = '{$frost_arr['frost_id']}'");
					$task_obj->setWhere("task_id='{$task['task_id']}'");
					$task_frost_obj->edit_keke_witkey_task_frost();
					$task_obj->edit_keke_witkey_task();
					Func_comm_class::notify_user("任务冻结通知",'您的任务 <b>'.$task['task_title'].'</b> 的冻结状态已被恢复，',$task['uid'],$task['username']);
				}
				Func_comm_class::adminSystemLog("恢复任务$ids");
			}
			
			
			Func_comm_class::adminshowmessage('操作成功',"index.php?do=model&model_id=$model_id&view=list");
		}
	 } 



$where_str = "model_id=1 ";

if ($slt_indus_id){
	$where_str .= " and indus_id='{$slt_indus_id}' ";
}
if ($status=='n'){
	$where_str .= " and task_status='0' ";
}
elseif ($status){
	$where_str .= " and task_status='{$status}' ";
}
if ($txt_task_id)
{
	$where_str .= " and task_id='{$txt_task_id}' ";
}
$lefttime = "";
if ($txt_leftday)
{
	$lefttime += $txt_task_id*24*60*60;
}
if ($txt_lefthour)
{
	$lefttime += $txt_lefthour*60*60;
}
if ($lefttime)
{
	$where_str .= " and end_time<{$lefttime} ";
}

switch ($order) {
	case 1:
		$where_str.=' order by task_id desc ';
	;
	break;
	case 2:
		$where_str.=' order by task_id asc ';
	;
	break;
	case 3:
		$where_str.=' order by start_time desc ';
	;
	break;
	case 4:
		$where_str.=' order by start_time asc ';
	;
	break;
	case 5:
		$where_str.=' order by end_time desc ';
	;
	break;
	case 6:
		$where_str.=' order by end_time asc ';
	;
	break;
	default:
	   $where_str.=' order by start_time desc ';
		;
	break;
}
$task_obj->setWhere($where_str);
$task_arr =  $task_obj->query_keke_witkey_task();

$indus_arr = Cache_ext_Class::getIndustryList(1);

$temp_arr = array ();
$indus_option_arr = Cache_ext_Class::getIndustryList(1);
Func_comm_class::get_tree($indus_option_arr,$temp_arr);
$indus_option_arr = $temp_arr;

require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/control/admin/tpl/model_' . $view );