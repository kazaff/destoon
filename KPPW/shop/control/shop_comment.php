<?php
 
if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}
 
if ($op == "comment") {
	$img = new Secode_class ( );
	$res_code = $img->check ( $code );
	
	if (! $res_code) {
		Func_comm_class::showmessage ( '留言，验证码输入有误！', 'shop.php?do=shop&view=comment&shop_id=' . $shop_id, 3, '验证码输入有误，请重新输入', 'error' );
	}
	
	if ($uid == $shop_info ['uid']) {
		Func_comm_class::showmessage ( '错误', 'shop.php?do=shop&view=comment&shop_id=' . $shop_id, 3, '您不能给自己的网店留言', 'error' );
	}
	
	$comment_obj = new Keke_witkey_comment_class ( );
	$comment_obj->setContent ( $txt_comment );
	$comment_obj->setComment_type ( 7 );
	if (! $ckb_hide_user) {
		$comment_obj->setUid ( $uid );
		$comment_obj->setUsername ( $username );
	}
	$comment_obj->setObj_id ( $shop_id );
	$comment_obj->setOn_time ( time () );
	$comment_obj->create_keke_witkey_comment ();
 
	if($uid && $uid != $shop_info['uid']){
		Func_comm_class::update_score_value($uid,'service_comment',2);
	}
	Func_comm_class::showmessage ( "操作成功", "shop.php?do=shop&view=comment&shop_id=$shop_id" );
}

 

 
$page_obj = new Pages_Class ( );  
$page = $page ? $page : 1;
$limit = 10;
$count = db_factory::query ( "select count(*) as count from " . TABLEPRE . "witkey_comment where comment_type in (7,8) and obj_id = $shop_id" );
$count = $count [0] ['count'];
$url = "shop.php?do=shop&view=comment&shop_id=$shop_id";
$pages = $page_obj->getPages ( $count, $limit, $page, $url );

$comment_obj = new Keke_witkey_comment_class ( );
$comment_obj->setWhere ( "comment_type in (7,8) and obj_id = $shop_id order by on_time {$pages['where']}" );
$comment_list = $comment_obj->query_keke_witkey_comment ();

 
$temp = array ();
foreach ( $comment_list as $c ) {
	if ($c ['p_id']) {
		$temp [$c ['p_id']] ['reply'] [$c ['comment_id']] = $c;
	} else {
		$temp [$c ['comment_id']] = $c;
	}
}
$comment_list = $temp;

if ($shop_info ['shop_type'] == 1) {
 
	

	require_once $template_obj->template ( "shop/tpl/{$_K['template']}/person_{$do}_{$view}" );
} else {
 
	

	if ($shop_config ['tpl_direction'] == 1) {
		require_once $template_obj->template ( "shop/tpl/{$_K['template']}/enterprise_{$do}_{$view}" );
	} else {
		require_once $template_obj->template ( "shop/tpl/{$_K['template']}/enterprisev_{$do}_{$view}" );
	}
}

