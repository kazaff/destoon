<?php
  class Keke_witkey_entry_auth_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_licen_id; //���� 		 var $_licen_num; 		 var $_licen_pic; 		 var $_status; 		 var $_uid; 		 var $_username; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //�飬�ģ�ɾ����
	     function  keke_witkey_entry_auth_class(){ //���췽��			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_entry_auth";		 }	    
	    		function getLicen_id(){			 return $this->_licen_id ;		}		function getLicen_num(){			 return $this->_licen_num ;		}		function getLicen_pic(){			 return $this->_licen_pic ;		}		function getStatus(){			 return $this->_status ;		}		function getUid(){			 return $this->_uid ;		}		function getUsername(){			 return $this->_username ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setLicen_id($value){ 			 $this->_licen_id = $value;		}		function setLicen_num($value){ 			 $this->_licen_num = $value;		}		function setLicen_pic($value){ 			 $this->_licen_pic = $value;		}		function setStatus($value){ 			 $this->_status = $value;		}		function setUid($value){ 			 $this->_uid = $value;		}		function setUsername($value){ 			 $this->_username = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * ��keke_witkey_entry_auth����������һ����¼		 * @return ��������ID		 */		function create_keke_witkey_entry_auth(){		 		 $data =  array(); 					if(!is_null($this->_licen_id)){ 				 $data['licen_id']=$this->_licen_id;			}			if(!is_null($this->_licen_num)){ 				 $data['licen_num']=$this->_licen_num;			}			if(!is_null($this->_licen_pic)){ 				 $data['licen_pic']=$this->_licen_pic;			}			if(!is_null($this->_status)){ 				 $data['status']=$this->_status;			}			if(!is_null($this->_uid)){ 				 $data['uid']=$this->_uid;			}			if(!is_null($this->_username)){ 				 $data['username']=$this->_username;			}			 return $this->_licen_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * �༭��keke_witkey_entry_auth��һ������¼		 * @return ����Ӱ�������		 */		function edit_keke_witkey_entry_auth(){ 		 		 $data =  array();  					if(!is_null($this->_licen_id)){ 				 $data['licen_id']=$this->_licen_id;			}			if(!is_null($this->_licen_num)){ 				 $data['licen_num']=$this->_licen_num;			}			if(!is_null($this->_licen_pic)){ 				 $data['licen_pic']=$this->_licen_pic;			}			if(!is_null($this->_status)){ 				 $data['status']=$this->_status;			}			if(!is_null($this->_uid)){ 				 $data['uid']=$this->_uid;			}			if(!is_null($this->_username)){ 				 $data['username']=$this->_username;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('licen_id' => $this->_licen_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * ��ѯ��keke_witkey_entry_auth,��������ʱ������������ROW���������м�¼		 * @return ����һ��(array)��������		 */		function query_keke_witkey_entry_auth(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_entry_auth(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_entry_auth(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where licen_id = $this->_licen_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>