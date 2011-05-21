<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

$case_obj = new Keke_witkey_case_class ( );
$task_obj=new Keke_witkey_task_class();
$upload_obj = new Upload_Class ( UPLOAD_ROOT, array ("gif", 'jpeg', 'jpg', 'png' ), UPLOAD_MAXSIZE );


if ($case_id) {
	$case_obj->setWhere ( 'case_id=' . intval ( $case_id ) );
	$case_info = $case_obj->query_keke_witkey_case();
	$case_info = $case_info [0];
}

if ($txt_task_id){
	$task_obj->setWhere("task_id = '$txt_task_id' ");
	$case_info = $task_obj->query_keke_witkey_task();
	$case_info = $case_info[0];
}
if($ajax ==1 && $id){
	$task_obj->setWhere("task_id = '$id' ");
	$task_info = $task_obj->query_keke_witkey_task();
	$task_info = $task_info[0];
	Func_comm_class::echojson('',1,$task_info);
}



if (isset ( $sbt_edit )) {

	
	$case_obj->setObj_id ( $txt_task_id );
	$case_obj->setObj_type ( 'task' );
	$case_obj->setCase_auther ( $txt_case_auther );
	$case_obj->setCase_price ( $txt_case_price );
	$case_obj->setCase_desc ( $tar_case_desc );
	$case_obj->setCase_title($txt_task_title);
	$case_obj->setOn_time (time());
	$files = $upload_obj->run ( 'fle_case_img', 1 );
	if ($files != 'The uploaded file is Unallowable!') {
	
		$case_img = $files [0] ['saveName'];
		if ($case_img) {
			$case_img = "data/uploads/".UPLOAD_RULE. $case_img;
			$case_obj->setCase_img ( $case_img );
		}
	}
	

	if ($hdn_case_id) {
		$case_obj->setCase_id ( $hdn_case_id );
		
		
		$res = $case_obj->edit_keke_witkey_case ();
		if ($res) {
			Func_comm_class::adminshowmessage ( '修改案例成功', 'index.php?do=case&view=list' );
		} else {
			Func_comm_class::adminshowmessage ( '修改案例失败', 'index.php?do=case&view=list' );
		}
	} else {
		
		
		$sql="select count(*) as c  from ".TABLEPRE."witkey_case where obj_id='$txt_task_id' ";
		$a=db_factory::query($sql);
		$a=$a[0][c];
		if(!$a)
		{
					$res = $case_obj->create_keke_witkey_case ();
			
		}
		else{
				Func_comm_class::adminshowmessage ( '案例已经存在，不可重复添加', 'index.php?do=case&view=list' );
		}
		if ($res) {
			Func_comm_class::adminshowmessage ( '添加案例成功', 'index.php?do=case&view=list' );
		} else {
			Func_comm_class::adminshowmessage ( '添加案例失败', 'index.php?do=case&view=list' );
		}
	
	}

}

require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do . '_' . $view );