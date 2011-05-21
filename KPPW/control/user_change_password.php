<?php


if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

if ($is_submit)
{
	$user_info = Func_comm_class::getuserinfo($uid);
	if ($basic_config['user_intergration'] != "2"&&$pwd_oldpwd == $pwd_newpwd1)
	{
		Func_comm_class::showmessage("修改密码失败",'index.php?do=user&view=change_password',3,"新旧密码一样,轻重新输入",'error');
	}
	elseif ($basic_config['user_intergration'] != "2"&&md5($pwd_oldpwd)!=$user_info['password']){
		Func_comm_class::showmessage("修改密码失败",'index.php?do=user&view=change_password',3,"旧密码错误",'error');
	}
	elseif ($pwd_newpwd1!=$pwd_newpwd2)
	{
		Func_comm_class::showmessage("修改密码失败",'index.php?do=user&view=change_password',3,"两次密码输入不一致",'error');
	}

	$message_obj = new Message_Class();
	if ($message_obj->validate('update_password_isnotice')){
		$message_obj->setUid($user_info['uid']);
		$message_obj->setUsername($user_info['username']);
		$message_obj->setTitle('密码修改成功');
		$message_obj->setValue('新密码',$pwd_newpwd1);
		$message_obj->send();
	}
	
	$user_obj = new Keke_witkey_space_class();
	$user_obj->setWhere("uid='$uid'");
	$user_obj->setPassword(md5($pwd_newpwd1));
	$user_obj->edit_keke_witkey_space();
	$member_obj = new Keke_witkey_member_class();
	$member_obj->setWhere("uid='$uid'");
	$member_obj->setPassword(md5($pwd_newpwd1));
	$res = $member_obj->edit_keke_witkey_member();
	
	$flag = Syn_interface_class::user_edit($username,$pwd_oldpwd,$pwd_newpwd1,'',0)>0?1:0;
	$flag&&$res==1?Func_comm_class::showmessage("操作提示",'index.php?do=user&view=change_password',3,"密码已经修改成功"):Func_comm_class::showmessage("修改密码失败",'index.php?do=user&view=change_password',0,"",'error');
}

require_once  $template_obj->template ($do."_".$view);