<?php

  class Keke_witkey_task_prize_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    		 var $_task_id; 
		 var $_prize; 
		 var $_prize_count; 
		 var $_prize_cash; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //�飬�ģ�ɾ����

	     function  keke_witkey_task_prize_class(){ //���췽��
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_task_prize";
		 }
	    

	    		function getTask_id(){
			 return $this->_task_id ;
		}
		function getPrize(){
			 return $this->_prize ;
		}
		function getPrize_count(){
			 return $this->_prize_count ;
		}
		function getPrize_cash(){
			 return $this->_prize_cash ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setTask_id($value){ 
			 $this->_task_id = $value;
		}
		function setPrize($value){ 
			 $this->_prize = $value;
		}
		function setPrize_count($value){ 
			 $this->_prize_count = $value;
		}
		function setPrize_cash($value){ 
			 $this->_prize_cash = $value;
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
		 * ��keke_witkey_task_prize����������һ����¼
		 * @return ��������ID
		 */
		function create_keke_witkey_task_prize(){
		 		 $data =  array(); 

					if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
			if(!is_null($this->_prize)){ 
				 $data['prize']=$this->_prize;
			}
			if(!is_null($this->_prize_count)){ 
				 $data['prize_count']=$this->_prize_count;
			}
			if(!is_null($this->_prize_cash)){ 
				 $data['prize_cash']=$this->_prize_cash;
			}

			 return $this->_frost_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * �༭��keke_witkey_task_prize��һ������¼
		 * @return ����Ӱ�������
		 */
		function edit_keke_witkey_task_prize(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
			if(!is_null($this->_prize)){ 
				 $data['prize']=$this->_prize;
			}
			if(!is_null($this->_prize_count)){ 
				 $data['prize_count']=$this->_prize_count;
			}
			if(!is_null($this->_prize_cash)){ 
				 $data['prize_cash']=$this->_prize_cash;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('frost_id' => $this->_frost_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * ��ѯ��keke_witkey_task_prize,��������ʱ������������ROW���������м�¼
		 * @return ����һ��(array)��������
		 */
		function query_keke_witkey_task_prize(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_task_prize(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_task_prize(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where frost_id = $this->_frost_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>