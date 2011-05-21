<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$_K['html_title'] = '发布威客任务--'.$_K['html_title']; 

if ($view == 'agree')
{
	$title = '任务发布协议';
	require_once  $template_obj->template ('release_agree');
	die();
}

if($mid==6){
	if($euid){
		$user_info = Func_comm_class::getuserinfo($euid);
	}
}

if (!$model_id){
	require_once  $template_obj->template ( $do );
}
else {
	$model_info = $model_list[$model_id];
	if (!$model_info){
		Func_comm_class::showmessage("错误","index.php?do=index",3,'任务模型不存在或已禁用','error');
	}
	else {
		require "task/".$model_info['model_dir']."/control/release.php";
	}
}

