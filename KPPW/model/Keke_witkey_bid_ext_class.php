<?php
class Keke_witkey_bid_ext_class extends Keke_witkey_bid_class{
	  /**
		 * 查询表keke_witkey_bid,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_bid(){ 
			 if($this->_where){ 
				 $sql = "select a.*,
				b.isvip,
				 b.realname_auth,
				 b.enterprise_auth,
				 b.email_auth,
				 b.bank_auth,
				 b.studio_id,
				 b.reg_time,
				 b.accepted_num,
				 b.experience_value,
				 b.g_m_credit_value,
				 b.w_m_credit_value,
				 b.seller_good_rate,
				 b.buyer_good_rate,
				 b.realname_auth,
				 b.enterprise_auth,
				 b.email_auth,
				 b.bank_auth,
				 b.last_login_time,
				 c.mark_status,
				 d.studio_id,
				 d.title
				 from $this->_tablename 
				 a left join ".TABLEPRE."witkey_space b
				 on a.uid = b.uid  
				 left join ".TABLEPRE."witkey_mark_log c on a.bid_id=c.work_id and c.mark_type=1 
				 left join ".TABLEPRE."witkey_studio d on b.studio_id = d.studio_id
				 where ".$this->_where; 
			 } 
			 else{ 
				  $sql = "select * from $this->_tablename 
				 a left join ".TABLEPRE."witkey_space b 
				 on a.uid = b.uid ";
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_bid(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename
 				 a left join ".TABLEPRE."witkey_space b 
				 on a.uid = b.uid 
				 where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename
				  a left join ".TABLEPRE."witkey_space b 
				 on a.uid = b.uid ";
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 

	

}