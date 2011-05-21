<?php

  class Keke_witkey_work_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_work_id; //主键 
		 var $_task_id; 
		 var $_uid; 
		 var $_username; 
		 var $_work_title; 
		 var $_work_desc; 
		 var $_work_file; 
		 var $_work_pic; 
		 var $_work_time; 
		 var $_hide_work; 
		 var $_vote_num; 
		 var $_work_status; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_work_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_work";
		 }
	    

	    		function getWork_id(){
			 return $this->_work_id ;
		}
		function getTask_id(){
			 return $this->_task_id ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getWork_title(){
			 return $this->_work_title ;
		}
		function getWork_desc(){
			 return $this->_work_desc ;
		}
		function getWork_file(){
			 return $this->_work_file ;
		}
		function getWork_pic(){
			 return $this->_work_pic ;
		}
		function getWork_time(){
			 return $this->_work_time ;
		}
		function getHide_work(){
			 return $this->_hide_work ;
		}
		function getVote_num(){
			 return $this->_vote_num ;
		}
		function getWork_status(){
			 return $this->_work_status ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setWork_id($value){ 
			 $this->_work_id = $value;
		}
		function setTask_id($value){ 
			 $this->_task_id = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setWork_title($value){ 
			 $this->_work_title = $value;
		}
		function setWork_desc($value){ 
			 $this->_work_desc = $value;
		}
		function setWork_file($value){ 
			 $this->_work_file = $value;
		}
		function setWork_pic($value){ 
			 $this->_work_pic = $value;
		}
		function setWork_time($value){ 
			 $this->_work_time = $value;
		}
		function setHide_work($value){ 
			 $this->_hide_work = $value;
		}
		function setVote_num($value){ 
			 $this->_vote_num = $value;
		}
		function setWork_status($value){ 
			 $this->_work_status = $value;
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
		 * 表keke_witkey_work创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_work(){
		 		 $data =  array(); 

					if(!is_null($this->_work_id)){ 
				 $data['work_id']=$this->_work_id;
			}
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_work_title)){ 
				 $data['work_title']=$this->_work_title;
			}
			if(!is_null($this->_work_desc)){ 
				 $data['work_desc']=$this->_work_desc;
			}
			if(!is_null($this->_work_file)){ 
				 $data['work_file']=$this->_work_file;
			}
			if(!is_null($this->_work_pic)){ 
				 $data['work_pic']=$this->_work_pic;
			}
			if(!is_null($this->_work_time)){ 
				 $data['work_time']=$this->_work_time;
			}
			if(!is_null($this->_hide_work)){ 
				 $data['hide_work']=$this->_hide_work;
			}
			if(!is_null($this->_vote_num)){ 
				 $data['vote_num']=$this->_vote_num;
			}
			if(!is_null($this->_work_status)){ 
				 $data['work_status']=$this->_work_status;
			}

			 return $this->_work_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_work的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_work(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_work_id)){ 
				 $data['work_id']=$this->_work_id;
			}
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_work_title)){ 
				 $data['work_title']=$this->_work_title;
			}
			if(!is_null($this->_work_desc)){ 
				 $data['work_desc']=$this->_work_desc;
			}
			if(!is_null($this->_work_file)){ 
				 $data['work_file']=$this->_work_file;
			}
			if(!is_null($this->_work_pic)){ 
				 $data['work_pic']=$this->_work_pic;
			}
			if(!is_null($this->_work_time)){ 
				 $data['work_time']=$this->_work_time;
			}
			if(!is_null($this->_hide_work)){ 
				 $data['hide_work']=$this->_hide_work;
			}
			if(!is_null($this->_vote_num)){ 
				 $data['vote_num']=$this->_vote_num;
			}
			if(!is_null($this->_work_status)){ 
				 $data['work_status']=$this->_work_status;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('work_id' => $this->_work_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_work,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_work(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_work(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_work(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where work_id = $this->_work_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>