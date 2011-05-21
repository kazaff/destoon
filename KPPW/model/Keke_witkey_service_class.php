<?php

  class Keke_witkey_service_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_service_id; //主键 
		 var $_service_type; 
		 var $_shop_id; 
		 var $_uid; 
		 var $_username; 
		 var $_indus_id; 
		 var $_indus_path; 
		 var $_cus_cate_id; 
		 var $_title; 
		 var $_price; 
		 var $_unite_price; 
		 var $_service_time; 
		 var $_unit_time; 
		 var $_obj_name; 
		 var $_pic; 
		 var $_ad_pic; 
		 var $_area_range; 
		 var $_key_word; 
		 var $_submit_method; 
		 var $_file_path; 
		 var $_content; 
		 var $_on_time; 
		 var $_is_stop; 
		 var $_sale_num; 
		 var $_views; 
		 var $_refresh_time; 


	    var $_replace=0;  

	    var $_where;      

	     function  keke_witkey_service_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_service";
		 }
	    

	    		function getService_id(){
			 return $this->_service_id ;
		}
		function getService_type(){
			 return $this->_service_type ;
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
		function getIndus_path(){
			 return $this->_indus_path ;
		}
		function getCus_cate_id(){
			 return $this->_cus_cate_id ;
		}
		function getTitle(){
			 return $this->_title ;
		}
		function getPrice(){
			 return $this->_price ;
		}
		function getUnite_price(){
			 return $this->_unite_price ;
		}
		function getService_time(){
			 return $this->_service_time ;
		}
		function getUnit_time(){
			 return $this->_unit_time ;
		}
		function getObj_name(){
			 return $this->_obj_name ;
		}
		function getPic(){
			 return $this->_pic ;
		}
		function getAd_pic(){
			 return $this->_ad_pic ;
		}
		function getArea_range(){
			 return $this->_area_range ;
		}
		function getKey_word(){
			 return $this->_key_word ;
		}
		function getSubmit_method(){
			 return $this->_submit_method ;
		}
		function getFile_path(){
			 return $this->_file_path ;
		}
		function getContent(){
			 return $this->_content ;
		}
		function getOn_time(){
			 return $this->_on_time ;
		}
		function getIs_stop(){
			 return $this->_is_stop ;
		}
		function getSale_num(){
			 return $this->_sale_num ;
		}
		function getViews(){
			 return $this->_views ;
		}
		function getRefresh_time(){
			 return $this->_refresh_time ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setService_id($value){ 
			 $this->_service_id = $value;
		}
		function setService_type($value){ 
			 $this->_service_type = $value;
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
		function setIndus_path($value){ 
			 $this->_indus_path = $value;
		}
		function setCus_cate_id($value){ 
			 $this->_cus_cate_id = $value;
		}
		function setTitle($value){ 
			 $this->_title = $value;
		}
		function setPrice($value){ 
			 $this->_price = $value;
		}
		function setUnite_price($value){ 
			 $this->_unite_price = $value;
		}
		function setService_time($value){ 
			 $this->_service_time = $value;
		}
		function setUnit_time($value){ 
			 $this->_unit_time = $value;
		}
		function setObj_name($value){ 
			 $this->_obj_name = $value;
		}
		function setPic($value){ 
			 $this->_pic = $value;
		}
		function setAd_pic($value){ 
			 $this->_ad_pic = $value;
		}
		function setArea_range($value){ 
			 $this->_area_range = $value;
		}
		function setKey_word($value){ 
			 $this->_key_word = $value;
		}
		function setSubmit_method($value){ 
			 $this->_submit_method = $value;
		}
		function setFile_path($value){ 
			 $this->_file_path = $value;
		}
		function setContent($value){ 
			 $this->_content = $value;
		}
		function setOn_time($value){ 
			 $this->_on_time = $value;
		}
		function setIs_stop($value){ 
			 $this->_is_stop = $value;
		}
		function setSale_num($value){ 
			 $this->_sale_num = $value;
		}
		function setViews($value){ 
			 $this->_views = $value;
		}
		function setRefresh_time($value){ 
			 $this->_refresh_time = $value;
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
		 * 表keke_witkey_service创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_service(){
		 		 $data =  array(); 

					if(!is_null($this->_service_id)){ 
				 $data['service_id']=$this->_service_id;
			}
			if(!is_null($this->_service_type)){ 
				 $data['service_type']=$this->_service_type;
			}
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
			if(!is_null($this->_indus_path)){ 
				 $data['indus_path']=$this->_indus_path;
			}
			if(!is_null($this->_cus_cate_id)){ 
				 $data['cus_cate_id']=$this->_cus_cate_id;
			}
			if(!is_null($this->_title)){ 
				 $data['title']=$this->_title;
			}
			if(!is_null($this->_price)){ 
				 $data['price']=$this->_price;
			}
			if(!is_null($this->_unite_price)){ 
				 $data['unite_price']=$this->_unite_price;
			}
			if(!is_null($this->_service_time)){ 
				 $data['service_time']=$this->_service_time;
			}
			if(!is_null($this->_unit_time)){ 
				 $data['unit_time']=$this->_unit_time;
			}
			if(!is_null($this->_obj_name)){ 
				 $data['obj_name']=$this->_obj_name;
			}
			if(!is_null($this->_pic)){ 
				 $data['pic']=$this->_pic;
			}
			if(!is_null($this->_ad_pic)){ 
				 $data['ad_pic']=$this->_ad_pic;
			}
			if(!is_null($this->_area_range)){ 
				 $data['area_range']=$this->_area_range;
			}
			if(!is_null($this->_key_word)){ 
				 $data['key_word']=$this->_key_word;
			}
			if(!is_null($this->_submit_method)){ 
				 $data['submit_method']=$this->_submit_method;
			}
			if(!is_null($this->_file_path)){ 
				 $data['file_path']=$this->_file_path;
			}
			if(!is_null($this->_content)){ 
				 $data['content']=$this->_content;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}
			if(!is_null($this->_is_stop)){ 
				 $data['is_stop']=$this->_is_stop;
			}
			if(!is_null($this->_sale_num)){ 
				 $data['sale_num']=$this->_sale_num;
			}
			if(!is_null($this->_views)){ 
				 $data['views']=$this->_views;
			}
			if(!is_null($this->_refresh_time)){ 
				 $data['refresh_time']=$this->_refresh_time;
			}

			 return $this->_service_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_service的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_service(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_service_id)){ 
				 $data['service_id']=$this->_service_id;
			}
			if(!is_null($this->_service_type)){ 
				 $data['service_type']=$this->_service_type;
			}
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
			if(!is_null($this->_indus_path)){ 
				 $data['indus_path']=$this->_indus_path;
			}
			if(!is_null($this->_cus_cate_id)){ 
				 $data['cus_cate_id']=$this->_cus_cate_id;
			}
			if(!is_null($this->_title)){ 
				 $data['title']=$this->_title;
			}
			if(!is_null($this->_price)){ 
				 $data['price']=$this->_price;
			}
			if(!is_null($this->_unite_price)){ 
				 $data['unite_price']=$this->_unite_price;
			}
			if(!is_null($this->_service_time)){ 
				 $data['service_time']=$this->_service_time;
			}
			if(!is_null($this->_unit_time)){ 
				 $data['unit_time']=$this->_unit_time;
			}
			if(!is_null($this->_obj_name)){ 
				 $data['obj_name']=$this->_obj_name;
			}
			if(!is_null($this->_pic)){ 
				 $data['pic']=$this->_pic;
			}
			if(!is_null($this->_ad_pic)){ 
				 $data['ad_pic']=$this->_ad_pic;
			}
			if(!is_null($this->_area_range)){ 
				 $data['area_range']=$this->_area_range;
			}
			if(!is_null($this->_key_word)){ 
				 $data['key_word']=$this->_key_word;
			}
			if(!is_null($this->_submit_method)){ 
				 $data['submit_method']=$this->_submit_method;
			}
			if(!is_null($this->_file_path)){ 
				 $data['file_path']=$this->_file_path;
			}
			if(!is_null($this->_content)){ 
				 $data['content']=$this->_content;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}
			if(!is_null($this->_is_stop)){ 
				 $data['is_stop']=$this->_is_stop;
			}
			if(!is_null($this->_sale_num)){ 
				 $data['sale_num']=$this->_sale_num;
			}
			if(!is_null($this->_views)){ 
				 $data['views']=$this->_views;
			}
			if(!is_null($this->_refresh_time)){ 
				 $data['refresh_time']=$this->_refresh_time;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('service_id' => $this->_service_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_service,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_service(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_service(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_service(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where service_id = $this->_service_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>