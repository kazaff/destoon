<?php
  class Keke_witkey_resource_submenu_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_submenu_id; //���� 		 var $_submenu_name; 		 var $_menu_name; 		 var $_listorder; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //�飬�ģ�ɾ����
	     function  keke_witkey_resource_submenu_class(){ //���췽��			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_resource_submenu";		 }	    
	    		function getSubmenu_id(){			 return $this->_submenu_id ;		}		function getSubmenu_name(){			 return $this->_submenu_name ;		}		function getMenu_name(){			 return $this->_menu_name ;		}		function getListorder(){			 return $this->_listorder ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setSubmenu_id($value){ 			 $this->_submenu_id = $value;		}		function setSubmenu_name($value){ 			 $this->_submenu_name = $value;		}		function setMenu_name($value){ 			 $this->_menu_name = $value;		}		function setListorder($value){ 			 $this->_listorder = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * ��keke_witkey_resource_submenu����������һ����¼		 * @return ��������ID		 */		function create_keke_witkey_resource_submenu(){		 		 $data =  array(); 					if(!is_null($this->_submenu_id)){ 				 $data['submenu_id']=$this->_submenu_id;			}			if(!is_null($this->_submenu_name)){ 				 $data['submenu_name']=$this->_submenu_name;			}			if(!is_null($this->_menu_name)){ 				 $data['menu_name']=$this->_menu_name;			}			if(!is_null($this->_listorder)){ 				 $data['listorder']=$this->_listorder;			}			 return $this->_submenu_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * �༭��keke_witkey_resource_submenu��һ������¼		 * @return ����Ӱ�������		 */		function edit_keke_witkey_resource_submenu(){ 		 		 $data =  array();  					if(!is_null($this->_submenu_id)){ 				 $data['submenu_id']=$this->_submenu_id;			}			if(!is_null($this->_submenu_name)){ 				 $data['submenu_name']=$this->_submenu_name;			}			if(!is_null($this->_menu_name)){ 				 $data['menu_name']=$this->_menu_name;			}			if(!is_null($this->_listorder)){ 				 $data['listorder']=$this->_listorder;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('submenu_id' => $this->_submenu_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * ��ѯ��keke_witkey_resource_submenu,��������ʱ������������ROW���������м�¼		 * @return ����һ��(array)��������		 */		function query_keke_witkey_resource_submenu(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_resource_submenu(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_resource_submenu(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where submenu_id = $this->_submenu_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>