<?php
class Order_class {
	
	var $_uid;
	var $_username;
	var $_order_type;
	var $_order_id;
	var $_total_fee;
	var $_obj_id;
	var $_pay_m;
	 
	public function __set($property_name, $value) {
		$this->$property_name = $value;
	}
	public function __get($property_name) {
		if (isset ( $this->$property_name )) {
			return $this->$property_name;
		} else {
			return null;
		}
	}
 
	function __construct($uid = '', $obj_id = '', $order_type = '', $order_id = '', $total_fee = '', $pay_m = 1) {
		$user_info = Func_comm_class::getuserinfo ( $uid );
		$this->_uid = $uid;
		$this->_username = $user_info ['username'];
		$this->_order_type = $order_type;
		$this->_order_id = $order_id;
		$this->_total_fee = $total_fee;
		$this->_obj_id = $obj_id;
		$this->_pay_m = $pay_m;
		$this->update_space ();
		$this->create_finance_log ();
		switch ($this->_order_type) {
			case 'task':
			 $this->task_charge();
			break;
			case 'vip':
			 $this->vip_charge();
			break;
			case 'delay':
			$this->delay_chareg();
			break;
			default:
			 
				$message_obj = new Message_Class();
				if ($message_obj->validate('success_isnotice')){
					$message_obj->setUid($uid);
					$message_obj->setUsername($this->_username);
					$message_obj->setValue('充值金额',$task_info['task_id']);
					$message_obj->send();
				};
			break;
		}
		
	}
 
	function update_space() {
		db_factory::execute ( "update " . TABLEPRE . "witkey_space set balance = balance+$this->_total_fee where uid = $this->_uid " );
	}
 
	function create_finance_log() {
		$user_info = Func_comm_class::getuserinfo ( $this->_uid );
		$xs_config = Cache_ext_Class::getConfig ( 'xs_task' );
		$finance_obj = new Keke_witkey_finance_class ( );
		$finance_obj->setFina_type ( 1 );
	 
		$finance_obj->setFina_narrate ( 1 );
		$finance_obj->setOrder_id ( $this->_order_id );
		$finance_obj->setUid ( $this->_uid );
		$finance_obj->setUsername ( $this->_username );
		if ($this->_order_type == 'task') {
			$finance_obj->setTask_id ( $this->_obj_id );
		}
		$finance_obj->setFina_cash ( $this->_total_fee );
		$finance_obj->setUser_balance ( $user_info['balance'] );
		$finance_obj->setFina_approach ( $this->_pay_m );
		$finance_obj->setFina_time ( time () );
		$finance_obj->create_keke_witkey_finance ();
	}
 
