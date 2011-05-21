<?php
  class Keke_witkey_score_log_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_score_log_id; //主键		 var $_score_log_type;		 var $_uid;		 var $_score_num;		 var $_on_date;
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //查，改，删条件
	     function  keke_witkey_score_log_class(){ //构造方法			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_score_log";		 }
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
	    /**		 * 表keke_witkey_score_log创建或新增一条记录		 * @return 返回新增ID		 */		function create_keke_witkey_score_log(){		 		 $data =  array();					if(!is_null($this->_score_log_id)){				 $data['score_log_id']=$this->_score_log_id;			}			if(!is_null($this->_score_log_type)){				 $data['score_log_type']=$this->_score_log_type;			}			if(!is_null($this->_uid)){				 $data['uid']=$this->_uid;			}			if(!is_null($this->_score_num)){				 $data['score_num']=$this->_score_num;			}			if(!is_null($this->_on_date)){				 $data['on_date']=$this->_on_date;			}			 return $this->_score_log_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace);		 }
	    /**		 * 编辑表keke_witkey_score_log的一个条记录		 * @return 返回影响的行数		 */		function edit_keke_witkey_score_log(){		 		 $data =  array();					if(!is_null($this->_score_log_id)){				 $data['score_log_id']=$this->_score_log_id;			}			if(!is_null($this->_score_log_type)){				 $data['score_log_type']=$this->_score_log_type;			}			if(!is_null($this->_uid)){				 $data['uid']=$this->_uid;			}			if(!is_null($this->_score_num)){				 $data['score_num']=$this->_score_num;			}			if(!is_null($this->_on_date)){				 $data['on_date']=$this->_on_date;			}			if($this->_where){				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere());			 }			 else{				 $where = array('score_log_id' => $this->_score_log_id);				 return $this->_db->updatetable($this->_tablename,$data,$where);			}		 }
	    /**		 * 查询表keke_witkey_score_log,当有条件时返回有条件的ROW，否则返所有记录		 * @return 返回一个(array)关联数组		 */		function query_keke_witkey_score_log(){			 if($this->_where){				 $sql = "select * from $this->_tablename where ".$this->_where;			 }			 else{				 $sql = "select * from $this->_tablename";			 }			 $this->_where = "";			 return $this->_dbop->query($sql);		 }		function count_keke_witkey_score_log(){			 if($this->_where){				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where;			 }			 else{				 $sql = "select count(*) as count from $this->_tablename";			 }			 $this->_where = "";			 return $this->_dbop->getCount($sql);		 }		function del_keke_witkey_score_log(){			 if($this->_where){				 $sql = "delete from $this->_tablename where ".$this->_where;			 }			 else{				 $sql = "delete from $this->_tablename where score_log_id = $this->_score_log_id ";			 }			 $this->_where = "";			 return $this->_dbop->execute($sql);		 }
   }
 ?>