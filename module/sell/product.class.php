<?php
/*
	[Destoon B2C System] Copyright (c) 2009 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
class product {
	var $db;
	var $oid;
	var $table;
	var $table_option;
	var $errmsg = errmsg;

	function product() {
		global $db, $DT_PRE;
		$this->table = $DT_PRE.'sell_product';
		$this->table_option = $DT_PRE.'sell_option';
		$this->db = &$db;
	}

	function pass($post) {
		if(!is_array($post)) return false;
		if(!$post['pid']) return $this->_(lang('message->pass_product_op_pid'));
		if(!$post['name']) return $this->_(lang('message->pass_product_op_name'));
		if($post['type'] == 3) {
			if(!$post['value']) return $this->_(lang('message->pass_product_op_value'));
			if(strpos($post['value'], '|') === false) return $this->_(lang('message->pass_product_op_value_min'));
		}
		return true;
	}

	function set($post) {
		$post['value'] = $post['type'] ? trim($post['value']) : '';
		return $post;
	}

	function add($post) {
		$post = $this->set($post);
		$sqlk = $sqlv = '';
		foreach($post as $k=>$v) {
			$sqlk .= ','.$k; $sqlv .= ",'$v'";
		}
        $sqlk = substr($sqlk, 1);
        $sqlv = substr($sqlv, 1);
		$this->db->query("INSERT INTO {$this->table_option} ($sqlk) VALUES ($sqlv)");
		cache_option($post['pid']);
		return true;
	}

	function edit($post) {
		$post = $this->set($post);
		$sql = '';
		foreach($post as $k=>$v) {
			$sql .= ",$k='$v'";
		}
        $sql = substr($sql, 1);
	    $this->db->query("UPDATE {$this->table_option} SET $sql WHERE oid=$this->oid");
		cache_option($post['pid']);
		return true;
	}

	function get_one() {
        return $this->db->get_one("SELECT * FROM {$this->table_option} WHERE oid=$this->oid");
	}

	function delete($pid) {
		$this->db->query("DELETE FROM {$this->table_option} WHERE oid=$this->oid");
		cache_option($pid);
	}

	function order($listorder, $pid) {
		if(!is_array($listorder)) return false;
		foreach($listorder as $k=>$v) {
			$k = intval($k);
			$v = intval($v);
			$this->db->query("UPDATE {$this->table_option} SET listorder=$v WHERE oid=$k");
		}
		$pid ? cache_option($pid) : cache_option();
		return true;
	}

	function get_list($pid = 0) {
		global $pages, $page, $pagesize, $offset, $pagesize;
		$condition = 1;
		if($pid) $condition .= " AND pid=$pid";
		$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table_option} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table_option} WHERE $condition ORDER BY pid DESC,listorder DESC,oid DESC LIMIT $offset,$pagesize");
		while($r = $this->db->fetch_array($result)) {
			$lists[] = $r;
		}
		return $lists;
	}

	function update($post) {
		$this->_add($post[0]);
		unset($post[0]);
		foreach($post as $k=>$v) {
			if(isset($v['delete'])) {
				$this->_delete($k);
				unset($post[$k]);
			}
		}
		$this->_edit($post);
		cache_product();
		return true;
	}

	function _add($post) {
		if(!$post['title']) return false;
		$post['listorder'] = intval($post['listorder']);
		$post['catid'] = intval($post['catid']);
		$this->db->query("INSERT INTO {$this->table} (listorder,title,unit,catid) VALUES('$post[listorder]','$post[title]','$post[unit]','$post[catid]')");
	}

	function _edit($post) {
		foreach($post as $k=>$v) {
			if(!$v['title']) return false;
			$v['listorder'] = intval($v['listorder']);
			$v['catid'] = intval($v['catid']);
			$this->db->query("UPDATE {$this->table} SET listorder='$v[listorder]',title='$v[title]',unit='$v[unit]',catid='$v[catid]' WHERE pid='$k'");
		}
	}

	function _delete($pid) {
		$this->db->query("DELETE FROM {$this->table} WHERE pid=$pid");
	}

	function _get_list($condition = '1') {
		global $pages, $page, $pagesize, $offset, $pagesize;
		$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE $condition ORDER BY listorder DESC,pid DESC LIMIT $offset,$pagesize");
		while($r = $this->db->fetch_array($result)) {
			$n = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table_option} WHERE pid=$r[pid]");
			$r['items'] = $n['num'];
			$lists[] = $r;
		}
		return $lists;
	}

	function _($e) {
		$this->errmsg = $e;
		return false;
	}
}
?>