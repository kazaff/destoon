<?php

  class Keke_witkey_vip_history_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_h_id; //主键 
		 var $_uid; 
		 var $_username; 
		 var $_start_time; 
		 var $_end_time; 
		 var $_day; 
		 var $_cash_cost; 
		 var $_credit_cost; 
		 var $_h_status; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_vip_history_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_vip_history";
		 }
	    

	    		function getH_id(){
			 return $this->_h_id ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getStart_time(){
			 return $this->_start_time ;
		}
		function getEnd_time(){
			 return $this->_end_time ;
		}
		function getDay(){
			 return $this->_day ;
		}
		function getCash_cost(){
			 return $this->_cash_cost ;
		}
		function getCredit_cost(){
			 return $this->_credit_cost ;
		}
		function getH_status(){
			 return $this->_h_status ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setH_id($value){ 
			 $this->_h_id = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setStart_time($value){ 
			 $this->_start_time = $value;
		}
		function setEnd_time($value){ 
			 $this->_end_time = $value;
		}
		function setDay($value){ 
			 $this->_day = $value;
		}
		function setCash_cost($value){ 
			 $this->_cash_cost = $value;
		}
		function setCredit_cost($value){ 
			 $this->_credit_cost = $value;
		}
		function setH_status($value){ 
			 $this->_h_status = $value;
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
		 * 表keke_witkey_vip_history创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_vip_history(){
		 		 $data =  array(); 

					if(!is_null($this->_h_id)){ 
				 $data['h_id']=$this->_h_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_start_time)){ 
				 $data['start_time']=$this->_start_time;
			}
			if(!is_null($this->_end_time)){ 
				 $data['end_time']=$this->_end_time;
			}
			if(!is_null($this->_day)){ 
				 $data['day']=$this->_day;
			}
			if(!is_null($this->_cash_cost)){ 
				 $data['cash_cost']=$this->_cash_cost;
			}
			if(!is_null($this->_credit_cost)){ 
				 $data['credit_cost']=$this->_credit_cost;
			}
			if(!is_null($this->_h_status)){ 
				 $data['h_status']=$this->_h_status;
			}

			 return $this->_h_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_vip_history的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_vip_history(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_h_id)){ 
				 $data['h_id']=$this->_h_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_start_time)){ 
				 $data['start_time']=$this->_start_time;
			}
			if(!is_null($this->_end_time)){ 
				 $data['end_time']=$this->_end_time;
			}
			if(!is_null($this->_day)){ 
				 $data['day']=$this->_day;
			}
			if(!is_null($this->_cash_cost)){ 
				 $data['cash_cost']=$this->_cash_cost;
			}
			if(!is_null($this->_credit_cost)){ 
				 $data['credit_cost']=$this->_credit_cost;
			}
			if(!is_null($this->_h_status)){ 
				 $data['h_status']=$this->_h_status;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('h_id' => $this->_h_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_vip_history,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_vip_history(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_vip_history(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_vip_history(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where h_id = $this->_h_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>