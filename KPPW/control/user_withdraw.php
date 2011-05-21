<?php


if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$withdraw_obj = new Keke_witkey_withdraw_class();

$finance_obj = new Keke_witkey_finance_class();

$space_obj = new Keke_witkey_space_class();

$user_info = Func_comm_class::getuserinfo($uid);

$pay_arr = Cache_ext_Class::getConfig ( 'paypal' );


if(intval($uid)){
	$space_info = Func_comm_class::getuserinfo(intval($uid));
	if(Func_comm_class::submitcheck('formhash')){
		
		$withdraw_sum = db_factory::query(" select sum(withdraw_cash) as  sum_cash from ".TABLEPRE."witkey_withdraw where uid=".$uid." and  DATE_SUB(CURDATE(), INTERVAL  1 DAY) <= date(from_unixtime(applic_time)) ");
		$withdraw_sum = $withdraw_sum[0];
		$withdraw_sum = $withdraw_sum[sum_cash];
		
		if(intval($txt_withdraw_cash)<=0&&intval($txt_withdraw_cash)>=$space_info[balance]){
			Func_comm_class::showmessage('提交失败！','index.php?do=user&view=withdraw',2,'提现申请金额不能为空或小于您的当前余额！','error');
		}else if($pay_arr[withdraw_max]<$withdraw_sum+$txt_withdraw_cash){
			Func_comm_class::showmessage('提交失败！','index.php?do=user&view=withdraw',2,'您当天的提现申请金额不能大'.$pay_arr[withdraw_max].'！','error');
		}
		$withdraw_obj->setWithdraw_cash(intval($txt_withdraw_cash));
		$withdraw_obj->setUid($uid);
		$withdraw_obj->setUsername($username);
		$withdraw_obj->setWithdraw_status(0);
		$withdraw_obj->setApplic_time(time());
		$withdraw_obj->setPay_type($rdo_pay_type);
		if ($rdo_pay_type==1){
			$withdraw_obj->setPay_zfb($txt_pay_zfb);
			$txt_pay_zfb?"":Func_comm_class::showmessage("提交失敗",'index.php?do=user&view=withdraw',2,'未填写提款帐号！','error');
			if ($txt_pay_zfb!=$user_info['pay_zfb'])
			{
				$space_obj->setWhere('uid='.$uid);
				$space_obj->setPay_zfb($txt_pay_zfb);
				$space_obj->edit_keke_witkey_space();
			}
			
		}
		elseif ($rdo_pay_type==2){
			$withdraw_obj->setPay_zfb($txt_pay_cft);
			$txt_pay_cft?"":Func_comm_class::showmessage("提交失敗",'index.php?do=user&view=withdraw',2,'未填写提款帐号！','error');
			if ($txt_pay_cft!=$user_info['pay_cft'])
			{
				$space_obj->setWhere('uid='.$uid);
				$space_obj->setPay_cft($txt_pay_cft);
				$space_obj->edit_keke_witkey_space();
			}
		}
		elseif ($rdo_pay_type==3){
			$withdraw_obj->setPay_bank($txt_pay_bank);
			$txt_pay_bank?"":Func_comm_class::showmessage("提交失敗",'index.php?do=user&view=withdraw',2,'未填写提款帐号！','error');
			if ($txt_pay_bank!=$user_info['pay_bank'])
			{
				$space_obj->setWhere('uid='.$uid);
				$space_obj->setPay_bank($txt_pay_bank);
				$space_obj->edit_keke_witkey_space();
			}
		}
		else {
			Func_comm_class::showmessage("提交失敗",'index.php?do=user&view=withdraw',2,'未选择提款途径！','error');
		}
		$res1 = $withdraw_obj->create_keke_witkey_withdraw();

		$finance_obj->setUid($uid);
		$finance_obj->setUsername($username);
		$finance_obj->setFina_type(1);
		$finance_obj->setFina_cash(abs(intval($txt_withdraw_cash)));
	
		$finance_obj->setOrder_id($res1);

		$finance_obj->setFina_narrate(16);

		$space_info = Func_comm_class::getuserinfo(intval($uid));
		$balance = $space_info['balance'];
		$finance_obj->setUser_balance($balance-abs(intval($txt_withdraw_cash)));
		$finance_obj->setFina_time(time());

		$finance_obj->create_keke_witkey_finance();
		
		if($res1){
			
			db_factory::execute("update " .TABLEPRE."witkey_space set balance = balance-".abs(intval($txt_withdraw_cash))." where uid ={$uid}");
			Func_comm_class::showmessage('提交成功！','index.php?do=user&view=withdraw',2,'提现申请提交成功,请等待管理员的审核!');
		}else{
			Func_comm_class::showmessage('提交失败！','index.php?do=user&view=withdraw',2,'提现申请提交失败！','error');
		}
		
		
	}
}

$page_obj = new Pages_Class();
$page_size = intval($page_size)?intval($page_size):13;
$withdraw_obj->setWhere("uid = '$uid' ");
$count = $withdraw_obj->count_keke_witkey_withdraw();


$url ='index.php?do='.$do.'&view='.$view.'&page_size='.$page_size;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);

$withdraw_obj->setWhere("uid = '$uid' order by applic_time desc ".$pages[where]);
$withdraw_arr = $withdraw_obj->query_keke_witkey_withdraw();



require_once  $template_obj->template ($do."_".$view);