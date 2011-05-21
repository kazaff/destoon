<?php
  class Keke_witkey_admin_notice_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    		 var $_notice_id; 
		 var $_uid; 
		 var $_content; 

	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //�飬�ģ�ɾ����
	     function  keke_witkey_admin_notice_class(){ //���췽��
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_admin_notice";
		 }
	    
	    		function getNotice_id(){
			 return $this->_notice_id ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getContent(){
			 return $this->_content ;
		}
		function getWhere(){
			 return $this->_where ;
		}

	    		function setNotice_id($value){ 
			 $this->_notice_id = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setContent($value){ 
			 $this->_content = $value;
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
		 * ��keke_witkey_admin_notice����������һ����¼
		 * @return ��������ID
		 */
		function create_keke_witkey_admin_notice(){
		 		 $data =  array(); 

					if(!is_null($this->_notice_id)){ 
				 $data['notice_id']=$this->_notice_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_content)){ 
				 $data['content']=$this->_content;
			}

			 return $this->_ad_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 

	    /**
		 * �༭��keke_witkey_admin_notice��һ������¼
		 * @return ����Ӱ�������
		 */
		function edit_keke_witkey_admin_notice(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_notice_id)){ 
				 $data['notice_id']=$this->_notice_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_content)){ 
				 $data['content']=$this->_content;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('ad_id' => $this->_ad_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 

	    /**
		 * ��ѯ��keke_witkey_admin_notice,��������ʱ������������ROW���������м�¼
		 * @return ����һ��(array)��������
		 */
		function query_keke_witkey_admin_notice(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 

	    
		function count_keke_witkey_admin_notice(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 

	    
		function del_keke_witkey_admin_notice(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where ad_id = $this->_ad_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 

	   
	    
	    
   }
 ?>