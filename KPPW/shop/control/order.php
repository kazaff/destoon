<?php

if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

$_K['is_rewrite'] = 0 ;

if (!$uid){
	Func_comm_class::showmessage("没有登录","index.php?do=login",3,'请先登录！','error');
}


if (!$service_id)
{
	Func_comm_class::showmessage("错误提示",$_K['siteurl'],3,'参数信息错误！','error');
}

$service_order_obj = new Keke_witkey_service_order_class();
$service_obj = new Keke_witkey_service_class();
$order_detail_obj = new Keke_witkey_service_order_detail_class();


$service_obj->setWhere("service_id = '$service_id'");
$service_info = $service_obj->query_keke_witkey_service();
$service_info = $service_info[0];

if (!$service_info){
	Func_comm_class::showmessage("错误提示",$_K['siteurl'],3,'此服务不存在或已被关闭！','error');
}


$shop_info = db_factory::query("select b.*,a.* from ".TABLEPRE."witkey_shop a left join ".TABLEPRE."witkey_space b on a.uid = b.uid where a.shop_id = '{$service_info['shop_id']}'");
$shop_info = $shop_info[0];

if (!$shop_info){
	Func_comm_class::showmessage("错误提示",$_K['siteurl'],3,'此服务所在店铺已关闭服务！','error');
}

$shop_logo = db_factory::query("select shop_logo from ".TABLEPRE."witkey_shop_tpl_econfig where shop_id = '{$shop_info['shop_id']}'");
$shop_logo = $shop_logo[0]['shop_logo'];


if ($shop_info['uid']==$uid){
	Func_comm_class::showmessage("错误提示",$_SERVER['HTTP_REFERER'],3,'这是您自己的店铺,您不需要购买的！','error');
}

//if(Func_comm_class::submitcheck('formhash')){
if($formhash){
	//订单数据处理
	$service_order_obj->_order_id = null;
	$service_order_obj->setTitle($order['title']);
	$service_order_obj->setCount_cash($order['count_cash']);
	
	

		$service_order_obj->setBuy_uid($uid);
		$service_order_obj->setBuy_username($username);
		$service_order_obj->setOn_time(time());
		$service_order_obj->setOrder_status(0);
		$service_order_obj->setSale_uid($service_info['uid']);
		$service_order_obj->setSale_username($service_info['username']);
		$service_order_obj->setService_id($service_id);
		$service_order_obj->setService_type($service_info['service_type']);
		$service_order_obj->setShop_id($service_info['shop_id']);
		$service_order_obj->setBuyer_status(1);
		$service_order_obj->setSale_status(0);
		$order_id = $service_order_obj->create_keke_witkey_service_order();
		$res += $order_id;
		

		$noti_info = '<a target="_blank" href="'.$_K['siteurl'].'/index.php?do=space&member_id='.$uid.'">'.$username.'</a>购买了您的服务<a target="_blank" href="shop.php?do=service_info&sid='.$service_info['service_id'].'">'.$service_info['title'].'</a>  <a target="_blank" href="'.$_K['siteurl'].'/shop.php?do=step&order_id='.$order_id.'">查看订单</a>';
		Func_comm_class::notify_user("您有新的订单",$noti_info,$shop_info['uid']);
		$userinfo = Func_comm_class::getuserinfo($uid);
		if ($userinfo['email'])Func_comm_class::sendMail($userinfo['email'],'您的服务<<'.$service_info['title'].'>>有新的订单',$noti_info);
		
		

	if ($detail_arr['del']){
		$order_detail_obj->setWhere("detail_id in ({$detail_arr[del]})");
		$res +=$order_detail_obj->del_keke_witkey_service_order_detail();
	}
	
	
	if ($detail_arr['new'])
	foreach($detail_arr['new'] as $k=>$detail){
		$order_detail_obj->_detail_id=null;
		$order_detail_obj->setStep_cash($detail['step_cash']);
		$order_detail_obj->setStep_detail($detail['step_detail']);
		$order_detail_obj->setStep_num($k);
		$order_detail_obj->setStep_status(0);
		$order_detail_obj->setOrder_id($order_id);
		$res += $order_detail_obj->create_keke_witkey_service_order_detail();
	}
	
	
	if ($res){
		if($uid && $uid != $shop_info['uid']){
			Func_comm_class::update_score_value($uid,'buy_service',3);
		}
		Func_comm_class::showmessage("订单提交成功","shop.php?do=step&order_id=$order_id");
	}
	else {
		Func_comm_class::showmessage("错误提示","shop.php?do=order&order_id=$order_id&service_id=$service_id",3,'订单无任何修改！','error');
	}
}
	


require_once $template_obj->template("shop/tpl/{$_K['template']}/".$do);