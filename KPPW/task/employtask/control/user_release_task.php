<?php

if(!defined('IN_KEKE')) {
	exit('Access Denied');
}


$task_obj = new Keke_witkey_task_class();

$page_obj = new Pages_Class();

$reward_status_arr = array('0'=>'任务未付款',
							'1'=>'任务待审核',
							'2'=>'任务进行中',
							'3'=>'任务公示中',
							'4'=>'任务投票中',
							'5'=>'任务失败',
							'6'=>'任务冻结',
							'7'=>'任务完成',
							'8'=>'任务审核失败');

$reward_cove_arr = array('1'=>'100元以下',
						 '2'=>'100元—500元',
						 '3'=>'500元—1000元',
						 '4'=>'1000元—5000元',
						 '5'=>'5000元以上');
if($uid){
	$file_path = S_ROOT."./task/".$model_list[$model_id]['model_code']."/control/admin/task_config.xml";
	$xs_config = Xml_Oper_Class::get_xml_toarr($file_path);
    $user_info = Func_comm_class::getuserinfo($uid);
    $basic_config = Cache_ext_Class::getConfig("basic");
    
	$user_info['credit'] = $basic_config['credit_is_allow']==1?$user_info['credit']:0;
	 
	if(isset($ajax)&& $ajax == 'show_confirm'){
		$title = '悬赏任务付款确认';
		$service_cash = $task_cash*$xs_config['deduct_scale']/100;
		require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/tpl/'.$_K['template']."/user_reward_confirm" );
		die();
	}
	if(isset($ajax)&& $ajax == 'pay'){
	  $task_obj  = new Keke_witkey_task_class();
	  $finance_obj = new Keke_witkey_finance_class();
	  $finance_objc = new Keke_witkey_finance_class();
	  $finance_obj->setFina_type(1);
	  $finance_obj->setUid($uid);
	  $finance_obj->setUsername($username);
	  $finance_objc->setFina_type(1);
	  $finance_objc->setUid($uid);
	  $finance_objc->setUsername($username);
      
	  $task_cash = intval($task_cash)+0;
	  $prom_cash = intval($prom_count)+0;
	  $user_credit = floatval($user_info['credit'])+0;
	  $user_balance = floatval($user_info['balance'])+0;
	  
	  if($user_credit+$user_balance < $task_cash+$prom_cash)die(Func_comm_class::echojson('非法提交!',0));
	  $sy_credit =  $user_credit-$task_cash;
		  if($sy_credit>0)
		  {
		  	$task_obj->setCredit_cost($task_cash); 
		  	db_factory::execute("update " .TABLEPRE."witkey_space set credit = credit-{$task_cash} where uid ={$uid}");
		  	$finance_obj->setFina_credit($task_cash);
		  	
		  	$u_credit_arr = db_factory::query("select credit from ".TABLEPRE."witkey_space where uid =".$uid);
		  	$user_credit = $basic_config['credit_is_allow']==1?$u_credit_arr[0]['credit']:0;
		  	$finance_obj->setFina_narrate(4);
		  	$finance_obj->setUser_credit($user_credit);
		  }
		  else 
		  {
		  	$task_obj->setCredit_cost($user_credit);
		  	$task_obj->setCash_cost(abs($sy_credit)); 
		  	db_factory::execute("update " .TABLEPRE."witkey_space set credit = credit-{$user_credit},balance = balance-".abs($sy_credit)." where uid ={$uid}");
		  	$finance_obj->setFina_cash(abs($sy_credit));
		  	$finance_obj->setFina_credit($user_credit);
		  	$u_space_arr = db_factory::query("select credit,balance from ".TABLEPRE."witkey_space where uid =".$uid);
		  	$user_credit = $basic_config['credit_is_allow']==1?$u_space_arr[0]['credit']:0;
		  	$finance_obj->setFina_narrate(4);
		  	$finance_obj->setUser_balance($u_space_arr[0]['balance']);
		  	$finance_obj->setUser_credit($user_credit);
		  }
		  $finance_obj->setTask_id($task_id);
		  $finance_obj->setFina_time(time());
	    
		  if($prom_cash>0)
		  {
			  $sy_creditt = $user_credit - $prom_cash;
			  if($sy_creditt>0){
			  	$task_obj->setProm_credit($prom_cash);
			  	db_factory::execute("update " .TABLEPRE."witkey_space set credit = credit-{$prom_cash} where uid ={$uid}");
			  	$finance_objc->setFina_credit($prom_cash);
			  	$u_credit_arr = db_factory::query("select credit from ".TABLEPRE."witkey_space where uid =".$uid);
			  	
			  	$finance_objc->setFina_narrate(5);
			  	
			  	$finance_objc->setUser_credit($u_credit_arr[0]['credit']);
			  }else{
			  	$task_obj->setProm_credit($user_credit);
			  	$task_obj->setProm_cash(abs($sy_creditt));
			  	db_factory::execute("update " .TABLEPRE."witkey_space set credit = credit-{$user_credit},balance = balance-".abs($sy_creditt)." where uid ={$uid}");
			   
			  	$finance_objc->setFina_cash(abs($sy_creditt));
			  	$finance_objc->setFina_credit($user_credit);
			  	$u_space_arr = db_factory::query("select credit,balance from ".TABLEPRE."witkey_space where uid =".$uid);
			  	
			  	$finance_objc->setFina_narrate(5);
			  	
			  	$finance_objc->setUser_balance($u_space_arr[0]['balance']);
			  	
			  	$finance_objc->setUser_credit($u_space_arr[0]['credit']);
			  }
			  $finance_objc->setTask_id($task_id);
			  $finance_objc->setFina_time(time());
		  }
         
         db_factory::execute("update ".TABLEPRE."witkey_space set pub_num = pub_num+1 where uid = $uid");
		 
		 if($task_cash >=$xs_config[audit_cash])
		 {
		   $finance_obj->setSite_profit($task_cash*$xs_config['deduct_scale']/100);
           $task_obj->setTask_status(2);
           $s = '任务进行中';
		 }
		 else 
		 {
		 	$task_obj->setTask_status(1);
		 	$s = '任务待审核';
		 }
		 $task_obj->setStart_time(time());
		 $task_obj->setEnd_time(time()+24*3600*$task_day);
		 $task_obj->setTask_id($task_id);
		 $res = $task_obj->edit_keke_witkey_task();
		 if($res){
		 	
		 	$finance_objc->create_keke_witkey_finance();
		 	$finance_obj->create_keke_witkey_finance();
		 	Func_comm_class::echojson('任务付款成功！',1,array('status'=>$s));
		 }
	}
	
	$where = ' uid ='.$uid." and model_id = {$model_id} ";
	
	if(isset($slt_task_status)){
		$where.=' and  task_status ='.intval($slt_task_status);
	}
	
	if($txt_task_title){
		$where.=' and task_title like "%'.$txt_task_title.'%"';
	}
	
	
	$txt_start_time = strtotime($txt_start_time);
	$txt_end_time = strtotime($txt_end_time);
	
	if(intval($txt_start_time)&&intval($txt_end_time)){
		if(intval($txt_start_time)>=intval($txt_end_time)){
			Func_comm_class::showmessage('搜索失败','index.php?do='.$do.'&view='.$view,2,'开始时间不能大于结束时间','error');
		}elseif(intval($txt_start_time)==intval($txt_end_time)){
			$where.= ' and start_time = '.intval($txt_start_time);
		}else{
			$where.= ' and start_time >= '.intval($txt_start_time).' and start_time <= '.intval($txt_end_time);
		}
	}
	
	if($slt_cash_cove){
		switch (intval($slt_cash_cove)) {
			case 1:
				$where.=' and task_cash<100 ' ;
			break;
			case 2:
				$where.=' and task_cash>=100 and task_cash<500 ' ;
			break;
			case 3:
				$where.=' and task_cash>=500 and task_cash<1000 ' ;
			break;
			case 4:
				$where.=' and task_cash>=1000 and task_cash<5000 ' ;
			break;
			case 5:
				$where.=' and task_cash>=5000 ' ;
			break;
			default:
				;
			break;
		}
	}
	
	
	$page_size = intval($page_size)?intval($page_size):17;
	
	$task_obj->setWhere($where);
	$count = $task_obj->count_keke_witkey_task();
	
	$url ='index.php?do='.$do.'&model_id='.$model_id.'&view='.$view.'&page_size='.$page_size.'&slt_task_status='.$slt_task_status.'&txt_task_title='.$txt_task_title.'&txt_start_time='.$txt_start_time.'&txt_end_time='.$txt_end_time.'&slt_cash_cove='.$slt_cash_cove.'&slt_order='.$slt_order;
	$page = $_GET ['page'] ? $_GET ['page'] : 1;
	$limit=$page_size;
	$pages = $page_obj->getPages($count,$limit,$page,$url);
	
	$order_where = ' order by start_time desc ';
	
	$where .= $order_where;
	
	$task_obj->setWhere($where.$pages[where]);
	$task_arr = $task_obj->query_keke_witkey_task();
	
	for ($i = 0; $i < count($task_arr); $i++) {
		$task_arr[$i][remaining_time] = Func_comm_class::time2Units($task_arr[$i][end_time]);
	}
	
	
}else{
	Func_comm_class::showmessage('您还没有登录，无法进行此操作！','index.php');
}

require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/tpl/'.$_K['template']."/user_release_task" );
