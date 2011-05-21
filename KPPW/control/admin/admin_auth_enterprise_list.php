<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$enterprise_obj = new Keke_witkey_enterprise_auth_class();
$space_obj = new Keke_witkey_space_class();
$page_obj = new Pages_Class();


$where = ' 1 = 1 ';

if ($status==n){
	$where .= " and auth_status = 0 ";
}
elseif ($status){
	$where .= " and auth_status = $status ";
}

if(isset($sbt_search)){
	if($txt_id){
		$where.=' and enterprise_auth_id = '.$txt_id;
	}
	if($txt_title){
		$where.=' and username like '.'"%'.$txt_title.'%" ';
	}
}


switch ($ord) {
	case 1:
		$where.=' order by enterprise_auth_id desc ';
	;
	break;
	case 2:
		$where.=' order by enterprise_auth_id asc ';
	;
	break;
	case 3:
		$where.=' order by enterprise_auth_id desc ';
	;
	break;
	case 4:
		$where.=' order by enterprise_auth_id asc ';
	;
	break;
	default:
		$where.=' order by enterprise_auth_id desc ';
	break;
}


$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;
	
$enterprise_obj->setWhere($where);
$count = $enterprise_obj->count_keke_witkey_enterprise_auth();

$url ='index.php?do='.$do.'&view='.$view.'&slt_page_size='.$slt_page_size.'&txt_id='.$txt_id.'&txt_title='.$txt_title.'&status='.$status;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);

$enterprise_obj->setWhere($where.$pages[where]);
$enterprise_arr = $enterprise_obj->query_keke_witkey_enterprise_auth();

switch ($ac) {	
	case 'pass':
		if($enterprise_auth_id){
			$enterprise_obj->setWhere('enterprise_auth_id='.$enterprise_auth_id);
			$enterprise_obj->setAuth_status(1);
			$res = $enterprise_obj->edit_keke_witkey_enterprise_auth();
			
			$enterprise_obj->setWhere('enterprise_auth_id='.$enterprise_auth_id);
			$enterprise_info = $enterprise_obj->query_keke_witkey_enterprise_auth();
			$enterprise_info = $enterprise_info[0];
			if($enterprise_info[uid]){
				$space_obj->setWhere('uid='.$enterprise_info[uid]);
				$space_obj->setEnterprise_auth(1);
				$space_obj->edit_keke_witkey_space();
			}

			if($res){
				Func_comm_class::feed_add('<a href="index.php?do=space&member_id='. $enterprise_info[uid].'" target="_blank">'.$enterprise_info[username].'</a>已通过银行认证', $enterprise_info[uid],$enterprise_info[username],'enterprise_auth',$res);
				Func_comm_class::notify_user ( '企业认证通过通知', '您的企业认证已通过，请到<a href="index.php?do=user&view=auth">认证中心</a>查看详细', $enterprise_info[uid], $enterprise_info[username] );
				Func_comm_class::adminshowmessage('认证申请审核通过！','index.php?do='.$do.'&view='.$view);
			}
			
		}else{
			Func_comm_class::adminshowmessage('认证申请不存在，审核失败！','index.php?do='.$do.'&view='.$view);
		}
	;
	break;
	case 'not_pass':
		if($enterprise_auth_id){
			$enterprise_obj->setWhere('enterprise_auth_id='.$enterprise_auth_id);
			$enterprise_obj->setAuth_status(2);
			$res = $enterprise_obj->edit_keke_witkey_enterprise_auth();
			$enterprise_obj->setWhere('enterprise_auth_id='.$enterprise_auth_id);
			$enterprise_info = $enterprise_obj->query_keke_witkey_enterprise_auth();
			$enterprise_info = $enterprise_info[0];
			if($enterprise_info[uid]){
				$space_obj->setWhere('uid='.$enterprise_info[uid]);
				$space_obj->setEnterprise_auth(0);
				$space_obj->edit_keke_witkey_space();
			}
			if($res){
				Func_comm_class::notify_user ( '企业认证失败', '您的企业认证不通过，请到<a href="index.php?do=user&view=auth">认证中心</a>查看详细', $enterprise_info[uid], $enterprise_info[username] );
				Func_comm_class::adminshowmessage('认证申请审核不通过！','index.php?do='.$do.'&view='.$view);
			}
		}else{
			Func_comm_class::adminshowmessage('认证申请不存在，审核失败！','index.php?do='.$do.'&view='.$view);
		}
	;
	break;
	case 'del':
		if($enterprise_auth_id){
			$enterprise_obj->setWhere('enterprise_auth_id='.$enterprise_auth_id);
			$res = $enterprise_obj->del_keke_witkey_enterprise_auth();	
			$enterprise_obj->setWhere('enterprise_auth_id='.$enterprise_auth_id);
			$enterprise_info = $enterprise_obj->query_keke_witkey_enterprise_auth();
			$enterprise_info = $enterprise_info[0];
			if($enterprise_info[uid]){
				$space_obj->setWhere('uid='.$enterprise_info[uid]);
				$space_obj->setEnterprise_auth(0);
				$space_obj->edit_keke_witkey_space();
			}
			Func_comm_class::adminSystemLog("删除认证申请$enterprise_auth_id");
			Func_comm_class::adminshowmessage('认证申请删除成功！','index.php?do='.$do.'&view='.$view);
		}else{
			Func_comm_class::adminshowmessage('认证申请不存在，删除失败！','index.php?do='.$do.'&view='.$view);
		}
	;
	break;
	
	default:
		;
	break;
}



