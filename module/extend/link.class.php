<?php 
defined('IN_DESTOON') or exit('Access Denied');
class dlink {
	var $itemid;
	var $db;
	var $table;
	var $fields;
	var $errmsg = errmsg;

    function dlink() {
		global $db, $DT_PRE;
		$this->table = $DT_PRE.'link';
		$this->db = &$db;
		$this->fields = array('typeid','level','title','style','thumb','introduce','addtime','editor','edittime','template', 'status', 'linkurl');
    }

	function pass($post) {
		global $L;
		if(!is_array($post)) return false;
		if(!$post['typeid']) return $this->_($L['link_pass_type']);
		if(!$post['title']) return $this->_($L['link_pass_site']);
		if(!$post['linkurl']) return $this->_($L['link_pass_url']);
		return true;
	}

	function set($post) {
		global $MOD, $DT_TIME, $_username, $_userid;
		if(!$this->itemid) $post['addtime'] = $DT_TIME;
		$post['edittime'] = $DT_TIME;
		$post['editor'] = $_username;
		clear_upload($post['thumb']);
		return $post;
	}

	function get_one() {
        return $this->db->get_one("SELECT * FROM {$this->table} WHERE itemid='$this->itemid'");
	}

	function get_list($condition = '1', $order = 'listorder DESC, itemid DESC') {
		global $MOD, $TYPE, $pages, $page, $pagesize, $offset;
		$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);
		$extendurl = extendurl('link');		
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
		while($r = $this->db->fetch_array($result)) {
			$r['title'] = set_style($r['title'], $r['style']);
			$r['adddate'] = timetodate($r['addtime'], 5);
			$r['editdate'] = timetodate($r['edittime'], 5);
			$r['typename'] = $TYPE[$r['typeid']]['typename'];
			$r['typeurl'] = $extendurl.rewrite('index.php?typeid='.$r['typeid']);
			$lists[] = $r;
		}
		return $lists;
	}

	function add($post) {
		global $DT, $MOD, $module;
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
		global $DT, $MOD, $module;
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
		global $CFG;
		if(is_array($itemid)) {
			foreach($itemid as $v) { 
				$this->delete($v, $all); 
			}
		} else {
			$this->itemid = $itemid;
			$r = $this->get_one();
			if($all) {
				$userid = get_user($r['editor']);
				if($r['thumb']) delete_upload($r['thumb'], $userid);
				$this->db->query("DELETE FROM {$this->table} WHERE itemid=$itemid");
			}
		}
	}

	function check($itemid) {
		global $_username, $DT_TIME;
		if(is_array($itemid)) {
			foreach($itemid as $v) { $this->check($v); }
		} else {
			$this->db->query("UPDATE {$this->table} SET status=3,editor='$_username',edittime=$DT_TIME WHERE itemid=$itemid");
			return true;
		}
	}

	function order($listorder) {
		if(!is_array($listorder)) return false;
		foreach($listorder as $k=>$v) {
			$k = intval($k);
			$v = intval($v);
			$this->db->query("UPDATE {$this->table} SET listorder=$v WHERE itemid=$k");
		}
		return true;
	}

	function level($itemid, $level) {
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$this->db->query("UPDATE {$this->table} SET level=$level WHERE itemid IN ($itemids)");
	}

	function _($e) {
		$this->errmsg = $e;
		return false;
	}
}
?>