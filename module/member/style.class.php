<?php 
defined('IN_DESTOON') or exit('Access Denied');
class style {
	var $itemid;
	var $db;
	var $table;
	var $fields;
	var $errmsg = errmsg;

    function style() {
		global $db, $DT_PRE;
		$this->table = $DT_PRE.'style';
		$this->db = &$db;
		$this->fields = array('typeid','title','skin','template','author','groupid','fee','currency', 'addtime','editor','edittime');
    }

	function pass($post) {
		global $CFG, $MODULE, $L;
		if(!is_array($post)) return false;
		if(!$post['title']) return $this->_($L['style_pass_title']);
		if(!$post['skin']) return $this->_($L['style_pass_skin']);
		if(!preg_match("/^[a-z0-9\-_]+$/i", $post['skin'])) return $this->_($L['style_pass_skin_match']);
		if(!is_file(DT_ROOT.'/'.$MODULE[4]['moduledir'].'/skin/'.$post['skin'].'/style.css')) return $this->_($L['style_pass_css']);
		if(!$post['template']) return $this->_($L['style_pass_template']);
		if(!preg_match("/^[a-z0-9\-_]+$/i", $post['template'])) return $this->_($L['style_pass_template_match']);
		if(!is_dir(DT_ROOT.'/template/'.$CFG['template'].'/'.$post['template'].'/')) return $this->_($L['style_pass_dir']);
		if(!isset($post['groupid'])) return $this->_($L['style_pass_groupid']);
		return true;
	}

	function set($post) {
		global $MOD, $DT_TIME, $_username, $_userid;
		$post['addtime'] = (isset($post['addtime']) && $post['addtime']) ? strtotime($post['addtime']) : $DT_TIME;
		$post['edittime'] = $DT_TIME;
		$post['editor'] = $_username;		
		$post['groupid'] = (isset($post['groupid']) && $post['groupid']) ? ','.implode(',', $post['groupid']).',' : '';
		$post['fee'] = dround($post['fee']);
		return $post;
	}

	function get_one($condition = '') {
        return $this->db->get_one("SELECT * FROM {$this->table} WHERE itemid='$this->itemid' $condition");
	}

	function get_list($condition = '1', $order = 'listorder DESC, itemid DESC') {
		global $MODULE, $CFG, $MOD, $pages, $page, $pagesize, $offset;
		$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);
		$GROUP = cache_read('group.php');
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
		while($r = $this->db->fetch_array($result)) {
			$r['adddate'] = timetodate($r['addtime'], 5);
			$r['thumb'] = is_file(DT_ROOT.'/'.$MODULE[4]['moduledir'].'/skin/'.$r['skin'].'/thumb.gif') ? $MODULE[4]['linkurl'].'skin/'.$r['skin'].'/thumb.gif' : DT_SKIN.'image/nopic150.gif';
			$groupid = explode(',', substr($r['groupid'], 1, -1));
			$group = array();
			foreach($groupid as $gid) {
				$group[] = $GROUP[$gid]['groupname'];
			}
			$r['group'] = implode('<br/>', $group);
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

	function delete($itemid, $all = true) {
		global $CFG, $MOD;
		if(is_array($itemid)) {
			foreach($itemid as $v) { $this->delete($v); }
		} else {
			$r = $this->db->get_one("SELECT * FROM {$this->table} WHERE itemid=$itemid");
			$this->db->query("UPDATE {$this->db->pre}company SET skin='',template='' WHERE skin='".$r['skin']."' AND template='".$r['template']."'");
			$this->db->query("DELETE FROM {$this->table} WHERE itemid=$itemid");
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

	function _($e) {
		$this->errmsg = $e;
		return false;
	}
}
?>