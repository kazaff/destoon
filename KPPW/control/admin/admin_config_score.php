<?php

if(!defined('ADMIN_KEKE')) {
	exit('Access Denied');
}


$score_rule = Cache_ext_Class::gettabledata("witkey_score_rule","","max_score",null);
$score_config = Cache_ext_Class::getConfig('score');

$m = $m?$m:"config";

if (isset($submit)){
	

	$score_config_obj = new Keke_witkey_score_config_class();
	$txt_login?$score_config_obj->setLogin($txt_login):"";
	$txt_register?$score_config_obj->setRegister($txt_register):"";
	$txt_update_pic?$score_config_obj->setUpdate_pic($txt_update_pic):"";
	$txt_edit_userinfo?$score_config_obj->setEdit_userinfo($txt_edit_userinfo):"";
	$txt_edit_withdrawinfo?$score_config_obj->setEdit_withdrawinfo($txt_edit_withdrawinfo):"";
	$txt_buy_vip?$score_config_obj->setBuy_vip($txt_buy_vip):"";
	$txt_online_pay?$score_config_obj->setOnline_pay($txt_online_pay):"";
	$txt_withdraw?$score_config_obj->setWithdraw($txt_withdraw):"";
	$txt_pub_task?$score_config_obj->setPub_task($txt_pub_task):"";
	$txt_view_task?$score_config_obj->setView_task($txt_view_task):"";
	$txt_collect_task?$score_config_obj->setCollect_task($txt_collect_task):"";
	$txt_task_comment?$score_config_obj->setTask_comment($txt_task_comment):"";
	$txt_task_apply?$score_config_obj->setTask_apply($txt_task_apply):"";
	$txt_task_pubwork?$score_config_obj->setTask_pubwork($txt_task_pubwork):"";
	$txt_task_bid?$score_config_obj->setTask_bid($txt_task_bid):"";
	$txt_work_accept?$score_config_obj->setWork_accept($txt_work_accept):"";
	$txt_view_space?$score_config_obj->setView_space($txt_view_space):"";
	$txt_user_mark?$score_config_obj->setUser_mark($txt_user_mark):"";
	$txt_access_shop?$score_config_obj->setAccess_shop($txt_access_shop):"";
	$txt_buy_service?$score_config_obj->setBuy_service($txt_buy_service):"";
	$txt_create_service?$score_config_obj->setCreate_service($txt_create_service):"";
	$txt_service_comment?$score_config_obj->setService_comment($txt_service_comment):"";
	$txt_create_shop?$score_config_obj->setCreate_shop($txt_create_shop):"";
	$score_config_obj->setWhere('1=1');
	
	$res = 0;
	if ($score_config){
	$res = $score_config_obj->edit_keke_witkey_score_config();
	}
	else {
		$res = $score_config_obj->create_keke_witkey_score_config();
	}
	
	
	
	
	
	
	

	$upload_obj = new Upload_Class(UPLOAD_ROOT."ico/",array("gif",'jpg'),UPLOAD_MAXSIZE);
	

	$score_rule_obj = new Keke_witkey_score_rule_class();
	if ($ruleitem['del']){
		$score_rule_obj->setWhere('score_rule_id in ('.$ruleitem['del'].')');
		$res += $score_rule_obj->del_keke_witkey_score_rule();
	}
	
	$ico = 0;
	if ($ruleitem['new'])
	foreach ($ruleitem['new'] as $key=>$value){
		$value['max_score'] = intval($value['max_score']);
		if ($value['max_score']){
			$score_rule_obj->_score_rule_id = null;
			$score_rule_obj->setMax_score($value['max_score']);
			$score_rule_obj->setUnit_id($value['unit_id']);
			$score_rule_obj->setUnit_title($value['unit_title']);
			$score_rule_obj->_unit_ico = null;
			if ($_FILES['icon_'.$key]['name']){
				$files = $upload_obj->run('icon_'.$key,1);
				if($files!='The uploaded file is Unallowable!'){
				
					$sc_ico = $files[$ico++]['saveName'];
					if($sc_ico){
						$sc_ico = "data/uploads/ico/".$sc_ico;
						$score_rule_obj->setUnit_ico($sc_ico);
					}
				}
			}
			
			$res += $score_rule_obj->create_keke_witkey_score_rule();
		}
	}
	
	
	if ($ruleitem['old'])
	foreach ($ruleitem['old'] as $key=>$value){
		$value['max_score'] = intval($value['max_score']);
			$score_rule_obj->_score_rule_id = null;
			$score_rule_obj->setWhere("score_rule_id = '$key'");
			$score_rule_obj->setMax_score($value['max_score']);
			$score_rule_obj->setUnit_id($value['unit_id']);
			$score_rule_obj->setUnit_title($value['unit_title']);
			$score_rule_obj->_unit_ico = null;
			if ($_FILES['ico_'.$key]['name']){
				$files = $upload_obj->run('ico_'.$key,1);
				if($files!='The uploaded file is Unallowable!'){
				
					$sc_ico = $files[$ico++]['saveName'];
					if($sc_ico){
						$sc_ico = "data/uploads/ico/".$sc_ico;
						$score_rule_obj->setUnit_ico($sc_ico);
					}
				}
			}
			
		
			$res += $score_rule_obj->edit_keke_witkey_score_rule();
		
	}
	if ($res) {
		Func_comm_class::adminshowmessage('修改成功',"index.php?do=config&view=score&m=$m");
	}
	else {
		Func_comm_class::adminshowmessage('修改失败',"index.php?do=config&view=score&m=$m");
	}
}

require_once $template_obj->template('control/admin/tpl/admin_config_score');