<?php
  class Keke_witkey_rule_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_rule_id; //主键 
		 var $_rule_key; 
		 var $_rule_group; 
		 var $_rule; 

	    var $_replace=0;  
	    var $_where;      
	     function  keke_witkey_rule_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_rule";
		 }
	    
	    		function getRule_id(){
			 return $this->_rule_id ;
		}
		function getRule_key(){
			 return $this->_rule_key ;
		}
		function getRule_group(){
			 return $this->_rule_group ;
		}
		function getRule(){
			 return $this->_rule ;
		}
		function getWhere(){
			 return $this->_where ;
		}

	    		function setRule_id($value){ 
			 $this->_rule_id = $value;
		}
		function setRule_key($value){ 
			 $this->_rule_key = $value;
		}
		function setRule_group($value){ 
			 $this->_rule_group = $value;
		}
		function setRule($value){ 
			 $this->_rule = $value;
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
		 * 表keke_witkey_rule创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_rule(){
		 		 $data =  array(); 

					if(!is_null($this->_rule_id)){ 
				 $data['rule_id']=$this->_rule_id;
			}
			if(!is_null($this->_rule_key)){ 
				 $data['rule_key']=$this->_rule_key;
			}
			if(!is_null($this->_rule_group)){ 
				 $data['rule_group']=$this->_rule_group;
			}
			if(!is_null($this->_rule)){ 
				 $data['rule']=$this->_rule;
			}

			 return $this->_rule_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 

	    /**
		 * 编辑表keke_witkey_rule的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_rule(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_rule_id)){ 
				 $data['rule_id']=$this->_rule_id;
			}
			if(!is_null($this->_rule_key)){ 
				 $data['rule_key']=$this->_rule_key;
			}
			if(!is_null($this->_rule_group)){ 
				 $data['rule_group']=$this->_rule_group;
			}
			if(!is_null($this->_rule)){ 
				 $data['rule']=$this->_rule;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('rule_id' => $this->_rule_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 

	    /**
		 * 查询表keke_witkey_rule,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_rule(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 

	    
		function count_keke_witkey_rule(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 

	    
		function del_keke_witkey_rule(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where rule_id = $this->_rule_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 

	   
	    
	    
   }
 ?>