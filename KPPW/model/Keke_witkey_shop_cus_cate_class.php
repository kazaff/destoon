<?php
  class Keke_witkey_shop_cus_cate_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_cus_cate_id; //����		 var $_obj_type;		 var $_obj_id;		 var $_cate_name;		 var $_shop_id;
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //�飬�ģ�ɾ����
	     function  keke_witkey_shop_cus_cate_class(){ //���췽��			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_shop_cus_cate";		 }
	    		function getCus_cate_id(){			 return $this->_cus_cate_id ;		}		function getObj_type(){			 return $this->_obj_type ;		}		function getObj_id(){			 return $this->_obj_id ;		}		function getCate_name(){			 return $this->_cate_name ;		}		function getShop_id(){			 return $this->_shop_id ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setCus_cate_id($value){			 $this->_cus_cate_id = $value;		}		function setObj_type($value){			 $this->_obj_type = $value;		}		function setObj_id($value){			 $this->_obj_id = $value;		}		function setCate_name($value){			 $this->_cate_name = $value;		}		function setShop_id($value){			 $this->_shop_id = $value;		}		function setWhere($value){			 $this->_where = $value;		}
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
	    /**		 * ��keke_witkey_shop_cus_cate����������һ����¼		 * @return ��������ID		 */		function create_keke_witkey_shop_cus_cate(){		 		 $data =  array();					if(!is_null($this->_cus_cate_id)){				 $data['cus_cate_id']=$this->_cus_cate_id;			}			if(!is_null($this->_obj_type)){				 $data['obj_type']=$this->_obj_type;			}			if(!is_null($this->_obj_id)){				 $data['obj_id']=$this->_obj_id;			}			if(!is_null($this->_cate_name)){				 $data['cate_name']=$this->_cate_name;			}			if(!is_null($this->_shop_id)){				 $data['shop_id']=$this->_shop_id;			}			 return $this->_cus_cate_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace);		 }
	    /**		 * �༭��keke_witkey_shop_cus_cate��һ������¼		 * @return ����Ӱ�������		 */		function edit_keke_witkey_shop_cus_cate(){		 		 $data =  array();					if(!is_null($this->_cus_cate_id)){				 $data['cus_cate_id']=$this->_cus_cate_id;			}			if(!is_null($this->_obj_type)){				 $data['obj_type']=$this->_obj_type;			}			if(!is_null($this->_obj_id)){				 $data['obj_id']=$this->_obj_id;			}			if(!is_null($this->_cate_name)){				 $data['cate_name']=$this->_cate_name;			}			if(!is_null($this->_shop_id)){				 $data['shop_id']=$this->_shop_id;			}			if($this->_where){				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere());			 }			 else{				 $where = array('cus_cate_id' => $this->_cus_cate_id);				 return $this->_db->updatetable($this->_tablename,$data,$where);			}		 }
	    /**		 * ��ѯ��keke_witkey_shop_cus_cate,��������ʱ������������ROW���������м�¼		 * @return ����һ��(array)��������		 */		function query_keke_witkey_shop_cus_cate(){			 if($this->_where){				 $sql = "select * from $this->_tablename where ".$this->_where;			 }			 else{				 $sql = "select * from $this->_tablename";			 }			 $this->_where = "";			 return $this->_dbop->query($sql);		 }		function count_keke_witkey_shop_cus_cate(){			 if($this->_where){				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where;			 }			 else{				 $sql = "select count(*) as count from $this->_tablename";			 }			 $this->_where = "";			 return $this->_dbop->getCount($sql);		 }		function del_keke_witkey_shop_cus_cate(){			 if($this->_where){				 $sql = "delete from $this->_tablename where ".$this->_where;			 }			 else{				 $sql = "delete from $this->_tablename where cus_cate_id = $this->_cus_cate_id ";			 }			 $this->_where = "";			 return $this->_dbop->execute($sql);		 }
   }
 ?>