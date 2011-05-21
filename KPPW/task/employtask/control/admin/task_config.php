<?php

if(!defined('ADMIN_KEKE')) {
	exit('Access Denied');
}


$task_menu_arr = array(
	'任务管理'=>'index.php?do=model&model_id=6&view=list&status=0',
	'雇佣配置'=>'index.php?do=model&model_id=6&view=config',
);

$task_rule_menu_t = array(
	'taskpub'=>array('任务发布',1,'每日发布任务次数限制'),
);