<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}
$temp = Cache_ext_Class::gettabledata("witkey_rule","","",null);
$rule_list = array();
foreach ($temp as $t){
	$rule_list[$t['rule_key']][$t['rule_group']]=$t['rule'];
}
include 'task_config.php';
$score_rule = Cache_ext_Class::gettabledata("witkey_score_rule","","max_score",null);


$config_reward_obj = new Keke_witkey_xs_task_config_class (); 

$day_rule_obj = new Keke_witkey_day_rule_class ();

$day_rule_obj->setWhere(' model_id ='.$model_id);

$day_rule_arr = Cache_ext_Class::gettabledata("witkey_day_rule","model_id='{$model_info['model_id']}'","rule_cash",null);


$defer_rule_obj = new Keke_witkey_defer_rule_class (); 
$defer_rule_arr = Cache_ext_Class::gettabledata("witkey_defer_rule","model_id='$model_id'","defer_times");

$config_reward_obj->setWhere ( ' 1 limit 1' );
$config_reward_info = $config_reward_obj->query_keke_witkey_xs_task_config ();
$config_reward_info = $config_reward_info [0];
extract ( $config_reward_info );

if (isset ( $sbt_edit )) {
	$config_reward_obj->setXs_is_close ( $rdo_is_open_xs );
	$config_reward_obj->setAudit_cash ( $txt_audit_cash );
	$config_reward_obj->setIs_auto_adjourn ( $txt_is_auto_adjourn); 
	$config_reward_obj->setAdjourn_day ( $txt_adjourn_day ); 

	$config_reward_obj->setIs_open_prom ( $rdo_is_open_prom );
	$config_reward_obj->setVip_task_istop ( $ckb_vip_task_istop ? $ckb_vip_task_istop : 2 );
	$config_reward_obj->setVip_work_istop ( $ckb_vip_work_istop ? $ckb_vip_work_istop : 2 );
	$config_reward_obj->setVip_hidden_work ( $ckb_vip_hidden_work ? $ckb_vip_hidden_work : 2 );
	$config_reward_obj->setVip_recommend ( $ckb_vip_recommend ? $ckb_vip_recommend : 2 );
	$config_reward_obj->setDeduct_scale ( $txt_deduct_scale );
	$config_reward_obj->setDefeated_money ( $rdo_defeated_money ? $rdo_defeated_money : 2 );
	$config_reward_obj->setIs_comment ( $ckb_is_comment ? $ckb_is_comment : 2 );
	$config_reward_obj->setTask_min_cash ( $txt_task_min_cash );
	$config_reward_obj->setVote_limit_time ( $txt_vote_limit_time );
	$config_reward_obj->setShow_limit_time ( $txt_show_limit_time );
	$config_reward_obj->setReg_vote_limit_time ( $txt_reg_vote_limit_time );
	$config_reward_obj->setOn_time ( time () );
	
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
	       Func_comm_class::adminshowmessage("任务最小金额必须与任务规则第一条的起始金额相等");
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
		Cache::delete("keke_witkey_day_rule");
		Cache::write($day_rule_arr,"keke_witkey_day_rule");
	}
	if ($adjourn_rul_count) {
	    for ($i = 1; $i <= $adjourn_rul_count; $i++) {
	    	if($i>1)
	    	{
	    		if($_POST['txt_defer_cash_scale_'.($i-1)]>=$_POST['txt_defer_cash_scale_'.$i])
	    		{
	    			Func_comm_class::adminshowmessage("延期加价规则中第".($i)."次的加价的百分比小于前一次的设置","index.php?do=model&model_id={$model_id}&view=config");
	    			die();
	    		}
	    	}
	    }
	    $defer_rule_obj->setWhere('model_id='.$model_id);
	    $defer_rule_obj->del_keke_witkey_defer_rule();
	    for ($i = 1; $i <= $adjourn_rul_count; $i++) {
	       $defer_rule_obj->setDefer_times($_POST['txt_defer_times_'.$i]);
	       $defer_rule_obj->setDefer_rule_id(null);
	       $defer_rule_obj->setDefer_cash_scale($_POST['txt_defer_cash_scale_'.$i]);
	       $defer_rule_obj->setModel_id($model_id);
	       $defer_rule_obj->create_keke_witkey_defer_rule();
	    }
	    $defer_rule_arr = $defer_rule_obj->query_keke_witkey_defer_rule();
	    Cache::delete("keke_witkey_defer_rule");
	    Cache::write($defer_rule_arr,"keke_witkey_defer_rule");
	}
	if ($hdn_xs_config_id) {
		$config_reward_obj->setXs_task_config_id ( $hdn_xs_config_id );
		$res = $config_reward_obj->edit_keke_witkey_xs_task_config ();
		$config_reward_obj->setWhere(" 1 limit 1");
		$config_reward_arr = $config_reward_obj->query_keke_witkey_xs_task_config();
		if ($res) {
			Cache::delete("keke_witkey_xs_task_config");
			Cache::write($config_reward_arr,"keke_witkey_xs_task_config");
			Func_comm_class::adminSystemLog("修改悬赏任务配置");
			Func_comm_class::adminshowmessage ( '悬赏配置修改成功！', 'index.php?do=model&model_id='.$model_id.'&view=config' );
		}
		
	} else {
		$res = $config_reward_obj->create_keke_witkey_xs_task_config ();
		$config_reward_obj->setWhere(" 1 limit 1");
		$config_reward_arr = $config_reward_obj->query_keke_witkey_xs_task_config();
		if ($res) {
			Cache::delete("keke_witkey_xs_task_config");
			Cache::write($config_reward_arr,"keke_witkey_xs_task_config");
			Func_comm_class::adminshowmessage ( '悬赏配置添加成功！', 'index.php?do=model&model_id='.$model_id.'&view=config' );
		}
	}
}

require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/control/admin/tpl/model_' . $view );