<?php
  class Keke_witkey_skill_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_skill_id; //主键 		 var $_indus_id; 		 var $_skill_name; 		 var $_listorder; 		 var $_on_time; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //查，改，删条件
	     function  keke_witkey_skill_class(){ //构造方法			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_skill";		 }	    
	    		function getSkill_id(){			 return $this->_skill_id ;		}		function getIndus_id(){			 return $this->_indus_id ;		}		function getSkill_name(){			 return $this->_skill_name ;		}		function getListorder(){			 return $this->_listorder ;		}		function getOn_time(){			 return $this->_on_time ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setSkill_id($value){ 			 $this->_skill_id = $value;		}		function setIndus_id($value){ 			 $this->_indus_id = $value;		}		function setSkill_name($value){ 			 $this->_skill_name = $value;		}		function setListorder($value){ 			 $this->_listorder = $value;		}		function setOn_time($value){ 			 $this->_on_time = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * 表keke_witkey_skill创建或新增一条记录		 * @return 返回新增ID		 */		function create_keke_witkey_skill(){		 		 $data =  array(); 					if(!is_null($this->_skill_id)){ 				 $data['skill_id']=$this->_skill_id;			}			if(!is_null($this->_indus_id)){ 				 $data['indus_id']=$this->_indus_id;			}			if(!is_null($this->_skill_name)){ 				 $data['skill_name']=$this->_skill_name;			}			if(!is_null($this->_listorder)){ 				 $data['listorder']=$this->_listorder;			}			if(!is_null($this->_on_time)){ 				 $data['on_time']=$this->_on_time;			}			 return $this->_skill_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * 编辑表keke_witkey_skill的一个条记录		 * @return 返回影响的行数		 */		function edit_keke_witkey_skill(){ 		 		 $data =  array();  					if(!is_null($this->_skill_id)){ 				 $data['skill_id']=$this->_skill_id;			}			if(!is_null($this->_indus_id)){ 				 $data['indus_id']=$this->_indus_id;			}			if(!is_null($this->_skill_name)){ 				 $data['skill_name']=$this->_skill_name;			}			if(!is_null($this->_listorder)){ 				 $data['listorder']=$this->_listorder;			}			if(!is_null($this->_on_time)){ 				 $data['on_time']=$this->_on_time;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('skill_id' => $this->_skill_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * 查询表keke_witkey_skill,当有条件时返回有条件的ROW，否则返所有记录		 * @return 返回一个(array)关联数组		 */		function query_keke_witkey_skill(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_skill(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_skill(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where skill_id = $this->_skill_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>