<?php
class Keke_witkey_article_ext_class extends Keke_witkey_article_class{
	 /**
		 * 查询表keke_witkey_article,keke_witkey_article_category当有条件时返回有条件的ROW，否则返所有记录
		 * @return 返回一个(array)关联数组
		 */
		function query_keke_witkey_article(){ 
			 if($this->_where){ 
				 $sql = "select 
				 b.art_cat_id,b.cat_name,a.art_id,a.username,a.art_title,
				 a.art_source,a.art_pic,a.content,a.is_recommend,a.seo_title,
				 a.seo_keyword,a.listorder,a.is_show,a.pub_time 
				 from $this->_tablename a
				 left join ".TABLEPRE."witkey_article_category  b
				 on a.art_cat_id = b.art_cat_id 
				 where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select  b.art_cat_id,b.cat_name,a.art_id,a.username,a.art_title,
				 a.art_source,a.art_pic,a.content,a.is_recommend,a.seo_title,
				 a.seo_keyword,a.listorder,a.is_show,a.pub_time from $this->_tablename a
				 left join ".TABLEPRE."witkey_article_category  b
				 on a.art_cat_id = b.art_cat_id 
				 "; 
			 } 
			 $this->_where = "";
			 return $this->_dbop->query($sql); 
		 } 

	    
		function count_keke_witkey_article(){ 
			 if($this->_where){ 
				 $sql = "select count(*) as count from $this->_tablename a
				 left join ".TABLEPRE."witkey_article_category  b
				 on a.art_cat_id = b.art_cat_id 
				 where ".$this->_where; 
			 } 
			 else{ 
				 $sql = "select count(*) as count from $this->_tablename a
				 left join ".TABLEPRE."witkey_article_category  b
				 on a.art_cat_id = b.art_cat_id 
				 "; 
			 } 
			 $this->_where = ""; 
			 return $this->_dbop->getCount($sql); 
		 } 
	
}
