<?php

class Pages_Class {
	public $_style='Pagination';
	public $_ajax = 0;
	public $_param ;
	/**
	 * 生成分页html
	 *
	 * @param unknown_type $num
	 * @param unknown_type $perpage
	 * @param unknown_type $curpage
	 * @param unknown_type $mpurl
	 * @return unknown
	 */
	function setStyle($value){
		$this->_style = $value;
	}
	function  setAjax($value){
		$this->_ajax = $value;
	}
	function setParam($value){
		$this->_param = $value;
	}
	function Pagination($num, $perpage, $curpage, $mpurl) {
		$Paginationpage = '';
		$mpurl .= strpos ( $mpurl, '?' ) ? '&' : '?';
		if ($num > $perpage) {
			$page = 10;
			$offset = 5;
			$pages = @ceil ( $num / $perpage );
			if ($page > $pages) {
				$from = 1;
				$to = $pages;
			} else {
				$from = $curpage - $offset;
				$to = $curpage + $page - $offset - 1;
				if ($from < 1) {
					$to = $curpage + 1 - $from;
					$from = 1;
					if (($to - $from) < $page && ($to - $from) < $pages) {
						$to = $page;
					}
				} elseif ($to > $pages) {
					$from = $curpage - $pages + $to;
					$to = $pages;
					if (($to - $from) < $page && ($to - $from) < $pages) {
						$from = $pages - $page + 1;
					}
				}
			}
			
			if($this->_ajax){
				$Paginationpage = ($curpage - $offset > 1 && $pages > $page ? "<a href=javascript:; href=ajaxpage('{$mpurl}page=1'>第一页</a>" : '') . ($curpage > 1 ? "<a href=javascript:; onclick=ajaxpage('{$mpurl}page=".($curpage - 1)."')><<上一页</a> " : '');
				
			}else{
				$Paginationpage = ($curpage - $offset > 1 && $pages > $page ? '<a href="' . $mpurl . 'page=1">第一页</a> ' : '') . ($curpage > 1 ? '<a href="' . $mpurl . 'page=' . ($curpage - 1) . '"><<上一页</a> ' : '');
			}
			
			
			for($i = $from; $i <= $to; $i ++) {
				if($this->_ajax){
					$Paginationpage .= $i == $curpage ? '<a class="Nnow">' . $i . '</a>' : "<a href=javascript:; onclick=ajaxpage('".$mpurl."page={$i}')>{$i}</a>";
				}else{
					$Paginationpage .= $i == $curpage ? '<a class="Nnow">' . $i . '</a>' : '<a href="' . $mpurl . 'page=' . $i . '">' . $i . '</a> ';
				}
			}
			if($this->_ajax){
				$Paginationpage .= ($curpage < $pages ? "<a href=javascript:; onclick=ajaxpage('".$mpurl."page=". ($curpage + 1) . "')>下一页>></a>" : '') . ($to < $pages ? " <a href=javascript:; onclick=ajaxpage('".$mpurl."page={$pages}')>最后一页</a>" : '');
				$Paginationpage = $Paginationpage ? '<span> '.$curpage.' / '.$pages.' 页</span> ' . $Paginationpage : '';
			}else{
				$Paginationpage .= ($curpage < $pages ? '<a href="' . $mpurl . 'page=' . ($curpage + 1) . '">下一页>></a>' : '') . ($to < $pages ? ' <a href="' . $mpurl . 'page=' . $pages . '">最后一页</a>' : '');
				$Paginationpage = $Paginationpage ? '<span> '.$curpage.' / '.$pages.' 页</span> ' . $Paginationpage : '';
			}
		}
		return $Paginationpage;
	}
	
	
	/**
	 * 分页方法
	 *
	 * @param  $count 总记录数
	 * @param  $limit 每页多少条
	 * @param  $curpage 当前页数
	 * @param  $url 当前URl
	 * @return array(page,where)
	 */
	function getPages($count, $limit, $curpage, $url) {
		$style = $this->_style;
		if ($count > 0 && $limit > 0) {
			$total_pages = ceil ( $count / $limit );
			 
		} else {
			$total_pages = 0;
		}
		if ($curpage > $total_pages)
		{
			$curpage = $total_pages;
		}
		 
		$start = $limit * $curpage - $limit;
		if ($start < 0)	$start = 0;
		
		$where .= " limit " . $start . " ," . $limit;
		$page ['page'] = $this->$style( $count, $limit, $curpage, $url );
		$page ['where'] = $where;
		return $page;
	}
}

?>