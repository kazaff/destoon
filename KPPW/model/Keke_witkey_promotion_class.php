<?php
  class Keke_witkey_promotion_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_prom_id; //���� 		 var $_prom_uid; 		 var $_pub_uid; 		 var $_join_uid; 		 var $_task_id; 		 var $_prom_money; 		 var $_prom_status; 		 var $_prom_time; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //�飬�ģ�ɾ����
	     function  keke_witkey_promotion_class(){ //���췽��			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_promotion";		 }	    
	    		function getProm_id(){			 return $this->_prom_id ;		}		function getProm_uid(){			 return $this->_prom_uid ;		}		function getPub_uid(){			 return $this->_pub_uid ;		}		function getJoin_uid(){			 return $this->_join_uid ;		}		function getTask_id(){			 return $this->_task_id ;		}		function getProm_money(){			 return $this->_prom_money ;		}		function getProm_status(){			 return $this->_prom_status ;		}		function getProm_time(){			 return $this->_prom_time ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setProm_id($value){ 			 $this->_prom_id = $value;		}		function setProm_uid($value){ 			 $this->_prom_uid = $value;		}		function setPub_uid($value){ 			 $this->_pub_uid = $value;		}		function setJoin_uid($value){ 			 $this->_join_uid = $value;		}		function setTask_id($value){ 			 $this->_task_id = $value;		}		function setProm_money($value){ 			 $this->_prom_money = $value;		}		function setProm_status($value){ 			 $this->_prom_status = $value;		}		function setProm_time($value){ 			 $this->_prom_time = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * ��keke_witkey_promotion����������һ����¼		 * @return ��������ID		 */		function create_keke_witkey_promotion(){		 		 $data =  array(); 					if(!is_null($this->_prom_id)){ 				 $data['prom_id']=$this->_prom_id;			}			if(!is_null($this->_prom_uid)){ 				 $data['prom_uid']=$this->_prom_uid;			}			if(!is_null($this->_pub_uid)){ 				 $data['pub_uid']=$this->_pub_uid;			}			if(!is_null($this->_join_uid)){ 				 $data['join_uid']=$this->_join_uid;			}			if(!is_null($this->_task_id)){ 				 $data['task_id']=$this->_task_id;			}			if(!is_null($this->_prom_money)){ 				 $data['prom_money']=$this->_prom_money;			}			if(!is_null($this->_prom_status)){ 				 $data['prom_status']=$this->_prom_status;			}			if(!is_null($this->_prom_time)){ 				 $data['prom_time']=$this->_prom_time;			}			 return $this->_prom_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * �༭��keke_witkey_promotion��һ������¼		 * @return ����Ӱ�������		 */		function edit_keke_witkey_promotion(){ 		 		 $data =  array();  					if(!is_null($this->_prom_id)){ 				 $data['prom_id']=$this->_prom_id;			}			if(!is_null($this->_prom_uid)){ 				 $data['prom_uid']=$this->_prom_uid;			}			if(!is_null($this->_pub_uid)){ 				 $data['pub_uid']=$this->_pub_uid;			}			if(!is_null($this->_join_uid)){ 				 $data['join_uid']=$this->_join_uid;			}			if(!is_null($this->_task_id)){ 				 $data['task_id']=$this->_task_id;			}			if(!is_null($this->_prom_money)){ 				 $data['prom_money']=$this->_prom_money;			}			if(!is_null($this->_prom_status)){ 				 $data['prom_status']=$this->_prom_status;			}			if(!is_null($this->_prom_time)){ 				 $data['prom_time']=$this->_prom_time;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('prom_id' => $this->_prom_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * ��ѯ��keke_witkey_promotion,��������ʱ������������ROW���������м�¼		 * @return ����һ��(array)��������		 */		function query_keke_witkey_promotion(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_promotion(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_promotion(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where prom_id = $this->_prom_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>