<?php

  class Keke_witkey_pay_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_order_id; //主键 
		 var $_order_type; 
		 var $_pay_type; 
		 var $_return_order_id; 
		 var $_obj_id; 
		 var $_uid; 
		 var $_username; 
		 var $_pay_time; 
		 var $_pay_money; 
		 var $_order_status; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_pay_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_pay";
		 }
	    

	    		function getOrder_id(){
			 return $this->_order_id ;
		}
		function getOrder_type(){
			 return $this->_order_type ;
		}
		function getPay_type(){
			 return $this->_pay_type ;
		}
		function getReturn_order_id(){
			 return $this->_return_order_id ;
		}
		function getObj_id(){
			 return $this->_obj_id ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getPay_time(){
			 return $this->_pay_time ;
		}
		function getPay_money(){
			 return $this->_pay_money ;
		}
		function getOrder_status(){
			 return $this->_order_status ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setOrder_id($value){ 
			 $this->_order_id = $value;
		}
		function setOrder_type($value){ 
			 $this->_order_type = $value;
		}
		function setPay_type($value){ 
			 $this->_pay_type = $value;
		}
		function setReturn_order_id($value){ 
			 $this->_return_order_id = $value;
		}
		function setObj_id($value){ 
			 $this->_obj_id = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setPay_time($value){ 
			 $this->_pay_time = $value;
		}
		function setPay_money($value){ 
			 $this->_pay_money = $value;
		}
		function setOrder_status($value){ 
			 $this->_order_status = $value;
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
		 * 表keke_witkey_pay创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_pay(){
		 		 $data =  array(); 

					if(!is_null($this->_order_id)){ 
				 $data['order_id']=$this->_order_id;
			}
			if(!is_null($this->_order_type)){ 
				 $data['order_type']=$this->_order_type;
			}
			if(!is_null($this->_pay_type)){ 
				 $data['pay_type']=$this->_pay_type;
			}
			if(!is_null($this->_return_order_id)){ 
				 $data['return_order_id']=$this->_return_order_id;
			}
			if(!is_null($this->_obj_id)){ 
				 $data['obj_id']=$this->_obj_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_pay_time)){ 
				 $data['pay_time']=$this->_pay_time;
			}
			if(!is_null($this->_pay_money)){ 
				 $data['pay_money']=$this->_pay_money;
			}
			if(!is_null($this->_order_status)){ 
				 $data['order_status']=$this->_order_status;
			}

			 return $this->_order_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_pay的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_pay(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_order_id)){ 
				 $data['order_id']=$this->_order_id;
			}
			if(!is_null($this->_order_type)){ 
				 $data['order_type']=$this->_order_type;
			}
			if(!is_null($this->_pay_type)){ 
				 $data['pay_type']=$this->_pay_type;
			}
			if(!is_null($this->_return_order_id)){ 
				 $data['return_order_id']=$this->_return_order_id;
			}
			if(!is_null($this->_obj_id)){ 
				 $data['obj_id']=$this->_obj_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_pay_time)){ 
				 $data['pay_time']=$this->_pay_time;
			}
			if(!is_null($this->_pay_money)){ 
				 $data['pay_money']=$this->_pay_money;
			}
			if(!is_null($this->_order_status)){ 
				 $data['order_status']=$this->_order_status;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('order_id' => $this->_order_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_pay,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_pay(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_pay(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_pay(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where order_id = $this->_order_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>