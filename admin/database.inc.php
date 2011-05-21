<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/include/sql.func.php';
$menus = array (
    array('数据库备份', '?file='.$file),
    array('数据库恢复', '?file='.$file.'&action=import'),
    array('字符替换', '?file='.$file.'&action=replace'),
    array('执行SQL', '?file='.$file.'&action=execute'),
    array('数据互转', '?file='.$file.'&action=move'),
    array('数据导入', '?file=data'),
);
$this_forward = '?file='.$file;
$D = DT_ROOT.'/file/backup/';
isset($dir) or $dir = '';
switch($action) {
	case 'repair':
		if(!$tables) msg();
		if(is_array($tables)) {
			foreach($tables as $table) {
				$db->query("REPAIR TABLE `$table`");
			}
		} else {
			$db->query("REPAIR TABLE `$tables`");
		}
		dmsg('修复成功', $this_forward);
	break;
	case 'optimize':
		if(!$tables) msg();
		if(is_array($tables)) {
			foreach($tables as $table) {
				$db->query("OPTIMIZE TABLE `$table`");
			}
		} else {
			$db->query("OPTIMIZE TABLE `$tables`");
		}
		dmsg('优化成功', $this_forward);
	break;
	case 'drop':
		if(!$tables) msg();
		if(is_array($tables)) {
			foreach($tables as $table) {
				if(strpos($table, $DT_PRE) === false) $db->query("DROP TABLE `$table`");
			}
		}
		dmsg('删除成功', $this_forward);
	break;
	case 'execute':
		if(!isset($CFG['executesql']) || !$CFG['executesql']) msg('系统禁止了执行SQL，请FTP修改根目录config.inc.php<br/>$CFG[\'executesql\'] = \'0\'; 修改为 $CFG[\'executesql\'] = \'1\';');
		if($submit) {
			if(trim($sql) == '') {
				msg('SQL语句为空');
			} else {
				$sql = stripslashes($sql);
				if(preg_match("/DROP(.*)(TABLE|DATABASE)/i", $sql)) msg('系统禁止DROP语句');				
				sql_execute($sql);
				dmsg('执行成功', '?file='.$file.'&action=execute');
			}
		} else {
			include tpl('database_execute');
		}
	break;
	case 'comments':
		$db->halt = 0;
		$C = include(DT_ROOT.'/file/setting/table-comment.php');
		foreach($C as $k=>$v) {
			$sql = "ALTER TABLE `{$DT_PRE}{$k}` COMMENT='{$v}'";
			$db->query($sql);
		}
		foreach($MODULE as $k=>$v) {
			if(in_array($v['module'], array('article', 'info'))) {
				$sql = "ALTER TABLE `".$DT_PRE.$v['module']."_".$v['moduleid']."` COMMENT='".$v['name']."'";
				$db->query($sql);
				$sql = "ALTER TABLE `".$DT_PRE.$v['module']."_data_".$v['moduleid']."` COMMENT='".$v['name']."内容'";
				$db->query($sql);
			}
		}
		dmsg('重建成功', '?file='.$file);
	break;
	case 'comment':
		$table or msg('Table为空');
		if($submit) {
			$name = trim($name);
			$db->query("ALTER TABLE `{$table}` COMMENT='{$name}'");
			dmsg('修改成功', '?file='.$file);
		} else {
			include tpl('database_comment');
		}
	break;
	case 'export':
		if(!$table) msg();
		//$memory_limit = trim(@ini_get('memory_limit'));
		$sizelimit = 1024*1024;//Max 1G
		file_down('', $table.'.sql', sql_dumptable($table));
	break;
	case 'download':
		$file_ext = file_ext($filename);
		if($file_ext != 'sql') msg('只能下载SQL文件');
		file_down($dir ? $D.$dir.'/'.$filename : $D.$filename);
	break;
	case 'upload':
		if(!isset($CFG['executesql']) || !$CFG['executesql']) msg('系统禁止了执行SQL，请FTP修改根目录config.inc.php<br/>$CFG[\'executesql\'] = \'0\'; 修改为 $CFG[\'executesql\'] = \'1\';');
		require DT_ROOT.'/include/upload.class.php';
		$upload = new upload($_FILES, 'file/backup/', $uploadfile_name, 'sql');
		$upload->adduserid = false;
		if($upload->uploadfile()) dmsg('上传成功', '?file='.$file.'&action=import&back=success');
		msg($upload->errmsg);
	break;
	case 'delete':
		if(!is_array($filenames)) {
			$tmp = $filenames;
			$filenames = array();
			$filenames[0] = $tmp;
		}
		foreach($filenames as $filename) {
			if(file_ext($filename) == 'sql') {
				file_del($dir ? $D.$dir.'/'.$filename : $D.$filename);
			} else if(is_dir($D.$filename)) {
				dir_delete($D.$filename);
			}
		}
		dmsg('删除成功', $forward);
	break;
	case 'move':
		if($submit) {
			$condition = str_replace('and', 'AND', trim($condition));
			$condition = strpos($condition, 'AND') === false ? "itemid IN ($condition)" : substr($condition, 3);
			if($type == 1) {
				$ftb = $DT_PRE.'sell';
				$ftb_data = $DT_PRE.'sell_data';
				$ttb = $DT_PRE.'buy';
				$ttb_data = $DT_PRE.'buy_data';
				$fmid = 5;
			} else if($type == 2) {
				$ftb = $DT_PRE.'buy';
				$ftb_data = $DT_PRE.'buy_data';
				$ttb = $DT_PRE.'sell';
				$ttb_data = $DT_PRE.'sell_data';
				$fmid = 6;
			} else if($type == 3) {
				$ftb = $DT_PRE.'article_'.$afid;
				$ftb_data = $DT_PRE.'article_data_'.$afid;
				$ttb = $DT_PRE.'article_'.$atid;
				$ttb_data = $DT_PRE.'article_data_'.$atid;
				$fmid = $afid;
			} else if($type == 4) {
				$ftb = $DT_PRE.'info_'.$ifid;
				$ftb_data = $DT_PRE.'info_data_'.$ifid;
				$ttb = $DT_PRE.'info_'.$itid;
				$ttb_data = $DT_PRE.'info_data_'.$itid;
				$fmid = $ifid;
			} else {
				message('请选择转移类型');
			}
			$i = 0;
			$fs = array();
			$result = $db->query("SHOW COLUMNS FROM `$ttb`");
			while($r = $db->fetch_array($result)) {
				$fs[] = $r['Field'];
			}
			$result = $db->query("SELECT * FROM {$ftb} WHERE $condition");
			while($r = $db->fetch_array($result)) {
				$fid = $r['itemid'];
				unset($r['itemid']);
				$r['catid'] = $catid;
				$r = daddslashes($r);
				$d = $db->get_one("SELECT content FROM {$ftb_data} WHERE itemid=$fid");
				$content = daddslashes($d['content']);			
				$sqlk = $sqlv = '';
				foreach($r as $k=>$v) {
					if($fs && !in_array($k, $fs)) continue;
					$sqlk .= ','.$k; $sqlv .= ",'$v'";
				}
				$sqlk = substr($sqlk, 1);
				$sqlv = substr($sqlv, 1);
				$db->query("INSERT INTO {$ttb} ($sqlk) VALUES ($sqlv)");
				$tid = $db->insert_id();
				$db->query("INSERT INTO {$ttb_data} (itemid,content)  VALUES ('$tid', '$content')");
				if($delete) {
					$db->query("DELETE FROM {$ftb} WHERE itemid=$fid");
					$db->query("DELETE FROM {$ftb_data} WHERE itemid=$fid");
					$html = DT_ROOT.'/'.$MODULE[$fmid]['moduledir'].'/'.$r['linkurl'];
					if(is_file($html)) @unlink($html);
				}
				$i++;
			}
			message('成功转移 '.$i.' 条数据', '?file='.$file.'&action='.$action, 2);
		} else {
			include tpl('database_move');
		}
	break;
	case 'replace':
		if($submit) {
			if(!$table || !$fields) msg('请选择字段');
			if($type == 1) {
				if(!$from) msg('请填写查找内容');
				$from = stripslashes($from);
				$to = stripslashes($to);
			} else {
				if(!$add) msg('请填写追加内容');
				$add = stripslashes($add);
			}
			if($conditon) $conditon = stripslashes($conditon);
			$key = '';
			$result = $db->query("SHOW COLUMNS FROM `$table`");
			while($r = $db->fetch_array($result)) {
				if($r['Key'] == 'PRI') {
					$key = $r['Field'];
					break;
				}
			}
			$key or msg('表'.$table.'无主键，无法完成操作');
			$key != $fields or msg('无法完成主键操作');
			$result = $db->query("SELECT `$fields`,`$key` FROM `$table` WHERE 1 $condition");
			while($r = $db->fetch_array($result)) {
				$value = '';
				if($type == 1) {
					$value = str_replace($from, $to, $r[$fields]);
				} else if($type == 2) {
					$value = $add.$r[$fields];
				} else if($type == 3) {
					$value = $r[$fields].$add;
				} else {
					msg();
				}
				$value = addslashes($value);
				$db->query("UPDATE `$table` SET $fields='".$value."' WHERE `$key`='".$r[$key]."'");
			}
			dmsg('操作成功', '?file='.$file.'&action='.$action);
		} else {
			$table_select = '';
			$query = $db->query("SHOW TABLES FROM `".$CFG['db_name']."`");
			while($r = $db->fetch_row($query)) {
				$table = $r[0];
				if(preg_match("/^".$DT_PRE."/i", $table)) {
					$table_select .= '<option value="'.$table.'">'.$table.'</option>';         
				}
			}
			$sql_select = '';
			$sqlfiles = glob($D.'*');
			if(is_array($sqlfiles)) {				
				$sqlfiles = array_reverse($sqlfiles);
				foreach($sqlfiles as $id=>$sqlfile)	{
					$tmp = basename($sqlfile);
					if(is_dir($sqlfile)) $sql_select .= '<option value="'.$tmp.'">'.$tmp.'</option>'; 
				}
			}
			include tpl('database_replace');
		}
	break;
	case 'fields':
		(isset($table) && $table) or exit;
		$fields_select = '';
		$result = $db->query("SHOW COLUMNS FROM `$table`");
		while($r = $db->fetch_array($result)) {
			$fields_select .= '<option value="'.$r['Field'].'">'.$r['Field'].'</option>';
		}
		echo '<select name="fields" id="fd"><option value="">选择字段</option>'.$fields_select.'</select>';
		exit;
	break;
	case 'file_replace':
		if(!$file_pre) msg('请选择或者填写备份文件前缀');
		if(!$file_from) msg('请请填写查找内容');
		$fileid = isset($fileid) ? $fileid : 1;
		$filename = $file_pre.'/'.$fileid.'.sql';
		$dfile = $D.$filename;
		$file_from = urldecode($file_from);
		$file_to = urldecode($file_to);
		if(is_file($dfile)) {
			$sql = file_get($dfile);
			$sql = str_replace($file_from, $file_to, $sql);
			file_put($dfile, $sql);
			msg('分卷 <strong>#'.$fileid++.'</strong> 替换成功 程序将自动继续...', '?file='.$file.'&action='.$action.'&file_pre='.$file_pre.'&fileid='.$fileid.'&file_from='.urlencode($file_from).'&file_to='.urlencode($file_to));
		} else {
			msg('文件内容替换成功', '?file='.$file.'&action=replace');
		}
	break;
	case 'open':
		if(!$dir) msg('请选择备份系列');
		if(!is_dir($D.$dir)) msg('备份系列不存在');
		$sql = $sqls = array();
		$sqlfiles = glob($D.$dir.'/*.sql');
		if(!$sqlfiles) msg('备份系列文件不存在');
		foreach($sqlfiles as $id=>$sqlfile)	{
			$tmp = basename($sqlfile);
			$sql['filename'] = $tmp;
			$sql['filesize'] = round(filesize($sqlfile)/(1024*1024), 2);
			$sql['pre'] = $dir;
			$sql['number'] = str_replace('.sql', '', $tmp);
			$sql['mtime'] = timetodate(filemtime($sqlfile), 5);
			$sql['btime'] = substr(str_replace('.', ':', $dir), 0, -3);
			$sqls[] = $sql;
		}
		include tpl('database_open');
	break;
	case 'import':
		if(isset($import)) {
			if(isset($filename) && $filename && file_ext($filename) == 'sql') {
				$dfile = $D.$filename;
				if(!is_file($dfile)) msg('文件不存在，请检查');
				$sql = file_get($dfile);
				sql_execute($sql);
				msg($filename.' 导入成功', '?file='.$file.'&action=import');
			} else {
				$fileid = isset($fileid) ? $fileid : 1;
				$filename = is_dir($D.$filepre) ? $filepre.'/'.$fileid : $filepre.$fileid;
				$filename = $D.$filename.'.sql';
				if(is_file($filename)) {
					$sql = file_get($filename);
					sql_execute($sql);
					msg('分卷 <strong>#'.$fileid++.'</strong> 导入成功 程序将自动继续...', '?file='.$file.'&action='.$action.'&filepre='.$filepre.'&fileid='.$fileid.'&import=1');
				} else {
					msg('数据库恢复成功', '?file='.$file.'&action=import');
				}
			}
		} else {
			$dbak = $dbaks = $dsql = $dsqls = $sql = $sqls = array();
			$sqlfiles = glob($D.'*');
			if(is_array($sqlfiles)) {
				$class = 1;
				foreach($sqlfiles as $id=>$sqlfile)	{
					$tmp = basename($sqlfile);
					if(is_dir($sqlfile)) {
						$dbak['filename'] = $tmp;
						$size = $number = 0;
						$ss = glob($D.$tmp.'/*.sql');
						foreach($ss as $s) {
							$size += filesize($s);
							$number++;
						}
						$dbak['filesize'] = round($size/(1024*1024), 2);
						$dbak['pre'] = $tmp;
						$dbak['number'] = $number;
						$dbak['mtime'] = str_replace('.', ':', substr($tmp,	0, 19));
						$dbak['btime'] = substr($dbak['mtime'], 0, -3);
						$dbaks[] = $dbak;
					} else {
						if(preg_match("/([a-z0-9_]+_[0-9]{8}_[0-9a-z]{8}_)([0-9]+)\.sql/i", $tmp, $num)) {
							$dsql['filename'] = $tmp;
							$dsql['filesize'] = round(filesize($sqlfile)/(1024*1024), 2);
							$dsql['pre'] = $num[1];
							$dsql['number'] = $num[2];
							$dsql['mtime'] = timetodate(filemtime($sqlfile), 5);	if(preg_match("/[a-z0-9_]+_([0-9]{4})([0-9]{2})([0-9]{2})_([0-9]{2})([0-9]{2})([0-9a-z]{4})_/i", $num[1], $tm)) {
								$dsql['btime'] = $tm[1].'-'.$tm[2].'-'.$tm[3].' '.$tm[4].':'.$tm[5];
							} else {
								$dsql['btime'] = $dsql['mtime'];
							}
							if($dsql['number'] == 1) $class = $class  ? 0 : 1;
							$dsql['class'] = $class;
							$dsqls[] = $dsql;
						} else {
							if(file_ext($tmp) != 'sql') continue;
							$sql['filename'] = $tmp;
							$sql['filesize'] = round(filesize($sqlfile)/(1024*1024),2);
							$sql['mtime'] = timetodate(filemtime($sqlfile), 5);
							$sqls[] = $sql;
						}
					}
				}
			}
		}
		if($dbaks) $dbaks = array_reverse($dbaks);
		include tpl('database_import');
	break;
	default:
		if(isset($backup)) {
			$fileid = isset($fileid) ? intval($fileid) : 1;
			if($fileid == 1 && $tables) {
				if(!isset($tables) || !is_array($tables)) msg('请选择需要备份的表');
				$random = date('Y-m-d H.i.s', $DT_TIME).' '.strtolower(random(10));
				cache_write($_username.'_backup.php', $tables);
			} else {
				if(!$tables = cache_read($_username.'_backup.php')) msg('请选择需要备份的表');
			}
			$sizelimit = $sizelimit ? intval($sizelimit) : 2048;
			$dumpcharset = $sqlcharset ? $sqlcharset : $CFG['db_charset'];
			$setnames = ($sqlcharset && $db->version() > '4.1' && (!$sqlcompat || $sqlcompat == 'MYSQL41')) ? "SET NAMES '$dumpcharset';\n\n" : '';
			if($db->version() > '4.1') {
				if($sqlcharset) $db->query("SET NAMES '".$sqlcharset."';\n\n");
				if($sqlcompat == 'MYSQL40')	{
					$db->query("SET SQL_MODE='MYSQL40'");
				} else if($sqlcompat == 'MYSQL41') {
					$db->query("SET SQL_MODE=''");
				}
			}
			$sqldump = '';
			$tableid = isset($tableid) ? $tableid - 1 : 0;
			$startfrom = isset($startfrom) ? intval($startfrom) : 0;
			$tablenumber = count($tables);
			for($i = $tableid; $i < $tablenumber && strlen($sqldump) < $sizelimit * 1000; $i++) {
				$sqldump .= sql_dumptable($tables[$i], $startfrom, strlen($sqldump));
				$startfrom = 0;
			}
			if(trim($sqldump)) {
				$sqldump = "# Destoon V".DT_VERSION." R".DT_RELEASE." http://www.destoon.com\n# ".date('Y-m-d H:i:s', $DT_TIME)."\n# --------------------------------------------------------\n\n\n".$sqldump;
				$tableid = $i;
				$filename = $random.'/'.$fileid.'.sql';
				file_put($D.$filename, $sqldump);
				msg('分卷 <strong>#'.$fileid++.'</strong> 备份成功.. 程序将自动继续...', '?file='.$file.'&sizelimit='.$sizelimit.'&sqlcompat='.$sqlcompat.'&sqlcharset='.$sqlcharset.'&tableid='.$tableid.'&fileid='.$fileid.'&startfrom='.$startrow.'&random='.$random.'&backup=1');
			} else {
			   cache_delete($_username.'_backup.php');
			   $db->query("DELETE FROM {$DT_PRE}setting WHERE item='destoon' AND item_key='backtime'");
			   $db->query("INSERT INTO {$DT_PRE}setting (item,item_key,item_value) VALUES('destoon','backtime','$DT_TIME')");
			   msg('数据库备份成功', '?file='.$file.'&action=import');
			}
		} else {
			$dtables = $tables = $C = array();
			$i = $j = $dtotalsize = $totalsize = 0;
			$result = $db->query("SHOW TABLES FROM `".$CFG['db_name']."`");
			while($rr = $db->fetch_row($result)) {
				if(!$rr[0]) continue;
				$r = $db->get_one("SHOW TABLE STATUS FROM `".$CFG['db_name']."` LIKE '".$rr[0]."'");
				if(preg_match('/^'.$DT_PRE.'/', $rr[0])) {
					$dtables[$i]['name'] = $r['Name'];
					$dtables[$i]['rows'] = $r['Rows'];
					$dtables[$i]['size'] = round($r['Data_length']/1024/1024, 2);
					$dtables[$i]['auto'] = $r['Auto_increment'];
					$dtables[$i]['updatetime'] = $r['Update_time'];
					$dtables[$i]['note'] = $r['Comment'];
					$dtotalsize += $r['Data_length'];
					//$C[str_replace($DT_PRE, '', $r['Name'])] = $r['Comment'];
					$i++;
				} else {
					$tables[$j]['name'] = $r['Name'];
					$tables[$j]['rows'] = $r['Rows'];
					$tables[$j]['size'] = round($r['Data_length']/1024/1024, 2);
					$tables[$j]['auto'] = $r['Auto_increment'];
					$tables[$j]['updatetime'] = $r['Update_time'];
					$tables[$j]['note'] = $r['Comment'];
					$totalsize += $r['Data_length'];
					$j++;
				}
			}
			//cache_write('table-comment.php', $C);
			$dtotalsize = round($dtotalsize/1024/1024, 2);
			$totalsize = round($totalsize/1024/1024, 2);
			include tpl('database');
		}
	break;
}
?>