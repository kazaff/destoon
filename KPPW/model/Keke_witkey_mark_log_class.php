<?php

  class Keke_witkey_mark_log_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_mark_id; //主键 
		 var $_mark_type; 
		 var $_obj_id; 
		 var $_mark_status; 
		 var $_mark_content; 
		 var $_mark_time; 
		 var $_uid; 
		 var $_username; 
		 var $_mark_max_time; 
		 var $_by_uid; 
		 var $_by_username; 
		 var $_user_type; 
		 var $_obj_cash; 
		 var $_work_id; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_mark_log_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_mark_log";
		 }
	    

	    		function getMark_id(){
			 return $this->_mark_id ;
		}
		function getMark_type(){
			 return $this->_mark_type ;
		}
		function getObj_id(){
			 return $this->_obj_id ;
		}
		function getMark_status(){
			 return $this->_mark_status ;
		}
		function getMark_content(){
			 return $this->_mark_content ;
		}
		function getMark_time(){
			 return $this->_mark_time ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getMark_max_time(){
			 return $this->_mark_max_time ;
		}
		function getBy_uid(){
			 return $this->_by_uid ;
		}
		function getBy_username(){
			 return $this->_by_username ;
		}
		function getUser_type(){
			 return $this->_user_type ;
		}
		function getObj_cash(){
			 return $this->_obj_cash ;
		}
		function getWork_id(){
			 return $this->_work_id ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setMark_id($value){ 
			 $this->_mark_id = $value;
		}
		function setMark_type($value){ 
			 $this->_mark_type = $value;
		}
		function setObj_id($value){ 
			 $this->_obj_id = $value;
		}
		function setMark_status($value){ 
			 $this->_mark_status = $value;
		}
		function setMark_content($value){ 
			 $this->_mark_content = $value;
		}
		function setMark_time($value){ 
			 $this->_mark_time = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setMark_max_time($value){ 
			 $this->_mark_max_time = $value;
		}
		function setBy_uid($value){ 
			 $this->_by_uid = $value;
		}
		function setBy_username($value){ 
			 $this->_by_username = $value;
		}
		function setUser_type($value){ 
			 $this->_user_type = $value;
		}
		function setObj_cash($value){ 
			 $this->_obj_cash = $value;
		}
		function setWork_id($value){ 
			 $this->_work_id = $value;
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
		 * 表keke_witkey_mark_log创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_mark_log(){
		 		 $data =  array(); 

					if(!is_null($this->_mark_id)){ 
				 $data['mark_id']=$this->_mark_id;
			}
			if(!is_null($this->_mark_type)){ 
				 $data['mark_type']=$this->_mark_type;
			}
			if(!is_null($this->_obj_id)){ 
				 $data['obj_id']=$this->_obj_id;
			}
			if(!is_null($this->_mark_status)){ 
				 $data['mark_status']=$this->_mark_status;
			}
			if(!is_null($this->_mark_content)){ 
				 $data['mark_content']=$this->_mark_content;
			}
			if(!is_null($this->_mark_time)){ 
				 $data['mark_time']=$this->_mark_time;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_mark_max_time)){ 
				 $data['mark_max_time']=$this->_mark_max_time;
			}
			if(!is_null($this->_by_uid)){ 
				 $data['by_uid']=$this->_by_uid;
			}
			if(!is_null($this->_by_username)){ 
				 $data['by_username']=$this->_by_username;
			}
			if(!is_null($this->_user_type)){ 
				 $data['user_type']=$this->_user_type;
			}
			if(!is_null($this->_obj_cash)){ 
				 $data['obj_cash']=$this->_obj_cash;
			}
			if(!is_null($this->_work_id)){ 
				 $data['work_id']=$this->_work_id;
			}

			 return $this->_mark_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_mark_log的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_mark_log(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_mark_id)){ 
				 $data['mark_id']=$this->_mark_id;
			}
			if(!is_null($this->_mark_type)){ 
				 $data['mark_type']=$this->_mark_type;
			}
			if(!is_null($this->_obj_id)){ 
				 $data['obj_id']=$this->_obj_id;
			}
			if(!is_null($this->_mark_status)){ 
				 $data['mark_status']=$this->_mark_status;
			}
			if(!is_null($this->_mark_content)){ 
				 $data['mark_content']=$this->_mark_content;
			}
			if(!is_null($this->_mark_time)){ 
				 $data['mark_time']=$this->_mark_time;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_mark_max_time)){ 
				 $data['mark_max_time']=$this->_mark_max_time;
			}
			if(!is_null($this->_by_uid)){ 
				 $data['by_uid']=$this->_by_uid;
			}
			if(!is_null($this->_by_username)){ 
				 $data['by_username']=$this->_by_username;
			}
			if(!is_null($this->_user_type)){ 
				 $data['user_type']=$this->_user_type;
			}
			if(!is_null($this->_obj_cash)){ 
				 $data['obj_cash']=$this->_obj_cash;
			}
			if(!is_null($this->_work_id)){ 
				 $data['work_id']=$this->_work_id;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('mark_id' => $this->_mark_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_mark_log,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_mark_log(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_mark_log(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_mark_log(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where mark_id = $this->_mark_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>