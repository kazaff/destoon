<?php


if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$bid_obj = new Keke_witkey_bid_class();
$bid_ext_obj = new Keke_witkey_bid_ext_class();
$task_obj = new Keke_witkey_task_class();


if(!$task_id){
	Func_comm_class::showmessage("参数错误",'index.php',3,'','error');
}


$where =  ' a.task_id = '.intval($task_id); 

switch ($bidtype) {
	case '1':
		$where = $where;
	;
	break;
	case '2':
		$where .= ' and  b.isvip = 1  ';
	;
	break;
	case '3':
		$where .= ' and  b.is_auth = 1  ';
	;
	break;
	default:
		;
	break;
}

if (!$tender_config)
$tender_config = Cache_ext_Class::getConfig('zb_task');
$ord = $ord?$ord:"desc";
if ($tender_config['vip_sign_istop'])
{
	$order = "order by a.bid_status desc,b.isvip desc,a.bid_time $ord";
}
else{
	$order = "order by a.bid_status desc,a.bid_time $ord";
}

if($txt_username){
	$where .= ' and b.username like "%'.$txt_username.'%"';
}
$where.=" $order";

$bid_ext_obj->setWhere($where);
$count = $bid_ext_obj->count_keke_witkey_bid();

$page_size = 5;
$url ='index.php?do=task&view='.$view.'&page_size='.$page_size.'&task_id='.$task_id.'&bidtype='.$bidtype.'&txt_username='.$txt_username;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$page_size;
$bid_pages = $page_obj->getPages($count,$limit,$page,$url);

$bid_ext_obj->setWhere($where.$bid_pages[where]);
$bid_arr = $bid_ext_obj->query_keke_witkey_bid();

if($ac=='select_bid'){
	$bid_obj->setWhere(' task_id = '.$task_id.' and bid_status = 1');
	$bid_info = $bid_obj->query_keke_witkey_bid();
	if($bid_info){
		Func_comm_class::showmessage('选标失败！','index.php?do=task&view='.$view.'&task_id='.$task_id,2,'对不起，您已经选择了'.$bid_info[0][bid_id].'号投标，请勿重复选标','error');
	}
	
	$task_obj->setTask_id($task_id);
	$task_obj->setTask_status(3);
	$task_obj->edit_keke_witkey_task();
	
	$bid_obj->setBid_id(intval($bid_id));
	$bid_obj->setBid_status(1);
	$res = $bid_obj->edit_keke_witkey_bid();
	
	$bid_obj->setWhere(' bid_id =  '.intval($bid_id));
	$bid_info = $bid_obj->query_keke_witkey_bid();
	$bid_info = $bid_info[0];
	
	db_factory::execute("update ".TABLEPRE."witkey_space set accepted_num = accepted_num+1 where uid=".intval($bid_info[uid]));
	
	if($res){
		Func_comm_class::feed_add('<a target="_blank" href="index.php?do=space&member_id='.$bid_info['uid'].'">'.$bid_info['username'].'</a>成功中标任务<a href="index.php?do=task&task_id='.$task_info['task_id'].'">'.$task_info['task_title'].'</a>',$bid_info['uid'],$bid_info['username'],'work_accept');
		Func_comm_class::notify_user("系统信息",'您已成功中标任务  <a href="index.php?do=task&task_id='.$task_info['task_id'].'">'.$task_info['task_title'].'</a>',$bid_info['uid'],$bid_info['username']);
		Func_comm_class::showmessage('选标成功！','index.php?do=task&view='.$view.'&task_id='.$task_id,2,'恭喜您，选标成功');
	}else{
		Func_comm_class::showmessage('选标失败！','index.php?do=task&view='.$view.'&task_id='.$task_id,2,'对不起，选标失败','error');
	}
}elseif($ac=='task_status4'){
	$task_obj->setTask_id($task_id);
	$task_obj->setTask_status(4);
	$res = $task_obj->edit_keke_witkey_task();
	if($res){
		Func_comm_class::showmessage('确定工作完成！','index.php?do=task&view='.$view.'&task_id='.$task_id,2,'恭喜您，确定工作完成');
	}else{
		Func_comm_class::showmessage('确定工作完成失败！','index.php?do=task&view='.$view.'&task_id='.$task_id,2,'对不起，确定工作完成失败','error');
	}
}elseif($ac=='task_status7'){
	$task_obj->setTask_id($task_id);
	$task_obj->setTask_status(7);
	$res = $task_obj->edit_keke_witkey_task();
	if($res){
		Func_comm_class::showmessage('确定任务完成！','index.php?do=task&view='.$view.'&task_id='.$task_id,2,'恭喜您，确定任务完成');
	}else{
		Func_comm_class::showmessage('确定任务完成失败！','index.php?do=task&view='.$view.'&task_id='.$task_id,2,'对不起，确定任务完成失败','error');
	}
}