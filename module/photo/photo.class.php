<?php
defined('IN_DESTOON') or exit('Access Denied');
class photo {
	var $moduleid;
	var $itemid;
	var $db;
	var $table;
	var $table_data;
	var $table_item;
	var $split;
	var $fields;
	var $errmsg = errmsg;

    function photo($moduleid) {
		global $db, $table, $table_data, $table_item, $MOD;
		$this->moduleid = $moduleid;
		$this->table = $table;
		$this->table_data = $table_data;
		$this->table_item = $table_item;
		$this->split = $MOD['split'];
		$this->db = &$db;
		$this->fields = array('catid','level','title','style','fee','introduce','thumb','banner','tag','status','hits','open','password','question','answer','username','addtime', 'editor','edittime','ip','template', 'linkurl','filepath','domain','note');
    }

	function pass($post) {
		if(!is_array($post)) return false;
		if(!$post['catid']) return $this->_(lang('message->pass_catid'));
		if(strlen($post['title']) < 3) return $this->_(lang('message->pass_title'));
		if(!$post['password'] && $post['open'] == 2) return $this->_(lang('photo->pass_password'));
		if(!$post['question'] && $post['open'] == 1) return $this->_(lang('photo->pass_question'));
		if(!$post['answer'] && $post['open'] == 1) return $this->_(lang('photo->pass_answer'));
		return true;
	}

	function set($post) {
		global $MOD, $DT_TIME, $DT_IP, $CATEGORY, $_username, $_userid;
		$post['addtime'] = (isset($post['addtime']) && $post['addtime']) ? strtotime($post['addtime']) : $DT_TIME;
		$post['edittime'] = $DT_TIME;
		$post['ip'] = $DT_IP;
		$post['title'] = trim($post['title']);
		$post['content'] = stripslashes($post['content']);
		$post['fee'] = dround($post['fee']);
		if($MOD['clear_link']) $post['content'] = clear_link($post['content']);
		if($MOD['save_remotepic']) $post['content'] = save_remote($post['content']);
		if($MOD['introduce_length']) $post['introduce'] = addslashes(get_intro($post['content'], $MOD['introduce_length']));
		if($this->itemid) {
			$post['editor'] = $_username;
			$new = $post['content'];
			if($post['thumb']) $new .= '<img src="'.$post['thumb'].'">';
			$r = $this->get_one();
			$old = $r['content'];
			if($r['thumb']) $old .= '<img src="'.$r['thumb'].'">';
			delete_diff($new, $old);
		} else {
			$post['username'] = $post['editor'] = $_username;
		}
		if(!defined('DT_ADMIN')) {
			$content = $post['content'];
			unset($post['content']);
			$post = dhtmlspecialchars($post);
			$post['content'] = $content;
		}
		$post['content'] = addslashes($post['content']);
		return $post;
	}

	function get_one() {
		$content_table = content_table($this->moduleid, $this->itemid, $this->split, $this->table_data);
        return $this->db->get_one("SELECT * FROM {$this->table} a,{$content_table} c WHERE a.itemid=c.itemid and a.itemid=$this->itemid");
	}

	function get_list($condition = 'status=3', $order = 'addtime DESC', $cache = '') {
		global $MOD, $pages, $page, $pagesize, $offset, $items;
		$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table} WHERE $condition", $cache);
		$items = $r['num'];
		$pages = defined('CATID') ? listpages(1, CATID, $items, $page, $pagesize, 10, $MOD['linkurl']) : pages($items, $page, $pagesize);
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize", $cache);
		while($r = $this->db->fetch_array($result)) {
			$r['adddate'] = timetodate($r['addtime'], 5);
			$r['editdate'] = timetodate($r['edittime'], 5);
			$r['alt'] = $r['title'];
			$r['title'] = set_style($r['title'], $r['style']);
			$r['linkurl'] = $MOD['linkurl'].$r['linkurl'];
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
		$content_table = content_table($this->moduleid, $this->itemid, $this->split, $this->table_data);
		$this->db->query("INSERT INTO {$content_table} (itemid,content) VALUES ('$this->itemid', '$post[content]')");
		$this->update($this->itemid, $post, $post['content']);
		if($post['status'] == 3 && $post['username'] && $MOD['credit_add']) {
			credit_add($post['username'], $MOD['credit_add']);
			credit_record($post['username'], $MOD['credit_add'], 'system', lang('my->credit_record_add', array($MOD['name'])), 'ID:'.$this->itemid);
		}
		clear_upload($post['content'].$post['thumb'], $this->itemid);
		if($post['status'] == 3) $this->tohtml($this->itemid, $post['catid']);
		return $this->itemid;
	}

