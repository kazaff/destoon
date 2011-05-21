<?php
  class Keke_witkey_mark_config_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_mark_config_id; //主键 		 var $_min_cash; 		 var $_max_cash; 		 var $_good; 		 var $_normal; 		 var $_bad; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //查，改，删条件
	     function  keke_witkey_mark_config_class(){ //构造方法			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_mark_config";		 }	    
	    		function getMark_config_id(){			 return $this->_mark_config_id ;		}		function getMin_cash(){			 return $this->_min_cash ;		}		function getMax_cash(){			 return $this->_max_cash ;		}		function getGood(){			 return $this->_good ;		}		function getNormal(){			 return $this->_normal ;		}		function getBad(){			 return $this->_bad ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setMark_config_id($value){ 			 $this->_mark_config_id = $value;		}		function setMin_cash($value){ 			 $this->_min_cash = $value;		}		function setMax_cash($value){ 			 $this->_max_cash = $value;		}		function setGood($value){ 			 $this->_good = $value;		}		function setNormal($value){ 			 $this->_normal = $value;		}		function setBad($value){ 			 $this->_bad = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * 表keke_witkey_mark_config创建或新增一条记录		 * @return 返回新增ID		 */		function create_keke_witkey_mark_config(){		 		 $data =  array(); 					if(!is_null($this->_mark_config_id)){ 				 $data['mark_config_id']=$this->_mark_config_id;			}			if(!is_null($this->_min_cash)){ 				 $data['min_cash']=$this->_min_cash;			}			if(!is_null($this->_max_cash)){ 				 $data['max_cash']=$this->_max_cash;			}			if(!is_null($this->_good)){ 				 $data['good']=$this->_good;			}			if(!is_null($this->_normal)){ 				 $data['normal']=$this->_normal;			}			if(!is_null($this->_bad)){ 				 $data['bad']=$this->_bad;			}			 return $this->_mark_config_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * 编辑表keke_witkey_mark_config的一个条记录		 * @return 返回影响的行数		 */		function edit_keke_witkey_mark_config(){ 		 		 $data =  array();  					if(!is_null($this->_mark_config_id)){ 				 $data['mark_config_id']=$this->_mark_config_id;			}			if(!is_null($this->_min_cash)){ 				 $data['min_cash']=$this->_min_cash;			}			if(!is_null($this->_max_cash)){ 				 $data['max_cash']=$this->_max_cash;			}			if(!is_null($this->_good)){ 				 $data['good']=$this->_good;			}			if(!is_null($this->_normal)){ 				 $data['normal']=$this->_normal;			}			if(!is_null($this->_bad)){ 				 $data['bad']=$this->_bad;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('mark_config_id' => $this->_mark_config_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * 查询表keke_witkey_mark_config,当有条件时返回有条件的ROW，否则返所有记录		 * @return 返回一个(array)关联数组		 */		function query_keke_witkey_mark_config(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_mark_config(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_mark_config(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where mark_config_id = $this->_mark_config_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>