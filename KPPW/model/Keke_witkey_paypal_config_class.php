<?php

  class Keke_witkey_paypal_config_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_paypay_config_id; //主键 
		 var $_currency; 
		 var $_recharge_min; 
		 var $_withdraw_min; 
		 var $_withdraw_max; 
		 var $_alipay_num; 
		 var $_alipay_partner; 
		 var $_alipay_safety_code; 
		 var $_tenpay_seller_id; 
		 var $_tenpay_ckey; 
		 var $_chinabank_seller_id; 
		 var $_chinabank_ckey; 
		 var $_on_time; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_paypal_config_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_paypal_config";
		 }
	    

	    		function getPaypay_config_id(){
			 return $this->_paypay_config_id ;
		}
		function getCurrency(){
			 return $this->_currency ;
		}
		function getRecharge_min(){
			 return $this->_recharge_min ;
		}
		function getWithdraw_min(){
			 return $this->_withdraw_min ;
		}
		function getWithdraw_max(){
			 return $this->_withdraw_max ;
		}
		function getAlipay_num(){
			 return $this->_alipay_num ;
		}
		function getAlipay_partner(){
			 return $this->_alipay_partner ;
		}
		function getAlipay_safety_code(){
			 return $this->_alipay_safety_code ;
		}
		function getTenpay_seller_id(){
			 return $this->_tenpay_seller_id ;
		}
		function getTenpay_ckey(){
			 return $this->_tenpay_ckey ;
		}
		function getChinabank_seller_id(){
			 return $this->_chinabank_seller_id ;
		}
		function getChinabank_ckey(){
			 return $this->_chinabank_ckey ;
		}
		function getOn_time(){
			 return $this->_on_time ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setPaypay_config_id($value){ 
			 $this->_paypay_config_id = $value;
		}
		function setCurrency($value){ 
			 $this->_currency = $value;
		}
		function setRecharge_min($value){ 
			 $this->_recharge_min = $value;
		}
		function setWithdraw_min($value){ 
			 $this->_withdraw_min = $value;
		}
		function setWithdraw_max($value){ 
			 $this->_withdraw_max = $value;
		}
		function setAlipay_num($value){ 
			 $this->_alipay_num = $value;
		}
		function setAlipay_partner($value){ 
			 $this->_alipay_partner = $value;
		}
		function setAlipay_safety_code($value){ 
			 $this->_alipay_safety_code = $value;
		}
		function setTenpay_seller_id($value){ 
			 $this->_tenpay_seller_id = $value;
		}
		function setTenpay_ckey($value){ 
			 $this->_tenpay_ckey = $value;
		}
		function setChinabank_seller_id($value){ 
			 $this->_chinabank_seller_id = $value;
		}
		function setChinabank_ckey($value){ 
			 $this->_chinabank_ckey = $value;
		}
		function setOn_time($value){ 
			 $this->_on_time = $value;
		}
		function setWhere($value){ 
			 $this->_where = $value;
		}


	    

    	   public  function __set($property_name, $value) {


		 		$this->$property_name = $value; 


			}


			public function __get($property_name) { 


				if (isset ( $this->$property_name )) { 


					return $this->$property_name; 


				} else { 


					return null; 


				} 


			}


    	

	    /**
		 * 表keke_witkey_paypal_config创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_paypal_config(){
		 		 $data =  array(); 

					if(!is_null($this->_paypay_config_id)){ 
				 $data['paypay_config_id']=$this->_paypay_config_id;
			}
			if(!is_null($this->_currency)){ 
				 $data['currency']=$this->_currency;
			}
			if(!is_null($this->_recharge_min)){ 
				 $data['recharge_min']=$this->_recharge_min;
			}
			if(!is_null($this->_withdraw_min)){ 
				 $data['withdraw_min']=$this->_withdraw_min;
			}
			if(!is_null($this->_withdraw_max)){ 
				 $data['withdraw_max']=$this->_withdraw_max;
			}
			if(!is_null($this->_alipay_num)){ 
				 $data['alipay_num']=$this->_alipay_num;
			}
			if(!is_null($this->_alipay_partner)){ 
				 $data['alipay_partner']=$this->_alipay_partner;
			}
			if(!is_null($this->_alipay_safety_code)){ 
				 $data['alipay_safety_code']=$this->_alipay_safety_code;
			}
			if(!is_null($this->_tenpay_seller_id)){ 
				 $data['tenpay_seller_id']=$this->_tenpay_seller_id;
			}
			if(!is_null($this->_tenpay_ckey)){ 
				 $data['tenpay_ckey']=$this->_tenpay_ckey;
			}
			if(!is_null($this->_chinabank_seller_id)){ 
				 $data['chinabank_seller_id']=$this->_chinabank_seller_id;
			}
			if(!is_null($this->_chinabank_ckey)){ 
				 $data['chinabank_ckey']=$this->_chinabank_ckey;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}

			 return $this->_paypay_config_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_paypal_config的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_paypal_config(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_paypay_config_id)){ 
				 $data['paypay_config_id']=$this->_paypay_config_id;
			}
			if(!is_null($this->_currency)){ 
				 $data['currency']=$this->_currency;
			}
			if(!is_null($this->_recharge_min)){ 
				 $data['recharge_min']=$this->_recharge_min;
			}
			if(!is_null($this->_withdraw_min)){ 
				 $data['withdraw_min']=$this->_withdraw_min;
			}
			if(!is_null($this->_withdraw_max)){ 
				 $data['withdraw_max']=$this->_withdraw_max;
			}
			if(!is_null($this->_alipay_num)){ 
				 $data['alipay_num']=$this->_alipay_num;
			}
			if(!is_null($this->_alipay_partner)){ 
				 $data['alipay_partner']=$this->_alipay_partner;
			}
			if(!is_null($this->_alipay_safety_code)){ 
				 $data['alipay_safety_code']=$this->_alipay_safety_code;
			}
			if(!is_null($this->_tenpay_seller_id)){ 
				 $data['tenpay_seller_id']=$this->_tenpay_seller_id;
			}
			if(!is_null($this->_tenpay_ckey)){ 
				 $data['tenpay_ckey']=$this->_tenpay_ckey;
			}
			if(!is_null($this->_chinabank_seller_id)){ 
				 $data['chinabank_seller_id']=$this->_chinabank_seller_id;
			}
			if(!is_null($this->_chinabank_ckey)){ 
				 $data['chinabank_ckey']=$this->_chinabank_ckey;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('paypay_config_id' => $this->_paypay_config_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_paypal_config,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_paypal_config(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_paypal_config(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_paypal_config(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where paypay_config_id = $this->_paypay_config_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>