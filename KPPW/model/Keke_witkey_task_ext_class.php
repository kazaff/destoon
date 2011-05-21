<?php
class Keke_witkey_task_ext_class extends Keke_witkey_task_class{
/*
SQL语句问题：有两个表，通过一个ID来关联，要求查找出A表中存在的记录而B表中不存在的记录，两个表的记录都百万条，应该怎么来写这条SQL
解决办法：建议用外联结，效率应该高很多。能不用in就尽量不用in,速度太慢。

假设A         
id 
1 
2 
5 
7 

假设B 
ID 
2 
5 
那么查询出的结果应该是ID为1，7的记录 

实现语句：select a.* from a left join b on a.id <> b.id

语句功能：将主表中与子表中有相同task_id字段的记录选择出来，其中主表的task_id为唯一的，子表
select * from hongshan_witkey_task a where a.task_id in (select task_id from hongshan_witkey_task_delay)
*/
		function query_keke_witkey_task(){//查询witkey_task(a)表和witkey_task_delay(b)表中相同task_id的记录，并（根据条件）统计总的延时金额
			if($this->_where){ 
				 $sql = "
				 SELECT a.*, (select count(b.delay_cash)
			  from ".TABLEPRE."witkey_task_delay b 
			  where a.task_id = b.task_id and b.delay_status>0)  
			  as delay_cash  FROM  $this->_tablename 
			  a  where ".$this->_where; 
				 /*将表witkey_task_delay中的task_id与witkey_task表中task_id字段相同的记录的delay字段的数据进行统计，结果放在别名为delay_cash字段中。
				 (select count(b.delay_cash)
			  from ".TABLEPRE."witkey_task_delay b 
			  where a.task_id = b.task_id )
				 */
				 				
				 /*
				 SELECT a.*,delay_cash FROM $this->_tablename a where ".$this->_where; 
				 */
			 } 
			 else{ 
				 $sql = " SELECT a.*, (select count(b.delay_cash)
			  from ".TABLEPRE."witkey_task_delay b 
			  where a.task_id = b.task_id )  
			  as delay_cash  FROM  $this->_tablename 
			  a  "; 
			 } 
			 //var_dump($sql);
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 

	    
		function count_keke_witkey_task(){ //统计witkey_task_delay表和witkey_task表中都出现的记录（on a.task_id = b.task_id）条数，但会返回witkey_task_delay表的所有行（left join ）
			 if($this->_where){ 
				 $sql = "select count(*) as count
				 from $this->_tablename a left join ".TABLEPRE."witkey_task_delay b
				 on a.task_id = b.task_id 
				 where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename
				  a left join ".TABLEPRE."witkey_task_delay b
				 on a.task_id = b.task_id 
				 "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 
		 
		 function query_keke_witkey_task_industry(){ 
			if($this->_where){ 
				 $sql = "select * from $this->_tablename 
				 a left join ".TABLEPRE."witkey_industry b 
				 on a.indus_id = b.indus_id 
				 where ".$this->_where; 
			 } 
			 else{ 
				  $sql = "select * from $this->_tablename 
				 a left join ".TABLEPRE."witkey_industry b 
				 on a.indus_id = b.indus_id";
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 }
		 //推列任务查询
		function query_keke_witkey_tl_task(){ 
			if($this->_where){ 
				 $sql = "
				 SELECT a.*,c.*, (select count(b.delay_cash)
			  from ".TABLEPRE."witkey_task_delay b 
			  where a.task_id = b.task_id )  
			  as delay_cash  FROM  $this->_tablename 
			  a left join ".TABLEPRE."witkey_tl_task c  on a.task_id = c.task_id where ".$this->_where; 
				 
				
			 } 
			 else{
				 $sql = " SELECT a.*,c.*, (select count(b.delay_cash)
			  from ".TABLEPRE."witkey_task_delay b
			  where a.task_id = b.task_id )
			  as delay_cash  FROM  $this->_tablename
			  a left join ".TABLEPRE."witkey_tl_task c  on a.task_id = c.task_id ";
			 }
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 

      //推列任务统计
		function count_keke_witkey_tl_task(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename 
				  a left join ".TABLEPRE."witkey_task_delay b
				 on a.task_id = b.task_id left join ".TABLEPRE."witkey_tl_task c  on a.task_id = c.task_id
				 where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename
				  a left join ".TABLEPRE."witkey_task_delay b
				 on a.task_id = b.task_id  left join ".TABLEPRE."witkey_tl_task c  on a.task_id = c.task_id
				 "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 }
		 function count_keke_witkey_task_industry(){
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename 
				  a left join ".TABLEPRE."witkey_industry b 
				 on a.indus_id = b.indus_id 
				 where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename
				  a left join ".TABLEPRE."witkey_industry b 
				 on a.indus_id = b.indus_id";
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 	
}