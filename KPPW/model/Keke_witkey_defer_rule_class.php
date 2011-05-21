<?php

  class Keke_witkey_defer_rule_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_defer_rule_id; //���� 
		 var $_defer_times; 
		 var $_defer_cash_scale; 
		 var $_model_id; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //�飬�ģ�ɾ����

	     function  keke_witkey_defer_rule_class(){ //���췽��
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_defer_rule";
		 }
	    

	    		function getDefer_rule_id(){
			 return $this->_defer_rule_id ;
		}
		function getDefer_times(){
			 return $this->_defer_times ;
		}
		function getDefer_cash_scale(){
			 return $this->_defer_cash_scale ;
		}
		function getModel_id(){
			 return $this->_model_id ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setDefer_rule_id($value){ 
			 $this->_defer_rule_id = $value;
		}
		function setDefer_times($value){ 
			 $this->_defer_times = $value;
		}
		function setDefer_cash_scale($value){ 
			 $this->_defer_cash_scale = $value;
		}
		function setModel_id($value){ 
			 $this->_model_id = $value;
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
		 * ��keke_witkey_defer_rule����������һ����¼
		 * @return ��������ID
		 */
		function create_keke_witkey_defer_rule(){
		 		 $data =  array(); 

					if(!is_null($this->_defer_rule_id)){ 
				 $data['defer_rule_id']=$this->_defer_rule_id;
			}
			if(!is_null($this->_defer_times)){ 
				 $data['defer_times']=$this->_defer_times;
			}
			if(!is_null($this->_defer_cash_scale)){ 
				 $data['defer_cash_scale']=$this->_defer_cash_scale;
			}
			if(!is_null($this->_model_id)){ 
				 $data['model_id']=$this->_model_id;
			}

			 return $this->_defer_rule_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * �༭��keke_witkey_defer_rule��һ������¼
		 * @return ����Ӱ�������
		 */
		function edit_keke_witkey_defer_rule(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_defer_rule_id)){ 
				 $data['defer_rule_id']=$this->_defer_rule_id;
			}
			if(!is_null($this->_defer_times)){ 
				 $data['defer_times']=$this->_defer_times;
			}
			if(!is_null($this->_defer_cash_scale)){ 
				 $data['defer_cash_scale']=$this->_defer_cash_scale;
			}
			if(!is_null($this->_model_id)){ 
				 $data['model_id']=$this->_model_id;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('defer_rule_id' => $this->_defer_rule_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * ��ѯ��keke_witkey_defer_rule,��������ʱ������������ROW���������м�¼
		 * @return ����һ��(array)��������
		 */
		function query_keke_witkey_defer_rule(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_defer_rule(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_defer_rule(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where defer_rule_id = $this->_defer_rule_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>