<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$task_id = $task_id?$task_id:Func_comm_class::adminshowmessage("参数错误","index.php?do=model&model_id=$model_id&view=list");
$task_obj = new Keke_witkey_task_class();
$task_obj->setWhere("task_id ='{$task_id}'");
$task_info = $task_obj->query_keke_witkey_task();
$task_info = $task_info[0];
$find = '/'.'src="data'.'/i';
$replase = 'src="../../data';
$task_info[task_desc] =  preg_replace ( $find, $replase, $task_info[task_desc] );

//load  attachment
$file_obj = new Keke_witkey_file_class();
$file_obj->setWhere("task_id = '{$task_id}'");
$file_list = $file_obj->query_keke_witkey_file();

$task_obj->setWhere("task_id ='{$task_id}'");
$cash_rule_arr = Cache_ext_Class::gettabledata("witkey_cash_rule","","",0,"cash_rule_id");
if ($is_submit)
{
	if (strtotime($txt_start_time)>strtotime($txt_end_time))
	{
		Func_comm_class::adminshowmessage("结束时间不能小于发布时间","index.php?do=model&model_id=$model_id&view=list");
	}
	if (strtotime($txt_end_time)<time('now()'))
	{
		Func_comm_class::adminshowmessage("结束时间不能小于当前时间","index.php?do=model&model_id=$model_id&view=list");
	}
	if (!$slt_indus_id)
	{
		Func_comm_class::adminshowmessage("必须选择一个行业","index.php?do=model&model_id=$model_id&view=list");
	}
	
	$task_obj->setTask_title($txt_task_title);
	$task_obj->setIndus_id($slt_indus_id);
	$task_obj->setIstop($rdo_istop);
	$find ='src=\"../../data/';
	$replase = 'src=\"data/';
	$txt_task_desc =  str_ireplace ( $find, $replase, $txt_task_desc );
	$task_obj->setTask_desc($txt_task_desc);
	$task_obj->setTask_cash_coverage($slt_cash_coverage);
	$task_obj->setStart_time(strtotime("$txt_start_time",time()));
	$task_obj->setEnd_time(strtotime("$txt_end_time"));
	
	$upload_obj = new Upload_Class(UPLOAD_ROOT,array("gif",'jpeg','jpg','png'),UPLOAD_MAXSIZE);
	$files = $upload_obj->run('fle_task_pic',1);
	if($files!='The uploaded file is Unallowable!'){
		$task_pic = $files[0]['saveName'];
		if($task_pic){
			$task_pic = "data/uploads/".UPLOAD_RULE.$task_pic;
			$task_obj->setTask_pic($task_pic);
		}
	}
	
	$task_obj->edit_keke_witkey_task();
	Func_comm_class::notify_user('系统消息','管理员'.$myinfo_arr['username'].'编辑了您的任务<b><a href="index.php?do=task&task_id='.$task_info['task_id'].'">'.$task_info['task_title'].'</a></b>(id'.$task_id.') 。',$task_info['uid'],$task_info['username']);
	Func_comm_class::adminSystemLog("编辑任务$txt_task_title");
	Func_comm_class::adminshowmessage("任务编辑成功","index.php?do=model&model_id=$model_id&view=list");
}








$indus_arr = Cache_ext_Class::getIndustryList(1);
$temp_arr = array ();
$indus_option_arr = Cache_ext_Class::getIndustryList(1);
Func_comm_class::get_tree($indus_option_arr,$temp_arr,"option",$task_info['indus_id']);
$indus_option_arr = $temp_arr;

require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/control/admin/tpl/model_' . $view );