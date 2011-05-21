<?php
  class Keke_witkey_shop_image_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_image_id; //主键 		 var $_image_address; 		 var $_image_name; 		 var $_indus_id; 		 var $_list_order; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //查，改，删条件
	     function  keke_witkey_shop_image_class(){ //构造方法			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_shop_image";		 }	    
	    		function getImage_id(){			 return $this->_image_id ;		}		function getImage_address(){			 return $this->_image_address ;		}		function getImage_name(){			 return $this->_image_name ;		}		function getIndus_id(){			 return $this->_indus_id ;		}		function getList_order(){			 return $this->_list_order ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setImage_id($value){ 			 $this->_image_id = $value;		}		function setImage_address($value){ 			 $this->_image_address = $value;		}		function setImage_name($value){ 			 $this->_image_name = $value;		}		function setIndus_id($value){ 			 $this->_indus_id = $value;		}		function setList_order($value){ 			 $this->_list_order = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * 表keke_witkey_shop_image创建或新增一条记录		 * @return 返回新增ID		 */		function create_keke_witkey_shop_image(){		 		 $data =  array(); 					if(!is_null($this->_image_id)){ 				 $data['image_id']=$this->_image_id;			}			if(!is_null($this->_image_address)){ 				 $data['image_address']=$this->_image_address;			}			if(!is_null($this->_image_name)){ 				 $data['image_name']=$this->_image_name;			}			if(!is_null($this->_indus_id)){ 				 $data['indus_id']=$this->_indus_id;			}			if(!is_null($this->_list_order)){ 				 $data['list_order']=$this->_list_order;			}			 return $this->_image_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * 编辑表keke_witkey_shop_image的一个条记录		 * @return 返回影响的行数		 */		function edit_keke_witkey_shop_image(){ 		 		 $data =  array();  					if(!is_null($this->_image_id)){ 				 $data['image_id']=$this->_image_id;			}			if(!is_null($this->_image_address)){ 				 $data['image_address']=$this->_image_address;			}			if(!is_null($this->_image_name)){ 				 $data['image_name']=$this->_image_name;			}			if(!is_null($this->_indus_id)){ 				 $data['indus_id']=$this->_indus_id;			}			if(!is_null($this->_list_order)){ 				 $data['list_order']=$this->_list_order;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('image_id' => $this->_image_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * 查询表keke_witkey_shop_image,当有条件时返回有条件的ROW，否则返所有记录		 * @return 返回一个(array)关联数组		 */		function query_keke_witkey_shop_image(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_shop_image(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_shop_image(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where image_id = $this->_image_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>