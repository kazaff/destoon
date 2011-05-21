<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}


if ($view == 'notice')
{
	$title = '服务条款';
	require_once  $template_obj->template ('register_notice');
	die();
}

$basic_config = Cache_ext_Class::getConfig('basic');


if(isset($check_email) && !empty($check_email)){
	Func_comm_class::echojson('',Syn_interface_class::user_checkemail($check_email));
}

if(isset($check_username) && !empty($check_username)){
	if (strtolower($_K['charset'])!='UTF-8')
	{
		$check_username = Func_comm_class::utftogbk($check_username);
	}
	$check_username = strtolower($check_username);
    if(Func_comm_class::k_strpos($check_username))
    {   
    	Func_comm_class::echojson('',2);
    }else{
    	
    Func_comm_class::echojson('',Syn_interface_class::user_checkname($check_username));
    	
   }
}
if(isset($txt_username) && !empty($txt_username)){
    
	$img = new Secode_class();
	$res_code =$img->check($code);

	if(!$res_code){
		Func_comm_class::showmessage('注册失败，验证码输入有误！','index.php?do=register',2,'验证码输入有误，请重新输入','error');
	}
	
	$basic_config_info = Cache_ext_Class::getConfig('basic');
	
	
	$limit_username = Syn_interface_class::user_getprotected();
	
	if($limit_username&&in_array($txt_username,$limit_username)){
		Func_comm_class::showmessage('注册失败，用户名限制注册！','index.php?do=register',2,'对不起，您输入的用户名限制注册，请重新输入','error');
	}
	
	
	if($basic_config_info['reg_limit']){
		$space_obj = new Keke_witkey_space_class();
		$space_obj->setWhere(' reg_ip="'.$_SERVER["REMOTE_ADDR"].'" order by uid desc ');
		$has_reg_user = $space_obj->query_keke_witkey_space();
		
		if(time()-$has_reg_user[0][reg_time]<$basic_config_info['reg_limit']*60){
			Func_comm_class::showmessage('注册失败！','index.php?do=register',2,'对不起，同一IP用户'.$basic_config_info['reg_limit'].'分钟内只能注册一次！','error');
		}
	}
	
	

	$member_info = Syn_interface_class::user_register($txt_username,$pwd_password,$txt_email);
	if ($member_info){
		$_SESSION['uid']=$member_info['uid'];
		$_SESSION['username']=$member_info['username'];
		
		$message_obj = new Message_Class();
		if ($message_obj->validate('reg_isnotice')){
			$message_obj->setUid($member_info['uid']);
			$message_obj->setUsername($member_info['username']);
			$message_obj->setEmail($member_info[email]);
			$message_obj->setTitle('注册成功');
			$message_obj->send();
		}
		Func_comm_class::prom_check();
		if(isset($_COOKIE['kekerefer2'])){
			$r = $_COOKIE['kekerefer2'];
			setcookie('kekerefer2','');
		}else{
			$r = 'index.php';
		}
		
		$synhtml = Syn_interface_class::user_synlogin($member_info['uid']);
		Func_comm_class::update_score_value($member_info['uid'],'register',1);
		Func_comm_class::showmessage('注册成功！',$r,2,'恭喜您，注册成功！'.$synhtml);
	}
	else {
		Func_comm_class::showmessage('注册失败，请重新操作！','index.php',3,'','error');
	}
	
}




require_once  $template_obj->template ( $do );
