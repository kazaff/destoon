<?php
/*
	[Destoon B2C System] Copyright (c) 2009 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$pid = isset($pid) ? intval($pid) : 0;
$menus = array (
    array('产品管理', '?file='.$file.'&moduleid='.$moduleid),
);
$do = new product;
if($submit) {
	$do->update($post);
	dmsg('更新成功', '?file='.$file.'&moduleid='.$moduleid);
} else {
	$lists = $do->get_list();
	include tpl('product', $module);
}
class product {
	var $db;
	var $table;

	function product() {
		global $db, $DT_PRE;
		$this->table = $DT_PRE.'quote_product';
		$this->db = &$db;
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
		cache_quote_product();
		return true;
	}

	function add($post) {
		if(!$post['title'] || !$post['catid']) return false;
		$post['listorder'] = intval($post['listorder']);
		$v['catid'] = intval($v['catid']);
		$this->db->query("INSERT INTO {$this->table} (listorder,title,catid) VALUES('$post[listorder]','$post[title]','$post[catid]')");
	}

	function edit($post) {
		foreach($post as $k=>$v) {
			if(!$v['title'] || !$v['catid']) return false;
			$v['listorder'] = intval($v['listorder']);
			$v['catid'] = intval($v['catid']);
			$this->db->query("UPDATE {$this->table} SET listorder='$v[listorder]',title='$v[title]',catid='$v[catid]' WHERE pid='$k'");
		}
	}

	function delete($pid) {
		$this->db->query("DELETE FROM {$this->table} WHERE pid=$pid");
	}

	function get_list() {
		global $pages, $page, $pagesize, $offset, $pagesize;
		$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table}");
		$pages = pages($r['num'], $page, $pagesize);
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table} ORDER BY listorder DESC,pid DESC LIMIT $offset,$pagesize");
		while($r = $this->db->fetch_array($result)) {
			$lists[] = $r;
		}
		return $lists;
	}
}
?>