<?php
  class Keke_witkey_service_order_detail_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_detail_id; //主键 		 var $_order_id; 		 var $_step_num; 		 var $_step_cash; 		 var $_step_detail; 		 var $_step_status; 
	    var $_replace=0;  
	    var $_where;      
	     function  keke_witkey_service_order_detail_class(){ //构造方法			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_service_order_detail";		 }	    
	    		function getDetail_id(){			 return $this->_detail_id ;		}		function getOrder_id(){			 return $this->_order_id ;		}		function getStep_num(){			 return $this->_step_num ;		}		function getStep_cash(){			 return $this->_step_cash ;		}		function getStep_detail(){			 return $this->_step_detail ;		}		function getStep_status(){			 return $this->_step_status ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setDetail_id($value){ 			 $this->_detail_id = $value;		}		function setOrder_id($value){ 			 $this->_order_id = $value;		}		function setStep_num($value){ 			 $this->_step_num = $value;		}		function setStep_cash($value){ 			 $this->_step_cash = $value;		}		function setStep_detail($value){ 			 $this->_step_detail = $value;		}		function setStep_status($value){ 			 $this->_step_status = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * 表keke_witkey_service_order_detail创建或新增一条记录		 * @return 返回新增ID		 */		function create_keke_witkey_service_order_detail(){		 		 $data =  array(); 					if(!is_null($this->_detail_id)){ 				 $data['detail_id']=$this->_detail_id;			}			if(!is_null($this->_order_id)){ 				 $data['order_id']=$this->_order_id;			}			if(!is_null($this->_step_num)){ 				 $data['step_num']=$this->_step_num;			}			if(!is_null($this->_step_cash)){ 				 $data['step_cash']=$this->_step_cash;			}			if(!is_null($this->_step_detail)){ 				 $data['step_detail']=$this->_step_detail;			}			if(!is_null($this->_step_status)){ 				 $data['step_status']=$this->_step_status;			}			 return $this->_detail_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * 编辑表keke_witkey_service_order_detail的一个条记录		 * @return 返回影响的行数		 */		function edit_keke_witkey_service_order_detail(){ 		 		 $data =  array();  					if(!is_null($this->_detail_id)){ 				 $data['detail_id']=$this->_detail_id;			}			if(!is_null($this->_order_id)){ 				 $data['order_id']=$this->_order_id;			}			if(!is_null($this->_step_num)){ 				 $data['step_num']=$this->_step_num;			}			if(!is_null($this->_step_cash)){ 				 $data['step_cash']=$this->_step_cash;			}			if(!is_null($this->_step_detail)){ 				 $data['step_detail']=$this->_step_detail;			}			if(!is_null($this->_step_status)){ 				 $data['step_status']=$this->_step_status;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('detail_id' => $this->_detail_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * 查询表keke_witkey_service_order_detail,当有条件时返回有条件的ROW，否则返所有记录		 * @return 返回一个(array)关联数组		 */		function query_keke_witkey_service_order_detail(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_service_order_detail(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_service_order_detail(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where detail_id = $this->_detail_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>