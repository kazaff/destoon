<?php 
defined('IN_DESTOON') or exit('Access Denied');
class comment {
	var $itemid;
	var $db;
	var $table;
	var $table_stat;
	var $table_ban;
	var $errmsg = errmsg;

    function comment() {
		global $db;
		$this->table = $db->pre.'comment';
		$this->table_stat = $db->pre.'comment_stat';
		$this->table_ban = $db->pre.'comment_ban';
		$this->db = &$db;
    }

	function pass($post) {
		global $L;
		if(!is_array($post)) return false;
		if(!$post['content']) return $this->_($L['comment_pass_content']);
		return true;
	}

	function set($post) {
		global $DT_TIME, $_username;
		$post['hidden'] = isset($post['hidden']) ? 1 : 0;
		$post['status'] = $post['status'] == 3 ? 3 : 2;
		if($post['reply']) {
			$post['replytime'] = $DT_TIME;
			$post['reply'] = trim($post['reply']);
		}
		$post['editor'] = $_username;
		return $post;
	}

	function get_one() {
        return $this->db->get_one("SELECT * FROM {$this->table} WHERE itemid='$this->itemid'");
	}

	function get_list($condition = 'status=3', $order = 'itemid DESC') {
		global $MOD, $TYPE, $pages, $page, $pagesize, $offset, $items;
		$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table} WHERE $condition");
		$items = $r['num'];
		$pages = pages($items, $page, $pagesize);		
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
		while($r = $this->db->fetch_array($result)) {
			$r['adddate'] = timetodate($r['addtime'], 6);
			$r['replydate'] = $r['replytime'] ? timetodate($r['replytime'], 6) : '';
			$lists[] = $r;
		}
		return $lists;
	}

	function edit($post) {
		$post = $this->set($post);
		$sql = '';
		foreach($post as $k=>$v) {
			$sql .= ",$k='$v'";
		}
        $sql = substr($sql, 1);
	    $this->db->query("UPDATE {$this->table} SET $sql WHERE itemid=$this->itemid");
		return true;
	}

	function delete($itemid) {
		global $MOD, $L;
		if(is_array($itemid)) {
			foreach($itemid as $v) { 
				$this->delete($v); 
			}
		} else {
			$this->itemid = $itemid;
			$r = $this->get_one();
			if($r) {
				$star = 'star'.$r['star'];
				$this->db->query("UPDATE {$this->table_stat} SET comment=comment-1,`{$star}`=`{$star}`-1 WHERE itemid=$r[item_id] AND moduleid=$r[item_mid]");
				$this->db->query("DELETE FROM {$this->table} WHERE itemid=$itemid");
				if($r['username'] && $MOD['credit_del_comment']) {
					credit_add($r['username'], -$MOD['credit_del_comment']);
					credit_record($r['username'], -$MOD['credit_del_comment'], 'system', $L['comment_record_del'], 'ID:'.$r['itemid']);
				}
			}
		}
	}

	function check($itemid, $status = 3) {
		global $MOD, $L;
		if(is_array($itemid)) {
			foreach($itemid as $v) { 
				$this->check($v, $status); 
			}
		} else {
			if($MOD['credit_add_comment'] && $status == 3) {
				$this->itemid = $itemid;
				$item = $this->get_one();
				if($item['username']) {
					credit_add($item['username'], $MOD['credit_add_comment']);
					credit_record($item['username'], $MOD['credit_add_comment'], 'system', $L['comment_record_add'], 'ID:'.$itemid);
				}
			}
			$this->db->query("UPDATE {$this->table} SET status=$status WHERE itemid=$itemid");
		}
	}

	function get_ban_list($condition = '1') {
		global $pages, $page, $pagesize, $offset, $pagesize;
		$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table_ban} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table_ban} WHERE $condition ORDER BY bid DESC LIMIT $offset,$pagesize");
		while($r = $this->db->fetch_array($result)) {
			$r['edittime'] = timetodate($r['edittime'], 6);
			$lists[] = $r;
		}
		return $lists;
	}

	function ban_update($post) {
		$this->_add($post[0]);
		unset($post[0]);
		foreach($post as $k=>$v) {
			if(isset($v['delete'])) {
				$this->_delete($k);
				unset($post[$k]);
			}
		}
		$this->_edit($post);
		cache_bancomment();
		return true;
	}

	function _add($post) {
		global $DT_TIME, $_username;
		$post['moduleid'] = intval($post['moduleid']);
		$post['itemid'] = intval($post['itemid']);
		if(!$post['moduleid'] || !$post['itemid']) return false;
		$this->db->query("INSERT INTO {$this->table_ban} (moduleid,itemid,editor,edittime) VALUES('$post[moduleid]','$post[itemid]','$_username','$DT_TIME')");
	}

	function _edit($post) {
		foreach($post as $k=>$v) {
			$v['moduleid'] = intval($v['moduleid']);
			$v['itemid'] = intval($v['itemid']);
			if(!$v['moduleid'] || !$v['itemid']) return false;
			$this->db->query("UPDATE {$this->table_ban} SET moduleid='$v[moduleid]',itemid='$v[itemid]' WHERE bid='$k'");
		}
	}

	function _delete($bid) {
		$this->db->query("DELETE FROM {$this->table_ban} WHERE bid=$bid");
	}

	function _($e) {
		$this->errmsg = $e;
		return false;
	}
}
?>