	function edit($post) {
		$this->delete($this->itemid, false);
		$post = $this->set($post);
		$sql = '';
		foreach($post as $k=>$v) {
			if(in_array($k, $this->fields)) $sql .= ",$k='$v'";
		}
        $sql = substr($sql, 1);
	    $this->db->query("UPDATE {$this->table} SET $sql WHERE itemid=$this->itemid");
		$content_table = content_table($this->moduleid, $this->itemid, $this->split, $this->table_data);
	    $this->db->query("UPDATE {$content_table} SET content='$post[content]' WHERE itemid=$this->itemid");
		$this->update($this->itemid, $post, $post['content']);
		clear_upload($post['content'].$post['thumb'], $this->itemid);
		if($post['status'] == 3) $this->tohtml($this->itemid, $post['catid']);
		return true;
	}

	function tohtml($itemid = 0, $catid = 0) {
		global $module, $MOD;
		if($MOD['show_html'] && $itemid) tohtml('show', $module, "itemid=$itemid");
		if($MOD['list_html'] && $catid) tohtml('list', $module, "catid=$catid&fid=1&num=3");
		if($MOD['index_html']) tohtml('index', $module);
	}

	function update($itemid, $item = array(), $content = '') {
		$item or $item = $this->db->get_one("SELECT * FROM {$this->table} WHERE itemid=$itemid");
		$keyword = $item['title'].','.strip_tags(cat_pos($item['catid'], ','));
		$keyword = str_replace("//", '', addslashes($keyword));
		$item['itemid'] = $itemid;
		$linkurl = itemurl($item);
		$sql = "keyword='$keyword',linkurl='$linkurl'";
		$this->db->query("UPDATE {$this->table} SET $sql WHERE itemid=$itemid");
	}

	function recycle($itemid) {
		if(is_array($itemid)) {
			foreach($itemid as $v) { $this->recycle($v); }
		} else {
			$this->db->query("UPDATE {$this->table} SET status=0 WHERE itemid=$itemid");
			$this->delete($itemid, false);
			return true;
		}		
	}

	function restore($itemid) {
		global $module, $MOD;
		if(is_array($itemid)) {
			foreach($itemid as $v) { $this->restore($v); }
		} else {
			$this->db->query("UPDATE {$this->table} SET status=3 WHERE itemid=$itemid");
			if($MOD['show_html']) tohtml('show', $module, "itemid=$itemid");
			return true;
		}		
	}

	function delete($itemid, $all = true) {
		global $CFG, $MOD;
		if(is_array($itemid)) {
			foreach($itemid as $v) { 
				$this->delete($v, $all);
			}
		} else {
			$this->itemid = $itemid;
			$r = $this->get_one();
			if($MOD['show_html']) {
				$_file = DT_ROOT.'/'.$MOD['moduledir'].'/'.$r['linkurl'];
				if(is_file($_file)) unlink($_file);
			}
			if($all) {
				$userid = get_user($r['username']);
				if($r['thumb']) delete_upload($r['thumb'], $userid);
				if($r['content']) delete_local($r['content'], $userid);
				$this->db->query("DELETE FROM {$this->table} WHERE itemid=$itemid");
				$content_table = content_table($this->moduleid, $this->itemid, $this->split, $this->table_data);
				$this->db->query("DELETE FROM {$content_table} WHERE itemid=$itemid");
				$result = $this->db->query("SELECT * FROM {$this->table_item} WHERE item=$itemid");
				while($rr = $this->db->fetch_array($result)) {
					delete_upload($rr['thumb'], $userid);
				}
				$this->db->query("DELETE FROM {$this->table_item} WHERE item=$itemid");
				if($r['username'] && $MOD['credit_del']) {
					credit_add($r['username'], -$MOD['credit_del']);
					credit_record($r['username'], -$MOD['credit_del'], 'system', lang('my->credit_record_del', array($MOD['name'])), 'ID:'.$this->itemid);
				}
			}
		}
	}