if (isset ( $sbt_action )) {
	$keyids = $ckb;
	
	 if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	 }
	if (count ( $keyids )) {
		$enterprise_obj->setWhere(' enterprise_auth_id in ('.$ids.') ');
		switch ($sbt_action) {
			case '直接删除' : 
				$enterprise_list = $enterprise_obj->query_keke_witkey_enterprise_auth();
				$b_uids =array();
				foreach ($enterprise_list as $v){
					$b_uids[] = $v['uid'];
				}
				$b_uids = implode(',',$b_uids);
				$space_obj->setWhere("uid in ($b_uids)");
				$space_obj->setEnterprise_auth(0);
				$space_obj->edit_keke_witkey_space();
				
				$enterprise_obj->setWhere(' enterprise_auth_id in ('.$ids.') ');
				
				$res = $enterprise_obj->del_keke_witkey_enterprise_auth();
				Func_comm_class::adminSystemLog("删除认证申请$ids");
				break;
			case '批量审核' : 
				$enterprise_obj->setAuth_status(1);
				$res = $enterprise_obj->edit_keke_witkey_enterprise_auth();
				
				$enterprise_obj->setWhere(' enterprise_auth_id in ('.$ids.') ');
				$enterprise_arr = $enterprise_obj->query_keke_witkey_enterprise_auth();
				foreach ($enterprise_arr as $value) {
					Func_comm_class::feed_add('<a href="index.php?do=space&member_id='. $value[uid].'" target="_blank">'.$value[username].'</a>已通过银行认证', $value[uid],$value[username],'enterprise_auth',$res);
				Func_comm_class::notify_user ( '企业认证通过', '您的企业认证已通过，请到<a href="index.php?do=user&view=auth">认证中心</a>查看详细', $value[uid], $value[username] );
					$space_obj->setWhere('uid='.$value[uid]);
					$space_obj->setEnterprise_auth(1);
					$space_obj->edit_keke_witkey_space();
				}
				
				Func_comm_class::adminSystemLog("审核认证申请$ids");
				break;
			case '批量不通过' : 
				$enterprise_list = $enterprise_obj->query_keke_witkey_enterprise_auth();
				$b_uids =array();
				foreach ($enterprise_list as $v){
					$b_uids[] = $v['uid'];
				}
				$b_uids = implode(',',$b_uids);
				$space_obj->setWhere("uid in ($b_uids)");
				$space_obj->setEnterprise_auth(0);
				$space_obj->edit_keke_witkey_space();
				
				$enterprise_obj->setWhere(' enterprise_auth_id in ('.$ids.') ');
				$enterprise_obj->setAuth_status(2);
				$res = $enterprise_obj->edit_keke_witkey_enterprise_auth();
				Func_comm_class::adminSystemLog("审核认证申请不通过$ids");
			break;
			default : 
			default : 
			break;
		}
		
		if($res){
			Func_comm_class::adminshowmessage('批量操作成功！','index.php?do='.$do.'&view='.$view);
		}else{
			Func_comm_class::adminshowmessage('批量操作失败，请重新操作！','index.php?do='.$do.'&view='.$view);
		}
		
	} else {
		Func_comm_class::adminshowmessage('请选择要操作的项！','index.php?do='.$do.'&view='.$view);
	}
}


require_once $template_obj->template ( 'control/admin/tpl/admin_'.$do.'_' . $view );