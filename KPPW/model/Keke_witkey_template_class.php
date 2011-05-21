<?php
  class Keke_witkey_template_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_temp_id; //主键 		 var $_temp_title; 		 var $_temp_desc; 		 var $_develop; 		 var $_temp_pic; 		 var $_temp_path; 		 var $_is_selected; 		 var $_on_time; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //查，改，删条件
	     function  keke_witkey_template_class(){ //构造方法			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_template";		 }	    
	    		function getTemp_id(){			 return $this->_temp_id ;		}		function getTemp_title(){			 return $this->_temp_title ;		}		function getTemp_desc(){			 return $this->_temp_desc ;		}		function getDevelop(){			 return $this->_develop ;		}		function getTemp_pic(){			 return $this->_temp_pic ;		}		function getTemp_path(){			 return $this->_temp_path ;		}		function getIs_selected(){			 return $this->_is_selected ;		}		function getOn_time(){			 return $this->_on_time ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setTemp_id($value){ 			 $this->_temp_id = $value;		}		function setTemp_title($value){ 			 $this->_temp_title = $value;		}		function setTemp_desc($value){ 			 $this->_temp_desc = $value;		}		function setDevelop($value){ 			 $this->_develop = $value;		}		function setTemp_pic($value){ 			 $this->_temp_pic = $value;		}		function setTemp_path($value){ 			 $this->_temp_path = $value;		}		function setIs_selected($value){ 			 $this->_is_selected = $value;		}		function setOn_time($value){ 			 $this->_on_time = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * 表keke_witkey_template创建或新增一条记录		 * @return 返回新增ID		 */		function create_keke_witkey_template(){		 		 $data =  array(); 					if(!is_null($this->_temp_id)){ 				 $data['temp_id']=$this->_temp_id;			}			if(!is_null($this->_temp_title)){ 				 $data['temp_title']=$this->_temp_title;			}			if(!is_null($this->_temp_desc)){ 				 $data['temp_desc']=$this->_temp_desc;			}			if(!is_null($this->_develop)){ 				 $data['develop']=$this->_develop;			}			if(!is_null($this->_temp_pic)){ 				 $data['temp_pic']=$this->_temp_pic;			}			if(!is_null($this->_temp_path)){ 				 $data['temp_path']=$this->_temp_path;			}			if(!is_null($this->_is_selected)){ 				 $data['is_selected']=$this->_is_selected;			}			if(!is_null($this->_on_time)){ 				 $data['on_time']=$this->_on_time;			}			 return $this->_temp_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * 编辑表keke_witkey_template的一个条记录		 * @return 返回影响的行数		 */		function edit_keke_witkey_template(){ 		 		 $data =  array();  					if(!is_null($this->_temp_id)){ 				 $data['temp_id']=$this->_temp_id;			}			if(!is_null($this->_temp_title)){ 				 $data['temp_title']=$this->_temp_title;			}			if(!is_null($this->_temp_desc)){ 				 $data['temp_desc']=$this->_temp_desc;			}			if(!is_null($this->_develop)){ 				 $data['develop']=$this->_develop;			}			if(!is_null($this->_temp_pic)){ 				 $data['temp_pic']=$this->_temp_pic;			}			if(!is_null($this->_temp_path)){ 				 $data['temp_path']=$this->_temp_path;			}			if(!is_null($this->_is_selected)){ 				 $data['is_selected']=$this->_is_selected;			}			if(!is_null($this->_on_time)){ 				 $data['on_time']=$this->_on_time;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('temp_id' => $this->_temp_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * 查询表keke_witkey_template,当有条件时返回有条件的ROW，否则返所有记录		 * @return 返回一个(array)关联数组		 */		function query_keke_witkey_template(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_template(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_template(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where temp_id = $this->_temp_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>