<?php

if ($type=='score'){
	$score_info = Cache_ext_Class::gettabledata("witkey_score_rule","score_rule_id=$score_id","",0,'',1,1);
	$rule_group = 'score_'.$score_id;
}
else if ($type=='auth'){
	$rule_group = $auth;
}



$temp = Cache_ext_Class::gettabledata("witkey_rule","","",null);
$rule_list = array();
foreach ($temp as $t){
	$rule_list[$t['rule_key']][$t['rule_group']]=$t['rule'];
}


if (isset($sbt_edit)){
	$rule_obj = new Keke_witkey_rule_class();
	foreach ($edit_rule as $k=>$v){
	$rule_obj->_rule_id = null;
		
		if ($v['v']==-1){
			$rule_obj->setRule(-1);
		}
		else{
			$rule_obj->setRule(intval($v['t'])?$v['t']:0);
		}
		if (db_factory::query("select * from ".TABLEPRE."witkey_rule where rule_key='$k' and rule_group='$rule_group'")){
			$rule_obj->setWhere("rule_key='$k' and rule_group='$rule_group'");
			$res+=$rule_obj->edit_keke_witkey_rule();
		}
		else {
			$rule_obj->setRule_key($k);
			$rule_obj->setRule_group($rule_group);
			$res += $rule_obj->create_keke_witkey_rule();
		}
	}
	if ($type=="score"){
		Func_comm_class::adminshowmessage("编辑成功","index.php?do=rule");
	}else 
	{
		Func_comm_class::adminshowmessage("编辑成功","index.php?do=rule&m=rule");
	}
}

require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do . '_' . $view );
?>