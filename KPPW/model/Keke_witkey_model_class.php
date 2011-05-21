<?php

  class Keke_witkey_model_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_model_id; //���� 
		 var $_model_code; 
		 var $_model_name; 
		 var $_model_dir; 
		 var $_model_dev; 
		 var $_model_status; 
		 var $_listorder; 
		 var $_on_time; 


	    var $_replace=0;  

	    var $_where;      

	     function  keke_witkey_model_class(){ //���췽��
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_model";
		 }
	    

	    		function getModel_id(){
			 return $this->_model_id ;
		}
		function getModel_code(){
			 return $this->_model_code ;
		}
		function getModel_name(){
			 return $this->_model_name ;
		}
		function getModel_dir(){
			 return $this->_model_dir ;
		}
		function getModel_dev(){
			 return $this->_model_dev ;
		}
		function getModel_status(){
			 return $this->_model_status ;
		}
		function getListorder(){
			 return $this->_listorder ;
		}
		function getOn_time(){
			 return $this->_on_time ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setModel_id($value){ 
			 $this->_model_id = $value;
		}
		function setModel_code($value){ 
			 $this->_model_code = $value;
		}
		function setModel_name($value){ 
			 $this->_model_name = $value;
		}
		function setModel_dir($value){ 
			 $this->_model_dir = $value;
		}
		function setModel_dev($value){ 
			 $this->_model_dev = $value;
		}
		function setModel_status($value){ 
			 $this->_model_status = $value;
		}
		function setListorder($value){ 
			 $this->_listorder = $value;
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
		 * ��keke_witkey_model����������һ����¼
		 * @return ��������ID
		 */
		function create_keke_witkey_model(){
		 		 $data =  array(); 

					if(!is_null($this->_model_id)){ 
				 $data['model_id']=$this->_model_id;
			}
			if(!is_null($this->_model_code)){ 
				 $data['model_code']=$this->_model_code;
			}
			if(!is_null($this->_model_name)){ 
				 $data['model_name']=$this->_model_name;
			}
			if(!is_null($this->_model_dir)){ 
				 $data['model_dir']=$this->_model_dir;
			}
			if(!is_null($this->_model_dev)){ 
				 $data['model_dev']=$this->_model_dev;
			}
			if(!is_null($this->_model_status)){ 
				 $data['model_status']=$this->_model_status;
			}
			if(!is_null($this->_listorder)){ 
				 $data['listorder']=$this->_listorder;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}

			 return $this->_model_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * �༭��keke_witkey_model��һ������¼
		 * @return ����Ӱ�������
		 */
		function edit_keke_witkey_model(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_model_id)){ 
				 $data['model_id']=$this->_model_id;
			}
			if(!is_null($this->_model_code)){ 
				 $data['model_code']=$this->_model_code;
			}
			if(!is_null($this->_model_name)){ 
				 $data['model_name']=$this->_model_name;
			}
			if(!is_null($this->_model_dir)){ 
				 $data['model_dir']=$this->_model_dir;
			}
			if(!is_null($this->_model_dev)){ 
				 $data['model_dev']=$this->_model_dev;
			}
			if(!is_null($this->_model_status)){ 
				 $data['model_status']=$this->_model_status;
			}
			if(!is_null($this->_listorder)){ 
				 $data['listorder']=$this->_listorder;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('model_id' => $this->_model_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * ��ѯ��keke_witkey_model,��������ʱ������������ROW���������м�¼
		 * @return ����һ��(array)��������
		 */
		function query_keke_witkey_model(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_model(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_model(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where model_id = $this->_model_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>