<?php

  class Keke_witkey_realname_auth_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_realname_a_id; //主键 
		 var $_uid; 
		 var $_username; 
		 var $_realname; 
		 var $_id_card; 
		 var $_id_pic; 
		 var $_cash; 
		 var $_start_time; 
		 var $_end_time; 
		 var $_auth_status; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_realname_auth_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_realname_auth";
		 }
	    

	    		function getRealname_a_id(){
			 return $this->_realname_a_id ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getRealname(){
			 return $this->_realname ;
		}
		function getId_card(){
			 return $this->_id_card ;
		}
		function getId_pic(){
			 return $this->_id_pic ;
		}
		function getCash(){
			 return $this->_cash ;
		}
		function getStart_time(){
			 return $this->_start_time ;
		}
		function getEnd_time(){
			 return $this->_end_time ;
		}
		function getAuth_status(){
			 return $this->_auth_status ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setRealname_a_id($value){ 
			 $this->_realname_a_id = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setRealname($value){ 
			 $this->_realname = $value;
		}
		function setId_card($value){ 
			 $this->_id_card = $value;
		}
		function setId_pic($value){ 
			 $this->_id_pic = $value;
		}
		function setCash($value){ 
			 $this->_cash = $value;
		}
		function setStart_time($value){ 
			 $this->_start_time = $value;
		}
		function setEnd_time($value){ 
			 $this->_end_time = $value;
		}
		function setAuth_status($value){ 
			 $this->_auth_status = $value;
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
		 * 表keke_witkey_realname_auth创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_realname_auth(){
		 		 $data =  array(); 

					if(!is_null($this->_realname_a_id)){ 
				 $data['realname_a_id']=$this->_realname_a_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_realname)){ 
				 $data['realname']=$this->_realname;
			}
			if(!is_null($this->_id_card)){ 
				 $data['id_card']=$this->_id_card;
			}
			if(!is_null($this->_id_pic)){ 
				 $data['id_pic']=$this->_id_pic;
			}
			if(!is_null($this->_cash)){ 
				 $data['cash']=$this->_cash;
			}
			if(!is_null($this->_start_time)){ 
				 $data['start_time']=$this->_start_time;
			}
			if(!is_null($this->_end_time)){ 
				 $data['end_time']=$this->_end_time;
			}
			if(!is_null($this->_auth_status)){ 
				 $data['auth_status']=$this->_auth_status;
			}

			 return $this->_realname_a_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_realname_auth的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_realname_auth(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_realname_a_id)){ 
				 $data['realname_a_id']=$this->_realname_a_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_realname)){ 
				 $data['realname']=$this->_realname;
			}
			if(!is_null($this->_id_card)){ 
				 $data['id_card']=$this->_id_card;
			}
			if(!is_null($this->_id_pic)){ 
				 $data['id_pic']=$this->_id_pic;
			}
			if(!is_null($this->_cash)){ 
				 $data['cash']=$this->_cash;
			}
			if(!is_null($this->_start_time)){ 
				 $data['start_time']=$this->_start_time;
			}
			if(!is_null($this->_end_time)){ 
				 $data['end_time']=$this->_end_time;
			}
			if(!is_null($this->_auth_status)){ 
				 $data['auth_status']=$this->_auth_status;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('realname_a_id' => $this->_realname_a_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_realname_auth,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_realname_auth(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_realname_auth(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_realname_auth(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where realname_a_id = $this->_realname_a_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>