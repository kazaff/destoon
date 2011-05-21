<?php 
defined('IN_DESTOON') or exit('Access Denied');
class member {
	var $userid;
	var $username;
	var $db;
	var $tb_member;
	var $tb_company;
	var $tb_company_data;
	var $errmsg = errmsg;

    function member() {
		global $db, $DT_PRE;
		$this->tb_member = $DT_PRE.'member';
		$this->tb_company = $DT_PRE.'company';
		$this->tb_company_data = $DT_PRE.'company_data';
		$this->db = &$db;
    }

	function is_username($username) {
		global $MOD, $L;
		if(!check_name($username)) return $this->_($L['member_username_match']);
		$MOD['minusername'] or $MOD['minusername'] = 4;
		$MOD['maxusername'] or $MOD['maxusername'] = 20;
		if(strlen($username) < $MOD['minusername'] || strlen($username) > $MOD['maxusername']) return $this->_(lang($L['member_username_len'], array($MOD['minusername'], $MOD['maxusername'])));
		if($MOD['banusername']) {
			$tmp = explode('|', $MOD['banusername']);
			foreach($tmp as $v) {
				if(strpos($username, $v) !== false) return $this->_($L['member_username_ban']);
			}
		}
		if($this->username_exists($username)) return $this->_($L['member_username_reg']);
		return true;
	}

	function is_passport($passport) {
		global $MOD, $L;
		$MOD['minusername'] or $MOD['minusername'] = 4;
		$MOD['maxusername'] or $MOD['maxusername'] = 20;
		if(strlen($passport) < $MOD['minusername'] || strlen($passport) > $MOD['maxusername']) return $this->_(lang($L['member_passport_len'], array($MOD['minusername'], $MOD['maxusername'])));
		$badwords = array("$","\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n","#");
		foreach($badwords as $v) {
			if(strpos($passport, $v) !== false) return $this->_($L['member_passport_char']);
		}
		if($MOD['banusername']) {
			$tmp = explode('|', $MOD['banusername']);
			foreach($tmp as $v) {
				if(strpos($passport, $v) !== false) return $this->_($L['member_passport_ban']);
			}
		}
		if($this->passport_exists($passport)) return $this->_($L['member_passport_reg']);
		return true;
	}

	function is_password($password, $cpassword) {
		global $MOD, $L;
		if(!$password) return $this->_($L['member_password_null']);
		if($password != $cpassword) return $this->_($L['member_password_match']);
		if(!$MOD['minpassword']) $MOD['minpassword'] = 6;
		if(!$MOD['maxpassword']) $MOD['maxpassword'] = 20;
		if(strlen($password) < $MOD['minpassword'] || strlen($password) > $MOD['maxpassword']) return $this->_(lang($L['member_password_len'], array($MOD['minpassword'], $MOD['maxpassword'])));
		return true;
	}

	function is_payword($password, $cpassword) {
		global $MOD, $L;
		if(!$password) return $this->_($L['member_payword_null']);
		if($password != $cpassword) return $this->_($L['member_payword_match']);
		if(!$MOD['minpassword']) $MOD['minpassword'] = 6;
		if(!$MOD['maxpassword']) $MOD['maxpassword'] = 20;
		if(strlen($password) < $MOD['minpassword'] || strlen($password) > $MOD['maxpassword']) return $this->_(lang($L['member_payword_len'], array($MOD['minpassword'], $MOD['maxpassword'])));
		return true;
	}

