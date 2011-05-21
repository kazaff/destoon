<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

$shop_config = new Keke_witkey_shop_config_class();
$shop_config->setWhere( " 1=1 limit 1");
$shop_config_arr = $shop_config->query_keke_witkey_shop_config();
$shop_config_arr = $shop_config_arr[0];
extract($shop_config_arr);

$task_rule_menu['shop'] = array(
	'personshop_create'=>array('个人店铺开通',0,'是否允许开启'),
	'enterpriseshop_create'=>array('企业店铺开通',0,'是否允许开启'),
	'service_allow'=>array('发布服务',0,'如果不开启 将只允许发布商品'),
);

$temp = Cache_ext_Class::gettabledata("witkey_rule","","",null);
$rule_list = array();
foreach ($temp as $t){
	$rule_list[$t['rule_key']][$t['rule_group']]=$t['rule'];
}

$score_rule = Cache_ext_Class::gettabledata("witkey_score_rule","","max_score",null);

if(isset($sbt_edit)){
	if ($op == "config"){ 
		$shop_config->setService_prorate(floatval($txt_service_prorate));
		$shop_config->setDown_prorate(floatval($txt_down_prorate));
		$shop_config->setService_min_amount(floatval($txt_service_min_amount));
		$shop_config->setStep_min_amount(floatval($txt_step_min_amount));
		$shop_config->setShop_is_close(intval($rdo_shop_is_close));
		if($hdn_config_id){
			$shop_config->setConfig_id($hdn_config_id);
			$res = $shop_config->edit_keke_witkey_shop_config();
			if($res){
				Func_comm_class::adminshowmessage('编辑成功',"index.php?do=$do&view=$view&op=config",2,"");
			}else {
				Func_comm_class::adminshowmessage('编辑失败',"index.php?do=$do&view=$view&op=config",3,"");
			}
		}else{
			$res = $shop_config->create_keke_witkey_shop_config();
			if($res){
				Func_comm_class::adminshowmessage('创建成功',"index.php?do=$do&view=$view&op=config",2,"");
			}else {
				Func_comm_class::adminshowmessage('创建失败',"index.php?do=$do&view=$view&op=config",3,"");
			}
		}
	}
	elseif ($op == 'rule'){
		
	}
	
}

require_once $template_obj->template ( 'control/admin/tpl/admin_'.$do.'_' . $view );