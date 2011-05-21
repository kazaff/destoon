<?php

  class Keke_witkey_xs_task_config_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_xs_task_config_id; //主键 
		 var $_xs_is_close; 
		 var $_audit_cash; 
		 var $_is_auto_adjourn; 
		 var $_adjourn_day; 
		 var $_is_open_prom; 
		 var $_vip_task_istop; 
		 var $_vip_work_istop; 
		 var $_vip_hidden_work; 
		 var $_vip_recommend; 
		 var $_deduct_scale; 
		 var $_defeated_money; 
		 var $_is_comment; 
		 var $_task_min_cash; 
		 var $_vote_limit_time; 
		 var $_show_limit_time; 
		 var $_reg_vote_limit_time; 
		 var $_on_time; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_xs_task_config_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_xs_task_config";
		 }
	    

	    		function getXs_task_config_id(){
			 return $this->_xs_task_config_id ;
		}
		function getXs_is_close(){
			 return $this->_xs_is_close ;
		}
		function getAudit_cash(){
			 return $this->_audit_cash ;
		}
		function getIs_auto_adjourn(){
			 return $this->_is_auto_adjourn ;
		}
		function getAdjourn_day(){
			 return $this->_adjourn_day ;
		}
		function getIs_open_prom(){
			 return $this->_is_open_prom ;
		}
		function getVip_task_istop(){
			 return $this->_vip_task_istop ;
		}
		function getVip_work_istop(){
			 return $this->_vip_work_istop ;
		}
		function getVip_hidden_work(){
			 return $this->_vip_hidden_work ;
		}
		function getVip_recommend(){
			 return $this->_vip_recommend ;
		}
		function getDeduct_scale(){
			 return $this->_deduct_scale ;
		}
		function getDefeated_money(){
			 return $this->_defeated_money ;
		}
		function getIs_comment(){
			 return $this->_is_comment ;
		}
		function getTask_min_cash(){
			 return $this->_task_min_cash ;
		}
		function getVote_limit_time(){
			 return $this->_vote_limit_time ;
		}
		function getShow_limit_time(){
			 return $this->_show_limit_time ;
		}
		function getReg_vote_limit_time(){
			 return $this->_reg_vote_limit_time ;
		}
		function getOn_time(){
			 return $this->_on_time ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setXs_task_config_id($value){ 
			 $this->_xs_task_config_id = $value;
		}
		function setXs_is_close($value){ 
			 $this->_xs_is_close = $value;
		}
		function setAudit_cash($value){ 
			 $this->_audit_cash = $value;
		}
		function setIs_auto_adjourn($value){ 
			 $this->_is_auto_adjourn = $value;
		}
		function setAdjourn_day($value){ 
			 $this->_adjourn_day = $value;
		}
		function setIs_open_prom($value){ 
			 $this->_is_open_prom = $value;
		}
		function setVip_task_istop($value){ 
			 $this->_vip_task_istop = $value;
		}
		function setVip_work_istop($value){ 
			 $this->_vip_work_istop = $value;
		}
		function setVip_hidden_work($value){ 
			 $this->_vip_hidden_work = $value;
		}
		function setVip_recommend($value){ 
			 $this->_vip_recommend = $value;
		}
		function setDeduct_scale($value){ 
			 $this->_deduct_scale = $value;
		}
		function setDefeated_money($value){ 
			 $this->_defeated_money = $value;
		}
		function setIs_comment($value){ 
			 $this->_is_comment = $value;
		}
		function setTask_min_cash($value){ 
			 $this->_task_min_cash = $value;
		}
		function setVote_limit_time($value){ 
			 $this->_vote_limit_time = $value;
		}
		function setShow_limit_time($value){ 
			 $this->_show_limit_time = $value;
		}
		function setReg_vote_limit_time($value){ 
			 $this->_reg_vote_limit_time = $value;
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
		 * 表keke_witkey_xs_task_config创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_xs_task_config(){
		 		 $data =  array(); 

					if(!is_null($this->_xs_task_config_id)){ 
				 $data['xs_task_config_id']=$this->_xs_task_config_id;
			}
			if(!is_null($this->_xs_is_close)){ 
				 $data['xs_is_close']=$this->_xs_is_close;
			}
			if(!is_null($this->_audit_cash)){ 
				 $data['audit_cash']=$this->_audit_cash;
			}
			if(!is_null($this->_is_auto_adjourn)){ 
				 $data['is_auto_adjourn']=$this->_is_auto_adjourn;
			}
			if(!is_null($this->_adjourn_day)){ 
				 $data['adjourn_day']=$this->_adjourn_day;
			}
			if(!is_null($this->_is_open_prom)){ 
				 $data['is_open_prom']=$this->_is_open_prom;
			}
			if(!is_null($this->_vip_task_istop)){ 
				 $data['vip_task_istop']=$this->_vip_task_istop;
			}
			if(!is_null($this->_vip_work_istop)){ 
				 $data['vip_work_istop']=$this->_vip_work_istop;
			}
			if(!is_null($this->_vip_hidden_work)){ 
				 $data['vip_hidden_work']=$this->_vip_hidden_work;
			}
			if(!is_null($this->_vip_recommend)){ 
				 $data['vip_recommend']=$this->_vip_recommend;
			}
			if(!is_null($this->_deduct_scale)){ 
				 $data['deduct_scale']=$this->_deduct_scale;
			}
			if(!is_null($this->_defeated_money)){ 
				 $data['defeated_money']=$this->_defeated_money;
			}
			if(!is_null($this->_is_comment)){ 
				 $data['is_comment']=$this->_is_comment;
			}
			if(!is_null($this->_task_min_cash)){ 
				 $data['task_min_cash']=$this->_task_min_cash;
			}
			if(!is_null($this->_vote_limit_time)){ 
				 $data['vote_limit_time']=$this->_vote_limit_time;
			}
			if(!is_null($this->_show_limit_time)){ 
				 $data['show_limit_time']=$this->_show_limit_time;
			}
			if(!is_null($this->_reg_vote_limit_time)){ 
				 $data['reg_vote_limit_time']=$this->_reg_vote_limit_time;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}

			 return $this->_xs_task_config_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_xs_task_config的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_xs_task_config(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_xs_task_config_id)){ 
				 $data['xs_task_config_id']=$this->_xs_task_config_id;
			}
			if(!is_null($this->_xs_is_close)){ 
				 $data['xs_is_close']=$this->_xs_is_close;
			}
			if(!is_null($this->_audit_cash)){ 
				 $data['audit_cash']=$this->_audit_cash;
			}
			if(!is_null($this->_is_auto_adjourn)){ 
				 $data['is_auto_adjourn']=$this->_is_auto_adjourn;
			}
			if(!is_null($this->_adjourn_day)){ 
				 $data['adjourn_day']=$this->_adjourn_day;
			}
			if(!is_null($this->_is_open_prom)){ 
				 $data['is_open_prom']=$this->_is_open_prom;
			}
			if(!is_null($this->_vip_task_istop)){ 
				 $data['vip_task_istop']=$this->_vip_task_istop;
			}
			if(!is_null($this->_vip_work_istop)){ 
				 $data['vip_work_istop']=$this->_vip_work_istop;
			}
			if(!is_null($this->_vip_hidden_work)){ 
				 $data['vip_hidden_work']=$this->_vip_hidden_work;
			}
			if(!is_null($this->_vip_recommend)){ 
				 $data['vip_recommend']=$this->_vip_recommend;
			}
			if(!is_null($this->_deduct_scale)){ 
				 $data['deduct_scale']=$this->_deduct_scale;
			}
			if(!is_null($this->_defeated_money)){ 
				 $data['defeated_money']=$this->_defeated_money;
			}
			if(!is_null($this->_is_comment)){ 
				 $data['is_comment']=$this->_is_comment;
			}
			if(!is_null($this->_task_min_cash)){ 
				 $data['task_min_cash']=$this->_task_min_cash;
			}
			if(!is_null($this->_vote_limit_time)){ 
				 $data['vote_limit_time']=$this->_vote_limit_time;
			}
			if(!is_null($this->_show_limit_time)){ 
				 $data['show_limit_time']=$this->_show_limit_time;
			}
			if(!is_null($this->_reg_vote_limit_time)){ 
				 $data['reg_vote_limit_time']=$this->_reg_vote_limit_time;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('xs_task_config_id' => $this->_xs_task_config_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_xs_task_config,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_xs_task_config(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_xs_task_config(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_xs_task_config(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where xs_task_config_id = $this->_xs_task_config_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>