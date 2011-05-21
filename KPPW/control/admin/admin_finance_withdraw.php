<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(9);


$withdraw_obj = new Keke_witkey_withdraw_class();
$page_obj = new Pages_Class();
$user_space_obj = new Keke_witkey_space_class();

$finance_obj = new Keke_witkey_finance_class();

$where = ' 1 = 1 ';

if(isset($sbt_search)){
	if($txt_id){
		$where.=' and withdraw_id = '.$txt_id;
	}
	if($txt_title){
		$where.=' and username like '.'"%'.$txt_title.'%" ';
	}
}


switch ($ord) {
	case 1:
		$where.=' order by withdraw_id desc ';
	;
	break;
	case 2:
		$where.=' order by withdraw_id asc ';
	;
	break;
	case 3:
		$where.=' order by applic_time desc ';
	;
	break;
	case 4:
		$where.=' order by applic_time asc ';
	;
	break;
	default:
		$where.=' order by applic_time desc ';
	break;
}


$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;
	
$withdraw_obj->setWhere($where);
$count = $withdraw_obj->count_keke_witkey_withdraw();

$url ='index.php?do='.$do.'&view='.$view.'&slt_page_size='.$slt_page_size.'&txt_id='.$txt_id.'&txt_title='.$txt_title;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);

$withdraw_obj->setWhere($where.$pages[where]);
$withdraw_arr = $withdraw_obj->query_keke_witkey_withdraw();



if($withdraw_id){
	$withdraw_obj->setWhere('withdraw_id='.$withdraw_id);
	$withdraw_info = $withdraw_obj->query_keke_witkey_withdraw();
	$withdraw_info = $withdraw_info[0];
}


switch ($ac) {	
	case 'pass':
		if($withdraw_id){
		
			if ($is_submit){
								
				$user_space_info = Func_comm_class::getuserinfo($withdraw_info[uid]);
				
				if($withdraw_info[withdraw_status]==1){
					Func_comm_class::adminshowmessage('该提现申请已经审核通过，无需重复操作！','index.php?do='.$do.'&view='.$view);
				}
				
				$withdraw_obj->setWhere('withdraw_id='.$withdraw_id);
				
				$withdraw_obj->setWithdraw_status(1);
				$withdraw_obj->setProcess_uid($admin_info['uid']);
				$withdraw_obj->setProcess_username($admin_info['username']);
				$withdraw_obj->setProcess_time(time());
				$res = $withdraw_obj->edit_keke_witkey_withdraw();	
				
				$finance_obj->setWhere(" order_id = '$withdraw_id' and fina_narrate=16");
				
				$finance_obj->setFina_narrate(6);
				$finance_obj->edit_keke_witkey_finance();				
				
				
				Func_comm_class::feed_add('<a href="index.php?do=space&member_id='.$user_space_info[uid].'" target="_blank">'.$withdraw_info['username'].'</a>成功提现了'.$withdraw_info[withdraw_cash].'元',$user_space_info['uid'],$user_space_info[username],'withdraw');
				//邮件
				$message_obj = new Message_Class();
				if ($message_obj->validate('draw_success_isnotice')){
					$message_obj->setUid($withdraw_info['uid']);
					$message_obj->setUsername($withdraw_info['username']);
					$message_obj->setValue("提现金额",$withdraw_info[withdraw_cash]);
					$message_obj->setTitle('提现成功');
					$message_obj->send();
				}
				
				$space_info = Func_comm_class::getuserinfo(intval($withdraw_info['uid']));
				
				Func_comm_class::update_score_value($withdraw_info['uid'],'withdraw',2);
				Func_comm_class::adminSystemLog("审核提现申请$withdraw_id");
				Func_comm_class::adminshowmessage('提现申请审核通过！','index.php?do='.$do.'&view='.$view);
			}
			require_once $template_obj->template('control/admin/tpl/admin_finance_withdraw_info');die();
		}else{
			Func_comm_class::adminshowmessage('提现申请不存在，审核失败！','index.php?do='.$do.'&view='.$view);
		}
	;
	break;
	
	case 'del':
		if($withdraw_id){
			$withdraw_obj->setWhere('withdraw_id='.$withdraw_id);
			$withdraw_info  = $withdraw_obj->query_keke_witkey_withdraw();
			$withdraw_obj->setWhere('withdraw_id='.$withdraw_id);
			$res = $withdraw_obj->del_keke_witkey_withdraw();	
			
			$withdraw_cash = $withdraw_info[0][withdraw_cash];
			$uid = $withdraw_info[0][uid];
			$username = $withdraw_info[0][username];
			
			db_factory::execute("update " .TABLEPRE."witkey_space set balance = balance+".abs(intval($withdraw_cash))." where uid =$uid");
			
			$finance_obj->setFina_type(2);
			
			$finance_obj->setFina_narrate(17);
			$finance_obj->setUid($uid);
			$finance_obj->setUsername($username);
			$finance_obj->setFina_cash($withdraw_cash);
			$space_info = Func_comm_class::getuserinfo(intval($uid));
		    $balance = $space_info['balance'];
			$finance_obj->setUser_balance($balance);
			$finance_obj->setFina_time(time());
			$finance_obj->create_keke_witkey_finance();
				
			Func_comm_class::notify_user('提现申请审核失败','您的提现申请审核未通过,提现金额已经返还到你的现金帐户请查收！',$uid,$username);
			if ($space_info['email']){Func_comm_class::sendMail($space_info['email'],'提现申请审核失败','您的提现申请审核未通过,提现金额已经返还到你的现金帐户请查收！');}
			Func_comm_class::adminSystemLog("删除提现申请$withdraw_id");
			Func_comm_class::adminshowmessage('提现申请删除成功！','index.php?do='.$do.'&view='.$view);
		}else{
			Func_comm_class::adminshowmessage('提现申请不存在，删除失败！','index.php?do='.$do.'&view='.$view);
		}
	;
	break;
	

}


