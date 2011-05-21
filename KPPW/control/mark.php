<?php
/**
 * @copyright keke-teach
 * @author shang
 * @version v 1.0
 * 2010-6-30早上11:59:00
 */
if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$mark_type = $mark_type?$mark_type:1;

$mark_log_obj = new Keke_witkey_mark_log_class();
if ($mark_type==1){
	if($user_type==1){
		$title = '对发布者评分';
	}else{
		$title = '对投稿者评分';
	}

	if (Func_comm_class::submitcheck ('formhash')) {
		//任务相关评分
	
		$task_id = intval($task_id);
		$work_id = intval($work_id);
		$to_uid = intval($to_uid);
		
		//获得相关信息
		$task_info = Cache_ext_Class::gettabledata('witkey_task',"task_id = $task_id",'',0,'',1,1);
		$work_list = Cache_ext_Class::gettabledata('witkey_work',"task_id = '$task_id' and uid in({$task_info['uid']},$to_uid,$uid)",'',0,'work_id');
		$bid_list = Cache_ext_Class::gettabledata('witkey_bid',"task_id = '$task_id' and uid in({$task_info['uid']},$to_uid,$uid)",'',0,'bid_id');
		
		//判断条件
		if (!$work_list&&!$bid_list){
			Func_comm_class::showmessage("您没有权限评分","",3,"",'error');
		}
		
		$user_type = intval($user_type);
		$mark_log_obj->setWhere(' by_uid= '.$uid.' and user_type =1 and obj_id ='.$task_id.' and work_id ='.$work_id.' and mark_status = "" ');
		$mark_log_info[0] = $mark_log_obj->query_keke_witkey_mark_log();
		$mark_log_info = $mark_log_info[0];
		$rdo_mark = intval($rdo_mark);
		if($mark_log_info){
			$mark_log_obj->setWhere(' mark_id ='.intval($mark_log_info[mark_id]));
			$mark_log_obj->setMark_type(1);
			$mark_log_obj->setBy_uid($uid);
			$mark_log_obj->setBy_username($username);
			$mark_log_obj->setUid(intval($to_uid));
			$mark_log_obj->setMark_content($tar_mark_content);
			$mark_log_obj->setWork_id($work_id);
			$mark_log_obj->setObj_id($task_id);
			$mark_log_obj->setUser_type($user_type);
			$mark_log_obj->setMark_status(intval($rdo_mark));
			$mark_log_obj->setMark_time(time());
			if (!$basic_config['auto_mark_time']){
				$mark_log_obj->setObj_cash($task_info['task_cash']);
			}
			$res = $mark_log_obj->edit_keke_witkey_mark_log();
		}else{
			$mark_log_obj->setBy_uid($uid);
			$mark_log_obj->setBy_username($username);
			$mark_log_obj->setMark_type(1);
			$mark_log_obj->setUid(intval($to_uid));
			$mark_log_obj->setObj_id($task_id);
			$tar_mark_content = Func_comm_class::str_filter($tar_mark_content);
			$mark_log_obj->setMark_content($tar_mark_content);
			$mark_log_obj->setWork_id($work_id);
			$mark_log_obj->setUser_type(intval($user_type));
			$mark_log_obj->setMark_status(intval($rdo_mark));
			$mark_log_obj->setMark_time(time());
			if (!$basic_config['auto_mark_time']){
				$mark_log_obj->setObj_cash($task_info['task_cash']);
			}
			$res = $mark_log_obj->create_keke_witkey_mark_log();
			//不自动评价的情况下    评价的同时即计算积分 
			if (!$basic_config['auto_mark_time']){
					$the_log = Cache_ext_Class::gettabledata("witkey_mark_log","obj_id='$task_id' and obj_cash>0 and user_type='$user_type'");
					if ($the_log){
						$edit_col = $user_type==1?"g_m_credit_value":"w_m_credit_value";
						$plus_value = Func_comm_class::get_comment_score($task_info['task_cash'],$rdo_mark);
						db_factory::execute("update ".TABLEPRE."witkey_space set $edit_col=ifnull($edit_col,0)+$plus_value where uid = $to_uid");
					}	
			}
		}
		Func_comm_class::update_score_value($uid,'user_mark',2);
		
		db_factory::execute("update ".TABLEPRE."witkey_space a set seller_good_rate = (select count(*) from ".TABLEPRE."witkey_mark_log where uid=a.uid and mark_status=1 and user_type=1)*100/(select count(*) from ".TABLEPRE."witkey_mark_log where uid=a.uid and user_type=1) where uid='$to_uid'");
		db_factory::execute("update ".TABLEPRE."witkey_space a set buyer_good_rate = (select count(*) from ".TABLEPRE."witkey_mark_log where uid=a.uid and mark_status=1 and user_type=2)*100/(select count(*) from ".TABLEPRE."witkey_mark_log where uid=a.uid and user_type=2) where uid='$to_uid'");
		
		if($res){
			Func_comm_class::showmessage('评分成功！','index.php?do='.$task_type.'&task_id='.$task_id.'&view=favorable');
		}
	}
	
}

