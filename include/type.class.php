<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
class dtype {
	var $item;
	var $db;
	var $table;
	var $cache = 0;

	function dtype() {
		global $db;
		$this->db = &$db;
		$this->table = $this->db->pre.'type';
	}

	function get_list() {
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE item='$this->item' ORDER BY listorder ASC,typeid DESC ");
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
		if($this->cache) cache_type($this->item);
		return true;
	}

	function add($post) {
		if(!$post['typename']) return false;
		$post['listorder'] = intval($post['listorder']);
		$this->db->query("INSERT INTO {$this->table} (listorder,typename,style,item,cache) VALUES('$post[listorder]','$post[typename]','$post[style]','$this->item','$this->cache')");
	}

	function edit($post) {
		foreach($post as $k=>$v) {
			if(!$v['typename']) continue;
			$v['listorder'] = intval($v['listorder']);
			$this->db->query("UPDATE {$this->table} SET listorder='$v[listorder]',typename='$v[typename]',style='$v[style]' WHERE typeid='$k' AND item='$this->item'");
		}
	}

	function delete($typeid) {
		$this->db->query("DELETE FROM {$this->table} WHERE typeid=$typeid AND item='$this->item'");
		if($this->cache) cache_type($this->item);
	}
}
?>