<?php

final class Tender_pay_return_class extends Pay_return_base_class {
	function __construct($uid = '', $obj_id = '', $order_type = '', $order_id = '', $total_fee = '', $pay_m = 1) {
		parent::__construct ();
		$this->_userinfo = Func_comm_class::getuserinfo ( $uid );
		$this->_uid = $uid;
		$this->_username = $user_info ['username'];
		$this->_order_type = $order_type;
		$this->_order_id = $order_id;
		$this->_total_fee = $total_fee;
		$this->_obj_id = $obj_id;
		$this->_pay_m = $pay_m;
	}
	
	function task_charge() {
		
		$basic_config = $this->_basic_config;
		$user_info = $this->_userinfo;
		$task_obj = new Keke_witkey_task_class ( );
		 
		$task_obj->setWhere ( "task_id= $this->_obj_id and task_status =0 and model_id = 2" );
		$task_info = $task_obj->query_keke_witkey_task ();
		if (count ( $task_info ) == 1) {
			$finance_obj = new Keke_witkey_finance_class ( );
			$finance_obj->setFina_type ( 1 );
			$finance_obj->setUid ( $this->_uid );
			$finance_obj->setUsername ( $this->_username );
			
			$user_info ['credit'] = $basic_config ['credit_is_allow'] == 1 ? $user_info ['credit'] : 0;
			
			$task_cash = intval ( $zb_config ['zb_fees'] ) + 0;
			$user_credit = floatval ( $user_info ['credit'] ) + 0;
			$user_balance = floatval ( $user_info ['balance'] ) + 0;
			if ($user_credit + $user_balance < $task_cash)
				die ();
			$sy_credit = $user_credit - $task_cash;
			if ($sy_credit > 0) {
				$task_obj->setCredit_cost ( $task_cash );
				db_factory::execute ( "update " . TABLEPRE . "witkey_space set credit = credit-{$task_cash} where uid ={$uid}" );
				$finance_obj->setFina_credit ( $task_cash );
				
				$u_credit_arr = db_factory::query ( "select credit from " . TABLEPRE . "witkey_space where uid =" . $uid );
				$finance_obj->setFina_narrate ( 4 );
				$finance_obj->setUser_credit ( $u_credit_arr [0] ['credit'] );
			
			} else {
				$task_obj->setCredit_cost ( $user_credit );
				$task_obj->setCash_cost ( abs ( $sy_credit ) );
				db_factory::execute ( "update " . TABLEPRE . "witkey_space set credit = credit-{$user_credit},balance = balance-" . abs ( $sy_credit ) . " where uid ={$uid}" );
				$finance_obj->setFina_cash ( abs ( $sy_credit ) );
				$finance_obj->setFina_credit ( $user_credit );
				$u_space_arr = db_factory::query ( "select credit,balance from " . TABLEPRE . "witkey_space where uid =" . $uid );
				$finance_obj->setFina_narrate ( 4 );
				$finance_obj->setUser_balance ( $u_space_arr [0] ['balance'] );
				$finance_obj->setUser_credit ( $u_space_arr [0] ['credit'] );
			}
			
			$finance_obj->setSite_cash($this->_total_fee);
			
			$finance_obj->setSite_profit($task_cash);
			
			$finance_obj->create_keke_witkey_finance();
			
			if ($zb_config ['zb_audit'] == 1) {
				$task_obj->setTask_status ( 1 );
				
			} else {
				$task_obj->setTask_status ( 2 );
			}
			db_factory::execute ( "update " . TABLEPRE . "witkey_space set pub_num = pub_num+1 where uid = $uid" );
		
		}
	
	}
	
	function delay_charge() {
	
	}
}

?>