	function is_member($member) {
		global $L;
		if(!is_array($member)) return false;
		if(!$this->is_passport($member['passport'])) return false;
		if(!$member['groupid']) return $this->_($L['member_groupid_null']);
		if(empty($member['truename'])) return $this->_($L['member_truename_null']);
		if(!is_email(trim($member['email']))) return $this->_($L['member_email_null']);
		if($this->email_exists(trim($member['email']))) return $this->_($L['member_email_reg']);
		if(!$member['areaid']) return $this->_($L['member_areaid_null']);
		$groupid = $this->userid ? $member['groupid'] : $member['regid'];
		if($groupid > 5 && $groupid != 8) {
			if(strlen($member['company']) < 2) return $this->_($L['member_company_null']);
			if(preg_match("/[0-9]+/", $member['company'])) return $this->_($L['member_company_bad']);
			if($this->company_exists($member['company'])) return $this->_($L['member_company_reg']);
			if(strlen($member['type']) < 2) return $this->_($L['member_type_null']);
			if(strlen($member['telephone']) < 6) return $this->_($L['member_telephone_null']);
		}
		if($this->userid) {
			if($member['password'] && !$this->is_password($member['password'], $member['cpassword'])) return false;
			if($member['payword'] && !$this->is_payword($member['payword'], $member['cpayword'])) return false;
			if($member['groupid'] > 5) {
				if(strlen($member['regyear']) != 4 || !is_numeric($member['regyear'])) return $this->_($L['member_regyear_null']);
				if(empty($member['address'])) return $this->_($L['member_address_null']);
				if(word_count($member['introduce']) < 5) return $this->_($L['member_introduce_null']);
				if(!$member['business']) return $this->_($L['member_business_null']);
				if(strlen($member['catid']) < 2) return $this->_($L['member_catid_null']);
			}
		} else {
			if(!$this->is_username($member['username'])) return false;
			if(!$this->is_password($member['password'], $member['cpassword'])) return false;
		}
		return true;
	}

	function set_member($member) {
		global $MOD, $CATEGORY;
		$member['email'] = trim($member['email']);
		$member['mail'] = isset($member['mail']) ? trim($member['mail']) : '';
		is_email($member['mail']) or $member['mail'] = '';
		$member['msn'] = isset($member['msn']) ? trim($member['msn']) : '';
		is_email($member['msn']) or $member['msn'] = '';
		$member['qq'] = isset($member['qq']) ? trim($member['qq']) : '';
		is_numeric($member['qq']) or $member['qq'] = '';
		$member['postcode'] = isset($member['postcode']) ? trim($member['postcode']) : '';
		is_numeric($member['postcode']) or $member['postcode'] = '';
		$member['mode'] = (isset($member['mode']) && is_array($member['mode']) && $member['mode']) ? implode(',', $member['mode']) : '';
		$member['keyword'] = $member['company'];
		$member['homepage'] = isset($member['homepage']) ? fix_link($member['homepage']) : '';
		$member['capital'] = isset($member['capital']) ? dround($member['capital']) : '';
		if($this->userid) {		
			$member['keyword'] = $member['company'].strip_tags(area_pos($member['areaid'], ',')).','.$member['business'].','.$member['sell'].','.$member['buy'].','.$member['mode'];
			clear_upload($member['thumb'].$member['banner'].$member['introduce'], $this->userid);
			$new = $member['introduce'];
			if($member['thumb']) $new .= '<img src="'.$member['thumb'].'">';
			if($member['banner']) $new .= '<img src="'.$member['banner'].'">';
			$content_table = content_table(4, $this->userid, is_file(DT_CACHE.'/4.part'), $this->tb_company_data);
			$r = $this->db->get_one("SELECT content FROM {$content_table} WHERE userid=$this->userid");
			$old = $r['content'];
			$r = $this->get_one();
			if($r['thumb']) $old .= '<img src="'.$r['thumb'].'">';
			if($r['banner']) $old .= '<img src="'.$r['banner'].'">';
			delete_diff($new, $old);
		} else {
			if($member['thumb']) clear_upload($member['thumb'].$member['banner'].$member['introduce']);
		}
		$member['content'] = $member['introduce'];
		$member['introduce'] = addslashes(get_intro($member['content'], $MOD['introduce_length']));
		if(!defined('DT_ADMIN')) {
			$content = $member['content'];
			unset($member['content']);
			$member = dhtmlspecialchars($member);
			$member['content'] = dsafe($content);
		}
		if($MOD['introduce_clear'] || $MOD['introduce_save']) {
			$member['content'] = stripslashes($member['content']);
			if($MOD['introduce_clear']) $member['content'] = clear_link($member['content']);
			if($MOD['introduce_save']) $member['content'] = save_remote($member['content']);
			$member['content'] = addslashes($member['content']);
		}
		if($member['catid']) {
			$catids = explode(',', substr($member['catid'], 1, -1));
			$cids = '';
			foreach($catids as $catid) {
				$catid = $CATEGORY[$catid]['parentid'] ? $CATEGORY[$catid]['arrparentid'].','.$catid : $catid;
				$cids .= $catid.',';
			}
			$cids = array_unique(explode(',', substr(str_replace(',0,', ',', ','.$cids), 1, -1)));
			$member['catids'] = ','.implode(',', $cids).',';
		}
		return $member;
	}

