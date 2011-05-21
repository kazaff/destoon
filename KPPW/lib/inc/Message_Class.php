<?php

class Message_Class {
	var $_key;
	var $_title;
	var $_config;
	var $_uid;
	var $_username;
	var $_sitename;
	var $_content;
	var $_email;
	var $_messagetype;
	
 	function  message_class(){ 
		$this->_key = array();
		$this->_title = "消息提示";
		$this->_config = Cache_ext_Class::getConfig('message');
		$basicconfig = Cache_ext_Class::getConfig('basic');
		$this->_messagetype = "";
		
		$this->_sitename = $basicconfig['website_name'];
	}
	
	function setUid($uid)
	{
		$this->_uid = $uid;
	}
	function setUsername($username)
	{
		$this->_username = $username;
	}
	function setTitle($title)
	{
		$this->_title = $title;
	}
	function setEmail($email)
	{
		$this->_email = $email;
	}
	
	function setMessagetype($messagetype)
	{
		$this->_messagetype = $messagetype;
	}
	
	function setValue($key,$value)
	{
		$this->_key[$key] = $value;
	}
	
	
 
	function validate($messagetype=""){
		if ($this->_config[$messagetype]==1)
		{
			return false;
		}
		else 
		{
			$messagetype?$this->_messagetype=$messagetype:"";
		}
		return true;
	} 
	
	function send()
	{
		if (!$this->_uid)
		{
			return false;
		}
		if (!$this->validate())
		{
			return false;
		}
		$this->pregmessage($this->_messagetype);
		
		if ($this->_config[$this->_messagetype]==2)
		{
			$this->sendmessage();
		}
		if ($this->_config[$this->_messagetype]==3)
		{
			$this->sendmail();
		}
		if ($this->_config[$this->_messagetype]==4)
		{
			
			$this->sendmessage();
			$this->sendmail();
		}
		$this->_key = array();
	}
	
	private function pregmessage($op)
	{
		
		$tpl = Cache_ext_Class::getmessagetpl($op);
		$cont = $tpl['msg_temp_content'];
		
		if (!$this->_username){
			$userinfo = Func_comm_class::getuserinfo($this->_uid);
			$this->_username = $userinfo['username'];
		}
		
		if ($this->_username)$cont = str_replace('{'.'用户名'.'}',$this->_username,$cont);
		if ($this->_uid)$cont = str_replace('{'.'用户id'.'}',$this->_uid,$cont);
		if ($this->_sitename)$cont = str_replace('{'.'网站名称'.'}',$this->_sitename,$cont);
		foreach ($this->_key as $k=>$v)
		{
			$cont = str_replace('{'.$k.'}',$v,$cont);
		}
		
		
		$this->_content = $cont;
	}
	
	private function sendmessage(){
		$message_obj = new Keke_witkey_message_class();
		$message_obj->setTitle($this->_title);
		$message_obj->setContent($this->_content);
		$message_obj->setRecive_uid($this->_uid);
		$message_obj->setRecive_username($this->_username);
		$message_obj->setOn_time(time('now()'));
		$message_obj->create_keke_witkey_message();
	}
	
	private function sendmail(){
		global $basicconfig ,$_K;
		if (!$this->_email||!$this->_username)
		{
			$userinfo = Func_comm_class::getuserinfo($this->_uid);
			
			$this->_username = $userinfo['username'];
			$this->_email = $userinfo['email'];
		}
		if (!$this->_email){
			return false;
		}
		if (!$basicconfig)
		$basicconfig = Cache_ext_Class::getConfig('basic');
		
		
		if ($basicconfig['mail_server_cat']=='mail'){
			$hearer="From:{$basicconfig['post_account']}\nReply-To:{$basicconfig['mail_replay']}\nX-Mailer: PHP/".phpversion()."\nContent-Type:text/html";
			mail($this->_email,$this->_title,$this->_content,$hearer);
		}
		else {
			$mail = new Phpmailer_class ();
		 
			
			
			
			
			if ($basicconfig['mail_server_cat'] == "smtp") {
				$mail->IsSMTP ();
				$mail->SMTPAuth = true;
				$mail->CharSet = strtolower($_K['charset']);
			 
				$mail->Host = $basicconfig['smtp_url'];
				$mail->Port = $basicconfig['mail_server_port'];
				$mail->Username = $basicconfig['post_account'];
				$mail->Password = $basicconfig['account_pwd'];
			} else {
				$mail->IsMail();
			}
			
		 
			
			$mail->SetFrom ($basicconfig['post_account'],$basicconfig['website_name']);
			
			if ($basicconfig['mail_replay'])$mail->AddReplyTo ( $basicconfig['mail_replay'], $basicconfig['website_name']);
			
			$mail->Subject = $this->_title;
			
			$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";  
			$body = $this->_content;
			$mail->MsgHTML ( $body );
			
			
			$address = $this->_email;
			$mail->AddAddress ( $address, $basicconfig['website_name']);
			
			if (! $mail->Send()) {
			} else {
 
			}
		}
	}
}

?>