<?php

  class Keke_witkey_space_class{

        var $_db;

        var $_tablename;

	    var $_dbop;

	    	 var $_uid; //主键 
		 var $_username; 
		 var $_password; 
		 var $_email; 
		 var $_user_pic; 
		 var $_group_id; 
		 var $_isvip; 
		 var $_status; 
		 var $_user_type; 
		 var $_sex; 
		 var $_marry; 
		 var $_hometown; 
		 var $_residency; 
		 var $_address; 
		 var $_birthday; 
		 var $_truename; 
		 var $_idcard; 
		 var $_idpic; 
		 var $_qq; 
		 var $_msn; 
		 var $_fax; 
		 var $_phone; 
		 var $_mobile; 
		 var $_indus_id; 
		 var $_skill_ids; 
		 var $_summary; 
		 var $_experience; 
		 var $_reg_time; 
		 var $_reg_ip; 
		 var $_domain; 
		 var $_credit; 
		 var $_balance; 
		 var $_balance_status; 
		 var $_is_auth; 
		 var $_auth_name; 
		 var $_auth_time; 
		 var $_pub_num; 
		 var $_take_num; 
		 var $_nominate_num; 
		 var $_accepted_num; 
		 var $_vip_start_time; 
		 var $_vip_end_time; 
		 var $_pay_zfb; 
		 var $_pay_cft; 
		 var $_pay_bank; 
		 var $_experience_value; 
		 var $_g_m_credit_value; 
		 var $_w_m_credit_value; 
		 var $_seller_good_rate; 
		 var $_buyer_good_rate; 
		 var $_studio_id; 
		 var $_realname_auth; 
		 var $_enterprise_auth; 
		 var $_email_auth; 
		 var $_bank_auth; 
		 var $_last_login_time; 


	    var $_replace=0; //insert into or replace into ?

	    var $_where;     //查，改，删条件

	     function  keke_witkey_space_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_space";
		 }
	    

	    		function getUid(){
			 return $this->_uid ;
		}
		function getUsername(){
			 return $this->_username ;
		}
		function getPassword(){
			 return $this->_password ;
		}
		function getEmail(){
			 return $this->_email ;
		}
		function getUser_pic(){
			 return $this->_user_pic ;
		}
		function getGroup_id(){
			 return $this->_group_id ;
		}
		function getIsvip(){
			 return $this->_isvip ;
		}
		function getStatus(){
			 return $this->_status ;
		}
		function getUser_type(){
			 return $this->_user_type ;
		}
		function getSex(){
			 return $this->_sex ;
		}
		function getMarry(){
			 return $this->_marry ;
		}
		function getHometown(){
			 return $this->_hometown ;
		}
		function getResidency(){
			 return $this->_residency ;
		}
		function getAddress(){
			 return $this->_address ;
		}
		function getBirthday(){
			 return $this->_birthday ;
		}
		function getTruename(){
			 return $this->_truename ;
		}
		function getIdcard(){
			 return $this->_idcard ;
		}
		function getIdpic(){
			 return $this->_idpic ;
		}
		function getQq(){
			 return $this->_qq ;
		}
		function getMsn(){
			 return $this->_msn ;
		}
		function getFax(){
			 return $this->_fax ;
		}
		function getPhone(){
			 return $this->_phone ;
		}
		function getMobile(){
			 return $this->_mobile ;
		}
		function getIndus_id(){
			 return $this->_indus_id ;
		}
		function getSkill_ids(){
			 return $this->_skill_ids ;
		}
		function getSummary(){
			 return $this->_summary ;
		}
		function getExperience(){
			 return $this->_experience ;
		}
		function getReg_time(){
			 return $this->_reg_time ;
		}
		function getReg_ip(){
			 return $this->_reg_ip ;
		}
		function getDomain(){
			 return $this->_domain ;
		}
		function getCredit(){
			 return $this->_credit ;
		}
		function getBalance(){
			 return $this->_balance ;
		}
		function getBalance_status(){
			 return $this->_balance_status ;
		}
		function getIs_auth(){
			 return $this->_is_auth ;
		}
		function getAuth_name(){
			 return $this->_auth_name ;
		}
		function getAuth_time(){
			 return $this->_auth_time ;
		}
		function getPub_num(){
			 return $this->_pub_num ;
		}
		function getTake_num(){
			 return $this->_take_num ;
		}
		function getNominate_num(){
			 return $this->_nominate_num ;
		}
		function getAccepted_num(){
			 return $this->_accepted_num ;
		}
		function getVip_start_time(){
			 return $this->_vip_start_time ;
		}
		function getVip_end_time(){
			 return $this->_vip_end_time ;
		}
		function getPay_zfb(){
			 return $this->_pay_zfb ;
		}
		function getPay_cft(){
			 return $this->_pay_cft ;
		}
		function getPay_bank(){
			 return $this->_pay_bank ;
		}
		function getExperience_value(){
			 return $this->_experience_value ;
		}
		function getG_m_credit_value(){
			 return $this->_g_m_credit_value ;
		}
		function getW_m_credit_value(){
			 return $this->_w_m_credit_value ;
		}
		function getSeller_good_rate(){
			 return $this->_seller_good_rate ;
		}
		function getBuyer_good_rate(){
			 return $this->_buyer_good_rate ;
		}
		function getStudio_id(){
			 return $this->_studio_id ;
		}
		function getRealname_auth(){
			 return $this->_realname_auth ;
		}
		function getEnterprise_auth(){
			 return $this->_enterprise_auth ;
		}
		function getEmail_auth(){
			 return $this->_email_auth ;
		}
		function getBank_auth(){
			 return $this->_bank_auth ;
		}
		function getLast_login_time(){
			 return $this->_last_login_time ;
		}
		function getWhere(){
			 return $this->_where ;
		}


	    		function setUid($value){ 
			 $this->_uid = $value;
		}
		function setUsername($value){ 
			 $this->_username = $value;
		}
		function setPassword($value){ 
			 $this->_password = $value;
		}
		function setEmail($value){ 
			 $this->_email = $value;
		}
		function setUser_pic($value){ 
			 $this->_user_pic = $value;
		}
		function setGroup_id($value){ 
			 $this->_group_id = $value;
		}
		function setIsvip($value){ 
			 $this->_isvip = $value;
		}
		function setStatus($value){ 
			 $this->_status = $value;
		}
		function setUser_type($value){ 
			 $this->_user_type = $value;
		}
		function setSex($value){ 
			 $this->_sex = $value;
		}
		function setMarry($value){ 
			 $this->_marry = $value;
		}
		function setHometown($value){ 
			 $this->_hometown = $value;
		}
		function setResidency($value){ 
			 $this->_residency = $value;
		}
		function setAddress($value){ 
			 $this->_address = $value;
		}
		function setBirthday($value){ 
			 $this->_birthday = $value;
		}
		function setTruename($value){ 
			 $this->_truename = $value;
		}
		function setIdcard($value){ 
			 $this->_idcard = $value;
		}
		function setIdpic($value){ 
			 $this->_idpic = $value;
		}
		function setQq($value){ 
			 $this->_qq = $value;
		}
		function setMsn($value){ 
			 $this->_msn = $value;
		}
		function setFax($value){ 
			 $this->_fax = $value;
		}
		function setPhone($value){ 
			 $this->_phone = $value;
		}
		function setMobile($value){ 
			 $this->_mobile = $value;
		}
		function setIndus_id($value){ 
			 $this->_indus_id = $value;
		}
		function setSkill_ids($value){ 
			 $this->_skill_ids = $value;
		}
		function setSummary($value){ 
			 $this->_summary = $value;
		}
		function setExperience($value){ 
			 $this->_experience = $value;
		}
		function setReg_time($value){ 
			 $this->_reg_time = $value;
		}
		function setReg_ip($value){ 
			 $this->_reg_ip = $value;
		}
		function setDomain($value){ 
			 $this->_domain = $value;
		}
		function setCredit($value){ 
			 $this->_credit = $value;
		}
		function setBalance($value){ 
			 $this->_balance = $value;
		}
		function setBalance_status($value){ 
			 $this->_balance_status = $value;
		}
		function setIs_auth($value){ 
			 $this->_is_auth = $value;
		}
		function setAuth_name($value){ 
			 $this->_auth_name = $value;
		}
		function setAuth_time($value){ 
			 $this->_auth_time = $value;
		}
		function setPub_num($value){ 
			 $this->_pub_num = $value;
		}
		function setTake_num($value){ 
			 $this->_take_num = $value;
		}
		function setNominate_num($value){ 
			 $this->_nominate_num = $value;
		}
		function setAccepted_num($value){ 
			 $this->_accepted_num = $value;
		}
		function setVip_start_time($value){ 
			 $this->_vip_start_time = $value;
		}
		function setVip_end_time($value){ 
			 $this->_vip_end_time = $value;
		}
		function setPay_zfb($value){ 
			 $this->_pay_zfb = $value;
		}
		function setPay_cft($value){ 
			 $this->_pay_cft = $value;
		}
		function setPay_bank($value){ 
			 $this->_pay_bank = $value;
		}
		function setExperience_value($value){ 
			 $this->_experience_value = $value;
		}
		function setG_m_credit_value($value){ 
			 $this->_g_m_credit_value = $value;
		}
		function setW_m_credit_value($value){ 
			 $this->_w_m_credit_value = $value;
		}
		function setSeller_good_rate($value){ 
			 $this->_seller_good_rate = $value;
		}
		function setBuyer_good_rate($value){ 
			 $this->_buyer_good_rate = $value;
		}
		function setStudio_id($value){ 
			 $this->_studio_id = $value;
		}
		function setRealname_auth($value){ 
			 $this->_realname_auth = $value;
		}
		function setEnterprise_auth($value){ 
			 $this->_enterprise_auth = $value;
		}
		function setEmail_auth($value){ 
			 $this->_email_auth = $value;
		}
		function setBank_auth($value){ 
			 $this->_bank_auth = $value;
		}
		function setLast_login_time($value){ 
			 $this->_last_login_time = $value;
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
		 * 表keke_witkey_space创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_space(){
		 		 $data =  array(); 

					if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_password)){ 
				 $data['password']=$this->_password;
			}
			if(!is_null($this->_email)){ 
				 $data['email']=$this->_email;
			}
			if(!is_null($this->_user_pic)){ 
				 $data['user_pic']=$this->_user_pic;
			}
			if(!is_null($this->_group_id)){ 
				 $data['group_id']=$this->_group_id;
			}
			if(!is_null($this->_isvip)){ 
				 $data['isvip']=$this->_isvip;
			}
			if(!is_null($this->_status)){ 
				 $data['status']=$this->_status;
			}
			if(!is_null($this->_user_type)){ 
				 $data['user_type']=$this->_user_type;
			}
			if(!is_null($this->_sex)){ 
				 $data['sex']=$this->_sex;
			}
			if(!is_null($this->_marry)){ 
				 $data['marry']=$this->_marry;
			}
			if(!is_null($this->_hometown)){ 
				 $data['hometown']=$this->_hometown;
			}
			if(!is_null($this->_residency)){ 
				 $data['residency']=$this->_residency;
			}
			if(!is_null($this->_address)){ 
				 $data['address']=$this->_address;
			}
			if(!is_null($this->_birthday)){ 
				 $data['birthday']=$this->_birthday;
			}
			if(!is_null($this->_truename)){ 
				 $data['truename']=$this->_truename;
			}
			if(!is_null($this->_idcard)){ 
				 $data['idcard']=$this->_idcard;
			}
			if(!is_null($this->_idpic)){ 
				 $data['idpic']=$this->_idpic;
			}
			if(!is_null($this->_qq)){ 
				 $data['qq']=$this->_qq;
			}
			if(!is_null($this->_msn)){ 
				 $data['msn']=$this->_msn;
			}
			if(!is_null($this->_fax)){ 
				 $data['fax']=$this->_fax;
			}
			if(!is_null($this->_phone)){ 
				 $data['phone']=$this->_phone;
			}
			if(!is_null($this->_mobile)){ 
				 $data['mobile']=$this->_mobile;
			}
			if(!is_null($this->_indus_id)){ 
				 $data['indus_id']=$this->_indus_id;
			}
			if(!is_null($this->_skill_ids)){ 
				 $data['skill_ids']=$this->_skill_ids;
			}
			if(!is_null($this->_summary)){ 
				 $data['summary']=$this->_summary;
			}
			if(!is_null($this->_experience)){ 
				 $data['experience']=$this->_experience;
			}
			if(!is_null($this->_reg_time)){ 
				 $data['reg_time']=$this->_reg_time;
			}
			if(!is_null($this->_reg_ip)){ 
				 $data['reg_ip']=$this->_reg_ip;
			}
			if(!is_null($this->_domain)){ 
				 $data['domain']=$this->_domain;
			}
			if(!is_null($this->_credit)){ 
				 $data['credit']=$this->_credit;
			}
			if(!is_null($this->_balance)){ 
				 $data['balance']=$this->_balance;
			}
			if(!is_null($this->_balance_status)){ 
				 $data['balance_status']=$this->_balance_status;
			}
			if(!is_null($this->_is_auth)){ 
				 $data['is_auth']=$this->_is_auth;
			}
			if(!is_null($this->_auth_name)){ 
				 $data['auth_name']=$this->_auth_name;
			}
			if(!is_null($this->_auth_time)){ 
				 $data['auth_time']=$this->_auth_time;
			}
			if(!is_null($this->_pub_num)){ 
				 $data['pub_num']=$this->_pub_num;
			}
			if(!is_null($this->_take_num)){ 
				 $data['take_num']=$this->_take_num;
			}
			if(!is_null($this->_nominate_num)){ 
				 $data['nominate_num']=$this->_nominate_num;
			}
			if(!is_null($this->_accepted_num)){ 
				 $data['accepted_num']=$this->_accepted_num;
			}
			if(!is_null($this->_vip_start_time)){ 
				 $data['vip_start_time']=$this->_vip_start_time;
			}
			if(!is_null($this->_vip_end_time)){ 
				 $data['vip_end_time']=$this->_vip_end_time;
			}
			if(!is_null($this->_pay_zfb)){ 
				 $data['pay_zfb']=$this->_pay_zfb;
			}
			if(!is_null($this->_pay_cft)){ 
				 $data['pay_cft']=$this->_pay_cft;
			}
			if(!is_null($this->_pay_bank)){ 
				 $data['pay_bank']=$this->_pay_bank;
			}
			if(!is_null($this->_experience_value)){ 
				 $data['experience_value']=$this->_experience_value;
			}
			if(!is_null($this->_g_m_credit_value)){ 
				 $data['g_m_credit_value']=$this->_g_m_credit_value;
			}
			if(!is_null($this->_w_m_credit_value)){ 
				 $data['w_m_credit_value']=$this->_w_m_credit_value;
			}
			if(!is_null($this->_seller_good_rate)){ 
				 $data['seller_good_rate']=$this->_seller_good_rate;
			}
			if(!is_null($this->_buyer_good_rate)){ 
				 $data['buyer_good_rate']=$this->_buyer_good_rate;
			}
			if(!is_null($this->_studio_id)){ 
				 $data['studio_id']=$this->_studio_id;
			}
			if(!is_null($this->_realname_auth)){ 
				 $data['realname_auth']=$this->_realname_auth;
			}
			if(!is_null($this->_enterprise_auth)){ 
				 $data['enterprise_auth']=$this->_enterprise_auth;
			}
			if(!is_null($this->_email_auth)){ 
				 $data['email_auth']=$this->_email_auth;
			}
			if(!is_null($this->_bank_auth)){ 
				 $data['bank_auth']=$this->_bank_auth;
			}
			if(!is_null($this->_last_login_time)){ 
				 $data['last_login_time']=$this->_last_login_time;
			}

			 return $this->_uid = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 


	    /**
		 * 编辑表keke_witkey_space的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_space(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_uid)){ 
				 $data['uid']=$this->_uid;
			}
			if(!is_null($this->_username)){ 
				 $data['username']=$this->_username;
			}
			if(!is_null($this->_password)){ 
				 $data['password']=$this->_password;
			}
			if(!is_null($this->_email)){ 
				 $data['email']=$this->_email;
			}
			if(!is_null($this->_user_pic)){ 
				 $data['user_pic']=$this->_user_pic;
			}
			if(!is_null($this->_group_id)){ 
				 $data['group_id']=$this->_group_id;
			}
			if(!is_null($this->_isvip)){ 
				 $data['isvip']=$this->_isvip;
			}
			if(!is_null($this->_status)){ 
				 $data['status']=$this->_status;
			}
			if(!is_null($this->_user_type)){ 
				 $data['user_type']=$this->_user_type;
			}
			if(!is_null($this->_sex)){ 
				 $data['sex']=$this->_sex;
			}
			if(!is_null($this->_marry)){ 
				 $data['marry']=$this->_marry;
			}
			if(!is_null($this->_hometown)){ 
				 $data['hometown']=$this->_hometown;
			}
			if(!is_null($this->_residency)){ 
				 $data['residency']=$this->_residency;
			}
			if(!is_null($this->_address)){ 
				 $data['address']=$this->_address;
			}
			if(!is_null($this->_birthday)){ 
				 $data['birthday']=$this->_birthday;
			}
			if(!is_null($this->_truename)){ 
				 $data['truename']=$this->_truename;
			}
			if(!is_null($this->_idcard)){ 
				 $data['idcard']=$this->_idcard;
			}
			if(!is_null($this->_idpic)){ 
				 $data['idpic']=$this->_idpic;
			}
			if(!is_null($this->_qq)){ 
				 $data['qq']=$this->_qq;
			}
			if(!is_null($this->_msn)){ 
				 $data['msn']=$this->_msn;
			}
			if(!is_null($this->_fax)){ 
				 $data['fax']=$this->_fax;
			}
			if(!is_null($this->_phone)){ 
				 $data['phone']=$this->_phone;
			}
			if(!is_null($this->_mobile)){ 
				 $data['mobile']=$this->_mobile;
			}
			if(!is_null($this->_indus_id)){ 
				 $data['indus_id']=$this->_indus_id;
			}
			if(!is_null($this->_skill_ids)){ 
				 $data['skill_ids']=$this->_skill_ids;
			}
			if(!is_null($this->_summary)){ 
				 $data['summary']=$this->_summary;
			}
			if(!is_null($this->_experience)){ 
				 $data['experience']=$this->_experience;
			}
			if(!is_null($this->_reg_time)){ 
				 $data['reg_time']=$this->_reg_time;
			}
			if(!is_null($this->_reg_ip)){ 
				 $data['reg_ip']=$this->_reg_ip;
			}
			if(!is_null($this->_domain)){ 
				 $data['domain']=$this->_domain;
			}
			if(!is_null($this->_credit)){ 
				 $data['credit']=$this->_credit;
			}
			if(!is_null($this->_balance)){ 
				 $data['balance']=$this->_balance;
			}
			if(!is_null($this->_balance_status)){ 
				 $data['balance_status']=$this->_balance_status;
			}
			if(!is_null($this->_is_auth)){ 
				 $data['is_auth']=$this->_is_auth;
			}
			if(!is_null($this->_auth_name)){ 
				 $data['auth_name']=$this->_auth_name;
			}
			if(!is_null($this->_auth_time)){ 
				 $data['auth_time']=$this->_auth_time;
			}
			if(!is_null($this->_pub_num)){ 
				 $data['pub_num']=$this->_pub_num;
			}
			if(!is_null($this->_take_num)){ 
				 $data['take_num']=$this->_take_num;
			}
			if(!is_null($this->_nominate_num)){ 
				 $data['nominate_num']=$this->_nominate_num;
			}
			if(!is_null($this->_accepted_num)){ 
				 $data['accepted_num']=$this->_accepted_num;
			}
			if(!is_null($this->_vip_start_time)){ 
				 $data['vip_start_time']=$this->_vip_start_time;
			}
			if(!is_null($this->_vip_end_time)){ 
				 $data['vip_end_time']=$this->_vip_end_time;
			}
			if(!is_null($this->_pay_zfb)){ 
				 $data['pay_zfb']=$this->_pay_zfb;
			}
			if(!is_null($this->_pay_cft)){ 
				 $data['pay_cft']=$this->_pay_cft;
			}
			if(!is_null($this->_pay_bank)){ 
				 $data['pay_bank']=$this->_pay_bank;
			}
			if(!is_null($this->_experience_value)){ 
				 $data['experience_value']=$this->_experience_value;
			}
			if(!is_null($this->_g_m_credit_value)){ 
				 $data['g_m_credit_value']=$this->_g_m_credit_value;
			}
			if(!is_null($this->_w_m_credit_value)){ 
				 $data['w_m_credit_value']=$this->_w_m_credit_value;
			}
			if(!is_null($this->_seller_good_rate)){ 
				 $data['seller_good_rate']=$this->_seller_good_rate;
			}
			if(!is_null($this->_buyer_good_rate)){ 
				 $data['buyer_good_rate']=$this->_buyer_good_rate;
			}
			if(!is_null($this->_studio_id)){ 
				 $data['studio_id']=$this->_studio_id;
			}
			if(!is_null($this->_realname_auth)){ 
				 $data['realname_auth']=$this->_realname_auth;
			}
			if(!is_null($this->_enterprise_auth)){ 
				 $data['enterprise_auth']=$this->_enterprise_auth;
			}
			if(!is_null($this->_email_auth)){ 
				 $data['email_auth']=$this->_email_auth;
			}
			if(!is_null($this->_bank_auth)){ 
				 $data['bank_auth']=$this->_bank_auth;
			}
			if(!is_null($this->_last_login_time)){ 
				 $data['last_login_time']=$this->_last_login_time;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('uid' => $this->_uid); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 


	    /**
		 * 查询表keke_witkey_space,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_space(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_space(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 


	    
		function del_keke_witkey_space(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where uid = $this->_uid "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 


	   

	    

	    

   }

 ?>