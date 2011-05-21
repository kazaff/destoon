<?php

if(!defined('ADMIN_KEKE')) {
	exit('Access Denied');
}

$task_menu_arr = array(
	'任务管理'=>'index.php?do=model&model_id=2&view=list&status=0',
	'招标配置'=>'index.php?do=model&model_id=2&view=config',
);

$task_rule_menu_t = array(
	'taskpub'=>array('任务发布',1,'每日发布任务次数限制'),
	'taskbid'=>array('任务投标',1,'每日报名次数限制'),
	'taskcomment'=>array('任务留言',0,'该任务模型是否允许留言'),
	'taskfav'=>array('任务收藏',0,'是否允许每日限制收藏任务0'),
);
