<?php
if(!defined('ADMIN_KEKE')) {
	exit('Access Denied');
}

$task_id = $task_id?$task_id:Func_comm_class::adminshowmessage("错误的参数","index.php?do=task&view=rewardlist");
$task_obj = new Keke_witkey_task_class();
$task_obj->setWhere("task_id='{$task_id}'");
$task_info = $task_obj->query_keke_witkey_task();
$task_info = $task_info[0];


$model_info = $model_list[$task_info['model_id']];
require S_ROOT."task/".$model_info['model_dir']."/control/admin/model_op.php";