	function email_exists($email) {
		$condition = "email='$email'";
		if($this->userid) $condition .= " AND userid!=$this->userid";
		return $this->db->get_one("SELECT userid FROM {$this->tb_member} WHERE $condition");
	}

	function username_exists($username) {
		return $this->db->get_one("SELECT userid FROM {$this->tb_member} WHERE username='$username'");
	}

	function company_exists($company) {
		$condition = "company='$company'";
		if($this->userid) $condition .= " AND userid!=$this->userid";
		return $this->db->get_one("SELECT userid FROM {$this->tb_company} WHERE $condition");
	}

	function passport_exists($passport) {
		$condition = "passport='$passport'";
		if($this->userid) $condition .= " AND userid!=$this->userid";
		return $this->db->get_one("SELECT userid FROM {$this->tb_member} WHERE $condition");
	}

	function add($member) {
		global $DT, $DT_TIME, $DT_IP, $MOD, $L;
		if(!$this->is_member($member)) return false;
		$member = $this->set_member($member);
		$member['linkurl'] = userurl($member['username']);
		$member['password'] = $member['payword'] = md5(md5($member['password']));
		$member_fields = array('username','company','passport', 'password','payword','email','gender','truename','mobile','msn','qq','ali','skype','department','career','groupid','regid','edittime','inviter');
		$company_fields = array('username','groupid','company','type','catid','catids','areaid', 'mode','capital','regunit','size','regyear','sell','buy','business','telephone','fax','mail','address','postcode','homepage','introduce','thumb','keyword','linkurl');
		$member_sqlk = $member_sqlv = $company_sqlk = $company_sqlv = '';
		foreach($member as $k=>$v) {
			if(in_array($k, $member_fields)) {$member_sqlk .= ','.$k; $member_sqlv .= ",'$v'";}
			if(in_array($k, $company_fields)) {$company_sqlk .= ','.$k; $company_sqlv .= ",'$v'";}
		}
        $member_sqlk = substr($member_sqlk, 1);
        $member_sqlv = substr($member_sqlv, 1);
        $company_sqlk = substr($company_sqlk, 1);
        $company_sqlv = substr($company_sqlv, 1);
		$this->db->query("INSERT INTO {$this->tb_member} ($member_sqlk,regip,regtime,loginip,logintime)  VALUES ($member_sqlv,'$DT_IP','$DT_TIME','$DT_IP','$DT_TIME')");
		$this->userid = $this->db->insert_id();
		$this->username = $member['username'];
	    $this->db->query("INSERT INTO {$this->tb_company} (userid, $company_sqlk) VALUES ('$this->userid', $company_sqlv)");
		$content_table = content_table(4, $this->userid, is_file(DT_CACHE.'/4.part'), $this->tb_company_data);
	    $this->db->query("INSERT INTO {$content_table} (userid, content) VALUES ('$this->userid', '$member[content]')");
		if($MOD['credit_register'] > 0) {
			credit_add($this->username, $MOD['credit_register']);
			credit_record($this->username, $MOD['credit_register'], 'system', $L['member_record_reg'], $DT_IP);
		}
		if($MOD['money_register'] > 0) {
			money_add($this->username, $MOD['money_register']);
			money_record($this->username, $MOD['money_register'], $L['in_site'], 'system', $L['member_record_reg'], $DT_IP);
		}
		return $this->userid;
	}

