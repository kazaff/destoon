<?php



$msg_obj = new Keke_witkey_message_class();//实例化站内短信对象

$space_obj = new Keke_witkey_space_class();//实例化用户空间信息


if(isset($sbt_msg)){
	$space_obj->setWhere(' username ="'.$txt_to_username.'"');
	$space_info = $space_obj->query_keke_witkey_space();
	if(!$space_info){
		Func_comm_class::showmessage('站内短信发送失败！','index.php?do='.$do.'&view='.$view,2,'您填写的用户不存在','error');
	}elseif ($space_info[0][uid]==$uid){
		Func_comm_class::showmessage('站内短信发送失败！','index.php?do='.$do.'&view='.$view,2,'不能给自己发送短信','error');
	}
	
	if(intval($hdn_pid)){
		$msg_obj->setMsg_pid($hid_pid);
	}
	$msg_obj->setUid($uid);
	$msg_obj->setUsername($username);
	$msg_obj->setRecive_uid($space_info[0][uid]);
	$msg_obj->setRecive_username($space_info[0][username]);
	if(!$txt_title){
		Func_comm_class::showmessage('站内短信发送失败！','index.php?do='.$do.'&view='.$view,2,'请填写标题','error');
	}
	$msg_obj->setTitle(Func_comm_class::str_filter($txt_title));
	if(!$tar_content){
		Func_comm_class::showmessage('站内短信发送失败！','index.php?do='.$do.'&view='.$view,2,'请填写内容','error');
	}
	$msg_obj->setContent(Func_comm_class::str_filter($tar_content));
	$msg_obj->setOn_time(time());
	$res = $msg_obj->create_keke_witkey_message();
	if($res){
		Func_comm_class::showmessage('站内短信发送成功！','index.php?do='.$do.'&view='.$view,2,'站内短信已成功发送给'.$space_info[0][username]);
	}else{
		Func_comm_class::showmessage('站内短信发送失败！','index.php?do='.$do.'&view='.$view,2,'站内短信发送失败','error');
	}
}



require_once  $template_obj->template ($do."_".$view);