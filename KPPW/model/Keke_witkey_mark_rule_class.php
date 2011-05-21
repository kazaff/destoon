<?php
  class Keke_witkey_mark_rule_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_mark_rule_id; //���� 
		 var $_min_mark; 
		 var $_max_mark; 
		 var $_unit_count; 
		 var $_unit_id; 
		 var $_unit_title; 
		 var $_g_ico; 
		 var $_m_ico; 

	    var $_replace=0;  
	    var $_where;      
	     function  keke_witkey_mark_rule_class(){ //���췽��
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_mark_rule";
		 }
	    
	    		function getMark_rule_id(){
			 return $this->_mark_rule_id ;
		}
		function getMin_mark(){
			 return $this->_min_mark ;
		}
		function getMax_mark(){
			 return $this->_max_mark ;
		}
		function getUnit_count(){
			 return $this->_unit_count ;
		}
		function getUnit_id(){
			 return $this->_unit_id ;
		}
		function getUnit_title(){
			 return $this->_unit_title ;
		}
		function getG_ico(){
			 return $this->_g_ico ;
		}
		function getM_ico(){
			 return $this->_m_ico ;
		}
		function getWhere(){
			 return $this->_where ;
		}

	    		function setMark_rule_id($value){ 
			 $this->_mark_rule_id = $value;
		}
		function setMin_mark($value){ 
			 $this->_min_mark = $value;
		}
		function setMax_mark($value){ 
			 $this->_max_mark = $value;
		}
		function setUnit_count($value){ 
			 $this->_unit_count = $value;
		}
		function setUnit_id($value){ 
			 $this->_unit_id = $value;
		}
		function setUnit_title($value){ 
			 $this->_unit_title = $value;
		}
		function setG_ico($value){ 
			 $this->_g_ico = $value;
		}
		function setM_ico($value){ 
			 $this->_m_ico = $value;
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
		 * ��keke_witkey_mark_rule����������һ����¼
		 * @return ��������ID
		 */
		function create_keke_witkey_mark_rule(){
		 		 $data =  array(); 

					if(!is_null($this->_mark_rule_id)){ 
				 $data['mark_rule_id']=$this->_mark_rule_id;
			}
			if(!is_null($this->_min_mark)){ 
				 $data['min_mark']=$this->_min_mark;
			}
			if(!is_null($this->_max_mark)){ 
				 $data['max_mark']=$this->_max_mark;
			}
			if(!is_null($this->_unit_count)){ 
				 $data['unit_count']=$this->_unit_count;
			}
			if(!is_null($this->_unit_id)){ 
				 $data['unit_id']=$this->_unit_id;
			}
			if(!is_null($this->_unit_title)){ 
				 $data['unit_title']=$this->_unit_title;
			}
			if(!is_null($this->_g_ico)){ 
				 $data['g_ico']=$this->_g_ico;
			}
			if(!is_null($this->_m_ico)){ 
				 $data['m_ico']=$this->_m_ico;
			}

			 return $this->_mark_rule_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 

	    /**
		 * �༭��keke_witkey_mark_rule��һ������¼
		 * @return ����Ӱ�������
		 */
		function edit_keke_witkey_mark_rule(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_mark_rule_id)){ 
				 $data['mark_rule_id']=$this->_mark_rule_id;
			}
			if(!is_null($this->_min_mark)){ 
				 $data['min_mark']=$this->_min_mark;
			}
			if(!is_null($this->_max_mark)){ 
				 $data['max_mark']=$this->_max_mark;
			}
			if(!is_null($this->_unit_count)){ 
				 $data['unit_count']=$this->_unit_count;
			}
			if(!is_null($this->_unit_id)){ 
				 $data['unit_id']=$this->_unit_id;
			}
			if(!is_null($this->_unit_title)){ 
				 $data['unit_title']=$this->_unit_title;
			}
			if(!is_null($this->_g_ico)){ 
				 $data['g_ico']=$this->_g_ico;
			}
			if(!is_null($this->_m_ico)){ 
				 $data['m_ico']=$this->_m_ico;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('mark_rule_id' => $this->_mark_rule_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 

	    /**
		 * ��ѯ��keke_witkey_mark_rule,��������ʱ������������ROW���������м�¼
		 * @return ����һ��(array)��������
		 */
		function query_keke_witkey_mark_rule(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 

	    
		function count_keke_witkey_mark_rule(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 

	    
		function del_keke_witkey_mark_rule(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where mark_rule_id = $this->_mark_rule_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 

	   
	    
	    
   }
 ?>