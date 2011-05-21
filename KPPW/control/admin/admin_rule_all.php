<?php

$temp = Cache_ext_Class::gettabledata("witkey_rule","","",null);
$rule_list = array();
foreach ($temp as $t){
	$rule_list[$t['rule_key']][$t['rule_group']]=$t['rule'];
}


$score_rule = Cache_ext_Class::gettabledata("witkey_score_rule","","max_score",null);
$score_rule_count = count($score_rule);
$score_rule = Cache_ext_Class::gettabledata("witkey_score_rule","","max_score",null);

if (isset($submit)){

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
		Func_comm_class::adminshowmessage('修改成功',"index.php?do=rule&view=all&m=$m");
	}
	else {
		Func_comm_class::adminshowmessage('修改失败',"index.php?do=rule&view=all&m=$m");
	}
}

require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do . '_' . $view );

?>