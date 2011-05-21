<?php



if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

if (!$msg_id)
{
	Func_comm_class::showmessage("错误的参数","index.php",3,"",'error');
}
$msg_obj = new Keke_witkey_message_class();
$msg_obj->setWhere("msg_id = '$msg_id'");
$msg = $msg_obj->query_keke_witkey_message();
$msg = $msg[0];
if ($msg['uid']!=$uid&&$msg['recive_uid']!=$uid)
{
	Func_comm_class::showmessage("该消息不存在或不属于你。","index.php",3,"","error");
}


if ($op == 'del')
{
	$msg_obj->setWhere("msg_id = '$msg_id'");
	if ($uid==$msg['uid']){
		if ($msg['msg_status']!=1)
		{
			$msg_obj->setMsg_status(2);
			$msg_obj->edit_keke_witkey_message();
		}
		else {
			$msg_obj->del_keke_witkey_message();
		}
	}
	else if($uid==$msg['recive_uid'])
	{
		if ($msg['uid']==0)
		{
			$msg_obj->del_keke_witkey_message();
		}
		elseif ($msg['msg_status']!=2)
		{
			$msg_obj->setMsg_status(1);
			$msg_obj->edit_keke_witkey_message();
		}
		else {
			$msg_obj->del_keke_witkey_message();
		}
	}
	Func_comm_class::showmessage("删除成功",'index.php?do=user&view=message_list');
}


if ($uid==$msg['recive_uid']&&!$msg['view_status'])
{
	$msg_obj->setWhere("msg_id = '$msg_id'");
	$msg_obj->setView_status(1);
	$msg_obj->edit_keke_witkey_message();
}

require_once  $template_obj->template ($do."_".$view);