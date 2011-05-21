<?php 
defined('IN_DESTOON') or exit('Access Denied');
class friend {
	var $itemid;
	var $db;
	var $table;
	var $fields;
	var $errmsg = errmsg;

    function friend() {
		global $db;
		$this->table = $db->pre.'friend';
		$this->db = &$db;
		$this->fields = array('listorder', 'userid','typeid','username','truename','style','company','career','telephone','mobile','homepage','email','msn','qq','ali','skype','note','addtime');
    }

	function pass($post) {
		global $_userid, $L;
		if(!is_array($post)) return false;
		if(!$post['truename']) return $this->_($L['friend_pass_truename']);
		return true;
	}

	function set($post) {
		if($post['email'] && !is_email($post['email'])) $post['email'] = '';
		if($post['msn'] && !is_email($post['msn'])) $post['msn'] = '';
		if($post['qq'] && !is_numeric($post['qq'])) $post['qq'] = '';
		$post = dhtmlspecialchars($post);
		return $post;
	}

	function get_one($condition = '') {
        return $this->db->get_one("SELECT * FROM {$this->table} WHERE itemid=$this->itemid $condition");
	}

	function get_list($condition = 'status=3', $order = 'itemid DESC') {
		global $TYPE, $pages, $page, $pagesize, $offset, $L;
		$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
		while($r = $this->db->fetch_array($result)) {
			$r['adddate'] = timetodate($r['addtime'], 5);
			$r['dcompany'] = set_style($r['company'], $r['style']);
			$r['type'] = $r['typeid'] && isset($TYPE[$r['typeid']]) ? set_style($TYPE[$r['typeid']]['typename'], $TYPE[$r['typeid']]['style']) : $L['default_type'];
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
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$this->db->query("DELETE FROM {$this->table} WHERE itemid IN ($itemids)");
	}

	function _($e) {
		$this->errmsg = $e;
		return false;
	}
}
?>