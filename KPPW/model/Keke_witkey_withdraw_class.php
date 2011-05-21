<?php

  class Keke_witkey_withdraw_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_withdraw_id; //主键 
		 var $_withdraw_cash; 
		 var $_uid; 
		 var $_username; 
		 var $_withdraw_status; 
		 var $_applic_time; 
		 var $_process_uid; 
		 var $_process_username; 
		 var $_process_time; 
		 var $_pay_zfb; 
		 var $_pay_cft; 
		 var $_pay_bank; 
		 var $_pay_type; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_withdraw_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_withdraw";
		 }
	    

	    		function getWithdraw_id(){
			 return $this->_withdraw_id ;
		}
		function getWithdraw_cash(){
			 return $this->_withdraw_cash ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getWithdraw_status(){
			 return $this->_withdraw_status ;
		}
		function getApplic_time(){
			 return $this->_applic_time ;
		}
		function getProcess_uid(){
			 return $this->_process_uid ;
		}
		function getProcess_username(){
			 return $this->_process_username ;
		}
		function getProcess_time(){
			 return $this->_process_time ;
		}
		function getPay_zfb(){
			 return $this->_pay_zfb ;
		}
		function getPay_cft(){
			 return $this->_pay_cft ;
		}
		function getPay_bank(){
			 return $this->_pay_bank ;
		}
		function getPay_type(){
			 return $this->_pay_type ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setWithdraw_id($value){ 
			 $this->_withdraw_id = $value;
		}
		function setWithdraw_cash($value){ 
			 $this->_withdraw_cash = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setWithdraw_status($value){ 
			 $this->_withdraw_status = $value;
		}
		function setApplic_time($value){ 
			 $this->_applic_time = $value;
		}
		function setProcess_uid($value){ 
			 $this->_process_uid = $value;
		}
		function setProcess_username($value){ 
			 $this->_process_username = $value;
		}
		function setProcess_time($value){ 
			 $this->_process_time = $value;
		}
		function setPay_zfb($value){ 
			 $this->_pay_zfb = $value;
		}
		function setPay_cft($value){ 
			 $this->_pay_cft = $value;
		}
		function setPay_bank($value){ 
			 $this->_pay_bank = $value;
		}
		function setPay_type($value){ 
			 $this->_pay_type = $value;
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
		 * 表keke_witkey_withdraw创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_withdraw(){
		 		 $data =  array(); 

					if(!is_null($this->_withdraw_id)){ 
				 $data['withdraw_id']=$this->_withdraw_id;
			}
			if(!is_null($this->_withdraw_cash)){ 
				 $data['withdraw_cash']=$this->_withdraw_cash;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_withdraw_status)){ 
				 $data['withdraw_status']=$this->_withdraw_status;
			}
			if(!is_null($this->_applic_time)){ 
				 $data['applic_time']=$this->_applic_time;
			}
			if(!is_null($this->_process_uid)){ 
				 $data['process_uid']=$this->_process_uid;
			}
			if(!is_null($this->_process_username)){ 
				 $data['process_username']=$this->_process_username;
			}
			if(!is_null($this->_process_time)){ 
				 $data['process_time']=$this->_process_time;
			}
			if(!is_null($this->_pay_zfb)){ 
				 $data['pay_zfb']=$this->_pay_zfb;
			}
			if(!is_null($this->_pay_cft)){ 
				 $data['pay_cft']=$this->_pay_cft;
			}
			if(!is_null($this->_pay_bank)){ 
				 $data['pay_bank']=$this->_pay_bank;
			}
			if(!is_null($this->_pay_type)){ 
				 $data['pay_type']=$this->_pay_type;
			}

			 return $this->_withdraw_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_withdraw的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_withdraw(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_withdraw_id)){ 
				 $data['withdraw_id']=$this->_withdraw_id;
			}
			if(!is_null($this->_withdraw_cash)){ 
				 $data['withdraw_cash']=$this->_withdraw_cash;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_withdraw_status)){ 
				 $data['withdraw_status']=$this->_withdraw_status;
			}
			if(!is_null($this->_applic_time)){ 
				 $data['applic_time']=$this->_applic_time;
			}
			if(!is_null($this->_process_uid)){ 
				 $data['process_uid']=$this->_process_uid;
			}
			if(!is_null($this->_process_username)){ 
				 $data['process_username']=$this->_process_username;
			}
			if(!is_null($this->_process_time)){ 
				 $data['process_time']=$this->_process_time;
			}
			if(!is_null($this->_pay_zfb)){ 
				 $data['pay_zfb']=$this->_pay_zfb;
			}
			if(!is_null($this->_pay_cft)){ 
				 $data['pay_cft']=$this->_pay_cft;
			}
			if(!is_null($this->_pay_bank)){ 
				 $data['pay_bank']=$this->_pay_bank;
			}
			if(!is_null($this->_pay_type)){ 
				 $data['pay_type']=$this->_pay_type;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('withdraw_id' => $this->_withdraw_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_withdraw,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_withdraw(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_withdraw(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_withdraw(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where withdraw_id = $this->_withdraw_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>