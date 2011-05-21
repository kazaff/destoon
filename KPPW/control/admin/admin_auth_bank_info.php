<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$bank_obj = new Keke_witkey_bank_auth_class();
$space_obj = new Keke_witkey_space_class();
$page_obj = new Pages_Class();
$pay_tool_arr = array(1=>'支付宝',2=>'财付通',3=>'网银在线');
$bank_name_arr = array(
1=>'中国农业银行',
2=>'中国建设银行',
3=>'中国工商银行',
4=>'招商银行',
5=>'交通银行',
6=>'浦发银行',
7=>'中国民生银行',
8=>'中信银行',
9=>'中国邮政储蓄银行',
10=>'兴业银行',
11=>'华夏银行');

if($bank_a_id){
	$bank_obj->setWhere('bank_a_id='.$bank_a_id);
	$bank_info = $bank_obj->query_keke_witkey_bank_auth();
	$bank_info = $bank_info[0];
}

if($sbt_pay_to_user){
	$bank_obj->setWhere('bank_a_id='.$hdn_bank_a_id);
	$bank_obj->setPay_to_user_cash($txt_pay_to_user_cash);
	$bank_obj->setPay_time(time());
	$res = $bank_obj->edit_keke_witkey_bank_auth();
	
	$bank_obj->setWhere('bank_a_id='.$hdn_bank_a_id);
	$bank_info = $bank_obj->query_keke_witkey_bank_auth();
	$bank_info = $bank_info[0];
	
	Func_comm_class::notify_user ( '银行认证打款通知', '管理员已经打款到您的账户，请及时查收，并在<a href="index.php?do=user&view=auth">认证中心</a>确认收款金额', $bank_info[uid], $bank_info[username] );
	
	if($res){
		Func_comm_class::adminshowmessage('打款金额设置成功！','index.php?do='.$do.'&view='.$view.'&bank_a_id='.$hdn_bank_a_id);
	}
}


switch ($ac) {	
	case 'pass':
		if($bank_a_id){
			$bank_obj->setWhere('bank_a_id='.$bank_a_id);
			$bank_obj->setAuth_status(1);
			$res = $bank_obj->edit_keke_witkey_bank_auth();
			
			$bank_obj->setWhere('bank_a_id='.$bank_a_id);
			$enterprise_info = $bank_obj->query_keke_witkey_bank_auth();
			$enterprise_info = $enterprise_info[0];
			if($enterprise_info[uid]){
				$space_obj->setWhere('uid='.$enterprise_info[uid]);
				$space_obj->setEnterprise_auth(1);
				$space_obj->edit_keke_witkey_space();
			}
			if($res){
				Func_comm_class::adminshowmessage('认证申请审核通过！','index.php?do='.$do.'&view='.$view);
			}
			
		}else{
			Func_comm_class::adminshowmessage('认证申请不存在，审核失败！','index.php?do='.$do.'&view='.$view);
		}
	;
	break;
		case 'pay_to_user':
		if($bank_a_id){
			$bank_obj->setWhere('bank_a_id='.$bank_a_id);
			$enterprise_info = $bank_obj->query_keke_witkey_enterprise_auth();
			$enterprise_info = $enterprise_info[0];
			if($enterprise_info[uid]){
				$space_obj->setWhere('uid='.$enterprise_info[uid]);
				$space_obj->setEnterprise_auth(1);
				$space_obj->edit_keke_witkey_space();
			}
			if($res){
				Func_comm_class::adminshowmessage('认证申请审核通过！','index.php?do='.$do.'&view='.$view);
			}
			
		}else{
			Func_comm_class::adminshowmessage('认证申请不存在，审核失败！','index.php?do='.$do.'&view='.$view);
		}
	;
	break;
	case 'del':
		if($bank_a_id){
			$bank_obj->setWhere('bank_a_id='.$bank_a_id);
			$res = $bank_obj->del_keke_witkey_enterprise_auth();	
			Func_comm_class::adminSystemLog("删除认证申请$bank_a_id");
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


require_once $template_obj->template ( 'control/admin/tpl/admin_'.$do.'_' . $view );