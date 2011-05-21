<?php

  class Keke_witkey_bid_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_bid_id; //���� 
		 var $_task_id; 
		 var $_uid; 
		 var $_username; 
		 var $_quote; 
		 var $_cycle; 
		 var $_area; 
		 var $_message; 
		 var $_bid_status; 
		 var $_bid_time; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //�飬�ģ�ɾ����

	     function  keke_witkey_bid_class(){ //���췽��
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_bid";
		 }
	    

	    		function getBid_id(){
			 return $this->_bid_id ;
		}
		function getTask_id(){
			 return $this->_task_id ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getQuote(){
			 return $this->_quote ;
		}
		function getCycle(){
			 return $this->_cycle ;
		}
		function getArea(){
			 return $this->_area ;
		}
		function getMessage(){
			 return $this->_message ;
		}
		function getBid_status(){
			 return $this->_bid_status ;
		}
		function getBid_time(){
			 return $this->_bid_time ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setBid_id($value){ 
			 $this->_bid_id = $value;
		}
		function setTask_id($value){ 
			 $this->_task_id = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setQuote($value){ 
			 $this->_quote = $value;
		}
		function setCycle($value){ 
			 $this->_cycle = $value;
		}
		function setArea($value){ 
			 $this->_area = $value;
		}
		function setMessage($value){ 
			 $this->_message = $value;
		}
		function setBid_status($value){ 
			 $this->_bid_status = $value;
		}
		function setBid_time($value){ 
			 $this->_bid_time = $value;
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
		 * ��keke_witkey_bid����������һ����¼
		 * @return ��������ID
		 */
		function create_keke_witkey_bid(){
		 		 $data =  array(); 

					if(!is_null($this->_bid_id)){ 
				 $data['bid_id']=$this->_bid_id;
			}
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_quote)){ 
				 $data['quote']=$this->_quote;
			}
			if(!is_null($this->_cycle)){ 
				 $data['cycle']=$this->_cycle;
			}
			if(!is_null($this->_area)){ 
				 $data['area']=$this->_area;
			}
			if(!is_null($this->_message)){ 
				 $data['message']=$this->_message;
			}
			if(!is_null($this->_bid_status)){ 
				 $data['bid_status']=$this->_bid_status;
			}
			if(!is_null($this->_bid_time)){ 
				 $data['bid_time']=$this->_bid_time;
			}

			 return $this->_bid_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * �༭��keke_witkey_bid��һ������¼
		 * @return ����Ӱ�������
		 */
		function edit_keke_witkey_bid(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_bid_id)){ 
				 $data['bid_id']=$this->_bid_id;
			}
			if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_quote)){ 
				 $data['quote']=$this->_quote;
			}
			if(!is_null($this->_cycle)){ 
				 $data['cycle']=$this->_cycle;
			}
			if(!is_null($this->_area)){ 
				 $data['area']=$this->_area;
			}
			if(!is_null($this->_message)){ 
				 $data['message']=$this->_message;
			}
			if(!is_null($this->_bid_status)){ 
				 $data['bid_status']=$this->_bid_status;
			}
			if(!is_null($this->_bid_time)){ 
				 $data['bid_time']=$this->_bid_time;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('bid_id' => $this->_bid_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * ��ѯ��keke_witkey_bid,��������ʱ������������ROW���������м�¼
		 * @return ����һ��(array)��������
		 */
		function query_keke_witkey_bid(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_bid(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_bid(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where bid_id = $this->_bid_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>