	function edit($member)	{
		if(!$this->is_member($member)) return false;
		$member = $this->set_member($member);
		$r = $this->get_one();
		$member['linkurl'] = userurl($r['username'], '', $member['domain']);
		$member_fields = array('company','passport','email','msn','qq','ali','skype','gender','truename','mobile','department','career','groupid', 'edittime','black','bank','account','vemail','vmobile','vbank','vtruename','vcompany');
		$company_fields = array('company','type','areaid', 'catid','catids','business','mode','regyear','regunit','capital','size','address','postcode','telephone','fax','mail','homepage','sell','buy','introduce','thumb','keyword','banner','css','linkurl','groupid','domain','icp','validated','validator','validtime','skin','template');
		$member_sql = $company_sql = '';
		foreach($member as $k=>$v) {
			if(in_array($k, $member_fields)) $member_sql .= ",$k='$v'";
			if(in_array($k, $company_fields)) $company_sql .= ",$k='$v'";
		}
		if($member['password']) {
			$password = md5(md5($member['password']));
			$member_sql .= ",password='$password'";
		}
		if($member['payword']) {
			$payword = md5(md5($member['payword']));
			$member_sql .= ",payword='$payword'";
		}
        $member_sql = substr($member_sql, 1);
        $company_sql = substr($company_sql, 1);
	    $this->db->query("UPDATE {$this->tb_member} SET $member_sql WHERE userid=$this->userid");
	    $this->db->query("UPDATE {$this->tb_company} SET $company_sql WHERE userid=$this->userid");
		$content_table = content_table(4, $this->userid, is_file(DT_CACHE.'/4.part'), $this->tb_company_data);
	    $this->db->query("UPDATE {$content_table} SET content='$member[content]' WHERE userid=$this->userid");
		return true;
	}

	function get_one($username = '') {
		$condition = $username ? "m.username='$username'" : "m.userid='$this->userid'";
        return $this->db->get_one("SELECT * FROM {$this->tb_member} m,{$this->tb_company} c WHERE m.userid=c.userid AND $condition");
	}

