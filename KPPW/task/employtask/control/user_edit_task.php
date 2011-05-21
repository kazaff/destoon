<?php
if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

$file_path = S_ROOT."./task/".$model_list[$model_id]['model_code']."/control/admin/task_config.xml";
$xs_config = Xml_Oper_Class::get_xml_toarr($file_path);

$task_obj = new Keke_witkey_task_class();

$indus_obj = new Keke_witkey_industry_class();

$upload_size = Func_comm_class::formatBytes(UPLOAD_MAXSIZE);


if ($task_info['uid']!=$uid){
	Func_comm_class::showmessage('操作失败','index.php?do=user&view=release_task&model_id='.$model_info['model_id'],1,'任务不属于您！','error');
}
if ($task_info['task_status']>0){
	Func_comm_class::showmessage('操作失败','index.php?do=user&view=release_task&model_id='.$model_info['model_id'],1,'任务状态无效！','error');
}

if ($op == 'del'){
	$task_obj->setWhere("task_id = '$task_id'");
	$task_obj->del_keke_witkey_task();
	Func_comm_class::showmessage('任务删除成功','index.php?do=user&view=release_task&model_id='.$model_info['model_id']);
}

$indus_obj->setWhere(' indus_pid = 0 and indus_type = 1 order by listorder asc ');
$indus_p_arr = $indus_obj->query_keke_witkey_industry();

$indus_obj->setWhere(' indus_pid != 0 indus_type = 1 order by listorder asc ');
$indus_c_arr = $indus_obj->query_keke_witkey_industry();

if($task_id){
	$task_obj->setWhere(' task_id= '.intval($task_id));
	$task_info = $task_obj->query_keke_witkey_task();
	$task_info = $task_info[0];
	
	
	
	$title = '编辑'.$model_info['model_name'];
	
	
	if($task_info[indus_id]){
		$indus_obj->setWhere(' indus_id =  '.intval($task_info[indus_id]));
		$indus_info = $indus_obj->query_keke_witkey_industry();
		$indus_info = $indus_info[0];
	}
}else{
	Func_comm_class::showmessage('任务编辑失败','index.php?do=user&view=release_task&model_id='.$model_info['model_id'],1,'任务ID不存在，编辑失败！','error');
}

if(isset($sbt_xs)){
	$task_obj->setWhere('task_id = '.intval($task_id));
	$task_obj->setIndus_id($slt_indus_id);
	$txt_task_title = Func_comm_class::str_filter($txt_task_title);
	$task_obj->setTask_title($txt_task_title);
	$tar_content = Func_comm_class::str_filter($tar_content);
	$task_obj->setTask_desc($tar_content);
	$res = $task_obj->edit_keke_witkey_task();
	
	
	if($res){
		Func_comm_class::showmessage('任务编辑成功','index.php?do=user&view=release_task&model_id='.$model_info['model_id'],1,'任务编辑成功！');
	}else{
		Func_comm_class::showmessage('任务编辑失败','index.php?do=user&view=release_task&model_id='.$model_info['model_id'],1,'任务编辑失败！','error');
	}
	
}

require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/tpl/'.$_K['template']."/user_edit_task" );

