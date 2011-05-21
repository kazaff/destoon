<?php
$i_model = 1;
require_once '../app_comm.php';
require_once 'install_function.php';
require_once 'install_var.php';
require_once 'install_lang.php';
require_once 'install_mysql.php';
$sqlfile =  S_ROOT.'./install/data/keke_kppw_install.sql';
$sqldemofile = S_ROOT.'./install/data/keke_kppw_demo.sql';
$data_lockfile = S_ROOT.'./data/keke_kppw_install.lck';
$cf = S_ROOT."./config/config.inc.php";
$configcontent = Template_Class::sreadfile($cf);
if(empty($_GET['step'])) $_GET['step'] = 'start';
if($_GET['step']=='start') {
		if(!file_exists($data_lockfile)){
			
		}else{show_error('<center><font color=red>您已经安装过 客客威客程序 KPPW '.KEKE_VERSION.'版，请删除data目录下的 keke_kppw_install.lck 文件，重新安装</font></center>','error',2);die();}
		if(file_exists($sqlfile)){}else{show_error('<center><font color=red>data目录下的keke_kppw_install.sql文件不存在，安装程序中止</font></center>','error',2);die();}
		
		//安装开始
		show_view('安装协议：<br><br>
		 
<p>
	感谢您选择KPPW1.x系统，KPPW 是客客专业威客系统的简称，英文全称Keke Produced Professional Witkey 。武汉客客信息技术有限公司KPPW产品的开发商，依法独立拥有 KPPW 产品著作权
</p>
<p>
	本授权协议适用且仅适用于 KPPW 1.x 版本，武汉客客信息技术有限公司拥有对本授权协议的最终解释权。
</p>
<p>
	&nbsp;
</p>
<p>
	I. 协议许可的权利 
</p>
<p>
	1. 您可以在完全遵守本最终用户授权协议的基础上，将本软件应用于非商业用途(包括个人用户：不具备法人资格的自然人，以个人名义从事网络威客交易；非盈利性用途：从事非盈利活动的商业机构及非盈利性组织，将KPPW 产品用且仅用于产品演示、展示及发布，而并不是用来买卖及盈利的运营活动的) 
</p>
<p>
	2. 您可以在协议规定的约束和限制范围内修改 KPPW 源代码(如果被提供的话)或界面风格以适应您的网站要求。
</p>
<p>
	3. 您拥有使用本软件构建的威客系统中全部任务信息，文章，用户信息及相关信息的所有权，并独立承担与其内容的相关法律义务。
</p>
<p>
	4. 获得商业授权之后，您可以将本软件应用于商业用途，同时依据所购买的授权类型中确定的技术支持期限、技术支持方式和技术支持内容，自授权时刻起，在技术支持期限内拥有通过指定的方式获得指定范围内的技术支持服务。商业授权用户享有反映和提出意见的权力，相关意见将被作为首要考虑，但没有一定被采纳的承诺或保证。
</p>
<p>
	&nbsp;
</p>
<p>
	II. 协议规定的约束和限制 
</p>
<p>
	1. 未获商业授权之前，不得将本软件用于商业用途(包括但不限于企业法人经营的企业网站、经营性网站、以盈利为目或实现盈利的网站)。
</p>
<p>
	2. 不得对本软件或与之关联的商业授权进行出租、出售、抵押或发放子许可证。
</p>
<p>
	3. 无论如何，即无论用途如何、是否经过修改或美化、修改程度如何，只要使用KPPW 的整体或任何部分，未经书面许可，网站页面页脚处的 KPPW 名称和武汉客客信息技术有限公司下属网站(http://www.kekezu.com) 的链接都必须保留，而不能清除或修改。
</p>
<p>
	4. 禁止在 KPPW 的整体或任何部分基础上以发展任何派生版本、修改版本或第三方版本用于重新分发。
</p>
<p>
	5. 如果您未能遵守本协议的条款，您的授权将被终止，所被许可的权利将被收回，并承担相应法律责任。
</p>
<p>
	&nbsp;
</p>
 
<p>
	III. 有限担保和免责声明 
</p>
<p>
	1. 本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的。
</p>
<p>
	2. 用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未购买产品技术服务之前，我们不承诺提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任。
</p>
<p>
	3. 武汉客客信息技术有限公司不对使用本软件构建的威客系统中的文章或任务信息承担责任，但在不侵犯用户隐私信息的前提下，保留以任何方式获取用户及商品信息的权利。
</p>
 
<p>
	有关 KPPW! 最终用户授权协议、商业授权与技术服务的详细内容，均由KEKE 官方网站独家提供。 武汉客客信息技术有限公司拥有在不事先通知的情况下，修改授权协议和服务价目表的权力，修改后的协议或价目表对自改变之日起的新授权用户生效。电子文本形式的授权协议如同双方书面签署的协议一样，具有完全的和等同的法律效力。您一旦开始安装 KPPW1.X，即被视为完全理解并接受本协议的各项条款，在享有上述条款授予的权力的同时，受到相关的约束和限制。协议许可范围以外的行为，将直接违反本授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权力。
</p>
 
 
<p align="right">
	武汉客客信息技术有限公司
</p>
		
		<br><br><center>
		<input type="button" name="step_1" value="我同意安装" onclick="location.href=\'index.php?step=checkset\'">
		<a href="index.php?step=checkset"></a>
		<br><br></center>
		特别提醒：为了数据安全，安装完毕后，不要忘记删除本文件。');
} elseif ($_GET['step'] == 'checkset') {
	
	//function_check($func_items);
	
	env_check($env_items);

	dirfile_check($dirfile_items);

	echo(show_env_result($env_items, $dirfile_items, $func_items));

} elseif ($_GET['step'] == 'sql') {
	
	$default_configfile = './install/data/config.inc.php';
	if(file_exists(S_ROOT.$default_configfile)){
		include S_ROOT.$default_configfile;
		$dbhost = $keke_config['db']['dbhost'];
		$dbname = $keke_config['db']['dbname'];
		$dbpw = $keke_config['db']['dbpass'];
		$dbuser = $keke_config['db']['dbuser'];
		$tablepre = $keke_config['db']['tablepre'];
		$adminemail = 'admin@admin.com';
	}
	
	$dbhost = $_POST[dbhost]?$_POST[dbhost]:$dbhost;
	$dbname = $_POST[dbname]?$_POST[dbname]:$dbname;
	$dbuser = $_POST[dbuser]?$_POST[dbuser]:$dbuser;
	$dbpw = $_POST[dbpw]?$_POST[dbpw]:$dbpw;
	$tablepre = $_POST[tablepre]?$_POST[tablepre]:$tablepre;
	$username = $_POST[username];
	$email = $_POST[email];
	$password = $_POST[password];
	if($_POST && !KEKE_OFF && $_SERVER['REQUEST_METHOD'] == 'POST') {
		if($password != $password2) {
			$error_msg['admininfo']['password2'] = 1;
			$submit = false;
		}
		$forceinstall = isset($_POST['dbinfo']['forceinstall']) ? $_POST['dbinfo']['forceinstall'] : '';
		$dbname_not_exists = true;
		if(!empty($dbhost) && empty($forceinstall)) {
			$dbname_not_exists = check_db($dbhost, $dbuser, $dbpw, $dbname, $tablepre);
			if(!$dbname_not_exists) {
				$form_db_init_items['dbinfo']['forceinstall'] = array('type' => 'checkbox', 'required' => 0, 'reg' => '/^.*+/');
				$error_msg['dbinfo']['forceinstall'] = 1;
				$submit = false;
				$dbname_not_exists = false;
			}
		}
	}
	$url_this = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
	$url_this = explode('/install/',$url_this);
	$url_this = $url_this[0];
	
	$form_str =" 
<form method='post' action='index.php?step=sql'  id='frm_sql' name='frm_sql'>
<div id='form_items_cache' >
<div class='desc'><b>填写数据库信息</b></div>
<table class='tb2'>
	<tr>
		<td class='padleft'>
		 网站地址:
		</td>
		<td class='padleft'>
		<input type='text' name='weburl' maxlength='100' value='$url_this' size='35' class='txt' limit='len:3-100;general:false' msg='网站地址格式填写有误！' msgArea='weburl_msg'>
		</td>
		<td class='pdleft1' id='weburl_msg'>
		站点的url
		</td>
	</tr>
	<tr>
		<td class='padleft'>
		 数据库服务器:
		</td>
		<td class='padleft'>
		<input type='text' name='dbhost' value='$dbhost' size='35' class='txt' limit='required:true;len:3-100' msg='数据库服务器地址填写有误！' msgArea='dbhost_msg'>
		</td>
		<td class='pdleft1' id='dbhost_msg'>
		数据库服务器地址, 一般为 localhost
		</td>
	</tr>
	<tr>
		<td class='padleft'>
		数据库名:
		</td>
		<td class='padleft'>
		<input type='text' name='dbname' value='$dbname' size='35' class='txt' limit='required:true;len:3-20' msg='数据库名填写有误！' msgArea='dbname_msg'>
		</td>
		<td class='pdleft1' id='dbname_msg'>
		
		</td>
	</tr>
	<tr>
		<td class='padleft'>
		  数据库用户名:
		</td>
		<td class='padleft'>
		<input type='text' name='dbuser' value='$dbuser' size='35' class='txt' limit='required:true;len:3-20' msg='数据库用户名填写有误！' msgArea='dbuser_msg'>
		</td>
		<td class='pdleft1' id='dbuser_msg'>
		
		</td>
	</tr>
	<tr>
		<td class='padleft'>
		 数据库密码:
		</td>
		<td class='padleft'>
		<input type='password' name='dbpw' value='$dbpw' size='35' class='txt' limit='required:true;len:3-20' msg=' <span style=color:red> 数据库密码填写有误！</span>' msgArea='dbpsw_msg'>
		</td>
		<td class='pdleft1' id='dbpsw_msg'>
		</td>
	</tr>
	<tr>
		<td class='padleft'>
		 数据表前缀:
		</td>
		<td class='padleft'>
		<input type='text' name='tablepre' value='$tablepre' size='35' class='txt'>
		</td>
		<td class='pdleft1'>
		同一数据库运行多个系统时，请修改前缀
		</td>
	</tr>
	</table>
	<div class='desc'><b>填写管理员信息</b></div>
	<table  class='tb2'>
	<tr>
		<td class='padleft'>
		管理员账号:
		</td>
		<td class='padleft'>
		<input type='text' name='username' value='admin' size='35' class='txt' limit='required:true;len:3-20' msg='<span style=color:red>  管理员账号填写有误！</span>' msgArea='username_msg'>
		</td>
		<td class='pdleft1' id='username_msg'>
		
		</td>
	</tr>
	<tr>
		<td class='padleft'>
		管理员密码:
		</td>
		<td class='padleft'>
		<input type='password' name='password' value='' size='35' class='txt' limit='required:true;len:3-20' id='password' msg=' <span style=color:red> 管理员密码填写有误！</span>' msgArea='password_msg'>
		</td>
		<td class='pdleft1' id='password_msg'>
		管理员密码不能为空
		</td>
	</tr>
	<tr>
		<td class='padleft'>
		 重复密码:
		</td>
		<td class='padleft'>
		<input type='password' name='password2' value='' size='35' class='txt' limit='required:true;equals:password' msg='<span style=color:red> 密码重复输入有误！</span>' msgArea='password2_msg'>
		</td>
		<td class='pdleft1' id='password2_msg'>
		</td>
	</tr>
	<tr>
		<td class='padleft'>
		管理员 Email:
		</td>
		<td class='padleft'>
		<input type='text' name='email' value='admin@admin.com' size='35' class='txt'  limit='required:true;len:3-20' msg=' <span style=color:red> 管理员 Email输入有误！</span>' msgArea='email_msg'>
		</td>
		<td class='pdleft1' id='email_msg'>
		</td>
	</tr>
	<tr>
		<td class='padleft'>
		初始化数据库:
		</td>
		<td class='padleft'>
		 <label for=\"date1\"><input type=\"radio\" name=\"datefile\" id=\"date1\" checked=\"checked\" value=\"1\">不带演示数据</label>
	    <label for=\"date2\"><input type=\"radio\" name=\"datefile\" id=\"date2\" value=\"2\">带有演示数据</label>
		</td>
		<td class='pdleft1' id='email_msg'>
		</td>
	</tr>
	<tr>
	<td class='padleft'>
		&nbsp;
		</td>
		<td class='padleft'>
		<center><input type='submit' name='setup_sql' value='下一步'></center>
		</td>
		<td class='pdleft1'>
		</td>
	</tr>
</table>
</div>	
</form>
";
	
if($_POST) {
		if(empty($dbname)) {
			show_error('dbname_invalid', $dbname, 0);
		} else {
			if(!$link = @mysql_connect($dbhost, $dbuser, $dbpw)) {
				$errno = mysql_errno($link);
				$error = mysql_error($link);
				if($errno == 1045) {
					show_error('database_errno_1045', $error, 0);
				} elseif($errno == 2003) {
					show_error('database_errno_2003', $error, 0);
				} else {
					show_error('database_connect_error', $error, 0);
				}
			}
			$_SESSION['link'] = mysql_get_server_info();
			if(mysql_get_server_info() > '4.1') {
				mysql_query("CREATE DATABASE IF NOT EXISTS `$dbname` DEFAULT CHARACTER SET ".DBCHARSET, $link);
			} else {
				mysql_query("CREATE DATABASE IF NOT EXISTS `$dbname`", $link);
			}
			if(mysql_errno()) {
				show_error('database_errno_1044', mysql_error(), 0);
			}
			mysql_close($link);
		}

		if(strpos($tablepre, '.') !== false) {
			show_error('tablepre_invalid', $tablepre, 0);
		}


		$db = new db_tool();
		$db->connect($dbhost, $dbuser, $dbpw, $dbname, DBCHARSET);

		$r_arr = array("dbhost"=>$dbhost, "dbname"=>$dbname, "dbuser"=>$dbuser,"dbpass"=>$dbpw,"tablepre"=>$tablepre);
	    foreach ($r_arr as $k=>$v){
			$k = strtoupper($k);
			$configcontent =  preg_replace("/define\(\'$k's*,*\s*'.*?'\);/i", "define('$k', '$v');", $configcontent);
		}
		Template_Class::swritefile($cf,$configcontent);
		if($_POST[datefile]==2)
		{
			
			$sqlfile = $sqldemofile;
		}
		$sql = file_get_contents($sqlfile);
		$sql = str_replace("\r\n", "\n", $sql);
		
		runquery($sql);
		
		$md5_password = md5($password);
		
		if($_POST[datefile]==1)
		{
			$db->query("INSERT INTO `{$tablepre}witkey_member`(`uid`,`username`,`password`,`email`) VALUES ('1', '$username','$md5_password','$email')");
			$db->query("INSERT INTO `{$tablepre}witkey_space` (`uid`,`username`,`password`,`email`,`group_id`,`status`,`reg_time`) VALUES('1','$username','$md5_password','$email','1','1','".time()."')");
		}else{
			$db->query("update `{$tablepre}witkey_member` set username = '$username',password = '$md5_password',email = '$email' where uid = 1");
			$db->query("update `{$tablepre}witkey_space` set username = '$username',password = '$md5_password',email = '$email',group_id = 1,status = 1 where uid = 1");
		}
		
		$db->query("update `{$tablepre}witkey_basic_config` set website_url = '$weburl' ");
			
		$pars = array ('ac' =>'install','sitename' => '', 'siteurl' =>$weburl, 'charset' => $_K['charset'], 'version' =>KEKE_VERSION, 'release' =>KEKE_RELEASE, 'os' => PHP_OS, 'php' =>$_SERVER['SERVER_SOFTWARE'], 'mysql' =>mysql_get_server_info() , 'browser' => urlencode ( $_SERVER ['HTTP_USER_AGENT'] ), 'username' => urlencode ($_SESSION['username']), 'email' =>$basic_config ['email']?$basic_config ['email']:'noemail');
	    $data = http_build_query ( $pars );
		show_msg("数据库安装成功！", 'index.php?step=finish&'.$data);
		
		
		 
		
		
		
	}else{
		show_header();
		echo($form_str);
		show_footer();
		
	}
	
} elseif ($_GET['step'] == 'finish') {
	//安装完成
	Cache::delete_all();
	$str = md5(random(100).'_'.time()).'_keke_install.lck';
	@touch($data_lockfile);
	file_put_contents($data_lockfile,$str);
	$version = $_SESSION['link'];
	unset($_SESSION['link']);
	$pars = array ('ac' =>'install','sitename' => '', 'siteurl' =>$weburl, 'charset' => $_K['charset'], 'version' =>KEKE_VERSION, 'release' =>KEKE_RELEASE, 'os' => PHP_OS, 'php' =>$_SERVER['SERVER_SOFTWARE'], 'mysql' => $version, 'browser' => urlencode ( $_SERVER ['HTTP_USER_AGENT'] ), 'username' => urlencode ($_SESSION['username']), 'email' =>$basic_config ['email']?$basic_config ['email']:'noemail');
	 
	if(file_exists(S_ROOT."./config/keke.lic")){
	$lic = Template_Class::sreadfile(S_ROOT."./config/keke.lic");
	}
	$data = http_build_query($_GET);
	$verify = md5 ( $data . $lic);
	$notice = "http://www.kekezu.com/update.php?".$data."&lic=".$lic."&verify=".$verify."&p_name=".P_NAME;
   
    show_view("恭喜您，KPPW ".KEKE_VERSION."! 《客客专业威客》  安装成功！！<br><br>
	安装完后，请仔细阅读 我们的<b>配置说明</b> 如有需要修改的，修改完到后台更新下缓存。<br><br>
	如果您没有什么，那就开始体验吧！<br><br><br>
	特别提醒：为了数据安全，安装完毕后，不要忘记删除本文件。
	<br><br><br><br>
	<center>
	<input type='button' value='任务大厅' onclick=\"location.href='../index.php'\">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type='button' value='后台管理' onclick=\"location.href='../control/admin/index.php'\">
	</center>
	<script type='text/javascript' src='$notice'></script>
	");
}
?>