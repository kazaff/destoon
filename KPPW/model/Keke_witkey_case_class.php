<?php

  class Keke_witkey_case_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_case_id; //主键 
		 var $_obj_id; 
		 var $_obj_type; 
		 var $_case_img; 
		 var $_case_title; 
		 var $_case_desc; 
		 var $_case_price; 
		 var $_case_auther; 
		 var $_on_time; 


	    var $_replace=0;  

	    var $_where;      

	     function  keke_witkey_case_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_case";
		 }
	    

	    		function getCase_id(){
			 return $this->_case_id ;
		}
		function getObj_id(){
			 return $this->_obj_id ;
		}
		function getObj_type(){
			 return $this->_obj_type ;
		}
		function getCase_img(){
			 return $this->_case_img ;
		}
		function getCase_title(){
			 return $this->_case_title ;
		}
		function getCase_desc(){
			 return $this->_case_desc ;
		}
		function getCase_price(){
			 return $this->_case_price ;
		}
		function getCase_auther(){
			 return $this->_case_auther ;
		}
		function getOn_time(){
			 return $this->_on_time ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setCase_id($value){ 
			 $this->_case_id = $value;
		}
		function setObj_id($value){ 
			 $this->_obj_id = $value;
		}
		function setObj_type($value){ 
			 $this->_obj_type = $value;
		}
		function setCase_img($value){ 
			 $this->_case_img = $value;
		}
		function setCase_title($value){ 
			 $this->_case_title = $value;
		}
		function setCase_desc($value){ 
			 $this->_case_desc = $value;
		}
		function setCase_price($value){ 
			 $this->_case_price = $value;
		}
		function setCase_auther($value){ 
			 $this->_case_auther = $value;
		}
		function setOn_time($value){ 
			 $this->_on_time = $value;
		}
		function setWhere($value){ 
			 $this->_where = $value;
		}


	    

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


    	

	    /**
		 * 表keke_witkey_case创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_case(){
		 		 $data =  array(); 

					if(!is_null($this->_case_id)){ 
				 $data['case_id']=$this->_case_id;
			}
			if(!is_null($this->_obj_id)){ 
				 $data['obj_id']=$this->_obj_id;
			}
			if(!is_null($this->_obj_type)){ 
				 $data['obj_type']=$this->_obj_type;
			}
			if(!is_null($this->_case_img)){ 
				 $data['case_img']=$this->_case_img;
			}
			if(!is_null($this->_case_title)){ 
				 $data['case_title']=$this->_case_title;
			}
			if(!is_null($this->_case_desc)){ 
				 $data['case_desc']=$this->_case_desc;
			}
			if(!is_null($this->_case_price)){ 
				 $data['case_price']=$this->_case_price;
			}
			if(!is_null($this->_case_auther)){ 
				 $data['case_auther']=$this->_case_auther;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}

			 return $this->_case_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_case的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_case(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_case_id)){ 
				 $data['case_id']=$this->_case_id;
			}
			if(!is_null($this->_obj_id)){ 
				 $data['obj_id']=$this->_obj_id;
			}
			if(!is_null($this->_obj_type)){ 
				 $data['obj_type']=$this->_obj_type;
			}
			if(!is_null($this->_case_img)){ 
				 $data['case_img']=$this->_case_img;
			}
			if(!is_null($this->_case_title)){ 
				 $data['case_title']=$this->_case_title;
			}
			if(!is_null($this->_case_desc)){ 
				 $data['case_desc']=$this->_case_desc;
			}
			if(!is_null($this->_case_price)){ 
				 $data['case_price']=$this->_case_price;
			}
			if(!is_null($this->_case_auther)){ 
				 $data['case_auther']=$this->_case_auther;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('case_id' => $this->_case_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_case,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_case(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_case(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_case(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where case_id = $this->_case_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>