<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('已启用', '?file='.$file),
    array('待审核', '?file='.$file.'&status=2'),

);
$MODULE[-7]['moduleid'] = -7;
$MODULE[-7]['name'] = '报价';
$MODULE[-7]['linkurl'] = $MODULE[5]['linkurl'];
$MODULE[-9]['moduleid'] = -9;
$MODULE[-9]['name'] = '简历';
$MODULE[-9]['linkurl'] = $MODULE[9]['linkurl'];
$status = isset($status) ? intval($status) : 3;
$do = new keyword;
switch($action) {
	case 'letter':
		if(!$word) exit('');
		if(strtoupper(DT_CHARSET) != 'UTF-8') $word = convert($word, 'UTF-8', DT_CHARSET);
		exit(gb2py($word));
	break;
	default:
		if($submit) {
			$do->update($post);
			dmsg('更新成功', '?file='.$file.'&status='.$status);
		} else {
			$sorder  = array('结果排序方式', '总搜索量降序', '总搜索量升序', '本月搜索降序', '本月搜索升序', '本周搜索降序', '本周搜索升序', '今日搜索降序', '今日搜索升序', '信息数量降序', '信息数量升序', '更新时间降序', '更新时间升序');
			$dorder  = array('itemid DESC', 'total_search DESC', 'total_search ASC', 'month_search DESC', 'month_search ASC', 'week_search DESC', 'week_search ASC', 'today_search DESC', 'today_search ASC', 'items DESC', 'items ASC', 'updatetime DESC', 'updatetime ASC');
			isset($order) && isset($dorder[$order]) or $order = 0;
			isset($mid) or $mid = 0;
			$order_select  = dselect($sorder, 'order', '', $order);

			$condition = "status=$status";
			if($keyword) $condition .= " AND keyword LIKE '%$keyword%'";
			if($mid) $condition .= " AND moduleid=$mid";
			$lists = $do->get_list($condition, $dorder[$order]);
			include tpl('keyword');
		}
	break;
}

class keyword {
	var $db;
	var $table;

	function keyword() {
		global $db, $DT_PRE;
		$this->table = $DT_PRE.'keyword';
		$this->db = &$db;
	}

	function get_list($condition, $order) {
		global $pages, $page, $pagesize, $offset, $pagesize;
		$pages = pages($this->db->count($this->table, $condition), $page, $pagesize);
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
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
	}

	function add($post) {
		global $DT_TIME;
		if(!$post['word']) return false;
		$post['status'] = $post['status'] == 3 ? 3 : 2;
		$this->db->query("INSERT INTO {$this->table} (moduleid,word,keyword,letter,items,total_search,month_search,week_search,today_search,updatetime,status) VALUES('$post[moduleid]','$post[word]','$post[keyword]','$post[letter]','$post[items]','$post[total_search]','$post[month_search]','$post[week_search]','$post[today_search]','$DT_TIME', '$post[status]')");
	}

	function edit($post) {
		foreach($post as $k=>$v) {
			if(!$v['word']) continue;
			$v['status'] = $v['status'] == 3 ? 3 : 2;
			$this->db->query("UPDATE {$this->table} SET word='$v[word]',keyword='$v[keyword]',letter='$v[letter]',total_search='$v[total_search]',month_search='$v[month_search]',week_search='$v[week_search]',today_search='$v[today_search]',status='$v[status]' WHERE itemid='$k'");
		}
	}

	function delete($itemid) {
		$this->db->query("DELETE FROM {$this->table} WHERE itemid=$itemid");
	}
}
?>