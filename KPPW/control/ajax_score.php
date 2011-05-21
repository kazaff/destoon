<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$ac_arr = array ("login" => "登录", "register" => "注册", "update_pic" => "更新图像", "edit_userinfo" => "完善用户信息", "edit_withdrawinfo" => "完善取款帐号", "buy_vip" => "购买VIP", "online_pay" => "在线付款", "withdraw" => "提现操作", "pub_task" => "发布任务", "view_task" => "查看任务", "collect_task" => "收藏任务", "task_comment" => "任务评论", "task_apply" => "任务投票", "task_pubwork" => "任务投稿", "task_bid" => "招标投标", "work_accept" => "任务选稿", "view_space" => "访问他人空间", "user_mark" => "互评", "access_shop" => "访问商城店铺", "buy_service" => "成功购买服务", "create_service" => "发布服务", "service_comment" => "服务互评", "create_shop" => "开通商铺" );
$ty_arr = array ("1" => "第一次 ", "2" => "每次 ", "3" => "每天一次 " );
 
if ($op == "getscore") {
	
	if (isset ( $_COOKIE ['score_log'] )) {
		
		$score_str = $_COOKIE ['score_log'];
		$score_arr = explode('-',$score_str);
		$ac_str = $ac_arr [$score_arr [1]];
		$ty_str = $ty_arr [$score_arr [2]];
		$msg = <<<EOT
<div class="popupmenu_layer">
			<p>$ac_str</p>
			<p class="btn_line">
				增加经验 <strong>+$score_arr[0]</strong> 
			</p>
			<p>
				$ty_str
			</p>
			
	</div>
EOT;
		setcookie ( "score_log", "" );
		echo $msg = Template_Class::xml_out($msg);
		
		
	}
	
	die ();
}