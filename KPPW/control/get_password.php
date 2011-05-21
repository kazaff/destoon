<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$basic_config = Cache_ext_Class::getConfig('basic');

if (isset($_POST['sbt_get_password'])){
	
	$img = new Secode_class();
	 
	$res_code =$img->check($code);
	
	if(!$res_code){
		Func_comm_class::showmessage('找回密码失败，验证码输入有误！','index.php?do=get_password',2,'验证码输入有误，请重新输入','error');
	}
	
	$username = $_POST['txt_username'];
	$email = $_POST['txt_email'];
	
	$member_obj = new Keke_witkey_member_class();
	$member_obj->setWhere("username='$username' and email = '$email'");
	$user_arr =  $member_obj->query_keke_witkey_member();
	$user_arr = $user_arr[0];
	
	if(!$user_arr){
		Func_comm_class::showmessage('找回密码失败！','index.php?do=get_password',2,'找回密码失败，您输入的用户名和邮箱不匹配，请重试','error');
	}else{
		
		$member_obj->setWhere('uid='.$user_arr[uid]);
		
		$new_password = Func_comm_class::randomkeys(6);
		
		$password = md5($new_password);
		
		$member_obj->setPassword($password);
		$member_obj->edit_keke_witkey_member();
		
		$space_obj = new Keke_witkey_space_class();
		
		$space_obj->setWhere('uid='.$user_arr[uid]);
		$space_obj->setPassword($password);
		$space_obj->edit_keke_witkey_space();
		
		$address = $user_arr[email];
		$title = '客客--威客系统密码找回';
		$body = '
		客客--威客系统密码找回
		<p>
		欢迎<font color="red">'.$user_arr[username].'</font>进入客客-威客系统的密码找回功能，您的新密码为<font color="red">'.$new_password.'</font>
		</p>
		';
		
		if ($basic_config['user_intergration']==2){
			Syn_interface_class::user_edit($username,'',$new_password,$email);
		}
		
		$res = Func_comm_class::sendMail($user_arr[email],$title,$body);
		
		if($res){
			Func_comm_class::showmessage('找回密码成功！','index.php',2,'恭喜您，找回密码成功，新密码已经发送到您的邮箱，请及时接收！');
		}else{
			Func_comm_class::showmessage('找回密码失败！','index.php',2,'找回密码邮件发送失败，请重试！','error');
		}
		
		
	}
}

require_once  $template_obj->template ( $do );