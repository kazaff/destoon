<?php

  class Keke_witkey_file_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_file_id; //主键 
		 var $_work_id; 
		 var $_task_id; 
		 var $_task_title; 
		 var $_file_name; 
		 var $_file_save_name; 
		 var $_uid; 
		 var $_username; 
		 var $_on_time; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_file_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_file";
		 }
	    

	    		function getFile_id(){
			 return $this->_file_id ;
		}
		function getWork_id(){
			 return $this->_work_id ;
		}
		function getTask_id(){
			 return $this->_task_id ;
		}
		function getTask_title(){
			 return $this->_task_title ;
		}
		function getFile_name(){
			 return $this->_file_name ;
		}
		function getFile_save_name(){
			 return $this->_file_save_name ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getOn_time(){
			 return $this->_on_time ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setFile_id($value){ 
			 $this->_file_id = $value;
		}
		function setWork_id($value){ 
			 $this->_work_id = $value;
		}
		function setTask_id($value){ 
			 $this->_task_id = $value;
		}
		function setTask_title($value){ 
			 $this->_task_title = $value;
		}
		function setFile_name($value){ 
			 $this->_file_name = $value;
		}
		function setFile_save_name($value){ 
			 $this->_file_save_name = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
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
		 * 表keke_witkey_file创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_file(){
		 		 $data =  array(); 

					if(!is_null($this->_file_id)){ 
				 $data['file_id']=$this->_file_id;
			}
			if(!is_null($this->_work_id)){ 
				 $data['work_id']=$this->_work_id;
			}
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
			if(!is_null($this->_task_title)){ 
				 $data['task_title']=$this->_task_title;
			}
			if(!is_null($this->_file_name)){ 
				 $data['file_name']=$this->_file_name;
			}
			if(!is_null($this->_file_save_name)){ 
				 $data['file_save_name']=$this->_file_save_name;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}

			 return $this->_file_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_file的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_file(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_file_id)){ 
				 $data['file_id']=$this->_file_id;
			}
			if(!is_null($this->_work_id)){ 
				 $data['work_id']=$this->_work_id;
			}
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
			if(!is_null($this->_task_title)){ 
				 $data['task_title']=$this->_task_title;
			}
			if(!is_null($this->_file_name)){ 
				 $data['file_name']=$this->_file_name;
			}
			if(!is_null($this->_file_save_name)){ 
				 $data['file_save_name']=$this->_file_save_name;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('file_id' => $this->_file_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_file,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_file(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_file(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_file(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where file_id = $this->_file_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>