	function task_charge() {
		if ($this->_order_type == 'task') {
			 
			$basic_config = Cache_ext_Class::getConfig ( 'basic' );
			$user_info = Func_comm_class::getuserinfo ( $this->_uid );
			$task_obj = new Keke_witkey_task_class ( );
			 
			$task_obj->setWhere ( "task_id= $this->_obj_id and task_status =0" );
			$task_info = $task_obj->query_keke_witkey_task ();
			 
			if (count ( $task_info ) == 1) {
			 
				$finance_obj = new Keke_witkey_finance_class ( );
			 
				$finance_objc = new Keke_witkey_finance_class ( );
				
				$finance_obj->setFina_type ( 1 );
				$finance_obj->setUid ( $this->_uid );
				$finance_obj->setUsername ( $this->_username );
				
				$finance_objc->setFina_type ( 1 );
				$finance_objc->setUid ( $this->_uid );
				$finance_objc->setUsername ( $this->_username );
				
		 
				$user_info ['credit'] = $basic_config ['credit_is_allow'] == 1 ? $user_info ['credit'] : 0;
				$task_cash = intval ( $task_info [0] ['task_cash'] ) + 0;
				$prom_cash = intval ( $task_info [0] ['prom_cash'] ) + 0;
				$user_credit = floatval ( $user_info ['credit'] ) + 0;
				$user_balance = floatval ( $user_info ['balance'] ) + 0;
				$is_prom = $task_info [0] ['is_prom'];
				if ($user_credit + $user_balance < $task_cash + $prom_cash)
					die ();
	 
				$sy_credit = $user_credit - $task_cash;
				if ($sy_credit > 0) {
					$task_obj->setCredit_cost ( $task_cash );  
					db_factory::execute ( "update " . TABLEPRE . "witkey_space set credit = credit-{$task_cash} where uid ={$this->_uid}" );
					$finance_obj->setFina_credit ( $task_cash );
	 
					$u_credit_arr = db_factory::query ( "select credit from " . TABLEPRE . "witkey_space where uid =" . $this->_uid );
					$user_credit = $basic_config['credit_is_allow']==1?$u_credit_arr[0]['credit']:0;
					$finance_obj->setFina_narrate ( 4 );
					$finance_obj->setUser_credit ( $u_credit_arr [0] ['credit'] );
				} else {
					$task_obj->setCredit_cost ( $user_credit );
					$task_obj->setCash_cost ( abs ( $sy_credit ) );  
					db_factory::execute ( "update " . TABLEPRE . "witkey_space set credit = credit-{$user_credit},balance = balance-" . abs ( $sy_credit ) . " where uid ={$this->_uid}" );
					$finance_obj->setFina_cash ( abs ( $sy_credit ) );
					$finance_obj->setFina_credit ( $user_credit );
					$u_space_arr = db_factory::query ( "select credit,balance from " . TABLEPRE . "witkey_space where uid =" . $this->_uid );
					$user_credit = $basic_config['credit_is_allow']==1?$u_space_arr[0]['credit']:0;
					$finance_obj->setFina_narrate ( 4 );
					$finance_obj->setUser_balance ( $u_space_arr [0] ['balance'] );
					$finance_obj->setUser_credit ( $u_space_arr [0] ['credit'] );
				}
		 
				if ($is_prom == 1) {
					$sy_creditt = $user_credit - $prom_cash;
					if ($sy_creditt > 0) {
						$task_obj->setProm_credit ( $prom_cash );
						db_factory::execute ( "update " . TABLEPRE . "witkey_space set credit = credit-{$prom_cash} where uid ={$this->_uid}" );
						$finance_objc->setFina_credit ( $prom_cash );
						$u_credit_arr = db_factory::query ( "select credit from " . TABLEPRE . "witkey_space where uid =" . $this->_uid );
			 
						$finance_objc->setFina_narrate ( 5 );
					 
						$finance_objc->setUser_credit ( $u_credit_arr [0] ['credit'] );
					} else {
						$task_obj->setProm_credit ( $user_credit );
						$task_obj->setProm_cash ( abs ( $sy_creditt ) );
						db_factory::execute ( "update " . TABLEPRE . "witkey_space set credit = credit-{$user_credit},balance = balance-" . abs ( $sy_creditt ) . " where uid ={$this->_uid}" );
					 
						$finance_objc->setFina_cash ( abs ( $sy_creditt ) );
						$finance_objc->setFina_credit ( $user_credit );
						$u_space_arr = db_factory::query ( "select credit,balance from " . TABLEPRE . "witkey_space where uid =" . $uid );
						 
						$finance_objc->setFina_narrate ( 5 );
					 
						$finance_objc->setUser_balance ( $u_space_arr [0] ['balance'] );
					 
						$finance_objc->setUser_credit ( $u_space_arr [0] ['credit'] );
					}
				}
				
				db_factory::execute("update ".TABLEPRE."witkey_space set pub_num = pub_num+1 where uid = ".$this->_uid);
				
		 
				if ($task_cash >= $xs_config [audit_cash]) {
					$end_time = $task_info[0]['end_time']-$task_info[0]['start_time']+time();
					$task_obj->setTask_status ( 2 );
					$task_obj->setEnd_time($end_time);
					$task_obj->setStart_time(time());
				 
					$message_obj = new Message_Class();
					if ($message_obj->validate('task_pub_isnotice')){
						$message_obj->setUid($task_info[0]['uid']);
						$message_obj->setUsername($task_info[0]['username']);
						$message_obj->setValue('任务编号',$task_info[0]['task_id']);
						$message_obj->setValue('任务标题',$task_info[0]['task_title']);
						$url= "<a href =\'index.php?do=task&task_id={$task_info[0]['task_id']}\' target=\'_blank\' >{$task_info[0]['task_title']}</a>";
						$message_obj->setValue ( '任务链接', $url );
						$message_obj->setValue('开始时间',date('Y-m-d H:i:s',time()));
						$message_obj->setValue('结束时间',date('Y-m-d H:i:s',$end_time));
						$message_obj->setTitle('任务发布成功');
						$message_obj->send();
					}
					Func_comm_class::feed_add('<a href="index.php?do=space&member_id='.$u_space_arr[0]['uid'].'" target="_blank">'.$u_space_arr[0]['username'].'</a>发布了任务 <a target="_blank" href="index.php?do=task&task_id='.$this->_obj_id.'">'.$task_obj->getTask_title().'</a>',$u_space_arr[0]['uid'],$u_space_arr[0]['username'],'pub_task',$this->_obj_id);
				} else {
					$task_obj->setTask_status ( 1 );
				}
				$task_obj->setTask_id ( $this->_obj_id );
				$task_obj->edit_keke_witkey_task ();
				
			 
				$finance_obj->setTask_id ( $this->_obj_id );
				$finance_obj->setFina_time ( time () );
				$finance_obj->create_keke_witkey_finance ();
				 
				if ($is_prom == 1) {
					$finance_objc->setTask_id ( $this->_obj_id );
					$finance_objc->setFina_time ( time () );
					$finance_objc->create_keke_witkey_finance ();
				}
			}
		}
	}
	 
