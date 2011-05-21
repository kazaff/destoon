<?php

  class Keke_witkey_article_category_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_art_cat_id; //主键 
		 var $_art_cat_pid; 
		 var $_cat_name; 
		 var $_listorder; 
		 var $_is_show; 
		 var $_on_time; 
		 var $_service_type; 
		 var $_art_index; 


	    var $_replace=0;  

	    var $_where;      

	     function  keke_witkey_article_category_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_article_category";
		 }
	    

	    		function getArt_cat_id(){
			 return $this->_art_cat_id ;
		}
		function getArt_cat_pid(){
			 return $this->_art_cat_pid ;
		}
		function getCat_name(){
			 return $this->_cat_name ;
		}
		function getListorder(){
			 return $this->_listorder ;
		}
		function getIs_show(){
			 return $this->_is_show ;
		}
		function getOn_time(){
			 return $this->_on_time ;
		}
		function getService_type(){
			 return $this->_service_type ;
		}
		function getArt_index(){
			 return $this->_art_index ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setArt_cat_id($value){ 
			 $this->_art_cat_id = $value;
		}
		function setArt_cat_pid($value){ 
			 $this->_art_cat_pid = $value;
		}
		function setCat_name($value){ 
			 $this->_cat_name = $value;
		}
		function setListorder($value){ 
			 $this->_listorder = $value;
		}
		function setIs_show($value){ 
			 $this->_is_show = $value;
		}
		function setOn_time($value){ 
			 $this->_on_time = $value;
		}
		function setService_type($value){ 
			 $this->_service_type = $value;
		}
		function setArt_index($value){ 
			 $this->_art_index = $value;
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
		 * 表keke_witkey_article_category创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_article_category(){
		 		 $data =  array(); 

					if(!is_null($this->_art_cat_id)){ 
				 $data['art_cat_id']=$this->_art_cat_id;
			}
			if(!is_null($this->_art_cat_pid)){ 
				 $data['art_cat_pid']=$this->_art_cat_pid;
			}
			if(!is_null($this->_cat_name)){ 
				 $data['cat_name']=$this->_cat_name;
			}
			if(!is_null($this->_listorder)){ 
				 $data['listorder']=$this->_listorder;
			}
			if(!is_null($this->_is_show)){ 
				 $data['is_show']=$this->_is_show;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}
			if(!is_null($this->_service_type)){ 
				 $data['service_type']=$this->_service_type;
			}
			if(!is_null($this->_art_index)){ 
				 $data['art_index']=$this->_art_index;
			}

			 return $this->_art_cat_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_article_category的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_article_category(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_art_cat_id)){ 
				 $data['art_cat_id']=$this->_art_cat_id;
			}
			if(!is_null($this->_art_cat_pid)){ 
				 $data['art_cat_pid']=$this->_art_cat_pid;
			}
			if(!is_null($this->_cat_name)){ 
				 $data['cat_name']=$this->_cat_name;
			}
			if(!is_null($this->_listorder)){ 
				 $data['listorder']=$this->_listorder;
			}
			if(!is_null($this->_is_show)){ 
				 $data['is_show']=$this->_is_show;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}
			if(!is_null($this->_service_type)){ 
				 $data['service_type']=$this->_service_type;
			}
			if(!is_null($this->_art_index)){ 
				 $data['art_index']=$this->_art_index;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('art_cat_id' => $this->_art_cat_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_article_category,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_article_category(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_article_category(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_article_category(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where art_cat_id = $this->_art_cat_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>