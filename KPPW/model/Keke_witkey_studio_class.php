<?php

  class Keke_witkey_studio_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_studio_id; //主键 
		 var $_title; 
		 var $_aboutus; 
		 var $_logo; 
		 var $_members; 
		 var $_banner_pic; 
		 var $_uid; 
		 var $_address; 
		 var $_postcode; 
		 var $_email; 
		 var $_phone; 
		 var $_fax; 
		 var $_area; 
		 var $_username; 
		 var $_studio_status; 
		 var $_on_date; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_studio_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_studio";
		 }
	    

	    		function getStudio_id(){
			 return $this->_studio_id ;
		}
		function getTitle(){
			 return $this->_title ;
		}
		function getAboutus(){
			 return $this->_aboutus ;
		}
		function getLogo(){
			 return $this->_logo ;
		}
		function getMembers(){
			 return $this->_members ;
		}
		function getBanner_pic(){
			 return $this->_banner_pic ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getAddress(){
			 return $this->_address ;
		}
		function getPostcode(){
			 return $this->_postcode ;
		}
		function getEmail(){
			 return $this->_email ;
		}
		function getPhone(){
			 return $this->_phone ;
		}
		function getFax(){
			 return $this->_fax ;
		}
		function getArea(){
			 return $this->_area ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getStudio_status(){
			 return $this->_studio_status ;
		}
		function getOn_date(){
			 return $this->_on_date ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setStudio_id($value){ 
			 $this->_studio_id = $value;
		}
		function setTitle($value){ 
			 $this->_title = $value;
		}
		function setAboutus($value){ 
			 $this->_aboutus = $value;
		}
		function setLogo($value){ 
			 $this->_logo = $value;
		}
		function setMembers($value){ 
			 $this->_members = $value;
		}
		function setBanner_pic($value){ 
			 $this->_banner_pic = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setAddress($value){ 
			 $this->_address = $value;
		}
		function setPostcode($value){ 
			 $this->_postcode = $value;
		}
		function setEmail($value){ 
			 $this->_email = $value;
		}
		function setPhone($value){ 
			 $this->_phone = $value;
		}
		function setFax($value){ 
			 $this->_fax = $value;
		}
		function setArea($value){ 
			 $this->_area = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setStudio_status($value){ 
			 $this->_studio_status = $value;
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
		 * 表keke_witkey_studio创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_studio(){
		 		 $data =  array(); 

					if(!is_null($this->_studio_id)){ 
				 $data['studio_id']=$this->_studio_id;
			}
			if(!is_null($this->_title)){ 
				 $data['title']=$this->_title;
			}
			if(!is_null($this->_aboutus)){ 
				 $data['aboutus']=$this->_aboutus;
			}
			if(!is_null($this->_logo)){ 
				 $data['logo']=$this->_logo;
			}
			if(!is_null($this->_members)){ 
				 $data['members']=$this->_members;
			}
			if(!is_null($this->_banner_pic)){ 
				 $data['banner_pic']=$this->_banner_pic;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_address)){ 
				 $data['address']=$this->_address;
			}
			if(!is_null($this->_postcode)){ 
				 $data['postcode']=$this->_postcode;
			}
			if(!is_null($this->_email)){ 
				 $data['email']=$this->_email;
			}
			if(!is_null($this->_phone)){ 
				 $data['phone']=$this->_phone;
			}
			if(!is_null($this->_fax)){ 
				 $data['fax']=$this->_fax;
			}
			if(!is_null($this->_area)){ 
				 $data['area']=$this->_area;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_studio_status)){ 
				 $data['studio_status']=$this->_studio_status;
			}
			if(!is_null($this->_on_date)){ 
				 $data['on_date']=$this->_on_date;
			}

			 return $this->_studio_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_studio的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_studio(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_studio_id)){ 
				 $data['studio_id']=$this->_studio_id;
			}
			if(!is_null($this->_title)){ 
				 $data['title']=$this->_title;
			}
			if(!is_null($this->_aboutus)){ 
				 $data['aboutus']=$this->_aboutus;
			}
			if(!is_null($this->_logo)){ 
				 $data['logo']=$this->_logo;
			}
			if(!is_null($this->_members)){ 
				 $data['members']=$this->_members;
			}
			if(!is_null($this->_banner_pic)){ 
				 $data['banner_pic']=$this->_banner_pic;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_address)){ 
				 $data['address']=$this->_address;
			}
			if(!is_null($this->_postcode)){ 
				 $data['postcode']=$this->_postcode;
			}
			if(!is_null($this->_email)){ 
				 $data['email']=$this->_email;
			}
			if(!is_null($this->_phone)){ 
				 $data['phone']=$this->_phone;
			}
			if(!is_null($this->_fax)){ 
				 $data['fax']=$this->_fax;
			}
			if(!is_null($this->_area)){ 
				 $data['area']=$this->_area;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_studio_status)){ 
				 $data['studio_status']=$this->_studio_status;
			}
			if(!is_null($this->_on_date)){ 
				 $data['on_date']=$this->_on_date;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('studio_id' => $this->_studio_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_studio,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_studio(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_studio(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_studio(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where studio_id = $this->_studio_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>