	function vip_charge() {
		if ($this->_order_type == 'vip') {
		 
			$vip_history_obj = new Keke_witkey_vip_history_class();
			$vip_history_obj->setWhere( "h_id = $this->_obj_id and uid = $this->_uid and h_status =0");
            $vip_history_info = $vip_history_obj->query_keke_witkey_vip_history();
            $user_info = Func_comm_class::getuserinfo ( $this->_uid );
            
            $basic_config = Cache_ext_Class::getConfig ( 'basic' );
 
            $finance_obj = new Keke_witkey_finance_class ( );
            $finance_obj->setFina_type ( 1 );
			$finance_obj->setUid ( $this->_uid );
			$finance_obj->setUsername ( $this->_username );
          
			if(count($vip_history_info)==1){
             
            	$user_info ['credit'] = $basic_config ['credit_is_allow'] == 1 ? $user_info ['credit'] : 0;
            	$vip_cash = $vip_history_info[0]['cash_cost'] + $vip_history_info[0]['credit_cost']; 
            	$user_credit = floatval ( $user_info ['credit'] ) + 0;
				$user_balance = floatval ( $user_info ['balance'] ) + 0;
            	if ($user_credit + $user_balance < $vip_cash)
					die ();
				 	
				$vip_history_obj->setH_status(1);
				$sy_credit = $user_credit - $vip_cash;
				if($sy_credit>0){
					$vip_history_obj->setCredit_cost($vip_cash);
					$vip_history_obj->setCash_cost(0);
					db_factory::execute("update ".TABLEPRE."witkey_space set credit=credit-{$vip_cash} where uid='$this->_uid'");
					 
					$u_credit_arr = db_factory::query ( "select credit from " . TABLEPRE . "witkey_space where uid =" . $this->_uid );
					$finance_obj->setFina_narrate ( 7 );
					$finance_obj->setUser_credit ( $u_credit_arr [0] ['credit'] );
				}else{
					$vip_history_obj->setCredit_cost ( $user_credit );
					$vip_history_obj->setCash_cost ( abs ( $sy_credit ) );
					db_factory::execute ( "update " . TABLEPRE . "witkey_space set credit = credit-{$user_credit},balance = balance-" . abs ( $sy_credit ) . " where uid ={$this->_uid}" );
					$finance_obj->setFina_cash ( abs ( $sy_credit ) );
					$finance_obj->setFina_credit ( $user_credit );
					$u_space_arr = db_factory::query ( "select credit,balance from " . TABLEPRE . "witkey_space where uid =" . $this->_uid );
					$finance_obj->setFina_narrate ( 7 );
					$finance_obj->setUser_balance ( $u_space_arr [0] ['balance'] );
					$finance_obj->setUser_credit ( $u_space_arr [0] ['credit'] );
				}
				$vip_history_obj->setH_id($this->_obj_id);
				$vip_history_obj->setH_status(1);
				$vip_history_obj->edit_keke_witkey_vip_history();
		 
				$user_vip_end_time = $user_info[0]['vip_end_time'];
				$buy_time = $vip_history_info[0]['day']+24*3600;
				if($user_vip_end_time>time()){   
				 
					db_factory::execute("update".TABLEPRE."witkey_space set vip_end_time = vip_end_time+$buy_time where uid =$this->_uid");
				 
					db_factory::execute("update".TABLEPRE."witkey_vip_history set start_time =".time()." , end_time = ".$user_vip_end_time+$buy_time."  where h_id = $this->_obj_id");
				}else{
					db_factory::execute("update".TABLEPRE."witkey_space set vip_end_time = ".time()+$buy_time." where uid =$this->_uid");
					db_factory::execute("update".TABLEPRE."witkey_vip_history set start_time =".time()." , end_time = ".time()+$buy_time."  where h_id = $this->_obj_id");
				}
				
				Func_comm_class::feed_add('<a href="index.php?do=space&member_id='.$this->_uid.'">'.$this->_username.'</a>充值了VIP',$this->_uid,$this->_username,'vip');
				$finance_obj->setFina_time ( time () );
				$finance_obj->create_keke_witkey_finance ();
         }			
		}
	}
 
