<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$menus = array(
    array('问题验证', '?file='.$file),
);
$do = new question;
if($submit) {
	$do->update($post);
	dmsg('更新成功', '?file='.$file.'&item='.$item);
} else {
	$condition = "1";
	if($kw) $condition .= " AND (question LIKE '%$keyword%' OR answer LIKE '%$keyword%')";
	$lists = $do->get_list($condition);
	include tpl('question');
}

class question {
	var $db;
	var $table;

	function question() {
		global $db, $DT_PRE;
		$this->table = $DT_PRE.'question';
		$this->db = &$db;
	}

	function get_list($condition) {
		global $pages, $page, $pagesize, $offset, $pagesize;
		$pages = pages($this->db->count($this->table, $condition), $page, $pagesize);
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE $condition ORDER BY qid DESC LIMIT $offset,$pagesize");
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
		return true;
	}

	function add($post) {
		if(!$post['question'] || !$post['answer']) return false;
		$Q = explode("\n", $post['question']);
		$A = explode("\n", $post['answer']);
		foreach($Q as $k=>$q) {
			$q = trim($q);
			if($q) {
				$a = isset($A[$k]) ? trim($A[$k]) : '';
				if($q && $a) $this->db->query("INSERT INTO {$this->table} (question,answer) VALUES('$q','$a')");
			}
		}
	}

	function edit($post) {
		foreach($post as $k=>$v) {
			if(!$v['question'] || !$v['answer']) continue;
			$this->db->query("UPDATE {$this->table} SET question='$v[question]',answer='$v[answer]' WHERE qid='$k'");
		}
	}

	function delete($qid) {
		$this->db->query("DELETE FROM {$this->table} WHERE qid=$qid");
	}
}
?>