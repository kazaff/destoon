<?php
  class Keke_witkey_basic_config_class{
        var $_db;
        var $_tablename;
	    var $_dbop;
	    	 var $_basic_config_id; //主键 
		 var $_website_name; 
		 var $_website_title; 
		 var $_website_url; 
		 var $_install_path; 
		 var $_web_logo; 
		 var $_seo_title; 
		 var $_seo_keyword; 
		 var $_seo_desc; 
		 var $_company; 
		 var $_address; 
		 var $_phone; 
		 var $_kf_phone; 
		 var $_postcode; 
		 var $_filing; 
		 var $_is_close; 
		 var $_close_reason; 
		 var $_stats_code; 
		 var $_max_size; 
		 var $_file_type; 
		 var $_ban_users; 
		 var $_ban_content; 
		 var $_reg_limit; 
		 var $_on_time; 
		 var $_mail_server_cat; 
		 var $_mail_server_port; 
		 var $_mail_ssl; 
		 var $_smtp_url; 
		 var $_post_account; 
		 var $_account_pwd; 
		 var $_mail_replay; 
		 var $_mail_charset; 
		 var $_credit_is_allow; 
		 var $_user_intergration; 
		 var $_is_rewrite; 
		 var $_mark_start_status; 
		 var $_auto_mark_time; 
		 var $_auto_mark_status; 

	    var $_replace=0; //insert into or replace into ?
	    var $_where;     //查，改，删条件
	     function  keke_witkey_basic_config_class(){ //构造方法
			 $this->_db = new db_factory ( );
			 $this->_dbop = $this->_db->create(DBTYPE);
			 $this->_tablename = TABLEPRE."witkey_basic_config";
		 }
	    
	    		function getBasic_config_id(){
			 return $this->_basic_config_id ;
		}
		function getWebsite_name(){
			 return $this->_website_name ;
		}
		function getWebsite_title(){
			 return $this->_website_title ;
		}
		function getWebsite_url(){
			 return $this->_website_url ;
		}
		function getInstall_path(){
			 return $this->_install_path ;
		}
		function getWeb_logo(){
			 return $this->_web_logo ;
		}
		function getSeo_title(){
			 return $this->_seo_title ;
		}
		function getSeo_keyword(){
			 return $this->_seo_keyword ;
		}
		function getSeo_desc(){
			 return $this->_seo_desc ;
		}
		function getCompany(){
			 return $this->_company ;
		}
		function getAddress(){
			 return $this->_address ;
		}
		function getPhone(){
			 return $this->_phone ;
		}
		function getKf_phone(){
			 return $this->_kf_phone ;
		}
		function getPostcode(){
			 return $this->_postcode ;
		}
		function getFiling(){
			 return $this->_filing ;
		}
		function getIs_close(){
			 return $this->_is_close ;
		}
		function getClose_reason(){
			 return $this->_close_reason ;
		}
		function getStats_code(){
			 return $this->_stats_code ;
		}
		function getMax_size(){
			 return $this->_max_size ;
		}
		function getFile_type(){
			 return $this->_file_type ;
		}
		function getBan_users(){
			 return $this->_ban_users ;
		}
		function getBan_content(){
			 return $this->_ban_content ;
		}
		function getReg_limit(){
			 return $this->_reg_limit ;
		}
		function getOn_time(){
			 return $this->_on_time ;
		}
		function getMail_server_cat(){
			 return $this->_mail_server_cat ;
		}
		function getMail_server_port(){
			 return $this->_mail_server_port ;
		}
		function getMail_ssl(){
			 return $this->_mail_ssl ;
		}
		function getSmtp_url(){
			 return $this->_smtp_url ;
		}
		function getPost_account(){
			 return $this->_post_account ;
		}
		function getAccount_pwd(){
			 return $this->_account_pwd ;
		}
		function getMail_replay(){
			 return $this->_mail_replay ;
		}
		function getMail_charset(){
			 return $this->_mail_charset ;
		}
		function getCredit_is_allow(){
			 return $this->_credit_is_allow ;
		}
		function getUser_intergration(){
			 return $this->_user_intergration ;
		}
		function getIs_rewrite(){
			 return $this->_is_rewrite ;
		}
		function getMark_start_status(){
			 return $this->_mark_start_status ;
		}
		function getAuto_mark_time(){
			 return $this->_auto_mark_time ;
		}
		function getAuto_mark_status(){
			 return $this->_auto_mark_status ;
		}
		function getWhere(){
			 return $this->_where ;
		}

	    		function setBasic_config_id($value){ 
			 $this->_basic_config_id = $value;
		}
		function setWebsite_name($value){ 
			 $this->_website_name = $value;
		}
		function setWebsite_title($value){ 
			 $this->_website_title = $value;
		}
		function setWebsite_url($value){ 
			 $this->_website_url = $value;
		}
		function setInstall_path($value){ 
			 $this->_install_path = $value;
		}
		function setWeb_logo($value){ 
			 $this->_web_logo = $value;
		}
		function setSeo_title($value){ 
			 $this->_seo_title = $value;
		}
		function setSeo_keyword($value){ 
			 $this->_seo_keyword = $value;
		}
		function setSeo_desc($value){ 
			 $this->_seo_desc = $value;
		}
		function setCompany($value){ 
			 $this->_company = $value;
		}
		function setAddress($value){ 
			 $this->_address = $value;
		}
		function setPhone($value){ 
			 $this->_phone = $value;
		}
		function setKf_phone($value){ 
			 $this->_kf_phone = $value;
		}
		function setPostcode($value){ 
			 $this->_postcode = $value;
		}
		function setFiling($value){ 
			 $this->_filing = $value;
		}
		function setIs_close($value){ 
			 $this->_is_close = $value;
		}
		function setClose_reason($value){ 
			 $this->_close_reason = $value;
		}
		function setStats_code($value){ 
			 $this->_stats_code = $value;
		}
		function setMax_size($value){ 
			 $this->_max_size = $value;
		}
		function setFile_type($value){ 
			 $this->_file_type = $value;
		}
		function setBan_users($value){ 
			 $this->_ban_users = $value;
		}
		function setBan_content($value){ 
			 $this->_ban_content = $value;
		}
		function setReg_limit($value){ 
			 $this->_reg_limit = $value;
		}
		function setOn_time($value){ 
			 $this->_on_time = $value;
		}
		function setMail_server_cat($value){ 
			 $this->_mail_server_cat = $value;
		}
		function setMail_server_port($value){ 
			 $this->_mail_server_port = $value;
		}
		function setMail_ssl($value){ 
			 $this->_mail_ssl = $value;
		}
		function setSmtp_url($value){ 
			 $this->_smtp_url = $value;
		}
		function setPost_account($value){ 
			 $this->_post_account = $value;
		}
		function setAccount_pwd($value){ 
			 $this->_account_pwd = $value;
		}
		function setMail_replay($value){ 
			 $this->_mail_replay = $value;
		}
		function setMail_charset($value){ 
			 $this->_mail_charset = $value;
		}
		function setCredit_is_allow($value){ 
			 $this->_credit_is_allow = $value;
		}
		function setUser_intergration($value){ 
			 $this->_user_intergration = $value;
		}
		function setIs_rewrite($value){ 
			 $this->_is_rewrite = $value;
		}
		function setMark_start_status($value){ 
			 $this->_mark_start_status = $value;
		}
		function setAuto_mark_time($value){ 
			 $this->_auto_mark_time = $value;
		}
		function setAuto_mark_status($value){ 
			 $this->_auto_mark_status = $value;
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
		 * 表keke_witkey_basic_config创建或新增一条记录
		 * @return 返回新增ID
		 */
		function create_keke_witkey_basic_config(){
		 		 $data =  array(); 

					if(!is_null($this->_basic_config_id)){ 
				 $data['basic_config_id']=$this->_basic_config_id;
			}
			if(!is_null($this->_website_name)){ 
				 $data['website_name']=$this->_website_name;
			}
			if(!is_null($this->_website_title)){ 
				 $data['website_title']=$this->_website_title;
			}
			if(!is_null($this->_website_url)){ 
				 $data['website_url']=$this->_website_url;
			}
			if(!is_null($this->_install_path)){ 
				 $data['install_path']=$this->_install_path;
			}
			if(!is_null($this->_web_logo)){ 
				 $data['web_logo']=$this->_web_logo;
			}
			if(!is_null($this->_seo_title)){ 
				 $data['seo_title']=$this->_seo_title;
			}
			if(!is_null($this->_seo_keyword)){ 
				 $data['seo_keyword']=$this->_seo_keyword;
			}
			if(!is_null($this->_seo_desc)){ 
				 $data['seo_desc']=$this->_seo_desc;
			}
			if(!is_null($this->_company)){ 
				 $data['company']=$this->_company;
			}
			if(!is_null($this->_address)){ 
				 $data['address']=$this->_address;
			}
			if(!is_null($this->_phone)){ 
				 $data['phone']=$this->_phone;
			}
			if(!is_null($this->_kf_phone)){ 
				 $data['kf_phone']=$this->_kf_phone;
			}
			if(!is_null($this->_postcode)){ 
				 $data['postcode']=$this->_postcode;
			}
			if(!is_null($this->_filing)){ 
				 $data['filing']=$this->_filing;
			}
			if(!is_null($this->_is_close)){ 
				 $data['is_close']=$this->_is_close;
			}
			if(!is_null($this->_close_reason)){ 
				 $data['close_reason']=$this->_close_reason;
			}
			if(!is_null($this->_stats_code)){ 
				 $data['stats_code']=$this->_stats_code;
			}
			if(!is_null($this->_max_size)){ 
				 $data['max_size']=$this->_max_size;
			}
			if(!is_null($this->_file_type)){ 
				 $data['file_type']=$this->_file_type;
			}
			if(!is_null($this->_ban_users)){ 
				 $data['ban_users']=$this->_ban_users;
			}
			if(!is_null($this->_ban_content)){ 
				 $data['ban_content']=$this->_ban_content;
			}
			if(!is_null($this->_reg_limit)){ 
				 $data['reg_limit']=$this->_reg_limit;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}
			if(!is_null($this->_mail_server_cat)){ 
				 $data['mail_server_cat']=$this->_mail_server_cat;
			}
			if(!is_null($this->_mail_server_port)){ 
				 $data['mail_server_port']=$this->_mail_server_port;
			}
			if(!is_null($this->_mail_ssl)){ 
				 $data['mail_ssl']=$this->_mail_ssl;
			}
			if(!is_null($this->_smtp_url)){ 
				 $data['smtp_url']=$this->_smtp_url;
			}
			if(!is_null($this->_post_account)){ 
				 $data['post_account']=$this->_post_account;
			}
			if(!is_null($this->_account_pwd)){ 
				 $data['account_pwd']=$this->_account_pwd;
			}
			if(!is_null($this->_mail_replay)){ 
				 $data['mail_replay']=$this->_mail_replay;
			}
			if(!is_null($this->_mail_charset)){ 
				 $data['mail_charset']=$this->_mail_charset;
			}
			if(!is_null($this->_credit_is_allow)){ 
				 $data['credit_is_allow']=$this->_credit_is_allow;
			}
			if(!is_null($this->_user_intergration)){ 
				 $data['user_intergration']=$this->_user_intergration;
			}
			if(!is_null($this->_is_rewrite)){ 
				 $data['is_rewrite']=$this->_is_rewrite;
			}
			if(!is_null($this->_mark_start_status)){ 
				 $data['mark_start_status']=$this->_mark_start_status;
			}
			if(!is_null($this->_auto_mark_time)){ 
				 $data['auto_mark_time']=$this->_auto_mark_time;
			}
			if(!is_null($this->_auto_mark_status)){ 
				 $data['auto_mark_status']=$this->_auto_mark_status;
			}

			 return $this->_basic_config_id = $this->_db->inserttable($this->_tablename,$data,1,$this->_replace); 
		 } 

	    /**
		 * 编辑表keke_witkey_basic_config的一个条记录
		 * @return 返回影响的行数
		 */
		function edit_keke_witkey_basic_config(){ 
		 		 $data =  array(); 
 
					if(!is_null($this->_basic_config_id)){ 
				 $data['basic_config_id']=$this->_basic_config_id;
			}
			if(!is_null($this->_website_name)){ 
				 $data['website_name']=$this->_website_name;
			}
			if(!is_null($this->_website_title)){ 
				 $data['website_title']=$this->_website_title;
			}
			if(!is_null($this->_website_url)){ 
				 $data['website_url']=$this->_website_url;
			}
			if(!is_null($this->_install_path)){ 
				 $data['install_path']=$this->_install_path;
			}
			if(!is_null($this->_web_logo)){ 
				 $data['web_logo']=$this->_web_logo;
			}
			if(!is_null($this->_seo_title)){ 
				 $data['seo_title']=$this->_seo_title;
			}
			if(!is_null($this->_seo_keyword)){ 
				 $data['seo_keyword']=$this->_seo_keyword;
			}
			if(!is_null($this->_seo_desc)){ 
				 $data['seo_desc']=$this->_seo_desc;
			}
			if(!is_null($this->_company)){ 
				 $data['company']=$this->_company;
			}
			if(!is_null($this->_address)){ 
				 $data['address']=$this->_address;
			}
			if(!is_null($this->_phone)){ 
				 $data['phone']=$this->_phone;
			}
			if(!is_null($this->_kf_phone)){ 
				 $data['kf_phone']=$this->_kf_phone;
			}
			if(!is_null($this->_postcode)){ 
				 $data['postcode']=$this->_postcode;
			}
			if(!is_null($this->_filing)){ 
				 $data['filing']=$this->_filing;
			}
			if(!is_null($this->_is_close)){ 
				 $data['is_close']=$this->_is_close;
			}
			if(!is_null($this->_close_reason)){ 
				 $data['close_reason']=$this->_close_reason;
			}
			if(!is_null($this->_stats_code)){ 
				 $data['stats_code']=$this->_stats_code;
			}
			if(!is_null($this->_max_size)){ 
				 $data['max_size']=$this->_max_size;
			}
			if(!is_null($this->_file_type)){ 
				 $data['file_type']=$this->_file_type;
			}
			if(!is_null($this->_ban_users)){ 
				 $data['ban_users']=$this->_ban_users;
			}
			if(!is_null($this->_ban_content)){ 
				 $data['ban_content']=$this->_ban_content;
			}
			if(!is_null($this->_reg_limit)){ 
				 $data['reg_limit']=$this->_reg_limit;
			}
			if(!is_null($this->_on_time)){ 
				 $data['on_time']=$this->_on_time;
			}
			if(!is_null($this->_mail_server_cat)){ 
				 $data['mail_server_cat']=$this->_mail_server_cat;
			}
			if(!is_null($this->_mail_server_port)){ 
				 $data['mail_server_port']=$this->_mail_server_port;
			}
			if(!is_null($this->_mail_ssl)){ 
				 $data['mail_ssl']=$this->_mail_ssl;
			}
			if(!is_null($this->_smtp_url)){ 
				 $data['smtp_url']=$this->_smtp_url;
			}
			if(!is_null($this->_post_account)){ 
				 $data['post_account']=$this->_post_account;
			}
			if(!is_null($this->_account_pwd)){ 
				 $data['account_pwd']=$this->_account_pwd;
			}
			if(!is_null($this->_mail_replay)){ 
				 $data['mail_replay']=$this->_mail_replay;
			}
			if(!is_null($this->_mail_charset)){ 
				 $data['mail_charset']=$this->_mail_charset;
			}
			if(!is_null($this->_credit_is_allow)){ 
				 $data['credit_is_allow']=$this->_credit_is_allow;
			}
			if(!is_null($this->_user_intergration)){ 
				 $data['user_intergration']=$this->_user_intergration;
			}
			if(!is_null($this->_is_rewrite)){ 
				 $data['is_rewrite']=$this->_is_rewrite;
			}
			if(!is_null($this->_mark_start_status)){ 
				 $data['mark_start_status']=$this->_mark_start_status;
			}
			if(!is_null($this->_auto_mark_time)){ 
				 $data['auto_mark_time']=$this->_auto_mark_time;
			}
			if(!is_null($this->_auto_mark_status)){ 
				 $data['auto_mark_status']=$this->_auto_mark_status;
			}

			if($this->_where){ 
				 return $this->_db->updatetable($this->_tablename,$data,$this->getWhere()); 
			 } 
			 else{ 
				 $where = array('basic_config_id' => $this->_basic_config_id); 
				 return $this->_db->updatetable($this->_tablename,$data,$where); 
			} 
		 } 

	    /**
		 * 查询表keke_witkey_basic_config,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_basic_config(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 

	    
		function count_keke_witkey_basic_config(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 

	    
		function del_keke_witkey_basic_config(){ 
			 if($this->_where){ 
				 $sql = "delete from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "delete from $this->_tablename where basic_config_id = $this->_basic_config_id "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->execute($sql); 
		 } 

	   
	    
	    
   }
 ?>