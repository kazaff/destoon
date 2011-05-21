<?php
 
if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

 
 
 
$sid = $_GET['sid'];



 
$service_obj = new Keke_witkey_service_class();
$s_config = Cache_ext_Class::getConfig("shop");
$page_obj = new Pages_Class ( );

if(isset($sid)&& intval($sid)){
   $service_obj->setWhere(" service_id = $sid");
   $service_info = $service_obj->query_keke_witkey_service();
   $service_info= $service_info[0];
}
else{
	Func_comm_class::showmessage('错误提示','shop.php',3,'参数错误','error');
}

if (!$service_info||$service_info['is_stop']){
	Func_comm_class::showmessage('错误提示','shop.php',3,'商品不存在或已删除','error');
}

 
$shop_id = $service_info['shop_id'];
 
$shop_info = db_factory::query ( "select b.*,a.*,a.indus_id as shop_indus_id from " . TABLEPRE . "witkey_shop a left join " . TABLEPRE . "witkey_space b on a.uid = b.uid where a.shop_id = '$shop_id'" );
$shop_info = $shop_info [0];

 
 
if ($shop_info ['shop_type'] == 1 && !$shop_info['is_close']) {  
 
	$shop_config = db_factory::query ( "select * from " . TABLEPRE . "witkey_shop_tpl_pconfig where shop_id = '{$shop_info['shop_id']}' " );
	$shop_config = $shop_config[0];
	
 
	$shop_banner = $shop_config ['banner_img'];
	if (! $shop_banner && $shop_config ['banner_id']) {
		$banner_info = Cache_ext_Class::gettabledata ( "witkey_shop_banner", "banner_id = '{$shop_info['banner_id']}'", "", null, "", 1, 1 );
		$shop_banner = $banner_info ['img_file'];
	}
	
	$shop_indus = Cache_ext_Class::getIndustryList (1);
	$service_range = explode ( ',', $shop_info ['service_range'] );
	$shop_pindus = Cache_ext_Class::gettabledata("witkey_shop_cus_cate","shop_id={$shop_info['shop_id']} and obj_type = 2","",null,'cus_cate_id');
 
	$link_arr = db_factory::query ( "select * from " . TABLEPRE . "witkey_link where shop_id = $shop_id order by listorder asc" );

} else if ($shop_info ['shop_type'] == 2 && !$shop_info['is_close']){  
 
	$shop_config = db_factory::query ( "select * from " . TABLEPRE . "witkey_shop_tpl_econfig where shop_id = '{$shop_info['shop_id']}' " );
	$shop_config = $shop_config[0];
}else {
	Func_comm_class::showmessage('错误提示','shop.php',3,'店铺不存在或已关闭','error');
}
 
 
$shop_meun = Cache_ext_Class::gettabledata ( "witkey_shop_menu", "shop_id='$shop_id'", '', 5000, '', 1, 1 );
if (! $shop_meun) {
	include_once 'header_menu_default.php';
	$shop_meun = $menu_arr [$shop_info ['shop_type']];
}

 
if ($op == "confirm"&&$uid&&$uid!=$service_info['uid']){
	$user_info = Func_comm_class::getuserinfo($uid);
	$title = "确认购买";
	require $template_obj->template("shop/tpl/{$_K['template']}/order_confirm");die();	
}

 
if ($op == 'online'&&$uid&&$uid!=$service_info['uid']){
	$service_order_obj = new Keke_witkey_service_order_class();
	$service_order_obj->setOn_time(time());
	$service_order_obj->setOrder_status(0);
	$service_order_obj->setBuy_uid($uid);
	$service_order_obj->setBuy_username($username);
	$service_order_obj->setSale_uid($service_info['uid']);
	$service_order_obj->setSale_username($service_info['username']);
	$service_order_obj->setService_id($sid);
	$service_order_obj->setService_type(2);
	$service_order_obj->setTitle($service_info['title']);
	$service_order_obj->setCount_cash($service_info['price']);
	$service_order_obj->setShop_id($service_info['shop_id']);
	$order_id = $service_order_obj->create_keke_witkey_service_order();
	Func_comm_class::showmessage("跳转","index.php?do=user&view=cash&type=service_buy&obj_id=$order_id&cash={$service_info['price']}",1,"转入在线支付流程");;
}


 
if ($op == 'order'&&$uid&&$uid!=$service_info['uid']){
 
	$user_info = Func_comm_class::getuserinfo($uid);
	$cost_cash=$count_cash = $service_info['price'];
	if ($basic_config['credit_is_allow']==2){
		$user_info['credit']=0;
	}
	$cost_credit = $user_info['credit']>=$count_cash?$count_cash:$user_info['credit'];
	$cost_cash-=$cost_credit;
	if ($cost_credit){
		db_factory::execute("update ".TABLEPRE."witkey_space set credit=credit-$cost_credit where uid = '$uid'");
	}
	if ($cost_cash){
		db_factory::execute("update ".TABLEPRE."witkey_space set balance=balance-$cost_cash where uid = '$uid'");
	}
 
	
	$pay_cash = $count_cash;
	if ($s_config['down_prorate']){
		$pay_cash = $pay_cash*(100-$s_config['down_prorate'])/100;
	}
	db_factory::execute("update ".TABLEPRE."witkey_space set balance=balance+$pay_cash where uid='{$shop_info['uid']}'");
	
	
 
	$service_order_obj = new Keke_witkey_service_order_class();
	$service_order_obj->setBuy_uid($uid);
	$service_order_obj->setBuy_username($username);
	$service_order_obj->setBuyer_status(1);
	$service_order_obj->setCost_cash($cost_cash);
	$service_order_obj->setCost_credit($cost_credit);
	$service_order_obj->setCount_cash($service_info['price']);
	$service_order_obj->setOn_time(time());
	$service_order_obj->setOrder_status(7);
	$service_order_obj->setSale_uid($service_info['uid']);
	$service_order_obj->setSale_username($service_info['username']);
	$service_order_obj->setSale_status(1);
	$service_order_obj->setService_id($sid);
	$service_order_obj->setService_type($service_info['service_type']);
	$service_order_obj->setShop_id($shop_id);
	$service_order_obj->setTitle($service_info['title']);
	$order_id = $service_order_obj->create_keke_witkey_service_order();
	
	$fina_obj = new Keke_witkey_finance_class();
	$fina_obj->setFina_cash($cost_cash);
	$fina_obj->setFina_credit($cost_credit);
	$fina_obj->setFina_narrate(21);
	$fina_obj->setFina_time(time());
	$fina_obj->setFina_type(1);
	$fina_obj->setOrder_id($order_id);
	$fina_obj->setUid($uid);
	$fina_obj->setUser_balance($user_info['balance']-$cost_cash);
	$fina_obj->setUser_credit($user_info['credit']-$cost_credit);
	$fina_obj->setUsername($username);
	$fina_obj->setSite_profit($count_cash-$pay_cash);
	$fina_obj->create_keke_witkey_finance();
	
	$shop_userinfo = Func_comm_class::getuserinfo($shop_info['uid']);
	$fina_obj = new Keke_witkey_finance_class();
	$fina_obj->setFina_cash($count_cash);
	$fina_obj->setFina_narrate(22);
	$fina_obj->setFina_time(time());
	$fina_obj->setFina_type(2);
	$fina_obj->setOrder_id($order_id);
	$fina_obj->setUid($shop_info['uid']);
	$fina_obj->setUser_balance($shop_userinfo['balance']+$pay_cash);
	$fina_obj->setUsername($shop_info['username']);
	$fina_obj->create_keke_witkey_finance();
	
	Func_comm_class::feed_add('<a target="_blank" href="index.php?do=space&member_id='.$uid.'" >'.$username.'</a>购买了<a target="_blank" href="index.php?do=space&member_id='.$shop_info['uid'].'">'.$shop_info['username'].'</a>的服务<a target="_blank" href="shop.php?do=service_info&sid='.$sid.'">'.$service_info['title'].'</a>',$uid,$username,'buy_service',$sid);
	Func_comm_class::notify_user('服务购买通知','<a target="_blank" href="index.php?do=space&member_id='.$uid.'" >'.$username.'</a>购买了您的服务<a target="_blank" href="shop.php?do=service_info&sid='.$sid.'">'.$service_info['title'].'</a>',$shop_info['uid'],$shop_info['username']);
	
	Func_comm_class::showmessage("服务购买成功","shop.php?do=service_info&sid=$sid");
}



 
	if($op == 'bookmark'){
		$fav_obj = new Keke_witkey_favorite_class();
		$fav_obj->setWhere("obj_id = $shop_id and obj_type=1 and uid = '$uid'");
		$count = $fav_obj->count_keke_witkey_favorite();
		if ($count){
			Func_comm_class::echojson ( '', 0 );die();
		}
		
		$fav_obj->setObj_id($shop_id);
		$fav_obj->setObj_type(1);
		$fav_obj->setOn_date(time());
		$fav_obj->setUid($uid);
		$fav_obj->setUsername($username);
		$fav_obj->setObj_name($service_info['title']);
		$res = $fav_obj->create_keke_witkey_favorite();
		if ($res) {
			Func_comm_class::echojson ( '', 1 );die();
		}
		
	}
	
 
	$service_order_obj = new Keke_witkey_service_order_class();
	$service_order_obj->setWhere("order_status = 7 and service_id = '$sid'");
	$s_count = $service_order_obj->count_keke_witkey_service_order();
	
	$page_size = $page ? $page : 1;
	$limit = 10;
	$url = 'shop.php?do=service_info&sid=' . $sid . '&page_size=' . $page_size;
	$s_pages = $page_obj->getPages($s_count,$limit,$page_size,$url);
	$service_order_obj->setWhere("order_status = 7 and service_id = '$sid' {$_pages['where']}" );
	
	$order_list = $service_order_obj->query_keke_witkey_service_order();
	
	
 
	    $mark_obj = new Keke_witkey_mark_log_class();
	
		$where =' 1= 1 and mark_type = 2 and mark_status !=0 and obj_id = '.$sid;
		
		if($slt_mark_type){
			$where.=' and mark_status = '.intval($slt_mark_type);
		}
		if($slt_mark_content){
			if(intval($slt_mark_content)==1){
				$where.=' and mark_content !="" ';
			}else{
				$where.=' and mark_content ="" ';
			}
		}
		
		if($slt_mark_from){
			if(intval($slt_mark_from)==1){
				$where.=' and  user_type = 1';
			}else if(intval($slt_mark_from)==2){
				$where.=' and user_type = 2 ';
			}else{
				$where.=' and  user_type = 1';
			}
		}else{
			$where.=' and  user_type = 1';
		}
		
		$order_where=' order by mark_time desc ';
		$where=$where.$order_where;
		
		$mark_obj->setWhere($where);
		$count = $mark_obj->count_keke_witkey_mark_log();
		
 
		$page_size = 10;
		$url = 'shop.php?do=service_info&sid=' . $sid . '&page_size=' . $page_size;
		
		if($slt_mark_type){
			$url.='&slt_mark_type='.$slt_mark_type;
		}
		if($slt_mark_content){
			$url.='&slt_mark_content='.$slt_mark_content;
		}
		if($slt_mark_from){
			$url.='&slt_mark_from='.$slt_mark_from;
		}
		
		$page = $_GET ['page'] ? $_GET ['page'] : 1;
		$limit = $page_size;
		$mark_log_pages = $page_obj->getPages ( $count, $limit, $page, $url );
		
		$mark_obj->setWhere($where.$mark_log_pages[where]);
		$mark_log_arr = $mark_obj->query_keke_witkey_mark_log();
		
	
	
	 
	if ($service_info['service_type']>1){
	 
		$service_order_obj->setWhere("order_status = 7 and service_id = '$sid' and buy_uid='$uid'");
		$had_buy = $service_order_obj->query_keke_witkey_service_order();
		$had_buy = $had_buy[0];
	}

if ($op == 'filedown'){
	if (!$had_buy){
		die("您没有下载此文件的权限");
	}
	$file=$service_info['file_path'];
	$filename = S_ROOT .$file;
	$downfilename = $file;
	
	Header("Content-type: application/octet-stream");
	Header("Accept-Ranges: bytes");
	Header("Accept-Length: ".filesize($filename));
	Header("Content-Disposition: attachment; filename=".$downfilename);
	$file = fopen($filename,"r");
	echo fread($file,filesize($filename));
	fclose($file);
	die();
}
 
if ($shop_info['shop_type']==1){
	require_once $template_obj->template("shop/tpl/{$_K['template']}/person_shop_service_info");
}
else{
 
	if($shop_config['tpl_direction']==1)
	{	 
		require_once $template_obj->template("shop/tpl/{$_K['template']}/enterprise_shop_service_info");
	}else {	 
		require_once $template_obj->template("shop/tpl/{$_K['template']}/enterprisev_shop_service_info");
	}
}

