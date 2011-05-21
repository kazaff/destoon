<?php
class Keke_witkey_studio_member_ext_class extends Keke_witkey_studio_member_class{
  /**
		 * 查询表keke_witkey_studio_member,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
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