<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$title = '发送短信';

$msg_obj = new Keke_witkey_message_class();//实例化站内短信对象

$space_obj = new Keke_witkey_space_class();//实例化用户空间信息


if(isset($sbt_msg)){
	if (!trim($txt_title)||!trim($tar_content))
	{
		Func_comm_class::showmessage('站内短信发送失败！',$_SERVER['HTTP_REFERER'],"您必须输入标题和内容",'error');
	}
	
	$space_obj->setWhere('uid='.intval($hdn_to_uid));
	$space_info = $space_obj->query_keke_witkey_space();
	if(intval($hdn_pid)){
		$msg_obj->setMsg_pid($hid_pid);
	}
	$msg_obj->setUid($uid);
	$msg_obj->setUsername($username);
	$msg_obj->setRecive_uid($hdn_to_uid);
	$msg_obj->setRecive_username($space_info[0][username]);
	$msg_obj->setTitle(Func_comm_class::str_filter($txt_title));
	$msg_obj->setContent(Func_comm_class::str_filter($tar_content));
	$msg_obj->setOn_time(time());
	$res = $msg_obj->create_keke_witkey_message();
	if($res){
		Func_comm_class::showmessage('站内短信发送成功！',$hdn_task_id?'index.php?do=task&task_id='.$hdn_task_id:$_SERVER['HTTP_REFERER'],2,'站内短信已成功发送给'.$space_info[0][username]);
	}else{
		Func_comm_class::showmessage('站内短信发送失败！',$hdn_task_id?'index.php?do=task&task_id='.$hdn_task_id:$_SERVER['HTTP_REFERER'],2,'站内短信发送失败','error');
	}
}

require_once  $template_obj->template ( $do );