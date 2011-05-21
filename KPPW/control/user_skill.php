<?php

if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

$indus_obj = new Keke_witkey_industry_class();
$skill_obj = new Keke_witkey_skill_class();
$user_info = Func_comm_class::getuserinfo($uid);
$indus_p_arr = cache_ext_Class::getIndustryList(1,0);
$indus_arr = Cache_ext_Class::getIndustryList(1);
$skill_arr = Cache_ext_Class::getSkillList();


if($ac=='show_skill'){
	$skill_show_arr = Cache_ext_Class::gettabledata ( 'witkey_skill', "indus_id= $indus_id", '', NULL );
	foreach ($skill_show_arr as $value) {
		$show_htm.= '<a style="color: rgb(36, 124, 214);"  onclick="inset(this);" href="#inset">'.$value[skill_name].'</a>';
	}
	echo $show_htm;
	die();
}

if($user_info[skill_ids]){
	$skill_obj->setWhere(' skill_id in ( '.$user_info[skill_ids].') ');
	$user_skill_arr = $skill_obj->query_keke_witkey_skill();
}
if($user_info[indus_id]){
	$indus_obj->setWhere('indus_id='.$user_info[indus_id]);
	$indus_info = $indus_obj->query_keke_witkey_industry();
	$indus_info = $indus_info[0];
}


if ($sbt_edit){
	$user_skill_arr = explode(',',$tar_skill_ids);
	if(is_array($user_skill_arr)){
	
		foreach ($skill_arr as $value1) {
			foreach ($user_skill_arr as $value2) {
				if($value1[skill_name]==$value2){
					$skill_ids .= $value1[skill_id].',';
				}
			}
		}
	}
	$skill_ids.='0';
	$space_obj = new Keke_witkey_space_class();
	$space_obj->setWhere("uid='$uid'");
	$space_obj->setSkill_ids($skill_ids);
	if(intval($slt_indus_id)){
		$space_obj->setIndus_id(intval($slt_indus_id));
	}
	$res = $space_obj->edit_keke_witkey_space();
	Func_comm_class::showmessage("您的职业技能已经编辑成功！","index.php?do=".$do."&view=".$view);
}



require_once  $template_obj->template ($do."_".$view);

