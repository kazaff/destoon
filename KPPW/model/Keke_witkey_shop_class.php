<?php

  class Keke_witkey_shop_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_shop_id; //主键 
		 var $_uid; 
		 var $_username; 
		 var $_indus_id; 
		 var $_shop_name; 
		 var $_city; 
		 var $_service_range; 
		 var $_aboutus; 
		 var $_linkman; 
		 var $_job; 
		 var $_tel; 
		 var $_fax; 
		 var $_moblie; 
		 var $_email; 
		 var $_work_year; 
		 var $_address; 
		 var $_shop_type; 
		 var $_on_time; 
		 var $_is_close; 
		 var $_views; 


	    var $_replace=0;  

	    var $_where;      

	     function  keke_witkey_shop_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_shop";
		 }
	    

	    		function getShop_id(){
			 return $this->_shop_id ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getIndus_id(){
			 return $this->_indus_id ;
		}
		function getShop_name(){
			 return $this->_shop_name ;
		}
		function getCity(){
			 return $this->_city ;
		}
		function getService_range(){
			 return $this->_service_range ;
		}
		function getAboutus(){
			 return $this->_aboutus ;
		}
		function getLinkman(){
			 return $this->_linkman ;
		}
		function getJob(){
			 return $this->_job ;
		}
		function getTel(){
			 return $this->_tel ;
		}
		function getFax(){
			 return $this->_fax ;
		}
		function getMoblie(){
			 return $this->_moblie ;
		}
		function getEmail(){
			 return $this->_email ;
		}
		function getWork_year(){
			 return $this->_work_year ;
		}
		function getAddress(){
			 return $this->_address ;
		}
		function getShop_type(){
			 return $this->_shop_type ;
		}
		function getOn_time(){
			 return $this->_on_time ;
		}
		function getIs_close(){
			 return $this->_is_close ;
		}
		function getViews(){
			 return $this->_views ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setShop_id($value){ 
			 $this->_shop_id = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setIndus_id($value){ 
			 $this->_indus_id = $value;
		}
		function setShop_name($value){ 
			 $this->_shop_name = $value;
		}
		function setCity($value){ 
			 $this->_city = $value;
		}
		function setService_range($value){ 
			 $this->_service_range = $value;
		}
		function setAboutus($value){ 
			 $this->_aboutus = $value;
		}
		function setLinkman($value){ 
			 $this->_linkman = $value;
		}
		function setJob($value){ 
			 $this->_job = $value;
		}
		function setTel($value){ 
			 $this->_tel = $value;
		}
		function setFax($value){ 
			 $this->_fax = $value;
		}
		function setMoblie($value){ 
			 $this->_moblie = $value;
		}
		function setEmail($value){ 
			 $this->_email = $value;
		}
		function setWork_year($value){ 
			 $this->_work_year = $value;
		}
		function setAddress($value){ 
			 $this->_address = $value;
		}
		function setShop_type($value){ 
			 $this->_shop_type = $value;
		}
		function setOn_time($value){ 
			 $this->_on_time = $value;
		}
		function setIs_close($value){ 
			 $this->_is_close = $value;
		}
		function setViews($value){ 
			 $this->_views = $value;
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
		 * 表keke_witkey_shop创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_shop(){
		 		 $data =  array(); 

					if(!is_null($this->_shop_id)){ 
				 $data['shop_id']=$this->_shop_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_indus_id)){ 
				 $data['indus_id']=$this->_indus_id;
			}
			if(!is_null($this->_shop_name)){ 
				 $data['shop_name']=$this->_shop_name;
			}
			if(!is_null($this->_city)){ 
				 $data['city']=$this->_city;
			}
			if(!is_null($this->_service_range)){ 
				 $data['service_range']=$this->_service_range;
			}
			if(!is_null($this->_aboutus)){ 
				 $data['aboutus']=$this->_aboutus;
			}
			if(!is_null($this->_linkman)){ 
				 $data['linkman']=$this->_linkman;
			}
			if(!is_null($this->_job)){ 
				 $data['job']=$this->_job;
			}
			if(!is_null($this->_tel)){ 
				 $data['tel']=$this->_tel;
			}
			if(!is_null($this->_fax)){ 
				 $data['fax']=$this->_fax;
			}
			if(!is_null($this->_moblie)){ 
				 $data['moblie']=$this->_moblie;
			}
			if(!is_null($this->_email)){ 
				 $data['email']=$this->_email;
			}
			if(!is_null($this->_work_year)){ 
				 $data['work_year']=$this->_work_year;
			}
			if(!is_null($this->_address)){ 
				 $data['address']=$this->_address;
			}
			if(!is_null($this->_shop_type)){ 
				 $data['shop_type']=$this->_shop_type;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}
			if(!is_null($this->_is_close)){ 
				 $data['is_close']=$this->_is_close;
			}
			if(!is_null($this->_views)){ 
				 $data['views']=$this->_views;
			}

			 return $this->_shop_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_shop的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_shop(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_shop_id)){ 
				 $data['shop_id']=$this->_shop_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_indus_id)){ 
				 $data['indus_id']=$this->_indus_id;
			}
			if(!is_null($this->_shop_name)){ 
				 $data['shop_name']=$this->_shop_name;
			}
			if(!is_null($this->_city)){ 
				 $data['city']=$this->_city;
			}
			if(!is_null($this->_service_range)){ 
				 $data['service_range']=$this->_service_range;
			}
			if(!is_null($this->_aboutus)){ 
				 $data['aboutus']=$this->_aboutus;
			}
			if(!is_null($this->_linkman)){ 
				 $data['linkman']=$this->_linkman;
			}
			if(!is_null($this->_job)){ 
				 $data['job']=$this->_job;
			}
			if(!is_null($this->_tel)){ 
				 $data['tel']=$this->_tel;
			}
			if(!is_null($this->_fax)){ 
				 $data['fax']=$this->_fax;
			}
			if(!is_null($this->_moblie)){ 
				 $data['moblie']=$this->_moblie;
			}
			if(!is_null($this->_email)){ 
				 $data['email']=$this->_email;
			}
			if(!is_null($this->_work_year)){ 
				 $data['work_year']=$this->_work_year;
			}
			if(!is_null($this->_address)){ 
				 $data['address']=$this->_address;
			}
			if(!is_null($this->_shop_type)){ 
				 $data['shop_type']=$this->_shop_type;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}
			if(!is_null($this->_is_close)){ 
				 $data['is_close']=$this->_is_close;
			}
			if(!is_null($this->_views)){ 
				 $data['views']=$this->_views;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('shop_id' => $this->_shop_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_shop,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_shop(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_shop(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_shop(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where shop_id = $this->_shop_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>