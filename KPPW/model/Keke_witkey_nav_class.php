<?php
  class Keke_witkey_nav_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_nav_id; //主键 
		 var $_nav_url; 
		 var $_nav_title; 
		 var $_nav_style; 
		 var $_listorder; 
		 var $_newwindow; 
		 var $_ishide; 

	    var $_replace=0;  
	    var $_where;      
	     function  keke_witkey_nav_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_nav";
		 }
	    
	    		function getNav_id(){
			 return $this->_nav_id ;
		}
		function getNav_url(){
			 return $this->_nav_url ;
		}
		function getNav_title(){
			 return $this->_nav_title ;
		}
		function getNav_style(){
			 return $this->_nav_style ;
		}
		function getListorder(){
			 return $this->_listorder ;
		}
		function getNewwindow(){
			 return $this->_newwindow ;
		}
		function getIshide(){
			 return $this->_ishide ;
		}
		function getWhere(){
			 return $this->_where ;
		}

	    		function setNav_id($value){ 
			 $this->_nav_id = $value;
		}
		function setNav_url($value){ 
			 $this->_nav_url = $value;
		}
		function setNav_title($value){ 
			 $this->_nav_title = $value;
		}
		function setNav_style($value){ 
			 $this->_nav_style = $value;
		}
		function setListorder($value){ 
			 $this->_listorder = $value;
		}
		function setNewwindow($value){ 
			 $this->_newwindow = $value;
		}
		function setIshide($value){ 
			 $this->_ishide = $value;
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
		 * 表keke_witkey_nav创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_nav(){
		 		 $data =  array(); 

					if(!is_null($this->_nav_id)){ 
				 $data['nav_id']=$this->_nav_id;
			}
			if(!is_null($this->_nav_url)){ 
				 $data['nav_url']=$this->_nav_url;
			}
			if(!is_null($this->_nav_title)){ 
				 $data['nav_title']=$this->_nav_title;
			}
			if(!is_null($this->_nav_style)){ 
				 $data['nav_style']=$this->_nav_style;
			}
			if(!is_null($this->_listorder)){ 
				 $data['listorder']=$this->_listorder;
			}
			if(!is_null($this->_newwindow)){ 
				 $data['newwindow']=$this->_newwindow;
			}
			if(!is_null($this->_ishide)){ 
				 $data['ishide']=$this->_ishide;
			}

			 return $this->_nav_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 

	    /**
		 * 编辑表keke_witkey_nav的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_nav(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_nav_id)){ 
				 $data['nav_id']=$this->_nav_id;
			}
			if(!is_null($this->_nav_url)){ 
				 $data['nav_url']=$this->_nav_url;
			}
			if(!is_null($this->_nav_title)){ 
				 $data['nav_title']=$this->_nav_title;
			}
			if(!is_null($this->_nav_style)){ 
				 $data['nav_style']=$this->_nav_style;
			}
			if(!is_null($this->_listorder)){ 
				 $data['listorder']=$this->_listorder;
			}
			if(!is_null($this->_newwindow)){ 
				 $data['newwindow']=$this->_newwindow;
			}
			if(!is_null($this->_ishide)){ 
				 $data['ishide']=$this->_ishide;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('nav_id' => $this->_nav_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 

	    /**
		 * 查询表keke_witkey_nav,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_nav(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 

	    
		function count_keke_witkey_nav(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 

	    
		function del_keke_witkey_nav(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where nav_id = $this->_nav_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 

	   
	    
	    
   }
 ?>