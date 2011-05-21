<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/

/* 
采集软件入库接口 For Destoon
支持POST或GET两种方式发送数据
例如：
文章模型入库可发送 http://www.xxx.com/api/spider.php?moduleid=21&catid=1&title=测试标题&content=测试内容
获取栏目分类可请求 http://www.xxx.com/api/spider.php?moduleid=21&action=cat
返回状态会直接输出，请注意判断
为了系统安全，强烈建议修改spider.php文件名
*/

$verify_mode = 4; //身份验证模式
//1 验证是否为创始人，需要登录
//2 验证密钥，如果设置为2，则必须设置 入库密钥[推荐]
//3 验证IP，如果设置为3，则必须设置 允许的IP
//4 关闭接口

$spider_auth = '';   //入库密钥 最少6位
$spider_ip = '';     //允许的IP
$spider_status = 3;  //信息状态 2为待审核 3为通过 0为通过软件发送
$spider_errlog = 0;  //错误日志 0关闭 1开启 开启后系统将记录错误日志至api/spider/目录,以便调试(spider目录需要可写入)
$spider_mode = 0; //数据入库模式
/*
数据入库模式为0时
系统调用内置的类文件入库，自动抛弃多余字段

数据入库模式为1时
系统根据发送的数据构造SQL语句入库，不对发送的字段进行处理，字段名和数据表内一致
例如发送&title=测试标题&catid=分类ID，则构造
 (title, catid) VALUES ('测试标题', '分类ID') 的插入语句
*/

/*以下内容请勿修改*/
if($verify_mode == 4) exit('接口未开启');
if(strpos($_SERVER['PHP_SELF'], '/spider.php') !== false) exit('为了系统安全，请修改接口文件名');

$_DPOST = $_POST;
$_DGET = $_GET;

define('DT_ADMIN', true);
require '../common.inc.php';

//校验身份
$pass = false;
if($verify_mode == 1) {
	if($_userid && $_userid == $CFG['founderid']) $pass = true;
} else if($verify_mode == 2) {
	$auth = $_DPOST ? $_DPOST['auth'] : $_DGET['auth'];
	if(strlen($auth) >= 6 && $auth == $spider_auth) $pass = true;
} if($verify_mode == 3) {
	if($DT_IP && $DT_IP == $spider_ip) $pass = true;
}
$pass or exit('身份校验失败');

$class = DT_ROOT.'/module/'.$module.'/'.$module.'.class.php';
if($MODULE[$moduleid]) {
	$CATEGORY = cache_read('category-'.($moduleid == 2 ? 4 : $moduleid).'.php');
	if($action == 'cat') {//获取栏目ID
		echo '<select name="catid">';
		foreach($CATEGORY as $k=>$v) {
			echo '<option value="'.$v['catid'].'">'.$v['catname'].'</option>';
		}
		echo '</select>';
	} else {
		$post = array();
		if($_DPOST) {
			$post = $_DPOST;
		} else if($_DGET) {
			$post = $_DGET;
		} else {
			exit('未接收到数据');
		}		
		if(isset($post['username'])) $_username = $post['username'];
		if(in_array($module, array('article', 'info'))) {
			$table = $DT_PRE.$module.'_'.$moduleid;
			$table_data = $DT_PRE.$module.'_data_'.$moduleid;
		} else {
			$table = $DT_PRE.$module;
			$table_data = $DT_PRE.$module.'_data';
		}
		if($spider_mode) {
			get_magic_quotes_gpc() or $post = array_map('addslashes', $post);
			if($moduleid == 2) {
				$table_member = $DT_PRE.'member';
				$table_company = $DT_PRE.'company';
				$table_company_data = $DT_PRE.'company_data';
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
				foreach($post as $k=>$v) {
					if(!in_array($k, $mfs)) continue;
					$sqlk .= ','.$k; $sqlv .= ",'$v'";
				}
				if(!$sqlk) exit('无效数据');
				$sqlk = substr($sqlk, 1);
				$sqlv = substr($sqlv, 1);
				$db->query("INSERT INTO {$table_member} ($sqlk) VALUES ($sqlv)");
				$userid = $db->insert_id();
				$post['userid'] = $userid;
				$sqlk = $sqlv = '';
				isset($post['addtime']) or $post['addtime'] = $DT_TIME;
				$post['adddate'] = date("Y-m-d", $post['addtime']);
				isset($post['edittime']) or $post['edittime'] = $DT_TIME;
				$post['editdate'] = date("Y-m-d", $post['edittime']);
				foreach($post as $k=>$v) {
					if(!in_array($k, $cfs)) continue;
					$sqlk .= ','.$k; $sqlv .= ",'$v'";
				}
				$sqlk = substr($sqlk, 1);
				$sqlv = substr($sqlv, 1);
				$db->query("INSERT INTO {$table_company} ($sqlk) VALUES ($sqlv)");
				$content = $post['content'];
				$content_table = content_table(4, $userid, is_file(DT_CACHE.'/4.part'), $table_company_data);
				$db->query("INSERT INTO {$content_table} (userid,content)  VALUES ('$userid', '$content')");
				exit('发布成功');
			} else {
				$fs = cache_read($table.'.php');
				if(!$fs) {
					$fs = array();
					$result = $db->query("SHOW COLUMNS FROM `$table`");
					while($r = $db->fetch_array($result)) {
						$fs[] = $r['Field'];
					}
					cache_write($table.'.php', $fs);
				}
				$sqlk = $sqlv = '';
				foreach($post as $k=>$v) {
					if(!in_array($k, $fs)) continue;
					$sqlk .= ','.$k; $sqlv .= ",'$v'";
				}
				if(!$sqlk) exit('无效数据');
				$sqlk = substr($sqlk, 1);
				$sqlv = substr($sqlv, 1);
				$db->query("INSERT INTO {$table} ($sqlk) VALUES ($sqlv)");
				$itemid = $db->insert_id();
				$content = $post['content'];
				$db->query("INSERT INTO {$table_data} (itemid,content)  VALUES ('$itemid', '$content')");
				exit('发布成功');
			}
		} else if(is_file($class)) {
			$AREA = cache_read('area.php');
			require DT_ROOT.'/include/module.func.php';
			require DT_ROOT.'/include/post.func.php';
			require $class;
			$do = new $module($moduleid);	
			foreach($do->fields as $v) {
				isset($post[$v]) or $post[$v] = '';
			}
			if(isset($post['islink'])) unset($post['islink']);
			if($spider_status) $post['status'] = $spider_status;
			get_magic_quotes_gpc() or $post = array_map('addslashes', $post);
			if($module == 'article') $post['save_remotepic'] = $MOD['save_remotepic'];
			if($moduleid == 2) {
				if($do->add($post)) {
					exit('发布成功');
				} else {
					if($spider_errlog) file_put_contents('spider/'.date('Ymd-His-').mt_rand(10, 99).'.txt', $do->errmsg);
					exit($do->errmsg);
				}
			}
			if($do->pass($post)) {
				$do->add($post);
				exit('发布成功');
			} else {
				if($spider_errlog) file_put_contents('spider/'.date('Ymd-His-').mt_rand(10, 99).'.txt', $do->errmsg);
				exit($do->errmsg);
			}
		} else {
			exit('模型不支持入库');
		}
	}
} else {
	exit('模型不存在');
}
?>