	function get_list($condition, $order = 'userid DESC') {
		global $pages, $page, $pagesize, $offset;
		$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->tb_member} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);
		$members = array();
		$result = $this->db->query("SELECT * FROM {$this->tb_member} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
		while($r = $this->db->fetch_array($result)) {
			$r['logindate'] = timetodate($r['logintime'], 5);
			$r['regdate'] = timetodate($r['regtime'], 5);
			$members[] = $r;
		}
		return $members;
	}

	function login($login_username, $login_password, $login_cookietime = 0, $admin = false) {
		global $CFG, $DT_TIME, $DT_IP, $MOD, $L;
		if(!check_name($login_username)) return $this->_($L['member_login_username_bad']);
		if(!$MOD || !isset($MOD['login_times'])) $MOD = cache_read('module-2.php');
		$login_lock = ($MOD['login_times'] && $MOD['lock_hour']) ? true : false;
		$LOCK = array();
		if($login_lock) {
			$LOCK = cache_read($DT_IP.'.php', 'ban');
			if($LOCK) {
				if($DT_TIME - $LOCK['time'] < $MOD['lock_hour']*3600) {
					if($LOCK['times'] >= $MOD['login_times']) return $this->_(lang($L['member_login_ban'], array($MOD['login_times'], $MOD['login_times'])));
				} else {
					$LOCK = array();
					cache_delete($DT_IP.'.php', 'ban');
				}
			}
		}
		$user = userinfo($login_username, '');
		if(!$user) {
			$this->lock($login_lock, $LOCK, $DT_IP, $DT_TIME);
			return $this->_($L['member_login_not_member']);
		}
		if(!$admin) {
			if($user['password'] != (is_md5($login_password) ? md5($login_password) : md5(md5($login_password)))) {
				$this->lock($login_lock, $LOCK, $DT_IP, $DT_TIME);
				return $this->_($L['member_login_password_bad']);
			}
		}
		if($user['groupid'] == 2) return $this->_($L['member_login_member_ban']);
		$userid = $user['userid'];

		if($MOD['credit_login'] > 0 && timetodate($DT_TIME, 3) != timetodate($user['logintime'], 3)) {
			credit_add($login_username, $MOD['credit_login']);
			credit_record($login_username, $MOD['credit_login'], 'system', $L['member_record_login'], $DT_IP);
		}

		if($user['vip'] && $user['totime'] && $user['totime'] < $DT_TIME) {
			$user['groupid'] = $gid = $user['regid'];
			$this->db->query("UPDATE {$this->tb_company} SET groupid=$gid,vip=0 WHERE userid=$userid");
			$this->db->query("UPDATE {$this->tb_member} SET groupid=$gid WHERE userid=$userid");
		}
		if($user['styletime'] && $user['styletime'] < $DT_TIME) {			
			$this->db->query("UPDATE {$this->tb_company} SET styletime=0,skin='',template='' WHERE userid=$userid");
		}
		$cookietime = $login_cookietime ? $DT_TIME + intval($login_cookietime) : 0;
		$auth = encrypt($user['userid']."\t".$user['username']."\t".$user['groupid']."\t".$user['password'], md5(DT_KEY.$_SERVER['HTTP_USER_AGENT']));
		set_cookie('auth', $auth, $cookietime);
		if($login_cookietime) set_cookie('username', $user['username'], $DT_TIME + 86400*7);
		$this->db->query("UPDATE {$this->tb_member} SET loginip='$DT_IP',logintime=$DT_TIME,logintimes=logintimes+1 WHERE username='$login_username'");
		return $user;
	}

	function lock($login_lock, $LOCK, $DT_IP, $DT_TIME) {
		if($login_lock && $DT_IP) {
			$LOCK['time'] = $DT_TIME;
			$LOCK['times'] = isset($LOCK['times']) ? $LOCK['times']+1 : 1;
			cache_write($DT_IP.'.php', $LOCK, 'ban');
		}
	}

	function logout() {
		set_cookie('auth', '');
		return true;
	}

	function delete($userid) {
		global $DT_PRE, $CFG, $MODULE, $L;
		if(!$userid) return false;
		if(is_array($userid)) {
			if(in_array(1, $userid) || in_array($CFG['founderid'], $userid)) return $this->_($L['member_founder_del']);
			$userids = implode(',', $userid);
		} else {
			if($userid == 1 || $userid == $CFG['founderid']) return $this->_($L['member_founder_del']);
			$userids = intval($userid);
		}
		$result = $this->db->query("SELECT username,userid FROM {$this->tb_member} WHERE userid IN ($userids)");
		while($r = $this->db->fetch_array($result)) {
			$userid = $r['userid'];
			$username = $r['username'];
			$content_table = content_table(4, $userid, is_file(DT_CACHE.'/4.part'), $this->tb_company_data);
			$content_table = str_replace($DT_PRE, '', $content_table);
			foreach(array('member', 'company', $content_table, 'company_setting', 'admin', 'favorite', 'friend') as $v) {
				$this->deluser($v, $userid, false);
			}
			foreach(array('alert', 'ask', 'comment', 'credit', 'finance_card', 'finance_cash', 'finance_charge', 'finance_pay', 'finance_record', 'finance_sms', 'guestbook', 'job_talent', 'link', 'log', 'login', 'mail_list', 'spread', 'upgrade', 'know_answer', 'know_vote') as $v) {
				$this->deluser($v, $username, true);
			}
			foreach(array('news', 'resume') as $v) {
				$this->deluser($v, $username, true, true);
			}
			foreach($MODULE as $m) {
				if($m['islink'] || $m['moduleid'] < 5) continue;
				if(in_array($m['module'], array('article', 'info'))) {
					$this->deluser($m['module'].'_'.$m['moduleid'], $username, true, true);
				} else {
					$this->deluser($m['module'], $username, true, true);
				}
			}
			$this->db->query("DELETE FROM {$DT_PRE}finance_trade WHERE buyer='$username'");
			$this->db->query("DELETE FROM {$DT_PRE}finance_trade WHERE seller='$username'");
			$this->db->query("DELETE FROM {$DT_PRE}job_apply WHERE apply_username='$username'");
			$this->db->query("DELETE FROM {$DT_PRE}message WHERE fromuser='$username'");
			$this->db->query("DELETE FROM {$DT_PRE}message WHERE touser='$username'");
			$this->delupload($username, $userid);
		}
		return true;
	}

	function deluser($table, $user, $name = true, $data = false) {
		global $DT_PRE;
		$fields = $name ? 'username' : 'userid';
		if($data) {
			$result = $this->db->query("SELECT itemid FROM {$DT_PRE}{$table} WHERE `$fields`='$user'");
			while($r = $this->db->fetch_array($result)) {
				$itemid = $r['itemid'];
				$this->db->query("DELETE FROM {$DT_PRE}{$table} WHERE itemid='$itemid'");
				$table_data = strpos($table, '_') === false ? $table.'_data' : str_replace('_', '_data_', $table);
				$this->db->query("DELETE FROM {$DT_PRE}{$table_data} WHERE itemid='$itemid'");
			}
		} else {
			$this->db->query("DELETE FROM {$DT_PRE}{$table} WHERE `$fields`='$user'");
		}
	}

	function delupload($username, $userid) {		
		$result = $this->db->query("SELECT fileurl FROM {$this->db->pre}upload WHERE username='$username'");
		while($r = $this->db->fetch_array($result)) {
			 delete_upload($r['fileurl'], $userid);
		}
	}

	function rename($cusername, $nusername) {
		global $DT_PRE, $CFG, $MODULE, $L;
		$cusername = trim($cusername);
		$nusername = trim($nusername);
		if(!$this->username_exists($cusername)) return $this->_($L['member_rename_not_member']);
		if(!$this->is_username($nusername)) return false;
		$tables = array('member', 'company', 'alert', 'ask', 'comment', 'credit', 'finance_card', 'finance_cash', 'finance_charge', 'finance_pay', 'finance_record', 'finance_sms', 'guestbook', 'job_talent', 'link', 'log', 'login', 'mail_list', 'spread', 'news', 'resume', 'upgrade', 'know_answer', 'know_vote');
		foreach($MODULE as $m) {
			if($m['islink'] || $m['moduleid'] < 5) continue;
			$tables[] = in_array($m['module'], array('article', 'info')) ? $m['module'].'_'.$m['moduleid'] : $m['module'];
		}
		foreach($tables as $table) {
			$this->db->query("UPDATE {$DT_PRE}{$table} SET username='$nusername' WHERE username='$cusername'");
		}
		$this->db->query("UPDATE {$DT_PRE}finance_trade SET buyer='$nusername' WHERE buyer='$cusername'");
		$this->db->query("UPDATE {$DT_PRE}finance_trade SET seller='$nusername' WHERE seller='$cusername'");
		$this->db->query("UPDATE {$DT_PRE}job_apply SET apply_username='$nusername' WHERE apply_username='$cusername'");
		$this->db->query("UPDATE {$DT_PRE}message SET fromuser='$nusername' WHERE fromuser='$cusername'");
		$this->db->query("UPDATE {$DT_PRE}message SET touser='$nusername' WHERE touser='$cusername'");
		return true;
	}

	function move($userid, $groupid) {
		global $CFG, $L;
		if(!isset($userid) || !$userid || !$groupid) return false;
		$userids = is_array($userid) ? implode(',', $userid) : intval($userid);
		if(is_array($userid)) {
			if(in_array(1, $userid) || in_array($CFG['founderid'], $userid)) return $this->_($L['member_founder_move']);
			$userids = implode(',', $userid);
		} else {
			if($userid == 1 || $userid == $CFG['founderid']) return $this->_($L['member_founder_move']);
			$userids = intval($userid);
		}
		$this->db->query("UPDATE {$this->tb_member} SET groupid='$groupid' WHERE userid IN ($userids)");
		$this->db->query("UPDATE {$this->tb_company} SET groupid='$groupid' WHERE userid IN ($userids)");
		return true;
	}

	function check($userid) {
		if(is_array($userid)) {
			foreach($userid as $v) { $this->check($v); }
		} else {
			$this->userid = $userid;
			$user = $this->get_one();
			$groupid = $user['regid'];
			$this->db->query("UPDATE {$this->tb_member} SET groupid=$groupid WHERE userid=$userid");
			$this->db->query("UPDATE {$this->tb_company} SET groupid=$groupid WHERE userid=$userid");
			return true;
		}
	}

	function login_log($username, $password, $admin = 0, $message = '') {
		global $DT_PRE, $DT_TIME, $DT_IP, $L;
		$password = is_md5($password) ? md5($password) : md5(md5($password));
		$agent = $_SERVER['HTTP_USER_AGENT'];
		$message or $message = $L['member_login_ok'];
		if($message == $L['member_login_ok']) cache_delete($DT_IP.'.php', 'ban');
		$this->db->query("INSERT INTO {$DT_PRE}login (username,password,admin,loginip,logintime,message,agent) VALUES ('$username','$password','$admin','$DT_IP','$DT_TIME','$message','$agent')");
	}

	function _($e) {
		$this->errmsg = $e;
		return false;
	}
}
?>