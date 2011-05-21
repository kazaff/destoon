<?php
  class Keke_witkey_shop_member_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_shop_member_id; //主键 		 var $_shop_id; 		 var $_real_name; 		 var $_licen_pic; 		 var $_job; 		 var $_express; 		 var $_top_xl; 		 var $_school; 		 var $_aboutus; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //查，改，删条件
	     function  keke_witkey_shop_member_class(){ //构造方法			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_shop_member";		 }	    
	    		function getShop_member_id(){			 return $this->_shop_member_id ;		}		function getShop_id(){			 return $this->_shop_id ;		}		function getReal_name(){			 return $this->_real_name ;		}		function getLicen_pic(){			 return $this->_licen_pic ;		}		function getJob(){			 return $this->_job ;		}		function getExpress(){			 return $this->_express ;		}		function getTop_xl(){			 return $this->_top_xl ;		}		function getSchool(){			 return $this->_school ;		}		function getAboutus(){			 return $this->_aboutus ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setShop_member_id($value){ 			 $this->_shop_member_id = $value;		}		function setShop_id($value){ 			 $this->_shop_id = $value;		}		function setReal_name($value){ 			 $this->_real_name = $value;		}		function setLicen_pic($value){ 			 $this->_licen_pic = $value;		}		function setJob($value){ 			 $this->_job = $value;		}		function setExpress($value){ 			 $this->_express = $value;		}		function setTop_xl($value){ 			 $this->_top_xl = $value;		}		function setSchool($value){ 			 $this->_school = $value;		}		function setAboutus($value){ 			 $this->_aboutus = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * 表keke_witkey_shop_member创建或新增一条记录		 * @return 返回新增ID		 */		function create_keke_witkey_shop_member(){		 		 $data =  array(); 					if(!is_null($this->_shop_member_id)){ 				 $data['shop_member_id']=$this->_shop_member_id;			}			if(!is_null($this->_shop_id)){ 				 $data['shop_id']=$this->_shop_id;			}			if(!is_null($this->_real_name)){ 				 $data['real_name']=$this->_real_name;			}			if(!is_null($this->_licen_pic)){ 				 $data['licen_pic']=$this->_licen_pic;			}			if(!is_null($this->_job)){ 				 $data['job']=$this->_job;			}			if(!is_null($this->_express)){ 				 $data['express']=$this->_express;			}			if(!is_null($this->_top_xl)){ 				 $data['top_xl']=$this->_top_xl;			}			if(!is_null($this->_school)){ 				 $data['school']=$this->_school;			}			if(!is_null($this->_aboutus)){ 				 $data['aboutus']=$this->_aboutus;			}			 return $this->_shop_member_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * 编辑表keke_witkey_shop_member的一个条记录		 * @return 返回影响的行数		 */		function edit_keke_witkey_shop_member(){ 		 		 $data =  array();  					if(!is_null($this->_shop_member_id)){ 				 $data['shop_member_id']=$this->_shop_member_id;			}			if(!is_null($this->_shop_id)){ 				 $data['shop_id']=$this->_shop_id;			}			if(!is_null($this->_real_name)){ 				 $data['real_name']=$this->_real_name;			}			if(!is_null($this->_licen_pic)){ 				 $data['licen_pic']=$this->_licen_pic;			}			if(!is_null($this->_job)){ 				 $data['job']=$this->_job;			}			if(!is_null($this->_express)){ 				 $data['express']=$this->_express;			}			if(!is_null($this->_top_xl)){ 				 $data['top_xl']=$this->_top_xl;			}			if(!is_null($this->_school)){ 				 $data['school']=$this->_school;			}			if(!is_null($this->_aboutus)){ 				 $data['aboutus']=$this->_aboutus;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('shop_member_id' => $this->_shop_member_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * 查询表keke_witkey_shop_member,当有条件时返回有条件的ROW，否则返所有记录		 * @return 返回一个(array)关联数组		 */		function query_keke_witkey_shop_member(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_shop_member(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_shop_member(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where shop_member_id = $this->_shop_member_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>