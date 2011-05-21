<?php

  class Keke_witkey_message_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_msg_id; //主键 
		 var $_msg_pid; 
		 var $_uid; 
		 var $_username; 
		 var $_recive_uid; 
		 var $_recive_username; 
		 var $_msg_status; 
		 var $_view_status; 
		 var $_title; 
		 var $_content; 
		 var $_on_time; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_message_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_message";
		 }
	    

	    		function getMsg_id(){
			 return $this->_msg_id ;
		}
		function getMsg_pid(){
			 return $this->_msg_pid ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getRecive_uid(){
			 return $this->_recive_uid ;
		}
		function getRecive_username(){
			 return $this->_recive_username ;
		}
		function getMsg_status(){
			 return $this->_msg_status ;
		}
		function getView_status(){
			 return $this->_view_status ;
		}
		function getTitle(){
			 return $this->_title ;
		}
		function getContent(){
			 return $this->_content ;
		}
		function getOn_time(){
			 return $this->_on_time ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setMsg_id($value){ 
			 $this->_msg_id = $value;
		}
		function setMsg_pid($value){ 
			 $this->_msg_pid = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setRecive_uid($value){ 
			 $this->_recive_uid = $value;
		}
		function setRecive_username($value){ 
			 $this->_recive_username = $value;
		}
		function setMsg_status($value){ 
			 $this->_msg_status = $value;
		}
		function setView_status($value){ 
			 $this->_view_status = $value;
		}
		function setTitle($value){ 
			 $this->_title = $value;
		}
		function setContent($value){ 
			 $this->_content = $value;
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
		 * 表keke_witkey_message创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_message(){
		 		 $data =  array(); 

					if(!is_null($this->_msg_id)){ 
				 $data['msg_id']=$this->_msg_id;
			}
			if(!is_null($this->_msg_pid)){ 
				 $data['msg_pid']=$this->_msg_pid;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_recive_uid)){ 
				 $data['recive_uid']=$this->_recive_uid;
			}
			if(!is_null($this->_recive_username)){ 
				 $data['recive_username']=$this->_recive_username;
			}
			if(!is_null($this->_msg_status)){ 
				 $data['msg_status']=$this->_msg_status;
			}
			if(!is_null($this->_view_status)){ 
				 $data['view_status']=$this->_view_status;
			}
			if(!is_null($this->_title)){ 
				 $data['title']=$this->_title;
			}
			if(!is_null($this->_content)){ 
				 $data['content']=$this->_content;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}

			 return $this->_msg_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_message的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_message(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_msg_id)){ 
				 $data['msg_id']=$this->_msg_id;
			}
			if(!is_null($this->_msg_pid)){ 
				 $data['msg_pid']=$this->_msg_pid;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_recive_uid)){ 
				 $data['recive_uid']=$this->_recive_uid;
			}
			if(!is_null($this->_recive_username)){ 
				 $data['recive_username']=$this->_recive_username;
			}
			if(!is_null($this->_msg_status)){ 
				 $data['msg_status']=$this->_msg_status;
			}
			if(!is_null($this->_view_status)){ 
				 $data['view_status']=$this->_view_status;
			}
			if(!is_null($this->_title)){ 
				 $data['title']=$this->_title;
			}
			if(!is_null($this->_content)){ 
				 $data['content']=$this->_content;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('msg_id' => $this->_msg_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_message,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_message(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_message(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_message(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where msg_id = $this->_msg_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>