elseif($mark_type==2){
	//商城
	$rurl = "shop.php";
	
	if (!$obj_id){
		Func_comm_class::showmessage("参数错误",$rurl,60,"","error");
	}
		
	//是否已存在
	$lg = db_factory::query("select * from ".TABLEPRE."witkey_mark_log where by_uid = $uid and obj_id = '$obj_id'");
	$lg = $lg[0];
	if ($lg)
	{
		Func_comm_class::showmessage("您已评过分",$rurl,3,"","error");
		
	}
	
	//service
	$order_info = db_factory::query("select * from ".TABLEPRE."witkey_service_order a left join ".TABLEPRE."witkey_service b on a.service_id = b.service_id where a.order_id = '$obj_id'");
	$order_info = $order_info[0];

	$user_type = $uid == $order_info['buy_uid']?1:2;
	$rurl = $user_type==1?"index.php?do=user&view=buy_service":"index.php?do=user&view=sell_service";	
	
	$title = $user_type==1?'对卖家评分':"对买家评分";
	
	if ($uid != $order_info['sale_uid']&&$uid != $order_info['buy_uid']){
		Func_comm_class::showmessage("您没有权限评分",$rurl,3,"","error");
	}
		
	if (Func_comm_class::submitcheck ('formhash')) {
		$to_uid = $uid == $order_info['buy_uid']?$order_info['sale_uid']:$order_info['buy_uid'];
		$to_username = $uid == $order_info['buy_username']?$order_info['sale_username']:$order_info['buy_username'];
		$rdo_mark = intval($rdo_mark);
		$mark_log_obj->setBy_uid($uid);
		$mark_log_obj->setBy_username($username);
		$mark_log_obj->setMark_type(2);
		$mark_log_obj->setUid(intval($to_uid));
		$mark_log_obj->setUsername($to_username);
		$mark_log_obj->setObj_id($obj_id);
		$mark_log_obj->setMark_content($tar_mark_content);
		$mark_log_obj->setUser_type(intval($user_type));
		$mark_log_obj->setMark_status(intval($rdo_mark));
		$mark_log_obj->setMark_time(time());
		$mark_log_obj->setObj_cash($order_info['count_cash']);
	
		$res = $mark_log_obj->create_keke_witkey_mark_log();
		// 评价的同时即计算积分 
		if ($the_log){
			$edit_col = $user_type==1?"g_m_credit_value":"w_m_credit_value";
			$plus_value = Func_comm_class::get_comment_score($order_info['count_cash'],$rdo_mark);
			db_factory::execute("update ".TABLEPRE."witkey_space set $edit_col=ifnull($edit_col,0)+$plus_value where uid = $to_uid");
		}
		
		Func_comm_class::update_score_value($uid,'user_mark',2);
			
		db_factory::execute("update ".TABLEPRE."witkey_space a set seller_good_rate = (select count(*) from ".TABLEPRE."witkey_mark_log where uid=a.uid and mark_status=1 and user_type=1)*100/(select count(*) from ".TABLEPRE."witkey_mark_log where uid=a.uid and user_type=1) where uid='$to_uid'");
		db_factory::execute("update ".TABLEPRE."witkey_space a set buyer_good_rate = (select count(*) from ".TABLEPRE."witkey_mark_log where uid=a.uid and mark_status=1 and user_type=2)*100/(select count(*) from ".TABLEPRE."witkey_mark_log where uid=a.uid and user_type=2) where uid='$to_uid'");
			
		if($res){
			Func_comm_class::showmessage('评分成功！',$rurl);
		}
	}
}
	


require_once  $template_obj->template ( $do );