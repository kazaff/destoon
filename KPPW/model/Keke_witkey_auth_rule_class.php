<?php
  class Keke_witkey_auth_rule_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_rule_id; //主键 		 var $_l_time; 		 var $_charge; 		 var $_rule_name; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //查，改，删条件
	     function  keke_witkey_auth_rule_class(){ //构造方法			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_auth_rule";		 }	    
	    		function getRule_id(){			 return $this->_rule_id ;		}		function getL_time(){			 return $this->_l_time ;		}		function getCharge(){			 return $this->_charge ;		}		function getRule_name(){			 return $this->_rule_name ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setRule_id($value){ 			 $this->_rule_id = $value;		}		function setL_time($value){ 			 $this->_l_time = $value;		}		function setCharge($value){ 			 $this->_charge = $value;		}		function setRule_name($value){ 			 $this->_rule_name = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * 表keke_witkey_auth_rule创建或新增一条记录		 * @return 返回新增ID		 */		function create_keke_witkey_auth_rule(){		 		 $data =  array(); 					if(!is_null($this->_rule_id)){ 				 $data['rule_id']=$this->_rule_id;			}			if(!is_null($this->_l_time)){ 				 $data['l_time']=$this->_l_time;			}			if(!is_null($this->_charge)){ 				 $data['charge']=$this->_charge;			}			if(!is_null($this->_rule_name)){ 				 $data['rule_name']=$this->_rule_name;			}			 return $this->_rule_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * 编辑表keke_witkey_auth_rule的一个条记录		 * @return 返回影响的行数		 */		function edit_keke_witkey_auth_rule(){ 		 		 $data =  array();  					if(!is_null($this->_rule_id)){ 				 $data['rule_id']=$this->_rule_id;			}			if(!is_null($this->_l_time)){ 				 $data['l_time']=$this->_l_time;			}			if(!is_null($this->_charge)){ 				 $data['charge']=$this->_charge;			}			if(!is_null($this->_rule_name)){ 				 $data['rule_name']=$this->_rule_name;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('rule_id' => $this->_rule_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * 查询表keke_witkey_auth_rule,当有条件时返回有条件的ROW，否则返所有记录		 * @return 返回一个(array)关联数组		 */		function query_keke_witkey_auth_rule(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_auth_rule(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_auth_rule(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where rule_id = $this->_rule_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>