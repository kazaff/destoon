<?php
  class Keke_witkey_member_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_uid; //主键 		 var $_username; 		 var $_password; 		 var $_email; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //查，改，删条件
	     function  keke_witkey_member_class(){ //构造方法			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_member";		 }	    
	    		function getUid(){			 return $this->_uid ;		}		function getUsername(){			 return $this->_username ;		}		function getPassword(){			 return $this->_password ;		}		function getEmail(){			 return $this->_email ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setUid($value){ 			 $this->_uid = $value;		}		function setUsername($value){ 			 $this->_username = $value;		}		function setPassword($value){ 			 $this->_password = $value;		}		function setEmail($value){ 			 $this->_email = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * 表keke_witkey_member创建或新增一条记录		 * @return 返回新增ID		 */		function create_keke_witkey_member(){		 		 $data =  array(); 					if(!is_null($this->_uid)){ 				 $data['uid']=$this->_uid;			}			if(!is_null($this->_username)){ 				 $data['username']=$this->_username;			}			if(!is_null($this->_password)){ 				 $data['password']=$this->_password;			}			if(!is_null($this->_email)){ 				 $data['email']=$this->_email;			}			 return $this->_uid = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * 编辑表keke_witkey_member的一个条记录		 * @return 返回影响的行数		 */		function edit_keke_witkey_member(){ 		 		 $data =  array();  					if(!is_null($this->_uid)){ 				 $data['uid']=$this->_uid;			}			if(!is_null($this->_username)){ 				 $data['username']=$this->_username;			}			if(!is_null($this->_password)){ 				 $data['password']=$this->_password;			}			if(!is_null($this->_email)){ 				 $data['email']=$this->_email;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('uid' => $this->_uid); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * 查询表keke_witkey_member,当有条件时返回有条件的ROW，否则返所有记录		 * @return 返回一个(array)关联数组		 */		function query_keke_witkey_member(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_member(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_member(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where uid = $this->_uid "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>