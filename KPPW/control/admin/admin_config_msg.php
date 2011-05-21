<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(44);

$config_msg_obj = new Keke_witkey_message_config_class ();
$config_msg_obj->setWhere ( " 1 limit 1 " );
$config_msg_arr = $config_msg_obj->query_keke_witkey_message_config ();
if(count($config_msg_arr))
{
	extract ( $config_msg_arr[0] );
	
}

if (isset ( $sbt_edit )) {
	$config_msg_obj->setMsg_cofig_id ( $hdn_msg_config_id );
	$config_msg_obj->setReg_isnotice ( $rdo_reg_isnotice );
	$config_msg_obj->setTask_pub_isnotice ( $rdo_task_pub_isnotice );
	$config_msg_obj->setTender_isnotice ( $rdo_tender_isnotice );
	$config_msg_obj->setPay_success_isnotice ( $rdo_pay_success_isnotice );
	$config_msg_obj->setPay_fail_isnotice ( $rdo_pay_fail_isnotice );
	$config_msg_obj->setTask_auth_fail_isnotice ( $rdo_task_auth_fail_isnotice );
	$config_msg_obj->setUser_auth_success_isnotice ( $rdo_user_auth_success_isnotice );
	$config_msg_obj->setUser_auth_fail_isnotice ( $rdo_user_auth_fail_isnotice );
	$config_msg_obj->setDraw_success_isnotice( $rdo_draw_isnotice );
	$config_msg_obj->setFreeze_isnotice ( $rdo_freeze_isnotice );
	$config_msg_obj->setTask_freeze_isnotice($rdo_task_freeze_isnotice);
	$config_msg_obj->setUpdate_password_isnotice ( $rdo_update_password_isnotice );
	$config_msg_obj->setMsg_send_type ( $rdo_msg_send_type );
	$config_msg_obj->setOn_time ( time () );
	if ($hdn_msg_config_id) {
		$res = $config_msg_obj->edit_keke_witkey_message_config ();
		$config_msg_obj->setWhere ( "1 limit 1" );
		$config_msg_arr = $config_msg_obj->query_keke_witkey_message_config ();
		
		if ($res) {
			Cache::delete ( "keke_witkey_message_config" );
			Cache::write ( $config_msg_arr, "keke_witkey_message_config" );
			Func_comm_class::adminSystemLog("修改站内短信配置");
			Func_comm_class::adminshowmessage ( "站内短信发送配置修改成功！", "index.php?do=config&view=msg" );
		}
	} else {
		$config_msg_obj->setMsg_cofig_id ( null );
		$res = $config_msg_obj->create_keke_witkey_message_config ();
		$config_msg_obj->setWhere ( "1 limit 1" );
		$config_msg_arr = $config_msg_obj->query_keke_witkey_message_config ();
		
		if ($res) {
			
			Cache::write ( $config_msg_arr, "keke_witkey_message_config" );
			Func_comm_class::adminshowmessage ( "站内短信发送配置保存成功！", "index.php?do=config&view=msg" );
		}
	}

}



require_once $template_obj->template ( 'control/admin/tpl/admin_config_' . $view );