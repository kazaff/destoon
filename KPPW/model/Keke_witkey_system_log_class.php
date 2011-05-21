<?php

  class Keke_witkey_system_log_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_log_id; //主键 
		 var $_log_type; 
		 var $_uid; 
		 var $_username; 
		 var $_user_type; 
		 var $_log_content; 
		 var $_log_ip; 
		 var $_log_time; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_system_log_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_system_log";
		 }
	    

	    		function getLog_id(){
			 return $this->_log_id ;
		}
		function getLog_type(){
			 return $this->_log_type ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getUser_type(){
			 return $this->_user_type ;
		}
		function getLog_content(){
			 return $this->_log_content ;
		}
		function getLog_ip(){
			 return $this->_log_ip ;
		}
		function getLog_time(){
			 return $this->_log_time ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setLog_id($value){ 
			 $this->_log_id = $value;
		}
		function setLog_type($value){ 
			 $this->_log_type = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setUser_type($value){ 
			 $this->_user_type = $value;
		}
		function setLog_content($value){ 
			 $this->_log_content = $value;
		}
		function setLog_ip($value){ 
			 $this->_log_ip = $value;
		}
		function setLog_time($value){ 
			 $this->_log_time = $value;
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
		 * 表keke_witkey_system_log创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_system_log(){
		 		 $data =  array(); 

					if(!is_null($this->_log_id)){ 
				 $data['log_id']=$this->_log_id;
			}
			if(!is_null($this->_log_type)){ 
				 $data['log_type']=$this->_log_type;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_user_type)){ 
				 $data['user_type']=$this->_user_type;
			}
			if(!is_null($this->_log_content)){ 
				 $data['log_content']=$this->_log_content;
			}
			if(!is_null($this->_log_ip)){ 
				 $data['log_ip']=$this->_log_ip;
			}
			if(!is_null($this->_log_time)){ 
				 $data['log_time']=$this->_log_time;
			}

			 return $this->_log_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_system_log的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_system_log(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_log_id)){ 
				 $data['log_id']=$this->_log_id;
			}
			if(!is_null($this->_log_type)){ 
				 $data['log_type']=$this->_log_type;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_user_type)){ 
				 $data['user_type']=$this->_user_type;
			}
			if(!is_null($this->_log_content)){ 
				 $data['log_content']=$this->_log_content;
			}
			if(!is_null($this->_log_ip)){ 
				 $data['log_ip']=$this->_log_ip;
			}
			if(!is_null($this->_log_time)){ 
				 $data['log_time']=$this->_log_time;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('log_id' => $this->_log_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_system_log,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_system_log(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_system_log(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_system_log(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where log_id = $this->_log_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>