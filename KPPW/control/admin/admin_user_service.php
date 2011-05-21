<?php
if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}
Func_comm_class::adminCheckRole(75);

if($op == 'add'){
	
	$member_obj = new Keke_witkey_member_class();
	$memberspace_obj = new Keke_witkey_space_class();
	if ($is_submit){
		$txt_user_id = intval($txt_user_id);
		$memberspace_obj->setWhere("uid='{$txt_user_id}'");
		$memberinfo_info = $memberspace_obj->query_keke_witkey_space();
		$memberinfo_info = $memberinfo_info[0];
		if (!$memberinfo_info){
			Func_comm_class::adminshowmessage('该用户不存在',"index.php?do=user&type=service");
		}elseif($memberinfo_info[group_id]==7){
			Func_comm_class::adminshowmessage('该用户已经是客服，请勿重复操作',"index.php?do=user&type=service");
		}else{
			$memberspace_obj->setUid($txt_user_id);
			$memberspace_obj->setGroup_id(7);
			$res = $memberspace_obj->edit_keke_witkey_space();
			if($res){
				Func_comm_class::adminSystemLog("编辑客服$txt_user_id");
				Func_comm_class::notify_user("系统消息","管理员 <b>{$admin_info['username']}</b> 设置将您的设置为客服，",$txt_user_id,$memberinfo_arr['username']);
				Func_comm_class::adminshowmessage('客服添加成功',"index.php?do=user&type=service");
			}
		}
		
	}
	require_once $template_obj->template('control/admin/tpl/admin_user_service_add');
}
elseif($op == 'del'){
	if (!$delid){
		Func_comm_class::adminshowmessage('参数错误',"index.php?do=user&type=service");
	}
	db_factory::execute("update ".TABLEPRE."witkey_space set group_id = 0 where uid = $delid");
	Func_comm_class::adminshowmessage('操作成功',"index.php?do=user&type=service");
}

else{

	$page_obj = new Pages_Class();//实例化分页对象
	$memberspace_obj = new Keke_witkey_space_class();
	
	$url ='index.php?do=user&type=service&slt_static=$slt_static&txt_uid='.$txt_uid.'&txt_username='.$txt_username.'&slt_page_size='.$slt_page_size.'&ckb_isvip='.$ckb_isvip;
	
	//批量操作
	if (isset ( $sbt_action )) {
	//$o_p = $rdo;
	$keyids = $ckb;
	//var_dump($keyids);die();
	 $ids = implode(',',$keyids);
	 
		if (count ( $keyids )) {
			$memberspace_obj->setWhere("uid in ({$ids})");
			if ($sbt_action == "批量删除"){
				$memberspace_obj->setGroup_id(0);
				$memberspace_obj->edit_keke_witkey_space();
				Func_comm_class::adminSystemLog("取消客服用户$keyids");
			}
			Func_comm_class::adminshowmessage('操作成功',$url);
		}
	 } 

	
	$where_str =  "1=1 and group_id = 7  ";
	
	//每页显示多少条，默认10
	$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;
	
	if ($txt_uid)
	{
		$where_str .= "and uid='{$txt_uid}' ";
	}
	if ($txt_username)
	{
		$where_str .= "and username like '%{$txt_username}%' ";
	}
	if ($slt_static == 1)
	{
		$where_str .= "and status=1 ";
	}
	if ($slt_static == 2)
	{
		$where_str .= "and status=0 ";
	}
	
	
//排序条件
switch ($ord) {
	case 1:
		$where_str.=' order by uid desc ';//文章ID倒序
	;
	break;
	case 2:
		$where_str.=' order by uid asc ';//文章ID升序
	;
	break;
	case 3:
		$where_str.=' order by credit desc ';//时间倒序
	;
	break;
	case 4:
		$where_str.=' order by credit asc ';//时间升序
	;
	break;
	case 5:
		$where_str.=' order by balance desc ';//时间倒序
	;
	break;
	case 6:
		$where_str.=' order by balance asc ';//时间升序
	;
	break;
	default:
		;
	break;
}

	$memberspace_obj->setWhere($where_str);
	$count = $memberspace_obj->count_keke_witkey_space();
	
	$limit=$slt_page_size;
	$page = $_GET ['page'] ? $_GET ['page'] : 1;
	$pages = $page_obj->getPages($count,$limit,$page,$url);
	$memberspace_obj->setWhere($where_str.$pages['where']);
	$userlist_arr = $memberspace_obj->query_keke_witkey_space();
	$grouplist_arr = Cache_ext_Class::getGroupList();
	require_once $template_obj->template('control/admin/tpl/admin_user_service_list');
}

