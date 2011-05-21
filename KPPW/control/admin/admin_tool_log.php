<?php



if(!defined('ADMIN_KEKE')) {
	exit('Access Denied');
}

Func_comm_class::adminCheckRole(35);

$log_obj = new Keke_witkey_system_log_class();

if ($op == 'del')
{
	$log_id = $log_id?$log_id:Func_comm_class::adminshowmessage("参数错误","index.php?do=tool&view=log");
	$log_obj->setWhere("log_id = '{$log_id}'");
	$log_obj->del_keke_witkey_system_log();
	Func_comm_class::adminshowmessage("记录删除成功",'index.php?do=tool&view=log');
}

if (isset ( $sbt_action )) {
	$o_p = $rdo;
	$keyids = $ckb;;
	if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	}
	if (count ( $keyids )) {
		
		$log_obj->setWhere(' log_id in ('.$ids.') ');
		switch ($sbt_action) {
			case '删除' : 
				$res = $log_obj->del_keke_witkey_system_log();
				break;
		}
		
		Func_comm_class::adminshowmessage('批量操作成功！','index.php?do='.$do.'&view='.$view);
		
	} else {
		Func_comm_class::adminshowmessage('请选择要操作的项！','index.php?do='.$do.'&view='.$view);
	}
}



$page_obj = new Pages_Class();
$where = "1=1 ";

$txt_start_time = Func_comm_class::sstrtotime($txt_start_time);
$txt_end_time = Func_comm_class::sstrtotime($txt_end_time);

if ($txt_start_time)
{
	$where.="and log_time>'{$txt_start_time}' ";
}
if ($txt_end_time)
{
	$where.="and log_time<'{$txt_end_time}' ";
}
if ($txt_username)
{
	$where.="and username='{$txt_username}' ";
}

switch ($ord) {
	case 1:
		$where.=' order by log_time desc ';
	;
	break;
	case 2:
		$where.=' order by log_time asc ';
	;
	break;
	default:
		$where.=' order by log_time desc ';
	break;
}


$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;

$log_obj->setWhere($where);
$count = $log_obj->count_keke_witkey_system_log();
$url ='index.php?do='.$do.'&view='.$view.'&ord='.$ord.'&txt_username='.$txt_username.'&txt_start_time='.$txt_start_time.'&txt_end_time='.$txt_end_time.'&slt_page_size='.$slt_page_size;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);

$log_obj->setWhere($where.$pages[where]);
$log_arr = $log_obj->query_keke_witkey_system_log();


$group_arr = Cache_ext_Class::getGroupList();

require_once $template_obj->template ( 'control/admin/tpl/admin_'.$do.'_' . $view );