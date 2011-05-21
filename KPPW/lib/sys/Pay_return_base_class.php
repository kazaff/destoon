<?php
 
abstract  class Pay_return_base_class {
	var $_basic_config;
	var $_uid;
    var $_username;
	var $_order_type;
	var $_order_id;
	var $_total_fee;
	var $_obj_id;
	var $_pay_m;
    var $_userinfo;
	function __construct() {
		 global $basic_config;
 	     $this->_basic_config = $basic_config;
	}
	public function __set($property_name, $value) {
		$this->$property_name = $value;
	}
	
	public function __get($property_name) {
		if (isset ( $this->$property_name )) {
			return $this->$property_name;
		} else {
			return null;
		}
	}
	
	
	abstract function task_charge();
	abstract function delay_charge();
	
	
	
 

 
}