if (isset ( $sbt_action )) {
	$keyids = $ckb;
	
	 if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	 }
	if (count ( $keyids )) {
    
    $withdraw_obj->setWhere(" withdraw_id in ('$ids') and withdraw_status =0 ");
    $nodraw_arr = $withdraw_obj->query_keke_witkey_withdraw();

    $withdraw_obj->setWhere(' withdraw_id in ('.$ids.') ');
	switch ($sbt_action) {
		case '直接删除' : 
            foreach ($nodraw_arr as $v) {
            	$withdraw_id = $v['withdraw_id'];
            	$where = "withdraw_id = '$withdraw_id' ";
            	$withdraw_info = db_factory::query("select * from ".TABLEPRE."witkey_withdraw where $where" );
               	$withdraw_cash = $withdraw_info[0][withdraw_cash];
				$uid = $withdraw_info[0][uid];
				$username = $withdraw_info[0][username];
				
				db_factory::execute("update " .TABLEPRE."witkey_space set balance = balance+".abs(intval($withdraw_cash))." where uid =$uid");
				
				$finance_obj->setFina_id(NULL);
				$finance_obj->setFina_type(1);
				
				$finance_obj->setFina_narrate(17);
				$finance_obj->setUid($uid);
				$finance_obj->setUsername($username);
				$finance_obj->setFina_cash($withdraw_cash);
				$space_info = Func_comm_class::getuserinfo(intval($uid));
			    $balance = $space_info['balance'];
				$finance_obj->setUser_balance($balance);
				$finance_obj->setFina_time(time());
				$finance_obj->create_keke_witkey_finance();
				Func_comm_class::notify_user('提现申请审核失败','您的提现申请审核未通过,提现金额已经返还到你的现金帐户请查收！',$uid,$username);
            if ($space_info['email']){Func_comm_class::sendMail($space_info['email'],'提现申请审核失败','您的提现申请审核未通过,提现金额已经返还到你的现金帐户请查收！');}
            }
            
			$res = $withdraw_obj->del_keke_witkey_withdraw();
			Func_comm_class::adminSystemLog("删除提现申请$ids");
			break;
		case '批量审核' : 
			$withdraw_arr = $withdraw_obj->query_keke_witkey_withdraw();
			$withdraw_obj->setWithdraw_status(1);
			$withdraw_obj->setWhere(' withdraw_id in ('.$ids.') ');
			$res = $withdraw_obj->edit_keke_witkey_withdraw();
			
			foreach ($withdraw_arr as $withdraw_info)
			{
				$space_info = Func_comm_class::getuserinfo($withdraw_info['uid']);
				$withdraw_id = $withdraw_info['withdraw_id']; 
				if($withdraw_info[withdraw_status]==1){
					continue;
				}

				
				$message_obj = new Message_Class();
				if ($message_obj->validate('draw_success_isnotice')){
					$message_obj->setUid($withdraw_info['uid']);
					$message_obj->setUsername($withdraw_info['username']);
					$message_obj->setValue("提现金额",$withdraw_info[withdraw_cash]);
					$message_obj->setTitle('提现成功');
					$message_obj->send();
				}
				
			
				$finance_obj->setWhere(" order_id = '$withdraw_id' and fina_narrate=16");
				
				$finance_obj->setFina_narrate(6);
				$finance_obj->edit_keke_witkey_finance();	
				
				Func_comm_class::update_score_value($withdraw_info['uid'],'withdraw',2);
				Func_comm_class::feed_add('<a href="index.php?do=space&member_id='.$space_info[uid].'" target="_blank">'.$withdraw_info['username'].'</a>成功提现了'.$withdraw_info[withdraw_cash].'元',$user_space_info['uid'],$user_space_info[username],'withdraw');
			}
			
			
			Func_comm_class::adminSystemLog("审核提现申请$ids");
			break;
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


require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do . '_' . $view );