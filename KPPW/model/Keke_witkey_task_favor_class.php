<?php
  class Keke_witkey_task_favor_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_fav_id; //���� 		 var $_task_id; 		 var $_task_title; 		 var $_uid; 		 var $_username; 		 var $_fav_time; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //�飬�ģ�ɾ����
	     function  keke_witkey_task_favor_class(){ //���췽��			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_task_favor";		 }	    
	    		function getFav_id(){			 return $this->_fav_id ;		}		function getTask_id(){			 return $this->_task_id ;		}		function getTask_title(){			 return $this->_task_title ;		}		function getUid(){			 return $this->_uid ;		}		function getUsername(){			 return $this->_username ;		}		function getFav_time(){			 return $this->_fav_time ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setFav_id($value){ 			 $this->_fav_id = $value;		}		function setTask_id($value){ 			 $this->_task_id = $value;		}		function setTask_title($value){ 			 $this->_task_title = $value;		}		function setUid($value){ 			 $this->_uid = $value;		}		function setUsername($value){ 			 $this->_username = $value;		}		function setFav_time($value){ 			 $this->_fav_time = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * ��keke_witkey_task_favor����������һ����¼		 * @return ��������ID		 */		function create_keke_witkey_task_favor(){		 		 $data =  array(); 					if(!is_null($this->_fav_id)){ 				 $data['fav_id']=$this->_fav_id;			}			if(!is_null($this->_task_id)){ 				 $data['task_id']=$this->_task_id;			}			if(!is_null($this->_task_title)){ 				 $data['task_title']=$this->_task_title;			}			if(!is_null($this->_uid)){ 				 $data['uid']=$this->_uid;			}			if(!is_null($this->_username)){ 				 $data['username']=$this->_username;			}			if(!is_null($this->_fav_time)){ 				 $data['fav_time']=$this->_fav_time;			}			 return $this->_fav_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * �༭��keke_witkey_task_favor��һ������¼		 * @return ����Ӱ�������		 */		function edit_keke_witkey_task_favor(){ 		 		 $data =  array();  					if(!is_null($this->_fav_id)){ 				 $data['fav_id']=$this->_fav_id;			}			if(!is_null($this->_task_id)){ 				 $data['task_id']=$this->_task_id;			}			if(!is_null($this->_task_title)){ 				 $data['task_title']=$this->_task_title;			}			if(!is_null($this->_uid)){ 				 $data['uid']=$this->_uid;			}			if(!is_null($this->_username)){ 				 $data['username']=$this->_username;			}			if(!is_null($this->_fav_time)){ 				 $data['fav_time']=$this->_fav_time;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('fav_id' => $this->_fav_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * ��ѯ��keke_witkey_task_favor,��������ʱ������������ROW���������м�¼		 * @return ����һ��(array)��������		 */		function query_keke_witkey_task_favor(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_task_favor(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_task_favor(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where fav_id = $this->_fav_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>