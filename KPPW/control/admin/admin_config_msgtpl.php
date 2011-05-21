<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}
$msg_temp_obj = new Keke_witkey_message_template_class ();

if (isset ( $msg_temp_id )) {
	if ($msg_temp_id) {
		$msg_temp_obj->setWhere ( "msg_temp_type = '$msg_temp_id'" );
		$msg_temp_arr = $msg_temp_obj->query_keke_witkey_message_template ();
		if (count ( $msg_temp_arr )) {
			Func_comm_class::echojson ( '', 1, $msg_temp_arr [0] );
		} else {
			echo json_encode ( array ("status" => 0 ) );
		}
	}
}

if(isset($sbt_edit))
{
	$msg_temp_obj->setMsg_temp_content($tar_msg_temp_content);
	
	if($slt_msg_temp_type)
	{
		$msg_temp_obj->setWhere("msg_temp_type='{$slt_msg_temp_type}'");
		$msg_temp_obj->edit_keke_witkey_message_template();
		Func_comm_class::adminSystemLog("修改短信模板");
		Func_comm_class::adminshowmessage("模板修改成功",'index.php?do=config&view=msgtpl&slt_msg_temp_type='.$slt_msg_temp_type);
	}
	else
	{
		$msg_temp_obj->create_keke_witkey_message_template();
		Func_comm_class::adminshowmessage("模板保存成功",'index.php?do=config&view=msgtpl&slt_msg_temp_type='.$slt_msg_temp_type);
	}
}

$msg_tpl_obj = new Keke_witkey_message_template_class();
$msg_tpl_obj->setWhere("msg_temp_type='{$slt_msg_temp_type}'");
$msg_tpl = $msg_tpl_obj->query_keke_witkey_message_template();
$msg_tpl = $msg_tpl[0]['msg_temp_content'];

require_once $template_obj->template ( 'control/admin/tpl/admin_config_' . $view );