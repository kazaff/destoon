<?php
  class Keke_witkey_score_log_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_score_log_id; //����		 var $_score_log_type;		 var $_uid;		 var $_score_num;		 var $_on_date;
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //�飬�ģ�ɾ����
	     function  keke_witkey_score_log_class(){ //���췽��			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_score_log";		 }
	    		function getScore_log_id(){			 return $this->_score_log_id ;		}		function getScore_log_type(){			 return $this->_score_log_type ;		}		function getUid(){			 return $this->_uid ;		}		function getScore_num(){			 return $this->_score_num ;		}		function getOn_date(){			 return $this->_on_date ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setScore_log_id($value){			 $this->_score_log_id = $value;		}		function setScore_log_type($value){			 $this->_score_log_type = $value;		}		function setUid($value){			 $this->_uid = $value;		}		function setScore_num($value){			 $this->_score_num = $value;		}		function setOn_date($value){			 $this->_on_date = $value;		}		function setWhere($value){			 $this->_where = $value;		}
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
	    /**		 * ��keke_witkey_score_log����������һ����¼		 * @return ��������ID		 */		function create_keke_witkey_score_log(){		 		 $data =  array();					if(!is_null($this->_score_log_id)){				 $data['score_log_id']=$this->_score_log_id;			}			if(!is_null($this->_score_log_type)){				 $data['score_log_type']=$this->_score_log_type;			}			if(!is_null($this->_uid)){				 $data['uid']=$this->_uid;			}			if(!is_null($this->_score_num)){				 $data['score_num']=$this->_score_num;			}			if(!is_null($this->_on_date)){				 $data['on_date']=$this->_on_date;			}			 return $this->_score_log_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace);		 }
	    /**		 * �༭��keke_witkey_score_log��һ������¼		 * @return ����Ӱ�������		 */		function edit_keke_witkey_score_log(){		 		 $data =  array();					if(!is_null($this->_score_log_id)){				 $data['score_log_id']=$this->_score_log_id;			}			if(!is_null($this->_score_log_type)){				 $data['score_log_type']=$this->_score_log_type;			}			if(!is_null($this->_uid)){				 $data['uid']=$this->_uid;			}			if(!is_null($this->_score_num)){				 $data['score_num']=$this->_score_num;			}			if(!is_null($this->_on_date)){				 $data['on_date']=$this->_on_date;			}			if($this->_where){				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere());			 }			 else{				 $where = array('score_log_id' => $this->_score_log_id);				 return $this->_db->updatetable($this->_tablename,$data,$where);			}		 }
	    /**		 * ��ѯ��keke_witkey_score_log,��������ʱ������������ROW���������м�¼		 * @return ����һ��(array)��������		 */		function query_keke_witkey_score_log(){			 if($this->_where){				 $sql = "select * from $this->_tablename where ".$this->_where;			 }			 else{				 $sql = "select * from $this->_tablename";			 }			 $this->_where = "";			 return $this->_dbop->query($sql);		 }		function count_keke_witkey_score_log(){			 if($this->_where){				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where;			 }			 else{				 $sql = "select count(*) as count from $this->_tablename";			 }			 $this->_where = "";			 return $this->_dbop->getCount($sql);		 }		function del_keke_witkey_score_log(){			 if($this->_where){				 $sql = "delete from $this->_tablename where ".$this->_where;			 }			 else{				 $sql = "delete from $this->_tablename where score_log_id = $this->_score_log_id ";			 }			 $this->_where = "";			 return $this->_dbop->execute($sql);		 }
   }
 ?>