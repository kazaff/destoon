<?php


if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$task_id = $task_id?$task_id:Func_comm_class::adminshowmessage("参数错误",'index.php?do=model&model_id='.$model_id.'&view=list');
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

if ($task_info['task_status']==6)
{
	$work_obj = new Keke_witkey_work_class();
	$work_obj->setWhere("task_id='$task_id' order by work_status desc");
	$work_arr = $work_obj->query_keke_witkey_work();

	
	if ($task_info['task_mode']==2)
	{
		$prize_obj = new Keke_witkey_task_prize_class();
		$prize_obj->setWhere("task_id = '$task_id'");
		$prize_arr = $prize_obj->query_keke_witkey_task_prize();
	}
}

$task_obj->setWhere("task_id ='{$task_id}'");
if ($is_submit)
{
	if (strtotime($txt_start_time)>strtotime($txt_end_time))
	{
		Func_comm_class::adminshowmessage("结束时间不能小于发布时间","index.php?do=model&model_id=$model_id&view=edit&task_id=$task_id");
	}
	if (strtotime($txt_end_time)<time('now()'))
	{
		Func_comm_class::adminshowmessage("结束时间不能小于当前时间","index.php?do=model&model_id=$model_id&view=edit&task_id=$task_id");
	}
	if (!$slt_indus_id)
	{
		Func_comm_class::adminshowmessage("必须选择一个行业","index.php?do=model&model_id=$model_id&view=edit&task_id=$task_id");
	}
	
	if ($task_info['task_status']==6)
	{
		$work_obj ->setWhere("task_id='$task_id'");
		$work_obj->setWork_status(0);
		$work_obj->edit_keke_witkey_work();
		if ($works_status5)
		{
			$work_obj ->setWhere("work_id in ($works_status5)");
			$work_obj->setWork_status(5);
			$work_obj->edit_keke_witkey_work();
		}
		if ($works_status6)
		{
			$work_obj ->setWhere("work_id in ($works_status6)");
			$work_obj->setWork_status(6);
			$work_obj->edit_keke_witkey_work();
		}
		if ($works_status1)
		{
			$work_obj ->setWhere("work_id in ($works_status1)");
			$work_obj->setWork_status(1);
			$work_obj->edit_keke_witkey_work();
		}
		if ($works_status2)
		{
			$work_obj ->setWhere("work_id in ($works_status2)");
			$work_obj->setWork_status(2);
			$work_obj->edit_keke_witkey_work();
		}
		if ($works_status3)
		{
			$work_obj ->setWhere("work_id in ($works_status3)");
			$work_obj->setWork_status(3);
			$work_obj->edit_keke_witkey_work();
		}
		if ($work_status4)
		{
			$work_obj ->setWhere("work_id = $work_status4");
			$work_obj->setWork_status(4);
			$work_obj->edit_keke_witkey_work();
		}
	}
	
	

	$task_obj->setTask_title($txt_task_title);
	$task_obj->setIndus_id($slt_indus_id);
	$task_obj->setIstop($rdo_istop);
	$find ='src=\"../../data/';
	$replase = 'src=\"data/';
	$txt_task_desc =  str_ireplace ( $find, $replase, $txt_task_desc );
	$task_obj->setTask_desc($txt_task_desc);
	$task_obj->setTask_cash($txt_task_cash);
	$task_obj->setProm_cash($txt_prom_cash);
	$task_obj->setStart_time(strtotime("$txt_start_time"));
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
	
	Func_comm_class::notify_user('任务编辑提示','管理员'.$myinfo_arr['username'].'<b>编辑了您的任务<b>'.$task_info['task_title'].'(id'.$task_id.') 。',$task_info['uid'],$task_info['username']);
	
	$task_obj->edit_keke_witkey_task();
	Func_comm_class::adminSystemLog("编辑任务$txt_task_title");
	Func_comm_class::adminshowmessage("任务编辑成功","index.php?do=model&model_id=$model_id&view=list");
}

 
$indus_arr = Cache_ext_Class::getIndustryList();


sort($indus_arr);
function dafenglei_select($m,$id,$index){	
	global $indus_arr;
	
	$n = str_pad('',$m,'-',STR_PAD_RIGHT);
	$n = str_replace("-","&nbsp;&nbsp;",$n);
	
	for($i=0;$i<count($indus_arr);$i++){
		if($indus_arr[$i]['indus_pid']==$id){
			if($indus_arr[$i]['indus_id']==$index){
				echo "        <option value=\"".$indus_arr[$i]['indus_id']."\" selected=\"selected\">".$n."|----".$indus_arr[$i]['indus_name']."</option>\n";
			}else{
				echo "        <option value=\"".$indus_arr[$i]['indus_id']."\">".$n."|--".$indus_arr[$i]['indus_name']."</option>\n";
			}
			dafenglei_select($m+1,$indus_arr[$i]['indus_id'],$index);
		}
		
	}
}

require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/control/admin/tpl/model_' . $view );