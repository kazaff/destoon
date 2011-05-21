<?php
  class Keke_witkey_zb_task_config_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_zb_config_id; //主键 		 var $_is_open_zb; 		 var $_zb_fees; 		 var $_zb_audit; 		 var $_vip_task_istop; 		 var $_vip_sign_istop; 		 var $_zb_max_time; 		 var $_on_time; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //查，改，删条件
	     function  keke_witkey_zb_task_config_class(){ //构造方法			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_zb_task_config";		 }	    
	    		function getZb_config_id(){			 return $this->_zb_config_id ;		}		function getIs_open_zb(){			 return $this->_is_open_zb ;		}		function getZb_fees(){			 return $this->_zb_fees ;		}		function getZb_audit(){			 return $this->_zb_audit ;		}		function getVip_task_istop(){			 return $this->_vip_task_istop ;		}		function getVip_sign_istop(){			 return $this->_vip_sign_istop ;		}		function getZb_max_time(){			 return $this->_zb_max_time ;		}		function getOn_time(){			 return $this->_on_time ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setZb_config_id($value){ 			 $this->_zb_config_id = $value;		}		function setIs_open_zb($value){ 			 $this->_is_open_zb = $value;		}		function setZb_fees($value){ 			 $this->_zb_fees = $value;		}		function setZb_audit($value){ 			 $this->_zb_audit = $value;		}		function setVip_task_istop($value){ 			 $this->_vip_task_istop = $value;		}		function setVip_sign_istop($value){ 			 $this->_vip_sign_istop = $value;		}		function setZb_max_time($value){ 			 $this->_zb_max_time = $value;		}		function setOn_time($value){ 			 $this->_on_time = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * 表keke_witkey_zb_task_config创建或新增一条记录		 * @return 返回新增ID		 */		function create_keke_witkey_zb_task_config(){		 		 $data =  array(); 					if(!is_null($this->_zb_config_id)){ 				 $data['zb_config_id']=$this->_zb_config_id;			}			if(!is_null($this->_is_open_zb)){ 				 $data['is_open_zb']=$this->_is_open_zb;			}			if(!is_null($this->_zb_fees)){ 				 $data['zb_fees']=$this->_zb_fees;			}			if(!is_null($this->_zb_audit)){ 				 $data['zb_audit']=$this->_zb_audit;			}			if(!is_null($this->_vip_task_istop)){ 				 $data['vip_task_istop']=$this->_vip_task_istop;			}			if(!is_null($this->_vip_sign_istop)){ 				 $data['vip_sign_istop']=$this->_vip_sign_istop;			}			if(!is_null($this->_zb_max_time)){ 				 $data['zb_max_time']=$this->_zb_max_time;			}			if(!is_null($this->_on_time)){ 				 $data['on_time']=$this->_on_time;			}			 return $this->_zb_config_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * 编辑表keke_witkey_zb_task_config的一个条记录		 * @return 返回影响的行数		 */		function edit_keke_witkey_zb_task_config(){ 		 		 $data =  array();  					if(!is_null($this->_zb_config_id)){ 				 $data['zb_config_id']=$this->_zb_config_id;			}			if(!is_null($this->_is_open_zb)){ 				 $data['is_open_zb']=$this->_is_open_zb;			}			if(!is_null($this->_zb_fees)){ 				 $data['zb_fees']=$this->_zb_fees;			}			if(!is_null($this->_zb_audit)){ 				 $data['zb_audit']=$this->_zb_audit;			}			if(!is_null($this->_vip_task_istop)){ 				 $data['vip_task_istop']=$this->_vip_task_istop;			}			if(!is_null($this->_vip_sign_istop)){ 				 $data['vip_sign_istop']=$this->_vip_sign_istop;			}			if(!is_null($this->_zb_max_time)){ 				 $data['zb_max_time']=$this->_zb_max_time;			}			if(!is_null($this->_on_time)){ 				 $data['on_time']=$this->_on_time;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('zb_config_id' => $this->_zb_config_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * 查询表keke_witkey_zb_task_config,当有条件时返回有条件的ROW，否则返所有记录		 * @return 返回一个(array)关联数组		 */		function query_keke_witkey_zb_task_config(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_zb_task_config(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_zb_task_config(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where zb_config_id = $this->_zb_config_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>