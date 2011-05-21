<?php


if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$fina_narrate_arr = array(
						'1'=>'在线充值',
						'2'=>'任务佣金',
						'3'=>'推广佣金',
						'4'=>'任务支出',
						'5'=>'推广支出',
						'6'=>'提现成功',
						'7'=>'购买vip',
						'8'=>'任务返款',
						'9'=>'推广返款',
						'11'=>'实名认证',
						'12'=>'银行认证',
						'13'=>'企业认证',
						'14'=>'邮箱认证',
						'16'=>'提现申请',
						'17'=>'提现失败返款',
						'21'=>'购买服务',
						'22'=>'服务佣金',
						'23'=>'服务退款'
);



$page_obj = new Pages_Class();

$finance_obj = new Keke_witkey_finance_class();

if(intval($uid)){
	
	$where =  '  1 = 1 and uid = '.intval($uid);
 	
	
	if($slt_narrate){
		$where.=' and  fina_narrate =  '.intval($slt_narrate);
	}
	

	if(intval($txt_start_cash)&&intval($txt_end_cash)){
		if(intval($txt_start_cash)>=intval($txt_end_cash)){
			Func_comm_class::showmessage('搜索失败','index.php?do=user&view=finance',2,'开始金额不能大于结束金额','error');
		}elseif(intval($txt_start_cash)==intval($txt_end_cash)){
			$where.= ' and fina_cash = '.intval($txt_start_cash);
		}else{
			$where.= ' and fina_cash >= '.intval($txt_start_cash).' and fina_cash <= '.intval($txt_end_cash);
		}
	}
	

	
	$txt_start_time = strtotime($txt_start_time);
	$txt_end_time = strtotime($txt_end_time);
	
	if(intval($txt_start_time)&&intval($txt_end_time)){
		if(intval($txt_start_time)>=intval($txt_end_time)){
			Func_comm_class::showmessage('搜索失败','index.php?do=user&view=finance',2,'开始时间不能大于结束时间','error');
		}elseif(intval($txt_start_time)==intval($txt_end_time)){
			$where.= ' and fina_time = '.intval($txt_start_time);
		}else{
			$where.= ' and fina_time >= '.intval($txt_start_time).' and fina_time <= '.intval($txt_end_time);
		}
	}
	

	$page_size = intval($page_size)?intval($page_size):17;
		


	$finance_obj->setWhere($where);
	$count = $finance_obj->count_keke_witkey_finance();

	$url ='index.php?do='.$do.'&view='.$view.'&page_size='.$page_size.
	'&slt_narrate='.$slt_narrate.'&txt_start_cash='.$txt_start_cash.'&txt_end_cash='.$txt_end_cash.
	'&txt_start_time='.$txt_start_time.'&txt_end_time='.$txt_end_time;
	$page = $_GET ['page'] ? $_GET ['page'] : 1;
	$limit=$page_size;
	$pages = $page_obj->getPages($count,$limit,$page,$url);
	

	$order_where = ' order by fina_id desc ';
	

	$where .= $order_where;

	$finance_obj->setWhere($where.$pages[where]);
	$finance_arr = $finance_obj->query_keke_witkey_finance();
	
}



require_once  $template_obj->template ($do."_".$view);