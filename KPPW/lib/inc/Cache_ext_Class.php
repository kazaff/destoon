<?php

require_once 'Cache_Class.php';

class Cache_ext_Class extends Cache {
	
	static function getMenuset(){
		global $model_list;
		
		$menuset_arr = Cache::get('menu_resource_cache');

		if(!$menuset_arr){
		
		$resource_obj = new Keke_witkey_resource_class();
		$resource_obj->setWhere("1=1 order by listorder asc");
		$resource_arr = $resource_obj->query_keke_witkey_resource();
		$resource_submenu_obj = new Keke_witkey_resource_submenu_class();
		$resource_submenu_obj->setWhere("1=1 order by listorder");
		$resource_sub_arr = $resource_submenu_obj->query_keke_witkey_resource_submenu();
		
		$temp_arr = array();
		$temp_arr2 = array();
		$resource_set_arr = array();
		$submenu_set_arr = array();
		foreach ($resource_arr as $r_tp){
			$resource_set_arr[$r_tp['resource_id']]=$r_tp;
			$temp_arr[$r_tp['submenu_id']][]=$r_tp;
		}
		foreach ($resource_sub_arr as $r_tp){
			$submenu_set_arr[$r_tp['submenu_id']] = $r_tp;
			$temp_arr2[$r_tp['menu_name']][]=array('name'=>$r_tp['submenu_name'], 'items'=>$temp_arr[$r_tp['submenu_id']]);
		}
		$resource_arr = $temp_arr2;
		$menuset_arr = array('menu'=>$resource_arr,'submenu'=>$submenu_set_arr,'resource'=>$resource_set_arr);
		
		
		$model_list = $model_list?$model_list:Cache_ext_Class::gettabledata('witkey_model','model_status=1','',null,'model_id');
		$i=0;
		foreach ($model_list as $model)
		{
			$task_menu_arr = array();
			if (!file_exists(S_ROOT.'task/'.$model['model_dir'].'/control/admin/task_config.php')){
				continue;
			}
			require S_ROOT.'task/'.$model['model_dir'].'/control/admin/task_config.php';
			$mulist_arr = array();
			foreach ($task_menu_arr as $k=>$v){
				$mulist_arr[]=array(
					'resource_id'=>"m{$model['model_id']}".$i++,
					'resource_name'=>$k,
					'resource_url'=>$v,
				);
			}
			
			$menuset_arr['menu']['task'][] = array(
				'name'=>$model['model_name'],
				'items'=>$mulist_arr,
			);
		}
		
		
		
		Cache::write($menuset_arr,'menu_resource_cache');
		}
		return $menuset_arr;
	}
	
	static function getGroupList(){
		$group_arr = Cache::get("member_group_cache");
		if (!$group_arr)
		{
			$membergroup_obj = new Keke_witkey_member_group_class();
			$group_arr = $membergroup_obj->query_keke_witkey_member_group();
			$temp_arr = array();
			foreach ($group_arr as $v)
			{
				$temp_arr[$v['group_id']] = $v;
				$temp_arr[$v['group_id']]['group_roles'] = explode(',',$v['group_roles']);
			}
			$group_arr = $temp_arr;
			Cache::write($group_arr,'member_group_cache');
		}
		
		return $group_arr;
	}
	
	static function getAdminUserinfo($uid){
		$space_obj = new Keke_witkey_space_class();
		$myinfo_arr = Cache::get("admin_user_{$uid}_info_cache");
		if(!$myinfo_arr)
		{
			$space_obj->setWhere("uid='$uid'");
			$myinfo_arr = $space_obj->query_keke_witkey_space();
			$myinfo_arr = $myinfo_arr[0];
			
			Cache::write($myinfo_arr,"admin_user_{$uid}_info_cache",60*60);
		}
		return $myinfo_arr;
		
		
	}
	
	static function getIndustryList($indus_type="1",$pid = NULL,$cache=NULL){
		
		if(is_null($pid)){
			$where = "indus_type='".intval($indus_type)."'";
		}else {
			//$where = "indus_pid = '".intval($pid)."'";
			$where = "indus_type='".intval($indus_type)."' and indus_pid = '".intval($pid)."'";
		}
		$indus_arr = self::gettabledata("witkey_industry",$where,"listorder",$cache,"indus_id");
		
		return $indus_arr;

	}
	
	static function getIndusIndex($indus_type="1",$pid = NULL){
		$indus_index_arr = Cache::get('indus_index_arr'.$indus_type.'_'.$pid);
		if(!$indus_index_arr){
			$indus_arr = Cache_ext_Class::getIndustryList($indus_type,$pid);
			$indus_index_arr = array();
			foreach ($indus_arr as $indus){
				$indus_index_arr[$indus['indus_pid']][$indus['indus_id']] = $indus;
			}
			Cache::write($indus_index_arr,'indus_index_arr'.$indus_type.'_'.$pid);
		}
		return $indus_index_arr;
	}
	
