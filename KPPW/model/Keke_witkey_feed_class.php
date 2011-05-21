<?php

  class Keke_witkey_feed_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_feed_id; //主键 
		 var $_obj_id; 
		 var $_obj_link; 
		 var $_feedtype; 
		 var $_uid; 
		 var $_username; 
		 var $_icon; 
		 var $_title; 
		 var $_feed_desc; 
		 var $_feed_pic; 
		 var $_feed_time; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_feed_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_feed";
		 }
	    

	    		function getFeed_id(){
			 return $this->_feed_id ;
		}
		function getObj_id(){
			 return $this->_obj_id ;
		}
		function getObj_link(){
			 return $this->_obj_link ;
		}
		function getFeedtype(){
			 return $this->_feedtype ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getIcon(){
			 return $this->_icon ;
		}
		function getTitle(){
			 return $this->_title ;
		}
		function getFeed_desc(){
			 return $this->_feed_desc ;
		}
		function getFeed_pic(){
			 return $this->_feed_pic ;
		}
		function getFeed_time(){
			 return $this->_feed_time ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setFeed_id($value){ 
			 $this->_feed_id = $value;
		}
		function setObj_id($value){ 
			 $this->_obj_id = $value;
		}
		function setObj_link($value){ 
			 $this->_obj_link = $value;
		}
		function setFeedtype($value){ 
			 $this->_feedtype = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setIcon($value){ 
			 $this->_icon = $value;
		}
		function setTitle($value){ 
			 $this->_title = $value;
		}
		function setFeed_desc($value){ 
			 $this->_feed_desc = $value;
		}
		function setFeed_pic($value){ 
			 $this->_feed_pic = $value;
		}
		function setFeed_time($value){ 
			 $this->_feed_time = $value;
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
		 * 表keke_witkey_feed创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_feed(){
		 		 $data =  array(); 

					if(!is_null($this->_feed_id)){ 
				 $data['feed_id']=$this->_feed_id;
			}
			if(!is_null($this->_obj_id)){ 
				 $data['obj_id']=$this->_obj_id;
			}
			if(!is_null($this->_obj_link)){ 
				 $data['obj_link']=$this->_obj_link;
			}
			if(!is_null($this->_feedtype)){ 
				 $data['feedtype']=$this->_feedtype;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_icon)){ 
				 $data['icon']=$this->_icon;
			}
			if(!is_null($this->_title)){ 
				 $data['title']=$this->_title;
			}
			if(!is_null($this->_feed_desc)){ 
				 $data['feed_desc']=$this->_feed_desc;
			}
			if(!is_null($this->_feed_pic)){ 
				 $data['feed_pic']=$this->_feed_pic;
			}
			if(!is_null($this->_feed_time)){ 
				 $data['feed_time']=$this->_feed_time;
			}

			 return $this->_feed_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_feed的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_feed(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_feed_id)){ 
				 $data['feed_id']=$this->_feed_id;
			}
			if(!is_null($this->_obj_id)){ 
				 $data['obj_id']=$this->_obj_id;
			}
			if(!is_null($this->_obj_link)){ 
				 $data['obj_link']=$this->_obj_link;
			}
			if(!is_null($this->_feedtype)){ 
				 $data['feedtype']=$this->_feedtype;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_icon)){ 
				 $data['icon']=$this->_icon;
			}
			if(!is_null($this->_title)){ 
				 $data['title']=$this->_title;
			}
			if(!is_null($this->_feed_desc)){ 
				 $data['feed_desc']=$this->_feed_desc;
			}
			if(!is_null($this->_feed_pic)){ 
				 $data['feed_pic']=$this->_feed_pic;
			}
			if(!is_null($this->_feed_time)){ 
				 $data['feed_time']=$this->_feed_time;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('feed_id' => $this->_feed_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_feed,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_feed(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_feed(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_feed(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where feed_id = $this->_feed_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>