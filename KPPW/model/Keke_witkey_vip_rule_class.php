<?php
  class Keke_witkey_vip_rule_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_vip_rule_id; //���� 		 var $_vip_cash; 		 var $_vip_day; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //�飬�ģ�ɾ����
	     function  keke_witkey_vip_rule_class(){ //���췽��			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_vip_rule";		 }	    
	    		function getVip_rule_id(){			 return $this->_vip_rule_id ;		}		function getVip_cash(){			 return $this->_vip_cash ;		}		function getVip_day(){			 return $this->_vip_day ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setVip_rule_id($value){ 			 $this->_vip_rule_id = $value;		}		function setVip_cash($value){ 			 $this->_vip_cash = $value;		}		function setVip_day($value){ 			 $this->_vip_day = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * ��keke_witkey_vip_rule����������һ����¼		 * @return ��������ID		 */		function create_keke_witkey_vip_rule(){		 		 $data =  array(); 					if(!is_null($this->_vip_rule_id)){ 				 $data['vip_rule_id']=$this->_vip_rule_id;			}			if(!is_null($this->_vip_cash)){ 				 $data['vip_cash']=$this->_vip_cash;			}			if(!is_null($this->_vip_day)){ 				 $data['vip_day']=$this->_vip_day;			}			 return $this->_vip_rule_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * �༭��keke_witkey_vip_rule��һ������¼		 * @return ����Ӱ�������		 */		function edit_keke_witkey_vip_rule(){ 		 		 $data =  array();  					if(!is_null($this->_vip_rule_id)){ 				 $data['vip_rule_id']=$this->_vip_rule_id;			}			if(!is_null($this->_vip_cash)){ 				 $data['vip_cash']=$this->_vip_cash;			}			if(!is_null($this->_vip_day)){ 				 $data['vip_day']=$this->_vip_day;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('vip_rule_id' => $this->_vip_rule_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * ��ѯ��keke_witkey_vip_rule,��������ʱ������������ROW���������м�¼		 * @return ����һ��(array)��������		 */		function query_keke_witkey_vip_rule(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_vip_rule(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_vip_rule(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where vip_rule_id = $this->_vip_rule_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>