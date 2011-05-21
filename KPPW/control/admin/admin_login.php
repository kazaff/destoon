<?php

if ($_SESSION['uid']&&$_SESSION['auid'])
{
	Func_comm_class::adminshowmessage('您已登陆','index.php');
}

if ($_POST['is_submit'])
{
	$username = $_POST['txt_username'];
	$pwd = $_POST['pwd_pwd'];
	
	$user_arr = Syn_interface_class::user_login($username,$pwd);
	if(!$user_arr){
		Func_comm_class::adminshowmessage('登录失败！','index.php?do=login');
	}else{
		$user_arr  = Func_comm_class::getuserinfo($user_arr[0]);
	}

	if (!$user_arr){
		Func_comm_class::adminshowmessage('您没有管理权限','index.php?do=login');
	}
	else if (!$user_arr['group_id']&&$user_arr['uid']!=ADMIN_UID)
	{
		Func_comm_class::adminshowmessage('您没有管理权限','index.php?do=login');
	}
	else {
		$_SESSION['auid'] = $_SESSION['uid']=$user_arr['uid'];
		$_SESSION['username']=$user_arr['username'];
		Func_comm_class::adminSystemLog($user_arr['username'].date('Y-m-d H:i:s',time())."登陆系统");
		Func_comm_class::adminshowmessage('登陆成功','index.php');
	}
	
}
else {
	require_once $template_obj->template('control/admin/tpl/admin_'.$do);
}



?>