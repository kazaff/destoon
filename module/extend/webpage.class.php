<?php 
defined('IN_DESTOON') or exit('Access Denied');
class webpage {
	var $itemid;
	var $item;
	var $db;
	var $table;
	var $fields;
	var $errmsg = errmsg;

    function webpage() {
		global $db, $DT_PRE;
		$this->table = $DT_PRE.'webpage';
		$this->db = &$db;
		$this->fields = array('item', 'title','level','style','content','seo_title','seo_keywords','seo_description','editor','edittime','template', 'islink', 'linkurl','domain');
    }

	function pass($post) {
		global $L;
		if(!is_array($post)) return false;
		if(!$post['title']) return $this->_($L['webpage_pass_title']);
		if(isset($post['islink'])) {
			if(!$post['linkurl']) return $this->_($L['webpage_pass_linkurl']);
		} else {
			if($post['filepath'] && !preg_match("/^[0-9a-z_\-\/]+\/$/", $post['filepath'])) return $this->_($L['webpage_pass_path']);
			if($post['filename'] && !preg_match("/^[0-9a-z_\-]+\.[a-z]+$/", $post['filename'])) return $this->_($L['webpage_pass_name']);
			if($post['filename']) {
				if($this->itemid) {
					$r = $this->get_one();
					if($r['linkurl'] != $post['filepath'].$post['filename']) {
						if(is_file(DT_ROOT.'/'.$post['filepath'].$post['filename'])) return $this->_($L['webpage_pass_exist']);
					}
				} else {
					if(is_file(DT_ROOT.'/'.$post['filepath'].$post['filename'])) return $this->_($L['webpage_pass_exist']);
				}
			}
		}
		return true;
	}

	function set($post) {
		global $MOD, $DT_TIME, $_username, $_userid;
		$post['islink'] = isset($post['islink']) ? 1 : 0;
		$post['edittime'] = $DT_TIME;
		$post['editor'] = $_username;
		if($post['content'] && isset($post['clear_link'])) $post['content'] = clear_link($post['content']);
		if($post['content'] && isset($post['save_remotepic'])) $post['content'] = addslashes(save_remote($post['content'], $MOD['moduledir']));
		clear_upload($post['content']);
		if($this->itemid) {
			$new = $post['content'];
			$r = $this->get_one();
			$old = $r['content'];
			delete_diff($new, $old);
		}
		$post['item'] = $this->item;
		return $post;
	}

	function get_one() {
        return $this->db->get_one("SELECT * FROM {$this->table} WHERE itemid=$this->itemid");
	}

	function get_list($condition = 'status=3', $order = 'listorder DESC, itemid DESC') {
		global $MOD, $pages, $page, $pagesize, $offset;
		$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
		while($r = $this->db->fetch_array($result)) {
			$r['title'] = set_style($r['title'], $r['style']);
			$r['editdate'] = timetodate($r['edittime'], 5);
			$r['linkurl'] = $r['domain'] ? $r['domain'] : linkurl($r['linkurl'], 1);
			$lists[] = $r;
		}
		return $lists;
	}

	function add($post) {
		global $DT, $module;
		$post = $this->set($post);
		$sqlk = $sqlv = '';
		foreach($post as $k=>$v) {
			if(in_array($k, $this->fields)) { $sqlk .= ','.$k; $sqlv .= ",'$v'"; }
		}
        $sqlk = substr($sqlk, 1);
        $sqlv = substr($sqlv, 1);
		$this->db->query("INSERT INTO {$this->table} ($sqlk) VALUES ($sqlv)");
		$this->itemid = $this->db->insert_id();
		if(!$post['islink']) {
			if($post['filename']) {
				$linkurl = $post['filepath'].$post['filename'];
			} else {
				$linkurl = $post['filepath'].$this->itemid.'.'.$DT['file_ext'];
			}
			$this->db->query("UPDATE {$this->table} SET linkurl='$linkurl',listorder=$this->itemid WHERE itemid=$this->itemid");
		}
		tohtml('webpage', $module, "itemid=$this->itemid");
		return $this->itemid;
	}

	function edit($post) {
		global $DT, $module;
		$this->delete($this->itemid, false);
		$post = $this->set($post);
		$sql = '';
		foreach($post as $k=>$v) {
			if(in_array($k, $this->fields)) $sql .= ",$k='$v'";
		}
        $sql = substr($sql, 1);
	    $this->db->query("UPDATE {$this->table} SET $sql WHERE itemid=$this->itemid");
		if(!$post['islink']) {
			if($post['filename']) {
				$linkurl = $post['filepath'].$post['filename'];
			} else {
				$linkurl = $post['filepath'].$this->itemid.'.'.$DT['file_ext'];
			}
			$this->db->query("UPDATE {$this->table} SET linkurl='$linkurl' WHERE itemid=$this->itemid");
		}
		tohtml('webpage', $module, "itemid=$this->itemid");
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
			if(!$r['islink']) {
				$_file = DT_ROOT.'/'.$r['linkurl'];
				if(is_file($_file)) unlink($_file);
			}
			if($all) {
				$userid = get_user($r['editor']);
				if($r['content']) delete_local($r['content'], $userid);
				$this->db->query("DELETE FROM {$this->table} WHERE itemid=$itemid");
			}
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

	function html() {
		global $module;
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE islink=0");
		while($r = $this->db->fetch_array($result)) {
			$itemid = $r['itemid'];
			tohtml('webpage', $module, "itemid=$itemid");
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