<?php

if (!$task_id){
	Func_comm_class::showmessage("错误","index.php?do=index",'time','错误的参数','error');
}
$task_ext_obj = new Keke_witkey_task_ext_class();
$task_ext_obj->setWhere('a.task_id=' . intval ( $task_id ));
$task_info = $task_ext_obj->query_keke_witkey_task();
$task_info = $task_info [0];
Func_comm_class::update_score_value($uid,'view_task',3);

if (!$task_info){
	Func_comm_class::showmessage("错误","index.php?do=index",'time','任务不存已删除','error');
}

$model_info = $model_list[$task_info['model_id']];

if (!$model_info){
	Func_comm_class::showmessage("错误","index.php?do=index",'time','任务模型不存在或已禁用','error');
}
else {
	require S_ROOT."./task/".$model_info['model_dir']."/control/user_edit_task.php";
}
