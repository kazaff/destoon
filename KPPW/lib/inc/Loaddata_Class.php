<?php

class Loaddata_Class {
	
	static function readfeed($loadcount, $type = '', $uid = '', $objid = '', $templatename = "", $cachename = "", $cachetime = 0) {
		$feed_arr = $cachename ? Cache::get ( "feed_" . $cachename . "_cache" ) : null;
		if (! $feed_arr) {
			$feed_obj = new Keke_witkey_feed_class ( );
			$limit = $loadcount ? "limit 0,$loadcount" : "";
			$where = "1=1 ";
			$where .= $type ? "and feedtype='$type' " : "";
			$where .= $uid ? "and uid='$uid' " : "";
			$where .= $objid ? "and obj_id='$objid' " : "";
			$where .= " order by feed_time desc ";
			$feed_obj->setWhere ( $where . $limit );
			$feed_arr = $feed_obj->query_keke_witkey_feed ();
			$temp_arr = array ();
			foreach ( $feed_arr as $v ) {
				$v ['on_time'] = Func_comm_class::gmdate ( $v ['feed_time'] );
				$temp_arr [] = $v;
			}
			$feed_arr = $temp_arr;
			$cachename ? Cache::write ( $feed_arr, "feed_" . $cachename . "_cache", $cachetime ) : null;
		}
		
		$datalist = $feed_arr;
		
		$tplfile = './control/admin/tpl/template_feed_' . $templatename;
		
		if (! $tplfile) {
			$tplfile = 'control/admin/tpl/template_feed_default';
		}
		
		require Template_Class::template ( $tplfile );
	}
	
	
	static function readtag($name) {
		
		$tag_arr = Cache_ext_Class::gettaglist ();
		$tag_info = $tag_arr [$name];
		
		if ($tag_info ['tag_type'] == 5) {
			echo $tag_info ['code'];
		}
		
		
		if ($tag_info ['cache_time']) {
			

				$datalist = Cache::get('tag_datalist_data'.$tag_info ['tag_id']);
				if (!$datalist){
					$datalist = Loaddata_Class::loaddata ( $tag_info );
					Cache::write ( $datalist, 'tag_datalist_data' . $tag_info ['tag_id'], $tag_info ['cache_time'] );
				}
				$tplfile = './control/admin/tpl/template_tag_' . $tag_info ['tplname'];
				require Template_Class::template ( $tplfile );
		} 
		else if ($tag_info) {
			Loaddata_Class::previewtag ( $tag_info );
		} else {
			echo "标签" . $name . "未找到";
		}
	}
	
