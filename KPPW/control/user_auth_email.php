<?php



if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

$auth_item_obj = new Keke_witkey_auth_item_class();
$space_obj = new Keke_witkey_space_class();
$basic_config = Cache_ext_Class::getConfig('basic');
if(intval($auth_id)){
	$auth_item_obj->setWhere(' auth_id =  '.intval($auth_id));
	$item_info = $auth_item_obj->query_keke_witkey_auth_item();
	$item_info = $item_info[0];
}

$user_info = Func_comm_class::getuserinfo($uid);

if($op=='check_email'){
	if(md5($uid.$username.$user_info[email])==$md5_code){
		$space_obj->setUid($uid);
		$space_obj->setEmail_auth(1);
		$res  = $space_obj->edit_keke_witkey_space();
		if($res){
			Func_comm_class::feed_add('<a href="index.php?do=space&member_id='.$uid.'" target="_blank">'.$username.'</a>已通过邮箱认证',$uid,$username,'email_auth',$res);
			
			Func_comm_class::showmessage('邮箱认证成功！','index.php?do='.$do.'&view='.$view.'&auth_id='.$auth_id,3,'邮箱认证成功');
		}
	}
}

if($sbt_edit){
	if(!$txt_email){
		Func_comm_class::showmessage('邮箱认证提交失败！','index.php?do='.$do.'&view='.$view.'&auth_id='.$auth_id,3,'邮箱认证提交失败，您填写的资料不完整！','error');
	}else{
		
		if($item_info[auth_cash]>=0){
			$fina_obj = new Keke_witkey_finance_class();
			$fina_obj->setFina_narrate(14);
			$fina_obj->setFina_time(time());
			$fina_obj->setFina_type(1);
			$fina_obj->setUid($uid);
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
		
		$md5_code = md5($uid.$username.$txt_email);
		$title = $basic_config['website_name'].'--邮箱认证';
		$body = '<font color="red">'.$basic_config['website_name'].'--邮箱认证</font><br><br>&nbsp;&nbsp;&nbsp;请点击邮件认证地址：'.$_K[siteurl].'/index.php?do=user&view=auth_email&auth_id=4&op=check_email&md5_code='.$md5_code;
		
		$res = Func_comm_class::sendMail($txt_email,$title,$body);
	}
	
}

require_once  $template_obj->template ($do."_".$view);