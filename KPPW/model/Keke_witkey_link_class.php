<?php

  class Keke_witkey_link_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_link_id; //主键 
		 var $_link_type; 
		 var $_link_name; 
		 var $_link_url; 
		 var $_link_pic; 
		 var $_listorder; 
		 var $_shop_id; 
		 var $_link_status; 
		 var $_on_time; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_link_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_link";
		 }
	    

	    		function getLink_id(){
			 return $this->_link_id ;
		}
		function getLink_type(){
			 return $this->_link_type ;
		}
		function getLink_name(){
			 return $this->_link_name ;
		}
		function getLink_url(){
			 return $this->_link_url ;
		}
		function getLink_pic(){
			 return $this->_link_pic ;
		}
		function getListorder(){
			 return $this->_listorder ;
		}
		function getShop_id(){
			 return $this->_shop_id ;
		}
		function getLink_status(){
			 return $this->_link_status ;
		}
		function getOn_time(){
			 return $this->_on_time ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setLink_id($value){ 
			 $this->_link_id = $value;
		}
		function setLink_type($value){ 
			 $this->_link_type = $value;
		}
		function setLink_name($value){ 
			 $this->_link_name = $value;
		}
		function setLink_url($value){ 
			 $this->_link_url = $value;
		}
		function setLink_pic($value){ 
			 $this->_link_pic = $value;
		}
		function setListorder($value){ 
			 $this->_listorder = $value;
		}
		function setShop_id($value){ 
			 $this->_shop_id = $value;
		}
		function setLink_status($value){ 
			 $this->_link_status = $value;
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
		 * 表keke_witkey_link创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_link(){
		 		 $data =  array(); 

					if(!is_null($this->_link_id)){ 
				 $data['link_id']=$this->_link_id;
			}
			if(!is_null($this->_link_type)){ 
				 $data['link_type']=$this->_link_type;
			}
			if(!is_null($this->_link_name)){ 
				 $data['link_name']=$this->_link_name;
			}
			if(!is_null($this->_link_url)){ 
				 $data['link_url']=$this->_link_url;
			}
			if(!is_null($this->_link_pic)){ 
				 $data['link_pic']=$this->_link_pic;
			}
			if(!is_null($this->_listorder)){ 
				 $data['listorder']=$this->_listorder;
			}
			if(!is_null($this->_shop_id)){ 
				 $data['shop_id']=$this->_shop_id;
			}
			if(!is_null($this->_link_status)){ 
				 $data['link_status']=$this->_link_status;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}

			 return $this->_link_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_link的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_link(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_link_id)){ 
				 $data['link_id']=$this->_link_id;
			}
			if(!is_null($this->_link_type)){ 
				 $data['link_type']=$this->_link_type;
			}
			if(!is_null($this->_link_name)){ 
				 $data['link_name']=$this->_link_name;
			}
			if(!is_null($this->_link_url)){ 
				 $data['link_url']=$this->_link_url;
			}
			if(!is_null($this->_link_pic)){ 
				 $data['link_pic']=$this->_link_pic;
			}
			if(!is_null($this->_listorder)){ 
				 $data['listorder']=$this->_listorder;
			}
			if(!is_null($this->_shop_id)){ 
				 $data['shop_id']=$this->_shop_id;
			}
			if(!is_null($this->_link_status)){ 
				 $data['link_status']=$this->_link_status;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('link_id' => $this->_link_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_link,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_link(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_link(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_link(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where link_id = $this->_link_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>