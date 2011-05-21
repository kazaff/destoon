<?php

 


if(!defined('IN_KEKE')) {
	exit('Access Denied');
}


$auth_item_obj = new Keke_witkey_auth_item_class();
$realname_obj = new Keke_witkey_realname_auth_class();
$space_obj = new Keke_witkey_space_class();
$upload_obj = new Upload_Class ( UPLOAD_ROOT , array ("gif", 'jpeg', 'jpg', 'png' ), UPLOAD_MAXSIZE );

$basic_config = Cache_ext_Class::getConfig('basic');

if(intval($auth_id)){
	$auth_item_obj->setWhere(' auth_id =  '.intval($auth_id));
	$item_info = $auth_item_obj->query_keke_witkey_auth_item();
	$item_info = $item_info[0];
}

$user_info = Func_comm_class::getuserinfo($uid);

$realname_obj->setWhere('uid = '.$uid.' order by  realname_a_id desc ');
$realname_info = $realname_obj->query_keke_witkey_realname_auth();
$realname_info = $realname_info[0];

if($sbt_edit){

	if($_FILES['fle_id_pic']['name']){
		$files1 = $upload_obj->run ( 'fle_id_pic' );
		if(is_array($files1)){
			$id_pic= "data/uploads/".UPLOAD_RULE.$files1[0]['saveName'];
		}
	}
	
	if(!$id_pic||!$txt_id_card||!$txt_realname){
		Func_comm_class::showmessage('身份认证申请提交失败！','index.php?do='.$do.'&view='.$view.'&auth_id='.$auth_id,3,'身份认证申请提交失败，您填写的资料不完整！','error');
	}else{
		
		if($item_info[auth_cash]>=0){
			$fina_obj = new Keke_witkey_finance_class();
			$fina_obj->setFina_narrate(11);
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
		
		$realname_obj->setUid($uid);
		$realname_obj->setUsername($username);
		$realname_obj->setId_card($txt_id_card);
		$realname_obj->setId_pic($id_pic);
		$realname_obj->setRealname($txt_realname);
		$realname_obj->setStart_time(time());
		$realname_obj->setEnd_time(time()+$item_info[auth_period]*3600*24);
		$realname_obj->setCash($item_info[auth_cash]);
		$res = $realname_obj->create_keke_witkey_realname_auth();
	}
	
	if($res){
		
		Func_comm_class::showmessage('身份认证申请提交成功！','index.php?do='.$do.'&view='.$view.'&auth_id='.$auth_id,3,'身份认证申请提交成功，请耐心等待管理员审核！');
	}
}

require_once  $template_obj->template ($do."_".$view);