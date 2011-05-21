<?php

  class Keke_witkey_article_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_art_id; //主键 
		 var $_art_cat_id; 
		 var $_uid; 
		 var $_username; 
		 var $_art_title; 
		 var $_art_source; 
		 var $_art_pic; 
		 var $_content; 
		 var $_is_recommend; 
		 var $_seo_title; 
		 var $_seo_keyword; 
		 var $_seo_desc; 
		 var $_listorder; 
		 var $_is_show; 
		 var $_is_delineas; 
		 var $_pub_time; 
		 var $_views; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_article_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_article";
		 }
	    

	    		function getArt_id(){
			 return $this->_art_id ;
		}
		function getArt_cat_id(){
			 return $this->_art_cat_id ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getArt_title(){
			 return $this->_art_title ;
		}
		function getArt_source(){
			 return $this->_art_source ;
		}
		function getArt_pic(){
			 return $this->_art_pic ;
		}
		function getContent(){
			 return $this->_content ;
		}
		function getIs_recommend(){
			 return $this->_is_recommend ;
		}
		function getSeo_title(){
			 return $this->_seo_title ;
		}
		function getSeo_keyword(){
			 return $this->_seo_keyword ;
		}
		function getSeo_desc(){
			 return $this->_seo_desc ;
		}
		function getListorder(){
			 return $this->_listorder ;
		}
		function getIs_show(){
			 return $this->_is_show ;
		}
		function getIs_delineas(){
			 return $this->_is_delineas ;
		}
		function getPub_time(){
			 return $this->_pub_time ;
		}
		function getViews(){
			 return $this->_views ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setArt_id($value){ 
			 $this->_art_id = $value;
		}
		function setArt_cat_id($value){ 
			 $this->_art_cat_id = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setArt_title($value){ 
			 $this->_art_title = $value;
		}
		function setArt_source($value){ 
			 $this->_art_source = $value;
		}
		function setArt_pic($value){ 
			 $this->_art_pic = $value;
		}
		function setContent($value){ 
			 $this->_content = $value;
		}
		function setIs_recommend($value){ 
			 $this->_is_recommend = $value;
		}
		function setSeo_title($value){ 
			 $this->_seo_title = $value;
		}
		function setSeo_keyword($value){ 
			 $this->_seo_keyword = $value;
		}
		function setSeo_desc($value){ 
			 $this->_seo_desc = $value;
		}
		function setListorder($value){ 
			 $this->_listorder = $value;
		}
		function setIs_show($value){ 
			 $this->_is_show = $value;
		}
		function setIs_delineas($value){ 
			 $this->_is_delineas = $value;
		}
		function setPub_time($value){ 
			 $this->_pub_time = $value;
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
		 * 表keke_witkey_article创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_article(){
		 		 $data =  array(); 

					if(!is_null($this->_art_id)){ 
				 $data['art_id']=$this->_art_id;
			}
			if(!is_null($this->_art_cat_id)){ 
				 $data['art_cat_id']=$this->_art_cat_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_art_title)){ 
				 $data['art_title']=$this->_art_title;
			}
			if(!is_null($this->_art_source)){ 
				 $data['art_source']=$this->_art_source;
			}
			if(!is_null($this->_art_pic)){ 
				 $data['art_pic']=$this->_art_pic;
			}
			if(!is_null($this->_content)){ 
				 $data['content']=$this->_content;
			}
			if(!is_null($this->_is_recommend)){ 
				 $data['is_recommend']=$this->_is_recommend;
			}
			if(!is_null($this->_seo_title)){ 
				 $data['seo_title']=$this->_seo_title;
			}
			if(!is_null($this->_seo_keyword)){ 
				 $data['seo_keyword']=$this->_seo_keyword;
			}
			if(!is_null($this->_seo_desc)){ 
				 $data['seo_desc']=$this->_seo_desc;
			}
			if(!is_null($this->_listorder)){ 
				 $data['listorder']=$this->_listorder;
			}
			if(!is_null($this->_is_show)){ 
				 $data['is_show']=$this->_is_show;
			}
			if(!is_null($this->_is_delineas)){ 
				 $data['is_delineas']=$this->_is_delineas;
			}
			if(!is_null($this->_pub_time)){ 
				 $data['pub_time']=$this->_pub_time;
			}
			if(!is_null($this->_views)){ 
				 $data['views']=$this->_views;
			}

			 return $this->_art_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_article的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_article(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_art_id)){ 
				 $data['art_id']=$this->_art_id;
			}
			if(!is_null($this->_art_cat_id)){ 
				 $data['art_cat_id']=$this->_art_cat_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_art_title)){ 
				 $data['art_title']=$this->_art_title;
			}
			if(!is_null($this->_art_source)){ 
				 $data['art_source']=$this->_art_source;
			}
			if(!is_null($this->_art_pic)){ 
				 $data['art_pic']=$this->_art_pic;
			}
			if(!is_null($this->_content)){ 
				 $data['content']=$this->_content;
			}
			if(!is_null($this->_is_recommend)){ 
				 $data['is_recommend']=$this->_is_recommend;
			}
			if(!is_null($this->_seo_title)){ 
				 $data['seo_title']=$this->_seo_title;
			}
			if(!is_null($this->_seo_keyword)){ 
				 $data['seo_keyword']=$this->_seo_keyword;
			}
			if(!is_null($this->_seo_desc)){ 
				 $data['seo_desc']=$this->_seo_desc;
			}
			if(!is_null($this->_listorder)){ 
				 $data['listorder']=$this->_listorder;
			}
			if(!is_null($this->_is_show)){ 
				 $data['is_show']=$this->_is_show;
			}
			if(!is_null($this->_is_delineas)){ 
				 $data['is_delineas']=$this->_is_delineas;
			}
			if(!is_null($this->_pub_time)){ 
				 $data['pub_time']=$this->_pub_time;
			}
			if(!is_null($this->_views)){ 
				 $data['views']=$this->_views;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('art_id' => $this->_art_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_article,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_article(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_article(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_article(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where art_id = $this->_art_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>