	static function gettagHTML($tagid) {
		global $_K;
		
		$url = $_K ['siteurl'] . "/control/admin/plu.php?do=previewtag&tagid=" . $tagid;
		if (function_exists("curl_init")){
			$content = Func_comm_class::curl_file_get_contents ( $url );
		}
		else {
			$content = file_get_contents ( $url );
		}
		return $content;
	}
	

	
	static function previewtag($tag_info) {
		$datalist = Loaddata_Class::loaddata ( $tag_info );
		
		//print_r($datalist);
		
		if ($tag_info['tag_type']!=5){
			$tplfile = 'control/admin/tpl/template_tag_' . $tag_info ['tplname'];
			require Template_Class::template ( $tplfile );
		}
		else{
			echo $tag_info['code'];
		}
	}
	
	
	static function loaddata($tag_info) {
		global $_K;
		
		if ($tag_info ['tag_type'] == 1) {
			$task_obj = new Keke_witkey_task_class ( );
			$where = "1=1 ";
			if ($tag_info ['task_ids']) {
				$where .= "adn task_id in ({$tag_info['task_ids']})";
			} else {
				if ($tag_info ['task_type']) {
					$where .= "and model_id = '{$tag_info['task_type']}' ";
				}
				if ($tag_info ['task_indus_ids']) {
					$where .= "and indus_id in ({$tag_info['task_indus_ids']}) ";
				} else if ($tag_info ['task_indus_id']) {
					$where .= "and indus_id = '{$tag_info['task_indus_id']}' ";
				}
				if ($tag_info ['task_status']) {
					$where .= "and task_status = '{$tag_info['task_status']}' ";
				} else {
					$where .= "and task_status in (2,3,4,7) ";
				}
				if ($tag_info ['start_time1']) {
					$where .= "and start_time >{$tag_info['start_time1']} ";
				}
				if ($tag_info ['start_time2']) {
					$where .= "and start_time <{$tag_info['start_time2']} ";
				}
				if ($tag_info ['end_time1']) {
					$where .= "and end_time >{$tag_info['end_time1']} ";
				}
				if ($tag_info ['end_time2']) {
					$where .= "and end_time <{$tag_info['end_time2']} ";
				}
				$lefttime = 0;
				if ($tag_info ['left_day']) {
					$lefttime += $tag_info ['left_day'] * 24 * 60 * 60;
				}
				if ($tag_info ['left_hour']) {
					$lefttime += $tag_info ['left_hour'] * 60 * 60;
				}
				if ($lefttime) {
					$lefttime += time ( 'now()' );
					$where .= "and end_time >{$lefttime} ";
				}
				if ($tag_info ['task_cash1']) {
					$where .= "and task_cash >{$tag_info['task_cash1']} ";
				}
				if ($tag_info ['task_cash2']) {
					$where .= "and task_cash <{$tag_info['task_cash2']} ";
				}
				if ($tag_info ['prom_cash1']) {
					$where .= "and prom_count >{$tag_info['prom_cash1']} ";
				}
				if ($tag_info ['prom_cash2']) {
					$where .= "and prom_count <{$tag_info['prom_cash2']} ";
				}
				if ($tag_info ['username']) {
					$where .= "and username = '{$tag_info['username']}' ";
				}
			}
			
			
$where .= $tag_info ['open_is_top'] ? "order by istop desc," : "order by ";
			switch ($tag_info ['listorder']) {
				case 1 :
				default :
					$where .= "task_id desc ";
					break;
				case 2 :
					$where .= "task_id asc ";
					break;
				case 3 :
					$where .= "task_cash desc ";
					break;
				case 4 :
					$where .= "task_cash asc ";
					break;
				case 5 :
					$where .= "prom_cash desc ";
					break;
				case 6 :
					$where .= "prom_cash asc ";
					break;
				case 7 :
					$where .= "start_time desc ";
					break;
				case 8 :
					$where .= "start_time asc ";
					break;
				case 9 :
					$where .= "end_time desc ";
					break;
				case 10 :
					$where .= "end_time asc ";
					break;
			}
			
			if ($tag_info ['loadcount']) {
				$where .= "limit 0,{$tag_info['loadcount']} ";
			}
			$task_obj->setWhere ( $where );
			
			$task_arr = $task_obj->query_keke_witkey_task ();
			
			$temp_arr = array ();
			$indus_arr = Cache_ext_Class::getIndustryList ();
			$task_cash_rule = Cache_ext_class::getConfigRule ( "cash" );
			foreach ( $task_arr as $v ) {
				$a = array ();
				$a ['id'] = $v ['task_id'];
				$a ['type'] = $v ['task_type'];
				$a ['status'] = $v ['task_status'];
				$a ['title'] = $v ['task_title'];
				$a ['pic'] = $v ['task_pic'];
				$a ['catid'] = $v ['indus_id'];
				$a ['uid'] = $v ['uid'];
				$a ['username'] = $v ['username'];
				$a ['starttime'] = $v ['start_time'];
				$a ['endtime'] = $v ['end_time'];
				$a ['cash'] = $v ['task_cash_coverage']?$task_cash_rule [$v ['task_cash_coverage']] ['start_cove'] . '-' . $task_cash_rule [$v ['task_cash_coverage']] ['end_cove']:$v ['task_cash'];
				
				$a ['views'] = $v ['view_num'];
				$a ['prom'] = $v ['prom_cash'];
				$a ['top'] = $v ['istop'];
				if ($a ['type'] == 1) {
					$a ['url'] = $_K ['siteurl'] . "/index.php?do=task&task_id=" . $a ['id'];
				} else {
					$a ['url'] = $_K ['siteurl'] . "/index.php?do=task&task_id=" . $a ['id'];
				}
				
				$a ['time'] = $v ['pub_time'];
				$temp_arr [] = $a;
			}
		
		} elseif ($tag_info ['tag_type'] == 2) {
			$art_obj = new Keke_witkey_article_class ( );
			$where = "1=1 ";
			
			if ($tag_info ['art_ids']) {
				$where .= "and art_id in ({$tag_info['art_ids']}) ";
			} else {
				if ($tag_info ['art_cat_ids']) {
					$where .= "and art_cat_id in ({$tag_info['art_cat_ids']}) ";
				} else if ($tag_info ['art_cat_id']) {
					$where .= "and (art_cat_id = '{$tag_info['art_cat_id']}' or art_cat_id in (select art_cat_id from " . TABLEPRE . "witkey_article_category" . " where art_cat_pid like '%{{$tag_info['art_cat_id']}}%')) ";
				}
				if ($tag_info ['art_time1']) {
					$where .= "and pub_time <{$tag_info['art_time1']} ";
				}
				if ($tag_info ['art_time2']) {
					$where .= "and pub_time >{$tag_info['art_time2']} ";
				}
				if ($tag_info ['art_hasimg']) {
					$where .= "and art_pic !='' ";
				}
				if ($tag_info ['art_iscommend']) {
					$where .= "and is_recommend=1 ";
				}
			}
			
			switch ($tag_info ['listorder']) {
				case 1 :
				default :
					$where .= "order by art_id desc ";
					break;
				case 2 :
					$where .= "order by art_id asc ";
					break;
				case 3 :
					$where .= "order by pub_time desc ";
					break;
				case 4 :
					$where .= "order by pub_time asc ";
					break;
			}
			
			if ($tag_info ['loadcount']) {
				$where .= "limit 0,{$tag_info['loadcount']} ";
			}
			$art_obj->setWhere ( $where );
			$art_arr = $art_obj->query_keke_witkey_article ();
			
			$temp_arr = array ();
			$cat_arr = Cache_ext_Class::getArticleCategoryList ();
			foreach ( $art_arr as $v ) {
				$a = array ();
				$a ['id'] = $v ['art_id'];
				$a ['catid'] = $v ['art_cat_id'];
				$a ['catname'] = $cat_arr [$v ['art_cat_id']] ['cat_name'];
				$a ['uid'] = $v [uid];
				$a ['catid'] = $v ['art_cat_id'];
				$a ['title'] = $v ['art_title'];
				$a ['content'] = $v ['content'];
				$a ['pic'] = $v ['art_pic'];
				$a ['time'] = $v ['pub_time'];
				$a ['url'] = $_K ['siteurl'] . "/index.php?do=news_info&art_id=" . $a ['id'];
				$temp_arr [] = $a;
			}
		
		} elseif ($tag_info ['tag_type'] == 3) {
			$cat_obj = null;
			if ($tag_info ['cat_type'] == 2) {
				$cat_obj = new Keke_witkey_article_category_class ( );
				$where = "1=1 ";
				
				$where .= $tag_info ['cat_cat_ids'] ? "and art_cat_id in ({$tag_info['cat_cat_ids']}) " : $tag_info ['cat_cat_ids'] ? "and art_cat_id in ({$tag_info['cat_cat_ids']}) " : "";
				if ($tag_info ['cat_loadsub']) {
					$where .= $tag_info ['cat_cat_ids'] ? "and art_cat_pid in ({$tag_info['cat_cat_ids']}) " : $tag_info ['cat_cat_ids'] ? "and art_cat_pid = '{$tag_info['cat_cat_id']}' " : "";
				}
				$where .= $tag_info ['cat_onlyrecommend'] ? "and is_show = 1 " : "";
				$where .= " order by listorder ";
				if ($tag_info ['loadcount']) {
					$where .= "limit 0,{$tag_info['loadcount']} ";
				}
				$cat_obj->setWhere ( $where );
				$cat_arr = $cat_obj->query_keke_witkey_article_category ();
				$temp_arr = array ();
				foreach ( $cat_arr as $v ) {
					$a = array ();
					$a ['id'] = $v ['art_cat_id'];
					$a ['name'] = $v ['cat_name'];
					$a ['url'] = $_K ['siteurl'] . "/index.php?do=news_list&art_cat_id=" . $a ['id'];
					$temp_arr [] = $a;
				}
			} else {
				
				$cat_obj = new Keke_witkey_industry_class ( );
				$where = "1=1 ";
				
				$where .= $tag_info ['cat_cat_ids'] ? "and indus_id in ({$tag_info['cat_cat_ids']})" : $tag_info ['cat_cat_ids'] ? "and indus_id in ({$tag_info['cat_cat_ids']})" : "";
				
				if ($tag_info ['cat_loadsub']) {
					$where .= $tag_info ['cat_cat_ids'] ? "and indus_pid in ({$tag_info['cat_cat_ids']})" : $tag_info ['cat_cat_ids'] ? "and indus_pid = '{$tag_info['cat_cat_id']}'" : "";
				}
				
				$where .= $tag_info ['cat_onlyrecommend'] ? "and is_recommend = 1 " : "";
				$where .=" order by listorder ";
				if ($tag_info ['loadcount']) {
					$where .= "limit 0,{$tag_info['loadcount']} ";
				}
				$cat_obj->setWhere ( $where);
				$cat_arr = $cat_obj->query_keke_witkey_industry ();
				$temp_arr = array ();
				foreach ( $cat_arr as $v ) {
					$a = array ();
					$a ['id'] = $v ['indus_id'];
					$a ['name'] = $v ['indus_name'];
					$a ['url'] = $_K ['siteurl'] . "/index.php?do=search_list&indus_id=" . $a ['id'];
					$temp_arr [] = $a;
				}
			}
		
		} elseif ($tag_info ['tag_type'] == 4) {
			$sql = stripslashes ( $tag_info ['tag_sql'] );
			$temp_arr = db_factory::query ( $sql );
		}
		
		return $temp_arr;
	
	}
	
