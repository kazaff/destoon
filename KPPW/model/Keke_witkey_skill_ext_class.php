<?php
class Keke_witkey_skill_ext_class extends Keke_witkey_skill_class{
	 /**
		 * ��ѯ��keke_witkey_skill,keke_witkey_industry��������ʱ������������ROW���������м�¼
		 * @return ����һ��(array)��������
		 */
		function query_keke_witkey_skill(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename a 
				 left join ".TABLEPRE."witkey_industry  b
				 on a.indus_id = b.indus_id				 
				 where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename a
				  left join ".TABLEPRE."witkey_industry  b
				  on a.indus_id = b.indus_id 		
				 "; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 


	    
		function count_keke_witkey_skill(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename 
				  left join ".TABLEPRE."witkey_industry  b
				  on a.indus_id = b.indus_id		
				 where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename
				  left join ".TABLEPRE."witkey_industry  b
				  on a.indus_id = b.indus_id		
				 "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 
	
	
}