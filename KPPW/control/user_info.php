<?php

if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

$skill_arr = Cache_ext_Class::getSkillList();
$skill_indus_arr = array();
if ($indusskill)
{
	$title = "选择技能";
	foreach ($skill_arr as $s)
	{
		if ($s['indus_id']==$indusskill)
		{
			$skill_indus_arr[]=$s;
		}
	}

	require_once  $template_obj->template('skill');
	die();
}
$user_obj = new Keke_witkey_space_class();
$user_info = Func_comm_class::getuserinfo($uid);
$user_info['residency'] = explode(',',$user_info['residency']);
$user_info['skill_ids'] = explode(',',$user_info['skill_ids']);
if ($is_submit)
{
	if ($_FILES['user_pic']['name']){$pic_name = Func_comm_class::uploaduserpic("user_pic",$uid);}
	
	if (!$slt_indus_id)
	{
		Func_comm_class::showmessage("请选择一个行业","index.php?do=user&view=info",3,'','error');
	}
	$rdo_sex?$user_obj->setSex($rdo_sex):"";
	if($user_info[realname_auth]!=1){
		$user_obj->setTruename($txt_truename);
	}
	$txt_birthday=$txt_birthday?Func_comm_class::sstrtotime($txt_birthday):'';
	$txt_birthday?$user_obj->setBirthday($txt_birthday):'';
	$user_obj->setResidency($slt_province.",".$slt_city);
	$user_obj->setIndus_id($slt_indus_id);
	$user_obj->setSkill_ids($hd_skill_ids);
	$user_obj->setSummary($are_summary);
	if($user_info[enterprise_auth]!=1){
		$user_obj->setExperience($are_experience);
	}
	if($user_info[realname_auth]!=1){
		$user_obj->setTruename($txt_truename);
	}
	if($user_info[email_auth]!=1){
		$user_obj->setEmail($txt_email);
	}
	$user_obj->setQq($txt_qq);
	$user_obj->setMsn($txt_msn);
	$user_obj->setPhone($txt_phone);
	$user_obj->setMobile($txt_mobile);
	$user_obj->setFax($txt_fax);
	$user_obj->setPay_zfb($txt_pay_zfb);
	$user_obj->setPay_cft($txt_pay_cft);
	$user_obj->setPay_bank($txt_pay_bank);
	if($txt_pay_zfb||$txt_pay_cft){
		Func_comm_class::update_score_value($uid,'edit_withdrawinfo',1);
	}
	$user_obj->setWhere("uid = '$uid' ");
	$user_obj->edit_keke_witkey_space();
	
	Func_comm_class::showmessage("","index.php?do={$do}&view={$view}",2,"修改个人资料成功！");
}


$config_basic_obj = new Keke_witkey_basic_config_class ();
$config_basic_obj->setWhere ( " 1 limit 1" );
$config_basic_arr = $config_basic_obj->query_keke_witkey_basic_config ();
$config_basic_arr=$config_basic_arr[0];

$indus_arr = Cache_ext_Class::getIndustryList(1);

require_once  $template_obj->template ($do."_".$view);