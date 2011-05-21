<?php

  class Keke_witkey_comment_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_comment_id; //主键 
		 var $_obj_id; 
		 var $_p_id; 
		 var $_comment_type; 
		 var $_uid; 
		 var $_username; 
		 var $_content; 
		 var $_on_time; 
		 var $_status; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_comment_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_comment";
		 }
	    

	    		function getComment_id(){
			 return $this->_comment_id ;
		}
		function getObj_id(){
			 return $this->_obj_id ;
		}
		function getP_id(){
			 return $this->_p_id ;
		}
		function getComment_type(){
			 return $this->_comment_type ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getContent(){
			 return $this->_content ;
		}
		function getOn_time(){
			 return $this->_on_time ;
		}
		function getStatus(){
			 return $this->_status ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setComment_id($value){ 
			 $this->_comment_id = $value;
		}
		function setObj_id($value){ 
			 $this->_obj_id = $value;
		}
		function setP_id($value){ 
			 $this->_p_id = $value;
		}
		function setComment_type($value){ 
			 $this->_comment_type = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setContent($value){ 
			 $this->_content = $value;
		}
		function setOn_time($value){ 
			 $this->_on_time = $value;
		}
		function setStatus($value){ 
			 $this->_status = $value;
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
		 * 表keke_witkey_comment创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_comment(){
		 		 $data =  array(); 

					if(!is_null($this->_comment_id)){ 
				 $data['comment_id']=$this->_comment_id;
			}
			if(!is_null($this->_obj_id)){ 
				 $data['obj_id']=$this->_obj_id;
			}
			if(!is_null($this->_p_id)){ 
				 $data['p_id']=$this->_p_id;
			}
			if(!is_null($this->_comment_type)){ 
				 $data['comment_type']=$this->_comment_type;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_content)){ 
				 $data['content']=$this->_content;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}
			if(!is_null($this->_status)){ 
				 $data['status']=$this->_status;
			}

			 return $this->_comment_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_comment的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_comment(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_comment_id)){ 
				 $data['comment_id']=$this->_comment_id;
			}
			if(!is_null($this->_obj_id)){ 
				 $data['obj_id']=$this->_obj_id;
			}
			if(!is_null($this->_p_id)){ 
				 $data['p_id']=$this->_p_id;
			}
			if(!is_null($this->_comment_type)){ 
				 $data['comment_type']=$this->_comment_type;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_content)){ 
				 $data['content']=$this->_content;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}
			if(!is_null($this->_status)){ 
				 $data['status']=$this->_status;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('comment_id' => $this->_comment_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_comment,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_comment(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_comment(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_comment(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where comment_id = $this->_comment_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>