<?php

  class Keke_witkey_bank_auth_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_bank_a_id; //主键 
		 var $_uid; 
		 var $_username; 
		 var $_pay_type; 
		 var $_online_pay_tool; 
		 var $_online_pay_account; 
		 var $_bank_account; 
		 var $_bank_name; 
		 var $_deposit_area; 
		 var $_deposit_name; 
		 var $_pay_to_user_cash; 
		 var $_user_get_cash; 
		 var $_pay_time; 
		 var $_cash; 
		 var $_start_time; 
		 var $_end_time; 
		 var $_auth_status; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_bank_auth_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_bank_auth";
		 }
	    

	    		function getBank_a_id(){
			 return $this->_bank_a_id ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getPay_type(){
			 return $this->_pay_type ;
		}
		function getOnline_pay_tool(){
			 return $this->_online_pay_tool ;
		}
		function getOnline_pay_account(){
			 return $this->_online_pay_account ;
		}
		function getBank_account(){
			 return $this->_bank_account ;
		}
		function getBank_name(){
			 return $this->_bank_name ;
		}
		function getDeposit_area(){
			 return $this->_deposit_area ;
		}
		function getDeposit_name(){
			 return $this->_deposit_name ;
		}
		function getPay_to_user_cash(){
			 return $this->_pay_to_user_cash ;
		}
		function getUser_get_cash(){
			 return $this->_user_get_cash ;
		}
		function getPay_time(){
			 return $this->_pay_time ;
		}
		function getCash(){
			 return $this->_cash ;
		}
		function getStart_time(){
			 return $this->_start_time ;
		}
		function getEnd_time(){
			 return $this->_end_time ;
		}
		function getAuth_status(){
			 return $this->_auth_status ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setBank_a_id($value){ 
			 $this->_bank_a_id = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setPay_type($value){ 
			 $this->_pay_type = $value;
		}
		function setOnline_pay_tool($value){ 
			 $this->_online_pay_tool = $value;
		}
		function setOnline_pay_account($value){ 
			 $this->_online_pay_account = $value;
		}
		function setBank_account($value){ 
			 $this->_bank_account = $value;
		}
		function setBank_name($value){ 
			 $this->_bank_name = $value;
		}
		function setDeposit_area($value){ 
			 $this->_deposit_area = $value;
		}
		function setDeposit_name($value){ 
			 $this->_deposit_name = $value;
		}
		function setPay_to_user_cash($value){ 
			 $this->_pay_to_user_cash = $value;
		}
		function setUser_get_cash($value){ 
			 $this->_user_get_cash = $value;
		}
		function setPay_time($value){ 
			 $this->_pay_time = $value;
		}
		function setCash($value){ 
			 $this->_cash = $value;
		}
		function setStart_time($value){ 
			 $this->_start_time = $value;
		}
		function setEnd_time($value){ 
			 $this->_end_time = $value;
		}
		function setAuth_status($value){ 
			 $this->_auth_status = $value;
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
		 * 表keke_witkey_bank_auth创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_bank_auth(){
		 		 $data =  array(); 

					if(!is_null($this->_bank_a_id)){ 
				 $data['bank_a_id']=$this->_bank_a_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_pay_type)){ 
				 $data['pay_type']=$this->_pay_type;
			}
			if(!is_null($this->_online_pay_tool)){ 
				 $data['online_pay_tool']=$this->_online_pay_tool;
			}
			if(!is_null($this->_online_pay_account)){ 
				 $data['online_pay_account']=$this->_online_pay_account;
			}
			if(!is_null($this->_bank_account)){ 
				 $data['bank_account']=$this->_bank_account;
			}
			if(!is_null($this->_bank_name)){ 
				 $data['bank_name']=$this->_bank_name;
			}
			if(!is_null($this->_deposit_area)){ 
				 $data['deposit_area']=$this->_deposit_area;
			}
			if(!is_null($this->_deposit_name)){ 
				 $data['deposit_name']=$this->_deposit_name;
			}
			if(!is_null($this->_pay_to_user_cash)){ 
				 $data['pay_to_user_cash']=$this->_pay_to_user_cash;
			}
			if(!is_null($this->_user_get_cash)){ 
				 $data['user_get_cash']=$this->_user_get_cash;
			}
			if(!is_null($this->_pay_time)){ 
				 $data['pay_time']=$this->_pay_time;
			}
			if(!is_null($this->_cash)){ 
				 $data['cash']=$this->_cash;
			}
			if(!is_null($this->_start_time)){ 
				 $data['start_time']=$this->_start_time;
			}
			if(!is_null($this->_end_time)){ 
				 $data['end_time']=$this->_end_time;
			}
			if(!is_null($this->_auth_status)){ 
				 $data['auth_status']=$this->_auth_status;
			}

			 return $this->_bank_a_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_bank_auth的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_bank_auth(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_bank_a_id)){ 
				 $data['bank_a_id']=$this->_bank_a_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_pay_type)){ 
				 $data['pay_type']=$this->_pay_type;
			}
			if(!is_null($this->_online_pay_tool)){ 
				 $data['online_pay_tool']=$this->_online_pay_tool;
			}
			if(!is_null($this->_online_pay_account)){ 
				 $data['online_pay_account']=$this->_online_pay_account;
			}
			if(!is_null($this->_bank_account)){ 
				 $data['bank_account']=$this->_bank_account;
			}
			if(!is_null($this->_bank_name)){ 
				 $data['bank_name']=$this->_bank_name;
			}
			if(!is_null($this->_deposit_area)){ 
				 $data['deposit_area']=$this->_deposit_area;
			}
			if(!is_null($this->_deposit_name)){ 
				 $data['deposit_name']=$this->_deposit_name;
			}
			if(!is_null($this->_pay_to_user_cash)){ 
				 $data['pay_to_user_cash']=$this->_pay_to_user_cash;
			}
			if(!is_null($this->_user_get_cash)){ 
				 $data['user_get_cash']=$this->_user_get_cash;
			}
			if(!is_null($this->_pay_time)){ 
				 $data['pay_time']=$this->_pay_time;
			}
			if(!is_null($this->_cash)){ 
				 $data['cash']=$this->_cash;
			}
			if(!is_null($this->_start_time)){ 
				 $data['start_time']=$this->_start_time;
			}
			if(!is_null($this->_end_time)){ 
				 $data['end_time']=$this->_end_time;
			}
			if(!is_null($this->_auth_status)){ 
				 $data['auth_status']=$this->_auth_status;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('bank_a_id' => $this->_bank_a_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_bank_auth,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_bank_auth(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_bank_auth(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_bank_auth(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where bank_a_id = $this->_bank_a_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>