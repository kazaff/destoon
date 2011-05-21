<?php

class Time_fac_class {
	var $_basic_config;
	
	function __construct() {
		global $basic_config;
		$this->_basic_config = $basic_config ? $basic_config : Cache_ext_Class::getConfig ( 'basic' );
	
	}
	
	function __destruct() {
	
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
	
	function run() {
		global $model_list;
		$model_list = $model_list ? $model_list : Cache_ext_Class::gettabledata ( 'witkey_model', 'model_status=1', '', null, 'model_id' );
		
		$this->validuservip ();
		
		foreach ( $model_list as $model_info ) {
			$model_dir = $model_info ['model_dir'];
			if (file_exists ( S_ROOT . "./task/$model_dir" ))
				$m = ucwords ( $model_dir ) . "_time_class";
			if (class_exists ( $m )) {
				$time_obj = new $m ( );
				$time_obj->validmarkstatus ();
				$time_obj->validtaskstatus ();
			}
		}
	}
	
	function validuservip($uid = 0, $uinfo = array()) {
		$user_obj = new Keke_witkey_space_class ( );
		
		if ($uinfo) {
			$uid = $uinfo ['uid'];
		}
		if ($uid && ! $uinfo) {
			$uinfo = Func_comm_class::getuserinfo ( $uid );
		}
		
		if ($uid) {
			if ($uinfo ['isvip'] && $uinfo ['vip_end_time'] <= time ()) {
				$user_obj->setWhere ( "uid='$uid'" );
				$user_obj->setIsvip ( 0 );
				//事件通知
				Func_comm_class::notify_user ( 'vip过期', '您的vip已过期', $uid, $username );
			}
		} else {
			$user_obj->setWhere ( "isvip>0 and vip_end_time<=" . time () );
			$temp_arr = $user_obj->query_keke_witkey_space ();
			$uids = array ();
			foreach ( $temp_arr as $t ) {
				$uids = $t ['uid'];
				Func_comm_class::notify_user ( 'vip已过期', '您的vip已过期', $t ['uid'], $t ['username'] );
			}
			$user_obj->setWhere ( "isvip>0 and vip_end_time<=" . time () );
			$user_obj->setIsvip ( 0 );
			$user_obj->edit_keke_witkey_space ();
		}
	}

}

?>