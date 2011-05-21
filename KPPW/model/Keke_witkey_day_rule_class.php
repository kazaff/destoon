<?php
  class Keke_witkey_day_rule_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_day_rule_id; //���� 
		 var $_rule_cash; 
		 var $_rule_day; 
		 var $_model_id; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //�飬�ģ�ɾ����

	     function  keke_witkey_day_rule_class(){ //���췽��
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_day_rule";
		 }
	    

	    		function getDay_rule_id(){
			 return $this->_day_rule_id ;
		}
		function getRule_cash(){
			 return $this->_rule_cash ;
		}
		function getRule_day(){
			 return $this->_rule_day ;
		}
		function getModel_id(){
			 return $this->_model_id ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setDay_rule_id($value){ 
			 $this->_day_rule_id = $value;
		}
		function setRule_cash($value){ 
			 $this->_rule_cash = $value;
		}
		function setRule_day($value){ 
			 $this->_rule_day = $value;
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
		 * ��keke_witkey_day_rule����������һ����¼
		 * @return ��������ID
		 */
		function create_keke_witkey_day_rule(){
		 		 $data =  array(); 

					if(!is_null($this->_day_rule_id)){ 
				 $data['day_rule_id']=$this->_day_rule_id;
			}
			if(!is_null($this->_rule_cash)){ 
				 $data['rule_cash']=$this->_rule_cash;
			}
			if(!is_null($this->_rule_day)){ 
				 $data['rule_day']=$this->_rule_day;
			}
			if(!is_null($this->_model_id)){ 
				 $data['model_id']=$this->_model_id;
			}

			 return $this->_day_rule_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * �༭��keke_witkey_day_rule��һ������¼
		 * @return ����Ӱ�������
		 */
		function edit_keke_witkey_day_rule(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_day_rule_id)){ 
				 $data['day_rule_id']=$this->_day_rule_id;
			}
			if(!is_null($this->_rule_cash)){ 
				 $data['rule_cash']=$this->_rule_cash;
			}
			if(!is_null($this->_rule_day)){ 
				 $data['rule_day']=$this->_rule_day;
			}
			if(!is_null($this->_model_id)){ 
				 $data['model_id']=$this->_model_id;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('day_rule_id' => $this->_day_rule_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * ��ѯ��keke_witkey_day_rule,��������ʱ������������ROW���������м�¼
		 * @return ����һ��(array)��������
		 */
		function query_keke_witkey_day_rule(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_day_rule(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_day_rule(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where day_rule_id = $this->_day_rule_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>