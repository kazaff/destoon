<?php

  class Keke_witkey_ad_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_ad_id; //主键 
		 var $_ad_type; 
		 var $_ad_name; 
		 var $_ad_file; 
		 var $_ad_content; 
		 var $_ad_url; 
		 var $_ad_cash; 
		 var $_start_time; 
		 var $_end_time; 
		 var $_uid; 
		 var $_username; 
		 var $_listorder; 
		 var $_width; 
		 var $_height; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_ad_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_ad";
		 }
	    

	    		function getAd_id(){
			 return $this->_ad_id ;
		}
		function getAd_type(){
			 return $this->_ad_type ;
		}
		function getAd_name(){
			 return $this->_ad_name ;
		}
		function getAd_file(){
			 return $this->_ad_file ;
		}
		function getAd_content(){
			 return $this->_ad_content ;
		}
		function getAd_url(){
			 return $this->_ad_url ;
		}
		function getAd_cash(){
			 return $this->_ad_cash ;
		}
		function getStart_time(){
			 return $this->_start_time ;
		}
		function getEnd_time(){
			 return $this->_end_time ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getListorder(){
			 return $this->_listorder ;
		}
		function getWidth(){
			 return $this->_width ;
		}
		function getHeight(){
			 return $this->_height ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setAd_id($value){ 
			 $this->_ad_id = $value;
		}
		function setAd_type($value){ 
			 $this->_ad_type = $value;
		}
		function setAd_name($value){ 
			 $this->_ad_name = $value;
		}
		function setAd_file($value){ 
			 $this->_ad_file = $value;
		}
		function setAd_content($value){ 
			 $this->_ad_content = $value;
		}
		function setAd_url($value){ 
			 $this->_ad_url = $value;
		}
		function setAd_cash($value){ 
			 $this->_ad_cash = $value;
		}
		function setStart_time($value){ 
			 $this->_start_time = $value;
		}
		function setEnd_time($value){ 
			 $this->_end_time = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setListorder($value){ 
			 $this->_listorder = $value;
		}
		function setWidth($value){ 
			 $this->_width = $value;
		}
		function setHeight($value){ 
			 $this->_height = $value;
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
		 * 表keke_witkey_ad创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_ad(){
		 		 $data =  array(); 

					if(!is_null($this->_ad_id)){ 
				 $data['ad_id']=$this->_ad_id;
			}
			if(!is_null($this->_ad_type)){ 
				 $data['ad_type']=$this->_ad_type;
			}
			if(!is_null($this->_ad_name)){ 
				 $data['ad_name']=$this->_ad_name;
			}
			if(!is_null($this->_ad_file)){ 
				 $data['ad_file']=$this->_ad_file;
			}
			if(!is_null($this->_ad_content)){ 
				 $data['ad_content']=$this->_ad_content;
			}
			if(!is_null($this->_ad_url)){ 
				 $data['ad_url']=$this->_ad_url;
			}
			if(!is_null($this->_ad_cash)){ 
				 $data['ad_cash']=$this->_ad_cash;
			}
			if(!is_null($this->_start_time)){ 
				 $data['start_time']=$this->_start_time;
			}
			if(!is_null($this->_end_time)){ 
				 $data['end_time']=$this->_end_time;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_listorder)){ 
				 $data['listorder']=$this->_listorder;
			}
			if(!is_null($this->_width)){ 
				 $data['width']=$this->_width;
			}
			if(!is_null($this->_height)){ 
				 $data['height']=$this->_height;
			}

			 return $this->_ad_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_ad的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_ad(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_ad_id)){ 
				 $data['ad_id']=$this->_ad_id;
			}
			if(!is_null($this->_ad_type)){ 
				 $data['ad_type']=$this->_ad_type;
			}
			if(!is_null($this->_ad_name)){ 
				 $data['ad_name']=$this->_ad_name;
			}
			if(!is_null($this->_ad_file)){ 
				 $data['ad_file']=$this->_ad_file;
			}
			if(!is_null($this->_ad_content)){ 
				 $data['ad_content']=$this->_ad_content;
			}
			if(!is_null($this->_ad_url)){ 
				 $data['ad_url']=$this->_ad_url;
			}
			if(!is_null($this->_ad_cash)){ 
				 $data['ad_cash']=$this->_ad_cash;
			}
			if(!is_null($this->_start_time)){ 
				 $data['start_time']=$this->_start_time;
			}
			if(!is_null($this->_end_time)){ 
				 $data['end_time']=$this->_end_time;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_listorder)){ 
				 $data['listorder']=$this->_listorder;
			}
			if(!is_null($this->_width)){ 
				 $data['width']=$this->_width;
			}
			if(!is_null($this->_height)){ 
				 $data['height']=$this->_height;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('ad_id' => $this->_ad_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_ad,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_ad(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_ad(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_ad(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where ad_id = $this->_ad_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


   }

 ?>