<?php
  class Keke_witkey_member_group_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_group_id; //���� 		 var $_groupname; 		 var $_group_roles; 		 var $_on_time; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //�飬�ģ�ɾ����
	     function  keke_witkey_member_group_class(){ //���췽��			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_member_group";		 }	    
	    		function getGroup_id(){			 return $this->_group_id ;		}		function getGroupname(){			 return $this->_groupname ;		}		function getGroup_roles(){			 return $this->_group_roles ;		}		function getOn_time(){			 return $this->_on_time ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setGroup_id($value){ 			 $this->_group_id = $value;		}		function setGroupname($value){ 			 $this->_groupname = $value;		}		function setGroup_roles($value){ 			 $this->_group_roles = $value;		}		function setOn_time($value){ 			 $this->_on_time = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * ��keke_witkey_member_group����������һ����¼		 * @return ��������ID		 */		function create_keke_witkey_member_group(){		 		 $data =  array(); 					if(!is_null($this->_group_id)){ 				 $data['group_id']=$this->_group_id;			}			if(!is_null($this->_groupname)){ 				 $data['groupname']=$this->_groupname;			}			if(!is_null($this->_group_roles)){ 				 $data['group_roles']=$this->_group_roles;			}			if(!is_null($this->_on_time)){ 				 $data['on_time']=$this->_on_time;			}			 return $this->_group_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * �༭��keke_witkey_member_group��һ������¼		 * @return ����Ӱ�������		 */		function edit_keke_witkey_member_group(){ 		 		 $data =  array();  					if(!is_null($this->_group_id)){ 				 $data['group_id']=$this->_group_id;			}			if(!is_null($this->_groupname)){ 				 $data['groupname']=$this->_groupname;			}			if(!is_null($this->_group_roles)){ 				 $data['group_roles']=$this->_group_roles;			}			if(!is_null($this->_on_time)){ 				 $data['on_time']=$this->_on_time;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('group_id' => $this->_group_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * ��ѯ��keke_witkey_member_group,��������ʱ������������ROW���������м�¼		 * @return ����һ��(array)��������		 */		function query_keke_witkey_member_group(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_member_group(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_member_group(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where group_id = $this->_group_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>