	static function getSkillList(){
		$skill_arr = Cache::get("keke_witkey_skill");
		if(!$skill_arr){
			$skill_obj = new Keke_witkey_skill_class();
			$skill_obj->setWhere(' 1 = 1 order by listorder asc ');
			$skill_arr = $skill_obj->query_keke_witkey_skill();
			$temparr = array();
			foreach ($skill_arr as $inarr)
			{
				$temparr[$inarr['skill_id']] = $inarr;
			}
			$skill_arr = $temparr;
			Cache::write($skill_arr,"keke_witkey_skill");
		}
		
		return $skill_arr;

	}
	
	static function getArticleCategoryList(){
		$category_arr = Cache::get("keke_witkey_article_category");
		if(!$category_arr){
			$category_obj = new Keke_witkey_article_category_class();
			$category_obj->setWhere(' 1 = 1 order by listorder asc ');
			$category_arr = $category_obj->query_keke_witkey_article_category();
			$temparr = array();
			foreach ($category_arr as $inarr)
			{
				$temparr[$inarr['art_cat_id']] = $inarr;
			}
			$category_arr = $temparr;
			Cache::write($category_arr,"keke_witkey_article_category");
		}
		
		return $category_arr;

	}
	
	static function getConfig($configtype){
		$config_arr = Cache::get("keke_witkey_{$configtype}_config");
		if (!$config_arr)
		{
			eval('$config_obj = new Keke_witkey_'.$configtype.'_config_class();');
			eval('$config_arr = $config_obj->query_keke_witkey_'.$configtype.'_config();');
			Cache::write($config_arr,"keke_witkey_{$configtype}_config");
		}
		
		
		return $config_arr[0];
	}
	
	static function getConfigRule($ruletype,$nokey=''){
		$rule_arr = Cache::get("keke_witkey_{$ruletype}_rule".$nokey);
		if (!$rule_arr)
		{
			eval('$config_obj = new Keke_witkey_'.$ruletype.'_rule_class();');
			eval('$rule_arr = $config_obj->query_keke_witkey_'.$ruletype.'_rule();');
			if (!$nokey){
			$temp_arr = array();
				foreach ($rule_arr as $rule)
				{
					$temp_arr[$rule[$ruletype.'_rule_id']] = $rule;
				}
				$rule_arr = $temp_arr;
			}
			Cache::write($rule_arr,"keke_witkey_{$ruletype}_rule".$nokey);
		}
		
		return $rule_arr;
	}
	
	static function gettaglist($mode='')
	{
		$taginfo = Cache::get("tag_list_cache".$mode);
		
		if (!$taginfo)
		{
			$tag_obj = new Keke_witkey_tag_class();
			$taginfo = $tag_obj->query_keke_witkey_tag();
			$temp_arr = array();
			if (!$mode){
				foreach ($taginfo as $tag)
				{
					$temp_arr[$tag['tagname']]=$tag;
				}
				$taginfo = $temp_arr;
			}
			else if($mode==1){
				foreach ($taginfo as $tag)
				{
					$temp_arr[$tag['tag_id']]=$tag;
				}
				$taginfo = $temp_arr;
			}
			
			Cache::write($taginfo,"tag_list_cache".$mode);
		}
		return $taginfo;
	}
	
	static function getmessagetpl($tpltype)
	{
		$tpl = Cache::get("msg_template_".$tpltype."_cache");
		
		if (!$tpl)
		{
			$msg_obj = new Keke_witkey_message_template_class();
			$msg_obj->setWhere("msg_temp_type='$tpltype'");
			$tpl = $msg_obj->query_keke_witkey_message_template();
			Cache::write($taginfo,"msg_template_".$tpltype."_cache");
		}
		return $tpl[0];
	}
	
	static function get($filename)
	{
		return Cache::get($filename);
	}
	
	static function gettemplate(){
		$tpl = Cache::get("template_cache");
		if (!$tpl) {
			$template_obj = new Keke_witkey_template_class();
			$template_obj->setWhere("is_selected = 1");
			$tpl_arr = $template_obj->query_keke_witkey_template();
			$tpl = $tpl_arr[0];
			
			Cache::write($tpl,"template_cache");
		}
		return $tpl;
	}
	
	static function getadlist(){
		$adlist = Cache::get("ad_list_cache");
		if (!$adlist){
			$ad_obj = new Keke_witkey_ad_class();
			$ad_obj->setWhere('1=1 order by listorder');
			$templist = $ad_obj->query_keke_witkey_ad();
			$adlist = array();
			foreach ($templist as $t)
			{
				$adlist[$t['ad_id']] = $t;
			}
		}
		return $adlist;
	}
	
