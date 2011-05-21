<?php 
defined('IN_DESTOON') or exit('Access Denied');
class alert {
	var $itemid;
	var $db;
	var $table;
	var $table_data;
	var $fields;
	var $errmsg = errmsg;

    function alert() {
		global $db;
		$this->db = &$db;
		$this->table = $this->db->pre.'alert';
		$this->table_data = $this->db->pre.'alert_data';
		$this->fields = array('word','email','mid','catid','areaid','rate','username','addtime','editor','edittime','status');
    }

	function pass($post) {
		global $L;
		if(!is_array($post)) return false;
		if(!$post['word'] && !$post['catid']) return $this->_($L['alert_pass']);
		return true;
	}

	function set($post) {
		global $MOD, $DT_TIME, $_username;
		$post['edittime'] = $DT_TIME;
		$post['editor'] = $_username;
		return $post;
	}

	function get_one() {
        return $this->db->get_one("SELECT * FROM {$this->table} WHERE itemid=$this->itemid");
	}

	function get_list($condition = 'status=3', $order = 'itemid DESC') {
		global $MOD, $pages, $page, $pagesize, $offset;
		$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
		while($r = $this->db->fetch_array($result)) {
			$lists[] = $r;
		}
		return $lists;
	}

	function add($post) {
		global $MOD;
		$post = $this->set($post);
		$sqlk = $sqlv = '';
		foreach($post as $k=>$v) {
			if(in_array($k, $this->fields)) { $sqlk .= ','.$k; $sqlv .= ",'$v'"; }
		}
        $sqlk = substr($sqlk, 1);
        $sqlv = substr($sqlv, 1);
		$this->db->query("INSERT INTO {$this->table} ($sqlk) VALUES ($sqlv)");
		$this->itemid = $this->db->insert_id();
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

	function delete($itemid, $all = true) {
		global $CFG, $MOD;
		if(is_array($itemid)) {
			foreach($itemid as $v) { $this->delete($v); }
		} else {
			$this->db->query("DELETE FROM {$this->table} WHERE itemid=$itemid");
		}
	}

	function check($itemid, $status = 3) {
		global $_username, $DT_TIME;
		if(is_array($itemid)) {
			foreach($itemid as $v) { $this->check($v, $status); }
		} else {
			$this->db->query("UPDATE {$this->table} SET status=$status,editor='$_username',edittime=$DT_TIME WHERE itemid=$itemid");
			return true;
		}
	}

	function _($e) {
		$this->errmsg = $e;
		return false;
	}
}
?>