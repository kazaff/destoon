<?php
class Keke_witkey_task_favor_ext_class extends Keke_witkey_task_favor_class{
  /**
		 * ��ѯ��keke_witkey_task_favor,��������ʱ������������ROW���������м�¼
		 * @return ����һ��(array)��������
		 */
		function query_keke_witkey_task_favor(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename 
				 a left join ".TABLEPRE."witkey_task b
				 on a.task_id = b.task_id 
				 where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename
				  a left join ".TABLEPRE."witkey_task b
				 on a.task_id = b.task_id 
				 "; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 

	    
		function count_keke_witkey_task_favor(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename 
				  a left join ".TABLEPRE."witkey_task b
				 on a.task_id = b.task_id 
				 where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename
				  a left join ".TABLEPRE."witkey_task b
				 on a.task_id = b.task_id 
				 "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 

}