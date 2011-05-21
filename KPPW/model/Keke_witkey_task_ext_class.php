<?php
class Keke_witkey_task_ext_class extends Keke_witkey_task_class{
/*
SQL������⣺��������ͨ��һ��ID��������Ҫ����ҳ�A���д��ڵļ�¼��B���в����ڵļ�¼��������ļ�¼����������Ӧ����ô��д����SQL
����취�������������ᣬЧ��Ӧ�øߺܶࡣ�ܲ���in�;�������in,�ٶ�̫����

����A         
id 
1 
2 
5 
7 

����B 
ID 
2 
5 
��ô��ѯ���Ľ��Ӧ����IDΪ1��7�ļ�¼ 

ʵ����䣺select a.* from a left join b on a.id <> b.id

��书�ܣ������������ӱ�������ͬtask_id�ֶεļ�¼ѡ����������������task_idΪΨһ�ģ��ӱ�
select * from hongshan_witkey_task a where a.task_id in (select task_id from hongshan_witkey_task_delay)
*/
		function query_keke_witkey_task(){//��ѯwitkey_task(a)���witkey_task_delay(b)������ͬtask_id�ļ�¼����������������ͳ���ܵ���ʱ���
			if($this->_where){ 
				 $sql = "
				 SELECT a.*, (select count(b.delay_cash)
			  from ".TABLEPRE."witkey_task_delay b 
			  where a.task_id = b.task_id and b.delay_status>0)  
			  as delay_cash  FROM  $this->_tablename 
			  a  where ".$this->_where; 
				 /*����witkey_task_delay�е�task_id��witkey_task����task_id�ֶ���ͬ�ļ�¼��delay�ֶε����ݽ���ͳ�ƣ�������ڱ���Ϊdelay_cash�ֶ��С�
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

	    
		function count_keke_witkey_task(){ //ͳ��witkey_task_delay���witkey_task���ж����ֵļ�¼��on a.task_id = b.task_id�����������᷵��witkey_task_delay��������У�left join ��
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
		 //���������ѯ
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

      //��������ͳ��
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