	static function gettabledata($tablename,$where='',$order='',$cachetime=0,$pkkeyname='',$rows='',$isoneline='')
	{
		
		$md5_k = md5($where.'_'.$order.'_'.$pkkeyname.'_'.$isoneline);
		$d_list = $cachetime===null?'':$cachetime>0?Cache::get($tablename.'_'.$md5_k):"";
		if (!$d_list){
			if ($cachetime==-1){
				Cache::delete($tablename.'_'.$md5_k);
			}
			$where = $where?"where $where":"";
			$sql = "select * from ".TABLEPRE.$tablename." ".$where." ";
			$sql.= $order?"order by $order ":"";
			if ($isoneline)
			{
				$sql .= $isoneline?"limit 0,1":"";
			}
			else {
				$sql .= $rows?"limit 0,$rows":"";
			}
			
			$d_list = db_factory::query($sql);
			
			if ($isoneline)
			{
				$d_list = $d_list[0];
			}
			elseif ($pkkeyname){
				$temp = array();
				foreach ($d_list as $v){
					$temp[$v[$pkkeyname]]=$v;
				}
				$d_list = $temp;
			}
			if (!($cachetime===0)){
			Cache::write($d_list,$tablename.'_'.$md5_k,$cachetime);
			}
		}
		
		return $d_list;
	}
	
	static function getPaymentConfig($paymentname=""){
		if ($paymentname){
			if (!file_exists(S_ROOT."./payment/".$paymentname."/pay_config.xml")){return FALSE;}
			$pay_config = Xml_Oper_Class::get_xml_toarr(S_ROOT."./payment/".$paymentname."/pay_config.xml");
			$list = Cache_ext_Class::gettabledata("witkey_payment","payment='$paymentname'","",0,'k');
			$temp = array();
			foreach ($list as $l){
				$temp[$l[k]] = $l['v'];
			}
			$list = $temp?array_merge($temp,$pay_config):$pay_config;
			
			return $list;
		}
		else {
			$filepath = S_ROOT."./payment";
			$handle=opendir($filepath);
			$i=0;
			while($file=readdir($handle)) {
				if (($file!=".")and($file!=".."and file_exists(S_ROOT."./payment/".$file."/pay_config.xml"))) {
					$paymentlist[$file]=Cache_ext_Class::getPaymentConfig($file);
					$i=$i+1;
				}
			}
			closedir($handle); 
			return $paymentlist;
		}
	}
	
	
	static function getRule($action,$uid=0,$userinfo=null,$model_id=0){
		global $site_rule_list;
		if (!$site_rule_list){
			$temp = Cache_ext_Class::gettabledata("witkey_rule","","",null);
			$site_rule_list = array();
			foreach ($temp as $t){
				$site_rule_list[$t['rule_key']][$t['rule_group']]=$t['rule'];
			}
		}
		
		if (!$uid&&!$userinfo){
			if ($_K['is_debug']){
				var_dump("Cache_ext_Class::getRule函数参数错误  未指定用户");
				die();
			}
			else {
				return -1;
			}
		}
		elseif ($uid&&!$userinfo){
			$userinfo = Func_comm_class::getuserinfo($uid);
		}
		$uid = $userinfo['uid'];
		if ($uid ==ADMIN_UID)
		{
			return 0;
		}
		
		$action .= $model_id?"_$model_id":"";
		$sc = Func_comm_class::get_experience_level($userinfo['experience_value']);
		$user_rule = $site_rule_list[$action]["score_{$sc['score_id']}"];
		return $user_rule;
		if ($userinfo['isvip']==1){
			$t = $site_rule_list[$action]["vip"];
			$user_rule = $t==-1?$user_rule:!$t?0:$user_rule;
		}
		if ($userinfo['realname_auth']==1){
			$t = $site_rule_list[$action]["realname"];
			$user_rule = $t==-1?$user_rule:!$t?0:$user_rule;
		}
		if ($userinfo['enterprise_auth']==1){
			$t = $site_rule_list[$action]["enterprise"];
			$user_rule = $t==-1?$user_rule:!$t?0:$user_rule;
		}
		if ($userinfo['email_auth']==1){
			$t = $site_rule_list[$action]["email"];
			$user_rule = $t==-1?$user_rule:!$t?0:$user_rule;
		}
		if ($userinfo['bank_auth']==1){
			$t = $site_rule_list[$action]["bank"];
			$user_rule = $t==-1?$user_rule:!$t?0:$user_rule;
		}
		return $user_rule;
	}
}
