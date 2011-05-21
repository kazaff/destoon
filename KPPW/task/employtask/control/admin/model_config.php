<?php
if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$config_reward_obj = new Keke_witkey_xs_task_config_class (); 

$day_rule_obj = new Keke_witkey_day_rule_class (); 
$day_rule_obj->setWhere(' model_id ='.$model_id);
$day_rule_arr = Cache_ext_Class::gettabledata("witkey_day_rule","model_id='{$model_info['model_id']}'","rule_cash",null);


$defer_rule_obj = new Keke_witkey_defer_rule_class ();
$defer_rule_obj->setWhere(' model_id ='.$model_id);
$defer_rule_arr = Cache_ext_Class::gettabledata("witkey_defer_rule","model_id='$model_id'","defer_times");
 

$xml_path  = S_ROOT."./task/{$model_info['model_dir']}/control/admin/task_config.xml";

$xml_arr = Xml_Oper_Class::get_xml_toarr($xml_path);
extract($xml_arr);


if (isset ( $sbt_edit )) {
	$xml_obj = new Xml_Oper_Class($xml_path);
	$xml_obj->setxml('xs_is_close',$rdo_is_open_xs);
	$xml_obj->setxml('audit_cash',$txt_audit_cash);
	$xml_obj->setxml('is_auto_adjourn',$txt_is_auto_adjourn);
	$xml_obj->setxml('adjourn_day',$txt_adjourn_day);
	$xml_obj->setxml('is_open_prom',$rdo_is_open_prom );
	$xml_obj->setxml('vip_task_istop',$ckb_vip_task_istop ? $ckb_vip_task_istop : 2 );
	$xml_obj->setxml('vip_work_istop',$ckb_vip_work_istop ? $ckb_vip_work_istop : 2);
	$xml_obj->setxml('vip_hidden_work',$ckb_vip_hidden_work ? $ckb_vip_hidden_work : 2);
	$xml_obj->setxml('vip_recommend',$ckb_vip_recommend ? $ckb_vip_recommend : 2 );
	$xml_obj->setxml('deduct_scale',$txt_deduct_scale);
	$xml_obj->setxml('defeated_money',$rdo_defeated_money ? $rdo_defeated_money : 2);
	$xml_obj->setxml('is_comment',$ckb_is_comment ? $ckb_is_comment : 2 );
	$xml_obj->setxml('task_min_cash',$txt_task_min_cash);
	$xml_obj->setxml('vote_limit_time',$txt_vote_limit_time);
	$xml_obj->setxml('show_limit_time',$txt_show_limit_time);
	$xml_obj->setxml('reg_vote_limit_time',$txt_reg_vote_limit_time);
	$xml_obj->setxml('on_time',time());
   	
	if ($cash_rul_count) {
		
		for($i = 1; $i <= $cash_rul_count; $i ++) {
			if ($i > 1) {
				if ($_POST['txt_task_min_cash_' . ($i - 1)] >= $_POST['txt_task_min_cash_' . $i] or $_POST['txt_task_min_day_' . ($i - 1)] >= $_POST['txt_task_min_day_' . $i]) {
					Func_comm_class::adminshowmessage ( "任务规则中第(".($i).")条规则的时间与金额须大于前一次", "index.php?do=model&model_id=$model_id&view=config",10 );
					die ();
				}
			}
		}
	    if($txt_task_min_cash != $txt_task_min_cash_1) 
	    {
	       Func_comm_class::adminshowmessage("任务最小金额必须与任务规则第一条的起始金额相等","index.php?do=model&model_id=$model_id&view=config");
	       die();	
	    }
		$day_rule_obj->setWhere('model_id='.$model_id);
		$day_rule_obj->del_keke_witkey_day_rule ();
		
		for($i = 1; $i <= $cash_rul_count; $i ++) {
			$txt_task_min_cash_value = $_POST['txt_task_min_cash_'.$i];
			$txt_task_min_day_value = $_POST['txt_task_min_day_'.$i];
			$day_rule_obj->setDay_rule_id(null);
			$day_rule_obj->setRule_cash ( $txt_task_min_cash_value );
			$day_rule_obj->setRule_day ( $txt_task_min_day_value );
			$day_rule_obj->setModel_id($model_id);
			$day_rule_obj->create_keke_witkey_day_rule ();
			
		}
		$day_rule_arr = $day_rule_obj->query_keke_witkey_day_rule();
		Cache::write($day_rule_arr,"keke_witkey_day_rule");
	}
	
	Func_comm_class::adminshowmessage ( '任务配置成功！', 'index.php?do=model&model_id='.$model_id.'&view=config' );
		
	
}

require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/control/admin/tpl/model_' . $view );