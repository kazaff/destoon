<?php

  class Keke_witkey_task_delay_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_delay_id; //主键 
		 var $_task_id; 
		 var $_delay_cash; 
		 var $_delay_day; 
		 var $_uid; 
		 var $_on_time; 
		 var $_delay_status; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_task_delay_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_task_delay";
		 }
	    

	    		function getDelay_id(){
			 return $this->_delay_id ;
		}
		function getTask_id(){
			 return $this->_task_id ;
		}
		function getDelay_cash(){
			 return $this->_delay_cash ;
		}
		function getDelay_day(){
			 return $this->_delay_day ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getOn_time(){
			 return $this->_on_time ;
		}
		function getDelay_status(){
			 return $this->_delay_status ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setDelay_id($value){ 
			 $this->_delay_id = $value;
		}
		function setTask_id($value){ 
			 $this->_task_id = $value;
		}
		function setDelay_cash($value){ 
			 $this->_delay_cash = $value;
		}
		function setDelay_day($value){ 
			 $this->_delay_day = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setOn_time($value){ 
			 $this->_on_time = $value;
		}
		function setDelay_status($value){ 
			 $this->_delay_status = $value;
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
		 * 表keke_witkey_task_delay创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_task_delay(){
		 		 $data =  array(); 

					if(!is_null($this->_delay_id)){ 
				 $data['delay_id']=$this->_delay_id;
			}
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
			if(!is_null($this->_delay_cash)){ 
				 $data['delay_cash']=$this->_delay_cash;
			}
			if(!is_null($this->_delay_day)){ 
				 $data['delay_day']=$this->_delay_day;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}
			if(!is_null($this->_delay_status)){ 
				 $data['delay_status']=$this->_delay_status;
			}

			 return $this->_delay_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_task_delay的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_task_delay(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_delay_id)){ 
				 $data['delay_id']=$this->_delay_id;
			}
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
			if(!is_null($this->_delay_cash)){ 
				 $data['delay_cash']=$this->_delay_cash;
			}
			if(!is_null($this->_delay_day)){ 
				 $data['delay_day']=$this->_delay_day;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}
			if(!is_null($this->_delay_status)){ 
				 $data['delay_status']=$this->_delay_status;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('delay_id' => $this->_delay_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_task_delay,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_task_delay(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_task_delay(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_task_delay(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where delay_id = $this->_delay_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>