	function check($itemid) {
		global $_username, $DT_TIME, $MOD;;
		if(is_array($itemid)) {
			foreach($itemid as $v) { $this->check($v); }
		} else {
			$this->itemid = $itemid;
			$item = $this->get_one();
			if($MOD['credit_add'] && $item['username'] && $item['addtime'] == $item['edittime']) {
				credit_add($item['username'], $MOD['credit_add']);
				credit_record($item['username'], $MOD['credit_add'], 'system', lang('my->credit_record_add', array($MOD['name'])), 'ID:'.$this->itemid);
			}
			$this->db->query("UPDATE {$this->table} SET status=3,editor='$_username',edittime=$DT_TIME WHERE itemid=$itemid");
			$this->tohtml($itemid);
			return true;
		}
	}

	function reject($itemid) {
		global $_username, $DT_TIME;
		if(is_array($itemid)) {
			foreach($itemid as $v) { $this->reject($v); }
		} else {
			$this->db->query("UPDATE {$this->table} SET status=1,editor='$_username' WHERE itemid=$itemid");
			return true;
		}
	}

	function clear($condition = 'status=0') {		
		$result = $this->db->query("SELECT itemid FROM {$this->table} WHERE $condition ");
		while($r = $this->db->fetch_array($result)) {
			$this->delete($r['itemid']);
		}
	}

	function level($itemid, $level) {
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$this->db->query("UPDATE {$this->table} SET level=$level WHERE itemid IN ($itemids)");
	}

	function item_list($condition = 'status=3', $order = 'listorder ASC,itemid ASC', $cache = '') {
		global $MOD, $pages, $page, $pagesize, $offset, $items;
		$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table_item} WHERE $condition", $cache);
		$items = $r['num'];
		$pages =  pages($items, $page, $pagesize);
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table_item} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize", $cache);
		while($r = $this->db->fetch_array($result)) {
			$lists[] = $r;
		}
		return $lists;
	}
	
	function item_update($post) {
		global $L;
		$thumb = '';
		foreach($post as $v) {
			$thumb .= $v['thumb'];
		}
		if($thumb) clear_upload($thumb, $this->itemid);
		if($post[0]['thumb']) {
			$thumb = $post[0]['thumb'];
			$listorder = intval($post[0]['listorder']);
			$introduce = $post[0]['introduce'];
			if($introduce == $L['photo_intro']) $introduce = '';
			$this->db->query("INSERT INTO {$this->table_item} (item,thumb,introduce,listorder) VALUES ('$this->itemid', '$thumb','$introduce','$listorder')");
		}
		unset($post[0]);
		foreach($post as $k=>$v) {
			if($v['thumb']) {				
				$thumb = $v['thumb'];
				$listorder = intval($v['listorder']);
				$introduce = $v['introduce'];
				if($introduce == $L['photo_intro']) $introduce = '';
				$this->db->query("UPDATE {$this->table_item} SET thumb='$thumb',introduce='$introduce',listorder='$listorder' WHERE itemid=$k");
			} else {
				$this->item_delete($k);
			}
		}
	}

	function item_delete($itemid = 0) {
		global $_userid;
		if($itemid) {
			$r = $this->db->get_one("SELECT thumb FROM {$this->table_item} WHERE itemid=$itemid");
			if($r) {
				delete_upload($r['thumb'], $_userid);
				$this->db->query("DELETE FROM {$this->table_item} WHERE itemid=$itemid");
			}
		} else {
			$result = $this->db->query("SELECT thumb FROM {$this->table_item} WHERE item=$this->itemid");
			while($r = $this->db->fetch_array($result)) {
				delete_upload($r['thumb'], $_userid);
			}
			$this->db->query("DELETE FROM {$this->table_item} WHERE item=$this->itemid");
		}
	}

	function _($e) {
		$this->errmsg = $e;
		return false;
	}
}
?>