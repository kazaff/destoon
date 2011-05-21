<?php

if(!defined('ADMIN_KEKE')) {
	exit('Access Denied');
}

$mark_rule = Cache_ext_Class::gettabledata("witkey_mark_rule","","max_mark",null);


$mark_config = new Keke_witkey_mark_config_class();
$mark_config->setWhere("1=1");
$mark_arr = $mark_config->query_keke_witkey_mark_config();


$m = $m?$m:"config";
$mc_rule = Cache_ext_Class::gettabledata("witkey_mark_config","","max_cash","0");
$basic_config = $basic_config?$basic_config:Cache_ext_Class::getConfig('basic');

if (isset($submit)){
	$res = 0;

	$basic_config_obj = new Keke_witkey_basic_config_class();
	$basic_config_obj->setAuto_mark_status($rdo_auto_mark_status);
	$basic_config_obj->setAuto_mark_time(intval($txt_auto_mark_time));
	$basic_config_obj->setMark_start_status($rdo_mark_start_status);
	$basic_config_obj->setWhere('1=1');
	$res+= $basic_config_obj->edit_keke_witkey_basic_config();
	Cache::delete("keke_witkey_basic_config");
	
	$mark_config_obj = new Keke_witkey_mark_config_class();
	if ($configitem['del']){
		$mark_config_obj->setWhere('mark_config_id in ('.$configitem['del'].')');
		$res += $mark_config_obj->del_keke_witkey_mark_config();
	}
	if ($configitem['new'])
	foreach ($configitem['new'] as $value){
		$value['max_cash'] = intval($value['max_cash']);
		$value['good'] = intval($value['good']);
		$value['normal'] = intval($value['normal']);
		$value['bad'] = intval($value['bad']);
		if ($value['max_cash']){
			$mark_config_obj->_mark_config_id = null;
			$mark_config_obj->setMax_cash($value['max_cash']);
			$mark_config_obj->setGood($value['good']);
			$mark_config_obj->setNormal($value['normal']);
			$mark_config_obj->setBad($value['bad']);
			$res += $mark_config_obj->create_keke_witkey_mark_config();
		}
	}
	
	if ($configitem['old'])
	foreach ($configitem['old'] as $key=>$value){
		$value['good'] = intval($value['good']);
		$value['normal'] = intval($value['normal']);
		$value['bad'] = intval($value['bad']);
		if (implode('_',$value)!=implode('_',array($mark_rule[$key]['max_cash'],$mark_rule[$key]['good'],$mark_rule[$key]['normal'],$mark_rule[$key]['bad']))){
			$mark_config_obj->_mark_config_id = null;
			$mark_config_obj->setWhere("mark_config_id = '$key'");
			$mark_config_obj->setMax_cash($value['max_cash']);
			$mark_config_obj->setGood($value['good']);
			$mark_config_obj->setNormal($value['normal']);
			$mark_config_obj->setBad($value['bad']);
			$res += $mark_config_obj->edit_keke_witkey_mark_config();
		}
	}
	
	

	$mark_rule_obj = new Keke_witkey_mark_rule_class();
	$upload_obj = new Upload_Class(UPLOAD_ROOT."ico/",array("gif",'jpg'),UPLOAD_MAXSIZE);
	
	if ($ruleitem['del']){
		$mark_rule_obj->setWhere('mark_rule_id in ('.$ruleitem['del'].')');
		$res += $mark_rule_obj->del_keke_witkey_mark_rule();
	}
	$ico = 0;
	
	
	if ($ruleitem['new'])
	foreach ($ruleitem['new'] as $key=>$value){
		$value['max_mark'] = intval($value['max_mark']);
		if ($value['max_mark']){
			$mark_rule_obj->_mark_rule_id = null;
			$mark_rule_obj->setMax_mark($value['max_mark']);
			$mark_rule_obj->setUnit_id($value['unit_id']);
			$mark_rule_obj->setUnit_title($value['unit_title']);
			$mark_rule_obj->_g_ico = null;$mark_rule_obj->_m_ico=null;
			if ($_FILES['gicon_'.$key]['name']){
				$files = $upload_obj->run('gicon_'.$key,1);
				if($files!='The uploaded file is Unallowable!'){
			
					$sc_ico = $files[$ico++]['saveName'];
					if($sc_ico){
						$sc_ico = "data/uploads/ico/".$sc_ico;
						$mark_rule_obj->setG_ico($sc_ico);
					}
				}
			}
			
			if ($_FILES['micon_'.$key]['name']){
				$files = $upload_obj->run('micon_'.$key,1);
				if($files!='The uploaded file is Unallowable!'){
			
					$sc_ico = $files[$ico++]['saveName'];
					if($sc_ico){
						$sc_ico = "data/uploads/ico/".$sc_ico;
						$mark_rule_obj->setM_ico($sc_ico);
					}
				}
			}
			
			$res += $mark_rule_obj->create_keke_witkey_mark_rule();
		}
	}
	if ($ruleitem['old'])
	foreach ($ruleitem['old'] as $key=>$value){
		$value['max_mark'] = intval($value['max_mark']);
			$mark_rule_obj->_mark_rule_id = null;
			$mark_rule_obj->setWhere("mark_rule_id = '$key'");
			$mark_rule_obj->setMax_mark($value['max_mark']);
			$mark_rule_obj->setUnit_id($value['unit_id']);
			$mark_rule_obj->setUnit_title($value['unit_title']);
			$mark_rule_obj->_g_ico = null;$mark_rule_obj->_m_ico=null;
			if ($_FILES['gico_'.$key]['name']){
				
				$files = $upload_obj->run('gico_'.$key,1);
				if($files!='The uploaded file is Unallowable!'){
				
					$sc_ico = $files[$ico++]['saveName'];
					if($sc_ico){
						$sc_ico = "data/uploads/ico/".$sc_ico;
						$mark_rule_obj->setG_ico($sc_ico);
					}
				}
			}
			if ($_FILES['mico_'.$key]['name']){
				
				$files = $upload_obj->run('mico_'.$key,1);
				if($files!='The uploaded file is Unallowable!'){
				
					$sc_ico = $files[$ico++]['saveName'];
					if($sc_ico){
						$sc_ico = "data/uploads/ico/".$sc_ico;
						$mark_rule_obj->setM_ico($sc_ico);
					}
				}
			}
			
			$res += $mark_rule_obj->edit_keke_witkey_mark_rule();
		
	}
	if ($res) {
		$mc_rule = Cache_ext_Class::gettabledata("witkey_mark_config","","max_cash","-1","mark_config_id");
		Func_comm_class::adminshowmessage('修改成功',"index.php?do=config&view=mark&m=$m");
	}
	else {
		Func_comm_class::adminshowmessage('修改失败',"index.php?do=config&view=mark&m=$m");
	}
}

require_once $template_obj->template('control/admin/tpl/admin_config_mark');