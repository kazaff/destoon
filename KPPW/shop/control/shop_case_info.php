<?php
 
if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

 
$case_obj = new Keke_witkey_shop_case_class();
$page_obj = new Pages_Class();

if (!$cid){
	Func_comm_class::showmessage("错误提示","shop.php?do=shop&view=case",3,"参数错误","error");
}
if ($op == "comment"){
		$img = new Secode_class();
		$res_code =$img->check($code);
	
		if(!$res_code){
			Func_comm_class::showmessage('留言，验证码输入有误！',"shop.php?do=shop&view=case_info&cid=$cid&shop_id=$shop_id",3,'验证码输入有误，请重新输入','error');
		}
		
		if ($uid==$shop_info['uid']){
			Func_comm_class::showmessage('错误',"shop.php?do=shop&view=case_info&cid=$cid&shop_id=$shop_id",3,'您不能给自己的网店留言','error');
		}
		
		$comment_obj = new Keke_witkey_comment_class();
		$comment_obj->setContent($txt_comment);
		$comment_obj->setComment_type(9);
		if (!$ckb_hide_user){
			$comment_obj->setUid($uid);
			$comment_obj->setUsername($username);
		}
		$comment_obj->setObj_id($cid);
		$comment_obj->setOn_time(time());
		$comment_obj->create_keke_witkey_comment();
		Func_comm_class::showmessage("操作成功","shop.php?do=shop&view=case_info&cid=$cid&shop_id=$shop_id");
	}
	
	
	
	
	
	
	
	
 
	$case_obj = new Keke_witkey_shop_case_class();
	$case_obj->setWhere("case_id = $cid");
	$case_info = $case_obj->query_keke_witkey_shop_case();
	$case_info = $case_info[0];
	
 
	$page_obj = new Pages_Class(); 
	$page = $page ? $page : 1;
	$limit = 10;
	$count = db_factory::query("select count(*) as count from ".TABLEPRE."witkey_comment where comment_type in (8,9) and obj_id = $cid");
	$count = $count[0]['count'];
	$url = "shop.php?do=shop&view=case_info&shop_id=$shop_id&cid=$cid";
	$pages = $page_obj->getPages($count,$limit,$page,$url);
	
	
	$comment_obj = new Keke_witkey_comment_class();
	$comment_obj->setWhere("comment_type = 9 and obj_id = $cid order by on_time {$pages['where']}");
	$comment_list = $comment_obj->query_keke_witkey_comment();
if ($shop_info['shop_type']==1){
	
	
	
	
	require_once $template_obj->template("shop/tpl/{$_K['template']}/person_{$do}_{$view}");
}
else{
	 
	
	
if ($shop_config ['tpl_direction'] == 1) {
		require_once $template_obj->template ( "shop/tpl/{$_K['template']}/enterprise_{$do}_{$view}" );
	} else {
		require_once $template_obj->template ( "shop/tpl/{$_K['template']}/enterprisev_{$do}_{$view}" );
	}
}

