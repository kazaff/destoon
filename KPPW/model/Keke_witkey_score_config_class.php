<?php
  class Keke_witkey_score_config_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_login; //主键 		 var $_register; 		 var $_update_pic; 		 var $_edit_userinfo; 		 var $_edit_withdrawinfo; 		 var $_buy_vip; 		 var $_online_pay; 		 var $_withdraw; 		 var $_pub_task; 		 var $_view_task; 		 var $_collect_task; 		 var $_task_comment; 		 var $_task_apply; 		 var $_task_pubwork; 		 var $_task_bid; 		 var $_work_accept; 		 var $_view_space; 		 var $_user_mark; 		 var $_access_shop; 		 var $_buy_service; 		 var $_create_service; 		 var $_service_comment; 		 var $_create_shop; 		 var $_update_date; 
	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //查，改，删条件
	     function  keke_witkey_score_config_class(){ //构造方法			 $this->_db = new db_factory ( );			 $this->_dbop = $this->_db->create(DBTYPE);			 $this->_tablename = TABLEPRE."witkey_score_config";		 }	    
	    		function getLogin(){			 return $this->_login ;		}		function getRegister(){			 return $this->_register ;		}		function getUpdate_pic(){			 return $this->_update_pic ;		}		function getEdit_userinfo(){			 return $this->_edit_userinfo ;		}		function getEdit_withdrawinfo(){			 return $this->_edit_withdrawinfo ;		}		function getBuy_vip(){			 return $this->_buy_vip ;		}		function getOnline_pay(){			 return $this->_online_pay ;		}		function getWithdraw(){			 return $this->_withdraw ;		}		function getPub_task(){			 return $this->_pub_task ;		}		function getView_task(){			 return $this->_view_task ;		}		function getCollect_task(){			 return $this->_collect_task ;		}		function getTask_comment(){			 return $this->_task_comment ;		}		function getTask_apply(){			 return $this->_task_apply ;		}		function getTask_pubwork(){			 return $this->_task_pubwork ;		}		function getTask_bid(){			 return $this->_task_bid ;		}		function getWork_accept(){			 return $this->_work_accept ;		}		function getView_space(){			 return $this->_view_space ;		}		function getUser_mark(){			 return $this->_user_mark ;		}		function getAccess_shop(){			 return $this->_access_shop ;		}		function getBuy_service(){			 return $this->_buy_service ;		}		function getCreate_service(){			 return $this->_create_service ;		}		function getService_comment(){			 return $this->_service_comment ;		}		function getCreate_shop(){			 return $this->_create_shop ;		}		function getUpdate_date(){			 return $this->_update_date ;		}		function getWhere(){			 return $this->_where ;		}
	    		function setLogin($value){ 			 $this->_login = $value;		}		function setRegister($value){ 			 $this->_register = $value;		}		function setUpdate_pic($value){ 			 $this->_update_pic = $value;		}		function setEdit_userinfo($value){ 			 $this->_edit_userinfo = $value;		}		function setEdit_withdrawinfo($value){ 			 $this->_edit_withdrawinfo = $value;		}		function setBuy_vip($value){ 			 $this->_buy_vip = $value;		}		function setOnline_pay($value){ 			 $this->_online_pay = $value;		}		function setWithdraw($value){ 			 $this->_withdraw = $value;		}		function setPub_task($value){ 			 $this->_pub_task = $value;		}		function setView_task($value){ 			 $this->_view_task = $value;		}		function setCollect_task($value){ 			 $this->_collect_task = $value;		}		function setTask_comment($value){ 			 $this->_task_comment = $value;		}		function setTask_apply($value){ 			 $this->_task_apply = $value;		}		function setTask_pubwork($value){ 			 $this->_task_pubwork = $value;		}		function setTask_bid($value){ 			 $this->_task_bid = $value;		}		function setWork_accept($value){ 			 $this->_work_accept = $value;		}		function setView_space($value){ 			 $this->_view_space = $value;		}		function setUser_mark($value){ 			 $this->_user_mark = $value;		}		function setAccess_shop($value){ 			 $this->_access_shop = $value;		}		function setBuy_service($value){ 			 $this->_buy_service = $value;		}		function setCreate_service($value){ 			 $this->_create_service = $value;		}		function setService_comment($value){ 			 $this->_service_comment = $value;		}		function setCreate_shop($value){ 			 $this->_create_shop = $value;		}		function setUpdate_date($value){ 			 $this->_update_date = $value;		}		function setWhere($value){ 			 $this->_where = $value;		}
	    
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
    	
	    /**		 * 表keke_witkey_score_config创建或新增一条记录		 * @return 返回新增ID		 */		function create_keke_witkey_score_config(){		 		 $data =  array(); 					if(!is_null($this->_login)){ 				 $data['login']=$this->_login;			}			if(!is_null($this->_register)){ 				 $data['register']=$this->_register;			}			if(!is_null($this->_update_pic)){ 				 $data['update_pic']=$this->_update_pic;			}			if(!is_null($this->_edit_userinfo)){ 				 $data['edit_userinfo']=$this->_edit_userinfo;			}			if(!is_null($this->_edit_withdrawinfo)){ 				 $data['edit_withdrawinfo']=$this->_edit_withdrawinfo;			}			if(!is_null($this->_buy_vip)){ 				 $data['buy_vip']=$this->_buy_vip;			}			if(!is_null($this->_online_pay)){ 				 $data['online_pay']=$this->_online_pay;			}			if(!is_null($this->_withdraw)){ 				 $data['withdraw']=$this->_withdraw;			}			if(!is_null($this->_pub_task)){ 				 $data['pub_task']=$this->_pub_task;			}			if(!is_null($this->_view_task)){ 				 $data['view_task']=$this->_view_task;			}			if(!is_null($this->_collect_task)){ 				 $data['collect_task']=$this->_collect_task;			}			if(!is_null($this->_task_comment)){ 				 $data['task_comment']=$this->_task_comment;			}			if(!is_null($this->_task_apply)){ 				 $data['task_apply']=$this->_task_apply;			}			if(!is_null($this->_task_pubwork)){ 				 $data['task_pubwork']=$this->_task_pubwork;			}			if(!is_null($this->_task_bid)){ 				 $data['task_bid']=$this->_task_bid;			}			if(!is_null($this->_work_accept)){ 				 $data['work_accept']=$this->_work_accept;			}			if(!is_null($this->_view_space)){ 				 $data['view_space']=$this->_view_space;			}			if(!is_null($this->_user_mark)){ 				 $data['user_mark']=$this->_user_mark;			}			if(!is_null($this->_access_shop)){ 				 $data['access_shop']=$this->_access_shop;			}			if(!is_null($this->_buy_service)){ 				 $data['buy_service']=$this->_buy_service;			}			if(!is_null($this->_create_service)){ 				 $data['create_service']=$this->_create_service;			}			if(!is_null($this->_service_comment)){ 				 $data['service_comment']=$this->_service_comment;			}			if(!is_null($this->_create_shop)){ 				 $data['create_shop']=$this->_create_shop;			}			if(!is_null($this->_update_date)){ 				 $data['update_date']=$this->_update_date;			}			 return $this->_login = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 		 } 
	    /**		 * 编辑表keke_witkey_score_config的一个条记录		 * @return 返回影响的行数		 */		function edit_keke_witkey_score_config(){ 		 		 $data =  array();  					if(!is_null($this->_login)){ 				 $data['login']=$this->_login;			}			if(!is_null($this->_register)){ 				 $data['register']=$this->_register;			}			if(!is_null($this->_update_pic)){ 				 $data['update_pic']=$this->_update_pic;			}			if(!is_null($this->_edit_userinfo)){ 				 $data['edit_userinfo']=$this->_edit_userinfo;			}			if(!is_null($this->_edit_withdrawinfo)){ 				 $data['edit_withdrawinfo']=$this->_edit_withdrawinfo;			}			if(!is_null($this->_buy_vip)){ 				 $data['buy_vip']=$this->_buy_vip;			}			if(!is_null($this->_online_pay)){ 				 $data['online_pay']=$this->_online_pay;			}			if(!is_null($this->_withdraw)){ 				 $data['withdraw']=$this->_withdraw;			}			if(!is_null($this->_pub_task)){ 				 $data['pub_task']=$this->_pub_task;			}			if(!is_null($this->_view_task)){ 				 $data['view_task']=$this->_view_task;			}			if(!is_null($this->_collect_task)){ 				 $data['collect_task']=$this->_collect_task;			}			if(!is_null($this->_task_comment)){ 				 $data['task_comment']=$this->_task_comment;			}			if(!is_null($this->_task_apply)){ 				 $data['task_apply']=$this->_task_apply;			}			if(!is_null($this->_task_pubwork)){ 				 $data['task_pubwork']=$this->_task_pubwork;			}			if(!is_null($this->_task_bid)){ 				 $data['task_bid']=$this->_task_bid;			}			if(!is_null($this->_work_accept)){ 				 $data['work_accept']=$this->_work_accept;			}			if(!is_null($this->_view_space)){ 				 $data['view_space']=$this->_view_space;			}			if(!is_null($this->_user_mark)){ 				 $data['user_mark']=$this->_user_mark;			}			if(!is_null($this->_access_shop)){ 				 $data['access_shop']=$this->_access_shop;			}			if(!is_null($this->_buy_service)){ 				 $data['buy_service']=$this->_buy_service;			}			if(!is_null($this->_create_service)){ 				 $data['create_service']=$this->_create_service;			}			if(!is_null($this->_service_comment)){ 				 $data['service_comment']=$this->_service_comment;			}			if(!is_null($this->_create_shop)){ 				 $data['create_shop']=$this->_create_shop;			}			if(!is_null($this->_update_date)){ 				 $data['update_date']=$this->_update_date;			}			if($this->_where){ 				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 			 } 			 else{ 				 $where = array('login' => $this->_login); 				 return $this->_db->updatetable($this->_tablename,$data,$where); 			} 		 } 
	    /**		 * 查询表keke_witkey_score_config,当有条件时返回有条件的ROW，否则返所有记录		 * @return 返回一个(array)关联数组		 */		function query_keke_witkey_score_config(){ 			 if($this->_where){ 				 $sql = "select * from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select * from $this->_tablename"; 			 } 			 $this->_where = "";			 return $this->_dbop->query($sql); 		 } 
	    		function count_keke_witkey_score_config(){ 			 if($this->_where){ 				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "select count(*) as count from $this->_tablename"; 			 } 			 $this->_where = ""; 			 return $this->_dbop->getCount($sql); 		 } 
	    		function del_keke_witkey_score_config(){ 			 if($this->_where){ 				 $sql = "delete from $this->_tablename where ".$this->_where; 			 } 			 else{ 				 $sql = "delete from $this->_tablename where login = $this->_login "; 			 } 			 $this->_where = ""; 			 return $this->_dbop->execute($sql); 		 } 
	   
	    
	    
   }
 ?>