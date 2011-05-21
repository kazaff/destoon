<?php

$score_rule = Cache_ext_Class::gettabledata("witkey_score_rule","","max_score",null);
$temp = Cache_ext_Class::gettabledata("witkey_rule","","",null);
$rule_list = array();
foreach ($temp as $t){
	$rule_list[$t['rule_key']][$t['rule_group']]=$t['rule'];
}

if ($model_id){
	$rule = $task_rule_menu['task'][$model_id][$key];
}
else {
	$rule = $task_rule_menu['shop'][$key]?$task_rule_menu['shop'][$key]:$task_rule_menu['studio'][$key];
}

$model_key = $model_id?"_$model_id":"";
$res = 0;
if (isset($sbt_edit)){
	$model_key = $key.$model_key;
	$rule_obj = new Keke_witkey_rule_class();
	foreach ($edit_rule as $k=>$edit){
		$rule_obj->_rule_id = null;
		
		if ($edit['r']==-1){
			$rule_obj->setRule(-1);
		}
		else{
			$rule_obj->setRule(intval($edit['t'])?$edit['t']:0);
		}
		if (db_factory::query("select * from ".TABLEPRE."witkey_rule where rule_key='$model_key' and rule_group='$k'")){
			$rule_obj->setWhere("rule_key='$model_key' and rule_group='$k'");
			$res+=$rule_obj->edit_keke_witkey_rule();
		}
		else {
			$rule_obj->setRule_key($model_key);
			$rule_obj->setRule_group($k);
			$res += $rule_obj->create_keke_witkey_rule();
		}
	}
	$m = $type=="auth"?"rule":"";
	if ($res){
		Func_comm_class::adminshowmessage("编辑成功","index.php?do=rule&m=$m");
	}
	else {
		Func_comm_class::adminshowmessage("编辑成功","index.php?do=rule&m=$m",3,"无任何更改");
	}
	
}

require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do . '_' . $view );
?>