	static function ad($adid) {
		$ad_arr = Cache_ext_Class::getadlist ();
		$ad_info = $ad_arr [$adid];
		if ($ad_info ['ad_type'] == 1) {
			$adstr = '<embed src="' . $ad_info ['ad_file'] . '" quality="high" width="' . $ad_info ['width'] . '" height="' . $ad_info ['height'] . '" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash"></embed>';
		} elseif ($ad_info ['ad_type'] == 2) {
		$adstr = '<img src="' . $ad_info ['ad_file'] . '" ';
		$adstr .= $ad_info ['width'] ? "width={$ad_info['width']} " : '';
		$adstr .= $ad_info ['height'] ? "height={$ad_info['height']} " : '';
		$adstr .= '>';
		if ($ad_info ['ad_url']) {
			$adstr = '<a href="' . $ad_info ['ad_url'] . '">' . $adstr . '</a>';
		}
		} elseif ($ad_info ['ad_type'] == 3) {
			$adstr = $ad_info ['ad_content'];
		}
		echo $adstr;
	
	}
	
	static function adgroup($adname, $tpl) {
		$ad_arr = Cache_ext_Class::getadlist ();
		
		$datalist = array ();
		
		foreach ( $ad_arr as $ad ) {
			
			if ($ad ['ad_name'] == $adname) {
				$datalist [] = $ad;
			}
		}
		
		$tpl = $tpl ? $tpl : 'default';
		$tplfile = './control/admin/tpl/template_adgroup_' . $tpl;
		require Template_Class::template ( $tplfile );
	}

}

?>