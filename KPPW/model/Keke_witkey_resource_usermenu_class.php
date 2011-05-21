<?php
  class Keke_witkey_resource_usermenu_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_menu_id; //主键 		 var $_menu_name; 		 var $_menu_items; 		 var $_listorder; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //查，改，删条件
	     function  keke_witkey_resource_usermenu_class(){ //构造方法			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_resource_usermenu";		 }	    
	    		function getMenu_id(){			 return $this->_menu_id ;		}		function getMenu_name(){			 return $this->_menu_name ;		}		function getMenu_items(){			 return $this->_menu_items ;		}		function getListorder(){			 return $this->_listorder ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setMenu_id($value){ 			 $this->_menu_id = $value;		}		function setMenu_name($value){ 			 $this->_menu_name = $value;		}		function setMenu_items($value){ 			 $this->_menu_items = $value;		}		function setListorder($value){ 			 $this->_listorder = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * 表keke_witkey_resource_usermenu创建或新增一条记录		 * @return 返回新增ID		 */		function create_keke_witkey_resource_usermenu(){		 		 $data =  array(); 					if(!is_null($this->_menu_id)){ 				 $data['menu_id']=$this->_menu_id;			}			if(!is_null($this->_menu_name)){ 				 $data['menu_name']=$this->_menu_name;			}			if(!is_null($this->_menu_items)){ 				 $data['menu_items']=$this->_menu_items;			}			if(!is_null($this->_listorder)){ 				 $data['listorder']=$this->_listorder;			}			 return $this->_menu_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * 编辑表keke_witkey_resource_usermenu的一个条记录		 * @return 返回影响的行数		 */		function edit_keke_witkey_resource_usermenu(){ 		 		 $data =  array();  					if(!is_null($this->_menu_id)){ 				 $data['menu_id']=$this->_menu_id;			}			if(!is_null($this->_menu_name)){ 				 $data['menu_name']=$this->_menu_name;			}			if(!is_null($this->_menu_items)){ 				 $data['menu_items']=$this->_menu_items;			}			if(!is_null($this->_listorder)){ 				 $data['listorder']=$this->_listorder;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('menu_id' => $this->_menu_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * 查询表keke_witkey_resource_usermenu,当有条件时返回有条件的ROW，否则返所有记录		 * @return 返回一个(array)关联数组		 */		function query_keke_witkey_resource_usermenu(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_resource_usermenu(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_resource_usermenu(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where menu_id = $this->_menu_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>