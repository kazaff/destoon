<?php

  class Keke_witkey_enterprise_auth_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_enterprise_auth_id; //���� 
		 var $_uid; 
		 var $_username; 
		 var $_licen_num; 
		 var $_licen_pic; 
		 var $_cash; 
		 var $_start_time; 
		 var $_end_time; 
		 var $_auth_status; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //�飬�ģ�ɾ����

	     function  keke_witkey_enterprise_auth_class(){ //���췽��
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_enterprise_auth";
		 }
	    

	    		function getEnterprise_auth_id(){
			 return $this->_enterprise_auth_id ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getLicen_num(){
			 return $this->_licen_num ;
		}
		function getLicen_pic(){
			 return $this->_licen_pic ;
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


	    		function setEnterprise_auth_id($value){ 
			 $this->_enterprise_auth_id = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setLicen_num($value){ 
			 $this->_licen_num = $value;
		}
		function setLicen_pic($value){ 
			 $this->_licen_pic = $value;
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
		 * ��keke_witkey_enterprise_auth����������һ����¼
		 * @return ��������ID
		 */
		function create_keke_witkey_enterprise_auth(){
		 		 $data =  array(); 

					if(!is_null($this->_enterprise_auth_id)){ 
				 $data['enterprise_auth_id']=$this->_enterprise_auth_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_licen_num)){ 
				 $data['licen_num']=$this->_licen_num;
			}
			if(!is_null($this->_licen_pic)){ 
				 $data['licen_pic']=$this->_licen_pic;
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

			 return $this->_enterprise_auth_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * �༭��keke_witkey_enterprise_auth��һ������¼
		 * @return ����Ӱ�������
		 */
		function edit_keke_witkey_enterprise_auth(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_enterprise_auth_id)){ 
				 $data['enterprise_auth_id']=$this->_enterprise_auth_id;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_licen_num)){ 
				 $data['licen_num']=$this->_licen_num;
			}
			if(!is_null($this->_licen_pic)){ 
				 $data['licen_pic']=$this->_licen_pic;
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
				 $where = array('enterprise_auth_id' => $this->_enterprise_auth_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * ��ѯ��keke_witkey_enterprise_auth,��������ʱ������������ROW���������м�¼
		 * @return ����һ��(array)��������
		 */
		function query_keke_witkey_enterprise_auth(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_enterprise_auth(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_enterprise_auth(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where enterprise_auth_id = $this->_enterprise_auth_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>