	function delay_chareg() {
		if ($this->_order_type == 'delay') {
		    $user_info = Func_comm_class::getuserinfo ( $this->_uid );
            $basic_config = Cache_ext_Class::getConfig ( 'basic' );
        
            $finance_obj = new Keke_witkey_finance_class ( );
            $finance_obj->setFina_type ( 1 );
			$finance_obj->setUid ( $this->_uid );
			$finance_obj->setUsername ( $this->_username );
			$finance_obj->setFina_narrate(10);
	 
			$task_delay_obj = new Keke_witkey_task_delay_class();
			$task_delay_obj->setWhere(" delay_id = $this->_obj_id and delay_status>0");
			$task_delay_info =$task_delay_obj->query_keke_witkey_task_delay();
			$task_delay_info = $task_delay_info[0];
			if($task_delay_info)
			{
				$cost_cash = $task_delay_info['delay_cash'];
		 
				if ($cost_cash-$user_info['balance']-$user_info['credit']>0)
				{
			 
			   		$task_delay_obj->setWhere(" delay_id = $this->_obj_id");
			   		$task_delay_obj->setDelay_status(1);
			   		
			   		 
			   		$costs = $task_delay_info['delay_cash'];
					$mycredit = $user_info['credit'];
					$mycash = $user_info['balance'];
					if ($basic_config['credit_is_allow']!=1){
						$mycredit = 0;
					}
			   		$costcredit = $costs>$mycredit?$mycredit:$costs;
			   		$costcash = $costs-$costcredit;
					db_factory::execute("update ".TABLEPRE."witkey_space set balance=balance-".$costcash." , credit=credit-".$costcash." where uid = ".$this->_uid);
			   		
			   
			   		$task_obj = new Keke_witkey_task_class();
			   		$task_obj->setWhere("task_id = '{$task_delay_info['task_id']}'");
			   		$task_info = $task_obj->query_keke_witkey_task();
			   		$task_info = $task_info[0];
			   		$task_obj->setWhere("task_id = '{$task_delay_info['task_id']}'");
			   		$task_obj->setEnd_time($task_info['end_time']+$slt_day*24*3600);
					
					$task_obj->setCredit_cost($task_info['credit_cost']+$costcredit);
					$task_obj->setCash_cost($task_info['cash_cost']+$costcash);
					$task_obj->setTask_cash($task_info['task_cash']+$costs);
					
					if ($task_info['task_mode']==2){
						$prize_obj = new Keke_witkey_task_prize_class();
						$prize_obj->setWhere("task_id='{$task_info['task_id']}'");
						$prizecount = $prize_obj->count_keke_witkey_task_prize();
						db_factory::execute("update ".TABLEPRE."witkey_task_prize set prize_cash = prize_cash+".($costs/$prizecount));
					}
					elseif ($task_info['task_mode']==3){
						$task_obj->setSingle_cash($task_info['single_price']+$costs/$task_info['work_count']);
					}
			   		
			   	  
			   		$finance_obj->setTask_id($task_delay_info['task_id']);
			   		$finance_obj->setFina_cash($costcash);
			   		$finance_obj->setFina_credit($costcredit);
			   		$finance_obj->setUser_balance($mycash-$costcash);
			   		$finance_obj->setUser_credit($mycredit-$costcredit);
			   		$finance_obj->edit_keke_witkey_finance();
				}
				
				
			}
		}
	}

}

?>