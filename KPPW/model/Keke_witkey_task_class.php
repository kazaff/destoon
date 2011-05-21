<?php

  class Keke_witkey_task_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_task_id; //主键 
		 var $_model_id; 
		 var $_task_mode; 
		 var $_work_count; 
		 var $_single_cash; 
		 var $_task_status; 
		 var $_task_title; 
		 var $_task_desc; 
		 var $_task_file; 
		 var $_task_pic; 
		 var $_indus_id; 
		 var $_uid; 
		 var $_username; 
		 var $_start_time; 
		 var $_end_time; 
		 var $_sp_end_time; 
		 var $_city; 
		 var $_task_cash; 
		 var $_task_cash_coverage; 
		 var $_cash_cost; 
		 var $_credit_cost; 
		 var $_view_num; 
		 var $_work_num; 
		 var $_sign_num; 
		 var $_is_prom; 
		 var $_prom_count; 
		 var $_prom_cash; 
		 var $_prom_credit; 
		 var $_is_delineas; 
		 var $_isvip; 
		 var $_istop; 
		 var $_kf_uid; 


	    var $_replace=0;  

	    var $_where;      

	     function  keke_witkey_task_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_task";
		 }
	    

	    		function getTask_id(){
			 return $this->_task_id ;
		}
		function getModel_id(){
			 return $this->_model_id ;
		}
		function getTask_mode(){
			 return $this->_task_mode ;
		}
		function getWork_count(){
			 return $this->_work_count ;
		}
		function getSingle_cash(){
			 return $this->_single_cash ;
		}
		function getTask_status(){
			 return $this->_task_status ;
		}
		function getTask_title(){
			 return $this->_task_title ;
		}
		function getTask_desc(){
			 return $this->_task_desc ;
		}
		function getTask_file(){
			 return $this->_task_file ;
		}
		function getTask_pic(){
			 return $this->_task_pic ;
		}
		function getIndus_id(){
			 return $this->_indus_id ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getStart_time(){
			 return $this->_start_time ;
		}
		function getEnd_time(){
			 return $this->_end_time ;
		}
		function getSp_end_time(){
			 return $this->_sp_end_time ;
		}
		function getCity(){
			 return $this->_city ;
		}
		function getTask_cash(){
			 return $this->_task_cash ;
		}
		function getTask_cash_coverage(){
			 return $this->_task_cash_coverage ;
		}
		function getCash_cost(){
			 return $this->_cash_cost ;
		}
		function getCredit_cost(){
			 return $this->_credit_cost ;
		}
		function getView_num(){
			 return $this->_view_num ;
		}
		function getWork_num(){
			 return $this->_work_num ;
		}
		function getSign_num(){
			 return $this->_sign_num ;
		}
		function getIs_prom(){
			 return $this->_is_prom ;
		}
		function getProm_count(){
			 return $this->_prom_count ;
		}
		function getProm_cash(){
			 return $this->_prom_cash ;
		}
		function getProm_credit(){
			 return $this->_prom_credit ;
		}
		function getIs_delineas(){
			 return $this->_is_delineas ;
		}
		function getIsvip(){
			 return $this->_isvip ;
		}
		function getIstop(){
			 return $this->_istop ;
		}
		function getKf_uid(){
			 return $this->_kf_uid ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setTask_id($value){ 
			 $this->_task_id = $value;
		}
		function setModel_id($value){ 
			 $this->_model_id = $value;
		}
		function setTask_mode($value){ 
			 $this->_task_mode = $value;
		}
		function setWork_count($value){ 
			 $this->_work_count = $value;
		}
		function setSingle_cash($value){ 
			 $this->_single_cash = $value;
		}
		function setTask_status($value){ 
			 $this->_task_status = $value;
		}
		function setTask_title($value){ 
			 $this->_task_title = $value;
		}
		function setTask_desc($value){ 
			 $this->_task_desc = $value;
		}
		function setTask_file($value){ 
			 $this->_task_file = $value;
		}
		function setTask_pic($value){ 
			 $this->_task_pic = $value;
		}
		function setIndus_id($value){ 
			 $this->_indus_id = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setStart_time($value){ 
			 $this->_start_time = $value;
		}
		function setEnd_time($value){ 
			 $this->_end_time = $value;
		}
		function setSp_end_time($value){ 
			 $this->_sp_end_time = $value;
		}
		function setCity($value){ 
			 $this->_city = $value;
		}
		function setTask_cash($value){ 
			 $this->_task_cash = $value;
		}
		function setTask_cash_coverage($value){ 
			 $this->_task_cash_coverage = $value;
		}
		function setCash_cost($value){ 
			 $this->_cash_cost = $value;
		}
		function setCredit_cost($value){ 
			 $this->_credit_cost = $value;
		}
		function setView_num($value){ 
			 $this->_view_num = $value;
		}
		function setWork_num($value){ 
			 $this->_work_num = $value;
		}
		function setSign_num($value){ 
			 $this->_sign_num = $value;
		}
		function setIs_prom($value){ 
			 $this->_is_prom = $value;
		}
		function setProm_count($value){ 
			 $this->_prom_count = $value;
		}
		function setProm_cash($value){ 
			 $this->_prom_cash = $value;
		}
		function setProm_credit($value){ 
			 $this->_prom_credit = $value;
		}
		function setIs_delineas($value){ 
			 $this->_is_delineas = $value;
		}
		function setIsvip($value){ 
			 $this->_isvip = $value;
		}
		function setIstop($value){ 
			 $this->_istop = $value;
		}
		function setKf_uid($value){ 
			 $this->_kf_uid = $value;
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
		 * 表keke_witkey_task创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_task(){
		 		 $data =  array(); 

					if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
			if(!is_null($this->_model_id)){ 
				 $data['model_id']=$this->_model_id;
			}
			if(!is_null($this->_task_mode)){ 
				 $data['task_mode']=$this->_task_mode;
			}
			if(!is_null($this->_work_count)){ 
				 $data['work_count']=$this->_work_count;
			}
			if(!is_null($this->_single_cash)){ 
				 $data['single_cash']=$this->_single_cash;
			}
			if(!is_null($this->_task_status)){ 
				 $data['task_status']=$this->_task_status;
			}
			if(!is_null($this->_task_title)){ 
				 $data['task_title']=$this->_task_title;
			}
			if(!is_null($this->_task_desc)){ 
				 $data['task_desc']=$this->_task_desc;
			}
			if(!is_null($this->_task_file)){ 
				 $data['task_file']=$this->_task_file;
			}
			if(!is_null($this->_task_pic)){ 
				 $data['task_pic']=$this->_task_pic;
			}
			if(!is_null($this->_indus_id)){ 
				 $data['indus_id']=$this->_indus_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_start_time)){ 
				 $data['start_time']=$this->_start_time;
			}
			if(!is_null($this->_end_time)){ 
				 $data['end_time']=$this->_end_time;
			}
			if(!is_null($this->_sp_end_time)){ 
				 $data['sp_end_time']=$this->_sp_end_time;
			}
			if(!is_null($this->_city)){ 
				 $data['city']=$this->_city;
			}
			if(!is_null($this->_task_cash)){ 
				 $data['task_cash']=$this->_task_cash;
			}
			if(!is_null($this->_task_cash_coverage)){ 
				 $data['task_cash_coverage']=$this->_task_cash_coverage;
			}
			if(!is_null($this->_cash_cost)){ 
				 $data['cash_cost']=$this->_cash_cost;
			}
			if(!is_null($this->_credit_cost)){ 
				 $data['credit_cost']=$this->_credit_cost;
			}
			if(!is_null($this->_view_num)){ 
				 $data['view_num']=$this->_view_num;
			}
			if(!is_null($this->_work_num)){ 
				 $data['work_num']=$this->_work_num;
			}
			if(!is_null($this->_sign_num)){ 
				 $data['sign_num']=$this->_sign_num;
			}
			if(!is_null($this->_is_prom)){ 
				 $data['is_prom']=$this->_is_prom;
			}
			if(!is_null($this->_prom_count)){ 
				 $data['prom_count']=$this->_prom_count;
			}
			if(!is_null($this->_prom_cash)){ 
				 $data['prom_cash']=$this->_prom_cash;
			}
			if(!is_null($this->_prom_credit)){ 
				 $data['prom_credit']=$this->_prom_credit;
			}
			if(!is_null($this->_is_delineas)){ 
				 $data['is_delineas']=$this->_is_delineas;
			}
			if(!is_null($this->_isvip)){ 
				 $data['isvip']=$this->_isvip;
			}
			if(!is_null($this->_istop)){ 
				 $data['istop']=$this->_istop;
			}
			if(!is_null($this->_kf_uid)){ 
				 $data['kf_uid']=$this->_kf_uid;
			}

			 return $this->_task_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_task的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_task(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_task_id)){ 
				 $data['task_id']=$this->_task_id;
			}
			if(!is_null($this->_model_id)){ 
				 $data['model_id']=$this->_model_id;
			}
			if(!is_null($this->_task_mode)){ 
				 $data['task_mode']=$this->_task_mode;
			}
			if(!is_null($this->_work_count)){ 
				 $data['work_count']=$this->_work_count;
			}
			if(!is_null($this->_single_cash)){ 
				 $data['single_cash']=$this->_single_cash;
			}
			if(!is_null($this->_task_status)){ 
				 $data['task_status']=$this->_task_status;
			}
			if(!is_null($this->_task_title)){ 
				 $data['task_title']=$this->_task_title;
			}
			if(!is_null($this->_task_desc)){ 
				 $data['task_desc']=$this->_task_desc;
			}
			if(!is_null($this->_task_file)){ 
				 $data['task_file']=$this->_task_file;
			}
			if(!is_null($this->_task_pic)){ 
				 $data['task_pic']=$this->_task_pic;
			}
			if(!is_null($this->_indus_id)){ 
				 $data['indus_id']=$this->_indus_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_start_time)){ 
				 $data['start_time']=$this->_start_time;
			}
			if(!is_null($this->_end_time)){ 
				 $data['end_time']=$this->_end_time;
			}
			if(!is_null($this->_sp_end_time)){ 
				 $data['sp_end_time']=$this->_sp_end_time;
			}
			if(!is_null($this->_city)){ 
				 $data['city']=$this->_city;
			}
			if(!is_null($this->_task_cash)){ 
				 $data['task_cash']=$this->_task_cash;
			}
			if(!is_null($this->_task_cash_coverage)){ 
				 $data['task_cash_coverage']=$this->_task_cash_coverage;
			}
			if(!is_null($this->_cash_cost)){ 
				 $data['cash_cost']=$this->_cash_cost;
			}
			if(!is_null($this->_credit_cost)){ 
				 $data['credit_cost']=$this->_credit_cost;
			}
			if(!is_null($this->_view_num)){ 
				 $data['view_num']=$this->_view_num;
			}
			if(!is_null($this->_work_num)){ 
				 $data['work_num']=$this->_work_num;
			}
			if(!is_null($this->_sign_num)){ 
				 $data['sign_num']=$this->_sign_num;
			}
			if(!is_null($this->_is_prom)){ 
				 $data['is_prom']=$this->_is_prom;
			}
			if(!is_null($this->_prom_count)){ 
				 $data['prom_count']=$this->_prom_count;
			}
			if(!is_null($this->_prom_cash)){ 
				 $data['prom_cash']=$this->_prom_cash;
			}
			if(!is_null($this->_prom_credit)){ 
				 $data['prom_credit']=$this->_prom_credit;
			}
			if(!is_null($this->_is_delineas)){ 
				 $data['is_delineas']=$this->_is_delineas;
			}
			if(!is_null($this->_isvip)){ 
				 $data['isvip']=$this->_isvip;
			}
			if(!is_null($this->_istop)){ 
				 $data['istop']=$this->_istop;
			}
			if(!is_null($this->_kf_uid)){ 
				 $data['kf_uid']=$this->_kf_uid;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('task_id' => $this->_task_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_task,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_task(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_task(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_task(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where task_id = $this->_task_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>