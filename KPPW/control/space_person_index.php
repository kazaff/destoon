<?php

 
$skill_obj = new Keke_witkey_skill_class();
if($space_info[skill_ids]){
	$skill_obj->setWhere(' skill_id in('.$space_info[skill_ids].')');
	$skill_arr = $skill_obj->query_keke_witkey_skill();
}
require_once $template_obj->template ( $do . "_" . $view );