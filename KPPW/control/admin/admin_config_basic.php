<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(1);

$config_basic_obj = new Keke_witkey_basic_config_class ();

$config_basic_obj->setWhere ( " 1 limit 1" );
$config_basic_arr = $config_basic_obj->query_keke_witkey_basic_config ();
extract ( $config_basic_arr [0] );

$ops = array('info','conf');
$op = in_array($op,$ops)?$op:"info";


if (isset ( $submit )) {
	$config_basic_obj->setBasic_config_id ( $basic_config_id );
	if($op=='info'){
		$config_basic_obj->setWebsite_name ( $txt_website_name );
		$config_basic_obj->setWebsite_url ( $txt_website_url );
		$config_basic_obj->setInstall_path ( $txt_install_path );
		$config_basic_obj->setWebsite_title ( $txt_website_title );
		$config_basic_obj->setWeb_logo($fle_web_logo);
		$config_basic_obj->setCompany ( $txt_company );
		$config_basic_obj->setAddress ( $txt_address );
		$config_basic_obj->setPhone ( $txt_phone );
		$config_basic_obj->setKf_phone($txt_kf_phone);
		$config_basic_obj->setPostcode ( $txt_post );
		$config_basic_obj->setFiling ( $txt_filing );
		$config_basic_obj->setIs_close ( $txt_is_close );
		$config_basic_obj->setClose_reason ( $txt_close_reason );
		$config_basic_obj->setStats_code ( $txt_stats_code );
	}else{
		$config_basic_obj->setIs_rewrite(intval($ckb_is_rewrite));
		$config_basic_obj->setSeo_title ( $txt_seo_title );
		$config_basic_obj->setSeo_keyword ( $txt_seo_keyword );
		$config_basic_obj->setSeo_desc ( $txt_seo_desc );
		$config_basic_obj->setMax_size ( $txt_max_size );
		$config_basic_obj->setFile_type ( $txt_file_type );
		$config_basic_obj->setBan_users ( $txt_ban_users );
		$config_basic_obj->setBan_content ( $txt_ban_content );
		$config_basic_obj->setReg_limit ( $txt_reg_limit );
		$config_basic_obj->setOn_time ( time () );
		$config_basic_obj->setMail_server_cat ( $rdo_mail_server_cat );
		$config_basic_obj->setMail_ssl ( $rdo_mail_ssl );
		$config_basic_obj->setSmtp_url ( $txt_smtp_url );
		$config_basic_obj->setMail_server_port ( $txt_mail_server_port );
		$config_basic_obj->setPost_account ( $txt_post_account );
		$config_basic_obj->setAccount_pwd ( $txt_account_pwd );
		$config_basic_obj->setMail_replay ( $txt_mail_replay );
		$config_basic_obj->setMail_charset ( $rdo_mail_charset );
		$config_basic_obj->setCredit_is_allow($rdo_credit_is_allow);
	}
	

	
	if ($basic_config_id) {
		$flag = $config_basic_obj->edit_keke_witkey_basic_config ();
		$config_basic_obj->setWhere(" 1 limit 1");
		$config_basic_arr = $config_basic_obj->query_keke_witkey_basic_config();
		if ($flag) {
			Cache::write($config_basic_arr,"keke_witkey_basic_config");
			Func_comm_class::adminSystemLog("修改系统基本配置");
			Func_comm_class::adminshowmessage ( "系统基本配置保存成功！", "index.php?do=config&view=basic&op=".$op );
		} else {
			Func_comm_class::adminshowmessage ( "系统基本配置保存失败！", "index.php?do=config&view=basic&op=".$op );
		}
	
	} else {
		$flag = $config_basic_obj->create_keke_witkey_basic_config ();
		$config_basic_obj->setWhere(" 1 limit 1");
		$config_basic_arr = $config_basic_obj->query_keke_witkey_basic_config();
		if ($flag) {
			Cache::write($config_basic_arr,"keke_witkey_basic_config");
			Func_comm_class::adminshowmessage ( "系统基本配置添加成功！", "index.php?do=config&view=basic&op=".$op );
		} else {
			Func_comm_class::adminshowmessage ( "系统基本配置添加失败！", "index.php?do=config&view=basic&op=".$op);
		}
	
	}
}

require_once $template_obj->template ( 'control/admin/tpl/admin_config_' . $view );