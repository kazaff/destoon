<?php


if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

$auth_item_obj = new Keke_witkey_auth_item_class();
$bank_obj = new Keke_witkey_bank_auth_class();
$space_obj = new Keke_witkey_space_class();


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

$basic_config = Cache_ext_Class::getConfig('basic');

if(intval($auth_id)){
	$auth_item_obj->setWhere(' auth_id =  '.intval($auth_id));
	$item_info = $auth_item_obj->query_keke_witkey_auth_item();
	$item_info = $item_info[0];
}

$bank_obj->setWhere('uid = '.$uid.' order by  bank_a_id desc ');
$bank_info = $bank_obj->query_keke_witkey_bank_auth();
$bank_info = $bank_info[0];

if($bank_info){
	$pay_type=$bank_info[pay_type];
}else{
	$pay_types = array(1,2);
	$pay_type = in_array($pay_type,$pay_types)?$pay_type:1;
}


if($bank_info[deposit_area]){
	$bank_info[deposit_area]=explode(',',$bank_info[deposit_area]);
}


$user_info = Func_comm_class::getuserinfo($uid);



if($sbt_edit){
	
	$pay_type = intval($pay_type);
	$bank_obj->setPay_type($pay_type);
	if($pay_type==1){
		if(!$slt_online_pay_tool||!$txt_online_pay_account){
			Func_comm_class::showmessage('银行认证申请提交失败！','index.php?do='.$do.'&view='.$view.'&auth_id='.$auth_id,3,'银行认证申请提交失败，您填写的资料不完整！','error');
		}
	}elseif($pay_type==2){
		if(!$slt_bank_name||!$txt_bank_account||!$slt_province||!$slt_city||!$txt_deposit_name){
			Func_comm_class::showmessage('银行认证申请提交失败！','index.php?do='.$do.'&view='.$view.'&auth_id='.$auth_id,3,'银行认证申请提交失败，您填写的资料不完整！','error');
		}
	}
		if($item_info[auth_cash]>=0){
			$fina_obj = new Keke_witkey_finance_class();
			$fina_obj->setFina_narrate(12);
			$fina_obj->setFina_time(time());
			$fina_obj->setUid($uid);
			$fina_obj->setFina_type(1);
			$fina_obj->setUsername($username);
			$fina_obj->setSite_profit($item_info[auth_cash]);
			if ($basic_config[credit_is_allow]!=1){
				$user_info['credit']=0;
			}
			$cost_credit = $item_info[auth_cash]>$user_info['credit']?$user_info['credit']:$item_info[auth_cash];
			$cost_cash = $item_info[auth_cash]-$cost_credit;
			$fina_obj->setFina_cash($cost_cash);
			$fina_obj->setFina_credit($cost_credit);
			$fina_obj->setUser_credit($user_info['credit']-$cost_credit);
			$fina_obj->setUser_balance($user_info['balance']-$cost_cash);
			db_factory::execute("update ".TABLEPRE."witkey_space set balance=balance-".($cost_cash+0).",credit=credit-".($cost_credit+0)." where uid=$uid");
			$fina_obj->create_keke_witkey_finance();
		}
		
		if($pay_type==1){
			$bank_obj->setOnline_pay_tool($slt_online_pay_tool);
			$bank_obj->setOnline_pay_account($txt_online_pay_account);
		}else{
			$bank_obj->setBank_name($slt_bank_name);
			$bank_obj->setBank_account($txt_bank_account);
			$bank_obj->setDeposit_area($slt_province.','.$slt_city);
			$bank_obj->setDeposit_name($txt_deposit_name);
		}
		$bank_obj->setStart_time(time());
		$bank_obj->setEnd_time(time()+$item_info[auth_period]*3600*24);
		$bank_obj->setCash($item_info[auth_cash]);
		$bank_obj->setUid($uid);
		$bank_obj->setUsername($username);
		$res = $bank_obj->create_keke_witkey_bank_auth();

	if($res){
		Func_comm_class::showmessage('银行认证申请提交成功！','index.php?do='.$do.'&view='.$view.'&auth_id='.$auth_id,3,'银行认证申请提交成功，请耐心等待管理员审核！');
	}
}

if($sbt_user_get_cash){
	$bank_obj->setBank_a_id($bank_info[bank_a_id]);
	$bank_obj->setUser_get_cash(floatval($txt_user_get_cash));
	
	if(floatval($txt_user_get_cash)==$bank_info[pay_to_user_cash]){
		$bank_obj->setAuth_status(1);
		$space_obj->setWhere("uid='$uid'");
		$space_obj->setBank_auth(1);
		$space_obj->edit_keke_witkey_space();
		$res = $bank_obj->edit_keke_witkey_bank_auth();
		if($res){
			Func_comm_class::feed_add('<a href="index.php?do=space&member_id='.$uid.'" target="_blank">'.$username.'</a>已通过银行认证',$uid,$username,'bank_auth',$res);
			Func_comm_class::notify_user ( '银行认证成功', '您的银行认证已通过，请到<a href="index.php?do=user&view=auth">认证中心</a>查看详细', $uid, $username );
			Func_comm_class::showmessage('用户银行卡认证成功！','index.php?do='.$do.'&view='.$view.'&auth_id='.$auth_id,3,'用户银行卡认证成功！');
		}
	}else{
		$bank_obj->setAuth_status(2);
		$res = $bank_obj->edit_keke_witkey_bank_auth();
		if($res){
			Func_comm_class::notify_user ( '银行认证失败', '您的银行认证未通过，请与客服联系', $uid, $username );
			Func_comm_class::showmessage('用户银行卡认证失败！','index.php?do='.$do.'&view='.$view.'&auth_id='.$auth_id,3,'用户填写的收款金额与管理员打款金额不相等，用户银行卡认证失败！','error');
		}
	}
}
require_once  $template_obj->template ($do."_".$view);