<?php

  class Keke_witkey_service_order_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_order_id; //主键 
		 var $_shop_id; 
		 var $_sale_uid; 
		 var $_sale_username; 
		 var $_service_id; 
		 var $_service_type; 
		 var $_on_time; 
		 var $_count_cash; 
		 var $_pay_cash; 
		 var $_clr_cash; 
		 var $_title; 
		 var $_sale_status; 
		 var $_buyer_status; 
		 var $_order_status; 
		 var $_buy_username; 
		 var $_buy_uid; 
		 var $_cost_cash; 
		 var $_cost_credit; 


	    var $_replace=0;  

	    var $_where;      

	     function  keke_witkey_service_order_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_service_order";
		 }
	    

	    		function getOrder_id(){
			 return $this->_order_id ;
		}
		function getShop_id(){
			 return $this->_shop_id ;
		}
		function getSale_uid(){
			 return $this->_sale_uid ;
		}
		function getSale_username(){
			 return $this->_sale_username ;
		}
		function getService_id(){
			 return $this->_service_id ;
		}
		function getService_type(){
			 return $this->_service_type ;
		}
		function getOn_time(){
			 return $this->_on_time ;
		}
		function getCount_cash(){
			 return $this->_count_cash ;
		}
		function getPay_cash(){
			 return $this->_pay_cash ;
		}
		function getClr_cash(){
			 return $this->_clr_cash ;
		}
		function getTitle(){
			 return $this->_title ;
		}
		function getSale_status(){
			 return $this->_sale_status ;
		}
		function getBuyer_status(){
			 return $this->_buyer_status ;
		}
		function getOrder_status(){
			 return $this->_order_status ;
		}
		function getBuy_username(){
			 return $this->_buy_username ;
		}
		function getBuy_uid(){
			 return $this->_buy_uid ;
		}
		function getCost_cash(){
			 return $this->_cost_cash ;
		}
		function getCost_credit(){
			 return $this->_cost_credit ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setOrder_id($value){ 
			 $this->_order_id = $value;
		}
		function setShop_id($value){ 
			 $this->_shop_id = $value;
		}
		function setSale_uid($value){ 
			 $this->_sale_uid = $value;
		}
		function setSale_username($value){ 
			 $this->_sale_username = $value;
		}
		function setService_id($value){ 
			 $this->_service_id = $value;
		}
		function setService_type($value){ 
			 $this->_service_type = $value;
		}
		function setOn_time($value){ 
			 $this->_on_time = $value;
		}
		function setCount_cash($value){ 
			 $this->_count_cash = $value;
		}
		function setPay_cash($value){ 
			 $this->_pay_cash = $value;
		}
		function setClr_cash($value){ 
			 $this->_clr_cash = $value;
		}
		function setTitle($value){ 
			 $this->_title = $value;
		}
		function setSale_status($value){ 
			 $this->_sale_status = $value;
		}
		function setBuyer_status($value){ 
			 $this->_buyer_status = $value;
		}
		function setOrder_status($value){ 
			 $this->_order_status = $value;
		}
		function setBuy_username($value){ 
			 $this->_buy_username = $value;
		}
		function setBuy_uid($value){ 
			 $this->_buy_uid = $value;
		}
		function setCost_cash($value){ 
			 $this->_cost_cash = $value;
		}
		function setCost_credit($value){ 
			 $this->_cost_credit = $value;
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
		 * 表keke_witkey_service_order创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_service_order(){
		 		 $data =  array(); 

					if(!is_null($this->_order_id)){ 
				 $data['order_id']=$this->_order_id;
			}
			if(!is_null($this->_shop_id)){ 
				 $data['shop_id']=$this->_shop_id;
			}
			if(!is_null($this->_sale_uid)){ 
				 $data['sale_uid']=$this->_sale_uid;
			}
			if(!is_null($this->_sale_username)){ 
				 $data['sale_username']=$this->_sale_username;
			}
			if(!is_null($this->_service_id)){ 
				 $data['service_id']=$this->_service_id;
			}
			if(!is_null($this->_service_type)){ 
				 $data['service_type']=$this->_service_type;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}
			if(!is_null($this->_count_cash)){ 
				 $data['count_cash']=$this->_count_cash;
			}
			if(!is_null($this->_pay_cash)){ 
				 $data['pay_cash']=$this->_pay_cash;
			}
			if(!is_null($this->_clr_cash)){ 
				 $data['clr_cash']=$this->_clr_cash;
			}
			if(!is_null($this->_title)){ 
				 $data['title']=$this->_title;
			}
			if(!is_null($this->_sale_status)){ 
				 $data['sale_status']=$this->_sale_status;
			}
			if(!is_null($this->_buyer_status)){ 
				 $data['buyer_status']=$this->_buyer_status;
			}
			if(!is_null($this->_order_status)){ 
				 $data['order_status']=$this->_order_status;
			}
			if(!is_null($this->_buy_username)){ 
				 $data['buy_username']=$this->_buy_username;
			}
			if(!is_null($this->_buy_uid)){ 
				 $data['buy_uid']=$this->_buy_uid;
			}
			if(!is_null($this->_cost_cash)){ 
				 $data['cost_cash']=$this->_cost_cash;
			}
			if(!is_null($this->_cost_credit)){ 
				 $data['cost_credit']=$this->_cost_credit;
			}

			 return $this->_order_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_service_order的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_service_order(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_order_id)){ 
				 $data['order_id']=$this->_order_id;
			}
			if(!is_null($this->_shop_id)){ 
				 $data['shop_id']=$this->_shop_id;
			}
			if(!is_null($this->_sale_uid)){ 
				 $data['sale_uid']=$this->_sale_uid;
			}
			if(!is_null($this->_sale_username)){ 
				 $data['sale_username']=$this->_sale_username;
			}
			if(!is_null($this->_service_id)){ 
				 $data['service_id']=$this->_service_id;
			}
			if(!is_null($this->_service_type)){ 
				 $data['service_type']=$this->_service_type;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}
			if(!is_null($this->_count_cash)){ 
				 $data['count_cash']=$this->_count_cash;
			}
			if(!is_null($this->_pay_cash)){ 
				 $data['pay_cash']=$this->_pay_cash;
			}
			if(!is_null($this->_clr_cash)){ 
				 $data['clr_cash']=$this->_clr_cash;
			}
			if(!is_null($this->_title)){ 
				 $data['title']=$this->_title;
			}
			if(!is_null($this->_sale_status)){ 
				 $data['sale_status']=$this->_sale_status;
			}
			if(!is_null($this->_buyer_status)){ 
				 $data['buyer_status']=$this->_buyer_status;
			}
			if(!is_null($this->_order_status)){ 
				 $data['order_status']=$this->_order_status;
			}
			if(!is_null($this->_buy_username)){ 
				 $data['buy_username']=$this->_buy_username;
			}
			if(!is_null($this->_buy_uid)){ 
				 $data['buy_uid']=$this->_buy_uid;
			}
			if(!is_null($this->_cost_cash)){ 
				 $data['cost_cash']=$this->_cost_cash;
			}
			if(!is_null($this->_cost_credit)){ 
				 $data['cost_credit']=$this->_cost_credit;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('order_id' => $this->_order_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_service_order,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_service_order(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_service_order(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_service_order(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where order_id = $this->_order_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>