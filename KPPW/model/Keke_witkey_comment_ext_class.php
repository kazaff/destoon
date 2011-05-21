<?php
class Keke_witkey_comment_ext_class extends Keke_witkey_comment_class{
	function query_keke_witkey_comment(){ 
			 if($this->_where){ 
				 $sql = "select * from $this->_tablename
				 a left join ".TABLEPRE."witkey_task b 
				 on a.obj_id = b.task_id				
				 where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select * from $this->_tablename
				 a left join ".TABLEPRE."witkey_task b 
				 on a.obj_id = b.task_id	
				 "; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 

	    
		function count_keke_witkey_comment(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename
				a left join ".TABLEPRE."witkey_task b 
				 on a.obj_id = b.task_id	
				 where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename
				 a left join ".TABLEPRE."witkey_task b 
				 on a.obj_id = b.task_id	
				 "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 
}