<?php
  class Keke_witkey_resource_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_resource_id; //���� 		 var $_resource_name; 		 var $_resource_url; 		 var $_submenu_id; 		 var $_listorder; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //�飬�ģ�ɾ����
	     function  keke_witkey_resource_class(){ //���췽��			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_resource";		 }	    
	    		function getResource_id(){			 return $this->_resource_id ;		}		function getResource_name(){			 return $this->_resource_name ;		}		function getResource_url(){			 return $this->_resource_url ;		}		function getSubmenu_id(){			 return $this->_submenu_id ;		}		function getListorder(){			 return $this->_listorder ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setResource_id($value){ 			 $this->_resource_id = $value;		}		function setResource_name($value){ 			 $this->_resource_name = $value;		}		function setResource_url($value){ 			 $this->_resource_url = $value;		}		function setSubmenu_id($value){ 			 $this->_submenu_id = $value;		}		function setListorder($value){ 			 $this->_listorder = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * ��keke_witkey_resource����������һ����¼		 * @return ��������ID		 */		function create_keke_witkey_resource(){		 		 $data =  array(); 					if(!is_null($this->_resource_id)){ 				 $data['resource_id']=$this->_resource_id;			}			if(!is_null($this->_resource_name)){ 				 $data['resource_name']=$this->_resource_name;			}			if(!is_null($this->_resource_url)){ 				 $data['resource_url']=$this->_resource_url;			}			if(!is_null($this->_submenu_id)){ 				 $data['submenu_id']=$this->_submenu_id;			}			if(!is_null($this->_listorder)){ 				 $data['listorder']=$this->_listorder;			}			 return $this->_resource_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * �༭��keke_witkey_resource��һ������¼		 * @return ����Ӱ�������		 */		function edit_keke_witkey_resource(){ 		 		 $data =  array();  					if(!is_null($this->_resource_id)){ 				 $data['resource_id']=$this->_resource_id;			}			if(!is_null($this->_resource_name)){ 				 $data['resource_name']=$this->_resource_name;			}			if(!is_null($this->_resource_url)){ 				 $data['resource_url']=$this->_resource_url;			}			if(!is_null($this->_submenu_id)){ 				 $data['submenu_id']=$this->_submenu_id;			}			if(!is_null($this->_listorder)){ 				 $data['listorder']=$this->_listorder;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('resource_id' => $this->_resource_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * ��ѯ��keke_witkey_resource,��������ʱ������������ROW���������м�¼		 * @return ����һ��(array)��������		 */		function query_keke_witkey_resource(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_resource(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_resource(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where resource_id = $this->_resource_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>