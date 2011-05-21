<?php 
defined('IN_DESTOON') or exit('Access Denied');
class guestbook {
	var $itemid;
	var $db;
	var $table;
	var $fields;
	var $errmsg = errmsg;

    function guestbook() {
		global $db, $DT_PRE;
		$this->table = $DT_PRE.'guestbook';
		$this->db = &$db;
		$this->fields = array( 'title','content','truename','telephone','email','qq','msn','ali','skype','hidden','status','username','addtime', 'ip', 'reply','editor','edittime');
    }

	function pass($post) {
		global $L;
		if(!is_array($post)) return false;
		if($this->itemid) {
			//
		} else {
			if(!$post['truename']) return $this->_(lang('message->pass_truename'));
			if(!$post['telephone']) return $this->_(lang('message->pass_telephone'));
			if(!$post['email'] || !is_email($post['email'])) return $this->_(lang('message->pass_email'));
			if($post['qq'] && !is_numeric($post['qq'])) return $this->_(lang('message->pass_qq'));
			if($post['msn'] && !is_email($post['msn'])) return $this->_(lang('message->pass_msn'));
		}
		if(!$post['title']) return $this->_($L['gbook_pass_title']);
		if(!$post['content']) return $this->_($L['gbook_pass_content']);
		return true;
	}

	function set($post) {
		global $DT_TIME, $_username, $DT_IP;
		$post['title'] = trim($post['title']);
		$post['content'] = trim($post['content']);
		$post['hidden'] = isset($post['hidden']) ? 1 : 0;
		if($this->itemid) {
			$post['status'] = $post['status'] == 2 ? 2 : 3;
			$post['editor'] = $_username;
			$post['edittime'] = $DT_TIME;
			$post['reply'] = trim($post['reply']);
		} else {
			$post['username'] = $_username;
			$post['addtime'] =  $DT_TIME;
			$post['ip'] =  $DT_IP;
			$post['edittime'] = 0;
			$post['reply'] = '';
			$post['status'] = 2;
		}
		$post = dhtmlspecialchars($post);
		return $post;
	}

	function get_one() {
        return $this->db->get_one("SELECT * FROM {$this->table} WHERE itemid='$this->itemid'");
	}

	function get_list($condition = 'status=3', $order = 'itemid DESC') {
		global $MOD, $pages, $page, $pagesize, $offset;
		$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
		while($r = $this->db->fetch_array($result)) {
			$r['adddate'] = timetodate($r['addtime'], 5);
			$r['content'] = nl2br($r['content']);
			$r['editdate'] = '--';
			if($r['reply']) {
				$r['reply'] = nl2br($r['reply']);
				$r['editdate'] = timetodate($r['edittime'], 5);
			}
			$lists[] = $r;
		}
		return $lists;
	}

	function add($post) {
		$post = $this->set($post);
		$sqlk = $sqlv = '';
		foreach($post as $k=>$v) {
			if(in_array($k, $this->fields)) { $sqlk .= ','.$k; $sqlv .= ",'$v'"; }
		}
        $sqlk = substr($sqlk, 1);
        $sqlv = substr($sqlv, 1);
		$this->db->query("INSERT INTO {$this->table} ($sqlk) VALUES ($sqlv)");
		return $this->itemid;
	}

	function edit($post) {
		$post = $this->set($post);
		$sql = '';
		foreach($post as $k=>$v) {
			if(in_array($k, $this->fields)) $sql .= ",$k='$v'";
		}
        $sql = substr($sql, 1);
	    $this->db->query("UPDATE {$this->table} SET $sql WHERE itemid=$this->itemid");
		return true;
	}

	function delete($itemid) {
		if(is_array($itemid)) {
			foreach($itemid as $v) { $this->delete($v); }
		} else {
			$this->db->query("DELETE FROM {$this->table} WHERE itemid=$itemid");
		}
	}

	function check($itemid, $status) {
		if(is_array($itemid)) {
			foreach($itemid as $v) { $this->check($v, $status); }
		} else {
			$this->db->query("UPDATE {$this->table} SET status=$status WHERE itemid=$itemid");
		}
	}

	function _($e) {
		$this->errmsg = $e;
		return false;
	}
}
?>