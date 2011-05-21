<?php

  class Keke_witkey_tag_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_tag_id; //主键 
		 var $_tagname; 
		 var $_tag_type; 
		 var $_task_type; 
		 var $_task_indus_id; 
		 var $_task_indus_ids; 
		 var $_task_status; 
		 var $_start_time1; 
		 var $_start_time2; 
		 var $_end_time1; 
		 var $_end_time2; 
		 var $_left_day; 
		 var $_left_hour; 
		 var $_task_cash1; 
		 var $_task_cash2; 
		 var $_prom_cash1; 
		 var $_prom_cash2; 
		 var $_username; 
		 var $_task_ids; 
		 var $_open_is_top; 
		 var $_listorder; 
		 var $_art_cat_id; 
		 var $_art_cat_ids; 
		 var $_art_iscommend; 
		 var $_art_hasimg; 
		 var $_art_time1; 
		 var $_art_time2; 
		 var $_art_ids; 
		 var $_loadcount; 
		 var $_perpage; 
		 var $_tplname; 
		 var $_cat_type; 
		 var $_cat_cat_id; 
		 var $_cat_cat_ids; 
		 var $_cat_loadsub; 
		 var $_cat_onlyrecommend; 
		 var $_tag_sql; 
		 var $_cache_time; 
		 var $_code; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_tag_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_tag";
		 }
	    

	    		function getTag_id(){
			 return $this->_tag_id ;
		}
		function getTagname(){
			 return $this->_tagname ;
		}
		function getTag_type(){
			 return $this->_tag_type ;
		}
		function getTask_type(){
			 return $this->_task_type ;
		}
		function getTask_indus_id(){
			 return $this->_task_indus_id ;
		}
		function getTask_indus_ids(){
			 return $this->_task_indus_ids ;
		}
		function getTask_status(){
			 return $this->_task_status ;
		}
		function getStart_time1(){
			 return $this->_start_time1 ;
		}
		function getStart_time2(){
			 return $this->_start_time2 ;
		}
		function getEnd_time1(){
			 return $this->_end_time1 ;
		}
		function getEnd_time2(){
			 return $this->_end_time2 ;
		}
		function getLeft_day(){
			 return $this->_left_day ;
		}
		function getLeft_hour(){
			 return $this->_left_hour ;
		}
		function getTask_cash1(){
			 return $this->_task_cash1 ;
		}
		function getTask_cash2(){
			 return $this->_task_cash2 ;
		}
		function getProm_cash1(){
			 return $this->_prom_cash1 ;
		}
		function getProm_cash2(){
			 return $this->_prom_cash2 ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getTask_ids(){
			 return $this->_task_ids ;
		}
		function getOpen_is_top(){
			 return $this->_open_is_top ;
		}
		function getListorder(){
			 return $this->_listorder ;
		}
		function getArt_cat_id(){
			 return $this->_art_cat_id ;
		}
		function getArt_cat_ids(){
			 return $this->_art_cat_ids ;
		}
		function getArt_iscommend(){
			 return $this->_art_iscommend ;
		}
		function getArt_hasimg(){
			 return $this->_art_hasimg ;
		}
		function getArt_time1(){
			 return $this->_art_time1 ;
		}
		function getArt_time2(){
			 return $this->_art_time2 ;
		}
		function getArt_ids(){
			 return $this->_art_ids ;
		}
		function getLoadcount(){
			 return $this->_loadcount ;
		}
		function getPerpage(){
			 return $this->_perpage ;
		}
		function getTplname(){
			 return $this->_tplname ;
		}
		function getCat_type(){
			 return $this->_cat_type ;
		}
		function getCat_cat_id(){
			 return $this->_cat_cat_id ;
		}
		function getCat_cat_ids(){
			 return $this->_cat_cat_ids ;
		}
		function getCat_loadsub(){
			 return $this->_cat_loadsub ;
		}
		function getCat_onlyrecommend(){
			 return $this->_cat_onlyrecommend ;
		}
		function getTag_sql(){
			 return $this->_tag_sql ;
		}
		function getCache_time(){
			 return $this->_cache_time ;
		}
		function getCode(){
			 return $this->_code ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setTag_id($value){ 
			 $this->_tag_id = $value;
		}
		function setTagname($value){ 
			 $this->_tagname = $value;
		}
		function setTag_type($value){ 
			 $this->_tag_type = $value;
		}
		function setTask_type($value){ 
			 $this->_task_type = $value;
		}
		function setTask_indus_id($value){ 
			 $this->_task_indus_id = $value;
		}
		function setTask_indus_ids($value){ 
			 $this->_task_indus_ids = $value;
		}
		function setTask_status($value){ 
			 $this->_task_status = $value;
		}
		function setStart_time1($value){ 
			 $this->_start_time1 = $value;
		}
		function setStart_time2($value){ 
			 $this->_start_time2 = $value;
		}
		function setEnd_time1($value){ 
			 $this->_end_time1 = $value;
		}
		function setEnd_time2($value){ 
			 $this->_end_time2 = $value;
		}
		function setLeft_day($value){ 
			 $this->_left_day = $value;
		}
		function setLeft_hour($value){ 
			 $this->_left_hour = $value;
		}
		function setTask_cash1($value){ 
			 $this->_task_cash1 = $value;
		}
		function setTask_cash2($value){ 
			 $this->_task_cash2 = $value;
		}
		function setProm_cash1($value){ 
			 $this->_prom_cash1 = $value;
		}
		function setProm_cash2($value){ 
			 $this->_prom_cash2 = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setTask_ids($value){ 
			 $this->_task_ids = $value;
		}
		function setOpen_is_top($value){ 
			 $this->_open_is_top = $value;
		}
		function setListorder($value){ 
			 $this->_listorder = $value;
		}
		function setArt_cat_id($value){ 
			 $this->_art_cat_id = $value;
		}
		function setArt_cat_ids($value){ 
			 $this->_art_cat_ids = $value;
		}
		function setArt_iscommend($value){ 
			 $this->_art_iscommend = $value;
		}
		function setArt_hasimg($value){ 
			 $this->_art_hasimg = $value;
		}
		function setArt_time1($value){ 
			 $this->_art_time1 = $value;
		}
		function setArt_time2($value){ 
			 $this->_art_time2 = $value;
		}
		function setArt_ids($value){ 
			 $this->_art_ids = $value;
		}
		function setLoadcount($value){ 
			 $this->_loadcount = $value;
		}
		function setPerpage($value){ 
			 $this->_perpage = $value;
		}
		function setTplname($value){ 
			 $this->_tplname = $value;
		}
		function setCat_type($value){ 
			 $this->_cat_type = $value;
		}
		function setCat_cat_id($value){ 
			 $this->_cat_cat_id = $value;
		}
		function setCat_cat_ids($value){ 
			 $this->_cat_cat_ids = $value;
		}
		function setCat_loadsub($value){ 
			 $this->_cat_loadsub = $value;
		}
		function setCat_onlyrecommend($value){ 
			 $this->_cat_onlyrecommend = $value;
		}
		function setTag_sql($value){ 
			 $this->_tag_sql = $value;
		}
		function setCache_time($value){ 
			 $this->_cache_time = $value;
		}
		function setCode($value){ 
			 $this->_code = $value;
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
		 * 表keke_witkey_tag创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_tag(){
		 		 $data =  array(); 

					if(!is_null($this->_tag_id)){ 
				 $data['tag_id']=$this->_tag_id;
			}
			if(!is_null($this->_tagname)){ 
				 $data['tagname']=$this->_tagname;
			}
			if(!is_null($this->_tag_type)){ 
				 $data['tag_type']=$this->_tag_type;
			}
			if(!is_null($this->_task_type)){ 
				 $data['task_type']=$this->_task_type;
			}
			if(!is_null($this->_task_indus_id)){ 
				 $data['task_indus_id']=$this->_task_indus_id;
			}
			if(!is_null($this->_task_indus_ids)){ 
				 $data['task_indus_ids']=$this->_task_indus_ids;
			}
			if(!is_null($this->_task_status)){ 
				 $data['task_status']=$this->_task_status;
			}
			if(!is_null($this->_start_time1)){ 
				 $data['start_time1']=$this->_start_time1;
			}
			if(!is_null($this->_start_time2)){ 
				 $data['start_time2']=$this->_start_time2;
			}
			if(!is_null($this->_end_time1)){ 
				 $data['end_time1']=$this->_end_time1;
			}
			if(!is_null($this->_end_time2)){ 
				 $data['end_time2']=$this->_end_time2;
			}
			if(!is_null($this->_left_day)){ 
				 $data['left_day']=$this->_left_day;
			}
			if(!is_null($this->_left_hour)){ 
				 $data['left_hour']=$this->_left_hour;
			}
			if(!is_null($this->_task_cash1)){ 
				 $data['task_cash1']=$this->_task_cash1;
			}
			if(!is_null($this->_task_cash2)){ 
				 $data['task_cash2']=$this->_task_cash2;
			}
			if(!is_null($this->_prom_cash1)){ 
				 $data['prom_cash1']=$this->_prom_cash1;
			}
			if(!is_null($this->_prom_cash2)){ 
				 $data['prom_cash2']=$this->_prom_cash2;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_task_ids)){ 
				 $data['task_ids']=$this->_task_ids;
			}
			if(!is_null($this->_open_is_top)){ 
				 $data['open_is_top']=$this->_open_is_top;
			}
			if(!is_null($this->_listorder)){ 
				 $data['listorder']=$this->_listorder;
			}
			if(!is_null($this->_art_cat_id)){ 
				 $data['art_cat_id']=$this->_art_cat_id;
			}
			if(!is_null($this->_art_cat_ids)){ 
				 $data['art_cat_ids']=$this->_art_cat_ids;
			}
			if(!is_null($this->_art_iscommend)){ 
				 $data['art_iscommend']=$this->_art_iscommend;
			}
			if(!is_null($this->_art_hasimg)){ 
				 $data['art_hasimg']=$this->_art_hasimg;
			}
			if(!is_null($this->_art_time1)){ 
				 $data['art_time1']=$this->_art_time1;
			}
			if(!is_null($this->_art_time2)){ 
				 $data['art_time2']=$this->_art_time2;
			}
			if(!is_null($this->_art_ids)){ 
				 $data['art_ids']=$this->_art_ids;
			}
			if(!is_null($this->_loadcount)){ 
				 $data['loadcount']=$this->_loadcount;
			}
			if(!is_null($this->_perpage)){ 
				 $data['perpage']=$this->_perpage;
			}
			if(!is_null($this->_tplname)){ 
				 $data['tplname']=$this->_tplname;
			}
			if(!is_null($this->_cat_type)){ 
				 $data['cat_type']=$this->_cat_type;
			}
			if(!is_null($this->_cat_cat_id)){ 
				 $data['cat_cat_id']=$this->_cat_cat_id;
			}
			if(!is_null($this->_cat_cat_ids)){ 
				 $data['cat_cat_ids']=$this->_cat_cat_ids;
			}
			if(!is_null($this->_cat_loadsub)){ 
				 $data['cat_loadsub']=$this->_cat_loadsub;
			}
			if(!is_null($this->_cat_onlyrecommend)){ 
				 $data['cat_onlyrecommend']=$this->_cat_onlyrecommend;
			}
			if(!is_null($this->_tag_sql)){ 
				 $data['tag_sql']=$this->_tag_sql;
			}
			if(!is_null($this->_cache_time)){ 
				 $data['cache_time']=$this->_cache_time;
			}
			if(!is_null($this->_code)){ 
				 $data['code']=$this->_code;
			}

			 return $this->_tag_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_tag的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_tag(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_tag_id)){ 
				 $data['tag_id']=$this->_tag_id;
			}
			if(!is_null($this->_tagname)){ 
				 $data['tagname']=$this->_tagname;
			}
			if(!is_null($this->_tag_type)){ 
				 $data['tag_type']=$this->_tag_type;
			}
			if(!is_null($this->_task_type)){ 
				 $data['task_type']=$this->_task_type;
			}
			if(!is_null($this->_task_indus_id)){ 
				 $data['task_indus_id']=$this->_task_indus_id;
			}
			if(!is_null($this->_task_indus_ids)){ 
				 $data['task_indus_ids']=$this->_task_indus_ids;
			}
			if(!is_null($this->_task_status)){ 
				 $data['task_status']=$this->_task_status;
			}
			if(!is_null($this->_start_time1)){ 
				 $data['start_time1']=$this->_start_time1;
			}
			if(!is_null($this->_start_time2)){ 
				 $data['start_time2']=$this->_start_time2;
			}
			if(!is_null($this->_end_time1)){ 
				 $data['end_time1']=$this->_end_time1;
			}
			if(!is_null($this->_end_time2)){ 
				 $data['end_time2']=$this->_end_time2;
			}
			if(!is_null($this->_left_day)){ 
				 $data['left_day']=$this->_left_day;
			}
			if(!is_null($this->_left_hour)){ 
				 $data['left_hour']=$this->_left_hour;
			}
			if(!is_null($this->_task_cash1)){ 
				 $data['task_cash1']=$this->_task_cash1;
			}
			if(!is_null($this->_task_cash2)){ 
				 $data['task_cash2']=$this->_task_cash2;
			}
			if(!is_null($this->_prom_cash1)){ 
				 $data['prom_cash1']=$this->_prom_cash1;
			}
			if(!is_null($this->_prom_cash2)){ 
				 $data['prom_cash2']=$this->_prom_cash2;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_task_ids)){ 
				 $data['task_ids']=$this->_task_ids;
			}
			if(!is_null($this->_open_is_top)){ 
				 $data['open_is_top']=$this->_open_is_top;
			}
			if(!is_null($this->_listorder)){ 
				 $data['listorder']=$this->_listorder;
			}
			if(!is_null($this->_art_cat_id)){ 
				 $data['art_cat_id']=$this->_art_cat_id;
			}
			if(!is_null($this->_art_cat_ids)){ 
				 $data['art_cat_ids']=$this->_art_cat_ids;
			}
			if(!is_null($this->_art_iscommend)){ 
				 $data['art_iscommend']=$this->_art_iscommend;
			}
			if(!is_null($this->_art_hasimg)){ 
				 $data['art_hasimg']=$this->_art_hasimg;
			}
			if(!is_null($this->_art_time1)){ 
				 $data['art_time1']=$this->_art_time1;
			}
			if(!is_null($this->_art_time2)){ 
				 $data['art_time2']=$this->_art_time2;
			}
			if(!is_null($this->_art_ids)){ 
				 $data['art_ids']=$this->_art_ids;
			}
			if(!is_null($this->_loadcount)){ 
				 $data['loadcount']=$this->_loadcount;
			}
			if(!is_null($this->_perpage)){ 
				 $data['perpage']=$this->_perpage;
			}
			if(!is_null($this->_tplname)){ 
				 $data['tplname']=$this->_tplname;
			}
			if(!is_null($this->_cat_type)){ 
				 $data['cat_type']=$this->_cat_type;
			}
			if(!is_null($this->_cat_cat_id)){ 
				 $data['cat_cat_id']=$this->_cat_cat_id;
			}
			if(!is_null($this->_cat_cat_ids)){ 
				 $data['cat_cat_ids']=$this->_cat_cat_ids;
			}
			if(!is_null($this->_cat_loadsub)){ 
				 $data['cat_loadsub']=$this->_cat_loadsub;
			}
			if(!is_null($this->_cat_onlyrecommend)){ 
				 $data['cat_onlyrecommend']=$this->_cat_onlyrecommend;
			}
			if(!is_null($this->_tag_sql)){ 
				 $data['tag_sql']=$this->_tag_sql;
			}
			if(!is_null($this->_cache_time)){ 
				 $data['cache_time']=$this->_cache_time;
			}
			if(!is_null($this->_code)){ 
				 $data['code']=$this->_code;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('tag_id' => $this->_tag_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_tag,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_tag(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_tag(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_tag(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where tag_id = $this->_tag_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


   }

 ?>