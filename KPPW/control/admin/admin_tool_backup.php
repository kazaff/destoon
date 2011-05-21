<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(33);

$db_factory = new db_factory ();

$tables = $db_factory->query ( ' show table status from ' . DBNAME );
 $temp_arr = array();
 foreach ($tables as $v) {

    if(substr($v[Name],0,strlen(TABLEPRE)) == TABLEPRE)
    { 	
 	$temp_arr[] = $v ;
    }
 }
$tables = $temp_arr;
if (isset ( $sbt_edit )) {
	echo "<div align=\"left\"><b><font color=\"red\">注：</font>生成的数据库*.sql文件存放在网站根目录/data/backup/下</b><br><br>";
	foreach ($tables as $tablesarr) {
		 
		$table_name = $tablesarr ['Name'];
		 
		echo "正在备份数据表：<b>" . $table_name . "</b><br>";
		$table_type = $tablesarr ['Type'];
		$result =$db_factory->query ( "show fields from " . $table_name );
		
		$sqlmsg .= "#表名：<" . $table_name . ">\n";
		
		$sqlmsg .="DROP TABLE IF EXISTS `" . $table_name . "`;\n####################\n";
		
		$sqlmsg .= "CREATE TABLE `" . $table_name . "`(\n";
		
		foreach ($result as $fileds) {
		
			$field_name = $fileds ['Field']; 
			$field_type = $fileds ['Type']; 
			$field_len = $fileds ['Null']; 
	 
			if ($fileds ['Extra'] != ""){
				$fileds ['Extra'] = " " . $fileds ['Extra'];
			}
				
			if ($field_len != ""){
				$field_len = " " . $field_len;
			}
				
			if(isset($fileds ['Default'])){
				$field_flag = "default '" . $fileds ['Default'] . "'" . $fileds ['Extra']; //字段标志
			}else{
				$field_flag = "default NULL" . $fileds ['Extra']; //字段标志
			}
			
			if($fileds['Key']=='PRI'){
				$field_flag = " NOT NULL " . $fileds ['Extra']; //字段标志
			}
			
			$fields [] = $field_name;
			$sqlmsg .= " `" . $field_name . "` " . $field_type  . " " . $field_flag . ",\n";
			 
		}
		
		$key_result = $db_factory->query ( "show keys from " . $table_name );
		
		foreach ($key_result as $keyr) {
		
			if ($keyr ["Key_name"] == "PRIMARY")
				$sqlmsg .= " PRIMARY KEY (`" . $keyr ["Column_name"] . "`),\n";
			elseif (($keyr ["Key_name"] != "PRIMARY") && ($keyr ["Non_unique"] == 0))
				$sqlmsg .= " UNIQUE KEY " . $keyr ["Key_name"] . " (`" . $keyr ["Column_name"] . "`),\n";
			elseif ($keyr ["Comment"] == "FULLTEXT")
				$sqlmsg .= " FULLTEXT " . $keyr ["Key_name"] . " (`" . $keyr ["Column_name"] . "`),\n";
			else
				$sqlmsg .= " KEY " . $keyr ["Key_name"] . " (`" . $keyr ["Column_name"] . "`),\n";
		}
		
		$sqlmsg = preg_replace ( "/\,$/", "", $sqlmsg );
		$sqlmsg .= " ) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=gbk ;\n####################\n";
		
		
		$field = join ( ",", $fields );
		 
		$sql = $db_factory->query ( "select " . $field . " from " . $table_name ) ;

		$field_a =explode(',',$field);
		
		foreach ($sql as $r) {
			
			$sqlmsg .= "insert into " . $table_name . " (" . $field . ") values(";
			$iii = 0;
			foreach($r as $k=>$v) {
				if ($iii++)
				{
					$sqlmsg.=",";
				}
				if($v){
					$sqlmsg .= "'" . Func_comm_class::k_addslashes($v) . "'";
				}else{
					$sqlmsg .= "'0'";
				}
				
			}
			
			
			$sqlmsg .= ");\n";
			
		}
		unset ( $fields ); 
	}

	$sqlmsg .= "\n "; 
	$sqlmsg = $headmsg . $sqlmsg;
	$path = S_ROOT.'./data/backup/backup_'.time().'_'.DBNAME. ".sql";
    Template_Class::swritefile($path,$sqlmsg);
	Func_comm_class::adminSystemLog("备份数据库");
	if(file_exists($path)){
		echo '<br><b>数据库备份成功,文件名为<font color=\'red\'>“backup_'.time().'_'.DBNAME.'.sql”</font>';
	}else{
		echo '<br><b>数据库备份失败,请<a href=\'index.php?do='.$do.'&view='.$view.'\'>重新操作！</a>';
	}
	
}else{
	require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do . '_' . $view );
}
