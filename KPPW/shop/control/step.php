 <?php
 

 if (!$uid){
 	Func_comm_class::showmessage("错误提示",$_K['siteurl'],3,'您需要先登录！','error');
 }
 
$service_order_obj = new Keke_witkey_service_order_class();
 
if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

if (!$order_id){
	Func_comm_class::showmessage("错误提示",$_K['siteurl'],3,'参数信息错误！','error');
}
 
$service_order_obj->setWhere("order_id='$order_id'");
$order_info = $service_order_obj->query_keke_witkey_service_order();
$order_info = $order_info[0];

 
if (!$order_info){
	Func_comm_class::showmessage("错误提示",$_K['siteurl'],3,'此订单不存在！','error');
}




 
$shop_info = db_factory::query("select a.*,b.* from ".TABLEPRE."witkey_shop a left join ".TABLEPRE."witkey_space b on b.uid = a.uid where a.shop_id = '{$order_info['shop_id']}'");
$shop_info = $shop_info[0];
 
if (!$shop_info){
	Func_comm_class::showmessage("错误提示",$_K['siteurl'],3,'此服务所在店铺已关闭服务！','error');
}

if ($uid!=$shop_info['uid']&&$uid!=$order_info['buy_uid'])
{
	Func_comm_class::showmessage("错误提示",$_K['siteurl'],3,'订单不属于您！','error');
}

 
$userinfo = Func_comm_class::getuserinfo($uid);



 
$order_detail_arr = Cache_ext_Class::gettabledata("witkey_service_order_detail","order_id='$order_id'","step_num",0,'step_num');

if ($op == 'cancerorder'&&!$order_info['order_status']){
	$service_order_obj->setOrder_status(2);
	$service_order_obj->edit_keke_witkey_service_order();
	
	if ($uid == $order_info['buy_uid']){
		$noti_info = '买方终止了您的的订单#'.$order_id.' '.'<a target="_blank" href="'.$_K['siteurl'].'/shop.php?do=step&order_id='.$order_id.'">'.$order_info['title'].'</a>';
		Func_comm_class::notify_user('订单终止',$noti_info,$order_info,$order_info['sale_uid'],$order_info['sale_username']);
		$userinfo = Func_comm_class::getuserinfo($order_info['sale_uid']);
		if ($userinfo['email'])Func_comm_class::sendMail($userinfo['email'],'卖方终止了您的的订单#'.$order_id.' '.$order_info['title'].'',$noti_info);
	}
	else {
		$noti_info = '卖方修改了您的的订单#'.$order_id.' '.'<a target="_blank" href="'.$_K['siteurl'].'/shop.php?do=step&order_id='.$order_id.'">'.$order_info['title'].'</a>';
		Func_comm_class::notify_user('订单终止',$noti_info,$order_info['buy_uid'],$order_info['buy_username']);
		$userinfo = Func_comm_class::getuserinfo($order_info['buy_uid']);
		if ($userinfo['email'])Func_comm_class::sendMail($userinfo['email'],'卖方终止了您的的订单#'.$order_id.' '.$order_info['title'].'',$noti_info);
	}
}

