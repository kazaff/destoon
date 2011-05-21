<?php
  class Keke_witkey_favorite_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_f_id; //主键 		 var $_obj_type; 		 var $_obj_id; 		 var $_obj_name; 		 var $_uid; 		 var $_username; 		 var $_on_date; 
	    var $_replace=0;  
	    var $_where;      
	     function  keke_witkey_favorite_class(){ //构造方法			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_favorite";		 }	    
	    		function getF_id(){			 return $this->_f_id ;		}		function getObj_type(){			 return $this->_obj_type ;		}		function getObj_id(){			 return $this->_obj_id ;		}		function getObj_name(){			 return $this->_obj_name ;		}		function getUid(){			 return $this->_uid ;		}		function getUsername(){			 return $this->_username ;		}		function getOn_date(){			 return $this->_on_date ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setF_id($value){ 			 $this->_f_id = $value;		}		function setObj_type($value){ 			 $this->_obj_type = $value;		}		function setObj_id($value){ 			 $this->_obj_id = $value;		}		function setObj_name($value){ 			 $this->_obj_name = $value;		}		function setUid($value){ 			 $this->_uid = $value;		}		function setUsername($value){ 			 $this->_username = $value;		}		function setOn_date($value){ 			 $this->_on_date = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * 表keke_witkey_favorite创建或新增一条记录		 * @return 返回新增ID		 */		function create_keke_witkey_favorite(){		 		 $data =  array(); 					if(!is_null($this->_f_id)){ 				 $data['f_id']=$this->_f_id;			}			if(!is_null($this->_obj_type)){ 				 $data['obj_type']=$this->_obj_type;			}			if(!is_null($this->_obj_id)){ 				 $data['obj_id']=$this->_obj_id;			}			if(!is_null($this->_obj_name)){ 				 $data['obj_name']=$this->_obj_name;			}			if(!is_null($this->_uid)){ 				 $data['uid']=$this->_uid;			}			if(!is_null($this->_username)){ 				 $data['username']=$this->_username;			}			if(!is_null($this->_on_date)){ 				 $data['on_date']=$this->_on_date;			}			 return $this->_f_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * 编辑表keke_witkey_favorite的一个条记录		 * @return 返回影响的行数		 */		function edit_keke_witkey_favorite(){ 		 		 $data =  array();  					if(!is_null($this->_f_id)){ 				 $data['f_id']=$this->_f_id;			}			if(!is_null($this->_obj_type)){ 				 $data['obj_type']=$this->_obj_type;			}			if(!is_null($this->_obj_id)){ 				 $data['obj_id']=$this->_obj_id;			}			if(!is_null($this->_obj_name)){ 				 $data['obj_name']=$this->_obj_name;			}			if(!is_null($this->_uid)){ 				 $data['uid']=$this->_uid;			}			if(!is_null($this->_username)){ 				 $data['username']=$this->_username;			}			if(!is_null($this->_on_date)){ 				 $data['on_date']=$this->_on_date;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('f_id' => $this->_f_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * 查询表keke_witkey_favorite,当有条件时返回有条件的ROW，否则返所有记录		 * @return 返回一个(array)关联数组		 */		function query_keke_witkey_favorite(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_favorite(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_favorite(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where f_id = $this->_f_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>