<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}
Func_comm_class::adminCheckRole(41);
$config_basic_obj = new Keke_witkey_basic_config_class ();

$config_basic_obj->setWhere ( " 1 limit 1" );
$config_basic_arr = $config_basic_obj->query_keke_witkey_basic_config ();
extract ( $config_basic_arr [0] );


if (isset ( $submit )) {
	
	$config_basic_obj->setBasic_config_id ( $basic_config_id );
	$config_basic_obj->setMail_server_cat ( $rdo_mail_server_cat );
	$config_basic_obj->setMail_ssl ( $rdo_mail_ssl );
	$config_basic_obj->setSmtp_url ( $txt_smtp_url );
	$config_basic_obj->setMail_server_port ( $txt_mail_server_port );
	$config_basic_obj->setPost_account ( $txt_post_account );
	$config_basic_obj->setAccount_pwd ( $txt_account_pwd );
	$config_basic_obj->setMail_replay ( $txt_mail_replay );
	$config_basic_obj->setMail_charset ( $rdo_mail_charset );
	
	if ($basic_config_id) {
		$flag = $config_basic_obj->edit_keke_witkey_basic_config ();
		$config_basic_obj->setWhere(" 1 limit 1");
		$config_basic_arr = $config_basic_obj->query_keke_witkey_basic_config();
		if ($flag) {
			Func_comm_class::adminSystemLog("修改邮件配置");
			Cache::delete("keke_witkey_basic_config");
			Cache::write($config_basic_arr,"keke_witkey_basic_config");
			Func_comm_class::adminshowmessage ( "邮件配置保存成功！", "index.php?do=config&view=mail" );
		} else {
			Func_comm_class::adminshowmessage ( "邮件配置保存失败！", "index.php?do=config&view=mail" );
		}
	
	} else {
		
		$flag = $config_basic_obj->create_keke_witkey_basic_config ();
		
		if ($flag) {
			Func_comm_class::adminshowmessage ( "邮件配置添加成功！", "index.php?do=config&view=mail" );
		} else {
			Func_comm_class::adminshowmessage ( "邮件配置添加失败！", "index.php?do=config&view=mail" );
		}
	
	}
}






if (isset ( $email )) {
	$mail = new Phpmailer_class ();
	if ($mail_server_cat == "smtp") {
		$mail->IsSMTP ();
		$mail->SMTPAuth = true;
		$mail->CharSet = ($_K['charset']);
		
		$mail->Host = $smtp_url;
		$mail->Port = $mail_server_port;
		$mail->Username = $post_account;
		$mail->Password = $account_pwd;
	
	} else {
		$mail->IsMail();
	}

	$mail->SetFrom ( $post_account, $website_name );
	
	$mail->AddReplyTo ( $mail_replay, $website_name);
	
	$mail->Subject = "客客威客信息测试邮件";
	
	$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$body = "测试邮件发送成功 ！";
	$mail->MsgHTML ( $body );
	
	$address = $email;
	$mail->AddAddress ( $address, $website_name );
	
	if (! $mail->Send ()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message sent!";
	}
	die();
}

require_once $template_obj->template ( 'control/admin/tpl/admin_config_' . $view );