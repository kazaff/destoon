<?php



if(!defined('IN_KEKE')) {
	exit('Access Denied');
}


$model_info = $model_list[$model_id];


if (!$model_info){
	Func_comm_class::showmessage("错误","index.php?do=index",'time','任务模型不存在或已禁用','error');
}
else {
	require S_ROOT."./task/".$model_info['model_dir']."/control/task_list.php";
}