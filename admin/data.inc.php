<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/include/module.func.php';
$menus = array (
    array('数据导入', '?file='.$file),
    array('数据备份', '?file=database'),
);
$this_forward = '?file='.$file;
isset($name) or $name = '';
if($name && !preg_match("/^[0-9a-z_\-\.]+$/i", $name)) msg('不是一个有效的文件名');
switch($action) {
	case 'config':
		if($submit) {
			$data['name'] = $name;
			$data['edittime'] = timetodate($DT_TIME, 5);
			file_put(DT_ROOT.'/file/data/'.$data['name'].'.php', '<?php $data = '.var_export($data, true).'; ?>');
			dmsg('保存成功', '?file='.$file);
		} else {
			$title = $db_host = $db_user = $db_pass = $db_name = $db_table = $db_condition = $db_key = $db_charset = $code = $lasttime = $lastid = '';
			$database = 'mysql';
			$fields = $fields_d = $_fields = array();
			$edit = false;
			if($name) {
				@include DT_ROOT.'/file/data/'.$name.'.php';
				$data = dstripslashes($data);
				extract($data);
				$edit = true;
				$_fields = $fields;
				$fields = array();
				$inc = DT_ROOT.'/file/data/'.$name.'.inc.php';
				if(is_file($inc) && $code = file_get($inc)) $code = substr($code, 53, -3);
			}
			if($type == 0 && $mid == 0) msg('请选择模型');
			if($type == 2 && $tb == '') msg('请选择表');
			if($type == 0) {
				$sc_table = get_table($mid);
				$fields_d['content']['name'] = $edit ? $_fields['content']['name'] : '';
				$fields_d['content']['value'] = $edit ? $_fields['content']['value'] : '';
			} else if($type == 1) {
				$sc_table = $DT_PRE.'member';
				$result = $db->query("SHOW COLUMNS FROM `{$DT_PRE}company`");
				while($r = $db->fetch_array($result)) {
					if(in_array($r['Field'], array('userid', 'username', 'groupid'))) continue;
					$k = $r['Field'];
					$fields_d[$k]['name'] = $edit ? $_fields[$k]['name'] : '';
					$fields_d[$k]['value'] = $edit ? $_fields[$k]['value'] : '';
				}
			} else if($type == 2) {
				$sc_table = $DT_PRE.$tb;
			}
			$result = $db->query("SHOW COLUMNS FROM `$sc_table`");
			while($r = $db->fetch_array($result)) {
				$k = $r['Field'];
				$fields[$k]['name'] = $edit ? $_fields[$k]['name'] : '';
				$fields[$k]['value'] = $edit ? $_fields[$k]['value'] : '';
			}
			$names = array(
				'itemid' => 'ID',
				'userid' => '会员ID',
				'username' => '会员名',
				'title' => '标题',
				'style' => '标题颜色',
				'level' => '级别',
				'introduce' => '简介',
				'keyword' => '关键词',
				'tag' => '产品名/标签',
				'fee' => '收费',
				'listorder' => '排序',
				'typeid' => '类别',
				'catid' => '分类ID',
				'areaid' => '地区ID',
				'addtime' => '添加时间',
				'adddate' => '添加日期',
				'edittime' => '修改时间',
				'editdate' => '修改日期',
				'editor' => '编辑',
				'fromtime' => '开始时间',
				'totime' => '过期时间',
				'thumb' => '标题图',
				'thumb1' => '标题图',
				'thumb2' => '标题图',
				'hits' => '浏览次数',
				'islink' => '外部链接',
				'company' => '公司名',
				'ip' => 'IP地址',
				'template' => '模板',
				'status' => '状态',
				'linkurl' => 'URL地址',
				'filepath' => '文件地址',
				'note' => '备注',
				'author' => '作者',
				'copyfrom' => '来源',
				'fromurl' => '来源链接',
				'voteid' => '投票ID',
				'vip' => 'VIP级别',
				'validated' => '认证',
				'pid' => '产品ID',
				'mycatid' => '自定义分类',
				'elite' => '公司主页推荐',
				'model' => '产品型号',
				'standard' => '产品规格',
				'brand' => '品牌',
				'unit' => '单位',
				'price' => '价格',
				'minamount' => '起定量',
				'amount' => '供货总量',
				'days' => '发货时间',
				'pack' => '包装要求',
				'telephone' => '电话',
				'mobile' => '手机',
				'fax' => '传真',
				'email' => 'E-mail',
				'mail' => 'E-mail',
				'gender' => '性别',
				'groupid' => '会员组',
				'truename' => '姓名/联系人',
				'address' => '地址',
				'postcode' => '邮编',
				'msn' => 'MSN',
				'qq' => 'QQ',
				'passport' => '通行证',
				'password' => '登录密码',
				'payword' => '支付密码',
				'content' => '内容',
			);
			if($type == 1) {
				$names['content'] = '公司介绍';
			}
			include tpl('data_config');
		}
	break;
	case 'download':
		if($name) file_down(DT_ROOT.'/file/data/'.$name.'.php');
		msg();
	break;
	case 'delete':
		 if($name) {
			file_del(DT_ROOT.'/file/data/'.$name.'.php');
			file_del(DT_ROOT.'/file/data/'.$name.'.inc.php');
		}
		dmsg('删除成功', '?file='.$file);
	break;
	case 'view':
		$data = array();
		@include DT_ROOT.'/file/data/'.$name.'.php';
		$data = dstripslashes($data);
		extract($data);
		if($database == 'mysql') {
			if($db_host && $db_user && $db_name) {
				$sc = new db_mysql;
				$sc->connect($db_host, $db_user, $db_pass, $db_name, $CFG['db_expires'], $CFG['db_charset'], $CFG['pconnect']);
			} else {
				$sc = &$db;
			}
		} else if($database == 'mssql') {
			require DT_ROOT.'/include/db_mssql.class.php';
			$sc = new db_mssql;
			$sc->connect($db_host, $db_user, $db_pass, $db_name);
		} else if($database == 'access') {
			require DT_ROOT.'/include/db_access.class.php';
			$sc = new db_access;
			$sc->connect(DT_ROOT.'/'.$db_host, $db_user, $db_pass, $db_table);
		} else {
			msg('配置文件错误');
		}
		$result = $sc->query("SELECT * FROM {$db_table} WHERE $db_key>$lastid $db_condition");
		while($F = $sc->fetch_array($result)) {
			$T = array();
			if($db_charset) $F = convert($F, $db_charset, DT_CHARSET);
			foreach($fields as $k=>$v) {
				if($v['value']) {
					if(strpos($v['value'], '*') !== false || strpos($v['value'], '$') !== false) {
						$a = $v['name'] ? (isset($F[$v['name']]) ? $F[$v['name']] : '') : '';
						$tmp = str_replace('*', '$a', $v['value']);
						$b = NULL;
						eval("\$b = $tmp;");
						if($b != NULL) $T[$k] = $b;
					} else {
						$T[$k] = $v['value'];
					}
				} else if($v['name']) {
					if(isset($F[$v['name']])) $T[$k] = $F[$v['name']];
				}
			}
			@include DT_ROOT.'/file/data/'.$name.'.inc.php';
			include tpl('data_view');
			exit;
		}
	break;
	case 'import':
		$data = array();
		@include DT_ROOT.'/file/data/'.$name.'.php';
		$data = dstripslashes($data);
		extract($data);
		if($database == 'mysql') {
			if($db_host && $db_user && $db_name) {
				$sc = new db_mysql;
				$sc->connect($db_host, $db_user, $db_pass, $db_name, $CFG['db_expires'], $CFG['db_charset'], $CFG['pconnect']);
			} else {
				$sc = &$db;
			}
		} else if($database == 'mssql') {
			require DT_ROOT.'/include/db_mssql.class.php';
			$sc = new db_mssql;
			$sc->connect($db_host, $db_user, $db_pass, $db_name);
		} else if($database == 'access') {
			require DT_ROOT.'/include/db_access.class.php';
			$sc = new db_access;
			$sc->connect(DT_ROOT.'/'.$db_host, $db_user, $db_pass, $db_table);
		} else {
			msg('配置文件错误');
		}
		$key = strpos($db_key, '.') !== false ? trim(substr(strrchr($db_key, '.'), 1)) : $db_key;
		if(!isset($fid)) {
			$r = $sc->get_one("SELECT min($db_key) AS fid FROM {$db_table} WHERE $db_key>$lastid $db_condition");
			$fid = $r['fid'] ? $r['fid'] : 0;
		}
		if(!isset($tid)) {
			$r = $sc->get_one("SELECT max($db_key) AS tid FROM {$db_table} WHERE $db_key>$lastid $db_condition");
			$tid = $r['tid'] ? $r['tid'] : 0;
		}
		isset($total) or $total = 0;
		isset($num) or $num = 500;
		if($fid <= $tid) {
			$result = $sc->query("SELECT * FROM {$db_table} WHERE $db_key>$lastid AND $db_key>=$fid $db_condition ORDER BY $db_key LIMIT 0,$num ");
			if($sc->affected_rows($result)) {
				while($F = $sc->fetch_array($result)) {
					if($db_charset) $F = convert($F, $db_charset, DT_CHARSET);
					$keyid = $F[$key];
					$T = array();
					foreach($fields as $k=>$v) {
						if($v['value']) {
							if(strpos($v['value'], '*') !== false || strpos($v['value'], '$') !== false) {
								$a = $v['name'] ? (isset($F[$v['name']]) ? $F[$v['name']] : '') : '';
								$tmp = str_replace('*', '$a', $v['value']);
								$b = NULL;
								eval("\$b = $tmp;");
								if($b != NULL) $T[$k] = $b;
							} else {
								$T[$k] = $v['value'];
							}
						} else if($v['name']) {
							if(isset($F[$v['name']])) $T[$k] = $F[$v['name']];
						}
					}
					@include DT_ROOT.'/file/data/'.$name.'.inc.php';
					$T = daddslashes($T);
					if($type == 0) {
						if(isset($T['content'])) {
							$content = $T['content'];
							unset($T['content']);
						} else {
							$content = '';
						}
						$sqlk = $sqlv = '';
						foreach($T as $k=>$v) {
							$sqlk .= ','.$k; $sqlv .= ",'$v'";
						}
						$sqlk = substr($sqlk, 1);
						$sqlv = substr($sqlv, 1);
						$db->query("INSERT INTO ".get_table($mid)." ($sqlk) VALUES ($sqlv)");
						$itemid = $db->insert_id();
						$db->query("INSERT INTO ".get_table($mid, 1)." (itemid,content)  VALUES ('$itemid', '$content')");
					} else if($type == 1) {
						if(isset($T['content'])) {
							$content = $T['content'];
							unset($T['content']);
						} else {
							$content = '';
						}
						$table_member = $DT_PRE.'member';
						$table_company = $DT_PRE.'company';
						$table_company_data = $DT_PRE.'company_data';
						$m = $db->get_one("SELECT userid FROM {$table_member} WHERE username='$T[username]' OR email='$T[email]'");
						if($m) continue;
						$mfs = cache_read($table_member.'.php');
						if(!$mfs) {
							$mfs = array();
							$result = $db->query("SHOW COLUMNS FROM `$table_member`");
							while($r = $db->fetch_array($result)) {
								$mfs[] = $r['Field'];
							}
							cache_write($table_member.'.php', $mfs);
						}
						$cfs = cache_read($table_company.'.php');
						if(!$cfs) {
							$cfs = array();
							$result = $db->query("SHOW COLUMNS FROM `$table_company`");
							while($r = $db->fetch_array($result)) {
								$cfs[] = $r['Field'];
							}
							cache_write($table_company.'.php', $cfs);
						}
						$sqlk = $sqlv = '';
						foreach($T as $k=>$v) {
							if(!in_array($k, $mfs)) continue;
							$sqlk .= ','.$k; $sqlv .= ",'$v'";
						}
						$sqlk = substr($sqlk, 1);
						$sqlv = substr($sqlv, 1);
						$db->query("INSERT INTO {$table_member} ($sqlk) VALUES ($sqlv)");
						$userid = $db->insert_id();
						$T['userid'] = $userid;
						$sqlk = $sqlv = '';
						foreach($T as $k=>$v) {
							if(!in_array($k, $cfs)) continue;
							$sqlk .= ','.$k; $sqlv .= ",'$v'";
						}
						$sqlk = substr($sqlk, 1);
						$sqlv = substr($sqlv, 1);
						$db->query("INSERT INTO {$table_company} ($sqlk) VALUES ($sqlv)");
						$content_table = content_table(4, $userid, is_file(DT_CACHE.'/4.part'), $table_company_data);
						$db->query("INSERT INTO {$content_table} (userid,content)  VALUES ('$userid', '$content')");
					} else if($type == 2) {
						$sqlk = $sqlv = '';
						foreach($T as $k=>$v) {
							$sqlk .= ','.$k; $sqlv .= ",'$v'";
						}
						$sqlk = substr($sqlk, 1);
						$sqlv = substr($sqlv, 1);
						$db->query("INSERT INTO {$DT_PRE}{$tb} ($sqlk) VALUES ($sqlv)");
					}
					$total++;
				}
				$keyid += 1;
			} else {
				$keyid = $fid + $num;
			}
		} else {
			$data = array();
			$cf = DT_ROOT.'/file/data/'.$name.'.php';
			@include $cf;
			$data['lasttime'] = timetodate($DT_TIME, 5);
			$data['lastid'] = $tid;
			file_put($cf, '<?php $data = '.var_export($data, true).'; ?>');
			msg('转换成功,成功导入 <strong>'.$total.'</strong> 条数据', "?file=$file", 10);
		}
		msg('ID从'.$fid.'至'.($keyid-1).'转换成功 当前已导入 <strong>'.$total.'</strong> 条数据', "?file=$file&action=$action&name=$name&fid=$keyid&tid=$tid&num=$num&total=$total");
	break;
	default:
		$files = glob(DT_ROOT.'/file/data/*.php', GLOB_NOSORT);
		$lists = $tables = array();
		foreach($files as $f) {
			if(strpos(basename($f), '.inc.') !== false) continue;
			$data = array();
			include $f;
			$lists[] = $data;
		}
		$i = 0;
		$result = $db->query("SHOW TABLES FROM `".$CFG['db_name']."`");
		while($rr = $db->fetch_row($result)) {
			$r = $db->get_one("SHOW TABLE STATUS FROM `".$CFG['db_name']."` LIKE '".$rr[0]."'");
			if(preg_match('/^'.$DT_PRE.'/', $rr[0])) {
				$tables[$i]['name'] = str_replace($DT_PRE, '', $r['Name']);
				$tables[$i]['note'] = $r['Comment'];
				$i++;
			}
		}
		include tpl('data');
	break;
}
?>