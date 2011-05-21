<?php
  class Keke_witkey_shoptpl_config_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_tmp_id; //主键 		 var $_shop_id; 		 var $_tmp_style; 		 var $_tmp_logo; 		 var $_tmp_adtitle; 		 var $_cus_image; 		 var $_topic_color; 		 var $_blackground; 		 var $_menu_slt_color; 		 var $_font_color; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //查，改，删条件
	     function  keke_witkey_shoptpl_config_class(){ //构造方法			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_shoptpl_config";		 }	    
	    		function getTmp_id(){			 return $this->_tmp_id ;		}		function getShop_id(){			 return $this->_shop_id ;		}		function getTmp_style(){			 return $this->_tmp_style ;		}		function getTmp_logo(){			 return $this->_tmp_logo ;		}		function getTmp_adtitle(){			 return $this->_tmp_adtitle ;		}		function getCus_image(){			 return $this->_cus_image ;		}		function getTopic_color(){			 return $this->_topic_color ;		}		function getBlackground(){			 return $this->_blackground ;		}		function getMenu_slt_color(){			 return $this->_menu_slt_color ;		}		function getFont_color(){			 return $this->_font_color ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setTmp_id($value){ 			 $this->_tmp_id = $value;		}		function setShop_id($value){ 			 $this->_shop_id = $value;		}		function setTmp_style($value){ 			 $this->_tmp_style = $value;		}		function setTmp_logo($value){ 			 $this->_tmp_logo = $value;		}		function setTmp_adtitle($value){ 			 $this->_tmp_adtitle = $value;		}		function setCus_image($value){ 			 $this->_cus_image = $value;		}		function setTopic_color($value){ 			 $this->_topic_color = $value;		}		function setBlackground($value){ 			 $this->_blackground = $value;		}		function setMenu_slt_color($value){ 			 $this->_menu_slt_color = $value;		}		function setFont_color($value){ 			 $this->_font_color = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * 表keke_witkey_shoptpl_config创建或新增一条记录		 * @return 返回新增ID		 */		function create_keke_witkey_shoptpl_config(){		 		 $data =  array(); 					if(!is_null($this->_tmp_id)){ 				 $data['tmp_id']=$this->_tmp_id;			}			if(!is_null($this->_shop_id)){ 				 $data['shop_id']=$this->_shop_id;			}			if(!is_null($this->_tmp_style)){ 				 $data['tmp_style']=$this->_tmp_style;			}			if(!is_null($this->_tmp_logo)){ 				 $data['tmp_logo']=$this->_tmp_logo;			}			if(!is_null($this->_tmp_adtitle)){ 				 $data['tmp_adtitle']=$this->_tmp_adtitle;			}			if(!is_null($this->_cus_image)){ 				 $data['cus_image']=$this->_cus_image;			}			if(!is_null($this->_topic_color)){ 				 $data['topic_color']=$this->_topic_color;			}			if(!is_null($this->_blackground)){ 				 $data['blackground']=$this->_blackground;			}			if(!is_null($this->_menu_slt_color)){ 				 $data['menu_slt_color']=$this->_menu_slt_color;			}			if(!is_null($this->_font_color)){ 				 $data['font_color']=$this->_font_color;			}			 return $this->_tmp_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * 编辑表keke_witkey_shoptpl_config的一个条记录		 * @return 返回影响的行数		 */		function edit_keke_witkey_shoptpl_config(){ 		 		 $data =  array();  					if(!is_null($this->_tmp_id)){ 				 $data['tmp_id']=$this->_tmp_id;			}			if(!is_null($this->_shop_id)){ 				 $data['shop_id']=$this->_shop_id;			}			if(!is_null($this->_tmp_style)){ 				 $data['tmp_style']=$this->_tmp_style;			}			if(!is_null($this->_tmp_logo)){ 				 $data['tmp_logo']=$this->_tmp_logo;			}			if(!is_null($this->_tmp_adtitle)){ 				 $data['tmp_adtitle']=$this->_tmp_adtitle;			}			if(!is_null($this->_cus_image)){ 				 $data['cus_image']=$this->_cus_image;			}			if(!is_null($this->_topic_color)){ 				 $data['topic_color']=$this->_topic_color;			}			if(!is_null($this->_blackground)){ 				 $data['blackground']=$this->_blackground;			}			if(!is_null($this->_menu_slt_color)){ 				 $data['menu_slt_color']=$this->_menu_slt_color;			}			if(!is_null($this->_font_color)){ 				 $data['font_color']=$this->_font_color;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('tmp_id' => $this->_tmp_id); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * 查询表keke_witkey_shoptpl_config,当有条件时返回有条件的ROW，否则返所有记录		 * @return 返回一个(array)关联数组		 */		function query_keke_witkey_shoptpl_config(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_shoptpl_config(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_shoptpl_config(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where tmp_id = $this->_tmp_id "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>