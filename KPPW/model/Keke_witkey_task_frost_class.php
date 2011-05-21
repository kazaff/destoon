<?php

  class Keke_witkey_task_frost_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_frost_id; //主键 
		 var $_frost_status; 
		 var $_task_id; 
		 var $_frost_time; 
		 var $_restore_time; 
		 var $_admin_uid; 
		 var $_admin_username; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_task_frost_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_task_frost";
		 }
	    

	    		function getFrost_id(){
			 return $this->_frost_id ;
		}
		function getFrost_status(){
			 return $this->_frost_status ;
		}
		function getTask_id(){
			 return $this->_task_id ;
		}
		function getFrost_time(){
			 return $this->_frost_time ;
		}
		function getRestore_time(){
			 return $this->_restore_time ;
		}
		function getAdmin_uid(){
			 return $this->_admin_uid ;
		}
		function getAdmin_username(){
			 return $this->_admin_username ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setFrost_id($value){ 
			 $this->_frost_id = $value;
		}
		function setFrost_status($value){ 
			 $this->_frost_status = $value;
		}
		function setTask_id($value){ 
			 $this->_task_id = $value;
		}
		function setFrost_time($value){ 
			 $this->_frost_time = $value;
		}
		function setRestore_time($value){ 
			 $this->_restore_time = $value;
		}
		function setAdmin_uid($value){ 
			 $this->_admin_uid = $value;
		}
		function setAdmin_username($value){ 
			 $this->_admin_username = $value;
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
		 * 表keke_witkey_task_frost创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_task_frost(){
		 		 $data =  array(); 

					if(!is_null($this->_frost_id)){ 
				 $data['frost_id']=$this->_frost_id;
			}
			if(!is_null($this->_frost_status)){ 
				 $data['frost_status']=$this->_frost_status;
			}
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
			if(!is_null($this->_frost_time)){ 
				 $data['frost_time']=$this->_frost_time;
			}
			if(!is_null($this->_restore_time)){ 
				 $data['restore_time']=$this->_restore_time;
			}
			if(!is_null($this->_admin_uid)){ 
				 $data['admin_uid']=$this->_admin_uid;
			}
			if(!is_null($this->_admin_username)){ 
				 $data['admin_username']=$this->_admin_username;
			}

			 return $this->_frost_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_task_frost的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_task_frost(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_frost_id)){ 
				 $data['frost_id']=$this->_frost_id;
			}
			if(!is_null($this->_frost_status)){ 
				 $data['frost_status']=$this->_frost_status;
			}
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
			if(!is_null($this->_frost_time)){ 
				 $data['frost_time']=$this->_frost_time;
			}
			if(!is_null($this->_restore_time)){ 
				 $data['restore_time']=$this->_restore_time;
			}
			if(!is_null($this->_admin_uid)){ 
				 $data['admin_uid']=$this->_admin_uid;
			}
			if(!is_null($this->_admin_username)){ 
				 $data['admin_username']=$this->_admin_username;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('frost_id' => $this->_frost_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_task_frost,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_task_frost(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_task_frost(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_task_frost(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where frost_id = $this->_frost_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>