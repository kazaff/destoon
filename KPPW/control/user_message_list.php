<?php




if(!defined('IN_KEKE')) {
	exit('Access Denied');
}
$page_obj = new Pages_Class();
$message_obj = new Keke_witkey_message_class();

$where = "1=1 ";

if ($message_type==1)
{
	$where.="and uid<1 and recive_uid=$uid and msg_status!=1 ";
}
else if ($message_type==2)
{
	$where.="and uid>0 and recive_uid=$uid and msg_status!=1 ";
}
else if ($message_type==3)
{
	$where.="and uid=$uid and msg_status!=2 ";
}
else {
	$where.="and recive_uid=$uid and msg_status != 1 ";
}
$where.="order by on_time desc ";

$page_size = intval($page_size)?intval($page_size):15;
$message_obj->setWhere($where);
$count = $message_obj->count_keke_witkey_message();


$url ='index.php?do='.$do.'&view='.$view.'&page_size='.$page_size.'&message_type='.$message_type;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);

$message_obj->setWhere($where.$pages[where]);
$message_arr = $message_obj->query_keke_witkey_message();


if (isset ( $sbt_action )) {
	$o_p = $rdo;
	$keyids = $ckb;

	if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	}
	if (count ( $keyids )) {
		switch ($sbt_action) {
			case '批量删除' : 
				$message_obj->setWhere(' msg_id in ('.$ids.') and msg_status !=1 and uid ='.$uid);
				$message_obj->setMsg_status(2);
				$res1 = $message_obj->edit_keke_witkey_message();
				
				$message_obj->setWhere(' msg_id in ('.$ids.') and msg_status !=2 and recive_uid= '.$uid );
				$message_obj->setMsg_status(1);
				$res2 = $message_obj->edit_keke_witkey_message();
				
				$message_obj->setWhere(' msg_id in ('.$ids.') and msg_status =1 and uid ='.$uid);
				$res3 = $message_obj->del_keke_witkey_message();
				
				$message_obj->setWhere(' msg_id in ('.$ids.') and msg_status =2 and recive_uid ='.$uid);
				$res4 = $message_obj->del_keke_witkey_message();
				
				$message_obj->setWhere(' msg_id in ('.$ids.') and uid<1 ' );
				$res5 = $message_obj->del_keke_witkey_message();
				
				break;
			default : 
				break;
		}
		
		Func_comm_class::showmessage('批量操作成功！','index.php?do='.$do.'&view='.$view);
		
	} else {
		Func_comm_class::showmessage('请选择要操作的项！','index.php?do='.$do.'&view='.$view,3,'您还未选择所要操作的项！','error');
	}
}


require_once  $template_obj->template ($do."_".$view);