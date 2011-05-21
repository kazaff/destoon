<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$menus = array(
    array('词语过滤', '?file='.$file),
);
$do = new banword;
if($submit) {
	$do->update($post);
	dmsg('更新成功', '?file='.$file.'&item='.$item);
} else {
	$condition = "1";
	if($keyword) $condition .= " AND (replacefrom LIKE '%$keyword%' OR replaceto LIKE '%$keyword%')";
	$lists = $do->get_list($condition);
	include tpl('banword');
}

class banword {
	var $db;
	var $table;

	function banword() {
		global $db, $DT_PRE;
		$this->table = $DT_PRE.'banword';
		$this->db = &$db;
	}

	function get_list($condition) {
		global $pages, $page, $pagesize, $offset, $pagesize;
		$pages = pages($this->db->count($this->table, $condition), $page, $pagesize);
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE $condition ORDER BY bid DESC LIMIT $offset,$pagesize");
		while($r = $this->db->fetch_array($result)) {
			$lists[] = $r;
		}
		return $lists;
	}

	function update($post) {
		$this->add($post[0]);
		unset($post[0]);
		foreach($post as $k=>$v) {
			if(isset($v['delete'])) {
				$this->delete($k);
				unset($post[$k]);
			}
		}
		$this->edit($post);
		cache_banword();
	}

	function add($post) {
		if(!$post['replacefrom']) return false;
		$post['deny'] = $post['deny'] ? 1 : 0;
		$F = explode("\n", $post['replacefrom']);
		$T = explode("\n", $post['replaceto']);
		foreach($F as $k=>$f) {
			$f = trim($f);
			if($f) {
				$t = isset($T[$k]) ? trim($T[$k]) : '';
				if($f != $t) $this->db->query("INSERT INTO {$this->table} (replacefrom,replaceto,deny) VALUES('$f','$t','$post[deny]')");
			}
		}
	}

	function edit($post) {
		foreach($post as $k=>$v) {
			if(!$v['replacefrom']) continue;
			$v['deny'] = $v['deny'] ? 1 : 0;
			if($v['replacefrom'] != $v['replaceto']) $this->db->query("UPDATE {$this->table} SET replacefrom='$v[replacefrom]',replaceto='$v[replaceto]',deny='$v[deny]' WHERE bid='$k'");
		}
	}

	function delete($bid) {
		$this->db->query("DELETE FROM {$this->table} WHERE bid=$bid");
	}
}
?>