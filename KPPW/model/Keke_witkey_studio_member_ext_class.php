<?php
class Keke_witkey_studio_member_ext_class extends Keke_witkey_studio_member_class{
  /**
		 * ��ѯ��keke_witkey_studio_member,��������ʱ������������ROW���������м�¼
		 * @return ����һ��(array)��������
		 */
		function query_keke_witkey_studio_member(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename
				a left join  ".TABLEPRE."witkey_space b 
				on a.uid = b.uid 
				 where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename
				 a left join  ".TABLEPRE."witkey_space b 
				on a.uid = b.uid 
				 "; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 

	    
		function count_keke_witkey_studio_member(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename 
				 a left join  ".TABLEPRE."witkey_space b 
				on a.uid = b.uid 
				 where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename
				 a left join  ".TABLEPRE."witkey_space b 
				on a.uid = b.uid 
				 "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 
	
}