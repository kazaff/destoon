<?php
  class Keke_witkey_vote_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_vote_id; //主键 		 var $_work_id; 		 var $_uid; 		 var $_username; 		 var $_vote_ip; 		 var $_vote_time; 
		 var $_task_id;
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //查，改，删条件
	    function  keke_witkey_vote_class(){ //构造方法			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_vote";		 }	    
	    		function getVote_id(){			 return $this->_vote_id ;		}		function getWork_id(){			 return $this->_work_id ;		}
  	function getTask_id(){
			 return $this->_task_id ;
		}		function getUid(){			 return $this->_uid ;		}		function getUsername(){			 return $this->_username ;		}		function getVote_ip(){			 return $this->_vote_ip ;		}		function getVote_time(){			 return $this->_vote_time ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setVote_id($value){ 			 $this->_vote_id = $value;		}
		
  		function setTask_id($value){ 
			 $this->_task_id = $value;
		}
				function setWork_id($value){ 			 $this->_work_id = $value;		}		function setUid($value){ 			 $this->_uid = $value;		}		function setUsername($value){ 			 $this->_username = $value;		}		function setVote_ip($value){ 			 $this->_vote_ip = $value;		}		function setVote_time($value){ 			 $this->_vote_time = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * 表keke_witkey_vote创建或新增一条记录		 * @return 返回新增ID		 */		function create_keke_witkey_vote(){		 		 $data =  array(); 					if(!is_null($this->_vote_id)){ 				 $data['vote_id']=$this->_vote_id;			}
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}			if(!is_null($this->_work_id)){ 				 $data['work_id']=$this->_work_id;			}			if(!is_null($this->_uid)){ 				 $data['uid']=$this->_uid;			}			if(!is_null($this->_username)){ 				 $data['username']=$this->_username;			}			if(!is_null($this->_vote_ip)){ 				 $data['vote_ip']=$this->_vote_ip;			}			if(!is_null($this->_vote_time)){ 				 $data['vote_time']=$this->_vote_time;			}			 return $this->_vote_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * 编辑表keke_witkey_vote的一个条记录		 * @return 返回影响的行数		 */		function edit_keke_witkey_vote(){ 		 		 $data =  array();  					if(!is_null($this->_vote_id)){ 				 $data['vote_id']=$this->_vote_id;			}
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}			if(!is_null($this->_work_id)){ 				 $data['work_id']=$this->_work_id;			}			if(!is_null($this->_uid)){ 				 $data['uid']=$this->_uid;			}			if(!is_null($this->_username)){ 				 $data['username']=$this->_username;			}			if(!is_null($this->_vote_ip)){ 				 $data['vote_ip']=$this->_vote_ip;			}			if(!is_null($this->_vote_time)){ 				 $data['vote_time']=$this->_vote_time;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('vote_id' => $this->_vote_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * 查询表keke_witkey_vote,当有条件时返回有条件的ROW，否则返所有记录		 * @return 返回一个(array)关联数组		 */		function query_keke_witkey_vote(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_vote(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_vote(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where vote_id = $this->_vote_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>