<?php
  class Keke_witkey_vote_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_vote_id; //���� 		 var $_work_id; 		 var $_uid; 		 var $_username; 		 var $_vote_ip; 		 var $_vote_time; 
		 var $_task_id;
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //�飬�ģ�ɾ����
	    function  keke_witkey_vote_class(){ //���췽��			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_vote";		 }	    
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
    	
	    /**		 * ��keke_witkey_vote����������һ����¼		 * @return ��������ID		 */		function create_keke_witkey_vote(){		 		 $data =  array(); 					if(!is_null($this->_vote_id)){ 				 $data['vote_id']=$this->_vote_id;			}
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}			if(!is_null($this->_work_id)){ 				 $data['work_id']=$this->_work_id;			}			if(!is_null($this->_uid)){ 				 $data['uid']=$this->_uid;			}			if(!is_null($this->_username)){ 				 $data['username']=$this->_username;			}			if(!is_null($this->_vote_ip)){ 				 $data['vote_ip']=$this->_vote_ip;			}			if(!is_null($this->_vote_time)){ 				 $data['vote_time']=$this->_vote_time;			}			 return $this->_vote_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * �༭��keke_witkey_vote��һ������¼		 * @return ����Ӱ�������		 */		function edit_keke_witkey_vote(){ 		 		 $data =  array();  					if(!is_null($this->_vote_id)){ 				 $data['vote_id']=$this->_vote_id;			}
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}			if(!is_null($this->_work_id)){ 				 $data['work_id']=$this->_work_id;			}			if(!is_null($this->_uid)){ 				 $data['uid']=$this->_uid;			}			if(!is_null($this->_username)){ 				 $data['username']=$this->_username;			}			if(!is_null($this->_vote_ip)){ 				 $data['vote_ip']=$this->_vote_ip;			}			if(!is_null($this->_vote_time)){ 				 $data['vote_time']=$this->_vote_time;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('vote_id' => $this->_vote_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * ��ѯ��keke_witkey_vote,��������ʱ������������ROW���������м�¼		 * @return ����һ��(array)��������		 */		function query_keke_witkey_vote(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_vote(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_vote(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where vote_id = $this->_vote_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>