<?php
if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}
Func_comm_class::adminCheckRole(95);

$views = array ( 'all','edit','group_rule');
$view = (! empty ( $view ) && in_array ( $view, $views )) ? $view : 'all';
$task_rule_menu = array();


$task_rule_menu['shop'] = array(
	'personshop_create'=>array('个人店铺',0,'是否允许开启'),
	'enterpriseshop_create'=>array('企业店铺',0,'是否允许开启'),
	'service_allow'=>array('发布服务',0,'如果不开启 将只允许发布商品'),
);
$task_rule_menu['studio'] = array(
	'studio_create'=>array('创建工作室',0,'是否允许创建工作室'),
	
);
foreach ($model_list as $model){
	$task_rule_menu_t = array();
	include S_ROOT."./task/".$model['model_dir']."/control/admin/task_config.php";
	if ($task_rule_menu_t){
		$task_rule_menu['task'][$model['model_id']]=$task_rule_menu_t;
	}
}



require_once ADMIN_ROOT.'admin_'.$do.'_'.$view.'.php';
?>