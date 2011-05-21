<?php

  class Keke_witkey_cash_rule_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_cash_rule_id; //主键 
		 var $_start_cove; 
		 var $_end_cove; 
		 var $_cove_desc; 
		 var $_on_time; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_cash_rule_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_cash_rule";
		 }
	    

	    		function getCash_rule_id(){
			 return $this->_cash_rule_id ;
		}
		function getStart_cove(){
			 return $this->_start_cove ;
		}
		function getEnd_cove(){
			 return $this->_end_cove ;
		}
		function getCove_desc(){
			 return $this->_cove_desc ;
		}
		function getOn_time(){
			 return $this->_on_time ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setCash_rule_id($value){ 
			 $this->_cash_rule_id = $value;
		}
		function setStart_cove($value){ 
			 $this->_start_cove = $value;
		}
		function setEnd_cove($value){ 
			 $this->_end_cove = $value;
		}
		function setCove_desc($value){ 
			 $this->_cove_desc = $value;
		}
		function setOn_time($value){ 
			 $this->_on_time = $value;
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
		 * 表keke_witkey_cash_rule创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_cash_rule(){
		 		 $data =  array(); 

					if(!is_null($this->_cash_rule_id)){ 
				 $data['cash_rule_id']=$this->_cash_rule_id;
			}
			if(!is_null($this->_start_cove)){ 
				 $data['start_cove']=$this->_start_cove;
			}
			if(!is_null($this->_end_cove)){ 
				 $data['end_cove']=$this->_end_cove;
			}
			if(!is_null($this->_cove_desc)){ 
				 $data['cove_desc']=$this->_cove_desc;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}

			 return $this->_cash_rule_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_cash_rule的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_cash_rule(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_cash_rule_id)){ 
				 $data['cash_rule_id']=$this->_cash_rule_id;
			}
			if(!is_null($this->_start_cove)){ 
				 $data['start_cove']=$this->_start_cove;
			}
			if(!is_null($this->_end_cove)){ 
				 $data['end_cove']=$this->_end_cove;
			}
			if(!is_null($this->_cove_desc)){ 
				 $data['cove_desc']=$this->_cove_desc;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('cash_rule_id' => $this->_cash_rule_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_cash_rule,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_cash_rule(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_cash_rule(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_cash_rule(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where cash_rule_id = $this->_cash_rule_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>