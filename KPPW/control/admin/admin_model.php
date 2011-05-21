<?php


if(!defined('ADMIN_KEKE')) {
	exit('Access Denied');
}




if (!$model_id){
	Func_comm_class::adminshowmessage("错误的模型参数","index.php?do=info");
}
else {
	$model_info = $model_list[$model_id];
	require S_ROOT."task/".$model_info['model_dir']."/control/admin/admin_task.php";
}

