<?php
  class Keke_witkey_message_template_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_msg_temp_id; //���� 		 var $_msg_temp_type; 		 var $_msg_temp_content; 		 var $_listorder; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //�飬�ģ�ɾ����
	     function  keke_witkey_message_template_class(){ //���췽��			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_message_template";		 }	    
	    		function getMsg_temp_id(){			 return $this->_msg_temp_id ;		}		function getMsg_temp_type(){			 return $this->_msg_temp_type ;		}		function getMsg_temp_content(){			 return $this->_msg_temp_content ;		}		function getListorder(){			 return $this->_listorder ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setMsg_temp_id($value){ 			 $this->_msg_temp_id = $value;		}		function setMsg_temp_type($value){ 			 $this->_msg_temp_type = $value;		}		function setMsg_temp_content($value){ 			 $this->_msg_temp_content = $value;		}		function setListorder($value){ 			 $this->_listorder = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * ��keke_witkey_message_template����������һ����¼		 * @return ��������ID		 */		function create_keke_witkey_message_template(){		 		 $data =  array(); 					if(!is_null($this->_msg_temp_id)){ 				 $data['msg_temp_id']=$this->_msg_temp_id;			}			if(!is_null($this->_msg_temp_type)){ 				 $data['msg_temp_type']=$this->_msg_temp_type;			}			if(!is_null($this->_msg_temp_content)){ 				 $data['msg_temp_content']=$this->_msg_temp_content;			}			if(!is_null($this->_listorder)){ 				 $data['listorder']=$this->_listorder;			}			 return $this->_msg_temp_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * �༭��keke_witkey_message_template��һ������¼		 * @return ����Ӱ�������		 */		function edit_keke_witkey_message_template(){ 		 		 $data =  array();  					if(!is_null($this->_msg_temp_id)){ 				 $data['msg_temp_id']=$this->_msg_temp_id;			}			if(!is_null($this->_msg_temp_type)){ 				 $data['msg_temp_type']=$this->_msg_temp_type;			}			if(!is_null($this->_msg_temp_content)){ 				 $data['msg_temp_content']=$this->_msg_temp_content;			}			if(!is_null($this->_listorder)){ 				 $data['listorder']=$this->_listorder;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('msg_temp_id' => $this->_msg_temp_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * ��ѯ��keke_witkey_message_template,��������ʱ������������ROW���������м�¼		 * @return ����һ��(array)��������		 */		function query_keke_witkey_message_template(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 
						 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_message_template(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_message_template(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where msg_temp_id = $this->_msg_temp_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>