<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

if($uid){
	Func_comm_class::showmessage('您已经属于登录在线状态！','index.php',2,'您已经属于登录在线状态！','error');
}
setcookie('kekerefer',$_K['refer'],time()+20*60);
if (isset($_POST['login_submit'])){
	$username = $_POST['txt_username'];
	$pwd = $_POST['pwd_password'];

	$user_arr = Syn_interface_class::user_login($username,$pwd);
	
	if(!$user_arr){
		Func_comm_class::showmessage('登录失败！','index.php?do=login',2,'登录失败，您输入的用户名或密码错误请重新登录','error');
	}else{
		$user_info  = Func_comm_class::getuserinfo($user_arr[0]);
		
		
		if($user_info[status]==2){
			Func_comm_class::showmessage('登录失败！','index.php',2,'帐户已经冻结','error');
		}else{
		$_SESSION['uid']=$user_info['uid'];
		$_SESSION['username']=$user_info['username'];
		
		if($ckb_cookie){
			$login_arr = array($user_info['uid']=>$user_info['username']);
			$c_v = Encrypt_Class::encode(serialize($login_arr));
			setcookie("user_login", $c_v,3600*24);
		}
	
		Func_comm_class::prom_check();
		if(isset($_COOKIE['kekerefer'])){
			$r = $_COOKIE['kekerefer'];
			setcookie('kekerefer','');
		}else{
			$r = 'index.php';
		}
		
		$synhtml = Syn_interface_class::user_synlogin($user_info['uid']);
		
		Func_comm_class::update_score_value($user_info['uid'],'login',3);
		$user_obj = new Keke_witkey_space_class();
		$user_obj->setLast_login_time(time());
		$user_obj->setWhere( "uid = '{$user_info['uid']}'");
		$user_obj->edit_keke_witkey_space();
		
		Func_comm_class::showmessage('登录成功！',$r,1,'恭喜您，登录成功！'.$synhtml);
		}
	}
}

$title = "用户登录";
require_once  $template_obj->template ( $do );