if ($op == 'edit_step'&&!$order_info['order_status']){
	$service_order_obj->setTitle($txt_title);
	$service_order_obj->setCount_cash($txt_count_cash);
	$service_order_obj->setWhere("order_id = '$order_id'");
	$service_order_obj->edit_keke_witkey_service_order();
	
	$order_detail_obj = new Keke_witkey_service_order_detail_class();
	if ($detail_arr[del]){
		$order_detail_obj->setWhere("detail_id in ({$detail_arr[del]})");
		$order_detail_obj->del_keke_witkey_service_order_detail();
	}
	
	$item_index = 1;
	if ($detail_arr[old]){
		foreach ($detail_arr['old'] as $k=>$v){
			$order_detail_obj->setWhere("detail_id='$k'");
			$order_detail_obj->setStep_cash($v['step_cash']);
			$order_detail_obj->setStep_detail($v['step_detail']);
			$order_detail_obj->setStep_num($item_index++);
			$order_detail_obj->edit_keke_witkey_service_order_detail();	
		}
	}
	
	if ($detail_arr['new']){
		foreach ($detail_arr['new'] as $k=>$v){
			$order_detail_obj->_detail_id = null;
			$order_detail_obj->setOrder_id($order_id);
			$order_detail_obj->setStep_cash($v['step_cash']);
			$order_detail_obj->setStep_detail($v['step_detail']);
			$order_detail_obj->setStep_num($item_index++);
			$order_detail_obj->setStep_status(0);
			$order_detail_obj->create_keke_witkey_service_order_detail();
		}
	}
	
 
		if ($uid == $shop_info['uid']){
			$service_order_obj->setBuyer_status(0);
			$service_order_obj->setSale_status(1);
			
		 
			if ($order_info['buyer_status']==1){
			 
				$noti_info = '卖方修改了您的的订单#'.$order_id.' '.'<a target="_blank" href="'.$_K['siteurl'].'/shop.php?do=step&order_id='.$order_id.'">'.$order_info['title'].'</a>,请仔细核对后确认';
				Func_comm_class::notify_user("卖方修改了您的的订单",$noti_info,$order_info['buy_uid']);
				$userinfo = Func_comm_class::getuserinfo($order_info['buy_uid']);
				if ($userinfo['email'])Func_comm_class::sendMail($userinfo['email'],'卖方修改了您的的订单#'.$order_id.' '.$order_info['title'].'',$noti_info);
			}
		}
		else {
			$service_order_obj->setBuyer_status(1);
			$service_order_obj->setSale_status(0);
			
			 
			if ($order_info['sale_status']==1){
			 
				$noti_info = '买方修改了您的的订单#'.$order_id.' '.'<a target="_blank" href="'.$_K['siteurl'].'/shop.php?do=step&order_id='.$order_id.'">'.$order_info['title'].'</a>,请仔细核对后确认';
				Func_comm_class::notify_user("买方修改了您的的订单",$noti_info,$order_info['sale_uid']);
				$userinfo = Func_comm_class::getuserinfo($order_info['sale_uid']);
				if ($userinfo['email'])Func_comm_class::sendMail($userinfo['email'],'买方修改了您的的订单#'.$order_id.' '.$order_info['title'].'',$noti_info);
			}
		}
 
		$service_order_obj->setWhere("order_id = '$order_id'");
		$res +=$service_order_obj->edit_keke_witkey_service_order();
		Func_comm_class::showmessage("修改成功","shop.php?do=step&order_id=$order_id",3,'订单修改成功,请等待确认！');
	
}

 
if ($op == 'acceptorder'){
	
	if ($order_info['order_status']){
		Func_comm_class::showmessage("错误提示","shop.php?do=step&order_id=$order_id",3,'此订单已在进行中！','error');
	}
	
	$res = 0;
	$service_step_obj = new Keke_witkey_service_order_detail_class();
	if ($uid == $shop_info['uid']){
	 
		if ($order_info['buyer_status']){
			$service_order_obj->setWhere("order_id=$order_id");
			$service_order_obj->setSale_status(1);
			$res+=$service_order_obj->edit_keke_witkey_service_order();
			
			Func_comm_class::notify_user('订单确认',"卖方<a target=\"_blank\" href=\"index.php?do=space&member_id=$uid\"></a>已确认，订单<a target=\"_blank\" href=\"shop.php?do=step&order_id={$order_id}\">{$order_info['title']}</a>需要付款",$order_info['buy_uid'],$order_info['buy_username']);
			Func_comm_class::showmessage("订单确认成功","shop.php?do=step&order_id=$order_id");
		}
	}
	elseif ($uid==$order_info['buy_uid']){
 
			if ($basic_config['credit_is_allow']==2){
				$userinfo['credit']=0;
			}
		
			if ($order_info['sale_status']){
				if ($userinfo['balance']+$userinfo['credit']>=$order_info['count_cash']){
				 
					
				 
					$order_cash = $order_info['count_cash'];
					$user_credit = floatval($user_info['credit'])+0;
					$user_balance = floatval($user_info['balance'])+0;
					$finance_obj = new Keke_witkey_finance_class();
					$finance_obj->setFina_type(1);
					$sy_credit =  $user_credit-$order_cash;
					if($sy_credit>0)
					{
					 $service_order_obj->setCost_credit($order_cash);  
					 db_factory::execute("update " .TABLEPRE."witkey_space set credit = credit-{$order_cash} where uid ={$uid}");
					 $finance_obj->setFina_credit($order_cash);
				 
					 $u_credit_arr = db_factory::query("select credit from ".TABLEPRE."witkey_space where uid =".$uid);
					 $user_credit = $basic_config['credit_is_allow']==2?$u_credit_arr[0]['credit']:0;
					 $finance_obj->setFina_narrate(21);
					 $finance_obj->setUser_credit($user_credit);
					 }
					 else 
					 {
					 	$service_order_obj->setCost_credit($user_credit);
					  	$service_order_obj->setCost_cash(abs($sy_credit));  
					  	db_factory::execute("update " .TABLEPRE."witkey_space set credit = credit-{$user_credit},balance = balance-".abs($sy_credit)." where uid ={$uid}");
					  	$finance_obj->setFina_cash(abs($sy_credit));
					  	$finance_obj->setFina_credit($user_credit);
					  	$u_space_arr = db_factory::query("select credit,balance from ".TABLEPRE."witkey_space where uid =".$uid);
					  	$user_credit = $basic_config['credit_is_allow']==2?$u_space_arr[0]['credit']:0;
					  	$finance_obj->setFina_narrate(21);
					  	$finance_obj->setUser_balance($u_space_arr[0]['balance']);
					  	$finance_obj->setUser_credit($user_credit);
					  	$finance_obj->create_keke_witkey_finance();
					 }
					
					
					
					
			 
					$service_order_obj->setWhere("order_id=$order_id");
					$service_order_obj->setBuyer_status(1);
					$service_order_obj->setOrder_status(1);
					$res+=$service_order_obj->edit_keke_witkey_service_order();
					$service_step_obj->setWhere("detail_id={$order_detail_arr[1]['detail_id']}");
					$service_step_obj->setStep_status(1);
					$service_step_obj->edit_keke_witkey_service_order_detail();
					
				 
					Func_comm_class::feed_add("<a target=\"_blank\" href=\"index.php?do=space&member_id={$order_info['buy_uid']}\">{$order_info['buy_username']}</a>购买了服务<a href=\"shop.php?do=service_info&sid={$order_info['service_id']}\" target=\"_blank\">{$order_info['title']}</a>",$order_info['buy_uid'],$order_info['buy_username'],'confirm_order',$order_id);
					Func_comm_class::notify_user('订单确认',"<a target=\"_blank\" href=\"index.php?do=space&member_id=$uid\"></a>已确认付款，订单<a target=\"_blank\" href=\"shop.php?do=step&order_id={$order_id}\">{$order_info['title']}</a>进入进行状态",$shop_info['uid'],$shop_info['username']);
					
					Func_comm_class::showmessage("订单确认成功","shop.php?do=step&order_id=$order_id");
				}
				else {
					Func_comm_class::showmessage("跳转","index.php?do=user&view=cash&type=service&obj_id=$order_id&cash={$order_info['count_cash']}",1,"转入在线支付流程");
					 
				}
				
				
				
				
			}
	}
	else {
		Func_comm_class::showmessage("错误提示",$_K['siteurl'],3,'参数错误！','error');
	}
	

}

 
if ($op == 'acceptstep'){
	$service_step_obj = new Keke_witkey_service_order_detail_class();
	
 
	if (!$step_id)
	{
		Func_comm_class::showmessage("错误提示",$_K['siteurl'],3,'参数错误！','error');
	}
	;
	$step_info = $order_detail_arr[$step_id];
	
	if (!$step_info){
		Func_comm_class::showmessage("错误提示",$_K['siteurl'],3,'参数错误！','error');
	}
	
	if ($step_info['step_status']==1){
 
		if ($uid==$shop_info['uid']){
			$service_step_obj->setWhere("order_id = $order_id and step_num = $step_id");
			$service_step_obj->setStep_status(2);
			$service_step_obj->edit_keke_witkey_service_order_detail();
			Func_comm_class::notify_user("订单阶段确认","<a href=\"index.php?do=space&member_id=$uid\">$username</a>已完成了订单<a href=\"index.php?do=shop&view=step&order_id={$order_id}\">{$order_info['title']}</a>的第{$step_info['step_num']}阶段,请确认",$order_info['buy_uid'],$order_info['buy_username']);
			Func_comm_class::showmessage("操作完成","shop.php?do=step&order_id=$order_id");
		}
	}
	elseif($step_info['step_status']==2){
 
		if ($uid==$order_info['buy_uid']){
		 
			$service_step_obj->setWhere("order_id = $order_id and step_num = $step_id");
			$service_step_obj->setStep_status(3);
			$service_step_obj->edit_keke_witkey_service_order_detail();
			if ($order_detail_arr[$step_id+1]){
		 
				$service_step_obj->setWhere("step_num = ".($step_id+1)." and order_id=$order_id");
				$service_step_obj->setStep_status(1);
				$service_step_obj->edit_keke_witkey_service_order_detail();
		 
				Func_comm_class::notify_user("订单阶段开启","<a href=\"index.php?do=space&member_id=$uid\">$username</a>已确认 了订单<a href=\"shop.php?do=step&order_id={$order_id}\">{$order_info['title']}</a>的第{$step_info['step_num']}阶段,第".($step_info['step_num']+1)."阶段开启",$shop_info['uid'],$shop_info['username']);
				Func_comm_class::showmessage("操作完成","shop.php?do=step&order_id=$order_id");
			}
			else {
			 
				$service_order_obj->setWhere("order_id = '$order_id'");
				$service_order_obj->setOrder_status(7);
				$service_order_obj->edit_keke_witkey_service_order();
				
		 
				db_factory::execute("update ".TABLEPRE."witkey_space set balance=balance+".$order_info['count_cash']." where uid = '{$shop_info['uid']}'");
				
				$shop_userinfo = Func_comm_class::getuserinfo($shop_info['uid']);
			 
				$fina_obj = new Keke_witkey_finance_class();
				$fina_obj->setFina_cash($order_info['count_cash']);
				$fina_obj->setFina_narrate(22);
				$fina_obj->setFina_time(time());
				$fina_obj->setFina_type(2);
				$fina_obj->setUid($shop_info['uid']);
				$fina_obj->setUser_balance($shop_userinfo['balance']);
				$fina_obj->setUsername($shop_userinfo['username']);
				$fina_obj->create_keke_witkey_finance();
				
				
				Func_comm_class::notify_user("订单完成","<a href=\"index.php?do=space&member_id=$uid\">$username</a>已确认 了订单<a href=\"shop.php?do=step&order_id={$order_id}\">{$order_info['title']}</a>的第{$step_info['step_num']}阶段,订单完成，服务费已支付 ,&nbsp;&nbsp;&nbsp;<a href=\"javascript:;\" onclick=\"showWindow(\'buyer_mark\', \'index.php?do=mark&obj_id={$order_info[order_id]}&mark_type=2\');\">评价买家</a>",$shop_info['uid'],$shop_info['username']);
				if ($inajax){
					Func_comm_class::echojson(1);
				}
				else {
					Func_comm_class::showmessage("操作完成","shop.php?do=step&order_id=$order_id");
				}
			}
		}
	}
}

if ($op == 'refusestep'){
	if ($uid == $order_info['buy_uid']){
		$service_step_obj = new Keke_witkey_service_order_detail_class();
		$service_step_obj->setWhere("step_num='$step_id' and order_id = $order_id");
		$service_step_obj->setStep_status(1);
		$service_step_obj->edit_keke_witkey_service_order_detail();
		Func_comm_class::notify_user("订单审核失败","订单<a href=\"shop.php?do=step&order_id={$order_id}\">{$order_info['title']}</a>的第{$step_id}阶段没有通过买家的审核，请检查确认",$shop_info['uid'],$shop_info['username']);
		Func_comm_class::showmessage("操作完成","shop.php?do=step&order_id=$order_id");
	}
}



require_once $template_obj->template("shop/tpl/{$_K['template']}/".$do);

