<?php
  class Keke_witkey_score_rule_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_score_rule_id; //主键 
		 var $_min_score; 
		 var $_max_score; 
		 var $_unit_count; 
		 var $_unit_id; 
		 var $_unit_title; 
		 var $_unit_ico; 

	    var $_replace=0;  
	    var $_where;      
	     function  keke_witkey_score_rule_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_score_rule";
		 }
	    
	    		function getScore_rule_id(){
			 return $this->_score_rule_id ;
		}
		function getMin_score(){
			 return $this->_min_score ;
		}
		function getMax_score(){
			 return $this->_max_score ;
		}
		function getUnit_count(){
			 return $this->_unit_count ;
		}
		function getUnit_id(){
			 return $this->_unit_id ;
		}
		function getUnit_title(){
			 return $this->_unit_title ;
		}
		function getUnit_ico(){
			 return $this->_unit_ico ;
		}
		function getWhere(){
			 return $this->_where ;
		}

	    		function setScore_rule_id($value){ 
			 $this->_score_rule_id = $value;
		}
		function setMin_score($value){ 
			 $this->_min_score = $value;
		}
		function setMax_score($value){ 
			 $this->_max_score = $value;
		}
		function setUnit_count($value){ 
			 $this->_unit_count = $value;
		}
		function setUnit_id($value){ 
			 $this->_unit_id = $value;
		}
		function setUnit_title($value){ 
			 $this->_unit_title = $value;
		}
		function setUnit_ico($value){ 
			 $this->_unit_ico = $value;
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
		 * 表keke_witkey_score_rule创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_score_rule(){
		 		 $data =  array(); 

					if(!is_null($this->_score_rule_id)){ 
				 $data['score_rule_id']=$this->_score_rule_id;
			}
			if(!is_null($this->_min_score)){ 
				 $data['min_score']=$this->_min_score;
			}
			if(!is_null($this->_max_score)){ 
				 $data['max_score']=$this->_max_score;
			}
			if(!is_null($this->_unit_count)){ 
				 $data['unit_count']=$this->_unit_count;
			}
			if(!is_null($this->_unit_id)){ 
				 $data['unit_id']=$this->_unit_id;
			}
			if(!is_null($this->_unit_title)){ 
				 $data['unit_title']=$this->_unit_title;
			}
			if(!is_null($this->_unit_ico)){ 
				 $data['unit_ico']=$this->_unit_ico;
			}

			 return $this->_score_rule_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 

	    /**
		 * 编辑表keke_witkey_score_rule的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_score_rule(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_score_rule_id)){ 
				 $data['score_rule_id']=$this->_score_rule_id;
			}
			if(!is_null($this->_min_score)){ 
				 $data['min_score']=$this->_min_score;
			}
			if(!is_null($this->_max_score)){ 
				 $data['max_score']=$this->_max_score;
			}
			if(!is_null($this->_unit_count)){ 
				 $data['unit_count']=$this->_unit_count;
			}
			if(!is_null($this->_unit_id)){ 
				 $data['unit_id']=$this->_unit_id;
			}
			if(!is_null($this->_unit_title)){ 
				 $data['unit_title']=$this->_unit_title;
			}
			if(!is_null($this->_unit_ico)){ 
				 $data['unit_ico']=$this->_unit_ico;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('score_rule_id' => $this->_score_rule_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 

	    /**
		 * 查询表keke_witkey_score_rule,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_score_rule(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 

	    
		function count_keke_witkey_score_rule(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 

	    
		function del_keke_witkey_score_rule(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where score_rule_id = $this->_score_rule_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 

	   
	    
	    
   }
 ?>