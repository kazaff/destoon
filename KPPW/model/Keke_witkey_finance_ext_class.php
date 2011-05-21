<?php
class Keke_witkey_finance_ext_class extends Keke_witkey_finance_class{
	
	    /**
		 * 查询表keke_witkey_finance,当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function get_total_cash(){ 
			 if($this->_where){ 
				 $sql = "select sum(fina_cash) as cash from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select sum(fina_cash) as cash from $this->_tablename"; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 
		 
		function get_fina_report($date_format='')
		{
			if($this->_where)
			{
				$sql = "SELECT sum(fina_cash) as fina_cash , sum(fina_credit) as fina_credit , count(task_id) as task_num,"; 
                if($date_format =="'%Y'")
                {
                   $sql .= "concat(CAST(from_unixtime(fina_time,$date_format) as CHAR), '年') as count_time";
			    }
			    else if($date_format =="'%Y-%m'")
			    {
			    	$sql .= "concat(CAST(from_unixtime(fina_time,$date_format) as CHAR), '月') as count_time";
			    }
			    else
			    {
			    	$sql .= "from_unixtime(fina_time,$date_format) as count_time";
			    }
				
				$sql .= " FROM
						$this->_tablename 
						where ".$this->_where; 
				         
			}else {
				$sql = "SELECT sum(fina_cash) as fina_cash , sum(fina_credit) as fina_credit , count(task_id) as task_num, 
						from_unixtime(fina_time,$date_format) as count_time
						FROM
						keke_witkey_finance 
						where 1 
						group by day(from_unixtime(fina_time))";
			}
			//echo $sql ;
			$this->_where = '';
			return $this->_dbop->query($sql);
		}
		/**
		 * 报表总记录数
		 */
		function count_fina_report()
		{
			if($this->_where){ 
				 $sql = "select sum(fina_id) as count from $this->_tablename where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select sum(fina_id) as count from $this->_tablename"; 
			 } 
			 $this->_where = ""; 
			 $temp_arr =  $this->_dbop->query($sql);
			 return count($temp_arr);
			  
		}
	    
};
