<?php
  class Keke_witkey_shop_banner_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_banner_id; //����		 var $_banner_type;		 var $_img_file;		 var $_img_name;		 var $_indus_id;		 var $_list_order;
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //�飬�ģ�ɾ����
	     function  keke_witkey_shop_banner_class(){ //���췽��			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_shop_banner";		 }
	    		function getBanner_id(){			 return $this->_banner_id ;		}		function getBanner_type(){			 return $this->_banner_type ;		}		function getImg_file(){			 return $this->_img_file ;		}		function getImg_name(){			 return $this->_img_name ;		}		function getIndus_id(){			 return $this->_indus_id ;		}		function getList_order(){			 return $this->_list_order ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setBanner_id($value){			 $this->_banner_id = $value;		}		function setBanner_type($value){			 $this->_banner_type = $value;		}		function setImg_file($value){			 $this->_img_file = $value;		}		function setImg_name($value){			 $this->_img_name = $value;		}		function setIndus_id($value){			 $this->_indus_id = $value;		}		function setList_order($value){			 $this->_list_order = $value;		}		function setWhere($value){			 $this->_where = $value;		}
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
	    /**		 * ��keke_witkey_shop_banner����������һ����¼		 * @return ��������ID		 */		function create_keke_witkey_shop_banner(){		 		 $data =  array();					if(!is_null($this->_banner_id)){				 $data['banner_id']=$this->_banner_id;			}			if(!is_null($this->_banner_type)){				 $data['banner_type']=$this->_banner_type;			}			if(!is_null($this->_img_file)){				 $data['img_file']=$this->_img_file;			}			if(!is_null($this->_img_name)){				 $data['img_name']=$this->_img_name;			}			if(!is_null($this->_indus_id)){				 $data['indus_id']=$this->_indus_id;			}			if(!is_null($this->_list_order)){				 $data['list_order']=$this->_list_order;			}			 return $this->_banner_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace);		 }
	    /**		 * �༭��keke_witkey_shop_banner��һ������¼		 * @return ����Ӱ�������		 */		function edit_keke_witkey_shop_banner(){		 		 $data =  array();					if(!is_null($this->_banner_id)){				 $data['banner_id']=$this->_banner_id;			}			if(!is_null($this->_banner_type)){				 $data['banner_type']=$this->_banner_type;			}			if(!is_null($this->_img_file)){				 $data['img_file']=$this->_img_file;			}			if(!is_null($this->_img_name)){				 $data['img_name']=$this->_img_name;			}			if(!is_null($this->_indus_id)){				 $data['indus_id']=$this->_indus_id;			}			if(!is_null($this->_list_order)){				 $data['list_order']=$this->_list_order;			}			if($this->_where){				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere());			 }			 else{				 $where = array('banner_id' => $this->_banner_id);				 return $this->_db->updatetable($this->_tablename,$data,$where);			}		 }
	    /**		 * ��ѯ��keke_witkey_shop_banner,��������ʱ������������ROW���������м�¼		 * @return ����һ��(array)��������		 */		function query_keke_witkey_shop_banner(){			 if($this->_where){				 $sql = "select * from $this->_tablename where ".$this->_where;			 }			 else{				 $sql = "select * from $this->_tablename";			 }			 $this->_where = "";			 return $this->_dbop->query($sql);		 }		function count_keke_witkey_shop_banner(){			 if($this->_where){				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where;			 }			 else{				 $sql = "select count(*) as count from $this->_tablename";			 }			 $this->_where = "";			 return $this->_dbop->getCount($sql);		 }		function del_keke_witkey_shop_banner(){			 if($this->_where){				 $sql = "delete from $this->_tablename where ".$this->_where;			 }			 else{				 $sql = "delete from $this->_tablename where banner_id = $this->_banner_id ";			 }			 $this->_where = "";			 return $this->_dbop->execute($sql);		 }
   }
 ?>