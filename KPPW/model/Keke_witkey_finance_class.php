<?php
  class Keke_witkey_finance_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_fina_id; //主键 
		 var $_fina_type; 
		 var $_fina_narrate; 
		 var $_order_id; 
		 var $_uid; 
		 var $_username; 
		 var $_task_id; 
		 var $_fina_cash; 
		 var $_user_balance; 
		 var $_fina_credit; 
		 var $_user_credit; 
		 var $_fina_approach; 
		 var $_fina_time; 
		 var $_site_cash; 
		 var $_site_profit; 

	    var $_replace=0;  
	    var $_where;      
	     function  keke_witkey_finance_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_finance";
		 }
	    
	    		function getFina_id(){
			 return $this->_fina_id ;
		}
		function getFina_type(){
			 return $this->_fina_type ;
		}
		function getFina_narrate(){
			 return $this->_fina_narrate ;
		}
		function getOrder_id(){
			 return $this->_order_id ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getTask_id(){
			 return $this->_task_id ;
		}
		function getFina_cash(){
			 return $this->_fina_cash ;
		}
		function getUser_balance(){
			 return $this->_user_balance ;
		}
		function getFina_credit(){
			 return $this->_fina_credit ;
		}
		function getUser_credit(){
			 return $this->_user_credit ;
		}
		function getFina_approach(){
			 return $this->_fina_approach ;
		}
		function getFina_time(){
			 return $this->_fina_time ;
		}
		function getSite_cash(){
			 return $this->_site_cash ;
		}
		function getSite_profit(){
			 return $this->_site_profit ;
		}
		function getWhere(){
			 return $this->_where ;
		}

	    		function setFina_id($value){ 
			 $this->_fina_id = $value;
		}
		function setFina_type($value){ 
			 $this->_fina_type = $value;
		}
		function setFina_narrate($value){ 
			 $this->_fina_narrate = $value;
		}
		function setOrder_id($value){ 
			 $this->_order_id = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setTask_id($value){ 
			 $this->_task_id = $value;
		}
		function setFina_cash($value){ 
			 $this->_fina_cash = $value;
		}
		function setUser_balance($value){ 
			 $this->_user_balance = $value;
		}
		function setFina_credit($value){ 
			 $this->_fina_credit = $value;
		}
		function setUser_credit($value){ 
			 $this->_user_credit = $value;
		}
		function setFina_approach($value){ 
			 $this->_fina_approach = $value;
		}
		function setFina_time($value){ 
			 $this->_fina_time = $value;
		}
		function setSite_cash($value){ 
			 $this->_site_cash = $value;
		}
		function setSite_profit($value){ 
			 $this->_site_profit = $value;
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
		 * 表keke_witkey_finance创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_finance(){
		 		 $data =  array(); 

					if(!is_null($this->_fina_id)){ 
				 $data['fina_id']=$this->_fina_id;
			}
			if(!is_null($this->_fina_type)){ 
				 $data['fina_type']=$this->_fina_type;
			}
			if(!is_null($this->_fina_narrate)){ 
				 $data['fina_narrate']=$this->_fina_narrate;
			}
			if(!is_null($this->_order_id)){ 
				 $data['order_id']=$this->_order_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
			if(!is_null($this->_fina_cash)){ 
				 $data['fina_cash']=$this->_fina_cash;
			}
			if(!is_null($this->_user_balance)){ 
				 $data['user_balance']=$this->_user_balance;
			}
			if(!is_null($this->_fina_credit)){ 
				 $data['fina_credit']=$this->_fina_credit;
			}
			if(!is_null($this->_user_credit)){ 
				 $data['user_credit']=$this->_user_credit;
			}
			if(!is_null($this->_fina_approach)){ 
				 $data['fina_approach']=$this->_fina_approach;
			}
			if(!is_null($this->_fina_time)){ 
				 $data['fina_time']=$this->_fina_time;
			}
			if(!is_null($this->_site_cash)){ 
				 $data['site_cash']=$this->_site_cash;
			}
			if(!is_null($this->_site_profit)){ 
				 $data['site_profit']=$this->_site_profit;
			}

			 return $this->_fina_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 

	    /**
		 * 编辑表keke_witkey_finance的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_finance(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_fina_id)){ 
				 $data['fina_id']=$this->_fina_id;
			}
			if(!is_null($this->_fina_type)){ 
				 $data['fina_type']=$this->_fina_type;
			}
			if(!is_null($this->_fina_narrate)){ 
				 $data['fina_narrate']=$this->_fina_narrate;
			}
			if(!is_null($this->_order_id)){ 
				 $data['order_id']=$this->_order_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
			if(!is_null($this->_fina_cash)){ 
				 $data['fina_cash']=$this->_fina_cash;
			}
			if(!is_null($this->_user_balance)){ 
				 $data['user_balance']=$this->_user_balance;
			}
			if(!is_null($this->_fina_credit)){ 
				 $data['fina_credit']=$this->_fina_credit;
			}
			if(!is_null($this->_user_credit)){ 
				 $data['user_credit']=$this->_user_credit;
			}
			if(!is_null($this->_fina_approach)){ 
				 $data['fina_approach']=$this->_fina_approach;
			}
			if(!is_null($this->_fina_time)){ 
				 $data['fina_time']=$this->_fina_time;
			}
			if(!is_null($this->_site_cash)){ 
				 $data['site_cash']=$this->_site_cash;
			}
			if(!is_null($this->_site_profit)){ 
				 $data['site_profit']=$this->_site_profit;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('fina_id' => $this->_fina_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 

	    /**
		 * 查询表keke_witkey_finance,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_finance(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 

	    
		function count_keke_witkey_finance(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 

	    
		function del_keke_witkey_finance(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where fina_id = $this->_fina_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 

	   
	    
	    
   }
 ?>