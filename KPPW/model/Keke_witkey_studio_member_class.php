<?php
  class Keke_witkey_studio_member_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_w_uid; //主键 		 var $_studio_id; 		 var $_uid; 		 var $_username; 		 var $_on_date; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //查，改，删条件
	     function  keke_witkey_studio_member_class(){ //构造方法			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_studio_member";		 }	    
	    		function getW_uid(){			 return $this->_w_uid ;		}		function getStudio_id(){			 return $this->_studio_id ;		}		function getUid(){			 return $this->_uid ;		}		function getUsername(){			 return $this->_username ;		}		function getOn_date(){			 return $this->_on_date ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setW_uid($value){ 			 $this->_w_uid = $value;		}		function setStudio_id($value){ 			 $this->_studio_id = $value;		}		function setUid($value){ 			 $this->_uid = $value;		}		function setUsername($value){ 			 $this->_username = $value;		}		function setOn_date($value){ 			 $this->_on_date = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * 表keke_witkey_studio_member创建或新增一条记录		 * @return 返回新增ID		 */		function create_keke_witkey_studio_member(){		 		 $data =  array(); 					if(!is_null($this->_w_uid)){ 				 $data['w_uid']=$this->_w_uid;			}			if(!is_null($this->_studio_id)){ 				 $data['studio_id']=$this->_studio_id;			}			if(!is_null($this->_uid)){ 				 $data['uid']=$this->_uid;			}			if(!is_null($this->_username)){ 				 $data['username']=$this->_username;			}			if(!is_null($this->_on_date)){ 				 $data['on_date']=$this->_on_date;			}			 return $this->_w_uid = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * 编辑表keke_witkey_studio_member的一个条记录		 * @return 返回影响的行数		 */		function edit_keke_witkey_studio_member(){ 		 		 $data =  array();  					if(!is_null($this->_w_uid)){ 				 $data['w_uid']=$this->_w_uid;			}			if(!is_null($this->_studio_id)){ 				 $data['studio_id']=$this->_studio_id;			}			if(!is_null($this->_uid)){ 				 $data['uid']=$this->_uid;			}			if(!is_null($this->_username)){ 				 $data['username']=$this->_username;			}			if(!is_null($this->_on_date)){ 				 $data['on_date']=$this->_on_date;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('w_uid' => $this->_w_uid); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * 查询表keke_witkey_studio_member,当有条件时返回有条件的ROW，否则返所有记录		 * @return 返回一个(array)关联数组		 */		function query_keke_witkey_studio_member(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_studio_member(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_studio_member(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where w_uid = $this->_w_uid "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>