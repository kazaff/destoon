<?php
  class Keke_witkey_shop_case_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_case_id; //主键 
		 var $_cus_cate_id; 
		 var $_shop_id; 
		 var $_case_type; 
		 var $_case_name; 
		 var $_express; 
		 var $_indus_id; 
		 var $_content; 
		 var $_uid; 
		 var $_username; 
		 var $_pic; 
		 var $_on_date; 

	    var $_replace=0;  
	    var $_where;      
	     function  keke_witkey_shop_case_class(){ //构�?�方�?
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_shop_case";
		 }
	    
	    		function getCase_id(){
			 return $this->_case_id ;
		}
		function getCus_cate_id(){
			 return $this->_cus_cate_id ;
		}
		function getShop_id(){
			 return $this->_shop_id ;
		}
		function getCase_type(){
			 return $this->_case_type ;
		}
		function getCase_name(){
			 return $this->_case_name ;
		}
		function getExpress(){
			 return $this->_express ;
		}
		function getIndus_id(){
			 return $this->_indus_id ;
		}
		function getContent(){
			 return $this->_content ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getPic(){
			 return $this->_pic ;
		}
		function getOn_date(){
			 return $this->_on_date ;
		}
		function getWhere(){
			 return $this->_where ;
		}

	    		function setCase_id($value){ 
			 $this->_case_id = $value;
		}
		function setCus_cate_id($value){ 
			 $this->_cus_cate_id = $value;
		}
		function setShop_id($value){ 
			 $this->_shop_id = $value;
		}
		function setCase_type($value){ 
			 $this->_case_type = $value;
		}
		function setCase_name($value){ 
			 $this->_case_name = $value;
		}
		function setExpress($value){ 
			 $this->_express = $value;
		}
		function setIndus_id($value){ 
			 $this->_indus_id = $value;
		}
		function setContent($value){ 
			 $this->_content = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setPic($value){ 
			 $this->_pic = $value;
		}
		function setOn_date($value){ 
			 $this->_on_date = $value;
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
		 * 表keke_witkey_shop_case创建或新增一�?�����?
		 * @return 返回新增ID
		 */
		function create_keke_witkey_shop_case(){
		 		 $data =  array(); 

					if(!is_null($this->_case_id)){ 
				 $data['case_id']=$this->_case_id;
			}
			if(!is_null($this->_cus_cate_id)){ 
				 $data['cus_cate_id']=$this->_cus_cate_id;
			}
			if(!is_null($this->_shop_id)){ 
				 $data['shop_id']=$this->_shop_id;
			}
			if(!is_null($this->_case_type)){ 
				 $data['case_type']=$this->_case_type;
			}
			if(!is_null($this->_case_name)){ 
				 $data['case_name']=$this->_case_name;
			}
			if(!is_null($this->_express)){ 
				 $data['express']=$this->_express;
			}
			if(!is_null($this->_indus_id)){ 
				 $data['indus_id']=$this->_indus_id;
			}
			if(!is_null($this->_content)){ 
				 $data['content']=$this->_content;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_pic)){ 
				 $data['pic']=$this->_pic;
			}
			if(!is_null($this->_on_date)){ 
				 $data['on_date']=$this->_on_date;
			}

			 return $this->_case_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 

	    /**
		 * 编辑表keke_witkey_shop_case的一个条记录
		 * @return 返回影响的行�?
		 */
		function edit_keke_witkey_shop_case(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_case_id)){ 
				 $data['case_id']=$this->_case_id;
			}
			if(!is_null($this->_cus_cate_id)){ 
				 $data['cus_cate_id']=$this->_cus_cate_id;
			}
			if(!is_null($this->_shop_id)){ 
				 $data['shop_id']=$this->_shop_id;
			}
			if(!is_null($this->_case_type)){ 
				 $data['case_type']=$this->_case_type;
			}
			if(!is_null($this->_case_name)){ 
				 $data['case_name']=$this->_case_name;
			}
			if(!is_null($this->_express)){ 
				 $data['express']=$this->_express;
			}
			if(!is_null($this->_indus_id)){ 
				 $data['indus_id']=$this->_indus_id;
			}
			if(!is_null($this->_content)){ 
				 $data['content']=$this->_content;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_pic)){ 
				 $data['pic']=$this->_pic;
			}
			if(!is_null($this->_on_date)){ 
				 $data['on_date']=$this->_on_date;
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
		 * 查询表keke_witkey_shop_case,当有条件时返回有条件的ROW，否则返�?有记�?
		 * @return 返回�?�?(array)关联数组
		 */
		function query_keke_witkey_shop_case(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 

	    
		function count_keke_witkey_shop_case(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 

	    
		function del_keke_witkey_shop_case(){ 
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
