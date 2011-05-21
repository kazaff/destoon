<?php

  class Keke_witkey_shop_menu_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_menu_id; //主键 
		 var $_shop_id; 
		 var $_menu_type; 
		 var $_menu_1; 
		 var $_menu_2; 
		 var $_menu_3; 
		 var $_menu_4; 
		 var $_menu_5; 
		 var $_list_order; 
		 var $_uid; 
		 var $_username; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_shop_menu_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_shop_menu";
		 }
	    

	    		function getMenu_id(){
			 return $this->_menu_id ;
		}
		function getShop_id(){
			 return $this->_shop_id ;
		}
		function getMenu_type(){
			 return $this->_menu_type ;
		}
		function getMenu_1(){
			 return $this->_menu_1 ;
		}
		function getMenu_2(){
			 return $this->_menu_2 ;
		}
		function getMenu_3(){
			 return $this->_menu_3 ;
		}
		function getMenu_4(){
			 return $this->_menu_4 ;
		}
		function getMenu_5(){
			 return $this->_menu_5 ;
		}
		function getList_order(){
			 return $this->_list_order ;
		}
		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setMenu_id($value){ 
			 $this->_menu_id = $value;
		}
		function setShop_id($value){ 
			 $this->_shop_id = $value;
		}
		function setMenu_type($value){ 
			 $this->_menu_type = $value;
		}
		function setMenu_1($value){ 
			 $this->_menu_1 = $value;
		}
		function setMenu_2($value){ 
			 $this->_menu_2 = $value;
		}
		function setMenu_3($value){ 
			 $this->_menu_3 = $value;
		}
		function setMenu_4($value){ 
			 $this->_menu_4 = $value;
		}
		function setMenu_5($value){ 
			 $this->_menu_5 = $value;
		}
		function setList_order($value){ 
			 $this->_list_order = $value;
		}
		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
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
		 * 表keke_witkey_shop_menu创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_shop_menu(){
		 		 $data =  array(); 

					if(!is_null($this->_menu_id)){ 
				 $data['menu_id']=$this->_menu_id;
			}
			if(!is_null($this->_shop_id)){ 
				 $data['shop_id']=$this->_shop_id;
			}
			if(!is_null($this->_menu_type)){ 
				 $data['menu_type']=$this->_menu_type;
			}
			if(!is_null($this->_menu_1)){ 
				 $data['menu_1']=$this->_menu_1;
			}
			if(!is_null($this->_menu_2)){ 
				 $data['menu_2']=$this->_menu_2;
			}
			if(!is_null($this->_menu_3)){ 
				 $data['menu_3']=$this->_menu_3;
			}
			if(!is_null($this->_menu_4)){ 
				 $data['menu_4']=$this->_menu_4;
			}
			if(!is_null($this->_menu_5)){ 
				 $data['menu_5']=$this->_menu_5;
			}
			if(!is_null($this->_list_order)){ 
				 $data['list_order']=$this->_list_order;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}

			 return $this->_menu_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_shop_menu的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_shop_menu(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_menu_id)){ 
				 $data['menu_id']=$this->_menu_id;
			}
			if(!is_null($this->_shop_id)){ 
				 $data['shop_id']=$this->_shop_id;
			}
			if(!is_null($this->_menu_type)){ 
				 $data['menu_type']=$this->_menu_type;
			}
			if(!is_null($this->_menu_1)){ 
				 $data['menu_1']=$this->_menu_1;
			}
			if(!is_null($this->_menu_2)){ 
				 $data['menu_2']=$this->_menu_2;
			}
			if(!is_null($this->_menu_3)){ 
				 $data['menu_3']=$this->_menu_3;
			}
			if(!is_null($this->_menu_4)){ 
				 $data['menu_4']=$this->_menu_4;
			}
			if(!is_null($this->_menu_5)){ 
				 $data['menu_5']=$this->_menu_5;
			}
			if(!is_null($this->_list_order)){ 
				 $data['list_order']=$this->_list_order;
			}
			if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('menu_id' => $this->_menu_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_shop_menu,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_shop_menu(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_shop_menu(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_shop_menu(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where menu_id = $this->_menu_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>