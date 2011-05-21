<?php


if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}
$_K['is_rewrite']=0;


$task_status_arr = array('0'=>'任务未付款',
						'1'=>'任务待审核',
						'2'=>'任务进行中',
						'3'=>'任务公示中',
						'4'=>'任务投票中',
						'5'=>'任务失败',
						'6'=>'任务冻结',
						'7'=>'任务完成'
						);

$reward_cove_arr = array('1'=>'100元以下',
 '2'=>'100元—500元',
 '3'=>'500元—1000元',
 '4'=>'1000元—5000元',
 '5'=>'5000元以上');



$page_obj = new Pages_Class();

$task_obj = new Keke_witkey_task_class();

$indus_obj = new Keke_witkey_industry_class();

$cash_rule_obj = new Keke_witkey_cash_rule_class;


$cash_rule_arr = $cash_rule_obj->query_keke_witkey_cash_rule();


$indus_c_arr = $indus_arr ;


	
require_once  $template_obj->template ( $do );