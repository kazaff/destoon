<?php

class Pay_return_fac_class {
	var $_model_id;
	var $_uid;
	var $_username;
	var $_order_type;
	var $_order_id;
	var $_total_fee;
	var $_obj_id;
	var $_pay_m;
	var $_userinfo;
	
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
	function __construct($model_id='',$uid = '', $obj_id = '', $order_type = '', $order_id = '', $total_fee = '', $pay_m = 1) {
		$this->_userinfo = Func_comm_class::getuserinfo ( $uid );
		$this->_model_id = $model_id;
		$this->_uid = $uid;
		$this->_username = $user_info ['username'];
		$this->_order_type = $order_type;
		$this->_order_id = $order_id;
		$this->_total_fee = $total_fee;
		$this->_obj_id = $obj_id;
		$this->_pay_m = $pay_m;
		$this->update_space ();
		
	}
 
	function load() {
		global $model_list;
		$model_list = $model_list?$model_list:Cache_ext_Class::gettabledata('witkey_model','model_status=1','',null,'model_id');
		$model_id = $this->_model_id ;
		if ($model_id){
		$model_dir = $model_list[$this->_model_id]['model_dir'];
		$m = ucwords($model_dir)."_pay_return_class";
		$pay_obj = new $m($this->_uid,$this->_obj_id,$this->_order_type,$this->_order_id,$this->_total_fee);
		}
		switch ($this->_order_type){
			case "task":
				$pay_obj->task_charge();
				break;
			case "vip":
				$this->vip_charge();
				break;
			case "delay":
				$pay_obj->delay_charge();
				break;
			case "service":
				$this->service_charge();
				break;
			case "service_buy":
				$this->service_buy_charge();
				break;
			default:
				$this->create_finance_log ();
				break;
			
			
		}
	}
	
	private function update_space() {
		db_factory::execute ( "update " . TABLEPRE . "witkey_space set balance = balance+$this->_total_fee where uid = $this->_uid " );
	}
 
	private function create_finance_log() {
		$user_info = Func_comm_class::getuserinfo ( $this->_uid );
		$finance_obj = new Keke_witkey_finance_class ( );
		$finance_obj->setFina_type ( 2 );
	 
		$finance_obj->setFina_narrate ( 1 );
		$finance_obj->setOrder_id ( $this->_order_id );
		$finance_obj->setUid ( $user_info['uid'] );
		$finance_obj->setUsername ($user_info['username'] );
		if ($this->_order_type == 'task') {
			$finance_obj->setTask_id ( $this->_obj_id );
		}
		$finance_obj->setFina_cash ( $this->_total_fee );
		$finance_obj->setUser_balance ( $user_info ['balance'] );
		$finance_obj->setFina_approach ( $this->_pay_m );
		$finance_obj->setFina_time ( time () );
		$finance_obj->setSite_cash($this->_total_fee);
		$finance_obj->create_keke_witkey_finance ();
	}
	
