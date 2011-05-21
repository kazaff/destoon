<?php

if (! defined ( 'ADMIN_KEKE' )) {
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


$views = array ('withdraw', 'in', 'all','report','info');

$view = (! empty ( $view ) && in_array ( $view, $views )) ? $view : 'info';



if (file_exists ( ADMIN_ROOT . 'admin_'.$do.'_' . $view . '.php' )) {
	require_once ADMIN_ROOT . 'admin_'.$do.'_' . $view . '.php';
} else {
	Func_comm_class::adminshowmessage ( "您访问的页面不存在!" );
}
