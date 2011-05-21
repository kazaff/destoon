<?php

 

class Syn_interface_class {
	
 
	static function getuserinfo($username, $isuid) {
		global $_UC, $basic_config;
		if ($basic_config ['user_intergration'] == 1) {
			return Func_comm_class::getuserinfo ( $username, ! $isuid );
			;
		} elseif ($basic_config ['user_intergration'] == 2) {
			require_once S_ROOT . './keke_client/ucenter/client.php';
			$uc_info = uc_get_user ( $username, $isuid );
			return $uc_info;
		}
	
	}
	
	static function user_register($username, $password, $email) {
		global $_UC, $basic_config;
		if ($basic_config ['user_intergration'] == 1) {
			$member_obj = new Keke_witkey_member_class ( );
			$member_obj->setEmail ( $email );
			$member_obj->setUsername ( $username );
			$member_obj->setPassword ( md5 ( $password ) );
			$res_uid = $member_obj->create_keke_witkey_member ();
			$space_obj = new Keke_witkey_space_class ( );
			$space_obj->setUid ( $res_uid );
			$space_obj->setUsername ( $username );
			$space_obj->setPassword ( md5 ( $password ) );
			$space_obj->setEmail ( $email );
			$space_obj->setReg_time ( time () );
			$space_obj->setReg_ip ( Func_comm_class::getIP () );
			$res_space_id = $space_obj->create_keke_witkey_space ();
			if ($res_uid && $res_space_id) {
				return array ('uid' => $res_uid, 'username' => $username, 'email' => $email );
			} else {
				return array ();
			}
		
		} elseif ($basic_config ['user_intergration'] == 2) {
			require_once S_ROOT . './keke_client/ucenter/client.php';
			$reg_uid = uc_user_register ( $username, $password, $email );
			if ($reg_uid > 0) {
				$member_obj = new Keke_witkey_member_class ( );
				$member_obj->setUid ( $reg_uid );
				$member_obj->setEmail ( $email );
				$member_obj->setUsername ( $username );
				$member_obj->setPassword ( md5 ( $password ) );
				$res_uid = $member_obj->create_keke_witkey_member ();
				
				$space_obj = new Keke_witkey_space_class ( );
				$space_obj->setUid ( $res_uid );
				$space_obj->setUsername ( $username );
				$space_obj->setPassword ( md5 ( $password ) );
				$space_obj->setEmail ( $email );
				$space_obj->setReg_time ( time () );
				$space_obj->setReg_ip ( Func_comm_class::getIP () );
				$res_space_id = $space_obj->create_keke_witkey_space ();
				
				return array ('uid' => $res_uid, 'username' => $username, 'email' => $email );
			} else {
				return array ();
			}
		}
	}
	
	static function user_login($username, $password) {
		global $_UC, $basic_config;
		$member_obj = new Keke_witkey_member_class ( );
		$member_obj->setWhere ( "username='$username'" );
		$user_arr = $member_obj->query_keke_witkey_member ();
		$user_arr = $user_arr [0];
		
		if ($basic_config ['user_intergration'] == 1) {
			return $user_arr ['password'] == md5 ( $password ) ? array('0'=>$user_arr['uid'],'1'=>$user_arr['username']) : array ();
		} elseif ($basic_config ['user_intergration'] == 2) {
			require_once S_ROOT . './keke_client/ucenter/client.php';
			$uc_uid = uc_user_login ( $username, $password );
			$uc_uid = $uc_uid [0];
			$userinfo = uc_get_user ($username);
			
			
		 
			if (! $user_arr) {
				if ($uc_uid > 0) {
					$member_obj = new Keke_witkey_member_class ( );
					$member_obj->setUid ( $uc_uid );
					$member_obj->setEmail ( $userinfo ['2'] );
					$member_obj->setUsername ( $username );
					$member_obj->setPassword ( md5 ( $password ) );
					$res_uid = $member_obj->create_keke_witkey_member ();
					
					$space_obj = new Keke_witkey_space_class ( );
					$space_obj->setUid ( $uc_uid );
					$space_obj->setUsername ( $username );
					$space_obj->setPassword ( md5 ( $password ) );
					$space_obj->setEmail ( $userinfo ['2'] );
					$space_obj->setReg_time ( time () );
					$space_obj->setReg_ip ( Func_comm_class::getIP () );
					$res_space_id = $space_obj->create_keke_witkey_space ();
				}
				
				return $uc_uid > 0 ?$userinfo: 0;
			} else {
				return $uc_uid >0 ?$userinfo:0;
			}
		
		}
	
	}
	
	static function user_edit($username, $oldpwd, $newpwd, $email,$nocheckold=1) {
		global $_UC, $basic_config;
		if ($basic_config ['user_intergration'] == 1) {
			return 1;
		}
		if ($basic_config ['user_intergration'] == 2) {
			require_once S_ROOT . './keke_client/ucenter/client.php';
			return uc_user_edit ( $username, $oldpwd, $newpwd, $email, $nocheckold );
		}
		
	}
	
	static function user_delete($username) {
		global $_UC, $basic_config;
		if ($basic_config ['user_intergration'] == 2) {
			require_once S_ROOT . './keke_client/ucenter/client.php';
			uc_user_delete ( $username );
		}
	}
	
	static function user_synlogin($uid) {
		global $_UC, $basic_config;
		if ($basic_config ['user_intergration'] == 2) {
			require_once S_ROOT . './keke_client/ucenter/client.php';
			return uc_user_synlogin ( $uid );
		}
	}
	
	static function user_synlogout() {
		global $_UC, $basic_config;
		
		if ($basic_config ['user_intergration'] == 2) {
			require_once S_ROOT . './keke_client/ucenter/client.php';
			return uc_user_synlogout ();
		}
	}
	
	static function user_checkemail($email) {
		global $_UC, $basic_config;
		if ($basic_config ['user_intergration'] == 1) {
			$member_obj = new Keke_witkey_member_class ( );
			$member_obj->setWhere ( 'email="' . $email . '"' );
			$res = $member_obj->count_keke_witkey_member ();
			$res = $res?0:1;
		} elseif ($basic_config ['user_intergration'] == 2) {
			require_once S_ROOT . './keke_client/ucenter/client.php';
			$res = uc_user_checkemail( $email );
			$res = $res >0?1:0;
			
		}
		return $res;
	}
	
	static function user_checkname($username) {
		global $_UC, $basic_config;
		if ($basic_config ['user_intergration'] == 1) {
			$member_obj = new Keke_witkey_member_class ( );
			$member_obj->setWhere ( 'username="' . $username . '"' );
			$res = $member_obj->count_keke_witkey_member ();
			$res = $res?0:1;
		} elseif ($basic_config ['user_intergration'] == 2) {
			require_once S_ROOT . './keke_client/ucenter/client.php';
			$res = uc_user_checkname ( $username );
			$res = $res > 0 ?1:0;
		}
		return $res;
	
	}
	
	static function user_getprotected() {
		global $_UC, $basic_config;
		if ($basic_config_info ['ban_users']) {
			$limit_username = explode ( ',', $basic_config_info ['ban_users'] );
		}
		
		if ($basic_config ['user_intergration'] == 1) {
			return $limit_username;
		} elseif ($basic_config ['user_intergration'] == 2) {
			require_once S_ROOT . './keke_client/ucenter/client.php';
			$limit_username = $limit_username ? $limit_username : array ();
			uc_user_getprotected ();
			
			return array_merge ( uc_user_getprotected (), $limit_username );
		}
	
	}

}