	private function vip_charge() {
		global $basic_config;
		if ($this->_order_type == 'vip') {
		 
			$vip_history_obj = new Keke_witkey_vip_history_class ( );
			$vip_history_obj->setWhere ( "h_id = $this->_obj_id and uid = $this->_uid and h_status =0" );
			$vip_history_info = $vip_history_obj->query_keke_witkey_vip_history ();
			$user_info = $this->_userinfo;
			
		 
			$finance_obj = new Keke_witkey_finance_class ( );
			$finance_obj->setFina_type ( 1 );
			$finance_obj->setUid ( $this->_uid );
			$finance_obj->setUsername ( $this->_username );
	 
			if (count ( $vip_history_info ) == 1) {
	 
				$user_info ['credit'] = $basic_config ['credit_is_allow'] == 1 ? $user_info ['credit'] : 0;
				$vip_cash = $vip_history_info [0] ['cash_cost'] + $vip_history_info [0] ['credit_cost'];
				$user_credit = floatval ( $user_info ['credit'] ) + 0;
				$user_balance = floatval ( $user_info ['balance'] ) + 0;
				if ($user_credit + $user_balance < $vip_cash)
					die ();
				 	
				$vip_history_obj->setH_status ( 1 );
				$sy_credit = $user_credit - $vip_cash;
				if ($sy_credit > 0) {
					$vip_history_obj->setCredit_cost ( $vip_cash );
					$vip_history_obj->setCash_cost ( 0 );
					db_factory::execute ( "update " . TABLEPRE . "witkey_space set credit=credit-{$vip_cash} where uid='$this->_uid'" );
			 
					$u_credit_arr = db_factory::query ( "select credit from " . TABLEPRE . "witkey_space where uid =" . $this->_uid );
					$finance_obj->setFina_narrate ( 7 );
					$finance_obj->setUser_credit ( $u_credit_arr [0] ['credit'] );
				} else {
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
				$vip_history_obj->setH_id ( $this->_obj_id );
				$vip_history_obj->setH_status ( 1 );
				$vip_history_obj->edit_keke_witkey_vip_history ();
			 
				$user_vip_end_time = $user_info [0] ['vip_end_time'];
				$buy_time = $vip_history_info [0] ['day'] + 24 * 3600;
				if ($user_vip_end_time > time ()) { //用户VIP到期时间大于当前时间
			 
					db_factory::execute ( "update" . TABLEPRE . "witkey_space set vip_end_time = vip_end_time+$buy_time where uid =$this->_uid" );
				 
					db_factory::execute ( "update" . TABLEPRE . "witkey_vip_history set start_time =" . time () . " , end_time = " . $user_vip_end_time + $buy_time . "  where h_id = $this->_obj_id" );
				} else {
					db_factory::execute ( "update" . TABLEPRE . "witkey_space set vip_end_time = " . time () + $buy_time . " where uid =$this->_uid" );
					db_factory::execute ( "update" . TABLEPRE . "witkey_vip_history set start_time =" . time () . " , end_time = " . time () + $buy_time . "  where h_id = $this->_obj_id" );
				}
				
				Func_comm_class::feed_add ( '<a href="index.php?do=space&member_id=' . $this->_uid . '">' . $this->_username . '</a>充值了VIP', $this->_uid, $this->_username, 'vip' );
				Func_comm_class::sendMail($user_info['email'],'vip充值'.$this->_total_fee.'元 成功',"信息来自".$basic_config['website_name']."无需回复");
		 
				$finance_obj->setSite_cash($this->_total_fee);
		 
				$finance_obj->setSite_profit($vip_cash);
				$finance_obj->setFina_time ( time () );
				$finance_obj->create_keke_witkey_finance ();
			}
		}
	
	}
	
	private function service_charge(){
		global $basic_config;
		$this->create_finance_log();
		$service_order_obj = new Keke_witkey_service_order_class();
		$order_id = $this->_obj_id;
		$service_order_obj->setWhere("order_id='$order_id'");
		$order_info = $service_order_obj->query_keke_witkey_service_order();
		$order_info = $order_info[0];
	 
		if (!$order_info){
			echo 'error:order not found';die();
		}
		$shop_info = db_factory::query("select a.*,b.* from ".TABLEPRE."witkey_shop a left join ".TABLEPRE."witkey_space b on b.uid = a.uid where a.shop_id = '{$order_info['shop_id']}'");
		$shop_info = $shop_info[0];echo '<br>';
		if (!$shop_info){
			echo 'error:shop not found or closed';die();
		}
		
		if ($order_info['order_status']){
			echo 'order already paid';die();
		}
		
		$userinfo=$user_info = Func_comm_class::getuserinfo($order_info['buy_uid']);echo '<br>';
		
		$order_detail_arr = Cache_ext_Class::gettabledata("witkey_service_order_detail","order_id='$order_id'","step_num",0,'step_num');
		
		
		if (!$order_info['order_status']){
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
					 db_factory::execute("update " .TABLEPRE."witkey_space set credit = credit-{$order_cash} where uid ={$order_info['buy_uid']}");
					 $finance_obj->setFina_credit($order_cash);
					 
					 $u_credit_arr = db_factory::query("select credit from ".TABLEPRE."witkey_space where uid =".$order_info['buy_uid']);
					 $user_credit = $basic_config['credit_is_allow']==1?$u_credit_arr[0]['credit']:0;
					 $finance_obj->setFina_narrate(21);
					 $finance_obj->setUser_credit($user_credit);
					 }
					 else 
					 {
					 	$service_order_obj->setCost_credit($user_credit);
					  	$service_order_obj->setCost_cash(abs($sy_credit));  
					  	db_factory::execute("update " .TABLEPRE."witkey_space set credit = credit-{$user_credit},balance = balance-".abs($sy_credit)." where uid ={$order_info['buy_uid']}");
					  	$finance_obj->setFina_cash(abs($sy_credit));
					  	$finance_obj->setFina_credit($user_credit);
					  	$u_space_arr = db_factory::query("select credit,balance from ".TABLEPRE."witkey_space where uid =".$order_info['buy_uid']);
					  	$user_credit = $basic_config['credit_is_allow']==1?$u_space_arr[0]['credit']:0;
					  	$finance_obj->setFina_narrate(21);
					  	$finance_obj->setUser_balance($u_space_arr[0]['balance']);
					  	$finance_obj->setUser_credit($user_credit);
					  	$finance_obj->create_keke_witkey_finance();
					 }
					
					
					
					$service_step_obj = new Keke_witkey_service_order_detail_class();
				 
					$service_order_obj->setWhere("order_id=$order_id");
					$service_order_obj->setBuyer_status(1);
					$service_order_obj->setOrder_status(1);
					$res+=$service_order_obj->edit_keke_witkey_service_order();
					$service_step_obj->setWhere("detail_id={$order_detail_arr[1]['detail_id']}");
					$service_step_obj->setStep_status(1);
					$service_step_obj->edit_keke_witkey_service_order_detail();
					
					 
					Func_comm_class::feed_add("<a target=\"_blank\" href=\"index.php?do=space&member_id={$order_info['buy_uid']}\">{$order_info['buy_username']}</a>购买了服务<a href=\"shop.php?do=service_info&sid={$order_info['service_id']}\" target=\"_blank\">{$order_info['title']}</a>",$order_info['buy_uid'],$order_info['buy_username'],'confirm_order',$order_id);
					Func_comm_class::notify_user('订单确认',"<a target=\"_blank\" href=\"index.php?do=space&member_id={$order_info['buy_uid']}\"></a>已确认付款，订单<a target=\"_blank\" href=\"index.php?do=shop&view=step&order_id={$order_id}\">{$order_info['title']}</a>进入进行状态",$shop_info['uid'],$shop_info['username']);
			}
			else {
				 
				echo '您的余额不足！';
			}
			
		}
	}
	
	private function service_buy_charge(){
	global $basic_config;
	$this->create_finance_log();
	$order_id = $this->_obj_id;
	
 
	$service_order_obj = new Keke_witkey_service_order_class();
	$service_order_obj->setWhere("order_id = $order_id");
	$order_info = $service_order_obj->query_keke_witkey_service_order();
	$order_info = $order_info[0];
	$uid =$order_info['buy_uid'];
	$username = $order_info['buy_username'];
	
	$user_info = Func_comm_class::getuserinfo($uid);
	
	$shop_config = db_factory::query ( "select * from " . TABLEPRE . "witkey_shop_tpl_pconfig where shop_id = '{$shop_info['shop_id']}' " );
	$shop_config = $shop_config[0];

 
	if ($service_info['price']>$user_info['balance']+$user_info['credit']){
		die();
	}
	
	$sid = $order_info['sid'];
	$service_obj = new Keke_witkey_service_class();
	$service_obj->setWhere("service_id = {$order_info['service_id']}");
	$service_info = $service_obj->query_keke_witkey_service();
	$service_info = $service_info[0];
	$sid = $service_info['service_id'];
	
	$shop_id = $service_info['shop_id'];
	$shop_obj = new Keke_witkey_shop_class();
	$shop_obj->setWhere("shop_id = {$order_info['shop_id']}");
	$shop_info = $shop_obj->query_keke_witkey_shop();
	$shop_info = $shop_info[0];
	
		
 
	$user_info = Func_comm_class::getuserinfo($uid);
	$cost_cash=$count_cash = $service_info['price'];
	if ($basic_config['credit_is_allow']){
		$user_info['credit']=0;
	}
	$cost_credit = $user_info['credit']>=$count_cash?$count_cash:$user_info['credit'];
	$cost_cash-=$cost_credit;
	
	if ($cost_credit){
		db_factory::execute("update ".TABLEPRE."witkey_space set credit=credit-$cost_credit where uid = '$uid'");
	}
	if ($cost_cash){
		db_factory::execute("update ".TABLEPRE."witkey_space set balance=balance-$cost_cash where uid = '$uid'");
	}
 
	$pay_cash = $count_cash;
	if ($shop_config['down_prorate']){
		$pay_cash = $pay_cash*(100-$shop_config['down_prorate'])/100;
	}
	db_factory::execute("update ".TABLEPRE."witkey_space set balance=balance+$pay_cash where uid='{$shop_info['uid']}'");
	
	
	$service_order_obj = new Keke_witkey_service_order_class();
	$service_order_obj->setWhere("order_id = $order_id");
	$service_order_obj->setBuyer_status(1);
	$service_order_obj->setCost_cash($cost_cash);
	$service_order_obj->setCost_credit($cost_credit);
	$service_order_obj->setCount_cash($service_info['price']);
	$service_order_obj->setOrder_status(7);
	$service_order_obj->setSale_uid($service_info['uid']);
	$service_order_obj->setSale_username($service_info['username']);
	$service_order_obj->setSale_status(1);
	$service_order_obj->setService_id($sid);
	$service_order_obj->setService_type($service_info['service_type']);
	$service_order_obj->setShop_id($shop_id);
	$service_order_obj->setTitle($service_info['title']);
	$service_order_obj->edit_keke_witkey_service_order();
	
	
 
	$fina_obj = new Keke_witkey_finance_class();
	$fina_obj->setFina_cash($cost_cash);
	$fina_obj->setFina_credit($cost_credit);
	$fina_obj->setFina_narrate(21);
	$fina_obj->setFina_time(time());
	$fina_obj->setFina_type(1);
	$fina_obj->setOrder_id($order_id);
	$fina_obj->setUid($uid);
	$fina_obj->setUser_balance($user_info['balance']-$cost_cash);
	$fina_obj->setUser_credit($user_info['credit']-$cost_credit);
	$fina_obj->setUsername($username);
	$fina_obj->setSite_profit($count_cash-$pay_cash);
	$fina_obj->setSite_cash($this->_total_fee);
	$fina_obj->create_keke_witkey_finance();
	
 
	$shop_userinfo = Func_comm_class::getuserinfo($shop_info['uid']);
	$fina_obj = new Keke_witkey_finance_class();
	$fina_obj->setFina_cash($count_cash);
	$fina_obj->setFina_narrate(22);
	$fina_obj->setFina_time(time());
	$fina_obj->setFina_type(2);
	$fina_obj->setOrder_id($order_id);
	$fina_obj->setUid($shop_info['uid']);
	$fina_obj->setUser_balance($shop_userinfo['balance']+$pay_cash);
	$fina_obj->setUsername($shop_info['username']);
	$fina_obj->create_keke_witkey_finance();
	
 
	Func_comm_class::feed_add('<a target="_blank" href="index.php?do=space&member_id='.$uid.'" >'.$username.'</a>购买了<a target="_blank" href="index.php?do=space&uid='.$shop_info['uid'].'">'.$shop_info['username'].'</a>的商品<a target="_blank" href="shop.php?do=service_info&sid='.$sid.'">'.$service_info['title'].'</a>',$uid,$username,'buy_service',$sid);
	Func_comm_class::notify_user('商品购买通知','<a target="_blank" href="index.php?do=space&member_id='.$uid.'" >'.$username.'</a>购买了您的商品<a target="_blank" href="shop.php?do=service_info&sid='.$sid.'">'.$service_info['title'].'</a>',$shop_info['uid'],$shop_info['username']);
	}

}

?>