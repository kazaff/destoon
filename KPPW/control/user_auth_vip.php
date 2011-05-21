<?php


if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

$basic_config = Cache_ext_Class::getConfig('basic');

$user_info = Func_comm_class::getuserinfo($uid);
$vip_rule_arr = Cache_ext_Class::getConfigRule('vip');

$vip_history_obj = new Keke_witkey_vip_history_class();
$vip_history_obj->setWhere("uid = '{$uid}' and h_status=1");
$vip_history_arr = $vip_history_obj->query_keke_witkey_vip_history();

if ($is_submit)
{
	
	$vr = $vip_rule_arr[$rdo_vip_rule];
	if (!$vr)
	{
		Func_comm_class::showmessage("错误的参数","index.php?do=user&view=auth_vip",3,'','error');
	}
	$cost = $vr['vip_cash'];
	$uservalue = $basic_config[credit_is_allow]==1?$user_info['balance']+$user_info['credit']:$user_info['balance'];
	if ($cost<=$uservalue)
	{
		$vip_history_obj->setDay($vr['vip_day']);
		$vip_history_obj->setH_status(1);
		$end_time = $user_info['vip_end_time']>time('now()')?$user_info['vip_end_time']+$vr['vip_day']*24*3600:time('now()')+$vr['vip_day']*24*3600;
		$vip_history_obj->setEnd_time($end_time);
		$vip_history_obj->setStart_time(time('now()'));
		$vip_history_obj->setUid($uid);
		$vip_history_obj->setUsername($username);
		$space_obj = new Keke_witkey_space_class();
		$space_obj->setWhere("uid = '{$uid}'");
		$space_obj->setIsvip(1);
		$space_obj->setVip_end_time($end_time);
		$space_obj->edit_keke_witkey_space();
		
		$fina_obj = new Keke_witkey_finance_class();
		$fina_obj->setFina_time(time('now()'));
		$fina_obj->setFina_type(1);
		$fina_obj->setFina_narrate(7);
		$fina_obj->setUid($uid);
		$fina_obj->setUsername($username);
		
		if ($basic_config[credit_is_allow]==1){
		if ($user_info['credit']<$cost){
			$costcredit = $user_info['credit'];
		}
		else {
			$costcredit = $cost;
		}
		
		$cost = ($cost-$costcredit);
		db_factory::execute("update ".TABLEPRE."witkey_space set credit=credit-'{$costcredit}' where uid='$uid'");
		$fina_obj->setFina_credit($costcredit);
		$fina_obj->setUser_credit($user_info['credit']-$costcredit);
		$vip_history_obj->setCredit_cost($costcredit);
		}
		
		if ($cost>0)
		{
			$costcash = $cost;
			db_factory::execute("update ".TABLEPRE."witkey_space set balance=balance-'{$costcash}' where uid='$uid'");
			$fina_obj->setFina_cash($costcash);
			$fina_obj->setUser_balance($user_info['balance']-$costcash);
			$vip_history_obj->setCash_cost($costcash);
		}
		$fina_obj->setSite_profit($cost);
		$fina_obj->create_keke_witkey_finance();
		$vip_history_obj->create_keke_witkey_vip_history();
		Func_comm_class::feed_add('<a href="index.php?do=space&member_id='.$uid.'">'.$username.'</a>充值了VIP',$uid,$username,'vip');
		Func_comm_class::notify_user ( '系统消息', '恭喜您，已经成功升级为VIP用户，可以享受更多的VIP特权！', $uid,$username );
		Func_comm_class::update_score_value($uid,'buy_vip',2);
		Func_comm_class::showmessage("购买成功","index.php?do=user&view=auth_vip");
	}
	else {
		$vip_history_obj->setDay($vr['vip_day']);
		$vip_history_obj->setH_status(0);
		$vip_history_obj->setStart_time(time('now()'));
		$vip_history_obj->setCash_cost($cost);
		$vip_history_obj->setUid($uid);
		$vip_history_obj->setUsername($username);
		$onlinepaycash = $cost-$uservalue;
		$obj_id = $vip_history_obj->create_keke_witkey_vip_history();
		Func_comm_class::showmessage("请选择支付途径","index.php?do=user&view=cash&type=vip&obj_id=".$obj_id."&cash=".$onlinepaycash);
	}
}

require_once  $template_obj->template ($do."_".$view);