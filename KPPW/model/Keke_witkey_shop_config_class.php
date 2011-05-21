<?php

  class Keke_witkey_shop_config_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_config_id; //主键 
		 var $_service_prorate; 
		 var $_down_prorate; 
		 var $_service_min_amount; 
		 var $_step_min_amount; 
		 var $_shop_is_close; 
		 var $_on_date; 


	    var $_replace=0;  

	    var $_where;      

	     function  keke_witkey_shop_config_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_shop_config";
		 }
	    

	    		function getConfig_id(){
			 return $this->_config_id ;
		}
		function getService_prorate(){
			 return $this->_service_prorate ;
		}
		function getDown_prorate(){
			 return $this->_down_prorate ;
		}
		function getService_min_amount(){
			 return $this->_service_min_amount ;
		}
		function getStep_min_amount(){
			 return $this->_step_min_amount ;
		}
		function getShop_is_close(){
			 return $this->_shop_is_close ;
		}
		function getOn_date(){
			 return $this->_on_date ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setConfig_id($value){ 
			 $this->_config_id = $value;
		}
		function setService_prorate($value){ 
			 $this->_service_prorate = $value;
		}
		function setDown_prorate($value){ 
			 $this->_down_prorate = $value;
		}
		function setService_min_amount($value){ 
			 $this->_service_min_amount = $value;
		}
		function setStep_min_amount($value){ 
			 $this->_step_min_amount = $value;
		}
		function setShop_is_close($value){ 
			 $this->_shop_is_close = $value;
		}
		function setOn_date($value){ 
			 $this->_on_date = $value;
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
		 * 表keke_witkey_shop_config创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_shop_config(){
		 		 $data =  array(); 

					if(!is_null($this->_config_id)){ 
				 $data['config_id']=$this->_config_id;
			}
			if(!is_null($this->_service_prorate)){ 
				 $data['service_prorate']=$this->_service_prorate;
			}
			if(!is_null($this->_down_prorate)){ 
				 $data['down_prorate']=$this->_down_prorate;
			}
			if(!is_null($this->_service_min_amount)){ 
				 $data['service_min_amount']=$this->_service_min_amount;
			}
			if(!is_null($this->_step_min_amount)){ 
				 $data['step_min_amount']=$this->_step_min_amount;
			}
			if(!is_null($this->_shop_is_close)){ 
				 $data['shop_is_close']=$this->_shop_is_close;
			}
			if(!is_null($this->_on_date)){ 
				 $data['on_date']=$this->_on_date;
			}

			 return $this->_config_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_shop_config的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_shop_config(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_config_id)){ 
				 $data['config_id']=$this->_config_id;
			}
			if(!is_null($this->_service_prorate)){ 
				 $data['service_prorate']=$this->_service_prorate;
			}
			if(!is_null($this->_down_prorate)){ 
				 $data['down_prorate']=$this->_down_prorate;
			}
			if(!is_null($this->_service_min_amount)){ 
				 $data['service_min_amount']=$this->_service_min_amount;
			}
			if(!is_null($this->_step_min_amount)){ 
				 $data['step_min_amount']=$this->_step_min_amount;
			}
			if(!is_null($this->_shop_is_close)){ 
				 $data['shop_is_close']=$this->_shop_is_close;
			}
			if(!is_null($this->_on_date)){ 
				 $data['on_date']=$this->_on_date;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('config_id' => $this->_config_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_shop_config,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_shop_config(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_shop_config(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_shop_config(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where config_id = $this->_config_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>