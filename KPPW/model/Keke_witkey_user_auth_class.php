<?php
  class Keke_witkey_user_auth_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_u_auth_id; //���� 		 var $_uid; 		 var $_username; 		 var $_id_num; 		 var $_real_name; 		 var $_origo; 		 var $_licen_pic; 		 var $_status; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //�飬�ģ�ɾ����
	     function  keke_witkey_user_auth_class(){ //���췽��			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_user_auth";		 }	    
	    		function getU_auth_id(){			 return $this->_u_auth_id ;		}		function getUid(){			 return $this->_uid ;		}		function getUsername(){			 return $this->_username ;		}		function getId_num(){			 return $this->_id_num ;		}		function getReal_name(){			 return $this->_real_name ;		}		function getOrigo(){			 return $this->_origo ;		}		function getLicen_pic(){			 return $this->_licen_pic ;		}		function getStatus(){			 return $this->_status ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setU_auth_id($value){ 			 $this->_u_auth_id = $value;		}		function setUid($value){ 			 $this->_uid = $value;		}		function setUsername($value){ 			 $this->_username = $value;		}		function setId_num($value){ 			 $this->_id_num = $value;		}		function setReal_name($value){ 			 $this->_real_name = $value;		}		function setOrigo($value){ 			 $this->_origo = $value;		}		function setLicen_pic($value){ 			 $this->_licen_pic = $value;		}		function setStatus($value){ 			 $this->_status = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * ��keke_witkey_user_auth����������һ����¼		 * @return ��������ID		 */		function create_keke_witkey_user_auth(){		 		 $data =  array(); 					if(!is_null($this->_u_auth_id)){ 				 $data['u_auth_id']=$this->_u_auth_id;			}			if(!is_null($this->_uid)){ 				 $data['uid']=$this->_uid;			}			if(!is_null($this->_username)){ 				 $data['username']=$this->_username;			}			if(!is_null($this->_id_num)){ 				 $data['id_num']=$this->_id_num;			}			if(!is_null($this->_real_name)){ 				 $data['real_name']=$this->_real_name;			}			if(!is_null($this->_origo)){ 				 $data['origo']=$this->_origo;			}			if(!is_null($this->_licen_pic)){ 				 $data['licen_pic']=$this->_licen_pic;			}			if(!is_null($this->_status)){ 				 $data['status']=$this->_status;			}			 return $this->_u_auth_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * �༭��keke_witkey_user_auth��һ������¼		 * @return ����Ӱ�������		 */		function edit_keke_witkey_user_auth(){ 		 		 $data =  array();  					if(!is_null($this->_u_auth_id)){ 				 $data['u_auth_id']=$this->_u_auth_id;			}			if(!is_null($this->_uid)){ 				 $data['uid']=$this->_uid;			}			if(!is_null($this->_username)){ 				 $data['username']=$this->_username;			}			if(!is_null($this->_id_num)){ 				 $data['id_num']=$this->_id_num;			}			if(!is_null($this->_real_name)){ 				 $data['real_name']=$this->_real_name;			}			if(!is_null($this->_origo)){ 				 $data['origo']=$this->_origo;			}			if(!is_null($this->_licen_pic)){ 				 $data['licen_pic']=$this->_licen_pic;			}			if(!is_null($this->_status)){ 				 $data['status']=$this->_status;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('u_auth_id' => $this->_u_auth_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * ��ѯ��keke_witkey_user_auth,��������ʱ������������ROW���������м�¼		 * @return ����һ��(array)��������		 */		function query_keke_witkey_user_auth(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_user_auth(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_user_auth(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where u_auth_id = $this->_u_auth_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>