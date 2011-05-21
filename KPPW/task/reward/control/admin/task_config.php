<?php

if(!defined('ADMIN_KEKE')) {
	exit('Access Denied');
}

$task_menu_arr = array(
	'任务管理'=>'index.php?do=model&model_id=1&view=list&status=0',
	'悬赏配置'=>'index.php?do=model&model_id=1&view=config',
);


$task_rule_menu_t = array(
	'taskpub'=>array('任务发布',1,'每日发布任务次数限制'),
	'tasksign'=>array('任务报名',1,'每日报名次数限制'),
	'taskwork'=>array('任务交稿',1,'每日交稿次数限制'),
	'taskcomment'=>array('任务留言',0,'该任务模型是否允许留言'),
	'taskvote'=>array('稿件投票',0,'每日投票是否允许'),
	'workhide'=>array('稿件隐藏',0,'是否允许威客隐藏稿件'),
	'taskfav'=>array('任务收藏',0,'是否允许每日限制收藏任务0'),
);